<?php
// co-메뉴
function submenu($sm_tid, $skin_dir="basic", $theme_path=G5_PATH)
{
    global $config, $group, $g5,$bo_table,$sca,$swr2;


	if(!$sm_tid)
		return;
    if($bo_table == "product"){
        switch($sca){
            case "산업용 로봇":
                $sm_tid="product";
                break;
            case "협동로봇":
                $sm_tid="product02";
                break;
            case "주변기기/그리퍼": //FIXME 필요없을경우 나중에 삭제
            case "AGV/AMR": //231115_수정 추가
                $sm_tid="product03";
                break;
            case "PLC/통신기기":
                $sm_tid="product04";
                break;
        }
    }
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