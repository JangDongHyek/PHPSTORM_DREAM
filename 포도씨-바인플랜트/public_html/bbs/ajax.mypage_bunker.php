<?php
include_once('./_common.php');

/** 마이페이지 - 벙커관리 (ajax) **/

$sql_search = '';
$date = $year.'-'.sprintf('%02d', $month);

// 페이징
if($mode == 'in') { // 적립내역
    $sql_search .= " and mode = '적립' ";
    $sql_search .= " and wr_datetime like '{$date}%' ";
} else if($mode == 'out') { // 차감내역
    $sql_search .= " and mode = '차감' ";
    $sql_search .= " and wr_datetime like '{$date}%' ";
} else { // 출금내역
    $sql_search .= " and mode = '출금' ";
    $sql_search .= " and (wr_datetime like '{$date}%' or payment_date like '{$date}%') ";
}

$sql = " select count(*) as cnt from g5_bunker_history where 1=1 and mb_id = '{$member['mb_id']}' {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 5;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 적립내역/출금내역 리스트
if($mode == 'in' || $mode == 'out') { // 적립내역 or 차감내역
    $sql = " select * from g5_bunker_history where 1=1 and mb_id = '{$member['mb_id']}' {$sql_search} order by idx desc limit {$from_record}, {$rows} ";
} else { // 출금내역
    $sql = " select * from g5_bunker_withdraw where 1=1 and mb_id = '{$member['mb_id']}' order by idx desc limit {$from_record}, {$rows} ";
}
$result = sql_query($sql);

$i = 0;
while($row = sql_fetch_array($result)) {
    $i++;

    if($mode == 'in' || $mode == 'out') {
        $category = ''; // 종류
        /*if($row['etc'] == 'bonus') { $category = '보너스'; }
        else if($row['etc'] == 'great' || $row['etc'] == 'best') { $category = '헬프미'; }
        else if($row['etc'] == 'charge') { $category = '충전'; }*/
        if($row['etc'] == 'bonus') { $category = '보너스'; }
        else {$category = '일반'; }

        $contents = $row['contents']; // 내용
        if($row['etc'] == 'gift') {
            $contents = $row['contents'] . ' ('.getNickOrId($row['rel_mb_id']).')';
        }
        else if($row['etc'] == 'reference') {
            // $contents = $row['contents'] . ' ('.getNickOrId($row['rel_mb_id']).')';
        }
?>
    <li class="tbl_cont">
        <ul class="tbl_list tbl">
            <li class="data w2"><?=str_replace('-','.',substr($row['wr_datetime'], 0, 10))?></li>
            <li class="type w2"><?=$category?></li>
            <li class="cont w4"><?=$contents?></li>
            <li class="price w2"><?=number_format($row['bunker'])?> BUNKER</li>
        </ul>
    </li>
    <?php } else { ?>
    <li class="tbl_cont">
        <ul class="tbl_list tbl">
            <li class="state w1"><?=$row['state']?></li> <!--상태-->
            <li class="data w2"><?=str_replace('-','.',substr($row['wr_datetime'], 0, 10))?></li> <!--신청일-->
            <li class="account w3"><?=$bank_list[$row['bank']]?> / <?=$row['account_number']?> / <?=$row['account_holder']?></li> <!--은행/계좌번호/예금주-->
            <li class="price w2"><?=number_format($row['exchange_krw'])?></li> <!--금액-->
            <li class="data w2"><?=str_replace('-','.',substr($row['payment_date'], 0, 10))?></li> <!--적립일시-->
        </ul>
    </li>
    <?php } ?>
<?php
}
if($i==0) {
?>
<li class="tbl_cont">
    <ul class="tbl_list tbl">
        <li class="nodata" style="text-align: center;">등록된 내용이 없습니다.</li>
    </ul>
</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
