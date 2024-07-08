<?
	require_once("include/lib.inc.php");

	$exist_id_begin = '<!--'; // 이미등록된 아이디
	$exist_id_end = '-->';
	
	$use_id_begin = '<!--'; // 사용가능한 아이디
	$use_id_end = '-->';
	
	$no_id_input_begin = '<!--'; // 아이디 입력이 없음
	$no_id_input_end = '-->';
	
	if($id) {
		if(rg_get_member_info($id)) {
				$exist_id_begin = '';
				$exist_id_end = '';
//			echo "이미 등록된 아이디입니다.";
		} else {
			$use_id_begin = '';
			$use_id_end = '';
//			echo "사용 가능한 아이디입니다.";
		}
	} else {
		$no_id_input_begin = '';
		$no_id_input_end = '';
//		echo "아이디를 입력해주세요.";
	}
	
	include($skin_site_path."confirm_id.php");
	
?>