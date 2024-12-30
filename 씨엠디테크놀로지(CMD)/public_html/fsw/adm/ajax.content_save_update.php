<?php
include_once("./_common.php");

$frm = array();
foreach ($_POST['frm'] as $key => $val) {
	$frm[$_POST['frm'][$key]['name']] = $_POST['frm'][$key]['value']; 
}

if($frm['t'] == "b"){
	$co = sql_fetch("select * from {$g5['content_table']} where co_id = '{$frm['co_id']}'");
	unset($frm);
	$frm = $co;
}

extract($frm);

$sql_common = " 
				co_id				= '$co_id',
				co_include_head     = '$co_include_head',
				co_include_tail     = '$co_include_tail',
				co_html             = '$co_html',
				co_tag_filter_use   = '$co_tag_filter_use',
				co_subject          = '$co_subject',
				co_content          = '$co_content',
				co_mobile_content   = '$co_mobile_content',
				co_skin             = '$co_skin',
				co_mobile_skin      = '$co_mobile_skin',
				co_datetime			= '".G5_TIME_YMDHIS."'";

sql_query("insert into {$g5['content_save_table']} set {$sql_common}");

?>