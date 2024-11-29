<?
	require_once("include/mobile.bbs.lib.inc.php");
	$mode_write=true;
	$mode = 'write';
	$html_title = ($html_title)?$html_title." > 글쓰기":'';

	// 글쓰기 권한체크
	if(!$auth[bbs_write]) {
		$error_msg = '권한이 없습니다.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}
	
	// 글쓰기 금지 아이피 체크
	if(rg_chk_deny_ip($bbs[bbs_deny_write_ip],$REMOTE_ADDR)) {
		$error_msg = $REMOTE_ADDR.'쓰기권한이 없습니다.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}
	
	$u_action = $u_write;

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
				echo $_SESSION['write_key'] ." ". $bbs[bbs_num].'.'.$bbs[bbs_id]."<br>";
				$error_msg = '로봇에의한 글쓰기 제한';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
		}
		unset($_SESSION['write_key']);
		
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);

		if($rg_title=='') {
			$error_msg = '제목을 입력해주세요.';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_error.php");
			require_once("_mobile_footer.php");
			exit;
		}

		if($rg_content=='') {
			$error_msg = '내용을 입력해주세요.';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_error.php");
			require_once("_mobile_footer.php");
			exit;
		}
		
		if($tmp = rg_str_inword($bbs[bbs_deny_word],$rg_title)) {
				echo ("
                        <script language=javascript>
                                alert(\"$tmp (은)는 사용할수 없는 단어입니다.\");
                        </script>
                        <form name='form' action='board_write.htm?bbs_id=$bbs_id' method='post'>
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
                        <form name='form' action='board_write.htm?bbs_id=$bbs_id' method='post'>
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

		
		if($bbs[bbs_write_time] && ($_SESSION[ss_write_date]+$bbs[bbs_write_time] > $now) && !$auth[admin]) {
			$error_msg = $bbs[bbs_write_time].'초 후에 글을 올려주세요.(도배방지)';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_error.php");
			require_once("_mobile_footer.php");
			exit;
		}
		
		// 공지 사용가능 ?
		$rg_notice = ($auth[bbs_notice])?$rg_notice:'0';
		$rg_html_use = ($auth[bbs_html])?$rg_html_use:'0';

		// 게시판 설정이 전체가 아니고 , 로그인 되어 있다면
		if($bbs_cfg[$C_AUTH_WRITE]!='A' && $mb) {
			$rg_name = $mb[mb_show_name];
			$rg_email = $mb[mb_mail];
//			$rg_home_url = $mb[mb_homepage]; // 2003-10-15 항상홈페이지입력가능
		} else {
			if($rg_name=='') {
				$error_msg = '이름을 입력해주세요.';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
			if(($rg_password=='') && !$mb) {  // 로그인되어 있지 않고 암호도 없다면
				$error_msg = '암호을 입력해주세요.';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
		}
		$rg_doc_num = '';
		$rg_top_num = '';
		$rg_parent_num = '';
		$rg_sequence = 1;
		$rg_depth = 0;
		$rg_next_num = '';
//		$rg_cat_num
		$rg_mb_num = $mb[mb_num];
//		$rg_name 
		if($rg_password) $rg_password = get_password_str($rg_password);
//		$rg_email
//		$rg_home_url 
		$rg_home_url=rg_homepage_chk($rg_home_url);

		$rg_home_hit = 0;
//		$rg_link1_url
//		$rg_link2_url 
		$rg_link1_hit = 0;
		$rg_link2_hit = 0;
		$rg_file1_name = '';
		$rg_file2_name = '';
		$rg_file1_size = 0;
		$rg_file2_size = 0;
		$rg_file1_hit = 0;
		$rg_file2_hit = 0;
		$rg_vote_yes = 0;
		$rg_vote_no = 0;
		$rg_doc_hit = 0;
		$rg_cmt_count = 0;
//		$rg_title
//		$rg_content
//		$rg_html_use 
		$rg_reg_date = $now;
//		$rg_modi_date
		$rg_reg_ip = $REMOTE_ADDR;
//		$rg_modi_ip
//		$rg_deleted
//		$rg_secret 
		$rg_vote_ip = $REMOTE_ADDR;
//		$rg_head_num
//		$rg_reply_mail 
		$rg_agree = 0;

		// 업로드체크
		include("{$site_path}include/upload_chk.inc.php");

		if($rg_notice>0) {
			// 공지사항인경우 next_num 값을 구한다
			$dbqry="
				SELECT max(rg_next_num) as rg_next_num
				FROM `$bbs_table`
			";
			$rs=query($dbqry,$dbcon);
			$tmp = mysql_fetch_array($rs);
			$rg_next_num = $tmp[rg_next_num] + 1;
		} else {
			// 공지사항이 아닌경우 next_num 값을 구한다
			$dbqry="
				SELECT max(rg_next_num) as rg_next_num
				FROM `$bbs_table`
				WHERE rg_notice < 1
			";
			$rs=query($dbqry,$dbcon);
			$tmp = mysql_fetch_array($rs);
			$rg_next_num = $tmp[rg_next_num] + 1;
			
			// 공지사항의  next_num을 하나씩 올린다.
			$dbqry="
				UPDATE `$bbs_table` SET
					`rg_next_num` = `rg_next_num` + 1
				WHERE rg_notice > 0
			";
			query($dbqry,$dbcon);
		}			

		$bbs_id_substr = substr($bbs_id,0,3);
		if($bbs_id_substr == "pro" || $bbs_id == "flash"){ //갤러리 우선순위
			$admin_orderby_query1= ", `admin_orderby`";
			$admin_orderby_query2= ", '$admin_orderby'";
		}
		if($bbs_id == "flash"){
			$sql = "select * from `$bbs_table`";
			$result = query($sql,$dbcon);
			$tot_cot = mysql_num_rows($result);

			if($tot_cot > 100){
				rg_href("mobile_list.php?bbs_id=$bbs_id","100개까지만 등록이 가능합니다");
			}

			//파일 업로드전 기존꺼 전부 +1
			$sql2 = "select * from `$bbs_table` where 1 order by admin_orderby desc";
			$result2 = query($sql2,$dbcon); //4하고 2사이에 있는거
			$numrow2 = mysql_num_rows($result2);
			if($numrow2 > 0){
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
		}
		
		$dbqry="
			INSERT INTO `$bbs_table`
				( `rg_doc_num` , `rg_top_num` , `rg_parent_num` ,
				 	`rg_sequence` , `rg_depth` , `rg_next_num` ,
					`rg_cat_num` , `rg_mb_num` , `rg_name` ,
					`rg_password` , `rg_email` , `rg_home_url` ,
					`rg_home_hit` , `rg_link1_url` , `rg_link2_url` ,
					`rg_link1_hit` , `rg_link2_hit` , `rg_file1_name` ,
					`rg_file2_name` , `rg_file1_size` , `rg_file2_size` ,
					`rg_file1_hit` , `rg_file2_hit` , `rg_vote_yes` ,
					`rg_vote_no` , `rg_doc_hit` , `rg_cmt_count` ,
					`rg_title` , `rg_content` , `rg_html_use` ,
					`rg_reg_date` , `rg_modi_date` , `rg_reg_ip` ,
					`rg_modi_ip` , `rg_deleted` , `rg_secret` ,
					`rg_vote_ip` , `rg_notice` , `rg_reply_mail` ,
					`rg_agree` , `rg_ext1` , `rg_ext2` ,
					`rg_ext3` , `rg_ext4` , `rg_ext5` $admin_orderby_query1
				)
			VALUES 
				( '$rg_doc_num', '$rg_top_num', '$rg_parent_num',
					'$rg_sequence', '$rg_depth', '$rg_next_num', 
					'$rg_cat_num', '$rg_mb_num', '$rg_name', 
					'$rg_password', '$rg_email', '$rg_home_url', 
					'$rg_home_hit', '$rg_link1_url', '$rg_link2_url', 
					'$rg_link1_hit', '$rg_link2_hit', '$rg_file1_name', 
					'$rg_file2_name', '$rg_file1_size', '$rg_file2_size', 
					'$rg_file1_hit', '$rg_file2_hit', '$rg_vote_yes', 
					'$rg_vote_no', '$rg_doc_hit', '$rg_cmt_count', 
					'$rg_title', '$rg_content', '$rg_html_use', 
					'$rg_reg_date', '$rg_modi_date', '$rg_reg_ip', 
					'$rg_modi_ip', '$rg_deleted', '$rg_secret', 
					'$rg_vote_ip', '$rg_notice', '$rg_reply_mail', 
					'$rg_agree', '$rg_ext1', '$rg_ext2', 
					'$rg_ext3', '$rg_ext4', '$rg_ext5' $admin_orderby_query2
				)
		";
		query($dbqry,$dbcon);

		$rg_doc_num = mysql_insert_id();
		$rg_top_num = $rg_doc_num;
		
		// 업로드 관련 루틴은 공용
		if($bbs_id == "flash"){
			include("{$site_path}include/upload.inc.ori.php");
		}else{
			include("{$site_path}include/upload.inc.php");
		}
		
		if($rg_files_count > 2)
		{
			// 추가 파일이 있을 경우 필드가 존재하지 않으면 필드를 추가
			$alterQry = "ALTER TABLE `$bbs_table` ";
			for($fi=3;$fi<=$rg_files_count;$fi++) {
				$dbqry="
					SHOW  COLUMNS  FROM `$bbs_table` LIKE  'rg_file{$fi}_name'
				";
				$rs = mysql_query($dbqry,$dbcon);
				if(!mysql_num_rows($rs))
				{
					$alterQry .= ", ADD `rg_file{$fi}_name` VARCHAR( 255 ) AFTER `rg_file".($fi-1)."_name`";
					$alterQry .= ", ADD `rg_file{$fi}_size` INT( 20 ) AFTER `rg_file".($fi-1)."_size`";
				}
			}
			query($alterQry,$dbcon);
		}

		$dbqry="
				UPDATE `$bbs_table` SET
				`rg_top_num` = '$rg_top_num'	";


		if($bbs_id=="flash"){
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
		


		$dbqry .= " WHERE rg_doc_num='$rg_doc_num'	";

		query($dbqry,$dbcon);

		$ss_write_date = $now;
//		session_register("ss_write_date");
		$_SESSION['ss_write_date']=$ss_write_date;

		rg_set_point($mb[mb_num],$bbs[bbs_point_write],1);

	
/*
 메일 발송기능
(운영자메일수신 되어 있고 운영자 목록이 있다면)
*/
		if(($bbs_cfg[$C_USE_ADMIN_MAIL] && $bbs[bbsdmin_list]) &&
   			 file_exists($skin_board_path."mail.php")) { 
			$mail_subject = $site[st_site_name];
			$mail_subject = ($mail_subject)?
											$mail_subject." > ".$bbs[bbs_name]:
											$bbs[bbs_name];
			$mail_subject = "[{$mail_subject}] 새글이 올라왔습니다.";
			$mail_title = rg_conv_text($rg_title);
			$mail_from_name = $rg_name;
			if($rg_html_use == 1 || $rg_html_use == 2) {
				$rg_content = rg_script_conv($bbs[bbs_html_text],$rg_content);
			}
			$mail_content = rg_conv_text($rg_content,$rg_html_use);
			$mail_view_url = rg_get_current_url().'view.php?&bbs_id='.$bbs_id.'&doc_num='.$rg_doc_num;

			$mail_subject = stripslashes($mail_subject);
			$mail_title = stripslashes($mail_title);
			$mail_from_name = stripslashes($mail_from_name);
			$mail_content = stripslashes($mail_content);
	
			// 게시판관리자 이메일 추출하기 
			$email_list=array();
			if($bbs_cfg[$C_USE_ADMIN_MAIL]  && $bbs[bbsdmin_list]) {
				$tmp=explode (',', $bbs['bbsdmin_list']);
				$admin_id_list='\''.implode ('\',\'', $tmp).'\'';
				$dbqry="
					SELECT mb_email
					FROM `$db_table_member`
					WHERE mb_id in ($admin_id_list) 
					  AND mb_email <> ''
				";
				$rs=query($dbqry,$dbcon);
				while($R=mysql_fetch_array($rs)) {
					$email_list[] = $R[mb_email];
				}
			}
			// 메일 발송 루틴은 공용
			include("{$site_path}include/mail.inc.php");	
		}

		// 비밀글을 썻다면 글목록으로
		if($rg_secret && $bbs[bbsct_after]=='1') $bbs[bbsct_after]='';
		
		switch($bbs[bbsct_after]){
			case '' : 
			case '0' : 
					rg_href("mobile_list.php?$p_str&page=$page&bbs_id=$bbs_id&doc_num=$rg_doc_num");
					break;
			case '1' : 
					rg_href("mobile_view.php?$p_str&page=$page&bbs_id=$bbs_id&doc_num=$rg_doc_num");
					break;
			default : 
					rg_href($bbs[bbsct_after]);
					break;
		}
	}
	$category_list_option=rg_html_option($category_list,'cat_num','cat_name',$ss[fc]);
	$checked_html_use0 = 'checked';
	$rg_link1_url = '';
	$rg_link2_url = '';
	$rg_content = $bbs[bbs_default_content];

	// 글쓰기가 아무나 가능하지 않고 회원로그인 되어 있다면
	if($bbs_cfg[$C_AUTH_WRITE]!='A' && $mb) {
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

	// 로그인 했다면
	if($mb) {
		$rg_name = $mb[mb_show_name];
		$rg_email = $mb[mb_email];
		$rg_home_url = $mb[mb_homepage];
	} else {
		$rg_name = '';
		$rg_email = '';
		$rg_home_url = '';
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
		${'show_ext'.$i.'_input'} = 
		rg_makeform('rg_ext'.$i,$bbs[bbs_ext_types][$i],$bbs['bbs_ext_value'.$i]);
	}
	
	require_once("_mobile_header.php");
	include($skin_board_path."mobile_write.php");
	require_once("_mobile_footer.php");

	// 로봇등록을 방지 하기 위해서	
	if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
		$_SESSION['write_key']=$bbs[bbs_num].'.'.$bbs[bbs_id];
	}
?>