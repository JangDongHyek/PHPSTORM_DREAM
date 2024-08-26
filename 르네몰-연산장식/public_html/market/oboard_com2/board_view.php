<?
/*
if(!$HTTP_COOKIE_VARS[BEAUTYE_ID]){
	meta_read("../member2.php");
}
*/
$result = mysql_query("select * from $board where id='$uid'");
db_error($result,"데이터질의문 오류!");
$ans = mysql_fetch_array($result);

$count = $ans[count]+1;

mysql_query("update $board set count='$count' where id='$uid'");

$H_01= mysql_query("select count(*) from $board where code='$code_url' and thread=$ans[thread] and thread2 >'$ans[thread2]'");
db_error($H_01,"Data Query Error No.1");

$T_Exist= mysql_result($H_01,0,0);

$title = stripslashes($ans[title]);
$body = stripslashes($ans[body]);
$body = Create_br($body);

$sign_date = substr($ans[reg_date],0,10);
$data = explode(",",$check_array);


if($ans[user_file]) {
	$usr_tmp = split("/",$ans[user_file]);
	$user_file = "<a href='$ans[user_file]'><img src='img/bul3.gif' width='13' height='13' border='0'> ";
	$user_file .= $usr_tmp[1]."</a>";

	$file_type = substr(strrchr($usr_tmp[1],"."),1);

	if($file_type==jpg || $file_type==png || $file_type==gif || $file_type==jepg || $file_type==bmp) {
		$size = @GetImageSize($ans[user_file]);

		while($size[0]>400) { $size[0]/=2; $size[1]*=($size[0]/2/$size[0]); }

		$view_img_file .= "<img src='$ans[user_file]' width='$size[0]' height='$size[1]'>";
	}

}else{
	$user_file = "첨부파일이 없습니다.";
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function delete_it(url,uid,thread,thread2,depth,board){
	if(confirm('정말 삭제 하시겠습니까?')){
		location = "../board_sung/board_write_process.php?code_url="+url+"&mode=delete&uid="+uid+"&thread="+thread+"&thread2="+thread2+"&depth="+depth+"&board="+board;
	}
}
//-->
</SCRIPT>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<form name="free_view" method="post">
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="90%"><div align="center"><img src="../images/oboard_com2_title.gif" width="673" height="88" /></div></td>
            </tr>
  </table>
		  <table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DDDDDD">
		                  <tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>업체명</b></div></td>
                    <td width="506" bgcolor="#FFFFFF"><?=$ans[value1]?></td>
                  </tr>
                  <tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>대표자</b></div></td>
                    <td bgcolor="#FFFFFF"><?=$ans[value2]?></td>
                  </tr>
<?
if($Mall_Admin_ID&&$MemberLevel==1){
?>
										<tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>아이디</b></div></td>
                    <td bgcolor="#FFFFFF">
										<?=$ans[value11]?>					</td>
                  </tr>
									<tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>비밀번호</b></div></td>
                    <td bgcolor="#FFFFFF">
										<?=$ans[value12]?>					</td>
                  </tr>
								<tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>대표자주민번호</b></div></td>
                    <td bgcolor="#FFFFFF">
										<?=$ans[value3]?>					</td>
                  </tr>
                  <tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>사업자등록번호</b></div></td>
                    <td bgcolor="#FFFFFF"><?=$ans[value4]?></td>
                  </tr>
                  
<?
}
?>

                  <tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>전화번호</b></div></td>
                    <td bgcolor="#FFFFFF"><?=$ans[value6]?>					</td>
                  </tr>
                  <tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>팩스번호</b></div></td>
                    <td bgcolor="#FFFFFF"><?=$ans[value7]?>					</td>
                  </tr>
                  <tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>홈페이지주소</b></div></td>
                    <td bgcolor="#FFFFFF"><a href="http://<?=$ans[value8]?>" target="_blank"><?=$ans[value8]?></a></td>
                  </tr>
                  <tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>이메일주소</b></div></td>
                    <td bgcolor="#FFFFFF"><?=$ans[value9]?></td>
                  </tr>
                  <tr>
                    <td width="150" height="30" bgcolor="#FFFFFF"><div align="right"><b>취급품목</b></div></td>
                    <td bgcolor="#FFFFFF"><?=$ans[value10]?></td>
                  </tr>
                 
              <tr bgcolor="CFCFCF"> 
                <td height="1" colspan="4" align="center" bgcolor="#FFFFFF"></td>
              </tr>
              <tr> 
                <td height="2" colspan="4" bgcolor="#FFFFFF"></td>
              </tr>
               <tr> 
                <td height="2" colspan="4" bgcolor="#FFFFFF">&nbsp;&nbsp;</td>
              </tr>
  </table>
								<table width="99%" border="0" cellspacing="0" cellpadding="0">
								<tr>
								<td height="40" align="center">
                      <a href="<?=$code_url?>?set=list&board=<?=$board?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>"><img src="../oboard_com2/images/list_btn.gif" width="68" height="22"></a>
                      &nbsp;&nbsp;&nbsp;
                   <?
									 	if($Mall_Admin_ID&&$MemberLevel==1){
										?>
											<a href="<?=$code_url?>?set=modify&uid=<?=$ans[id]?>&board=<?=$board?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>"><img src="../oboard_com2/images/modify_btn.gif" width="64" height="22"></a>
                      &nbsp;&nbsp;&nbsp;
											<a href="../oboard_com2/board_write_process.php?code_url=<?=$code_url?>&mode=delete&board=<?=$board?>&uid=<?=$ans[id]?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>"><img src="../oboard_com2/images/delete_btn.gif" width="64" height="22"></a>
										<?
										}else if($_SESSION['ss_mb_id'] == $ans[value11]){
										?>		
											<a href="<?=$code_url?>?set=modify&uid=<?=$ans[id]?>&board=<?=$board?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>"><img src="../oboard_com2/images/modify_btn.gif" width="64" height="22"></a>
										<?
										}
										?>
										</td>
                  </tr>
  </table>
</form>

















