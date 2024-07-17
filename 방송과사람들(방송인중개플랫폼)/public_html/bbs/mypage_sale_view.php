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

<!-- 상태변경 select 모달-->
<div id="basic_modal">
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="inquiry_idx" name="inquiry_idx">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close""><span></span><span></span></button>
					<h4 class="modal-title" id="appModalLabel">상태변경</h4>
				</div>
				<div class="modal-body">
					<ul id="sort_list">
						<li class="active"><em>진행대기</em></li>
						<li><em>진행중</em></li>
						<li><em>완료</em></li>
						<li><em>취소</em></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 상태변경 select 모달-->

<div id="item_view" class="order view">
	<div class="inr v2">
		<h3 class="ptitle">상세내역</h3>
	        
			<div class="pd_info">
				<div class="pd_view">
					<i class="type">진행대기</i>
					<i data-toggle="modal" data-target="#listModal" class="type chk"><em></em>진행대기</i>
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
				<a href="">의뢰인과 채팅하기</a>
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
