<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

//view에서 sca 세션 저장
set_session("ss_sca", substr($view['ca_code'], 0, 2));

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<script src="http://apis.daum.net/maps/maps3.js?apikey=<?php echo $config['cf_10']; ?>&libraries=services"></script> <!-- daum -->
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<?php if($is_adm){ ?>
<div class="bo_fx">
	<ul class="btn_bo_user">
		<li><a href="<?php echo $update_href ?>&sca=<?php echo substr($view['ca_code'], 0, 2);?>" class="btn_b02"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;&nbsp;수정</a></li>
		<li><a href="<?php echo $delete_href ?>" class="btn_b02" onclick="del(this.href); return false;"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;삭제</a></li>
		<li><a href="<?php echo $write_href ?>" class="btn_b01"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;등록</a></li>
	</ul>
</div>
<?php } ?>

<div id="view_wrap" class="view_wrap">
	<article id="v_content">
		<div class="rows">	
			<h2><?php echo $view['subject']; ?></h2>
			<dl class="box-txt"><?php echo $view['wr_4'];?>&nbsp;</dl>

			<dl id="sub_event">
				<dd class="box-title01" data-toggle="modal" data-target=".bs-example-modal-lg">위캐시 결제</dd>

				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<dl class="modal-dialog modal-lg">
						<dd class="modal-content modal-point">
							<p>※ 결제하실 위캐시 입력 후 결제버튼을 눌러주세요. </p>
							<p class="row wc-price">
								<span class="col-xs-6">보유중인 위캐시</span>
								<span class="col-xs-6 text-right"><strong><?php echo number_format($member['mb_point']);?></strong></span>
							</p>
							<input type="number" name="wecash_pay" id="wecash_pay" value="" class="frm-input">
							<input type="button" value="결제" class="btn btn-danger" onclick="setPay()">
						</dd>
					</dl>
				</div>
			</dl>
		</div>

		<div id="swiper_img" class="swiper-container rows">
			<div class="swiper-wrapper">
				<?php 
				// 파일 출력
				$v_img_count = count($view['file']);
				if($v_img_count) {
					for ($i=0; $i<count($view['file']); $i++) {
						if ($view['file'][$i]['view']) {
							//echo $view['file'][$i]['view'];
							$thumb = get_view_thumbnail($view['file'][$i]['view'], 500);
							if(!$kakao_thumb)
								$kakao_thumb = get_kakao_thumbnail($view['file'][$i]['view'], 500);
				?>
				<div class="swiper-slide swiper-img" style="text-align:center;"><?php echo $thumb; ?></div>
				<?php
						}
					}

					if(!$thumb){
				?>
					<div class="swiper-slide"><img src="<?php echo $board_skin_url;?>/img/noimg.jpg" style="width:100%;"></div>
					<?php } ?>
				<?php }else{ ?>
				<div class="swiper-slide"><img src="<?php echo $board_skin_url;?>/img/none.jpg" style="width:100%;"></div>
				<?php } ?>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>

		<!-- 스크랩 추천 비추천 시작 { -->
		<div style="position:relative; width:100%;">
			<?php if ($good_href) { ?>
			<dl style="position:absolute; top:-55px; right:5px; z-index:100; ">
				<a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" style="display:inline-block; background:#FFF; border:1px solid #DBDBDB; padding:0 12px; color:#193366; font-size:1.5em; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;">
				<i class="fa fa-heart"></i>
				</a>
			</dl>
			<?php } ?>
		</div>

		<div id="swiper-tab02" class="swiper-container">
			<dl class="swiper-wrapper">
				<dd class="swiper-slide">업체정보</dd>
				<dd class="swiper-slide">리뷰</dd>
			</dl>
		</div>

		<div id="swiper-content02" class="swiper-container">
			<dl class="swiper-wrapper">
				<dd class="swiper-slide">
					<div class="box-info">
						<dl>
							<table>
								<tbody>
									<tr>
										<th><p>주소</p></th>
										<td><?php echo $view['wr_addr1']?> <?php echo $view['wr_addr2']?></td>
									</tr>
									<tr>
										<th><p>영업시간</p></th>
										<td><?php echo $view['wr_1'];?></td>
									</tr>
									<tr>
										<th><p>휴무일</p></th>
										<td><?php echo $view['wr_2'];?></td>
									</tr>
									<tr>
										<th><p>주차시설</p></th>
										<td><?php echo $view['wr_3'];?></td>
									</tr>
									<tr>
										<th><p>소개</p></th>
										<td id="vwr_content"><?php echo get_view_thumbnail2($view['content'], 300); ?></td>
									</tr>
									<tr>
										<th colspan="2"><p id="daum_view" onclick="setDaumMap()">지도보기</p></th>
									</tr>
									<tr>
										<td colspan="2"><div id="daum_map" style="display:none;"></div></td>
									</tr>
								</tbody>
							</table>
						</dl>
					</div>
				</dd>
				<dd id="review_slide" class="swiper-slide">
					<?php include_once(G5_BBS_PATH.'/view_comment.php'); ?>
				</dd>
			</dl>
		</div>

		<!-- } 게시판 읽기 끝 -->
		<?php if(!$is_adm){ ?>
		<div id="ap_bottom" class="ap_bottom"> 
			<ul class="row">
				<li class="col-xs-6">
					<?php if($member['mb_id'] == $view['mb_id']){ ?>
					<a href="<?php echo $update_href;?>">수정</a>
					<?php }else{ ?>
					<a id="kakao-link-btn" href="javascript:sendLink();">
						<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/b_share.png" style="width: 25px">&nbsp;&nbsp;공유하기
					</a>
					<?php } ?>
				</li>
				<li class="col-xs-6">
					<?php if($member['mb_id'] == $view['mb_id']){ ?>
					<a href="<?php echo $delete_href;?>" onclick="del(this.href); return false;">삭제</a>
					<?php }else{ ?>
					<a href="<?php if($view['wr_tel']) echo "tel:".$view['wr_tel']; else echo "javascript:alert('등록된 전화번호가 없습니다.')";?>">
						<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/b_call.png" style="width: 25px">&nbsp;&nbsp;전화하기
					</a>
					<?php } ?>
				</li>
			</ul>
            <img src="<?php echo G5_THEME_IMG_URL ?>/qrcode.jpg" alt="" width="100px;">
		</div>
		<?php } ?>
	</article>
