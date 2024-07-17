<?php
include_once('./_common.php');

$mode = $_REQUEST['mode'];

function insert_query($arr,$db_name,$first_name){
    global $member;

    $sql = "insert into {$db_name} set ";
    foreach ($arr as $key => $value) {
        if (strpos($key, $first_name.'_') === 0) {

            $sql .= $key . "='" . $value . "',";

        }
    }
    $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "' ";


    sql_query($sql);
    $idx = sql_insert_id();

    return $idx;
}

function update_query($arr,$db_name,$first_name){

    $sql = "update {$db_name} set ";
    foreach ($arr as $key => $value) {
        if (strpos($key, $first_name.'_') === 0) {
            if ($key != $first_name.'_idx' ) {
                $sql .= $key . "='" . $value . "',";
            }

        }
    }
    $sql .= "up_datetime = '" . G5_TIME_YMDHIS . "' ";
    $sql .=  "where {$first_name}_idx = '{$_REQUEST[$first_name.'_idx']}' ";

    $result = sql_query($sql);
    return $result;
}

if ($mode == "ctg_update") {

    insert_query($_REQUEST,'new_category','c');
    goto_url(G5_ADMIN_URL."/category_list.php?".$qstr);

}elseif ($mode == 'yn_list_change'){

    $result = update_query($_REQUEST,'new_category','c');

    echo $result;

}elseif ($mode == "category_list_update"){

    for ($i=0; $i<count($_POST['c_number']); $i++)
    {

        $sql = " update new_category
                    set c_number = '{$_POST['c_number'][$i]}',
                    c_name = '{$_POST['c_name'][$i]}'
                    where c_idx = '{$_POST['c_idx'][$i]}' ";
        sql_query($sql);

    }
    alert('저장되었습니다.','./category_list.php?'.$qstr);

}