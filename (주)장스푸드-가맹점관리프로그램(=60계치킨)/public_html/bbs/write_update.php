<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

// 토큰체크
//check_write_token($bo_table);

$g5['title'] = '게시글 저장';

$msg = array();

if($board['bo_use_category']) {
    $ca_name = trim($_POST['ca_name']);
	/*
    if(!$ca_name) {
        $msg[] = '<strong>분류</strong>를 선택하세요.';
    } else {
        $categories = array_map('trim', explode("|", $board['bo_category_list'].($is_admin ? '|공지' : '')));
        if(!empty($categories) && !in_array($ca_name, $categories))
            $msg[] = '분류를 올바르게 입력하세요.';

        if(empty($categories))
            $ca_name = '';
    }
	*/
} else {
    $ca_name = '';
}

$wr_subject = '';
if (isset($_POST['wr_subject'])) {
    $wr_subject = substr(trim($_POST['wr_subject']),0,255);
    $wr_subject = preg_replace("#[\\\]+$#", "", $wr_subject);
}
if ($wr_subject == '') {
    $msg[] = '<strong>제목</strong>을 입력하세요.';
}

$wr_content = '';
if (isset($_POST['wr_content'])) {
    $wr_content = substr(trim($_POST['wr_content']),0,65536);
    $wr_content = preg_replace("#[\\\]+$#", "", $wr_content);
}
if ($wr_content == '') {
    $msg[] = '<strong>내용</strong>을 입력하세요.';
}

$wr_content2 = '';
if (isset($_POST['wr_content2'])) {
	$wr_content2 = substr(trim($_POST['wr_content2']),0,65536);
	$wr_content2 = preg_replace("#[\\\]+$#", "", $wr_content2);
}

$wr_content3 = '';
if (isset($_POST['wr_content3'])) {
	$wr_content3 = substr(trim($_POST['wr_content3']),0,65536);
	$wr_content3 = preg_replace("#[\\\]+$#", "", $wr_content3);
}

$wr_link1 = '';
if (isset($_POST['wr_link1'])) {
    $wr_link1 = substr($_POST['wr_link1'],0,1000);
    $wr_link1 = trim(strip_tags($wr_link1));
    $wr_link1 = preg_replace("#[\\\]+$#", "", $wr_link1);
}

$wr_link2 = '';
if (isset($_POST['wr_link2'])) {
    $wr_link2 = substr($_POST['wr_link2'],0,1000);
    $wr_link2 = trim(strip_tags($wr_link2));
    $wr_link2 = preg_replace("#[\\\]+$#", "", $wr_link2);
}
$msg = implode('<br>', $msg);
if ($msg) {
    alert($msg);
}

// 090710
if (substr_count($wr_content, '&#') > 50) {
    alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
    exit;
}

if (substr_count($wr_content2, '&#') > 50) {
	alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
	exit;
}

if (substr_count($wr_content3, '&#') > 50) {
	alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
	exit;
}

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

$notice_array = explode(",", $board['bo_notice']);

if ($w == 'u' || $w == 'r') {
    $wr = get_write($write_table, $wr_id);
    if (!$wr['wr_id']) {
        alert("글이 존재하지 않습니다.\\n글이 삭제되었거나 이동하였을 수 있습니다.");
    }
}

// 외부에서 글을 등록할 수 있는 버그가 존재하므로 비밀글은 사용일 경우에만 가능해야 함
if (!$is_admin && !$board['bo_use_secret'] && (stripos($_POST['html'], 'secret') !== false || stripos($_POST['secret'], 'secret') !== false || stripos($_POST['mail'], 'secret') !== false)) {
	alert('비밀글 미사용 게시판 이므로 비밀글로 등록할 수 없습니다.');
}

$secret = '';
if (isset($_POST['secret']) && $_POST['secret']) {
    if(preg_match('#secret#', strtolower($_POST['secret']), $matches))
        $secret = $matches[0];
}

// 외부에서 글을 등록할 수 있는 버그가 존재하므로 비밀글 무조건 사용일때는 관리자를 제외(공지)하고 무조건 비밀글로 등록
if (!$is_admin && $board['bo_use_secret'] == 2) {
    $secret = 'secret';
}

$html = '';
if (isset($_POST['html']) && $_POST['html']) {
    if(preg_match('#html(1|2)#', strtolower($_POST['html']), $matches))
        $html = $matches[0];
}

$mail = '';
if (isset($_POST['mail']) && $_POST['mail']) {
    if(preg_match('#mail#', strtolower($_POST['mail']), $matches))
        $mail = $matches[0];
}

$notice = '';
if (isset($_POST['notice']) && $_POST['notice']) {
    $notice = $_POST['notice'];
}

$sql_orderby = '';
if(isset($_POST['wr_orderby']) && $_POST['wr_orderby']){
	$sql_orderby = ', wr_orderby = "{$wr_orderby}"';
}

for ($i=1; $i<=10; $i++) {
    $var = "wr_$i";
    $$var = "";
    if (isset($_POST['wr_'.$i]) && settype($_POST['wr_'.$i], 'string')) {
        $$var = trim($_POST['wr_'.$i]);
    }
}

@include_once($board_skin_path.'/write_update.head.skin.php');

