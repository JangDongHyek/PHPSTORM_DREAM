<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>▒파플레이골프 모바일홈페이지▒</title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
</head>

<body>

<!-- 탑메뉴 시작-->
<div class="top">
  <div><img src="../mobile/images/main_02.gif" width="310" height="57" border="0" usemap="#Map2" /></div>
  <div><img src="../mobile/images/main_04.jpg" width="310" height="31" border="0" usemap="#Map55"/></div> </div>
	<!--게시판 리스트 시작-->
<div class="body"><img src="../mobile/images/<?=$bbs_id?>.jpg" width="308" height="213" border="0" usemap="#Map88" />
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
</div><br><br>
<map name="Map55" id="Map55">
  <area shape="rect" coords="2,3,98,25" href="../mobile/sub1_1.htm"/>
  <area shape="rect" coords="97,2,176,28" href="../mobile/sub2_1.htm" />
  <area shape="rect" coords="174,5,248,26" href="../mobile/sub3_1.htm" />
  <area shape="rect" coords="248,0,307,26" href="../mobile/sub4_1.htm" />
</map>
<map name="Map2" id="Map2"><area shape="rect" coords="4,5,148,54" href="../mobile/" />
<area shape="rect" coords="151,14,247,45" href="../bbs/mobile_list2.php?bbs_id=golf" />
<area shape="rect" coords="246,11,308,45" href="../bbs/mobile_list.php?bbs_id=qna" />
</map>
<map name="Map88" id="Map88">
<area shape="rect" coords="0,183,94,210" href="../bbs/mobile_list.php?bbs_id=qna" />
<area shape="rect" coords="95,183,190,211" href="../bbs/mobile_list.php?bbs_id=pro_gall" />
<area shape="rect" coords="189,184,282,209" href="../bbs/mobile_list.php?bbs_id=notice" />
</map>