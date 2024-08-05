<?php

include_once("./_common.php");
require_once G5_PATH."/PHPExcel/Classes/PHPExcel.php";


function column_char($i) { return chr( 65 + $i ); }

/*첫번째시트 헤더*/
$headers = array('번호','등급', '아이디', '조합원번호', '이름', '휴대폰', '관리지점', '가입일','포인트', '탈퇴일', '최종접속' );

$widths  = array(5, 10, 15, 15, 10, 20, 15, 10, 10, 10, 10, 10); //칸 넓이
$header_bgcolor = 'FFDDEBF7'; //헤더 배경색

$last_char = column_char(count($headers) - 1);

$sfl = $_REQUEST['sfl'];
$stx = $_REQUEST['stx'];
$sst = $_REQUEST['sst'];
$lv = $_REQUEST['lv'];

$sql_search = " where mb_id!='lets080' ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}


//탈퇴자만 보기
$sql_leave = "";
if ($sst == "mb_leave_date"){
    $sql_leave .= " and mb_leave_date != '' ";
}
//정상회원목록
if ($sst == "basic_mem"){
    $sql_leave .= " and mb_leave_date = '' ";
}
$sql_search = $sql_search.$sql_leave;

if ($lv != ""){
    $sql_search .= " and mb_level = '{$lv}'";
}

$sql =  "select * from g5_member {$sql_search} order by mb_datetime desc ";
$result = sql_query($sql);


for($i=0; $row=sql_fetch_array($result); $i++) {
    $no = $i+1;

    $level_text = "";
    if ($row['mb_level'] < 9){
        $level_text = $level_arr[$row['mb_level']-1];
    }else{
        $level_text = "관리자";
    }
    $leave_date = ($row['mb_leave_date'] != "") ? date("y-m-d",strtotime($row['mb_leave_date'])) : "";


    $rows[] = array($no, $level_text,$row['mb_id'],$row['mb_1'],$row['mb_name'],$row['mb_hp'],$row['mb_2'],substr($row['mb_datetime'],2,8),number_format($row['mb_point']),$leave_date,substr($row['mb_today_login'],2,8));//첫번째 시트 데이터
}


$data1 = array_merge(array($headers), $rows);


$excel = new PHPExcel();

/*sheet1*/
$excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
$excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
$excel->getActiveSheet()->fromArray($data1,NULL,'A1');
$excel->getActiveSheet()->setTitle("회원관리");

$excel->setActiveSheetIndex(0);

$filename = "[".$config['cf_title']."]회원관리_".date('Ymd',strtotime(G5_TIME_YMD)).".xls";

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-type: application/x-msexcel; charset=utf-8");
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$writer->save('php://output');
?>

