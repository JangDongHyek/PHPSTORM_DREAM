<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == "") {
	include "../admin_head.php";
?>
<script language="JavaScript">
<!-- 
function OpenWindow() {
RemindWindow = window.open( "", "mainpage","toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no" 
);
}
// -->
</script>
<script>
function checkform(f){
	if(f.searchword.value==''){
		alert("�˻�� �Է��ϼ���.");
		f.searchword.focus();
		return false;
	}
	else return true;
}
function update(f){
	f.flag.value='diff';
	
	var Digit = '1234567890'
	var Digit1 = '1234567890.'
		if (f.amount.value==""){
			alert("����� �Է��ϼ���");
			f.amount.focus();
			return false;
		}
		else{
			var len =f.amount.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
			  var ch = f.amount.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("���ڸ� �Է� �ϼ���");
						f.amount.focus();
						return false;
				}
				ret = false;
			}	
		}
		return true;
}
</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "3";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>��ü��ǰ������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					  <td vAlign="top" width="90%" bgColor="#ffffff"><strong>[��ü��ǰ ������]</strong>��ϵǾ��� 
					  ��ǰ �� ī�װ��� ������ǰ �� ���ϴ� ��ǰ�� �˻��Ͽ� �����Ͻ� 
					  �� �ֽ��ϴ�.<br>
					  �˻����ȭ�鿡�� ���, ������ ��뿩�δ� �ٷ� �����Ͻ� �� 
					  ������,<br>
					  ��ǰ���� Ŭ���Ͻø� �ش� ��ǰ�� �����Ͻ� �� �ֽ��ϴ�.<br>
					  �˻��� ��ü��ǰ�� ���� ����������ϽǷ���, 
					  �ϴ��� ����/���� ������ �̿��Ͽ��ּ���.<br>
					  </td>
					</tr>
					<tr>
					  <td><table border="0" width="100%">
						 <tr>
							<td width="50%"></td>
							<td width="50%"><div align="right"><table border="0" width="200" cellspacing="0"
							cellpadding="0">
							  <tr>
								 <td width="100%" bgcolor="#D5D5D5">
								 <table border="0" width="100%" cellspacing="1" cellpadding="2">
								 
<form action='item_find_jaego.php' method='post'>
<input type='hidden' name='page' value='<?echo $page?>'>
<input type='hidden' name='keyset' value='<?echo $keyset?>'>
<input type='hidden' name='searchword' value='<?echo $searchword?>'>
<input type='hidden' name='order' value='<?echo $order?>'>
								<?
								if ($cnfPagecount == "") $cnfPagecount = 10;
								?>
									<tr>
									  <td width="100%" bgcolor="#F6F6F6"><p align="center">�������� 
									  ��°���&nbsp; 
									  <select name="cnfPagecount" onchange='this.form.submit()' style="BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; HEIGHT: 18px" size="1">
										 <option value="10"
										 <?
										 if($cnfPagecount == 10) echo " selected";
										 ?>
										 >10</option>
										 <option value="50"
										 <?
										 if($cnfPagecount == 50) echo " selected";
										 ?>
										 >50</option>
										 <option value="100"
										 <?
										 if($cnfPagecount == 100) echo " selected";
										 ?>
										 >100</option>
									  </select></td>
									</tr>
								  </form> 
								 </table>
								 
								 </td>
							  </tr>
							</table>
							</div></td>
						 </tr>
					  </table>
					  </td>
					</tr>
					<tr>
					  <td></td>
					</tr>
					<tr>
					  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="left">
					  <table width="100%" border="0">
						 <tr>
							<td width="100%" bgColor="#cccccc">
							<table cellSpacing="0" cellPadding="0" width="100%" border="0">
							  <tr>
								 <td width="100%" bgColor="#f7f7f7" height="30">
								 <table border="0" width="103%" cellspacing="0" cellpadding="0">
									
									<form method='post' name='search' onsubmit='return checkform(this)'>
									<input type='hidden' name='keyset' value='category_num'>
									<input type='hidden' name='page' value='1'>
									<input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
									
									<tr>
									  <td width="18%" height="25">&nbsp; ī�װ��� �˻�</td>
									  <td width="33%" height="25">
									  <select name='searchword' size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
