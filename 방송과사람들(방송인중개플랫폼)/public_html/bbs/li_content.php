<?php
$mb = get_member_no($row['mb_no']); // 프로필 완료되면 바꾸기
$sql = "select * from g5_board_file where wr_id = '{$row["i_idx"]}' and bo_table = 'main_img' and bf_no = 0 limit 1";
$img_result = sql_fetch($sql)['bf_file'];

$sql = "select count(*) cnt from new_heart where h_p_idx = {$row["i_idx"]} and mb_no = '{$member['mb_no']}' ";
$like_cnt = sql_fetch($sql)['cnt'];

?>
<li>
    <i class="heart <?php if ($like_cnt > 0) echo "on" ?>" onclick="heart_click(<?=$row['i_idx']?>,this)"></i>
    <a href="<?php echo G5_BBS_URL ?>/item_view.php?idx=<?=$row['i_idx']?>">
        <div class="area_img">
            <img src="<?php echo G5_DATA_URL.'/file/main_img/'.$img_result ?>">
        </div>
        <div class="area_txt">
           
            <span><?=$mb['mb_name']?></span><!-- 업체명 -->
            <h3><?=$row['i_title']?></h3> <!-- 제목 -->
            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
            <div class="price"><?=number_format($row['i_price'])?>원 </div> <!-- 가격 -->
        </div>

    </a>
	<?php if ($row['page_type'] == 'update' && $mb['mb_id'] == $member['mb_id']) { ?>
	    <a class="list_btn" href="<?=G5_BBS_URL."/item_write01.php?idx=".$row['i_idx']?>">수정</a> <!-- 제목 -->
	<?php }?>
</li>