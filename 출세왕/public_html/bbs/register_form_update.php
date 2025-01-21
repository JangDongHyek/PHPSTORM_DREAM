<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');
include_once(G5_LIB_PATH.'/shop.lib.php');

// 리퍼러 체크
referer_check();

if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if ($w == 'u' && $is_admin == 'super') {
    if (file_exists(G5_PATH.'/DEMO'))
        alert('데모 화면에서는 하실(보실) 수 없는 작업입니다.');
}

//if (!chk_captcha()) {
//    alert('자동등록방지 숫자가 틀렸습니다.');
//}

if($w == 'u')
    $mb_id = isset($_SESSION['ss_mb_id']) ? trim($_SESSION['ss_mb_id']) : '';
else if($w == '')
    $mb_id = trim($_POST['mb_id']);
else
    alert('잘못된 접근입니다', G5_URL);

if(!$mb_id)
    alert('회원아이디 값이 없습니다. 올바른 방법으로 이용해 주십시오.');

$mb_password    = trim($_POST['mb_password']);
$mb_password_re = trim($_POST['mb_password_re']);
$mb_name        = trim($_POST['mb_name']);
$mb_nick        = trim($_POST['mb_nick']);
$mb_email       = trim($_POST['mb_email']);
$mb_sex         = isset($_POST['mb_sex'])           ? trim($_POST['mb_sex'])         : "";
$mb_birth       = isset($_POST['mb_birth'])         ? trim($_POST['mb_birth'])       : "";
$mb_homepage    = isset($_POST['mb_homepage'])      ? trim($_POST['mb_homepage'])    : "";
$mb_tel         = isset($_POST['mb_tel'])           ? trim($_POST['mb_tel'])         : "";
$mb_hp          = isset($_POST['mb_hp'])            ? trim(str_replace ( '-' , '',$_POST['mb_hp']))          : "";
$mb_zip1        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 0, 3) : "";
$mb_zip2        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 3)    : "";
$mb_addr1       = isset($_POST['mb_addr1'])         ? trim($_POST['mb_addr1'])       : "";
$mb_addr2       = isset($_POST['mb_addr2'])         ? trim($_POST['mb_addr2'])       : "";
$mb_addr3       = isset($_POST['mb_addr3'])         ? trim($_POST['mb_addr3'])       : "";
$mb_addr_jibeon = isset($_POST['mb_addr_jibeon'])   ? trim($_POST['mb_addr_jibeon']) : "";
$mb_signature   = isset($_POST['mb_signature'])     ? trim($_POST['mb_signature'])   : "";
$mb_profile     = isset($_POST['mb_profile'])       ? trim($_POST['mb_profile'])     : "";
$mb_recommend   = isset($_POST['mb_id'])       ? trim($_POST['mb_id'])     : "";
$mb_mailling    = isset($_POST['mb_mailling'])      ? trim($_POST['mb_mailling'])    : "";
$mb_sms         = isset($_POST['mb_sms'])           ? trim($_POST['mb_sms'])         : "";
$mb_1           = isset($_POST['mb_1'])             ? trim($_POST['mb_1'])           : "";
$mb_2           = isset($_POST['mb_2'])             ? trim($_POST['mb_2'])           : "";
$mb_3           = isset($_POST['mb_3'])             ? trim($_POST['mb_3'])           : "";
$mb_4           = isset($_POST['mb_4'])             ? trim($_POST['mb_4'])           : "";
$mb_5           = isset($_POST['mb_5'])             ? trim($_POST['mb_5'])           : "";
$mb_6           = isset($_POST['mb_6'])             ? trim($_POST['mb_6'])           : "";
$mb_7           = isset($_POST['mb_7'])             ? trim($_POST['mb_7'])           : "";
$mb_8           = isset($_POST['mb_8'])             ? trim($_POST['mb_8'])           : "";
$mb_9           = isset($_POST['mb_9'])             ? trim($_POST['mb_9'])           : "";
$mb_10          = isset($_POST['mb_10'])            ? trim($_POST['mb_10'])          : "";

