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
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><p style="padding-left: 10px"><span class="aa"><br>
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
        		</span></td>
      	</tr>
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top">
        		<p align="right">
        		<span class="bb"><small>▶</small> 
        		카테고리 바로가기&nbsp;&nbsp; 
        		<select onchange="goto_byselect(this, 'self')" class="aa" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
          		<?
				$SQL = "select * from $CategoryTable where prevno=0 and mart_id='$mart_id' order by category_num desc";
				$dbresult = mysql_query($SQL, $dbconn);
			
				$tmp_category_num = $category_num;
				$numRows = mysql_num_rows($dbresult);
				for ($i=0; $i<$numRows; $i++) {
					mysql_data_seek($dbresult,$i);
					$ary = mysql_fetch_array($dbresult);
					$category_num = $ary["category_num"];
					$category_name = $ary["category_name"];
					
					$SQL = "select * from $CategoryTable where prevno=$category_num and mart_id='$mart_id' order by category_num desc";
					//echo "sql=$SQL";
					$dbresult2 = mysql_query($SQL, $dbconn);
					$numRows1 = mysql_num_rows($dbresult2);
					
					echo ("
					<option value=''>---------------</option>
					<option value='jaego_item_list.php?category_num=$category_num'
					");		
					if($tmp_category_num == $category_num) {
						echo "selected";
						$cur_category_name = $category_name;
						}
					echo ("	>▷$category_name</option>
					<option value=''>---------------</option>
					");
								
					for($j=0;$j<$numRows1;$j++){
						mysql_data_seek($dbresult2,$j);
						$ary1 = mysql_fetch_array($dbresult2);
						$category_num1 = $ary1["category_num"];
						$category_name1 = $ary1["category_name"];
								
						echo ("
					<option value='jaego_item_list.php?category_num=$category_num1'
						");	
						if($tmp_category_num == $category_num1){
							echo "selected";
							$cur_category_name = $category_name1;
						}
						echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>");
					}
				}
				?>
					
				</select><br>
        		<br>
        		</span></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		
        		<table border="0" width="100%">
          		<tr>
            		<td width="100%" height="20"><strong><span class="cc">[현재 카테고리 : <?echo $cur_category_name?>]</span></strong></td>
          		</tr>
        		</table>
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"><span class="aa"></span></td>
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
            			<span class="aa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
						</span></td>
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
                    				<td width="50%">&nbsp; <strong><span class="dd">상품별 재고현황</span></strong></td>
                    				<td width="50%"></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="3%" bgcolor="#C8DFEC" align="center"><span class="aa">상태</span></td>
                			<td width="4%" bgcolor="#C8DFEC" align="center"><span class="aa">번호</span></td>
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
                				<span class='aa'>$j</span></td>
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
						</span></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정완료">&nbsp; 
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">&nbsp; 
        		<input class="aa" onclick="javascript:window.location.href='jaego_category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="이전화면"></td>
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
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "<meta http-equiv='refresh' content='0; URL=jaego_item_list.php?category_num=$prevno'>";
}
?>
<?
mysql_close($dbconn);
?>