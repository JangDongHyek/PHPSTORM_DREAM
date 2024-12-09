<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');

// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

$w = $is_member? "u" : "";


$readonly = "";
if ($w == "") {
    // 리퍼러 체크
    referer_check();
    $g5['title'] = '회원 가입';

    /*
     * print_r($_POST);
    Array
    (
        [kcb_name] => 윤지영
        [kcb_birth] => 19890220
        [kcb_sex] => F
        [kcb_hp] => 01026120220
        [kcb_cert] => Y
        [kcb_telcom] => 02
    )
    */
    // 아이티포원테스트
    if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103" || $_SERVER['REMOTE_ADDR'] == "121.140.204.65") {
        $_POST = array("nice_name" => "홍길동", "nice_birth" => 19890220, "nice_sex" => "F", "nice_hp" => "01026120220", "nice_cert" => "Y");
    }

    // NICE 본인인증 POST
    $nice_name = $_POST['nice_name'];
    $nice_sex = $_POST['nice_sex'];
    $nice_birth = $_POST['nice_birth'];
    $nice_hp = $_POST['nice_hp'];
    $nice_cert = $_POST['nice_cert'];

    if ($nice_cert == "Y") {
        $member['mb_name'] = $nice_name;
        $member['mb_sex'] = ($nice_sex == "0") ? "여" : "남";
        $member['mb_birth'] = substr($nice_birth, 0, 4) . "-" . substr($nice_birth, 4, 2) . "-" . substr($nice_birth, 6, 2);
        $member['mb_hp'] = $nice_hp;
        $member['mb_certify'] = "Y";

        // 본인확인 후 데이터 검사
        // if ($member['mb_name'] == "" || $member['mb_sex'] == "" || $member['mb_birth'] == "" || $member['mb_hp'] == "")
        //     alert("본인확인 정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.", G5_BBS_URL . "/register_form.php?#step=1");
    }

    // // KCB 본인인증 POST
    // $kcb_name = $_POST['kcb_name'];
    // $kcb_sex = $_POST['kcb_sex'];
    // $kcb_birth = $_POST['kcb_birth'];
    // $kcb_hp = $_POST['kcb_hp'];
    // $kcb_cert = $_POST['kcb_cert'];
    //
    // if ($kcb_cert == "Y") {
    //     $member['mb_name'] = $kcb_name;
    //     $member['mb_sex'] = ($kcb_sex == "M") ? "남" : "여";
    //     $member['mb_birth'] = substr($kcb_birth, 0, 4) . "-" . substr($kcb_birth, 4, 2) . "-" . substr($kcb_birth, 6, 2);
    //     $member['mb_hp'] = $kcb_hp;
    //     $member['mb_certify'] = "Y";
    //
    //     // 본인확인 후 데이터 검사
    //     if ($member['mb_name'] == "" || $member['mb_sex'] == "" || $member['mb_birth'] == "" || $member['mb_hp'] == "")
    //         alert("본인확인 정보를 받아오는데 실패하였습니다. 다시 시도해 주세요.", G5_BBS_URL . "/register_form.php?#step=1");
    //
    // }

} else if ($w == 'u') {
    $readonly = "readonly";
    if ($is_admin)
        alert('관리자의 회원정보는 관리자 페이지에서 수정해주세요.', G5_URL."/app");

    if (!$is_member)
        alert('로그인이 필요합니다.', G5_URL."/bbs/login.php");

    set_session("edit_mb_id", $member['mb_id']);

    // if ($member['mb_id'] != $_POST['mb_id'])
    //     alert('로그인된 회원과 넘어온 정보가 서로 다릅니다.', G5_URL."/app/login.php");

    // if (!($member[mb_password] == sql_password($_POST[mb_password]) && $_POST[mb_password]))
    //     alert("비밀번호가 틀립니다.");

    // 수정 후 다시 이 폼으로 돌아오기 위해 임시로 저장해 놓음
    // set_session("ss_tmp_password", $_POST[mb_password]);

    // if ($_POST['mb_password']) {
        // 수정된 정보를 업데이트후 되돌아 온것이라면 비밀번호가 암호화 된채로 넘어온것임
        // if ($_POST['is_update'])
        //     $tmp_password = $_POST['mb_password'];
        // else
        //     $tmp_password = get_encrypt_string($_POST['mb_password']);
        //
        // if ($member['mb_password'] != $tmp_password)
        //     alert('비밀번호가 틀립니다.');
    // }

    $g5['title'] = '회원 정보 수정';

}
include_once('./_head.php');
include_once($member_skin_path.'/register_form.skin.php');
include_once('./_tail.php');
?>


