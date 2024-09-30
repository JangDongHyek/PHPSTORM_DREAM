<?php
include_once("../common.php");
//include_once('../head.sub.php');
// PHPExcel.php 파일 경로 지정
include_once("./plugin/PHPExcel.php");
/**
 * 회원 - 주문내역 엑셀다운로드
 * PHPExcel 방식
 */

// Create new PHPExcel object
$excel = new PHPExcel();
$sheet = $excel->getActiveSheet();

$sql_common = " FROM g5_order AS ord LEFT JOIN g5_dosirak AS do ON do.idx = ord.dosirak_idx LEFT JOIN g5_member AS mb ON mb.mb_id = ord.mb_id ";
$sql_search = " WHERE 1=1 AND ord.mb_id = '{$mb_id}' AND read_yn IS NOT NULL ";
$sql_order = " ORDER BY ord.idx ";

// 주문 일자 검색
if(!empty($_REQUEST['st_date']) && !empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' and date_format(ord.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
} else if(!empty($_REQUEST['st_date']) && empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' ";
} else if(empty($_REQUEST['st_date']) && empty(!$_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
}

/**
 * 정기배달
 */
$sql = " select ord.*, do.do_category, mb.mb_name {$sql_common} {$sql_search} and do.do_category = '정기배달' {$sql_order} ";
//echo $sql;exit;
$result = sql_query($sql);

// 첫번째 행 지정
$excel->setActiveSheetIndex(0)
    -> setCellValue("A1", "No.")
    -> setCellValue("B1", "주문일")
    -> setCellValue("C1", "주문자아이디")
    -> setCellValue("D1", "업체명&현장명")
    -> setCellValue("E1", "주문배송지")
    -> setCellValue("F1", "받는사람")
    -> setCellValue("G1", "연락처")
    -> setCellValue("H1", "배송시작일")
    -> setCellValue("I1", "메모")
    -> setCellValue("J1", "메뉴명")
    -> setCellValue("K1", "수량")
    -> setCellValue("L1", "금액")
    -> setCellValue("M1", "부가세")
    -> setCellValue("N1", "합계");

$no = 1;
$total_a = 0; // 수량
$total_b = 0; // 금액
$total_c = 0; // 부가세
$total_d = 0; // 합계
for ($i=2; $row=sql_fetch_array($result); $i++) {
    // 주문일 - 수정된 주문은 수정일 표시
    $order_date = substr($row['wr_datetime'],0, 10);
    if($row['mod_yn'] == 'Y') {
        $order_date = substr($row['up_datetime'], 0, 10);
    }

    $excel->setActiveSheetIndex(0)
        ->setCellValue("A".$i, $no)
        ->setCellValue("B".$i, $order_date)
        ->setCellValue("C".$i, $row['mb_id'])
        ->setCellValue("D".$i, $row['mb_name'])
        ->setCellValue("E".$i, $row['order_post']." ".$row['order_addr1']." ".$row['order_addr2'])
        ->setCellValue("F".$i, $row['order_name'])
        ->setCellValue("G".$i, $row['order_tel'])
        ->setCellValue("H".$i, $row['delivery_date'])
        ->setCellValue("I".$i, $row['order_memo'])
        ->setCellValue("J".$i, $row['do_name'])
        ->setCellValue("K".$i, number_format($row['order_amount']))
        ->setCellValue("L".$i, number_format($row['total_price']))
        ->setCellValue("M".$i, number_format($row['total_price']/10))
        ->setCellValue("N".$i, number_format($row['total_price']+($row['total_price']/10)));

    $no++;
    $total_a += $row['order_amount'];
    $total_b += $row['total_price'];
    $total_c += $row['total_price']/10;
    $total_d += $row['total_price'] + ($row['total_price']/10);
}

// 마지막 행 합계 표시
$num = sql_num_rows($result);
$num = $num+2;
$excel->setActiveSheetIndex(0)
    ->setCellValue("A".$num, "")
    ->setCellValue("B".$num, "")
    ->setCellValue("C".$num, "")
    ->setCellValue("D".$num, "")
    ->setCellValue("E".$num, "")
    ->setCellValue("F".$num, "")
    ->setCellValue("G".$num, "")
    ->setCellValue("H".$num, "")
    ->setCellValue("I".$num, "")
    ->setCellValue("J".$num, "")
    ->setCellValue("K".$num, number_format($total_a))
    ->setCellValue("L".$num, number_format($total_b))
    ->setCellValue("M".$num, number_format($total_c))
    ->setCellValue("N".$num, number_format($total_d));

//=========================================================================

/**
 * 행사용
 */
// 첫번째 행 지정
$sql = " select ord.*, do.do_category, mb.mb_name {$sql_common} {$sql_search} and do.do_category = '행사용' {$sql_order} ";
$result = sql_query($sql);

$sheet2 = $excel->createSheet(1);
$sheet2-> setCellValue("A1", "No.")
    -> setCellValue("B1", "주문일")
    -> setCellValue("C1", "주문자아이디")
    -> setCellValue("D1", "업체명&현장명")
    -> setCellValue("E1", "주문배송지")
    -> setCellValue("F1", "받는사람")
    -> setCellValue("G1", "연락처")
    -> setCellValue("H1", "행사날짜")
    -> setCellValue("I1", "행사시간")
    -> setCellValue("J1", "메모")
    -> setCellValue("K1", "메뉴명")
    -> setCellValue("L1", "수량")
    -> setCellValue("M1", "금액")
    -> setCellValue("N1", "부가세")
    -> setCellValue("O1", "합계");

$no = 1;
$total_a = 0; // 수량
$total_b = 0; // 금액
$total_c = 0; // 부가세
$total_d = 0; // 합계
for ($i=2; $row=sql_fetch_array($result); $i++) {
    $sheet2->setCellValue("A".$i, $no)
        ->setCellValue("B".$i, $order_date)
        ->setCellValue("C".$i, $row['mb_id'])
        ->setCellValue("D".$i, $row['mb_name'])
        ->setCellValue("E".$i, $row['order_post']." ".$row['order_addr1']." ".$row['order_addr2'])
        ->setCellValue("F".$i, $row['order_name'])
        ->setCellValue("G".$i, $row['order_tel'])
        ->setCellValue("H".$i, $row['event_date'])
        ->setCellValue("I".$i, $row['event_time'])
        ->setCellValue("J".$i, $row['order_memo'])
        ->setCellValue("K".$i, $row['do_name'])
        ->setCellValue("L".$i, number_format($row['order_amount']))
        ->setCellValue("M".$i, number_format($row['total_price']))
        ->setCellValue("N".$i, number_format($row['total_price']/10))
        ->setCellValue("O".$i, number_format($row['total_price']+($row['total_price']/10)));

    $no++;
    $total_a += $row['order_amount'];
    $total_b += $row['total_price'];
    $total_c += $row['total_price']/10;
    $total_d += $row['total_price'] + ($row['total_price']/10);
}

// 마지막 행 합계 표시
$num = sql_num_rows($result);
$num = $num+2;
$excel->setActiveSheetIndex(1)
    ->setCellValue("A".$num, "")
    ->setCellValue("B".$num, "")
    ->setCellValue("C".$num, "")
    ->setCellValue("D".$num, "")
    ->setCellValue("E".$num, "")
    ->setCellValue("F".$num, "")
    ->setCellValue("G".$num, "")
    ->setCellValue("H".$num, "")
    ->setCellValue("I".$num, "")
    ->setCellValue("J".$num, "")
    ->setCellValue("K".$num, "")
    ->setCellValue("L".$num, number_format($total_a))
    ->setCellValue("M".$num, number_format($total_b))
    ->setCellValue("N".$num, number_format($total_c))
    ->setCellValue("O".$num, number_format($total_d));

//=========================================================================

/**
 * 샐러드팩
 */
$sql = " select ord.*, do.do_category, mb.mb_name {$sql_common} {$sql_search} and do.do_category = '샐러드팩' {$sql_order} ";
$result = sql_query($sql);

$sheet3 = $excel->createSheet(2);
$sheet3-> setCellValue("A1", "No.")
    -> setCellValue("B1", "주문일")
    -> setCellValue("C1", "주문자아이디")
    -> setCellValue("D1", "업체명&현장명")
    -> setCellValue("E1", "주문배송지")
    -> setCellValue("F1", "받는사람")
    -> setCellValue("G1", "연락처")
    -> setCellValue("H1", "배송시작일")
    -> setCellValue("I1", "메모")
    -> setCellValue("J1", "메뉴명")
    -> setCellValue("K1", "수량")
    -> setCellValue("L1", "금액")
    -> setCellValue("M1", "부가세")
    -> setCellValue("N1", "합계");

$no = 1;
$total_a = 0; // 수량
$total_b = 0; // 금액
$total_c = 0; // 부가세
$total_d = 0; // 합계
for ($i=2; $row=sql_fetch_array($result); $i++) {
    // 주문일 - 수정된 주문은 수정일 표시
    $order_date = substr($row['wr_datetime'],0, 10);
    if($row['mod_yn'] == 'Y') {
        $order_date = substr($row['up_datetime'], 0, 10);
    }

    $sheet3->setCellValue("A".$i, $no)
        ->setCellValue("B".$i, $order_date)
        ->setCellValue("C".$i, $row['mb_id'])
        ->setCellValue("D".$i, $row['mb_name'])
        ->setCellValue("E".$i, $row['order_post']." ".$row['order_addr1']." ".$row['order_addr2'])
        ->setCellValue("F".$i, $row['order_name'])
        ->setCellValue("G".$i, $row['order_tel'])
        ->setCellValue("H".$i, $row['delivery_date'])
        ->setCellValue("I".$i, $row['order_memo'])
        ->setCellValue("J".$i, $row['do_name'])
        ->setCellValue("K".$i, number_format($row['order_amount']))
        ->setCellValue("L".$i, number_format($row['total_price']))
        ->setCellValue("M".$i, number_format($row['total_price']/10))
        ->setCellValue("N".$i, number_format($row['total_price']+($row['total_price']/10)));

    $no++;
    $total_a += $row['order_amount'];
    $total_b += $row['total_price'];
    $total_c += $row['total_price']/10;
    $total_d += $row['total_price'] + ($row['total_price']/10);
}

// 마지막 행 합계 표시
$num = sql_num_rows($result);
$num = $num+2;
$excel->setActiveSheetIndex(2)
    ->setCellValue("A".$num, "")
    ->setCellValue("B".$num, "")
    ->setCellValue("C".$num, "")
    ->setCellValue("D".$num, "")
    ->setCellValue("E".$num, "")
    ->setCellValue("F".$num, "")
    ->setCellValue("G".$num, "")
    ->setCellValue("H".$num, "")
    ->setCellValue("I".$num, "")
    ->setCellValue("J".$num, "")
    ->setCellValue("K".$num, number_format($total_a))
    ->setCellValue("L".$num, number_format($total_b))
    ->setCellValue("M".$num, number_format($total_c))
    ->setCellValue("N".$num, number_format($total_d));

//=========================================================================

// 셀 너비
for ($col = 'A'; $col <= 'O'; $col++) {
    $sheet->getColumnDimension($col)->setWidth(12);
    $sheet2->getColumnDimension($col)->setWidth(12);
    $sheet3->getColumnDimension($col)->setWidth(12);
    //$sheet->getColumnDimension($col)->setAutoSize();
    //$sheet->getStyle($col.'1')->getFont()->setSize(13)->setBold(true);
    //$sheet->getStyle($col.'2')->getFont()->setBold(true);
}
// 스타일
$sheet->getDefaultStyle()->getFont()->setName("맑은 고딕");
$sheet->getStyle('O'.$num)->getFont()->setBold(true);
$sheet2->getDefaultStyle()->getFont()->setName("맑은 고딕");
$sheet2->getStyle('O'.$num)->getFont()->setBold(true);
$sheet3->getDefaultStyle()->getFont()->setName("맑은 고딕");
$sheet3->getStyle('O'.$num)->getFont()->setBold(true);

// 시트명
$filename = '주문내역';
$sheet->setTitle('정기배달');
$sheet2->setTitle('행사용');
$sheet3->setTitle('샐러드팩');

// 첫번째 시트(Sheet)로 열리게 설정
$excel -> setActiveSheetIndex(0);

// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
//$filename = iconv("UTF-8", "EUC-KR", "주문내역");

// 브라우저로 엑셀파일을 리다이렉션
header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".$filename.".xls");
header("Cache-Control:max-age=0");

$objWriter = PHPExcel_IOFactory::createWriter($excel, "Excel5");
$objWriter -> save("php://output");

// ==========================================// ==========================================// ==========================================// ==========================================

/**
 * header 방식
 */
//header( "Content-type: application/vnd.ms-excel; charset=utf-8");
//header( "Content-Disposition: attachment; filename = 주문내역.xls" );     //filename = 저장되는 파일명을 설정합니다.
//header( "Content-Description: PHP4 Generated Data" );
//
//$sql_common = " from g5_order as ord left join g5_dosirak as do on do.idx = ord.dosirak_idx left join g5_member as mb on mb.mb_id = ord.mb_id ";
//$sql_search = " where 1=1 and ord.mb_id = '{$member['mb_id']}' and do.do_category = '정기배달' ";
//$sql_order = " order by ord.idx ";
//
//// 주문 일자 검색
//if(!empty($_REQUEST['st_date']) && !empty($_REQUEST['ed_date'])) {
//    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' and date_format(ord.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
//} else if(!empty($_REQUEST['st_date']) && empty($_REQUEST['ed_date'])) {
//    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' ";
//} else if(empty($_REQUEST['st_date']) && empty(!$_REQUEST['ed_date'])) {
//    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
//}
//
//$sql = " select ord.*, do.do_category, mb.mb_name {$sql_common} {$sql_search} {$sql_order} ";
//$result = sql_query($sql);
//
//$_excel = "
//<table border='1'>
//    <tr>
//       <td>No.</td>
//       <td>주문번호</td>
//       <td>주문일</td>
//       <td>주문자아이디</td>
//       <td>업체명&현장명</td>
//       <td>주문배송지</td>
//       <td>받는사람</td>
//       <td>연락처</td>
//       <td>배송시작일</td>
//       <td>수정일</td>
//       <td>메뉴명</td>
//       <td>수량</td>
//       <td>금액</td>
//       <td>부가세</td>
//       <td>합계</td>
//    </tr>
//";
//
//$no = 1;
//$total_a = 0; // 수량
//$total_b = 0; // 금액
//$total_c = 0; // 부가세
//$total_d = 0; // 합계
//while ($row = sql_fetch_array($result)) {
//    $_excel .= "
//    <tr>
//       <td>".$no."</td>
//       <td>".$row['order_no']."</td>
//       <td>".substr($row['wr_datetime'], 0, 10)."</td>
//       <td>".$row['mb_id']."</td>
//       <td>".$row['mb_name']."</td>
//       <td>".$row['order_post']." ".$row['order_addr1']." ".$row['order_addr2']."</td>
//       <td>".$row['order_name']."</td>
//       <td>".$row['order_tel']."</td>
//       <td>".$row['delivery_date']."</td>
//       <td>".substr($row['up_datetime'], 0, 16)."</td>
//       <td>".$row['do_name']."</td>
//       <td>".number_format($row['order_amount'])."</td>
//       <td>".number_format($row['total_price'])."</td>
//       <td>".number_format($row['total_price']/10)."</td>
//       <td>".number_format($row['total_price']+($row['total_price']/10))."</td>
//    </tr>
//    ";
//    $no++;
//
//    $total_a += $row['order_amount'];
//    $total_b += $row['total_price'];
//    $total_c += $row['total_price']/10;
//    $total_d += $row['total_price'] + ($row['total_price']/10);
//}
//
//$_excel .= "
//    <tr>
//       <td></td>
//       <td></td>
//       <td></td>
//       <td><td>
//       <td></td>
//       <td></td>
//       <td></td>
//       <td></td>
//       <td></td>
//       <td></td>
//       <td>".number_format($total_a)."</td>
//       <td>".number_format($total_b)."</td>
//       <td>".number_format($total_c)."</td>
//       <td style='font-weight: bold;'>".number_format($total_d)."</td>
//    </tr>
//    ";
//
//$_excel .= "</table>";
//
//echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
//echo $_excel;
?>
