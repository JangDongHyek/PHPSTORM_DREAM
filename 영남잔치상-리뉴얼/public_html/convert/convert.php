<?php
include_once ('../bbs/_common.php');
$sql="select * from new_board where bbs_no='17' order by index_no asc";
$result=sql_query($sql);
for($i=0;$row=sql_fetch_array($result);$i++){
	$wr_num = get_next_num("g5_write_gall02");
	$wr_parent = abs($wr_num);
	$mb_id="admin";
	$wr_password="";
	$wr_name="관리자";
	$wr_email="";
	$wr_datetime=$row[write_date];
	$files=array();
	$fileSizes=array();
	if($row[userfile]){
		array_push($files,$row[userfile]);
		array_push($fileSizes,filesize("../janchisang/".$row[userfile]));
	}
	if($row[userfile1]){
		array_push($files,$row[userfile1]);
		array_push($fileSizes,filesize("../janchisang/".$row[userfile1]));
	}
	if($row[userfile2]){
		array_push($files,$row[userfile2]);
		array_push($fileSizes,filesize("../janchisang/".$row[userfile2]));
	}
	if($row[userfile3]){
		array_push($files,$row[userfile3]);
		array_push($fileSizes,filesize("../janchisang/".$row[userfile3]));
	}
	if($row[userfile4]){
		array_push($files,$row[userfile4]);
		array_push($fileSizes,filesize("../janchisang/".$row[userfile4]));
	}
	$content2=addslashes($row[content2]);
	$wr_2=$row[mtm_telno1]."-".$row[mtm_telno2]."-".$row[mtm_telno3];

	$sql="select * from g5_write_gall02 where wr_10='$row[index_no]'";
	$row2=sql_fetch($sql);
	if($row2[wr_id]==""){

		$sql="insert into g5_write_gall02
				set wr_num='$wr_num',
				wr_parent='$wr_parent',
				wr_is_comment='0',
				wr_comment='0',
				wr_content='$content2',
				wr_subject='".addslashes($row[subject_new])."',
				wr_1='".addslashes($row[mtm_phone1])."',
				wr_2='$wr_2',
				wr_3='$row[ext1]',
				wr_4='$row[content]',
				mb_id='$mb_id',
				wr_password='$wr_password',
				wr_email='$wr_email',
				wr_datetime='$wr_datetime',
				wr_10='$row[index_no]'";
		echo $sql."<br/>";
		sql_query($sql);
		$wr_id = sql_insert_id();
		$file_cnt = 0;
		for ($i=0; $i<count($files); $i++)
		{
			
			if($files[$i]){
				copy(G5_PATH."/janchisang/".$files[$i],G5_DATA_PATH."/file/gall02/".$files[$i]);
				$sql = " insert into g5_board_file
							set bo_table = 'gall02',
								 wr_id = '{$wr_id}',
								 bf_no = '".($i+1)."',
								 bf_source = '{$files[$i]}',
								 bf_file = '{$files[$i]}',
								 bf_content = '',
								 bf_download = 0,
								 bf_filesize = '{$fileSizes[$i]}',
								 bf_width = '',
								 bf_height = '',
								 bf_type = '2',
								 bf_datetime = '$wr_datetime' ";
				sql_query($sql);
				$file_cnt++;
			}
		}
		 sql_query(" update g5_write_gall02 set wr_file = '$file_cnt' where wr_id = '$wr_id' ");
	}
}	