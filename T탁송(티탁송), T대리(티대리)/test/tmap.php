<?php
include_once("../common.php");
include_once(G5_THEME_MOBILE_PATH.'/head.php');

// 관제 테스트
$start_lat = 37.56806851568106;
$start_lng = 126.9685264145542;

?>
<!-- 티맵지도 -->
<div id="map_div"></div>

<script src="https://apis.openapi.sk.com/tmap/jsv2?version=1&appKey=<?=$config['cf_tmap_api']?>"></script>
<script>
var width = $(window).width();
var height = $(window).height() - $("#hd").height();
var start_lat = parseFloat("<?=$start_lat?>");
var start_lng = parseFloat("<?=$start_lng?>");
var time=120000;
var map, marker;
var driver_marker;
var fn_interval;

$(function() {
	initTmap();
});

// 맵 호출
function initTmap() {
	var markerPosition = new Tmapv2.LatLng(start_lat, start_lng);

	map = new Tmapv2.Map("map_div", {
		center : markerPosition,
		width : width + "px",
		height : height + "px",
		zoom : 14,
		zoomControl : false,
		scrollwheel : true,
		draggable: true
	});

	// 사용자 마커
	marker = new Tmapv2.Marker({
		position : markerPosition,
		icon : "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_b_m_a.png",
		iconSize : new Tmapv2.Size(24, 38),
		map : map
	});

	// n초마다 실행
	fn_interval = setInterval(driverPosition, 2000);
}

var test_cnt = 0;
var test_lat = [37.5701136978226, 37.57012220158145, 37.57017109817494, 37.57013708315673, 37.57012007564219]; 
var test_lng = [126.98240550509985, 126.9805762385574, 126.9780576442929, 126.97584884517532, 126.97333829753406];  

// 드라이버 위치
function driverPosition() {
	var lat = test_lat[test_cnt];
	var lng = test_lng[test_cnt];
	var markerPosition = new Tmapv2.LatLng(lat, lng);

	if (typeof lat != "undefined" && typeof lng != "undefined") {
		// 드라이버 마커 초기화
		if (typeof driver_marker != "undefined") {
			driver_marker.setMap(null);
		}

		driver_marker = new Tmapv2.Marker({
			position : markerPosition,
			icon : "http://tmapapis.sktelecom.com/resources/images/common/pin_car.png",
			iconSize : new Tmapv2.Size(24, 38),
			map : map
		});
		map.setCenter(markerPosition);
	}

	// 테스트 종료
	if (test_cnt == test_lat.length) {
		 clearInterval(fn_interval);
		 alert('end');
	}

	test_cnt++;
}

</script>



<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>