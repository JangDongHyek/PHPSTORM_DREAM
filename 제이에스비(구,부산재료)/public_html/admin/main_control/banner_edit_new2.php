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
			<!--왼쪽부분시작-->
<?
$left_menu = "10";
include "../include/left_menu_layer.php"; 


	$SQL = "select * from $ControlTable where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);
	$img11 = $rows[img1];
	$img21 = $rows[img2];
	$img31 = $rows[img3];
	$img41 = $rows[img4];
	$img51 = $rows[img5];
	$img61 = $rows[img6];
	$img71 = $rows[img7];
	$img81 = $rows[img8];
	$img91 = $rows[img9];
	$img101 = $rows[img10];


?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>메인화면관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td width="90%" bgcolor="#FFFFFF"><strong>[스킨수정]</strong><br>
				  </td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" valign="top"><div align="center"><center>
<form method="post" name="frm"  onsubmit="return checkform(this)">
<input type='hidden' name='flag' value='update'>
<input type='hidden' name='updateflag' value=''>
<input type='hidden' name='img1_old' value='<?=$img11?>'>
<input type='hidden' name='img2_old' value='<?=$img21?>'>
<input type='hidden' name='img3_old' value='<?=$img31?>'>
<input type='hidden' name='img4_old' value='<?=$img41?>'>
<input type='hidden' name='img5_old' value='<?=$img51?>'>
<input type='hidden' name='img6_old' value='<?=$img61?>'>
<input type='hidden' name='img7_old' value='<?=$img71?>'>
<input type='hidden' name='img8_old' value='<?=$img81?>'>
<input type='hidden' name='img9_old' value='<?=$img91?>'>
<input type='hidden' name='img10_old' value='<?=$img101?>'>
				  <table border="0" width="95%">
					 <tr>
						<td width="90%" bgcolor="#999999"><table border="0" width="100%" cellspacing="1" cellpadding="3">
						  <tr>
							 <td bgcolor="#8FBECD" colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="50%">&nbsp; <strong>스킨수정하기</strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td bgcolor="#8FBECD" colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="50%">&nbsp; <strong>스킨명 <input type="text" name="name" value="<?=$rows[name]?>"></strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>						  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 1</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img1" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img1');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
<?
	if( $img11 ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img11?>' border='0'>
<?
	}
?>
                 <br>
가로길이:100 세로길이:200 </td>

						  </tr>
						  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 2</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img2" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img2');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
<?
	if( $img21 ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img21?>' border='0'>
<?
	}
?>                 <br>
가로길이:100 세로길이:200 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 3</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img3" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img3');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
 <?
	if( $img31 ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img31?>' border='0'>
<?
	}
?>                <br>
가로길이:100 세로길이:200 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 4</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img4" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img4');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
 <?
	if( $img41 ){
?>

       <embed src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img41?>'></embed>
<?
	}
?>                <br>
가로길이:100 세로길이:200 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 5</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img5" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img5');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
<?
	if( $img51 ){
?>
								<embed src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img51?>'></embed>
<?
	}
?>                 <br>
가로길이:100 세로길이:200 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 6</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img6" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img6');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
  <?
	if( $img61 ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img61?>' border='0'>
<?
	}
?>               <br>
가로길이:100 세로길이:200 </td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 7</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img7" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img7');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
<?
	if( $img71 ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img71?>' border='0'>
<?
	}
?>                 <br>
가로길이:100 세로길이:200<br />
링크:<input type="text" name="link7" size="70" value="<?=$rows[link7]?>" class="input_03"></td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 8</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img8" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img8');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
<?
	if( $img81){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img81?>' border='0'>
<?
	}
?>                 <br>
가로길이:100 세로길이:200<br />
링크:<input type="text" name="link8" size="70" value="<?=$rows[link8]?>" class="input_03"></td>
						  </tr>
													  <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 9</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img9" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img9');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
 <?
	if( $img91 ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img91?>' border='0'>
<?
	}
?>                <br>
가로길이:100 세로길이:200<br />
링크:<input type="text" name="link9" size="70" value="<?=$rows[link9]?>" class="input_03"></td>
						  </tr>
							 <tr>
							 <td width="3%" bgcolor="#C8DFEC" align="center">
							 10</td>
							 <td width="97%" bgcolor="#FFFFFF" align="left"><input name="img10" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img10');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
 <?
	if( $img101 ){
?>
								<img src='<?=$Co_img_DOWN?><?=$mart_id?>/<?=$img101?>' border='0'>
<?
	}
?>                <br>
가로길이:100 세로길이:200<br />
</td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정"> 
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력"> 
					  <input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트">
				  </td>
				</tr>
</form> 