$reg_type           = isset($_POST['reg_type'])             ? trim($_POST['reg_type'])           : "";
$go_work           = isset($_POST['go_work'])             ? trim($_POST['go_work'])           : "";
$go_time1           = isset($_POST['go_time1'])             ? trim($_POST['go_time1'])           : "";
$go_time2           = isset($_POST['go_time2'])             ? trim($_POST['go_time2'])           : "";
$go_day_arr           = $_POST['go_day'];
$go_day = implode(',',$go_day_arr);

$ma_time1           = isset($_POST['ma_time1'])             ? trim($_POST['ma_time1'])           : "";
$ma_time2           = isset($_POST['ma_time2'])             ? trim($_POST['ma_time2'])           : "";
$ma_time3           = isset($_POST['ma_time3'])             ? trim($_POST['ma_time3'])           : "";
$ma_time4           = isset($_POST['ma_time4'])             ? trim($_POST['ma_time4'])           : "";
$ma_day_arr           = $_POST['ma_day'];
$ma_day = implode(',',$ma_day_arr);
$ma_hope_month           = isset($_POST['ma_hope_month'])             ? trim($_POST['ma_hope_month'])           : "";
$ma_exp_yn           = isset($_POST['ma_exp_yn'])             ? trim($_POST['ma_exp_yn'])           : "";
$ma_car_no           = isset($_POST['ma_car_no'])             ? trim($_POST['ma_car_no'])           : "";
$ma_car_type           = isset($_POST['ma_car_type'])             ? trim($_POST['ma_car_type'])           : "";
$mb_level           = isset($_POST['mb_level'])             ? trim($_POST['mb_level'])           : "";

$car_no           = isset($_POST['car_no'])             ? trim($_POST['car_no'])           : "";
$car_type           = isset($_POST['car_type'])             ? trim($_POST['car_type'])           : "";
$car_color           = isset($_POST['car_color'])             ? trim($_POST['car_color'])           : "";
$ma_birth           = isset($_POST['ma_birth'])             ? trim($_POST['ma_birth'])           : "";


$mb_name        = clean_xss_tags($mb_name);
$mb_email       = get_email_address($mb_email);
$mb_homepage    = clean_xss_tags($mb_homepage);
$mb_tel         = clean_xss_tags($mb_tel);
$mb_zip1        = preg_replace('/[^0-9]/', '', $mb_zip1);
$mb_zip2        = preg_replace('/[^0-9]/', '', $mb_zip2);
$mb_addr1       = clean_xss_tags($mb_addr1);
$mb_addr2       = clean_xss_tags($mb_addr2);
$mb_addr3       = clean_xss_tags($mb_addr3);
$mb_addr_jibeon = preg_match("/^(N|R)$/", $mb_addr_jibeon) ? $mb_addr_jibeon : '';

