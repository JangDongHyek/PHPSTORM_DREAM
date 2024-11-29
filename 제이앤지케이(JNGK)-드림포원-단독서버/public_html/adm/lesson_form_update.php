<?php
$sub_menu = "220100";
include_once("./_common.php");

$w = $_POST['w'];
$idx = $_POST['idx'];

$sql = " select if(max(substring(lesson_code, 7)+0) is null, 0, max(substring(lesson_code, 7)+0)) as lesson_code from g5_lesson where center_code = '{$member['center_code']}' ";
$lesson_code = sql_fetch($sql)['lesson_code'];
//$lesson_code = explode('lesson', $code)[1];
$lesson_code = 'lesson' . ($lesson_code + 1);

$lesson_price = str_replace(',','',$_POST['lesson_price']);

$sql_common = " lesson_name = '{$_POST['lesson_name']}',
                lesson_time = '{$_POST['lesson_time']}',
                lesson_count = '{$_POST['lesson_count']}',
                lesson_price = '{$lesson_price}',
                center_code = '{$member['center_code']}',
                ";

if($w == '') {
    $sql_common .= " lesson_code = '{$lesson_code}', reg_date = now(), reg_mb_no = '{$member['mb_no']}' ";

    $sql = " insert into g5_lesson set {$sql_common} ";
    sql_query($sql);
}
if($w == 'u') {
    $sql_common .= " mod_date = now(), mod_mb_no = '{$member['mb_no']}' ";

    $sql = " update g5_lesson set {$sql_common} where idx = {$idx} ";
    sql_query($sql);
}

if($ios_flag) {
    goto_url(G5_ADMIN_URL . '/lesson_list.php');
}
else {
echo "
<script>
    opener.document.location.replace('./lesson_list.php');
    window.close();
</script>
";
}
?>


