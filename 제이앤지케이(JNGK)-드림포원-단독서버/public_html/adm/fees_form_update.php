<?php
$sub_menu = "220100";
include_once("./_common.php");

$w = $_POST['w'];
$center_code = $_POST['center_code'];

$sql_common = " credit_card_fees = '{$_POST['credit_card_fees']}',
                check_card_fees = '{$_POST['check_card_fees']}',
                ";

if($w == '') {
    $sql_common .= " center_code = '{$center_code}', reg_date = now() ";

    $sql = " insert into g5_center_fees set {$sql_common} ";
    sql_query($sql);
}
if($w == 'u') {
    $sql_common .= " mod_date = now() ";

    $sql = " update g5_center_fees set {$sql_common} where center_code = '{$center_code}' ";
    sql_query($sql);
}

if($ios_flag) {
echo "
<script>
    alert('수수료가 저장되었습니다.');
</script>
";
goto_url(G5_ADMIN_URL . '/lesson_list.php');
}
else {
echo "
<script>
    alert('수수료가 저장되었습니다.');
    window.close();
</script>
";
}
?>


