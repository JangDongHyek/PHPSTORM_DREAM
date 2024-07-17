<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지';
include_once('./_head.php');

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>

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


    <div id="area_mypage">
		<div class="inr">		
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?> 
				
				<div class="mypage_cont">
					<div class="box">
						<h3>판매관리</h3>
						<ul class="sort_list">
							<li class="active"><a href="">전체(4)</a></li>
							<li><a href="">진행대기(1)</a></li>
							<li><a href="">진행중(1)</a></li>
							<li><a href="">완료(1)</a></li>
							<li><a href="">취소(1)</a></li>
						</ul>
						<ul id="product_list" class="col01">
							
							<!-- nodata
							<li class="nodata">
								<div class="box">
									<img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_nodata.svg">
									<p>구매한 재능상품이 없습니다.<p>
								</div>
							</li>
							<!-- nodata -->

							<!-- 목록 8개-->
							
							
							<li>								
								<div class="area_img">
									<a href="<?php echo G5_BBS_URL ?>/mypage_view.php">
										<img src="<?php echo G5_IMG_URL ?>/app/img_product03.jpg">
									</a>
								</div>
								<div class="area_right">
									<i data-toggle="modal" data-target="#listModal" class="type chk"><em></em>진행대기</i>
									<div class="area_txt">									
										<a href="<?php echo G5_BBS_URL ?>/mypage_sale_view.php">
											
											<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
											<div class="price">200,000원 ~</div> <!-- 가격 -->
											<div id="seller_info">
												<div class="photo"><img class="p_img" src='<?php echo G5_THEME_IMG_URL ?>/app/img_company01.jpg'></div>
												<div class="name"><p>스튜디오오늘</p></div>
											</div>
										</a>	
									</div>	
								</div>	

	
							</li>

							<li>								
								<div class="area_img">
									<a href="<?php echo G5_BBS_URL ?>/mypage_sale_view.php">
										<img src="<?php echo G5_IMG_URL ?>/app/img_product01.jpg">
									</a>
								</div>
								<div class="area_right">
									<i data-toggle="modal" data-target="#listModal" class="type chk"><em></em>진행중</i>
									<div class="area_txt">
										<a href="<?php echo G5_BBS_URL ?>/mypage_sale_view.php">
											
											<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.방송국에서 기획하는 가성비 영상 제작해 드립니다.방송국에서 기획하는 가성비 영상 제작해 드립니다.방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
											<div class="price">200,000원 ~</div> <!-- 가격 -->
											<div id="seller_info">
												<div class="photo"><img class="p_img" src='<?php echo G5_THEME_IMG_URL ?>/app/img_company01.jpg'></div>
												<div class="name"><p>스튜디오오늘</p></div>
											</div>
										</a>	
									</div>						
								</div>						
							</li>
							<li>								
								<div class="area_img">
									<a href="<?php echo G5_BBS_URL ?>/mypage_sale_view.php">
										<img src="<?php echo G5_IMG_URL ?>/app/img_product02.jpg">
									</a>
								</div>
							
								<div class="area_right">
									<i data-toggle="modal" data-target="#listModal" class="type chk"><em></em>완료</i>
									<div class="area_txt">
										<a href="<?php echo G5_BBS_URL ?>/mypage_sale_view.php">
											
											<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
											<div class="price">200,000원 ~</div> <!-- 가격 -->
											<div id="seller_info">
												<div class="photo"><img class="p_img" src='<?php echo G5_THEME_IMG_URL ?>/app/img_company01.jpg'></div>
												<div class="name"><p>스튜디오오늘</p></div>
											</div>
										</a>	
									</div>						
								</div>						
							</li>
							<li>								
								<div class="area_img">
									<a href="<?php echo G5_BBS_URL ?>/mypage_sale_view.php">
										<img src="<?php echo G5_IMG_URL ?>/app/img_product03.jpg">
									</a>
								</div>
							
								<div class="area_right">
									<i data-toggle="modal" data-target="#listModal" class="type chk"><em></em>취소</i>
									<div class="area_txt">
										<a href="<?php echo G5_BBS_URL ?>/mypage_sale_view.php">
											
											<h3>방송국에서 기획하는 가성비 영상 제작해 드립니다.</h3> <!-- 제목 -->
											<div class="price">200,000원 ~</div> <!-- 가격 -->
											<div id="seller_info">
												<div class="photo"><img class="p_img" src='<?php echo G5_THEME_IMG_URL ?>/app/img_company01.jpg'></div>
												<div class="name"><p>스튜디오오늘</p></div>
											</div>
										</a>	
									</div>						
								</div>						
							</li>
							
							
						</ul>
						
					</div>
				</div>
				<!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_menu.php'); ?> 	
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
     $('[name=r_score]').val(score[1]);
     return false;
});

function review_write() {

    var form = $('#reviewfrm')[0];
    var formData = new FormData(form);

    $.ajax({
        url: g5_bbs_url+"/ajax.controller.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success: function(data) {
            if (data == 'success') {
                swal("리뷰 등록이 완료되었습니다.");
                $("#review_modal").hide();
            }else{
                swal("실패하였습니다. 다시시도 해주세요.");
                location.href = location.href
            }

        }
    });

}

$('#reviewModal').on('show.bs.modal', function(event) {
    idx = $(event.relatedTarget).data('idx');
    $('#r_p_idx').val(idx);
});

</script>
