<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

// 리퍼러 체크
referer_check();

if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if ($w == 'u' && $is_admin == 'super') {
    if (file_exists(G5_PATH.'/DEMO'))
        alert('데모 화면에서는 하실(보실) 수 없는 작업입니다.');
}

if($w == 'u')
    $mb_id = isset($_SESSION['ss_mb_id']) ? trim($_SESSION['ss_mb_id']) : '';
else if($w == '')
    $mb_id = trim($_POST['mb_email']);
else
    alert('잘못된 접근입니다', G5_URL);


if(!$mb_id)
    alert('회원아이디 값이 없습니다. 올바른 방법으로 이용해 주십시오.');

$mb_certify    = trim($_POST['mb_certify']);
$mb_password    = trim($_POST['mb_password']);
$mb_password_re = trim($_POST['mb_password_re']);
$mb_name        = trim($_POST['mb_name']);
$mb_nick        = trim($_POST['mb_nick']);
$mb_email       = trim($_POST['mb_email']);
$mb_sex         = isset($_POST['mb_sex'])           ? trim($_POST['mb_sex'])         : "";
$mb_birth       = isset($_POST['mb_birth'])         ? trim($_POST['mb_birth'])       : "";
$mb_homepage    = isset($_POST['mb_homepage'])      ? trim($_POST['mb_homepage'])    : "";
$mb_tel         = isset($_POST['mb_tel'])           ? trim($_POST['mb_tel'])         : "";
$mb_hp          = isset($_POST['mb_hp'])            ? trim($_POST['mb_hp'])          : "";
$mb_zip1        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 0, 3) : "";
$mb_zip2        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 3)    : "";
$mb_addr1       = isset($_POST['mb_addr1'])         ? trim($_POST['mb_addr1'])       : "";
$mb_addr2       = isset($_POST['mb_addr2'])         ? trim($_POST['mb_addr2'])       : "";
$mb_addr3       = isset($_POST['mb_addr3'])         ? trim($_POST['mb_addr3'])       : "";
$mb_addr_jibeon = isset($_POST['mb_addr_jibeon'])   ? trim($_POST['mb_addr_jibeon']) : "";
$mb_signature   = isset($_POST['mb_signature'])     ? trim($_POST['mb_signature'])   : "";
$mb_profile     = isset($_POST['mb_profile'])       ? trim($_POST['mb_profile'])     : "";
$mb_recommend   = isset($_POST['mb_recommend'])     ? trim($_POST['mb_recommend'])   : "";
$mb_mailling    = isset($_POST['mb_mailling'])      ? trim($_POST['mb_mailling'])    : "";
$mb_sms         = isset($_POST['mb_sms'])           ? trim($_POST['mb_sms'])         : "";
$mb_1           = isset($_POST['mb_1'])             ? trim($_POST['mb_1'])           : "";
$mb_2           = isset($_POST['mb_2'])             ? trim($_POST['mb_2'])           : "";
$mb_3           = isset($_POST['mb_3'])             ? str_replace('-','',trim($_POST['mb_3']))           : "";
$mb_4           = isset($_POST['mb_4'])             ? trim($_POST['mb_4'])           : "";
$mb_5           = isset($_POST['mb_5'])             ? trim($_POST['mb_5'])           : "";
$mb_6           = isset($_POST['mb_6'])             ? trim($_POST['mb_6'])           : "";
$mb_7           = isset($_POST['mb_7'])             ? trim($_POST['mb_7'])           : "";
$mb_8           = isset($_POST['mb_8'])             ? trim($_POST['mb_8'])           : "";
$mb_9           = isset($_POST['mb_9'])             ? trim($_POST['mb_9'])           : "";
$mb_10          = isset($_POST['mb_10'])            ? trim($_POST['mb_10'])          : "";
//$mb_birthday          = trim($_POST['mb_year'])."-".trim($_POST['mb_month'])."-".trim($_POST['mb_day']);
$mb_division          = isset($_POST['mb_division'])            ? trim($_POST['mb_division'])          : "";
$mb_join_division          = isset($_POST['mb_join_division'])            ? trim($_POST['mb_join_division'])          : "";

$mb_sub_path = "";
for ($i = 0; $i < count($_POST['mb_sub_path']); $i++) {
    $mb_sub_path .= "," . $_POST['mb_sub_path'][$i];
}
$mb_sub_path = substr($mb_sub_path, 1);
$mb_sub_text = isset($_POST['mb_sub_text'])            ? trim($_POST['mb_sub_text'])          : "";

