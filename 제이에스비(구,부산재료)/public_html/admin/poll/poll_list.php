<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){
	$SQL = "delete from $PollTable where poll_code = $poll_code and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$SQL = "delete from $Poll_AnsTable where poll_code = $poll_code and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�����������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
      			<tr>    
        			<td width="90%" bgcolor="#FFFFFF" valign="top">����� �Ƿ��ִ� ��¥���� ������������ ������ ��ȹ�� �����, ���ϴµ� �־&nbsp;<br>   
						���� ����� ������� �ϳ��Դϴ�.&nbsp;&nbsp;
        			</td>        
				</tr>        

				<tr>       
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						<table border="0" width="100%">       
						<tr>       
							<td width="100%" height="30"><strong>[���� ����ǰ� �ִ� ����]</strong></td>
						</tr>     
						</table>     
					</td>     
				</tr>     
				<center>     
    			<tr>     
        			<td width="100%" bgcolor="#FFFFFF" valign="top">
        				<div align="center"><center>
        				<table border="0" width="97%">     
          					<tr>     
								<td width="100%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3"> 
										<tr>     
											<td width="41%" bgcolor="#e7e7e7" align="center"><strong>����</strong></td>     
											<td width="9%" bgcolor="#e7e7e7" align="center"><strong>�������</strong></td>    
											<td width="12%" bgcolor="#e7e7e7" align="center"><strong>�������</strong></td>    
										</tr>    
			            <?
						$SQL = "select * from $PollTable where mart_id='$mart_id' order by poll_code desc";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						
						if($numRows > 0){
							mysql_data_seek($dbresult, 0);
							$ary=mysql_fetch_array($dbresult);
							$poll_code = $ary["poll_code"];
							$poll_name = $ary["poll_name"];
							$content = $ary["content"];
							$date = substr($ary["date"],0,10);
							echo ("
										<tr>    
											<td width='41%' bgcolor='#FFFFFF' align='left'>
												<span class='aa'><a href='poll_edit.php?poll_code=$poll_code'>$content</a></td>    
											<td width='9%' bgcolor='#FFFFFF' align='center'>
												<span class='aa'>$date</td>    
											<td width='12%' bgcolor='#FFFFFF' align='center'>
												&nbsp;
												<input class='aa' onclick=\"window.location.href='poll_result.php?poll_code=$poll_code'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�������'> &nbsp;
											</td>     
										</tr>     
	            			");
            			}
            			?>
            						</table>     
            					</td>     
          					</tr>     
        				</table>     
        				</center></div>
        			</td>     
      			</tr>     
    			</center>     
      			<tr><td width="100%" bgcolor="#FFFFFF" valign="top"></td></tr>
					<tr><td width="100%" bgcolor="#FFFFFF" valign="top">    
						<table border="0" width="100%">
							<tr>
								<td width="97%"><strong>&nbsp;&nbsp;    
									[���� ���� ����Ʈ]      
									</strong>
								</td>   
							</tr>   
							<tr>     
								<td width="100%" bgcolor="#FFFFFF" valign="top">     
									<div align="center"><center>
									<table border="0" width="97%">
										<tr>
											<td width="100%" bgcolor="#999999">
												<table border="0" width="100%" cellspacing="1" cellpadding="3">
													<tr>
														<td width="41%" bgcolor="#e7e7e7" align="center">
															<strong>����</strong></td>    
														<td width="9%" bgcolor="#e7e7e7" align="center">
															<strong>����</strong></td>    
														<td width="12%" bgcolor="#e7e7e7" align="center">
															<strong>����</strong></td>    
													</tr>
				                <?
				                if($numRows > 1){
									for ($i=1; $i < $numRows; $i++) {
										mysql_data_seek($dbresult, $i);
										$ary=mysql_fetch_array($dbresult);
										$poll_code = $ary["poll_code"];
										$poll_name = $ary["poll_name"];
										$content = $ary["content"];
										$date = substr($ary["date"],0,10);
										echo ("	
													<tr>
														<td width='41%' bgcolor='#FFFFFF' align='left'>
															<span class='aa'><a href='poll_edit.php?poll_code=$poll_code'>$content</a></td>    
														<td width='9%' bgcolor='#FFFFFF' align='center'>
															<span class='aa'>$date</td>    
														<td width='12%' bgcolor='#FFFFFF' align='center'>&nbsp; 
															<input class='aa' onclick=\"window.location.href='poll_result.php?poll_code=$poll_code'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='reset' value='�������'> &nbsp;
														</td>     
													</tr>
                    					");
                    				}
                    			}
                    			?>
												</table>
											</td>
										</tr>
									</table></center></div>
								</td>  
							</tr>  
							<tr>    
								<td width="100%" height="30" bgcolor="#FFFFFF" align="center">
									<input onclick="window.location.href='poll_write.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���� ���"></td>  
							</tr>
						</table>
						</td>
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