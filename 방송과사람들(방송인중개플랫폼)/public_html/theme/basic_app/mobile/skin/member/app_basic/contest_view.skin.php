<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style_pro.css">', 0);
$url = "";
?>
<link rel="stylesheet" href="<?= $member_skin_url?>/competition.css">

<style>
    .box-article .box-body .row{ background:#fff}
    .tab-content {
        display: none;
        float: left;
        width: 100%;
        padding: 0 0 1em 0;
        background:#fff;
    }
    #item_review{ padding:0}
    #item_review .info .nick {
        color: #555;
        font-size: 1.13em;
        margin:0 0 10px;
        font-weight:500;
    }
</style>

<!-- 프로젝트 참여 MODAL -->
<?php if($is_member){ ?>
    <div class="modal fade" id="Participation" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"><i class="fal fa-cog fa-spin"></i>&nbsp;프로젝트 참여하기</h4>
                </div>

                <div class="modal-body">
                    <div id="pro_step">

                        <!--등록 폼 시작-->
                        <div class="in">
                            <form id="applyfrm" method="post">
                                <input type="hidden" id="ap_cp_idx" name="ap_cp_idx" value="<?=$cp_idx?>">

                                <div class="form-group">
                                    <label for="test01">의뢰인에게 하시고 싶으신 말씀을 입력하세요</label>
                                    <div class="txt_bx">
                                        <textarea name="ap_content" id="ap_content" class="form-control txt doc_text" rows="5" placeholder="프로젝트 관련 의뢰인에게 하시고 싶으신 말씀을 입력하세요."></textarea>
                                        <div class="text_limit"><span id="ap_content_count">0</span> / 최소 100자</div>
                                        <!--텍스트입력시 카운트가 올라감-->
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group">
                                    <h2 class="title">원본 첨부하기</h2>
                                    <div class="img_up">
                                        <strong class="tit">원본 파일 등록</strong><a data-toggle="modal" data-target="#myModal_mg1" class="img_tip">TIP!</a>
                                        <div class="size">파일을 등록해주세요.</div>
                                        <div style="margin: 20px 0">
                                            <input type="file" name="bf_file[]">
                                        </div>
                                    </div><!--img_up-->

                                    <?php /* <div class="img_up">
                                    <strong class="tit">캡쳐 이미지 첨부하기</strong><a data-toggle="modal" data-target="#myModal_mg2" class="img_tip">TIP!</a>
                                    <div class="size">원본파일의 캡쳐본을 등록해주세요.<strong class="img_limit"><span id="cap_count">0</span> / 3</strong></div>
                                    <ul class="mainType" id="mainType_img">
                                        <div id="prev_area">

                                        </div>
                                        <li onClick="file_add()" class="addFiles" id="li_list_img"></li><!--이미지 등록 전-->
                                    </ul>
                                </div><!--img_up--> */?>
                                </div>


                            </form>
                        </div><!--in-->


                    </div>
                </div>

                <div class="modal-footer">
                    <div class="f_save cf">
                        <div class="arr"><a href="javascript: form_ajax()" class="btn btn-default">등록완료</a></div>
                    </div><!--f_save-->
                    <!--저장 부분-->
                    <?php /*?><button type="button" class="btn btn-default" data-dismiss="modal">창닫기</button><?php */?>
                </div>
            </div><!--//modal-content-->
        </div>
    </div>
    <!-- //프로젝트 참여 MODAL -->
<?php } ?>

