<?
	require_once("include/mobile.bbs.lib.inc.php");
	$mode_edit=true;
	$mode = 'edit';
	$html_title = ($html_title)?$html_title." > �ۼ���":'';

	// �ۼ��� ���� üũ
	if(!$auth[bbs_edit]) {
		$error_msg = '������ �����ϴ�.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}
	
	// �۾��� ���� ������ üũ
	if(rg_chk_deny_ip($bbs[bbs_deny_write_ip],$REMOTE_ADDR)) {
		$error_msg = $REMOTE_ADDR.'������ ���������� �����ϴ�.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}
	
	$u_action = $u_edit.$doc_num;
	$rg_doc_num = $doc_num;
	
	$data=rg_get_doc_info($bbs_id,$doc_num);
	if($data[rg_parent_num]) 
		$chk = $bbs_cfg[$C_AUTH_REPLY]; // ������� ���
	else
		$chk = $bbs_cfg[$C_AUTH_WRITE]; // ������� �ƴ϶��
	
	// ���ñ��� �ִٸ� ���� �ɼ��� ��� ó�� 
	if(($bbs_cfg[$C_REPLY_DELETE]==1) || ($bbs_cfg[$C_REPLY_DELETE]==2)) {
		$dbqry = "
			SELECT count(*)
			FROM `$bbs_table`
			WHERE `rg_parent_num` = '$data[rg_doc_num]'
		";
		$rs = query($dbqry,$dbcon);
		$tmp = mysql_fetch_array($rs);
		if($tmp[0]) { // ������� �ִٸ� 
			$error_msg = '������� ������ �����ϽǼ� �����ϴ�.';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_error.php");
			require_once("_mobile_footer.php");
			exit;
		}
	}
	// �α����� �Ǿ� ���� �ʰų� �ڽ��� ���� �ƴϰ� �����ڰ� �ƴ϶��
	if((!$mb || ($data[rg_mb_num] != $mb[mb_num])) && !$auth[admin]) { 
		if($old_password) {  // ��ȣ �Է��� �ִٸ�
			if($data[rg_password] != get_password_str($old_password)) {
				$msg = '��ȣ�� �ٸ��ϴ�.\n��Ȯ�� �Է����ּ���.';
				rg_href('',$msg,'','back');
			}
		} else { // ��ȣ�Է��� ���ٸ�
			$title='�ۼ��� ��ȣ�� �Է��ϼ���.';
			require_once("_mobile_header.php");
			include($skin_board_path."mobile_password.php");
			require_once("_mobile_footer.php");		
			exit;
		}		
	}
	
	if($data[rg_mb_num])
		$doc_mb_info = rg_get_member_info($data[rg_mb_num],1);
	
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
				$error_msg = '�κ������� �۾��� ����';
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
                                alert(\"$tmp (��)�� ����Ҽ� ���� �ܾ��Դϴ�.\");
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
			//$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
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
		
		// �н����� ������
		if($rg_password) {
			$rg_password = get_password_str($rg_password);
			$sql_password = "`rg_password` = '$rg_password',";
		}

		// �Խ��� ������ ��ü�� �ƴϰ� , ȸ���� �´ٸ�
		if($chk != 'A' && $doc_mb_info) {
			$rg_name = $data[rg_name];
			$rg_email = $data[rg_email];
//			$rg_home_url = $data[mb_homepage]; // 2003-10-15 �׻�Ȩ�������Է°���
		} else {
			if($rg_name=='') {
				$error_msg = '�̸��� �Է����ּ���.';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
		}
		
		// ����üũ�� �ȵǾ� �ִٸ� �����̶�
		if(!$rg_notice) $rg_notice = 0; 
		// �����ڶ�� ���� ��밡��
		$rg_notice = ($auth[bbs_notice])?$rg_notice:'0';
		$rg_html_use = ($auth[bbs_html])?$rg_html_use:'0';

		// �������°� ���ϰ�, �ֻ����� �̶��
		if(($rg_notice != $data[rg_notice]) && ($data[rg_parent_num] == 0)) {
			if($rg_notice>0) {
				// ���������ΰ�� next_num ���� ���Ѵ�(�ְ�� ū������)
				$dbqry="
					SELECT max(rg_next_num) as rg_next_num
					FROM `$bbs_table`
				";
				$rs=query($dbqry,$dbcon);
				$tmp = mysql_fetch_array($rs);
				$rg_next_num = $tmp[rg_next_num];
				
				// �ڽ��� �ۺ��� next_num �� ũ�� �ϳ��� ������.
				$dbqry="
					UPDATE `$bbs_table` SET
						`rg_next_num` = `rg_next_num` - 1
					WHERE rg_next_num > '$data[rg_next_num]'
				";
				query($dbqry,$dbcon);
			} else {
				// ���������� �ƴѰ�� next_num ���� ���Ѵ�
				// top��ȣ�� �������� �ڽ��� �ۺ��� �������� ū���� ���Ѵ�.
				$dbqry="
					SELECT max(rg_next_num) as rg_next_num
					FROM `$bbs_table`
					WHERE rg_top_num < '$data[rg_top_num]'
						AND rg_notice = 0
				";
				$rs=query($dbqry,$dbcon);
				$tmp = mysql_fetch_array($rs);
				$rg_next_num = $tmp[rg_next_num]+1;
				
				// �������׾ƴϰ� ���ο� next ���� ũ��,
				// ���������̸鼭 �ڽ��� next ���� �۴ٸ� �ø���
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
		
		// ���ε� üũ
		include("../bbs/include/upload_chk.inc.php");
		
		// ���ε� ó��
		if($bbs_id == "flash"){
			include("../bbs/include/upload.inc.ori.php");
		}else{
			include("../bbs/include/upload.inc.php");
		}
		
		$rg_home_url=rg_homepage_chk($rg_home_url);

		$bbs_id_substr = substr($bbs_id,0,3);
		if($bbs_id_substr == "pro"){ //�������켱����
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

		$dbqry .= " WHERE rg_doc_num='$rg_doc_num'
		";
		query($dbqry,$dbcon);

	################################################################

	if($bbs_id == "flash"){
		if($admin_orderby_old > $admin_orderby){ //4->2�� ���� �Ѵٰ� ���� ����������

				//2�� 9999�� ����
				$small_newfile="small9999.jpg";
				$big_newfile = "big9999.jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small".$admin_orderby.".jpg",$small_newfile_url); 
				rename($bbs_data_path."big".$admin_orderby.".jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='9999' where admin_orderby='$admin_orderby'";
				query($sql2,$dbcon);
	


				//4�� 2�κ���
				$small_newfile="small".$admin_orderby.".jpg";
				$big_newfile = "big".$admin_orderby.".jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small".$admin_orderby_old.".jpg",$small_newfile_url); 
				rename($bbs_data_path."big".$admin_orderby_old.".jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$admin_orderby' where admin_orderby='$admin_orderby_old'";
				query($sql2,$dbcon);



				//4�� 2���̿� �ִ°� ���� +1
				$admin_orderby_chai=$admin_orderby_old - $admin_orderby;
				if($admin_orderby_chai > 1){ //���̿� 1���� ������ ����				
					$sql2 = "select * from `$bbs_table` where admin_orderby < '$admin_orderby_old' and admin_orderby > '$admin_orderby' order by admin_orderby desc";
					$result2 = query($sql2,$dbcon); //4�ϰ� 2���̿� �ִ°�
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
							

				//9999�� �ٲ��� 2�� +1�ϱ�

				$admin_orderby_1 = $admin_orderby + 1;

				$small_newfile="small".$admin_orderby_1.".jpg";
				$big_newfile = "big".$admin_orderby_1.".jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small9999.jpg",$small_newfile_url); 
				rename($bbs_data_path."big9999.jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$admin_orderby_1' where admin_orderby='9999'";
				query($sql2,$dbcon);



		}elseif($admin_orderby_old < $admin_orderby){ //2->4�� ���� �Ѵٰ� ���� �����ڷ�

				//4�� 9999�� ����
				$small_newfile="small9999.jpg";
				$big_newfile = "big9999.jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small".$admin_orderby.".jpg",$small_newfile_url); 
				rename($bbs_data_path."big".$admin_orderby.".jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='9999' where admin_orderby='$admin_orderby'";
				query($sql2,$dbcon);
	


				//2�� 4�κ���
				$small_newfile="small".$admin_orderby.".jpg";
				$big_newfile = "big".$admin_orderby.".jpg";
				$small_newfile_url=$bbs_data_path.$small_newfile;
				$big_newfile_url = $bbs_data_path.$big_newfile;

				rename($bbs_data_path."small".$admin_orderby_old.".jpg",$small_newfile_url); 
				rename($bbs_data_path."big".$admin_orderby_old.".jpg",$big_newfile_url); 

				$sql2 = "update `$bbs_table` set rg_file1_name='$small_newfile', rg_file2_name='$big_newfile', admin_orderby='$admin_orderby' where admin_orderby='$admin_orderby_old'";
				query($sql2,$dbcon);



				//2�� 4���̿� �ִ°� ���� -1
				$admin_orderby_chai=$admin_orderby - $admin_orderby_old;
				if($admin_orderby_chai > 1){ //���̿� 1���� ������ ����				
					$sql2 = "select * from `$bbs_table` where admin_orderby > '$admin_orderby_old' and admin_orderby < '$admin_orderby' order by admin_orderby asc";
					$result2 = query($sql2,$dbcon); //4�ϰ� 2���̿� �ִ°�
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
							

				//9999�� �ٲ��� 4�� -1�ϱ�

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
		
		// ��б��� ���ٸ� �۸������
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
	// ī�װ���
	$cat_name = $category_list[$cat_num][cat_name]; 
	$category_list_option=rg_html_option($category_list,'cat_num','cat_name',$rg_cat_num);
	$checked_notice=($rg_notice)?'checked':'';
	$checked_secret=($rg_secret)?'checked':'';
	$checked_reply_mail=($rg_reply_mail)?'checked':'';
	${'checked_html_use'.$rg_html_use} = 'checked';

	// ����Ǵ� ������� ��ü�� �ƴϰ� , �α��� ���¿��� ���� ��ٸ�
	if($chk != 'A' && $doc_mb_info) {
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

	// ������̶�� ���������� ���� ����.
	if($rg_parent_num) {
		$show_notice_begin = '<!--';
		$show_notice_end = '-->';
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
		${'show_ext'.$i.'_input'} = rg_makeform('rg_ext'.$i, $bbs[bbs_ext_types][$i],
					           $bbs['bbs_ext_value'.$i], ${'rg_ext'.$i});
	}

	require_once("_mobile_header.php");
	include($skin_board_path."mobile_write.php");
	require_once("_mobile_footer.php");

?>