<?
	require_once("include/lib.inc.php");
	if(!$mb) {
		rg_href('',"로그인후 사용할수 있습니다.",'','close');
	}

	switch($mode) {
		case 'delete' : 
			$memo = get_memo_doc($mo_num);
			extract($memo);
			if(($mo_recv_mb_num != $mb[mb_num]) && ($mo_send_mb_num != $mb[mb_num]))
					rg_href('',"자신의 쪽지만 삭제가 가능합니다.",'','back');
			$dbqry="
				DELETE FROM `$db_table_memo`
				WHERE mo_num = '$mo_num'
			";
			query($dbqry,$dbcon);
			rg_href("?mode=$nmode");
			break;
		case 'write' : 
			if($act=='ok') {
				while(list($key,$value)=each($HTTP_POST_VARS))
					if(is_string($value))
						$GLOBALS[$key]=trim($value);
						
				$mo_write_date=$now;
				$mo_read_date='0';
				$mo_send_mb_num=$mb[mb_num];
				$mm=rg_get_member_info($mo_recv_mb_id);
				if(!$mm) {
					rg_href('',"받는 사람이 회원목록에 없습니다.",'','back');
				}
				$mo_recv_mb_num = $mm[mb_num];
				$dbqry = "
					INSERT INTO `$db_table_memo`
						( `mo_num` , `mo_recv_mb_num` , `mo_send_mb_num` ,
							`mo_write_date` , `mo_read_date` , `mo_content` 
						) 
					VALUES 
						(	'', '$mo_recv_mb_num', '$mo_send_mb_num',
							'$mo_write_date', '$mo_read_date', '$mo_content'
						)
				";
				query($dbqry,$dbcon);

				$dbqry="
					UPDATE `$db_table_member` SET
						mb_exist_memo = '1'
					WHERE mb_num = '$mo_recv_mb_num'
				";
				$rs = query($dbqry,$dbcon);

				rg_href('?mode=list_send');
				exit;
			}
			include($skin_site_path."memo_head.php");
			include($skin_site_path."memo_write.php");
			include($skin_site_path."memo_foot.php");
			break;
		case 'read' : 
			$memo = get_memo_doc($mo_num);
			extract($memo);
			$a_memo_list = "<a href=\"?mode=$nmode\">";
			$a_memo_reply = "<a href=\"?mode=write&mo_recv_mb_id=$mo_send_mb_id\">";
			if(($mo_recv_mb_num != $mb[mb_num]) && ($mo_send_mb_num != $mb[mb_num]))
					rg_href('',"자신의 쪽지만 읽을수 있습니다.",'','back');
			$mo_content=rg_get_text($mo_content,1);
			include($skin_site_path."memo_head.php");
			include($skin_site_path."memo_view.php");
			include($skin_site_path."memo_foot.php");
			if($mo_recv_mb_num == $mb[mb_num]) {
				if(!$mo_read_date) {
					$dbqry="
						UPDATE `$db_table_memo` SET
							mo_read_date = '$now'
						WHERE mo_num = '$mo_num'
					";
					$rs = query($dbqry,$dbcon);
				}
				$dbqry="
					UPDATE `$db_table_member` SET
						mb_exist_memo = '0'
					WHERE mb_num = '$mb[mb_num]'
				";
				$rs = query($dbqry,$dbcon);
			}
			break;
		default : 
			include($skin_site_path."memo_head.php");

			if($mode == 'list_send') {
				$where_str = " mo_send_mb_num='$mb[mb_num]' ";				
				$head_file = $skin_site_path."memo_list_send_head.php";
				$list_file = $skin_site_path."memo_list_send_main.php";
				$foot_file = $skin_site_path."memo_list_send_foot.php";
			}	else {
				$where_str = " mo_recv_mb_num='$mb[mb_num]' ";				
				$head_file = $skin_site_path."memo_list_recv_head.php";
				$list_file = $skin_site_path."memo_list_recv_main.php";
				$foot_file = $skin_site_path."memo_list_recv_foot.php";
			}

			$dbqry="
				SELECT count(*) as row_count 
				FROM `$db_table_memo`
				WHERE $where_str
			";
			$rs = query($dbqry,$dbcon);

			fetch($rs,array("row_count"));
			$page_info=rg_navigation($page,$row_count,20,10);

			include($head_file);
			
			$dbqry="
				SELECT $db_table_memo.*,
							 a.mb_id as mo_send_mb_id,
							 a.mb_email as mo_send_mb_email,
							 a.mb_homepage as mo_send_mb_homepage,
							 a.mb_open_info as mo_send_mb_open_info,
							 b.mb_id as mo_recv_mb_id,
							 b.mb_email as mo_recv_mb_email,
							 b.mb_homepage as mo_recv_mb_homepage,
							 b.mb_open_info as mo_recv_mb_open_info
				FROM `$db_table_memo`,
				     `$db_table_member` a,
						 `$db_table_member` b
				WHERE $where_str 
					AND a.mb_num=mo_send_mb_num
					AND b.mb_num=mo_recv_mb_num
				ORDER BY mo_num
				LIMIT  $page_info[offset],$page_info[rows] ";
			$rs=query($dbqry,$dbcon);

			while($R=mysql_fetch_array($rs)) {
				extract($R);
				if($mo_read_date) {
					$show_read_begin = '';
					$show_read_end = '';
					$show_noread_begin = '<!--';
					$show_noread_end = '-->';
				} else {
					$show_read_begin = '<!--';
					$show_read_end = '-->';
					$show_noread_begin = '';
					$show_noread_end = '';
				}
				if($mo_read_date>0)
					$mo_read_date = rg_date($mo_read_date,'%m-%d %H:%M');
				else 
					$mo_read_date = '-';
				
				$mo_write_date = rg_date($mo_write_date,'%m-%d %H:%M');
				$a_memo_read = "<a href=\"?mode=read&nmode=$mode&mo_num=$mo_num\">";
				$a_memo_delete = "<a href=\"?mode=delete&nmode=$mode&mo_num=$mo_num\">";
				include($list_file);
			}
			include($foot_file);
			include($skin_site_path."memo_foot.php");
			break;
	}
?>