<?php if ($member['mb_id'] == $row['mb_id'] || $member['mb_id'] == 'admin' || sql_num_rows($apply_my_result) > 0){ ?>
    <!-- 프로젝트 참여자 확인 MODAL -->
    <div class="modal fade" id="Participation_mem" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <span id = "html1"><h4 class="modal-title"><i class="fas fa-user-circle"></i>&nbsp;신박한 재능인<span>2021.02.20</span></h4></span>
                </div>

                <div class="modal-body">
                    <div id="partici_mem">

                        <!--등록 폼 시작-->
                        <div class="in">
                            <div class="form-group">
                                <p class="tit_mem">의뢰인에게 코멘트를 남기셨습니다.</p>
                                <div class="txt_bx_comm">
                                    <p id="html2"></p>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group">
                                <div class="img_up">
                                    <strong class="tit">원본 파일</strong>
                                    <div class="size">파일을 다운 받으세요.</div>
                                    <div class="box-article">
                                        <div class="box-body">
                                            <dl class="row">
                                                <dd>
                                                    <ul id="html3">
                                                    </ul>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div><!--img_up-->

                                <?php /* <div class="img_up">
                                    <strong class="tit">캡쳐 이미지</strong>
                                    <div class="sameple_capture">
                                        <ul id="html4">
                                              <li><img src="http://www.jobgo.ac/data/file/competition_sub/3076986471__facf0b3effb6d92ea476103a25a35de5f3c693d0.jpg"></li>
                                              <li><img src="http://www.jobgo.ac/data/file/competition_sub/3076986471__facf0b3effb6d92ea476103a25a35de5f3c693d0.jpg"></li>
                                              <li><img src="http://www.jobgo.ac/data/file/competition_sub/3076986471__facf0b3effb6d92ea476103a25a35de5f3c693d0.jpg"></li>
                                        </ul>
                                    </div>
                                </div><!--img_up--> */?>
                            </div>
                        </div><!--in-->

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">창닫기</button>
                </div>
            </div><!--//modal-content-->
        </div>
    </div>
    <!-- //프로젝트 참여자 확인 MODAL -->
<?php } ?>

