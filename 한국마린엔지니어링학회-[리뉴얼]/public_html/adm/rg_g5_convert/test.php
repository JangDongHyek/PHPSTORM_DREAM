<?php
$sub_menu = "910100";
include_once('./_common.php');
$sql="select * from rg_memb_body";
$result=sql_query($sql);
while($row=sql_fetch_array($result)){
	$sql="select * from rg_memb_category where cat_num='$row[rg_cat_num]'";
	$row2=sql_fetch($sql);
	$sql="insert g5_write_greet05 set 
			ca_name='$row2[cat_name]',
			wr_name='관리자',
			mb_id='admin',
			wr_subject='$row[rg_name]',
			wr_content='$row[rg_title]'";
	sql_query($sql);
	$wr_id=sql_insert_id();
	if($row['rg_file1_name']){
		if(file_exists(G5_PATH."/rg_data/memb/".$row['rg_doc_num']."\1\$th2\$".$row['rg_file1_name'])){
			$file_name = $row['rg_doc_num']."\$1\$th2\$".$row['rg_file1_name'];
		}else{
			$file_name = $row['rg_doc_num']."\$1\$".$row['rg_file1_name'];
		}
		$file_size = $row['rg_file1_size'];
	}else{
		$file_name="";
		$file_size=0;
	}
	echo $file_name;

copy(G5_PATH."/rg_data/memb/".$file_name,G5_DATA_PATH."/file/greet05/".$file_name);
			$sql = " insert into g5_board_file
						set bo_table = 'greet05',
							 wr_id = '{$wr_id}',
							 bf_no = '".($i - 1)."',
							 bf_source = '{$file_name}',
							 bf_file = '{$file_name}',
							 bf_content = '',
							 bf_download = 0,
							 bf_filesize = '{$file_size}',
							 bf_width = '',
							 bf_height = '',
							 bf_type = '2',
							 bf_datetime = '$wr_date' ";
			sql_query($sql);

						
}
?>