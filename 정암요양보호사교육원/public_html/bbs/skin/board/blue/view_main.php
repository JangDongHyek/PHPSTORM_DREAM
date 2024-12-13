<SCRIPT LANGUAGE="JavaScript">
<!--
	
function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}

function openTarget(objForm, strFeatures, strWindowName){
	strWindowName = 'formTarget' + (new Date().getTime());
	objForm.target = strWindowName;
	open('', strWindowName, strFeatures);
}


//-->
</SCRIPT>
<?
	$rg_jumin_arr = explode('-',$rg_jumin);
	$rg_jumin = $rg_jumin_arr[0];
?>
<TABLE width="100%" border=0 align="left" cellPadding=0 cellSpacing=0>
<TR> 
	<TD align=right>
    <?=$show_prev_begin?><?=$a_prev?><img src="<?=$skin_board_url?>images/prev.gif" border=0></a><?=$show_prev_end?>
    <?=$show_next_begin?><?=$a_next?><img src="<?=$skin_board_url?>images/next.gif" border=0></a><?=$show_next_end?>
	</TD>
</TR>

<form name="form_view" method="post" action="<?=$skin_board_url?>form_print.html" onsubmit="openTarget(this, 'width=645,height=750,resizable=1,scrollbars=1'); return true;">
<input type="hidden" name="rg_name" value="<?=$rg_name?>">
<input type="hidden" name="rg_jumin" value="<?=$rg_jumin?>">
<input type="hidden" name="rg_post" value="<?=$rg_post?>">
<input type="hidden" name="rg_address" value="<?=$rg_address?>">
<input type="hidden" name="rg_tel" value="<?=$rg_tel?>">
<input type="hidden" name="rg_phone" value="<?=$rg_phone?>">
<input type="hidden" name="rg_level1" value="<?=$rg_level1?>">
<input type="hidden" name="rg_jakyuk1" value="<?=$rg_jakyuk1?>">
<input type="hidden" name="rg_jakyuk2" value="<?=$rg_jakyuk2?>">
<input type="hidden" name="rg_jakyuk3" value="<?=$rg_jakyuk3?>">
<input type="hidden" name="rg_jakyuk4" value="<?=$rg_jakyuk4?>">
<input type="hidden" name="rg_jakyuk5" value="<?=$rg_jakyuk5?>">
<input type="hidden" name="rg_school" value="<?=$rg_school?>">
<input type="hidden" name="rg_date" value="<?=$rg_date?>">
<input type="hidden" name="rg_edu_ju" value="<?=$rg_edu_ju?>">
<input type="hidden" name="rg_edu_time" value="<?=$rg_edu_time?>">
<input type="hidden" name="rg_title" value="<?=$rg_title?>">
<input type="hidden" name="rg_content" value="<?=$rg_content?>">
<input type="hidden" name="rg_email" value="<?=strip_tags($rg_email)?>">
<input type="hidden" name="rg_tommorow" value="<?=$rg_tommorow?>">
<TR>
	<TD>
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
					<strong><font color="#006699"><img src="" width="3" height="10" alt="" style="background-color: #006699" />&nbsp;
					아래의 수강신청서를 작성후 완료버튼을 클릭하시면 수강신청이 접수됩니다.</font></strong>
					</td>
					<td align="right">
					
					<input type="image" src="<?=$skin_board_url?>images/btn_print.gif" width="94" height="21" border="0">
					
					<!--
					<a href="javascript:;" onclick="MM_openBrWindow('<?=$skin_board_url?>form_print.html','','scrollbars=yes,width=645,height=650')"><img src="<?=$skin_board_url?>images/btn_print.gif" width="94" height="21" border="0" /></a>
					-->
					</td>
				</tr>
				</table>
				
	</TD>
</TR>
</form>


