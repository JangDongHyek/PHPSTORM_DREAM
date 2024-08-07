<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);
$naverUrl = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NAVER_CLIENT_ID."&redirect_uri=".urlencode(NAVER_CALLBACK_URL);
?>
<style>
body{}
#hd_wrapper{border-bottom:1px solid rgba(255,255,255,0.5);}
</style>
<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1><?php echo $config['cf_title']; ?> 회원로그인</h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">
    <fieldset id="login_fs">
        <legend>이메일</legend>
        <label for="login_id" class="login_id">이메일<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" class="frm_input" size="20" placeholder="아이디(이메일)를 입력해주세요">
        <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" class="frm_input" size="20" maxLength="20" placeholder="비밀번호를 입력해주세요">
        <input type="submit" value="회원로그인" class="btn_submit">
    </fieldset>

    <aside id="login_info">
        <a href="<?php echo G5_BBS_URL ?>/password_lost.php">아이디/비밀번호 찾기</a>
        <a href="./register_form.php">회원가입</a>
    </aside>
    <div id="login_sns">
        <a href="javascript:clickKakaoLogin();" class="ka"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_kakao.png" />카카오로 로그인</a>
        <a href="<?=$naverUrl?>" class="ne"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_naver.png" />네이버로 로그인</a>
    </div>
    </form>
</div>


<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script>


function flogin_submit(f) {
    if(f.mb_id.value.length == 0) {
        swal('이메일을 입력해 주세요.');
        return false;
    }
    if(f.mb_password.value.length == 0) {
        swal('비밀번호를 입력해 주세요.');
        return false;
    }
    return true;
}

$(function(){
    Kakao.init('ee14e8baeeb2ee2dc372a5a7c3b16ddd');
    Kakao.isInitialized();
});

// 카카오 로그인
function clickKakaoLogin(){
    Kakao.Auth.authorize({
        redirectUri: g5_bbs_url+"/register_form.php"
    });
}


// 네이버 로그인
function clickNaverLogin(){


}


</script>
<!-- } 로그인 끝 -->
