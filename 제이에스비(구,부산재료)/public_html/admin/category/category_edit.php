<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $CategoryTable where category_num=$category_num and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$row = mysql_fetch_array( $dbresult );
$category_name = $row[category_name];
$category_date = $row[category_date];
$category_desc = $row[category_desc];
$category_img = $row[category_img];
$if_hide = $row[if_hide];
$category_html = htmlspecialchars($row[category_html], ENT_QUOTES);
$category_left = htmlspecialchars($row[category_left], ENT_QUOTES);

$upload = "../../up/$mart_id/";
$target = "$upload"."$category_img";
if( $category_img ){
	$cate_target_img = "<img src='$target' border='0' align='absmiddle'>";
}else{
	$cate_target_img = "No Image";
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(f){
	if(f.category_name.value == ""){
		alert("변경할 카테고리명을 입력하세요.")
		f.category_name.focus();
		return false;
	}	

	if(!editor_wr_ok())
	{
		return false;
	}

	return true;
}
</script>
</head>
<?
include_once('../../editor_ori/func_editor.php');
$content = $category_left;
?>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<form action='category_modify.php?category_num=<?=$category_num?>' name="up" method="post" onsubmit="return checkform(this)" enctype="multipart/form-data">
<input type="hidden" name="flag" value="update">
<input type="hidden" name="category_img" value="<?=$category_img?>">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "2";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		 <td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>카테고리 관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function view_image(input)
	{
		var oImg = document.getElementById("upImage");
		oImg.src = input.value;
		oImg.style.display = "";
	}
//-->
</SCRIPT>
			<table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white"  align="center">
      			<tr>
        			<td width="90%" bgcolor="#999999">
        				<table border="0" width="100%" cellspacing="1" cellpadding="3">
          				<tr>
            				<td width="20%" bgcolor="#C8DFEC" align="center">
								등록된 카테고리명
            				</td>
            				<td width="21%" bgcolor="#FFFFFF" align="center">
            					<b><?=$category_name?></b>
							</td>
            				<td width="19%" bgcolor="#C8DFEC"  align="center">
								변경할 카테고리명
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<input class="aa" name="category_name" value='<?=$category_name?>' size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
            				</td>
          				</tr>
          				<tr>
            				<td bgcolor="#C8DFEC" align="center">카테고리 이미지</td>
            				<td bgcolor="#FFFFFF" colspan='3'>&nbsp;&nbsp;<?=$cate_target_img?> <input type='file' size='30' maxlength='100' name='categoryimg' class="input_03" onChange="view_image(this);"><img src='' id="upImage" style="display:none;"></td>
          				</tr>          				
          				<tr>
            				<td bgcolor="#C8DFEC" align="center">카테고리 레프트 배너</td>
							<td bgcolor="#FFFFFF" colspan='3'>								
								<?=myEditor(1,'../../editor','up','category_left','100%','250');?>
							</td>
          				</tr>
          				<tr>
							<td width="20%" bgcolor="#C8DFEC" align="center"><span class="aa">상점출력유무</span></td>
							<td width="80%" bgcolor="#FFFFFF" colspan="3">
							&nbsp;&nbsp;&nbsp;&nbsp; 
							<input class="aa" type="radio" value="0" name="if_hide" <?if($if_hide == '0') echo "checked";?>> 상점에 출력함
							<input class="aa" type="radio" value="1" name="if_hide" <?if($if_hide == '1') echo "checked";?>>상점에 출력하지않음 <br>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							(등록은 되지만, 상점에 출력되지는 않습니다)
						</td>
              		</tr>
        				</table>
        			</td>
      			</tr>
    		</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
      			<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
						<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료"> 
						<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력"> 
						<input class="aa" onclick="window.location.href='category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="목록">
    				</td>
  				</tr>
  				<tr align="center">
    				<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
  				</tr>
			</table>
<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>