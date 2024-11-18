<?php
include_once('./_common.php');

//수정이 아닌경우 break;
if ($w != 'u'){
    die("수정만 가능한 작업입니다.");
}

$nw_subject = $_POST['nw_subject'];
$nw_content = $_POST['nw_content'];

$sql_common = "";
switch($nw_subject) {
    case 'bo_1':
        $sql_common = " bo_1 = '{$nw_content}' ";
        break;
    case 'bo_2':
        $sql_common = " bo_2 = '{$nw_content}' ";
        break;
    case 'bo_3':
        $sql_common = " bo_3 = '{$nw_content}' ";
        break;
    case 'bo_4':
        $sql_common = " bo_4 = '{$nw_content}' ";
        break;
    case 'bo_5':
        $sql_common = " bo_5 = '{$nw_content}' ";
        break;
    case 'bo_6':
        $sql_common = " bo_6 = '{$nw_content}' ";
        break;
    default:
        break;
}

check_admin_token();


if($w == "")
{
    /*$sql = " insert {$g5['board_table']} set $sql_common ";
    sql_query($sql);

    $nw_id = sql_insert_id();*/
}
else if ($w == "u")
{
    $sql = " update {$g5['board_table']} set $sql_common where bo_table = 'cs' ";
    sql_query($sql);
}

//goto_url("./cs_update_form.php?w=u&amp;nw_id=$nw_subject");
goto_url("./cs_default_msg_manager");

?>
