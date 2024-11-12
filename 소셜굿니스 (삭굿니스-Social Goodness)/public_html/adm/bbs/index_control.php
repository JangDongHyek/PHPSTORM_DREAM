<?php
include_once('./_common.php');

$control = $_POST['control'];

$sql = " select * from g5_member where mb_id = '{$_SESSION['ss_mb_id']}' ";
$mb_row = sql_fetch($sql);

// 평가 안된 장소만 표시
if($control == 'on') {
    $sql = " select * from g5_place_eval where mb_no = {$_SESSION['ss_mb_no']} and category = '평가' ";
    $result = sql_query($sql);

    $te_no_list = '';
    for($i=0; $row = sql_fetch_array($result); $i++) {
        $te_no_list .= $row['te_no'] . ',';
    }
    $te_no_list = substr($te_no_list,0,-1);

    if($te_no_list != '') {
        $sql = " select * from g5_tes where te_category = '장소' and te_no not in ({$te_no_list}) and te_reg_state like '%승인%' order by te_reg_date desc ";
        $result = sql_query($sql);
    } else {
        $sql = " select * from g5_tes where te_category = '장소' and te_reg_state like '%승인%' order by te_reg_date desc ";
        $result = sql_query($sql);
    }
}
else {
    $sql = " select * from g5_tes where te_category = '장소' and te_reg_state like '%승인%' order by te_reg_date desc ";
    $result = sql_query($sql);
}
?>

<!--장소 리스트-->
<ul>
    <?php
    for($i=0; $row = sql_fetch_array($result); $i++) {
        $end_date = strtotime($row['te_review_end_date']);
        $today = strtotime(date('Y-m-d H:i'));

        $diff = $end_date-$today;

        $day = floor(($diff)/(60*60*24));
        $hour = floor(($diff-($day*60*60*24))/(60*60));
        $minute  = floor(($diff-($day*60*60*24)-($hour*60*60))/(60));

        if($diff < 0) {
            $review_end_date = '평가 불가능';
        } else {
            $review_end_date = $day . '일 ' . $hour . '시간 ' . $minute . '분 남음';
        }

        $file_sql = " select * from g5_file where tb_no = {$row['te_no']}";
        $file_row = sql_fetch($file_sql);
        ?>
        <li>
            <a href="<?php echo G5_BBS_URL; ?>/place_view.php?mb_no=<?=$_SESSION['ss_mb_no']?>&te_no=<?=$row['te_no']?>">
                <?php
                if(count($file_row) > 0) {
                ?>
                <dl style="background:url(data/file/place/<?=$file_row['fi_file']?>) no-repeat center center">
                <?php
                } else {
                ?>
                <dl style="background:url(theme/fingerate/skin/member/basic/img/bg.png) no-repeat center center">
                <?php
                }
                ?>
                <div class="ramain_t"><i class="fal fa-clock"></i><?=$review_end_date?></div>
                <dt><?=$row['te_name']?></dt>
                <dd><?=$row['te_contents']?></dd>
                <!--btm-->
                <div class="offer_btm clearfix">
                    <div class="col-xs-6"><i class="fal fa-coin"></i>보상 <span class="num"><?=$row['te_reward_btm']?></span><span class="ico">BTM</span></div>
                    <div class="col-xs-6 text-right"><i class="fal fa-coin"></i>가맹 보상 <span class="num"><?=$row['te_affiliation_btm']?></span><span class="ico">BTM</span></div>
                </div>
            </a>
        </li>
    <?php } ?>
</ul>

<?php
die(0);
?>