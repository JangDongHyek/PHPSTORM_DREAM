<?php
$sub_id = "register_form";
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');

// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

if ($w == "") {

    // 페이스북 로그인/회원가입 시 아이디 중복 체크
    if(!empty($email)) {
        $count = sql_fetch(" select count(*) as count from g5_member where mb_id = '{$_POST['email']}' and mb_sns = 'facebook' ")['count']; // 페이스북 회원가입으로 가입한 이력이 있는지 확인
        if($count != 0) {
            // 이미 회원가입 시 바로 로그인
            $mb = get_member($_POST['email']);
            set_session('ss_mb_id', $mb['mb_id']);
            set_session('ss_mb_no', $mb['mb_no']);
            // FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
            set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
            set_session('ss_sns', 'Y' );

            // 자동 로그인
            $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
            set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
            set_cookie('ck_auto', $key, 86400 * 31 * 9999);
            set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);

            goto_url(G5_URL);
        }

        $count = sql_fetch(" select count(*) as count from g5_member where mb_id = '{$email}' ")['count']; // 페이스북 회원가입으로 가입한 이력 없을 경우 아이디 중복 확인
        if($count != 0) {
            alert('이미 사용중인 회원아이디 입니다.', G5_BBS_URL.'/login.php');
        }
    }

    // 회원 로그인을 한 경우 회원가입 할 수 없다
    // 경고창이 뜨는것을 막기위해 아래의 코드로 대체
    // alert("이미 로그인중이므로 회원 가입 하실 수 없습니다.", "./");
    if (isset($_GET['code'])){
        $get_data = $_GET;
        $app_key = $config['cf_kakao_js_apikey'];
        $redirect_uri = G5_BBS_URL.'/register_form.php';
        $shell_string = "curl -v -X POST https://kauth.kakao.com/oauth/token -d 'grant_type=authorization_code' -d 'client_id=".$app_key."' -d 'redirect_uri=".$redirect_uri."' -d 'code=".$get_data['code']."'";
        $output = shell_exec($shell_string);

        $token_json = json_decode($output, true);


        $kakao_email_check = 0;
        if (@!$token_json['access_token']) {
            alert('아이디 정보가 없습니다. 재시도 해주세요.',G5_BBS_URL.'/login.php');
            exit();
        } else {
            $shell_string = "curl -v -X POST https://kapi.kakao.com/v2/user/me -H 'Authorization: Bearer " . $token_json['access_token'] . "' -d 'property_keys=" . $_REQUEST['kakao_acount']['email'] . "'";

            $user_info = shell_exec($shell_string);


            $user = json_decode($user_info, true);

            //이메일 필수항목인데 안하면 경고창
//            if (!@$user['kakao_account']['email']) {
//                $shell_string = "curl -v -X POST https://kapi.kakao.com/v1/user/unlink -H 'Authorization: Bearer " . $token_json['access_token'] . "'";
//                shell_exec($shell_string);
//
//                alert('필수 정보에 동의하지 않으셨습니다. 로그인을 재시도 해주세요.', G5_BBS_URL.'/register.php');
//            }


            //멤버인가, 같은 sns로 가입한게 맞는가 검사
            $mb = get_member($user["kakao_account"]["email"]);
            if (isset($mb['mb_id'])) {

                if ($mb['mb_sns'] != 'kakao'){
                    alert("같은 이메일로 회원가입한 이력이 있습니다. 다른 sns로 접근해주세요.",G5_URL);
                }
                $mb = get_member($user["kakao_account"]["email"]);
                // 탈퇴한 아이디인가?
                if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
                    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
                    alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
                }

                //멤버테이블에 데이터가 있을 경우 로그인 시킴
                if (isset($mb)) {
                    // 로그인데이터 앱저장
                    if ($android == true) {
                        echo '
                        <script>
                            window.Android.updateLoginInfo("'.$mb['mb_id'].'");
                        </script>';
                        }

                    set_session('ss_mb_id', $mb["mb_id"]);
                    set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
                    set_session('ss_mb_no', $mb["mb_no"]);
                    set_session('ss_sns', 'Y' );

                    //자동로그인
                    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
                    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
                    set_cookie('ck_auto', $key, 86400 * 31 * 9999);
                    set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);
                    //로그인시킴
                    goto_url(G5_URL);
                }
            }else{
                //이메일담아서 회원가입 페이지로 이동
                set_session('ss_sns', 'kakao' );
                set_session('ss_check_mb_id', $user["kakao_account"]["email"]);
                set_session('chk_age', $user["kakao_account"]["age_range"]);
                $mb_id = $user["kakao_account"]["email"];
//                goto_url(G5_BBS_URL.'/register_form.php?sns=Y');
            }

//            $certify_method = $result['ch_method'];

            //goto_url(G5_BBS_URL.'/register_form.php?certify_id='.$user["kakao_account"]["email"]);
        }
    }else{
        if ($is_member) {
            goto_url(G5_URL);
        }

    }

//    if (!isset($_POST['agree']) || !$_POST['agree']) {
//        alert('회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.', G5_BBS_URL.'/register.php');
//    }

//    if (!isset($_POST['agree2']) || !$_POST['agree2']) {
//        alert('개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.', G5_BBS_URL.'/register.php');
//    }

    $agree  = preg_replace('#[^0-9]#', '', $_POST['agree']);
    $agree2 = preg_replace('#[^0-9]#', '', $_POST['agree2']);

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
        alert('관리자의 회원정보는 관리자 화면에서 수정해 주십시오.', G5_URL);

    if (!$is_member)
        alert('로그인 후 이용하여 주십시오.', G5_URL);

//    if ($member['mb_id'] != $_POST['mb_id'])
//        alert('로그인된 회원과 넘어온 정보가 서로 다릅니다.');

    /*
    if (!($member[mb_password] == sql_password($_POST[mb_password]) && $_POST[mb_password]))
        alert("비밀번호가 틀립니다.");

    // 수정 후 다시 이 폼으로 돌아오기 위해 임시로 저장해 놓음
    set_session("ss_tmp_password", $_POST[mb_password]);
    */

    if ($_POST['mb_password']) {
        // 수정된 정보를 업데이트후 되돌아 온것이라면 비밀번호가 암호화 된채로 넘어온것임
        if ($_POST['is_update'])
            $tmp_password = $_POST['mb_password'];
        else
            $tmp_password = get_encrypt_string($_POST['mb_password']);

        if ($member['mb_password'] != $tmp_password)
            alert('비밀번호가 틀립니다.');
    }

    $g5['title'] = '회원 정보 수정';

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
} else {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

include_once('./_head.php');

// 회원아이콘 경로
$mb_icon_path = G5_DATA_PATH.'/member/'.substr($member['mb_id'],0,2).'/'.$member['mb_id'].'.jpg';
$mb_icon_url  = G5_DATA_URL.'/member/'.substr($member['mb_id'],0,2).'/'.$member['mb_id'].'.jpg';

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
$req_nick = !isset($member['mb_nick_date']) || (isset($member['mb_nick_date']) && $member['mb_nick_date'] <= date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400)));
$required = ($w=='') ? 'required' : '';
$readonly = ($w=='u') ? 'readonly' : '';

$agree  = preg_replace('#[^0-9]#', '', $agree);
$agree2 = preg_replace('#[^0-9]#', '', $agree2);
$mb_division = 1;
$mb_join_division = 1;
// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
if ($config['cf_use_addr'])
    add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

include_once($member_skin_path.'/register_form.skin.php');
include_once('./_tail.php');
?>