<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if ($wr_link1) { 
	
    preg_match('@https?://(?:www\.)?youtube\.com/(?:watch\?|\?)?v[/=]([a-zA-Z0-9-_]+)@', $wr_link1, $matches);
	$wr_1 = $matches[1];

    if (!$wr_1) { 
        preg_match('@https?://(?:www\.)?youtu\.be/([a-zA-Z0-9-_]+)@', $wr_link1, $matches);
        $wr_1 = $matches[1];
    } 

	if ($wr_1) { 
		sql_query(" update {$write_table} set wr_1 = '$wr_1' where wr_id = '$wr_id' ");    
	}
} 
else {
	sql_query(" update {$write_table} set wr_1 = '' where wr_id = '$wr_id' ");
}