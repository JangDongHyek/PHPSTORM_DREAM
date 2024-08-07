<?php
include_once("./_common.php");

$mb_bank = $_GET['mb_bank'];
$mb_aname = $_GET['mb_aname'];
$mb_account = $_GET['mb_account'];

sql_query("update g5_member set mb_bank = '{$mb_bank}', mb_aname = '{$mb_aname}', mb_account = '{$mb_account}' where mb_id = '{$member['mb_id']}'");
?>