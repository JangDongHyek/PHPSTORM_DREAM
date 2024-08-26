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
</style>


<!--마이페이지-->

<article id="mypage">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>


        <section id="right_view">
            <h3>공모전 관리</h3>

            <div class="wrapper">
                <div class="tabs cf">
                    <ul>
                        <li id="tab1"><a href="<?php echo G5_BBS_URL ?>/my_contest.php?tab=1">등록한 공모전<span class="badge"><?=$write_total?></span></a></li>
                        <li id="tab2"><a href="<?php echo G5_BBS_URL ?>/my_contest.php?tab=2">참여한 공모전<span class="badge"><?=$apply_total?></span></a></li>
                        <li id="tab3"><a href="<?php echo G5_BBS_URL ?>/my_contest.php?tab=3">찜한 공모전<span class="badge"><?=$like_total?></span></a></li>
                    </ul>
                
                    <!--<input name="tabs" id="tab1" type="radio">
                    <label onclick="a_tab('1')" for="tab1">등록한 공모전<span class="badge"><?=$write_total?></span></label>
                    <input name="tabs" id="tab2" type="radio">
                    <label onclick="a_tab('2')" for="tab2">참여한 공모전<span class="badge"><?=$apply_total?></span></label>
                    <input name="tabs" id="tab3" type="radio">
                    <label onclick="a_tab('3')" for="tab3">찜한 공모전<span class="badge"><?=$like_total?></span></label>-->

                    <!--등록한 공모전-->
                    <div id="tab-content1" class="tab-content">
                    
                         <!--리스트-->
                         <div id="my_contest">
                            <div class="in">
                                <div class="list cf">
                            <?php
                                if ($write_total > 0){
                                    for ($i = 0; $write = sql_fetch_array($write_comp); $i++){
                                        //진행상황 변경(날짜가 지났을 경우 심사 중 처리 - view로 들어갈 경우 update되서.)
                                        if (G5_TIME_YMD >= date('Y-m-d', strtotime($write['cp_datetime'])) && $write['cp_progress'] < 2 ) {
                                            $write['cp_progress'] = 2;
                                        } ?>
                                    <div class="thm">
                                            <div class="mg">
                                                <!--<span class="pri">PRIME</span>prime 광고등록 상품은 해당 아이콘이 뜨도록-->

                                                <div class="mg_in">
                                                     <div class="over">
                                                        <?php $sql = "select * from {$g5['board_file_table']} where wr_id = {$write['cp_idx']} and bo_table = 'competition_main' ";
                                                            $img = sql_fetch($sql);
                                                            $img_file = G5_DATA_PATH.'/file/competition_main/'.$img['bf_file'];
                                                            if (file_exists($img_file) && $img['bf_file'] != ""){
                                                                echo '<img src="'. G5_DATA_URL.'/file/competition_main/'.$img['bf_file'].'">';
                                                            }else{
                                                               // echo '<img src="'. G5_THEME_IMG_URL.'/main/heart_on.png">';
                                                                  echo "<div class='no_img'>로고 이미지가 없습니다.</div>";
                                                            }
                                                        ?>
                                                    </div>
                                                </div><!--클라이언트 로고-->
                                        </div><!--mg-->
        
                                        <a href="<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$write['cp_idx']?>">
        
                                        <div class="info">
                                                <!-- 재능강의 작성자 정보 -->
                                                <div class="btn_gr02">
                                                                <ul>
                                                                    <li onclick="location.href='<?php echo G5_BBS_URL; ?>/register_contest.php?idx=<?=$write['cp_idx']?>'">수정</li>
                                                                    <li onclick="location.href='<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$write['cp_idx']?>'">보기</li>
                                                                </ul>
                                                </div>
                                                <div id="lecture_writer_list">
                                                            <div class="mb">
                                                                <div class="mb_info">
                                                                    <p><i class="fas fa-user-circle"></i>&nbsp;<?=$write['cp_company_name']?></p>
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="tit"><?=$write['cp_title']?></div><!--공모전 제목(최대1줄까지만 추출, 나머지는 ... 처리함)-->
                                                <div class="cont"><?= cut_str($write['cp_logo_content'], 170, "…") ?></div><!--공모전 설명(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                                                <div class="rate cf">
                                                    <div class="star"><span><i class="fal fa-eye"></i> <?= number_format($write['hit'])?>회</span><span><?=comp_apply_cnt($write['cp_idx'])?>명의 참여자</span></div>
                                                    <div class="heart_hit"><span><i class="fal fa-calendar-week"></i></span> <?=$progress_list[$write['cp_progress']]?> (~<?= date('y.m.d',strtotime($write['cp_datetime'])) ?>) </div><!--심시기간-->
                                                </div>
                                                <div class="price">총상금 <?= number_format($write['cp_reward']) ?>만원</div><!--상품가격-->
                                            </div>
                                        </a>
                                    </div>
                                <?php }
                                }else{ ?>
                                <div class="text-center empty_list" style="margin: 40px 0 0;">
                                    <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                    <p class="t_padding17">등록한 공모전이 없습니다.</p>
                                </div>
                                <?php } ?>
                                </div><!--list-->
                                <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'] . '?tab=1'); ?>

                            </div><!--in-->
                        </div><!--goods-->

                    </div>
                    <!--//등록한 공모전-->

                    <!--참여한 공모전-->
                    <div id="tab-content2" class="tab-content box-article">
                    
                         <!--리스트-->
                         <div id="my_contest">
                            <div class="in">
                                <div class="list cf">
                                <?php 
                                if ($apply_total > 0){
                                    for ($i = 0; $apply = sql_fetch_array($apply_comp); $i++){

                                        //한 공모전에 여러번 참여 할 수 있어서 반복문 돌려서 확인함.
                                        $sql = "select ap_idx from new_competition_apply where ap_cp_idx = '{$apply['ap_cp_idx']}' ";
                                        $result = sql_query($sql);

                                        $sql = "select cp_win_apply from new_competition where cp_idx = '{$apply['ap_cp_idx']}' ";
                                        $win = sql_fetch($sql)['cp_win_apply'];
                                        $trophy = "";
                                        for ($a = 0; $apply_all = sql_fetch_array($result); $i++){
                                            if($apply_all['ap_idx'] == $win){
                                                $trophy = 'Y';
                                            }
                                        }


                                        //진행상황 변경(날짜가 지났을 경우 심사 중 처리 - view로 들어갈 경우 update되서.)
                                        if (G5_TIME_YMD >= date('Y-m-d', strtotime($apply['cp_datetime'])) && $apply['cp_progress'] < 2 ) {
                                            $apply['cp_progress'] = 2;
                                        }?>
                                    <div class="thm">
                                        <?php if($trophy == "Y"){ ?>
                                            <!--참여한 공모작 우승 트로피 아이콘-->
                                            <div class="trophy">
                                                <img src="<?php echo G5_THEME_IMG_URL ?>/sub/medal.png" alt="공모전1위마크" />
                                            </div>
                                        <?php } ?>
                                            <div class="mg">
                                                <!--<span class="pri">PRIME</span>prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                                                <div class="heart" id="heart_div_<?=$apply['cp_idx']?>">
                                                    <?php $like_sql = "select li_idx from {$g5['like_table']} where ta_idx = '{$apply['cp_idx']}' and li_table = 'competition' and mb_id = '{$member['mb_id']}' ";
                                                    $like_row = sql_fetch($like_sql);
                                                    if (isset($like_row['li_idx'])){ ?>
                                                        <button type="button" class="heart on" onclick="like_chk('off',<?=$apply['cp_idx']?>,'competition')"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button><!--좋아요 누른후-->
                                                    <?php }else{ ?>
                                                        <button type="button" class="heart off" onclick="like_chk('on',<?=$apply['cp_idx']?>,'competition')"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전 -->
                                                    <?php } ?>
                                                </div>
                                                <a href="<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$apply['cp_idx']?>">
        
                                                <div class="mg_in">
                                                     <div class="over">
                                                        <?php $sql = "select * from {$g5['board_file_table']} where wr_id = {$apply['cp_idx']} and bo_table = 'competition_main' ";
                                                            $img = sql_fetch($sql);
                                                            $img_file = G5_DATA_PATH.'/file/competition_main/'.$img['bf_file'];
                                                            if (file_exists($img_file) && $img['bf_file'] != ""){
                                                                echo '<img src="'. G5_DATA_URL.'/file/competition_main/'.$img['bf_file'].'">';
                                                            }else{
                                                               // echo '<img src="'. G5_THEME_IMG_URL.'/main/heart_on.png">';
                                                                  echo "<div class='no_img'>로고 이미지가 없습니다.</div>";
                                                            }
                                                        ?>
                                                    </div>
                                                </div><!--클라이언트 로고-->
                                            </a>
                                        </div><!--mg-->
        
                                        <a href="<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$apply['cp_idx']?>">
        
                                        <div class="info">
                                                <!-- 재능강의 작성자 정보 -->
                                                <div id="lecture_writer_list">
                                                            <div class="mb">
                                                                <div class="mb_info">
                                                                    <p><i class="fas fa-user-circle"></i>&nbsp;<?=$apply['cp_company_name']?></p>
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="tit"><?=$apply['cp_title']?></div><!--공모전 제목(최대1줄까지만 추출, 나머지는 ... 처리함)-->
                                                <div class="cont"><?= cut_str($apply['cp_logo_content'], 170, "…") ?></div><!--공모전 설명(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                                                <div class="rate cf">
                                                    <div class="star"><span><i class="fal fa-eye"></i> <?= number_format($apply['hit'])?>회</span><span><?=comp_apply_cnt($apply['cp_idx'])?>명의 참여자</span></div>
                                                    <div class="heart_hit"><span><i class="fal fa-calendar-week"></i></span> <?=$progress_list[$apply['cp_progress']]?> (~<?= date('y.m.d',strtotime($apply['cp_datetime'])) ?>) </div><!--심시기간-->
                                                </div>
                                                <div class="price">총상금 <?= number_format($apply['cp_reward']) ?>만원</div><!--상품가격-->
                                            </div>
                                        </a>
                                        
                                    </div>
                                    <?php }
                                }else{ ?>
                                <div class="text-center empty_list" style="margin: 40px 0 0;">
                                    <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                    <p class="t_padding17">참여한 공모전이 없습니다.</p>
                                </div>
                                <?php } ?>
                                </div><!--list-->
                                <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'] . '?tab=2'); ?>

                            </div><!--in-->
                        </div><!--goods-->
                        
                    </div>

                    <!--찜한 공모전-->
                    <div id="tab-content3" class="tab-content">
                    
                         <!--리스트-->
                         <div id="my_contest">
                            <div class="in">
                                <div class="list cf">
                                <?php
                                if ($like_total > 0){
                                    for ($i = 0; $like = sql_fetch_array($like_comp); $i++){
                                        //진행상황 변경(날짜가 지났을 경우 심사 중 처리 - view로 들어갈 경우 update되서.)
                                        if (G5_TIME_YMD >= date('Y-m-d', strtotime($like['cp_datetime'])) && $like['cp_progress'] < 2 ) {
                                            $like['cp_progress'] = 2;
                                        }?>
                                    <div class="thm">
                                            <div class="mg">
                                                <!--<span class="pri">PRIME</span>prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                                                <div class="heart" id="heart_div_<?=$like['cp_idx']?>">
                                                    <?php $like_sql = "select li_idx from {$g5['like_table']} where ta_idx = '{$like['cp_idx']}' and li_table = 'competition' and mb_id = '{$member['mb_id']}' ";
                                                    $like_row = sql_fetch($like_sql);
                                                    if (isset($like_row['li_idx'])){ ?>
                                                        <button type="button" class="heart on" onclick="like_chk('off',<?=$like['cp_idx']?>,'competition')"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button><!--좋아요 누른후-->
                                                    <?php }else{ ?>
                                                        <button type="button" class="heart off" onclick="like_chk('on',<?=$like['cp_idx']?>,'competition')"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전 -->
                                                    <?php } ?>
                                                </div>

                                                <div class="mg_in">
                                                     <div class="over">
                                                        <?php $sql = "select * from {$g5['board_file_table']} where wr_id = {$like['cp_idx']} and bo_table = 'competition_main' ";
                                                            $img = sql_fetch($sql);
                                                            $img_file = G5_DATA_PATH.'/file/competition_main/'.$img['bf_file'];
                                                            if (file_exists($img_file) && $img['bf_file'] != ""){
                                                                echo '<img src="'. G5_DATA_URL.'/file/competition_main/'.$img['bf_file'].'">';
                                                            }else{
                                                               // echo '<img src="'. G5_THEME_IMG_URL.'/main/heart_on.png">';
                                                                  echo "<div class='no_img'>로고 이미지가 없습니다.</div>";
                                                            }
                                                        ?>
                                                    </div>
                                                </div><!--클라이언트 로고-->
                                        </div><!--mg-->
        

                                        <div class="info">
                                                <!-- 재능강의 작성자 정보 -->
                                                <div class="btn_gr">
                                                                <ul>
                                                                    <li><a href="<?php echo G5_BBS_URL; ?>/contest_view.php?idx=<?=$like['cp_idx']?>">보기</a></li>
                                                                </ul>
                                                </div>
                                                <div id="lecture_writer_list">
                                                            <div class="mb">
                                                                <div class="mb_info">
                                                                    <p><i class="fas fa-user-circle"></i>&nbsp;<?=$like['cp_company_name']?></p>
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="tit"><?=$like['cp_title']?></div><!--공모전 제목(최대1줄까지만 추출, 나머지는 ... 처리함)-->
                                                <div class="cont"><?= cut_str($like['cp_logo_content'], 170, "…") ?></div><!--공모전 설명(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                                                <div class="rate cf">
                                                    <div class="star"><span><i class="fal fa-eye"></i> <?= number_format($like['hit'])?>회</span><span><?=comp_apply_cnt($like['cp_idx'])?>명의 참여자</span></div>
                                                    <div class="heart_hit"><span><i class="fal fa-calendar-week"></i></span> <?=$progress_list[$like['cp_progress']]?> (~<?= date('y.m.d',strtotime($like['cp_datetime'])) ?>) </div><!--심시기간-->
                                                </div>
                                                <div class="price">총상금 <?= number_format($like['cp_reward']) ?>만원</div><!--상품가격-->
                                            </div>

                                    </div>
                                    <?php }
                                }else{ ?>
                                <div class="text-center empty_list" style="margin: 40px 0 0;">
                                    <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                    <p class="t_padding17">찜한 공모전이 없습니다.</p>
                                </div>
                                <?php } ?>
        
                                </div><!--list-->
                                <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'] . '?tab=3'); ?>

                            </div><!--in-->
                        </div><!--goods-->

                    </div>

                </div><!--//tabs-->
            </div>

        </section>
</article>
<script>

    $(document).ready(function () {


    });

    function like_chk(type,idx,table) {

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            type: "POST",
            data: {
                mode: 'like_chk',
                ta_idx: idx,
                li_table: table,
                type: type
            },
            dataType:'json',
            success: function(data) {

                $('#heart_div_'+idx).html(data.html);

                var like_cnt = $('#like_cnt_'+idx).text();
                like_cnt=like_cnt *1
                if (type == 'off'){
                    $('#like_cnt_'+idx).text(like_cnt-1);
                }else{
                    $('#like_cnt_'+idx).text(like_cnt+1);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        })

    }

    function a_tab(id) {

        location.href = g5_bbs_url + "/my_contest.php?tab="+id
    }

</script>