<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag != "write"){
?>
<?
	include "../admin_head.php";
?>
<script>
function checkform(f){
	return true;	
}

function fileup(formname, imagename){
	var url = "../file_upload.php?formname="+formname+"&imagename="+imagename
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
				  <td width="90%" bgcolor="#FFFFFF"><strong>[스킨등록]</strong><br>
				  </td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" valign="top"><div align="center"><center>
		<form method="post" name="frm" onsubmit="return checkform(this)">
		<input type="hidden" name="flag" value="write">
		<input type="hidden" name="updateflag" value>
				  <table border="0" width="95%">
					 <tr>
						<td width="90%" bgcolor="#999999"><table border="0" width="100%" cellspacing="1" cellpadding="3">
						  <tr>
							 <td bgcolor="#8FBECD" colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="50%">&nbsp; <strong>스킨등록하기</strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td bgcolor="#8FBECD" colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="50%">&nbsp; <strong>스킨명 <input type="text" name="name"></strong></td>
								  <td width="50%"></td>
								</tr>
							 </table>
							 </td>
						  </tr>						  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 1</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img1" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img1');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:356<br /> 세로길이:98  </td>
							 <td width="71%" rowspan="10" align="left" bgcolor="#FFFFFF"><img src="../images/admin_skin_img.jpg">
							 </td>
						  </tr>
						  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 2</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img2" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img2');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:594<br />세로길이:60 </td>
						  </tr>
													  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 3</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img3" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img3');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:250<br />세로길이:98 </td>
						  </tr>
													  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 4</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img4" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img4');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:700<br />세로길이:218 </td>
						  </tr>
													  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 5</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img5" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img5');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:427<br />세로길이:322 </td>
						  </tr>
													  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 6</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img6" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img6');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:273<br />세로길이:78 <br>
										링크:<input type="text" name="link6" size="10" class="input_03"></td>
						  </tr>
													  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 7</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img7" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img7');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:437<br />세로길이:232 <br>
										링크:<input type="text" name="link7" size="10" class="input_03">
									</td>
						  </tr>
													  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 8</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img8" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img8');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:263<br />세로길이:120 <br />
링크:<input type="text" name="link8" size="10" class="input_03"></td>
						  </tr>
													  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 9</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img9" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img9');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
가로길이:213<br />세로길이:112 <br />
링크:<input type="text" name="link9" size="10" class="input_03"></td>
						  </tr>
													  <tr>
							 <td width="4%" bgcolor="#C8DFEC" align="center">
							 10</td>
							 <td width="28%" bgcolor="#FFFFFF" align="left"><input name="img10" size="15" class="input_03" readonly>
                 <input name="imageup" onclick="javascript:fileup('frm','img10');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="업로드">
                 <br>
세로길이:352</td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  </center></div></td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" align="center" height="35">
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="등록"> 
					  <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력"> 
					  <input onclick="window.location.href='banner_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트">
				  </td>
				</tr>
</form> 

</body>
</html>
<?
}
elseif ($flag == "write") {
	
	if (isset($img1)&&($img1 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		$maxBanner_no_1 = rand(999999,99999999999999);
		$img1_new = "banner_".$maxBanner_no_1."_".$img1;

		if(file_exists("$Co_img_UP$mart_id/$img1"))
			copy ("$Co_img_UP$mart_id/$img1","$Co_img_UP$mart_id/$img1_new" );	//업로드 파일 저장
	}
	if (isset($img2)&&($img2 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		$maxBanner_no_1 = rand(999999,99999999999999);
		$img2_new = "banner_".$maxBanner_no_1."_".$img2;
			
		if(file_exists("$Co_img_UP$mart_id/$img2"))
			copy ("$Co_img_UP$mart_id/$img2","$Co_img_UP$mart_id/$img2_new" );	//업로드 파일 저장
	}
	if (isset($img3)&&($img3 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		$maxBanner_no_1 = rand(999999,99999999999999);
		$img3_new = "banner_".$maxBanner_no_1."_".$img3;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img3"))
			copy ("$Co_img_UP$mart_id/$img3","$Co_img_UP$mart_id/$img3_new" );	//업로드 파일 저장
	}
	if (isset($img4)&&($img4 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		$maxBanner_no_1 = rand(999999,99999999999999);
		$img4_new = "banner_".$maxBanner_no_1."_".$img4;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img4"))
			copy ("$Co_img_UP$mart_id/$img4","$Co_img_UP$mart_id/$img4_new" );	//업로드 파일 저장
	}
	if (isset($img5)&&($img5 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
			$maxBanner_no_1 = rand(999999,99999999999999);
	$img5_new = "banner_".$maxBanner_no_1."_".$img5;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img5"))
			copy ("$Co_img_UP$mart_id/$img5","$Co_img_UP$mart_id/$img5_new" );	//업로드 파일 저장
	}
	if (isset($img6)&&($img6 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
			$maxBanner_no_1 = rand(999999,99999999999999);
	$img6_new = "banner_".$maxBanner_no_1."_".$img6;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img6"))
			copy ("$Co_img_UP$mart_id/$img6","$Co_img_UP$mart_id/$img6_new" );	//업로드 파일 저장
	}
	if (isset($img7)&&($img7 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
			$maxBanner_no_1 = rand(999999,99999999999999);
	$img7_new = "banner_".$maxBanner_no_1."_".$img7;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img7"))
			copy ("$Co_img_UP$mart_id/$img7","$Co_img_UP$mart_id/$img7_new" );	//업로드 파일 저장
	}
	if (isset($img8)&&($img8 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
			$maxBanner_no_1 = rand(999999,99999999999999);
	$img8_new = "banner_".$maxBanner_no_1."_".$img8;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img8"))
			copy ("$Co_img_UP$mart_id/$img8","$Co_img_UP$mart_id/$img8_new" );	//업로드 파일 저장
	}
	if (isset($img9)&&($img9 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
			$maxBanner_no_1 = rand(999999,99999999999999);
	$img9_new = "banner_".$maxBanner_no_1."_".$img9;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img9"))
			copy ("$Co_img_UP$mart_id/$img9","$Co_img_UP$mart_id/$img9_new" );	//업로드 파일 저장
	}
	if (isset($img10)&&($img10 != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
			$maxBanner_no_1 = rand(999999,99999999999999);
	$img10_new = "banner_".$maxBanner_no_1."_".$img10;
			
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img10"))
			copy ("$Co_img_UP$mart_id/$img10","$Co_img_UP$mart_id/$img10_new" );	//업로드 파일 저장
	}


	$SQL = "insert into $ControlTable (banner_no, mart_id, name, img1, img2, img3, img4, img5, img6, img7, img8, img9, img10, link6, link7, link8,link9, see_type) 
	values ('', '$mart_id', '$name', '$img1_new', '$img2_new', '$img3_new', '$img4_new', '$img5_new', '$img6_new', '$img7_new', '$img8_new', '$img9_new', '$img10_new', '$link6','$link7','$link8','$link9', 'n')";
	
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=banner_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>