if ($w == '' || $w == 'u') {

    if ($msg = empty_mb_id($mb_id))         alert($msg, "", true, true); // alert($msg, $url, $error, $post);
    if ($msg = valid_mb_id($mb_id))         alert($msg, "", true, true);
    if ($msg = count_mb_id($mb_id))         alert($msg, "", true, true);
    $mb_hp = hyphen_hp_number($mb_hp);
    //if ($msg = exist_mb_hp($mb_hp))         alert($msg, "", true, true);


    // 이름, 닉네임에 utf-8 이외의 문자가 포함됐다면 오류
    // 서버환경에 따라 정상적으로 체크되지 않을 수 있음.
    $tmp_mb_name = iconv('UTF-8', 'UTF-8//IGNORE', $mb_name);
    if($tmp_mb_name != $mb_name) {
        alert('이름을 올바르게 입력해 주십시오.');
    }
//    $tmp_mb_nick = iconv('UTF-8', 'UTF-8//IGNORE', $mb_nick);
//    if($tmp_mb_nick != $mb_nick) {
//        alert('닉네임을 올바르게 입력해 주십시오.');
//    }

    if ($w == '' && !$mb_password)
        alert('비밀번호가 넘어오지 않았습니다.');
    if($w == '' && $mb_password != $mb_password_re)
        alert('비밀번호가 일치하지 않습니다.');

    if ($msg = empty_mb_name($mb_name))       alert($msg, "", true, true);
//    if ($msg = empty_mb_nick($mb_nick))     alert($msg, "", true, true);
//    if ($msg = empty_mb_email($mb_email))   alert($msg, "", true, true);
    if ($msg = reserve_mb_id($mb_id))       alert($msg, "", true, true);
//    if ($msg = reserve_mb_nick($mb_nick))   alert($msg, "", true, true);
    // 이름에 한글명 체크를 하지 않는다.
    //if ($msg = valid_mb_name($mb_name))     alert($msg, "", true, true);
//    if ($msg = valid_mb_nick($mb_nick))     alert($msg, "", true, true);
//    if ($msg = valid_mb_email($mb_email))   alert($msg, "", true, true);
//    if ($msg = prohibit_mb_email($mb_email))alert($msg, "", true, true);

    // 휴대폰 필수입력일 경우 휴대폰번호 유효성 체크
    if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {
        if ($msg = valid_mb_hp($mb_hp))     alert($msg, "", true, true);
    }
    // 휴대폰 번호 체크 추가 23-12-28

    if ($w=='') {
        if ($msg = exist_mb_id($mb_id))     alert($msg);
        if ($msg = exist_hp($mb_hp))     alert($msg);


        if (get_session('ss_check_mb_id') != $mb_id  ) {
            set_session('ss_check_mb_id', '');
            set_session('ss_check_mb_nick', '');
            set_session('ss_check_mb_email', '');

            alert('올바른 방법으로 이용해 주십시오.');
        }

        // 본인확인 체크
        if($config['cf_cert_use'] && $config['cf_cert_req']) {
            if(trim($_POST['cert_no']) != $_SESSION['ss_cert_no'] || !$_SESSION['ss_cert_no'])
                alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
        }

        if ($config['cf_use_recommend'] && $mb_recommend) {
            if (!exist_mb_id($mb_recommend))
                alert("추천인이 존재하지 않습니다.");
        }
/*
        if (strtolower($mb_id) == strtolower($mb_recommend)) {
            alert('본인을 추천할 수 없습니다.1');
        }
*/
    } else {
        // 자바스크립트로 정보변경이 가능한 버그 수정
        // 닉네임수정일이 지나지 않았다면
        if ($member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400)))
            $mb_nick = $member['mb_nick'];
        // 회원정보의 메일을 이전 메일로 옮기고 아래에서 비교함
        $old_email = $member['mb_email'];
    }

//    if ($msg = exist_mb_nick($mb_nick, $mb_id))     alert($msg, "", true, true);
//    if ($msg = exist_mb_email($mb_email, $mb_id))   alert($msg, "", true, true);
}

// 사용자 코드 실행
@include_once($member_skin_path.'/register_form_update.head.skin.php');

//===============================================================
//  본인확인
//---------------------------------------------------------------
//$mb_hp = hyphen_hp_number($mb_hp);
if($config['cf_cert_use'] && $_SESSION['ss_cert_type'] && $_SESSION['ss_cert_dupinfo']) {
    // 중복체크
    $sql = " select mb_id from {$g5['member_table']} where mb_id <> '{$member['mb_id']}' and mb_dupinfo = '{$_SESSION['ss_cert_dupinfo']}' ";
    $row = sql_fetch($sql);
    if ($row['mb_id']) {
        alert("입력하신 본인확인 정보로 가입된 내역이 존재합니다.\\n회원아이디 : ".$row['mb_id']);
    }
}

