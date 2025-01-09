<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//카테고리 현재 위치
$cur_category_name = category_navi($category_num);
$tmp_category_num = $category_num;
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
<table width="600" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		 <td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>현재카테고리 : <?=$cur_category_name?></b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>   	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
<?
$SQL = "select * from $CategoryTable where category_num=$category_num and mart_id='$mart_id'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$category_name = $ary["category_name"];
}

//$SQL = "select * from $ItemTable where category_num='$category_num' and mart_id='$mart_id' order by item_order asc, item_no asc";

$SQL = "select item_no, item_order from $ItemTable where category_num = $category_num UNION select item_no, item_order from $Gnt_ItemTable where seller_id='$Mall_Admin_ID' and category_num = $category_num order by item_order asc, item_no asc";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
				
?>
		<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		
        		<table border="0" width="100%">
          		<tr>
            		<td width="100%" height="20"><strong><span class="cc">[현재 카테고리 : <?=$category_name?>]</span></strong></td>
          		</tr>
        		</table>
        		
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#808080" height="1"></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="5"><span class="aa"></span></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="0"><p style="padding-left:10px"><span class="aa"><br>
            			위치변경하단 blank에 입력한 수의 차례로 상품이 출력됩니다.
            			변경하지 않으시면 자동으로 상품입력순으로 출력됩니다.
            			기본값은 100으로 설정됩니다. 0 부터 1,2,3,4 처럼 작은숫자가 먼저 출력됩니다.</span></p>
            			<p align="right">　</td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF"><span class="aa">&nbsp;&nbsp;&nbsp; 총 <?=$numRows?>개의
            			상품이 등록되어 있습니다.</span></td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	
      	<form method='post'>
      	<input type='hidden' name='flag' value='update'>
      	
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<div align="center"><center>
        		
        		<table border="0" width="95%">
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="5">
                				
                				<table border="0" width="100%" >
                  				<tr>
                    				<td width="50%">&nbsp; <strong><span class="dd">현재 카테고리에 등록된 상품
                    					리스트</span></strong></td>
                    				<td width="50%"></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
		                	<td width="6%" bgcolor="#C8DFEC" align="center"><span class="aa">번호</span></td>
		                	<td width="20%" bgcolor="#C8DFEC" align="left"><span class="aa"><p align="center">상품명</span></td>
		                	<td width="7%" bgcolor="#C8DFEC" align="left"><span class="aa"><p align="center">등록일</span></td>
		                	<td width="5%" bgcolor="#C8DFEC" align="left"><span class="aa"><p align="center">조회수</span></td>
		                	<td width="9%" bgcolor="#C8DFEC" align="center"><span class="aa">위치변경</span></td>
		              	</tr>
		              	<?
		              	for ($i=0; $i < $numRows; $i++) {
							mysql_data_seek($dbresult, $i);
							$ary=mysql_fetch_array($dbresult);
							$item_no = $ary["item_no"];
							$item_order = $ary["item_order"];
							$j = $numRows - $i;
							
							$SQL1 = "select * from $ItemTable where item_no=$item_no";
							//echo "sql1=$SQL1";
							$dbresult1 = mysql_query($SQL1, $dbconn);
							$numRows1 = mysql_num_rows($dbresult1);
							if($numRows1 > 0){
								mysql_data_seek($dbresult1, 0);
								$ary1 = mysql_fetch_array($dbresult1);
								$mart_id = $ary1["mart_id"];
								$item_name = $ary1["item_name"];
								$reg_date = $ary1["reg_date"];
								$read_num = $ary1["read_num"];
							}
							//if($Mall_Admin_ID == $mart_id) 
								$gnt_img = "";
							/*else 
								$gnt_img = "<img src='../images/gnt.gif' height='12' width='25'>";*/
							
							echo ("		
			  			<input type='hidden' name='item_info[]' value='$item_no!$mart_id'>
			  			<tr>
							<td width='6%' bgcolor='#FFFFFF' align='center'><span class='aa'>$j</span></td>
		                	<td width='21%' bgcolor='#FFFFFF' align='left'><span class='aa'>$item_name$gnt_img</span></td>
		                	<td width='7%' bgcolor='#FFFFFF' align='left'><p align='center'><span class='aa'>$reg_date</span></td>
		                	<td width='5%' bgcolor='#FFFFFF' align='center'><span class='aa'>$read_num</span></td>
		                	<td width='9%' bgcolor='#FFFFFF' align='center'><span class='aa'>
		                		<input class='aa' name='item_order[]' value='$item_order' size='6' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; WIDTH: 50%'></span>
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
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="적용">
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
        		<input class="aa" onclick="window.location.href='item_list.php?category_num=<?=$category_num?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="상품리스트로">
        	</td>
      	</tr>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</form>
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
if($flag == "update"){
	for($i=0; $i<count($item_info); $i++) {
		
		$item_infos = explode("!", $item_info[$i]);
		$item_no = $item_infos[0];
		$mart_id = $item_infos[1];
		
		//if($Mall_Admin_ID == $mart_id)
			$SQL = "update $ItemTable set item_order = '$item_order[$i]' where item_no='$item_no' and mart_id='$mart_id'";
		//else
		//	$SQL = "update $Gnt_ItemTable set item_order = '$item_order[$i]' where item_no='$item_no' and seller_id = '$Mall_Admin_ID'";
		//echo "sql=$SQL <br>";
		$dbresult = mysql_query($SQL, $dbconn);
	}		

	echo "<meta http-equiv='refresh' content='0; URL=item_order.php?category_num=$category_num'>";
}
?>
<?
mysql_close($dbconn);
?>