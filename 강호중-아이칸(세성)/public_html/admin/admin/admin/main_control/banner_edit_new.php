<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ""){
?>
<?
	include "../admin_head.php";
?>
<script>
function checkform(f){
	return true;
}

function fileup(formname, imagename){
	var url = "./file_upload.php?formname="+formname+"&imagename="+imagename
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "10";
include "../include/left_menu_layer.php"; 


	$SQL = "select * from $ControlTable where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);


?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>����ȭ�����</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td width="90%" bgcolor="#FFFFFF"><strong>[��Ų����]</strong><br>
				  </td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" valign="top"><div align="center"><center>
<form method="post" name="frm"  onsubmit="return checkform(this)">
<input type='hidden' name='flag' value='update'>
<input type='hidden' name='updateflag' value=''>
				  <table border="0" width="95%">
					 <tr>
						<td width="90%" bgcolor="#999999"><table border="0" width="100%" cellspacing="1" cellpadding="3">
						  <tr>
							 <td bgcolor="#8FBECD" colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="90%">&nbsp; <strong>��Ų�����ϱ� (���ϼ����� �������ϸ�� �ٸ��� �Ͻñ� �ٶ��ϴ�)</strong></td>
								  <td width="10%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td bgcolor="#8FBECD" colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="50%">&nbsp; <strong>��Ų�� <input type="text" name="name" value="<?=$rows[name]?>"></strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>						  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 1</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img1" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img1');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
<?
	if( $rows[img1] ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img1]?>' border='0'>
<?
	}
?>
                 <br>
���α���:356 ���α���:98 </td>

						  </tr>
						  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 2</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img2" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img2');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
<?
	if( $rows[img2] ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img2]?>' border='0'>
<?
	}
?>                 <br>
���α���:594 ���α���:60 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 3</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img3" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img3');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
 <?
	if( $rows[img3] ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img3]?>' border='0'>
<?
	}
?>                <br>
���α���:250 ���α���:98 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 4</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img4" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img4');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
 <?
	if( $rows[img4] ){
?>

       <embed src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img4]?>'></embed>
<?
	}
?>                <br>
���α���:700 ���α���:218 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 5</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img5" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img5');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
<?
	if( $rows[img5] ){
?>
								<embed src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img5]?>'></embed>
<?
	}
?>                 <br>
���α���:427 ���α���:322 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 6</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img6" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img6');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
  <?
	if( $rows[img6] ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img6]?>' border='0'>
<?
	}
?>               <br>
���α���:273 ���α���:78 <br />
��ũ:<input type="text" name="link6" size="70" value="<?=$rows[link6]?>" class="input_03"></td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 7</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img7" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img7');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
<?
	if( $rows[img7] ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img7]?>' border='0'>
<?
	}
?>                 <br>
���α���:437 ���α���:232<br />
��ũ:<input type="text" name="link7" size="70" value="<?=$rows[link7]?>" class="input_03"></td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 8</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img8" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img8');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
<?
	if( $rows[img8]){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img8]?>' border='0'>
<?
	}
?>                 <br>
���α���:263 ���α���:120<br />
��ũ:<input type="text" name="link8" size="70" value="<?=$rows[link8]?>" class="input_03"></td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 9</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img9" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img9');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
 <?
	if( $rows[img9] ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img9]?>' border='0'>
<?
	}
?>                <br>
���α���:263 ���α���:112<br />
��ũ:<input type="text" name="link9" size="70" value="<?=$rows[link9]?>" class="input_03"></td>
						  </tr>
							 <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 10</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img10" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img10');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���ε�">
 <?
	if( $rows[img10] ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$rows[img10]?>' border='0'>
<?
	}
?>                <br>
 ���α���:352<br />
</td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="����"> 
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�"> 
					  <input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ">
				  </td>
				</tr>
</form> 

