<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false) {
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top"><p align="left"><br>
    	<br>
    	<br>
    	</p>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%"><img src="../images/a3.gif" WIDTH="160" HEIGHT="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#98A043"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><span class="bb"><br>
        		<small>▶</small> <font face="돋움">등록한 상품의 <strong>재고를 <br>
        		&nbsp; 관리</strong>합니다.<br>
        		</font><br>
        		</span></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#98A043" height="1"></td>
      	</tr>
    	</table>
    	<p align="left"><br>
    	<br>
    </td>
    <td width="1" bgcolor="#808080"><br>
    </td>
    <td width="646" bgcolor="#FFFFFF" valign="top">
    	<div align="center"><center>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		
        		<table border="0" width="100%">
          		<tr>
            		<td width="100%" height="20"><p align="center"><br>
            			<?
            			if($search_type == 1){
            				echo ("
            			<input class='aa' onclick=\"window.location.href='jaego_search_result.php?search_type=2'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='위험상품 검색결과로 가기'>
            				");
            			}
            			if($search_type == 2){
            				echo ("
            			<input class='aa' onclick=\"window.location.href='jaego_search_result.php?search_type=1'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='품절상품 검색결과로 가기'>
            				");
            			}
            			?>
            			</td>
          		</tr>
        		</table>
        		
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"><p align="center"><span class="aa"><br>
            			검색 결과내에서 재고량을 수정하실 수 있습니다.<br>
            			</span></td>
          		</tr>
          		<tr>
            		<td width="50%" bgcolor="#FFFFFF" height="0"></td>
            		<td width="50%" bgcolor="#FFFFFF" height="0"></td>
          		</tr>
          		<?
				if ($cnfPagecount == "") $cnfPagecount = 20;
				if ($page == "") $page = 1;
				$skipNum = ($page - 1) * $cnfPagecount;
				
				$prev_page = $page - 1;
				$next_page = $page + 1;
				
				if($search_type == 1)
					$SQL = "select * from $ItemTable where jaego = 0 and mart_id='$mart_id' and jaego_use = '1' order by item_no desc";
				
				if($search_type == 2)
					$SQL = "select * from $ItemTable where jaego >= 1 and jaego < 6 and mart_id='$mart_id' and jaego_use = '1' order by item_no desc";
				
				//echo "sql=$SQL";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				
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
            		<td width="100%" bgcolor="#FFFFFF" colspan="2"><p align="right"><br>
            		</td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" colspan="2">
            			<p style="padding-left: 20px">
            			<span class="aa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            			<?
		        		if($page == 1){
		        			echo ("
		        			처음
		        			");
		        		}
		        		else{
		        			echo ("
		        			<a href='jaego_search_result.php?search_type=$search_type&page=1'>처음</a>
		        			");
		        		}
		        	
		        		if($start_page > 1){
							echo ("
							<a href='jaego_search_result.php?search_type=$search_type&page=$prev_start_page'>
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
							<a href='jaego_search_result.php?search_type=$search_type&page=$i'>$i</a>
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='jaego_search_result.php?search_type=$search_type&page=$next_start_page'>
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
		        			<a href='jaego_search_result.php?search_type=$search_type&page=$total_page'>끝</a>
		        			");
		        		}
		        		?>
						</span>
						</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	
      	<form method='post''>
      	<input type='hidden' name='flag' value='update'>
      	<input type='hidden' name='search_type' value='<?echo $search_type?>'>
      	
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<div align="center"><center>
        		<table border="0" width="80%">
          		<tr>
            		<td width="90%" bgcolor="#999999">
            		
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="4">
                				
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				<tr>
                    				<td width="50%">&nbsp; <strong><span class="dd">상품별 재고현황</span></strong></td>
                    				<td width="50%"></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="3%" bgcolor="#C8DFEC" align="center"><span class="aa">상태</span></td>
                			<td width="4%" bgcolor="#C8DFEC" align="center"><span class="aa">번호(item_no)</span></td>
                			<td width="18%" bgcolor="#C8DFEC" align="left"><span class="aa"><p align="center">상품명</span></td>
                			<td width="8%" bgcolor="#C8DFEC" align="left"><p align="center"><span class="aa">재고량</span></td>
              			</tr>
              			<?	
						for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
							if ($i >= $numRows) break;
							mysql_data_seek($dbresult, $i);
							
							$ary=mysql_fetch_array($dbresult);
							$item_no = $ary["item_no"];
							$item_name = $ary["item_name"];
							$jaego = $ary["jaego"];
							$reg_date = $ary["reg_date"];
							$read_num = $ary["read_num"];
							$j = $numRows - $i;
							if($jaego == 0){
								$status_color = "#FF0000";
								$status_str = "품절";
							}
							if($jaego >= 1 && $jaego <= 5){
								$status_color = "#FFC821";
								$status_str = "위험";
							}
							if($jaego > 5){
								$status_color = "#0080C0";
								$status_str = "여유";
							}
							
							
							echo ("		
			  			<tr>
                			<input type='hidden' name='item_no[]' value='$item_no'>
                			<td width='3%' bgcolor='$status_color' align='center'>
                				<strong><span class='dd'>$status_str</span></strong></td>
                			<td width='4%' bgcolor='#FFFFFF' align='center'>
                				<span class='aa'>$j($item_no)</span></td>
                			<td width='19%' bgcolor='#FFFFFF' align='left'>
                				<span class='aa'>$item_name</span></td>
                			<td width='8%' bgcolor='#FFFFFF' align='left'>
                				<p align='center'><span class='aa'>
                				<input name='jaego[]' size='4' style='border: 1px solid rgb(136,136,136)' value='$jaego' class='aa'></span></td>
              			</tr>
              				");
              			}
              			?>
              			</table>
            		</td>
          		</tr>
        		</table>
        		</center></div></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<p align="right">
        		<span class="aa">
    				<?
        		if($page == 1){
        			echo ("
        			처음
        			");
        		}
        		else{
        			echo ("
        			<a href='jaego_search_result.php?search_type=$search_type&page=1'>처음</a>
        			");
        		}
        	
        		if($start_page > 1){
					echo ("
					<a href='jaego_search_result.php?search_type=$search_type&page=$prev_start_page'>
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
					<a href='jaego_search_result.php?search_type=$search_type&page=$i'>$i</a>
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='jaego_search_result.php?search_type=$search_type&page=$next_start_page'>
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
        			<a href='jaego_search_result.php?search_type=$search_type&page=$total_page'>끝</a>
        			");
        		}
        		?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정완료">&nbsp; 
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
        		<input class="aa" onclick="window.location.href='jaego_category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="이전화면"></td>
      	</tr>
      	
      	</form>
      	
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><br></td>
      	</tr>
    	</table>
    	</center></div></td>
</tr>
</table>
</body>
</html>
<?
}
if($flag == 'update'){
	for($i=0; $i<count($item_no); $i++) {
		$SQL = "update $ItemTable set jaego = '$jaego[$i]' where mart_id='$mart_id' and item_no = '$item_no[$i]'";

		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=jaego_search_result.php?search_type=$search_type'>";
}
?>
<?
mysql_close($dbconn);
?>