$sql_certify = '';
$md5_cert_no = $_SESSION['ss_cert_no'];
$cert_type = $_SESSION['ss_cert_type'];
if ($config['cf_cert_use'] && $cert_type && $md5_cert_no) {
    // 해시값이 같은 경우에만 본인확인 값을 저장한다.
    if ($_SESSION['ss_cert_hash'] == md5($mb_name.$cert_type.$_SESSION['ss_cert_birth'].$md5_cert_no)) {
//        $sql_certify .= " , mb_hp = '{$mb_hp}' ";
        $sql_certify .= " , mb_certify  = '{$cert_type}' ";
        $sql_certify .= " , mb_adult = '{$_SESSION['ss_cert_adult']}' ";
        $sql_certify .= " , mb_birth = '{$_SESSION['ss_cert_birth']}' ";
        $sql_certify .= " , mb_sex = '{$_SESSION['ss_cert_sex']}' ";
        $sql_certify .= " , mb_dupinfo = '{$_SESSION['ss_cert_dupinfo']}' ";
        if($w == 'u')
            $sql_certify .= " , mb_name = '{$mb_name}' ";
    } else {
  //      $sql_certify .= " , mb_hp = '{$mb_hp}' ";
        $sql_certify .= " , mb_certify  = '' ";
        $sql_certify .= " , mb_adult = 0 ";
        $sql_certify .= " , mb_birth = '' ";
        $sql_certify .= " , mb_sex = '' ";
    }
} else {
    if (get_session("ss_reg_mb_name") != $mb_name || get_session("ss_reg_mb_hp") != $mb_hp) {
    //    $sql_certify .= " , mb_hp = '{$mb_hp}' ";
        $sql_certify .= " , mb_certify = '' ";
        $sql_certify .= " , mb_adult = 0 ";
        $sql_certify .= " , mb_birth = '' ";
        $sql_certify .= " , mb_sex = '' ";
    }
}
//===============================================================


