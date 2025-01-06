<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title></title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
<link rel="stylesheet" type="text/css" href="../mobile/b.css" />
<link rel="stylesheet" type="text/css" href="../mobile/css/display.css" />
</head>

<body style="overflow-x:hidden">
<div id="wrap">
<!-- 탑메뉴-->
<? include '../mobile/top.htm'; ?>
</div>

	<? if($bbs_id == "pro_gal"){ ?>
	<div><? $page_view = "01"; include '../mobile/s_menu3.htm'; ?></div>
	<? } ?>
	<? if($bbs_id == "pro_sigong"){ ?>
	<div><? $page_view = "01"; include '../mobile/s_menu4.htm'; ?></div>
	<? } ?>
	
<!--// 탑메뉴-->
<section id="content">
<article id="contentSubTitle">
	<div class="subTitle">
		<!--//2DEPTH MENU -->
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
<!--<div class="board_login">
	<span>
		<? if(!$mb){?>
		<?=$a_login?><IMG src="<?=$skin_site_url?>images/head_img01.gif" border=0></a>
		<? }else{?>
		<?=$a_logout?><IMG src="<?=$skin_site_url?>images/head_img06.gif" border=0></a>
		<? }?>
	</span>
</div>-->
</div>
<div id="s_body">
<div class="content_box">
	<div class="content_menu">
