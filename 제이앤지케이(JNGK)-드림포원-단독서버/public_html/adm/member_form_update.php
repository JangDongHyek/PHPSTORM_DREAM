<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

@mkdir(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);

//print_r($_FILES['file']);exit;
//print_r($_POST);exit;

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

//check_admin_token();

$mb_id = trim($_POST['mb_id']);
$mb_no = trim($_POST['mb_no']);

if($_POST['mb_state'] == 'one_point_lesson') {
//    $mb_hp = hyphen_hp_number($_POST['mb_hp2']); // 휴대폰번호 체크
    $mb_hp = $_POST['mb_hp4'].'-'.$_POST['mb_hp5'].'-'.$_POST['mb_hp6'];
    $mb_name = $_POST['mb_name2'];
    $mb_notice = $_POST['mb_notice2'];
    $pro_mb_no = $_POST['pro_mb_no2'];
    $lesson_idx = $_POST['lesson_idx2'];
    $mb_center = $_POST['mb_center2'];
    $mb_option = $_POST['mb_option2'];

    // 매출관리 DB
    $cash_price = str_replace(',', '', $_POST['cash_price2']);
    $card_price = str_replace(',', '', $_POST['card_price2']);
    $fees = str_replace(',', '', $_POST['fees2']);
    $card_company = $_POST['card_company2'];
    $pay_option = $_POST['pay_option2'];
} else {
//    $mb_hp = hyphen_hp_number($_POST['mb_hp']); // 휴대폰번호 체크
    $mb_hp = $_POST['mb_hp1'].'-'.$_POST['mb_hp2'].'-'.$_POST['mb_hp3'];
    $mb_name = $_POST['mb_name'];
    $mb_notice = $_POST['mb_notice'];
    $pro_mb_no = $_POST['pro_mb_no'];
    $lesson_idx = $_POST['lesson_idx'];
    $mb_center = $_POST['mb_center'];
    $mb_option = $_POST['mb_option'];

    // 매출관리 DB
    $cash_price = str_replace(',', '', $_POST['cash_price']);
    $card_price = str_replace(',', '', $_POST['card_price']);
    $fees = str_replace(',', '', $_POST['fees']);
    $card_company = $_POST['card_company'];
    $pay_option = $_POST['pay_option'];
}

//if($mb_hp) {
//    $result = exist_mb_hp($mb_hp, $mb_id);
//    if ($result)
//        alert($result);
//}

// 생년월일
$mb_birth = $_POST['birth_year'].'.'.$_POST['birth_month'].'.'.$_POST['birth_day'];
if($mb_birth == '..') { $mb_birth = ''; }

//-- 회원번호 생성
$count = sql_fetch(" select count(*) as count from {$g5['member_table']} where mb_level != 10 ")['count'];

if($count == 0) {
    $mb_id_no = '000001';
} else {
    $sql = " select max(mb_id_no) as mb_id_no from {$g5['member_table']} ";
    $temp = sql_fetch($sql)['mb_id_no'];
    $temp++;

    $mb_id_no = sprintf('%06d',$temp);
}
//-- 회원번호 생성

// 담당프로명
$mb_charge_pro_name = sql_fetch(" select mb_name from {$g5['member_table']} where mb_no = '{$pro_mb_no}'; ")['mb_name'];
// 레슨코드
$lesson_code = sql_fetch(" select lesson_code from g5_lesson where idx = '{$lesson_idx}'; ")['lesson_code'];

// 회원 상품 구분마다 항목이 달라서 나눔
if($_POST['mb_state'] == 'one_point_lesson') { // 원포인트레슨
    $one_point_le_date = str_replace('-', '.' ,$_POST['one_point_le_date']);
    $sql_common = " one_point_le_date = '{$_POST['one_point_le_date']}',
                    one_point_le_time = '{$_POST['one_point_le_time']}',
                    ";
}
else { // 신규/재등록
    $sql_common = " mb_email = '{$_POST['mb_email']}',
                    mb_birth = '{$mb_birth}',
                    mb_addr1 = '{$_POST['mb_addr1']}',
                    mb_addr2 = '{$_POST['mb_addr2']}',
                    mb_recommend = '{$_POST['mb_recommend']}',
                    mb_score = '{$_POST['mb_score']}',
                    mb_career = '{$_POST['mb_career']}', 
                    mb_lesson = '{$_POST['mb_lesson']}',
                    mb_lesson_de = '{$_POST['mb_lesson_de']}',
                    mb_rounding = '{$_POST['mb_rounding']}',
                    mb_wish = '{$_POST['mb_wish']}',
                    ";
}
// 공통
$sql_common .= " mb_name = '{$mb_name}',
                 mb_hp = '{$mb_hp}',
                 mb_charge_pro = '{$mb_charge_pro_name}',
                 pro_mb_no = '{$pro_mb_no}',
                 mb_notice = '{$mb_notice}',
                 mb_state = '{$_POST['mb_state']}',
                 mb_category = '회원',
                 mb_level = '{$_POST['mb_level']}',
                 lesson_code = '{$lesson_code}',
                 mb_center = '{$mb_center}',
                 center_code = '{$_POST['center_code']}',
                 lesson_idx = '{$lesson_idx}',
                 mb_option = '{$mb_option}'
                 ";