<article id="contest_view">

    <header>
        <div id="contest">
            <div class="inr">
                <div class="list cf">
                    <div class="thm">
                        <div class="mg">
                            <!--<span class="pri">PRIME</span>prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                            <div class="heart" id="heart_div_<?=$row['cp_idx']?>">
                                <?php if (isset($like_row)){?>
                                <?php }else{?>
                                    <button type="button" class="heart off" onclick="like_chk('on',<?=$row['cp_idx']?>,'competition')"><i class="fa-light fa-heart"></i></button><!--좋아요 누르기전-->
                                <?php } ?>
                            </div>
                            <div class="mg_in">
                                <div class="over">
                                    <?php
                                    $main_file = G5_DATA_PATH.'/file/competition/'.$main_result['bf_file'];
                                    if (file_exists($main_file) && $main_result['bf_file'] != "") {
                                        $html = "<img src = '" . G5_DATA_URL . "/file/competition/" . $main_result['bf_file'] . "'>";

                                    }else{
                                        $html =  "<div class='no_img'>로고 이미지가 없습니다.</div>";
                                    }
                                    echo $html;
                                    ?>

                                </div>
                            </div><!--클라이언트 로고-->
                        </div><!--mg-->
                        <div class="info">
                            <!-- 재능강의 작성자 정보 -->
                            <div id="lecture_writer_list">
                                <div class="mb">
                                    <div class="mb_info">
                                        <p><i class="fas fa-user-circle"></i>&nbsp;<?=$row['cp_company_name'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tit"><?= $row['cp_title']?></div><!--프로젝트 제목(최대1줄까지만 추출, 나머지는 ... 처리함)-->
                            <div class="cont"><?= $row['cp_company_explain']?></div><!--프로젝트 설명(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                            <div class="rate cf">
                                <div class="star"><span><i class="fal fa-eye"></i> <?=number_format($row['hit']) ?> 회</span><span><?=comp_apply_cnt($row['cp_idx'])?>명의 참여자</span></div>
                                <div class="heart_hit"><span><i class="fal fa-calendar-week"></i></span> <?=$progress_list[$row['cp_progress']] ?> (~<?= date('Y-m-d',strtotime($row['cp_datetime'])) ?>) </div><!--심시기간-->
                            </div>
                            <div class="price">희망 제작비용 <?= number_format($row['cp_reward']) ?>만원</div><!--상품가격-->
                        </div>
                    </div>
                </div><!--list-->
            </div><!--in-->
        </div><!--//contest-->
    </header>

    <div class="wrapper inr">
        <div class="tabs cf">
            <input name="tabs" id="tab1" checked="" type="radio">
            <label for="tab1">프로젝트 의뢰 내용</label>
            <input name="tabs" id="tab2" type="radio">
            <label for="tab2">프로젝트 참여<?php if ($member['mb_id'] == $row['mb_id'] || $member['mb_id'] == 'admin' ){ ?><span class="badge"><?= comp_apply_cnt($row['cp_idx'])?></span><?php } ?></label>
            <input name="tabs" id="tab3" type="radio">
            <label for="tab3">문의사항<span class="badge"><?=sql_num_rows($comment_result)?></span></label>

            <!--프로젝트 내용-->
            <div id="tab-content1" class="tab-content">
                <div class="contest_cont">

                    <section>
                        <h3><i class="far fa-newspaper"></i> 프로젝트 의뢰내용</h3>
                        <div class="cont client">
                            <dl>
                                <dt>제목</dt>
                                <dd><?=$row['cp_title']?></dd>
                            </dl>
                            <dl>
                                <dt>클라이언트 명</dt>
                                <dd><?=$row['cp_company_name']?></dd>
                            </dl>
                            <dl>
                                <dt>서비스 설명</dt>
                                <dd><?=$row['cp_company_explain']?></dd>
                            </dl>
                        </div>
                    </section>

                    <section>
                        <h3><i class="fal fa-images"></i> 참고할 자료가 있으신가요?<span>(최대 3작품 선택)</span></h3>
                        <div class="cont sample">

                            <ul>

                                <?php
                                for($i = 0; $img = sql_fetch_array($sub_result); $i++){
                                    $sub_file = G5_DATA_PATH.'/file/competition_sub/'.$img['bf_file'];
                                    if (file_exists($sub_file) && $img['bf_file'] != "") {
                                        $html = "<li><img src = '" . G5_DATA_URL . "/file/competition_sub/" . $img['bf_file'] . "'></li>";
                                        echo $html;
                                    }
                                }
                                if ($i == 0){
                                    echo "<li>작품없음</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </section>

                    <section>
                        <h3><i class="fal fa-images"></i> 원하시는 관련키워드를 선택해주세요.</h3>
                        <div class="cont">
                            <?php
                            $arr = explode(',',$row['cp_logo_sty']);

                            if ($row['cp_logo_sty'] == ""){
                                $arr[0] = "없음";
                            }
                            for ($a = 0; $a < count($arr); $a++){ ?>
                                <span class="hash"><?=$arr[$a]?></span>
                            <?php } ?>
                        </div>
                    </section>

                    <section>
                        <h3><i class="fal fa-folder-tree"></i> 프로젝트 상세내용</h3>
                        <div class="cont" style="white-space: pre-wrap;"><?=$row['cp_logo_content']?></div>
                    </section>
                </div><!--//contest_cont-->
            </div>

            <!--프로젝트 참여-->
            <div id="tab-content2" class="tab-content">
                <?php if ($member['mb_id'] == $row['mb_id'] || $member['mb_id'] == 'admin' ){ ?>
                    <div class="contest_cont partici">
                        <!--참여인원 리스트-->
                        <ul>
                            <?php
                            if(sql_num_rows($apply_result) > 0){
                            for ($i = 0; $apply_row = sql_fetch_array($apply_result); $i++){
                                $apply_mem = get_member($apply_row['mb_id']);

                                $sql = "select * from {$g5['board_file_table']} where bo_table = 'comp_apply_capture' and wr_id = '{$apply_row['ap_idx']}' and bf_no = 0 ";
                                $file = sql_fetch($sql);
                                ?>
                                <li>
                                    <dl>
                                        <a href="javascript:comp_apply_view_modal(<?=$apply_row['ap_idx']?>);">
                                            <?php if (file_exists(G5_DATA_PATH.'/file/comp_apply_capture/'.$file['bf_file']&& $file['bf_file'] != "")){
                                                $url = G5_DATA_URL.'/file/comp_apply_capture/'.$file['bf_file'];
                                            }else{
                                                $url = G5_THEME_IMG_URL.'/sub/default.png';
                                            }?>
                                            <div class="mem_area" style="background:url(<?=$url?>) no-repeat center center; background-size:; background-color:#A8A8A8">
                                                <?php //우승자 트로피
                                                if ($row['cp_win_apply'] == $apply_row['ap_idx'] ){?>
                                                    <div class="trophy"></div>
                                                <?php }?>
                                            </div>
                                        </a>
                                        <?php if($row['cp_win_apply'] == '0' || $row['cp_win_apply'] == ''){?>
                                            <input type="radio" style="display: inline!important;" name="comp_win" value="<?=$apply_row['ap_idx']?>">
                                        <?php } ?>
                                        <i class="fas fa-user-circle"></i>&nbsp;<?= $apply_mem['mb_id'] ?>
                                        <dd class="date"><?= date("Y.m.d", strtotime($apply_row['wr_datetime']))?></dd>
                                    </dl>
                                </li>
                            <?php }?>

                        </ul>
                        <?php }else{ ?>
                            <div class="text-center empty_list" style="margin-top: 30px">
                                <i class="far fa-image-polaroid fa-4x"></i>
                                <p class="t_padding17">프로젝트 참여자가 없습니다. </p>
                            </div>

                        <?php }?>
                    </div><!--//contest_cont-->
                <?php }else{ ?>
                    <?php if (($row['cp_win_apply'] == '0' || $row['cp_win_apply'] == '')&&
                        $row['cp_progress'] == 1){ ?>
                        <div class="text-center empty_list" style="margin-top: 30px">
                            <i class="far fa-eye-slash fa-4x"></i>
                            <p class="t_padding17">현재 진행 중인 콘테스트의 참여작은 <br />개최 의뢰자만 확인 가능합니다.</p>
                        </div>
                    <?php }else{
                        if (sql_num_rows($apply_my_result) == 0){ ?>
                            <div class="text-center empty_list" style="margin-top: 30px">
                                <i class="far fa-eye-slash fa-4x"></i>
                                <p class="t_padding17">공모작 참가가 마감된 게시물 입니다.</p>
                            </div>
                        <?php }else{ ?>
                            <div class="contest_cont partici">
                                <ul>
                                    <?php for ($i = 0; $apply_my_row = sql_fetch_array($apply_my_result); $i++){
                                        $apply_mem = get_member($apply_my_row['mb_id']);

                                        $sql = "select * from {$g5['board_file_table']} where bo_table = 'comp_apply_capture' and wr_id = '{$apply_my_row['ap_idx']}' and bf_no = 0 ";
                                        $file = sql_fetch($sql); ?>

                                        <li>
                                            <dl>
                                                <a href="javascript:comp_apply_view_modal(<?=$apply_my_row['ap_idx']?>);">
                                                    <?php if (file_exists(G5_DATA_PATH.'/file/comp_apply_capture/'.$file['bf_file']) && $file['bf_file'] != "" ){
                                                        $url = G5_DATA_URL.'/file/comp_apply_capture/'.$file['bf_file'];
                                                    }else{
                                                        $url = G5_THEME_IMG_URL.'/sub/default.png';
                                                    }?>
                                                    <div class="mem_area" style="background:url(<?=$url?>) no-repeat center center; background-size:cover">
                                                        <?php //우승자 트로피
                                                        if ($row['cp_win_apply'] == $apply_my_row['ap_idx'] ){?>
                                                            <div class="trophy"></div>
                                                        <?php }?>
                                                        <? /* php if (file_exists(G5_DATA_PATH.'/file/comp_apply_capture/'.$file['bf_file'])) { */ ?>
                                                        <!--<img src="<?=G5_DATA_URL.'/file/comp_apply_capture/'.$file['bf_file']?>" class="mem_area">-->
                                                        <? /* php }else{ */ ?>
                                                        <!--<img src="<?=G5_DATA_URL.'/file/comp_apply_capture/'.$file['bf_file']?>" class="mem_area">-->
                                                        <? /* php } */ ?>
                                                    </div>
                                                </a>
                                                <?php if($row['cp_win_apply'] == '0' || $row['cp_win_apply'] == ''){?>
                                                    <input type="radio" style="display: inline!important;" name="comp_win" value="<?=$apply_my_row['ap_idx']?>">
                                                <?php } ?>
                                                <i class="fas fa-user-circle"></i>&nbsp;<?= $apply_mem['mb_nick'] ?>
                                                <dd class="date"><?= date("Y.m.d", strtotime($apply_my_row['wr_datetime']))?></dd>
                                            </dl>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <div class="btn_partici text-right">
                    <?php if (($member['mb_id'] == $row['mb_id'] || $member['mb_id'] == 'admin') && $row['cp_win_apply'] == '0' || $row['cp_win_apply'] == '' ){ ?>
                        <a href="javascript:comp_win_idx(<?=$row['cp_idx']?>)"><i class="far fa-trophy-alt"></i> 당선자 선정</a>
                    <?php } ?>
                    <?php
                    //프로젝트 작성자가 아니고, 당선작이 정해지지 않았고, 마감기간이 전 일 경우
                    if ( $member['mb_id'] != $row['mb_id'] &&
                        ($row['cp_win_apply'] == '0' || $row['cp_win_apply'] == '')&&
                        $row['cp_progress'] == 1
                    ){ ?>
                        <a href="javascript:comp_apply_modal()">프로젝트 참여하기</a>
                    <?php } ?>
                    <?php if ( $row['cp_progress'] == '3' && $member['mb_id'] == $row['mb_id'] ){ ?>
                        참여자에게 금액이 지급완료되었습니다.
                    <?php } ?>
                    <!--                    --><?php //if ( $row['cp_progress'] == '4' && $member['mb_id'] == $row['mb_id'] ){ ?>
                    <!--                       수상자에게 상금이 지급 완료되었습니다.-->
                    <!--                    --><?php //} ?>
                </div>
            </div>

            <!--참여작 보기-->
            <div id="tab-content3" class="tab-content">
                <div class="contest_cont">

                    <section class="cmt">
                        <textarea name="competition_comment_0" id="competition_comment_0" required="" maxlength="5000" placeholder="문의사항을 입력해주세요"></textarea>
                        <input type="button" onclick="competition_comment_update('0')" id="cmt_btn_submit" value="댓글입력" accesskey="s">
                        <p>*관련 문의사항만 등록해 주세요. 불만, 비방성 댓글은 의뢰자나 관리자에 의해 경고 없이 삭제될 수 있으며, 사이트 이용 제한이 발생할 수 있습니다.</p>
                    </section>

                    <section>
                        <!--<h3><i class="fal fa-images"></i> 프로젝트 문의사항 <span>(4)</span></h3>-->
                        <div id="item_review">
                            <div class="in">
                                <div class="rev cf">
                                    <?php if (sql_num_rows($comment_result) == 0){?>

                                        <div class="text-center empty_list">
                                            <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                            <p class="t_padding17">등록된 문의사항이 없습니다.</p>
                                        </div>

                                    <?php }
                                    for ($i = 0; $comment = sql_fetch_array($comment_result); $i++){
                                        $mb = get_member($comment['mb_id']);

                                        $mb_icon_path = G5_DATA_PATH.'/member/'.substr($mb['mb_id'],0,2).'/'.$mb['mb_id'].'.jpg';
                                        $mb_icon_url  = G5_DATA_URL.'/member/'.substr($mb['mb_id'],0,2).'/'.$mb['mb_id'].'.jpg';
                                        ?>
                                        <div class="list cf">
                                            <a href="javascript:;">
                                                <div class="mg">
                                                    <?php if (file_exists($mb_icon_path)){?>
                                                        <img src="<?php echo $mb_icon_url ?>">
                                                    <?php }else{ ?>
                                                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/default.png">

                                                    <?php } ?>
                                                </div><!--서비스 썸네일 추출-->
                                                <div class="info">
                                                    <div class="nick"><span><i class="fas fa-user-circle"></i></span><?=$mb['mb_nick']?></div><!--닉네임 일부분 노출-->
                                                    <div class="txt" style="white-space: pre-wrap"><?= $comment['wr_content'] ?></div>
                                                    <div class="date">
                                                        <div class="star"><?= date('Y.m.d H:i',strtotime($comment['wr_datetime'])) ?></div>
                                                    </div>
                                                    <div class="btn_gr">
                                                        <ul>
                                                            <?php if ($row['mb_id'] == $member['mb_id']){ ?>
                                                                <!--                프로젝트 글쓴이와 로그인 아이디가 일치할경우               -->
                                                                <li><a onclick="toggle_visibility('reply_<?=$comment["comment_idx"]?>');">답변</a></li>
                                                            <?php } ?>

                                                            <?php if ( $mb['mb_id'] == $member['mb_id'] || $row['mb_id'] == $member['mb_id']){ ?>
                                                                <li><a href="javascript:competition_comment_del(<?=$comment["comment_idx"]?>)">삭제</a></li>
                                                            <?php } ?>

                                                        </ul>

                                                    </div>
                                                    <div id="reply_div_<?=$comment['comment_idx']?>">
                                                        <?php $sql = "select * from new_comment where wr_parent = '{$comment["comment_idx"]}' order by comment_idx desc;";
                                                        $reply_result =sql_query($sql);
                                                        for ($i = 0; $reply = sql_fetch_array($reply_result); $i++){ ?>

                                                            <div class="reply">
                                                                <?= $reply['wr_content'] ?>
                                                                <?php if ( $reply['mb_id'] == $member['mb_id'] || $row['mb_id'] == $member['mb_id']){ ?>
                                                                    <a href="javascript:competition_comment_del(<?=$reply["comment_idx"]?>)"><span style="float: right">삭제</span></a>
                                                                <?php }?>
                                                            </div>

                                                        <?php }?>
                                                    </div>
                                                    <div id="reply_<?=$comment['comment_idx']?>" style="display: none">
                                                        <section class="cmt">
                                                            <input type="hidden" name="wr_num" id="wr_num_<?=$comment['comment_idx']?>" value="<?=$comment['wr_num']?>">
                                                            <textarea name="competition_comment_<?=$comment['comment_idx']?>" id="competition_comment_<?=$comment['comment_idx']?>" required="" maxlength="5000" placeholder="답변을 입력해주세요"></textarea>
                                                            <input type="button" onclick="competition_comment_update(<?=$comment['comment_idx']?>)" id="cmt_btn_submit" value="답변입력" accesskey="s">
                                                        </section>
                                                    </div>
                                                </div>

                                            </a>
                                        </div>
                                    <?php } ?>
                                </div><!--rev-->
                            </div><!--in-->
                            <?php if ($qna_cnt > 10){?>
                                <div class="review_more"><a href="">더 보기</a></div>
                            <?php } ?>
                        </div>
                    </section>
                </div><!--//contest_cont-->
            </div>

        </div><!--//tabs-->
    </div>

</article>

<script type="text/javascript">

    var subfilesTempArr  = [];
    $(document).ready(function () {
        <?php if ($_REQUEST['tab'] != "") { ?>
        $('#tab<?=$_REQUEST['tab']?>').prop("checked", true);
        <?php } ?>
    });

    function toggle_visibility(id) {
        var e = document.getElementById(id);
        if(e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
    }

    $("input:radio[name='tabs']:radio[value='tab3']").prop("checked", true);

    function competition_comment_update(idx) {

        var content = $('#competition_comment_'+idx).val();
        var num = $('#wr_num_'+idx).val();

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.competition.php",
            data: {
                "mode" : "competition_comment_update",
                "wr_content": content,
                "wr_cp_idx": <?=$row['cp_idx']?>,
                "wr_parent": idx,
                "wr_num": num,
                "wr_table": "competition",
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
                        location.href = g5_bbs_url +"/contest_view.php?idx="+ <?=$row['cp_idx']?> +"&tab=3"
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
                "wr_table": 'competition',

            },
            dataType: "html",
            success: function(data) {

                $('#reply_div_'+idx).html(data);
                $('#competition_comment_'+idx).val('');


            }
        });
    }


    function competition_comment_del(idx) {

        if (!confirm("문의사항을 삭제하시겠습니까?")){
            return false;
        }

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.competition.php",
            data: {
                "mode" : "competition_comment_del",
                "idx": idx,
                "wr_table": "competition"
            },
            success: function(data) {

                if (data == 1){
                    swal('문의사항이 삭제되었습니다.')
                        .then(function(){
                            location.href = g5_bbs_url +"/contest_view.php?idx="+ <?=$row['cp_idx']?> + "&tab=3"
                        });
                }

            }
        });
    }

    var file_idx = 0;
    function file_add() {
        var leng = $(".btn_del").size();
        var input_id = "image" + file_idx;


        upload = $('<input type="file" name="image[]" class="frm_file" id="'+input_id+'" multiple onchange="getImgPrev(this)" accept="image/*" >');

        if (leng < 3) {
            // $("#" + id + "file_input").after(upload);
            upload.trigger('click');
            // file_idx++;

        } else {
            alert("최대 3장까지 등록 가능합니다.");
            return false;
        }
    }

    var box_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    //이미지 미리보기
    function getImgPrev(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;
        var leng = $(".btn_del").size();
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);
        var count = 3;


        if (leng + input.files.length > count) {
            swal('최대 '+count+'개까지 등록 가능 합니다.');
            return false
        }
        //이미지 현재 개수에 파일 추가 하는 것 만큼 더해주기
        $('#cap_count').html($('#cap_count').text()*1+input.files.length);

        for (var i = 0; i < input.files.length; i++) {
            // img_idx++;

            var file_name = input.files[i].name.toLowerCase();
            if (!reg_ext.test(file_name)) {
                swal("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
                return false;
            }

            subfilesTempArr.push(files_arr[i]);

            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    box_idx++;
                    idx = box_idx;


                    var html = "<li id ='p_box_" + idx + "'><a href=\"javascript:;\">";
                    html += "<div class=\"img\"><img src='" + e.target.result + "' alt=\"\"></div>"
                    html += "<div onclick='btn_image_del(this)' id ='btn_del_" + (idx) + "' class='del btn_del'><img src=\"<?php echo G5_THEME_IMG_URL ?>/main/btn_sfile_del.png\" alt='삭제'></div>";
                    html += "</a></li>"
                    $('#prev_area').append(html);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
        // console.log(filesTempArr)
    }

    function btn_image_del(f) {
        var btn_del = document.getElementById(f.id),
            file_idx = btn_del.id.split('_');
        //splice하면 index꼬여서 delete처리함.

        delete subfilesTempArr[(file_idx[2] - 1)];

        //파일 딜리트하면 현재개수에서 -1
        $('#cap_count').html($('#cap_count').text()-1);

        $('#p_box_' + file_idx[2]).html('');
        $('#p_box_' + file_idx[2]).css('display', 'none');
    }

    $('.doc_text').keyup(function (e) {
        var content = $("textarea#"+this.id).val();
        $('#'+this.id+'_count').text("" + content.length); // 글자 수 실시간 카운팅

        if(this.id.indexOf('content') != -1) { // 설명
            console.log(content.length );
            if (content.length > 100) {
                swal("최대 100자까지 입력 가능합니다.");
                var content_slice = content.slice(0, 100);
                $("textarea#"+this.id).val(content_slice);
                $('#'+this.id+'_count').text("100");
            }
        }


    });

    var is_post = false;
    function form_ajax() {
        var form = $('#applyfrm')[0];
        var formData = new FormData(form);

        var msg = "등록완료 시 수정이 불가능합니다. \n 현재 내용으로 프로젝트 참여하시겠습니까?"

        if(!confirm(msg)) {
            return false;
        }

        if (is_post) {
            swal("참여하기 진행 중입니다. 잠시만 기다려 주세요.");
            return false;
        }
        is_post = true;

        //메인 사진은 하나만 담기
        // formData.append("bf_file[]", filesTempArr[filesTempArr.length-1]);

        for (var i = 0; i < subfilesTempArr.length; i++) {
            formData.append("subbf_file[]", subfilesTempArr[i]);
        }

        formData.append("mode", "comp_apply_form");
        // formData.append("update_sub_idx", update_sub_idx);



        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.competition.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            datatype: 'json',
            success: function (data) {
                if (data == 1) {
                    swal("프로젝트 등록이 완료되었습니다.")
                        .then(() => {
                            location.href = g5_bbs_url +"/contest_view.php?idx=<?=$cp_idx?>"
                        });

                } else {
                    is_post = false;
                    alert("통신에 실패했습니다.");
                }
            },
            err: function (err) {
                is_post = false;
                alert(err.status);
            }
        });

    }

    //프로젝트 참여하기 누를 시 로그인 안하면 팅겨냄
    function comp_apply_modal() {

        if(!g5_is_member){
            swal("회원이 아닙니다. 로그인 후 참여하기가 가능합니다.")
                .then(() => {
                    location.href = g5_bbs_url + '/login.php';
                });
        }else{
            $("#Participation").modal();

        }
    }

    //modal 뷰 보기
    function comp_apply_view_modal(idx) {

        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.competition.php",
            data: {"idx" : idx, "mode": "comp_apply_view_modal" },
            type: 'POST',
            datatype: 'json',
            success: function (data) {
                data = JSON.parse(data);
                var length = 4
                console.log(data);
                for (var i = 1; i <= length; i++){
                    $("#html"+i).html(data['html'+i]);
                }

                $("#Participation_mem").modal();

            },
            err: function (err) {

                alert(err.status);
            }
        });


    }

    //당선작 선정
    function comp_win_idx(idx) {

        var write_id = '<?=$row["mb_id"]?>';
        var apply_idx = $('input[name="comp_win"]:checked').val();

        if (apply_idx == "" || apply_idx == undefined){
            swal("당선작을 선택해주세요.");
            return false;
        }

        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.competition.php",
            data: {"idx" : idx, "apply_idx":apply_idx,"mode": "comp_win_idx", "write_id":write_id  },
            type: 'POST',
            datatype: 'json',
            success: function (data) {
                if(data == 1){
                    swal("당선작 선정이 완료되었습니다.")
                        .then(() => {
                            location.href = g5_bbs_url + '/contest_view.php?idx=<?=$cp_idx?>';
                        });
                }else{
                    swal("통신 오류입니다.");
                }
            },
            err: function (err) {

                alert(err.status);
            }
        });

    }

    //지급
    function pay_update(idx) {

        if (!confirm("수상자에게 금액을 지급하시겠습니까?")){
            return false;
        }

        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.competition.php",
            data: {"idx" : idx,"mode": "comp_pay_update"},
            type: 'POST',
            datatype: 'json',
            success: function (data) {
                if(data == 1){
                    swal("금액이 지급완료 되었습니다.")
                        .then(() => {
                            location.href = g5_bbs_url + '/my_contest.php';
                        });
                }else{
                    swal("통신 오류입니다.");
                }
            },
            err: function (err) {

                alert(err.status);
            }
        });

    }




</script>