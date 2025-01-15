<?
function board_write($rg_doc_num, $wr_name, $wr_password="1234", $w, $wr_num, $write_table, $bo_table, $wr_reply, $ca_name, $html, $secret, $wr_subject, $wr_content, $wr_link1, $wr_link2, $mb_id, $wr_email, $wr_homepage, $wr_date, $wr_ip, $file_name, $file_size ){
	global $prevTable;
	$g5['board_table'] = "g5_board";

	// 비회원의 경우 이름이 누락되는 경우가 있음
	$wr_name = clean_xss_tags(trim($wr_name));
	$wr_password = get_encrypt_string($wr_password);
	if($w=="r"){
		$wr_num = $wr_num;
		$wr_reply = $wr_reply;
	}else{
		$wr_num = get_next_num($write_table);
    }

    $sql = " insert into $write_table
                set wr_num = '$wr_num',
                     wr_reply = '$wr_reply',
                     wr_comment = 0,
                     ca_name = '$ca_name',
                     wr_option = '$html,$secret,$mail',
                     wr_subject = '$wr_subject',
                     wr_content = '$wr_content',
                     wr_link1 = '$wr_link1',
                     wr_link2 = '$wr_link2',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = '$mb_id',
                     wr_password = '$wr_password',
                     wr_name = '$wr_name',
                     wr_email = '$wr_email',
                     wr_homepage = '$wr_homepage',
                     wr_datetime = '$wr_date',
                     wr_last = '$wr_date',
                     wr_ip = '$wr_ip',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$rg_doc_num'
					 ";
		echo $sql;
		$result=sql_query($sql);
		if(!$result){
			echo $sql;

		}
    $wr_id = sql_insert_id();

    // 부모 아이디에 UPDATE
    sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

    // 게시글 1 증가
    sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");

	// 파일 경로
	// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
	$file_cnt = 0;
	for ($i=1; $i<=count($file_name); $i++)
	{
		
		
		if($file_name[$i]){
			echo $file_name[$i]."<br/>";
			copy(G5_PATH."/rg_data/{$prevTable}/".$file_name[$i],G5_DATA_PATH."/file/{$bo_table}/".$file_name[$i]);
			$sql = " insert into g5_board_file
						set bo_table = '{$bo_table}',
							 wr_id = '{$wr_id}',
							 bf_no = '".($i - 1)."',
							 bf_source = '{$file_name[$i]}',
							 bf_file = '{$file_name[$i]}',
							 bf_content = '',
							 bf_download = 0,
							 bf_filesize = '{$file_size[$i]}',
							 bf_width = '',
							 bf_height = '',
							 bf_type = '2',
							 bf_datetime = '$wr_date' ";
			sql_query($sql);
			$file_cnt++;
		}
	}

    sql_query(" update $write_table set wr_file = '$file_cnt' where wr_id = '$wr_id' ");
}


