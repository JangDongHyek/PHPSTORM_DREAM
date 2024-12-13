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

// 좌표로 상세주소
$path = '/v2/local/geo/coord2address';
$content_type = 'json'; // json or xml
// 1) 출발지 주소
$params1 = http_build_query(array('x' =>$start_lng, 'y'=>$start_lat));
$decode1 = kakaoRestApi($path, $params1, $content_type);
// 2) 경유지 주소
if ($pass_place != "") {
    $params2 = http_build_query(array('x' =>$pass_lng, 'y'=>$pass_lat));
    $decode2 = kakaoRestApi($path, $params2, $content_type);
}
// 3) 도착지 주소
$params3 = http_build_query(array('x' =>$end_lng, 'y'=>$end_lat));
$decode3 = kakaoRestApi($path, $params3, $content_type);
// 상세주소
$startAddress = $decode1['documents'][0]['address']['address_name'];
$passAddress = $decode2['documents'][0]['address']['address_name'];
$endAddress = $decode3['documents'][0]['address']['address_name'];

// 주소검색 실패 - 뒤로가기
if (empty($startAddress)) {
    alert("출발지 정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.", G5_URL."/index.php");
}
if (empty($endAddress)) {
    alert("도착지 정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.", G5_URL."/index.php");
}

/********************************************************************
// 요금 계산식 정리
1. 기본(빠른콜) : km계산 (소숫점 반올림)
	- 3km이하 : 10,000원
	- 5km이하 : 12,000원
	- 10km이하 : 15,000원
	- 10km초과 ~ 25km이하 : ((총km-10)*1,000원) + 15,000원
	- 25km초과 ~ 200km이하 : (((총km-25)*2.5) * 1,000원) + 30,000원
	- 그외 : (((총km-200)/4)*1,000원) + 100,000원
2. 빠른콜→환급콜 변경시 : 기본km계산의 80%
3. 경로에 경유지 존재 : +10,000원
4. 경유콜 체크 : +10,000원
5. 2.5톤이상 체크 : +25,000원

200910.추가
- 고객이 총금액을 변경할수 있음

211213. 요금계산식 변경됨
 * 3km이하 : 12,000원
 * 10km이하 : 15,000원
 * 10km초과 ~ 25km이하 : {(총km-10km) * 1,000원} + 15,000원
 * 25km초과 ~ 200km이하 : [{(총km-10km) / 2.5km} * 1,000원] +15,000원
 * 200km초과 : [{(총km-10km) / 3km} * 1,000원] + 15,000원
 *
 *
220519. 요금계산식 총 정리
(1) 3km이하 : 12,000원
(2) 10km이하 : 15,000원
(3) [ 10km부터 +15,000원 추가 ]
(4) 10km초과 ~ 25km이하까지, 10km 초과분부터 1km당 1,000원
    : {(총km-10km) * 1,000원} + 15,000원
(5) 25km초과 ~ 200km이하까지, 25km 초과분부터 2.5km당 1,000원
    총 45km로 가정했을 때
    1. 10km까지
    = 15,000원
    2. 10km~25km까지
    = (25km-10km) / 1km당 1,000원
    = 15km / 1km * 1,000원
    = 15,000원
    3. 25km 초과분
    = (45km-25km) / 2.5km당 1,000원
    = 20km / 2.5km * 1,000원
    = 8,000원
    총 더하여 15,000 + 15,000 + 8,000 = 38,000원 계산되어야 함
(6) 200km초과, 초과분부터 3km당 1,000원
    총 270km로 가정했을 때
    1. 10km까지
    = 15,000원
    2. 10km~25km까지
    = (25km-10km) / 1km당 1,000원
    = 15km / 1km * 1,000원
    = 15,000원
    3. 25km~200km까지
    = (200km-25km) / 2.5km당 1,000원
    = 175km / 2.5km * 1,000원
    = 70,000원
    4. 200km 초과분
    = 70km / 3km당 1,000원
    = 70km / 3km * 1,000원
    = 23,000원
    총 더하여 15,000 + 15,000 + 70,000 + 23,000 = 123,000원 계산되어야 함
********************************************************************/
?>
<link rel="stylesheet" type="text/css" href="<?=G5_URL?>/css/wickedpicker.min.css">
<script src="<?=G5_URL?>/js/wickedpicker.min.js"></script>
<script src="<?=G5_JS_URL?>/jquery.serializeObject.js"></script>
<script src="https://apis.openapi.sk.com/tmap/jsv2?version=1&appKey=<?=$config['cf_tmap_api']?>"></script><!-- tmap -->
<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- 이노페이 -->
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
var drawInfoArr = [];

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
	/*if (distance <= 3) {
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
	}*/
    // 기본요금계산식 변경 (211213)
    /*if (distance <= 3) {
        basic_fare = 12000;
    } else if (distance <= 10) {
        basic_fare = 15000;
    } else if (distance > 10 && distance <= 25) {
        basic_fare = ((distance-10)*1000) + 15000;
    } else if (distance > 25 && distance <= 200) {
        //basic_fare = Math.floor(((distance-10)/2.5) * 1000);
        basic_fare = (((distance-10)/2.5) * 1000).toFixed(0);
        basic_fare = parseInt(basic_fare) + 15000;
    } else {
        //basic_fare = Math.floor(((distance-10)/3) * 1000);
        basic_fare = (((distance-10)/3) * 1000).toFixed(0);
        basic_fare = parseInt(basic_fare) + 15000;
    }*/
    // 기본요금계산식 변경 (220519)
    if (distance <= 3) {
        basic_fare = 12000;
    } else if (distance <= 10) {
        basic_fare = 15000;
    } else if (distance > 10 && distance <= 25) {
        basic_fare = ((distance-10)*1000) + 15000;
    } else if (distance > 25 && distance <= 200) {
        // 1. 10km까지 = 15,000원 고정
        // 2. 10km~25km까지 = (25km-10km) / 1km당 1,000원 = 15,000원 고정
        // = 30,000원
        basic_fare = 30000;
        // 3. 25km 초과분 = (총km - 25km) / 2.5km당 1,000원
        basic_fare += parseInt((((distance-25)/2.5) * 1000).toFixed(0));
    } else {
        // 1. 10km까지 = 15,000원 고정
        // 2. 10km~25km까지 = (25km-10km) / 1km당 1,000원 = 15,000원 고정
        // = 30,000원
        basic_fare = 30000;
        // 3. 25km~200km까지 = (200km-25km) / 2.5km당 1,000원 = 70,000원 고정
        basic_fare += 70000;
        // 4. 200km 초과분 = (총km-200km) / 3km당 1,000원 = 계산
        let calc_km = parseInt(((distance-200) / 3).toFixed(0));
        basic_fare += calc_km * 1000;
    }

	// 경유지 존재하면 추가금 (1만원)
	if (pass_place != "") {
		basic_fare += 10000;
		f.call_pass_price.value = 10000;
	}
	
	// 총금액 (환급콜시 경유지금액 포함해서 0.8계산하기 때문에)
	setTotalPrice();

	//f.call_price.value = basic_fare;
	f.call_price_origin.value = basic_fare; // 거리별 기본요금 (고객이 요금변경 가능하도록 변경되어 추가된 값)
}
//================================================================

