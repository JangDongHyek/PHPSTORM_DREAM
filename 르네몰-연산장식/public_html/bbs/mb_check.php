<?
	require_once("include/lib.inc.php");

	$exist_jumin_begin = '<!--'; // �̵̹�ϵ� �ֹε�Ϲ�ȣ
	$exist_jumin_end = '-->';
	
	$use_jumin_begin = '<!--'; // ��밡���� �ֹε�Ϲ�ȣ
	$use_jumin_end = '-->';
	
	$wrong_jumin_begin = '<!--'; // �߸��� �ֹε�Ϲ�ȣ
	$wrong_jumin_end = '-->';
	
	$jumin = $mb_jumin1.$mb_jumin2;
	// �ֹε�Ϲ�ȣ ���� üũ
	if(!rg_check_jumun($jumin)) {
		$wrong_jumin_begin = ''; // �߸��� �ֹε�Ϲ�ȣ
		$wrong_jumin_end = '';		
	}
	else
	{

		$mb_jumin = get_password_str($jumin);
		if(rg_get_member_info($mb_jumin,3)) {	// ����ϰ� �ִ� �ֹε�Ϲ�ȣ
			$exist_jumin_begin = ''; 
			$exist_jumin_end = '';
		}
		else
		{
			$use_jumin_begin = '';						// ��밡���� �ֹε�Ϲ�ȣ
			$use_jumin_end = '';
		}
	}
	
	include($skin_site_path."mb_check.php");	
?>