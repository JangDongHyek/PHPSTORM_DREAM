<?php
$pid = "heart";
include_once("./app_head.php");

// 마이페이지 > 하트
$sql = "SELECT * FROM g5_heart WHERE mb_no = '{$member['mb_no']}' ORDER BY idx DESC";
$result = sql_query($sql);
$heart_cnt = 0;
$list = array();
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    if ($i == 0) $heart_cnt = $row['mb_heart'];
    $list[] = $row;
}

?>
<div id="heart">
    <div class="area_top">
        <p>현재 보유중인 하트</p> <strong><i class="fa-sharp fa-solid fa-heart"></i> <?=$heart_cnt?></strong>
    </div>
    <ul>
        <? if (count($list) == 0) { ?>
        <li>
            <div>내역이 없습니다.</div>
        </li>
        <?
        } else {
            foreach ($list AS $key=>$val) {
                $point = ($val['plus_heart'] == 0)? "-".$val['minus_heart'] : "+".$val['plus_heart'];
        ?>
        <li>
            <div>
                <p class="date"><?=date("Y-m-d", strtotime($val['regdate']))?></p>
                <strong><?=$val['description']?></strong>
            </div>
            <div class="point"><?=$point?></div>
        </li>
        <? }} ?>
    </ul>
</div>

<?php
include_once ("./app_tail.php");
?>