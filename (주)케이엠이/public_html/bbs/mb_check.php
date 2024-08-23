<?
	require_once("include/lib.inc.php");

	$exist_jumin_begin = '<!--'; // 이미등록된 주민등록번호
	$exist_jumin_end = '-->';
	
	$use_jumin_begin = '<!--'; // 사용가능한 주민등록번호
	$use_jumin_end = '-->';
	
	$wrong_jumin_begin = '<!--'; // 잘못된 주민등록번호
	$wrong_jumin_end = '-->';
	
	$jumin = $mb_jumin1.$mb_jumin2;
	// 주민등록번호 형식 체크
	if(!rg_check_jumun($jumin)) {
		$wrong_jumin_begin = ''; // 잘못된 주민등록번호
		$wrong_jumin_end = '';		
	}
	else
	{

		$mb_jumin = get_password_str($jumin);
		if(rg_get_member_info($mb_jumin,3)) {	// 사용하고 있는 주민등록번호
			$exist_jumin_begin = ''; 
			$exist_jumin_end = '';
		}
		else
		{
			$use_jumin_begin = '';						// 사용가능한 주민등록번호
			$use_jumin_end = '';
		}
	}
	
	include($skin_site_path."mb_check.php");	
?>