if ($w == '') {
    $sql = " insert into {$g5['member_table']}
                set mb_id = '{$mb_id}',
                     mb_password = '".get_encrypt_string($mb_password)."',
                     mb_name = '{$mb_name}',
                     mb_nick = '{$mb_nick}',
                     mb_nick_date = '".G5_TIME_YMD."',
                     mb_email = '{$mb_email}',
                     mb_homepage = '{$mb_homepage}',
                     mb_tel = '{$mb_tel}',
                     mb_hp = '{$mb_hp}',
                     mb_zip1 = '{$mb_zip1}',
                     mb_zip2 = '{$mb_zip2}',
                     mb_addr1 = '{$mb_addr1}',
                     mb_addr2 = '{$mb_addr2}',
                     mb_addr3 = '{$mb_addr3}',
                     mb_addr_jibeon = '{$mb_addr_jibeon}',
                     mb_signature = '{$mb_signature}',
                     mb_profile = '{$mb_profile}',
                     mb_today_login = '".G5_TIME_YMDHIS."',
                     mb_datetime = '".G5_TIME_YMDHIS."',
                     mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_level = '{$mb_level}',
                     mb_recommend = '{$mb_recommend}',
                     mb_login_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_mailling = '{$mb_mailling}',
                     mb_sms = '{$mb_sms}',
                     mb_open = '{$mb_open}',
                     mb_open_date = '".G5_TIME_YMD."',
                     mb_1 = '{$mb_1}',
                     mb_2 = '{$mb_2}',
                     mb_3 = '{$mb_3}',
                     mb_4 = '{$mb_4}',
                     mb_5 = '{$mb_5}',
                     mb_6 = '{$mb_6}',
                     mb_7 = '{$mb_7}',
                     mb_8 = '{$mb_8}',
                     mb_9 = '{$mb_9}',
                     mb_10 = '{$mb_10}',
                     reg_type = '{$reg_type}',
                     go_work = '{$go_work}',
                    go_time1 = '{$go_time1}',
                    go_time2 = '{$go_time2}',
                    go_day = '{$go_day}',
                    ma_time1 = '{$ma_time1}',
                    ma_time2 = '{$ma_time2}',
                    ma_time3 = '{$ma_time3}',
                    ma_time4 = '{$ma_time4}',
                    ma_day = '{$ma_day}',
                    ma_hope_month = '{$ma_hope_month}',
                    ma_exp_yn = '{$ma_exp_yn}',
                    ma_car_no = '{$ma_car_no}',
                    ma_birth = '{$ma_birth}',
                    ma_car_type = '{$ma_car_type}'
                     {$sql_certify} ";

    // 이메일 인증을 사용하지 않는다면 이메일 인증시간을 바로 넣는다
    if (!$config['cf_use_email_certify'])
        $sql .= " , mb_email_certify = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);

    if ($car_no != "") {




        @mkdir(G5_DATA_PATH . '/file/car_photo', G5_DIR_PERMISSION);
        @chmod(G5_DATA_PATH . '/file/car_photo', G5_DIR_PERMISSION);

//        if ($_REQUEST['del_mb_icon'] == 1)
//            @unlink(G5_DATA_PATH.'/file/car_photo/'.str_replace(" ", "",$car_no).'.jpg');

        if ($_FILES['bf_file']['tmp_name'] != "" ) {

            $arr_name = explode('.', $_FILES['bf_file']['name']);
            $file_ext = array_pop($arr_name); //확장자 추출 (array_pop : 배열의 마지막 원소를 빼내어 반환)
            $check_ext = array('JPG', 'JPEG', 'PNG','jpg', 'jpeg', 'png'); //확장자 체크를 위한 선언부

            if (!in_array($file_ext, $check_ext)) {
                echo "허용되지 않는 확장자입니다";
                exit;

            }

            $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
            $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $_FILES['bf_file']['name']);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
            $upload = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

            $dest_file = G5_DATA_PATH.'/file/car_photo/'.$upload;


//    if ($file_width > $new_file_width) { //이미지 가로사이즈가 200보다 크면 사이즈 조절

            //23.04.14 한글 그냥그대로 파일올리는거 ;; ㄷㄷ  다뜯어고치는중.. wc
            //$dest_path = G5_DATA_PATH . '/file/car_photo/' .str_replace(" ", "", $_REQUEST['car_no']). '.jpg';


            //이미지 사이즈 조정
            $tmp_file = $_FILES['bf_file']['tmp_name'];
            move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);//      exit();

            // 23.04.14 올라간 파일의 퍼미션을 변경합니다. wc
            chmod($dest_file, G5_FILE_PERMISSION);
            $_REQUEST['car_img'] =  $upload;
//    }
        }
        $sql = "insert into {$g5['car_table']} set mb_id = '{$mb_id}', car_no = '{$car_no}', car_img = '{$upload}', car_type = '{$car_type}', car_color = '{$car_color}',
            wr_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }



    // 23.04.20 추천인한테 쿠폰주는 부분 wc  -> 회원가입 승인할 때로 변경 관리자로
    if($mb_2){

        // 회원가입 포인트 부여 -> 회원가입 승인할 때로 변경
        //insert_point($mb_id, 5000, $mb_2.' 추천가입 축하', '@member', $mb_id, '회원가입');
        // 추천인에게 포인트 부여 -> 회원가입 승인할 때로 변경
        //insert_point($mb_2, 5000, $mb_id.'의 추천인', '@member', $mb_2, $mb_id.' 추천');

        /*
        $j = 0;
        do {
            $cp_id = get_coupon_id();
            $cp_id2 = get_coupon_id();
            $sql3 = " select count(*) as cnt from {$g5['g5_shop_coupon_table']} where cp_id = '$cp_id' or cp_id = '$cp_id2' ";
            $row3 = sql_fetch($sql3);
            if(!$row3['cnt'])
                break;
            else {
                if($j > 20)
                    die('Coupon ID Error');
            }
            $j++;
        } while(1);
        $sql = " INSERT INTO {$g5['g5_shop_coupon_table']}
                    ( cp_id, cp_subject, cp_method, cp_target, mb_id, cp_start, cp_end, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum, cp_datetime )
                VALUES
                    ( '$cp_id', '".$mb_id."-추천인쿠폰', '2', '', '$mb_2', '2000-01-01', '9999-09-09', '0', '5000', '10', '', '', '".G5_TIME_YMDHIS."' ) ";

        sql_query($sql);
        */
        //23.07.11 가입축하쿠폰발행
        /*
        $sql = " INSERT INTO {$g5['g5_shop_coupon_table']}
                    ( cp_id, cp_subject, cp_method, cp_target, mb_id, cp_start, cp_end, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum, cp_datetime )
                VALUES
                    ( '$cp_id', '가입축하쿠폰', '2', '', '$mb_id', '2000-01-01', '9999-09-09', '0', '5000', '10', '', '', '".G5_TIME_YMDHIS."' ) ";

        sql_query($sql);
        */
        /*
        INSERT INTO g5_shop_coupon ( cp_id, cp_subject, cp_method, cp_target, mb_id, cp_start,
            cp_end, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum, cp_datetime )
        VALUES ( 'R3AV-W4AU-GXDU-QCKE', '추가할떄 sql보자', '2', '', 'gogac3', '2023-04-20', '2023-04-27', '1', '10', '10', '', '', '2023-04-20 09:17:58' )
       */
    }

    // 회원님께 메일 발송
    if ($config['cf_email_mb_member']) {
        $subject = '['.$config['cf_title'].'] 회원가입을 축하드립니다.';

        $mb_md5 = md5($mb_id.$mb_email.G5_TIME_YMDHIS);
        $certify_href = G5_BBS_URL.'/email_certify.php?mb_id='.$mb_id.'&amp;mb_md5='.$mb_md5;

        ob_start();
        include_once ('./register_form_update_mail1.php');
        $content = ob_get_contents();
        ob_end_clean();

        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb_email, $subject, $content, 1);

        // 메일인증을 사용하는 경우 가입메일에 인증 url이 있으므로 인증메일을 다시 발송되지 않도록 함
        if($config['cf_use_email_certify'])
            $old_email = $mb_email;
    }

    // 최고관리자님께 메일 발송
    if ($config['cf_email_mb_super_admin']) {
        $subject = '['.$config['cf_title'].'] '.$mb_nick .' 님께서 회원으로 가입하셨습니다.';

        ob_start();
        include_once ('./register_form_update_mail2.php');
        $content = ob_get_contents();
        ob_end_clean();

        mailer($mb_nick, $mb_email, $config['cf_admin_email'], $subject, $content, 1);
    }

    // 메일인증 사용하지 않는 경우에만 로그인
    if (!$config['cf_use_email_certify'] && $mb_level == 2) {
        set_session('ss_mb_id', $mb_id);
        set_session('ss_mb_reg', $mb_id);
        set_cookie_app('mb_id', $mb['mb_id'], 86400);
    }else{
        //기사일 경우 바로 로그인 X
        set_session('ss_mb_reg', 'manager');
    }


} else if ($w == 'u') {
    if (!trim($_SESSION['ss_mb_id']))
        alert('로그인 되어 있지 않습니다.');

    if (trim($_POST['mb_id']) != $mb_id)
        alert("로그인된 정보와 수정하려는 정보가 틀리므로 수정할 수 없습니다.\\n만약 올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.");

    $sql_password = "";
    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."' ";

    $sql_nick_date = "";
    if ($mb_nick_default != $mb_nick)
        $sql_nick_date =  " , mb_nick_date = '".G5_TIME_YMD."' ";

    $sql_open_date = "";
    if ($mb_open_default != $mb_open)
        $sql_open_date =  " , mb_open_date = '".G5_TIME_YMD."' ";

    // 이전 메일주소와 수정한 메일주소가 틀리다면 인증을 다시 해야하므로 값을 삭제
    $sql_email_certify = '';
    if ($old_email != $mb_email && $config['cf_use_email_certify'])
        $sql_email_certify = " , mb_email_certify = '' ";

    $sql = " update {$g5['member_table']}
                set mb_nick = '{$mb_nick}',
                    mb_mailling = '{$mb_mailling}',
                    mb_sms = '{$mb_sms}',
                    mb_open = '{$mb_open}',
                    mb_email = '{$mb_email}',
                    mb_homepage = '{$mb_homepage}',
                    mb_tel = '{$mb_tel}',
					mb_hp = '{$mb_hp}',
                    mb_zip1 = '{$mb_zip1}',
                    mb_zip2 = '{$mb_zip2}',
                    mb_addr1 = '{$mb_addr1}',
                    mb_addr2 = '{$mb_addr2}',
                    mb_addr3 = '{$mb_addr3}',
                    mb_addr_jibeon = '{$mb_addr_jibeon}',
                    mb_signature = '{$mb_signature}',
                    mb_profile = '{$mb_profile}',
                    mb_1 = '{$mb_1}',
                    mb_2 = '{$mb_2}',
                    mb_3 = '{$mb_3}',
                    mb_4 = '{$mb_4}',
                    mb_5 = '{$mb_5}',
                    mb_6 = '{$mb_6}',
                    mb_7 = '{$mb_7}',
                    mb_8 = '{$mb_8}',
                    mb_9 = '{$mb_9}',
                    mb_10 = '{$mb_10}',
                    reg_type = '{$reg_type}',
                    go_work = '{$go_work}',
                    go_time1 = '{$go_time1}',
                    go_time2 = '{$go_time2}',
                    go_day = '{$go_day}',
                    ma_time1 = '{$ma_time1}',
                    ma_time2 = '{$ma_time2}',
                    ma_time3 = '{$ma_time3}',
                    ma_time4 = '{$ma_time4}',
                    ma_day = '{$ma_day}',
                    ma_hope_month = '{$ma_hope_month}',
                    ma_exp_yn = '{$ma_exp_yn}',
                    ma_car_no = '{$ma_car_no}',
                    ma_car_type = '{$ma_car_type}'
                    {$sql_password}
                    {$sql_nick_date}
                    {$sql_open_date}
                    {$sql_email_certify}
                    {$sql_certify}
              where mb_id = '$mb_id' ";

    sql_query($sql);


	$sql = "update `member_gcm` set `push_yn` = '$push_yn' where `mb_id` = '$member[mb_id]'";
	sql_query($sql);


	//24-12-30 고객이 주소 변경하면 정기세차 차 주소도 바뀌게
	$sql = "update `new_car_wash` set `car_w_addr1` = '{$mb_addr1}', `car_w_addr2` = '{$mb_addr2}' where `mb_id` = '{$member['mb_id']}'";
    sql_query($sql);
}