// === ** 프로 수당 별도 계산 ** ==> 프로 전체 매출로 적용할 수당(%)를 구하여 계산, 레슨 금액에 퍼센트 적용 ===

$sales_idx = sql_fetch(" select sales_idx from g5_member where mb_no = {$mb_no}; ")['sales_idx']; // 회원 정보 - 매출 idx

if($w == '' || $_POST['mb_re_reg_date'] == 'Y' || empty($sales_idx)) // 등록(+재등록)
{
    $sql = " select * from g5_pro_extra_pay where pro_mb_no = {$pro_mb_no} order by idx "; // 프로 수당 설정 정보 DB
    $result = sql_query($sql);

    $search = date('Y-m');
    $sql = " select sum(cash_price) as cash_price, sum(credit_card_price) as credit_price, sum(check_card_price) as check_price 
             from g5_sales 
             where pro_mb_no = {$pro_mb_no} and date_format(pay_date, '%Y-%m') = '{$search}' "; // 프로 매출 정보 DB
    $sales = sql_fetch($sql);
    $pro_sales = (int)$sales['cash_price'] + (int)$sales['credit_price'] + (int)$sales['check_price'] - (int)$sales['fees']; // 프로의 금월 총 매출 (수수료는 제외)

    $pay_percent = 0;
    $headoffice_pay_percent = 100 - $pay_percent;
    for($i=0; $extra_pay=sql_fetch_array($result);$i++) {
        if(!empty($extra_pay['min_price']) && !empty($extra_pay['max_price'])) { // 예) 100,000 ~ 200,000
            if($extra_pay['min_price'] <= $pro_sales && $pro_sales <= $extra_pay['max_price']) { // min_price <= 총매출 <= max_price
                $pay_percent = $extra_pay['pay_percent']; // 레슨 금액에 적용할 수당(%)
                $headoffice_pay_percent = 100 - $pay_percent;
            }
        }
        else if(!empty($extra_pay['min_price']) && empty($extra_pay['max_price'])) { // 예) 100,000 ~
            if($extra_pay['min_price'] <= $pro_sales) { // min_price <= 총매출
                $pay_percent = $extra_pay['pay_percent']; // 레슨 금액에 적용할 수당(%)
                $headoffice_pay_percent = 100 - $pay_percent;
            }
        }
        else if(empty($extra_pay['min_price']) && !empty($extra_pay['max_price'])) { // 예) ~ 200,000
            if($pro_sales <= $extra_pay['max_price']) { // 총매출 <= max_price
                $pay_percent = $extra_pay['pay_percent']; // 레슨 금액에 적용할 수당(%)
                $headoffice_pay_percent = 100 - $pay_percent;
            }
        }
    }

    $total_price = (int)$card_price - (int)$fees; // 레슨 합계 금액 (수수료는 제외)
    $pay_extra_pay = '';
    if(!empty($pay_percent)) { // 수당(%) 있을 시 적용
        $pay_extra_pay = $total_price * (int)$pay_percent / 100; // 레슨 합계 금액에 수당(%) 적용
    }

    if($pay_option == "현금" || $pay_option == "현금+신용카드" || $pay_option == "현금+체크카드") { // 본사지급액
        $total_price = (int)$cash_price; // 레슨 합계 금액 (수수료는 제외)

        $headoffice_pay = '';
        if(!empty($headoffice_pay_percent)) { // 수당(%) 있을 시 적용
            $headoffice_pay = $total_price * (int)$headoffice_pay_percent / 100; // 레슨 합계 금액에 수당(%) 적용
        }
    } else {
        $headoffice_pay_percent = 0;
    }
}
else if($w == 'u') // 수정 -- 수정 시 등록 당시 적용한 퍼센트로 재계산
{
    $sales = sql_fetch(" select * from g5_sales where idx = {$sales_idx}; "); // 매출 정보

    // 수정하는데 프로가 변경되면 퍼센트 다시 구함
    if($pro_mb_no != $salse['pro_mb_no']) {
        $sql = " select * from g5_pro_extra_pay where pro_mb_no = {$pro_mb_no} order by idx "; // 프로 수당 설정 정보 DB
        $result = sql_query($sql);

        $search = date('Y-m');
        $sql = " select sum(cash_price) as cash_price, sum(credit_card_price) as credit_price, sum(check_card_price) as check_price 
                 from g5_sales
                 where pro_mb_no = {$pro_mb_no} and date_format(pay_date, '%Y-%m') = '{$search}' "; // 프로 매출 정보 DB
        $sales = sql_fetch($sql);
        $pro_sales = (int)$sales['cash_price'] + (int)$sales['credit_price'] + (int)$sales['check_price'] - (int)$sales['fees']; // 프로의 금월 총 매출 (수수료는 제외)

        $pay_percent = 0;
        $headoffice_pay_percent = 100 - $pay_percent;
        for($i=0; $extra_pay=sql_fetch_array($result);$i++) {
            if(!empty($extra_pay['min_price']) && !empty($extra_pay['max_price'])) { // 예) 100,000 ~ 200,000
                if($extra_pay['min_price'] <= $pro_sales && $pro_sales <= $extra_pay['max_price']) { // min_price <= 총매출 <= max_price
                    $pay_percent = $extra_pay['pay_percent']; // 레슨 금액에 적용할 수당(%)
                    $headoffice_pay_percent = 100 - $pay_percent;
                }
            }
            else if(!empty($extra_pay['min_price']) && empty($extra_pay['max_price'])) { // 예) 100,000 ~
                if($extra_pay['min_price'] <= $pro_sales) { // min_price <= 총매출
                    $pay_percent = $extra_pay['pay_percent']; // 레슨 금액에 적용할 수당(%)
                    $headoffice_pay_percent = 100 - $pay_percent;
                }
            }
            else if(empty($extra_pay['min_price']) && !empty($extra_pay['max_price'])) { // 예) ~ 200,000
                if($pro_sales <= $extra_pay['max_price']) { // 총매출 <= max_price
                    $pay_percent = $extra_pay['pay_percent']; // 레슨 금액에 적용할 수당(%)
                    $headoffice_pay_percent = 100 - $pay_percent;
                }
            }
        }
    }
    else {
        $pay_percent = $sales['pay_percent']; // 등록 당시 적용한 퍼센트로 재계산 (프로 변경하지 않을 경우)
    }

    $total_price = (int)$card_price - (int)$fees; // 레슨 합계 금액 (수수료는 제외)
    $pay_extra_pay = '';
    if(!empty($pay_percent)) { // 수당(%) 있을 시 적용
        $pay_extra_pay = $total_price * (int)$pay_percent / 100; // 레슨 합계 금액에 수당(%) 적용
    }

    if($pay_option == "현금" || $pay_option == "현금+신용카드" || $pay_option == "현금+체크카드") { // 본사지급액
        $total_price = (int)$cash_price; // 레슨 합계 금액 (수수료는 제외)

        $headoffice_pay_percent = 100 - $pay_percent; // 등록 당시 적용한 퍼센트로 재계산
        $headoffice_pay = '';
        if(!empty($headoffice_pay_percent)) { // 수당(%) 있을 시 적용
            $headoffice_pay = $total_price * (int)$headoffice_pay_percent / 100; // 레슨 합계 금액에 수당(%) 적용
        }
    } else {
        $headoffice_pay_percent = 0;
    }
}

