<?
	if(realpath($_SERVER[SCRIPT_FILENAME]) == realpath(__FILE__)) exit;

	// ������ �Լ�
	include_once($site_path.'/include/lib_image_convert.php');

	// ����� ������
	$skin[icon_reply] = ''; 
	//�⺻�� <img src=\"{$skin_board_url}re.gif\">
	// ���� ������ 
	$skin[icon_new] = '';  
	//�⺻�� <img src=\"{$skin_board_url}new.gif\">
	// ����� ���̿� ���� ���� ���� 
	$skin[reply_space] = 10;  // �⺻���� 10
	
	// ��Ͽ��� ���� ��ũ 
	$class[link_list_view] = ' class=bbs';
	// ��� ��ũ 
	$class[link_header] = ' class=bbs';
	// ��Ÿ ��ũ 
	$class[link_bbs] = ' class=bbs';
	
	$cols = 3;				// ���ٿ� ������ �̹��� ���� 
	$img_width = 120; // �̹��� ����
	$img_view_width_percent = 70; // �ۺ���� �̹��� ũ�� ���� (%)
	
	// �������� ��� ������ �����Ѵ�. 
	if(($bbs[bbs_list_count] % $cols) > 0) {
		$bbs[bbs_list_count] += $cols - ($bbs[bbs_list_count] % $cols);
	}
	
	$colspan = $cols;
	
?>