$mb_want_ctg = "";
for ($i = 0; $i < count($_POST['mb_want_ctg']); $i++) {
    $mb_want_ctg .= "," . $_POST['mb_want_ctg'][$i];
}
$mb_want_ctg = substr($mb_want_ctg, 1);

$mb_name        = clean_xss_tags($mb_name);
if ($_SESSION['ss_sns'] != 'facebook') {
    $mb_email = get_email_address($mb_email);
}
$mb_homepage    = clean_xss_tags($mb_homepage);
$mb_tel         = clean_xss_tags($mb_tel);
$mb_zip1        = preg_replace('/[^0-9]/', '', $mb_zip1);
$mb_zip2        = preg_replace('/[^0-9]/', '', $mb_zip2);
$mb_addr1       = clean_xss_tags($mb_addr1);
$mb_addr2       = clean_xss_tags($mb_addr2);
$mb_addr3       = clean_xss_tags($mb_addr3);
$mb_addr_jibeon = preg_match("/^(N|R)$/", $mb_addr_jibeon) ? $mb_addr_jibeon : '';
$mb_adult = "0";

//나이스 인증으로 들어온 생년월일 ex)19900101 성인인지 아닌지
$year = substr($mb_birth, 0, 4);
if(date('Y',strtotime(G5_TIME_YMDHIS)) - $year > 19  ){
    $mb_adult = "1";
}

