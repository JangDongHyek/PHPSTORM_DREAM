<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$name = "cmypage";
$pid = "mypage";
$g5['title'] = '마이페이지';
include_once('./_head.php');

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<link rel="stylesheet" href="<?= $member_skin_url?>/competition.css">
<style>

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
									<a href="#" name="score_1" class="on"><i></i></a>
									<a href="#" name="score_2" class="on"><i></i></a>
									<a href="#" name="score_3" class="on"><i></i></a>
									<a href="#" name="score_4" class="on"><i></i></a>
									<a href="#" name="score_5" class="on"><i></i></a>
								</p>
							</div>
						</div>
                        <!--star_rating-->
						<h2>후기를 작성해 주세요.</h2>
						<div class="box">
							<div class="cont">
                                <form id="reviewfrm">
                                    <input type="hidden" name ="mode" value="review_write">
                                    <input type="hidden" name ="r_score" value="5">
                                    <input type="hidden" name= "r_p_idx" id="r_p_idx">
                                    <textarea name="r_content"></textarea>
                                </form>
							</div>
						</div>	
                    </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" onclick="review_write()">리뷰작성완료</button>
					</div>
                </div>
            </div>
        </div>
    </div><!--basic_modal-->
<!-- 리뷰 모달 -->


    <div id="area_mypage">
		<div class="inr">
            <?php include('./mypage_banner.php'); ?>
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?> 
				
				<div class="mypage_cont">
					<div class="box">
						<h3>내 프로젝트</h3>

                        <div id="contest">
                            <div class="">
                                <a href="<?php echo G5_BBS_URL ?>/contest_write.php" class="write_btn">의뢰등록</a>

                                <project-my-list mb_no="<?=$member['mb_no']?>"></project-my-list>

                            </div><!--in-->
                        </div><!--goods-->


                    </div>
				</div>
				<!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_menu.php'); ?> 	
			</div>				
		</div>
	</div>


<?
$jl->vueLoad("contest");
$jl->componentLoad("/project");
$jl->componentLoad("/item");
?>


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
