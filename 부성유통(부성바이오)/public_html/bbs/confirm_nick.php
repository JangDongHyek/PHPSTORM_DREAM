<?
	require_once("include/lib.inc.php");

	$exist_nick_begin = '<!--'; // �̵̹�ϵ� �г���
	$exist_nick_end = '-->';
	
	$use_nick_begin = '<!--'; // ��밡���� �г���
	$use_nick_end = '-->';
	
	$no_nick_input_begin = '<!--'; // �г��� �Է��� ����
	$no_nick_input_end = '-->';
	
	if($nick) {
		if(rg_get_member_info($nick,2)) {
				$exist_nick_begin = '';
				$exist_nick_end = '';
		} else {
			$use_nick_begin = '';
			$use_nick_end = '';
		}
	} else {
		$no_nick_input_begin = '';
		$no_nick_input_end = '';
	}
	
	include($skin_site_path."confirm_nick.php");
	
?>