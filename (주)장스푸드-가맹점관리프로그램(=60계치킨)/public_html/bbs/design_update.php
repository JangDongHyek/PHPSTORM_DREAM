<?php
include_once('./_common.php');

if($mode == 'design'){
	$sql = " update g5_order set 
		design_check_cnt = '1',
		edit_post = '{$edit_post}',
		edit_check = '수정요청'
		where od_idx = '{$od_idx}'
	";
	sql_query($sql);

	/* SMS 발송 STR */
	// SMS 발송
	$od_sql = " select * from g5_order where od_idx = '{$od_idx}' ";
	$od_row = sql_fetch($od_sql);
	$mb_hp = $od_row['mb_hp'];

	$mem_sql = " select * from g5_member where mb_id='{$od_row['mb_id']}' ";
	$mem_row = sql_fetch($mem_sql);

	$moid_arr = explode('60chicken4_',$od_row['moid']);

	//$conn_db = mysql_connect("211.115.216.107","jfsms","wkdtmvnem12!@");
	$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
	//mysql_select_db("si_server");
	mysql_select_db("chicken60");

	$tran_msg1 = "[60계치킨] 수정 요청이 접수되었습니다\n주문번호: {$moid_arr[1]}";

	$tran_msg2 = "[60계치킨] 디자인 수정요청이 등록되었습니다\n매장명: {$mem_row['mb_2']}";

	$sql = "insert into TBL_SUBMIT_QUEUE values
	(
		'200".$od_idx."2',
		'orders',
		'4133',
		'1',
		'00',
		'I',
		CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
		'1',
		'".str_replace('-','',$mb_hp)."',
		'$g_tel1',
		'',
		'00000',
		'".$tran_msg1."',
		'',
		'0',
		'',
		'',
		CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
		'',
		'',
		'',
		'',
		'0',
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'0',
		'0'
	)";
	mysql_query($sql,$conn_db);

	$oscm1_sql = " select * from g5_order_sms_cate_mb where oscm_ca_name='주문' and oscm_use='y' ";
	$oscm1_qry = sql_query($oscm1_sql);
	$k1=0;
	while($oscm1_row = sql_fetch_array($oscm1_qry)){
		$sql2 = "insert into TBL_SUBMIT_QUEUE values
		(
			'200".$od_idx."2".$k1."',
			'orders',
			'4133',
			'1',
			'00',
			'I',
			CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
			'1',
			'".str_replace('-','',$oscm1_row['oscm_mb_hp'])."',
			'$g_tel1',
			'',
			'00000',
			'".$tran_msg2."',
			'',
			'0',
			'',
			'',
			CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
			'',
			'',
			'',
			'',
			'0',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'0',
			'0'
		)";
		mysql_query($sql2,$conn_db);
		$k1++;
	}
	/* SMS 발송 END */

	alert('시안 수정요청을 하였습니다.',G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$od_idx.'&page='.$page.'&mode='.$mode);

} else {

	$upload_path = G5_DATA_PATH.'/design_file/';

	if($_FILES['design_file']['name'] != ''){
		if($pre_design_file != ''){
			@unlink($upload_path.$pre_design_file);
		}

		$design_file_name = $od_idx.'_'.iconv('utf-8','euc-kr',$_FILES['design_file']['name']);
		$design_file_name2 = $od_idx.'_'.$_FILES['design_file']['name'];
		if(move_uploaded_file($_FILES['design_file']['tmp_name'], $upload_path.$design_file_name)){
			$sql_query = ", design_file = '{$design_file_name2}'";
		}

		$sql = " update g5_order set 
			design_check = '검토요청',
			edit_check = '' 
			{$sql_query}
			where od_idx = '{$od_idx}'
		";
		sql_query($sql);

		/* SMS 발송 STR */
		// SMS 발송
		$od_sql = " select * from g5_order where od_idx = '{$od_idx}' ";
		$od_row = sql_fetch($od_sql);
		$mb_hp = $od_row['mb_hp'];

		$moid_arr = explode('60chicken4_',$od_row['moid']);

		//$conn_db = mysql_connect("211.115.216.107","jfsms","wkdtmvnem12!@");
		$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
		//mysql_select_db("si_server");
		mysql_select_db("chicken60");

		$tran_msg1 = "[60계치킨] 디자인 검토 요청이 접수되었습니다.\n주문번호: {$moid_arr[1]}";

		$sql = "insert into TBL_SUBMIT_QUEUE values
		(
			'200".$od_idx."2',
			'orders',
			'4133',
			'1',
			'00',
			'I',
			CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
			'1',
			'".str_replace('-','',$mb_hp)."',
			'$g_tel1',
			'',
			'00000',
			'".$tran_msg1."',
			'',
			'0',
			'',
			'',
			CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
			'',
			'',
			'',
			'',
			'0',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'0',
			'0'
		)";
		mysql_query($sql,$conn_db);
		/* SMS 발송 END */
	}

	alert('시안 검토를 요청하였습니다.',G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$od_idx.'&page='.$page);

}
?>
