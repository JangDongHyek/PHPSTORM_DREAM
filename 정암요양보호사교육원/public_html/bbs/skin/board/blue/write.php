<?
/******************************************************************
 ★ 파일설명 ★ 
목록하단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디

<?=$u_action?>				글쓰기 URL
<?=$old_password?>		수정시 기존 암호
<?=$a_list?>					글목록 링크

<?=$show_notice_begin?>공지사항체크<?=$show_notice_end?>
<?=$checked_notice?>	공지사항체크여부

<?=$show_secret_begin?>비밀글체크<?=$show_secret_end?>
<?=$checked_secret?>	비밀글체크여부

<?=$show_reply_mail_begin?>응답글메일로받기여부<?=$show_reply_mail_end?>
<?=$checked_reply_mail?>	응답글체크여부

<?=$show_name_begin?>이름입력<?=$show_name_end?>
<?=$rg_name?>					이름

<?=$show_password_begin?>암호입력<?=$show_password_end?>
<?=(!$mode_edit)?'required':''?>	글수정모드가 아니라면 필수입력

<?=$show_email_begin?>메일입력<?=$show_email_end?>
<?=$rg_email?>				메일

<?=$show_home_url_begin?>홈페이지입력<?=$show_home_url_end?>
<?=$rg_home_url?>			홈체이지

<?=$show_category_begin?>카테고리선택<?=$show_category_end?>
<?=$category_list_option?>	카테고리목록

<?=$show_html_begin?>	html 형태선택<?=$show_html_end?>
<?=$checked_html_use0?>	일반글체크
<?=$checked_html_use1?>	html체크
<?=$checked_html_use2?>	html+<br>체크

<?=$rg_title?>				제목
<?=$rg_content?>			내용
<?=$show_link_begin?>	링크입력폼<?=$show_link_end?>
<?=$rg_link1_url?>		링크#1
<?=$rg_link2_url?>		링크#2

<?=$show_upload_begin?>업로드폼<?=$show_upload_end?>

<?=$show_file1_delete_begin?>파일삭제<?=$show_file1_delete_end?>
<?=$rg_file1_name?>		파일명
(1~2)

<?=$show_file1_size_begin?>최대업로드용량<?=$show_file1_size_end?>
<?=$upload_file1_size?>	최대업로드용량

<?=$show_file1_ext_begin?>업로드확장자<?=$show_file1_ext_end?>
<?=$upload_file1_ext?>	업로드확장자
<?=($upload_file1_able)?'가능':'불가능'?>	업로드 가능여부

<?=$show_ext1_begin?>추가항목1<?=$show_ext1_end?>
<?=$show_ext1_title?>	추가항목명
<?=$show_ext1_input?>	추가항목입력폼
(1~5)

******************************************************************/
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
	
	function check(){
		
		if(document.form_write.rg_name.value == ""){
			alert("이름을 적어주세요");
			document.form_write.rg_name.focus();
			return false;
		}else if(document.form_write.rg_phone.value == ""){
			alert("핸드폰은 필수입력사항입니다.");
			document.form_write.rg_phone.focus();
			return false;
		}

		var denyArr=Array(",","-","/","=","~","|","?","!");
		for(var i=0;i<=denyArr.length;i++){
		//금지 단어 방지 스크립트
			var msg=denyText(denyArr[i]);
			if(msg){
				alert(msg);
				return false;
				break;
			}
		}
		
		return true;
	}


	function denyText(gubun){
		var obj_Deny=document.getElementById("bbs_deny_word").value;

		var obj_conetents="";
		var obj_Content_arr=document.getElementById("rg_content").value.split(gubun);
		var obj_DenyArr=obj_Deny.split(",");

		for(var k=0;k<obj_Content_arr.length;k++){
			obj_conetents+=obj_Content_arr[k];
		}

		var obj_Content=obj_conetents;
		if(obj_Deny){
			for(var i=0;i<obj_DenyArr.length;i++){
				var chk2=obj_Content.match(obj_DenyArr[i].toString());
				if(chk2==obj_DenyArr[i]){
					return "내용에 "+chk2+"는(은) 사용할 수 없는 단어입니다.";
					break;
				}
			}
		}
		return "";
	}
	
	/*
	function popup_zip(frm_name, dir, frm_zip1, frm_zip2, frm_addr1, frm_addr2)
	{
			url = dir+'<?=$skin_board_url?>confirm_zip.php?frm_name='+frm_name+'&frm_zip1='+frm_zip1+'&frm_zip2='+frm_zip2+'&frm_addr1='+frm_addr1+'&frm_addr2='+frm_addr2;
			opt = 'scrollbars=yes,width=500,height=300';
			window.open(url, "mbzip", opt);
	}
	*/