<?

die();

/*
if ($w == "") {
    // 회원 로그인을 한 경우 회원가입 할 수 없다
    // 경고창이 뜨는것을 막기위해 아래의 코드로 대체
    // alert("이미 로그인중이므로 회원 가입 하실 수 없습니다.", "./");
    if ($is_member) {
        goto_url(G5_URL);
    }

    // 리퍼러 체크
    referer_check();

    // if (!isset($_POST['agree']) || !$_POST['agree']) {
    //     alert('회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.', G5_BBS_URL.'/register.php');
    // }

    // if (!isset($_POST['agree2']) || !$_POST['agree2']) {
    //     alert('개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.', G5_BBS_URL.'/register.php');
    // }

    $member['mb_birth'] = '';
    $member['mb_sex']   = '';
    $member['mb_name']  = '';
    if (isset($_POST['birth'])) {
        $member['mb_birth'] = $_POST['birth'];
    }
    if (isset($_POST['sex'])) {
        $member['mb_sex']   = $_POST['sex'];
    }
    if (isset($_POST['mb_name'])) {
        $member['mb_name']  = $_POST['mb_name'];
    }

    $g5['title'] = '회원 가입';

} else if ($w == 'u') {

    if ($is_admin)
        alert('관리자의 회원정보는 관리자 화면에서 수정해주세요.', G5_URL);

    if (!$is_member)
        alert('로그인이 필요합니다.', G5_URL);

    if ($member['mb_id'] != $_POST['mb_id'])
        alert('로그인된 회원과 넘어온 정보가 서로 다릅니다.');


    if (!($member[mb_password] == sql_password($_POST[mb_password]) && $_POST[mb_password]))
        alert("비밀번호가 틀립니다.");

    // 수정 후 다시 이 폼으로 돌아오기 위해 임시로 저장해 놓음
    set_session("ss_tmp_password", $_POST[mb_password]);


    if ($_POST['mb_password']) {
        // 수정된 정보를 업데이트후 되돌아 온것이라면 비밀번호가 암호화 된채로 넘어온것임
        if ($_POST['is_update'])
            $tmp_password = $_POST['mb_password'];
        else
            $tmp_password = get_encrypt_string($_POST['mb_password']);

        if ($member['mb_password'] != $tmp_password)
            alert('비밀번호가 틀립니다.');
    }

    set_session("ss_reg_mb_name", $member['mb_name']);
    set_session("ss_reg_mb_hp", $member['mb_hp']);

    $member['mb_email']       = get_text($member['mb_email']);
    $member['mb_homepage']    = get_text($member['mb_homepage']);
    $member['mb_birth']       = get_text($member['mb_birth']);
    $member['mb_tel']         = get_text($member['mb_tel']);
    $member['mb_hp']          = get_text($member['mb_hp']);
    $member['mb_addr1']       = get_text($member['mb_addr1']);
    $member['mb_addr2']       = get_text($member['mb_addr2']);
    $member['mb_signature']   = get_text($member['mb_signature']);
    $member['mb_recommend']   = get_text($member['mb_recommend']);
    $member['mb_profile']     = get_text($member['mb_profile']);
    $member['mb_1']           = get_text($member['mb_1']);
    $member['mb_2']           = get_text($member['mb_2']);
    $member['mb_3']           = get_text($member['mb_3']);
    $member['mb_4']           = get_text($member['mb_4']);
    $member['mb_5']           = get_text($member['mb_5']);
    $member['mb_6']           = get_text($member['mb_6']);
    $member['mb_7']           = get_text($member['mb_7']);
    $member['mb_8']           = get_text($member['mb_8']);
    $member['mb_9']           = get_text($member['mb_9']);
    $member['mb_10']          = get_text($member['mb_10']);

    $g5['title'] = '회원 정보 수정';

// } else {
//     alert('w 값이 제대로 넘어오지 않았습니다.');
}

include_once('./_head.php');

// 회원아이콘 경로
// $mb_icon_path = G5_DATA_PATH.'/member/'.substr($member['mb_id'],0,2).'/'.$member['mb_id'].'.gif';
// $mb_icon_url  = G5_DATA_URL.'/member/'.substr($member['mb_id'],0,2).'/'.$member['mb_id'].'.gif';



include_once($member_skin_path.'/register_form.skin.php');
include_once('./_tail.php');
*/