// === ** 프로 수당 별도 계산 ** ==> 프로 전체 매출로 적용할 수당(%)를 구하여 계산, 레슨 금액에 퍼센트 적용 ===

// === 매출관리 DB ===
if($pay_option == '현금') {
    $sql_common2 = " cash_price = '{$cash_price}', credit_card_price = '', check_card_price = '', ";
} else if($pay_option == '신용카드') {
    $sql_common2 = " cash_price = '', credit_card_price = '{$card_price}', check_card_price = '', ";
} else if($pay_option == '체크카드') {
    $sql_common2 = " cash_price = '', credit_card_price = '', check_card_price = '{$card_price}', ";
} else if($pay_option == '현금+신용카드') {
    $sql_common2 = " cash_price = '{$cash_price}', credit_card_price = '{$card_price}', check_card_price = '', ";
} else { // 현금+체크카드
    $sql_common2 = " cash_price = '{$cash_price}', credit_card_price = '', check_card_price = '{$card_price}', ";
}
$sql_common2 .= " fees = '{$fees}',
                  card_company = '{$card_company}',
                  mb_state = '{$_POST['mb_state']}',
                  center_code = '{$_POST['center_code']}',
                  pay_option = '{$pay_option}',
                  pro_mb_no = '{$pro_mb_no}',
                  pro_extra_pay = '{$pay_extra_pay}',
                  pay_percent = '{$pay_percent}',
                  headoffice_pay = '{$headoffice_pay}',
                  headoffice_pay_percent = '{$headoffice_pay_percent}'
                  ";