/*
function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}
*/
//-->
</SCRIPT>




<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onsubmit="return check()">
<input type=hidden name=act value='ok'>
<input type="hidden" name="bbs_deny_word" id="bbs_deny_word" value="<?=$bbs[bbs_deny_word]?>">
<TR>
	<TD bgcolor=#999999 height=2></TD>
</TR>
<TR> 
	<TD>

	
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="35">

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
					<strong><font color="#006699"><img src="" width="3" height="10" alt="" style="background-color: #006699" />&nbsp;
					아래의 수강신청서를 작성후 완료버튼을 클릭하시면 수강신청이 접수됩니다.</font></strong>
					</td>
					<!--
					<td align="right">
					<a href="javascript:;" onclick="MM_openBrWindow('<?=$skin_board_url?>form_print.html','','scrollbars=yes,width=645,height=650')"><img src="<?=$skin_board_url?>images/btn_print.gif" width="94" height="21" border="0" /></a>
					</td>
					-->
				</tr>
				</table>

				</td>
			</tr>

			<tr>
				<td height="124">

				<table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="#D3CEC0">
					<tr>
						<td bgcolor="#FFFFFF">
				
						<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#B5B4A6">
						<tr>
							<td width="54"  rowspan="9" align="center" bgcolor="#E2DFDA" ><p> <strong><font color="#837867">신청인</font></strong> </p>
							</td>
							<td width="115" align="center" bgcolor="#F2F1EE"  ><p> 성명 </p>
							</td>
							<td width="131" bgcolor="#FFFFFF">
							<input name='rg_name' type=text id="rg_name" maxlength=15 required itemname='성명' style=height:22; size="15" class=b_input value="<?=$rg_name?>">
							</td>
							<!--------------------주민등록번호 수정해야함!------------------------>
							<td align="center" bgcolor="#F2F1EE"  >생년월일
							</td>
							<td bgcolor="#FFFFFF"><input name="rg_jumin1" type="text" style=height:22; id="rg_jumin1" maxlength="8" size="8" class=b_input />
							 <!--
							  -
							  <input name="rg_jumin2" type="text" style=height:22; id="rg_jumin2" size="8" maxlength="7" class=b_input />
							 -->
							</td>
							<!-------------------------------------------------------------------->
					    </tr>
						<!--
					    <tr>
				
							<td rowspan="2" align="center" bgcolor="#F2F1EE"  ><p> 주소 </p>
							</td>
							<td colspan="3" bgcolor="#FFFFFF"  ><input type="text" name='rg_post' style=height:22; size="8" maxlength="7" readonly="readonly" class=b_input />
								<img src="<?=$skin_board_url?>images/btn_zip.gif" width="57" height="18" align="absmiddle" onclick="popup_zip('form_write', './', 'rg_post', '', 'rg_address1', 'rg_address2');" style="cursor:hand;" />
							</td>
					    </tr>
						-->
					    <tr>
							<td align="center" bgcolor="#F2F1EE"  ><p> 주소 </p>
							<td colspan="3" bgcolor="#FFFFFF"  ><!--<input name='rg_address1' type="text" id="rg_address1" style='width:40%' value='<?=$rg_address1?>' readonly="readonly" class=b_input />
							<br>-->
							<input name='rg_address2' type="text" id="rg_address2" value='<?=$rg_address2?>' size="35" class=b_input />
							</td>
					
					    </tr>
					  <tr>
						<td align="center" bgcolor="#F2F1EE"><p> 전화번호 </p>
						</td>
						<td bgcolor="#FFFFFF">
						<input name="rg_tel" type=text id="rg_tel" maxlength="30" style=height:22; size="20" class=b_input />
						</td>
						<td width="96" align="center" bgcolor="#F2F1EE"  >휴대폰
						</td>
						<td width="146" bgcolor="#FFFFFF">
						<input name="rg_phone" type=text id="rg_phone" required itemname='휴대폰' maxlength="30" style=height:22; size="20" class=b_input />
						</td>
					  </tr>
					  <!--
					  <tr>
						<td align="center" bgcolor="#F2F1EE"><p> 이메일 </p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<input name="rg_email" type=text id="rg_email" maxlength="50" style=height:22; size="40" class=b_input />
						</td>
					  </tr>
					  -->
					 <!--  <tr>
					  						<td height="44" align="center" bgcolor="#F2F1EE"><p> 수업형태 </p>
					  						</td>
					  						<td colspan="3" bgcolor="#FFFFFF">
					  						<font color="#666666">
					  						<input name="rg_level1" type="radio" value="대면" />대면
					  						<input name="rg_level1" type="radio" value="비대면" />비대면
					  						</font>
					  						</td>
					  </tr> -->
					  <tr>
						<td height="70" align="center" bgcolor="#F2F1EE">본인이 소지한<br/>자격증</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <input type="checkbox" name="rg_jakyuk1" value="사회복지사" />&nbsp;사회복지사
						  <input type="checkbox" name="rg_jakyuk2" value="간호사" />&nbsp;간호사
						  <input type="checkbox" name="rg_jakyuk3" value="간호조무사" />&nbsp;간호조무사<br>
						  <input type="checkbox" name="rg_jakyuk4" value="물리치료사" />&nbsp;물리치료사
						  <input type="checkbox" name="rg_jakyuk5" value="작업치료사" />&nbsp;작업치료사 
						</font>
						</td>
					  </tr>
					  <tr>
						<td height="44" align="center" bgcolor="#F2F1EE"><p>최종학력</p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <input type="radio" name="rg_school" value="고졸이하" />&nbsp;고졸이하
						  <input type="radio" name="rg_school" value="고졸" />&nbsp;고졸
						  <input type="radio" name="rg_school" value="전문대졸" />&nbsp;전문대졸
						  <input type="radio" name="rg_school" value="대학교졸" />&nbsp;대학교졸
						  <input type="radio" name="rg_school" value="대학원이상" />&nbsp;대학원이상 
						</font>
						</td>
					  </tr>
					  <tr>
						<td height="44" align="center" bgcolor="#F2F1EE"><p>내일배움카드(국비)</p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <input type="radio" name="rg_tommorow" value="사용">사용
						  <input type="radio" name="rg_tommorow" value="사용안함">사용안함
						</font>
						</td>
					  </tr>
					</table>
					<table width="100%" height="5" border="0" cellpadding="0" cellspacing="0">
							<tr>
							  <td></td>
							</tr>
						  </table>
					  <TABLE width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#B5B4A6">
							<TR>
			
							  <TD width="260" height="37" rowspan="2" align="center" bgcolor="#E2DFDA" align="center"><font color="#837867"><strong>금회 신청 교육</strong></font>
							  </TD>
							  <TD width="162" rowspan="2" bgcolor="#FFFFFF">
							  &nbsp;&nbsp;
							  <select name="rg_year">
								<?
								$year = date("Y");
								for($i=$year;$i <= $year+1;$i++){
								?>
									<option value="<?=$i?>"><?=$i?></option>
								<?
								}
								?>
							  </select>
							  년<br />
								<br>
								&nbsp;&nbsp;
								<select name="rg_month">
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>                    월<br>
								&nbsp;&nbsp;
								<select name="rg_day">
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
								</select>                    일 
								
							  개설 </TD>
			
							  <TD width="196" align="center" bgcolor="#F2F1EE">교육시간<br>
							  </TD>
							  <td align="center" bgcolor="#F2F1EE">본인소지 자격증</td>
							  
							  <TD width="115" rowspan="2" align="center" bgcolor="#FFFFFF">
							  <input name='rg_title' type=text style=height:22; size="3" maxlength="3" class=b_input id="rg_title" value="<?=$rg_title?>">&nbsp;기
							  </TD>
							</TR>
							<TR>
							  <TD bgcolor="#FFFFFF">
							  <font color="#666666">
								<input type="radio" name="rg_edu_ju" value="주간(종일)" />&nbsp;주간(종일)<br>
								<!--<input type="radio" name="rg_edu_ju" value="주간(오전)" />&nbsp;주간(오전)<br>
								<input type="radio" name="rg_edu_ju" value="주간(오후)" />&nbsp;주간(오후)<br>-->
								<input type="radio" name="rg_edu_ju" value="야간" />&nbsp;야간<br>
								<input type="radio" name="rg_edu_ju" value="토/일" />&nbsp;토/일 
							  </font>
							  </TD>
							  <TD width="200"  bgcolor="#FFFFFF">
							  <font color="#666666">
								<input type="radio" name="rg_edu_time" value="신규" />&nbsp;신규<br>