$(function() {
	// 뒤로가기시 인덱스화면
	$("#hd .back_btn").on("click", function(e) {
		$(this).attr("onclick", "");

		var url = g5_url + "?start_place=" + start_place + "&start_lat=" + start_lat + "&start_lng=" + start_lng;
		if (pass_place != "") url += "&pass_place=" + pass_place + "&pass_lat=" + pass_lat + "&pass_lng=" + pass_lng;

		location.href = url;
	});

	// 빠른콜, 환급콜(80%), 적립콜
	$("input[name=call_kind]").on("change", function() {
        setTotalPrice();
	});

	// 경유콜, 2.5톤이상 체크
	$("input[name=call_pass_call_price], input[name=call_5t_price]").on("click", function() {
        setTotalPrice();
    });

	// 메모시 엔터버블링 막기
	$('input[name=call_memo]').keydown(function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
		};
	});

    // 날짜/시간
    $("input[name=call_req_time]").wickedpicker({
        //now: "12:35", //hh:mm 24 hour format only, defaults to current time
        twentyFour: true, //Display 24 hour format, defaults to false
        upArrow: 'wickedpicker__controls__control-up', //The up arrow class selector to use, for custom CSS
        downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
        close: 'wickedpicker__close', //The close class selector to use, for custom CSS
        hoverState: 'hover-state', //The hover state class to use, for custom CSS
        title: '시간 선택', //The Wickedpicker's title,
        showSeconds: false, //Whether or not to show seconds,
        secondsInterval: 1, //Change interval for seconds, defaults to 1 ,
        minutesInterval: 1, //Change interval for minutes, defaults to 1
        beforeShow: null, //A function to be called before the Wickedpicker is shown
        show: null, //A function to be called when the Wickedpicker is shown
        clearable: false, //Make the picker's input clearable (has clickable "x")

    }).on("change", function() {
        let time = $(this).val();
        let now_chk_el = document.querySelector("input[name=call_req_time_now]");
        if (now_chk_el.value == "") now_chk_el.value = time;

        if (now_chk_el.value == time) console.log('즉시');
        else console.log('즉시X');
    });

	// 현금/포인트
    $("input[name=call_payment]").on("change", function() {
        call_alert_chk = false;
    });
});

