<table border=0 cellspacing=1 cellpadding=4 width=100% bgcolor=888888>
  <tr bgcolor=white> 
    <td align="center" class="login"> 
      <?=$mb_id?>
      �α������Դϴ�.</td>
  </tr>
</table>
<img width=1 height=2><br>
<table border=0 width=100% cellspacing=1 cellpadding=4 bgcolor=dddddd>
  <tr> 
    <td valign=top bgcolor=white> 
      <table border=0 cellspacing=0 cellpadding=2 width=100%>
        <col width=50></col>
        <col></col>
        <col width=3></col>
<?=$show_name_begin?>
        <tr> 
          <td align="right" class="login">�̸� :&nbsp;</td>
          <td class="login"> 
            <?=$mb_name?>
          </td>
          <td></td>
        </tr>
<?=$show_name_end?>
<?=$show_nick_begin?>
        <tr> 
          <td align="right" class="login">�г��� :&nbsp;</td>
          <td class="login"> 
            <?=$mb_nick?>
          </td>
          <td></td>
        </tr>
<?=$show_nick_end?>
        <tr> 
          <td align="right" class="login">����Ʈ :&nbsp;</td>
          <td class="login"> 
            <?=$mb_point?>
          </td>
          <td></td>
        </tr>
        <tr> 
          <td align="right" class="login">���� :&nbsp;</td>
          <td class="login"> 
            <?=$mb_level?>
          </td>
          <td></td>
        </tr>
      </table>
		</td>
	</tr>
	<tr>
		<td bgcolor=white>
      <img width=1 height=2><br> <table cellpadding=0 cellspacing=0 border=0 width=100% height=25>
        <col width=50%>
        <col width=>
        <tr align="center"> 
          <td><a href="<?=$logout_url?>" class="login">�α׾ƿ�</a></td>
          <td><a href="<?=$member_modify_url?>" class="login">��������</a></td>
        </tr>
        <tr align="center"> 
          <td> 
            <?=$show_exist_memo_begin?><img src="<?=$skin_lastest_url?>new_memo.gif" width="8" height="8"><?=$show_exist_memo_end?><a href="javascript:lastest_memo()" class="login">����(<?=$mb_memo_count?>)</a></td>
          <td><a href="<?=$member_leave_url?>" class="login">ȸ��Ż��</a></td>
        </tr>
      </table>
      <?=$show_admin_begin?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td align="center"><a href="<?=$admin_url?>" target="_blank" class="login">������</a></td>
        </tr>
      </table>
      <?=$show_admin_end?>
  </table>
<script>
	function lastest_memo() {
		url = '<?=$member_memo_url?>';
		opt = 'scrollbars=yes,width=450,height=380';
		window.open(url, "memo", opt);
	} 
</script> 