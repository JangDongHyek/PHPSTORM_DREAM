<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$category_skin_url.'/style.css">', 0);
?>
<script src="http://apis.daum.net/maps/maps3.js?apikey=<?php echo $config['cf_10']; ?>&libraries=services"></script> <!-- daum -->

<div id="swiper-tab" class="swiper-container">
	<dl class="swiper-wrapper">
		<dd class="swiper-slide" data-code="all">전체</dd>
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
		<dd class="swiper-slide"></dd>
		<?php } ?>
	</dl>
</div>
<script>
$(function (){
	
	// Tabs page 
	var page = new Array();
	page[0] = new Array();
	page[0]['code'] = "all";
	page[0]['page'] = 1;
	<?php for($i=0; $i<count($ca_list); $i++){ ?>
	page[<?php echo ($i+1);?>] = new Array();
	page[<?php echo ($i+1);?>]['code'] = "<?php echo $ca_list[$i]['ca_code'];?>";
	page[<?php echo ($i+1);?>]['page'] = 1;
	<?php } ?>

	var swiperTab = new Swiper('#swiper-tab', {
		slidesPerView: 3,
		autoHeight: "auto"
	});	      

	var swiperContent = new Swiper('#swiper-content', {
		autoHeight: "auto"
	});

	swiperContent.on('transitionStart', function (e) {
		var idx = parseInt(e.activeIndex);
		var i = idx - 1;
		tabsOn(swiperTab, idx, i, 300);
	});

	$("#swiper-tab dd").click(function (){
		var idx = parseInt($("#swiper-tab dd").index(this));
		var i = idx;
		tabsOn(swiperContent, idx, i, 300);
	});
	
	// Tabs move
	function tabsOn(tab, idx, i, speed){
		var tm = 0;
		$("#swiper-tab dd").removeClass("on");
		$("#swiper-tab dd").eq(idx).addClass("on");
		
		tab.slideTo(i, speed);
		
		var sca = "<?php echo $ca['ca_name'];?>";
		var ca_code = $("#swiper-tab dd.on").data("code");
		for(var i=0; i<<?php echo count($ca_list);?>; i++){
			if(page[i]['page'] == 1 && page[i]['code'] == ca_code){
				$.post("<?php echo $category_skin_url;?>/ajax.list.skin.php", {bo_table:"<?php echo $bo_table;?>", page:page[i]['page'], sca:sca, ca_code:ca_code}, function (e){	
					var tabContainer = $("#swiper-content .swiper-slide-active");
					tabContainer.append(e);
				});
				page[i]['page'] ++;
			}
		}
	}

	tabsOn(swiperTab, <?php echo $ca_idx;?>, <?php echo ($ca_idx-1);?>, 0); // 시작시 타겟으로가게
	swiperContent.slideTo(<?php echo $ca_idx;?>, 0);

	$(window).scroll(function (e){
		var os = $(document).scrollTop();
		var boxH = $(".list-append div").eq(0).height();
		var h = $(document).height() - $(window).height() - boxH;
		
		if(os >= h){
			var ca_code = $("#swiper-tab dd.on").data("code");
			var sca = "<?php echo $ca['ca_name'];?>";
			for(var i=0; i<<?php echo count($ca_list);?>; i++){
				if(page[i]['code'] == ca_code){
					$.post("<?php echo $category_skin_url;?>/ajax.list_append.skin.php", {bo_table:"<?php echo $bo_table;?>", page:page[i]['page'], sca:sca, ca_code:ca_code}, function (e){	
						if(!e)
							return false;

						var tabContainer = $("#swiper-content .swiper-slide-active .list-append");
						tabContainer.append(e);
					});
				}
				page[i]['page']++;
			}
		}
	});
});

function getView(wr_id){
    $.pjax({ url: "<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>&wr_id="+wr_id, container:"#pjax_contanier", visibled:"visibled", session:"<?php echo G5_BBS_URL;?>/pjax.visibled.php", speed:"100", timeout:15000})
	.complete(function (e){
	});
}

//<![CDATA[
// // 사용할 앱의 JavaScript 키를 설정해 주세요.
// // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
function sendLink() {
  Kakao.Link.sendDefault({
	objectType: 'feed',
	content: {
	  title: '<?php echo $view["wr_subject"]; ?>',
	  description: '<?php echo $view["wr_content"]; ?>',
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
</script>