<?
$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno=0 and if_hide='0' order by cat_order desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$category_num = $ary["category_num"];
	$category_name = $ary["category_name"];
	
	$SQL = "select * from $CategoryTable where mart_id='$mart_id' and prevno=$category_num and if_hide='0' order by cat_order desc";
	$dbresult2 = mysql_query($SQL, $dbconn);
	$numRows1 = mysql_num_rows($dbresult2);
	
	echo ("
	<option value='$category_num'");
	if($searchword == $category_num){
		echo "selected";
		$cur_category_name = $category_name;
	}
	echo (">��$category_name</option>
	");
				
	for($j=0;$j<$numRows1;$j++){
		mysql_data_seek($dbresult2,$j);
		$ary1 = mysql_fetch_array($dbresult2);
		$category_num1 = $ary1["category_num"];
		$category_name1 = $ary1["category_name"];

		$SQL3 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num1' order by cat_order desc";
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);

		echo ("
			<option value='$category_num1'
			");
			if($searchword == $category_num1){
				echo "selected";
				$cur_category_name = $category_name1;
			}
		echo ("> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>
		");

		for($k=0;$k<$numRows3;$k++){
			$category_num3 = mysql_result($dbresult3,$k,0);
			$category_name3 = mysql_result($dbresult3,$k,1);

			echo ("
						<option value='$category_num3'
			");	
			if($searchword == $category_num3){
				echo "selected";
				$cur_category_name = $category_name3;
			}
			echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>");

			$SQL4 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num3' order by cat_order desc";
			$dbresult4 = mysql_query($SQL4, $dbconn);
			$numRows4 = mysql_num_rows($dbresult4);
			for($l=0;$l<$numRows4;$l++){
				$category_num4 = mysql_result($dbresult4,$l,0);
				$category_name4 = mysql_result($dbresult4,$l,1);
				echo ("
						<option value='$category_num4'
				");	
				if($tmp_category_num == $category_num4){
					echo "selected";
					$cur_category_name = $category_name4;
				}
				echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name4</option>");
			}
		}
	}
}
?>
													</select>
									  </td>
									  <td width="13%" height="25"><p align="center">���ļ���</td>
									  <td width="18%" height="25">
									  <select name='order' size="1" style="height: 18px; border: 1px solid black">
											<option value="item_name"
											<?
											if($keyset=='category_num'&& $order == 'item_name') echo " selected";
											?>
											>��ǰ��</option>
											<option value="item_company"
											<?
											if($keyset=='category_num'&& $order == 'item_company') echo " selected";
											?>
											>�������</option>
											<option value="z_price"
											<?
											if($keyset=='category_num'&& $order == 'z_price') echo " selected";
											?>
											>���ݼ�</option>
											<option value="reg_date"
											<?
											if($keyset=='category_num'&& $order == 'reg_date') echo " selected";
											?>
											>��ϼ�</option>
											</select>
											</td>
									  <td width="21%" height="25">
									  <input style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="�˻�"></td>
									</tr>
									</form>
									<tr>
									  <td width="18%" height="3"></td>
									  <td width="33%" height="3"></td>
									  <td width="13%" height="3"></td>
									  <td width="18%" height="3"></td>
									  <td width="21%" height="3"></td>
									</tr>
									<form method='post' name='search' onsubmit='return checkform(this)'>
										<input type='hidden' name='keyset' value='item_name'>
										<input type='hidden' name='page' value='1'>
										<input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
										<tr>
									  <td width="18%" height="25">&nbsp; ��ǰ�� �˻�</td>
									  <td width="33%" height="25">
									  <input name="searchword" value='<?if($keyset=='item_name') echo $searchword?>' class='input_03' size="30"></td>
									  <td width="13%" height="25"><p align="center">���ļ���</td>
									  <td width="18%" height="25">
									  <select name='order' size="1" style="height: 18px; border: 1px solid black">
											<option value="item_name"
											<?
											if($keyset=='item_name'&& $order == 'item_name') echo " selected";
											?>
											>��ǰ��</option>
											<option value="item_company"
											<?
											if($keyset=='item_name'&& $order == 'item_company') echo " selected";
											?>
											>�������</option>
											<option value="z_price"
											<?
											if($keyset=='item_name'&& $order == 'z_price') echo " selected";
											?>
											>���ݼ�</option>
											<option value="reg_date"
											<?
											if($keyset=='item_name'&& $order == 'reg_date') echo " selected";
											?>
											>��ϼ�</option>
									  </select></td>
									  <td width="21%" height="25">
									  <input style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="�˻�"></td>
									</tr>
									</form>
								 </table>
								 </td>
							  </tr>
							</table>
							</td>
						 </tr>
						 <tr>
							<td width="91%" bgColor="#ffffff"></td>
						 </tr>
						 <tr>
							<td width="100%" bgColor="#cccccc">
							<table cellSpacing="1" cellPadding="3" width="100%" bgColor="#f7f7f7" border="0">
							  <tr>
								 <td align="middle" width="5%" bgColor="#FCB663" height="25">
								 <b><font color="#ffffff">No</font></b></td>
								 <td align="middle" width="40%" bgColor="#FCB663" height="25">
								 <b><font color="#ffffff">��ǰ��</font></b></td>
								 <td align="middle" width="15%" bgColor="#FCB663" height="25">
								 <b><font color="#ffffff">���</font></b></td>
								 <td align="middle" width="10%" bgColor="#FCB663" height="25">
								 <b><font color="#ffffff">��뿩��</font></b></td>
							  </tr>
							  
							  <form action='item_find_jaego.php' method='post'>
							  <input type='hidden' name='flag' value='update'>
							  <input type='hidden' name='page' value='<?echo $page?>'>
							  <input type='hidden' name='keyset' value='<?echo $keyset?>'>
							  <input type='hidden' name='searchword' value='<?echo $searchword?>'>
							  <input type='hidden' name='order' value='<?echo $order?>'>
							  <input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
							  <?
							    $searchword = trim($searchword);
								if(!empty($keyset)&&!empty($searchword)){
									if($keyset == 'item_name')
									{
										$SQL = "select mart_id, item_no, item_name, item_company, z_price, reg_date, jaego, jaego_use
											from $ItemTable 
										where mart_id='$mart_id' and binary lower($keyset) like lower('%$searchword%') 
											order by $order Asc";
									}
									if($keyset == 'category_num')
									{
										$SQL = "select category_degree from $CategoryTable where category_num='$searchword' and mart_id='$mart_id'";
										$dbresult = mysql_query($SQL, $dbconn);
										$cate_degree = mysql_result($dbresult,0,0);

										if($cate_degree==0)
											$where = "firstno";
										elseif($cate_degree==1)
											$where = "prevno";
										elseif($cate_degree==2)
											$where = "thirdno";
										else
											$where = "category_num";


										$SQL = "select mart_id, item_no, item_name, item_company, z_price, reg_date, jaego, jaego_use 
											from $ItemTable 
										where mart_id='$mart_id' and $where= '$searchword' 
											order by $order Asc";
									}												
									//echo "sql=$SQL";
									$dbresult = mysql_query($SQL, $dbconn);
									$numRows = mysql_num_rows($dbresult);
								//echo "numRows=$numRows";
								
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
									
											for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
												if ($i >= $numRows) break;
												
												$mart_id_tmp = mysql_result($dbresult,$i,0);
												$item_no = mysql_result($dbresult,$i,1);
												$item_name = mysql_result($dbresult,$i,2);
												$z_price = mysql_result($dbresult,$i,4);
												$jaego = mysql_result($dbresult,$i,6);
												$jaego_use = mysql_result($dbresult,$i,7);
												
												$j = $numRows - $i;
												if($i%2==0) $bgcolor='#EFEFEF';
												else $bgcolor='#FFFFFF';
												echo "					
							  <input type='hidden' name='item_no[]' value='$item_no'>
							  <tr>
								 <td align='center' width='5%' bgcolor='$bgcolor'>$j</td>
								 <td align='middle' width='65%' bgcolor='$bgcolor'><p align='left'>
									";
									
										echo "
								 <a href='item_edit_old.php?item_no=$item_no&category_num=$category_num' onfocus='this.blur()' target='mainpage' onclick='OpenWindow()'>
										";
									
									echo "
								 $item_name</a></td>
									<td align='middle' width='15%' bgcolor='$bgcolor'>
									";
									
										echo "
								 <input name='jaego[]' value='$jaego' class='input_03' size='10'>
										";
									echo "
									</td>
								 <td align='middle' width='15%' bgcolor='$bgcolor'>
									";
									
										echo "	
								 <select name='jaego_use[]'  style='BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; HEIGHT: 18px' size='1'>
								 <option value='1'
										";
										if($jaego_use == '1') echo " selected";
										echo ">Yes</option>
								 <option value='0'
										";
										if($jaego_use == '0') echo " selected";
										echo "
									>No</option>
								 </select>
										";

									echo "
								 </td>
							  </tr>
									";
								}
							  }	
							  ?>
							  </table>
							</td>
						 </tr>
						 <tr>
							<td width="91%" bgColor="#ffffff"><p align="right"><br>
									<?
								if($page == 1){
									echo ("
									ó��
									");
								}
								else{
									echo ("
									<a href='item_find_jaego.php?page=1&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>ó��</a> 
									");
								}
							
								if($start_page > 1){
									echo ("
									<a href='item_find_jaego.php?page=$prev_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>
									��&nbsp; 
									</a>
									");
								}
								else{
									echo ("
									��&nbsp; 
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
									<a href='item_find_jaego.php?page=$i&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>$i</a> 	
										");
									}
								}
								if($end_page < $total_page){
									echo ("
									<a href='item_find_jaego.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>
									&nbsp;��
									</a>
									");
								}
								else{
									echo ("
									&nbsp;��
									");
								}
								if($page == $total_page){
									echo ("
									��
									");
								}
								else{
									echo ("
									<a href='item_find_jaego.php?page=$total_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>��</a> 
									");
								}
								?></td>
						 </tr>
						 <tr>
							<td width="91%" bgColor="#ffffff" align="center">
							<input style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="�����ϱ�"></td>
						 </tr>
						 
						 <tr>
							<td width="100%" bgColor="#cccccc">
							<table cellSpacing="1" cellPadding="3" width="100%" bgColor="#f7f7f7" border="0">
							  <tr>
								 <td align="middle" width="100%" bgColor="#FCB663" height="25"><p align="left">
								 <b><font color="#ffffff">��� �����ϱ�</font></b>
								 (������������ ��µ� ��ǰ�� ���ؼ��� �����˴ϴ�.)</td>
							  </tr>
							  <tr>
								 <td align="center" width="100%" bgcolor="#EFEFEF"><p align="left">
								 ����� 
								 <select size="1" name="p_m">
									<option value="+" selected>+</option>
									<option value="-">-</option>
								 </select> 
								 
								 <input name="amount" class="input_03" size="16">
								 �� ��ŭ 
								 <input onclick='return update(this.form)' style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="����">�մϴ�.</td>
							  </tr>
							</table>
							</td>
						 </tr>
						</form>
					  </table>
					  </div></td>
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
}
if($flag == 'update'){
	for($i=0; $i<count($item_no); $i++) {
		
		$SQL = "select mart_id from $ItemTable where item_no = $item_no[$i]";

		$dbresult = mysql_query($SQL, $dbconn);
		$mart_id_tmp = mysql_result($dbresult,0,0);
		
			$SQL = "update $ItemTable set jaego='$jaego[$i]', jaego_use='$jaego_use[$i]'
			where item_no = $item_no[$i] and mart_id='$mart_id'";
		

 		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=item_find_jaego.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>";
}
if($flag == 'diff'){
	for($i=0; $i<count($item_no); $i++) {
		
		$SQL0 = "select mart_id from $ItemTable where item_no = $item_no[$i]";
		//echo "sql=$SQL";
		$dbresult0 = mysql_query($SQL0, $dbconn);
		$mart_id_tmp = mysql_result($dbresult0,0,0);
		
		
			$SQL = "update $ItemTable set jaego = jaego $p_m $amount where item_no = $item_no[$i] and mart_id='$mart_id'";
		

 		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=item_find_jaego.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&order=$order&cnfPagecount=$cnfPagecount'>";
}
?>
<?
mysql_close($dbconn);
?>