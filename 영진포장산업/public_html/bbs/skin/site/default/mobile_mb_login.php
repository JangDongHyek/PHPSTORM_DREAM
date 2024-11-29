<style type="text/css">
/*로그인*/
.center {text-align:center;}
.m_login_t { color:#333; text-align:center; font-size:18px; font-weight:bold}
#m_login {padding:0;margin:10px;border:1px solid #ccc;border-radius:5px;-mz-border-radius:5px;background:#fff;}
#m_login ul {list-style-type:none;padding:15px;margin:0;}
#m_login li {list-style-type:none;padding:3px;margin:0;}
#m_login input.m_input_text {width:95%;padding:5px; margin:3px; background:#f5f5f5;border:1px solid #ccc;border-radius:3px;-mz-border-radius:3px;height:32px;}
#m_login input:focus {background:#fff;}
</style>

<script type="text/javascript">
function fhead_submit(f)
{
    if (!f.mb_id.value) {
        alert("회원아이디를 입력하십시오.");
        f.mb_id.focus();
        return false;
    }

    if (!f.mb_password.value) {
        alert("패스워드를 입력하십시오.");
        f.mb_password.focus();
        return false;
    }

    return true;
}
</script>


<form name=mblogin method=post action='<?=$login_url?>' autocomplete=off>
    <input type=hidden name=act value='ok' />
  <input type=hidden name=url value='<?=$url?>' />
  <div class="m_login_t">관리자 로그인</div>
<div id="m_login">
	<ul>
		<li><input name="mb_id" type="text" id="id" class="m_input_text" size="10" tabindex="1" maxlength="20" required placeholder='아이디'  onFocus="this.placeholder=''"></li>	
		<li><input name="mb_password" id="pw" type="password" tabindex="2" class="m_input_text" size="10" maxlength="20" placeholder='패스워드' onFocus="this.placeholder=''"></li>
		<li class="center" style="margin-top:5px;"><span class="button xLarge"><input type="submit" tabindex="3" value="로그인"></span></li>
		</ul>
</div>
</form>


</body>
</html>