</div>

<script>
var swiperContent;

var swiper = new Swiper('#swiper_img', {
	nextButton: '.swiper-button-next',
	prevButton: '.swiper-button-prev',
	pagination: '.swiper-pagination',
	paginationType: 'fraction',
	autoplay: 8000,
	autoHeight: true,
	loop:true,
});
	
var swiperTab = new Swiper('#swiper-tab02', {
	slidesPerView: 2,
	autoHeight: "auto"
});	      

swiperContent = new Swiper('#swiper-content02', {
	autoHeight: "auto"
});

swiperContent.on('transitionStart', function (e) {
	var idx = parseInt(e.activeIndex);
	var i = idx - 1;
	tabsOn(swiperTab, idx, i, 300);
});

$("#swiper-tab02 dd").click(function (){
	var idx = parseInt($("#swiper-tab02 dd").index(this));
	var i = idx;
	tabsOn(swiperContent, idx, i, 300);
});

// Tabs move
function tabsOn(tab, idx, i, speed){
	$("#swiper-tab02 dd").removeClass("on");
	$("#swiper-tab02 dd").eq(idx).addClass("on");
	$("#swiper-content02").css("height", "auto");
	tab.slideTo(i, speed);
}

tabsOn(swiperTab, 0, 0, 0); // 시작시 타겟으로가게
swiperContent.slideTo(0, 0);

$("#view_wrap").css("min-height", $(window).height() - 60);

// 추천, 비추천
$("#good_button, #nogood_button").click(function() {
	var $tx;
	if(this.id == "good_button")
		$tx = $("#bo_v_act_good");
	else
		$tx = $("#bo_v_act_nogood");

	excute_good(this.href, $(this), $tx);
	return false;
});

$("#pjax_contanier").scroll(function (e){
	var h = $(this).scrollTop() * (-1);
	$("#ap_bottom").css("bottom", h);
});

$("#ap_bottom").css("bottom", 0);

$(document).ready(function (e){
	setTimeout(function (){
		$("#swiper-content02").css("height", "auto");
	}, 100);
});

function setDaumMap(){
	if($("#daum_map").css("display") == "none"){
		$("#daum_map").css("display", "");
		$("#daum_view").html("지도닫기");
	}else{
		$("#daum_map").css("display", "none");
		$("#daum_view").html("지도보기");
	}

	swiperContent.update();

	var wr_lat = <?=$view['wr_lat']?$view['wr_lat']:"0"?>;
	var wr_lng = <?=$view['wr_lng']?$view['wr_lng']:"0"?>;
	var mapContainer = document.getElementById('daum_map'), // 지도를 표시할 div 
		mapOption = { 
			center: new daum.maps.LatLng(wr_lat, wr_lng), // 지도의 중심좌표
			draggable: true, // 지도를 생성할때 지도 이동 및 확대/축소를 막으려면 draggable: false 옵션을 추가하세요
			level: 2, // 지도의 확대 레벨
		};

	var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
	// 마커가 표시될 위치입니다 
	var markerPosition  = new daum.maps.LatLng(wr_lat, wr_lng); 
	// 마커를 생성합니다
	var marker = new daum.maps.Marker({
		position: markerPosition
	});
	// 마커가 지도 위에 표시되도록 설정합니다
	marker.setMap(map);
}
	 //<![CDATA[

// // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
function sendLink() {
  Kakao.Link.sendDefault({
	objectType: 'feed',
	content: {
	  title: '<?php echo $view["wr_subject"]; ?>',
	  description: '<?php echo $view["wr_4"]; ?>',
	  imageUrl: '<?php echo $kakao_thumb; ?>',
	  link: {
		mobileWebUrl: '<?php echo G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$wr_id;?>',
		webUrl: '<?php echo G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$wr_id;?>'
	  }
	},
	buttons: [
	  {
		title: '앱으로 보기',
		link: {
		  mobileWebUrl: '<?php echo G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$wr_id;?>',
		  webUrl: '<?php echo G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$wr_id;?>'
		}
	  }
	]
  });
}
//]]>

function setPay(){
	var wr_id = "<?php echo $wr_id;?>";
	var wp = $("#wecash_pay").val();

	if(!wp){
		alert("결제하실 위캐시를 입력해주세요.");
		return false;
	}

	$.get("<?php echo G5_BBS_URL;?>/ajax.wecash_update.php", {bo_table:"<?php echo $bo_table;?>", wr_id:wr_id, wp:wp}, function (e){
		if(e.success)
			location.href = "<?php echo G5_BBS_URL;?>/mypayment.php";
		else
			alert(e.msg);
	}, "json");
}
</script>
<!-- } 게시글 읽기 끝 -->