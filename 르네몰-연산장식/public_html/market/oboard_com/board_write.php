<?
/*
if($HTTP_COOKIE_VARS[BEAUTYE_GRADE] != 3){
	err_msg("�α����� �̿��� �ּ���.");
}
*/

if(!$set){
	$set = "write";
}


$result = mysql_query("select * from $board where id='$uid'");
db_error($result,"���������ǹ� ����!");
$ans = mysql_fetch_array($result);

$value3 = explode("-",$ans[value3]);
$value4 = explode("-",$ans[value4]);
$value5 = explode("-",$ans[value5]);
$value6 = explode("-",$ans[value6]);
$value7 = explode("-",$ans[value7]);
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
var NUM = "0123456789"; 
var SALPHA = "abcdefghijklmnopqrstuvwxyz";
var ALPHA = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"+SALPHA;
function TypeCheck (s, spc) {
	var i;
	for(i=0; i< s.length; i++) {
		if (spc.indexOf(s.substring(i, i+1)) < 0) {
			return false;
		}
	}        
	return true;
}
function IDcheck()
{
		var f=document.writeform;
		if (f.value11.value == "") {
		alert("ID�� �Է��� �ּ���. ");
		f.value11.focus();
		return false;
		}
		if (!TypeCheck(f.value11.value, ALPHA+NUM)) {
		alert("ID�� ������ �� ���ڷθ� ����� �� �ֽ��ϴ�. ");
		f.value11.focus();
		return false;
		}

		if ((f.value11.value.length < 4) || (f.value11.value.length > 12)) {
		alert("ID�� 4�� �̻�, 12�� �̳��̾�� �մϴ�.");
		f.value11.focus();
		return false;
		}

		winobject = window.open("","","scrollbars=no,resizable=yes,width=230,height=100,top=200,left=300");
		winobject.document.location = "../oboard_com/id_exist.php?value11=" + f.value11.value;
		winobject.focus();
		return false;
}

function code_pass(){
	var form=document.writeform;

	if(form.value11.value == ""){
		alert('���̵� �Է��ϼ���');
		form.value11.focus();
		return false;
	}
	<?
if($set == "write"){
?>

	if(!form.user_id_check.value){
		alert("���̵� �ߺ�üũ�� ���ּ���.");
		form.value11.focus();
		return false;
	}
	<?
	}
	?>
if (!TypeCheck(form.value11.value, ALPHA+NUM)) {
	alert("ID�� ������ �� ���ڷθ� ����� �� �ֽ��ϴ�. ");
	form.value11.focus();
	return false;
}

if ((form.value11.value.length < 4) || (form.value11.value.length > 12)) {
	alert("ID�� 4�� �̻�, 12�� �̳��̾�� �մϴ�.");
	form.value11.focus();
	return false;
}


	if(form.value12.value == ""){
		alert('��й�ȣ�� �Է��ϼ���');
		form.value12.focus();
		return false;
	}

	if ((form.value12.value.length < 4) || (form.value12.value.length > 12)) {
		alert("��й�ȣ�� 4�� �̻�, 12�� �̳��̾�� �մϴ�.");
		form.value12.focus();
	return false;
	}


	if(form.value122.value == ""){
		alert('��й�ȣ ��Ȯ���� �Է��ϼ���');
		form.value122.focus();
		return false;
	}
	if(form.value12.value  != form.value122.value){
		alert('�ΰ��� ��й�ȣ�� ��ġ���� �ʽ��ϴ�');
		form.value122.focus();
		return false;
	}
	if(form.value1.value == ""){
		alert('��ü���� �Է��ϼ���');
		form.value1.focus();
		return false;
	}
	if(form.value2.value == ""){
		alert('��ǥ�ڸ��� �Է��ϼ���');
		form.value2.focus();
		return false;
	}
if(form.value41.value == ""){
		alert('����� ��Ϲ�ȣ�� �Է��ϼ���');
		form.value41.focus();
		return false;
	}
	if(form.value42.value == ""){
		alert('����� ��Ϲ�ȣ�� �Է��ϼ���');
		form.value42.focus();
		return false;
	}
if(form.value43.value == ""){
		alert('����� ��Ϲ�ȣ�� �Է��ϼ���');
		form.value43.focus();
		return false;
	}
	if(form.value61.value == ""){
		alert('��ȭ��ȣ�� �Է��ϼ���');
		form.value61.focus();
		return false;
	}
	if(form.value62.value == ""){
		alert('��ȭ��ȣ�� �Է��ϼ���');
		form.value62.focus();
		return false;
	}
	if(form.value63.value == ""){
		alert('��ȭ��ȣ�� �Է��ϼ���');
		form.value63.focus();
		return false;
	}
	if(form.value10.value == ""){
		alert('���ǰ���� �Է��ϼ���');
		form.value10.focus();
		return false;
	}
return true;
}

