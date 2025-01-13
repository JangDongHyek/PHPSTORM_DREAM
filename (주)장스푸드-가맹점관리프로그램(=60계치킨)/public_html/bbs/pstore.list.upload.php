<?php
include_once('./_common.php');
require_once G5_PATH . '/lib/PHPExcel-1.8/Classes/PHPExcel.php';

$msg = "";
$list = array();
if ($_FILES["excel_file"]["error"] == UPLOAD_ERR_OK) {
    $filename = $_FILES['excel_file']['tmp_name'];

    // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
    $objReader = PHPExcel_IOFactory::createReaderForFile($filename);

    // 읽기전용으로 설정
    $objReader->setReadDataOnly(true);

    // 엑셀파일을 읽는다
    $objPHPExcel = $objReader->load($filename);

    // Set active sheet
    $sheet = $objPHPExcel->getActiveSheet();

    // Get the highest row number with data in the sheet
    $highestRow = $sheet->getHighestRow();

    $msg = '';

    $log_dir = '/home/chicken60/public_html/bbs/';

    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0777, true);
        chmod($log_dir, 0777);
    }

    $PageCall = date("Y-m-d [H:i:s]",time());
    $logfile = fopen( $log_dir . "pstore.list.update.log", "a+" );
    fwrite( $logfile,"************************************************\r\n");
    fwrite( $logfile,"PageCall  : ".$PageCall."\r\n");
    fwrite( $logfile,"highestRow  : ".$highestRow."\r\n");

    // Iterate through each row of the sheet
    for ($row = 2; $row <= $highestRow; $row++) { // Start from 2nd row because 1st row is the header
        $mb_2 = $sheet->getCellByColumnAndRow(0, $row)->getValue();
        $point_plus = $sheet->getCellByColumnAndRow(2, $row)->getValue();
        $point_minus = $sheet->getCellByColumnAndRow(3, $row)->getValue();
        $po_etc = $sheet->getCellByColumnAndRow(4, $row)->getValue();

        if(!$point_plus && !$point_minus){
            continue;
        }

        $sql = "SELECT * from g5_member where mb_2 = '{$mb_2}' limit 1";
        $mb = sql_fetch($sql);
        $expire = $config['cf_point_term'];
        $mb_id = $mb['mb_id'];

        fwrite( $logfile,"mb_2  : ".$mb_2."\r\n");
        fwrite( $logfile,"point_plus  : ".$point_plus."\r\n");
        fwrite( $logfile,"point_minus  : ".$point_minus."\r\n");
        fwrite( $logfile,"po_etc  : ".$po_etc."\r\n");
        fwrite( $logfile,"sql  : ".$sql."\r\n");
        fwrite( $logfile,"cf_point_term  : ".$config['cf_point_term']."\r\n");
        //fwrite( $logfile,"mb  : ".print_r($mb,true)."\r\n");


        $mb_2 = trim($mb_2);
        $point_plus = str_replace( array(',',' '), '', $point_plus);
        $point_minus = str_replace(array(',',' ','-'), '', $point_minus);
        $point_minus = $point_minus * -1 ;

        $po_etc = trim($po_etc);

        fwrite( $logfile,"mb_id  : ".$mb_id."\r\n");
        fwrite( $logfile,"row  : ".$row."\r\n");
        fwrite( $logfile,"mb  : ".$mb."\r\n");

        if(abs($point_minus) > 0){
            $po_type = "차감";
            $po_content = '지점별 마일리지차감';
            insert_point2($mb_id, $point_minus, $po_content, '@excel', $mb_id, $member['mb_id'].'-'.uniqid(''), $expire, $po_type, $po_etc);

        }

        if(abs($point_plus) > 0){
            $po_type = "발급";
            $po_content = '지점별 마일리지지급';
            insert_point2($mb_id, $point_plus, $po_content, '@excel', $mb_id, $member['mb_id'].'-'.uniqid(''), $expire, $po_type, $po_etc);
        }

    }

    fwrite( $logfile,"msg  : ".$msg."\r\n");
    fwrite( $logfile,"************************************************");
    fclose( $logfile );

} else {
    echo "파일 업로드 중 오류가 발생했습니다: " . $_FILES["excel_file"]["error"];
}

echo $msg;