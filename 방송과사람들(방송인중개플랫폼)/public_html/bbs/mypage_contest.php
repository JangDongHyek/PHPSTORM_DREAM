<?
include_once('./_common.php');
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
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?> 
				
				<div class="mypage_cont">
					<div class="box">
						<h3>내 프로젝트</h3>

                        <div id="contest">
                            <div class="">
                                <a href="<?php echo G5_BBS_URL ?>/contest_write.php" class="write_btn">의뢰등록</a>

                                <div class="list cf">
                                    <div class="thm">
                                        <div class="mg">
                                            <!--<span class="pri">PRIME</span>prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                                            <div class="heart" id="heart_div_18">
                                                <button type="button" class="heart off" onclick="like_chk('on',18,'competition')"><i class="fa-light fa-heart"></i></button><!--좋아요 누르기전 -->
                                            </div>
                                            <a href="http://itforone.com/~broadcast/bbs/contest_view.php?idx=18">

                                                <div class="mg_in">
                                                    <div class="over">
                                                        <img src="http://itforone.com/~broadcast/data/file/competition/202305261450419.png">                                            </div>
                                                </div><!--클라이언트 로고-->
                                            </a>
                                        </div><!--mg-->

                                        <a href="http://itforone.com/~broadcast/bbs/contest_view.php?idx=18">

                                            <div class="info">
                                                <!-- 재능강의 작성자 정보 -->
                                                <div id="lecture_writer_list">
                                                    <div class="mb">
                                                        <div class="mb_info">
                                                            <p><i class="fas fa-user-circle"></i>&nbsp;1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tit">3</div><!--프로젝트 제목(최대1줄까지만 추출, 나머지는 ... 처리함)-->
                                                <div class="cont">4</div><!--프로젝트 설명(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                                                <div class="rate cf">
                                                    <div class="star"><span><i class="fal fa-eye"></i> 0회</span><span>0명의 참여자</span></div>
                                                    <div class="heart_hit"><span><i class="fal fa-calendar-week"></i></span> 심사중 (~23.05.26) </div><!--심시기간-->
                                                </div>
                                                <div class="price">희망 제작비용 5만원</div><!--상품가격-->
                                            </div>
                                        </a>

                                    </div>
                                    <?php for ($i = 0; $row = sql_fetch_array($result); $i++){
                                        //업데이트 안되었을 경우 임시로 심사중으로 변경해주기
                                        if (G5_TIME_YMD >= date('Y-m-d', strtotime($row['cp_datetime'])) && $row['cp_progress'] < 2 ) {
                                            $row['cp_progress'] = 2;
                                        }
                                        ?>
                                        <div class="thm">
                                            <div class="mg">
                                                <!--<span class="pri">PRIME</span>prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                                                <div class="heart" id="heart_div_<?=$row['cp_idx']?>">
                                                    <?php $like_sql = "select li_idx from {$g5['like_table']} where ta_idx = '{$row['cp_idx']}' and li_table = 'competition' and mb_id = '{$member['mb_id']}' ";
                                                    $like_row = sql_fetch($like_sql);
                                                    if (isset($like_row['li_idx'])){ ?>
                                                        <button type="button" class="heart on" onclick="like_chk('off',<?=$row['cp_idx']?>,'competition')"><i class="fa-solid fa-heart"></i></button><!--좋아요 누른후-->
                                                    <?php }else{ ?>
                                                        <button type="button" class="heart off" onclick="like_chk('on',<?=$row['cp_idx']?>,'competition')"><i class="fa-light fa-heart"></i></button><!--좋아요 누르기전 -->
                                                    <?php } ?>
                                                </div>
                                                <a href="<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$row['cp_idx']?>">

                                                    <div class="mg_in">
                                                        <div class="over">
                                                            <?php $sql = "select * from {$g5['board_file_table']} where wr_id = {$row['cp_idx']} and bo_table = 'competition' ";
                                                            $img = sql_fetch($sql);
                                                            $img_file = G5_DATA_PATH.'/file/competition/'.$img['bf_file'];
                                                            if (file_exists($img_file) && $img['bf_file'] != ""){
                                                                echo '<img src="'. G5_DATA_URL.'/file/competition/'.$img['bf_file'].'">';
                                                            }else{
                                                                // echo '<img src="'. G5_THEME_IMG_URL.'/main/heart_on.png">';
                                                                echo "<div class='no_img'>로고 이미지가 없습니다.</div>";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div><!--클라이언트 로고-->
                                                </a>
                                            </div><!--mg-->

                                            <a href="<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$row['cp_idx']?>">

                                                <div class="info">
                                                    <!-- 재능강의 작성자 정보 -->
                                                    <div id="lecture_writer_list">
                                                        <div class="mb">
                                                            <div class="mb_info">
                                                                <p><i class="fas fa-user-circle"></i>&nbsp;<?=$row['cp_company_name']?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tit"><?=$row['cp_title']?></div><!--프로젝트 제목(최대1줄까지만 추출, 나머지는 ... 처리함)-->
                                                    <div class="cont"><?= cut_str($row['cp_logo_content'], 170, "…") ?></div><!--프로젝트 설명(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                                                    <div class="rate cf">
                                                        <div class="star"><span><i class="fal fa-eye"></i> <?= number_format($row['hit'])?>회</span><span><?= comp_apply_cnt($row['cp_idx'])?>명의 참여자</span></div>
                                                        <div class="heart_hit"><span><i class="fal fa-calendar-week"></i></span> <?=$progress_list[$row['cp_progress']]?> (~<?= date('y.m.d',strtotime($row['cp_datetime'])) ?>) </div><!--심시기간-->
                                                    </div>
                                                    <div class="price">희망 제작비용 <?= number_format($row['cp_reward']) ?>만원</div><!--상품가격-->
                                                </div>
                                            </a>

                                        </div>
                                    <?php }?>

                                </div><!--list-->
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