// 총금액 계산후 노출
function setTotalPrice(modify_amt) {
	var f = document.fcall;
    var kind = f.querySelector('input[name="call_kind"]:checked').value; //콜종류
	var amt = 0;

    // console.log("modify_amt", typeof modify_amt);

    if (typeof modify_amt == "number") { // 1)총금액수정
        amt =  modify_amt;

    } else { // 2)자동계산
        if (kind == "1") amt = (basic_fare * 0.8) + 1000;   // 1.환급콜 (기본료 80% + 수수료1000원)
        else amt = basic_fare;                              // 0.빠른콜, 2.적립콜
        amt = parseInt(amt);

        // 경유콜 체크확인
        var option1 = (f.querySelector('input[name="call_pass_call_price"]').checked)?
            parseInt(f.querySelector('input[name="call_pass_call_price"]:checked').value) : 0;
        // 2.5톤 체크확인
        var option2 = (f.querySelector('input[name="call_5t_price"]').checked)?
            parseInt(f.querySelector('input[name="call_5t_price"]:checked').value) : 0;
        amt += option1 + option2;
    }

	f.call_total_price.value = addComma(amt);   // 총금액
	f.call_price.value = basic_fare;             // 기본요금(회원변경가능)
}

// 요금직접수정
function changeAmt(mode) {
    var min = 1000;
    var f = document.fcall;
    var amt = parseInt(unComma(f.call_total_price.value));
    basic_fare = parseInt(basic_fare);

    if (mode == 0) {
        basic_fare -= 1000;
        amt -= 1000;

        // 최소금액 계산
        // 경유콜, 2.5톤 체크확인
        var option1 = (f.querySelector('input[name="call_pass_call_price"]').checked)?
            parseInt(f.querySelector('input[name="call_pass_call_price"]:checked').value) : 0;
        var option2 = (f.querySelector('input[name="call_5t_price"]').checked)?
            parseInt(f.querySelector('input[name="call_5t_price"]:checked').value) : 0;
        var option_total = option1 + option2;

        if (amt <= option_total) {
            var err_msg = "";
            if (f.querySelector('input[name="call_pass_call_price"]').checked) err_msg += "경유콜(추가요금 10,000원)";
            if (f.querySelector('input[name="call_5t_price"]').checked) {
                err_msg += (err_msg == "")? "" : "\n";
                err_msg += "2.5톤(추가요금 25,000원)";
            }
            err_msg += "보다 적은 금액은 불가능합니다.";

            getNoti(2, err_msg);
            return false;
        }

        if (basic_fare < min) basic_fare = min;
    }
    else {
        basic_fare += 1000;
        amt += 1000;
    }

    setTotalPrice(amt);
}