<TR>
	<TD bgColor=#FFFFFF>

					<table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="#D3CEC0">
					<tr>
						<td bgcolor="#FFFFFF">
				
						<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#B5B4A6">
						<tr>
							<td width="54"  rowspan="8" align="center" bgcolor="#E2DFDA" ><p> <strong><font color="#837867">신청인</font></strong> </p>
							</td>
							<td width="115" align="center" bgcolor="#F2F1EE"  ><p> 성명 </p>
							</td>
							<td width="131" bgcolor="#FFFFFF">
							<?=$rg_name?>
							</td>

							<td align="center" bgcolor="#F2F1EE"  >생년월일
							</td>
							<td bgcolor="#FFFFFF">
							<?=$rg_jumin?>
							</td>

					    </tr>
					    <tr>
							<td align="center" bgcolor="#F2F1EE"  ><p> 주소 </p>
							<td colspan="3" bgcolor="#FFFFFF"  ><?=$rg_address?>
							</td>
					    </tr>
					  <tr>
						<td align="center" bgcolor="#F2F1EE"><p> 전화번호 </p>
						</td>
						<td bgcolor="#FFFFFF">
						<?=$rg_tel?>
						</td>
						<td width="96" align="center" bgcolor="#F2F1EE"  >휴대폰
						</td>
						<td width="146" bgcolor="#FFFFFF">
						<?=$rg_phone?>
						</td>
					  </tr>
					  <!--
					  <tr>
						<td align="center" bgcolor="#F2F1EE"><p> 이메일 </p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<?=$rg_email?>
						</td>
					  </tr>
					  -->
					  <!-- <tr>
					  						<td height="44" align="center" bgcolor="#F2F1EE"><p> 수업형태 </p>
					  						</td>
					  						<td colspan="3" bgcolor="#FFFFFF">
					  						<font color="#666666">
					  						<?=$rg_level1?>
					  						</font>
					  						</td>
					  </tr> -->
					  <tr>
						<td height="70" align="center" bgcolor="#F2F1EE">자격/면허소지자
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <? if($rg_jakyuk1){echo $rg_jakyuk1."<br>";}?>
						  <? if($rg_jakyuk2){echo $rg_jakyuk2."<br>";}?>
						  <? if($rg_jakyuk3){echo $rg_jakyuk3."<br>";}?>
						  <? if($rg_jakyuk4){echo $rg_jakyuk4."<br>";}?>
						  <? if($rg_jakyuk5){echo $rg_jakyuk5."<br>";}?>
						</font>
						</td>
					  </tr>
					  <tr>
						<td height="44" align="center" bgcolor="#F2F1EE"><p>최종학력</p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <?=$rg_school?>
						</font>
						</td>
					  </tr>
					  <tr>
						<td height="44" align="center" bgcolor="#F2F1EE"><p>내일배움카드</p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <?=$rg_tommorow?>
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
							  <TD width="220" height="37" rowspan="2" align="center" bgcolor="#E2DFDA"><font color="#837867"><strong>금회 신청 교육</strong></font>
							  </TD>
							  <TD width="160" rowspan="2" bgcolor="#FFFFFF" align="center">
							  <?=$rg_date?>&nbsp;개설
							  </TD>
			
							  <TD width="150" align="center" bgcolor="#F2F1EE">교육시간<br> </TD>
							  <TD width="200" bgcolor="#FFFFFF" align="center">
							  <font color="#666666">
								<?=$rg_edu_ju?>
							  </font>
							  </TD>

								<TD width="140" bgcolor="#FFFFFF" valign="middle" align="center">
							  <font color="#666666">
								<?=$rg_edu_time?>
							  </font>
							  </TD>
							  <TD width="100" rowspan="2" align="center" bgcolor="#FFFFFF" >
							  <?=$rg_title?>&nbsp;기
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
						  <td width="160" height="37" align="center" bgcolor="#E2DFDA"><font color="#837867"><strong>남기고싶은말</strong></font>
						  </td>
						  <td align="left" bgcolor="#FFFFFF">
						  <?=$rg_content?>
						  </td>
						</tr>
					  </table></td>
				  </tr>
				</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="7">
					  <tr>
						<td><img src="<?=$skin_board_url?>images/s3_text.gif" width="597" height="121"></td>
					  </tr>
					</table>
				  <table width="100%" height="5" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td></td>
					  </tr>
	  </table>
	</td>
  </tr>
</table>

</TABLE>
	</TD>
</TR>
<TR>
	<TD height=5></TD>
</TR>
