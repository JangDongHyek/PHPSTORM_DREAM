<?
	require_once("include/lib.inc.php");

	$exist_id_begin = '<!--'; // �̵̹�ϵ� ���̵�
	$exist_id_end = '-->';
	
	$use_id_begin = '<!--'; // ��밡���� ���̵�
	$use_id_end = '-->';
	
	$no_id_input_begin = '<!--'; // ���̵� �Է��� ����
	$no_id_input_end = '-->';
	
	if($id) {
		if(rg_get_member_info($id)) {
				$exist_id_begin = '';
				$exist_id_end = '';
//			echo "�̹� ��ϵ� ���̵��Դϴ�.";
		} else {
			$use_id_begin = '';
			$use_id_end = '';
//			echo "��� ������ ���̵��Դϴ�.";
		}
	} else {
		$no_id_input_begin = '';
		$no_id_input_end = '';
//		echo "���̵� �Է����ּ���.";
	}
	
	include($skin_site_path."confirm_id.php");
	
?>