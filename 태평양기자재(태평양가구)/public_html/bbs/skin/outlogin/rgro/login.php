 <table border=0 cellspacing=1 cellpadding=4 width=100% bgcolor=888888>
  <tr bgcolor=white> 
    <td align="center" class="login">로 그 인</td>
  </tr>
</table>
<img width=1 height=2><br>
<table border=0 width=100% cellspacing=1 cellpadding=4 bgcolor=dddddd>
<form name=form_outlogin action="<?=$login_url?>" method="post">
  <tr> 
    <td valign=top bgcolor=white>
      <table cellpadding=4 cellspacing=0 border=0 width=100%>
        <col width=></col>
        <col width=60></col>
          <input type=hidden name=act value='ok'>
          <input type=hidden name=url value='<?=$url?>'>
          <tr> 
            <td> <table border=0 cellspacing=0 cellpadding=0 width=100%>
                <col width=52></col>
                <col></col>
                <tr> 
                  <td align="right" class="login">아이디 :&nbsp;</td>
                  <td><input type=text name=mb_id style="width:100%;" itemname='아이디' required></td>
                  <td></td>
                </tr>
              </table>
              <img border=0 height=4 width="1"><br> 
              <table border=0 cellspacing=0 cellpadding=0 width=100%>
                <col width=52></col>
                <col></col>
                <tr> 
                  <td align="right" class="login">암호 :&nbsp;</td>
                  <td><input type=password name=mb_password style="width:100%;" itemname='암호' required></td>
                  <td></td>
                </tr>
              </table></td>
          </tr>
      </table>
      <table cellpadding=3 cellspacing=0 border=0 width=100% height=30>
        <col width=50%></col>
        <col width=></col>
        <tr align="center"> 
          <td colspan="2"><input name="submit" type="submit" style="width:100%" value="로그인"></td>
        </tr>
        <tr align="center"> 
          <td><a href="<?=$member_join_url?>" class="login">회원가입</a> </td>
          <td><a href="<?=$password_url?>" class="login">암호분실</a> </td>
        </tr>
      </table></td>
  </tr>
  </form>
</table>
