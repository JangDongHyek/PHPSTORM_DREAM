<table width="800" height="300" border="0">
  <tr>
    <td>&nbsp;</td>
    <td align="center">
	  <?=$show_joining_check_begin?>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center">ȸ�����Կ��� Ȯ��</td>
        </tr>
      </table>
	  <table width="710" border="0">
	    <form name="mb_check" action="mb_check.php" method="post" target="mbcheck" onSubmit="return popup_member('./', 'jumin1', 'jumin2');">
        <tr>
          <td height="40" align="center">�ֹε�Ϲ�ȣ <input type="text" name='mb_jumin1' required itemname="�ֹε�Ϲ�ȣ" size="9" maxlength="6"> 
          - <input type="text" name='mb_jumin2' required itemname="�ֹε�Ϲ�ȣ"  size="11" maxlength="7"> 
          <input type="submit" value="����Ȯ��"></td>
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
          <td align="center">ȸ�����</td>
        </tr>
      </table>
	  <table width="710" border="0" cellpadding="0" cellspacing="1" bgcolor="D8D0C9">
        <tr>
         <td height="170" align="center" bgcolor="ffffff"><iframe src="<?=$skin_site_path?>contract.php" frameBorder=0 width=708 height=150></iframe></td>
        </tr>
      </table>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center"><input type="checkbox" name="agree[]" value="1"> �� ����� ������</td>
        </tr>
      </table>
	  <?=$show_agreement_end?>

	  <?=$show_pravacy_policy_begin?>
      <br>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center">�������� ��ȣ��å</td>
        </tr>
      </table>
      <table width="710" border="0" cellpadding="0" cellspacing="1" bgcolor="D8D0C9">
        <tr>
          <td height="170" align="center" bgcolor="ffffff"><iframe src="<?=$skin_site_path?>policy.php" frameBorder=0 width=708 height=150></iframe></td>
        </tr>
      </table>
	  <table width="710" height="35" border="0">
        <tr>
          <td align="center"><input type="checkbox" name="agree[]" value="1"> �� ��å�� ������</td>
        </tr>
      </table>
	  <br><br>
	  <table width="710" border="0">
        <tr>
          <td height="40" align="center">�� ȸ�����/�������� ��ȣ��å�� Ȯ���ϰ� ȸ�������� ��û�Ͻʽÿ�.</td>
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
          <td align="center"><input type="submit" value="ȸ�� ���� ��û"></td>
        </tr>
      </table>
	</td>
	<td>&nbsp;</td>
  </tr>
  </form>
</table>
<br>
