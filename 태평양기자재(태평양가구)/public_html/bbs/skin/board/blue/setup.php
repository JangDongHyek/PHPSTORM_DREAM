<?
	// ����� ������
	$skin[icon_reply] = "<img src={$skin_board_url}images/re.gif>";

	// ������ �Լ�
	include_once($site_path.'/include/lib_image_convert.php');
	
	// ���� ������ 
	$skin[icon_new] = "<img src={$skin_board_url}images/new.gif>";

	// ��б� ������ 
	$skin[icon_secret] = "<img src={$skin_board_url}images/secret.gif>";  

	// ����� ���̿� ���� ���� ���� 
	$skin[reply_space] = 10;  // �⺻���� 10
	
	// ��Ͽ��� ���� ��ũ 
	$class[link_list_view] = 'class=bbs';
	// ��� ��ũ 
	$class[link_header] = 'class=bbs';
	// ��Ÿ ��ũ 
	$class[link_bbs] = 'class=bbs';
	
	// ��Ϻ��⿡�� ��� 
	$colspan = 5;
	$colspan = ($bbs_cfg[$C_USE_CATEGORY]=='1')?$colspan+1:$colspan;
	$colspan = ($bbs_cfg[$C_AUTH_VOTE_YES]!='N')?$colspan+1:$colspan;
	$colspan = ($bbs_cfg[$C_AUTH_VOTE_NO]!='N')?$colspan+1:$colspan;
	$colspan = ($bbs_cfg[$C_AUTH_DOWNLOAD]!='N')?$colspan+1:$colspan;
?>