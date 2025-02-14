<?php include_once('./_common.php');
$mode = $_REQUEST["mode"];

if (!$is_admin){
    alert("관리자만 사용가능합니다",G5_URL);
}

if ($mode == "memo_insert"){

    $sql = "insert into new_memo set memo = '{$_REQUEST["memo"]}', memo_mb_id = '{$_REQUEST["memo_mb_id"]}',wr_datetime = '".G5_TIME_YMDHIS."' ";
    $result = sql_query($sql);


}elseif ($mode == "memo_del"){

    $sql = "delete from new_memo where idx = '{$_REQUEST["idx"]}' ";
    sql_query($sql);

   //goto_url(G5_ADMIN_URL."/member_form.php?w=u&tab=adm_memo&mb_id=".$_REQUEST["mb_id"]);
    goto_url(G5_ADMIN_URL."/member_form.php?w=u&mb_id=".$_REQUEST["mb_id"]);

}else if ($mode == "memo_update"){

    $sql = "update new_memo set memo = '{$_REQUEST["memo"]}' where idx = '{$_REQUEST["idx"]}' ";
    $result = sql_query($sql);


}elseif ($mode == 'yn_list_banner_change'){

    if ($_REQUEST['act_button'] == '비노출로 변경'){
        $use = '2';
    }else{
        $use = '1';
    }

    for ($i=0; $i<count($_POST['chk']); $i++)
    {

        $sql = "update new_adm_banner set ba_use = '{$use}' where idx = {$_POST['chk'][$i]} ";
        sql_query($sql);

    }


    goto_url(G5_ADMIN_URL.'/banner_list.php?'.$qstr);

}else if ($mode == "message_update"){

    $sql= "update g5_message set message = '{$_REQUEST["message"]}',up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$_REQUEST["idx"]}' ";
    $result = sql_query($sql);

    if ($result == 1){
        alert("완료되었습니다.", G5_ADMIN_URL."/message_form?idx=".$_REQUEST["idx"]."&".$qstr);
    }


}else if($mode == "message_del"){

    $sql= "delete from g5_message where idx = '{$_REQUEST["idx"]}' ";
    $result = sql_query($sql);

    if ($result == 1){
        alert("완료되었습니다.", G5_ADMIN_URL."/message_list.php?".$qstr);
    }


}elseif ($mode == 'mb_8_change'){

    $mb_8 = $_REQUEST['mb_8'];
    $mb_id = $_REQUEST['mb_id'];

    if ($mb_8 == 2){
        $sql_add = ", mb_hp = '' ,mb_leave_date = '".date('Ymd',strtotime(G5_TIME_YMD))."' ";
    }else{
        $sql_add = ",mb_leave_date = '' ";
    }
    $sql = " update {$g5['member_table']} set mb_8 = '{$mb_8}' {$sql_add} where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    echo $result;

}