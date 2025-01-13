<?php
include_once('./_common.php');
//ftp_file_delete("14.48.175.188","jangsfood", "6kfa%hd7","public_html/movie/","50m.mp4");
//echo 1;
//echo $_GET["hp"];
if($_GET["secu"] != "A2N9c8sSqQSzaaA") {
    echo "잘못된 접근입니다.";
    die();
}


$write_table = "g5_write_sms";
$wr_num = get_next_num($write_table);
$send_tel = "0260117050";
$tran_msg1 = "[60계치킨]
본인 인증번호 : {$_GET['num']}
10분 이내에 입력해주세요.";

$sql = " insert into $write_table
                set wr_num = '$wr_num',
                     wr_comment = 0,
                     wr_subject = '문자인증',
                     wr_content = '$tran_msg1',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = 'admin',
                     wr_password = '*A2A4F9054030F465A8600087E17868AB4ED80D97',
                     wr_name = '최고관리자',
                     wr_email = 'itforone@naver.com',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_1 = 'SMS',
                     wr_2 = '즉시',
                     wr_6 = '1',
                     wr_11 = '$send_tel'";
sql_query($sql);

$wr_id = sql_insert_id();




$conn_db = mysql_connect("localhost","chicken60","kiuosro1");
mysql_select_db("chicken60");

// 발신자 번호

$bo_table = "sms";
$used_cd = '00';
$reserved_fg = 'I';
$reserved_dttm = date('YmdHis');
$mb_hp = $_GET["mb_hp"];
$content_cnt = 0;
$content_mime_type = '';
$content_mime_type = '';
$msg_title = '';
$content_path = "";
$sql = "insert into TBL_SUBMIT_QUEUE values
					(
						'3".$wr_id."0',
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
?>