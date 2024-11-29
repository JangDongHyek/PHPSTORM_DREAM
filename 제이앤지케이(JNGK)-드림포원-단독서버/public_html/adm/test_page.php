<?php
include_once("./_common.php");

phpinfo();

exit;

/*// 예약시간설정 g5_lesson_time_set_pro (오전 6시~오후 11시 기본 설정)
$cnt = sql_fetch(" select count(*) as cnt from g5_lesson_time_set_pro where mb_no = '19228' ")['cnt'];
if($cnt == 0) {
    $rlt = sql_query(" select * from g5_lesson_time_set; ");
    for($i=0; $row=sql_fetch_array($rlt); $i++) {
        $sql = " insert into g5_lesson_time_set_pro set mb_no = 19228, time_set_idx = {$row['idx']}, use_yn = 'Y', reg_date = now(); ";
        sql_query($sql);
    }
}*/

exit;

$lesson_end_date = '2022-03-04';

// 미등록회원 = 마지막 레슨 종료일로부터 100일 이내 등록 안하면 미등록
// 휴면회원 = 마지막 레슨 종료일로부터 100일 지나면 휴면
$timestamp = strtotime($lesson_end_date . " +31 days");
$no_register_date = date('Y-m-d', $timestamp);

echo $no_register_date;
exit;

ini_set('memory_limit', '1024M');

// PHPExcel.php 파일 경로 지정
include_once("../lib/PHPExcel/PHPExcel.php");
include_once("../lib/PHPExcel/PHPExcel/IOFactory.php");

$filename = '../ns_aca.xlsx';

$objPHPExcel = new PHPExcel();

