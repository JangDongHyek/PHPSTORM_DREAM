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
<div class="top">
  <div><img src="../mobile/images/top.jpg" width="300" height="83" border="0" usemap="#Map2" />
</div>
  <div><img src="../mobile/images/logo_main.jpg" width="300" height="36" border="0" usemap="#Map"/>
</div> 
</div>
	<!--게시판 리스트 시작-->
<div class="body">
	<div id="dt5">
	<div><img src="../mobile/images/p_t3.jpg" alt="<?=$bbs[bbs_name]?>" width="300" height="60" border="0" usemap="#Map3" style="width:300; height:60;border-box; max-width:100% !important;">
</div>
	</div></div>
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
<map name="Map" id="Map">
<area shape="rect" coords="6,7,69,34" href="../mobile/s1.htm" />
<area shape="rect" coords="70,7,127,34" href="../bbs/mobile_list.php?bbs_id=pro_style1" />
<area shape="rect" coords="127,7,169,34" href="../bbs/mobile_list.php?bbs_id=pro_gallery01" />
<area shape="rect" coords="171,7,229,34" href="../bbs/mobile_list.php?bbs_id=noticee" />
<area shape="rect" coords="229,7,299,34" href="../mobile/s5.htm" />
</map>
<map name="Map2" id="Map2"><area shape="rect" coords="4,3,120,79" href="../mobile/index.htm" />
</map>
<map name="Map3" id="Map3">
  <area shape="rect" coords="5,3,91,29" href="../bbs/mobile_list.php?bbs_id=pro_gallery03" />
  <area shape="rect" coords="90,3,157,29" href="../bbs/mobile_list.php?bbs_id=pro_gallery05" />
  <area shape="rect" coords="156,4,236,29" href="../bbs/mobile_list.php?bbs_id=pro_gallery02" />
  <area shape="rect" coords="235,4,298,29" href="../bbs/mobile_list.php?bbs_id=pro_gallery01" />
  <area shape="rect" coords="200,30,298,55" href="../bbs/mobile_list.php?bbs_id=pro_gallery08" /><area shape="rect" coords="140,30,201,55" href="../bbs/mobile_list.php?bbs_id=pro_gallery07" /><area shape="rect" coords="69,30,141,54" href="../bbs/mobile_list.php?bbs_id=pro_gallery06" />
  <area shape="rect" coords="5,30,70,54" href="../bbs/mobile_list.php?bbs_id=pro_gallery04" />
</map>