// === 매출관리 DB ===

// === 21.01.14 레슨 기간 제한, 예) 2020-10-22일 3개월 레슨 등록, 2021-02-01일까지 예약 가능 (3개월+10(유예기간))
$lesson = sql_fetch(" select * from g5_lesson where idx = {$lesson_idx}; "); // 레슨정보

$pattern = '/([a-zA-Z0-9])+/';
$lesson_count = explode('/', $lesson['lesson_count'])[1];
preg_match_all($pattern, $lesson_count, $match);
$num = implode('', $match[0]);

if(strpos($lesson_count, '주') !== false) {
    $term = 'week';
} else if(strpos($lesson_count, '개월') !== false) {
    $term = 'months';
} else if(strpos($lesson_count, '년') !== false) {
    $term = 'years';
}

$lesson_start_date = !empty($_POST['lesson_start_date']) ? $_POST['lesson_start_date'] : ''; // 레슨시작일
//$timestamp = strtotime($lesson_start_date . " +" . $num . $term . " +10 days");
$timestamp = strtotime($lesson_start_date . " +" . $num . $term); // *수정접수내역 21.12.28 +10일 지급 삭제 요청 (수정 전에는 위 주석이었음)
$lesson_end_date = date('Y-m-d', $timestamp); // 레슨종료일
$g_lesson_end_date = date('Y-m-d', $timestamp); // 레슨종료일 (고정값 - 프로 회원 재등록 시 필요)





// 미등록회원 = 마지막 레슨 종료일로부터 100일 이내 등록 안하면 미등록
// 휴면회원 = 마지막 레슨 종료일로부터 100일 지나면 휴면 (레슨종료일 다음날부터 계산해야 하기 때문에 101일로 계산) ==> *수정접수내역 No.48 22.01.24 30일로 변경 (금일이 no_register_date면 휴면회원으로 변경)
$timestamp = strtotime($lesson_end_date . " +31 days");
$no_register_date = date('Y-m-d', $timestamp);
if($_POST['mb_state'] == 'one_point_lesson') {
    $lesson_start_date = $_POST['one_point_le_date'];
    $lesson_end_date = $_POST['one_point_le_date'];

    // 미등록회원 = 마지막 레슨 종료일로부터 100일 이내 등록 안하면 미등록
    // 휴면회원 = 마지막 레슨 종료일로부터 100일 지나면 휴면
    $timestamp = strtotime($lesson_end_date . " +31 days");
    $no_register_date = date('Y-m-d', $timestamp);
}
// === 21.01.14

// === 21.03.03
/*if($lesson['lesson_count'] == '1회') { // 신규나 재등록 시 원포인트 레슨 선택할 경우 레슨종료일에 레슨시작일 입력 -- 원포인트 레슨을 언제 진행하는지 모르기 때문에 레슨종료일에 시작일을 입력할 수가 없음
    $lesson_end_date = $lesson_start_date;

    // 미등록회원 = 마지막 레슨 종료일로부터 100일 이내 등록 안하면 미등록
    // 휴면회원 = 마지막 레슨 종료일로부터 100일 지나면 휴면
    $timestamp = strtotime($lesson_end_date . " +31 days");
    $no_register_date = date('Y-m-d', $timestamp);
}*/
// === 21.03.03

