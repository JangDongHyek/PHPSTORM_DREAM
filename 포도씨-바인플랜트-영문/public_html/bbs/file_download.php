<?php
include_once('./_common.php');
/**
 * 파일 다운로드 - 견적 자료 및 채팅방에서
 */

if($mode == 'chat') { // 채팅
    $file_path = G5_PATH.'/node/uploads/';
} else { // 의뢰자료
    $file_path = G5_DATA_PATH.'/file/'.$mode.'/';
}
$server_file_name = $temp; // 서버에 저장된 파일명
//$real_file_name = iconv('UTF-8','CP949', $real);// 실제 파일명
$real_file_name = $real;// 실제 파일명
$info = $file_path . $server_file_name;
$file_size = filesize($info);

if (file_exists($info)) {
    header("Content-Type:application/octet-stream");
    header("Content-Disposition:attachment;filename=\"$real_file_name\"");
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
alert("존재하지 않는 파일입니다.");
}
?>