</body>
</html>
<?
}
elseif ($flag == "update") {
	if($img1_old != "" && $img1 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img1"))
			unlink("$Co_img_UP$mart_id/$img1");
	}
	if($img2_old != "" && $img2 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img2"))
			unlink("$Co_img_UP$mart_id/$img2");
	}
	if($img3_old != "" && $img3 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img3"))
			unlink("$Co_img_UP$mart_id/$img3");
	}
	if($img4_old != "" && $img4 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img4"))
			unlink("$Co_img_UP$mart_id/$img4");
	}
	if($img5_old != "" && $img5 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img5"))
			unlink("$Co_img_UP$mart_id/$img5");
	}
	if($img6_old != "" && $img6 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img6"))
			unlink("$Co_img_UP$mart_id/$img6");
	}
	if($img7_old != "" && $img7 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img7"))
			unlink("$Co_img_UP$mart_id/$img7");
	}
	if($img8_old != "" && $img8 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img8"))
			unlink("$Co_img_UP$mart_id/$img8");
	}
	if($img9_old != "" && $img9 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img9"))
			unlink("$Co_img_UP$mart_id/$img9");
	}
	if($img10_old != "" && $img10 == ""){
		if(file_exists("$Co_img_UP$mart_id/$img10"))
			unlink("$Co_img_UP$mart_id/$img10");
	}

	if (isset($img1)&&($img1 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img1_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img1_old"))
					unlink("$Co_img_UP$mart_id/$img1_old");	
			}
			$img1_new = "banner_".$banner_no."_".$img1;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img1"))
				copy ("$Co_img_UP$mart_id/$img1","$Co_img_UP$mart_id/$img1_new" );	//���ε� ���� ����
		}
		else{
			$img1_new = $img1;
		}
	}

		
		if (isset($img2)&&($img2 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img2_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img2_old"))
					unlink("$Co_img_UP$mart_id/$img2_old");	
			}
			$img2_new = "banner_".$banner_no."_".$img2;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img2"))
				copy ("$Co_img_UP$mart_id/$img2","$Co_img_UP$mart_id/$img2_new" );	//���ε� ���� ����
		}
		else{
			$img2_new = $img2;
		}
	}

		if (isset($img3)&&($img3 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img3_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img3_old"))
					unlink("$Co_img_UP$mart_id/$img3_old");	
			}
			$img3_new = "banner_".$banner_no."_".$img3;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img3"))
				copy ("$Co_img_UP$mart_id/$img3","$Co_img_UP$mart_id/$img3_new" );	//���ε� ���� ����
		}
		else{
			$img3_new = $img3;
		}
	}

		if (isset($img4)&&($img4 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img4_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img4_old"))
					unlink("$Co_img_UP$mart_id/$img4_old");	
			}
			$img4_new = "banner_".$banner_no."_".$img4;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img4"))
				copy ("$Co_img_UP$mart_id/$img4","$Co_img_UP$mart_id/$img4_new" );	//���ε� ���� ����
		}
		else{
			$img4_new = $img4;
		}
	}

		if (isset($img5)&&($img5 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img5_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img5_old"))
					unlink("$Co_img_UP$mart_id/$img5_old");	
			}
			$img5_new = "banner_".$banner_no."_".$img5;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img5"))
				copy ("$Co_img_UP$mart_id/$img5","$Co_img_UP$mart_id/$img5_new" );	//���ε� ���� ����
		}
		else{
			$img5_new = $img5;
		}
	}

		if (isset($img6)&&($img6 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img6_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img6_old"))
					unlink("$Co_img_UP$mart_id/$img6_old");	
			}
			$img6_new = "banner_".$banner_no."_".$img6;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img6"))
				copy ("$Co_img_UP$mart_id/$img6","$Co_img_UP$mart_id/$img6_new" );	//���ε� ���� ����
		}
		else{
			$img6_new = $img6;
		}
	}

		if (isset($img7)&&($img7 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img7_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img7_old"))
					unlink("$Co_img_UP$mart_id/$img7_old");	
			}
			$img7_new = "banner_".$banner_no."_".$img7;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img7"))
				copy ("$Co_img_UP$mart_id/$img7","$Co_img_UP$mart_id/$img7_new" );	//���ε� ���� ����
		}
		else{
			$img7_new = $img7;
		}
	}

		if (isset($img8)&&($img8 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img8_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img8_old"))
					unlink("$Co_img_UP$mart_id/$img8_old");	
			}
			$img8_new = "banner_".$banner_no."_".$img8;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img8"))
				copy ("$Co_img_UP$mart_id/$img8","$Co_img_UP$mart_id/$img8_new" );	//���ε� ���� ����
		}
		else{
			$img8_new = $img8;
		}
	}

	if (isset($img9)&&($img9 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img9_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img9_old"))
					unlink("$Co_img_UP$mart_id/$img9_old");	
			}
			$img9_new = "banner_".$banner_no."_".$img9;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img9"))
				copy ("$Co_img_UP$mart_id/$img9","$Co_img_UP$mart_id/$img9_new" );	//���ε� ���� ����
		}
		else{
			$img9_new = $img9;
		}
	}

	if (isset($img10)&&($img10 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($img_updateflag=="ok"){
			
			if($img10_old != ""){
				if(file_exists("$Co_img_UP$mart_id/$img10_old"))
					unlink("$Co_img_UP$mart_id/$img10_old");	
			}
			$img10_new = "banner_".$banner_no."_".$img10;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img10"))
				copy ("$Co_img_UP$mart_id/$img10","$Co_img_UP$mart_id/$img10_new" );	//���ε� ���� ����
		}
		else{
			$img10_new = $img10;
		}
	}
if($img1_new){
$img1_query = ", img1 = '$img1_new'";
}
if($img2_new){
$img2_query = ", img2 = '$img2_new'";
}
if($img3_new){
$img3_query = ", img3 = '$img3_new'";
}
if($img4_new){
$img4_query = ", img4 = '$img4_new'";
}
if($img5_new){
$img5_query = ", img5 = '$img5_new'";
}
if($img6_new){
$img6_query = ", img6 = '$img6_new'";
}
if($img7_new){
$img7_query = ", img7 = '$img7_new'";
}
if($img8_new){
$img8_query = ", img8 = '$img8_new'";
}
if($img9_new){
$img9_query = ", img9 = '$img9_new'";
}
if($img10_new){
$img10_query = ", img10 = '$img10_new'";
}


	$SQL = "update $ControlTable set name='$name', link6='$link6', link7='$link7', link8='$link8', link9='$link9' $img1_query $img2_query $img3_query $img4_query $img5_query $img6_query $img7_query $img8_query $img9_query $img10_query where banner_no = $banner_no and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);	






	echo "<meta http-equiv='refresh' content='0; URL=banner_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>