<?php
$sub_id = "register";
include_once('./_common.php');
include_once(G5_PATH."/jl/Jl.php");

// 로그인중인 경우 회원가입 할 수 없습니다.
if ($is_member) {
    goto_url(G5_URL);
}

// 세션을 지웁니다.
set_session("ss_mb_reg", "");

$g5['title'] = '회원가입';
include_once('./_head.php');

//네이버 로그인
$client_id = "zLJRPBj6a8ai5kXgCYb4";

$redirectURI =  urlencode(G5_BBS_URL."/callback_naver.php");
$state = "RAMDOM_STATE";
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;

try {
    $jl = new Jl();
}catch (Exception $e) {
    echo $e;
}
$redirect = $jl->URL."/bbs/callback_kakao.php";
$kakao_key = "93bb7b776fef8ab69a652712a974e09b";
$kakaoURL = "https://kauth.kakao.com/oauth/authorize?client_id={$kakao_key}&response_type=code&redirect_uri={$redirect}";
?>

<div id="mb_login" class="mbskin">

    <h1 class="logo">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"><br>
        <span class="title_top"><strong class="point">잡고</strong>와 함께 해요</span>
    </h1>
    <aside id="login_info">
        <div class="join"><a href="./register_new_form.php">간단 회원가입</a></div>
    </aside>
    <ul id="sns_login">
        <li class="sns naver"><a href="<?=$apiURL?>"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_naver.png" class="네이버로 회원가입"></span>네이버로 회원가입</a></li>
        <li class="sns kakao"><a href="<?=$kakaoURL?>"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_kakao.png" class="카카오로 회원가입"></span>카카오로 회원가입</a></li>
    </ul><!--lg_btn-->
</div>

<?php
include_once('./_tail.php');
?>
