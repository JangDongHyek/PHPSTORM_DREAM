<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''){
	include "../admin_head.php";
?>


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
							<td width="90%" bgcolor="#ffffff">
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#a7a7a7" align="center">
<!---------------------------- ��Ʈ��ǰ ���� ���� ------------------------------->
									<tr>
										<td width="53%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td width="50%"><b>��Ʈ��ǰ ����</b></td>
													<td width="50%" align="right"><input onclick="window.location.href='fav_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="��Ʈ��ǰ ���"></td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= ��Ʈ��ǰ ���� ============================================
$sql2 = "select * from $Fav_ItemTable where mart_id='$mart_id' order by fav_item_order desc";
$res2 = mysql_query($sql2, $dbconn);
$tot2 = mysql_num_rows($res2);
?>
									<tr>
										<td width="53%" bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot2?>���� ��Ʈ��ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">��ȣ</td>
										<td width="10%">����</td>
										<td width="70%" colspan='2'>��ǰ��</td>
										<td width="10%">����</td>
									</tr>
<?
for ($i=0; $i < $tot2; $i++){
	mysql_data_seek($res2, $i);
	$ary2 = mysql_fetch_array($res2);

	$fav_item_no = $ary2[fav_item_no];
	$item_no = $ary2[item_no];
	$provider_id = $ary2[provider_id];
	$fav_item_order = $ary2[fav_item_order];
	$fav_main =  $ary2[fav_main];

	if( $fav_main == 'y' ){
		$fav_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=fav&target=main&fav_item_no=$fav_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$fav_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=fav&target=list&fav_item_no=$fav_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
	}
			
	$sql3 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no=$item_no";
	$res3 = mysql_query($sql3, $dbconn);
	$tot3 = mysql_num_rows($res3);
	if($tot3 > 0){
		$item_name = mysql_result($res3, 0, 0);
		$price = mysql_result($res3, 0, 1);
		$mart_id = mysql_result($res3, 0, 2);
		$firstno = mysql_result($res3, 0, 3);
		$prevno = mysql_result($res3, 0, 4);
		$category_num = mysql_result($res3, 0, 5);

		//================== 3�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql3 = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id'";
		$cate_res3 = mysql_query($cate_sql3, $dbconn);
		$cate_row3 = mysql_fetch_array( $cate_res3 );
		$category_name3 = $cate_row3[category_name];

		//================== 2�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql2 = "select * from $CategoryTable where category_num='$prevno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res2 = mysql_query($cate_sql2, $dbconn);
		$cate_row2 = mysql_fetch_array( $cate_res2 );
		$category_name2 = $cate_row2[category_name];

		//================== 1�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql1 = "select * from $CategoryTable where category_num='$firstno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res1 = mysql_query($cate_sql1, $dbconn);
		$cate_row1 = mysql_fetch_array( $cate_res1 );
		$category_name1 = $cate_row1[category_name];

		if($Mall_Admin_ID != $mart_id)
			$gnt_str = "<img src='../images/gnt.gif' height='12' width='25'>";
		else
			$gnt_str = "";
			$j = $i + 1;
	}else{
		$item_name = "��ǰ�� �����Ǿ����ϴ�.";
	}

	if($i < $tot2 - 1){
		$down_str = "<a href='theme_item.php?fav_item_no=$fav_item_no&fav_item_order=$fav_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?fav_item_no=$fav_item_no&fav_item_order=$fav_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	
	if($provider_id == ""&&$mart_id == $Mall_Admin_ID){
?>								
									<tr>
										<td bgcolor='#FFFFFF' align='center'><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>
										<td align='left' colspan='2'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a href="javascript:window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=fav&fav_item_no=<?=$fav_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}else if($provider_id == "gnt_item"){
?>
									<tr>
										<td><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>	
										<td align='left' colspan='2'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a href='../good/item_view_gnt_item.php?gnt_item_no=<?=$gnt_item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=fav&fav_item_no=<?=$fav_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}else {
?>
									<tr>
										<td><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>	
										<td align='left' colspan='2'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a href='../good/item_view_gnt.php?item_no=<?=$item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=fav&fav_item_no=<?=$fav_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}
}
?>
<!---------------------------- ��Ʈ��ǰ ���� �� --------------------------------->

<!---------------------------- ����Ʈ��ǰ ���� ���� ------------------------------------->
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="5">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>����Ʈ��ǰ ����</b></td>
												<td width="50%"><p align="right">
													<input onclick="window.location.href='best_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��ǰ ���">
												</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= ����Ʈ��ǰ ���� ==========================================
$sql6 = "select * from $Best_ItemTable where mart_id='$mart_id' order by best_item_order desc";
$res6 = mysql_query($sql6, $dbconn);
$tot6 = mysql_num_rows($res6);
?>
									<tr>
										<td bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot6?>���� ����Ʈ��ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">��ȣ</td>
										<td width="10%">����</td>
										<td width="60%">��ǰ��</td>
										<td width="10%">���λ�ǰ</td>
										<td width="10%">����</td>
									</tr>
<?
for($i=0; $i < $tot6; $i++){
	mysql_data_seek($res6, $i);
	$ary6 = mysql_fetch_array($res6);

	$best_item_no = $ary6[best_item_no];
	$item_no = $ary6[item_no];
	$provider_id = $ary6[provider_id];
	$best_item_order = $ary6[best_item_order];
	$best_main =  $ary6[best_main];

	if( $best_main == 'y' ){
		$best_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=best&target=main&best_item_no=$best_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$best_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=best&target=list&best_item_no=$best_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
	}
	$sql7 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no='$item_no'";
	$res7 = mysql_query($sql7, $dbconn);
	$tot7 = mysql_num_rows($res7);
	if($tot7 > 0){
		$item_name = mysql_result($res7, 0, 0);
		$price = mysql_result($res7, 0, 1);
		$mart_id = mysql_result($res7, 0, 2);
		$firstno = mysql_result($res7, 0, 3);
		$prevno = mysql_result($res7, 0, 4);
		$category_num = mysql_result($res7, 0, 5);

		//================== 3�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql3 = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id'";
		$cate_res3 = mysql_query($cate_sql3, $dbconn);
		$cate_row3 = mysql_fetch_array( $cate_res3 );
		$category_name3 = $cate_row3[category_name];

		//================== 2�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql2 = "select * from $CategoryTable where category_num='$prevno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res2 = mysql_query($cate_sql2, $dbconn);
		$cate_row2 = mysql_fetch_array( $cate_res2 );
		$category_name2 = $cate_row2[category_name];

		//================== 1�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql1 = "select * from $CategoryTable where category_num='$firstno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res1 = mysql_query($cate_sql1, $dbconn);
		$cate_row1 = mysql_fetch_array( $cate_res1 );
		$category_name1 = $cate_row1[category_name];

		if($Mall_Admin_ID != $mart_id)
			$gnt_str = "<img src='../images/gnt.gif' height='12' width='25'>";
		else
			$gnt_str = "";
		$j = $i + 1;
	}else{
		$item_name = "��ǰ�� �����Ǿ����ϴ�.";
	}


	if($i < $tot6 - 1){
		$down_str = "<a href='theme_item.php?best_item_no=$best_item_no&best_item_order=$best_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?best_item_no=$best_item_no&best_item_order=$best_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}

	if( $provider_id == "" && $mart_id == $Mall_Admin_ID ){
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>		
										<td align='left'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a onclick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td><?=$best_main_str?></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=best&best_item_no=<?=$best_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}else {
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>		
										<td align='left'><a href='../good/item_view_gnt.php?item_no=<?=$item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><?=$best_main_str?></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=best&best_item_no=<?=$best_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}
}
?>
<!---------------------------- ����Ʈ��ǰ ���� �� --------------------------------------->

<!---------------------------- ��õ��ǰ ���� ���� --------------------------------------->
									<!-- <tr>
										<td width="58%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>��õ��ǰ ����</b></td>
												<td width="50%" align="right">
													<input onclick="window.location.href='rec_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="��õ��ǰ ���">
													</td>
												</tr>
											</table>
										</td>
									</tr>
<?
$sql4 = "select * from $Rec_ItemTable where mart_id='$mart_id' order by rec_item_order desc";
$res4 = mysql_query($sql4, $dbconn);
$tot4 = mysql_num_rows($res4);
?>
									<tr>
										<td width="58%" bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot4?>���� ��õ��ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">��ȣ</td>
										<td width="10%">����</td>
										<td width="70%" colspan='2'>��ǰ��</td>
										<td width="10%">����</td>
									</tr>
<?
for($i=0; $i < $tot4; $i++){
	mysql_data_seek($res4, $i);
	$ary4 = mysql_fetch_array($res4);

	$rec_item_no = $ary4[rec_item_no];
	$item_no = $ary4[item_no];
	$provider_id = $ary4[provider_id];
	$rec_item_order = $ary4[rec_item_order];
	$rec_main =  $ary4[rec_main];

	if( $rec_main == 'y' ){
		$rec_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=rec&target=main&rec_item_no=$rec_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$rec_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=rec&target=list&rec_item_no=$rec_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
	}
			
	$sql5 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no=$item_no";
	$res5 = mysql_query($sql5, $dbconn);
	$tot5 = mysql_num_rows($res5);
	if($tot5 > 0){
		$item_name = mysql_result($res5, 0, 0);
		$price = mysql_result($res5, 0, 1);
		$mart_id = mysql_result($res5, 0, 2);
		$firstno = mysql_result($res5, 0, 3);
		$prevno = mysql_result($res5, 0, 4);
		$category_num = mysql_result($res5, 0, 5);

		//================== 3�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql3 = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id'";
		$cate_res3 = mysql_query($cate_sql3, $dbconn);
		$cate_row3 = mysql_fetch_array( $cate_res3 );
		$category_name3 = $cate_row3[category_name];

		//================== 2�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql2 = "select * from $CategoryTable where category_num='$prevno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res2 = mysql_query($cate_sql2, $dbconn);
		$cate_row2 = mysql_fetch_array( $cate_res2 );
		$category_name2 = $cate_row2[category_name];

		//================== 1�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql1 = "select * from $CategoryTable where category_num='$firstno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res1 = mysql_query($cate_sql1, $dbconn);
		$cate_row1 = mysql_fetch_array( $cate_res1 );
		$category_name1 = $cate_row1[category_name];

		if($Mall_Admin_ID != $mart_id)
			$gnt_str = "<img src='../images/gnt.gif' height='12' width='25'>";
		else
			$gnt_str = "";
		$j = $i + 1;
	}
	else $item_name = "��ǰ�� �����Ǿ����ϴ�.";

	if($i < $tot4 - 1){
		$down_str = "<a href='theme_item.php?rec_item_no=$rec_item_no&rec_item_order=$rec_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?rec_item_no=$rec_item_no&rec_item_order=$rec_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	
	if($provider_id == ""&&$mart_id == $Mall_Admin_ID){
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>
										<td align='left' colspan='2'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a onclick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=rec&rec_item_no=<?=$rec_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}else {
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td><?=$j?></td>
										<td>
<?
		if($i < $tot4 - 1){
?>
											<a href='theme_item.php?rec_item_no=<?=$rec_item_no?>&rec_item_order=<?=$rec_item_order?>&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'></a>
<?
		}else{
?>
											<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
		if($i > 0){	
?>
											<a href='theme_item.php?rec_item_no=<?=$rec_item_no?>&rec_item_order=<?=$rec_item_order?>&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'></a>
<?
		}else{
?>
											<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> 
<?
		}
?>
										</td>
										<td align='left' colspan='2'><a href='../category/item_view_gnt.php?item_no=<?=$item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=rec&rec_item_no=<?=$rec_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}
}
?> -->
<!---------------------------- ��õ��ǰ ���� �� ----------------------------------------->

<!---------------------------- �Ż�ǰ ���� ���� ----------------------------------------->
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="5">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>�Ż�ǰ ����</b></td>
												<td width="50%"><p align="right">
													<input onclick="window.location.href='new_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Ż�ǰ ���">
												</td>
												</tr>
											</table>
										</td>
									</tr>
<?
//============================= �Ż�ǰ ���� ==============================================
$sql0 = "select * from $New_ItemTable where mart_id='$mart_id' order by new_item_order desc";
$res0 = mysql_query($sql0, $dbconn);
$tot0 = mysql_num_rows($res0);
?>
									<tr>
										<td bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot0?>���� �Ż�ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">��ȣ</td>
										<td width="10%">����</td>
										<td width="60%">��ǰ��</td>
										<td width="10%">���λ�ǰ</td>
										<td width="10%">����</td>
									</tr>
<?
for($i=0; $i < $tot0; $i++){
	mysql_data_seek($res0, $i);
	$ary0=mysql_fetch_array($res0);

	$new_item_no = $ary0[new_item_no];
	$item_no = $ary0[item_no];
	$provider_id = $ary0[provider_id];
	$new_item_order = $ary0[new_item_order];
	$new_main =  $ary0[new_main];

	if( $new_main == 'y' ){
		$new_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=new&target=main&new_item_no=$new_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$new_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=new&target=list&new_item_no=$new_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
	}
	
	$sql1 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no='$item_no'";
	$res1 = mysql_query($sql1, $dbconn);
	$tot1 = mysql_num_rows($res1);
	if($tot1 > 0){
		$item_name = mysql_result($res1, 0, 0);
		$price = mysql_result($res1, 0, 1);
		$mart_id = mysql_result($res1, 0, 2);
		$firstno = mysql_result($res1, 0, 3);
		$prevno = mysql_result($res1, 0, 4);
		$category_num = mysql_result($res1, 0, 5);

		//================== 3�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql3 = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id'";
		$cate_res3 = mysql_query($cate_sql3, $dbconn);
		$cate_row3 = mysql_fetch_array( $cate_res3 );
		$category_name3 = $cate_row3[category_name];

		//================== 2�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql2 = "select * from $CategoryTable where category_num='$prevno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res2 = mysql_query($cate_sql2, $dbconn);
		$cate_row2 = mysql_fetch_array( $cate_res2 );
		$category_name2 = $cate_row2[category_name];

		//================== 1�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql1 = "select * from $CategoryTable where category_num='$firstno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res1 = mysql_query($cate_sql1, $dbconn);
		$cate_row1 = mysql_fetch_array( $cate_res1 );
		$category_name1 = $cate_row1[category_name];

		if($Mall_Admin_ID != $mart_id)
			$gnt_str = "<img src='../images/gnt.gif' height='12' width='25'>";
		else
			$gnt_str = "";
		$j = $i + 1;
	}else{
		$item_name = "��ǰ�� �����Ǿ����ϴ�.";
	}

	if($i < $tot0 - 1){
		$down_str = "<a href='theme_item.php?new_item_no=$new_item_no&new_item_order=$new_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?new_item_no=$new_item_no&new_item_order=$new_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}

	if( $provider_id == "" && $mart_id == $Mall_Admin_ID ){
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>		
										<td align='left'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a onclick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td><?=$new_main_str?></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=new&new_item_no=<?=$new_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}else {
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>		
										<td align='left' colspan='2'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a href='../good/item_view_gnt.php?item_no=<?=$item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=new&new_item_no=<?=$new_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}
}
?>
<!---------------------------- �Ż�ǰ ���� �� ------------------------------------------->

<!---------------------------- Ư����ǰ ���� ���� --------------------------------------->
									<!-- <tr>
										<td width="58%" bgcolor="#8FBECD" align="left" colspan="5" height="1">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>Ư����ǰ ����</b></td>
												<td width="50%" align="right">
													<input onclick="window.location.href='spe_item_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="Ư����ǰ ���">
													</td>
												</tr>
											</table>
										</td>
									</tr>
<?
$sql8 = "select * from $Spe_ItemTable where mart_id='$mart_id' order by spe_item_order desc";
$res8 = mysql_query($sql8, $dbconn);
$tot8 = mysql_num_rows($res8);
?>
									<tr>
										<td width="58%" bgcolor="#FFFFFF" colspan="5" align="center">�� <?=$tot8?>���� Ư����ǰ�� ��ϵǾ� �ֽ��ϴ�.</td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										<td width="10%">��ȣ</td>
										<td width="10%">����</td>
										<td width="70%" colspan='2'>��ǰ��</td>
										<td width="10%">����</td>
									</tr>
<?
for($i=0; $i < $tot8; $i++){
	mysql_data_seek($res8, $i);
	$ary8 = mysql_fetch_array($res8);

	$spe_item_no = $ary8[spe_item_no];
	$item_no = $ary8[item_no];
	$provider_id = $ary8[provider_id];
	$spe_item_order = $ary8[spe_item_order];
	$spe_main =  $ary8[spe_main];

	if( $spe_main == 'y' ){
		$spe_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=spe&target=main&spe_item_no=$spe_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: blue; HEIGHT: 18px' type='button' value='���λ�ǰ'>";
	}else{
		$spe_main_str = "<input onclick=\"document.location.href='theme_item.php?flag=spe&target=list&spe_item_no=$spe_item_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='�Ϲݻ�ǰ'>";
	}
	
	$sql9 = "select item_name, price, mart_id, firstno, prevno, category_num from $ItemTable where item_no=$item_no";
	$res9 = mysql_query($sql9, $dbconn);
	$tot9 = mysql_num_rows($res9);
	if($tot9 > 0){
		$item_name = mysql_result($res9, 0, 0);
		$price = mysql_result($res9, 0, 1);
		$mart_id = mysql_result($res9, 0, 2);
		$firstno = mysql_result($res9, 0, 3);
		$prevno = mysql_result($res9, 0, 4);
		$category_num = mysql_result($res9, 0, 5);

		//================== 3�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql3 = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id'";
		$cate_res3 = mysql_query($cate_sql3, $dbconn);
		$cate_row3 = mysql_fetch_array( $cate_res3 );
		$category_name3 = $cate_row3[category_name];

		//================== 2�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql2 = "select * from $CategoryTable where category_num='$prevno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res2 = mysql_query($cate_sql2, $dbconn);
		$cate_row2 = mysql_fetch_array( $cate_res2 );
		$category_name2 = $cate_row2[category_name];

		//================== 1�� ī�װ� ������ �ҷ��� ======================================
		$cate_sql1 = "select * from $CategoryTable where category_num='$firstno' and if_hide='0' and mart_id='$mart_id'";
		$cate_res1 = mysql_query($cate_sql1, $dbconn);
		$cate_row1 = mysql_fetch_array( $cate_res1 );
		$category_name1 = $cate_row1[category_name];

		if($Mall_Admin_ID != $mart_id)
			$gnt_str = "<img src='../images/gnt.gif' height='12' width='25'>";
		else
			$gnt_str = "";
		$j = $i + 1;
	}
	else $item_name = "��ǰ�� �����Ǿ����ϴ�.";

	if($i < $tot8 - 1){
		$down_str = "<a href='theme_item.php?spe_item_no=$spe_item_no&spe_item_order=$spe_item_order&flag=down'><img src='../images/dn_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ賻����'>";
	}else{
		$down_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'> ";
	}

	if($i > 0){
		$up_str = "<a href='theme_item.php?spe_item_no=$spe_item_no&spe_item_order=$spe_item_order&flag=up'><img src='../images/up_subcategory.gif' width='13' height='13' border='0' alt='�Ѵܰ�ø���'>";
	}else{
		$up_str = "<img src='../images/blank_subcategory.gif' width='13' height='13' border='0'>";
	}
	
	if($provider_id == ""&&$mart_id == $Mall_Admin_ID){
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td bgcolor='#FFFFFF' align='center'><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>		
										<td align='left' colspan='2'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a onclick="window.open( '../good/item_edit_old.php?item_no=<?=$item_no?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?></a></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=spe&spe_item_no=<?=$spe_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}else {
?>
									<tr bgcolor='#FFFFFF' align='center'>
										<td><?=$j?></td>
										<td><?=$down_str?> <?=$up_str?></td>		
										<td align='left' colspan='2'><?=$category_name1?> > <?=$category_name2?> > <?=$category_name3?> >  <a href='../good/item_view_gnt.php?item_no=<?=$item_no?>'><?=$item_name?></a> <img src='../images/gnt.gif' height='12' width='25'></td>
										<td><input onclick="document.location.href='theme_item.php?flag=del&target=spe&spe_item_no=<?=$spe_item_no?>'" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='����'></td>
									</tr>
<?
	}
}
?> -->
<!---------------------------- Ư����ǰ ���� �� ----------------------------------------->
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
}
if($flag=="del"){
	if($target == 'new'){
		$sql = "delete from $New_ItemTable where new_item_no = $new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'fav'){
		$sql = "delete from $Fav_ItemTable where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'rec'){
		$sql = "delete from $Rec_ItemTable where rec_item_no = $rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'best'){
		$sql = "delete from $Best_ItemTable where best_item_no = $best_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if($target == 'spe'){
		$sql = "delete from $Spe_ItemTable where spe_item_no = $spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
	}
	if ($res == false) echo "���� ���� ����!";

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "best"){
	if($target == 'main'){
		$sql = "update $Best_ItemTable set best_main='n' where best_item_no='$best_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Best_ItemTable set best_main='y' where best_item_no='$best_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "new"){
	if($target == 'main'){
		$sql = "update $New_ItemTable set new_main='n' where new_item_no='$new_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $New_ItemTable set new_main='y' where new_item_no='$new_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "rec"){
	if($target == 'main'){
		$sql = "update $Rec_ItemTable set rec_main='n' where rec_item_no='$rec_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Rec_ItemTable set rec_main='y' where rec_item_no='$rec_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "fav"){
	if($target == 'main'){
		$sql = "update $Fav_ItemTable set fav_main='n' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Fav_ItemTable set fav_main='y' where fav_item_no='$fav_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "spe"){
	if($target == 'main'){
		$sql = "update $Spe_ItemTable set spe_main='n' where spe_item_no='$spe_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	if($target == 'list'){
		$sql = "update $Spe_ItemTable set spe_main='y' where spe_item_no='$spe_item_no' and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "up"){
	if(!empty($new_item_no)&&!empty($new_item_order)){
		$sql = "select new_item_order from $New_ItemTable where new_item_order > $new_item_order and mart_id='$mart_id' order by new_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_new_item_order = mysql_result($res,0,0);
		
		$sql = "select new_item_no from $New_ItemTable where new_item_order = $up_new_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_new_item_no = mysql_result($res,0,0);

		$sql = "update $New_ItemTable set new_item_order = $up_new_item_order where new_item_no = $new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";

		$sql = "update $New_ItemTable set new_item_order = $new_item_order where new_item_no = $up_new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($fav_item_no)&&!empty($fav_item_order)){
		$sql = "select fav_item_order from $Fav_ItemTable where fav_item_order > $fav_item_order and mart_id='$mart_id' order by fav_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_fav_item_order = mysql_result($res,0,0);
		
		$sql = "select fav_item_no from $Fav_ItemTable where fav_item_order = $up_fav_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_fav_item_no = mysql_result($res,0,0);
		
		$sql = "update $Fav_ItemTable set fav_item_order = $up_fav_item_order where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Fav_ItemTable set fav_item_order = $fav_item_order where fav_item_no = $up_fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($rec_item_no)&&!empty($rec_item_order)){
		$sql = "select rec_item_order from $Rec_ItemTable where rec_item_order > $rec_item_order and mart_id='$mart_id' order by rec_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_rec_item_order = mysql_result($res,0,0);
		
		$sql = "select rec_item_no from $Rec_ItemTable where rec_item_order = $up_rec_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_rec_item_no = mysql_result($res,0,0);
		
		$sql = "update $Rec_ItemTable set rec_item_order = $up_rec_item_order where rec_item_no = $rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Rec_ItemTable set rec_item_order = $rec_item_order where rec_item_no = $up_rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($best_item_no)&&!empty($best_item_order)){
		$sql = "select best_item_order from $Best_ItemTable where best_item_order > $best_item_order and mart_id='$mart_id' order by best_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_best_item_order = mysql_result($res,0,0);
		
		$sql = "select best_item_no from $Best_ItemTable where best_item_order = $up_best_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_best_item_no = mysql_result($res,0,0);
		
		$sql = "update $Best_ItemTable set best_item_order = $up_best_item_order where best_item_no = $best_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Best_ItemTable set best_item_order = $best_item_order where best_item_no = $up_best_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($spe_item_no)&&!empty($spe_item_order)){
		$sql = "select spe_item_order from $Spe_ItemTable where spe_item_order > $spe_item_order and mart_id='$mart_id' order by spe_item_order Asc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_spe_item_order = mysql_result($res,0,0);
		
		$sql = "select spe_item_no from $Spe_ItemTable where spe_item_order = $up_spe_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$up_spe_item_no = mysql_result($res,0,0);
		
		$sql = "update $Spe_ItemTable set spe_item_order = $up_spe_item_order where spe_item_no = $spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Spe_ItemTable set spe_item_order = $spe_item_order where spe_item_no = $up_spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}

if($flag == "down"){
	if(!empty($new_item_no)&&!empty($new_item_order)){
		$sql = "select new_item_order from $New_ItemTable where new_item_order < $new_item_order and mart_id='$mart_id' order by new_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_new_item_order = mysql_result($res,0,0);
		
		$sql = "select new_item_no from $New_ItemTable where new_item_order = $down_new_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_new_item_no = mysql_result($res,0,0);
		
		$sql = "update $New_ItemTable set new_item_order = $down_new_item_order where new_item_no = $new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $New_ItemTable set new_item_order = $new_item_order where new_item_no = $down_new_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($fav_item_no)&&!empty($fav_item_order)){
		$sql = "select fav_item_order from $Fav_ItemTable where fav_item_order < $fav_item_order and mart_id='$mart_id' order by fav_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_fav_item_order = mysql_result($res,0,0);
		
		$sql = "select fav_item_no from $Fav_ItemTable where fav_item_order = $down_fav_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_fav_item_no= mysql_result($res,0,0);
		
		$sql = "update $Fav_ItemTable set fav_item_order = $down_fav_item_order where fav_item_no = $fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Fav_ItemTable set fav_item_order = $fav_item_order where fav_item_no = $down_fav_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($rec_item_no)&&!empty($rec_item_order)){
		$sql = "select rec_item_order from $Rec_ItemTable where rec_item_order < $rec_item_order and mart_id='$mart_id' order by rec_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_rec_item_order = mysql_result($res,0,0);
		
		$sql = "select rec_item_no from $Rec_ItemTable where rec_item_order = $down_rec_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_rec_item_no= mysql_result($res,0,0);
		
		$sql = "update $Rec_ItemTable set rec_item_order = $down_rec_item_order where rec_item_no = $rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Rec_ItemTable set rec_item_order = $rec_item_order where rec_item_no = $down_rec_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($best_item_no)&&!empty($best_item_order)){
		$sql = "select best_item_order from $Best_ItemTable where best_item_order < $best_item_order and mart_id='$mart_id' order by best_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_best_item_order = mysql_result($res,0,0);
		
		$sql = "select best_item_no from $Best_ItemTable where best_item_order = $down_best_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_best_item_no= mysql_result($res,0,0);
		
		$sql = "update $Best_ItemTable set best_item_order = $down_best_item_order where best_item_no = $best_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Best_ItemTable set best_item_order = $best_item_order where best_item_no = $down_best_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}
	
	if(!empty($spe_item_no)&&!empty($spe_item_order)){
		$sql = "select spe_item_order from $Spe_ItemTable where spe_item_order < $spe_item_order and mart_id='$mart_id' order by spe_item_order Desc";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_spe_item_order = mysql_result($res,0,0);
		
		$sql = "select spe_item_no from $Spe_ItemTable where spe_item_order = $down_spe_item_order and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		$down_spe_item_no= mysql_result($res,0,0);
		
		$sql = "update $Spe_ItemTable set spe_item_order = $down_spe_item_order where spe_item_no = $spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
		
		$sql = "update $Spe_ItemTable set spe_item_order = $spe_item_order where spe_item_no = $down_spe_item_no and mart_id='$mart_id'";
		$res = mysql_query($sql, $dbconn);
		if ($res == false) echo "���� ���� ����!";
	}

	echo "<meta http-equiv='refresh' content='0; URL=theme_item.php'>";
}
?>
<?
mysql_close($dbconn);
?>