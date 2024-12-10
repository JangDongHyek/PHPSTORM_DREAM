<?
if (!defined('LIB_INC_INCLUDED')) {  
    define('LIB_INC_INCLUDED', 1);
// *-- LIB_INC_INCLUDED START --*

	if ($_REQUEST[site_path] || $_REQUEST[skin_site_path]) {
		echo "<script>alert(\"불법 접근 금지\");</script>";
		exit;
	}
	if(!$site_path || eregi(":\/\/",$site_path)) $site_path='./';
	
	require_once("{$site_path}include/config.inc.php");
	require_once("{$site_path}include/func.inc.php");
	require_once("{$site_path}include/mysql.inc.php");

	// 에드온이라면 
	if(eregi('addon.php$',$HTTP_SERVER_VARS["PHP_SELF"])) 
		$is_addon = true;
	else
		$is_addon = false;

	$now = time();
	$agent = rg_get_agent();
	
	$data_path = $site_path.$data_dir;
	$data_url = $site_url.$data_dir;

	$site_addon_path = $site_path.$addon_dir;
	$site_addon_url = $site_url.$addon_dir;
	
	$session_tmp_path = $data_path.$session_tmp_dir;
	$member_photo_path = $data_path.$member_photo_dir;
	$member_icon_path = $data_path.$member_icon_dir;

	$member_photo_url = $data_url.$member_photo_dir;
	$member_icon_url = $data_url.$member_icon_dir;

	$skin_path = $site_path.$skin_dir;
	$skin_board_path = $skin_path.$skin_board_dir.$skin_site_id.'/';
	$skin_member_path = $skin_path.$skin_member_dir.$skin_member_id.'/';
	$skin_site_path = $skin_path.$skin_site_dir.$skin_site_id.'/';

	$skin_url = $site_url.$skin_dir;
	$skin_board_url = $skin_url.$skin_board_dir.$skin_site_id.'/';
	$skin_member_url = $skin_url.$skin_member_dir.$skin_member_id.'/';
	$skin_site_url = $skin_url.$skin_site_dir.$skin_site_id.'/';
	$skin_site_path = $skin_path.$skin_site_dir.$skin_site_id.'/';

//	@session_set_cookie_params (0,'/',$main_domain);
	if(is_dir($session_tmp_path))
		@session_save_path($session_tmp_path);
  session_cache_limiter('nocache, must-revalidate');
  session_start();

	// register_globals 설정이 안되어 있을경우
	if (!ini_get('register_globals')) {
		$raw = phpversion();
		list($v_Upper,$v_Major,$v_Minor) = explode(".",$raw);
		// PHP 버전이 4.1.0 이하인 경우
		if(($v_Upper >= 4 && $v_Major < 1) || $v_Upper < 4){
			$_FILES = $HTTP_POST_FILES;
			$_ENV = $HTTP_ENV_VARS;
			$_GET = $HTTP_GET_VARS;
			$_POST = $HTTP_POST_VARS;
			$_COOKIE = $HTTP_COOKIE_VARS;
			$_SERVER = $HTTP_SERVER_VARS;
			$_SESSION = $_SESSION;
		}
		extract($HTTP_POST_FILES);
		extract($HTTP_ENV_VARS);
		extract($HTTP_GET_VARS);
		extract($HTTP_POST_VARS);
		extract($HTTP_COOKIE_VARS);
		extract($HTTP_SERVER_VARS);
		extract($_SESSION);
		foreach($HTTP_POST_FILES as $key => $value) {
			$GLOBALS[$key]=$HTTP_POST_FILES[$key]['tmp_name'];
			foreach($value as $ext => $value2) {
				$key2 = $key."_".$ext;
				$GLOBALS[$key2]=$value2;
			}
		}
	}

	// 글조회수 변수 리셋
	if(strlen($_SESSION["ss_doc_hit"])>$site_bbs_view_chk_size) {
		$ss_doc_hit='';
//		session_register("ss_doc_hit");
		$_SESSION['ss_doc_hit']=$ss_doc_hit;
	}

	// 글투표 변수 리셋
	if(strlen($_SESSION["ss_doc_vote"])>$site_bbs_vote_chk_size) {
		$ss_doc_vote='';
//		session_register("ss_doc_vote");
		$_SESSION['ss_doc_vote']=$ss_doc_vote;
	}

	$dbconf=@file("{$site_path}data/db.inc.php");
	if(!$dbconf) {
		rg_href($site_path.'admin/install.php');
		exit;
	}

	if(count($dbconf) < 8) {
		include($skin_site_path."head.php");
		$error_msg = '데이타베이스 설정 파일에러';
		include($skin_site_path.'error.php');	
		include($skin_site_path."foot.php");
		exit;
	}
	for($i=0;$i<count($dbconf);$i++) {
		$dbconf[$i]=trim(str_replace("\n","",$dbconf[$i]));
	}

	if($dbconf[0] != '<'.'?' || $dbconf[count($dbconf)-1] != '?'.'>') {
		include($skin_site_path."head.php");
		$error_msg = '데이타베이스 설정 파일에러';
		include($skin_site_path.'error.php');	
		include($skin_site_path."foot.php");
		exit;
	}
	
	$mysql_host = $dbconf[3];
	$mysql_user = $dbconf[4];
	$mysql_password = $dbconf[5];
	$mysql_database_name = $dbconf[6];
	unset($dbconf);
	
	$referer=($HTTP_REFERER)?$HTTP_REFERER:"$site_url";
	
	$dbcon=dbinit();
	$site = rg_get_site_cfg();  // 사이트정보 로딩
	$site[st_join_form_cfg] = explode (',', $site[st_join_form_cfg]);

	$auth[admin] = false; 
	
	// 로그인 되어 있는 상태라면 회원 정보를
	if(($_SESSION[ss_login_ok]=='ok') && !empty($_SESSION[ss_mb_id])) {
		$mb=rg_get_member_info($_SESSION[ss_mb_id]);
		if(!$mb) { // 로그인되어 있는 회원의 정보가 올바르지 않다면 로그아웃.
			session_unregister("ss_mb_id");
			session_unregister("ss_mb_num");
			session_unregister("ss_login_ok");
			unset($mb);
		} else {
				// 권한설정
				// 회원레벨이 10이면 사이트관리자 
			$auth[site_admin] = ($mb[mb_level]>9)?true:false; 
				// 일반적으로 회원레벨이 10,그룹레벨이 10,
				// 게시판 관리자일경우 admin 은 참이 된다.
			$auth[admin] = ($auth[site_admin])?true:$auth[admin]; 
		}
	}
	
	// 현재 접속자수 체크
	if($site[st_connect_time]>0) { 
		$dbqry="
			INSERT INTO `$db_table_connect` 
				( `con_num` , `con_mb_id` , `con_mb_icon` ,
					`con_date` , `con_ip` ) 
			VALUES 
				( '', '$mb[mb_id]', '$mb[mb_icon]',
					'$now', '$REMOTE_ADDR'
				)
		";
		$tmp=query($dbqry,$dbcon,1);
		if(!$tmp) {
			$dbqry="
				UPDATE `$db_table_connect` SET
					`con_mb_id` = '$mb[mb_id]',
					`con_mb_icon` = '$mb[mb_icon]',
					`con_date` = '$now'
				WHERE con_ip = '$REMOTE_ADDR'
			";
			query($dbqry,$dbcon);
		}
		$dbqry="
			DELETE FROM `$db_table_connect`
			WHERE `con_date`+$site[st_connect_time] < '$now'
		";
		query($dbqry,$dbcon);
	}
	
	if($mb) {
		$show_mb_login_begin = '';
		$show_mb_login_end = '';
		$show_mb_logout_begin = '<!--';
		$show_mb_logout_end = '-->';
	} else {
		$show_mb_login_begin = '<!--';
		$show_mb_login_end = '-->';
		$show_mb_logout_begin = '';
		$show_mb_logout_end = '';
	}	

	if($mb) {
		$a_login="<RG----";
		$a_member_join="<RG----";
		$a_member_password="<RG----";
		$a_member_modify="<a href={$site_url}mb_edit.php?url=".urlencode($HTTP_SERVER_VARS['REQUEST_URI'])." $class[link_header]>";
		$a_member_memo="<RG--";
//		$a_member_memo="<a href={$site_url}mb_memo.php $class[link_header]>";
		$a_logout="<a href={$site_url}mb_logout.php?url=".urlencode($HTTP_SERVER_VARS['REQUEST_URI'])." $class[link_header]>";

		$a_member_leave="<a href={$site_url}mb_leave.php?url=".urlencode($HTTP_SERVER_VARS['REQUEST_URI'])." $class[link_header]>";
	} else {
		$a_login="<a href={$site_url}mb_login.php?url=".urlencode($HTTP_SERVER_VARS['REQUEST_URI'])." $class[link_header]>";
		$a_member_join="<a href={$site_url}mb_join.php?url=".urlencode($HTTP_SERVER_VARS['REQUEST_URI'])." $class[link_header]>";
		$a_member_password="<a href={$site_url}mb_password.php?url=".urlencode($HTTP_SERVER_VARS['REQUEST_URI'])." $class[link_header]>";
		$a_member_modify="<RG----";
		$a_member_memo="<RG----";
		$a_logout="<RG----";
		$a_member_leave="<RG----";
	}

	$html_title = $site[st_site_name];
} // *-- LIB_INC_INCLUDED END --*
?>