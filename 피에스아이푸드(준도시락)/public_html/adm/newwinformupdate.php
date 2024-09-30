<?php
$sub_menu = '280100'; //'100310';
include_once('./_common.php');

@mkdir(G5_DATA_PATH."/popup", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/popup", G5_DIR_PERMISSION);

/*
if ($w == "u" || $w == "d")
    check_demo();

if ($w == 'd')
    auth_check($auth[$sub_menu], "d");
else
    auth_check($auth[$sub_menu], "w");

check_admin_token();
*/

$nw_begin_time = $_POST['nw_begin_time'];
$nw_end_time = $_POST['nw_end_time'];

if (strlen($nw_begin_time) == 10) $nw_begin_time .= " 00:00:00";
if (strlen($nw_end_time) == 10) $nw_end_time .= " 23:59:59";


// 파일업로드
$upload_dir = G5_DATA_PATH.'/popup/';

if ($w == "d") {
    $row = sql_fetch("SELECT nw_file FROM {$g5['new_win_table']} WHERE nw_id = '{$nw_id}'");
    @unlink($upload_dir.$row['nw_file']);

} else {

    $upload_file = $_FILES['nw_file']['tmp_name'];
    $ext = array_pop(explode('.', $_FILES['nw_file']['name']));
    $file_name = "popup_".strtotime(G5_TIME_YMDHIS).".{$ext}";
    $upload_path = $upload_dir.$file_name;

    if ($w == "u" && $upload_file == "") {
        $file_name = $_POST['nw_file_old'];

    } else {
        $img_result = move_uploaded_file($upload_file, $upload_path);

        if (!$img_result) {
            alert("이미지 업로드에 실패하였습니다. 다시 시도해 주세요.");
            exit;
        }
    }
}

// 링크 프로토콜 확인
if ($_POST['nw_link'] != "") {
    if(strpos($_POST['nw_link'], "http") !== false){
    } else {
        $nw_link = "http://".$_POST['nw_link'];
    }
} else {
    $nw_link = "";
}

$sql_common = " nw_device = '{$_POST['nw_device']}',
                nw_begin_time = '{$nw_begin_time}',
                nw_end_time = '{$nw_end_time}',
                nw_disable_hours = '{$_POST['nw_disable_hours']}',
                nw_left = '{$_POST['nw_left']}',
                nw_top = '{$_POST['nw_top']}',
                nw_height = '{$_POST['nw_height']}',
                nw_width = '{$_POST['nw_width']}',
                nw_subject = '{$_POST['nw_subject']}',
                nw_content = '{$_POST['nw_content']}',
                nw_content_html = '{$_POST['nw_content_html']}',
				nw_file = '{$file_name}',
				nw_link = '{$nw_link}'
				";

if($w == "")
{
    $sql = " insert {$g5['new_win_table']} set $sql_common ";
    sql_query($sql);

    $nw_id = sql_insert_id();
}
else if ($w == "u")
{
    $sql = " update {$g5['new_win_table']} set $sql_common where nw_id = '$nw_id' ";
    sql_query($sql);
}
else if ($w == "d")
{
    $sql = " delete from {$g5['new_win_table']} where nw_id = '$nw_id' ";
    sql_query($sql);
}


goto_url('./newwinlist.php');

/*
if ($w == "d")
{
    goto_url('./newwinlist.php');
}
else
{
    goto_url("./newwinform.php?w=u&amp;nw_id=$nw_id");
}
*/
?>
