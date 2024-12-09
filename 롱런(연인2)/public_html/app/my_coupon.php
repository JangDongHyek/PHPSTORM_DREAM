<?php
$pid = "coupon";
include_once("./app_head.php");

// 마이페이지 > 쿠폰
$sql = "SELECT * FROM g5_coupon WHERE mb_no = '{$member['mb_no']}'
        ORDER BY (CASE use_date WHEN '' THEN 1 ELSE 2 END), use_date DESC, issue_date DESC";
$result = sql_query($sql);
$coupon_cnt = 0;
$list = array();
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $list[] = $row;
    if ($row['use_date'] == "") $coupon_cnt++;
}

?>
<style>
    #coupon ul li .point.gray {color: #ccc; text-align: right;}
</style>
<div id="coupon">
    <div class="area_top">
        현재 사용가능한 쿠폰 <strong><i class="fa-regular fa-ticket-simple"></i> <?=$coupon_cnt?></strong>
    </div>
    <ul>
        <? if (count($list) == 0) { ?>
        <li>
            <div>내역이 없습니다.</div>
        </li>
        <?
        } else {
            foreach ($list AS $key=>$val) {
        ?>
        <li>
            <div>
                <p class="date"><?=date("Y-m-d", strtotime($val['issue_date']))?></p>
                <strong>쿠폰 발급</strong>
            </div>
            <? if ($val['use_date']=="") { ?>
            <div class="point">사용가능</div>
            <? } else { ?>
            <div class="point gray">사용완료<br>(<?=date("Y-m-d", strtotime($val['use_date']))?>)</div>
            <? } ?>
        </li>
        <? }} ?>
    </ul>
</div>


<?php
include_once ("./app_tail.php");
?>