<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){
	$SQL = "delete from $EstimateTable where est_no = $est_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

if($flag=="ok"){
	$SQL = "update $EstimateTable set estimate_ok='y' where est_no = $est_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

if($flag=="no"){
	$SQL = "update $EstimateTable set estimate_ok='n' where est_no = $est_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

$SQL = "select * from $EstimateTable where mart_id='$mart_id' order by est_no desc";
$dbresult = mysql_query($SQL, $dbconn);

	include "../admin_head.php";
?>

<script>
function del(est_no){
	if(confirm("삭제하시겠습니까?")){
		window.location.href='estimate.php?flag=del&est_no='+est_no;
	}
	else return;
}
function est_ok(est_no){
	if(confirm("승인하시겠습니까?")){
		window.location.href='estimate.php?flag=ok&est_no='+est_no;
	}
	else return;
}
function est_no(est_no){
	if(confirm("승인취소하시겠습니까?")){
		window.location.href='estimate.php?flag=no&est_no='+est_no;
	}
	else return;
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu6.html'; ?>
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
            <td width="310"><img src="../img/page_title6.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../good/board_frame8.html">HOME</a> &gt; </span><span class="text_gray2_c">게시판관리</span> &gt; <span class="text_gray2_c">사용후기 관리 </span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
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
			<!--왼쪽부분시작-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->	  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>사용후기 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>


			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>     
				<td width="90%" bgcolor="#FFFFFF" valign="top"><span class="aa">고객이 작성한 
					상품 후기를      
				  관리하실 수 있습니다.<br>   
				  삭제버튼을 클릭하시면 삭제됩니다.    
				  </span>
				</td>
				</tr>    
				<tr>    
				<td width="90%" bgcolor="#FFFFFF" valign="top"><p align="right">　</td> 
				</tr> 
<?
$SQL = "select * from $EstimateTable where mart_id='$mart_id' order by est_no desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if ($cnfPagecount == "") $cnfPagecount = 5;
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

$total_page = ($numRows - 1) / $cnfPagecount;
$total_page = intval($total_page)+1;

if($page % 10 == 0)
$start_page = $page - 9;
else
$start_page = $page - ($page % 10) + 1;

$end_page = $start_page + 9;
if($end_page >= $total_page)
	$end_page = $total_page;
$prev_start_page = $start_page - 10;
$next_start_page = $start_page + 10;
?>				
			<tr> 
				<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">  
					
					<table border="0" width="100%" cellspacing="0" cellpadding="0">  
						<tr>  
							<td width="100%" bgcolor="#FFFFFF"><p align="right"><br>  
							</td>  
						</tr>  
						<tr>  
							<td width="100%" bgcolor="#FFFFFF">
								<p style="padding-left: 20px">
								<span class="aa">
								<?
							if($page == 1){
								echo ("
								처음
								");
							}
							else{
								echo ("
								<a href='estimate.php?page=1'>처음</a> 
								");
							}
						
							if($start_page > 1){
								echo ("
								<a href='estimate.php?page=$prev_start_page'>
								◁&nbsp; 
								</a>
								");
							}
							else{
								echo ("
								◁&nbsp; 
								");
							}
							for($i=$start_page;$i<=$end_page;$i++){
								if($i == $page){
									echo ("	
									[<b>$i</b>]
									");
								}
								else{
									echo ("
								<a href='estimate.php?page=$i'>$i</a> 
									");
								}
							}
							if($end_page < $total_page){
								echo ("
								<a href='estimate.php?page=$next_start_page'>
								&nbsp;▷
								</a>
								");
							}
							else{
								echo ("
								&nbsp;▷
								");
							}
							if($page == $total_page){
								echo ("
								끝
								");
							}
							else{
								echo ("
								<a href='estimate.php?page=$total_page'>끝</a> 
								");
							}
							if($numRows == 0){
								echo ("&nbsp;&nbsp;&nbsp;&nbsp;현재 등록된 사용후기가 없습니다.");
							} 
							?>      
								</span>
							</td>     
						</tr>     
					</table>     
				</td>     
			  </tr>     
				<tr>     
				<td width="100%" bgcolor="#FFFFFF" valign="top">
					<div align="center"><center>
					<table border="0" width="95%">     
						<tr>     
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">     
								
<?
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$est_no = $ary["est_no"];
	$item_no = $ary["item_no"];
	
	$SQL1 = "select item_code,item_name from $ItemTable where item_no='$item_no'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$row1 = mysql_fetch_array( $dbresult1 );
	$item_code = $row1[item_code];
	$item_name = $row1[item_name];

	$title = $ary[title];
	$name = $ary[name];
	$email = $ary[email];
	$estimate_ok = $ary[estimate_ok];
	$write_date = $ary[write_date];
	$content = nl2br($ary[content]);

	$write_date = substr($write_date,0,4)."/".substr($write_date,4,2)."/".substr($write_date,6,2);

	if( $estimate_ok == "y" ){
		$est_button = "<input class='aa' onclick=\"est_no('$est_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='승인 취 소'>";
	}else{
		$est_button = "<input class='aa' onclick=\"est_ok('$est_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='승 인'>";
	}
?>			
									<tr>     
										<td width='100%' bgcolor='#8FBECD' colspan='4'>
											<table border='0' width='100%' cellspacing='0' cellpadding='0'>     
												<tr>     
													<td width='50%'>
														&nbsp; <b><?=$write_date?>&nbsp;&nbsp;<a href='mailto:<?=$email?>'><?=$name?></a> &nbsp; </b>
													</td>     
													<td width='50%' align='right'>
														<?=$est_button?>&nbsp;
														<input class='aa' onClick="del('<?=$est_no?>')" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭 제'>
													</td>   
												</tr>   
											</table>   
										</td>   
									</tr>     
									<tr>   
										<td width='9%' bgcolor='#C8DFEC' align='center'>
											상품코드
										</td>      
										<td width='11%' bgcolor='#FFFFFF'>
											<?=$item_no?>
										</td>    
										<td width='7%' bgcolor='#C8DFEC' align='center'>상품명
										</td>   
										<td width='30%' bgcolor='#FFFFFF' align='center'>
											<?=$item_name?>
										</td>   
									</tr>     
									<tr>   
										<td width='57%' bgcolor='#FFFFFF' colspan='4' class='aa'> 
											<?=$title?><br><?=$content?>
										</td>   
								</tr>   
<?
}
?>
								</table>    
							</td>   
						</tr>   
					</table>   
					</div>
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