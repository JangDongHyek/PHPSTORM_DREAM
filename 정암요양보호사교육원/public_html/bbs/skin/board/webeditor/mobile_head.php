<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>�������� ã���ּż� ����帳�ϴ�.��</title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
</head>

<body>

<!-- ž�޴� ����-->
<div class="top">
	<div><? include "../mobile/menu.htm"; ?></div>
</div>
	
<div class="top_2">
	<div><? include "../mobile/jung_menu.htm"; ?></div>
</div>

<div class="small_menu">
	<div><img src="../mobile/images/jung_small_menu_3.gif" border="0" usemap="#jung_com_menu_map" /></div>
</div>


<div class="body">
	
	<!--�Խ��� ����Ʈ ����-->
	<div class="board_list">
	<div class="board_login">
		<span>
			<? if(!$mb){?>
			<?=$a_login?><IMG src="<?=$skin_board_url?>images/head_img01.gif" border=0></a>
			<? }else{?>
			<?=$a_logout?><IMG src="<?=$skin_board_url?>images/head_img06.gif" border=0></a>
			<? }?>
		</span>
	</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
function img_new_window(name,title) {
	if(name=='')
		return;
	var x=screen.width/2-150/2; //â�� ȭ�� �߾����� ��ġ 
	var y=(screen.height-30)/2-150/2;
	window.open('<?=$skin_board_url?>img_view.php?image='+name+'&title='+title,'','width=150,height=150,scrollbars=1,resizable=1,top='+y+',left='+x)
}
//-->
</SCRIPT>
<br>

<map name="jung_com_menu_map" id="jung_com_menu_map">
  <area shape="rect" coords="211,-1,280,27" href="../bbs/mobile_list.php?bbs_id=gallery" />
  <area shape="rect" coords="143,-1,212,27" href="../bbs/mobile_list.php?bbs_id=free" />
  <area shape="rect" coords="75,-1,144,27" href="../bbs/mobile_list.php?bbs_id=qa" />
  <area shape="rect" coords="18,-1,76,27" href="../bbs/mobile_list.php?bbs_id=notice" />
</map>