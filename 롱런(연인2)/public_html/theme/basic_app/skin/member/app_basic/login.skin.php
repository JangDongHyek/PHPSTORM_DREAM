<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);
?>
<style>
    body{background: url("<?php echo $member_skin_url ?>/img/bg.jpg") no-repeat #ce4067 top center/100% auto;
        height:100vh; display: grid; align-items: center; /*justify-content: center;*/}
    #hd {display: none;}
</style>
<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1>
        <img src="<?php echo G5_IMG_URL ?>/logo_white.svg" alt="<?php echo $config['cf_title']; ?>" class="logo">
        <p>Membership Login</p>
    </h1>

    <!--<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">-->
    <form method="post" autocomplete="off" onsubmit="return flogin_submit(this)">
    <!--<input type="hidden" name="url" value="<?php echo $login_url ?>">-->
        <input type="hidden" name="url" value="<?=$_GET['url']?>">
        <input type="hidden" name="app_type" value="<?=$app_type?>">
        <input type="hidden" name="app_ver" value="<?=$inapp_vercode?>">
        <fieldset id="login_fs">
            <legend>이메일</legend>
            <label for="login_id" class="login_id">아이디<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="mb_id" id="login_id" class="frm_input" size="20" placeholder="아이디를 입력해주세요">
            <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
            <input type="password" name="mb_password" id="login_pw" class="frm_input" size="20" maxLength="20" placeholder="비밀번호를 입력해주세요">
            <input type="submit" value="로그인하기" class="btn_submit">
        </fieldset>

        <aside id="login_info">
            <a href="./register_form.php">아직 롱런회원이 아니세요? > 회원가입</a>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php">아이디/비밀번호를 잃어버렸어요</a>

            <a href="http://www.longrun.kr/" target="_blank" class="guide">
                <i class="fa-sharp fa-solid fa-heart"></i> 롱런 이용방법 <i class="fa-sharp fa-solid fa-heart"></i>
            </a>
        </aside>
        <!--<div id="login_sns">
            <a href="" class="ka"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/sns_kakao.png" />카카오로 로그인</a>
            <a href="" class="ne"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/sns_naver.png" />네이버로 로그인</a>
        </div>-->
    </form>
</div>

<script>
    // 로그인하기
    function flogin_submit(f) {
        f.mb_id.value = trim(f.mb_id.value);

        if (f.mb_id.value.length == 0) {
            swal('아이디를 입력해 주세요.');
            return false;
        }

        if(f.mb_password.value.length == 0) {
            swal('비밀번호를 입력해 주세요.');
            return false;
        }

        let msg = "로그인에 실패했습니다.";

        $.ajax({
            type : "POST",
            url : "./ajax.login_check.php",
            data : {mb_id: f.mb_id.value, mb_password: f.mb_password.value},
            dataType : "json",
        }).done(function(data, textStatus, xhr) {
            console.log(data);
            if (f.app_type.value == "AOS") {
                saveMemberInfo(f.mb_id.value, f.app_type.value);

                // 페이스북 SDK (aos ver 1 이상)
                if (parseInt(f.app_ver.value) >= 1) {
                    saveFacebookLogEvent('로그인');
                }
            }

            if (data.result) {
                <?php // 관리자 로그인 ?>
                if (data.level == '10') {
                    location.href = g5_url + '/adm';
                    return;
                }

                if (f.url.value != "") location.href = f.url.value;
                else location.href = g5_url + "/app/index.php";
            } else {
                if (data.msg != "") msg = data.msg;
                swal(msg);
            }
        }).fail(function(data, textStatus, errorThrown) {
            swal(msg);
        });

        return false;
    }

</script>
<!-- } 로그인 끝 -->