if ($w == '' || $w == 'u') {

//    if ($msg = empty_mb_id($mb_id))         alert($msg, "", true, true); // alert($msg, $url, $error, $post);
//    if ($msg = valid_mb_id($mb_id))         alert($msg, "", true, true);
//    if ($msg = count_mb_id($mb_id))         alert($msg, "", true, true);

    // 이름, 닉네임에 utf-8 이외의 문자가 포함됐다면 오류
    // 서버환경에 따라 정상적으로 체크되지 않을 수 있음.
    $tmp_mb_name = iconv('UTF-8', 'UTF-8//IGNORE', $mb_name);
    if($tmp_mb_name != $mb_name) {
        alert('이름을 올바르게 입력해 주십시오.');
    }
    $tmp_mb_nick = iconv('UTF-8', 'UTF-8//IGNORE', $mb_nick);
    if($tmp_mb_nick != $mb_nick) {
        alert('닉네임을 올바르게 입력해 주십시오.');
    }

    if ($w == '' && !$mb_password && $_SESSION['ss_sns'] == "")
        alert('비밀번호가 넘어오지 않았습니다.');
//    if($w == '' && $mb_password != $mb_password_re)
//        alert('비밀번호가 일치하지 않습니다.');

//    if ($msg = empty_mb_name($mb_name))       alert($msg, "", true, true);
    if ($msg = empty_mb_nick($mb_nick))     alert($msg, "", true, true);
    if ($msg = empty_mb_email($mb_email))   alert($msg, "", true, true);
//    if ($msg = reserve_mb_id($mb_id))       alert($msg, "", true, true);
    if ($msg = reserve_mb_nick($mb_nick))   alert($msg, "", true, true);
    // 이름에 한글명 체크를 하지 않는다.
    //if ($msg = valid_mb_name($mb_name))     alert($msg, "", true, true);
    if ($msg = valid_mb_nick($mb_nick))     alert($msg, "", true, true);
    if ($_SESSION['ss_sns'] != 'facebook') {
        if ($msg = valid_mb_email($mb_email)) alert($msg, "", true, true);
        if ($msg = prohibit_mb_email($mb_email)) alert($msg, "", true, true);
    }

    // 휴대폰 필수입력일 경우 휴대폰번호 유효성 체크
    if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {
        if ($msg = valid_mb_hp($mb_hp))     alert($msg, "", true, true);
    }

    if ($w=='') {
//        if ($msg = exist_mb_id($mb_id))     alert($msg);
//        print_r($_SESSION);
//        print_r($mb_id);
//        exit;
        if (get_session('ss_check_mb_email') != $mb_id &&  get_session('ss_check_mb_id') != $mb_id) {

            set_session('ss_check_mb_id', '');
            set_session('chk_hp', '');


            alert('올바른 방법으로 이용해 주십시오.',G5_URL);
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

        if (strtolower($mb_id) == strtolower($mb_recommend)) {
            alert('본인을 추천할 수 없습니다.');
        }
    } else {
        // 자바스크립트로 정보변경이 가능한 버그 수정
        // 닉네임수정일이 지나지 않았다면
//        if ($member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400)))
//            $mb_nick = $member['mb_nick'];
        // 회원정보의 메일을 이전 메일로 옮기고 아래에서 비교함
        $old_email = $member['mb_email'];
    }

    if ($msg = exist_mb_nick($mb_nick, $mb_id))     alert($msg, "", true, true);
    if ($w == "") {
        if ($msg = exist_mb_email($mb_email, $mb_id)) alert($msg, "", true, true);
    }
}

// 사용자 코드 실행
@include_once($member_skin_path.'/register_form_update.head.skin.php');

//===============================================================
//  본인확인
//---------------------------------------------------------------
$mb_hp = hyphen_hp_number($mb_hp);
if($config['cf_cert_use'] && $_SESSION['ss_cert_type'] && $_SESSION['ss_cert_dupinfo']) {
    // 중복체크
    $sql = " select mb_id from {$g5['member_table']} where mb_id <> '{$member['mb_id']}' and mb_dupinfo = '{$_SESSION['ss_cert_dupinfo']}' ";
    $row = sql_fetch($sql);
    if ($row['mb_id']) {
        alert("입력하신 본인확인 정보로 가입된 내역이 존재합니다.\\n회원아이디 : ".$row['mb_id']);
    }
}

//===============================================================

if ($w == '') {
    if ($mb_level == ""){
        $mb_level = $config['cf_register_level'];
    }else{
        $mb_level = $_POST['mb_level'];
    }

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
                     mb_8 = '{$mb_8}',
                     mb_9 = '{$mb_9}',
                     mb_10 = '{$mb_10}',
                     mb_division = '{$mb_division}',
                     mb_join_division = '{$mb_join_division}',
                     mb_birth = '{$mb_birth}',
                     mb_adult = '{$mb_adult}',
                     mb_certify = '{$mb_certify}',
                     mb_sns = '{$_REQUEST["mb_sns"]}',
                     mb_sub_path = '{$mb_sub_path}',
                     mb_sub_text = '{$mb_sub_text}',
                     mb_want_ctg = '{$mb_want_ctg}',
                     mb_buisnessman = '{$_REQUEST["mb_buisnessman"]}',
                     mb_sex = '{$mb_sex}'
                     {$sql_certify} ";

    // 이메일 인증을 사용하지 않는다면 이메일 인증시간을 바로 넣는다
    if (!$config['cf_use_email_certify'])
        $sql .= " , mb_email_certify = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
    //알림톡
    if ($mb_hp != "") {
        alimtalk($mb_hp, $_REQUEST, 'register');
    }

    //공유하기로 들어온 링크로 가입했을 경우 공유하기 한 id로 +1해줌
    if ($_REQUEST["r_code"] != "") {
        $sql = "select * from new_recommend where code = '{$_REQUEST["r_code"]}' and register_mb_id = '' ";
        $recom = sql_fetch($sql);

        if ($recom['mb_id'] != "") {
            $mb_10 = 'mb_10 + 1';

            $sql = "update {$g5['member_table']} set mb_10 = {$mb_10} where mb_id = '{$recom['mb_id']}' ";
            sql_query($sql);

            $sql = "update new_recommend set register_mb_id = '{$mb_id}' where recom_idx = '{$recom['recom_idx']}' ";
            sql_query($sql);
        }else{
            alert("해당 추천인코드가 존재하지않거나, 해당 url로 이미 가입한 멤버가 있습니다.", G5_URL);

        }
    }


    if ($config["cf_register_point"] > 0) {
        // 회원가입 포인트 부여
        $sql = " update g5_member set mb_new_point = mb_new_point + {$config["cf_register_point"]} where mb_id = '{$mb_id}' ";
        sql_query($sql);

        $mb = get_member($mb_id);
        point_history($mb_id,'13',$register_point_plus['content'],$config["cf_register_point"],$mb["mb_new_point"],'plus');
    }

//    insert_point($mb_id, $config['cf_register_point'], '회원가입 축하', '@member', $mb_id, '회원가입');

    // 추천인에게 포인트 부여
//    if ($config['cf_use_recommend'] && $mb_recommend)
//        insert_point($mb_recommend, $config['cf_recommend_point'], $mb_id.'의 추천인', '@member', $mb_recommend, $mb_id.' 추천');

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
    if (!$config['cf_use_email_certify'])
        set_session('ss_mb_id', $mb_id);

    set_session('ss_mb_reg', $mb_id);
	set_cookie_app('mb_id', $mb['mb_id'], 86400);



} else if ($w == 'u') {
    if (!trim($_SESSION['ss_mb_id']))
        alert('로그인 되어 있지 않습니다.');

    if (trim($_POST['mb_email']) != $mb_id)
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
                    mb_name = '{$mb_name}',
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
                    mb_8 = '{$mb_8}',
                    mb_9 = '{$mb_9}',
                    mb_10 = '{$mb_10}',
                    mb_buisnessman = '{$_REQUEST["mb_buisnessman"]}',
                    mb_birthday = '{$mb_birthday}'
                    {$sql_password}
                    {$sql_nick_date}
                    {$sql_open_date}
                    {$sql_email_certify}
                    {$sql_certify}
              where mb_id = '$mb_id' ";

    sql_query($sql);
}

// 푸시알림 -- IOS USER AGENT 적용 필요
if(strpos($_SERVER['HTTP_USER_AGENT'], 'AGold') > 0) {
    $sql = "select * from g5_fcm where mb_id = '{$_POST['mb_id']}'";
    $result = sql_query($sql);
    if (sql_num_rows($result)) {
        $sql = "update g5_fcm set token='$token' where mb_id = '{$_POST['mb_id']}' ";
    } else {
        $sql = "insert g5_fcm set mb_id = '{$_POST['mb_id']}', token='$token'";
    }
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
if (is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
    $mb_dir = substr($mb_id, 0, 2);

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
    @mkdir(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);


    $arr_name = explode('.', $_FILES['mb_icon']['name']);
    $file_ext = array_pop($arr_name); //확장자 추출 (array_pop : 배열의 마지막 원소를 빼내어 반환)

    $file_type = $_FILES['mb_icon']['type'];
    $check_ext = array('jpg', 'jpeg', 'png','JPG', 'JPEG', 'PNG'); //확장자 체크를 위한 선언부


    if (!in_array($file_ext, $check_ext)) {
        echo "허용되지 않는 확장자입니다";
        exit;

    }
//    if ($file_width > $new_file_width) { //이미지 가로사이즈가 200보다 크면 사이즈 조절
    $dest_path = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $mb_id . '.jpg';

    size_image($_FILES['mb_icon'],$config['cf_member_icon_width'],$config['cf_member_icon_height'],$dest_path,'one');

//    }
}


//사업자 등록증
$mb_dir = substr($mb_id,0,2);
$buis_file_name = $mb_id.'_buis.jpg';


// 아이콘 업로드

if (is_uploaded_file($_FILES['mb_buisnessman_file']['tmp_name'])) {
    // 회원 아이콘 삭제 후 넣기
    @unlink(G5_DATA_PATH.'/member/'.$mb_dir.'/'.$buis_file_name);
    // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
    @mkdir(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);


    $arr_name = explode('.', $_FILES['mb_buisnessman_file']['name']);
    $file_ext = array_pop($arr_name); //확장자 추출 (array_pop : 배열의 마지막 원소를 빼내어 반환)

    $file_type = $_FILES['mb_icon']['type'];
    $check_ext = array('jpg', 'jpeg', 'png','JPG', 'JPEG', 'PNG'); //확장자 체크를 위한 선언부

    if (!in_array($file_ext, $check_ext)) {
        echo "허용되지 않는 확장자입니다";
        exit;

    }
//    if ($file_width > $new_file_width) { //이미지 가로사이즈가 200보다 크면 사이즈 조절
    $dest_path = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $buis_file_name;

    // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
    $error_code = move_uploaded_file($_FILES['mb_buisnessman_file']['tmp_name'], $dest_path) or die($_FILES['mb_buisnessman_file']['error'][$i]);

    // 올라간 파일의 퍼미션을 변경합니다.
    chmod($dest_path, G5_FILE_PERMISSION);
//    }

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
    if ($mb_division == 1){
        $url = G5_HTTP_BBS_URL.'/register_result.php';
    }else{
        $url = G5_HTTP_BBS_URL.'/register_expert_form03.php';
    }

    echo '<script>';
    if ($android == true) {
        echo "window.Android.updateLoginInfo('" . $mb_id . "');";
    }
    echo "location.replace(  '".$url."');";
    echo '</script>';
    exit;
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
        <form name="fregisterupdate" method="post" action="'.G5_HTTP_BBS_URL.'/register_form.php">
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