try {
    // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
    $objReader = PHPExcel_IOFactory::createReaderForFile($filename);

    // 읽기전용으로 설정
    $objReader->setReadDataOnly(true);

    // 엑셀파일을 읽는다
    $objExcel = $objReader->load($filename);

    // 첫번째 시트를 선택
    $objExcel->setActiveSheetIndex(0); // ** 여러 시트 있을 경우 시트 변경 필수!! **

    $objWorksheet = $objExcel->getActiveSheet();
    $rowIterator = $objWorksheet->getRowIterator();

    foreach ($rowIterator as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
    }

    $maxRow = $objWorksheet->getHighestRow();

//    echo $maxRow . "<br>";
//    exit;

    for ($i = 3 ; $i <= $maxRow ; $i++) {
        $a = $objWorksheet->getCell('A' . $i)->getValue(); // A열 -- 등록일
        $b = $objWorksheet->getCell('B' . $i)->getValue(); // B열 -- 프로명
        $c = $objWorksheet->getCell('C' . $i)->getValue(); // C열 -- 회원명
        $d = $objWorksheet->getCell('D' . $i)->getValue(); // D열 -- 구분
        $e = $objWorksheet->getCell('E' . $i)->getValue(); // E열 -- 레슨유형
        $n = $objWorksheet->getCell('N' . $i)->getValue(); // N열 -- 핸드폰
        $o = $objWorksheet->getCell('O' . $i)->getValue(); // O열 -- 주소

        // 날짜 형태의 셀을 읽을때는 toFormattedString를 사용한다.
        $a = PHPExcel_Style_NumberFormat::toFormattedString($a, 'YYYY-MM-DD');
//        echo $a . " / " . $b. " / " . $c . " / " . $d . " / " . $e . " / " . $n . " / " . $o . " <br>\n";
//        exit;

        $a  = addslashes(trim($a));
        $b  = addslashes(trim($b));
        $c  = addslashes(trim($c));
        $d  = addslashes(trim($d));
        $e  = addslashes(trim($e));
        $n  = addslashes(trim($n));
        $o  = addslashes(trim($o));

        // DB INSERT -- 회원명 없으면 안넣음
        if(!empty($c))
        {
            $pro = sql_fetch(" select * from g5_member where mb_name = '{$b}' and center_code = 'center4' and mb_category ='프로' ; "); // 프로 정보

//            echo $pro['mb_no'];exit;
            if(!empty($pro['mb_no']))
            {
                $mb_state = ($d == '재등록') ? 're_member' : 'new_member'; // 회원구분
                $mb_option = ($d != '재등록') ? $d : ''; // 지정/배정

                //-- 회원번호 생성
                $count = sql_fetch(" select count(*) as count from g5_member where mb_level != 10; ")['count'];

                if($count == 0) {
                    $mb_id_no = '000001';
                } else {
                    $sql = " select max(mb_id_no) as mb_id_no from g5_member ";
                    $temp = sql_fetch($sql)['mb_id_no'];
                    $temp++;

                    $mb_id_no = sprintf('%06d',$temp);
                }
                //-- 회원번호 생성

                //-- 회원아이디 생성
                if($pro['center_code'] == 'center1') { // 워커힐
                    $ini = 'wk';
                } else if($pro['center_code'] == 'center2') { // 세종
                    $ini = 'sj';
                } else if($pro['center_code'] == 'center3') { // 북악
                    $ini = 'bu';
                } else if($pro['center_code'] == 'center4') { // 남서울
                    $ini = 'ns';
                } else if($pro['center_code'] == 'center5') { // 삼성
                    $ini = 'ss';
                } else if($pro['center_code'] == 'center6') { // 부산
                    $ini = 'bs';
                } else if($pro['center_code'] == 'center7') { // 초안산
                    $ini = 'co';
                }
                $cnt = sql_fetch(" select max(substring(mb_id, 3,4)) as cnt from g5_member where substring(mb_id, 1,2) = '{$ini}' and mb_category = '회원' ; ")['cnt'];

                $init = '';
                if(empty($cnt)) {
                    $mb_id = $ini.'0001';
                } else {
                    $cnt++;
                    $mb_id = $ini.sprintf('%04d',$cnt);
                }
//                echo $mb_id;exit;
                //-- 회원아이디 생성

                //-- 동명이인 체크 (이름, 휴대폰번호) , 이름+휴대폰번호가 같으면 update, 안같으면 insert
                $count = sql_fetch(" select count(*) as count from g5_member where mb_name = '{$c}' and mb_hp = '{$n}'; ")['count'];

                if($count == 0) { // 신규 -- 구분 값 지정 또는 배정
                    // ** 레슨 정보가 없기 때문에 미등록회원, 휴면회원체크할 수 없음
                    // ** 구분에 재등록회원은 재등록으로, 지정/배정은 신규로 입력
                    // ** 각 아카데미 별 아이디로 사용할 이니셜 및 아이디 형식
                    $sql = " insert into g5_member set pro_mb_no = {$pro['mb_no']}, mb_charge_pro = '{$b}', mb_center = '{$pro['mb_center']}', center_code = '{$pro['center_code']}',
                     mb_name = '{$c}', mb_reg_date = '{$a}', mb_state = '{$mb_state}', mb_option = '{$mb_option}', mb_level = 2, mb_category = '회원', mb_hp = '{$n}', mb_addr1 = '{$o}',
                     mb_id = '{$mb_id}', mb_id_no = '{$mb_id_no}', mb_password = '".get_encrypt_string('0000')."', mb_datetime = '".G5_TIME_YMDHIS."', etc = 'excel'  ";
                    sql_query($sql);
                    $mb_no = sql_insert_id();

                    $sql = " insert into g5_member_history set mb_no = {$mb_no}, mb_state = '{$mb_state}', 
                     center_name = '{$pro['mb_center']}', center_code = '{$pro['center_code']}', lesson_start_date = '{$a}', reg_date = '".G5_TIME_YMDHIS."', etc = 'excel' ";
                    sql_query($sql);
                }
                else { // 재등록 -- 구분 값 재등록
                    $mb = sql_fetch( " select * from g5_member where mb_name = '{$c}' and mb_hp = '{$n}'; ");

                    $sql = " update g5_member set pro_mb_no = {$pro['mb_no']}, mb_charge_pro = '{$b}', mb_reg_date = '{$a}', 
                     mb_state = '{$mb_state}', mb_option = '{$mb_option}', mb_addr1 = '{$o}'
                     where mb_no = {$mb['mb_no']} ";
                    sql_query($sql);

                    $sql = " insert into g5_member_history set mb_no = {$mb['mb_no']}, mb_state = '{$mb_state}', 
                     center_name = '{$pro['mb_center']}', center_code = '{$pro['center_code']}', lesson_start_date = '{$a}', reg_date = '".G5_TIME_YMDHIS."', etc = 'excel' ";
                    sql_query($sql);
                }
                //-- 동명이인 체크 (이름, 휴대폰번호)
            }

        }
    }

    echo $maxRow-2 . " Data inserting finished !";

} catch (exception $e) {
    echo '엑셀파일을 읽는도중 오류가 발생하였습니다.!';
}



