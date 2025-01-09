<?
include "../lib/Mall_Admin_Session.php";
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE='JavaScript1.1'>
<!--
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
function checkform(f)
{
  	if (f.category_name.value=="") {
		alert("카테고리 명을 입력해주세요.");
		f.category_name.focus();
		return false;
	}
	return true;
}
function checkform1(f)
{
  	if (f.target_category.value=="") {
		alert("카테고리를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	return true;
}
function really2(item_no, tmp_category_num){
	if (confirm("현재상품을 삭제하시겠습니까?")){
		document.location.href='item_list.php?delflag=del_item&item_no='+item_no+'&category_num='+tmp_category_num;
	}
}
//-->
</SCRIPT>
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
        		<small>▶</small> <font face="돋움">쇼핑몰 <strong>상품</strong>을<strong> <br>
        		&nbsp;&nbsp; 관리</strong>합니다.<br>
        		</font><br>
        		</span>
        	</td>
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
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
        		<p style="padding-left: 10px"><span class="aa">현재 카테고리에 대한 상품을
        		관리하실 수 있습니다.<br>
        		이 카테고리에 대한 하위 카테고리가 존재하지 않으면 바로
        		상품등록을 하시고, <br>
        		하위 카테고리가 존재하면 하위 카테고리를 생성하신 후 상품을
        		등록하세요.<br>
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><p align="right"><span class="ee"><b>☞
        		카테고리 이동</b>&nbsp;&nbsp;
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
					<option value='item_list.php?category_num=$category_num'
					");		
					if($tmp_category_num == $category_num) {
						echo "selected";
						$cur_category_name = $category_name;
						}
					echo ("	style='color:#000000; background-color:#dddddd;'>▷$category_name</option>
					");
								
					for($j=0;$j<$numRows1;$j++){
						mysql_data_seek($dbresult2,$j);
						$ary1 = mysql_fetch_array($dbresult2);
						$category_num1 = $ary1["category_num"];
						$category_name1 = $ary1["category_name"];
								
						echo ("
					<option value='item_list.php?category_num=$category_num1'
						");	
						if($tmp_category_num == $category_num1){
							echo "selected";
							$cur_category_name = $category_name1;
						}
						echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>");
					}
				}
				
				// 주고 받기 카테고리..
				$SQL = "select * from $CategoryTable T1, $GiveNTakeTable T2 ".
				"where T1.category_num = T2.category_num and T1.mart_id = T2.provider_id and T2.seller_id = '$Mall_Admin_ID' order by T2.gnt_no desc";
				//echo "sql=$SQL";
				$dbresult = mysql_query($SQL, $dbconn);
			
				$numRows = mysql_num_rows($dbresult);
				//echo "numRows=$numRows";
				for ($i=0; $i<$numRows; $i++) {
					mysql_data_seek($dbresult,$i);
					$ary = mysql_fetch_array($dbresult);
					$category_num = $ary["category_num"];
					$category_name = $ary["category_name"];
					$provider_id = $ary["provider_id"];
					
					$SQL = "select * from $CategoryTable where prevno=$category_num order by category_num desc";
					//echo "sql=$SQL";
					$dbresult2 = mysql_query($SQL, $dbconn);
					$numRows1 = mysql_num_rows($dbresult2);
					
					echo ("
					<option value='item_list_gnt.php?category_num=$category_num'
					");		
					if($tmp_category_num == $category_num) {
						echo "selected";
						$cur_category_name = $category_name;
						}
					echo ("	style='color:#000000; background-color:#dddddd;'>▷$category_name</option>
					");
								
					for($j=0;$j<$numRows1;$j++){
						mysql_data_seek($dbresult2,$j);
						$ary1 = mysql_fetch_array($dbresult2);
						$category_num1 = $ary1["category_num"];
						$category_name1 = $ary1["category_name"];
								
						echo ("
					<option value='item_list_gnt.php?category_num=$category_num1'
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
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<table border="0" width="100%">
          		
          		<tr>
            		<td width="50%" height="20"><strong><span class="cc">[현재 카테고리 : <?echo $cur_category_name?>]</span></strong>
            			</td>
            		<td width="50%" height="20">
            		</td>
          		</tr>
          		</form>
        		</table>
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#808080" height="1" colspan="2"></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="5" colspan="2"><span class="aa"></span></td>
          		</tr>
          		<tr>
            		<td width="50%" bgcolor="#FFFFFF" height="0">
            			<p style="padding-left:10px">
            			<?
            			$SQL = "select * from $ItemTable where category_num='$tmp_category_num'";
						//echo "sql=$SQL";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						//echo "numRows=$numRows";
						?>
						<span class="aa">총 <?echo $numRows?>개의 상품이 등록되어 있습니다.</span></td>
            		<td width="50%" bgcolor="#FFFFFF" height="0">
            			<p align="right">
            			<?
            				echo ("
            			<span class='aa'>GiveNTake 카테고리에는 상품을 등록할 수 없습니다.</span>
            				");
            			?>
            		</td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" colspan="2"><p align="right"><br>
            		</td>
          		</tr>
          		<?
				if ($cnfPagecount == "") $cnfPagecount = 10;
				if ($page == "") $page = 1;
				$skipNum = ($page - 1) * $cnfPagecount;
				
				$prev_page = $page - 1;
				$next_page = $page + 1;
				
				$SQL = "select * from $ItemTable where category_num = $tmp_category_num order by item_no desc";
		
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
		        	<span class="aa">
		        		<?
		        		if($page == 1){
		        			echo ("
		        			처음
		        			");
		        		}
		        		else{
		        			echo ("
		        			<a href='item_list_gnt.php?category_num=$tmp_category_num&page=1'>처음</a>
		        			");
		        		}
		        	
		        		if($start_page > 1){
							echo ("
							<a href='item_list_gnt.php?category_num=$tmp_category_num&page=$prev_start_page'>
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
							<a href='item_list_gnt.php?category_num=$tmp_category_num&page=$i'>$i</a>
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='item_list_gnt.php?category_num=$tmp_category_num&page=$next_start_page'>
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
		        			<a href='item_list_gnt.php?category_num=$tmp_category_num&page=$total_page'>끝</a>
		        			");
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
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="6">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				<tr>
                    				<td width="50%">&nbsp;
                    					<strong><span class="dd">현재 카테고리에 등록된 상품 리스트</span></strong>
                    				</td>
                    				<td width="50%"></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
			                <td width="4%" bgcolor="#C8DFEC" align="center"><span class="aa">번호</span></td>
			                <td width="18%" bgcolor="#C8DFEC" align="left"><span class="aa"><p align="center">상품명</span></td>
			                <td width="8%" bgcolor="#C8DFEC" align="left"><span class="aa"><p align="center">등록일</span></td>
			                <td width="8%" bgcolor="#C8DFEC" align="center"><span class="aa">상세보기</span></td>
			                <td width="6%" bgcolor="#C8DFEC" align="center"><span class="aa">조회수</span></td>
			            </tr>
             
              			<?	
						for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
							if ($i >= $numRows) break;
							mysql_data_seek($dbresult, $i);
							$ary=mysql_fetch_array($dbresult);
						
							$item_no = $ary["item_no"];
							$item_name = $ary["item_name"];
							$reg_date = $ary["reg_date"];
							$read_num = $ary["read_num"];
							$j = $numRows - $i;
							echo ("		
			  			<tr>
                			<td width='4%' bgcolor='#FFFFFF' align='center'><span class='aa'>$j</span></td>
                			<td width='19%' bgcolor='#FFFFFF' align='left'><span class='aa'>$item_name</span></td>
                			<td width='8%' bgcolor='#FFFFFF' align='left'><p align='center'>
                				<span class='aa'>$reg_date</span></td>
                			<td width='8%' bgcolor='#FFFFFF' align='center'>
                				<input class='aa' onclick=\"javascript:window.location.href='item_view_gnt.php?item_no=$item_no&provider_id=$provider_id&page=$page'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='상세보기'>
                			</td>
                			<td width='5%' bgcolor='#FFFFFF' align='center'><span class='aa'>$read_num</span></td>
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
    	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input class="aa" onclick="javascript:window.location.href='category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="카테고리 리스트로">
        	</td>
		</tr>
    	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
    	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>