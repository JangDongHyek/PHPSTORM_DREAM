<?php
include_once('./_common.php');
include_once("../class/KakaoLogin.php");
include_once("../jl/Jl.php");
include_once("../jl/JlModel.php");

$jl = new Jl();

$kakao = new kakaoLogin(array(
    "redirect_uri" => $jl->URL."/bbs/callback_kakao.php",
    "client_id" => "93bb7b776fef8ab69a652712a974e09b",
));


if($_GET['code']){
    // 엑세스 토큰 발급
    $result = $kakao->getAccessToken($_GET['code']);

    // 프로필 정보 조회
    $result = $kakao->getUserMe($result['access_token']);


    $mb = get_member($result['kakao_account']['email']);

    //회원이면 로그인
    if (isset($mb["mb_id"])) {
        if ($mb['mb_sns'] != 'kakao'){
            alert("같은 이메일로  회원가입한 이력이 있습니다. 다른 sns로 접근해주세요.",G5_URL);
        }

        // 탈퇴한 아이디인가?
        if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
            $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
            alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
        }

        // 로그인데이터 앱저장
        if ($android == true) {

            echo '
                <script>
                    window.Android.updateLoginInfo("'.$mb['mb_id'].'");
                </script>';
        }


        set_session('ss_mb_id', $mb["mb_id"]);
        set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
        set_session('ss_mb_no', $mb["mb_no"] );
        set_session('ss_sns', 'Y' );
        //set_session('ss_naver_token', $refresh_token );
        //set_session('ss_naver_token2', $token );

        $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
        set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
        set_cookie('ck_auto', $key, 86400 * 31 * 9999);
        set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);
        goto_url(G5_URL);

    }else {
        $model = new JlModel(array(
            "table" => "g5_member",
            "primary" => "mb_no",
            "autoincrement" => true,
            "empty" => false
        ));

        $phone = $result['kakao_account']['phone_number'];
        if(strpos($phone,"+82") !== false) {
            $phone = str_replace('+82 ', '0', $phone);
            $phone = str_replace(' ', '', $phone);
        }

        $obj = array(
            "mb_id" => $result['kakao_account']['email'],
            "mb_email" => $result['kakao_account']['email'],
            "mb_level" => 2,
            "mb_hp" => $phone,
            "mb_name" => $result['kakao_account']['name'],
            "mb_adult" => 1,
            "mb_sns" => "kakao"
        );

        $model->insert($obj);

        $mb = get_member($result['kakao_account']['email']);

        // 로그인데이터 앱저장
        if ($android == true) {

            echo '
                <script>
                    window.Android.updateLoginInfo("'.$mb['mb_id'].'");
                </script>';
        }

        set_session('ss_mb_id', $mb["mb_id"]);
        set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
        set_session('ss_mb_no', $mb["mb_no"] );
        set_session('ss_sns', 'Y' );

        $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
        set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31 * 9999);
        set_cookie('ck_auto', $key, 86400 * 31 * 9999);
        set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);


        //goto_url(G5_BBS_URL . '/register_new_form.php?sns=Y');
        goto_url(G5_BBS_URL.'/register_result.php');
    }

}else {
    echo ("비정상적인 접근입니다.");
}
?>