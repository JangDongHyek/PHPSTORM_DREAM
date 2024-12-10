<?php
include_once('./_common.php');

if (!$is_member) {
	goto_url(G5_BBS_URL."/login.php?url=".urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
}

if ($start_place == "") {
	alert("출발지 정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.", G5_URL."/index.php");
}
if ($end_place == "") {
	alert("도착지 정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.", G5_URL."/index.php");
}

$g5['title'] = '요청하기';
include_once(G5_THEME_PATH.'/head.php');


/********************************************************************
// 요금 계산식 정리
1. 기본(가장빠른콜) : km계산 (소숫점 반올림)
	- 3km이하 : 10,000원
	- 5km이하 : 12,000원
	- 10km이하 : 15,000원
	- 10km초과 ~ 25km이하 : ((총km-10)*1,000원) + 15,000원
	- 25km초과 ~ 200km이하 : (((총km-25)*2.5) * 1,000원) + 30,000원
	- 그외 : (((총km-200)/4)*1,000원) + 100,000원
2. 가장빠른콜→환급콜 변경시 : 기본km계산의 80%
3. 경로에 경유지 존재 : +10,000원
4. 경유콜 체크 : +10,000원
5. 2.5톤이상 체크 : +25,000원
********************************************************************/
?>
<script src="<?=G5_JS_URL?>/jquery.serializeObject.js"></script>
<script src="https://apis.openapi.sk.com/tmap/jsv2?version=1&appKey=<?=$config['cf_tmap_api']?>"></script><!-- tmap -->
<script>
//================================================================
// 출발지, 경유지, 도착지 정보
//----------------------------------------------------------------
var start_place = "<?=urldecode($start_place)?>",
	start_lat = parseFloat("<?=$start_lat?>"),
	start_lng = parseFloat("<?=$start_lng?>");
var pass_place = "<?=urldecode($pass_place)?>",
	pass_lat = parseFloat("<?=$pass_lat?>"),
	pass_lng = parseFloat("<?=$pass_lng?>");
var end_place = "<?=urldecode($end_place)?>",
	end_lat = parseFloat("<?=$end_lat?>"),
	end_lng = parseFloat("<?=$end_lng?>");

// 티맵 변수
var map;
var marker_s, marker_e, marker_m, waypoint;
var resultMarkerArr = [];
var drawInfoArr = [];
var resultInfoArr = [];

$(function() {
	initTmap();
})

function initTmap(){
	resultMarkerArr = [];
	
	// 1. 지도 띄우기
	map = new Tmapv2.Map("map_div", {
		center: new Tmapv2.LatLng(start_lat, start_lng),
		width : "100%",
		height : "260px",
		zoom : 12,
		zoomControl : true,
		scrollwheel : true
	});

	// 2. 시작, 도착 심볼찍기
	// 시작
	marker_s = new Tmapv2.Marker({
		position : new Tmapv2.LatLng(start_lat, start_lng),
		icon : "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_s.png",
		iconSize : new Tmapv2.Size(24, 38),
		map:map
	});
	resultMarkerArr.push(marker_s);
	// 도착
	marker_e = new Tmapv2.Marker({
		position : new Tmapv2.LatLng(end_lat, end_lng),
		icon : "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_e.png",
		iconSize : new Tmapv2.Size(24, 38),
		map:map
	});
	resultMarkerArr.push(marker_e);

	// 3. 경유지 심볼 찍기
	if (pass_place != "") {
		marker = new Tmapv2.Marker({
			position : new Tmapv2.LatLng(pass_lat, pass_lng),
			icon : "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_b_m_1.png",
			iconSize : new Tmapv2.Size(24, 38),
			map:map
		});
		resultMarkerArr.push(marker);
	}

	// 4. 경로탐색 API 사용요청
	var searchOption = 0; // 교통최적+(0:추천, 1:무료우선, 2:최소시간, 3:초보)
	var apiKey = "<?=$config['cf_tmap_api']?>";

	// 4.1 경유지가 있는경우 
	if (pass_place != "") {
		var routeLayer;  
		var headers = {}; 
		headers["appKey"] = apiKey;
		headers["Content-Type"] = "application/json";

		var param = JSON.stringify({
			"startName" : encodeURI(start_place),
			"startX" : String(start_lng),
			"startY" : String(start_lat),
			"startTime" : "<?=date('YmdHi')?>",
			"endName" : encodeURI(end_place),
			"endX" : String(end_lng),
			"endY" : String(end_lat),
			"viaPoints" : [{
				"viaPointId" : "12345",
				"viaPointName" : encodeURI(pass_place),
				"viaX" : String(pass_lng),
				"viaY" : String(pass_lat),
			}],
			"reqCoordType" : "WGS84GEO",
			"resCoordType" : "EPSG3857",
			"searchOption": searchOption
		});

		$.ajax({
			method:"POST",
			url:"https://apis.openapi.sk.com/tmap/routes/routeSequential30?version=1&format=json",//
			headers : headers,
			async:false,
			data:param,
			success:function(response){
				var resultData = response.properties;
				var resultFeatures = response.features;
				var tDistance = (resultData.totalDistance / 1000).toFixed(1); // 총거리(km)
				var tTime = (resultData.totalTime / 60).toFixed(0); // 총시간(분)
				//var tFare = resultData.totalFare; // 총요금(원)

				resultCalc(tDistance, tTime);
				
				// 기존 라인 초기화
				if(resultInfoArr.length>0){
					for(var i in resultInfoArr){
						resultInfoArr[i].setMap(null);
					}
					resultInfoArr=[];
				}
				
				for(var i in resultFeatures) {
					var geometry = resultFeatures[i].geometry;
					var properties = resultFeatures[i].properties;
					var polyline_;
					
					drawInfoArr = [];
					
					if(geometry.type == "LineString") {
						for(var j in geometry.coordinates){
							// 경로들의 결과값(구간)들을 포인트 객체로 변환 
							var latlng = new Tmapv2.Point(geometry.coordinates[j][0], geometry.coordinates[j][1]);
							// 포인트 객체를 받아 좌표값으로 변환
							var convertPoint = new Tmapv2.Projection.convertEPSG3857ToWGS84GEO(latlng);
							// 포인트객체의 정보로 좌표값 변환 객체로 저장
							var convertChange = new Tmapv2.LatLng(convertPoint._lat, convertPoint._lng);
							
							drawInfoArr.push(convertChange);
						}

						polyline_ = new Tmapv2.Polyline({
							path : drawInfoArr,
							strokeColor : "#FF0000",
							strokeWeight: 6,
							map : map
						});
						resultInfoArr.push(polyline_);
						
					}else{
						var markerImg = "";
						var size = "";			//아이콘 크기 설정합니다.
						
						if(properties.pointType == "S"){	//출발지 마커
							markerImg = "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_s.png";	
							size = new Tmapv2.Size(24, 38);
						}else if(properties.pointType == "E"){	//도착지 마커
							markerImg = "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_e.png";
							size = new Tmapv2.Size(24, 38);
						}else{	//각 포인트 마커
							markerImg = "http://topopen.tmap.co.kr/imgs/point.png";
							size = new Tmapv2.Size(8, 8);
						}
						
						// 경로들의 결과값들을 포인트 객체로 변환 
						var latlon = new Tmapv2.Point(geometry.coordinates[0], geometry.coordinates[1]);
						// 포인트 객체를 받아 좌표값으로 다시 변환
						var convertPoint = new Tmapv2.Projection.convertEPSG3857ToWGS84GEO(latlon);
						
						marker_p = new Tmapv2.Marker({
							position: new Tmapv2.LatLng(convertPoint._lat, convertPoint._lng),
							icon : markerImg,
							iconSize : size,
							map:map
						});
						
						resultMarkerArr.push(marker_p);
					}
				}
			},
			error:function(request,status,error){
				//console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				var msg = "경로를 불러오는데 실패하였습니다. 다시 시도해 주세요.";
				swal("경로검색실패", msg, "error", {button: "확인",}).then(function(result) {
					location.href = g5_url + "/index.php" + window.location.search;
				});
			}
		});

	// 4.2 경유지가 없는 경우
	} else {
		var trafficInfochk = "N";	// 실시간 교통정보 표시
		var param = {
			"appKey" : apiKey,
			"startX" : String(start_lng),
			"startY" : String(start_lat),
			"endX" : String(end_lng),
			"endY" : String(end_lat),
			"reqCoordType" : "WGS84GEO",
			"resCoordType" : "EPSG3857",
			"searchOption" : searchOption,
			"trafficInfo" : trafficInfochk
		}

		$.ajax({
			type : "POST",
			url : "https://apis.openapi.sk.com/tmap/routes?version=1&format=json&callback=result",
			async : false,
			data : param,
			success : function(response) {
				var resultData = response.features;
				var tDistance = (resultData[0].properties.totalDistance / 1000).toFixed(1);	// 총거리(km)
				var tTime = (resultData[0].properties.totalTime / 60).toFixed(0);	// 총시간(분)
				//var tFare = resultData[0].properties.totalFare;	// 총요금(원)
				//var taxiFare = " 예상 택시 요금 : " + resultData[0].properties.taxiFare + "원";
			
				resultCalc(tDistance, tTime);

				// 기존 라인 초기화
				resettingMap();

				for ( var i in resultData) { //for문 [S]
					var geometry = resultData[i].geometry;
					var properties = resultData[i].properties;

					if (geometry.type == "LineString") {
						for ( var j in geometry.coordinates) {
							// 경로들의 결과값들을 포인트 객체로 변환 
							var latlng = new Tmapv2.Point(geometry.coordinates[j][0], geometry.coordinates[j][1]);
							// 포인트 객체를 받아 좌표값으로 변환
							var convertPoint = new Tmapv2.Projection.convertEPSG3857ToWGS84GEO(latlng);
							// 포인트객체의 정보로 좌표값 변환 객체로 저장
							var convertChange = new Tmapv2.LatLng(convertPoint._lat, convertPoint._lng);
							// 배열에 담기
							drawInfoArr.push(convertChange);
						}

						var polyline_ = new Tmapv2.Polyline({
							path : drawInfoArr,
							strokeColor : "#DD0000",
							strokeWeight : 6,
							map : map
						});
						resultInfoArr.push(polyline_);

					} else {
						var markerImg = "";
						var pType = "";

						if (properties.pointType == "S") { //출발지 마커
							markerImg = "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_s.png";
							pType = "S";
						} else if (properties.pointType == "E") { //도착지 마커
							markerImg = "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_e.png";
							pType = "E";
						} else { //각 포인트 마커
							markerImg = "http://topopen.tmap.co.kr/imgs/point.png";
							pType = "P"
						}

						// 경로들의 결과값들을 포인트 객체로 변환 
						var latlon = new Tmapv2.Point(geometry.coordinates[0], geometry.coordinates[1]);
						// 포인트 객체를 받아 좌표값으로 다시 변환
						var convertPoint = new Tmapv2.Projection.convertEPSG3857ToWGS84GEO(latlon);

						var routeInfoObj = {
							markerImage : markerImg,
							lng : convertPoint._lng,
							lat : convertPoint._lat,
							pointType : pType
						};

						// 마커 생성하기
						var size = new Tmapv2.Size(24, 38);//아이콘 크기 설정합니다.

						if (routeInfoObj.pointType == "P") { //포인트점일때는 아이콘 크기를 줄입니다.
							size = new Tmapv2.Size(8, 8);
						}

						marker_p = new Tmapv2.Marker({
							position : new Tmapv2.LatLng(routeInfoObj.lat, routeInfoObj.lng),
							icon : routeInfoObj.markerImage,
							iconSize : size,
							map : map
						});

						resultMarkerArr.push(marker_p);
					}
				}//for문 [E]
			},
			error : function(request, status, error) {
				//console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
				var msg = "경로를 불러오는데 실패하였습니다. 다시 시도해 주세요.";
				swal("경로검색실패", msg, "error", {button: "확인",}).then(function(result) {
					location.href = g5_url + "/index.php" + window.location.search;
				});
			}
		});

	} // end 4

}

//초기화 기능
function resettingMap() {
	//기존마커는 삭제
	marker_s.setMap(null);
	marker_e.setMap(null);

	if (resultMarkerArr.length > 0) {
		for (var i = 0; i < resultMarkerArr.length; i++) {
			resultMarkerArr[i].setMap(null);
		}
	}

	if (resultInfoArr.length > 0) {
		for (var i = 0; i < resultInfoArr.length; i++) {
			resultInfoArr[i].setMap(null);
		}
	}

	chktraffic = [];
	drawInfoArr = [];
	resultMarkerArr = [];
	resultInfoArr = [];
}

// km기본금액
var basic_fare = 0;

// 경로탐색 후 금액계산 및 화면노출
function resultCalc(distance, time) {
	var f = document.fcall;
	var distance = Math.round(distance);
	basic_fare = 0;

	// 1) 거리,시간 노출
	$("#distance").html(distance + "km");
	$("#time").html(time + "분");
	f.call_dist.value = distance;
	f.call_time.value = time;

	// 2) 기본요금 계산
	if (distance <= 3) {
		basic_fare = 10000;
	} else if (distance <= 5) {
		basic_fare = 12000;
	} else if (distance <= 10) {
		basic_fare = 15000;
	} else if (distance > 10 && distance <= 25) {
		basic_fare = ((distance-10)*1000) + 15000;
	} else if (distance > 25 && distance <= 200) {
		basic_fare = ((((distance-25)/2.5).toFixed(0))*1000) + 30000;
	} else {
		basic_fare = ((((distance-200)/4).toFixed(0))*1000) + 100000;
	}

	// 경유지 존재하면 추가금 (1만원)
	if (pass_place != "") {
		basic_fare += 10000;
		f.call_pass_price.value = 10000;
	}
	
	// 총금액 (환급콜시 경유지금액 포함해서 0.8계산하기 때문에)
	$("#price1").val(addComma(basic_fare));
	f.call_price.value = basic_fare;
}
//================================================================

// 탁송,대리요청하기
function serviceCall(f) {
	var total_price = parseInt(unComma(f.call_total_price.value));
	var my_point = parseInt("<?=$member['mb_point']?>");

	// 포인트결제시 포인트확인
	if ($("input[name=call_payment]:checked").val() == "P") {
		if (total_price > my_point) {
			getNoti(1, "포인트가 부족합니다.");
			return false;
		}
	}

	// 탁송/대리
	f.call_type.value = document.pressed;

	if (document.pressed == 1 && $("input[name=call_5t_price]").prop("checked")) {
		getNoti(1, "대리 요청하기 할 때는 2.5톤이상 요청을 하실 수 없습니다.");
		f.call_type.value = "";
		return false;
	}

	var obj = $(f).serializeObject();
	obj.mode = "insert";

	$.ajax({  
		type : "post",  
		url : g5_bbs_url + "/ajax.call_update",
		data : obj,
		dataType : "json",  
		async : false,
		success : function(data) {
			if (data.result == "T") {
				var _msg = (document.pressed == 1)? "대리" : "탁송";
				swal("요청완료", _msg + "요청이 완료되었습니다. ", "success", {button: "확인"}).then(function(result) {
					location.href = g5_url + "/index.php";
				});
			} else {
				getNoti(1, "요청하기에 실패하였습니다. 다시 시도해 주세요.1");
			}
		},  
		error : function(xhr,status,error) {
			getNoti(1, "요청하기에 실패하였습니다. 다시 시도해 주세요.2");
			return false;
		}
	});

	return false;
}

$(function() {
	// 뒤로가기시 인덱스화면
	$("#hd .back_btn").on("click", function(e) {
		$(this).attr("onclick", "");

		var url = g5_url + "?start_place=" + start_place + "&start_lat=" + start_lat + "&start_lng=" + start_lng;
		if (pass_place != "") url += "&pass_place=" + pass_place + "&pass_lat=" + pass_lat + "&pass_lng=" + pass_lng;

		location.href = url;
	});

	// 가장빠른콜, 환급콜(80%)
	$("input[name=call_kind]").on("change", function() {
		if ($(this).val() == "0") {
			$("#price1").val(addComma(basic_fare));
		} else {
			var _price = basic_fare * 0.8;
			$("#price1").val(addComma(_price));
		}
	});

	// 경유콜 체크, // 2.5톤이상 체크
	$("input[name=call_pass_call_price], input[name=call_5t_price]").on("click", function() {
		var _fare = basic_fare;

		if ($(this).prop("checked")) {
			_fare += parseInt($(this).val());
		} 
		$("#price1").val(addComma(_fare));
	});

	// 메모시 엔터버블링 막기
	$('input[name=call_memo]').keydown(function() {
		if (event.keyCode === 13) {
			event.preventDefault();
		};
	});
	
});
</script>

<!-- 지도영역 -->
<div id="map_div"></div>

<form name="fcall" action="" method="post" onsubmit="return serviceCall(this);">
<!-- 출발지, 도착지, 경유지 -->
<input type="hidden" name="start_place" value="<?=urldecode($start_place)?>">
<input type="hidden" name="start_lat" value="<?=$start_lat?>">
<input type="hidden" name="start_lng" value="<?=$start_lng?>">
<input type="hidden" name="end_place" value="<?=urldecode($end_place)?>">
<input type="hidden" name="end_lat" value="<?=$end_lat?>">
<input type="hidden" name="end_lng" value="<?=$end_lng?>">
<input type="hidden" name="pass_place" value="<?=urldecode($pass_place)?>">
<input type="hidden" name="pass_lat" value="<?=$pass_lat?>">
<input type="hidden" name="pass_lng" value="<?=$pass_lng?>">
<!-- 거리, 시간, 기본요금, 경유지추가금 -->
<input type="hidden" name="call_dist" value="">
<input type="hidden" name="call_time" value="">
<input type="hidden" name="call_price" value="0">
<input type="hidden" name="call_pass_price" value="0">
<!-- 탁송/대리 -->
<input type="hidden" name="call_type" value="">

<div class="collapse in" id="ft_req">
  <div class="well">
	<ul>
	<li class="text-center">
		T대리 어플리케이션 (수수료 20%지원)
	</li>
	<li class="nebi">
		<div class="route col-xs-9">
			<div class="loc"><span>출발지</span><div class="add1" id="start-place"><?=urldecode($start_place)?></div></div>
			<? if ($pass_place != "") { ?><div class="loc"><span>경유지</span><div class="add1" id="pass-place"><?=urldecode($pass_place)?></div></div><? } ?>
			<div class="loc"><span>도착지</span><div class="add1" id="end-place"><?=urldecode($end_place)?></div></div>
		</div>
		<div class="info col-xs-3 text-right">
			<span id="distance"><!--거리--></span>
			<p id="time"><!--시간--></p>
		</div>
	</li>
	<li class="price consign">
		<div class="col-xs-6">
			<label><input name="call_kind" type="radio" value="0" checked required>가장빠른콜</label>&nbsp;&nbsp;
			<label><input name="call_kind" type="radio" value="1">환급콜</label>
		</div>
		<div class="col-xs-6 text-right">
			<label><input type="checkbox" name="call_pass_call_price" value="10000">경유콜</label>&nbsp;&nbsp;
			<label><input type="checkbox" name="call_5t_price" value="25000">2.5톤이상</label>            
		</div>
	</li>
	<li class="price consign">
		<div class="col-xs-12">
			<label><input name="call_payment" type="radio" value="C" checked required>현금</label>&nbsp;&nbsp;
			<label><input name="call_payment" type="radio" value="P">포인트</label>
		</div>
	</li>
	<li class="total">
		<div class="col-xs-12 text-right">
			<dl>
				<dt>총금액</dt>
				<dd><input type="text" name="call_total_price" id="price1" value="0" class="frm_input" readonly>원</dd>
			</dl>
		</div>
	</li>
	<li class="memo">
		<input type="text" placeholder="기타메모" name="call_memo" value="">
	</li>
	</ul>
	<div class="btn_half">
		<button class="btn" type="submit" onclick="document.pressed=0">탁송 요청하기</button>
		<button class="btn" type="submit" onclick="document.pressed=1">대리 요청하기</button>
	</div>
  </div>
</div>
</form>



<?php
include_once('./_tail.sub.php');
?>