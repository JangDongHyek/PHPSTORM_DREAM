<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="point">
	<div id="my_point">
		<dl class="dl1">
			<dt>사용 가능 적립코인</dt>
			<dd>
				<strong><?=number_format($member['mb_coin'])?>코인</strong>
				<p>1일 최대 100코인까지 적림가능</p>
			</dd>
		</dl>
		<?php /*?><dl class="dl2">
			<dt>적립예정</dt>
			<dd>
				<p>0코인</p>
			</dd>
		</dl><?php */?>
	</div>

	<div class="top_gnb_wrap point">
		<ul class="pointtab">
			<li><a href="#" class="on" data-tab="all">전체</a></li>
			<li><a href="#" data-tab="plus">적립내역</a></li>
			<li><a href="#" data-tab="minus">사용내역</a></li>
		</ul>
	</div>
	<!-- // top_gnb_wrap -->

	<div id="container">
		<div class="swiper-container main-swiper">
			<div class="swiper-wrapper">

				<!-- 전체 -->
				<div class="coin_list swiper-slide" id="all">
					
				</div>
				<!-- // 전체 -->

				<!-- 적립내역 -->
				<div class="coin_list swiper-slide" id="plus">
					
				</div>
				<!-- // 적립내역 -->
				
				<!-- 사용내역 -->
				<div class="coin_list swiper-slide" id="minus">
				
				</div>
				<!-- // 사용내역 -->
				
			</div>
		</div>

	</div>
	<!-- // container -->
</div>

<script src="<?php echo G5_THEME_JS_URL ?>/swiper.js"></script> <!--스와이프js -->
<script src="<?php echo $member_skin_url ?>/js/swiper.tab.js"></script> <!--스와이프js -->
<script>
$(function() {
	$(".pointtab a").on("click", function() {
		var tab = $(this).data("tab");
		getCoinList(tab);
	});

	getCoinList();

});

main_swiper.on('transitionStart', function (e) {
	var tab = "all";
	if (e.activeIndex == 1) {
		tab = "plus";
	} else if (e.activeIndex == 2) {
		tab = "minus";
	}
	getCoinList(tab);
});

function getCoinList(tab, page) {
	if (typeof tab == "undefined" || tab == "") {
		tab = "all";
	}

	if (typeof page == "undefined" || page == "") {
		page = 1;
	}

	$.ajax({  
		type : "post",  
		url : "./ajax.mb_coin_list.php",
		data : {"mb_id" : "<?=$member['mb_id']?>", "page" : page, "tab" : tab},
		dataType : "html",  
		beforeSend : function() {
			$(".coin_list").html("");
		},
		success : function(data) {  
			$("#"+tab+".coin_list").html(data);
			$(".swiper-wrapper").css("height", "auto");
		},  
		error : function(xhr,status,error) {
			$("#"+tab+".coin_list li").html("코인내역을 불러오는데 실패하였습니다. 다시 시도해 주세요.");
		}  
	});

}
</script>