// 회원 아이콘
$mb_dir = G5_DATA_PATH.'/member/'.substr($mb_id,0,2);

// 아이콘 삭제
if (isset($_POST['del_mb_icon'])) {
    @unlink($mb_dir.'/'.$mb_id.'.gif');
}

$msg = "";

// 아이콘 업로드
$mb_icon = '';
if (isset($_FILES['mb_icon']) && is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
    if (preg_match("/(\.gif)$/i", $_FILES['mb_icon']['name'])) {
        // 아이콘 용량이 설정값보다 이하만 업로드 가능
        if ($_FILES['mb_icon']['size'] <= $config['cf_member_icon_size']) {
            @mkdir($mb_dir, G5_DIR_PERMISSION);
            @chmod($mb_dir, G5_DIR_PERMISSION);
            $dest_path = $mb_dir.'/'.$mb_id.'.gif';
            move_uploaded_file($_FILES['mb_icon']['tmp_name'], $dest_path);
            chmod($dest_path, G5_FILE_PERMISSION);
            if (file_exists($dest_path)) {
                //=================================================================\
                // 090714
                // gif 파일에 악성코드를 심어 업로드 하는 경우를 방지
                // 에러메세지는 출력하지 않는다.
                //-----------------------------------------------------------------
                $size = getimagesize($dest_path);
                if ($size[2] != 1) // gif 파일이 아니면 올라간 이미지를 삭제한다.
                    @unlink($dest_path);
                else
                // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                if ($size[0] > $config['cf_member_icon_width'] || $size[1] > $config['cf_member_icon_height'])
                    @unlink($dest_path);
                //=================================================================\
            }
        } else {
            $msg .= '회원아이콘을 '.number_format($config['cf_member_icon_size']).'바이트 이하로 업로드 해주십시오.';
        }

    } else {
        $msg .= $_FILES['mb_icon']['name'].'은(는) gif 파일이 아닙니다.';
    }
}


