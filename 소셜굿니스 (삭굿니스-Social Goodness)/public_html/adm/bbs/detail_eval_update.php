<?php
include_once('./_common.php');

$mode = $_REQUEST['mode'];

if ($mode == 'w') {

    // 혹시나 값이 안들어왔을 경우 팅겨냄
    if ($_REQUEST['service_option_text'] == "" && $_REQUEST['service_option'] == "") {
        alert("서비스 점수를 선택하거나 직접입력 해주세요.");
    }
    if ($_REQUEST['plant_option_text'] == "" && $_REQUEST['plant_option'] == "") {
        alert("시설 점수를 선택하거나 직접입력 해주세요.");
    }
    if ($_REQUEST['price_option_text'] == "" && $_REQUEST['price_option'] == "") {
        alert("가격 점수를 선택하거나 직접입력 해주세요.");
    }

    $sql_common = "";
    $sql_common .= "te_no = '".$_REQUEST['te_no']."',";
    $sql_common .= "mb_no = '".$_REQUEST['mb_no']."',";

    // 점수와 평가가 동시에 들어왔을 경우 평가가 세글자 이상인 경우 평가로 업데이트 됨.
    if (strlen($_REQUEST['service_option_text']) > 3 ) {
        $sql_common .= "service_option = '{$_REQUEST['service_option_text']}', ";
    }else{
        $sql_common .= "service_option = '{$_REQUEST['service_option']}', ";
    }

    if (strlen($_REQUEST['plant_option_text']) > 3) {
        $sql_common .= "plant_option = '{$_REQUEST['plant_option_text']}', ";
    }else{
        $sql_common .= "plant_option = '{$_REQUEST['plant_option']}', ";
    }

    if (strlen($_REQUEST['price_option_text']) > 3) {
        $sql_common .= "price_option = '{$_REQUEST['price_option_text']}', ";
    }else{
        $sql_common .= "price_option = '{$_REQUEST['price_option']}', ";
    }

    // 평가 이력 있는지 확인
    $eval_sql = " select count(*) as count from {$g5['eval_table']} where mb_no = {$_REQUEST['mb_no']} and te_no = {$_REQUEST['te_no']} and category = '리뷰' ";
    $eval_row = sql_fetch($eval_sql);
    $eval_count = $eval_row['count'];
    //finger_option 찾아서 넣어줌
    $sql = " select finger_option from {$g5['eval_table']} where mb_no = {$_REQUEST['mb_no']} and te_no = {$_REQUEST['te_no']} and category = '평가' ";
    $fo_row = sql_fetch($sql);
    $fo = $fo_row['finger_option'];

    $sql_common .= "finger_option = '{$fo}', ";

    // 평가 이력이 있을 경우 btm 업데이트 X
    if($eval_count == 0 ) {
        // 상세 평가 업데이트
        $sql = "insert into {$g5['eval_table']} set {$sql_common} ";
        $sql .= "category = '리뷰' ";
        $sql .= ",detail_eval_date = '" . G5_TIME_YMDHIS . "' ";
        $result = sql_query($sql);


        // btm 업데이트 -- 리워드 btm이 따로 필요하면 쿼리 수정 필요
        $sql = "update {$g5['member_table']} set mb_btm = mb_btm + 10,mb_btm_review = mb_btm_review + 10,mb_btm_reward = mb_btm_reward + 10,mb_btm_accumulate = mb_btm_accumulate+10
                where mb_no = '{$_REQUEST['mb_no']}' " ;
        sql_query($sql);
    }else{

        $sql = " update {$g5['eval_table']} set {$sql_common} ";
        $sql .= " detail_eval_date = '" . G5_TIME_YMDHIS . "' ";
        $sql .= " where mb_no = {$_REQUEST['mb_no']} and te_no = {$_REQUEST['te_no']} and category = '리뷰'; ";

        $result = sql_query($sql);

    }


    echo $result;

}elseif ($mode == "del"){

    $sql = "select del_date from {$g5['eval_table']} where idx = '{$_REQUEST['idx']}' ";
    $del_result = sql_fetch($sql);

    if ($del_result['del_date'] != "0000-00-00 00:00:00"){
        die(json_encode(array('msg'=>"이미 삭제처리 되었습니다.")));
    }

    $del_date = G5_TIME_YMDHIS;

    $sql = "update {$g5['eval_table']} set del_date =  '" . $del_date . "' where idx = '{$_REQUEST['idx']}' ";
    $result = sql_query($sql);

    if ($result){
        die(json_encode(array('msg'=>"success", 'del_date'=>$del_date)));
    }

}elseif ($mode == 'reply'){
    $sql_common = "";
    foreach ($_REQUEST as $key => $value) {
        if ($key != "mode" ) {
            $sql_common .= $key . '="' . $value . '" ,';
        }
    }

    $sql = "insert into {$g5['reply_table']} set {$sql_common}";

    print_r($sql);
    exit;
    $result = sql_query($sql);

    if ($result){
        alert("실패하였습니다.");
    }
}
?>