<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>제품명 검색</title>
<link rel="stylesheet" type="text/css" href="./img/style.css">
<STYLE>
BODY {
	SCROLLBAR-FACE-COLOR: #f7f7f7; SCROLLBAR-HIGHLIGHT-COLOR: #333333; SCROLLBAR-SHADOW-COLOR: #333333; SCROLLBAR-3DLIGHT-COLOR: #f7f7f7; SCROLLBAR-ARROW-COLOR: #333333; SCROLLBAR-TRACK-COLOR: #f7f7f7; SCROLLBAR-DARKSHADOW-COLOR: #f7f7f7
}
.td1 {
	BACKGROUND-COLOR: #2f6793
}
.td2 {
	BACKGROUND-COLOR: #ffffff
}
.td3 {
	BACKGROUND-COLOR: #a0bed6; TEXT-ALIGN: center
}
.td4 {
	BACKGROUND-COLOR: #d5e3ee; TEXT-ALIGN: center
}
.td5 {
	BACKGROUND-COLOR: #e5e5e5; TEXT-ALIGN: center
}
.td6 {
	BACKGROUND-COLOR: #ffffff; TEXT-ALIGN: left
}
.style1 {BACKGROUND-COLOR: #a0bed6; TEXT-ALIGN: center; color: #000000; }
</STYLE>
<link rel="stylesheet" type="text/css" href="./calendar.css">
<SCRIPT type="text/javascript" src="./dhtmlgoodies_calendar.js?random=20060118"></script>

<script>
function form_chk(f){
	if(f.this_name.value == ""){
		alert("제품명을 입력헤주세요.");
		f.this_name.focus();
		return false;
	}
	return true;
}

function select_go(f_name,f_no){
	opener.document.writeform.item_name.value = f_name;
	opener.document.writeform.item_no.value = f_no;
	window.close();
}


function cursorfocus(){
	document.getElementById("this_name").focus();
}
</script>
</head>
<body topmargin="10" leftmargin="10" rightmargin="10" bottommargin="5" onload="cursorfocus();">

<table width="100%" cellpadding=6 cellspacing=1 border=0 bgcolor="#2F6793">
<form method="post" name="src_form" action="" onsubmit="return form_chk(this);">
<tr>
	<td align="center" bgcolor="#FFFFFF" colspan="2"><span style="font-size:13pt; font-weight:bold;">제품명 검색</span></td>
</tr>
<tr>
	<td width="50%" align="left" bgcolor="#FFFFFF"><input type="text" name="this_name" id="this_name" value="" style="width:230px; ime-mode:active;"></td>
	<td width="50%" align="center" bgcolor="#FFFFFF"><input type="submit" value="검&nbsp;&nbsp;색"></td>
</tr>
</form>
</table>
<?if($this_name != ""){?>
<table width="100%" cellpadding=0 cellspacing=0 border=0 bgcolor="#2F6793" style="border-style:solid; border-left-width:1px; border-right-width:1px; border-top-width:1px; border-bottom-width:1px; border-color:#2F6793;">
<tr>
	<td align="center" bgcolor="#A0BED6" style="padding-top:4px; padding-bottom:4px;"><span style="color:#000000; font-weight:bold; font-size:10pt;">이미지</span></td>
	<td width="130" align="center" bgcolor="#A0BED6" style="padding-top:4px; padding-bottom:4px;"><span style="color:#000000; font-weight:bold; font-size:10pt;">제품명</span></td>
	<td width="90" align="center" bgcolor="#A0BED6" style="padding-top:4px; padding-bottom:4px;"></td>
</tr>
<tr>
	<td height="1" align="center" bgcolor="#2F6793" colspan="3"></td>
</tr>
<?
$fixed_size =" width='100' height='100' ";
$sql1 = "select * from item where item_name like '%$this_name%' order by item_no desc";
$qry1 = mysql_query($sql1);
$num1 = mysql_num_rows($qry1);
if($num1 > 0){
for($i=0; $i<$num1; $i++){
$row1 = mysql_fetch_array($qry1);
$row1[item_name] = str_replace("'","",$row1[item_name]);
$img_sml = $row1[img_sml];
		if($img_sml != "" && file_exists("$Co_img_UP$mart_id/$img_sml")){
			if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
				$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_sml' border='0' $fixed_size>";
			}
			if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
				$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_sml' $fixed_size></embed>";
			}
		}

?>
<tr>
	<td align="center" bgcolor="#FFFFFF" style="padding-top:4px; padding-bottom:4px;"><?=$img_str?></td>
	<td align="center" bgcolor="#FFFFFF" style="padding-top:4px; padding-bottom:4px;"><span style="color:#000000; font-size:9pt;"><?=$row1[item_name]?></span></td>
	<td align="center" bgcolor="#FFFFFF" style="padding-top:4px; padding-bottom:4px;">
	
	<span style="color:#000000; font-size:9pt; cursor:pointer;" onclick="select_go('<?=$row1[item_name]?>','<?=$row1[item_no]?>')">[선택]</span></td>

</tr>
<tr>
	<td height="1" align="center" bgcolor="#2F6793" colspan="3"></td>
</tr>
<?
}
}else{
?>
<tr>
	<td align="center" bgcolor="#FFFFFF" colspan="3" style="padding-top:4px; padding-bottom:4px;"><span style="color:#000000; font-size:9pt;">검색된 제품이 없습니다.</span></td>
</tr>
<tr>
	<td height="1" align="center" bgcolor="#2F6793" colspan="3"></td>
</tr>
<?
}
?>
</table>
<?}?>
</body>
</html>
<SCRIPT LANGUAGE="JavaScript">
<!--
	g4_path = "../overture";
//-->
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="../overture/js/wrest.js"></SCRIPT>