// 탁송,대리요청하기
var call_alert_chk = false;
function serviceCall(f) {
    var total_price = parseInt(unComma(f.call_total_price.value));
    var my_point = parseInt("<?=$member['mb_point']?>");
    var chk_paytype = f.querySelector('input[name="call_payment"]:checked').value;
    var prfx = "";

    switch(document.pressed) {
        case 0 :
            prfx = "탁송";
            break;
        case 1 :
            prfx = "대리";
            break;
        case 2 :
            prfx = "퀵";
            break;

    }

    // 포인트결제시 포인트확인
    if (chk_paytype == "P") {
        if (total_price > my_point) {
            getNoti(1, "포인트가 부족합니다. 포인트충전 후 이용해 주세요.");
            return false;
        }
    }

    if (call_alert_chk == false) {
        swal({
            title : "요청하기",
            text: prfx + "요청을 하시겠습니까?",
            icon: 'info',
            buttons: ['닫기', '확인'],
            dangerMode: true,
        }).then(function(result) {
            if (result) {
                call_alert_chk = true;
                serviceCall(document.fcall);
            } else {
                call_alert_chk = false;
            }
        });
        return false;
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
        url : g5_bbs_url + "/ajax.call_update.php",
        data : obj,
        dataType : "json",
        async : false,
        success : function(data) {
            if (data.result == "T") {
                /*swal("요청완료", prfx + "요청이 완료되었습니다. ", "success", {button: "확인"}).then(function(result) {
                    history.replaceState({data: "replaceState"}, "", g5_url + "/index.php");
                    location.href = g5_bbs_url + "/call_list_new.php?m=my";
                });*/
                let alert_msg = prfx + "요청이 완료되었습니다.\n기사배정까지 잠시 기다려 주세요.\n(전화 1599-1009로 연락주셔야 접수됩니다.)";
                swal(alert_msg, {
                    buttons: {
                        cancel: "전화",
                        catch: {
                            text: "수정",
                            value: "catch",
                        },
                        defeat: {
                            text: "닫기",
                        },
                    },
                }).then((value) => {
                    history.replaceState({data: "replaceState"}, "", g5_url + "/index.php");
                    switch (value) {
                        case "defeat":  // 닫기
                            location.href = g5_bbs_url + "/call_list_new.php?m=my";
                            break;
                        case "catch":   // 수정
                            location.href = g5_bbs_url + "/call_view.php?idx=" + data.idx;
                            break;
                        default:        // 전화
                            location.href = g5_bbs_url + "/call_list_new.php?m=my&call=1";
                            break;
                    }
                });

                /*
                if (chk_paytype == "CD") {
                    // 카드결제 이노페이호출
                    var payf = document.payfrm;
                    payf.PayMethod.value = "CARD";
                    payf.Amt.value = total_price;

					payf.Moid.value = "CD<? echo time().getRandomString(4, 'int'); ?>";
					payf.mallUserID.value = "<?=$member['mb_hp']?>";
					payf.BuyerName.value = "<?=$member['mb_name']?>";
					payf.FORWARD.value = "N";
					payf.MallReserved.value = "";

					console.log('이노페이 호출');

					goPay(payf);

				} else {
					swal("요청완료", _msg + "요청이 완료되었습니다. ", "success", {button: "확인"}).then(function(result) {
						location.href = g5_bbs_url + "/call_list_new.php?m=my";
					});
				}
				*/
            } else {
                getNoti(1, "[01] 요청하기에 실패하였습니다. 다시 시도해 주세요.");
            }
        },
        error : function(xhr,status,error) {
            getNoti(1, "[02] 요청하기에 실패하였습니다. 다시 시도해 주세요.");
            return false;
        }
    });

    return false;
}


