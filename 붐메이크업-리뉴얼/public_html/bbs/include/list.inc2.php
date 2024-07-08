<?
	// 표시변수


	/*
	$show_chk_begin  $show_chk_end : 체크박스
	$show_vote_yes_begin  $show_vote_yes_end : 추천 보이게 함
	$show_vote_no_begin  $show_vote_no_end : 비추천 보이게 함
	*/
	$show_chk_begin = '';
	$show_chk_end = '';
	$show_vote_yes_begin = '';
	$show_vote_yes_end = '';
	$show_vote_no_begin = '';
	$show_vote_no_end = '';
	$show_category_begin = '';
	$show_category_end = '';
	$show_download_begin = '';
	$show_download_end = '';
	
	if(!$auth[bbs_cart]) {
		$show_chk_begin = '<!--';
		$show_chk_end = '-->';
	}
	
	if($bbs_cfg[$C_AUTH_VOTE_YES]=='N') {
		$show_vote_yes_begin = '<!--';
		$show_vote_yes_end = '-->';
	}
		
	if($bbs_cfg[$C_AUTH_VOTE_NO]=='N') {
		$show_vote_no_begin = '<!--';
		$show_vote_no_end = '-->';
	}
		
	if($bbs_cfg[$C_USE_CATEGORY]!='1') {
		$show_category_begin = '<!--';
		$show_category_end = '-->';
	}
		
	if($bbs_cfg[$C_AUTH_DOWNLOAD]=='N') {
		$show_download_begin = '<!--';
		$show_download_end = '-->';
	}

  $order_str='';

	$bbs_id_substr = substr($bbs_id,0,3);
	if($bbs_id_substr == "pro"){ //갤러리 우선순위
		if(count($ot) > 0) {
			$sort = array();
			foreach($ot as $key => $val) {
				if($val)
					$sort[] = "$key";
				else
					$sort[] = "$key DESC";
			}
			if(count($sort) > 0) {
				$order_str.=" ORDER BY admin_orderby DESC, rg_next_num DESC";
			}
			unset($sort);
		} else {
			$order_str .= " ORDER BY admin_orderby DESC, rg_next_num DESC";
		}
	}else{
		if(count($ot) > 0) {
			$sort = array();
			foreach($ot as $key => $val) {
				if($val)
					$sort[] = "$key";
				else
					$sort[] = "$key DESC";
			}
			if(count($sort) > 0) {
				$order_str.=" ORDER BY ".implode(",",$sort)." ";
			}
			unset($sort);
		} else {
			$order_str .= " ORDER BY rg_next_num DESC";
		}
	}

	$dbqry="
		SELECT count(*) as row_count 
		FROM `$bbs_table`
		WHERE (1=1) $where_str
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("total_doc_count"));
	
	$page_info=rg_navigation($page,$total_doc_count,$bbs[bbs_list_count],$bbs[bbs_page_count]);
	
	ob_start();
	include($skin_board_path."navigation.php");
	$print_page = ob_get_contents(); 
	ob_end_clean();

	$page=$page_info[page];
	$total_page=$page_info[total_page];

	include($skin_board_path."list_head2.php");
	$dbqry="
		SELECT `$bbs_table`.*,
						mb_icon,mb_id,mb_name,mb_nick,mb_level,mb_open_info
		FROM `$bbs_table` LEFT JOIN `$db_table_member`
			ON rg_mb_num = mb_num
		WHERE (1=1) $where_str
		$order_str
		LIMIT  $page_info[offset],$page_info[rows] ";
	
	$rs=query($dbqry,$dbcon);
	$data_no = $page_info[total_rows]-$page_info[offset]+1;
	$current_doc_num = $doc_num;
	
	if(!$skin[reply_space]) $skin[reply_space] = 10;
	if(!$skin[icon_new])
	  $skin[icon_new] = "<img src=\"{$skin_board_url}new.gif\" border=0>";
	if(!$skin[icon_reply])
		$skin[icon_reply] = "<img src=\"{$skin_board_url}re.gif\" border=0>";
	if(!$skin[icon_secret])
		$skin[icon_secret] = "<img src=\"{$skin_board_url}secret.gif\" border=0>";

	// 스킨 체크
	$bbs_notice_skin_file = "list_main2.php";
	$bbs_secret_skin_file = "list_main2.php";
	$bbs_current_doc_skin_file = "list_main2.php";
	$bbs_deleted_skin_file = "list_main2.php";


	if (file_exists($skin_board_path."list_notice2.php")) 
    $bbs_notice_skin_file = "list_notice2.php";
	if (file_exists($skin_board_path."list_secret2.php")) 
    $bbs_secret_skin_file = "list_secret2.php";
	if (file_exists($skin_board_path."list_current.php")) 
    $bbs_current_doc_skin_file = "list_current.php";
	if (file_exists($skin_board_path."list_delete.php")) 
    $bbs_deleted_skin_file = "list_delete.php";

	while ($data=mysql_fetch_array($rs)) {
		$data_no--;
		$no = $data_no;
		$mb_icon='';
		$mb_id='';
		$mb_name='';
		$mb_nick='';
		$mb_level=0;
		$mb_open_info='';
		extract($data);
		if($skin[list_view]) {
			// 글보기 해석
			include("{$site_path}include/view.inc.php");
		} else {
			$rg_email_enc=($rg_email)?urlencode($rg_email):'';
			$rg_cat_name = $category_list[$rg_cat_num][cat_name]; 
			// 회원레벨이 10이하면 html 을 사용할수 없다.
			if($mb_level<10) {
				$rg_title = rg_get_text($rg_title);
				$rg_name = rg_get_text($rg_name);
				$rg_email = rg_get_text($rg_email);
			}
			if($bbs_cfg[$C_USE_MB_ICON] && $mb_icon) { // 아이콘이 있다면 
				$rg_mb_icon = "<img src=$member_icon_url$mb_icon border=0 align=absbottom>";
			} else {
				$rg_mb_icon = '';
			}

			if($rg_file1_name && eregi('(\.gif|\.jpg|\.png)$',$rg_file1_name)) {
				$rg_file1_info = @getimagesize("{$bbs_data_url}{$rg_doc_num}\$1\$$rg_file1_name");
				//$rg_file1_url = "{$bbs_data_url}{$rg_doc_num}\$1\$$rg_file1_name";
				$rg_file1_url = "{$bbs_data_url}".urlencode("{$rg_doc_num}\$1\$$rg_file1_name");
				$rg_file1_view = rg_img_view_tag($rg_file1_url);
				$show_file1_view_begin = '';
				$show_file1_view_end = '';
			}else
			{
				$rg_file1_info = NULL;
				$rg_file1_url = NULL;
				$rg_file1_view = NULL;
				$show_file1_view_begin = '<!--';
				$show_file1_view_end = '-->';
			}
			if($rg_file2_name && eregi('(\.gif|\.jpg|\.png)$',$rg_file2_name)) {
				$rg_file2_info = @getimagesize("{$bbs_data_url}{$rg_doc_num}\$2\$$rg_file2_name");
				//$rg_file2_url = "{$bbs_data_url}{$rg_doc_num}\$2\$$rg_file2_name";
				$rg_file2_url = "{$bbs_data_url}".urlencode("{$rg_doc_num}\$2\$$rg_file2_name");
				$rg_file2_view = rg_img_view_tag($rg_file2_url);
				$show_file2_view_begin = '';
				$show_file2_view_end = '';
			}
		}
			
		// 최근글 아이콘
		if($now < ($rg_reg_date+$bbs[bbs_new_time])) {
			$rg_new_icon = $skin[icon_new];
		} else {
			$rg_new_icon = '';
		}
		// 글 깊이
		if($rg_depth > 0) {
			$rg_reply = "<img height=1 width=".($rg_depth*$skin[reply_space])." border=0>".$skin[icon_reply];
		} else {
			$rg_reply = '';
		}
		// 비밀글이라면
		if($rg_secret > 0) {
			$rg_secret_icon = $skin[icon_secret];
		} else {
			$rg_secret_icon = '';
		}
		
		$rg_reg_date = rg_date($data[rg_reg_date],$bbs[bbs_list_date_disp]);
		$a_list_view = "<a href=\"$u_view$data[rg_doc_num]\" $class[link_list_view]>";
		$rg_cmt_count = ($rg_cmt_count)?"[$rg_cmt_count]":"";

		if($rg_doc_num == $current_doc_num) { // 현재글 
			include($skin_board_path.$bbs_current_doc_skin_file);
		} else if($rg_deleted) { // 삭제된글이라면
			if(!$auth[admin])
				$a_list_view = "<a $class[link_list_view]>";
			include($skin_board_path.$bbs_deleted_skin_file);
		} else if($rg_notice > 0) { // 공지사항 
			include($skin_board_path.$bbs_notice_skin_file);
		} else if($rg_secret > 0) { // 비밀글 
			include($skin_board_path.$bbs_secret_skin_file);
		} else { // 일반글
			include($skin_board_path."list_main2.php");
		}
	}

	//include($skin_board_path."list_foot.php");
?>	
