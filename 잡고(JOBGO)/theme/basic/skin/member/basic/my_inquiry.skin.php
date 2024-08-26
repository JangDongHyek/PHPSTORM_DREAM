<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="'.$member_skin_url.'/js/epggea.js"></script>', 100);


?>
<style>
.box-article .box-body .row{ background:#fff}
.tab-content {
	display: none;
	float: left;
	width: 100%;
	padding: 0 0 1em 0;
	background:#fff;
}
#reply{ display:none}
</style>


<!--마이페이지-->

<article id="mypage">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
             <h3>재능 문의 글<span>전체 문의 글 <?=sql_num_rows($result)?></span></h3>
             
                <!--문의글 리스트-->
                      <div id="item_review">
                            <div class="in">
                                <div class="rev cf">
                                    <?php
                                    if (sql_num_rows($result) > 0){
                                        for ($i = 0; $row = sql_fetch_array($result); $i++){
                                            $mb = get_member($row['co_mb_id']); ?>
                                    <div class="list cf">
                                        <a href="javascript:;">
                                            <div class="mg">
                                                <?php
                                                // 회원아이콘 경로
                                                $mb_icon_path = G5_DATA_PATH.'/member/'.substr($row['co_mb_id'],0,2).'/'.$row['co_mb_id'].'.jpg';
                                                $mb_icon_url  = G5_DATA_URL.'/member/'.substr($row['co_mb_id'],0,2).'/'.$row['co_mb_id'].'.jpg';

                                                if(file_exists($mb_icon_path)) { ?>
                                                    <img src="<?php echo $mb_icon_url ?>">
                                                <?php } else { ?>
                                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/thm29.jpg"> <!-- 디폴트 이미지 -->
                                                <?php } ?>
                                            </div><!--서비스 썸네일 추출-->
                                            <div class="info">
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span><?=$mb['mb_nick']?> <span class="date_inquiry"><?=date('Y.m.d H:i',strtotime($row['co_wr_datetime']))?></span></div>
                                                <div class="txt" style="white-space: pre-wrap"><?= $row['wr_content']?></div> <!-- 리뷰내용최대3줄추출 -->
                                                <div class="btn_gr">
                                                        <ul>
                                                            <li><a href="<?=G5_BBS_URL?>/item_view.php?idx=<?=$row['ta_idx']?>">재능 글 확인</a></li>
                                                            <?php if ($member['mb_division'] == 2){ ?>
                                                            <li><a onclick="toggle_visibility('reply_<?=$row["comment_idx"]?>');">답변</a></li>
                                                            <li><a href="javascript:competition_comment_del(<?=$row["comment_idx"]?>)">삭제</a></li>
                                                            <?php } ?>
                                                        </ul>
                                                </div>
                                                <div id="reply" name = "reply_<?=$row['comment_idx']?>" style="display: none">
                                                    <section class="cmt">
                                                        <input type="hidden" name="wr_num" id="wr_num_<?=$row['comment_idx']?>" value="<?=$row['wr_num']?>">
                                                        <textarea name="competition_comment_<?=$row['comment_idx']?>" id="competition_comment_<?=$row['comment_idx']?>" required="" maxlength="5000" placeholder="답변을 입력해주세요"></textarea>
                                                        <input type="button" onclick="competition_comment_update(<?=$row['comment_idx']?>,<?=$row['ta_idx']?>,'<?=$row['ta_title']?>','<?=$mb['mb_id']?>')" id="cmt_btn_submit" value="답변입력" accesskey="s">
                                                    </section>
                                                </div>
                                                <div id="reply_div_<?=$row['comment_idx']?>">
                                                    <?php $sql = "select * from new_comment where wr_parent = '{$row['comment_idx']}' and wr_table = 'talent' order by comment_idx desc;";
                                                    $reply_result =sql_query($sql);
                                                    for ($i = 0; $reply = sql_fetch_array($reply_result); $i++){ ?>

                                                        <div class="reply">
                                                            <?= $reply['wr_content'] ?>
                                                            <?php if ($member['mb_id'] == $reply['mb_id'] && $member['mb_division'] == 2) { ?>
                                                            <a href="javascript:competition_comment_del(<?=$reply['comment_idx']?>,'one')"><span style="float: right">삭제</span></a>
                                                            <?php }?>
                                                        </div>

                                                    <?php }?>
                                                </div>
												<script type="text/javascript">
                                                <!--
                                                    function toggle_visibility(id) {
                                                       var e = document.getElementsByName(id)[0];
                                                       if(e.style.display == 'block')
                                                          e.style.display = 'none';
                                                       else
                                                          e.style.display = 'block';
                                                    }
                                                //-->
                                                </script>
                                            </div>
                                        </a>
                                    </div>
                                    <?php }
                                    }else{ ?>
                                        <div class="text-center empty_list">
                                            <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                            <p class="t_padding17">문의글이 없습니다.</p>
                                        </div>
                                    <?php } ?>
                                </div><!--rev-->
                            </div><!--in-->
                          <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

                      </div>
        </section>

</article>
<script>

    $(document).ready(function () {

        <?php if (isset($my_like_cnt['cnt'])&&$my_like_cnt['cnt'] == 0&&!$member['mb_division'] == 2&!$is_admin){?>
        $('#tab-content1').html(div_html('찜한 재능이 없습니다.'));
        <?php } ?>

    });

    function competition_comment_update(idx,ta_idx,ta_title,co_mb_id) {

        var content = $('#competition_comment_'+idx).val();
        var num = $('#wr_num_'+idx).val();

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.competition.php",
            data: {
                "mode" : "competition_comment_update",
                "wr_content": content,
                "wr_cp_idx": ta_idx,
                "wr_parent": idx,
                "wr_num": num,
                "mb_id": co_mb_id,
                "talent_title": ta_title,
                "alim_mode": 'comment_reply',
                "wr_table": "talent"
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data['msg'] != 'success'){
                    swal(data['msg']);
                }else{
                    if (idx != 0){
                        competition_comment_list(idx);
                    }else{
                        location.href = location.href;
                    }
                }


            }
        });
    }

    function competition_comment_list(idx) {

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.competition.php",
            data: {
                "mode" : "competition_comment_list",
                "idx": idx,
                "wr_table": 'talent',

            },
            dataType: "html",
            success: function(data) {

                $('#reply_div_'+idx).html(data);
                $('#competition_comment_'+idx).val('');


            }
        });
    }


    function competition_comment_del(idx,type) {

        if (!confirm("문의사항을 삭제하시겠습니까?")){
            return false;
        }

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.competition.php",
            data: {
                "mode" : "competition_comment_del",
                "idx": idx,
                "wr_table": "talent",
                "type": type,

            },
            success: function(data) {

                if (data == 1){
                    swal('문의사항이 삭제되었습니다.')
                        .then(function(){
                            location.href = location.href
                        });
                }

            }
        });
    }
</script>