<?php
include_once('./_common.php');
/**
 * 레슨일지 - 동영상 다운로드
 */

if($android_flag) $agent = 'AOS';
else { $agent = 'IOS'; }
$info = sql_fetch(" select mb.mb_id from g5_lesson_diary as lr left join g5_member as mb on mb.mb_no = lr.mb_no where lr.idx = '{$idx}' ");
sql_query(" insert into g5_download set mb_id = '{$info['mb_id']}', diary_idx = '{$idx}', agent = '{$agent}', wr_datetime = '".G5_TIME_YMDHIS."' ");

$file_path = G5_DATA_PATH.'/file/lesson/';
$server_file_name = $temp; // 서버에 저장된 파일명
$real_file_name = iconv('UTF-8','CP949', $real);// 실제 파일명
$info = $file_path . $server_file_name;
$file_size = filesize($info);

if (file_exists($info)) {
    header("Content-Type:application/octet-stream");
    header("Content-Disposition:attachment;filename=$real_file_name");
    header("Content-Transfer-Encoding:binary");
    header("Content-Length:$file_size");
    header("Cache-Control:cache,must-revalidate");
    header("Pragma:no-cache");
    header("Expires:0");
    if (is_file($info)) {
        $fp = fopen($info, "r");
        while (!feof($fp)) {
            $buf = fread($fp, 8096);
            $read = strlen($buf);
            print($buf);
            flush();
        }
        fclose($fp);
    }
}
else {
    alert("존재하지 않는 동영상입니다.");
}
?>
