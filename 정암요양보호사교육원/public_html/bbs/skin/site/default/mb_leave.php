<form name=mblogin method=post action='' autocomplete=off onSubmit="return chk_form();">
  <table width=400 align=center border=0 cellpadding=3 cellspacing=1>
    <input type=hidden name=act value='ok'>
    <input type=hidden name=url value='<?=$url?>'>
    <col width=40% align=center>
    <col width=60%>
    <tr> 
      <td colspan=2> <table width=100% cellpadding=3 cellspacing=1 class=tablebg>
          <tr> 
            <td align=center height=30 class=subjectbg><span class=subject>Ż��<br>
              <br>
              ����Ȯ���� ���� ���̵�� ��ȣ�� �Է��ϼ���.</span></td>
          </tr>
        </table></td>
    
    <tr> 
      <td height=30><span class=subject>���̵�</span></td>
      <td><input type=text name='mb_id' size=20 maxlength=20 minlength=2 required itemname='���̵�' class=input></td>
    </tr>
    <tr> 
      <td height=30><span class=subject>��ȣ</span></td>
      <td><input type=password name='mb_password' size=20 maxlength=20 required itemname='��ȣ' class=input></td>
    </tr>
  </table>
  <p> 
  <div align=center> 
    <input name="submit" type=submit class=button value='   Ȯ   ��   '>
    <input name="button" type=button class=button onclick='history.go(-1);' value=' �� �� '>
  </div>
</form>
<script language="JavaScript" type="text/JavaScript">
function chk_form()
{
  if(!confirm('Ȯ���մϱ�'))
    return false;
  return true;
}
</script>
