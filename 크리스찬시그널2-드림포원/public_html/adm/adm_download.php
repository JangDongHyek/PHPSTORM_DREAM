<?php
include_once('./_common.php');

// clean the output buffer
ob_end_clean();

$bo_table = "adm_apply";
$sql = " select bf_source, bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and bf_file = '{$_REQUEST["bf_file"]}' ";
$file = sql_fetch($sql);


if (!$file['bf_file'])
    alert_close('파일 정보가 존재하지 않습니다.');

$filepath = G5_DATA_PATH . '/file/' . $bo_table . '/' . $file['bf_file'];
$filepath = addslashes($filepath);
if (!is_file($filepath) || !file_exists($filepath))
    alert('파일이 존재하지 않습니다.');


$g5['title'] = '다운로드 &gt; ' . conv_subject($write['wr_subject'], 255);

//$original = urlencode($file['bf_source']);
$original = iconv('utf-8', 'euc-kr', $file['bf_source']); // SIR 잉끼님 제안코드

@include_once($board_skin_path . '/download.tail.skin.php');

if (preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
    header("content-type: doesn/matter");
    header("content-length: " . filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else {
    header("content-type: file/unknown");
    header("content-length: " . filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");
}
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen($filepath, 'rb');

// 4.00 대체
// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
//if (!fpassthru($fp)) {
//    fclose($fp);
//}

$download_rate = 10;

while (!feof($fp)) {
    //echo fread($fp, 100*1024);
    /*
    echo fread($fp, 100*1024);
    flush();
    */

    print fread($fp, round($download_rate * 1024));
    flush();
    usleep(1000);
}
fclose($fp);
flush();

?>
