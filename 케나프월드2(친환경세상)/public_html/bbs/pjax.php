<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$pjax				= $_GET['_pjax'];
$bo_table			= $_GET['bo_table'];
$wr_id				= $_GET['wr_id'];

if(!$pjax)
	goto_url(G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$wr_id);

$view	= sql_fetch(" select * from {$write_table} where wr_id = '{$wr_id}' ");
$file	= get_file($bo_table, $wr_id);
$thumb	= array();

// 파일 출력
for ($i=0; $i<count($file); $i++) {
	if ($file[$i]['view']) {
		$thumb[$i] = get_kakao_thumbnail($file[$i]['view'], 400);
		if(!$kakao_thumb)
			$kakao_thumb = get_kakao_thumbnail($file[$i]['view'], 400);
	}
}

$result					= $view;
$result['file']			= $file;
$result['thumb']		= $thumb;
$result['kakao_thumb']	= $kakao_thumb;
$result['pjax']			= $pjax;
$result['bo_table']		= $bo_table; 
$result['wr_content']	= get_view_thumbnail2($view['wr_content'], 300);

echo json_encode($result);
?>