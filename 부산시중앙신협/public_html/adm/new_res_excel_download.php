<?php

include_once("./_common.php");
require_once G5_PATH."/PHPExcel/Classes/PHPExcel.php";

function column_char($i) { return chr( 65 + $i ); }

/*첫번째시트 헤더*/
$headers = array('no','예약상황', '창구','예약날짜',"예약시간", '고객아이디/등급/조합원번호', '고객이름', "방문사유","휴대폰번호", '접수일');
$widths  = array(5, 10, 10,15,10, 25, 10, 15, 25,15); //칸 넓이
$header_bgcolor = 'FFDDEBF7'; //헤더 배경색

$last_char = column_char(count($headers) - 1);


$sfl = $_REQUEST['sfl'];
$stx = $_REQUEST['stx'];
$window = $_REQUEST["window"];
$start_date = $_REQUEST["start_date"];
$end_date = $_REQUEST["end_date"];

$sql_search = " where 1=1 ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}


if ($window != ""){
    $sql_search .= "and pr_window = ".$window;
}

if ($start_date != "" && $end_date != ""){
    $sql_search .= " and date_format(pr_date, '%Y-%m-%d') >= '{$start_date}'
                    AND date_format(pr_date, '%Y-%m-%d') <= '{$end_date}' ";
}


$sql =  "select * from new_private_reserve pr left join g5_member mem on pr.mb_id = mem.mb_id {$sql_search} order by pr_idx desc ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    $no = $i+1;
    $proc = ($row['pr_proc'] == "comp") ? "예약완료" : "예약취소";

    $rows[] = array($no, $proc,$pr_window_arr[$row["pr_window"]],$row["pr_date"],$row["pr_time"],$row["mb_id"]."/".$level_arr[$row["mb_level"]-1]."/".$row["mb_1"],$row["mb_name"],$row["pr_memo"],$row["mb_hp"],substr($row['wr_datetime'],2,8));//첫번째 시트 데이터
}


$data1 = array_merge(array($headers), $rows);

$excel = new PHPExcel();

/*sheet1*/
$excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
$excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
$excel->getActiveSheet()->fromArray($data1,NULL,'A1');
$excel->getActiveSheet()->setTitle("예약관리");

$excel->setActiveSheetIndex(0);
$filename = "[".$config['cf_title']."]프라이빗예약관리_".date('Ymd',strtotime(G5_TIME_YMD)).".xls";

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-type: application/x-msexcel; charset=utf-8");
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$writer->save('php://output');


?>

