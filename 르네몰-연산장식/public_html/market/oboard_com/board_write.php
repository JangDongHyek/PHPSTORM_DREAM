<?
/*
if($HTTP_COOKIE_VARS[BEAUTYE_GRADE] != 3){
	err_msg("로그인후 이용해 주세요.");
}
*/

if(!$set){
	$set = "write";
}


$result = mysql_query("select * from $board where id='$uid'");
db_error($result,"데이터질의문 오류!");
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
		alert("ID를 입력해 주세요. ");
		f.value11.focus();
		return false;
		}
		if (!TypeCheck(f.value11.value, ALPHA+NUM)) {
		alert("ID는 영문자 및 숫자로만 사용할 수 있습니다. ");
		f.value11.focus();
		return false;
		}

		if ((f.value11.value.length < 4) || (f.value11.value.length > 12)) {
		alert("ID는 4자 이상, 12자 이내이어야 합니다.");
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
		alert('아이디를 입력하세요');
		form.value11.focus();
		return false;
	}
	<?
if($set == "write"){
?>

	if(!form.user_id_check.value){
		alert("아이디 중복체크를 해주세요.");
		form.value11.focus();
		return false;
	}
	<?
	}
	?>
if (!TypeCheck(form.value11.value, ALPHA+NUM)) {
	alert("ID는 영문자 및 숫자로만 사용할 수 있습니다. ");
	form.value11.focus();
	return false;
}

if ((form.value11.value.length < 4) || (form.value11.value.length > 12)) {
	alert("ID는 4자 이상, 12자 이내이어야 합니다.");
	form.value11.focus();
	return false;
}


	if(form.value12.value == ""){
		alert('비밀번호를 입력하세요');
		form.value12.focus();
		return false;
	}

	if ((form.value12.value.length < 4) || (form.value12.value.length > 12)) {
		alert("비밀번호는 4자 이상, 12자 이내이어야 합니다.");
		form.value12.focus();
	return false;
	}


	if(form.value122.value == ""){
		alert('비밀번호 재확인을 입력하세요');
		form.value122.focus();
		return false;
	}
	if(form.value12.value  != form.value122.value){
		alert('두개의 비밀번호가 일치하지 않습니다');
		form.value122.focus();
		return false;
	}
	if(form.value1.value == ""){
		alert('업체명을 입력하세요');
		form.value1.focus();
		return false;
	}
	if(form.value2.value == ""){
		alert('대표자명을 입력하세요');
		form.value2.focus();
		return false;
	}
if(form.value41.value == ""){
		alert('사업자 등록번호를 입력하세요');
		form.value41.focus();
		return false;
	}
	if(form.value42.value == ""){
		alert('사업자 등록번호를 입력하세요');
		form.value42.focus();
		return false;
	}
if(form.value43.value == ""){
		alert('사업자 등록번호를 입력하세요');
		form.value43.focus();
		return false;
	}
	if(form.value61.value == ""){
		alert('전화번호를 입력하세요');
		form.value61.focus();
		return false;
	}
	if(form.value62.value == ""){
		alert('전화번호를 입력하세요');
		form.value62.focus();
		return false;
	}
	if(form.value63.value == ""){
		alert('전화번호를 입력하세요');
		form.value63.focus();
		return false;
	}
	if(form.value10.value == ""){
		alert('취급품목을 입력하세요');
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
                    <td width="100" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><b>아이디</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value11" type="text" value="<?=$ans[value11]?>" class="input_03" id="name"> &nbsp;<input type="button" onClick="javascript:IDcheck()" value="중복체크"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><b>비밀번호</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value12" type="password" value="<?=$ans[value12]?>" class="input_03" id="name"> 재확인<input name="value122" type="password" value="<?=$ans[value12]?>" class="input_03" id="name"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><b>업체명</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value1" type="text" value="<?=$ans[value1]?>" class="input_03" id="name"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><b>대표자명</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value2" type="text" value="<?=$ans[value2]?>" size="8" class="input_03" id="name"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>사업자등록번호</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value41" type="text" value="<?=$value4[0]?>" class="input_03" id="name" size="4">-<input name="value42" type="text" value="<?=$value4[1]?>" class="input_03" id="name" size="3">-<input name="value43" type="text" value="<?=$value4[2]?>" class="input_03" id="name" size="7"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>법인번호</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value51" type="text" value="<?=$value5[0]?>" class="input_03" id="name" size="7">-<input name="value52" type="text" value="<?=$value5[1]?>" class="input_03" id="name" size="7"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>전화번호</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value61" type="text" value="<?=$value6[0]?>" class="input_03" id="name" size="3">-<input name="value62" type="text" value="<?=$value6[1]?>" class="input_03" id="name" size="4">-<input name="value63" type="text" value="<?=$value6[2]?>" class="input_03" id="name" size="4">
											</td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>팩스번호</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value71" type="text" value="<?=$value7[0]?>" class="input_03" id="name" size="3">-<input name="value72" type="text" value="<?=$value7[1]?>" class="input_03" id="name" size="4">-<input name="value73" type="text" value="<?=$value7[2]?>" class="input_03" id="name" size="4"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>홈페이지주소</b></div></td>
                    <td bgcolor="#FFFFFF">http://<input name="value8" type="text" value="<?=$ans[value8]?>" class="input_03" id="name" size="30"></td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>이메일주소</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value9" type="text" value="<?=$ans[value9]?>" class="input_03" id="name22" size="30">     </td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>취급품목</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="value10" type="text" value="<?=$ans[value10]?>" class="input_03" id="name22" size="30">     </td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>구분</b></div></td>
                    <td bgcolor="#FFFFFF">
<?										
if($set == "modify"){		
	if($ans[value13] == "도매"){
		$domae = "checked";	
	}else if($ans[value13] == "소매"){
		$somae = "checked";
	}
?>
										<input name="value13" type="radio" value="도매" id="name22" <?=$domae?>>도매 <input name="value13" type="radio" value="소매" id="name22" <?=$somae?>>소매    

<?
}else{
?>
										<input name="value13" type="radio" value="도매" id="name22" checked>도매 <input name="value13" type="radio" value="소매" id="name22">소매    
<?
}
?>										
										
										
										</td>
                  </tr>
                  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>(제품보기)<BR>비밀번호</b></div></td>
                    <td bgcolor="#FFFFFF"><input name="view_pw" type="password" value="<?=$ans[view_pw]?>" class="input_03" id="name22" size="30">     </td>
                  </tr>
				  <? if($Mall_Admin_ID&&$MemberLevel==1){?>
				  <tr>
                    <td width="100" height="25" bgcolor="#FFFFFF"><div align="right"><b>우선순위<br>(파워링크순서)</b></div></td>
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

