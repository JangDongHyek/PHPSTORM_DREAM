<?
if (!defined('CONFIG_INC_INCLUDED')) {  
  define('CONFIG_INC_INCLUDED', 1);
// *-- CONFIG_INC_INCLUDED START --*
	@error_reporting(E_ALL ^ E_NOTICE);
	// ������� 2005-10-01 ver 3.1.5 �ǿø�
	$C_MALL_VERSION = '1.2';
	
	// �Խ��Ǽ��� �������
	/*$C_AUTH_READ = 1;*/

	// ȸ�� ��� �������
	/*$MB_C_NICK = 1;
	$MB_C_NAME = 2;
	$MB_C_EMAIL = 3;
	$MB_C_MSN = 4;
	$MB_C_HOMEPAGE = 5;
	$MB_C_TEL = 6;
	$MB_C_MOBILE = 7;
	$MB_C_JUMIN = 8;
	$MB_C_BIRTH = 9;
	$MB_C_ADDRESS = 10;
	$MB_C_SEX = 11;
	$MB_C_JOB = 12;
	$MB_C_HOBBY = 13;
	$MB_C_PHOTO = 14;
	$MB_C_ICON = 15;
	$MB_C_SIGNATURE = 16;
	$MB_C_GREET = 17;*/
	
	// �Խ��� ����
	if(!$site_url) $site_url="./";
	
	$msg_upload_ext = "���ε�� %file_ext%Ȯ���ڸ� �����մϴ�";
	$msg_noupload_ext = "���ε�� %file_ext%Ȯ���ڸ� ������ ���ϸ� �����մϴ�";
	$msg_not_find_mb_id = "%mb_id%�� ���� ���̵��Դϴ�.";
	$msg_no_match_mb_password = "��ȣ�� �ٸ��ϴ�.";
	
	$msg_exist_mb_id = "%mb_id%�� ������� ���̵��Դϴ�.";
	$msg_exist_mb_nick = "%mb_nick%�� ������� �г����Դϴ�.";
	$msg_exist_mb_jumin = "�̹� ��ϵ� �ֹε�Ϲ�ȣ�Դϴ�.";
	$msg_check_mb_jumin = "�߸��� �ֹε�Ϲ�ȣ�Դϴ�.";
	
	$msg_exist_gr_mb_id = "%id%�� �̹̰��Ե� ���̵��Դϴ�.";

	$msg_mb_password_required = "���� �Է����ּ���.";
	$msg_mb_password_not_find = "�ش� ȸ���� �����ϴ�.";
	$msg_mb_password_mail_subject = "%id% ���� ����� ��ȣ�Դϴ�.";
	$msg_mb_password_send_ok = "��ȣ�� �����߽��ϴ�.";

	$msg_normal_error = "�߸��� �����Դϴ�.";

	/**
	*	���� �߰��� ����
	*/
	// �̹��� Ÿ�� �迭
	$imageTypes = array(
		1 => 'GIF',
		2 => 'JPG',
		3 => 'PNG',
		4 => 'SWF',
		5 => 'PSD',
		6 => 'BMP',
		7 => 'TIFF(intel byte order)',
		8 => 'TIFF(motorola byte order)',
		9 => 'JPC',
		10 => 'JP2',
		11 => 'JPX',
		12 => 'JB2',
		13 => 'SWC',
		14 => 'IFF',
		15 => 'WBMP',
		16 => 'XBM'
	);

	/**
 	* Unset magic_quotes_runtime - do not change!
 	*/
	set_magic_quotes_runtime(0);
	
} // *-- CONFIG_INC_INCLUDED END --*
?>