<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '상세내역';
include_once('./_head.php');

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#ft{display:none;}
</style>

<!-- 리뷰 모달 -->
    <div id="basic_modal">
        <!-- Modal -->
        <div class="modal fade review" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close""><span></span><span></span></button>
                        <h4 class="modal-title" id="appModalLabel">리뷰쓰기</h4>
                    </div>
                    <div class="modal-body">
                        <div id="star_rating">
							<h2>별점을 선택해 주세요.</h2>
							<div class="box">
								<p class="star_rating">
									<a href="#" name="score_'.$i.'"><i></i></a>
									<a href="#" name="score_'.$i.'"><i></i></a>
									<a href="#" name="score_'.$i.'"><i></i></a>
									<a href="#" name="score_'.$i.'"><i></i></a>
									<a href="#" name="score_'.$i.'"><i></i></a>
								</p>
							</div>
						</div>
                        <!--star_rating-->
						<h2>후기를 작성해 주세요.</h2>
						<div class="box">
							<div class="cont">
								<textarea name="r_content"><?=$view['r_content']?></textarea>
							</div>
						</div>	
                    </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">리뷰작성완료</button>
					</div>
                </div>
            </div>
        </div>
    </div><!--basic_modal-->
<!-- 리뷰 모달 -->

<div id="item_view" class="order view">
	<div class="inr v2">
		<h3 class="ptitle">상세내역</h3>
	        
			<div class="pd_info">
				<div class="pd_view">
					<i class="type">진행대기</i>
					<i class="btn_review" data-toggle="modal" data-target="#reviewModal">리뷰쓰기</i>
					<a href="<?=G5_BBS_URL?>/item_view.php">
						<div class="img_pd"><img src="<?php echo G5_IMG_URL ?>/app/img_product01.jpg"></div><!--서비스 썸네일 추출-->
						<div class="info">
							<ul class="pd_info_list">
								<li class="data">2022.02.07</li>
								<li>(주문번호:123456789)</li>
							</ul>
							<div class="tit">방송국에서 기획하는 가성비 영상 제작해 드립니다. 방송국에서 기획하는 가성비 영상 제작해 드립니다.</div>

							<div id="seller_info">
								<div class="name"><p>스튜디오오늘</p></div>
							</div>
						</div>
					</a>
					
					<div class="sale_info">
						<ul class="list_top">
							<li class="pinfo">상품정보</li>
							<li class="amount">수량</li>
							<li class="price">금액</li>
						</ul>
						<ul class="list_sale">
							<li class="pinfo">
								<h3>7일 완성 영상 (기획+촬영+편집)</h3>
								<span>작업일 <i class="point">7일</i></span>
							</li>
							<li class="amount">							
								<em>수량</em> <span class="count">1개</span>
							</li>
							<li class="price"><span>200,000원</span></li>
						</ul>
					</div>
				</div>
				<div class="total">
					<h3>총 결제금액</h3>
					<div class="total_price">200,000원</div>
				</div>
			</div>
			<div id="btn_cs">
				<a href="">전문가와 채팅하기</a>
			</div>
	</div>
</div>

<?
include_once('./_tail.php');
?>

<script>
$( ".star_rating a" ).click(function() {
     $(this).parent().children("a").removeClass("on");
     $(this).addClass("on").prevAll("a").addClass("on");
     var score = $(this).attr('name').split('_');
     $('#score').val(score[1]);
     return false;
});
</script>
