<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
html, body{width:100%;height:100%;min-height:500px; background:#fff; overflow-y:hidden; overflow-x:hidden;}
</style>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1><img src="<?php echo G5_IMG_URL ?>/logo2.png" /><span class="sound_only"><?php echo $g5['title'] ?></span></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="login_id" class="login_id"><strong class="sound_only">회원아이디 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="회원아이디">
        <label for="login_pw" class="login_pw"><strong class="sound_only">비밀번호 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호">
        <input type="submit" value="로그인" class="btn_submit">
        <!--<input type="checkbox" name="auto_login" id="login_auto_login" style="margin:0;"> 
        <label for="login_auto_login">자동로그인</label>-->
		
		<!--div style="text-align:center; padding-top:10px;"><a href="http://brosandkim.dreamforone.co.kr/theme/basic/mobile/pri.php">[ 개인정보처리방침 ]</a></div-->
		
    </fieldset>
	



    <aside id="login_info">
        <h2>회원로그인 안내</h2>
        <p>
            회원아이디 및 비밀번호는 고객센터로 문의바랍니다.<br>
            회원가입 또한 고객센터(관리자)를 통해 가능합니다.
        </p>
        <div>
            <?php /*?><a href="tel:010-2282-3751" class="btn02"><i class="fa fa-phone" aria-hidden="true"></i> 고객센터</a>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank" id="login_password_lost" class="btn02">ID/PW 찾기</a>
            <a href="./register.php" class="btn01">회원 가입</a><?php */?>

            <!-- Button trigger modal -->
            <a type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-phone" aria-hidden="true"></i> 고객센터
            </a>
        </div>
    </aside>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">고객센터</h4>
          </div>
          <div class="modal-body">
            <a href="tel:010-9247-8170" class="btn btn-default btn-lg"><i class="fa fa-phone" aria-hidden="true"></i> 010-9247-8170</a>
            <a href="tel:02-6951-4120" class="btn btn-default btn-lg"><i class="fa fa-phone" aria-hidden="true"></i> 02-6951-4120</a>
          </div>
          <?php /*?><div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div><?php */?>
        </div>
      </div>
    </div>

    <?php /*?><div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
    </div><?php */?>

    </form>

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
    return true;
}
</script>
<!-- } 로그인 끝 -->