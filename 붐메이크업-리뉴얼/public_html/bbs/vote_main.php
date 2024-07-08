<?
	require_once("include/vote.lib.inc.php");
	$now = time();
	$vip_ip = $REMOTE_ADDR;
	$vip_date = time();
	$show_popup_begin="<!--";
	$show_popup_end="-->";

	if($vt_num=='') {
		$dbqry="
			SELECT *
			FROM `{$db_table_vote}_cfg`
			WHERE UNIX_TIMESTAMP() BETWEEN `vt_start` AND `vt_end`
			ORDER BY vt_num DESC
			LIMIT  0,1
		";
		$rs=query($dbqry,$dbcon);
		if(mysql_num_rows($rs) == 0) {
			include($skin_site_path."head.php");
			$error_msg = '진행중인 투표가 없습니다.';
			include($skin_site_path.'error.php');	
			include($skin_site_path."foot.php");
			exit;
		}
		$R=mysql_fetch_array($rs);
		$vt_num=$R['vt_num'];
	} else {
		$R=rg_get_vote_cfg($vt_num);
	}
	if($R==false) {
		include($skin_site_path."head.php");
		$error_msg = '잘못된 접근입니다.';
		include($skin_site_path.'error.php');	
		include($skin_site_path."foot.php");
		exit;
	}
	extract($R);
	$skin_vote_path=$site_path.$skin_dir.$skin_vote_dir.$vt_skin.'/';
	$skin_vote_url=$site_url.$skin_dir.$skin_vote_dir.$vt_skin.'/';

	// 권한체크
	$tmp = array(1=>"comment",2=>"auth",3=>"show");
	if($group[gr_level_type]) {
		$tmp_level = $group_member[gm_level];
	} else {
		$tmp_level = $mb[mb_level];
	}

	foreach($tmp as $key => $val) {
		switch(${"vt_cfg_$val"}) {
			case 'A' : $vote_auth["{$val}"] = true;break;// 전체 
			case 'M' : $vote_auth["{$val}"] = ($mb)?true:false;break;// 회원 
			case 'D' :
			case 10 : $vote_auth["{$val}"] = ($auth[admin])?true:false;break;// 운영자 
			case 'N' : $vote_auth["{$val}"] = false;break;// 사용안함
			case 0 :
			case 1 : 
			case 2 :
			case 3 : 
			case 4 :
			case 5 : 
			case 6 :
			case 7 : 
			case 8 : 
			case 9 : 
			default : // 레벨에 따라서
					$vote_auth["{$val}"] = ($tmp_level>${"vt_cfg_$val"})?true:false;
					break;
//					$error_msg = '잘못된 설정입니다.';
//					include($skin_site_path.'error.htm');
//					exit;
//					break;
		}
		${"show_{$val}_begin"} = ($vote_auth["{$val}"])?'':'<!--';
		${"show_{$val}_end"} = ($vote_auth["{$val}"])?'':'-->';
//		echo ${"vt_cfg_$val"}."  vt_cfg_{$val} => ".$vote_auth["{$val}"]."&nbsp;&nbsp; $tmp_level<br>";
	}	
	unset($tmp_level);
	unset($tmp);

	// 투표기간이 체크 
	$vote_expired = !(($vt_start < $now) && ($now < $vt_end));
	// 중복투표체크 
	$vote_repeat=false;
	if($vt_cfg_repeat) {
		if($mb)
			$mb_sql=" OR vip_mb_num=$mb[mb_num] ";
		$qry="
			SELECT `{$db_table_vote}_ip`.*,vit_item,vit_order
			FROM `{$db_table_vote}_ip`,`{$db_table_vote}_item`
			WHERE vip_vt_num = '$vt_num'
			AND `{$db_table_vote}_item`.vit_num=`{$db_table_vote}_ip`.vip_vit_num
			AND (vip_ip='$vip_ip' $mb_sql)
			LIMIT 0,1
		";
		$rs=query($qry,$dbcon);
		if($last_vote=mysql_fetch_array($rs)) {
			$vote_repeat=true;
			$last_vote[vip_date]=rg_date($last_vote['vip_date'],'%Y-%m-%d');
		}
	}
	// 투표가능하다면 
	if(!$vote_expired && !$vote_repeat) {
		$vote_able=true;
		$show_item_check_begin='';
		$show_item_check_end='';
	} else {
//		$act=''; // 투표를할수 없다면 액션을 없앤다
		$vote_able=false;
		$show_item_check_begin='<!--';
		$show_item_check_end='-->';
	}
	include($skin_vote_path."setup.php");

	if($act) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		
		switch($mode) {
			case 'vote' : 
/*				if($vote_expired) { // 투표기간 종료
					include($skin_site_path."head.php");
					$error_msg = '투표기간이 종료되었습니다.';
					include($skin_site_path.'error.php');	
					include($skin_site_path."foot.php");
					exit;
				}
				if($vote_repeat) { // 투표기간 종료
					include($skin_site_path."head.php");
					$error_msg = '이미투표하셨습니다.';
					include($skin_site_path.'error.php');	
					include($skin_site_path."foot.php");
					exit;
				} */
				if($vit_num!='' && $vote_able) {
					$qry="
						UPDATE `{$db_table_vote}_item` SET
							vit_count = vit_count+1
						WHERE vit_num='$vit_num'
						AND vit_vt_num = '$vt_num'
					";
					$rs=query($qry,$dbcon);
					$qry="
						INSERT INTO `{$db_table_vote}_ip`
							( `vip_num` , `vip_vt_num` , `vip_vit_num` ,
							  `vip_mb_num` , `vip_ip` , `vip_date`) 
						VALUES
							( '', '$vt_num', '$vit_num',
							  '$mb[mb_num]', '$vip_ip' , '$vip_date')
					";
					$rs=query($qry,$dbcon);
				}
				break;
			case 'comment_write' : 
					$vtc_reg_date=time();
					$vtc_reg_ip=$REMOTE_ADDR;
					$vtc_password=get_password_str($vtc_password);
					if($mb) { // 로그인 되어 있다면 
						$vtc_name = $mb[mb_show_name];
						$vtc_email = $mb[mb_mail];
						$vtc_mb_num = $mb[mb_num];
					} else {
						if($vtc_name=='') {
							$error_msg = '이름을 입력하세요.';
							include($skin_site_path."head.php");
							include($skin_vote_path."error.php");
							include($skin_site_path."foot.php");							
							exit;
						}
						if($vtc_password=='') {
							$error_msg = '암호를 입력하세요.';
							include($skin_site_path."head.php");
							include($skin_vote_path."error.php");
							include($skin_site_path."foot.php");							
							exit;
						}
					}
					$dbqry="
						INSERT INTO `{$db_table_vote}_cmt`
							( `vtc_num` , `vtc_vt_num` , `vtc_mb_num` ,
								`vtc_name` , `vtc_password` , `vtc_email` ,
								`vtc_comment` , `vtc_reg_date` , `vtc_reg_ip`
							) 
						VALUES
							( '', '$vt_num', '$vtc_mb_num',
								'$vtc_name', '$vtc_password', '$vtc_email',
								'$vtc_comment', '$vtc_reg_date', '$vtc_reg_ip'
							)
					";
					query($dbqry,$dbcon);
					$dbqry="
						UPDATE `{$db_table_vote}_cfg` SET
							`vt_cmt_count` = vt_cmt_count + 1
						WHERE vt_num='$vt_num'
					";
					query($dbqry,$dbcon);
				break;
			case 'comment_delete' : 
					$dbqry="
						SELECT *
						FROM `{$db_table_vote}_cmt`
						WHERE vtc_num = '$vtc_num'
					";
					$rs = query($dbqry,$dbcon);
					$data = mysql_fetch_array($rs);
					if($data) {
						// 로그인이 되어 있지 않거나 자신의 글이 아니고 관리자가 아니라면
						if((!$mb || ($data[vtc_mb_num] != $mb[mb_num])) && !$auth[admin]) { 
							if($old_password) {  // 암호 입력이 있다면 
								if($data[vtc_password] != get_password_str($old_password)) {
									$msg = '암호가 다릅니다.\n정확히 입력해주세요.';
									rg_href('',$msg,'','back');
								}
							} else { // 암호입력이 없다면 
								$title='코멘트삭제 암호를 입력하세요.';
								include($skin_site_path."head.php");
								include($skin_vote_path."password.php");
								include($skin_site_path."foot.php");
								exit;
							}		
						} else { // 회원등 바로 삭제할수 있다면 확인 작업을 거친다.
							if($act != 'confirm_ok') {  // 삭제 확인이 아니면
								$title='코멘트삭제 확실합니까?';
								include($skin_site_path."head.php");
								include($skin_vote_path."confirm.php");
								include($skin_site_path."foot.php");
								exit;
							}		
						}
						// 코멘트 삭제
						$dbqry="
							DELETE FROM `{$db_table_vote}_cmt`
							WHERE vtc_num = '$vtc_num'
						";
						$rs=query($dbqry,$dbcon);
						$dbqry="
							UPDATE `{$db_table_vote}_cfg` SET
								`vt_cmt_count` = vt_cmt_count - 1
							WHERE vt_num='$vt_num'
						";
						query($dbqry,$dbcon);						
					}
				break;
		}
		rg_href("?vt_num=$vt_num");
	}

	// 아이템 로딩
	$qry="
		SELECT *
		FROM `{$db_table_vote}_item`
		WHERE vit_vt_num = '$vt_num'
		ORDER BY vit_order
	";
	$rs=query($qry,$dbcon);
	
	$item_list=array();
	$vt_max_count=0;
	$vt_total_count=0;
	while($R=mysql_fetch_array($rs)) {
		if($R[vit_count] > $vt_max_count) $vt_max_count = $R[vit_count];
		$vt_total_count = $vt_total_count + $R[vit_count];
		$item_list[]=$R;
	}
	foreach($item_list as $key => $val) {
		if($item_list[$key][vit_count]>0) {
			$item_list[$key][vit_count_per] = number_format($item_list[$key][vit_count]/$vt_total_count*100,2,'.','');
			$item_list[$key][vit_graph_per] = number_format($item_list[$key][vit_count]/$vt_max_count*75,0,'.','');
		} else {
			$item_list[$key][vit_count_per] = 0;
			$item_list[$key][vit_graph_per] = 0;
		}
		$item_list[$key][vit_count]=number_format($item_list[$key][vit_count]);
	}

	$vt_start=rg_date($vt_start,'%Y-%m-%d');
	$vt_end=rg_date($vt_end,'%Y-%m-%d');
	$vt_regdate=rg_date($vt_regdate,'%Y-%m-%d');

	include($skin_site_path."head.php");

	// 투표 헤더처리 
	if ($vt_header_file && file_exists("$vt_header_file")) 
    include("$vt_header_file");
	echo $vt_header_tag;

	include($skin_vote_path."setup.php");
	
	include($skin_vote_path."head.php");
	include($skin_vote_path."item_head.php");

	for($i=0;$i<count($item_list);$i++) {
		extract($item_list[$i]);
		include($skin_vote_path."item_list.php");
	}
	
	ob_start();
	// 투표 기간이 아님 
	if($vote_expired) {
		include($skin_vote_path."vote1.php");
	// 이미투표한경우 
	} else if($vote_repeat) {
		include($skin_vote_path."vote2.php");
	} else {
		include($skin_vote_path."vote3.php");
	}
	$vote_submit=ob_get_contents();
	ob_end_clean();
	
	include($skin_vote_path."item_foot.php");
	
	if($vote_auth[comment]) {
		$show_comment_form_begin = '';
		$show_comment_form_end = '';
	} else {
		$show_comment_form_begin = '<!--';
		$show_comment_form_end = '-->';
		$show_mb_login_begin = '';
		$show_mb_login_end = '';
		$show_mb_logout_begin = '';
		$show_mb_logout_end = '';
	}

	include($skin_vote_path."cmt_head.php");

	$dbqry="
		SELECT `{$db_table_vote}_cmt`.*,mb_icon,mb_id,mb_open_info,mb_homepage
		FROM `{$db_table_vote}_cmt` LEFT JOIN `$db_table_member`
			ON vtc_mb_num = mb_num
		WHERE vtc_vt_num = '$vt_num'
		ORDER BY vtc_num
	";
	$rs=query($dbqry,$dbcon);
	$u_comment_delete = "?vt_num=$vt_num&mode=comment_delete&act=ok&vtc_num=";
	while ($cdata=mysql_fetch_array($rs)) {
		$mb_icon='';
		$mb_id='';
		$mb_open_info='';
		$mb_homepage='';
		extract($cdata);
		$vtc_reg_date = rg_date($cdata[vtc_reg_date]);
		$a_comment_delete = "<a href=\"$u_comment_delete$vtc_num\">";
		if($mb_icon!='') { // 아이콘이 있다면
			$vtc_mb_icon = "<img src=$member_icon_url$mb_icon align=absbottom>";
		} else {
			$vtc_mb_icon = '';
		}
		// 삭제 표시조건
		// 1 : 전체 사용가능하다면 무조건 표시
		// 2 : 전체가 아니라면 글쓴사람
		// 관리자 로그인 인경우 무조건 삭제가 가능 
		if($vote_auth['comment'] == 'A' || $auth[admin] || ($vtc_mb_num == $mb['mb_num'])) {
			$show_comment_delete_begin = '';
			$show_comment_delete_end = '';
		} else {
			$show_comment_delete_begin = '<!--';
			$show_comment_delete_end = '-->';
		}
		$vtc_comment = rg_conv_text($vtc_comment);
		if(!$auth[admin]) $vtc_reg_ip = rg_hidden_ip($vtc_reg_ip);

		include($skin_vote_path."cmt_main.php");
	}
	// 이름표시형태 
	if($mb) { // 로그인 되어 있다면 
		switch($group[gr_name_disp]){
			case 0:
				$mb[mb_show_name] = $mb[mb_id];
				break;
			case 1:
				$mb[mb_show_name] = $mb[mb_name];
				break;
			case 2:
				$mb[mb_show_name] = $mb[mb_nick];
				break;
		}
		$vtc_name = $mb[mb_show_name];
		$vtc_email = $mb[mb_email];
	} else {
		$vtc_name = '';
		$vtc_email = '';
	}

	include($skin_vote_path."cmt_foot.php");
	include($skin_vote_path."foot.php");

	// 투표 푸터처리 
	if ($vt_footer_file && file_exists("$vt_footer_file")) 
    include("$vt_footer_file");
	echo $vt_footer_tag;
	
	include($skin_site_path."foot.php");
?>