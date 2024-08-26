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

$ans[body]=stripslashes($ans[body]);


?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function code_pass(){
	var form=document.writeform;
	
	if(form.reserv_name.value == ""){
		alert('성함을 입력하세요');
		form.reserv_name.focus();
		return false;
	}
	if(form.reserv_email.value == ""){
		alert('이메일을 입력하세요');
		form.reserv_email.focus();
		return false;
	}
	if(form.reserv_bunryu.value == ""){
		alert('제품분류를 선택하세요');
		form.reserv_bunryu.focus();
		return false;
	}
	if(form.reserv_kyukuk.value == ""){
		alert('제품규격을 입력하세요');
		form.reserv_kyukuk.focus();
		return false;
	}
	if(form.reserv_jaejil.value == ""){
		alert('재질을 선택하세요');
		form.reserv_jaejil.focus();
		return false;
	}
	if(form.reserv_insoi.value == ""){
		alert('인쇄를 선택하세요');
		form.reserv_insoi.focus();
		return false;
	}
		if(form.reserv_insoi.value == ""){
		alert('인쇄를 선택하세요');
		form.reserv_insoi.focus();
		return false;
	}
	if(form.reserv_coting.value == ""){
		alert('코팅을 선택하세요');
		form.reserv_coting.focus();
		return false;
	}
	if(form.reserv_gibonnum.value == ""){
		alert('기본수량을 입력하세요');
		form.reserv_gibonnum.focus();
		return false;
	}
	if(form.reserv_phone1.value == ""){
		alert('연락처를 입력하세요');
		form.reserv_phone1.focus();
		return false;
	}
	if(form.reserv_phone2.value == ""){
		alert('연락처를 입력하세요');
		form.reserv_phone2.focus();
		return false;
	}
	if(form.reserv_phone3.value == ""){
		alert('연락처를 입력하세요');
		form.reserv_phone3.focus();
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
<form name="writeform" method="post" action="../oboard/board_write_process.php?code_url=<?=$code_url?>&board=<?=$board?>&uid=<?echo $uid?>&thread=<?echo $thread?>&thread2=<?echo $thread2?>&check_array=<?echo $check_array?>&search_word=<?echo $search_word?>&page=<?echo $page?>&depth=<?echo $depth?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>&board_type=<?=$board_type?>" ENCTYPE='multipart/form-data' onsubmit="return code_pass()">
<input type="hidden" name="mode" value="<?echo $set?>">
<input type="hidden" name="opti_value" value="<?echo $ans[member_id]?>">
                  <tr>
                    <td height="25" colspan="2" bgcolor="#FFFFFF" class="txt_B"><div align="center"><img src="../images/oboard_title.gif" width="673" height="88" /></div></td>
                  </tr>
                  <tr>
                    <td width="150" height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><img src="../images/oboard_title1.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF"><input name="reserv_name" type="text" class="input_03" id="name"></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF" class="txt_B"><div align="right"><img src="../images/oboard_title2.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF"><input name="reserv_email" type="text" size="40" class="input_03" id="name"></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><div align="right"><img src="../images/oboard_title3.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF">
										<select name="reserv_bunryu" class="input_03" id="name">
                          <option selected value="">선택해주세요</option>
                          <option value="쇼핑백">쇼핑백</option>
                          <option value="자동쇼핑백(백화점용)">자동쇼핑백(백화점용)</option>
                          <option value="비닐쇼핑백">비닐쇼핑백</option>
                          <option value="칼라박스(함지)">칼라박스(함지)</option>
                          <option value="기타">기타</option>
										</select>					</td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><div align="right"><img src="../images/oboard_title4.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF"><input name="reserv_kyukuk" type="text" class="input_03" id="name"> 예)가로(장)*세로(폭)*높이(고)(mm)</td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><div align="right"><img src="../images/oboard_title5.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF">
												<select name="reserv_jaejil" class="input_03" id="name">
                          <option selected value="">선택해주세요</option>
                          <option value="아트지120g">아트지120g</option>
                          <option value="아트지140g">아트지140g</option>
                          <option value="아트지150g">아트지150g</option>
                          <option value="아트지160g">아트지160g</option>
                          <option value="아트지180g">아트지180g</option>
                          <option value="아트지200g">아트지200g</option>
                          <option value="아트지250g">아트지250g</option>
                          <option value="아트지300g">아트지300g</option>
                          <option value="크라프트지(K.P)98g">크라프트지(K.P)98g</option>
                          <option value="크라프트지(K.P)120g">크라프트지(K.P)120g</option>
                          <option value="크라프트지(K.P)160g">크라프트지(K.P)160g</option>
                          <option value="크라프트지(K.P)180g">크라프트지(K.P)180g</option>
                          <option value="특모조지120g">특모조지120g</option>
                          <option value="특모조지140g">특모조지140g</option>
                          <option value="특모조지160g">특모조지160g</option>
                        </select>					</td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><div align="right"><img src="../images/oboard_title6.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF">
											<select name="reserv_insoi" class="input_03" id="name">
                          <option selected value="">선택해주세요</option>
                          <option value="1도">1도</option>
                          <option value="2도">2도</option>
                          <option value="3도">3도</option>
                          <option value="4도">4도</option>
                          <option value="기타">기타</option>
                        </select>					</td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><div align="right"><img src="../images/oboard_title7.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF">
											<select name="reserv_coting" class="input_03" id="name">
                          <option selected value="">선택해주세요</option>
                          <option value="유광">유광</option>
                          <option value="무광">무광</option>
                          <option value="기타">기타</option>
                        </select>					</td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><div align="right"><img src="../images/oboard_title8.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF"><input name="reserv_gibonnum" type="text" class="input_03" id="name" size="5">pcs &nbsp;&nbsp;예)1000pcs,3000pcs,5000pcs.10000pcs이상</td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><div align="right"><img src="../images/oboard_title9.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF"><input name="reserv_phone1" type="text" class="input_03" id="name22" size="10">
                      -
                        <input name="reserv_phone2" type="text" class="input_03" id="name23" size="10">
                        -
                    <input name="reserv_phone3" type="text" class="input_03" id="name24" size="10"></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><div align="right"><img src="../images/oboard_title10.gif" width="68" height="21" /></div></td>
                    <td bgcolor="#FFFFFF"><textarea name="body" cols="40" rows="7" class="input_03" id="name" style="width:480px;height:100px"></textarea></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="2" bgcolor="#FFFFFF"><div align="center"><input type="image" src="../images/confirm_btn.gif"> &nbsp;&nbsp;</div>                    </tr>
                  <tr>
											<td height="30" colspan="2" bgcolor="#FFFFFF"><div align="center"><a href="#" onclick="MM_callJS('window.close()')"><img src="../images/close_btn.gif" width="50" height="20"></a>
									 </div>									 </tr>
										<tr>
											<td colspan="2" align="center" bgcolor="#FFFFFF">
										<?
										 if($Mall_Admin_ID&&$MemberLevel==1){ 
										?>
										<a href="./reservation.html?set=list"><img src="../images/list_view_btn.gif" /></a></td>
										<?
										}	
										?>
										</tr>
  </form>
</table>

