<?php
include_once('./_common.php');

if ($is_admin)
{
    if (!($token && get_session('ss_delete_token') == $token))
        alert('토큰 에러로 삭제 불가합니다.');
}

//$wr = sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");

@include_once($board_skin_path.'/delete.head.skin.php');

if ($is_admin == 'super') // 최고관리자 통과
    ;
else if ($is_admin == 'group') { // 그룹관리자
    $mb = get_member($write['mb_id']);
    if ($member['mb_id'] != $group['gr_admin']) // 자신이 관리하는 그룹인가?
        alert('자신이 관리하는 그룹의 게시판이 아니므로 삭제할 수 없습니다.');
    else if ($member['mb_level'] < $mb['mb_level']) // 자신의 레벨이 크거나 같다면 통과
        alert('자신의 권한보다 높은 권한의 회원이 작성한 글은 삭제할 수 없습니다.');
} else if ($is_admin == 'board') { // 게시판관리자이면
    $mb = get_member($write['mb_id']);
    if ($member['mb_id'] != $board['bo_admin']) // 자신이 관리하는 게시판인가?
        alert('자신이 관리하는 게시판이 아니므로 삭제할 수 없습니다.');
    else if ($member['mb_level'] < $mb['mb_level']) // 자신의 레벨이 크거나 같다면 통과
        alert('자신의 권한보다 높은 권한의 회원이 작성한 글은 삭제할 수 없습니다.');
} else if ($member['mb_id']) {
    if ($member['mb_id'] != $write['mb_id'])
        alert('자신의 글이 아니므로 삭제할 수 없습니다.');
} else {
    if ($write['mb_id'])
        alert('로그인 후 삭제하세요.', './login.php?url='.urlencode('./board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id));
    else if (!check_password($wr_password, $write['wr_password']))
        alert('비밀번호가 틀리므로 삭제할 수 없습니다.');
}


if($bo_table == 'as'){
	$child_sql = " select * from {$write_table} where wr_id='{$wr_id}' ";
	$child_row = sql_fetch($child_sql);

	$parent_sql = " select * from g5_write_new where wr_id='{$child_row['wr_1']}' ";
	$parent_row = sql_fetch($parent_sql);
}


$len = strlen($write['wr_reply']);
if ($len < 0) $len = 0;
$reply = substr($write['wr_reply'], 0, $len);

// 원글만 구한다.
$sql = " select count(*) as cnt from $write_table
            where wr_reply like '$reply%'
            and wr_id <> '{$write['wr_id']}'
            and wr_num = '{$write['wr_num']}'
            and wr_is_comment = 0 ";
$row = sql_fetch($sql);
if ($row['cnt'] && !$is_admin)
    alert('이 글과 관련된 답변글이 존재하므로 삭제 할 수 없습니다.\\n\\n우선 답변글부터 삭제하여 주십시오.');

// 코멘트 달린 원글의 삭제 여부
$sql = " select count(*) as cnt from $write_table
            where wr_parent = '$wr_id'
            and mb_id <> '{$member['mb_id']}'
            and wr_is_comment = 1 ";
$row = sql_fetch($sql);
if ($row['cnt'] >= $board['bo_count_delete'] && !$is_admin)
    alert('이 글과 관련된 코멘트가 존재하므로 삭제 할 수 없습니다.\\n\\n코멘트가 '.$board['bo_count_delete'].'건 이상 달린 원글은 삭제할 수 없습니다.');


// 사용자 코드 실행
@include_once($board_skin_path.'/delete.skin.php');


// 나라오름님 수정 : 원글과 코멘트수가 정상적으로 업데이트 되지 않는 오류를 잡아 주셨습니다.
//$sql = " select wr_id, mb_id, wr_comment from $write_table where wr_parent = '$write[wr_id]' order by wr_id ";
$sql = " select wr_id, mb_id, wr_is_comment, wr_content from $write_table where wr_parent = '{$write['wr_id']}' order by wr_id ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result))
{
    // 원글이라면
    if (!$row['wr_is_comment'])
    {
        // 원글 포인트 삭제
        if (!delete_point($row['mb_id'], $bo_table, $row['wr_id'], '쓰기'))
            insert_point($row['mb_id'], $board['bo_write_point'] * (-1), "{$board['bo_subject']} {$row['wr_id']} 글삭제");

        // 업로드된 파일이 있다면 파일삭제
        $sql2 = " select * from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '{$row['wr_id']}' ";
        $result2 = sql_query($sql2);
        while ($row2 = sql_fetch_array($result2)) {
            @unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row2['bf_file']);
            // 썸네일삭제
            if(preg_match("/\.({$config['cf_image_extension']})$/i", $row2['bf_file'])) {
                delete_board_thumbnail($bo_table, $row2['bf_file']);
            }
        }

        // 에디터 썸네일 삭제
        delete_editor_thumbnail($row['wr_content']);

        // 파일테이블 행 삭제
        sql_query(" delete from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '{$row['wr_id']}' ");

        $count_write++;
    }
    else
    {
        // 코멘트 포인트 삭제
        if (!delete_point($row['mb_id'], $bo_table, $row['wr_id'], '댓글'))
            insert_point($row['mb_id'], $board['bo_comment_point'] * (-1), "{$board['bo_subject']} {$write['wr_id']}-{$row['wr_id']} 댓글삭제");

        $count_comment++;
    }
}

if($bo_table == 'new'){
	$nt_sql = " select * from g5_write_new_type where nt_wr_id = '{$write['wr_id']}' order by nt_order asc ";
	$nt_qry = sql_query($nt_sql);
	$nt_num = sql_num_rows($nt_qry);
	if($nt_num > 0){
		for($r=0; $r<$nt_num; $r++){
			$nt_row = sql_fetch_array($nt_qry);
			if($nt_row['nt_file'] != ''){
				@unlink(G5_DATA_PATH.'/new_type/'.$nt_row['nt_file']);
			}
		}
	}
	$nt_del_sql = " delete from g5_write_new_type where nt_wr_id = '{$write['wr_id']}' ";
	sql_query($nt_del_sql);
}

// 게시글 삭제
sql_query(" delete from $write_table where wr_parent = '{$write['wr_id']}' ");

// 최근게시물 삭제
sql_query(" delete from {$g5['board_new_table']} where bo_table = '$bo_table' and wr_parent = '{$write['wr_id']}' ");

// 스크랩 삭제
sql_query(" delete from {$g5['scrap_table']} where bo_table = '$bo_table' and wr_id = '{$write['wr_id']}' ");


if($bo_table == 'as'){
	$chk1_sql = " select max(wr_3) as max_wr_3 from {$write_table} where wr_1='{$child_row['wr_1']}' and wr_2='정기점검' ";
	$chk1_row = sql_fetch($chk1_sql);
	$max_wr_3 = str_replace('-','',$chk1_row['max_wr_3']);
	$max_wr_3_arr = explode('-',$chk1_row['max_wr_3']);

	if($chk1_row['max_wr_3'] != '' && $max_wr_3 > 0){
		$new_sql = " select wr_16 from g5_write_new where wr_id='{$child_row['wr_1']}' ";
		$new_row = sql_fetch($new_sql);
		if($new_row['wr_16'] != ''){
			$latest_month = (int)$max_wr_3_arr[1];
			$wr_16 = str_replace('개월','',$new_row['wr_16']);
			$next_month = $latest_month + $wr_16;
			if($next_month > 12){
				$plus_year = $max_wr_3_arr[0] + floor($next_month / 12);
				$next_month = $next_month % 12;
			}else{
				$plus_year = $max_wr_3_arr[0];
			}

			if($next_month < 10) $next_month = '0'.$next_month;

			$next_check_date = $plus_year.$next_month.$max_wr_3_arr[2];

			$up_sql = " update g5_write_new set next_check_date = '{$next_check_date}' where wr_id='{$child_row['wr_1']}' ";
			sql_query($up_sql);
		}

		$up_sql = " update g5_write_new set latest_check_date = '{$max_wr_3}' where wr_id='{$child_row['wr_1']}' ";
		sql_query($up_sql);
	}else{
		$nt_sql = " select * from g5_write_new_type where nt_wr_id='{$child_row['wr_1']}' order by nt_date desc ";
		$nt_row = sql_fetch($nt_sql);
		if($nt_row['nt_idx'] != ''){
			$latest_check_date = str_replace('-','',$nt_row['nt_date']);	// 최근점검일자
			
			$latest_date_arr = explode('-',$latest_check_date);
			$latest_month = (int)$latest_date_arr[1];
			if($new_sql['wr_16'] != ''){
				$next_month = $latest_month + str_replace('개월','',$new_sql['wr_16']);
				if($next_month > 12){
					$plus_year = $latest_date_arr[0] + floor($next_month / 12);
					$next_month = $next_month % 12;
				}else{
					$plus_year = $latest_date_arr[0];
				}

				if($next_month < 10) $next_month = '0'.$next_month;

				$next_check_date = $plus_year.$next_month.$latest_date_arr[2];	// 다음점검일자
			}

			$up_sql = " update g5_write_new set latest_check_date = '{$latest_check_date}', next_check_date = '{$next_check_date}', where wr_id='{$child_row['wr_1']}' ";
			sql_query($up_sql);
		}
	}
}


/*
// 공지사항 삭제
$notice_array = explode("\n", trim($board['bo_notice']));
$bo_notice = "";
for ($k=0; $k<count($notice_array); $k++)
    if ((int)$write[wr_id] != (int)$notice_array[$k])
        $bo_notice .= $notice_array[$k] . "\n";
$bo_notice = trim($bo_notice);
*/
$bo_notice = board_notice($board['bo_notice'], $write['wr_id']);
sql_query(" update {$g5['board_table']} set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");

// 글숫자 감소
if ($count_write > 0 || $count_comment > 0)
    sql_query(" update {$g5['board_table']} set bo_count_write = bo_count_write - '$count_write', bo_count_comment = bo_count_comment - '$count_comment' where bo_table = '$bo_table' ");

@include_once($board_skin_path.'/delete.tail.skin.php');

delete_cache_latest($bo_table);

if($bo_table == 'new' && $sch_wr_2 == '임대해지'){
	goto_url('./board.php?bo_table='.$bo_table.'&sch_wr_2='.urlencode($sch_wr_2));
}

if($bo_table == 'as'){
	goto_url('./board.php?bo_table=new&wr_id='.$write['wr_1']);
}

goto_url('./board.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr);
?>
