<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>모바일홈페이지</title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
<link rel="stylesheet" type="text/css" href="../mobile/css/m_style.css" />
</head>

<body>
<!-- 탑메뉴-->
<? include '../mobile/top.htm'; ?>
<!--// 탑메뉴-->
<!--2DEPTH MENU -->
<?if($bbs_id == "notice"||$bbs_id == "qna"||$bbs_id == "board"){?>
<div class="subm3">
		<dl>
		 <dd><a href="../bbs/mobile_list.php?bbs_id=notice" <?if($bbs_id == "notice"){?>class="on"<?}?>>공지사항</a></dd>
		 <dd><a href="../bbs/mobile_list.php?bbs_id=qna" <?if($bbs_id == "qna"){?>class="on"<?}?>>질문 및 답변</a></dd>
		 <dd><a href="../bbs/mobile_list.php?bbs_id=board" <?if($bbs_id == "board"){?>class="on"<?}?>>게시판</a></dd>
		</dl>
</div>
<?}?>

<!--<div class="subm">
		<dl>
		 	<dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal" class="on">메뉴갤러리</a></dd>
		</dl>
</div>
-->
<!--//2DEPTH MENU -->
<div class="board_list">

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

<br />