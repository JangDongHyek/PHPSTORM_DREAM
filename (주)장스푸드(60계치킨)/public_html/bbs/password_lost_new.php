<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

$name = get_session("name");
$name = mb_convert_encoding($name,"UTF-8", "EUC-KR");
$hp = get_session("phoneNo");
$ci = get_session("ci");
$di = get_session("di");

unset($_SESSION['name']);
unset($_SESSION['phoneNo']);
unset($_SESSION['ci']);
unset($_SESSION['di']);

if(empty($name)){
    alert("메인으로 돌아갑니다.",G5_URL);
}

if(empty($hp)){
    alert("메인으로 돌아갑니다.",G5_URL);
}

if(empty($ci)){
    alert("메인으로 돌아갑니다.",G5_URL);
}

if(empty($di)){
    alert("메인으로 돌아갑니다.",G5_URL);
}

$sql = "select * from `g5_member` where `mb_9` = '$ci'";
$mb = sql_fetch($sql);

if(empty($mb)){
    alert("가입된 정보가 없습니다.", G5_URL);
}

set_session("pw_mb_id",$mb['mb_id']);
set_session("pw_ci", $ci);

$g5['title'] = '비밀번호 찾기';
//include_once(G5_PATH.'/head.sub.php');
include_once('./_head.php');
?>


    <div id="find_info" class="mbskin form">
        <h3>비밀번호 재설정</h3>

        <form>
            <div class="info_id">
                회원님의 아이디는 <strong><?=$mb['mb_id']?></strong>입니다.
            </div>

            <fieldset>
                <legend>비밀번호</legend>
                <label for="password">비밀번호<strong class="sound_only">필수</strong></label>
                <input type="password" name="password" id="password" class="frm_input" size="30" placeholder="비밀번호">
            </fieldset>

            <fieldset>
                <legend>비밀번호 확인</legend>
                <label for="confirm_password">비밀번호 확인<strong class="sound_only">필수</strong></label>
                <input type="password" name="confirm_password" id="confirm_password" class="frm_input" size="30" placeholder="비밀번호 확인">
            </fieldset>

            <div class="win_btn">
                <input type="button" value="비밀번호 변경" class="btn_submit" onclick="change_password()">
            </div>
        </form>
    </div>

<script>
    
    function change_password() {
        let password = $("#password").val().trim();
        let confirm_password = $("#confirm_password").val().trim();

        if(password == "" || confirm_password == ""){
            alert("비밀번호를 입력해주세요.");
            return false;
        }

        if(password != confirm_password){
            alert("비밀번호가 틀립니다.");
            return false;
        }

        $.post("<?=G5_URL?>/ajax/set_password.php",{"pass":password},function (data) {
            alert(data.msg);
            location.href = "<?=G5_URL?>";
        },"json");

    }
    
</script>

<?php
include_once('./_tail.php');
//include_once(G5_PATH.'/tail.sub.php');
?>