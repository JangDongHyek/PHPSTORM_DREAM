<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지 기업의뢰';
include_once('./_head.php');

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>

</style>

    <div id="area_mypage" class="company">
		<div class="inr v3">
			<div id="mypage_wrap">
				<?php include_once('./mypage_cinfo.php'); ?> 
				<div class="mypage_cont">
					<div class="box">
						<h3>기업의뢰</h3>
						<ul id="snb">
							<li><a href="<?php echo G5_BBS_URL ?>/mypage_company01.php">견적요청</a></li>
							<li><a href="<?php echo G5_BBS_URL ?>/mypage_company02.php">보낸견적</a></li>
							<li><a class="active" href="<?php echo G5_BBS_URL ?>/mypage_company03.php">매물리스트</a></li>
						</ul>
						<div class="box_cont">
							<!--
							<ul class="tabs">
								<li class="active" rel="tab1"><span>전체</span><em>3</em></li>
							</ul>	
							-->
							<div class="tab_container">
								<div id="tab1" class="tab_content">
									<div id="help_list" class="product">
										<ul class="list">						
											<!-- 리스트 10 -->
											
											<!-- 선박매물 -->
											<li class="company">
												<a href="<?php echo G5_BBS_URL ?>/help_view.php">
													<div class="title">
														<em>선박</em><!-- 카테고리 -->
														<h3>선박이름</h3> <!-- 매물 제품명 -->
													</div>	
													<div class="cont">
														<div class="left">
															<ul class="list_text">
																<li><em>Ship Type</em><span>Ship Type</span></li><!-- Ship Type -->
																<li><em>Built Year</em><span>2000</span></li><!-- Model/Type -->
																<li><em>Price Idea</em><span>$3,000 ~ $10,000</span></li><!-- Price Idea -->
																<li><em>Ship Location</em><span>Australia</span></li><!-- Located at -->
															</ul>
															<div class="list_info">
																<span class="data">2021.05.21</span> <!-- 의뢰올린날자 -->
															</div>							
														</div>
														<div class="right">
															<!-- 매물 등록시 파일첨부 첫번째 이미지 리스트 노출되게 해주세요~~~ -->
															<img src="<?php echo G5_IMG_URL ?>/img_photo.jpg">
														</div>
													</div>								
												</a>
											</li>
											<li class="company">
												<a href="<?php echo G5_BBS_URL ?>/help_view.php">
													<div class="title">
														<em>선박</em><!-- 카테고리 -->
														<h3>선박이름</h3> <!-- 매물 제품명 -->
													</div>	
													<div class="cont">
														<div class="left">
															<ul class="list_text">
																<li><em>Ship Type</em><span>Ship Type</span></li><!-- Ship Type -->
																<li><em>Built Year</em><span>2000</span></li><!-- Model/Type -->
																<li><em>Price Idea</em><span>$3,000 ~ $10,000</span></li><!-- Price Idea -->
																<li><em>Ship Location</em><span>Australia</span></li><!-- Located at -->
															</ul>
															<div class="list_info">
																<span class="data">2021.05.21</span> <!-- 의뢰올린날자 -->
															</div>							
														</div>
														<div class="right">
															<!-- 매물 등록시 파일첨부 첫번째 이미지 리스트 노출되게 해주세요~~~ -->
															<img src="<?php echo G5_IMG_URL ?>/img_photo.jpg">
														</div>
													</div>								
												</a>
											</li>
											<li class="company">
												<a href="<?php echo G5_BBS_URL ?>/help_view.php">
													<div class="title">
														<em>선박</em><!-- 카테고리 -->
														<h3>선박이름</h3> <!-- 매물 제품명 -->
													</div>	
													<div class="cont">
														<div class="left">
															<ul class="list_text">
																<li><em>Ship Type</em><span>Ship Type</span></li><!-- Ship Type -->
																<li><em>Built Year</em><span>2000</span></li><!-- Model/Type -->
																<li><em>Price Idea</em><span>$3,000 ~ $10,000</span></li><!-- Price Idea -->
																<li><em>Ship Location</em><span>Australia</span></li><!-- Located at -->
															</ul>
															<div class="list_info">
																<span class="data">2021.05.21</span> <!-- 의뢰올린날자 -->
															</div>							
														</div>
														<div class="right">
															<!-- 매물 등록시 파일첨부 첫번째 이미지 리스트 노출되게 해주세요~~~ -->
															<img src="<?php echo G5_IMG_URL ?>/img_photo.jpg">
														</div>
													</div>								
												</a>
											</li>
											<li class="company">
												<a href="<?php echo G5_BBS_URL ?>/help_view.php">
													<div class="title">
														<em>선박</em><!-- 카테고리 -->
														<h3>선박이름</h3> <!-- 매물 제품명 -->
													</div>	
													<div class="cont">
														<div class="left">
															<ul class="list_text">
																<li><em>Ship Type</em><span>Ship Type</span></li><!-- Ship Type -->
																<li><em>Built Year</em><span>2000</span></li><!-- Model/Type -->
																<li><em>Price Idea</em><span>$3,000 ~ $10,000</span></li><!-- Price Idea -->
																<li><em>Ship Location</em><span>Australia</span></li><!-- Located at -->
															</ul>
															<div class="list_info">
																<span class="data">2021.05.21</span> <!-- 의뢰올린날자 -->
															</div>							
														</div>
														<div class="right">
															<!-- 매물 등록시 파일첨부 첫번째 이미지 리스트 노출되게 해주세요~~~ -->
															<img src="<?php echo G5_IMG_URL ?>/img_photo.jpg">
														</div>
													</div>								
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include_once('./mypage_cmenu.php'); ?> 
			</div>			
		</div>
	</div>

<?
include_once('./_tail.php');
?>

<script>

$(document).ready(function() {
    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		}
    });
});

</script>