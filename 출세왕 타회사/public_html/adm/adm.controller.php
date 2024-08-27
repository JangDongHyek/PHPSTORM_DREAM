<?php
include_once('./_common.php');

$mode = $_REQUEST['mode'];

function insert_query($table_name,$arr,$key_ok,$add){

    $sql = "insert into ".$table_name." set ";

    foreach ($arr as $key => $value) {
        if (strpos( $key, $key_ok ) === 0 ) {
            $sql .= $key . "='" . $value . "',";
        }
    }
    $sql .= $add;
    $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";

    $result = sql_query($sql);
    return $result;


}
function update_query($table_name,$table_idx,$arr,$key_ok,$add){

    $sql = "update ".$table_name." set ";


    foreach ($arr as $key => $value) {
        if (strpos( $key, $key_ok ) === 0) {
            if ($key != $table_idx) {
                $sql .= $key . "='" . $value . "',";
            }
        }
    }
    $sql .= $add;
    $sql .= "up_datetime = '" . G5_TIME_YMDHIS . "'";
    $sql .= " where ".$table_idx." = '" . $arr[$table_idx] . "'";
    $result = sql_query($sql);
    return $result;

}


if ($mode == "go_car_update"){

    $table_name = $g5['car_table'];
    $add = 'mb_id = "'.$_REQUEST["mb_id"].'", ';
    $_REQUEST['car_no'] = str_replace(" ", "", $_REQUEST['car_no']);
    insert_query($table_name,$_REQUEST,'car_',$add);

    if ($car_no != "") {

        @mkdir(G5_DATA_PATH . '/file/car_photo', G5_DIR_PERMISSION);
        @chmod(G5_DATA_PATH . '/file/car_photo', G5_DIR_PERMISSION);

        if ($_REQUEST['del_mb_icon'] == 1)
            @unlink(G5_DATA_PATH.'/file/car_photo/'.str_replace(" ", "", $_REQUEST['car_no']).'.jpg');

        if ($_FILES['bf_file']['tmp_name'] != "" ) {

            $arr_name = explode('.', $_FILES['bf_file']['name']);
            $file_ext = array_pop($arr_name); //확장자 추출 (array_pop : 배열의 마지막 원소를 빼내어 반환)
            $check_ext = array('JPG', 'JPEG', 'PNG','jpg', 'jpeg', 'png'); //확장자 체크를 위한 선언부

            if (!in_array($file_ext, $check_ext)) {
                echo "허용되지 않는 확장자입니다";
                exit;

            }

//    if ($file_width > $new_file_width) { //이미지 가로사이즈가 200보다 크면 사이즈 조절
            $dest_path = G5_DATA_PATH . '/file/car_photo/' .str_replace(" ", "", $_REQUEST['car_no']). '.jpg';
            $tmp_file = $_FILES['bf_file']['tmp_name'];
            move_uploaded_file($tmp_file, $dest_path) or die($_FILES['bf_file']['error'][$i]);

//            size_image($_FILES['bf_file'],350,350, $dest_path,'one');
//      exit();
//    }
        }
    }

    goto_url(G5_ADMIN_URL.'/member_form.php?w=u&mb_id='.$_REQUEST['mb_id']);

}elseif ($mode == "go_car_del"){

    $sql = "delete from {$g5['car_table']} where gc_idx = '{$_REQUEST["idx"]}'";
    sql_query($sql);

    @unlink(G5_DATA_PATH.'/file/car_photo/'. str_replace(" ", "", $_REQUEST['car_no']).'.jpg');

    //23.04.14 여기에 car_img 값있으면 그것도삭제해주게 wc
    @unlink(G5_DATA_PATH.'/file/car_photo/'.$_REQUEST['car_img']);

    goto_url(G5_ADMIN_URL.'/member_form.php?w=u&mb_id='.$_REQUEST['mb_id']);

}elseif ($mode == "list_option"){

    $list = "";
    $type = $_REQUEST['type'];

    if ( strpos( $type, 'step' ) == true){
        $list = $step_list;
        $c = 0;
    }elseif ($type == "car_date_type"){
        $list = $cdt_list;
        $b = 1;
    }elseif ($type == "cu_building"){
        $list = $cub_list;
        $b = 1;
    }

    $html = "";
    $html .= '<select name="stx" id="stx" data-option = "option_list" class=" frm_input" value="'.$stx .'">';
    for ($c=0 ; $c < count($list); $c++) {
        if ($_REQUEST["is_no_company"] == "Y" && ($c+$b) == 4){
            continue;
        }
        $html .= '<option value = "'. ($c+$b) .'">'. $list[($c+$b)].'</option>';
    }
    $html .= '</select>';

    echo $html;
}elseif ($mode == "service_form"){


    //금액 콤마제거
    $_REQUEST['final_pay'] = str_replace ( ',' , '', $_REQUEST['final_pay']);
    $_REQUEST['ma_payment'] = str_replace ( ',' , '', $_REQUEST['ma_payment']);
    $add = "mb_name = '".$_REQUEST['mb_name']."', ";
    $add .="mb_hp = '".$_REQUEST['mb_hp']."', ";
    $add .="ma_id = '".$_REQUEST['ma_id']."', ";
    $add .="final_pay = '".$_REQUEST['final_pay']."', ";
    $add .="cw_step = '".$_REQUEST['cw_step']."', ";
    $add .="ma_step = '".$_REQUEST['ma_step']."', ";
    $add .="ma_payment = '".$_REQUEST['ma_payment']."', ";
    $add .="ma_payment_datetime = '".$_REQUEST['ma_payment_datetime']."', ";

    if($_REQUEST['w'] == 'u'){


        $result = update_query($g5['car_wash_table'],'cw_idx',$_REQUEST,'car_',$add);
        $idx = $_REQUEST['cw_idx'];
        $msg = "수정";
    }else{
        $add .="mb_id = '".$member['mb_id']."', ";

        $result = insert_query($g5['car_wash_table'],$_REQUEST,'car_',$add);
        $idx = sql_insert_id();
        $msg = "저장";

    }

    if($_REQUEST['re_url']){
        $url = G5_ADMIN_URL."/".$_REQUEST['re_url'].".php?".$qstr."&w=u&idx=".$idx;
    }else{
        $url = G5_ADMIN_URL."/adm_service_form.php?".$qstr."&w=u&idx=".$idx;
    }

    if ($result == 1 ){
        alert($msg.'되었습니다',$url);
    }else{
        alert("데이터가 정확하지 않습니다. 숫자, 문자를 구분해서 넣어주세요.",$url);
    }

}elseif ($mode == "manager_sel"){

    $arr = $_REQUEST;

    for ($i = 0; $i < count($arr['idx']); $i++){
      $sql = "select cw_step from {$g5['car_wash_table']} where cw_idx = '{$arr['idx'][$i]}' ";
      $result = sql_fetch($sql);

      if ($result["cw_step"] != 0 && $result["cw_step"] != 1){
          echo "대기, 진행중인 서비스만 매니저등록이 가능합니다.";
          die();
      }

    }

    for ($i = 0; $i < count($arr['idx']); $i++){
        $sql= "update {$g5['car_wash_table']} set ma_id = '{$arr["ma_id"]}', cw_step = '1',up_datetime =  '".G5_TIME_YMDHIS."' where cw_idx = '{$arr['idx'][$i]}' ";
        $up_result = sql_query($sql);
    }

    echo $up_result;



}elseif ($mode == "cleanup_form"){


    //금액 콤마제거
$_REQUEST['final_pay'] = str_replace ( ',' , '', $_REQUEST['final_pay']);

$add .="ma_id = '".$_REQUEST['ma_id']."', ";
$add .="final_pay = '".$_REQUEST['final_pay']."', ";

if($_REQUEST['w'] == 'u'){


    $result = update_query($g5['cleanup_table'],'cu_idx',$_REQUEST,'cu_',$add);
    $idx = $_REQUEST['cu_idx'];
    $msg = "수정";
}else{

    $result = insert_query($g5['cleanup_table'],$_REQUEST,'cu_',$add);
    $idx = sql_insert_id();
    $msg = "저장";

}

$url = G5_ADMIN_URL."/adm_cleanup_form.php?".$qstr."&w=u&idx=".$idx;
if ($result == 1 ){
    alert($msg.'되었습니다',$url);
}else{
    alert("데이터가 정확하지 않습니다. 숫자, 문자를 구분해서 넣어주세요.",$url);
}


}elseif ($mode == "cu_manager_sel" ){
    $arr = $_REQUEST;

    for ($i = 0; $i < count($arr['idx']); $i++){
        $sql = "select cu_step from {$g5['cleanup_table']} where cu_idx = '{$arr['idx'][$i]}' ";
        $result = sql_fetch($sql);

        if ($result["cu_step"] != 0 && $result["cu_step"] != 1){
            echo "대기, 진행중인 서비스만 매니저등록이 가능합니다.";
            die();
        }

    }

    for ($i = 0; $i < count($arr['idx']); $i++){
        $sql= "update {$g5['cleanup_table']} set ma_id = '{$arr["ma_id"]}', cu_step = '1',up_datetime = '".G5_TIME_YMDHIS."' where cu_idx = '{$arr['idx'][$i]}' ";
        $up_result = sql_query($sql);
    }

    echo $up_result;


}elseif ($mode == "re_service_form"){

    $idx = $_REQUEST['rw_idx'];

    if($_REQUEST['w'] == 'u'){

        if ($_REQUEST['rw_date2'] == ""){
            $_REQUEST['rw_date2'] = NULL;
        }

        $sql = "update new_re_car_wash set ";


        foreach ($_REQUEST as $key => $value) {
            if (strpos( $key, "rw_" ) === 0 && $key != "rw_idx") {
                    if ($key == 'rw_date2' && $value == ""){
                        $sql .= $key . "=NULL,";
                    }else{
                        $sql .= $key . "='" . $value . "',";
                    }
            }
        }
        $sql .= "up_datetime = '" . G5_TIME_YMDHIS . "'";
        $sql .= " where rw_idx = '" .$idx. "'";

        $result = sql_query($sql);
        $msg = "수정";
    }

    $url = G5_ADMIN_URL."/adm_re_service_form.php?".$qstr."&w=u&idx=".$idx;
    if ($result == 1 ){
        alert($msg.'되었습니다',$url);
    }else{
        alert("데이터가 정확하지 않습니다. 숫자, 문자를 구분해서 넣어주세요.",$url);
    }

}elseif ($mode == "service_company_form"){

    $add .= "ma_id = '".$_REQUEST["ma_id"]."',";

    if($_REQUEST['w'] == 'u'){

        $result = update_query("new_company_car_wash",'cc_idx',$_REQUEST,'cc_',$add);
        $idx = $_REQUEST['cc_idx'];
        $msg = "수정";
    }else{
        $add .= "mb_id = '".$member["mb_id"]."',";

        $result = insert_query("new_company_car_wash",$_REQUEST,'cc_',$add);
        $idx = sql_insert_id();
        $msg = "저장";

    }

    $url = G5_ADMIN_URL."/adm_company_service_form.php?".$qstr."&w=u&idx=".$idx;
    if ($result == 1 ){
        alert($msg.'되었습니다',$url);
    }else{
        alert("데이터가 정확하지 않습니다. 숫자, 문자를 구분해서 넣어주세요.",$url);
    }


}elseif ($mode == "memo_update"){
    $sql = "update new_car_wash set call_memo = '{$_REQUEST["call_memo"]}' where cw_idx = '{$_REQUEST["cw_idx"]}' ";
    $result = sql_query($sql);

    if ($result == 1 ) {
       $url = G5_ADMIN_URL."/adm_request_call.php?".$qstr;
       echo $url;
    }

}