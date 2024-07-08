<?
	require_once("include/mobile.bbs.lib.inc.php");
	$mode_edit=true;
	$mode = 'edit';
	$html_title = ($html_title)?$html_title." > 글수정":'';

	// 글수정 권한 체크
	if(!$auth[bbs_edit]) {
		$error_msg = '권한이 없습니다.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}
	
	// 글쓰기 금지 아이피 체크
	if(rg_chk_deny_ip($bbs[bbs_deny_write_ip],$REMOTE_ADDR)) {
		$error_msg = $REMOTE_ADDR.'에서는 수정권한이 없습니다.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}
	
	$u_action = $u_edit.$doc_num;
	$rg_doc_num = $doc_num;
	
	$data=rg_get_doc_info($bbs_id,$doc_num);
	if($data[rg_parent_num]) 
		$chk = $bbs_cfg[$C_AUTH_REPLY]; // 응답글이 라면
	else
		$chk = $bbs_cfg[$C_AUTH_WRITE]; // 응답글이 아니라면
	
	// 관련글이 있다면 수정 옵션일 경우 처리 
	if(($bbs_cfg[$C_REPLY_DELETE]==1) || ($bbs_cfg[$C_REPLY_DELETE]==2)) {
		$dbqry = "
			SELECT count(*)
			FROM `$bbs_table`
			WHERE `rg_parent_num` = '$data[rg_doc_num]'
		";
		$rs = query($dbqry,$dbcon);
		$tmp = mysql_fetch_array($rs);
		if($tmp[0]) { // 응답글이 있다면 
			$error_msg = '응답글이 있으면 수정하실수 없습니다.';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_error.php");
			require_once("_mobile_footer.php");
			exit;
		}
	}
	// 로그인이 되어 있지 않거나 자신의 글이 아니고 관리자가 아니라면
	if((!$mb || ($data[rg_mb_num] != $mb[mb_num])) && !$auth[admin]) { 
		if($old_password) {  // 암호 입력이 있다면
			if($data[rg_password] != get_password_str($old_password)) {
				$msg = '암호가 다릅니다.\n정확히 입력해주세요.';
				rg_href('',$msg,'','back');
			}
		} else { // 암호입력이 없다면
			$title='글수정 암호를 입력하세요.';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_password.php");
			require_once("_mobile_footer.php");		
			exit;
		}		
	}
	
	if($data[rg_mb_num])
		$doc_mb_info = rg_get_member_info($data[rg_mb_num],1);
	
	if($act=='ok') {			
		// 원격글쓰기 제한
		if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
			if(trim($HTTP_SERVER_VARS['HTTP_REFERER'])=='') {
				$error_msg = '원격글쓰기 제한';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
			if($_SESSION['write_key']!=$bbs[bbs_num].'.'.$bbs[bbs_id]) {
				$error_msg = '로봇에의한 글쓰기 제한';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
		}
		unset($_SESSION['write_key']);
		
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value)) {
				$GLOBALS[$key]=trim($value);
			}

		if($tmp = rg_str_inword($bbs[bbs_deny_word],$rg_title)) {
				echo ("
                        <script language=javascript>
                                alert(\"$tmp (은)는 사용할수 없는 단어입니다.\");
                        </script>
                        <form name='form' action='board_write.htm?mode=$mode&bbs_id=$bbs_id' method='post'>
                                <input type='hidden' name='rg_title' value='".urlencode($rg_title)."'>
								<input type='hidden' name='rg_html_use' value='$rg_html_use'>
                                <input type='hidden' name='rg_content' value='".urlencode($rg_content)."'>
                        </form>
                        <script>
                        document.form.submit();
                        </script>
                ");
                exit;			
			//$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
			//require_once("_mobile_header.php");
			//include($skin_board_path."mobile_error.php");
			//require_once("_mobile_footer.php");
			//exit;
		}

		if($tmp = rg_str_inword($bbs[bbs_deny_word],$rg_content)) {
                echo ("
                        <script language=javascript>
                                alert(\"$tmp (은)는 사용할수 없는 단어입니다.\");
                        </script>
                        <form name='form' action=''board_write.htm?mode=$mode&bbs_id=$bbs_id' method='post'>
                                <input type='hidden' name='rg_title' value='".urlencode($rg_title)."'>
								<input type='hidden' name='rg_html_use' value='$rg_html_use'>
                                <input type='hidden' name='rg_content' value='".urlencode($rg_content)."'>
                        </form>
                        <script>
                        document.form.submit();
                        </script>
                ");
                exit;
			//$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
			//require_once("_mobile_header.php");
			//include($skin_board_path."mobile_error.php");
			//require_once("_mobile_footer.php");
			//exit;
		}


		$dbqry = "SHOW COLUMNS FROM `$bbs_table` LIKE 'rg_file%_name'";
		$rs = mysql_query($dbqry, $dbcon);

		$fi = 1;
		while($col_images = mysql_fetch_array($rs))
		{
			${"rg_file{$fi}_name"} = $data["rg_file{$fi}_name"];
			${"rg_file{$fi}_size"} = $data["rg_file{$fi}_size"];
			$fi++;
		}
		
		// 패스워드 수정시
		if($rg_password) {
			$rg_password = get_password_str($rg_password);
			$sql_password = "`rg_password` = '$rg_password',";
		}

		// 게시판 설정이 전체가 아니고 , 회원이 맞다면
		if($chk != 'A' && $doc_mb_info) {
			$rg_name = $data[rg_name];
			$rg_email = $data[rg_email];
//			$rg_home_url = $data[mb_homepage]; // 2003-10-15 항상홈페이지입력가능
		} else {
			if($rg_name=='') {
				$error_msg = '이름을 입력해주세요.';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
		}
		
		// 공지체크가 안되어 있다면 공백이라서
		if(!$rg_notice) $rg_notice = 0; 
		// 관리자라면 공지 사용가능
		$rg_notice = ($auth[bbs_notice])?$rg_notice:'0';
		$rg_html_use = ($auth[bbs_html])?$rg_html_use:'0';

		// 공지상태가 변하고, 최상위글 이라면
		if(($rg_notice != $data[rg_notice]) && ($data[rg_parent_num] == 0)) {
			if($rg_notice>0) {
				// 공지사항인경우 next_num 값을 구한다(최고로 큰값으로)
				$dbqry="
					SELECT max(rg_next_num) as rg_next_num
					FROM `$bbs_table`
				";
				$rs=query($dbqry,$dbcon);
				$tmp = mysql_fetch_array($rs);
				$rg_next_num = $tmp[rg_next_num];
				
				// 자신의 글보다 next_num 이 크면 하나씩 내린다.
				$dbqry="
					UPDATE `$bbs_table` SET
						`rg_next_num` = `rg_next_num` - 1
					WHERE rg_next_num > '$data[rg_next_num]'
				";
				query($dbqry,$dbcon);
			} else {
				// 공지사항이 아닌경우 next_num 값을 구한다
				// top번호를 기준으로 자신의 글보다 작은것중 큰값을 구한다.
				$dbqry="
					SELECT max(rg_next_num) as rg_next_num
					FROM `$bbs_table`
					WHERE rg_top_num < '$data[rg_top_num]'
						AND rg_notice = 0
				";
				$rs=query($dbqry,$dbcon);
				$tmp = mysql_fetch_array($rs);
				$rg_next_num = $tmp[rg_next_num]+1;
				
				// 공지사항아니고 새로운 next 보다 크고,
				// 공지사항이면서 자신의 next 보다 작다면 올린다
				$dbqry="
					UPDATE `$bbs_table` SET
						`rg_next_num` = `rg_next_num` + 1
					WHERE ( rg_next_num >= '$rg_next_num'
						AND rg_notice = 0 )
						 OR ( rg_next_num < '$data[rg_next_num]'
						AND rg_notice = 1 )
				";
				query($dbqry,$dbcon);
			}		
			$sql_next_num = "`rg_next_num` = '$rg_next_num',";
		}
		
		// 업로드 체크
		include("../bbs/include/upload_chk.inc.php");
		
		// 업로드 처리
		if($bbs_id == "flash"){
			include("../bbs/include/upload.inc.ori.php");
		}else{
			include("../bbs/include/upload.inc.php");
		}
		
		$rg_home_url=rg_homepage_chk($rg_home_url);

		$bbs_id_substr = substr($bbs_id,0,3);
		if($bbs_id_substr == "pro"){ //갤러리우선순위
			$admin_orderby_query= ",`admin_orderby` = '$admin_orderby'";
		}
		if($bbs_id == "yeyak"){
			$rg_ext3=$rg_ext3_1."-".$rg_ext3_2."-".$rg_ext3_3;
			
		}

		$dbqry="
			UPDATE `$bbs_table` SET
				$sql_password
				$sql_next_num
				`rg_name` = '$rg_name',
				`rg_email` = '$rg_email',
				`rg_home_url` = '$rg_home_url',
				`rg_cat_num` = '$rg_cat_num',
				`rg_title` = '$rg_title',
				`rg_content` = '$rg_content',
				`rg_html_use` = '$rg_html_use',
				`rg_link1_url` = '$rg_link1_url',
				`rg_link2_url` = '$rg_link2_url',
				`rg_notice` = '$rg_notice',
				`rg_secret` = '$rg_secret',
				`rg_reply_mail` = '$rg_reply_mail',
				`rg_ext1` = '$rg_ext1',
				`rg_ext2` = '$rg_ext2',
				`rg_ext3` = '$rg_ext3',
				`rg_ext4` = '$rg_ext4',
				`rg_ext5` = '$rg_ext5' $admin_orderby_query";

		if($bbs_id == "flash"){
			for($fi=1;$fi<=$rg_files_count;$fi++) {
					  if($fi==1){//작은이미지
						$dbqry .= ", `rg_file{$fi}_name` = 'small".$admin_orderby.".jpg'";
						$dbqry .= ", `rg_file{$fi}_size` = '".${"rg_file{$fi}_size"}."'";
					  }else{//큰이미지
						$dbqry .= ", `rg_file{$fi}_name` = 'big".$admin_orderby.".jpg'";
						$dbqry .= ", `rg_file{$fi}_size` = '".${"rg_file{$fi}_size"}."'";
					  }
			}
		}else{
			for($fi=1;$fi<=$rg_files_count;$fi++) {
				$dbqry .= ", `rg_file{$fi}_name` = '".${"rg_file{$fi}_name"}."'";
				$dbqry .= ", `rg_file{$fi}_size` = '".${"rg_file{$fi}_size"}."'";
			}
		}

		$dbqry .= " WHERE rg_doc_num='$rg_doc_num'
		";
		query($dbqry,$dbcon);

	################################################################

	if($bbs_id == "flash"){
		if($admin_orderby_old > $admin_orderby){ //4->2로 변경 한다고 가정 순서앞으로

				//2를 9999로 변경
				$small_newfile="small9999.jpg";
				$big_newfile = "big9999.jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small".$admin_orderby.".jpg",$small_newfile_url); 
				rename($bbs_data_path."big".$admin_orderby.".jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='9999' where admin_orderby='$admin_orderby'";
				query($sql2,$dbcon);
	


				//4를 2로변경
				$small_newfile="small".$admin_orderby.".jpg";
				$big_newfile = "big".$admin_orderby.".jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small".$admin_orderby_old.".jpg",$small_newfile_url); 
				rename($bbs_data_path."big".$admin_orderby_old.".jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$admin_orderby' where admin_orderby='$admin_orderby_old'";
				query($sql2,$dbcon);



				//4와 2사이에 있는거 전부 +1
				$admin_orderby_chai=$admin_orderby_old - $admin_orderby;
				if($admin_orderby_chai > 1){ //사이에 1개라도 있으면 실행				
					$sql2 = "select * from `$bbs_table` where admin_orderby < '$admin_orderby_old' and admin_orderby > '$admin_orderby' order by admin_orderby desc";
					$result2 = query($sql2,$dbcon); //4하고 2사이에 있는거
					for($k=0;$rows=mysql_fetch_array($result2);$k++){	
						
						$rows_admin_orderby = $rows[admin_orderby] + 1;

						$small_newfile="small".$rows_admin_orderby.".jpg";
						$big_newfile = "big".$rows_admin_orderby.".jpg";
						$small_newfile_url=$bbs_data_path.$small_newfile;
						$big_newfile_url = $bbs_data_path.$big_newfile;

						rename($bbs_data_path."small".$rows[admin_orderby].".jpg",$small_newfile_url); 
						rename($bbs_data_path."big".$rows[admin_orderby].".jpg",$big_newfile_url); 

						$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$rows_admin_orderby' where admin_orderby='$rows[admin_orderby]'";

						query($sql2,$dbcon);						
					}
				}	
							

				//9999로 바꼈던 2를 +1하기

				$admin_orderby_1 = $admin_orderby + 1;

				$small_newfile="small".$admin_orderby_1.".jpg";
				$big_newfile = "big".$admin_orderby_1.".jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small9999.jpg",$small_newfile_url); 
				rename($bbs_data_path."big9999.jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$admin_orderby_1' where admin_orderby='9999'";
				query($sql2,$dbcon);



		}elseif($admin_orderby_old < $admin_orderby){ //2->4로 변경 한다고 가정 순서뒤로

				//4를 9999로 변경
				$small_newfile="small9999.jpg";
				$big_newfile = "big9999.jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small".$admin_orderby.".jpg",$small_newfile_url); 
				rename($bbs_data_path."big".$admin_orderby.".jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='9999' where admin_orderby='$admin_orderby'";
				query($sql2,$dbcon);
	


				//2를 4로변경
				$small_newfile="small".$admin_orderby.".jpg";
				$big_newfile = "big".$admin_orderby.".jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small".$admin_orderby_old.".jpg",$small_newfile_url); 
				rename($bbs_data_path."big".$admin_orderby_old.".jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$admin_orderby' where admin_orderby='$admin_orderby_old'";
				query($sql2,$dbcon);



				//2와 4사이에 있는거 전부 -1
				$admin_orderby_chai=$admin_orderby - $admin_orderby_old;
				if($admin_orderby_chai > 1){ //사이에 1개라도 있으면 실행				
					$sql2 = "select * from `$bbs_table` where admin_orderby > '$admin_orderby_old' and admin_orderby < '$admin_orderby' order by admin_orderby asc";
					$result2 = query($sql2,$dbcon); //4하고 2사이에 있는거
					for($k=0;$rows=mysql_fetch_array($result2);$k++){	
						
						$rows_admin_orderby = $rows[admin_orderby] - 1;

						$small_newfile="small".$rows_admin_orderby.".jpg";
						$big_newfile = "big".$rows_admin_orderby.".jpg";
						$small_newfile_url=$bbs_data_path.$small_newfile;
						$big_newfile_url = $bbs_data_path.$big_newfile;

						rename($bbs_data_path."small".$rows[admin_orderby].".jpg",$small_newfile_url); 
						rename($bbs_data_path."big".$rows[admin_orderby].".jpg",$big_newfile_url); 

						$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$rows_admin_orderby' where admin_orderby='$rows[admin_orderby]'";

						query($sql2,$dbcon);						
					}
				}	
							

				//9999로 바꼈던 4를 -1하기

				$admin_orderby_1 = $admin_orderby - 1;

				$small_newfile="small".$admin_orderby_1.".jpg";
				$big_newfile = "big".$admin_orderby_1.".jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small9999.jpg",$small_newfile_url); 
				rename($bbs_data_path."big9999.jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$admin_orderby_1' where admin_orderby='9999'";
				query($sql2,$dbcon);



		}
	}

	################################################################
		
		// 비밀글을 썻다면 글목록으로
		if($rg_secret && $bbs[bbs_act_after]=='1') $bbs[bbs_act_after]='';
		
		switch($bbs[bbs_act_after]){
			case '' : 
			case '0' : 
					rg_href("mobile_list.php?$p_str&page=$page&bbs_id=$bbs_id&doc_num=$rg_doc_num");
					break;
			case '1' : 
					rg_href("mobile_view.php?$p_str&page=$page&bbs_id=$bbs_id&doc_num=$rg_doc_num");
					break;
			default : 
					rg_href($bbs[bbs_act_after]);
					break;
		}
	}
	extract($data);
	$rg_title=htmlspecialchars($rg_title,ENT_QUOTES);
	$rg_content=htmlspecialchars($rg_content,ENT_QUOTES);
	// 카테고리명
	$cat_name = $category_list[$cat_num][cat_name]; 
	$category_list_option=rg_html_option($category_list,'cat_num','cat_name',$rg_cat_num);
	$checked_notice=($rg_notice)?'checked':'';
	$checked_secret=($rg_secret)?'checked':'';
	$checked_reply_mail=($rg_reply_mail)?'checked':'';
	${'checked_html_use'.$rg_html_use} = 'checked';

	// 쓰기또는 응답글이 전체가 아니고 , 로그인 상태에서 글을 썼다면
	if($chk != 'A' && $doc_mb_info) {
		$show_password_begin = '<!--';
		$show_password_end = '-->';
		$show_name_begin = '<!--';
		$show_name_end = '-->';
		$show_email_begin = '<!--';
		$show_email_end = '-->';
		$show_home_url_begin = ''; // 2003-10-15 홈페이지는 항상입력
		$show_home_url_end = '';
	} else {
		// 2003-10-15 (회원로그인했을 경우 암호를 입력안해두 됨)
		if($mb) {
			$show_password_begin = '<!--';
			$show_password_end = '-->';
		} else {
			$show_password_begin = '';
			$show_password_end = '';
		}
		$show_name_begin = '';
		$show_name_end = '';
		$show_email_begin = '';
		$show_email_end = '';
		$show_home_url_begin = '';
		$show_home_url_end = '';
	}

	// 응답글이라면 공지사항을 쓸수 없다.
	if($rg_parent_num) {
		$show_notice_begin = '<!--';
		$show_notice_end = '-->';
	}
	
	// 업로드가 가능하다면
	if($auth[bbs_upload]) {
		// 첫번째 업로드 가능 확장자 체크
		if($bbs[bbs_file1_ext]) {
			if(substr($bbs[bbs_file1_ext],0,1) == '!') {
				$upload_file1_ext = substr($bbs[bbs_file1_ext],1,strlen($bbs[bbs_file1_ext])-1);
				$upload_file1_able = false;
			} else {
				$upload_file1_ext = $bbs[bbs_file1_ext];
				$upload_file1_able = true;
			}
		} else {
			$show_file1_ext_begin = '<!--';
			$show_file1_ext_end = '-->';
		}
		
		// 두번째 업로드 가능 확장자 체크
		if($bbs[bbs_file2_ext]) {
			if(substr($bbs[bbs_file2_ext],0,1) == '!') {
				$upload_file2_ext = substr($bbs[bbs_file2_ext],1,strlen($bbs[bbs_file2_ext])-1);
				$upload_file2_able = false;
			} else {
				$upload_file2_ext = $bbs[bbs_file2_ext];
				$upload_file2_able = true;
			}
		} else {
			$show_file2_ext_begin = '<!--';
			$show_file2_ext_end = '-->';
		}

		// 업로드 용량이 정해져 있다면 1번째
		if($bbs[bbs_file1_size]) {
			$upload_file1_size = rg_human_fsize_lib($bbs[bbs_file1_size]);
		} else {
			$show_file1_size_begin = '<!--';
			$show_file1_size_end = '-->';
		}
		
		// 업로드 용량이 정해져 있다면 2번째
		if($bbs[bbs_file2_size]) {
			$upload_file2_size = rg_human_fsize_lib($bbs[bbs_file2_size]);
		} else {
			$show_file2_size_begin = '<!--';
			$show_file2_size_end = '-->';
		}
		
		$dbqry = "SHOW COLUMNS FROM `$bbs_table` LIKE 'rg_file%_name'";
		$rs = mysql_query($dbqry, $dbcon);

		$fi = 1;
		while($col_images = mysql_fetch_array($rs))
		{
			if(!$data[$col_images["Field"]])
			{
				${'show_file'.$fi.'_delete_begin'} = '<!--';
				${'show_file'.$fi.'_delete_end'} = '-->';	
			}
			$fi++;
		}
	}
	
	// 추가항목을 처리하는 루틴이다.
	for($i=1;$i<6;$i++) {
		${'show_ext'.$i.'_begin'} = ($bbs[bbs_ext_types][$i]==0)?'<!--':'';
		${'show_ext'.$i.'_end'} = ($bbs[bbs_ext_types][$i]==0)?'-->':'';
		${'show_ext'.$i.'_title'} = $bbs['bbs_ext_name'.$i];
		${'show_ext'.$i.'_input'} = rg_makeform('rg_ext'.$i, $bbs[bbs_ext_types][$i],
					           $bbs['bbs_ext_value'.$i], ${'rg_ext'.$i});
	}

	require_once("_mobile_header.php");
	include($skin_board_path."mobile_write.php");
	require_once("_mobile_footer.php");

?>