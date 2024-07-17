<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);

//print_r($member_skin_url);
?>
<link rel="stylesheet" href="<?= $member_skin_url?>/competition.css">
<link href="<?php echo G5_THEME_CSS_URL; ?>/flexslider.css" rel="stylesheet" type="text/css"><!--swiper CSS-->
<article id="contest_list">
	<div class="inr">

     <section>
         <div>
               <!--카테고리-->
               <nav id="bo_cate_blue">
                        <h2>프로젝트 카테고리</h2>
                        <ul id="bo_cate_ul">
                            <?php for ($i = 0; $i < count($competition_ctg); $i++){?>
                                <li><a id = "<?= $category1 == $competition_ctg[$i]['name'] ? 'bo_cate_on':"";?>" href="<?= G5_BBS_URL ?>/contest_list.php?category1=<?=$competition_ctg[$i]['name']?>"><?=$competition_ctg[$i]['name']?></a></li>
                            <?php } ?>
                            </ul>
                </nav>
                
                <section id="cate_depth">
        <div class="cateTit"><h2><?= $category1 ?></h2></div>
        <div class="cateList">
            <div class="sort">
                <ul>
                    <li class="check">신규등록 순</li>
                    <li>참여자 순</li>
                    <li>인기 순</li>
                    <li>추천 순</li>
                    <li>총상금 순</li>
                </ul>
            </div>
            <div class="depthList">
                <ul>
<!--                    <li class="check">--><!--</li>-->
<!--                    --><!--                        <a href="--><!--?category=--><!--&category2=--><!--"><li id="li_--><!--">--><!--</li></a>-->
<!--                    -->
                    <?php for ($i = 1; $i <= count($competition_ctg2); $i ++){ ?>
                            <a href="<?=$_SERVER['PHP_SELF']?>?category1=<?=$category1?>&category2=<?=$competition_ctg2[$i]['name']?>"><li id="li_<?=$competition_ctg2[$i]['idx']?>"><?=$competition_ctg2[$i]['name']?></li></a>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </section>
              
              
              <!--리스트-->
                 <div id="contest">
                    <div class="inr">
                    	<a href="<?php echo G5_BBS_URL ?>/contest_write.php" class="write_btn">의뢰등록</a>

                        <div class="list cf">
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
     
     </section>
     
     </div>

</article>
