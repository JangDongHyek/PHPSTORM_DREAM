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
			<!--왼쪽부분시작-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>설문조사관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
      			<tr>    
        			<td width="90%" bgcolor="#FFFFFF" valign="top">고민이 실려있는 잘짜여진 설문조사기능은 마케팅 계획을 세우고, 평가하는데 있어서&nbsp;<br>   
						가장 요긴한 기능중의 하나입니다.&nbsp;&nbsp;
        			</td>        
				</tr>        

				<tr>       
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						<table border="0" width="100%">       
						<tr>       
							<td width="100%" height="30"><strong>[현재 진행되고 있는 설문]</strong></td>
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
											<td width="41%" bgcolor="#e7e7e7" align="center"><strong>제목</strong></td>     
											<td width="9%" bgcolor="#e7e7e7" align="center"><strong>등록일자</strong></td>    
											<td width="12%" bgcolor="#e7e7e7" align="center"><strong>결과보기</strong></td>    
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
												<input class='aa' onclick=\"window.location.href='poll_result.php?poll_code=$poll_code'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='결과보기'> &nbsp;
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
									[지난 설문 리스트]      
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
															<strong>제목</strong></td>    
														<td width="9%" bgcolor="#e7e7e7" align="center">
															<strong>일자</strong></td>    
														<td width="12%" bgcolor="#e7e7e7" align="center">
															<strong>관리</strong></td>    
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
															<input class='aa' onclick=\"window.location.href='poll_result.php?poll_code=$poll_code'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='reset' value='결과보기'> &nbsp;
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
									<input onclick="window.location.href='poll_write.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="설문 등록"></td>  
							</tr>
						</table>
						</td>
					</tr>
				</table>


<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>