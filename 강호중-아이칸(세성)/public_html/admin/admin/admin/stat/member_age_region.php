<?
include "../lib/Mall_Admin_Session.php";
	include "../admin_head.php";
?>

<script>
function goto_byselect(sel, targetstr)
{
  var index = sel.selectedIndex;
  if (sel.options[index].value != '') {
     if (targetstr == 'blank') {
       window.open(sel.options[index].value, 'win1');
     } else {
       var frameobj;
       if ((frameobj = eval(targetstr)) != null)
         frameobj.location = sel.options[index].value;
     }
  }
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu7.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title7.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../good/board_frame8.html">HOME</a> &gt; </span> <span class="text_gray2_c">������</span> &gt; <span class="text_gray2_c">ȸ�����</span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;�����ڸ�忡 �����ϼ̽��ϴ�.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500">
			<!--���ʺκн���-->
<?
$left_menu = "9";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->	  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>ȸ�����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" height="35">������ ȸ������ ���Ǻ��� �˻��Ͻ� �� �ֽ��ϴ�. ���Ǻ� ��踦 �̿��Ͽ� �̵��ϼ���.</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
					
					<table border="0" width="320" cellspacing="0" cellpadding="0">
						<tr>
							<td width="20"></td>
							<td width="300">
								
								<table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
									<td width="100%" bgcolor="#CCCCCC">
										
										<table border="0" width="100%" cellspacing="1" cellpadding="3">
											<tr>
											<td width="100%" bgcolor="#F7F7F7" height="20">
												<table border="0" width="100%" cellspacing="0" cellpadding="0">
													<tr>
														<td width="33%" height="25">
															<p align="left">���� �˻�</td>
														<td width="67%" height="25">
															<p align="right">
                        						<select onChange="goto_byselect(this, 'self')" size="1" style="height: 18px; border: 1px solid black">
                        						<option value="member_region.php">������ ����</option>
                        						<option value="member_age.php">���ɴ뺰 ����</option>
                        						<option value="member_sex.php">������� ����</option>
                        						<option value="member_age_region.php" selected>����+������ ����</option>
															</select></td>
													</tr>
												</table>
											</td>
											</tr>
										</table>
									</td>
								</table>
							</td>
						</tr>
					</table>
					
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><center>
					
						<table border="0" width="450" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20"></td>
								<td width="430">
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%" bgcolor="#7BBEBD">
										
											<table border="0" width="100%" cellspacing="1" cellpadding="3">
												<tr>
												<td width="100%" bgcolor="#E9F5F5" height="30">
												
													<table border="0" width="100%">
														
														<form method='post'>
														<input type='hidden' name='flag' value='search'>
												
														<tr>
															<td width="83%">
																����+������ ����
																<select name='age'size="1" style="height: 18px; border: 1px solid black">
																<option value="15"
																<?
																if($age == '15') echo " selected"
																?>
																>15~20��</option>
																<option value="21"
																<?
																if($age == '21') echo " selected"
																?>
																>21~29��</option>
																<option value="30"
																<?
																if($age == '30') echo " selected"
																?>
																>30~39��</option>
																<option value="40"
																<?
																if($age == '40') echo " selected"
																?>
																>40�� �̻�</option>
																<option value="etc"
																<?
																if($age == 'etc') echo " selected"
																?>
																>��Ÿ</option>
															</select>&nbsp;&nbsp; 
																
																<select name="address" size="1">
																<option value="����"
																<?
																if($address == '����') echo " selected"
																?>
																>����</option>
																<option value="��õ"
																<?
																if($address == '��õ') echo " selected"
																?>
																>��õ</option>
																<option value="����"
																<?
																if($address == '����') echo " selected"
																?>
																>����</option>
																<option value="�뱸"
																<?
																if($address == '�뱸') echo " selected"
																?>
																>�뱸</option>
																<option value="�λ�"
																<?
																if($address == '�λ�') echo " selected"
																?>
																>�λ�</option>
																<option value="����"
																<?
																if($address == '����') echo " selected"
																?>
																>����</option>
																<option value="���"
																<?
																if($address == '���') echo " selected"
																?>
																>���</option>
																<option value="���"
																<?
																if($address == '���') echo " selected"
																?>
																>���</option>
																<option value="�泲"
																<?
																if($address == '�泲') echo " selected"
																?>
																>�泲</option>
																<option value="���"
																<?
																if($address == '���') echo " selected"
																?>
																>���</option>
																<option value="����"
																<?
																if($address == '����') echo " selected"
																?>
																>����</option>
																<option value="����"
																<?
																if($address == '����') echo " selected"
																?>
																>����</option>
																<option value="�泲"
																<?
																if($address == '�泲') echo " selected"
																?>
																>�泲</option>
																<option value="���"
																<?
																if($address == '���') echo " selected"
																?>
																>���</option>
																<option value="����"
																<?
																if($address == '����') echo " selected"
																?>
																>����</option>
																<option value="����"
																<?
																if($address == '����') echo " selected"
																?>
																>����</option>
														</select>&nbsp; 
														</td>
															<td width="17%">
																<p align="right">
																<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="submit" value="�˻�"></td>
														</tr>
</form>
													</table>
												</td>
												</tr>
											</table>
										</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
				  </td>
			  </tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						<?
							if($flag == 'search'){
							
								$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id'";
							
							//echo "sql4=$SQL4";
							$dbresult = mysql_query($SQL, $dbconn);
							$number_total = mysql_result($dbresult,0,0);
							
							$today_year = date("y") + 100;
								
								if($age == '15'){
									$age_str = "15~20��";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 15 and $today_year - substring(passport1,1,2)*1 <= 20 and binary address like '%$address%'";
								
							}
							
							if($age == '21'){
									$age_str = "21~29��";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 21 and $today_year - substring(passport1,1,2)*1 <= 29 and binary address like '%$address%'";
								
							}
							
							if($age == '30'){
									$age_str = "30~39��";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 30 and $today_year - substring(passport1,1,2)*1 <= 39 and binary address like '%$address%'";
								
							}
							
							if($age == '40'){
									$age_str = "40�� �̻�";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 40 and binary address like '%$address%'";
							}
							
							if($age == 'etc'){
									$age_str = "��Ÿ";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 < 15 and binary address like '%$address%'";
							}
							
							//echo "sql=$SQL";
							$dbresult = mysql_query($SQL, $dbconn);
							if($number_total == 0){
								$number = 0;
								$number_percent = 0;	
								$graph_width = 0;
							}
							else{
								$number = mysql_result($dbresult,0,0);
								$number_percent = number_format($number / $number_total * 100,2);	
								$graph_width = number_format($number / $number_total * 250);
							}
							
						?>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="3">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%">
													<b>
													<font color="#FFFFFF">�˻���� : <?echo $address?>/<?echo $age_str?> 
													���� ��Ȳ</font></b></td>
												<td width="50%"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="23%" bgcolor="#FFFFFF" align="left">
											<p align="center">����</td>
										<td width="23%" bgcolor="#FFFFFF" align="left">
											<p align="center">ȸ����</td>
										<td width="7%" bgcolor="#FFFFFF" align="center">
											�׷���</td>
									</tr>
									<tr>
										<td width="16%" height="25" bgcolor="#FFFFFF" align="center">
											<?echo $address?></td>
										<td width="18%" height="25" bgcolor="#FFFFFF" align="center">
											<?echo $number?>��</td>
										<td width="66%" height="25" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $graph_width?>" height="10"> 
											<?echo $number_percent?>%</td>
									</tr>
									<tr>
										<td width="16%" height="25" bgcolor="#FCB663" align="center">
											<b><font color="#FFFFFF">��ü</font></b></td>
										<td width="18%" height="25" bgcolor="#FCB663" align="center">
											<b><font color="#FFFFFF"><?echo $number_total?>��</font></b></td>
										<td width="66%" height="25" bgcolor="#FCB663" align="leftr">
											<img src="../images/graph1.gif" width="250" height="10"> 100%</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
						<?
							}
						?>
					</td>
					</tr>
		  </table>


					</center></div></td>
  </tr>
</table>


<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>