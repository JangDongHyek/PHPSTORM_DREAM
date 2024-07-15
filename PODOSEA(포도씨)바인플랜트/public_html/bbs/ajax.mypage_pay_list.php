<?php
include_once('./_common.php');

/** 마이페이지 - 판매대금관리 (ajax) **/

$sql_search = '';
$date = $year.'-'.sprintf('%02d', $month);

if($mode == 'sales') { // 판매내역
    $sql_search .= " and b.rr_is_free = 'N' ";
    if($all_view == "N") {
        $sql_search .= " and a.wr_datetime like '{$date}%' ";
    }
    $sql = " select count(*) as cnt from g5_reference_room_sale as a left join g5_reference_room as b on a.reference_idx = b.idx where 1=1 and sale_mb_id = '{$member['mb_id']}' {$sql_search} ";

} else if($mode == 'withdraw') { // 출금내역
    if($all_view == "N") {
        $sql_search .= " and (wr_datetime like '{$date}%' or payment_date like '{$date}%') ";
    }
    $sql = " select count(*) as cnt from g5_reference_room_withdraw where 1=1 and mb_id = '{$member['mb_id']}' {$sql_search} ";
}
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 5;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 판매내역 리스트
if($mode == 'sales') {
    $sql = " select b.*, a.buy_mb_id, a.price, a.wr_datetime as sale_date from g5_reference_room_sale as a left join g5_reference_room as b on a.reference_idx = b.idx where 1=1 and sale_mb_id = '{$member['mb_id']}' {$sql_search} order by a.idx desc limit {$from_record}, {$rows} ";
} else if($mode == 'withdraw') {
    $sql = " select * from g5_reference_room_withdraw where 1=1 and mb_id = '{$member['mb_id']}' {$sql_search} order by idx desc limit {$from_record}, {$rows} ";
}
$result = sql_query($sql);

$i = 0;
while($row = sql_fetch_array($result)) {
    $i++;

    if($mode == 'sales') { // 판매내역
?>
    <ul class="tbl_list tbl">
        <li class="data w15"><?=str_replace('-','.',substr($row['sale_date'], 0, 10))?></li>
        <li class="data w15"><?=$row['buy_mb_id']?></li>
        <li class="type w2"><?=$row['rr_category']?></li>
        <li class="cont w4"><?=$row['rr_subject']?></li>
        <li class="price w1"><?=number_format($row['price'])?> 원</li>
    </ul>
<?php
    }
    else if($mode == 'withdraw') { // 출금내역
    ?>
    <ul class="tbl_list tbl">
        <li class="state w1"><?=$row['state']?></li> <!--상태-->
        <li class="data w2"><?=str_replace('-','.',substr($row['wr_datetime'], 0, 10))?></li> <!--신청일-->
        <li class="account w3"><?=$bank_list[$row['bank']]?> / <?=$row['account_number']?> / <?=$row['account_holder']?></li> <!--은행/계좌번호/예금주-->
        <li class="price w2"><?=number_format($row['sales_proceeds'])?>원</li> <!--금액-->
        <li class="data w2"><?=str_replace('-','.',substr($row['payment_date'], 0, 10))?></li> <!--적립일시-->
    </ul>
    <?php
    }
}
if($i==0) {
?>
<ul class="tbl_list tbl">
    <li class="nodata" style="text-align: center;">자료가 없습니다.</li>
</ul>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
