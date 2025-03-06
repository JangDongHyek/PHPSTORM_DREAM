<?php

    include_once("./_common.php");
    $mb_id = $_POST['mb_id'];
    $approvalYN = $_POST['approvalYN'];

    if (!$mb_id) {
        exit('회원 아이디가 없습니다.');
    }
    $sql = "UPDATE g5_member SET mb_state = '{$approvalYN}' where mb_id = '{$mb_id}'";
    $result = sql_query($sql);

    if ($result) die('success');
    else die('fail');