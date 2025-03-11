<?
	require_once("include/mobile.bbs.lib.inc.php");
	$mode_write=true;
	$mode = 'write';
	$html_title = ($html_title)?$html_title." > �۾���":'';

	// �۾��� ����üũ
	if(!$auth[bbs_write]) {
		$error_msg = '������ �����ϴ�.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}
	
	// �۾��� ���� ������ üũ
	if(rg_chk_deny_ip($bbs[bbs_deny_write_ip],$REMOTE_ADDR)) {
		$error_msg = $REMOTE_ADDR.'��������� �����ϴ�.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}
	
	$u_action = $u_write;

	if($act=='ok') {
		// ���ݱ۾��� ����
		if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
			if(trim($HTTP_SERVER_VARS['HTTP_REFERER'])=='') {
				$error_msg = '���ݱ۾��� ����';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
			if($_SESSION['write_key']!=$bbs[bbs_num].'.'.$bbs[bbs_id]) {
				echo $_SESSION['write_key'] ." ". $bbs[bbs_num].'.'.$bbs[bbs_id]."<br>";
				$error_msg = '�κ������� �۾��� ����';
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
			$error_msg = '������ �Է����ּ���.';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_error.php");
			require_once("_mobile_footer.php");
			exit;
		}

		if($rg_content=='') {
			$error_msg = '������ �Է����ּ���.';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_error.php");
			require_once("_mobile_footer.php");
			exit;
		}
		
		if($tmp = rg_str_inword($bbs[bbs_deny_word],$rg_title)) {
				echo ("
                        <script language=javascript>
                                alert(\"$tmp (��)�� ����Ҽ� ���� �ܾ��Դϴ�.\");
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
			//$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
			//require_once("_mobile_header.php");
			//include($skin_board_path."mobile_error.php");
			//require_once("_mobile_footer.php");
			//exit;
		}

		if($tmp = rg_str_inword($bbs[bbs_deny_word],$rg_content)) {
                echo ("
                        <script language=javascript>
                                alert(\"$tmp (��)�� ����Ҽ� ���� �ܾ��Դϴ�.\");
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
			//$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
			//require_once("_mobile_header.php");
			//include($skin_board_path."mobile_error.php");
			//require_once("_mobile_footer.php");
			//exit;
		}

		
		if($bbs[bbs_write_time] && ($_SESSION[ss_write_date]+$bbs[bbs_write_time] > $now) && !$auth[admin]) {
			$error_msg = $bbs[bbs_write_time].'�� �Ŀ� ���� �÷��ּ���.(�������)';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_error.php");
			require_once("_mobile_footer.php");
			exit;
		}
		
		// ���� ��밡�� ?
		$rg_notice = ($auth[bbs_notice])?$rg_notice:'0';
		$rg_html_use = ($auth[bbs_html])?$rg_html_use:'0';

		// �Խ��� ������ ��ü�� �ƴϰ� , �α��� �Ǿ� �ִٸ�
		if($bbs_cfg[$C_AUTH_WRITE]!='A' && $mb) {
			$rg_name = $mb[mb_show_name];
			$rg_email = $mb[mb_mail];
//			$rg_home_url = $mb[mb_homepage]; // 2003-10-15 �׻�Ȩ�������Է°���
		} else {
			if($rg_name=='') {
				$error_msg = '�̸��� �Է����ּ���.';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
			if(($rg_password=='') && !$mb) {  // �α��εǾ� ���� �ʰ� ��ȣ�� ���ٸ�
				$error_msg = '��ȣ�� �Է����ּ���.';
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

		// ���ε�üũ
		include("{$site_path}include/upload_chk.inc.php");

		if($rg_notice>0) {
			// ���������ΰ�� next_num ���� ���Ѵ�
			$dbqry="
				SELECT max(rg_next_num) as rg_next_num
				FROM `$bbs_table`
			";
			$rs=query($dbqry,$dbcon);
			$tmp = mysql_fetch_array($rs);
			$rg_next_num = $tmp[rg_next_num] + 1;
		} else {
			// ���������� �ƴѰ�� next_num ���� ���Ѵ�
			$dbqry="
				SELECT max(rg_next_num) as rg_next_num
				FROM `$bbs_table`
				WHERE rg_notice < 1
			";
			$rs=query($dbqry,$dbcon);
			$tmp = mysql_fetch_array($rs);
			$rg_next_num = $tmp[rg_next_num] + 1;
			
			// ����������  next_num�� �ϳ��� �ø���.
			$dbqry="
				UPDATE `$bbs_table` SET
					`rg_next_num` = `rg_next_num` + 1
				WHERE rg_notice > 0
			";
			query($dbqry,$dbcon);
		}			

		$bbs_id_substr = substr($bbs_id,0,3);
		if($bbs_id_substr == "pro" || $bbs_id == "flash"){ //������ �켱����
			$admin_orderby_query1= ", `admin_orderby`";
			$admin_orderby_query2= ", '$admin_orderby'";
		}
		if($bbs_id == "flash"){
			$sql = "select * from `$bbs_table`";
			$result = query($sql,$dbcon);
			$tot_cot = mysql_num_rows($result);

			if($tot_cot > 100){
				rg_href("mobile_list.php?bbs_id=$bbs_id","100�������� ����� �����մϴ�");
			}

			//���� ���ε��� ������ ���� +1
			$sql2 = "select * from `$bbs_table` where 1 order by admin_orderby desc";
			$result2 = query($sql2,$dbcon); //4�ϰ� 2���̿� �ִ°�
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
		
		// ���ε� ���� ��ƾ�� ����
		if($bbs_id == "flash"){
			include("{$site_path}include/upload.inc.ori.php");
		}else{
			include("{$site_path}include/upload.inc.php");
		}
		
		if($rg_files_count > 2)
		{
			// �߰� ������ ���� ��� �ʵ尡 �������� ������ �ʵ带 �߰�
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
					  if($fi==1){//�����̹���
						$dbqry .= ", `rg_file{$fi}_name` = 'small".$admin_orderby.".jpg'";
						$dbqry .= ", `rg_file{$fi}_size` = '".${"rg_file{$fi}_size"}."'";
					  }else{//ū�̹���
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
 ���� �߼۱��
(��ڸ��ϼ��� �Ǿ� �ְ� ��� ����� �ִٸ�)
*/
		if(($bbs_cfg[$C_USE_ADMIN_MAIL] && $bbs[bbsdmin_list]) &&
   			 file_exists($skin_board_path."mail.php")) { 
			$mail_subject = $site[st_site_name];
			$mail_subject = ($mail_subject)?
											$mail_subject." > ".$bbs[bbs_name]:
											$bbs[bbs_name];
			$mail_subject = "[{$mail_subject}] ������ �ö�Խ��ϴ�.";
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
	
			// �Խ��ǰ����� �̸��� �����ϱ� 
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
			// ���� �߼� ��ƾ�� ����
			include("{$site_path}include/mail.inc.php");	
		}

		// ��б��� ���ٸ� �۸������
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

	// �۾��Ⱑ �ƹ��� �������� �ʰ� ȸ���α��� �Ǿ� �ִٸ�
	if($bbs_cfg[$C_AUTH_WRITE]!='A' && $mb) {
		$show_password_begin = '<!--';
		$show_password_end = '-->';
		$show_name_begin = '<!--';
		$show_name_end = '-->';
		$show_email_begin = '<!--';
		$show_email_end = '-->';
		$show_home_url_begin = ''; // 2003-10-15 Ȩ�������� �׻��Է�
		$show_home_url_end = '';
	} else {
		// 2003-10-15 (ȸ���α������� ��� ��ȣ�� �Է¾��ص� ��)
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

	// �α��� �ߴٸ�
	if($mb) {
		$rg_name = $mb[mb_show_name];
		$rg_email = $mb[mb_email];
		$rg_home_url = $mb[mb_homepage];
	} else {
		$rg_name = '';
		$rg_email = '';
		$rg_home_url = '';
	}
	
	// ���ε尡 �����ϴٸ�
	if($auth[bbs_upload]) {
		// ù��° ���ε� ���� Ȯ���� üũ
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
		
		// �ι�° ���ε� ���� Ȯ���� üũ
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
		
		// ���ε� �뷮�� ������ �ִٸ� 1��°
		if($bbs[bbs_file1_size]) {
			$upload_file1_size = rg_human_fsize_lib($bbs[bbs_file1_size]);
		} else {
			$show_file1_size_begin = '<!--';
			$show_file1_size_end = '-->';
		}
		
		// ���ε� �뷮�� ������ �ִٸ� 2��°
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
	
	// �߰��׸��� ó���ϴ� ��ƾ�̴�.
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

	// �κ������ ���� �ϱ� ���ؼ�	
	if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
		$_SESSION['write_key']=$bbs[bbs_num].'.'.$bbs[bbs_id];
	}
?>