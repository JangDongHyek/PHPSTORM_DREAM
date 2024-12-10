<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 드라이버는 콜내역 이동
if ($is_driver) {
	goto_url(G5_BBS_URL.'/call_list_new.php');
}

include_once(G5_THEME_MOBILE_PATH.'/head.php');

?>
<script src="https://apis.openapi.sk.com/tmap/jsv2?version=1&appKey=<?=$config['cf_tmap_api']?>"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=$config['cf_kakao_js_apikey']?>&libraries=services"></script>

<script>
var width = $(window).width();
var height = $(window).height() - $("#hd").height();
var map, marker;

var start_lat = parseFloat("<? echo ($start_lat)? $start_lat : 0; ?>");
var start_lng = parseFloat("<? echo ($start_lng)? $start_lng : 0; ?>");
var pass_lat = parseFloat("<? echo ($pass_lat)? $pass_lat : 0; ?>");
var pass_lng = parseFloat("<? echo ($pass_lng)? $pass_lng : 0; ?>");
// T맵 좌표변수
var init_lat = parseFloat("<?=$cur_lat?>");
var init_lng = parseFloat("<?=$cur_lng?>");

$(function() {
	if (start_lat != 0 && start_lng != 0) {
		if (pass_lat != 0 && pass_lng != 0) {
			init_lat = pass_lat;
			init_lng = pass_lng;
		} else {
			init_lat = start_lat;
			init_lng = start_lng;
		}
	}

	initTmap();

	// 경유지추가 툴팁
	$('[data-toggle="tooltip"]').tooltip('show');
});

// 맵 호출
function initTmap() {
	var markerPosition = new Tmapv2.LatLng(init_lat, init_lng);

	map = new Tmapv2.Map("map_div", {
		center : markerPosition,
		width : width + "px",
		height : height + "px",
		zoom : 15,
		zoomControl : false,
		scrollwheel : true,
		draggable: true
	});

	// 마커
	marker = new Tmapv2.Marker({
		position : markerPosition,
		icon : "http://tmapapis.sktelecom.com/upload/tmap/marker/pin_b_m_a.png",
		iconSize : new Tmapv2.Size(24, 38),
		map : map
	});
}

// 출발, 경유, 도착지 입력
function addPath(mode) {
	var url = g5_bbs_url;

	if (mode != "start") {
		if($("#start-place").val() == ""){
			getNoti(1, "출발지를 입력하세요");
			return;
		}
	}

	url += '/map_search.php?mode=' + mode + '&' + getPathParams();
	location.href = url;
}

function getPathParams() {
	var param = 'start_place=' + $("#start-place").val() + '&start_lat=' + $("#start_lat").val() + '&start_lng=' + $("#start_lng").val();
	var pass_chk = "<?=$pass_place?>";

	if (pass_chk != '') {
		param += '&pass_place=<?=$pass_place?>&pass_lat=<?=$pass_lat?>&pass_lng=<?=$pass_lng?>';
	}
	return param;
}

function getStartPlace(lat, lng) {
	var mapContainer = document.getElementById('daum_map'),
		mapOption = {
			center: new kakao.maps.LatLng(lat, lng),
			level: 1
		};
	var map = new kakao.maps.Map(mapContainer, mapOption); 
	// 주소-좌표 변환 객체를 생성합니다
	var geocoder = new kakao.maps.services.Geocoder();
	var coord = new kakao.maps.LatLng(lat, lng);
	var callback = function(result, status) {
		if (status === kakao.maps.services.Status.OK) {
			//console.log(result[0].address);
			location.href = g5_url + "?start_lat="+ lat +"&start_lng=" + lng + "&start_place="+ result[0].address.address_name;
		} else {
			getNoti(1, "현위치를 불러오는데 실패하였습니다. 다시 시도해 주세요.");
		}
	};
	geocoder.coord2Address(coord.getLng(), coord.getLat(), callback);
}

