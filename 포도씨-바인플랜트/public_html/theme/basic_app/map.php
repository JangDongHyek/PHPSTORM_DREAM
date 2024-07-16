<?php
$sub_id = "competition_map";
include_once('./_common.php');

$is_mypage = "competition_map";
$g5['title'] = '지점안내';
include_once('./_head.php');


	$city = "";
	if($si)
		$city .= "".$si;
	if($gu)
		$city .= " ".$gu;
	if($dong)
		$city .= " ".$dong;
	
	$sql_search .= " and wr_1 like '".$city."%'";


$si_arr = array("서울","경기","인천","부산","대구","대전","울산","광주","충남","충북","경남","경북","전남","전북","강원","제주");

?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=4d32fa97bb676df7f136e32d304145fc&libraries=services,clusterer,drawing"></script>

<style>

/* 지도 */
.root_daum_roughmap{padding:0 !important;}
.root_daum_roughmap .wrap_map{ height:100% !important;}

#hd_sch { text-align:left; position:fixed; width:100%; left:0; top:50px; z-index:998; padding:30px 10px;}
#hd_sch h2 {position:absolute;font-size:0;text-indent:-9999em;line-height:0;overflow:hidden}
#hd_sch form {position:relative; width:100%; height:50px; display:inline-block; margin:0; padding:10px 10px 10px 15px; background:#fff; border:2px solid #e62e8b;}
#hd_sch select.sch_sel{ border:0; background:none; font-size:1.1em; height:30px; line-height:30px;}
#hd_sch select.sch_s1{ width:calc(30% - 5px); margin-right:5px;}
#hd_sch select.sch_s2{ width:25%;}

#hd_sch select.sch_sel{
/* 네이티브 외형 감추기 */
 -webkit-appearance:none; 
-moz-appearance :none; 
appearance :none;
/* 화살표이미지 넣어주기 */
background:url(/img/select_arrow.gif) no-repeat 95% center;}
/* IE 10, 11의 네이티브 화살표 숨기기 */
#hd_sch select.sch_sel::-ms-expand{ display:none;}


/*#hd_sch input#sch_stx {width:calc(100% - 30px);height:30px;border:0; background:none !important; font-size:1.05em; line-height:2.5em;vertical-align:middle;color:#9494a5}
#hd_sch input#sch_stx::-webkit-input-placeholder { color:#9494a5; opacity:0.7; letter-spacing:-1px; }
#hd_sch input#sch_stx::-moz-placeholder { color:#9494a5; opacity:0.7; letter-spacing:-1px; }
#hd_sch input#sch_stx::-ms-input-placeholder { color:#9494a5; opacity:0.7; letter-spacing:-1px;} */

#hd_sch #sch_submit { float:right; margin:0;width:26px;height:26px;border:0;background:url(./hd_sch_btn.png) no-repeat 50%/auto 100%;vertical-align:middle;
					 color:#fff;text-indent:-9999px;}
					 
#hd_sch .filter{ float:right; background:#fff; border:3px solid #2a2a4c; width:52px; height:50px; line-height:45px; text-align:center; margin-left:4px; font-size:1.2em; color:#212529;}

#hd_sch form,
#hd_sch .filter{box-shadow:0 2px 3px rgba(0,0,0,0.3); border-radius:10px;}

