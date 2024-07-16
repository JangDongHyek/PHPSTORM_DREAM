<?php
include_once('./_common.php');

$sql = "select * from g5_member where mb_email = '{$mb_email}'";
$row = sql_fetch($sql);
if ($row['mb_id']) {
    $length = strlen($row['mb_id']) - 3;
    $firstId = substr($row['mb_id'], 0, 3);
    $starTxt = "";
    for ($i = 0; $i < $length; $i++) {
        $starTxt .= "*";
    }
    $mb_id = $firstId . $starTxt;
    // $mb_id = $row['mb_id'];

    echo "Member ID is <font color='blue' style='font-size:15px;font-weight:bold'>" . $mb_id . "</font>";
} else {
    echo "Missing information or entered incorrectly";
}
?>
