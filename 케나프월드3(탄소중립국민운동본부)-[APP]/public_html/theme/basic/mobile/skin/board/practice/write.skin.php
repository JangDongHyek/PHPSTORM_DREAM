<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$wr_lat) $wr_lat = "35.179700928421915";
if(!$wr_lng) $wr_lng = "129.07516214077822";

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>
<style>
.check-box img { width:30%; }
</style>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript" src="http://apis.daum.net/maps/maps3.js?apikey=<?php echo $config['cf_10']; ?>&libraries=services"></script>

<section id="bo_w">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="wr_lat" id="wr_lat" value="<?php echo $wr_lat ?>">
    <input type="hidden" name="wr_lng" id="wr_lng" value="<?php echo $wr_lng ?>">
	
	<article class="box-article">
		<div class="box-body">
			<div class="box-contitle"><?php echo $board['bo_subject'];?> 업체<?php if(!$w) echo "등록"; else echo "수정";?></div>
			<div class="box-content clearfix">
				<label for="wr_subject"><?php echo $board['bo_subject'];?> 업체명</label>
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" class="regist-input required" placeholder="<?php echo $board['bo_subject'];?> 업체명" required>
			</div>
			<div class="box-content clearfix">
				<div style="padding-top:10px; font-size:1.15em;">
					<?php echo $board['bo_subject'];?> 업체분류
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label for="wr_subject"><?php echo $board['bo_subject'];?> 업체분류</label>
					<select name="ca_name" id="ca_name" required class="required" >
						<option value="">선택하세요</option>
						<?php echo $category_option ?>
					</select>
				</div>
			</div>
		</div>
        <div class="box-body">
        	<div class="box-contitle"><?php echo $board['bo_subject'];?> 업체사진</div>
			<div class="box-content clearfix">
				<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
				<div class="col-xs-2">사진 #<?php echo $i+1 ?></div>
				<div class="col-xs-6">
					 <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input" style="width:100%;">
				</div>
				<div class="col-xs-4">
					
					<?php if($w == 'u' && $file[$i]['file']) { ?>
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>" style="display:inline-block;">파일 삭제</label>
					<?php } ?>

				</div>
				<div class="clearfix"></div>
				<?php } ?>
			</div>
         </div>   
		<div class="box-body">
			<div class="box-contitle">주소</div>
			<div class="box-content clearfix">
				<div id="daum_map" style="width:100%;height:200px; margin-bottom:10px;">
				</div>
				<div class="col-xs-6">
					<label for="wr_1">우편번호</label>
					<input type="text" name="wr_1" value="<?php echo $wr_1 ?>" id="wr_1" class="regist-input required readonly" required placeholder="우편번호">
				</div>
				<div class="col-xs-6">
					<a data-role="button" class="btn btn-default" style="width:100%;" onclick="daumPostcode()">우편번호 검색</a>
				</div>
				<div class="clearfix"></div>
				<div id="daum_address" style="position:relative; display:none; border:1px solid;width:100%;height:200px; margin:5px 0;">
					<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
				</div>

				<div class="col-xs-12">
					<input type="text" name="wr_2" value="<?php echo $wr_2 ?>" id="wr_2" class="regist-input required readonly" required placeholder="주소">
				</div>
				<div class="col-xs-12">
					<input type="text" name="wr_3" value="<?php echo $wr_3 ?>" id="wr_3" class="regist-input required" required placeholder="상세주소">
				</div>
			</div>
		</div>
		<div class="box-body">
			<div class="box-contitle">소개</div>
			<div class="box-content clearfix">
				<label for="wr_content">소개</label>
				<textarea name="wr_content" id="wr_content" placeholder="ex) 2017년 우수 <?php echo $board['bo_subject'];?>업체입니다." class="agree-text required"><?php echo $content;?></textarea>
			</div>
		</div>
		<div class="box-body">
			<div class="box-contitle">정보</div>
			<div class="box-content clearfix">
				<label for="wr_17">운영시간</label>
				<input type="text" name="wr_17" value="<?php echo $wr_17 ?>" id="wr_17" class="regist-input" placeholder="운영시간">
			</div>
			<div class="box-content clearfix">
				<label for="wr_18">전화번호</label>
				<input type="text" name="wr_18" value="<?php echo $wr_18 ?>" id="wr_18" class="regist-input" placeholder="전화번호">
			</div>
		</div>
	</article>

	<div class="ap_bottom"> 
		<ul class="row">
			<li class="col-xs-12">
				<input type="submit" value="<?php if($w=="") echo "등록"; else echo "수정"?>" id="btn_submit" accesskey="s" style="width:100%; border:0; background:#178dc8; color:#FFF; padding:5px 0;">
			</li>
		</ul>
	</div>

	</form>
