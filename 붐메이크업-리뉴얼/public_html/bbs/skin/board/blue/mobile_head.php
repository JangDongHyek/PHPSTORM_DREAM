<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>모바일 홈페이지</title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
</head>

<body>

<!-- 탑메뉴 시작-->
<div class="top" style="">
	<div><img src="../mobile/images/top.jpg" width="300" height="83" border="0" usemap="#Map2" /></div>
	<div class="top_menu"><img src="../mobile/images/logo_main.jpg" width="300"  border="0" height="36" usemap="#Map"/></div></div>
<div class="body">
	<div id="dt5"><div><img src="../mobile/images/<?=$bbs_id?>.gif" width="300" height="60" style="width:300; height:60;border-box; max-width:100% !important;" alt="<?=$bbs[bbs_name]?>"></div></div></div>
	<!--게시판 리스트 시작-->
	<div class="board_list">
<link rel=stylesheet href='<?=$skin_board_url?>style.css'>

<SCRIPT LANGUAGE="JavaScript">
<!--
function img_new_window(name,title) {
	if(name=='')
		return;
	var x=screen.width/2-150/2; //창을 화면 중앙으로 위치 
	var y=(screen.height-30)/2-150/2;
	window.open('<?=$skin_board_url?>img_view.php?image='+name+'&title='+title,'','width=150,height=150,scrollbars=1,resizable=1,top='+y+',left='+x)
}
//-->
</SCRIPT>
<div class="board_login">
	<span>
		<? if(!$mb){?>
		<?=$a_login?><IMG src="<?=$skin_board_url?>images/head_img01.gif" border=0></a>
		<? }else{?>
		<?=$a_logout?><IMG src="<?=$skin_board_url?>images/head_img06.gif" border=0></a>
		<? }?>
	</span>
</div><br>
<map name="Map" id="Map">
<area shape="rect" coords="3,6,66,36" href="../mobile/s1.htm" />
<area shape="rect" coords="63,6,128,36" href="../bbs/mobile_list.php?bbs_id=pro_style1" />
<area shape="rect" coords="125,6,168,36" href="../bbs/mobile_list.php?bbs_id=pro_gallery01" />
<area shape="rect" coords="167,6,230,36" href="../bbs/mobile_list.php?bbs_id=noticee" />
<area shape="rect" coords="227,6,298,36" href="../mobile/s5.htm" />
</map>
<map name="Map2" id="Map2"><area shape="rect" coords="5,5,124,79" href="../mobile/index.htm" />
</map>