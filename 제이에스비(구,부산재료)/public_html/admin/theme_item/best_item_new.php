<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''||$flag=='search') {
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<script>
function goto_byselect(sel, targetstr){
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
function checkform(f){
	if(f.searchword.value==''){
		alert("�˻�� �Է��ϼ���.");
		f.searchword.focus();
		return false;
	}
	else return true;
}
function toggle(val){
	dl = document.list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'checkSel[]')
        dl.elements[i].checked = val;
    }
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�׸���ǰ����</b></td>
				</tr>
			</table>

			<!--���� START~~-->
<br>

    	<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top">
        		<strong><span class="cc">[����Ʈ��ǰ ���]</span></strong> ��ϵǾ��� ��ǰ �� ����Ʈ��ǰ���� ����մϴ�.<br>����� ����Ʈ��ǰ�� <strong>ī�װ� ��ǰ����Ʈ�� ����Ʈ���꺣��Ʈ</strong>��  ��µ˴ϴ�<br>
					</td>
     		</tr>     		
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<div align="left">
        		<table border="0" width="100%">
          		<tr>
            		<td width="91%" bgcolor="#FFFFFF">
            			<span class="bb">�˻�â�� ���Ͽ� �˻��Ͻ� �� ����ϼ���.</span></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#CCCCCC">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#F7F7F7" height="30">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				
                  				<form method='post' name='search' onsubmit='return checkform(this)'>
              					<input type='hidden' name='flag' value='search'>
              					<input type='hidden' name='keyset' value='item_name'>
              					
              					<tr>
                    				<td width="18%" height="25"><span class="bb">&nbsp; ��ǰ�� �˻�</span></td>
                    				<td width="30%" height="25"><span class="bb">
                    					<input class="aa" name="searchword" style="width:85%;BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid;  BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid" size="20"></span></td>
                    				<td width="13%" height="25"><p align="left"><span class="bb">���ļ���</span></td>
                    				<td width="20%" height="25">
                    					<span class="bb">
                    					<select class="bb" name='order' size="1" style="height: 18px; border: 1px solid black">
                      					<option value="item_name">��ǰ��</option>
                      					<option value="item_company">�������</option>
                      					<option value="z_price">���ݼ�</option>
                      					<option value="reg_date">��ϼ�</option>
                    					</select></span></td>
                    				<td width="19%" height="25"><span class="bb">
                    					<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid; BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; COLOR: #929292; HEIGHT: 18px" type="submit" value="�˻�"></span></td>
                  				</tr>
                  				</form>
                  				<form method='post' name='search' onsubmit='return checkform(this)'>
              					<input type='hidden' name='flag' value='search'>
              					<input type='hidden' name='keyset' value='item_company'>
              					<tr>
                    				<td width="18%" height="25"><span class="bb">&nbsp; �����纰 �˻�</span></td>
                    				<td width="30%" height="25"><span class="bb">
                    					<input class="aa" name="searchword" style="width:85%;BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid;  BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid" size="20"></span></td>
                    				<td width="13%" height="25"><span class="bb">���ļ���</span></td>
                    				<td width="20%" height="25"><span class="bb">
                    					<select class="bb" name='order' size="1" style="height: 18px; border: 1px solid black">
                      					<option value="item_name">��ǰ��</option>
                      					<option value="item_company">�������</option>
                      					<option value="z_price">���ݼ�</option>
                      					<option value="reg_date">��ϼ�</option>
                    					</select></span></td>
                    				<td width="19%" height="25"><span class="bb">
                    					<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid; BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; COLOR: #929292; HEIGHT: 18px" type="submit" value="�˻�"></span></td>
                  				</tr>
                  				</form>
                  				<form method='post' name='search' onsubmit='return checkform(this)'>
              					<input type='hidden' name='flag' value='search'>
              					<input type='hidden' name='keyset' value='category_num'>
              					<tr>
                    				<td width="18%" height="25"><span class="bb">&nbsp; ī�װ��� �˻�</span></td>
                    				<td width="30%" height="25"><span class="bb">
										<select name="searchword" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
										<?=Make_select_category($mart_id, "37")?>
										</select>
							</span></td>
                    				<td width="13%" height="25"><span class="bb">���ļ���</span></td>
                    				<td width="20%" height="25"><span class="bb">
                    					<select class="bb" name='order' size="1" style="height: 18px; border: 1px solid black">
                      					<option value="item_name">��ǰ��</option>
                      					<option value="item_company">�������</option>
                      					<option value="z_price">���ݼ�</option>
                      					<option value="reg_date">��ϼ�</option>
                    					</select></span></td>
                    				<td width="19%" height="25"><span class="bb">
                    					<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid; BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; COLOR: #929292; HEIGHT: 18px" type="submit" value="�˻�"></span></td>
                  				</tr>
                  				</form>
                  				</table>
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
          		<tr>
            		<td width="91%" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#CCCCCC">
            			<table border="0" width="100%" bgcolor="#F7F7F7" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#FE9725" align="center" colspan="6" height="25">
                				<b><font color="#FFFFFF"><p align="left">�˻����</font></b></td>
              			</tr>
              			<tr>
                			<td width="7%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">����</font></b></span></td>
                			<td width="7%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">��ȣ</font></b></span></td>
                			<td width="35%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">��ǰ��</font></b></span></td>
                			<td width="8%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">����</font></b></span></td>
                			<td width="7%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">��ȣ</font></b></span></td>
                			<td width="38%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">��ǰ��</font></b></span></td>
              			</tr>
              			<tr>
              			
										<form action='best_item_new.php' method='post' name='list'>
										<input type='hidden' name='flag' value='to_best_item'>
										<input type='hidden' name='keyset' value='<?=$keyset?>'>
<?
              			if($flag == 'search'){
              				if($keyset != 'category_num'){
          							$SQL = "select item_no, item_name, item_company, z_price, reg_date 
															from $ItemTable T1,$CategoryTable T2 
															where T1.mart_id='$mart_id' and T1.if_hide='0' and T1.category_num=T2.category_num and T2.if_hide='0'
															and T1.$keyset like '%$searchword%' 
															UNION 
															select T1.item_no, T1.item_name, T1.item_company, T1.z_price, T1.reg_date 
															from $ItemTable T1, $Gnt_ItemTable T2 
															where T2.seller_id='$Mall_Admin_ID' and T1.item_no= T2.item_no and T1.$keyset like '%$searchword%' order by $order Asc
														";
											}else if($keyset == 'category_num'){
											$cate_SQL = "select category_degree from $CategoryTable where category_num = $searchword";

									$cate_dbresult = mysql_query($cate_SQL, $dbconn);
									$cate_row = mysql_fetch_array($cate_dbresult);
									$category_degree = $cate_row[category_degree];

									if($category_degree == 0)
										$item_keyset = "firstno";
									elseif($category_degree == 1)
										$item_keyset = "prevno";
									elseif($category_degree == 2)
										$item_keyset = "thirdno";
									else
										$item_keyset = "category_num";

          				$SQL = "select T1.mart_id, item_no, item_name, z_price, item_company, reg_date 
												from $ItemTable T1,$CategoryTable T2 
												where T1.if_hide='0' and T1.category_num=T2.category_num and T2.if_hide='0'
												and T1.$item_keyset ='$searchword' 
												UNION 
												select T1.mart_id, T1.item_no, T1.item_name, T1.z_price, T1.item_company, T1.reg_date 
												from $ItemTable T1, $Gnt_ItemTable T2 
												where T2.seller_id = '$Mall_Admin_ID' and T1.item_no = T2.item_no and T2.$keyset ='$searchword'
												order by $order Asc
											";
          						}
          					$dbresult = mysql_query($SQL, $dbconn);
										$numRows = mysql_num_rows($dbresult);


										
										if($numRows == 0){
											echo ("
											<td width='100%' height='5' align='center' colspan='6'>
            					<span class='bb'>�˻��� ��ǰ�� �����ϴ�.</span></td>
            					");
            				}
										else{
											for ($i=0; $i<$numRows; $i++) {
												mysql_data_seek($dbresult, $i);
												$ary = mysql_fetch_array($dbresult);
												$mart_id_tmp = $ary[mart_id];
												$item_no = $ary[item_no];
												$item_name = $ary[item_name];
												
												if($keyset == 'category_num'){
													$SQL1= "select * from $CategoryTable where mart_id='$mart_id' and $keyset ='$searchword'";
													$dbresult1 = mysql_query($SQL1, $dbconn);
													$numRows1 = mysql_num_rows($dbresult1);
													if($numRows1 > 0) $provider_id = "";
													else $provider_id = $mart_id_tmp;	
												}
									
												$j =  $i + 1;
	          						if($i % 4 == 0 || $i % 4 == 1)
	          							$bgcolor = '';
	          						else $bgcolor = '#FFFFFF'; 	  
	          						echo ("
          					<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
          						<input name='checkSel[]' type='checkbox' value='$item_no#$provider_id#$item_name'>
          						</td>
            				<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
            					<span class='bb'>$j</span></td>
            				<td width='38%' height='10' bgcolor='$bgcolor'>
            					<span class='bb'>$item_name</span></td>
            						");
	            					if($i % 2 == 1)
	            						echo ("</tr><tr>");
	            				
	            					if($i + 1 == $numRows && $i % 2 == 0){
	            						echo ("
	            			<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
          						</td>
            				<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
            					</td>
            				<td width='38%' height='10' bgcolor='$bgcolor'>
            					</td>
            							");
	            					}
	            				}
            				}
          				}
          				if($flag == 'search' && $keyset != 'category_num'){
              			?>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FE9725" align="center" colspan="6" height="25">
                				<span class="bb"><b><font color="#FFFFFF"><p align="left">�˻����(gnt)</font></b></span></td>
              			</tr>
              			<tr>
                			<td width="7%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">����</font></b></span></td>
                			<td width="7%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">��ȣ</font></b></span></td>
                			<td width="35%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">��ǰ��</font></b></span></td>
                			<td width="8%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">����</font></b></span></td>
                			<td width="7%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">��ȣ</font></b></span></td>
                			<td width="38%" bgcolor="#FCB663" align="center">
                				<span class="bb"><b><font color="#FFFFFF">��ǰ��</font></b></span></td>
              			</tr>
              			<tr>
              			<?
              				// �ְ� �ޱ� ��ǰ ��ü �������ϱ�
		            		$total = 0;
		            		$SQL = "select * from $GiveNTakeTable where seller_id = '$Mall_Admin_ID' and state1='2' order by gnt_no desc";
										$dbresult = mysql_query($SQL, $dbconn);
										$numRows = mysql_num_rows($dbresult);
										for ($i=0; $i<$numRows; $i++) {
											mysql_data_seek($dbresult,$i);
											$ary = mysql_fetch_array($dbresult);
											$category_num = $ary[category_num];
										
											$SQL1 = "select * from $ItemTable where (category_num = $category_num or prevno = $category_num) and $keyset like '%$searchword%' order by $order Asc";
											$dbresult1 = mysql_query($SQL1, $dbconn);
											$numRows1 = mysql_num_rows($dbresult1);
											for ($j=0; $j<$numRows1; $j++) {
												mysql_data_seek($dbresult1,$j);
												$ary1 = mysql_fetch_array($dbresult1);
												$item_no = $ary1[item_no];
												$total++;
											}
										}
										
										$k = 0;
              				// �ְ� �ޱ� ��ǰ ������ ����
		            		$SQL = "select * from $GiveNTakeTable where seller_id = '$Mall_Admin_ID' and state1='2' order by gnt_no desc";
										$dbresult = mysql_query($SQL, $dbconn);
										$numRows = mysql_num_rows($dbresult);
										for ($i=0; $i<$numRows; $i++) {
											mysql_data_seek($dbresult,$i);
											$ary = mysql_fetch_array($dbresult);
											$category_num = $ary[category_num];
										
											$SQL1 = "select * from $ItemTable where (category_num = $category_num or prevno = $category_num) and $keyset like '%$searchword%' order by $order Asc";
											//echo "sql1=$SQL1";
											$dbresult1 = mysql_query($SQL1, $dbconn);
											$numRows1 = mysql_num_rows($dbresult1);
											for ($j=0; $j<$numRows1; $j++) {
												mysql_data_seek($dbresult1,$j);
												$ary1 = mysql_fetch_array($dbresult1);
												$item_no = $ary1[item_no];
												$provider_id = $ary1[mart_id];
												$item_name = $ary1[item_name];
												if($k % 4 == 0 || $k % 4 == 1)
	          							$bgcolor = '';
	          						else $bgcolor = '#FFFFFF'; 	  
	          						echo ("
										<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
          						<input name='checkSel[]' type='checkbox' value='$item_no#$provider_id#$item_name'>
          					</td>
            				<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
            					<span class='bb'>$l</span></td>
            				<td width='38%' height='10' bgcolor='$bgcolor'>
            					<span class='bb'>$item_name</span></td>
            					");
	            					if($k + 1 == $total && $k % 2 == 0){
	            						echo ("
	            			<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
          						</td>
            				<td width='6%' height='10' bgcolor='$bgcolor' align='center'>
            					</td>
            				<td width='38%' height='10' bgcolor='$bgcolor'>
            					</td>
            							");
	            					}
	            					if($k % 2 == 1)
	            						echo ("</tr><tr>");
	            					$k++;
											}
            				}
            			}
									?>
              			</tr>
              			</table>
            		</td>
          		</tr>
          		
          		<tr>
            		<td width="100%">
            			<table border="0" width="100%" cellspacing="0" cellpadding="0">
              			<tr>
                			<td width="100%" bgcolor="#7BBEBD">
                				<table border="0" width="100%" cellspacing="1" cellpadding="3">
                  				<tr>
                    				<td width="100%" bgcolor="#E9F5F5" height="30">
                    					
                    					<table border="0" width="100%">
                      					<tr>
                        					<td width="100%">
                        						<input class="aa" onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��ü����"><strong><span class="ee"> </span></strong>
                        						<input class="aa" onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="��������">&nbsp;<span class="bb"><font color="#3D918A">�Ͽ� 
                        						&nbsp;����Ʈ��ǰ���� </font></span>
                        						<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="submit" value="���"></td>
                      					</tr>
                    					</form>
                    					</table>
                    				</td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%"></td>
              			</tr>
            			</table>
            		</td>
          		</tr>
          		<tr>
            		<td width="1%" bgcolor="#FFFFFF"></td>
          		</tr>
        		</table>
        		</div>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<p align="center"><br>
        		<input class="aa" onclick="window.location.href='theme_item.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��"> </td>
      	</tr>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>
			<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
}
if($flag == "to_best_item"){
	for($i=0; $i<count($checkSel); $i++) {
		$check_values = explode("#", $checkSel[$i]);
		$item_no = $check_values[0];
		$provider_id = $check_values[1];
		$item_name = $check_values[2];

		$sql0 = "select firstno, prevno, thirdno, category_num from $ItemTable where item_no='$item_no'";
		$res0 = mysql_query($sql0, $dbconn);
		$row0 = mysql_fetch_array( $res0 );
		$firstno = $row0[firstno];
		$prevno = $row0[prevno];
		$thirdno = $row0[thirdno];
		$category_num = $row0[category_num];

		//1�� ī�װ�
		//$sql1 = "select prevno from $CategoryTable where category_num='$prevno'";
		//$res1 = mysql_query($sql1, $dbconn);
		//$row1 = mysql_fetch_array( $res1 );
		//$firstno = $row1[prevno];

		$SQL = "select count(*) from $Best_ItemTable where mart_id='$mart_id' and item_no = $item_no";
		$dbresult = mysql_query($SQL, $dbconn);

		if ($dbresult == false) echo "���� ���� ����!";

		if (mysql_result($dbresult,0,0) > 0){
			echo ("
			<script language='javascript'>
				alert('$item_name �� �̹� ����Ͻ� ��ǰ�Դϴ�.');
			</script>
			");
			continue;
		} 
		
		$SQL = "select max(best_item_order), count(*) from $Best_ItemTable";
		$dbresult = mysql_query($SQL, $dbconn);

		if ($dbresult == false) echo "���� ���� ����!";

		if (mysql_result($dbresult,0,1) > 0) 
			$maxBest_Item_order = mysql_result($dbresult, 0, 0);
		else
			$maxBest_Item_order = 0;
		
		$maxBest_Item_order = $maxBest_Item_order + 1;
		
		$SQL = "insert into $Best_ItemTable (item_no, firstno, prevno, thirdno, category_num, mart_id, provider_id, best_item_order) values ( '$item_no', '$firstno', '$prevno', '$thirdno', '$category_num', '$mart_id', '$provider_id', $maxBest_Item_order)";
		//$SQL = "insert into $Best_ItemTable (item_no, mart_id, provider_id, best_item_order) values ( '$item_no', '$mart_id', '$provider_id', $maxBest_Item_order)";
		$dbresult = mysql_query($SQL, $dbconn);
		if ($dbresult == false) echo "���� ���� ����!";
	}

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
?>
<?
mysql_close($dbconn);
?>