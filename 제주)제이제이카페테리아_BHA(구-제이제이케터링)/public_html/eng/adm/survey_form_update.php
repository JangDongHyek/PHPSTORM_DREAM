<?php
$sub_menu = "500100";
include_once('./_common.php');
include_once('./survery_config.php');

for($i=0; $i<count($cl_subject); $i++){
	$sql_common[$i] = ", 
					cl_subject = '{$cl_subject[$i]}',
					cl_ext = '{$cl_ext[$i]}',
					cl_ext_cnt = '{$cl_ext_cnt[$i]}',
					cl_ext_txt = '{$cl_ext_txt[$i]}'
						";

	for($j=0; $j<count($cl[$i]); $j++){
		$sql_common[$i] .= ", cl_".($j+1)." = '{$cl[$i][$j]}'";
		$sql_common[$i] .= ", cl_cnt".($j+1)." = '{$cl_cnt[$i][$j]}'";
	}
}


if($w==""){
	$sql = "insert into {$g5['survey_table']}
			set 
				sv_subject = '{$sv_subject}',
				sv_date	   = '".G5_TIME_YMD."'
	";
	sql_query($sql);
	$sv_id = sql_insert_id();

	for($i=0; $i<count($sql_common); $i++){
		$sql = "insert into {$g5['clause_table']}
				set
					sv_id = '{$sv_id}'
					{$sql_common[$i]}
		";
		sql_query($sql);
	}
}else{
	$sv_id = $_POST['sv_id'];
	$sql = "update {$g5['survey_table']}
			set 
				sv_subject = '{$sv_subject}',
				sv_ips = '{$sv_ips}',
				mb_ids = '{$mb_ids}'
			where sv_id = '{$sv_id}'
	";
	sql_query($sql);

	//$sql = "DELETE FROM `g5_eazy_clause` WHERE sv_id = '{$sv_id}'";
	//sql_query($sql);
	$sql = "select * from {$g5['clause_table']} where sv_id = '{$sv_id}' order by cl_id asc";
	$result = sql_query($sql);
	$cnt = sql_num_rows($result) > count($sql_common) ? sql_num_rows($result):count($sql_common); //갯수가 많은게 기준
	for($i=0; $i < $cnt; $i++){
		$cl = sql_fetch_array($result);
		if($sql_common[$i]){
			if($cl_id[$i]){
				$sql = "update {$g5['clause_table']} 
						set
							sv_id = '{$sv_id}'
							{$sql_common[$i]}
						where cl_id = '".$cl_id[$i]."'
				";
			}else{
				$sql = "insert into {$g5['clause_table']}
						set
							sv_id = '{$sv_id}'
							{$sql_common[$i]}
				";
			}
		}else{
			$sql = "DELETE FROM `g5_eazy_clause` WHERE cl_id = '".$cl['cl_id']."'";
		}
		sql_query($sql);

		if($i>=1000) break;
	}
}

goto_url("./survey_list.php");
?>