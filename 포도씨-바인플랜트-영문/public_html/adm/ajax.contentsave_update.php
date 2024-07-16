<?php
$sub_menu = '300600';
include_once('./_common.php');

@mkdir(G5_DATA_PATH."/content_save", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/content_save", G5_DIR_PERMISSION);

$sql_common = " co_include_head     = '$co_include_head',
                co_include_tail     = '$co_include_tail',
                co_html             = '$co_html',
                co_tag_filter_use   = '$co_tag_filter_use',
                co_subject          = '$co_subject',
                co_content          = '$co_content',
                co_mobile_content   = '$co_mobile_content',
                co_skin             = '$co_skin',
                co_mobile_skin      = '$co_mobile_skin',
				co_datetime			= '".G5_TIME_YMDHIS."'
                 ";

$sql = " insert {$g5['content_save_table']}
			set co_id = '$co_id',
				$sql_common ";
sql_query($sql);

$sql = " select co_id from {$g5['content_table']} where co_id = '$co_id' ";
$row = sql_fetch($sql);

$prev_path = G5_DATA_PATH."/content/".$co_id."_h";
$dest_path = G5_DATA_PATH."/content_save/".$co_id."_h ".G5_TIME_YMDHIS;

// 파일 복사
if(file_exists($prev_path)) { 
	copy($prev_path, $dest_path);
} 

$prev_path = G5_DATA_PATH."/content/".$co_id."_t";
$dest_path = G5_DATA_PATH."/content_save/".$co_id."_t ".G5_TIME_YMDHIS;

// 파일 복사
if(file_exists($prev_path)) { 
	copy($prev_path, $dest_path);
} 

echo "저장이 완료되었습니다."
?>
