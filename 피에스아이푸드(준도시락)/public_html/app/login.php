<?php
$g5['title'] = '로그인';
//include_once('./_head.php');
include_once("./app_head.php");

/**
 * 로그인
 */

$url = $_GET['url'];

// url 체크
check_url_host($url);

// 이미 로그인 중이라면
if ($is_member) {
    if ($url)
        goto_url($url);
    else
        goto_url(G5_URL);
}

$login_url        = login_url($url);
$login_action_url = APP_URL."/login_check.php";

// 로그인 스킨이 없는 경우 관리자 페이지 접속이 안되는 것을 막기 위하여 기본 스킨으로 대체
$login_file = $member_skin_path.'/login.skin.php';
if (!file_exists($login_file))
    $member_skin_path   = G5_SKIN_PATH.'/member/basic';

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?ver='.G5_CSS_VER.'">', 100);

// 22.01.11 네이버로그인 API
// 네이버 로그인 접근 토큰 요청
$client_id = "zInqfjri754yOtVU81sC";
$redirectURI = urlencode(APP_URL."/naver_login_callback.php");
$state = "RAMDOM_STATE";
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state; // 재인증 필요 시 뒤에 &auth_type=reauthenticate 붙임
?>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1><?php echo $config['cf_title']; ?> 회원로그인</h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
        <input type="hidden" name="url" value="<?php echo $login_url ?>">
        <input type="hidden" name="token" id="token"> <!--푸시-->
        <fieldset id="login_fs">
            <legend>이메일</legend>
            <label for="login_id" class="login_id">이메일<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="mb_id" id="login_id" class="frm_input" size="20" placeholder="이메일">
            <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
            <input type="password" name="mb_password" id="login_pw" class="frm_input" size="20" maxLength="20" placeholder="비밀번호">
            <input type="submit" value="회원로그인" class="btn_submit">
        </fieldset>

        <div class="chk">
            <input type="checkbox" id="auto_login" name="auto_login"><label for="auto_login"><div></div>자동로그인</label>
        </div>

        <aside id="login_info">
            <a href="<?php echo APP_URL ?>/find_info.php">아이디/비밀번호 찾기</a>
            <a href="<?=APP_URL?>/register.php">회원가입</a>
        </aside>
        <!-- IOS 심사 때문에 주석 -->
        <div id="login_sns">
            <a href="javascript:loginKaKao();" class="ka"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_kakao.png" />카카오로 로그인</a>
            <?php /*if($private) { */?><!--
            <a href="<?/*=$apiURL*/?>" class="ne"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/sns_naver.png" />네이버로 로그인</a>
            <?php /*} else { */?>
            <a onclick="swal('준비중입니다.');return false;" class="ne"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/sns_naver.png" />네이버로 로그인</a>
            --><?php /*} */?>
        </div>
    </form>
</div>

<!--카카오 로그인-->
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>

<script>
    // 발급받은 앱 키 - JavaScript 키 (내 애플리케이션 > 앱 설정 > 앱 키)
    Kakao.init('<?=$kakao_javascript_key?>');
    console.log(Kakao.isInitialized()); // sdk 초기화여부판단

    //카카오로그인
    function loginKaKao() {
        Kakao.Auth.authorize({
            redirectUri: '<?=APP_URL?>/kakao_login_callback.php'
        });
    }

    function flogin_submit(f) {
        if($("input:checkbox[name=auto_login]").is(":checked")) {
            $('#auto_login').val('Y');
        } else {
            $('#auto_login').val('');
        }

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

    // 푸시
    function fcmKey(token) {
        $("input[name='token']").val(token); //토큰값을 필드에 넣기 mb_10일 경우 mb_10으로 하면된다
    }
</script>
<!-- } 로그인 끝 -->

<?php
include_once('./app_tail.php');
?>
