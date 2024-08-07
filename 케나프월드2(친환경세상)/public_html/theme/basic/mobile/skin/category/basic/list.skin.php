<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$category_skin_url.'/style.css">', 0);
?>
<div id="swiper-tab" class="swiper-container">
	<dl class="swiper-wrapper">
		<?php 
		for($i=0; $i<count($ca_list); $i++){
		?>
		<dd class="swiper-slide" data-code="<?php echo $ca_list[$i]['ca_code'];?>"><?php echo $ca_list[$i]['ca_name'];?></dd>
		<?php } ?>
	</dl>
</div>

<div id="swiper-content" class="swiper-container">
	<dl class="swiper-wrapper">
		<?php 
		for($i=0; $i<count($ca_list); $i++){
		?>
		<dd id="con_<?php echo $ca_list[$i]['ca_code'];?>" class="swiper-slide"><?php echo $ca_list[$i]['ca_name'];?></dd>
		<?php } ?>
	</dl>
</div>

<script>
$(document).ready(function (){
	var swiperTab = new Swiper('#swiper-tab', {
		slidesPerView: 5,
		autoHeight: "auto",
		lazy:true
	});	      

	var swiperContent = new Swiper('#swiper-content', {
		autoHeight: "auto",
		lazy:true
	});

	swiperContent.on('transitionStart', function (e) {
		var idx = parseInt(e.activeIndex);
		var i = idx - 2;
		tabsOn(swiperTab, idx, i, 300);
	});

	$("#swiper-tab dd").click(function (){
		var idx = parseInt($("#swiper-tab dd").index(this));
		var i = idx;
		tabsOn(swiperContent, idx, i, 300);
	});

	tabsOn(swiperTab, <?php echo $ca_idx;?>, <?php echo ($ca_idx);?>, 0); // 시작시 타겟으로가게
	swiperContent.slideTo(<?php echo $ca_idx;?>, 0);
	
	// Tabs move
	function tabsOn(tab, idx, i, speed){
		var tm = 0;
		$("#swiper-tab dd").removeClass("on");
		$("#swiper-tab dd").eq(idx).addClass("on");
		
		tab.slideTo(i, speed);
		
		var ca_code = $("#swiper-tab dd.on").data("code");
		$("#ca_code").val(ca_code);
		$.get("<?php echo G5_BBS_URL;?>/ajax.business.php", {sca:ca_code}, function (e){
		});
	}
	
	// Tabs page 
	var pages = new Array();
	
	var bo_table	= "<?php echo $bo_table;?>";
	var sca			= "<?php echo $ca['ca_name'];?>";
	var sfl			= "<?php echo $sfl;?>";
	var stx			= "<?php echo $stx;?>";
	var ca_cnt		= <?php echo count($ca_list);?>;
	var ca_idx		= 0;

	for(var j=0; j<ca_cnt; j++){
		ca_code = $("#swiper-tab dd").eq(j).data("code");
		pages[ca_code] = 0;
		setPages(bo_table, pages[ca_code], sca, ca_code, sfl, stx);
		ca_idx++;
	}

	$(window).scroll(function (e){
		var os = $(document).scrollTop();
		var boxH = $(".list-append div").eq(0).height();
		var h = $(document).height() - $(window).height() - boxH;
		
		if(os >= h){
			var ca_code = $("#swiper-tab dd.on").data("code");
			pages[ca_code]++;
			setPages(bo_table, pages[ca_code], sca, ca_code, sfl, stx);
		}
	});

	function setPages(bo_table, page, sca, ca_code, sfl, stx){
		$.post("<?php echo $category_skin_url;?>/ajax.list.skin.php", {bo_table:bo_table, page:page, sca:sca, ca_code:ca_code, sfl:sfl, stx:stx}, function (e){
			console.log(e);
			if(page == 0 || page == 1){
				$("#con_"+ca_code).html(e);
			}else{
				$("#con_"+ca_code).append(e);
			}
			swiperContent.update();
		});
	}
});

</script>