//$today = date('Y-m-d');
//
//$sql = " select * from g5_member where mb_category='회원' and center_code = '{$member['center_code']}' ";
//$result = sql_query($sql);
//
//for($i=0; $row=sql_fetch_array($result); $i++) {
//    if(!empty($row['no_register_date'])) {
//        if($row['mb_state'] == 'new_member' || $row['mb_state'] == 're_member') { // 신규나 재등록 회원 중
//            if($today > $row['lesson_end_date']) { // 금일이 레슨종료일 이후면 미등록 회원으로 전환시킬 것
//                $sql = " update g5_member set mb_state = 'no_register' where mb_no = {$row['mb_no']} ";
//                sql_query($sql);
//            }
//        }
//
//        if($row['mb_state'] == 'no_register') { // 미등록 회원 중
//            if($today > $row['no_register_date']) { // 금일이 휴면회원전환일 이후면 휴면회원으로 전환시킬 것
//                $sql = " update g5_member set mb_state = 'no_long_register' where mb_no = {$row['mb_no']} ";
//                sql_query($sql);
//            }
//        }
//    }
//}


//$sql = " select * from g5_member where mb_category = '프로' ";
//$result = sql_query($sql);
//
//for($i=0; $row=sql_fetch_array($result); $i++) {
//    for($k=1; $k<=35; $k++) {
//        $sql = " insert into g5_lesson_time_set_pro set mb_no = {$row['mb_no']}, time_set_idx = {$k}, use_yn = 'Y', reg_date = now(); ";
//        sql_query($sql);
//    }
//}


//$sql = " select * from g5_member where mb_category = '회원' ";
//$result = sql_query($sql);
//
//for($i=0; $row=sql_fetch_array($result); $i++) {
//    $idx = sql_fetch(" select idx from g5_lesson where lesson_code = '{$row['lesson_code']}' and center_code = '{$row['center_code']}' ")['idx'];
//
//    $sql = " update g5_member set lesson_idx = {$idx} where mb_no = {$row['mb_no']} ";
//    sql_query($sql);
//}


//$mb_no = $member['mb_no'];
//$mb = get_member_no($mb_no);
//
//$lesson = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' and center_code = '{$mb['center_code']}' "); // 레슨정보
//
//// === 21.01.14 레슨 기간 제한, 예) 2020-10-22일 3개월 레슨 등록, 2021-02-04일까지 예약 가능 (3개월+10(유예기간))
//$pattern = '/([a-zA-Z0-9])+/';
//$lesson_count = explode('/', $lesson['lesson_count'])[1];
//preg_match_all($pattern, $lesson_count, $match);
//$term_1 = implode('', $match[0]);
//
//if(strpos($lesson_count, '주') !== false) {
//    $term = 'week';
//} else if(strpos($lesson_count, '개월') !== false) {
//    $term = 'months';
//} else if(strpos($lesson_count, '년') !== false) {
//    $term = 'years';
//}
//
//echo $term;
?>
