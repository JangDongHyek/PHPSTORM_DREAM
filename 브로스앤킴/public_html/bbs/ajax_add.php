<?
include_once('./_common.php');

$wr_num = get_next_num("g5_write_invest");
$wr_reply = "";
$wr_subject = "투자";
$wr_content = "투자";
$bo_table = "invest";

if($wr_id) {
	if($del == true){
		sql_query("delete from `g5_write_invest` where wr_id = '$wr_id'");
		echo "삭제되었습니다.";
	} else {
		$sql = " update `g5_write_invest` set
					 wr_1 = '$fundname',
					 wr_2 = '$dep_day',
					 wr_3 = '$dep_moeny',
					 wr_4 = '$goal',
					 wr_5 = '$setting',
					 wr_6 = '$exp_day',
					 wr_7 = '$acc_num',
					 wr_8 = '$memo',
					 wr_9 = '$admin'
			  where wr_id = '$wr_id' ";
		sql_query($sql);
		echo "수정되었습니다.";
	}


/*
    // 분류가 수정되는 경우 해당되는 코멘트의 분류명도 모두 수정함
    // 코멘트의 분류를 수정하지 않으면 검색이 제대로 되지 않음
    $sql = " update `g5_write_invest` set ca_name = '{$ca_name}' where wr_parent = '$wr_id' ";
    sql_query($sql);

    $bo_notice = board_notice($board['bo_notice'], $wr_id, $notice);
    sql_query(" update {$g5['board_table']} set bo_notice = '{$bo_notice}' where bo_table = '{$bo_table}' ");
*/
} else {
	$sql = " insert into `g5_write_invest`
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
					 wr_name = '$mb_name',
					 wr_email = '$wr_email',
					 wr_homepage = '$wr_homepage',
					 wr_datetime = '".G5_TIME_YMDHIS."',
					 wr_last = '".G5_TIME_YMDHIS."',
					 wr_ip = '{$_SERVER['REMOTE_ADDR']}',
					 wr_1 = '$fundname',
					 wr_2 = '$dep_day',
					 wr_3 = '$dep_moeny',
					 wr_4 = '$goal',
					 wr_5 = '$setting',
					 wr_6 = '$exp_day',
					 wr_7 = '$acc_num',
					 wr_8 = '$memo',
					 wr_9 = '$admin',
					 wr_10 = '$wr_10' 
					 {$sql_orderby} ";
	sql_query($sql);

	$wr_id = sql_insert_id();

	// 부모 아이디에 UPDATE
	sql_query(" update `g5_write_invest` set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

	// 새글 INSERT
	sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '$mb_id' ) ");

	// 게시글 1 증가
	sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");
	
	echo "추가되었습니다.";
}

?>