<?

if(($Mall_Admin_ID&&$MemberLevel==1) || $AUTH2){
meta_read("$code_url?set=list&board=$board&uid=$uid&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2");
}

if($mode == "auth"){
include "./function.inc";
include("./util.php");
include "../../connect.php";

		$sql = "select * from reservation_com3 where value11='$value11' and value12='$value12'";
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);


		
		if($rows == 0){
			echo("
        <script>
	    window.alert('일치하는 아이디 비밀번호가 없습니다')
	    history.back()
	    </script>
			");
			exit;
		}else{
			 $now2 = date("YmdHis");
			 session_register("AUTH2");
			 session_register("ss_mb_id");

			$HTTP_SESSION_VARS["AUTH2"] = $now2;
			$_SESSION['ss_mb_id']=$value11;
			meta_read("$code_url?set=list&board=$board&uid=$uid&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2");
		}
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function code_pass(){
	var form=document.writeform;
	if(form.value11.value == ""){
		alert('아이디를 입력하세요');
		form.value11.focus();
		return false;
	}
	if(form.value12.value == ""){
		alert('비밀번호를 입력하세요');
		form.value12.focus();
		return false;
	}
return true;
}
//-->
</SCRIPT>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<form name="writeform" method="post" action="../oboard_com3/auth.php?code_url=<?=$code_url?>&board=<?=$board?>&uid=<?echo $uid?>&thread=<?echo $thread?>&thread2=<?echo $thread2?>&check_array=<?echo $check_array?>&search_word=<?echo $search_word?>&page=<?echo $page?>&depth=<?echo $depth?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&board_type=<?=$board_type?>" ENCTYPE='multipart/form-data' onsubmit="return code_pass()">
<input type="hidden" name="mode" value="auth">
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="90%"><div align="center"><img src="../images/sa_title.gif" width="673" height="88" border="0" usemap="#Map" />
                  <map name="Map" id="Map">
                    <!--area shape="rect" coords="406,12,658,79" href="../site/usage.htm" /-->
                  </map>
              </div></td>
            </tr>
  </table>
	<table width="570" height="40" border="0" align="center" cellpadding="0" cellspacing="0">
		                  <tr>
                    <td width="10"><img src="../oboard_com3/images/left_bg.gif" width="10" height="40" /></td>
                    <td width="275" background="../oboard_com3/images/title_bg.gif"><div align="right"><b>아이디</b> <input name="value11" type="text" value="" class="input_03" id="name" size="10" maxlength="10" /></div></td>
                    <td width="275" background="../oboard_com3/images/title_bg.gif"><div align="left">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>비밀번호</b> <input name="value12" type="password" value="<?=$value4[1]?>" class="input_03" id="name" size="10" maxlength="10" />
                    </div></td>
                    <td width="10"><img src="../oboard_com3/images/right_bg.gif" width="10" height="40" /></td>
                  </tr>
  </table>
	<br>
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
					<td align="center">
					  <div align="center"><input type="image" src="../img/submit_btn.gif" width="78" height="22">&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=$code_url?>?board=<?=$board?>&set=write"> 
									    <img src="../oboard_com3/images/confirm_btn2.gif" width="78" height="22"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=$code_url?>?board=<?=$board?>&set=write"> 
									    <img src="../oboard_com3/images/confirm_btn3.gif"></a></div></td>
			</tr>
  </table>
</form>

















