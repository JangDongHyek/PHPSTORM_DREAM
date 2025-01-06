<?
	require_once("include/bbs.lib.inc.php");

	if(!$auth[bbs_read]) {
		rg_href("","권한이 없습니다.","","close");
	}

	$dbqry="
		SELECT `$bbs_table`.*,
						mb_icon,mb_id,mb_name,mb_nick,mb_level,
						mb_open_info,mb_signature
		FROM `$bbs_table` LEFT JOIN `$db_table_member`
			ON rg_mb_num = mb_num
		WHERE rg_doc_num = '$doc_num'";
	$rs = mysql_query($dbqry,$dbcon);
	if(mysql_num_rows($rs)) {
		$data=mysql_fetch_array($rs);
	} else {
		rg_href("","","","close");
	}
//	$data=rg_get_doc_info($bbs_id,$doc_num);

	$html_title = ($html_title)?$html_title." > ".$data[rg_title]:$data[rg_title];	
	
	if($data[rg_deleted] && !$auth[admin]) { //삭제된글 
		rg_href("","삭제된 글입니다.","","close");
	}
	
	// 비밀글 체크
	if($data[rg_secret]) {
		if($data['rg_parent_num'] == 0) {
			$parent_data=false;
		} else {
			$parent_data=rg_get_doc_info($bbs_id,$data['rg_parent_num']);
		}
	 	// 자신의 글
		$view_check1=($mb[mb_num] == $data[rg_mb_num]);
	 	// 부모글이 자신의 글
		$view_check2=(($mb[mb_num] == $parent_data[rg_mb_num]) && $parent_data);
		
		if(!($mb && ($view_check1 || $view_check2)) && !$auth[admin]) {	
			if($bbs_cfg[$C_AUTH_SECRET] == 'A') {
				if($old_password) {  // 암호 입력이 있다면 
					// 글암호체크 
					$view_check3=(get_password_str($old_password) == $data[rg_password]);
					// 부모글암호체크 
					$view_check4=((get_password_str($old_password) == $parent_data[rg_password])
					                && $parent_data);
					
					if(!($view_check3 || $view_check4)) {
						$msg = '암호가 다릅니다.\n정확히 입력해주세요.';
						rg_href('',$msg,'','back');
					}
				} else { // 암호입력이 없다면
					$title='비밀글 암호를 입력하세요.';
					require_once("_header.php");
					include($skin_board_path."password.php");
					require_once("_footer.php");		
					exit;
				}	
			} else {
				$msg = '비밀글은 읽을수 없습니다.\n로그인이 되어 있지 않다면 로그인해주세요.';
				rg_href('',$msg,'','close');
			}
		}
		
		// 그냥 읽을수 있는조건
		// 1 로그인되어 있고, 자신의 글
		// 2 관리자
		
		// 암호 체크할경우 비밀글쓰기가 A로 되어 있는겨우  
		
		// 아예 못읽는경우 
		// 비밀글쓰기가 A가 아닌경우
		
	}
	extract($data);
	
	// 카테고리를 option 태그 로 생성한다.
	$category_list_option=rg_html_option($category_list,'cat_num','cat_name',$ss[fc]);
	
	// 글보기후 목록을 봤을때 본 글을 표시한다.
	$u_list = "{$site_url}list.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=$doc_num";
	$a_list = "<a href=\"$u_list\" $class[link_bbs]>";

	// 글 조회수 올리기 
	if($data[rg_mb_num] == '0' || $mb[mb_num] != $data[rg_mb_num]) {
		$tmp=explode(',',$_SESSION["ss_doc_hit"]);
		if(!in_array("$bbs[bbs_num]:$doc_num",$tmp)){
			$dbqry = "
				UPDATE $bbs_table SET
					`rg_doc_hit` = `rg_doc_hit` + 1
				WHERE rg_doc_num = '$doc_num'
			";
			$rs = query($dbqry,$dbcon);
			array_push($tmp, $bbs[bbs_num].':'.$doc_num);
			$ss_doc_hit = implode(',',$tmp);
//			session_register("ss_doc_hit");
			$_SESSION['ss_doc_hit']=$ss_doc_hit;
		}
		unset($tmp);
	}
	
	// 글보기 해석
	include("{$site_path}include/view.inc.php");

/************************************/
// 이전글 // 다음글 처리
/************************************/
	include("{$site_path}include/list_where.inc.php");

	// 이전글
	$dbqry = "
		SELECT *
		FROM `$bbs_table`
		WHERE (rg_next_num > '$data[rg_next_num]') $where_str
		ORDER BY rg_next_num
		LIMIT 0,1
	";
	$rs = query($dbqry,$dbcon);
	$prev_data = mysql_fetch_array($rs);

	if($prev_data) {
		$a_prev = "<a href=\"$u_images_view$prev_data[rg_doc_num]\">";
	}	else {
    $show_prev_begin = '<!--';
    $show_prev_end = '-->';
		$a_prev = '<RG--';
	}
	
	// 다음글
	$dbqry = "
		SELECT *
		FROM `$bbs_table`
		WHERE (rg_next_num < '$data[rg_next_num]') $where_str
		ORDER BY rg_next_num DESC
		LIMIT 0,1
	";
	$rs = query($dbqry,$dbcon);
	$next_data = mysql_fetch_array($rs);
	if($next_data) {
		$a_next = "<a href=\"$u_images_view$next_data[rg_doc_num]\">";
	} else {
    $show_next_begin = '<!--';
    $show_next_end = '-->';
		$a_next='<RG--';
	}
	
	include($skin_board_path."images_view.php");	
?>