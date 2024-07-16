<?php
$sub_menu = '300600';
include_once('./_common.php');

if ($w == "u" || $w == "d")
    check_demo();

if ($w == 'd')
    auth_check($auth[$sub_menu], "d");
else
    auth_check($auth[$sub_menu], "w");

$sql = " select * from {$g5['content_save_table']} where co_id = '{$co_id}' and co_no = '{$co_no}' limit 0, 1";
$content = sql_fetch($sql);

check_admin_token();

@mkdir(G5_DATA_PATH."/content_save", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/content_save", G5_DIR_PERMISSION);
if ($co_himg_del)  @unlink(G5_DATA_PATH."/content_save/{$co_id}_h ".$content['co_datetime']);
if ($co_timg_del)  @unlink(G5_DATA_PATH."/content_save/{$co_id}_t ".$content['co_datetime']);

$sql_common = " co_include_head     = '$co_include_head',
                co_include_tail     = '$co_include_tail',
                co_html             = '$co_html',
                co_tag_filter_use   = '$co_tag_filter_use',
                co_subject          = '$co_subject',
                co_content          = '$co_content',
                co_mobile_content   = '$co_mobile_content',
                co_skin             = '$co_skin',
                co_mobile_skin      = '$co_mobile_skin'
                 ";

if ($w == "u")
{
    $sql = " update {$g5['content_save_table']}
                set $sql_common
              where co_id = '$co_id' and co_no = '$co_no'";
    sql_query($sql);
}
else if ($w == "d")
{
    @unlink(G5_DATA_PATH."/content_save/{$co_id}_h ".$content['co_datetime']);
    @unlink(G5_DATA_PATH."/content_save/{$co_id}_t ".$content['co_datetime']);

    $sql = " delete from {$g5['content_save_table']} where co_id = '$co_id' and co_no = '$co_no'";
    sql_query($sql);
}

if ($w == "u")
{
    if ($_FILES['co_himg']['name'])
    {
        $dest_path = G5_DATA_PATH."/content_save/".$co_id."_h ".$content['co_datetime'];
        @move_uploaded_file($_FILES['co_himg']['tmp_name'], $dest_path);
        @chmod($dest_path, G5_FILE_PERMISSION);
    }
    if ($_FILES['co_timg']['name'])
    {
        $dest_path = G5_DATA_PATH."/content_save/".$co_id."_t ".$content['co_datetime'];
        @move_uploaded_file($_FILES['co_timg']['tmp_name'], $dest_path);
        @chmod($dest_path, G5_FILE_PERMISSION);
    }
    goto_url("./contentsaveform.php?w=u&amp;co_id=$co_id&amp;co_no=$co_no");
}
else
{
    goto_url("./contentsavelist.php");
}
?>
