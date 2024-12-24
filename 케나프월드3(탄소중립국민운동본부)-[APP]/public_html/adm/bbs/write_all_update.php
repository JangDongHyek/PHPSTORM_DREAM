<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

$g5['title'] = '게시글 저장';

$msg = array();


$wr_subject = '';


$upload_max_filesize = ini_get('upload_max_filesize');

$wr_idArray=array();

	for($i=0; $i < count($wr_content); $i++){
				$wr_num = get_next_num($write_table);
        $wr_reply = '';
			    $sql = " insert into $write_table
                set wr_num = '$wr_num',
                     wr_reply = '$wr_reply',
                     wr_comment = 0,
                     ca_name = '$ca_name',
                     wr_option = '$html,$secret,$mail',
                     wr_subject = '$wr_subject',
                     wr_content = '$wr_content[$i]',
                     wr_link1 = '$wr_link1',
                     wr_link2 = '$wr_link2',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = '{$member['mb_id']}',
                     wr_password = '$wr_password',
                     wr_name = '$wr_name',
                     wr_email = '$wr_email',
                     wr_homepage = '$wr_homepage',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_1 = '$wr_1[$i]',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$wr_10' 
					 {$sql_orderby} ";
    sql_query($sql);
		$wr_id = sql_insert_id();
		array_push($wr_idArray,$wr_id);
    // 부모 아이디에 UPDATE
    sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

    // 새글 INSERT
    sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$member['mb_id']}' ) ");

    // 게시글 1 증가
    sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");

    // 쓰기 포인트 부여
    if ($w == '') {
        if ($notice) {
            $bo_notice = $wr_id.($board['bo_notice'] ? ",".$board['bo_notice'] : '');
            sql_query(" update {$g5['board_table']} set bo_notice = '{$bo_notice}' where bo_table = '{$bo_table}' ");
        }

        insert_point($member['mb_id'], $board['bo_write_point'], "{$board['bo_subject']} {$wr_id} 글쓰기", $bo_table, $wr_id, '쓰기');
    } else {
        // 답변은 코멘트 포인트를 부여함
        // 답변 포인트가 많은 경우 코멘트 대신 답변을 하는 경우가 많음
        insert_point($member['mb_id'], $board['bo_comment_point'], "{$board['bo_subject']} {$wr_id} 글답변", $bo_table, $wr_id, '쓰기');
    }
	
	}

    
 



// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));