<!--								<input type="radio" name="rg_edu_time" value="경력자" />&nbsp;경력자<br>-->
								<input type="radio" name="rg_edu_time" value="사회복지사" />&nbsp;사회복지사<br>
								<input type="radio" name="rg_edu_time" value="간호조무사" />&nbsp;간호조무사<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;물리치료사<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;작업치료사<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;간호사<br/>
							  </font>
							  </TD>
							</TR>
						</TABLE>
					  <table width="100%" height="5" border="0" cellpadding="0" cellspacing="0">
						<tr>
						  <td></td>
						</tr>
					  </table>
					  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#B5B4A6">
						<tr>
						  <td width="157" height="37" align="center" bgcolor="#E2DFDA"><font color="#837867"><strong>남기고싶은말</strong></font>
						  </td>
						  <td align="center" bgcolor="#FFFFFF">
						  <textarea name="rg_content" id="rg_content"  rows="10"  cols="65" class="b_textarea"><?=$rg_content?></textarea>
						  </td>
						</tr>
					  </table></td>
				  </tr>
				</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="38"><strong><font color="#996600">■ 온라인 수강신청 유의사항</font></strong></td>
                </tr>
                <tr>
                  <td height="40"><table width="100%" border="0" cellpadding="6" cellspacing="4" bgcolor="#D3CEC0">
                      <tr>
                        <td bgcolor="#FFFFFF"><!-- Document Start -->
                        <strong> 1. 자격증소지자반만 온라인 신청가능 </strong><br>
                            &nbsp;&nbsp; - 해당자격 : 사회복지사/간호조무사/물리치료사/작업치료사 <br>
                             &nbsp;&nbsp; <span style="color:red">- 간호사 : 간호조무사소지반 합반, 50시간 이수,국비지원 불가</span> <br /><br>
                             
					    <strong> 2. 신청서 확인되면 학원에서 문자 및 전화드림</strong><br>
                             &nbsp;&nbsp; - (접수 후 일주일이 지나도 연락이 없으면 학원측으로 문의바람)<br /><br>

							 
					    <strong> 3. 내일배움카드 ‘사용’으로 체크하신 분</strong><br>
                             &nbsp;&nbsp; - 내일배움카드 미발급자 : www.hrd.go.kr 통해서 카드 신청 가능 <br />
                             &nbsp;&nbsp; - 내일배움카드 발급자 : 학원에서 수업과정 hrd 사이트 내 등록 후 개별 연락 <br />
<br />
* 내일배움카드 대상자 기준 및 발급 관련 문의는 관할 고용센터로 연락 바랍니다.
							 
							 
                   
                  </td>
                      </tr>
                    </table>
                      <BR>
                  </td>
                </tr>
              </table>
				  <table width="100%" height="5" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td></td>
					  </tr>
					</table>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="center">
						<? 
							session_start();
							if($_SESSION['ss_mb_level'] == 10){
						?>
						<?=$a_list?><IMG src="<?=$skin_board_url?>images/list_view.gif" border=0></a>&nbsp;
						<?
							}
						?>
						<INPUT type=image src="<?=$skin_board_url?>images/btn_ok.gif" width="95" height="44">&nbsp;
						<img src="<?=$skin_board_url?>images/btn_ce.gif" width="95" height="44" onclick="javascript:reset();" style="cursor:hand;">
						</td>
					  </tr>
					</table>
				  <p><br>
						<br>
				  </p></td>
			  </tr>
			</table>

	</TD>
</TR>
</form>
</TABLE>
<br>
<br>