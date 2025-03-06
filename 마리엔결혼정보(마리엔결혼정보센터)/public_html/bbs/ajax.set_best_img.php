<?php
    include_once("./_common.php");

    $bo_table = $_REQUEST['bo_table'];
    $bf_no = $_REQUEST['bf_no'];
    $wr_id = $_REQUEST['wr_id'];

    $sql = "update g5_board_file set bf_best = ''  where bo_table = 'member_img' and wr_id = '{$wr_id}'";
    $update_reset_img = sql_query($sql);

    var_dump($update_reset_img);
    $sql = "update g5_board_file set bf_best = 'Y'  where bo_table = 'member_img' and wr_id = '{$wr_id}' and bf_no = {$bf_no} ";
    $update_img = sql_query($sql);

var_dump($update_img);