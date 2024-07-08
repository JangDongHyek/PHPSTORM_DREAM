<?
$goto_url = G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table;

if (defined('G5_IS_ADMIN')) {
	$goto_url = str_replace(G5_URL, G5_ADMIN_URL, $goto_url);
} 

// 게시판 리스트로 이동
goto_url($goto_url);
?>