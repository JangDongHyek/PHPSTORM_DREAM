<?php
include_once("../common.php");
/**
 * 관리자 태블릿 - 주문내역 - 리스트 (ajax)
 */

$sql_common = " from g5_order as ord left join g5_dosirak as do on do.idx = ord.dosirak_idx left join g5_member as mb on mb.mb_id = ord.mb_id ";
$sql_search = " where 1=1 and ord.dosirak_idx != 0 and read_yn is not null ";

// 도시락 구분 검색
if(!empty($cate)) {
    $sql_search .= "and ord.order_category = '{$cate}' ";
}

if(empty($st_date) && empty($ed_date)) {
    $today = date('Y-m-d');
    $sql_search .= " and date_format(delivery_date, '%Y-%m-%d') = '{$today}' and date_format(delivery_date, '%Y-%m-%d') = '{$today}' ";
}

// 도시락 배송시작일 검색
if(!empty($st_date) && !empty($ed_date)) {
    $sql_search .= " and date_format(delivery_date, '%Y-%m-%d') >= '{$st_date}' and date_format(delivery_date, '%Y-%m-%d') <= '{$ed_date}' ";
} else if(!empty($st_date) && empty($ed_date)) {
    $sql_search .= " and date_format(delivery_date, '%Y-%m-%d') >= '{$st_date}' ";
} else if(empty($st_date) && empty(!$ed_date)) {
    $sql_search .= " and date_format(delivery_date, '%Y-%m-%d') <= '{$ed_date}' ";
}

$sql_orderby = " order by ord.delivery_date desc, ord.wr_datetime desc ";

// 페이징
$sql = " select count(*) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select ord.*, mb.mb_name {$sql_common} {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} "; // 주문내역
//if($private) { echo $sql; }
$rlt = sql_query($sql);

while($row = sql_fetch_array($rlt)) {
    $do = sql_fetch(" select * from g5_dosirak where idx = '{$row['dosirak_idx']}' ");
    if($row['order_category'] == "정기배달" || $row['order_category'] == "샐러드팩") {
        $mod_cls = ''; // 수정된 주문에 적용할 클래스
        if(empty($row['read_yn'])) { // 수정되기 전 이전 주문 건
            $mod_cls = 'style="text-decoration:line-through;"';
        }

        // 주문일 - 수정된 주문은 수정일 표시
        $order_date = str_replace('-', '.', substr($row['wr_datetime'],0, 16));
        if($row['mod_yn'] == 'Y') {
            $order_date = str_replace('-', '.', substr($row['up_datetime'], 0, 16));
        }

        $rider = get_member($row['rider']); // 배달담당기사
    ?>
    <!--정기배달-->
    <li>
        <div class="menu">
            <p><?=$row['do_name']?> <?=number_format($row['order_amount'])?>개</p>
        </div>
        <dl class="date">
            <dt>업체명&현장명</dt>
            <dd><?=$row['mb_name']?></dd>
        </dl>
        <dl class="memo">
            <dt>메모</dt>
            <dd><?=$row['order_memo']?></dd>
        </dl>
    </li>
    <!--//정기배달-->
    <?php
    }
    else { // 행사용/샐러드팩
    ?>
    <!--행사용-->
    <li>
        <div class="menu">
            <p><?=$row['do_name']?> <?=number_format($row['order_amount'])?>개</p>
        </div>
        <dl class="date">
            <dt>업체명&현장명</dt>
            <dd><?=$row['mb_name']?></dd>
        </dl>
        <dl class="memo">
            <dt>메모</dt>
            <dd><?=$row['order_memo']?></dd>
        </dl>
    </li>
    <!--//행사용-->
    <?php
    }
?>
<?php
}
if($total_count == 0) {
?>
<div style="text-align: center;">주문내역이 없습니다.</div>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>