for($k=0; $k < count($wr_content); $k++){
	// 가변 파일 업로드
	$file_upload_msg = '';
	$upload = array();
	for ($i=0; $i<count($_FILES['bf_file']['name'][$k]); $i++) {
			$upload[$i]['file']     = '';
			$upload[$i]['source']   = '';
			$upload[$i]['filesize'] = 0;
			$upload[$i]['image']    = array();
			$upload[$i]['image'][0] = '';
			$upload[$i]['image'][1] = '';
			$upload[$i]['image'][2] = '';

			// 삭제에 체크가 되어있다면 파일을 삭제합니다.
			if (isset($_POST['bf_file_del'][$i][$i]) && $_POST['bf_file_del'][$i][$i]) {
					$upload[$i]['del_check'] = true;

					$row = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
					@unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file']);
					// 썸네일삭제
					if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
							delete_board_thumbnail($bo_table, $row['bf_file']);
					}
			}
			else
					$upload[$i]['del_check'] = false;

			$tmp_file  = $_FILES['bf_file']['tmp_name'][$k][$i];
			$filesize  = $_FILES['bf_file']['size'][$k][$i];
			$filename  = $_FILES['bf_file']['name'][$k][$i];
			$filename  = get_safe_filename($filename);

			// 서버에 설정된 값보다 큰파일을 업로드 한다면
			if ($filename) {
					if ($_FILES['bf_file']['error'][$k][$i] == 1) {
							$file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
							continue;
					}
					else if ($_FILES['bf_file']['error'][$k][$i] != 0) {
							$file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
							continue;
					}
			}

			if (is_uploaded_file($tmp_file)) {
					// *관리자가 아니면서* 삭제, 설정한 업로드 사이즈보다 크다면 건너뜀
					if ($filesize > $board['bo_upload_size']) {
							$file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
							continue;
					}

					//=================================================================\
					// 090714
					// 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
					// 에러메세지는 출력하지 않는다.
					//-----------------------------------------------------------------
					$timg = @getimagesize($tmp_file);
					// image type
					if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
							 preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
							if ($timg['2'] < 1 || $timg['2'] > 16)
									continue;
					}
					//=================================================================

					$upload[$i]['image'] = $timg;

					// 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
					if ($w == 'u') {
							// 존재하는 파일이 있다면 삭제합니다.
							$row = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
							@unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file']);
							// 이미지파일이면 썸네일삭제
							if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
									delete_board_thumbnail($bo_table, $row['bf_file']);
							}
					}

					// 프로그램 원래 파일명
					$upload[$i]['source'] = $filename;
					$upload[$i]['filesize'] = $filesize;

					// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
					$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

					shuffle($chars_array);
					$shuffle = implode('', $chars_array);

					// 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
					$upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

					$dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$upload[$i]['file'];

					// 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
					$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

					// 올라간 파일의 퍼미션을 변경합니다.
					chmod($dest_file, G5_FILE_PERMISSION);
			}
	}

	// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
	for ($i=0; $i<count($upload); $i++)
	{
			if (!get_magic_quotes_gpc()) {
					$upload[$i]['source'] = addslashes($upload[$i]['source']);
			}

			$row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
			if ($row['cnt'])
			{
					// 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
					// 그렇지 않다면 내용만 업데이트 합니다.
					if ($upload[$i]['del_check'] || $upload[$i]['file'])
					{
							$sql = " update {$g5['board_file_table']}
													set bf_source = '{$upload[$i]['source']}',
															 bf_file = '{$upload[$i]['file']}',
															 bf_content = '{$bf_content[$i]}',
															 bf_filesize = '{$upload[$i]['filesize']}',
															 bf_width = '{$upload[$i]['image']['0']}',
															 bf_height = '{$upload[$i]['image']['1']}',
															 bf_type = '{$upload[$i]['image']['2']}',
															 bf_datetime = '".G5_TIME_YMDHIS."'
												where bo_table = '{$bo_table}'
																	and wr_id = '{$wr_idArray[$k]}'
																	and bf_no = '{$i}' ";
							sql_query($sql);
					}
					else
					{
							$sql = " update {$g5['board_file_table']}
													set bf_content = '{$bf_content[$i]}'
													where bo_table = '{$bo_table}'
																		and wr_id = '{$wr_idArray[$k]}'
																		and bf_no = '{$i}' ";
							sql_query($sql);
					}
			}
			else
			{
					$sql = " insert into {$g5['board_file_table']}
											set bo_table = '{$bo_table}',
													 wr_id = '{$wr_idArray[$k]}',
													 bf_no = '{$i}',
													 bf_source = '{$upload[$i]['source']}',
													 bf_file = '{$upload[$i]['file']}',
													 bf_content = '{$bf_content[$i]}',
													 bf_download = 0,
													 bf_filesize = '{$upload[$i]['filesize']}',
													 bf_width = '{$upload[$i]['image']['0']}',
													 bf_height = '{$upload[$i]['image']['1']}',
													 bf_type = '{$upload[$i]['image']['2']}',
													 bf_datetime = '".G5_TIME_YMDHIS."' ";
					sql_query($sql);
			}
	}

	//------------------------------------------------------------------------------

	// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
	// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
	$row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_idArray[$k]}' ");
	for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
	{
		$row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_idArray[$k]}' and bf_no = '{$i}' ");

		// 정보가 있다면 빠집니다.
		if ($row2['bf_file']) break;

		// 그렇지 않다면 정보를 삭제합니다.
		sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_idArray[$k]}' and bf_no = '{$i}' ");
	}

	// 파일의 개수를 게시물에 업데이트 한다.
	$row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_idArray[$k]}' ");
	sql_query(" update {$write_table} set wr_file = '{$row['cnt']}' where wr_id = '{$wr_idArray[$k]}' ");

}


// 비밀글이라면 세션에 비밀글의 아이디를 저장한다. 자신의 글은 다시 비밀번호를 묻지 않기 위함

if ($file_upload_msg)
    alert($file_upload_msg, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr);
else
    goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
?>
