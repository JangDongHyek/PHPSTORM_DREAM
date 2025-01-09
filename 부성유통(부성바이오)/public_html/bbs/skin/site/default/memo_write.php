<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr height=35  align=center>
 <td style="border-width:1; border-color:rgb(204,204,204); border-top-style:none; border-right-style:solid; border-bottom-style:none; border-left-style:solid;"> <font color="#FF0000"><strong>쪽지 쓰기</strong></font> </td></tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
<form action="?" method="post" enctype="multipart/form-data" name="form1">
<input name="mode" type="hidden" value="write">
<input name="act" type="hidden" value="ok">
  <tr height=30 bgcolor="#F6F6F6">
      <td style="border-width:1; border-color:rgb(204,204,204); border-top-style:solid; border-right-style:solid; border-bottom-style:solid; border-left-style:solid;">    
		<table><tr><td width="25%">
		받는 사람아이디 &nbsp; </td>
		<td style="border-width:1; border-color:rgb(204,204,204); border-style:solid;"
		>
		<input name="mo_recv_mb_id" type="text" style="width:100%;border-width:1; border-style:none;" id="mo_recv_mb_id" value="<?=$mo_recv_mb_id?>">
</td></tr></table>
      </td>
  </tr>
  <tr> 
    <td style="border-width:1; border-color:rgb(204,204,204); border-top-style:none; border-right-style:solid; border-bottom-style:solid; border-left-style:solid;">
        <textarea name="mo_content" cols="50" rows="11" id="mo_content" style="width:100%;border-width:1;border-color:rgb(204,204,204);border-style:solid;"></textarea> </td>
  </tr>
  <tr> 
      <td align="center">
		<input type=image src='<?=$skin_site_url?>memo_send.gif' name="Submit" value="전송"></td>
  </tr>
</form>
</table>