// 내위치호출
function getUserLocation() {
    let userAgent = navigator.userAgent;
    let inapp = Boolean("<?=$is_inapp?>");

    if (inapp) {
        getStartPlace(init_lat, init_lng);

    } else {
        alert('앱을 설치하셔야 합니다.');
    }
}

$(function() {
    <?php
    // IOS : 아이폰 위치호출
    if (strpos($_SERVER['HTTP_USER_AGENT'], "IOS_APP") !== false) {
    ?>
    sessionStorage.setItem("APP_OS", "IOS");

    // if (sessionStorage.getItem("IOS_INDEX_CALL_POS") != "Y") {
    //     //alert('호출');
    //     sessionStorage.setItem("IOS_INDEX_CALL_POS", "Y");
    //     window.webkit.messageHandlers.scriptHandler.postMessage("location");
    // } else {
    //     if (document.getElementById("start_lat").value.length == 0) {
    //         getStartPlace(init_lat, init_lng);
    //     }
    // }
    if (document.getElementById("start_lat").value.length == 0) {
        getStartPlace(init_lat, init_lng);
    }

    <?php } else { ?>
    // AOS : 인덱스 진입시 현위치 자동설정
    if (document.getElementById("start_lat").value.length == 0) {
        getStartPlace(init_lat, init_lng);
    }

    <?php } ?>
})


</script>

<input type="hidden" name="" id="start_lat" value="<?=$start_lat?>">
<input type="hidden" name="" id="start_lng" value="<?=$start_lng?>">
<input type="hidden" name="" id="end_lat" value="<?=$end_lat?>">
<input type="hidden" name="" id="end_lng" value="<?=$end_lng?>">

<div id="location">
	<div class="start"><button type="button" onclick="getUserLocation()" class="btn">현위치</button>
	<input type="text" id="start-place" placeholder="출발지를 선택해주세요" value="<?=urldecode($start_place)?>" onClick="addPath('start')"></div>
	<!--경유지 추가부분 -->
	<? if(!$pass_place){?>
	<button type="button" class="via_btn" data-toggle="tooltip" data-placement="bottom" title="경유지추가" onclick="addPath('pass')">경유지추가</button>
	<? } ?>
	<div class="via" style="display:<?php echo $pass_place?"":"none";?>"><input type="text" placeholder="경유지를 선택해주세요" value="<?=urldecode($pass_place)?>" onClick="addPath('pass')"></div>
	<!--//경유지 추가부분 -->
	<div class="goal"><input type="text" placeholder="어디로 가세요?" value="" onClick="addPath('end')"></div>
</div>

<?php if (!$is_member) {  ?>
<div id="ft_banner">
	<div class="join_bn">
		<p>T대리가 처음이세요?</p>
		<span>지금 가입하고 신규가입 혜택 받아가세요!</span>
		<a href="<?php echo G5_BBS_URL ?>/register.php">신규가입 바로가기</a>
	</div>
</div>
<?php }  ?>


<!-- 티맵지도 -->
<div id="map_div"></div>

<div class="map_wrap" style="width: 1px; height: 1px; position: absolute; left: -9999px; opacity: 0;">
    <div id="daum_map"></div>
</div>



<? /*
<!--지도-->
<style>
#map_div{position:fixed; width:100%; height:100%; z-index:0;}
.root_daum_roughmap .wrap_map{height:100%;}
</style>
<div id="map_div">
    <!-- * 카카오맵 - 지도퍼가기 -->
    <!-- 1. 지도 노드 -->
    <div id="daumRoughmapContainer1585786273254" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%; height:100%;"></div>
    
    <!--
        2. 설치 스크립트
        * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
    -->
    <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
    
    <!-- 3. 실행 스크립트 -->
    <script charset="UTF-8">
        new daum.roughmap.Lander({
            "timestamp" : "1585786273254",
            "key" : "xr5e",
            "mapWidth" : "100%",
            "mapHeight" : "100%"
        }).render();
    </script>

</div>    
<!--//지도-->
*/ ?>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>