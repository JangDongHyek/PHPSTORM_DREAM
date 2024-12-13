<?
	require_once("../bbs/include/mobile.bbs.lib.inc.php");
	if(!$auth[bbs_list]) {
		$error_msg = '권한이 없습니다.';
		//require_once("_mobile_header.php");
		if( $mb && ($HTTP_SESSION_VARS[ss_login_ok]=='ok') && !empty($HTTP_SESSION_VARS[ss_mb_id]))
		{
		
			include($skin_board_path."mobile_error.php");
		}else{
			$login_url = "mobile_mb_login.php";
			$url = "mobile_list.php?bbs_id=$bbs_id";
			include("mobile_mb_login.php");
		}
		//require_once("_mobile_footer.php");
		exit;
	}

	require_once("_mobile_header.php");
	// 카테고리를 option 태그 로 생성한다.	
	$category_list_option=rg_html_option($category_list,'cat_num','cat_name',$ss[fc]);
	include("{$site_path}include/list_where.inc.php");
	include("{$site_path}include/mobile.list.inc.php");
	require_once("_mobile_footer.php");

	// 로봇등록을 방지 하기 위해서	
	if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
		$_SESSION['write_key']=$bbs[bbs_num].'.'.$bbs[bbs_id];
	}
?>