/*
// 이노페이 수정 (target)
function goPay(f) {
	setEdiDate();
	checkDevice(f);
	var dvcStr = f.device.value;
	var payValue = f.PayMethod.value;

	merchantKey=f.MerchantKey.value;
	f.ediDate.value = ediDate;
	if(checkData(f)){
		makeEncKey(f);
		f.action = payActionUrl + '/pay/interfaceURL.jsp';
		if(f.FORWARD.value == 'Y'){
			var left = (screen.Width - 680)/2;
			var top = (screen.Height - 680)/2;
			var winopts= "left="+left+",top="+top+",toolbar=no,location=no,directories=no, status=no,menubar=no,scrollbars=no, resizable=no,width=681,height=681";
			var InnopayWin =  window.open("", "payWindow", winopts);
			if(InnopayWin==null){
				alert("팝업차단 해제 후 다시 시도해 주시기 바랍니다");
				return false;
			}
			$(".popup_notice").css('display','block');
			$(".popup_notice .text").center();

			f.target = "payWindow";
			f.submit();
		}else{
			//f.target="_self";
			f.submit();
		}
		return false;
	}else{
		return false;
	}
}
*/
</script>

<!-- 지도영역 -->
<div id="map_div"></div>

<form name="fcall" action="" method="post" onsubmit="return serviceCall(this);" autocomplete="off">
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
<!-- 거리, 시간, 기본요금(회원변경가능), 경유지추가금, 기본요금(원본) -->
<input type="hidden" name="call_dist" value="">
<input type="hidden" name="call_time" value="">
<input type="hidden" name="call_price" value="0">
<input type="hidden" name="call_pass_price" value="0">
<input type="hidden" name="call_price_origin" value="0">
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
			<div class="loc"><span>출발지</span><div class="add1" id="start-place"><?=urldecode($start_place)?></div><div class="add2"><?=$startAddress?></div></div>
			<? if ($pass_place != "") { ?><div class="loc"><span>경유지</span><div class="add1" id="pass-place"><?=urldecode($pass_place)?></div><div class="add2"><?=$passAddress?></div></div><? } ?>
			<div class="loc"><span>도착지</span><div class="add1" id="end-place"><?=urldecode($end_place)?></div><div class="add2"><?=$endAddress?></div></div>
		</div>
		<div class="info col-xs-3 text-right">
			<span id="distance"><!--거리--></span>
			<p id="time"><!--시간--></p>
		</div>
	</li>

    <li class="memo">
        <input type="text" class="frm_input" placeholder="출발지 상세정보를 입력하세요" name="call_memo" value="">
    </li>

    <li class="memo">
        <input type="text" class="frm_input" placeholder="도착지 상세정보를 입력하세요" name="call_memo2" value="">
    </li>

	<li class="price consign">
		<div class="col-xs-12">
			<!--<label><input name="call_kind" type="radio" value="0" checked required>빠른콜</label>&nbsp;
            <label><input name="call_kind" type="radio" value="3">가장빠른콜</label>&nbsp;
			<label><input name="call_kind" type="radio" value="1">환급콜</label>&nbsp;
            <label><input name="call_kind" type="radio" value="2">적립콜</label>-->

            <div>
                <label><input name="call_kind" type="radio" value="2" checked required>적립콜</label>
            </div>
            <div>
                <label>
                    <input name="call_kind" type="radio" value="3">가장빠른콜
                    <span style="font-size: 0.9em;">(콜무: 고객 콜 기사수수료 20% 차감없음)</span>
                </label>
            </div>
		</div>
	</li>
        <li class="price consign">
            <div class="col-xs-12">
                <label><input type="checkbox" name="call_pass_call_price" value="10000">경유콜</label>&nbsp;&nbsp;
                <label><input type="checkbox" name="call_5t_price" value="25000">2.5톤이상</label>
            </div>
        </li>
	<li class="price consign">
		<div class="col-xs-12">
			<label><input name="call_payment" type="radio" value="C" checked required>현금</label>&nbsp;&nbsp;
			<label><input name="call_payment" type="radio" value="P">포인트</label>
			<!--<label><input name="call_payment" type="radio" value="CD">카드결제</label>-->
		</div>
	</li>
	<li class="total">
		<div class="col-xs-12 text-right">
			<dl style="margin:0;">
				<dt>총금액</dt>
				<dd>
					<button type="button" class="btn minus" onclick="changeAmt(0)">-</button><input type="text" name="call_total_price" id="price1" value="0" class="frm_input" readonly style="height:35px; line-height:35px; width:110px; font-size: 1.1em;">원<button type="button" class="btn plus" onclick="changeAmt(1)">+</button>
				</dd>
			</dl>
		</div>
	</li>
    <li class="time consign">
        <div class="col-xs-12 text-right">
            <dl style="margin:0;">
                <dt>날짜/시간</dt>
                <dd>
                    <label><input type="checkbox" name="call_req_today" value="1"> 내일</label>
                    <span class="time_picker">
                        <input type="text" class="frm_input" name="call_req_time" readonly style="height:35px; line-height: 35px;">
                        <input type="hidden" name="call_req_time_now">
                    </span>
                </dd>
            </dl>
        </div>
    </li>
	</ul>

      <br>
	<div class="btn_half">
		<button class="btn" type="submit" onclick="document.pressed=0" *style="width:100%" style="margin-bottom : 4px;">탁송 요청하기</button>
		<button class="btn" type="submit" onclick="document.pressed=1">대리 요청하기</button>
        <button class="btn" type="submit" onclick="document.pressed=2">퀵 요청하기</button>
	</div>
  </div>
