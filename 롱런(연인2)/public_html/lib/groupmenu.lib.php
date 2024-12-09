<?php
if (!defined('_GNUBOARD_')) exit;

// 메뉴
function groupmenu($skin_dir='basic', $new_time)
{
    global $config, $group, $g5, $is_admin, $bo_table;
	$groupmenu = array();

    if(!$group['gr_id'] || G5_IS_MOBILE)
        return;
	
		$sql = " select * from {$g5['group_table']} where gr_device <> 'mobile' and gr_id = '{$group['gr_id']}' order by gr_order ";
    $result = sql_query($sql);
	for ($gi=0; $row=sql_fetch_array($result); $gi++) { // gi 는 group index
		$sql2 = " select * from {$g5['board_table']} where gr_id = '{$row['gr_id']}' and bo_device <> 'mobile' order by bo_order ";
		$result2 = sql_query($sql2);
		for ($bi=0; $row2=sql_fetch_array($result2); $bi++) { // bi 는 board index	
			$board_table = $g5['write_prefix'] . $row2['bo_table'];
			$latest_count =  sql_fetch(" select count(*) as cnt from {$board_table} where wr_datetime > '".date('Y-m-d H:i:s', time() - (3600 * $new_time))."'");
			
			$groupmenu[$bi]['bo_table'] = $row2['bo_table'];
			$groupmenu[$bi]['href'] = G5_BBS_URL.'/board.php?bo_table='.$row2['bo_table'];
			$groupmenu[$bi]['subject'] = $row2['bo_subject'];
			$groupmenu[$bi]['cnt'] = $latest_count['cnt'];
		}
	}	
	$groupmenu_skin_path = G5_SKIN_PATH.'/groupmenu/'.$skin_dir;
    $groupmenu_skin_url  = G5_SKIN_URL.'/groupmenu/'.$skin_dir;

    ob_start();	   
    include_once ($groupmenu_skin_path.'/groupmenu.skin.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}


// co-메뉴
function cogroupmenu($skin_dir='basic',$co_id)
{
    global $config, $group, $g5, $is_admin;
	
	if(!$co_id || G5_IS_MOBILE)
        return;

	$groupmenu[] = array();

	$res = sql_query("select * from {$g5['content_table']} where co_id = '{$co_id}'");
	$co = sql_fetch_array($res);
	$res = sql_query("select * from {$g5['content_table']} where co_group = '{$co['co_group']}'");

	$grp = sql_fetch("select * from {$g5['group_content_table']} where gc_id = '{$co['co_group']}'");
	$group['gr_subject'] = $grp['gc_subject'];

	for($i=0; $i<$row=sql_fetch_array($res); $i++){
		$groupmenu[$i]['href'] = G5_BBS_URL.'/content.php?co_id='.$row['co_id'];
		$groupmenu[$i]['co_id'] = $row['co_id'];
		$groupmenu[$i]['subject'] = $row['co_subject'];
	}

	$groupmenu_skin_path = G5_SKIN_PATH.'/groupmenu/'.$skin_dir;
    $groupmenu_skin_url  = G5_SKIN_URL.'/groupmenu/'.$skin_dir;
	
    ob_start();	   
    include_once ($groupmenu_skin_path.'/c_groupmenu.skin.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>