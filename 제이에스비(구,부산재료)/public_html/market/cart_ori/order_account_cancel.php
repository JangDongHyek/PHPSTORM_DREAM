<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

$SQL = "select * from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, "perms");
if($perms == "4") {
	echo ("		
	<script>
		alert('미등록 쇼핑몰입니다.');
		history.go(-1);
	</script>
	");
	exit;
}

include( '../include/getmartinfo.php' );

if(strstr($icon_module,"icon12")!=false) include('../include/head_template6.inc');
else include('../include/head_alltemplate.inc');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title><?=$page_title?></title>
<style type="text/css">
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {   font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #F78C00}
.dd {  font-size: 9pt; color: #ffffff}
.ee {  font-size: 9pt; color: #057BB1}
A            {font-size: 9pt;text-decoration: none;color: #000000 }
 A:hover      {text-decoration: none;  }  -->
</style>
<script langauage="Javascript">
<!-- 
  function hidestatus(){ 
  window.status='' 
  return true 
  } 

  if (document.layers) 
  document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT) 

  document.onmouseover=hidestatus 
  document.onmouseout=hidestatus 
//--> 
</script> 
</head>

<?
if(strstr($icon_module,"icon7")!=false || strstr($icon_module,"icon8")!=false){
	if(strstr($icon_module,"icon7")!=false){
		if($top_out_img != "") $tmp_body_background = "$Co_img_DOWN$mart_id/design2/$top_out_img";
		else $tmp_body_background == "";
		echo ("
<body topmargin='0' bgcolor='$top_out_color' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD' background='$tmp_body_background'>
		");
	}
	else {
		if($top_out_img != "") $tmp_body_background = "$Co_img_DOWN$mart_id/design2/temp2/$top_out_img";
		else $tmp_body_background == "";
		echo ("
<body topmargin='0' bgcolor='$top_out_color' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD' background='$tmp_body_background'>
		");
	}
}
if(strstr($icon_module,"icon9")!=false){
	// 탑메뉴 배경이미지
	if($top_bg_img_all != "") $tmp_background = "$Co_img_DOWN$mart_id/design2/temp3/$top_bg_img_all";
	else $tmp_background = "";
	echo ("
<body topmargin='0' bgcolor='$top_bg_color_all' background='$tmp_background' link='#CECBCE' vlink='#CECBCE' alink='#CECBCE' leftmargin='0'>
	");
}
if(strstr($icon_module,"icon10")!=false){
	if($top_bg_color_all != "") $tmp_top_bg_color_all = $top_bg_color_all;
	else{
		if($icon_module == 'icon10_1') $tmp_top_bg_color_all = "#E3E3E3";
		if($icon_module == 'icon10_2') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_3') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_4') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_5') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_6') $tmp_top_bg_color_all = "#FFFFFF";
		if($icon_module == 'icon10_7') $tmp_top_bg_color_all = "#E3E3E3";
		if($icon_module == 'icon10_8') $tmp_top_bg_color_all = "#E0EEFC";
		if($icon_module == 'icon10_9') $tmp_top_bg_color_all = "#9A9A9A";
		if($icon_module == 'icon10_10') $tmp_top_bg_color_all = "#9A9A9A";
	}
	if($top_bg_img_all != "") $tmp_top_bg_img_all = "$Co_img_DOWN$mart_id/design2/temp4/$top_bg_img_all";
	else $tmp_top_bg_img_all = "../images/template4/$icon_module/bg.gif";
	echo ("
	<body bgcolor='$tmp_top_bg_color_all' topmargin='0' link='#000000' vlink='#000000' alink='#000000' background='$tmp_top_bg_img_all'>
	");
}
if(strstr($icon_module,"icon11")!=false){
	echo ("
<body $leftmargin_str topmargin='0' bgcolor='$top_out_color' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD' background='$Co_img_DOWN$mart_id/design2/temp5/$top_out_img'>
	");
}
if(strstr($icon_module,"icon7")!=false) include( '../include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/topmenu_template2.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/topmenu_template5.inc' );
if(strstr($icon_module,"icon9")!=false) {
	if($onestep != 10) include( '../include/topmenu_template3.inc' );
	else include( '../include/topmenu_template3_1024.inc' );
}
if(strstr($icon_module,"icon10")!=false) include( '../include/topmenu_template4.inc' );
?>
<table border="0" width="<?echo $middle_width?>" cellspacing="0" cellpadding="0">
<tr>
    <?
	if(strstr($icon_module,"icon7")!=false) include( '../include/leftmenu.inc' );
	if(strstr($icon_module,"icon8")!=false) include( '../include/leftmenu_template2.inc' );
	if(strstr($icon_module,"icon9")!=false) include( '../include/leftmenu_template3.inc' );
	if(strstr($icon_module,"icon10")!=false) include( '../include/leftmenu_template4.inc' );
	if(strstr($icon_module,"icon11")!=false) include( '../include/leftmenu_template5.inc' );
	?>
	<td width="609" valign="top" bgcolor='#ffffff'>
    	<div align="center"><center>
    	
    	<table border="0" width="500">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%"><img src="../images/pay_ing.gif" WIDTH="122" HEIGHT="27"></td>
      	</tr>
      	<tr>
        	<td width="100%">
        	<?
        	if($ti_line_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_line_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_line_img' WIDTH='571' HEIGHT='12'>
        		";
        	}
        	else{
        		echo "
        	<img src='../images/line.gif' WIDTH='571' HEIGHT='12'>
        		";
        	}
        	?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" height="20"><span class="aa"></span></td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<div align="center"><center>
        		<table cellspacing="1" background="../images/dot2.gif" width="75%" border="0">
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top"><p align="center"><br>
            			<br>
            			<span class="bb">계좌이체가 취소되었습니다.</span><strong><span class="zz"><br>
            			<br><br>
            			</span></strong>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
<?
include( '../include/bottom.inc' );
?>
</body>
</html>
<?
mysql_close($dbconn);
?>