// 인증메일 발송
if ($config['cf_use_email_certify'] && $old_email != $mb_email) {
    $subject = '['.$config['cf_title'].'] 인증확인 메일입니다.';

    $mb_datetime = $member['mb_datetime'] ? $member['mb_datetime'] : G5_TIME_YMDHIS;
    $mb_md5 = md5($mb_id.$mb_email.$mb_datetime);
    $certify_href = G5_BBS_URL.'/email_certify.php?mb_id='.$mb_id.'&amp;mb_md5='.$mb_md5;

    ob_start();
    include_once ('./register_form_update_mail3.php');
    $content = ob_get_contents();
    ob_end_clean();

    mailer($config['cf_title'], $config['cf_admin_email'], $mb_email, $subject, $content, 1);
}


// 사용자 코드 실행
@include_once ($member_skin_path.'/register_form_update.tail.skin.php');

unset($_SESSION['ss_cert_type']);
unset($_SESSION['ss_cert_no']);
unset($_SESSION['ss_cert_hash']);
unset($_SESSION['ss_cert_birth']);
unset($_SESSION['ss_cert_adult']);

if ($msg)
    echo '<script>alert(\''.$msg.'\');</script>';

if ($w == '') {
//    goto_url(G5_HTTP_BBS_URL.'/register_result.php');
    if ($mb_level == 2){
        goto_url(G5_HTTP_BBS_URL.'/card_info_form.php');
    }else{
        goto_url(G5_HTTP_BBS_URL.'/register_result.php');
    }
} else if ($w == 'u') {
    $row  = sql_fetch(" select mb_password from {$g5['member_table']} where mb_id = '{$member['mb_id']}' ");
    $tmp_password = $row['mb_password'];

    if ($old_email != $mb_email && $config['cf_use_email_certify']) {
        set_session('ss_mb_id', '');
        alert('회원 정보가 수정 되었습니다.\n\nE-mail 주소가 변경되었으므로 다시 인증하셔야 합니다.', G5_URL);
    } else {
        echo '
        <!doctype html>
        <html lang="ko">
        <head>
        <meta charset="utf-8">
        <title>회원정보수정</title>
        <body>
        <form name="fregisterupdate" method="post" action="'.G5_URL.'">
        <input type="hidden" name="w" value="u">
        <input type="hidden" name="mb_id" value="'.$mb_id.'">
        <input type="hidden" name="mb_password" value="'.$tmp_password.'">
        <input type="hidden" name="is_update" value="1">
        </form>
        <script>
        alert("회원 정보가 수정 되었습니다.");
        document.fregisterupdate.submit();
        </script>
        </body>
        </html>';
    }
}
?>
