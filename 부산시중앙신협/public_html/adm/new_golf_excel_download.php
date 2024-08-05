<?php

include_once("./_common.php");
require_once G5_PATH."/PHPExcel/Classes/PHPExcel.php";

function column_char($i) { return chr( 65 + $i ); }

/*첫번째시트 헤더*/
$headers = array('No','예약상황', '예약장소','예약날짜',"예약시간", '결제방법', '고객아이디/등급/조합원번호',"고객이름", "휴대폰번호", '접수일');
$widths  = array(5, 10, 15,15,10, 15, 30, 15, 25,15); //칸 넓이
$header_bgcolor = 'FFDDEBF7'; //헤더 배경색

$last_char = column_char(count($headers) - 1);

$sfl = $_REQUEST['sfl'];
$stx = $_REQUEST['stx'];
$room = $_REQUEST["room"];
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


if ($room != ""){
    $sql_search .= "and gr_room = ".$room;
}

if ($start_date != "" && $end_date != ""){
    $sql_search .= " and date_format(gr_date, '%Y-%m-%d') >= '{$start_date}'
                    AND date_format(gr_date, '%Y-%m-%d') <= '{$end_date}' ";
}

if ($wr_start_date != "" && $wr_end_date != ""){
    $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') >= '{$wr_start_date}'
                    AND date_format(wr_datetime, '%Y-%m-%d') <= '{$wr_end_date}' ";
}

$sql =  "select * from new_golf_reserve gr left join g5_member mem on gr.mb_id = mem.mb_id {$sql_search} order by gr_idx desc ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    $no = $i+1;
    $proc = ($row['gr_proc'] == "comp") ? "예약완료" : "예약취소";
    if ($row["gr_room"] > 3){
        if ($row["gr_time"] == 1) {
            $row["gr_time"] ="오전(9시~13시)";
        }elseif ($row["gr_time"] == 2){
            $row["gr_time"] ="오후(13시~18시)";
        }
    }else{
        $row["gr_time"] = $reserve_time_arr[$row["gr_time"]];
    }

    $rows[] = array($no, $proc,$gr_room_arr[$row["gr_room"]],$row["gr_date"],$row["gr_time"],$method_arr[$row["gr_payment_method"]],$row["mb_id"]."/".$level_arr[$row["mb_level"]-1]."/".$row["mb_1"],$row["mb_name"],$row["mb_hp"],substr($row['wr_datetime'],2,8));//첫번째 시트 데이터
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
$filename = "[".$config['cf_title']."]더골프예약관리".date('Ymd',strtotime(G5_TIME_YMD)).".xls";

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-type: application/x-msexcel; charset=utf-8");
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$writer->save('php://output');

?>

