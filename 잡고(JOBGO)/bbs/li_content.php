<?php
$like_sql = "select li_idx from {$g5['like_table']} where ta_idx = '{$row['ta_idx']}' and li_table = 'talent' and mb_id = '{$member['mb_id']}' ";
$like_row = sql_fetch($like_sql);
$mb = get_member($row['mb_id']);

$sql = "select min(pta_pay) min_pta_pay,max(pta_pay) max_pta_pay from new_pay_talent where ta_idx = '{$row['ta_idx']}' ";
$pay_result = sql_fetch($sql);
$pay = "";
if($pay_result['min_pta_pay'] == 0) {
    $pay = $pay_result['max_pta_pay'];
    $pay = number_format($pay)."원 ~";
}else{
    $pay = number_format($pay_result['min_pta_pay'])."원 ~ ";
}

if (isset($like_row['li_idx'])){
    $on_off = 'on';
}else{
    $on_off = 'off';
}



?>
<div class="thm">

    <div class="mg">
        <!--                                                                    <span class="pri">PRIME</span>-->
        <!--prime 광고등록 상품은 해당 아이콘이 뜨도록-->
        <a href="<?php echo G5_BBS_URL; ?>/item_view.php?idx=<?=$row['ta_idx']?>">
            <div class="mg_in">
                <div class="over">
                    <?php
                    $file_sql = " select * from {$g5['board_file_table']} where bo_table = 'thum_talent' and wr_id = {$row['ta_idx']} order by bf_datetime limit 1 ";
                    $file_row = sql_fetch($file_sql);
                    $bo_table = 'thum_talent';


                    //썸네일 이미지가 추가개발되어 썸네일이미지가 들어있지 않은 재능의 경우 메인이미지 추출하도록 함.
                    if($file_row['wr_id'] == "") {
                        $file_sql = " select * from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = {$row['ta_idx']} order by bf_datetime limit 1 ";
                        $file_row = sql_fetch($file_sql);
                        $bo_table = 'talent';
                    }

                    if($file_row['wr_id']) { ?>
                        <img src="<?php echo G5_DATA_URL ?>/file/<?=$bo_table?>/<?=$file_row['bf_file']?>">
                    <?php } else { ?>
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"> <!-- 디폴트 이미지 -->
                    <?php } ?>
                </div>
            </div><!--상품사진-->
        </a>
    </div><!--mg-->

    <div class="info">
        <div class="heart" name="heart_div_<?=$row['ta_idx']?>">
            <button type="button" class="heart <?=$on_off?>" onclick="like_chk(<?=$row['ta_idx']?>,this,'talent')"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_<?=$on_off?>.png" alt="좋아요<?=$on_off?>" title="좋아요<?=$on_off?>"></button>
        </div>

        <!--재능 수정/보기-->
        <?php if ($row['page_type'] != ''){ ?>
        <div class="btn_gr">
            <ul>
            <?php if ($row['page_type'] == 'update'){ ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/pro_step01.php?w=u&ta_idx=<?=$row['ta_idx']?>">수정</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/item_view.php?idx=<?=$row['ta_idx']?>">보기</a></li>
            <?php }else{ ?>
                <li><a href="<?=G5_BBS_URL?>/item_view.php?idx=<?=$row['ta_idx']?>#review">구매후기</a></li> <!-- 서비스 평가로 이동 후 item_view.php 새로고침 시 다시 서비스 평가로 가는 문제 -->
                <li><a href="javascript:chatting('<?=$row['ta_idx']?>', '<?=$row['mb_id']?>', '<?=$row['sale_mb_nick']?>', '<?=$row['sale_mb_id']?>');" class="talk_btn">문의채팅</a></li>
            <?php } ?>
            </ul>

        </div>
        <?php } ?>
        <!-- 재능강의 작성자 정보 -->
        <div id="lecture_writer_list">
            <div class="mb">
                <div class="photo">
                    <?php
                    $mb_dir = substr($mb['mb_id'],0,2);
                    $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.jpg';
                    if (file_exists($icon_file)) {
                        $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.jpg';
                        echo '<img src="'.$icon_url.'" alt="">';
//                        echo '</div><input style="float: bottom" type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1"> ※체크 후 확인을 누르면 삭제됩니다.';
                    }else{
                        echo '<img src="'.G5_THEME_IMG_URL.'/sub/default.png" alt="">';
                    }

                    $review_span = "";
                    $review_span2 = "";

                    if (review_cnt($row['ta_idx']) > 2 ){
                        $review_span = '<span><i class="fas fa-star"></i> '.review_avg($row['ta_idx']).'</span><span>'.review_cnt($row['ta_idx']).'명의 평가</span>';
                        $review_span2 = '<span><i class="fas fa-star"></i>&nbsp;'.review_avg($row['ta_idx']).'</span>';
                    }
                    ?>
                </div>
                <div class="mb_info">
                    <p><?= $mb['mb_nick'] ?>&nbsp;&nbsp; <?=$review_span2?> </p>
                </div>
            </div>
        </div>
        <a href="<?php echo G5_BBS_URL; ?>/item_view.php?idx=<?=$row['ta_idx']?>">
            <div class="tit"><?= $row['ta_title'] ?></div><!--상품제목(최대2줄까지만 추출, 나머지는 ... 처리함) -->
            <div class="rate cf">
                <div class="star"> <?=$review_span?> </div>
                <div class="heart_hit"><span><i class="fas fa-heart"></i></span ><span style="margin-left: 5px" name="like_cnt_<?=$row['ta_idx']?>"><?= like_cnt($row['ta_idx'],'talent') ?></span></div><!--사람들이 좋아요 한 횟수-->
            </div>
            <div class="price"><?=$pay?></div><!--상품가격-->
        </a>
    </div>
</div>