</body>
</html>
<?
}
elseif ($flag == "update") {

	if($img1_old && $img1){
		if(file_exists("$Co_img_UP$mart_id/$img1_old"))
			unlink("$Co_img_UP$mart_id/$img1_old");
	}


	if($img2_old && $img2){
		if(file_exists("$Co_img_UP$mart_id/$img2_old"))
			unlink("$Co_img_UP$mart_id/$img2_old");
	}
	if($img3_old && $img3){
		if(file_exists("$Co_img_UP$mart_id/$img3_old"))
			unlink("$Co_img_UP$mart_id/$img3_old");
	}
	if($img4_old && $img4){
		if(file_exists("$Co_img_UP$mart_id/$img4_old"))
			unlink("$Co_img_UP$mart_id/$img4_old");
	}
	if($img5_old && $img5){
		if(file_exists("$Co_img_UP$mart_id/$img5_old"))
			unlink("$Co_img_UP$mart_id/$img5_old");
	}
	if($img6_old && $img6){
		if(file_exists("$Co_img_UP$mart_id/$img6_old"))
			unlink("$Co_img_UP$mart_id/$img6_old");
	}
	if($img7_old && $img7){
		if(file_exists("$Co_img_UP$mart_id/$img7_old"))
			unlink("$Co_img_UP$mart_id/$img7_old");
	}
	if($img8_old && $img8){
		if(file_exists("$Co_img_UP$mart_id/$img8_old"))
			unlink("$Co_img_UP$mart_id/$img8_old");
	}
	if($img9_old && $img9){
		if(file_exists("$Co_img_UP$mart_id/$img9_old"))
			unlink("$Co_img_UP$mart_id/$img9_old");
	}
	if($img10_old && $img10){
		if(file_exists("$Co_img_UP$mart_id/$img10_old"))
			unlink("$Co_img_UP$mart_id/$img10_old");
	}

	if (isset($img1)&&($img1 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			

			$img1_new = "banner_".$banner_no."_".$img1;
			if(file_exists("$Co_img_UP$mart_id/$img1"))
				copy ("$Co_img_UP$mart_id/$img1","$Co_img_UP$mart_id/$img1_new" );	//업로드 파일 저장
		}
		else{
			$img1_new = $img1;
		}
	}

		
		if (isset($img2)&&($img2 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			

			$img2_new = "banner_".$banner_no."_".$img2;
			if(file_exists("$Co_img_UP$mart_id/$img2"))
				copy ("$Co_img_UP$mart_id/$img2","$Co_img_UP$mart_id/$img2_new" );	//업로드 파일 저장
		}
		else{
			$img2_new = $img2;
		}
	}

		if (isset($img3)&&($img3 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			
		
			$img3_new = "banner_".$banner_no."_".$img3;
			if(file_exists("$Co_img_UP$mart_id/$img3"))
				copy ("$Co_img_UP$mart_id/$img3","$Co_img_UP$mart_id/$img3_new" );	//업로드 파일 저장
		}
		else{
			$img3_new = $img3;
		}
	}

		if (isset($img4)&&($img4 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			

			$img4_new = "banner_".$banner_no."_".$img4;

		if(file_exists("$Co_img_UP$mart_id/$img4"))
				copy ("$Co_img_UP$mart_id/$img4","$Co_img_UP$mart_id/$img4_new" );	//업로드 파일 저장
		}
		else{
			$img4_new = $img4;
		}
	}

		if (isset($img5)&&($img5 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			

			$img5_new = "banner_".$banner_no."_".$img5;
			if(file_exists("$Co_img_UP$mart_id/$img5"))
				copy ("$Co_img_UP$mart_id/$img5","$Co_img_UP$mart_id/$img5_new" );	//업로드 파일 저장
		}
		else{
			$img5_new = $img5;
		}
	}

		if (isset($img6)&&($img6 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			

			$img6_new = "banner_".$banner_no."_".$img6;
			if(file_exists("$Co_img_UP$mart_id/$img6"))
				copy ("$Co_img_UP$mart_id/$img6","$Co_img_UP$mart_id/$img6_new" );	//업로드 파일 저장
		}
		else{
			$img6_new = $img6;
		}
	}

		if (isset($img7)&&($img7 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			

			$img7_new = "banner_".$banner_no."_".$img7;
			if(file_exists("$Co_img_UP$mart_id/$img7"))
				copy ("$Co_img_UP$mart_id/$img7","$Co_img_UP$mart_id/$img7_new" );	//업로드 파일 저장
		}
		else{
			$img7_new = $img7;
		}
	}

		if (isset($img8)&&($img8 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			
	
			$img8_new = "banner_".$banner_no."_".$img8;
			if(file_exists("$Co_img_UP$mart_id/$img8"))
				copy ("$Co_img_UP$mart_id/$img8","$Co_img_UP$mart_id/$img8_new" );	//업로드 파일 저장
		}
		else{
			$img8_new = $img8;
		}
	}

	if (isset($img9)&&($img9 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			
	
			$img9_new = "banner_".$banner_no."_".$img9;
			if(file_exists("$Co_img_UP$mart_id/$img9"))
				copy ("$Co_img_UP$mart_id/$img9","$Co_img_UP$mart_id/$img9_new" );	//업로드 파일 저장
		}
		else{
			$img9_new = $img9;
		}
	}

	if (isset($img10)&&($img10 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
	
			$img10_new = "banner_".$banner_no."_".$img10;
			if(file_exists("$Co_img_UP$mart_id/$img10"))
				copy ("$Co_img_UP$mart_id/$img10","$Co_img_UP$mart_id/$img10_new" );	//업로드 파일 저장
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


	$SQL = "update $ControlTable set name='$name', link7='$link7', link8='$link8', link9='$link9' $img1_query $img2_query $img3_query $img4_query $img5_query $img6_query $img7_query $img8_query $img9_query $img10_query where banner_no = $banner_no and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);	






	echo "<meta http-equiv='refresh' content='0; URL=banner_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>