if ($w == '' || $w == 'u') {

    // 김선용 1.00 : 글쓰기 권한과 수정은 별도로 처리되어야 함
    if($w =='u' && $member['mb_id'] && $wr['mb_id'] == $member['mb_id']) {
        ;
    } else if ($member['mb_level'] < $board['bo_write_level']) {
        alert('글을 쓸 권한이 없습니다.');
    }

	// 외부에서 글을 등록할 수 있는 버그가 존재하므로 공지는 관리자만 등록이 가능해야 함
	if (!$is_admin && $notice) {
		alert('관리자만 공지할 수 있습니다.');
    }

} else if ($w == 'r') {

    if (in_array((int)$wr_id, $notice_array)) {
        alert('공지에는 답변 할 수 없습니다.');
    }

    if ($member['mb_level'] < $board['bo_reply_level']) {
        alert('글을 답변할 권한이 없습니다.');
    }

    // 게시글 배열 참조
    $reply_array = &$wr;

    // 최대 답변은 테이블에 잡아놓은 wr_reply 사이즈만큼만 가능합니다.
    if (strlen($reply_array['wr_reply']) == 10) {
        alert("더 이상 답변하실 수 없습니다.\\n답변은 10단계 까지만 가능합니다.");
    }

    $reply_len = strlen($reply_array['wr_reply']) + 1;
    if ($board['bo_reply_order']) {
        $begin_reply_char = 'A';
        $end_reply_char = 'Z';
        $reply_number = +1;
        $sql = " select MAX(SUBSTRING(wr_reply, $reply_len, 1)) as reply from {$write_table} where wr_num = '{$reply_array['wr_num']}' and SUBSTRING(wr_reply, {$reply_len}, 1) <> '' ";
    } else {
        $begin_reply_char = 'Z';
        $end_reply_char = 'A';
        $reply_number = -1;
        $sql = " select MIN(SUBSTRING(wr_reply, {$reply_len}, 1)) as reply from {$write_table} where wr_num = '{$reply_array['wr_num']}' and SUBSTRING(wr_reply, {$reply_len}, 1) <> '' ";
    }
    if ($reply_array['wr_reply']) $sql .= " and wr_reply like '{$reply_array['wr_reply']}%' ";
    $row = sql_fetch($sql);

    if (!$row['reply']) {
        $reply_char = $begin_reply_char;
    } else if ($row['reply'] == $end_reply_char) { // A~Z은 26 입니다.
        alert("더 이상 답변하실 수 없습니다.\\n답변은 26개 까지만 가능합니다.");
    } else {
        $reply_char = chr(ord($row['reply']) + $reply_number);
    }

    $reply = $reply_array['wr_reply'] . $reply_char;

} else {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if ($is_guest && !chk_captcha()) {
    alert('자동등록방지 숫자가 틀렸습니다.');
}

if ($w == '' || $w == 'r') {
    if (isset($_SESSION['ss_datetime'])) {
        /*if ($_SESSION['ss_datetime'] >= (G5_SERVER_TIME - $config['cf_delay_sec']) && !$is_admin)
            alert('너무 빠른 시간내에 게시물을 연속해서 올릴 수 없습니다.');*/
    }

    set_session("ss_datetime", G5_SERVER_TIME);
}

if (!isset($_POST['wr_subject']) || !trim($_POST['wr_subject']))
    alert('제목을 입력하여 주십시오.');


if($bo_table == 'sms'){
	$wr_6 = count($sms_mb_id);

	if($wr_2 == '즉시'){
		$wr_3 = '';
		$wr_4 = '';
		$wr_5 = '';
	}

	$item_add_sql = ", wr_11 = '{$_POST['wr_11']}'";
}


if($bo_table == 'item' || $bo_table == 'point_item' || $bo_table == 'ptmall_item'){
	if($_POST['wr_5'] == 'n'){
		$wr_opt1 = '';
		$wr_opt2 = '';
		$wr_opt3 = '';

		$opt_use1 = '';
		$opt_use2 = '';
		$opt_use3 = '';
	}

	$item_add_sql = ", 
	wr_opt1 = '{$wr_opt1}', 
	wr_opt2 = '{$wr_opt2}',
	wr_opt3 = '{$wr_opt3}',
	opt_use1 = '{$opt_use1}',
	opt_use2 = '{$opt_use2}',
	opt_use3 = '{$opt_use3}'
	";
}


if($bo_table == 'deliver'){
	$wr_1 = $wr_2 = '';
	if($wr_1_1 != '' && $wr_1_2 != '' && $wr_1_3 != '') $wr_1 .= $wr_1_1.'-'.$wr_1_2.'-'.$wr_1_3;
	if($wr_2_1 != '' && $wr_2_2 != '' && $wr_2_3 != '') $wr_2 .= $wr_2_1.'-'.$wr_2_2.'-'.$wr_2_3;
}


if ($w == '' || $w == 'r') {

    if ($member['mb_id']) {
        $mb_id = $member['mb_id'];
        $wr_name = addslashes(clean_xss_tags($board['bo_use_name'] ? $member['mb_name'] : $member['mb_name']));
		if($w == 'r' && ($bo_table == 'inquiry' || $bo_table == 'praise')){
			$wr_name = $member['mb_name'];
			$wr_1 = $member['mb_2'];
		}
		if($w == '' && ($bo_table == 'inquiry' || $bo_table == 'praise')){
			$wr_1 = $member['mb_2'];
		}
        $wr_password = $member['mb_password'];
        $wr_email = addslashes($member['mb_email']);
        $wr_homepage = addslashes(clean_xss_tags($member['mb_homepage']));
    } else {
        $mb_id = '';
        // 비회원의 경우 이름이 누락되는 경우가 있음
        $wr_name = clean_xss_tags(trim($_POST['wr_name']));
        if (!$wr_name)
            alert('이름은 필히 입력하셔야 합니다.');
        $wr_password = get_encrypt_string($wr_password);
        $wr_email = get_email_address(trim($_POST['wr_email']));
        $wr_homepage = clean_xss_tags($wr_homepage);
    }

    if ($w == 'r') {
        // 답변의 원글이 비밀글이라면 비밀번호는 원글과 동일하게 넣는다.
        if ($secret)
            $wr_password = $wr['wr_password'];

        $wr_id = $wr_id . $reply;
        $wr_num = $write['wr_num'];
        $wr_reply = $reply;
    } else {
        $wr_num = get_next_num($write_table);
        $wr_reply = '';
    }

	if($bo_table=="movie"){
		
		$wr_1=ftpUpload("14.48.175.188","jangsfood", "6kfa%hd7","public_html/movie/",$_FILES['movie_file']);

	}

	//23.11.20 wr_contents 2개 추가한부분 wc
	if($wr_content2){
		$item_add_sql .= ", wr_content2 = '{$wr_content2}'";
	}

	if($wr_content3){
		$item_add_sql .= ", wr_content3 = '{$wr_content3}'";
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
                     mb_id = '{$member['mb_id']}',
                     wr_password = '$wr_password',
                     wr_name = '$wr_name',
                     wr_email = '$wr_email',
                     wr_homepage = '$wr_homepage',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$wr_10'
					 {$item_add_sql}
					 {$sql_common}
					 {$sql_orderby} ";
    sql_query($sql);

    $wr_id = sql_insert_id();

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


	if($bo_table == 'item' || $bo_table == 'point_item' || $bo_table == 'ptmall_item'){
		if($_POST['wr_5'] == 'y'){
			if($opt_use1 == 'y'){
				if(count($opt_idx1) > 0){
					for($o=0; $o<count($opt_idx1); $o++){
						$in_sql = " insert into g5_opt1 set opt_bo_table='{$bo_table}', opt_wr_id='{$wr_id}', opt_name='{$opt_name1[$o]}', opt_price='{$opt_price1[$o]}', opt_price2='{$opt_price1_2[$o]}', opt_order='0' ";
						sql_query($in_sql);
					}
				}
			}

			if($opt_use2 == 'y'){
				if(count($opt_idx2) > 0){
					for($o=0; $o<count($opt_idx2); $o++){
						$in_sql = " insert into g5_opt2 set opt_bo_table='{$bo_table}', opt_wr_id='{$wr_id}', opt_name='{$opt_name2[$o]}', opt_price='{$opt_price2[$o]}', opt_price2='{$opt_price2_2[$o]}', opt_order='0' ";
						sql_query($in_sql);
					}
				}
			}

			if($opt_use3 == 'y'){
				if(count($opt_idx3) > 0){
					for($o=0; $o<count($opt_idx3); $o++){
						$in_sql = " insert into g5_opt3 set opt_bo_table='{$bo_table}', opt_wr_id='{$wr_id}', opt_name='{$opt_name3[$o]}', opt_price='{$opt_price3[$o]}', opt_price2='{$opt_price3_2[$o]}', opt_order='0' ";
						sql_query($in_sql);
					}
				}
			}
		}
	}


	if($bo_table == 'sms'){
		if(count($sms_mb_id) > 0){
			// 발신자 번호
			$send_tel = str_replace('-','',$_POST['wr_11']);

			// SMS 발송
			//$conn_db = mysql_connect("211.115.216.107","jfsms","wkdtmvnem12!@");
			$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
			//mysql_select_db("si_server");
			mysql_select_db("chicken60");

			$tran_msg1 = $wr_content;
			//$tran_msg1 = iconv('utf-8','euc-kr',$tran_msg1);

			for($s=0; $s<count($sms_mb_id); $s++){
				$sql = " insert into sms_mb_id set sm_bo_table='{$bo_table}', sm_wr_id='{$wr_id}', sm_mb_id='{$sms_mb_id[$s]}' ";
				sql_query($sql);

				$hp_sql = " select mb_hp from g5_member where mb_id='{$sms_mb_id[$s]}' limit 1 ";
				$hp_row = sql_fetch($hp_sql);
				if($hp_row['mb_hp'] != ''){
					$mb_hp = str_replace('-','',$hp_row['mb_hp']);

					$used_cd = $reserved_fg = $reserved_dttm = $content_cnt = $content_mime_type = $msg_title = '';

					if($wr_1 == 'SMS'){
						$used_cd = '00';
						$content_cnt = 0;
						$content_mime_type = '';
						$msg_title = '';
					}
					if($wr_1 == 'MMS'){
						$mms_img_path = G5_DATA_PATH.'/mms_img/';
						$used_cd = '20';
						$content_cnt = 1;
						$content_mime_type = 'text/plain';
						$content_path = '';
						if($_FILES['mms_img1']['name'] != ''){
							$content_cnt++;
							$content_mime_type .= ';image/jpg';
							$mms_img1_name = $wr_id.'_1_'.urlencode($_FILES['mms_img1']['name']);
							if (move_uploaded_file($_FILES['mms_img1']['tmp_name'], $mms_img_path.$mms_img1_name)) {
								$up1_sql = " update {$write_table} set wr_8='{$mms_img1_name}' where wr_id='{$wr_id}' ";
								sql_query($up1_sql);
								$content_path .= $mms_img_path.$mms_img1_name;
							}
						}
						if($_FILES['mms_img2']['name'] != ''){
							$content_cnt++;
							$content_mime_type .= ';image/jpg';
							$mms_img2_name = $wr_id.'_2_'.urlencode($_FILES['mms_img2']['name']);
							if (move_uploaded_file($_FILES['mms_img2']['tmp_name'], $mms_img_path.$mms_img2_name)) {
								$up2_sql = " update {$write_table} set wr_9='{$mms_img2_name}' where wr_id='{$wr_id}' ";
								sql_query($up2_sql);
								if($content_path != '') $content_path .= ';';
								$content_path .= $mms_img_path.$mms_img2_name;
							}
						}
						if($_FILES['mms_img3']['name'] != ''){
							$content_cnt++;
							$content_mime_type .= ';image/jpg';
							$mms_img3_name = $wr_id.'_3_'.urlencode($_FILES['mms_img3']['name']);
							if (move_uploaded_file($_FILES['mms_img3']['tmp_name'], $mms_img_path.$mms_img3_name)) {
								$up3_sql = " update {$write_table} set wr_10='{$mms_img3_name}' where wr_id='{$wr_id}' ";
								sql_query($up3_sql);
								if($content_path != '') $content_path .= ';';
								$content_path .= $mms_img_path.$mms_img3_name;
							}
						}
						$msg_title = $wr_subject;
						//$msg_title = iconv('utf-8','euc-kr',$wr_subject);
					}
					if($wr_1 == 'LMS'){
						$used_cd = '10';
						$content_cnt = 1;
						$content_mime_type = 'text/plain';
						$msg_title = $wr_subject;
						//$msg_title = iconv('utf-8','euc-kr',$wr_subject);
					}

					if($wr_2 == '즉시'){
						$reserved_fg = 'I';
						$reserved_dttm = date('YmdHis');
					}
					if($wr_2 == '예약'){
						$reserved_fg = 'R';
						$reserved_dttm = str_replace('-','',$wr_3).$wr_4.$wr_5.'00';
					}

					$sql = "insert into TBL_SUBMIT_QUEUE values
					(
						'3".$wr_id.$s."',
						'".$bo_table."',
						'4133',
						'1',
						'{$used_cd}',
						'{$reserved_fg}',
						'{$reserved_dttm}',
						'1',
						'".$mb_hp."',
						'{$send_tel}',
						'',
						'00000',
						'".$tran_msg1."',
						'',
						'{$content_cnt}',
						'{$content_mime_type}',
						'{$content_path}',
						CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
						'',
						'',
						'',
						'',
						'0',
						'',
						'{$msg_title}',
						'',
						'',
						'',
						'',
						'',
						'0',
						'0'
					)";
					mysql_query($sql,$conn_db);
					/*
					if(mysql_query($sql,$conn_db)){
						echo "success!<BR>";
					}else{
						echo mysql_error();
						echo "<BR>";
					}
					*/
				}
			}
		}
	}


	if($bo_table == 'inquiry' && $w == ''){
		// SMS 발송
		//$conn_db = mysql_connect("211.115.216.107","jfsms","wkdtmvnem12!@");
		$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
		//mysql_select_db("si_server");
		mysql_select_db("chicken60");

		$ic_sql = " select ic_mb_id,ic_ca_name from g5_write_inquiry_cate where ic_idx='{$_POST['ca_name']}' ";
		$ic_row = sql_fetch($ic_sql);

		$sms_sql = " select mb_name, mb_hp from g5_member where mb_id='{$ic_row['ic_mb_id']}' ";
		$sms_row = sql_fetch($sms_sql);

		// 점주 핸드폰번호
		$mb_hp = str_replace('-','',$member['mb_hp']);
		// 점주에게 발송되는 SMS
		$tran_msg1 = "1:1문의가 등록되었습니다.
{$sms_row['mb_name']}담당자가 신속히 답변드리겠습니다.";
		// 점주에게 SMS 발송!
		if($mb_hp != ''){
			$sql = "insert into TBL_SUBMIT_QUEUE values
			(
				'1".$wr_id."',
				'".$bo_table."',
				'4133',
				'1',
				'10',
				'I',
				CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
				'1',
				'".$mb_hp."',
				'$g_tel1',
				'',
				'00000',
				'".$tran_msg1."',
				'',
				'1',
				'text/plain',
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
		}

		// 담당자(임직원) 핸드폰번호
		$mb_hp2 = str_replace('-','',$sms_row['mb_hp']);
		// 담당자(임직원)에게 발송되는 SMS
		$tran_msg2 = "1:1문의가 등록되었습니다. 확인해주세요.\n매장명:{$member['mb_2']}\n문의번호:{$wr_id}\n분류:{$ic_row['ic_ca_name']}\n\n".strip_tags($wr_content);
		// 담당자(임직원)에게 SMS 발송!
		if($mb_hp2 != ''){
			$sql = "insert into TBL_SUBMIT_QUEUE values
			(
				'2".$wr_id."',
				'".$bo_table."',
				'4133',
				'1',
				'10',
				'I',
				CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
				'1',
				'".$mb_hp2."',
				'$g_tel1',
				'',
				'00000',
				'".$tran_msg2."',
				'',
				'1',
				'text/plain',
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
		}


		// 담당자(임직원)[회원관리에서 해당 카테고리에 체킹된 모든 임직원]에게 발송되는 SMS
		$tran_msg3 = $tran_msg2;
		// 회원관리에서 해당 카테고리에 체킹된 모든 임직원의 아이디&핸드폰번호를 불러옴
		// $em_sql = " select * from g5_write_inquiry_cate_mb where icm_ca_idx='{$_POST['ca_name']}' and icm_use='y' ";
		$em_sql = " select A.*, B.mb_name from g5_write_inquiry_cate_mb A INNER JOIN g5_member B ON A.icm_mb_id = B.mb_id
					where A.icm_ca_idx='{$_POST['ca_name']}' and A.icm_use='y' AND B.mb_level > 1 ";
		$em_qry = sql_query($em_sql);
		$em_num = sql_num_rows($em_qry);
		if($em_num > 0){
			for($em=0; $em<$em_num; $em++){
				$em_row = sql_fetch_array($em_qry);
				// 담당자(임직원)[회원관리에서 해당 카테고리에 체킹된 모든 임직원] 핸드폰번호
				$mb_hp3 = str_replace('-','',$em_row['icm_mb_hp']);

				if($mb_hp3 != ''){
					$sql = "insert into TBL_SUBMIT_QUEUE values
					(
						'4".$wr_id.$em."',
						'".$bo_table."',
						'4133',
						'1',
						'10',
						'I',
						CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
						'1',
						'".$mb_hp3."',
						'$g_tel1',
						'',
						'00000',
						'".$tran_msg3."',
						'',
						'1',
						'text/plain',
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
				}
			}
		}
	}

	if($bo_table == 'inquiry' && $w == 'r'){
		// SMS 발송
		//$conn_db = mysql_connect("211.115.216.107","jfsms","wkdtmvnem12!@");
		$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
		//mysql_select_db("si_server");
		mysql_select_db("chicken60");

		// 답변이 아닌 게시글의 정보를 불러옴
		$inq_sql = " select * from {$write_table} where wr_num='{$write['wr_num']}' and wr_reply='' ";
		$inq_row = sql_fetch($inq_sql);

		// 답변이 아닌 게시글을 작성한 점주의 회원정보를 불러옴
		$sms_sql = " select mb_hp,mb_2 from g5_member where mb_id='{$inq_row['mb_id']}' ";
		$sms_row = sql_fetch($sms_sql);

		// 답변 작성자와 게시글의 작성자가 일치하지 않을때는
		// 게시글 작성자에게 답변이 달렸다고 SMS 발송하고
		// 담당자(임직원)에게 똑같은 문자를 SMS 발송하고
		// 담당자(임직원)[회원관리에서 해당 카테고리에 체킹된 모든 임직원]에게 똑같은 문자를 SMS 발송한다.
		if($member['mb_id'] != $inq_row['mb_id']){
			// 점주 핸드폰번호
			$mb_hp = str_replace('-','',$sms_row['mb_hp']);
			// 점주에게 발송되는 SMS {$member['mb_name']} 담당자가 1:1문의에 답변을 드렸습니다. 에서 수정 20180626 백두산
			$tran_msg1 = "1:1문의 답변 완료. 게시판에서 확인 가능.
매장명:{$sms_row['mb_2']}
문의번호:{$inq_row['wr_id']}
";
			if($mb_hp != ''){
				$sql = "insert into TBL_SUBMIT_QUEUE values
				(
					'5".$wr_id."',
					'".$bo_table."',
					'4133',
					'1',
					'10',
					'I',
					CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
					'1',
					'".$mb_hp."',
					'$g_tel1',
					'',
					'00000',
					'".$tran_msg1."',
					'',
					'1',
					'text/plain',
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
			}

			// 담당자(임직원) ID 불러오기
			$ic_sql = " select ic_mb_id, ic_ca_name from g5_write_inquiry_cate where ic_idx='{$inq_row['ca_name']}' ";
			$ic_row = sql_fetch($ic_sql);
			// 담당자(임직원) 회원정보 불러오기
			$ic_mem = get_member($ic_row['ic_mb_id']);

			// 담당자(임직원) 핸드폰번호
			$mb_hp2 = str_replace('-','',$ic_mem['mb_hp']);
			// 담당자(임직원)에게 발송되는 SMS
			$tran_msg2 = $tran_msg1."\n분류:".$ic_row['ic_ca_name']."\n\n".strip_tags($wr_content);
			if($mb_hp2 != ''){
				$sql = "insert into TBL_SUBMIT_QUEUE values
				(
					'6".$wr_id."',
					'".$bo_table."',
					'4133',
					'1',
					'10',
					'I',
					CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
					'1',
					'".$mb_hp2."',
					'$g_tel1',
					'',
					'00000',
					'".$tran_msg2."',
					'',
					'1',
					'text/plain',
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
			}

			// 담당자(임직원)[회원관리에서 해당 카테고리에 체킹된 모든 임직원]에게 발송되는 SMS
			$tran_msg3 = $tran_msg2;
			// 회원관리에서 해당 카테고리에 체킹된 모든 임직원의 아이디&핸드폰번호를 불러옴
			// $em_sql = " select * from g5_write_inquiry_cate_mb where icm_ca_idx='{$inq_row['ca_name']}' and icm_use='y' ";
			$em_sql = " select A.*, B.mb_name from g5_write_inquiry_cate_mb A INNER JOIN g5_member B ON A.icm_mb_id = B.mb_id
						where A.icm_ca_idx='{$inq_row['ca_name']}' and A.icm_use='y' AND B.mb_level > 1 ";
			$em_qry = sql_query($em_sql);
			$em_num = sql_num_rows($em_qry);
			if($em_num > 0){
				for($em=0; $em<$em_num; $em++){
					$em_row = sql_fetch_array($em_qry);
					// 담당자(임직원)[회원관리에서 해당 카테고리에 체킹된 모든 임직원] 핸드폰번호
					$mb_hp3 = str_replace('-','',$em_row['icm_mb_hp']);
					if($mb_hp3 != ''){
						$sql = "insert into TBL_SUBMIT_QUEUE values
						(
							'7".$wr_id.$em."',
							'".$bo_table."',
							'4133',
							'1',
							'10',
							'I',
							CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
							'1',
							'".$mb_hp3."',
							'$g_tel1',
							'',
							'00000',
							'".$tran_msg3."',
							'',
							'1',
							'text/plain',
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
					}
				}
			}
		}

		// 답변 작성자와 게시글의 작성자가 일치하면 본인글에 답변을 단 상황
		// 담당자(임직원)에게 문자를 SMS 발송하고
		// 담당자(임직원)[회원관리에서 해당 카테고리에 체킹된 모든 임직원]에게 똑같은 문자를 SMS 발송한다.
		// 게시글 작성자가 본인이므로 본인에게 SMS 문자 발송
		if($member['mb_id'] == $inq_row['mb_id']){
			// 담당자(임직원)에게 발송되는 SMS
			$tran_msg1 = "1:1문의에 답변이 등록되었습니다. 확인해주세요.
매장명:{$sms_row['mb_2']}
문의번호:{$inq_row['wr_id']}
";
			// 담당자(임직원) ID 불러오기
			$ic_sql = " select ic_mb_id from g5_write_inquiry_cate where ic_idx='{$inq_row['ca_name']}' ";
			$ic_row = sql_fetch($ic_sql);
			// 담당자(임직원) 회원정보 불러오기
			$ic_mem = get_member($ic_row['ic_mb_id']);

			// 담당자(임직원) 핸드폰번호
			$mb_hp = str_replace('-','',$ic_mem['mb_hp']);
			if($mb_hp != ''){
				$sql = "insert into TBL_SUBMIT_QUEUE values
				(
					'5".$wr_id."',
					'".$bo_table."',
					'4133',
					'1',
					'10',
					'I',
					CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
					'1',
					'".$mb_hp."',
					'$g_tel1',
					'',
					'00000',
					'".$tran_msg1."',
					'',
					'1',
					'text/plain',
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
			}

			// 담당자(임직원)[회원관리에서 해당 카테고리에 체킹된 모든 임직원]에게 발송되는 SMS
			$tran_msg2 = $tran_msg1;
			// 회원관리에서 해당 카테고리에 체킹된 모든 임직원의 아이디&핸드폰번호를 불러옴
			// $em_sql = " select * from g5_write_inquiry_cate_mb where icm_ca_idx='{$inq_row['ca_name']}' and icm_use='y' ";
			$em_sql = " select A.*, B.mb_name from g5_write_inquiry_cate_mb A INNER JOIN g5_member B ON A.icm_mb_id = B.mb_id
						where A.icm_ca_idx='{$inq_row['ca_name']}' and A.icm_use='y' AND B.mb_level > 1 ";
			$em_qry = sql_query($em_sql);
			$em_num = sql_num_rows($em_qry);
			if($em_num > 0){
				for($em=0; $em<$em_num; $em++){
					$em_row = sql_fetch_array($em_qry);
					// 담당자(임직원)[회원관리에서 해당 카테고리에 체킹된 모든 임직원] 핸드폰번호
					$mb_hp2 = str_replace('-','',$em_row['icm_mb_hp']);
					if($mb_hp2 != ''){
						$sql = "insert into TBL_SUBMIT_QUEUE values
						(
							'7".$wr_id.$em."',
							'".$bo_table."',
							'4133',
							'1',
							'10',
							'I',
							CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
							'1',
							'".$mb_hp2."',
							'$g_tel1',
							'',
							'00000',
							'".$tran_msg2."',
							'',
							'1',
							'text/plain',
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
					}
				}
			}

			// 점주 핸드폰번호
			$mb_hp3 = str_replace('-','',$member['mb_hp']);
			// 점주에게 발송되는 SMS
			$tran_msg3 = "1:1문의 답변이 등록되었습니다.
{$ic_mem['mb_name']}담당자가 신속히 답변드리겠습니다.";
			// 점주에게 SMS 발송!
			if($mb_hp3 != ''){
				$sql = "insert into TBL_SUBMIT_QUEUE values
				(
					'10".$wr_id."',
					'".$bo_table."',
					'4133',
					'1',
					'10',
					'I',
					CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
					'1',
					'".$mb_hp3."',
					'$g_tel1',
					'',
					'00000',
					'".$tran_msg3."',
					'',
					'1',
					'text/plain',
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
			}
		}
	}

	// 칭찬합니다 SMS발송
	if($bo_table == 'praise' && $w == ''){
		// SMS 발송
		$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
		mysql_select_db("chicken60");

		$tran_msg = "칭찬게시물이 등록되었습니다.
매장명:{$member['mb_2']}";

		$pm_sql = " select * from g5_praise_sms_cate_mb where pscm_ca_name='수신' and pscm_mb_hp!='' and pscm_use='y' ";
		$pm_qry = sql_query($pm_sql);
		$pm_num = sql_num_rows($pm_qry);
		if($pm_num > 0){
			for($pm=0; $pm<$pm_num; $pm++){
				$pm_row = sql_fetch_array($pm_qry);
				$mb_hp = str_replace('-','',$pm_row['pscm_mb_hp']);

				$sql = "insert into TBL_SUBMIT_QUEUE values
				(
					'8".$wr_id.$pm."',
					'".$bo_table."',
					'4133',
					'1',
					'10',
					'I',
					CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
					'1',
					'".$mb_hp."',
					'$g_tel1',
					'',
					'00000',
					'".$tran_msg."',
					'',
					'1',
					'text/plain',
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
			}
		}
	}

	// 칭찬합니다 답변글 SMS발송
	if($bo_table == 'praise' && $w == 'r'){
		// SMS 발송
		$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
		mysql_select_db("chicken60");

		$wmb_sql = " select mb_id from {$write_table} where wr_num='{$write['wr_num']}' and wr_reply='' ";
		$wmb_row = sql_fetch($wmb_sql);
		$wmb_mb = get_member($wmb_row['mb_id']);

		$tran_msg = "{$member['mb_name']} 담당자가 칭찬게시물에 답변을 하였습니다.
매장명:{$wmb_mb['mb_2']}";

		$pm_sql = " select * from g5_praise_sms_cate_mb where pscm_ca_name='수신' and pscm_mb_hp!='' and pscm_use='y' ";
		$pm_qry = sql_query($pm_sql);
		$pm_num = sql_num_rows($pm_qry);
		if($pm_num > 0){
			for($pm=0; $pm<$pm_num; $pm++){
				$pm_row = sql_fetch_array($pm_qry);
				$mb_hp = str_replace('-','',$pm_row['pscm_mb_hp']);

				$sql = "insert into TBL_SUBMIT_QUEUE values
				(
					'9".$wr_id.$pm."',
					'".$bo_table."',
					'4133',
					'1',
					'10',
					'I',
					CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
					'1',
					'".$mb_hp."',
					'$g_tel1',
					'',
					'00000',
					'".$tran_msg."',
					'',
					'1',
					'text/plain',
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
			}
		}
	}

} else if ($w == 'u') {
    if (get_session('ss_bo_table') != $_POST['bo_table'] || get_session('ss_wr_id') != $_POST['wr_id']) {
        alert('올바른 방법으로 수정하여 주십시오.', G5_BBS_URL.'/board.php?bo_table='.$bo_table);
    }

    $return_url = './board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id;

    if ($is_admin == 'super') // 최고관리자 통과
        ;
    else if ($is_admin == 'group') { // 그룹관리자
        $mb = get_member($write['mb_id']);
        if ($member['mb_id'] != $group['gr_admin']) // 자신이 관리하는 그룹인가?
            alert('자신이 관리하는 그룹의 게시판이 아니므로 수정할 수 없습니다.', $return_url);
        else if ($member['mb_level'] < $mb['mb_level']) // 자신의 레벨이 크거나 같다면 통과
            alert('자신의 권한보다 높은 권한의 회원이 작성한 글은 수정할 수 없습니다.', $return_url);
    } else if ($is_admin == 'board') { // 게시판관리자이면
        $mb = get_member($write['mb_id']);
        if ($member['mb_id'] != $board['bo_admin']) // 자신이 관리하는 게시판인가?
            alert('자신이 관리하는 게시판이 아니므로 수정할 수 없습니다.', $return_url);
        else if ($member['mb_level'] < $mb['mb_level']) // 자신의 레벨이 크거나 같다면 통과
            alert('자신의 권한보다 높은 권한의 회원이 작성한 글은 수정할 수 없습니다.', $return_url);
    } else if ($member['mb_id']) {
		if($bo_table != 'item'){
			if ($member['mb_id'] != $write['mb_id']){
				alert('자신의 글이 아니므로 수정할 수 없습니다.', $return_url);
			}
		} else if($bo_table != 'point_item'){
			if ($member['mb_id'] != $write['mb_id']){
				alert('자신의 글이 아니므로 수정할 수 없습니다.', $return_url);
			}
		} else if($bo_table != 'ptmall_item'){
			if ($member['mb_id'] != $write['mb_id']){
				alert('자신의 글이 아니므로 수정할 수 없습니다.', $return_url);
			}
		}else{
			if ($member['mb_level'] < 3){
				alert('수정할 수 없습니다.', $return_url);
			}
		}
    } else {
        if ($write['mb_id'])
            alert('로그인 후 수정하세요.', './login.php?url='.urlencode($return_url));
    }

    if ($member['mb_id']) {
        // 자신의 글이라면
        if ($member['mb_id'] == $wr['mb_id']) {
            $mb_id = $member['mb_id'];
            $wr_name = addslashes(clean_xss_tags($board['bo_use_name'] ? $member['mb_name'] : $member['mb_name']));
            $wr_email = addslashes($member['mb_email']);
            $wr_homepage = addslashes(clean_xss_tags($member['mb_homepage']));
        } else {
            $mb_id = $wr['mb_id'];
            if(isset($_POST['wr_name']) && $_POST['wr_name'])
                $wr_name = clean_xss_tags(trim($_POST['wr_name']));
            else
                $wr_name = addslashes(clean_xss_tags($wr['wr_name']));
            if(isset($_POST['wr_email']) && $_POST['wr_email'])
                $wr_email = get_email_address(trim($_POST['wr_email']));
            else
                $wr_email = addslashes($wr['wr_email']);
            if(isset($_POST['wr_homepage']) && $_POST['wr_homepage'])
                $wr_homepage = addslashes(clean_xss_tags($_POST['wr_homepage']));
            else
                $wr_homepage = addslashes(clean_xss_tags($wr['wr_homepage']));
        }
    } else {
        $mb_id = "";
        // 비회원의 경우 이름이 누락되는 경우가 있음
        if (!trim($wr_name)) alert("이름은 필히 입력하셔야 합니다.");
        $wr_name = clean_xss_tags(trim($_POST['wr_name']));
        $wr_email = get_email_address(trim($_POST['wr_email']));
    }

    $sql_password = $wr_password ? " , wr_password = '".get_encrypt_string($wr_password)."' " : "";

    $sql_ip = '';
    if (!$is_admin)
        $sql_ip = " , wr_ip = '{$_SERVER['REMOTE_ADDR']}' ";
	
	if($bo_table=="movie"){
		if($del_wr_1){
			@ftp_file_delete("14.48.175.188","jangsfood", "6kfa%hd7","public_html/movie/",$wr_1);
			$wr_1="";
		}
		if($_FILES['movie_file']['name']){
			$wr_1=ftpUpload("14.48.175.188","jangsfood", "6kfa%hd7","public_html/movie/",$_FILES['movie_file']);
		}
	}

	//23.11.20 wr_contents 2개 추가한부분 wc
	if($wr_content2){
		$item_add_sql .= ", wr_content2 = '{$wr_content2}'";
	}

	if($wr_content3){
		$item_add_sql .= ", wr_content3 = '{$wr_content3}'";
	}

    $sql = " update {$write_table}
                set ca_name = '{$ca_name}',
                     wr_option = '{$html},{$secret},{$mail}',
                     wr_subject = '{$wr_subject}',
                     wr_content = '{$wr_content}',
                     wr_link1 = '{$wr_link1}',
                     wr_link2 = '{$wr_link2}',
                     mb_id = '{$mb_id}',
                     wr_name = '{$wr_name}',
                     wr_email = '{$wr_email}',
                     wr_homepage = '{$wr_homepage}',
                     wr_1 = '{$wr_1}',
                     wr_2 = '{$wr_2}',
                     wr_3 = '{$wr_3}',
                     wr_4 = '{$wr_4}',
                     wr_5 = '{$wr_5}',
                     wr_6 = '{$wr_6}',
                     wr_7 = '{$wr_7}',
                     wr_8 = '{$wr_8}',
                     wr_9 = '{$wr_9}',
                     wr_10= '{$wr_10}'
					 {$item_add_sql}
					 {$sql_common}
					 {$sql_orderby}
                     {$sql_ip}
                     {$sql_password}
              where wr_id = '{$wr['wr_id']}' ";
    sql_query($sql);

    // 분류가 수정되는 경우 해당되는 코멘트의 분류명도 모두 수정함
    // 코멘트의 분류를 수정하지 않으면 검색이 제대로 되지 않음
    $sql = " update {$write_table} set ca_name = '{$ca_name}' where wr_parent = '{$wr['wr_id']}' ";
    sql_query($sql);



	if($bo_table == 'item' || $bo_table == 'point_item' || $bo_table == 'ptmall_item'){
		if($_POST['wr_5'] != 'y'){
			$del_sql = " delete from g5_opt1 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' ";
			sql_query($del_sql);

			$del_sql = " delete from g5_opt2 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' ";
			sql_query($del_sql);

			$del_sql = " delete from g5_opt3 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' ";
			sql_query($del_sql);
		}

		if($_POST['wr_5'] == 'y'){
			if($opt_use1 == 'y'){
				$init_sql = " update g5_opt1 set opt_order='9999999' where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' ";
				sql_query($init_sql);

				if(count($opt_idx1) > 0){
					for($o=0; $o<count($opt_idx1); $o++){
						if($opt_idx1[$o] != ''){
							$up_sql = " update g5_opt1 set opt_name='{$opt_name1[$o]}', opt_price='{$opt_price1[$o]}', opt_price2='{$opt_price1_2[$o]}', opt_order='0' where opt_idx='{$opt_idx1[$o]}' ";
							sql_query($up_sql);
						}else{
							$in_sql = " insert into g5_opt1 set opt_bo_table='{$bo_table}', opt_wr_id='{$wr_id}', opt_name='{$opt_name1[$o]}', opt_price='{$opt_price1[$o]}', opt_price2='{$opt_price1_2[$o]}', opt_order='0' ";
							sql_query($in_sql);
						}
					}
				}

				$init_sql = " delete from g5_opt1 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' and opt_order='9999999' ";
				sql_query($init_sql);
			}

			if($opt_use2 == 'y'){
				$init_sql = " update g5_opt2 set opt_order='9999999' where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' ";
				sql_query($init_sql);

				if(count($opt_idx2) > 0){
					for($o=0; $o<count($opt_idx2); $o++){
						if($opt_idx2[$o] != ''){
							$up_sql = " update g5_opt2 set opt_name='{$opt_name2[$o]}', opt_price='{$opt_price2[$o]}', opt_price2='{$opt_price2_2[$o]}', opt_order='0' where opt_idx='{$opt_idx2[$o]}' ";
							sql_query($up_sql);
						}else{
							$in_sql = " insert into g5_opt2 set opt_bo_table='{$bo_table}', opt_wr_id='{$wr_id}', opt_name='{$opt_name2[$o]}', opt_price='{$opt_price2[$o]}', opt_price2='{$opt_price2_2[$o]}', opt_order='0' ";
							sql_query($in_sql);
						}
					}
				}

				$init_sql = " delete from g5_opt2 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' and opt_order='9999999' ";
				sql_query($init_sql);
			}

			if($opt_use3 == 'y'){
				$init_sql = " update g5_opt3 set opt_order='9999999' where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' ";
				sql_query($init_sql);

				if(count($opt_idx3) > 0){
					for($o=0; $o<count($opt_idx3); $o++){
						if($opt_idx3[$o] != ''){
							$up_sql = " update g5_opt3 set opt_name='{$opt_name3[$o]}', opt_price='{$opt_price3[$o]}', opt_price2='{$opt_price3_2[$o]}', opt_order='0' where opt_idx='{$opt_idx3[$o]}' ";
							sql_query($up_sql);
						}else{
							$in_sql = " insert into g5_opt3 set opt_bo_table='{$bo_table}', opt_wr_id='{$wr_id}', opt_name='{$opt_name3[$o]}', opt_price='{$opt_price3[$o]}', opt_price2='{$opt_price3_2[$o]}', opt_order='0' ";
							sql_query($in_sql);
						}
					}
				}

				$init_sql = " delete from g5_opt3 where opt_bo_table='{$bo_table}' and opt_wr_id='{$wr_id}' and opt_order='9999999' ";
				sql_query($init_sql);
			}
		}
	}



    /*
    if ($notice) {
        //if (!preg_match("/[^0-9]{0,1}{$wr_id}[\r]{0,1}/",$board['bo_notice']))
        if (!in_array((int)$wr_id, $notice_array)) {
            $bo_notice = $wr_id . ',' . $board['bo_notice'];
            sql_query(" update {$g5['board_table']} set bo_notice = '{$bo_notice}' where bo_table = '{$bo_table}' ");
        }
    } else {
        $bo_notice = '';
        for ($i=0; $i<count($notice_array); $i++)
            if ((int)$wr_id != (int)$notice_array[$i])
                $bo_notice .= $notice_array[$i] . ',';
        $bo_notice = trim($bo_notice);
        //$bo_notice = preg_replace("/^".$wr_id."[\n]?$/m", "", $board['bo_notice']);
        sql_query(" update {$g5['board_table']} set bo_notice = '{$bo_notice}' where bo_table = '{$bo_table}' ");
    }
    */

    $bo_notice = board_notice($board['bo_notice'], $wr_id, $notice);
    sql_query(" update {$g5['board_table']} set bo_notice = '{$bo_notice}' where bo_table = '{$bo_table}' ");
}

if($bo_table == 'notice' && $_POST['wr_3'] == 'y'){
	$up_sql = " update {$write_table} set wr_3='n' where wr_id != '{$wr_id}' ";
	sql_query($up_sql);
}

// 게시판그룹접근사용을 하지 않아야 하고 비회원 글읽기가 가능해야 하며 비밀글이 아니어야 합니다.
if (!$group['gr_use_access'] && $board['bo_read_level'] < 2 && !$secret) {
    naver_syndi_ping($bo_table, $wr_id);
}

// 파일개수 체크
$file_count   = 0;
$upload_count = count($_FILES['bf_file']['name']);

for ($i=0; $i<$upload_count; $i++) {
    if($_FILES['bf_file']['name'][$i] && is_uploaded_file($_FILES['bf_file']['tmp_name'][$i]))
        $file_count++;
}

if($w == 'u') {
    $file = get_file($bo_table, $wr_id);
    if($file_count && (int)$file['count'] > $board['bo_upload_count'])
        alert('기존 파일을 삭제하신 후 첨부파일을 '.number_format($board['bo_upload_count']).'개 이하로 업로드 해주십시오.');
} else {
    if($file_count > $board['bo_upload_count'])
        alert('첨부파일을 '.number_format($board['bo_upload_count']).'개 이하로 업로드 해주십시오.');
}

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 파일 업로드
$file_upload_msg = '';
$upload = array();
for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image']    = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
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

    $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
    $filesize  = $_FILES['bf_file']['size'][$i];
    $filename  = $_FILES['bf_file']['name'][$i];
    $filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['bf_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['bf_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if (!$is_admin && $filesize > $board['bo_upload_size']) {
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
                                and wr_id = '{$wr_id}'
                                and bf_no = '{$i}' ";
            sql_query($sql);
        }
        else
        {
            $sql = " update {$g5['board_file_table']}
                        set bf_content = '{$bf_content[$i]}'
                        where bo_table = '{$bo_table}'
                                  and wr_id = '{$wr_id}'
                                  and bf_no = '{$i}' ";
            sql_query($sql);
        }
    }
    else
    {
        $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$wr_id}',
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

// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
$row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
{
    $row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");

    // 정보가 있다면 빠집니다.
    if ($row2['bf_file']) break;

    // 그렇지 않다면 정보를 삭제합니다.
    sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
}

// 파일의 개수를 게시물에 업데이트 한다.
$row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
sql_query(" update {$write_table} set wr_file = '{$row['cnt']}' where wr_id = '{$wr_id}' ");

// 자동저장된 레코드를 삭제한다.
sql_query(" delete from {$g5['autosave_table']} where as_uid = '{$uid}' ");
//------------------------------------------------------------------------------

// 비밀글이라면 세션에 비밀글의 아이디를 저장한다. 자신의 글은 다시 비밀번호를 묻지 않기 위함
if ($secret)
    set_session("ss_secret_{$bo_table}_{$wr_num}", TRUE);

// 메일발송 사용 (수정글은 발송하지 않음)
if (!($w == 'u' || $w == 'cu') && $config['cf_email_use'] && $board['bo_use_email']) {

    // 관리자의 정보를 얻고
    $super_admin = get_admin('super');
    $group_admin = get_admin('group');
    $board_admin = get_admin('board');

    $wr_subject = get_text(stripslashes($wr_subject));

    $tmp_html = 0;
    if (strstr($html, 'html1'))
        $tmp_html = 1;
    else if (strstr($html, 'html2'))
        $tmp_html = 2;

    $wr_content = conv_content(conv_unescape_nl(stripslashes($wr_content)), $tmp_html);

    $warr = array( ''=>'입력', 'u'=>'수정', 'r'=>'답변', 'c'=>'코멘트', 'cu'=>'코멘트 수정' );
    $str = $warr[$w];

    $subject = '['.$config['cf_title'].'] '.$board['bo_subject'].' 게시판에 '.$str.'글이 올라왔습니다.';

    $link_url = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;'.$qstr;

    include_once(G5_LIB_PATH.'/mailer.lib.php');

    ob_start();
    include_once ('./write_update_mail.php');
    $content = ob_get_contents();
    ob_end_clean();

    $array_email = array();
    // 게시판관리자에게 보내는 메일
    if ($config['cf_email_wr_board_admin']) $array_email[] = $board_admin['mb_email'];
    // 게시판그룹관리자에게 보내는 메일
    if ($config['cf_email_wr_group_admin']) $array_email[] = $group_admin['mb_email'];
    // 최고관리자에게 보내는 메일
    if ($config['cf_email_wr_super_admin']) $array_email[] = $super_admin['mb_email'];

    // 원글게시자에게 보내는 메일
    if ($config['cf_email_wr_write']) {
        if($w == '')
            $wr['wr_email'] = $wr_email;

        $array_email[] = $wr['wr_email'];
    }

    // 옵션에 메일받기가 체크되어 있고, 게시자의 메일이 있다면
    if (strstr($wr['wr_option'], 'mail') && $wr['wr_email'])
        $array_email[] = $wr['wr_email'];

    // 중복된 메일 주소는 제거
    $unique_email = array_unique($array_email);
    $unique_email = array_values($unique_email);
    for ($i=0; $i<count($unique_email); $i++) {
        mailer($wr_name, $wr_email, $unique_email[$i], $subject, $content, 1);
    }
}

// 사용자 코드 실행
@include_once($board_skin_path.'/write_update.skin.php');
@include_once($board_skin_path.'/write_update.tail.skin.php');

delete_cache_latest($bo_table);

if(($bo_table == 'inquiry' || $bo_table == 'praise') && $w != ''){
	goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$_POST['wr_id'].$qstr);
}

if($bo_table == 'item' || $bo_table == 'point_item' || $bo_table == 'ptmall_item'){
	goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&page='.$page);
}

if($bo_table == 'deliver'){
	goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&page='.$page);
}

if ($file_upload_msg)
    alert($file_upload_msg, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.$qstr);
else
    goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.$qstr);
?>
