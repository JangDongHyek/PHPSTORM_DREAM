<?php
include_once('./_common.php');

$rows = $_POST['rows'];
$ta_idx = $_POST['ta_idx'];

$sql = " select re.*, mb.mb_nick from new_payment_review as re left join g5_member as mb on mb.mb_id = re.mb_id where re.ta_idx in ({$ta_idx}) order by wr_datetime desc limit {$rows}, 5 ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
?>
<div class="list cf">
    <div class="mg">
        <?php
        $mb_dir = substr($row['mb_id'],0,2);
        $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$row['mb_id'].'pro.jpg';
        if (file_exists($icon_file)) {
            $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$row['mb_id'].'pro.jpg';
            ?>
            <img src="<?=$icon_url?>">
            <?php
        }else{
            ?>
            <img src='<?=G5_THEME_IMG_URL?>/sub/default.png'>
            <?php
        }
        ?>
    </div>
    <div class="info">
        <div class="txt"><?=$row['review']?></div>
        <!-- 리뷰내용최대3줄추출 -->
        <div class="nick"><span><i class="fas fa-user-circle"></i></span><?=$row['mb_nick']?>
        </div><!--닉네임 일부분 노출-->
        <div class="date"><?=substr($row['wr_datetime'],0,16)?>
            <div class="star">
                <?php for($k=1; $k<=$row['rating']; $k++) { ?>
                    <span class="on"><i class="fas fa-star"></i></span>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
