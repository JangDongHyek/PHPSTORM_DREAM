<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>�����Ȩ������</title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
<link rel="stylesheet" type="text/css" href="../mobile/css/m_style.css" />
</head>

<body>
<!-- ž�޴�-->
<? include '../mobile/top.htm'; ?>
<!--// ž�޴�-->
<!--2DEPTH MENU -->
<!--<?if($bbs_id == "pro_gal01" || $bbs_id == "pro_gal02" || $bbs_id == "pro_gal03"){?>
<div class="subm2">
		<dl>
		 <dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal01" <?if($bbs_id == "pro_gal01"){?>class="on"<?}?>>����Ʈ</a></dd>
		<dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal02" <?if($bbs_id == "pro_gal02"){?>class="on"<?}?>>�п�/�б�/����/��</a></dd>
		<dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal03" <?if($bbs_id == "pro_gal03"){?>class="on"<?}?>>����/����/��ũ��/���۾�</a></dd>
		</dl>
</div>
<?}?>-->
    <div class="subm3">
            <dl>
			    <dd><a href="../mobile/s2_8.htm">�ٻ��̶�</a></dd>
                <dd><a href="../mobile/s2.htm">�ٻ�ȿ���� ���</a></dd>
                <dd><a href="../mobile/s2_3.htm">�ǰ����Ǻ�&amp;���۸���</a></dd>
            </dl>
    </div><!--.subm3-->
    <div class="subm3">
            <dl>
				<dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal02"  class="on">�ٻ�� �ǰ�</a></dd>
            	<dd><a href="../mobile/s2_6.htm">������ �������� ����</a></dd>
                <dd><a href="../mobile/s2_7.htm">ȣ������</a></dd>
            </dl>
    </div><!--.subm3-->
    <div class="subm3">
            <dl>
				<dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal01">�ٻ� ������ �ڷ�</a></dd>
            </dl>
    </div><!--.subm3-->

<!--//2DEPTH MENU -->
<div class="board_list">

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
<!--<div class="board_login">
	<span>
		<? if(!$mb){?>
		<?=$a_login?><IMG src="<?=$skin_site_url?>images/head_img01.gif" border=0></a>
		<? }else{?>
		<?=$a_logout?><IMG src="<?=$skin_site_url?>images/head_img06.gif" border=0></a>
		<? }?>
	</span>
</div>-->

