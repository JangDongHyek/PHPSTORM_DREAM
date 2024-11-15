<table width="800" height="300" border="0">
  <tr>
    <td>&nbsp;</td>
    <td align="center">
	  <?=$show_joining_check_begin?>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center">회원가입여부 확인</td>
        </tr>
      </table>
	  <table width="710" border="0">
	    <form name="mb_check" action="mb_check.php" method="post" target="mbcheck" onSubmit="return popup_member('./', 'jumin1', 'jumin2');">
        <tr>
          <td height="40" align="center">주민등록번호 <input type="text" name='mb_jumin1' required itemname="주민등록번호" size="9" maxlength="6"> 
          - <input type="text" name='mb_jumin2' required itemname="주민등록번호"  size="11" maxlength="7"> 
          <input type="submit" value="가입확인"></td>
        </tr>
		</form>
	  </table>
	  <?=$show_joining_check_end?>
	</td>
	<td>&nbsp;</td>
  </tr>
  <form name="frm_agree" method="post" action="mb_join.php" onSubmit="return confirm_agree();">
  <input type=hidden name=url value='<?=$url?>'>
  <tr>
    <td>&nbsp;</td>
	<td align=center>	
	  <?=$show_agreement_begin?>
	  <br>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center">회원약관</td>
        </tr>
      </table>
	  <table width="710" border="0" cellpadding="0" cellspacing="1" bgcolor="D8D0C9">
        <tr>
         <td height="170" align="center" bgcolor="ffffff"><iframe src="<?=$skin_site_path?>contract.php" frameBorder=0 width=708 height=150></iframe></td>
        </tr>
      </table>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center"><input type="checkbox" name="agree[]" value="1"> 위 약관에 동의함</td>
        </tr>
      </table>
	  <?=$show_agreement_end?>

	  <?=$show_pravacy_policy_begin?>
      <br>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center">개인정보 보호정책</td>
        </tr>
      </table>
      <table width="710" border="0" cellpadding="0" cellspacing="1" bgcolor="D8D0C9">
        <tr>
          <td height="170" align="center" bgcolor="ffffff"><iframe src="<?=$skin_site_path?>policy.php" frameBorder=0 width=708 height=150></iframe></td>
        </tr>
      </table>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center"><input type="checkbox" name="agree[]" value="1"> 위 정책에 동의함</td>
        </tr>
      </table>
	  <br><br>
	  <table width="710" border="0">
        <tr>
          <td height="40" align="center">위 회원약관/개인정보 보호정책을 확인하고 회원가입을 신청하십시오.</td>
        </tr>
	  </table>
	  <?=$show_pravacy_policy_end?>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	<td align=center>
	  <table width="710" border="0">
		<tr>
          <td align="center"><input type="submit" value="회원 가입 신청"></td>
        </tr>
      </table>
	</td>
	<td>&nbsp;</td>
  </tr>
  </form>
</table>
<br>