function board_write2($wr_num, $bo_table, $wr_subject, $wr_content, $wr_name, $wr_user_id, $wr_time, $wr_comment, $wr_document_srl, $wr_ca_name="") {
	global $g5, $member;
	
	$write_table = $g5['write_prefix'] . "$bo_table";
	
	$html = "html1";
	$g5_time = G5_TIME_YMDHIS;
		
    $sql = " insert into $write_table
                set wr_num = '$wr_num',
                    wr_comment = '$wr_comment',
                    ca_name = '$wr_ca_name',
                    wr_option = '$html',
                    wr_subject = '$wr_subject',
                    wr_content = '".addslashes($wr_content)."',
                    wr_link1_hit = 0,
                    wr_link2_hit = 0,
                    wr_hit = 0,
                    wr_good = 0,
                    wr_nogood = 0,
                    mb_id = '$wr_user_id',
                    wr_password = '',
                    wr_name = '$wr_name',
                    wr_datetime = '$wr_time',
                    wr_last = '$wr_time',
                    wr_ip = '$_SERVER[REMOTE_ADDR]' ";
    $result = sql_query($sql);
    $wr_id = mysql_insert_id();

    // 부모 아이디에 UPDATE
    sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

    // 새글 INSERT
	sql_query(" insert into $g5[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$bo_table', '$wr_id', '$wr_id', '$wr_time', '$wr_user_id' ) ");

	// 포인트 증가
	//insert_point($member[mb_id], "300", $wr_name . " 자동올리기");

	// 코멘트 복사
	$sql2 = "SELECT * FROM {$_POST['xe_db']}_comments where document_srl = '$wr_document_srl' ";
	$qry2 = sql_query($sql2);
	
	for($c=0;$c=$com=sql_fetch_array($qry2);$c++){
		$time = $com[last_update];
		$Y = substr($time,0,4);
		$m = substr($time,4,2);
		$d = substr($time,6,2);
		$H = substr($time,8,2);
		$i = substr($time,10,2);
		$s = substr($time,12,2);
		
		$wr_time = $Y."-".$m."-".$d." ".$H.":".$i.":".$s;
		comment_write($wr_num, "$bo_table", "$com[content]", "$com[nick_name]", "$com[user_id]", "$wr_time", $wr_id, "$com[ipaddress]");
	}

	// 첨부파일 복사
	$file_sql = " SELECT * FROM {$_POST['xe_db']}_files where upload_target_srl = '$wr_document_srl' and module_srl = {$_POST['xe_module_srl']} ";
	$file_qry = sql_query($file_sql);
	
	if(mysql_num_rows($file_qry) > 0) {
		// 첨부파일이 있는경우 G5 디렉토리에 복사
		for($f=0;$file_row=sql_fetch_array($file_qry);$f++){
			$file_time = $file_row[regdate];
			$Y = substr($file_time,0,4);
			$m = substr($file_time,4,2);
			$d = substr($file_time,6,2);
			$H = substr($file_time,8,2);
			$i = substr($file_time,10,2);
			$s = substr($file_time,12,2);
			$file_time = $Y."-".$m."-".$d." ".$H.":".$i.":".$s;
			
			$only_file_name = $file_row[uploaded_filename];
			$only_file_name = explode("/",$only_file_name);
			$only_file_name = $only_file_name[count($only_file_name)-1];


			copy("../"."$file_row[uploaded_filename]","../data/file/".$bo_table."/".$only_file_name);
			
			$file_in_sql = "
			insert into $g5[board_file_table]
				set bo_table = '$bo_table',
					wr_id = '$wr_id',
					bf_no = '$f',
					bf_source = '$file_row[source_filename]',
					bf_file = '$only_file_name',
					bf_download = '$file_row[download_count]',
					bf_content = '',
					bf_filesize = '$file_row[file_size]',
					bf_datetime = '$file_time'
			";	
			sql_query($file_in_sql);
			$sql_update = " update `$write_table` set wr_file = wr_file + 1 where wr_id = $wr_id ";
			sql_query($sql_update);
		}
	}
}

function comment_write($wr_num, $bo_table, $wr_content, $wr_name, $wr_user_id, $wr_time, $wr_id, $wr_ip) {
	global $g5, $member;
	
	$write_table = $g5['write_prefix'] . "$bo_table";
	$wr_reply = "";
	$html = "html1";
	$wr_subject = $wr_subject;
	$wr_link1 = "";	
	$wr_password = $member[mb_password];	
	$g5_time = G5_TIME_YMDHIS;
		
    $sql_c = " insert into $write_table
                set wr_num = '$wr_num',
                    wr_reply = '$wr_reply',
                    ca_name = '$ca_name',
					wr_is_comment = 1,
					wr_parent = '$wr_id',
                    wr_option = '$html',
                    wr_subject = '$wr_subject',
                    wr_content = '$wr_content',
                    wr_link1 = '$wr_link1',
                    wr_link1_hit = 0,
                    wr_link2_hit = 0,
                    wr_hit = 0,
                    wr_good = 0,
                    wr_nogood = 0,
                    mb_id = '$wr_user_id',
                    wr_password = '',
                    wr_name = '$wr_name',
                    wr_datetime = '$wr_time',
                    wr_last = '$wr_time',
                    wr_ip = '$wr_ip' ";
    sql_query($sql_c);
}
?>