.pop_cup{ position:fixed; width:calc(100% - 20px); height:100px; left:10px; right:10px; bottom:70px; z-index:1999; padding:15px 15px; background:#fff; color:#222; box-shadow:0 0 3px rgba(0,0,0,0.3);
display:none;}
.pop_cup h2{ font-size:1.25em; margin-bottom:10px; font-weight:normal;}
.pop_cup h2 i{margin-right:3px;}
.pop_cup dl{margin-bottom:3px;}
.pop_cup dl:after{content:""; display:block; clear:both;}
.pop_cup .ptitle{ font-size:1.5em; color:#222; margin-bottom:5px;}
.pop_cup dt{ float:left; margin-right:8px; opacity:0.6; font-weight:normal; color:#666;}
.pop_cup dd{ float:left; color:#666;}
.pop_cup dd.ptel{ color:#e62e8b;}
.pop_cup .btn_line{ width:50px; height:100px; border-left:1px dotted #ddd; position:absolute; top:0px; right:0px; background:#e62e8b;}
.pop_cup a.btn{ color:#fff; text-align:center; display:block; font-size:1.3em; line-height:100px; padding:0;}

.pop_cup.two{z-index:1;}
.pop_cup.two a{display:block; text-align:center; color:#fff; font-size:1.1em;}
.pop_cup.two a strong{text-decoration:underline; color:#FFE080; font-size:1.1em;}




#container{position:relative; width:100%; height:100%; left:0; top:-15px;}
#container_title{display:none;}
/*@media (min-width:768px){
#hd{position:fixed; left:0; top:0; width:100%; z-index:999;}
#container{position:relative; top:-15px; height:calc(100% - 55px); padding:0;}
#svisual{ height:70px;}
.pop_cup{position:fixed;}
}*/
</style>


<script>	
			var X_arr = new Array(); var Y_arr = new Array(); var type = new Array(); var teem = new Array();
			var date1 = new Array(); var date2 = new Array(); var wrid = new Array(); var title = new Array(); 
</script>





<?
$sql= "select * from g5_write_fran";

$result = sql_query($sql);
$cnt_result = sql_num_rows($result);
for ($i=0; $row=sql_fetch_array($result); $i++){
?>
<script>
X_arr.push('<?=$row[wr_9]?>'); Y_arr.push('<?=$row[wr_10]?>'); date1.push('<?=$row[wr_2]?>'); date2.push('');  type.push('<?=$row[wr_1]?>'); teem.push('<?=str_replace("|",",",$row[wr_2])?>'); wrid.push('<?=$row[wr_id]?>'); title.push('<?=$row[wr_subject]?>');

</script>

<?}?>
<!-- * 카카오맵 - 지도퍼가기 -->
<!-- 1. 지도 노드 -->
<div id="map" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%; height:100%; position:fixed"></div>

<!--
	2. 설치 스크립트
	* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
-->
<!-- <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script> -->

<!-- 3. 실행 스크립트 -->


			<div id="hd_sch">
            <h2>사이트 내 전체검색</h2>
            <form name="fsearchbox" action="./map.php" method="post">          
					<select name="si" id="si" class="sch_sel sch_s1">
						<option value="">시/도(전체)</option>
						<?php for($i=0; $i<count($si_arr); $i++){ ?>
						<option value="<?php echo $si_arr[$i]?>" <?php if($si==$si_arr[$i]) echo "selected";?>><?php echo $si_arr[$i]?></option>
						<?php } ?>
					</select>
					<select name="gu" id="gu" class="sch_sel sch_s1">
						<option value="" >구/군(전체)</option>
					</select>
					<select name="dong" id="dong" class="sch_sel sch_s2">
						<option value="" >동</option>
					</select>
			<input type="submit" value="검색" id="sch_submit">
			</form>
            <script>			

			var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
				mapOption = { 
					center: new kakao.maps.LatLng(35.174176, 129.129262), // 지도의 중심좌표
					level: 6 // 지도의 확대 레벨
				};

				var map = new kakao.maps.Map(mapContainer, mapOption);	
				var geocoder = new kakao.maps.services.Geocoder();
				var points = new Array();

			<?
			if($city){
			?>
						// 주소로 좌표를 검색합니다
						geocoder.addressSearch('<?=$city?>', function(result, status) {
							// 정상적으로 검색이 완료됐으면 
							 if (status === kakao.maps.services.Status.OK) {
								var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
								// 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
								map.setCenter(coords);
							} 
						});    

						for(var i=0; i<X_arr.length; i++){
								var coords = new kakao.maps.LatLng(X_arr[i], Y_arr[i]);
								points.push(coords);
								// 결과값으로 받은 위치를 마커로 표시합니다
								var marker = new kakao.maps.Marker({
									map: map,
									position: coords						
								});
									
								var latlng = marker.getPosition();
						//마커 클릭이벤트
								kakao.maps.event.addListener(marker, 'click',get_Latlng(latlng,type[i],teem[i],date1[i],date2[i],wrid[i],title[i]));				

						}

		<?}else{?>

						for(var i=0; i<X_arr.length; i++){
								var coords = new kakao.maps.LatLng(X_arr[i], Y_arr[i]);
								points.push(coords);
								// 결과값으로 받은 위치를 마커로 표시합니다
								var marker = new kakao.maps.Marker({
									map: map,
									position: coords						
								});
									
								var latlng = marker.getPosition();
						//마커 클릭이벤트
								kakao.maps.event.addListener(marker, 'click',get_Latlng(latlng,type[i],teem[i],date1[i],date2[i],wrid[i],title[i]));				

						}
		<?}?>





			kakao.maps.event.addListener(map, 'click', function(mouseEvent) {        
				$("#pop_cuup").hide();	
				$("#pop_cup").hide();
			});

			map.setCenter(points[0]);
/*
			window.onclick = function(event) {
				$("#pop_cup").hide();
		    }*/


			$(function() {  
					$("#pop_cuup").hide();
					$("#pop_cup").hide();

			if (navigator.geolocation) {
    
					// GeoLocation을 이용해서 접속 위치를 얻어옵니다
					navigator.geolocation.getCurrentPosition(function(position) {
						
						var lat = position.coords.latitude, // 위도
							lon = position.coords.longitude; // 경도
							lat = lat.toFixed(6);
							lon = lon.toFixed(6);
							console.log(lat+","+lon);
						var imageSrc = '<?=G5_THEME_URL?>/img/marker.png', // 마커이미지의 주소입니다    
						imageSize = new kakao.maps.Size(55, 55), // 마커이미지의 크기입니다
						imageOption = {offset: new kakao.maps.Point(23,30)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
						  
					// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
					var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
						markerPosition = new kakao.maps.LatLng(lat, lon); // 마커가 표시될 위치입니다

					// 마커를 생성합니다
					var marker = new kakao.maps.Marker({
						position: markerPosition, 
						image: markerImage // 마커이미지 설정 
					});

					// 마커가 지도 위에 표시되도록 설정합니다
					marker.setMap(map);  
					map.panTo(markerPosition);

					  });
					
				} else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다					
					
				}

				// 지도에 마커와 인포윈도우를 표시하는 함수입니다


			});

			

			function get_Latlng(latlng,type,teem,date1,date2,wrid,title){
				var temp_x = latlng.Ga;
				var temp_y = latlng.Ha;
				var poptype = 0;
						return function() {
								$.ajax({
										method : 'POST',
										url : '../ajax.count_latlng.php',
										data : {
											'x' : temp_y,
											'y' : temp_x
										},
										success : function(data) {
													if(data==1){
														poptype=1;
													}
													else{
														poptype=data;
													}	
													show_pop(type,teem,date1,date2,wrid,title,poptype);
											}
									});
							};
			}			

			function show_pop(type,teem,date1,date2,wrid,title,poptype){	
				
				$("#pop_title").html(title);
				$("#pop_type").html(type);
				$("#pop_date").html(date1);
				$("#pop_teem").html(teem);
				$("#pop_href").attr('href',"<?=G5_BBS_URL?>/store_detail.php?wr_id="+wrid);
				$("#pop_cuup").show();
				
			}		

            function fsearchbox_submit(f)
            {
                /*if (f.stx.value.length < 2) {
                    alert("검색어는 두 글자 이상 입력하십시오.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                var cnt = 0;
                for (var i=0; i<f.stx.value.length; i++) {
                    if (f.stx.value.charAt(i) == ' ')
                        cnt++;
                }

                if (cnt > 1) {
                    alert("빠른 검색을위한 쿼리 공백은 하나만 입력 할 수 있습니다.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                return true;*/
				return true;
            }
            </script>
            
        </div>
        

        <div id="pop_cuup" class="pop_cup">
             <!--<dl>
            	<dt>상호</dt>
                <dd id="pop_title"></dd>
            </dl>-->
            <div id="pop_title" class="ptitle"></div>
           <dl>
            	<dt><i class="fal fa-clock"></i> 진료시간</dt>
                <dd id="pop_date"></dd>
            </dl>
            <dl>
            	<dt><i class="fal fa-phone"></i> 연락처</dt>
                <dd id="pop_type" class="ptel"></dd>
            </dl>
            <div class="btn_line">
           	 <a class="btn" id="pop_href" href="<?php echo G5_BBS_URL ?>/store_detail.php"><i class="fal fa-chevron-right"></i></a>
        	</div>
        </div>


        

<form method="post" >
<div class="modal fade" id="filter_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">조건검색</h4>
      </div>
      <div class="modal-body">
      	<div class="sch_box">
        	<dl>
            	<dt>상호</dt>
            	<dd>
            	<input type="checkbox" name="sca[]" value="풋살" id="event1"><label for="event1">풋살</label>
            	<input type="checkbox" name="sca[]" value="족구" id="event2"><label for="event2">족구</label>
            	<input type="checkbox" name="sca[]" value="농구" id="event3"><label for="event3">농구</label>
                </dd>
            </dl>
            <dl>
            	<dt>연락처</dt>
            	<dd>
            	<input type="checkbox" name="sdateflg[]" value="1" id="state1"><label for="state1">진행</label>
            	<input type="checkbox" name="sdateflg[]" value="2" id="state2"><label for="state2">예정</label>
            	<input type="checkbox" name="sdateflg[]" value="3" id="state3"><label for="state3">완료</label>
            	</dd>
            </dl>
            <dl>
                <dt>진료시간</dt>
                <dd><input type="text" name="slocat" id="slocat" placeholder="지역분류"></dd>
            </dl> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="clear_sinputs()" class="btn btn-default" data-dismiss="modal">초기화</button>
        <button type="submit" class="btn btn-primary">검색</button>
      </div>
    </div>
  </div>
</div>
</form>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>

function move_map(lat,lng){
	//window.Android.call(lat);

//	var moveLatLon = new kakao.maps.LatLng(lat,lng);
	//map.panTo(moveLatLon);

	

	var imageSrc = '<?=G5_THEME_URL?>/img/marker.png', // 마커이미지의 주소입니다    
		imageSize = new kakao.maps.Size(55, 55), // 마커이미지의 크기입니다
		imageOption = {offset: new kakao.maps.Point(23,30)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
		  
			// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
	var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
		markerPosition = new kakao.maps.LatLng(lat, lng); // 마커가 표시될 위치입니다

	// 마커를 생성합니다
	var marker = new kakao.maps.Marker({
		position: markerPosition, 
		image: markerImage // 마커이미지 설정 
	});

	// 마커가 지도 위에 표시되도록 설정합니다
	marker.setMap(map);  
	map.panTo(markerPosition);
	//window.Android.call(lat,lng);
}

function move_crr(){
		
		if (navigator.geolocation) {
    
					// GeoLocation을 이용해서 접속 위치를 얻어옵니다
					navigator.geolocation.getCurrentPosition(function(position) {
						
						var lat = position.coords.latitude, // 위도
							lon = position.coords.longitude; // 경도
							lat = lat.toFixed(6);
							lon = lon.toFixed(6);
							console.log(lat+","+lon);
						var imageSrc = '<?=G5_THEME_URL?>/img/marker.png', // 마커이미지의 주소입니다    
						imageSize = new kakao.maps.Size(55, 55), // 마커이미지의 크기입니다
						imageOption = {offset: new kakao.maps.Point(23,30)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
						  
					// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
					var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
						markerPosition = new kakao.maps.LatLng(lat, lon); // 마커가 표시될 위치입니다

					// 마커를 생성합니다
					var marker = new kakao.maps.Marker({
						position: markerPosition, 
						image: markerImage // 마커이미지 설정 
					});

					// 마커가 지도 위에 표시되도록 설정합니다
					marker.setMap(map);  
					map.panTo(markerPosition);

					  });
					
				} else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다					
					
				}
}

function clear_sinputs(){

	$("#sdate1").val('');
	$("#sdate2").val('');
	$("#slocat").val('');
	$("input:checkbox[name='sdateflg[]']:checked").each(function(){
			$(this).prop("checked",false);
	});
	$("input:checkbox[name='sca[]']:checked").each(function(){
			$(this).prop("checked",false);
	});
}

$(".datepick").datepicker({
						dateFormat: 'yy-mm-dd'
						,showMonthAfterYear:true
						,monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'] //달력의 월 부분 텍스트
						,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 Tooltip 텍스트
						,dayNamesMin: ['일','월','화','수','목','금','토'] //달력의 요일 부분 텍스트
						,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일']	
	});

</script>



<script>
function getCity(si, gu){
	if(!si && !gu){
		return false;
	}

	var opt;
	var opt_select;

	$.ajax({
		type:"GET",
		url:"<?php echo G5_PLUGIN_URL?>/address/address.php",
		dataType: "json",
		data: {
			"si": si,
			"gu": gu
		},
		success:function(datas){
			for(var i=0; i<datas.length; i++){
				if("<?php echo $si?>" == datas[i] || "<?php echo $gu?>" == datas[i] || "<?php echo $dong?>" == datas[i])
					opt_select = "selected";
				else 
					opt_select = "";

				opt = "<option value='"+datas[i]+"' "+opt_select+">"+datas[i]+"</option>";
				if(!gu){
					$("#gu").append(opt);
				}else{
					$("#dong").append(opt);
				}
			}
		},
		error:function(request,status,error){
			alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

$(document).ready(function (){
	getCity("<?php echo $si?>");
	getCity("<?php echo $si?>", "<?php echo $gu?>");
});

$("#si").change(function (){
	$("#gu").find("option").remove();
	$("#gu").append("<option value=''>구/군(전체)</option>");
	$("#dong").find("option").remove();
	$("#dong").append("<option value=''>동</option>");

	getCity($(this).val(), "")
});

$("#gu").change(function (){
	var si = $("#si").val();
	$("#dong").find("option").remove();
	$("#dong").append("<option value=''>동</option>");

	getCity(si, $(this).val())
});

</script>

<?php
include_once('./_tail.php');
?>