<?php
include_once('./_common.php');

// clean the output buffer
ob_end_clean();

$no = (int)$no;

@include_once($board_skin_path.'/download.head.skin.php');

// 쿠키에 저장된 ID값과 넘어온 ID값을 비교하여 같지 않을 경우 오류 발생
// 다른곳에서 링크 거는것을 방지하기 위한 코드
//if (!get_session('ss_view_'.$bo_table.'_'.$wr_id))
//    alert('잘못된 접근입니다.');

// 다운로드 차감일 때 비회원은 다운로드 불가
if($board['bo_download_point'] < 0 && $is_guest)
    alert('다운로드 권한이 없습니다.\\n회원이시라면 로그인 후 이용해 보십시오.', G5_BBS_URL.'/login.php?wr_id='.$wr_id.'&amp;'.$qstr.'&amp;url='.urlencode(G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id));

echo $sql = " select bf_source, bf_file from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$no' ";
$file = sql_fetch($sql);
if (!$file['bf_file'])
    alert('파일 정보가 존재하지 않습니다.');

// JavaScript 불가일 때
if($js != 'on' && $board['bo_download_point'] < 0) {
    $msg = $file['bf_source'].' 파일을 다운로드 하시면 포인트가 차감('.number_format($board['bo_download_point']).'점)됩니다.\\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\\n그래도 다운로드 하시겠습니까?';
    $url1 = G5_BBS_URL.'/download.php?'.clean_query_string($_SERVER['QUERY_STRING']).'&amp;js=on';
    $url2 = clean_xss_tags($_SERVER['HTTP_REFERER']);

    //$url1 = 확인link, $url2=취소link
    // 특정주소로 이동시키려면 $url3 이용
    confirm($msg, $url1, $url2);
}

if ($member['mb_level'] < $board['bo_download_level']) {
    $alert_msg = '다운로드 권한이 없습니다.';
    if ($member['mb_id'])
        alert($alert_msg);
    else
        alert($alert_msg.'\\n회원이시라면 로그인 후 이용해 보십시오.', G5_BBS_URL.'/login.php?wr_id='.$wr_id.'&amp;'.$qstr.'&amp;url='.urlencode(G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id));
}

$filepath = G5_DATA_PATH.'/file/'.$bo_table.'/'.$file['bf_file'];
$filepath = addslashes($filepath);
if (!is_file($filepath) || !file_exists($filepath))
    alert('파일이 존재하지 않습니다.');

// 사용자 코드 실행
@include_once($board_skin_path.'/download.skin.php');

// 이미 다운로드 받은 파일인지를 검사한 후 게시물당 한번만 포인트를 차감하도록 수정
$ss_name = 'ss_down_'.$bo_table.'_'.$wr_id;
if (!get_session($ss_name))
{
    // 자신의 글이라면 통과
    // 관리자인 경우 통과
    if (($write['mb_id'] && $write['mb_id'] == $member['mb_id']) || $is_admin)
        ;
    else if ($board['bo_download_level'] >= 1) // 회원이상 다운로드가 가능하다면
    {
        // 다운로드 포인트가 음수이고 회원의 포인트가 0 이거나 작다면
        if ($member['mb_point'] + $board['bo_download_point'] < 0)
            alert('보유하신 포인트('.number_format($member['mb_point']).')가 없거나 모자라서 다운로드('.number_format($board['bo_download_point']).')가 불가합니다.\\n\\n포인트를 적립하신 후 다시 다운로드 해 주십시오.');

        // 게시물당 한번만 차감하도록 수정
        insert_point($member['mb_id'], $board['bo_download_point'], "{$board['bo_subject']} $wr_id 파일 다운로드", $bo_table, $wr_id, "다운로드");
    }

    // 다운로드 카운트 증가
    $sql = " update {$g5['board_file_table']} set bf_download = bf_download + 1 where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$no' ";
    sql_query($sql);

    set_session($ss_name, TRUE);
}

$g5['title'] = '다운로드 &gt; '.conv_subject($write['wr_subject'], 255);

//$original = urlencode($file['bf_source']);
$original = iconv('utf-8', 'euc-kr', $file['bf_source']); // SIR 잉끼님 제안코드

@include_once($board_skin_path.'/download.tail.skin.php');

// Must be fresh start
if( headers_sent() )
    die('Headers Already Sent');

// Required for some browsers
if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');

// Parse Info / Get Extension
$fsize = filesize($filepath);
$path_parts = pathinfo($filepath);
$ext = strtolower($path_parts["extension"]);

// Determine Content Type
switch ($ext)
{
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "doc": $ctype="application/msword"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpg"; break;
    default: $ctype="application/force-download";
}

header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: $ctype");
header("Content-Disposition: attachment; filename=\"".basename($filepath)."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$fsize);
ob_clean();
flush();

$fp = fopen($filepath, 'rb');

// 4.00 대체
// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
//if (!fpassthru($fp)) {
//    fclose($fp);
//}

$download_rate = 10;

while(!feof($fp)) {
    //echo fread($fp, 100*1024);
    /*
    echo fread($fp, 100*1024);
    flush();
    */

    print fread($fp, round($download_rate * 1024));
    flush();
    usleep(1000);
}
fclose ($fp);
flush();
?>
