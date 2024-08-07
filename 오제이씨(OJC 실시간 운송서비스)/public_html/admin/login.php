<?php
$pid = "admin";
include_once("../app/app_head.php");

/* direction */
if($is_member){
    if($member['mb_id'] == 'admin') header("Location: ./");
    else header("Location: ".G5_BBS_URL."/logout.php?type=admin");
    exit;
}

?>

<style>
body{width:100%;overflow-y:hidden; overflow-x:hidden;background: url(../theme/basic_app/img/common/bg2.png) center center no-repeat; background-size: cover}
</style>

<link rel="stylesheet" href="<?=G5_THEME_CSS_URL ?>/admin.css<?=LastFileVer?>">

<div id="mb_login" class="mbskin">
 	<p><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_w.svg" class="icon"></p>
    <p><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_copy_w.svg" class="logo"></p>
    <p>운송 관리 시스템 관리자</p>
	
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="login_id" class="login_id"><strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input" size="20" maxLength="20" placeholder="아이디" autofocus>
        <label for="login_pw" class="login_pw"><strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input" size="20" maxLength="20" placeholder="비밀번호">
    </fieldset>
	<div class="button" onclick="loginAdmin()">
		<input type="submit" value="로그인" class="btn_submit">
    </div>
</div>

<script>
    
    async function loginAdmin(){
        let $login_id = $('#login_id'),
            $login_pw = $('#login_pw'),
            falseMsg = '',
            target = null;
        
        if(!$login_id.val()){
            falseMsg = '아이디를 입력해주세요.';
            target = $login_id;
        }else if(!$login_pw.val()){
            falseMsg = '비밀번호를 입력해주세요.';
            target = $login_pw;
        }
        
        if(target != null){
            swal(falseMsg)
            .then(() => {
                target.focus(); 
            });
            return;
        }
        
        const memberRes = await postJson(getAjaxUrl('admin'), {            
            mode : 'login',            
            id : $login_id.val(),
            password : $login_pw.val()
        });

        if(!memberRes.result){
            swal(memberRes.msg)
            .then(() => {
               memberRes.target == 'id'? $login_id.focus() : $login_pw.focus();
            });
            return false;
        }
        
        location.replace('./');
    }
    
    $(function(){
        $('#login_id, #login_pw').on('keyup', function(e){
            if(e.keyCode != 13) return false;
            
            loginAdmin();
            return false;
        });
    });
    
</script>

<?php
include_once ("../app/tail.sub.php");
?>