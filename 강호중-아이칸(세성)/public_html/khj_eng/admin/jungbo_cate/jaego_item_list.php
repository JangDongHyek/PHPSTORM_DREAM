<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false) {
?>
<?
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
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "3";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>재고관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>
			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">
        		재고량을 수정하시려면 빈칸에 입력하시고 <br>
        		하단의 수정완료버튼을 클릭하시면 됩니다<br>
        		재고량에는 숫자만 입력하세요.
        		<br>
        		<img src="../images/tip.gif" WIDTH="30" HEIGHT="15"> 재고보는 법!<br>
        		<font color="#0000FF">
        		품절 : 현재 상품의 재고가 0 인 제품 | 재고량 : 0출력<br>
        		위험 : 현재 상품의 재고가 5 이하인 제품</font><br>
        		<font color="#0000FF">
        		여유 : 현재 상품의 재고가 5 이상인 제품&nbsp;<br>
					</td>
				</tr>

      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top">
        		<p align="right">
        		<small>▶</small> 
        		분류 바로가기&nbsp;&nbsp; 
        		<select onchange="goto_byselect(this, 'self')" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
<?
$SQL = "select category_num,category_name from jungbo_cate where mart_id='$mart_id' and prevno='0' order by category_num desc";
$dbresult = mysql_query($SQL, $dbconn);
$tmp_category_num = $category_num;
$numRows = mysql_num_rows($dbresult);
for($i=0; $i<$numRows; $i++){
	$category_num = mysql_result($dbresult,$i,0);
	$category_name = mysql_result($dbresult,$i,1);
	
	$SQL2 = "select category_num,category_name from jungbo_cate where mart_id='$mart_id' and prevno='$category_num' order by category_num desc";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	$numRows1 = mysql_num_rows($dbresult2);

	echo ("
					<option value='item_list.php?category_num=$category_num'
	");		
	if($tmp_category_num == $category_num){
		echo "selected";
		$cur_category_name = $category_name;
	}
	echo (" style='color:#000000; background-color:#dddddd;'>▷$category_name</option>");
				
	for($j=0;$j<$numRows1;$j++){
		$category_num1 = mysql_result($dbresult2,$j,0);
		$category_name1 = mysql_result($dbresult2,$j,1);

		$SQL3 = "select category_num,category_name from jungbo_cate where mart_id='$mart_id' and prevno='$category_num1' order by category_num desc";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);
				
		echo ("
					<option value='jaego_item_list.php?category_num=$category_num1'
		");	
		if($tmp_category_num == $category_num1){
			echo "selected";
			$cur_category_name = $category_name1;
		}
		echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>");

		for($k=0;$k<$numRows3;$k++){
			$category_num3 = mysql_result($dbresult3,$k,0);
			$category_name3 = mysql_result($dbresult3,$k,1);

			echo ("
						<option value='jaego_item_list.php?category_num=$category_num3'
			");	
			if($tmp_category_num == $category_num3){
				echo "selected";
				$cur_category_name = $category_name3;
			}
			echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>");
		}
	}
}
?>
					
				</select><br>
        		<br>
        		</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		
        		<table border="0" width="100%">
          		<tr>
            		<td width="100%" height="20"><strong>[현재 분류 : <?echo $cur_category_name?>]</strong></td>
          		</tr>
        		</table>
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"></td>
          		</tr>
          		<tr>
            		<td width="50%" bgcolor="#FFFFFF" height="0"></td>
            		<td width="50%" bgcolor="#FFFFFF" height="0"></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" colspan="2"><p align="right"><br>
            		</td>
          		</tr>
          		<?
				if ($cnfPagecount == "") $cnfPagecount = 20;
				if ($page == "") $page = 1;
				$skipNum = ($page - 1) * $cnfPagecount;
				
				$prev_page = $page - 1;
				$next_page = $page + 1;
				
				$SQL = "select * from $ItemTable where category_num = $tmp_category_num and mart_id='$mart_id' and jaego_use = '1' order by item_no desc";
		
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
            		<td width="100%" bgcolor="#FFFFFF" colspan="2">
            			<p style="padding-left: 20px">
            			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            			<?
		        		if($page == 1){
		        			echo ("
		        			처음
		        			");
		        		}
		        		else{
		        			echo ("
		        			<a href='jaego_item_list.php?category_num=$tmp_category_num&page=1'>처음</a>
		        			");
		        		}
		        	
		        		if($start_page > 1){
							echo ("
							<a href='jaego_item_list.php?category_num=$tmp_category_num&page=$prev_start_page'>
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
							<a href='jaego_item_list.php?category_num=$tmp_category_num&page=$i'>$i</a>
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='jaego_item_list.php?category_num=$tmp_category_num&page=$next_start_page'>
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
		        			<a href='jaego_item_list.php?category_num=$tmp_category_num&page=$total_page'>끝</a>
		        			");
		        		}
		        		?>
						</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	
      	<form method='post''>
      	<input type='hidden' name='flag' value='update'>
      	<input type='hidden' name='prevno' value='<?echo $tmp_category_num?>'>
      	
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
                    				<td width="50%">&nbsp; <strong>상품별 재고현황</strong></td>
                    				<td width="50%"></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="3%" bgcolor="#C8DFEC" align="center">상태</td>
                			<td width="4%" bgcolor="#C8DFEC" align="center">번호</td>
                			<td width="18%" bgcolor="#C8DFEC" align="left"><p align="center">상품명</td>
                			<td width="8%" bgcolor="#C8DFEC" align="left"><p align="center">재고량</td>
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
                				<strong>$status_str</strong></td>
                			<td width='4%' bgcolor='#FFFFFF' align='center'>
                				$j</td>
                			<td width='19%' bgcolor='#FFFFFF' align='left'>
                				$item_name</td>
                			<td width='8%' bgcolor='#FFFFFF' align='left'>
                				<p align='center'>
                				<input type='text' name='jaego[]' size='10' style='border: 1px solid rgb(136,136,136)' value='$jaego'></td>
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
        		
        		<?
		        		if($page == 1){
		        			echo ("
		        			처음
		        			");
		        		}
		        		else{
		        			echo ("
		        			<a href='jaego_item_list.php?category_num=$tmp_category_num&page=1'>처음</a>
		        			");
		        		}
		        	
		        		if($start_page > 1){
							echo ("
							<a href='jaego_item_list.php?category_num=$tmp_category_num&page=$prev_start_page'>
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
							<a href='jaego_item_list.php?category_num=$tmp_category_num&page=$i'>$i</a>
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='jaego_item_list.php?category_num=$tmp_category_num&page=$next_start_page'>
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
		        			<a href='jaego_item_list.php?category_num=$tmp_category_num&page=$total_page'>끝</a>
		        			");
		        		}
		        		?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정완료" style='cursor:hand'>&nbsp; 
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력" style='cursor:hand'>&nbsp; 
        		<input onclick="location.href='jaego_category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트" style='cursor:hand'></td>
      	</tr>
      	
      	</form>
      	
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><br></td>
      	</tr>
    	</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
}
if($flag == 'update'){
	
	for($i=0; $i<count($item_no); $i++) {
		$SQL = "update $ItemTable set jaego = '$jaego[$i]' where mart_id='$mart_id' and item_no = '$item_no[$i]'";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=jaego_item_list.php?category_num=$prevno'>";
}
?>
<?
mysql_close($dbconn);
?>