</div>
</form>


<!-- 이노페이 -->
<form name="payfrm" id="frm" method="post">
	<input type="hidden" name="PayMethod" value="">
	<input type="hidden" name="GoodsCnt" value="1">
	<input type="hidden" name="GoodsName" value="">
	<input type="hidden" name="Amt" value="">
	<input type="hidden" name="Moid" value="">
	<input type="hidden" name="MID" value="<?=INNO_PG_MID?>">
	<input type="hidden" name="ReturnURL" value="<?=G5_URL?>/innopay/pay_result.php">
	<input type="hidden" name="RetryURL" value="<?=G5_URL?>/innopay/pay_result.php">
	<input type="hidden" name="ResultYN" value="N">
	<input type="hidden" name="mallUserID" value="">
	<input type="hidden" name="BuyerName" value="">
	<input type="hidden" name="BuyerTel" value="">
	<input type="hidden" name="BuyerEmail" value="">
	<input type="hidden" name="MallReserved" value=""><!-- 기타 임의데이터 {Form변수}={Form값}&... -->
	<input type="hidden" name="FORWARD" value="N" ><!-- 팝업 -->
	<input type="hidden" name="BrowserType" value="" >
	<!--hidden 데이타 필수-->
    <input type="hidden" name="ediDate" value="">
	<input type="hidden" name="MerchantKey" value="<?=INNO_PG_MerchantKey?>">
	<!-- 발급된 가맹점키 -->
	<input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
	<input type="hidden" name="MallIP" value="127.0.0.1"><!-- 가맹점서버 IP 가맹점에서 설정-->
	<input type="hidden" name="UserIP" value="127.0.0.1"><!-- 구매자 IP 가맹점에서 설정-->
	<input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
    <input type="hidden" name="device" value=""><!-- 자동셋팅 -->
</form>

<script>
    console.log("<?=$member['mb_id']?>");
</script>

<?php
include_once('./_tail.sub.php');
?>