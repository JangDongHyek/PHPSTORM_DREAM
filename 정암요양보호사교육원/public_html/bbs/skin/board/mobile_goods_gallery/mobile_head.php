<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>용인열쇠 모바일홈페이지</title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
</head>

<body>

<!-- 탑메뉴 시작-->
<div class="top" style="">
	<div><img src="../mobile/images/top.jpg" width="300" height="47" border="0" usemap="#Map2" /></div>
	<div class="top_menu"><img src="../mobile/images/menu.jpg" width="300"  border="0" height="46" usemap="#Map"/>
</div>
</div>
<div class="body">
	<div><img src="../mobile/images/t5.jpg" width="300" height="81" border="0" usemap="#loginn" style="width:300; height:81;border-box; max-width:100% !important;">
<map name="loginn" id="loginn"><area shape="rect" coords="213,42,296,77" href="mobile_mb_login.php?url=<?=urlencode($HTTP_SERVER_VARS['REQUEST_URI'])?>&<?=$class[link_header]?>" /></map></div>
	<!--게시판 리스트 시작-->
	<div class="board_list">

<SCRIPT LANGUAGE="JavaScript">
<!--
function img_new_window(name,title) {
	if(name=='')
		return;
	var x=screen.width/2-300/2; //창을 화면 중앙으로 위치 
	var y=(screen.height-30)/2-480/2;
	window.open('<?=$skin_board_url?>img_view.php?image='+name+'&title='+title,'','width=150,height=150,scrollbars=1,resizable=1,top='+y+',left='+x)
}
//-->
</SCRIPT>
<!--
<div class="board_login">
	<span>
		<? if(!$mb){?>
		<?=$a_login?><IMG src="<?=$skin_board_url?>images/head_img01.gif" border=0></a>
		<? }else{?>
		<?=$a_logout?><IMG src="<?=$skin_board_url?>images/head_img06.gif" border=0></a>
		<? }?>
	</span>
</div><br><br>-->
<map name="Map2" id="Map2">
<area shape="rect" coords="7,10,170,45" href="../mobile/" />
<area shape="rect" coords="217,5,296,43" href="tel:0806401313" />
</map>
<map name="Map" id="Map">
<area shape="rect" coords="3,5,71,42" href="../mobile/s1.htm" />
<area shape="rect" coords="71,6,160,37" href="../mobile/s2.htm" />
<area shape="rect" coords="159,6,225,38" href="../mobile/s3.htm" />
<area shape="rect" coords="223,4,295,40" href="../mobile/s4.htm" />
</map>