//-->
</SCRIPT>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#DDDDDD">
<form name="writeform" method="post" action="../oboard_com/board_write_process.php?code_url=<?=$code_url?>&board=<?=$board?>&uid=<?echo $uid?>&thread=<?echo $thread?>&thread2=<?echo $thread2?>&check_array=<?echo $check_array?>&search_word=<?echo $search_word?>&page=<?echo $page?>&depth=<?echo $depth?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&board_type=<?=$board_type?>" ENCTYPE='multipart/form-data' onsubmit="return code_pass()">
<input type="hidden" name="mode" value="<?echo $set?>">
<input type="hidden" name="opti_value" value="<?echo $ans[member_id]?>">
<?
if($set == "write"){
?>
 <input type="hidden" name="user_id_check" value="">
<?
}
?>
                 <tr>
                    <td height="25" colspan="2" bgcolor="#FFFFFF" class="txt_B"><div align="center"><img src="../images/oboard_com_title.gif" width="673" height="88"></div></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><b>���̵�</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value11" type="text" value="<?=$ans[value11]?>" class="input_03" id="name"> &nbsp;<input type="button" onClick="javascript:IDcheck()" value="�ߺ�üũ"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><b>��й�ȣ</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value12" type="password" value="<?=$ans[value12]?>" class="input_03" id="name"> ��Ȯ��<input name="value122" type="password" value="<?=$ans[value12]?>" class="input_03" id="name"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><b>��ü��</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value1" type="text" value="<?=$ans[value1]?>" class="input_03" id="name"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><b>��ǥ�ڸ�</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value2" type="text" value="<?=$ans[value2]?>" size="8" class="input_03" id="name"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>����ڵ�Ϲ�ȣ</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value41" type="text" value="<?=$value4[0]?>" class="input_03" id="name" size="4">-<input name="value42" type="text" value="<?=$value4[1]?>" class="input_03" id="name" size="3">-<input name="value43" type="text" value="<?=$value4[2]?>" class="input_03" id="name" size="7"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>���ι�ȣ</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value51" type="text" value="<?=$value5[0]?>" class="input_03" id="name" size="7">-<input name="value52" type="text" value="<?=$value5[1]?>" class="input_03" id="name" size="7"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>��ȭ��ȣ</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value61" type="text" value="<?=$value6[0]?>" class="input_03" id="name" size="3">-<input name="value62" type="text" value="<?=$value6[1]?>" class="input_03" id="name" size="4">-<input name="value63" type="text" value="<?=$value6[2]?>" class="input_03" id="name" size="4">
											</td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>�ѽ���ȣ</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value71" type="text" value="<?=$value7[0]?>" class="input_03" id="name" size="3">-<input name="value72" type="text" value="<?=$value7[1]?>" class="input_03" id="name" size="4">-<input name="value73" type="text" value="<?=$value7[2]?>" class="input_03" id="name" size="4"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>Ȩ�������ּ�</b></div></td>
                    <td bgcolor="#FFFFFF">http://<input name="value8" type="text" value="<?=$ans[value8]?>" class="input_03" id="name" size="30"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>�̸����ּ�</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value9" type="text" value="<?=$ans[value9]?>" class="input_03" id="name22" size="30">     </td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>���ǰ��</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value10" type="text" value="<?=$ans[value10]?>" class="input_03" id="name22" size="30">     </td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>����</b></div></td>
                    <td bgcolor="#FFFFFF">
<?										
if($set == "modify"){		
	if($ans[value13] == "����"){
		$domae = "checked";	
	}else if($ans[value13] == "�Ҹ�"){
		$somae = "checked";
	}
?>
										<input name="value13" type="radio" value="����" id="name22" <?=$domae?>>���� <input name="value13" type="radio" value="�Ҹ�" id="name22" <?=$somae?>>�Ҹ�    

<?
}else{
?>
										<input name="value13" type="radio" value="����" id="name22" checked>���� <input name="value13" type="radio" value="�Ҹ�" id="name22">�Ҹ�    
<?
}
?>										
										
										
										</td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>(��ǰ����)<BR>��й�ȣ</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="view_pw" type="password" value="<?=$ans[view_pw]?>" class="input_03" id="name22" size="30">     </td>
                  </tr>
				  <? if($Mall_Admin_ID&&$MemberLevel==1){?>
				  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>�켱����<br>(�Ŀ���ũ����)</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="orderby" type="text" value="<?=$ans[orderby]?>" class="input_03" id="name22" size="30">     </td>
                  </tr>
				  <? }?>
                  <tr>
                    <td height="40" colspan="2" bgcolor="#FFFFFF"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../oboard_com/images/confirm_btn2.gif">
                    &nbsp;<a href="<?=$code_url?>?set=list&board=<?=$board?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>"> 
                        <img src="../oboard_com/images/list_btn2.gif" /></a>
                      &nbsp;&nbsp;&nbsp;</div>                    
    </tr>

  </form>
</table>

