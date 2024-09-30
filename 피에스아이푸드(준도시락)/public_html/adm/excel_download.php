<?php
include_once("./_common.php");
/**
 * 주문내역 엑셀다운로드
 */

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$cate."주문내역.xls" );     //filename = 저장되는 파일명을 설정합니다.
header( "Content-Description: PHP4 Generated Data" );

$sql_common = " FROM g5_order AS ord 
                LEFT JOIN g5_dosirak AS do ON do.idx = ord.dosirak_idx
                LEFT JOIN g5_member AS mb ON mb.mb_id = ord.mb_id
                LEFT JOIN g5_member AS mb2 ON mb2.mb_id = ord.rider ";
$sql_search = " WHERE 1=1 AND do.do_category = '{$cate}' AND read_yn IS NOT NULL ";
$sql_order = " ORDER BY delivery_date DESC, ord.wr_datetime DESC ";

if($stx) {
    $sql_search .= " and {$sfl} like '%{$stx}%' ";
}

if(!empty($cate)) {
    $sql_search .= " and do_category = '{$cate}' ";
}

// 주문 일자 검색
if(!empty($_REQUEST['st_date']) && !empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' and date_format(ord.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
} else if(!empty($_REQUEST['st_date']) && empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' ";
} else if(empty($_REQUEST['st_date']) && empty(!$_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
}

// 배달시작일 검색
if(!empty($_REQUEST['st_date2']) && !empty($_REQUEST['ed_date2'])) {
    $sql_search .= " and date_format(ord.delivery_date, '%Y-%m-%d') >= '{$_REQUEST['st_date2']}' and date_format(ord.delivery_date, '%Y-%m-%d') <= '{$_REQUEST['ed_date2']}' ";
} else if(!empty($_REQUEST['st_date2']) && empty($_REQUEST['ed_date2'])) {
    $sql_search .= " and date_format(ord.delivery_date, '%Y-%m-%d') >= '{$_REQUEST['st_date2']}' ";
} else if(empty($_REQUEST['st_date2']) && empty(!$_REQUEST['ed_date2'])) {
    $sql_search .= " and date_format(ord.delivery_date, '%Y-%m-%d') <= '{$_REQUEST['ed_date2']}' ";
}

$sql = " select ord.*, do.do_category, mb.mb_name, mb.send_email {$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql);

if($cate == '정기배달' || $cate == "샐러드팩") {
    $_excel_add = "
        <td>배송시작일</td>
    ";
}
else {
    $_excel_add = "
        <td>행사날짜</td>
        <td>행사시간</td>
        <td>메모</td>
    ";
}

$_excel = "
<table border='1'>
    <tr>
       <td>No.</td>
       <td>주문시간</td>
       <td>주문일</td>
       <td>주문자아이디</td>
       <td>업체명&현장명</td>
       <td>주문배송지</td>
       <td>받는사람</td>
       <td>연락처</td>
       <td>명세서수신이메일</td>
";
$_excel .= $_excel_add;
$_excel .= "
       <td>담당기사</td>
       <td>메뉴명</td>
       <td>수량</td>
       <td>금액</td>
       <td>부가세</td>
       <td>합계</td>
    </tr>
";

$no = 1;
$total_a = 0; // 수량
$total_b = 0; // 금액
$total_c = 0; // 부가세
$total_d = 0; // 합계
while ($row = sql_fetch_array($result)) {
    // 주문일 - 수정된 주문은 수정일 표시
    $order_date = $row['wr_datetime'];
    if($row['mod_yn'] == 'Y') {
        $order_date = $row['up_datetime'];
    }

    $rider = get_member($row['rider']); // 기사정보

    if($cate == '정기배달' || $cate == "샐러드팩") {
        $_excel_add2 = "
            <td>".$row['delivery_date']."</td>
        ";
    }
    else {
        $_excel_add2 = "
            <td>".substr($row['event_date'], 0, 10)."</td>
            <td>".substr($row['event_time'], 0, 10)."</td>
            <td>".$row['order_memo']."</td>
        ";
    }

    $_excel .= "
    <tr>
       <td>".$no."</td>
       <td>".substr($order_date, 11, 5)."</td>
       <td>".substr($order_date, 0, 10)."</td>
       <td>".$row['mb_id']."</td>
       <td>".$row['mb_name']."</td>
       <td>".$row['order_post']." ".$row['order_addr1']." ".$row['order_addr2']."</td>
       <td>".$row['order_name']."</td>
       <td>".$row['order_tel']."</td>
       <td>".$row['send_email']."</td>
    ";
    $_excel .= $_excel_add2;
    $_excel .= "
       <td>".$rider['mb_name']."</td>
       <td>".$row['do_name']."</td>
       <td>".number_format($row['order_amount'])."</td>
       <td>".number_format($row['total_price'])."</td>
       <td>".number_format($row['total_price']/10)."</td>
       <td>".number_format($row['total_price']+($row['total_price']/10))."</td>
    </tr>
    ";
    $no++;

    $total_a += $row['order_amount'];
    $total_b += $row['total_price'];
    $total_c += $row['total_price']/10;
    $total_d += $row['total_price'] + ($row['total_price']/10);
}

if($cate == '정기배달' || $cate == "샐러드팩") {
    $_excel_add3 = "
    <td></td> <!--배송시작일-->
    ";
}
else {
    $_excel_add3 = "
    <td></td> <!--행사날짜-->
    <td></td> <!--행사기간-->
    <td></td> <!--메모-->
    ";
}

$_excel .= "
    <tr>
       <td></td> <!--No-->
       <td></td> <!--주문시간-->
       <td></td> <!--주문일-->
       <td></td> <!--주문자아이디-->
       <td></td> <!--업체명&현장명-->
       <td></td> <!--주문배송지-->
       <td></td> <!--받는사람-->
       <td></td> <!--연락처-->
       <td></td> <!--명세서수신이메일-->
       ";
$_excel .= $_excel_add3;
$_excel .= "
       <td></td> <!--담당기사-->
       <td></td> <!--메뉴명-->
       <td>".number_format($total_a)."</td> <!--수량-->
       <td>".number_format($total_b)."</td> <!--금액-->
       <td>".number_format($total_c)."</td> <!--부가세-->
       <td style='font-weight: bold;'>".number_format($total_d)."</td> <!--합계-->
    </tr>
    ";

$_excel .= "</table>";

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $_excel;
?>
