<?
	if(realpath($_SERVER[SCRIPT_FILENAME]) == realpath(__FILE__)) exit;

	// ������ �Լ�
	include_once($site_path.'/include/lib_image_convert.php');
	
	// ���� ������ 
	$skin_icon_new = "";  
	//�⺻�� <img src=\"{$skin_board_url}new.gif\">
	$img_width = 150; // �̹��� ����
	$img_height = 150; // �̹��� ����
	
	$skin_date_format = '%Y-%m-%d'; // ����Ʈǥ������
	$class[link_title] = ' class=lastest';
	$class[link_list] = ' class=lastest';
?>