</section>
<script>
	
$(function (){
	$(".option li").click(function (){
		var img_src = $(this).find("img").attr("src");
		if($(this).hasClass("on")){
			$(this).removeClass("on");
			$("#"+$(this).data("for")).val("");
			$(this).find("img").attr("src", img_src.replace("on.", "off."));
		}else{
			$(this).addClass("on");
			$("#"+$(this).data("for")).val("1");
			$(this).find("img").attr("src", img_src.replace("off.", "on."));
		}
	});

	//체크박스 확인
	$(".check-box").click(function (){
		if($(this).hasClass("check-on")){
			$(this).removeClass("check-on");
			$("#"+$(this).data("for")).val("");
		}else{
			$(this).addClass("check-on");
			$("#"+$(this).data("for")).val("1");
		}
	});
	//체크박스 확인
});

// Daum API {
var lat = "<?php echo $wr_lat?>";
var lng = "<?php echo $wr_lng?>";

var mapContainer = document.getElementById('daum_map'), // 지도를 표시할 div 
	mapOption = {
		center: new daum.maps.LatLng(lat, lng), // 지도의 중심좌표
		level: 3 // 지도의 확대 레벨
	};  

// 지도를 생성합니다    
var map = new daum.maps.Map(mapContainer, mapOption); 
// 지도를 클릭한 위치에 표출할 마커입니다
var marker = new daum.maps.Marker({ 
	// 지도 중심좌표에 마커를 생성합니다 
	position: map.getCenter() 
}); 
// 지도에 마커를 표시합니다
marker.setMap(map);

// 지도에 클릭 이벤트를 등록합니다
// 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다
daum.maps.event.addListener(map, 'click', function(mouseEvent) {        
	// 클릭한 위도, 경도 정보를 가져옵니다 
	var latlng = mouseEvent.latLng; 
	// 마커 위치를 클릭한 위치로 옮깁니다
	marker.setPosition(latlng);
	
	panTo(latlng.getLat(), latlng.getLng());
});

function panTo(lat, lng) {
	// 이동할 위도 경도 위치를 생성합니다 
	var moveLatLon = new daum.maps.LatLng(lat, lng);
	// 지도 중심을 부드럽게 이동시킵니다
	// 만약 이동할 거리가 지도 화면보다 크면 부드러운 효과 없이 이동합니다
	document.getElementById("wr_lat").value = lat;
	document.getElementById("wr_lng").value = lng;
	map.panTo(moveLatLon);            
}

function getcoder(address){
	// 주소-좌표 변환 객체를 생성합니다
	var geocoder = new daum.maps.services.Geocoder();
	// 주소로 좌표를 검색합니다
	geocoder.addr2coord(address, function(status, result) {
		// 정상적으로 검색이 완료됐으면 
		if (status === daum.maps.services.Status.OK) {

			var coords = new daum.maps.LatLng(result.addr[0].lat, result.addr[0].lng);
			marker.setPosition(coords);

			// 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
			panTo(result.addr[0].lat, result.addr[0].lng);
		} 
	});
}

// 우편번호 찾기 찾기 화면을 넣을 element
var daum_wrap = document.getElementById('daum_address');

function foldDaumPostcode() {
	// iframe을 넣은 element를 안보이게 한다.
	daum_wrap.style.display = 'none';
}

function daumPostcode() {
	// 현재 scroll 위치를 저장해놓는다.
	var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
	new daum.Postcode({
		oncomplete: function(data) {
			// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = data.address; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 기본 주소가 도로명 타입일때 조합한다.
			if(data.addressType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById("wr_1").value = data.zonecode;
			document.getElementById("wr_2").value = fullAddr;
			document.getElementById("wr_3").focus();
			getcoder(fullAddr);

			// iframe을 넣은 element를 안보이게 한다.
			// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
			daum_wrap.style.display = 'none';

			// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
			document.body.scrollTop = currentScroll;
		},
		// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
		onresize : function(size) {
			daum_wrap.style.height = size.height+'px';
		},
		width : '100%',
		height : '100%'
	}).embed(daum_wrap);

	// iframe을 넣은 element를 보이게 한다.
	daum_wrap.style.display = 'block';
}
// Daum API

<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
	$("#wr_content").on("keyup", function() {
		check_byte("wr_content", "char_count");
	});
});

<?php } ?>
function html_auto_br(obj)
{
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "html2";
		else
			obj.value = "html1";
	}
	else
		obj.value = "";
}

function fwrite_submit(f)
{
	<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});

	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.wr_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}

	if (document.getElementById("char_count")) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(check_byte("wr_content", "char_count"));
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			}
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
</script>

</section>
<!-- } 게시물 작성/수정 끝 -->