if ($w == '')
{
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name']);

    // ** lesson_end_date가 빈값일 경우 처음 레슨시작일로 계산한 레슨종료일을 넣음 **
    if(empty($lesson_end_date) || $lesson_end_date == '0000-00-00') {
        $lesson_end_date = $g_lesson_end_date;
        $timestamp = strtotime($lesson_end_date . " +31 days");
        $no_register_date = date('Y-m-d', $timestamp);
    }

    // 회원 정보 insert
    if($_POST['mb_state'] == 'one_point_lesson') {$mb_id = $mb_id_no; $mb_password = '0000';} // 원포인트회원 아이디 = 회원번호
    $sql = " insert into {$g5['member_table']} 
             set 
             mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', 
             mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', mb_reg_date = '".G5_TIME_YMDHIS."', mb_id_no = '{$mb_id_no}', 
             lesson_start_date = '{$lesson_start_date}', lesson_end_date = '{$lesson_end_date}', no_register_date = '{$no_register_date}', {$sql_common} ";
    sql_query($sql);

    // 23.05.17 SQL log
    sql_query("INSERT INTO sql_log SET mb_id = '{$member['mb_id']}', memo = 'g5_member', sql_text = '".addslashes($sql)."'");

    // mb_no
    $sql = " select mb_no from {$g5['member_table']} where mb_id = '{$mb_id}' and use_yn = 'Y' ";
    $mb_no = sql_fetch($sql)['mb_no'];

    // 매출 정보 저장
    $sql_add = '';
    if(empty($cash_price) && empty($card_price)) { $sql_add = ", unpaid = 'Y' "; } else { $sql_add = ", unpaid = '' "; } // 원포인트레슨 시 후납의 경우를 체크하기 위함
    $sql = " insert into g5_sales set mb_no = '{$mb_no}', pay_date = '".G5_TIME_YMDHIS."', mb_reg_date = '".G5_TIME_YMDHIS."', {$sql_common2} {$sql_add} ";
    sql_query($sql);
    $salse_idx = sql_insert_id();

    // 23.05.17 SQL log
    sql_query("INSERT INTO sql_log SET mb_id = '{$member['mb_id']}', memo = 'g5_sales', sql_text = '".addslashes($sql)."'");

    // 회원 이력 저장
    $sql = " select * from g5_lesson where lesson_code = '{$lesson_code}' and center_code='{$_POST['center_code']}'; ";
    $info = sql_fetch($sql);
    $lesson_name = $info['lesson_name'].'/'.$info['lesson_time'].'/'.$info['lesson_count'].'/'.$info['lesson_price'];
    $sql = " insert into g5_member_history set 
             mb_no = {$mb_no}, pro_mb_no = {$pro_mb_no}, mb_state = '{$_POST['mb_state']}', lesson_idx = '{$lesson_idx}', center_code = '{$_POST['center_code']}', 
             center_name = '{$mb_center}', lesson_code = '{$lesson_code}', lesson_name = '{$lesson_name}', sales_idx = {$salse_idx}, 
             lesson_start_date = '{$lesson_start_date}', lesson_end_date = '{$lesson_end_date}', reg_date = '".G5_TIME_YMDHIS."';  ";
    sql_query($sql);
    $history_idx = sql_insert_id();

    sql_query("INSERT INTO sql_log SET mb_id = '{$member['mb_id']}', memo = 'g5_member_history', sql_text = '".addslashes($sql)."'");

    // 회원 정보에 매출 idx, 이력 idx 업데이트
    $sql = " update g5_member set sales_idx = {$salse_idx}, history_idx = {$history_idx} where mb_no = {$mb_no} ";
    sql_query($sql);

    // 원포인트 레슨 등록일 경우 예약 정보 insert (g5_lesson_reser)
    if($_POST['mb_state'] == 'one_point_lesson') {
        // 동시에 예약할 수 있으므로 예약하고자 하는 시간 재확인
        $count = sql_fetch(" select count(*) as count from g5_lesson_reser where pro_mb_no = {$pro_mb_no}, time_set_idx = {$_POST['time_set_idx']} and reser_state != '예약취소'; ")['count'];

        if($count == 0) {
            $sql = " insert into g5_lesson_reser 
                     set
                     history_idx = '{$history_idx}', pro_mb_no = {$pro_mb_no}, center_code = '{$_POST['center_code']}', lesson_code = '{$lesson_code}', 
                     mb_no = {$mb_no}, time_set_idx = {$_POST['time_set_idx']}, reser_date = '{$one_point_le_date}', reser_time = '{$_POST['one_point_le_time']}', reg_date = now(), one_point = 'Y', reg_mb_id = '{$member['mb_id']}'; ";
            sql_query($sql);

            sql_query("INSERT INTO sql_log SET mb_id = '{$member['mb_id']}', memo = 'g5_lesson_reser', sql_text = '".addslashes($sql)."'");
        } else {
            alert('이미 예약된 시간입니다.');
        }
    }
}
else if ($w == 'u')
{
    $mb = get_member_no($mb_no);

    // 21.10.20 프로 변경 시 이전에 예약 데이터 삭제 (레슨완료 된 데이터 제외, history_idx를 조건으로 거는 이유는 현재 레슨의 예약 데이터만 조회하기 위함)
    if($mb['pro_mb_no'] != $pro_mb_no) {
        $sql = " delete lr from g5_lesson_reser as lr left join g5_lesson_diary as ld on ld.reser_idx = lr.idx where lr.mb_no = '{$mb['mb_no']}' and lr.history_idx = '{$mb['history_idx']}' and ld.idx is null ";
        //$sql = " update g5_lesson_reser as lr left join g5_lesson_diary as ld on lr.idx = ld.reser_idx set lr.del_yn = 'Y' where lr.mb_no = '{$mb_no}' and ld.idx is null ";
        sql_query($sql);
    }

    $post_lesson_end_date = '';
    if(empty($_POST['lesson_end_date'])) { $post_lesson_end_date = '0000-00-00'; }
    // 레슨종료일을 임의로 변경할 시 종료일 자동 계산하지 않음 (회원의 레슨종료일이 빈칸이 아닐경우 && 레슨시작일을 변경하지 않았을 경우 && 레슨상품을 변경하지 않았을 경우 && 원포인트 아닐 경우)
    if($mb['lesson_end_date'] != $post_lesson_end_date && $mb['lesson_start_date'] == $_POST['lesson_start_date'] && $mb['lesson_code'] == $lesson_code && $_POST['mb_state'] != 'one_point_lesson') {
        $lesson_end_date = $_POST['lesson_end_date']; // (프로가 재등록 시에는 $_POST['lesson_end_date']가 없음 ==> $g_lesson_end_date 사용)

        // 미등록회원 = 마지막 레슨 종료일로부터 100일 이내 등록 안하면 미등록
        // 휴면회원 = 마지막 레슨 종료일로부터 100일 지나면 휴면 ==> *수정접수내역 No.48 22.01.24 30일로 변경
        $timestamp = strtotime($lesson_end_date . " +31 days");
        $no_register_date = date('Y-m-d', $timestamp);
        //if($_POST['mb_state'] == 'one_point_lesson') { $no_register_date = ''; }
    }

    // ** lesson_end_date가 빈값일 경우 처음 레슨시작일로 계산한 레슨종료일을 넣음 **
    // 23.11.08 계산한 레슨종료일없으면 31일 추가하는거 같이넣어줌 wc
    if(empty($lesson_end_date) || $lesson_end_date == '0000-00-00' || $lesson_end_date == '1970-01-01') {

        if(empty($g_lesson_end_date) || $g_lesson_end_date == '0000-00-00' || $g_lesson_end_date == '1970-01-01'){
            $lesson_end_date = $lesson_start_date;
        }else{
            $lesson_end_date = $g_lesson_end_date;
        }
        $timestamp = strtotime($lesson_start_date . " +31 days");
        $no_register_date = date('Y-m-d', $timestamp);
        $g_lesson_end_date = date('Y-m-d', $timestamp);
    }


    /*if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');*/

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    if ($_POST['mb_id'] == $member['mb_id'] && $_POST['mb_level'] != $mb['mb_level'])
        alert($mb['mb_id'].' : 로그인 중인 관리자 레벨은 수정 할 수 없습니다.');

    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."', pw_change_pro = '".G5_TIME_YMDHIS."', pw_change_pro_data = '".get_encrypt_string($mb_password)."', pw_pre_data = '{$mb['mb_password']}' ";
    else
        $sql_password = "";

    // 매출 정보 수정
    $sql_add = '';
    if(empty($cash_price) && empty($card_price)) { $sql_add = ", unpaid = 'Y' "; } else { $sql_add = ", unpaid = '' "; } // 원포인트레슨 시 후납의 경우를 체크하기 위함
    if(!empty($mb['sales_idx']) && $_POST['mb_re_reg_date'] != 'Y' && !empty($mb['history_idx'])) {
        $sql = " update g5_sales set {$sql_common2} {$sql_add} where idx = '{$mb['sales_idx']}' ";
        sql_query($sql);
    } else {
        // 매출관리 DB 저장
        $sql = " insert into g5_sales set mb_no = '{$mb_no}', pay_date = '".G5_TIME_YMDHIS."', mb_reg_date = '".G5_TIME_YMDHIS."', {$sql_common2} {$sql_add} ";
        sql_query($sql);
        $salse_idx = sql_insert_id();

        $sql = " update g5_member set sales_idx = {$salse_idx} where mb_no = {$mb_no} ";
        sql_query($sql);
    }

    // 재등록회원은 재등록 일자 별도 표기 (mb_re_reg_date가 Y로 넘어올 경우)
    $sql_add = '';
    if($_POST['mb_re_reg_date'] == 'Y') {
        $sql_add = " , mb_reg_date = '".G5_TIME_YMDHIS."', mb_re_reg = 'Y', mb_re_reg_date = '".G5_TIME_YMDHIS."' ";
    }
    if($_POST['app_member'] == 'Y') {
        $sql_add = " , mb_reg_date = '".G5_TIME_YMDHIS."' ";
    }

    // 회원 이력 저장 -- 재등록회원 or 온라인회원
    $sql = " select * from g5_lesson where lesson_code = '{$lesson_code}' and center_code='{$_POST['center_code']}'; ";
    $info = sql_fetch($sql);
    $lesson_name = $info['lesson_name'] . '/' . $info['lesson_time'] . '/' . $info['lesson_count'] . '/' . $info['lesson_price'];
    if($_POST['mb_re_reg_date'] == 'Y' || empty($mb['history_idx'])) {
        if(empty($lesson_end_date)) { // 재등록 시 lesson_end_date가 빈값일 경우 처음 레슨시작일로 계산한 레슨종료일을 넣음
            $lesson_end_date = $g_lesson_end_date; // 레슨종료일 (프로가 재등록 시에는 $_POST['lesson_end_date']가 없음 ==> $g_lesson_end_date 사용)
        }

        $sql = " insert into g5_member_history set 
                 mb_no = {$mb_no}, pro_mb_no = {$pro_mb_no}, mb_state = '{$_POST['mb_state']}', lesson_idx = '{$lesson_idx}', center_code = '{$_POST['center_code']}', 
                 center_name = '{$mb_center}', lesson_code = '{$lesson_code}', lesson_name = '{$lesson_name}', sales_idx = {$salse_idx}, 
                 lesson_start_date = '{$lesson_start_date}', lesson_end_date = '{$lesson_end_date}', reg_date = '" . G5_TIME_YMDHIS . "';  ";
        sql_query($sql);
        $history_idx = sql_insert_id();

        $sql = " update g5_member set history_idx = {$history_idx} where mb_no = {$mb_no} ";
        sql_query($sql);

        // 21.11.15 재등록 시 이전 history_idx의 재등록 시점 이후 예약(21.12.06 reser_state = '예약대기' 조건 삭제, 프로가 미리 예약완료로 상태 변경 했을 가능성 때문) 데이터 history_idx 업데이트 / etc에 메모
        $sql = " update g5_lesson_reser set history_idx = '{$history_idx}', etc = '재등록으로 예약대기 건 history_idx 변경 ({$mb['history_idx']}에서 {$history_idx})', etc_date = '".G5_TIME_YMDHIS."' 
                 where mb_no = '{$mb_no}' and history_idx = '{$mb['history_idx']}' and concat(replace(reser_date, '.', '-'), ' ', reser_time, ':00') > now(); ";
        sql_query($sql);
    }
    else {

        if(empty($lesson_end_date)) { // 재등록 시 lesson_end_date가 빈값일 경우 처음 레슨시작일로 계산한 레슨종료일을 넣음
            $lesson_end_date = $g_lesson_end_date; // 레슨종료일 (프로가 재등록 시에는 $_POST['lesson_end_date']가 없음 ==> $g_lesson_end_date 사용)
        }

        $sql = " update g5_member_history set pro_mb_no = {$pro_mb_no}, lesson_idx = '{$lesson_idx}', lesson_code = '{$lesson_code}', lesson_name = '{$lesson_name}', 
                 lesson_start_date = '{$lesson_start_date}', lesson_end_date = '{$lesson_end_date}', up_datetime = '".G5_TIME_YMDHIS."' where idx = {$mb['history_idx']} ";
        sql_query($sql);

        // 21.03.08 레슨 진행 중 레슨 상품 변경 시 레슨 일지 DB lesson_code 및 lesson_remain_count(잔여회차) 변경
        $total_lesson_count = explode('회', $info['lesson_count'])[0];
        $sql = " update g5_lesson_diary set lesson_code = '{$lesson_code}', lesson_remain_count = {$total_lesson_count} - lesson_count  where history_idx = {$mb['history_idx']} ";
        sql_query($sql);

        $history_idx = $mb['history_idx'];
    }

    // 회원 정보 update
    $sql = " update {$g5['member_table']} set lesson_start_date = '{$lesson_start_date}', lesson_end_date = '{$lesson_end_date}', no_register_date = '{$no_register_date}', up_datetime = '".G5_TIME_YMDHIS."', {$sql_common} {$sql_add} {$sql_password} {$sql_certify} where mb_no = '{$mb_no}' ";
    sql_query($sql);

    // 원포인트 레슨 등록일 경우 예약 정보 update (g5_lesson_reser)
    if($_POST['mb_state'] == 'one_point_lesson') {
        // 동시에 예약할 수 있으므로 예약하고자 하는 시간 재확인
        $count = sql_fetch(" select count(*) as count from g5_lesson_reser where pro_mb_no = {$pro_mb_no}, time_set_idx = {$_POST['time_set_idx']} and reser_state != '예약취소'; ")['count'];

        if ($count == 0) {
            if(empty($_POST['reser_idx'])) {
                $sql = " insert into g5_lesson_reser 
                         set
                         history_idx = '{$history_idx}', pro_mb_no = {$pro_mb_no}, center_code = '{$_POST['center_code']}', lesson_code = '{$lesson_code}', 
                         mb_no = {$mb_no}, time_set_idx = {$_POST['time_set_idx']}, reser_date = '{$one_point_le_date}', reser_time = '{$_POST['one_point_le_time']}', reg_date = now(), one_point = 'Y', reg_mb_id = '{$member['mb_id']}' ";
                sql_query($sql);
            }
            else {
                $sql = " update g5_lesson_reser 
                         set 
                         pro_mb_no = {$pro_mb_no}, time_set_idx = '{$_POST['time_set_idx']}', reser_date = '{$one_point_le_date}', reser_time = '{$_POST['one_point_le_time']}', mod_date = now() 
                         where idx = {$_POST['reser_idx']} ";
            }
            sql_query($sql);
        } else {
            alert('이미 예약된 시간입니다.');
        }
    }
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


// 파일 삭제
$del_mb_img = explode(',', $_POST['del_mb_img']);
for($i = 0; $i < count($del_mb_img); $i++) {
    $sql = " select * from g5_member_img where idx = {$del_mb_img[$i]} ";
    $row = sql_fetch($sql);

    unlink(G5_DATA_PATH . '/file/member/' . $row['img_file']);

    $sql = " delete from g5_member_img where idx = {$del_mb_img[$i]} ";
    sql_query($sql);
}

// 파일 등록
for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
    $upload[$i]['file'] = '';
    $upload[$i]['source'] = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image'] = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

    $tmp_file = $_FILES['file']['tmp_name'][$i];
    $filesize = $_FILES['file']['size'][$i];
    $filename = $_FILES['file']['name'][$i];
    $filename = get_safe_filename($filename);

    if (is_uploaded_file($tmp_file)) {
        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
            preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }
        //=================================================================

        $upload[$i]['image'] = $timg;

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);
        $dest_file = G5_DATA_PATH . '/file/member/' . $upload[$i]['file'];

        //이미지 크기조정
        //size_image($_FILES['file'], 200, 200, $dest_file, 'multi', $i);

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_img']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $sql = " insert into g5_member_img set mb_no = '{$mb_no}', img_source = '{$upload[$i]['source']}', img_file = '{$upload[$i]['file']}', 
                                               img_filesize = '{$upload[$i]['filesize']}', img_width = '{$upload[$i]['image']['0']}', img_height = '{$upload[$i]['image']['1']}', 
                                               img_type = '{$upload[$i]['image']['2']}', img_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }
}

// 23.05.17 SQL log
sql_query("INSERT INTO sql_log SET mb_id = '{$member['mb_id']}', memo = 'mb_no', sql_text = '{$mb_no}'");

die($mb_no);
//goto_url('./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>
