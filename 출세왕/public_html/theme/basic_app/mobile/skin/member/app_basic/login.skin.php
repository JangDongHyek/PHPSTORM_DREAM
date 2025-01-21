<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);

//네이버 로그인
$client_id = "l5GRogytpP3h5O_KgjgB";

$redirectURI =  urlencode(G5_BBS_URL."/callback_naver.php");
$state = "RAMDOM_STATE";
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;

?>
<style>
body{background:#1a7cff; }
    #add_footer,
    #add_footer a{
        color: #fff;
        text-align: center;
        opacity: 0.8;
    }
</style>
<script>
    try{
        localStorage.clear();

        var varUA = navigator.userAgent.toLowerCase();
        var regExpAndroid = /easyapp_android/gi;
        var regExpIos = /softapp_ios/gi;

        if (varUA.match(regExpAndroid)) {
            window.EasyappAOS.loadingFinish();
            localStorage.setItem("is_android","Y");
            localStorage.setItem("is_app","Y");
            window.EasyappAOS.getFcmInfo();
        } else if (varUA.match(regExpIos)) {
            localStorage.setItem("is_ios","Y");
            localStorage.setItem("is_app","Y");
            //webkit.messageHandlers.getFcmInfo.postMessage("");
            webkit.messageHandlers.getDeviceId.postMessage("");
            webkit.messageHandlers.getFcmToken.postMessage("");
        } else {
            localStorage.setItem("is_app","N");
        }
    }catch (e){
        localStorage.setItem("is_app","N");
    }finally{

    }
    function responseGetDeviceId(id){
        var device_uuid = $("<input name='device_uuid' type='hidden' value='"+id+"'>");
        var device_platform = $("<input name='device_platform' type='hidden' value='IOS'>");
        $("#login_form").append(device_uuid).append(device_platform);
    }
    function responseGetFcmToken(token){
        var push_register_id = $("<input name='push_register_id' type='hidden' value='"+token+"'>");
        $("#login_form").append(push_register_id);
    }
    function responseGetFcmInfo(token, id, kind){
        $("input[name='login_type']").val("APP");
        var device_uuid = $("<input name='device_uuid' type='hidden' value='"+id+"'>");
        var push_register_id = $("<input name='push_register_id' type='hidden' value='"+token+"'>");
        var device_platform = $("<input name='device_platform' type='hidden' value='"+kind+"'>");
        $("#login_form").append(device_uuid).append(push_register_id).append(device_platform);
    }

</script>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.png" class="logo"></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post" id="login_form">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <select name="level" id="level">
            <option value="">분류를 선택해주세요</option>
            <?php for ($i = 1; $i <= count($level_list); $i++){ ?>
            <option value="<?=$level_list[$i]['value']?>"><?=$level_list[$i]['name']?></option>
            <?php } ?>
        </select>
        <label for="login_id" class="login_id">회원아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="아이디">
        <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호">
        <input type="submit" value="로그인" class="btn_submit lgn">
        <!--<div class="chk_ico">
            <input type="checkbox" name="auto_login" id="login_auto_login">
            <label for="login_auto_login" class="auto_login">자동로그인</label>
        </div>-->
    </fieldset>

    <aside id="login_info">
        <?php /*?><h2>회원로그인 안내</h2>
        <p>
            회원아이디 및 비밀번호가 기억 안나실 때는 아이디/비밀번호 찾기를 이용하십시오.<br>
            아직 회원이 아니시라면 회원으로 가입 후 이용해 주십시오.
        </p><?php */?>
        <div>
            <?php /*?><a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="login_password_lost" class="btn02">아이디 비밀번호 찾기</a><?php */?>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="btn02">내정보찾기</a>
            <a href="./register_form.php" class="btn01">회원가입</a>
        </div>
    </aside>

    <?php /*?><div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
    </div><?php */?>
    <?php /*
    <ul class="sns_login_wrap">
        <li class="kakao"><a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_kakao.png" class="sns_login_icon">카카오로 로그인하기</a></li>
        <li class="naver"><a href="<?=$apiURL?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_naver.png" class="sns_login_icon">네이버로 로그인하기</a></li>
        <li class="google"><a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_google.png" class="sns_login_icon">구글로 로그인하기</a></li>
    </ul> */ ?>

    </form>
    <div id="add_footer" style="margin-top: 30px; font-size: 12px">
        <p><b>출세왕</b></p>
        <p>대표자 : 김홍규</p>
        <p>부산광역시 강서구 영강길 31, 2층(명지동)</p>
        <p>사업자 등록번호 : 174-67-00420</p>
        <p>대표번호 : 010-6610-3103</p>
        <p>대표이메일 : gimhonggyu88@hanmail.net</p>
<!--        <p>팩스 : 000-0000</p>-->
        <p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">이용약관</a><span class="line"></span><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보처리방침</a></p>
    </div>
</div>

<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{

    if ($("#level").val() == ""){
        swal("분류를 선택해주세요.");
        return false;
    }

    return true;
}
</script>
<!-- } 로그인 끝 -->