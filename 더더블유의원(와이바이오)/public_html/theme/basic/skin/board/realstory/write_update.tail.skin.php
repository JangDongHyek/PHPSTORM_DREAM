<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
	if($board['bo_use_category']) {
		if($ca_name=="etc" && $ca_name_user){
			$category=explode("|",$board['bo_category_list']);
			for($i=0;$i<count($category);$i++){
				if($category[$i]==$ca_name_user){
					$c="no";
					sql_query("update {$write_table} set ca_name = '{$ca_name_user}' where wr_id='{$wr_id}'");
					break;
				}
			}
			if(!$c){
				$new_cate=$board['bo_category_list']."|".$ca_name_user;
				$sort_cate=explode("|",$new_cate);
				sort($sort_cate);
				$cate="";
				$cutnum=count($sort_cate) -1;
				for($i=0;$i<count($sort_cate);$i++){
					if($i==$cutnum){
						$cate .= $sort_cate[$i];
					}
					else{
						$cate.= $sort_cate[$i]."|";
					}
				}
				sql_query("update {$g5['board_table']} set bo_category_list = '{$cate}' where bo_table='{$bo_table}'");
				sql_query("update {$write_table} set ca_name = '{$ca_name_user}' where wr_id='{$wr_id}'");				
			}
		}
	}
?>
