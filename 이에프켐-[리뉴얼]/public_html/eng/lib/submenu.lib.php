<?php
// co-메뉴
function submenu($sm_tid, $skin_dir="basic", $theme_path=G5_PATH)
{
    global $config, $group, $g5;

    if(!$sm_tid)
        return;

    $sql = " select *
				from {$g5['submenu_table']}
				where sm_use = '1'
				  and length(sm_code) = '4'
				  and sm_tid = '{$sm_tid}'
				order by sm_order limit 1";
    $tid = sql_fetch($sql);

    if(!$tid['sm_code'])
        return;
    $sql = "select * from {$g5['submenu_table']} where sm_use = '1' and length(sm_code) = '2' and sm_code like '".substr($tid['sm_code'],0,2)."%' limit 1";
    $title = sql_fetch($sql);

    $sql = "select * from {$g5['submenu_table']} where sm_use = '1' and length(sm_code) = '4' and sm_code like '".substr($tid['sm_code'],0,2)."%' order by sm_order";
    $result = sql_query($sql);
    ob_start();
    include_once ($theme_path.'/skin/submenu/'.$skin_dir.'/submenu.skin.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>