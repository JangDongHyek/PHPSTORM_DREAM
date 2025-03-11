<?php

include_once('./_common.php');

$mode = $_REQUEST['mode'];
$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 23.04.13 오류수정함 $add값 안들어가도 작동하게 wc
function insert_query($table_name,$table_idx,$arr,$add = ''){

    $sql = "insert into ".$table_name." set ";

    foreach ($arr as $key => $value) {
        if ($key != "mode" && $key != $table_idx && $key != 'bf_file' ) {
            $sql .= $key . "='" . $value . "',";
        }
    }

    $sql .= $add;
    $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";

    sql_query($sql);

    $idx = sql_insert_id();

    return $idx;


}

function insert_query_sql($table_name,$table_idx,$arr,$add = ''){

    $sql = "insert into ".$table_name." set ";

    foreach ($arr as $key => $value) {
        if ($key != "mode" && $key != $table_idx && $key != 'bf_file' ) {
            $sql .= $key . "='" . $value . "',";
        }
    }

    $sql .= $add;
    $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";

    return $sql;


}
//24-08-30 고객이 신청할떄 wr_datetime에 ,없어서 오류 매니저가 작업완료할떄 , 있어서 오류나서 insert_query 이원화
function insert_query2($table_name,$table_idx,$arr,$add = ''){

    $sql = "insert into ".$table_name." set ";

    foreach ($arr as $key => $value) {
        if ($key != "mode" && $key != $table_idx && $key != 'bf_file' ) {
            $sql .= $key . "='" . $value . "',";
        }
    }

    $sql .= $add;
    $sql .= ", wr_datetime = '" . G5_TIME_YMDHIS . "'";

    sql_query($sql);

    $idx = sql_insert_id();

    return $idx;


}
function update_query($table_name,$table_idx,$arr){

    $sql = "update ".$table_name." set ";

    foreach ($arr as $key => $value) {
        if ($key != "mode" && $key != $table_idx ) {
            $sql .= $key . "='" . $value . "',";
        }
    }

    $sql .= "up_datetime = '" . G5_TIME_YMDHIS . "'";
    $sql .= " where ".$table_idx." = '" . $arr[$table_idx] . "'";
    $result = sql_query($sql);
    return $result;

}
function service_step($step,$complete_cnt=0){

    global $g5;

    if ($step == 2 ){
        $complete_datetime = G5_TIME_YMDHIS;
    }

    if($complete_cnt==0){
        $result = update_query($g5['car_wash_table'],'cw_idx',array("cw_step" => $step ,"cw_idx" => $_REQUEST['idx'],"complete_datetime" => $complete_datetime));
    }else{
        $result = update_query($g5['car_wash_table'],'cw_idx',array("cw_step" => $step ,"cw_idx" => $_REQUEST['idx'],"complete_datetime" => $complete_datetime,"complete_cnt" => $complete_cnt ));

    }



        return $result;

}
//카 워시 폼

if ($mode == "car_wash_form"){

    $sql = "select count(*) cnt from new_car_wash where mb_id = '{$member["mb_id"]}' and car_date_type = 2 and car_no = '{$_REQUEST['car_no']}' ";
    $cw_cnt = sql_fetch($sql)["cnt"];

    /*
    Content-Disposition: form-data; name="car_size"	1
    Content-Disposition: form-data; name="car_date_type"	3
    Content-Disposition: form-data; name="mode"	car_wash_form
    Content-Disposition: form-data; name="cp_price_view"	30000
    Content-Disposition: form-data; name="cp_price"	25000
    Content-Disposition: form-data; name="cp_type"	cp_point
    Content-Disposition: form-data; name="cp_id"
    Content-Disposition: form-data; name="cp_subject"
    Content-Disposition: form-data; name="car_no"	12가1235
    Content-Disposition: form-data; name="car_type"	아반떼
    Content-Disposition: form-data; name="car_color"	흰색
    Content-Disposition: form-data; name="car_w_date"	2024. 1. 5
    Content-Disposition: form-data; name="car_w_addr1"	부산 강서구 명지국제5로 11  (명지동, 명지 대방노블랜드 오션뷰2차)
    Content-Disposition: form-data; name="car_w_addr2"	104동903호
    Content-Disposition: form-data; name="car_place"
    Content-Disposition: form-data; name="car_place2"
    Content-Disposition: form-data; name="car_picture_memo"
    Content-Disposition: form-data; name="car_memo"
    Content-Disposition: form-data; name="mb_name"	김홍규
    Content-Disposition: form-data; name="mb_hp"	01066103103
     */

    //23.04.13  && $_REQUEST['car_date_type'] != 3 , 5 (5는 실내세차) 추가 정기 있으면 신청아에안되던거 단기신청이 아닐땐 가능하게  정기 + 단기 중복신청가능 wc
    //if ($cw_cnt > 0 && (int)$_REQUEST['car_date_type'] != 3 && (int)$_REQUEST['car_date_type'] != 5 ){

    //24-08-30 정기세차가 있는데도 정기세차 맛보기 가능하게
    if ($cw_cnt > 0 && (int)$_REQUEST['car_date_type'] != 3 && (int)$_REQUEST['car_date_type'] != 5 && (int)$_REQUEST['car_date_type'] != 1){
        //여기 테스트용으로 풀고 정기신청 ㄱ
        $res['type'] = "NORMAL";
        $res['idx'] = 0;
        $res['aa'] = 0;
        echo json_encode($res);
        die();
    }


    $pay = $money_list[$_REQUEST['car_date_type']."".$_REQUEST['car_size']];

    //실내세차 가격해주던거 없앰
    //$in_pay = $_REQUEST['car_in_yn'] == 'Y' ? '10000': "";
    //$final_pay = $pay + $in_pay;

    // 23.04.20 쿠폰가격 wc
    if($_REQUEST['cp_id']){
        $cp_type = $_REQUEST['cp_type'];
        $cp_price = $_REQUEST['cp_price'];
        $dc = 0;

        if($cp_type == 1) {
            $dc = floor($pay * ( $cp_price / 100 ));
        } else {
            $dc =  $cp_price;
        }
        $final_pay = $pay - $dc;



    }else{
        $final_pay = $pay;
    }




    $add = "mb_id = '{$member['mb_id']}',";
    $add .= "final_pay = '{$final_pay}',";
    $bo_table = 'car_wash';

    if($_REQUEST['car_no']){
        $_REQUEST['car_no'] = str_replace( ' ' , '',$_REQUEST["car_no"]);
    }


    if(is_array($_REQUEST['car_w_date'])){
        $_REQUEST['car_w_date'] =  implode(", ", $_REQUEST['car_w_date']);
    }

    $sql_re = "select * from {$g5['car_wash_table']} where mb_id = '{$member['mb_id']}' and ma_id <> '' limit 0,1 ";
    $result_re = sql_fetch($sql_re);
    $res['sql_re'] = $sql_re;

    if($result_re){
        $add .= " ma_id = '{$result_re['ma_id']}', ";
        $add .= " cw_step = '1',";
    }

    $result = insert_query($g5['car_wash_table'],'cw_idx',$_REQUEST,$add);
    $result_sql = insert_query_sql($g5['car_wash_table'],'cw_idx',$_REQUEST,$add);

    @mkdir(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    //idx 임시생성
    $idx = $result;

    //쿠폰 로그남기는거
    if($_REQUEST['cp_id']) {
        //공백제거
        $_REQUEST['cp_id'] = preg_replace("/\s+/", "", $_REQUEST['cp_id']);
        $sql = " insert into {$g5['g5_shop_coupon_log_table']}
                        set cp_id       = '{$_REQUEST['cp_id']}',
                            mb_id       = '{$member['mb_id']}',
                            od_id       = '$idx',
                            cp_price    = '$dc',
                            cl_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }


    for ($i = 0; $i < count($_FILES['bf_file']['name']); $i++) {

        $upload[$i]['file'] = '';
        $upload[$i]['source'] = '';
        $upload[$i]['filesize'] = 0;
        $upload[$i]['image'] = array();
        $upload[$i]['image'][0] = '';
        $upload[$i]['image'][1] = '';
        $upload[$i]['image'][2] = '';

        $tmp_file = $_FILES['bf_file']['tmp_name'][$i];
        $filesize = $_FILES['bf_file']['size'][$i];
        $filename = $_FILES['bf_file']['name'][$i];
        $filename = get_safe_filename($filename);



        if (is_uploaded_file($tmp_file)) {


            //=================================================================\
            // 090714
            // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
            // 에러메세지는 출력하지 않는다.
            //-----------------------------------------------------------------
            $timg = @getimagesize($tmp_file);
            // image type
            if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
                preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
                if ($timg['2'] < 1 || $timg['2'] > 16)
                    continue;
            }
            //=================================================================

            $upload[$i]['image'] = $timg;

            // 프로그램 원래 파일명
            $upload[$i]['source'] = $filename;
            $upload[$i]['filesize'] = $filesize;

            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
            $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
            $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);

            $dest_file = G5_DATA_PATH . '/file/' . $bo_table . '/' . $upload[$i]['file'];

            //이미지 크기조정
            size_image($_FILES['bf_file'], 400, 400, $dest_file, 'multi', $i);
            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
//        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);
        }
    }

    for ($i = 0; $i < count($upload); $i++) {

        $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$idx}',
                         bf_no = '{$i}',
                         bf_source = '{$upload[$i]['source']}',
                         bf_file = '{$upload[$i]['file']}',
                         bf_content = '{$bf_content[$i]}',
                         bf_download = 0,
                         bf_filesize = '{$upload[$i]['filesize']}',
                         bf_width = '{$upload[$i]['image']['0']}',
                         bf_height = '{$upload[$i]['image']['1']}',
                         bf_type = '{$upload[$i]['image']['2']}',
                         bf_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);

    }


    //2023-11-28
    //포인트로 모두 결제해서 결제할내역이 없다면
    $res = array();
    if($final_pay == 0){

        $res['type'] = "POINT";

        //상태변경
        $sql = "update new_car_wash set is_payment = 'Y' where cw_idx = '{$idx}' ";
        sql_query($sql);
        //보유 포인트 차감
        insert_point($member['mb_id'], -($cp_price), '타입:'.$_REQUEST['car_date_type'].'member:'.$idx.' 포인트로 모두 결제했습니다.');
        //insert_use_point($member['mb_id'], $cp_price);
    }else{
        insert_point($member['mb_id'], -($cp_price), '타입:'.$_REQUEST['car_date_type'].'member:'.$idx.' 포인트를 일부사용 결제했습니다.');
        $res['type'] = "NORMAL";
    }
    $res['sq'] = $sql_re;
    $res['idx'] = $idx;
    $res['result_sql'] = $result_sql;
    echo json_encode($res);


}elseif ($mode == 'car_wash_cancel'){

    $result =  service_step('3');
    echo $result;

}elseif ($mode == 'go_car_del'){

    $sql = "select * from {$g5['car_table']} where gc_idx = '{$_REQUEST["idx"]}' ";
    $result = sql_query($sql);
    $car = sql_fetch_array($result);

    // 차랑번호가 같고 정기차량이고 매니저가 지정되어있고 취소상태가 아닌
    $sql = "select * from new_car_wash where car_no = '{$car['car_no']}' and  car_date_type = 2 and ma_id != '' and ma_step != 3";
    $result = sql_query($sql);

    $res['message'] = "";
    $res['success'] = true;

    if (sql_num_rows($result) > 0) {
        $res['message'] = "매니저가 배정 되어있어 삭제가 불가합니다. 차량정보 삭제를 원하실 경우 관리자에게 문의하시길 바랍니다.";
        $res['success'] = false;
    }else {
        $sql = "delete from {$g5['car_table']} where gc_idx = '{$_REQUEST["idx"]}'";
        sql_query($sql);

        @unlink(G5_DATA_PATH.'/file/car_photo/'. str_replace(" ", "", $_REQUEST['car_no']).'.jpg');
        //23.04.14 여기에 car_img 값있으면 그것도삭제해주게 wc
        @unlink(G5_DATA_PATH.'/file/car_photo/'.$_REQUEST['car_img']);

    }

    echo json_encode($res);
    die();


}elseif ($mode == 'go_car_update'){

    $table_name = $g5['car_table'];
    $table_idx = "gc_idx";
    $add = 'mb_id = "'.$member['mb_id'].'", ';
    $_REQUEST['car_no'] = str_replace(" ", "", $_REQUEST['car_no']);

    $car_no = $_REQUEST['car_no'];
    $car_type = $_REQUEST['car_type'];
    $car_color = $_REQUEST['car_color'];

    if ($car_no != "") {




        @mkdir(G5_DATA_PATH . '/file/car_photo', G5_DIR_PERMISSION);
        @chmod(G5_DATA_PATH . '/file/car_photo', G5_DIR_PERMISSION);

//        if ($_REQUEST['del_mb_icon'] == 1)
//            @unlink(G5_DATA_PATH.'/file/car_photo/'.str_replace(" ", "",$car_no).'.jpg');

        if ($_FILES['bf_file']['tmp_name'] != "" ) {

            $arr_name = explode('.', $_FILES['bf_file']['name']);
            $file_ext = array_pop($arr_name); //확장자 추출 (array_pop : 배열의 마지막 원소를 빼내어 반환)
            $check_ext = array('JPG', 'JPEG', 'PNG','jpg', 'jpeg', 'png'); //확장자 체크를 위한 선언부

            if (!in_array($file_ext, $check_ext)) {
                echo "허용되지 않는 확장자입니다";
                exit;
            }

            $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
            $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $_FILES['bf_file']['name']);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
            $upload = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

            $dest_file = G5_DATA_PATH.'/file/car_photo/'.$upload;


//    if ($file_width > $new_file_width) { //이미지 가로사이즈가 200보다 크면 사이즈 조절

            //23.04.14 한글 그냥그대로 파일올리는거 ;; ㄷㄷ  다뜯어고치는중.. wc
            //$dest_path = G5_DATA_PATH . '/file/car_photo/' .str_replace(" ", "", $_REQUEST['car_no']). '.jpg';

            //이미지 사이즈 조정
            $tmp_file = $_FILES['bf_file']['tmp_name'];
            move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);//      exit();

            // 23.04.14 올라간 파일의 퍼미션을 변경합니다. wc
            chmod($dest_file, G5_FILE_PERMISSION);
            $_REQUEST['car_img'] =  $upload;
//    }
        }
        $sql = "insert into {$g5['car_table']} set mb_id = '{$member['mb_id']}', car_no = '{$car_no}', car_img = '{$upload}', car_type = '{$car_type}', car_color = '{$car_color}',
            wr_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }

    //insert_query($table_name,$table_idx,$_REQUEST,$add);
    goto_url(G5_BBS_URL.'/my_car.php');

}elseif ($mode == "service_step"){

    $type = $_REQUEST['type'];
    $is = $_REQUEST['is_car_wash'];
    //완료 시 완료 카운터 추가
    $sql = "select * from {$g5['car_wash_table']} where cw_idx = '{$_REQUEST['idx']}' ";
    $complete = sql_fetch($sql);

    if ($type == 'cancel'){

        $result = service_step('3');
        $url = '/my_order_cancel.php';
    //작업완료 시
    }else if ($type == 'complete'){
        //재작업이 아닐 경우
        if ($is != "Y") {
            $complete_cnt = 0;
            //정기 세차일 경우만
            if ($complete["car_date_type"] < 3) {
                $complete_cnt = $complete['complete_cnt'] + 1;
                $result = insert_query("new_complete_history", "ch_idx", array("ch_datetime" => G5_TIME_YMDHIS, "cw_idx" => $_REQUEST['idx'], "ma_id" => $complete["ma_id"], "mb_id" => $complete["mb_id"], "total_cnt" => $complete_cnt));
            }


            //23.04.24 작업완료하면 정산 진행으로 바꿔주는부분 wc
            $sql = "update {$g5['car_wash_table']} set ma_step = 1 where cw_idx = '{$_REQUEST['idx']}'";
            $result = sql_query($sql);


            $result = service_step('2',$complete_cnt);
        //재작업일 경우 re_car_wash 스텝 변경해줌.(재작업일 경우 원래 작업은 완료상태)
        }else{
            //재작업일떄 2번째 컬럼cw_idx -> rw_idx로 바꿈 wc
            $sql = "update new_re_car_wash 
                    set is_turn_yn = 'N',rw_step = 2,rw_complete_cnt = {$complete["complete_cnt"]} ,
                        complete_datetime = '" . G5_TIME_YMDHIS . "' 
                    where cw_idx = '{$_REQUEST['idx']}' ORDER BY rw_idx DESC LIMIT 1";
            $result = sql_query($sql);

            //기존꺼.. 오류있어서 바꿈 위에껄로
            //$result = update_query("new_re_car_wash",'rw_idx',array("rw_step" => '2',"cw_idx" => $_REQUEST['idx'],"rw_idx" => $_REQUEST['rw_idx'],"update_yn" => 'N',"rw_complete_cnt" => $complete["complete_cnt"] ,"complete_datetime" => G5_TIME_YMDHIS) );
            //재작업일떄 횟수안건들여주고 스텝만바꿈
            $result = update_query($g5['car_wash_table'],'cw_idx',array("cw_step" => 2 ,"cw_idx" => $_REQUEST['idx'],"complete_datetime" => G5_TIME_YMDHIS ));

        }


		$sql_2 = "select * from `new_car_wash` where `cw_idx` = '$_REQUEST[idx]'";
		$row = sql_fetch($sql_2);

		$push_re = send_fcm($row[mb_id],"","세차가 완료되었습니다. 상세한 작업내역은 마이페이지에서 확인하실 수 있습니다.");

        //$url = '/my_order_end.php?filter='.$complete["car_date_type"];
        $url = '/my_order.php?filter='.$complete["car_date_type"];
    //완료취소 시
    }else if ($type == 'ing'){

        if ($is != "Y") {
            //정기 세차일 경우만
            if ($complete["car_date_type"] < 3) {

                $complete_cnt = $complete['complete_cnt'] - 1;
                //완료 취소 할 경우 기록을 위해 히스토리에도 완료 카운트 마이너스
                //$sql = "update new_complete_history set total_cnt = total_cnt-1, update_yn = 'Y' where ch_datetime = '{$complete['complete_datetime']}' and ma_id = '{$complete['ma_id']}' ";
                // 23.04.19 아래꺼로바꿔줌
                $sql = "update new_complete_history set update_yn = 'Y' where cw_idx = '{$_REQUEST['idx']}' and ma_id = '{$complete['ma_id']}' ORDER BY ch_idx DESC LIMIT 1";
                sql_query($sql);
            }

            //exit($sql);
            //23.04.24 작업취소 하면 정산 취소로 바꿔주는부분 wc
            $sql = "update {$g5['car_wash_table']} set ma_step = 3 where cw_idx = '{$_REQUEST['idx']}'";
            $result = sql_query($sql);


            //23.05.08 취소시 날짜 최근꺼중 완료된거 가져오기
            $sql = "select * from new_complete_history where update_yn = 'Y' and cw_idx = '{$_REQUEST['idx']}' and ma_id = '{$complete['ma_id']}' ORDER BY ch_idx DESC LIMIT 1";
            $result = sql_fetch($sql);
            $result_datetime = $result['complete_datetime'];


            //23.05.08 취소시 날짜 최근꺼중에 업데이트 update_yn n인거 날짜로 적어주기 wc
            $result = update_query($g5['car_wash_table'],'cw_idx',array("cw_step" => 1 ,"cw_idx" => $_REQUEST['idx'],"complete_datetime" => $result_datetime,"complete_cnt" => $complete_cnt ));
            //완료 취소 할 경우 완료 카운트 마이너스
            //$result = service_step('1',$complete_cnt);
        }else{
            $complete_cnt = $complete['complete_cnt'] - 1;
            //재작업일떄 2번째 컬럼cw_idx -> rw_idx로 바꿈 wc
            //$result = update_query("new_re_car_wash",'rw_idx',array("rw_step" => '1',"cw_idx" => $_REQUEST['idx'],"rw_idx" => $_REQUEST['rw_idx'],"complete_datetime" => "") );
            //23.05.08 취소시 날짜 최근꺼중 완료된거 가져오기
            $sql = "select * from new_complete_history where update_yn = 'Y' and cw_idx = '{$_REQUEST['idx']}' and ma_id = '{$complete['ma_id']}' ORDER BY ch_idx DESC LIMIT 1";
            $result = sql_fetch($sql);
            $result_datetime = $result['complete_datetime'];

            $sql = "update new_re_car_wash set complete_datetime = '{$result_datetime}',is_turn_yn = 'Y',rw_step = 1,rw_complete_cnt = {$complete["complete_cnt"]} where cw_idx = '{$_REQUEST['idx']}' ORDER BY rw_idx DESC LIMIT 1";
            $result = sql_query($sql);


            //23.05.08 취소시 날짜 최근꺼중에 업데이트 update_yn n인거 날짜로 적어주기 wc
            $result = update_query($g5['car_wash_table'],'cw_idx',array("cw_step" => 1  ,"cw_idx" => $_REQUEST['idx'],"complete_datetime" => $result_datetime));
            //$result = service_step('1',$complete_cnt);
        }
        $url = '/my_order.php?filter='.$complete["car_date_type"];

    }

    die(json_encode(array('result'=>$result, 'url'=> $url, "push_re"=>$push_re)));
}elseif ($mode == "cu_service_form"){

    $pay = $cu_money_list[$_REQUEST['cu_building']."".$_REQUEST['cu_type']];

    $final_pay = $_REQUEST['cu_width'] * $pay;

    if ($_REQUEST['cu_building'] == 3 && $_REQUEST['cu_type'] == 1 ){
        if ($_REQUEST['cu_width'] <= 20){
            $final_pay = '200000';
        }
    }

    $add = "mb_id = '{$member['mb_id']}',";
    $add .= "final_pay = '{$final_pay}',";

    $result = insert_query($g5['cleanup_table'],'cu_idx',$_REQUEST,$add);

    //print_r($_REQUEST);
   // exit;

    goto_url(G5_BBS_URL."/my_service_clean_ok.php?idx=".$result);

}elseif ($mode == "review_update"){

    $bo_table = $g5['review_table'];
    $idx = $_REQUEST['cw_idx'];
    @mkdir(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);

    $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
    // 가변 파일 업로드
    $file_upload_msg = '';
    $upload = array();

    for ($i = 0; $i < count($_FILES['bf_file']['name']); $i++) {
        $upload[$i]['file'] = '';
        $upload[$i]['source'] = '';
        $upload[$i]['filesize'] = 0;
        $upload[$i]['image'] = array();
        $upload[$i]['image'][0] = '';
        $upload[$i]['image'][1] = '';
        $upload[$i]['image'][2] = '';

        $tmp_file = $_FILES['bf_file']['tmp_name'][$i];
        $filesize = $_FILES['bf_file']['size'][$i];
        $filename = $_FILES['bf_file']['name'][$i];
        $filename = get_safe_filename($filename);


        if (is_uploaded_file($tmp_file)) {

            //=================================================================\
            // 090714
            // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
            // 에러메세지는 출력하지 않는다.
            //-----------------------------------------------------------------
            $timg = @getimagesize($tmp_file);
            // image type
            if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
                preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
                if ($timg['2'] < 1 || $timg['2'] > 16)
                    continue;
            }
            //=================================================================

            $upload[$i]['image'] = $timg;

            // 프로그램 원래 파일명
            $upload[$i]['source'] = $filename;
            $upload[$i]['filesize'] = $filesize;

            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
            $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
            $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);

            $dest_file = G5_DATA_PATH . '/file/' . $bo_table . '/' . $upload[$i]['file'];

            //이미지 크기조정
            size_image($_FILES['bf_file'], 400, 400, $dest_file, 'multi', $i);
            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
//        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);
        }
    }

    for ($i = 0; $i < count($upload); $i++) {

        $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$idx}',
                         bf_no = '{$i}',
                         bf_source = '{$upload[$i]['source']}',
                         bf_file = '{$upload[$i]['file']}',
                         bf_content = '{$bf_content[$i]}',
                         bf_download = 0,
                         bf_filesize = '{$upload[$i]['filesize']}',
                         bf_width = '{$upload[$i]['image']['0']}',
                         bf_height = '{$upload[$i]['image']['1']}',
                         bf_type = '{$upload[$i]['image']['2']}',
                         bf_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);

    }

    $result = insert_query($g5['review_table'],'re_idx',$_REQUEST);

    //$sql = "update {$g5['car_wash_table']} set review_datetime = '" . G5_TIME_YMDHIS . "' where cw_idx = $idx";
    //$result = sql_query($sql);

    return $result;
}elseif ($mode == "company_car_wash_form"){

    $bo_table = 'new_company_car_wash';
    $_REQUEST['cc_hp'] = str_replace('-', '', $_REQUEST['cc_hp']);

    if ($_REQUEST['cc_in_yn'] == "" ){
        $_REQUEST['cc_in_yn'] = "N";
    }

    $result = insert_query($bo_table,'cc_idx',$_REQUEST);
    echo $result;



}elseif ($mode == "car_re_wash"){

    $bo_table = 're_car_wash';

//    $sql = "select rw_idx from new_{$bo_table} where cw_idx = '{$_REQUEST["cw_idx"]}' ";
//    $cnt_result = sql_fetch($sql);

    //데이터 있으면 업뎃
//    if ($cnt_result['rw_idx'] == ""){
    $result = insert_query('new_'.$bo_table,'rw_idx',$_REQUEST);
     update_query('new_car_wash','cw_idx',array("cw_idx" => $_REQUEST["cw_idx"], "rw_idx" => $result ));

//    }else{
//         update_query('new_'.$bo_table,'rw_idx',array("is_turn_yn" => "N","rw_reason" => $_REQUEST["rw_reason"],"rw_idx"=>$cnt_result['rw_idx'],"rw_complete_cnt" => $_REQUEST["rw_complete_cnt"],"complete_datetime" => G5_TIME_YMDHIS));
//        $result = $cnt_result['rw_idx'];
//    }
//



    @mkdir(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    //idx 임시생성
    $idx = $result;


    for ($i = 0; $i < count($_FILES['bf_file']['name']); $i++) {

        $upload[$i]['file'] = '';
        $upload[$i]['source'] = '';
        $upload[$i]['filesize'] = 0;
        $upload[$i]['image'] = array();
        $upload[$i]['image'][0] = '';
        $upload[$i]['image'][1] = '';
        $upload[$i]['image'][2] = '';

        $tmp_name = $_FILES['bf_file']['tmp_name'][$i];
        $filesize = $_FILES['bf_file']['size'][$i];
        $filename = $_FILES['bf_file']['name'][$i];
        $filename = get_safe_filename($filename);


        if (is_uploaded_file($tmp_name)) {


            //=================================================================\
            // 090714
            // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
            // 에러메세지는 출력하지 않는다.
            //-----------------------------------------------------------------
            $timg = @getimagesize($tmp_name);
            // image type
            if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
                preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
                if ($timg['2'] < 1 || $timg['2'] > 16)
                    continue;
            }
            //=================================================================

            $upload[$i]['image'] = $timg;

            // 프로그램 원래 파일명
            $upload[$i]['source'] = $filename;
            $upload[$i]['filesize'] = $filesize;

            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
            $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
            $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);

            $dest_file = G5_DATA_PATH . '/file/' . $bo_table . '/' . $upload[$i]['file'];

            //이미지 크기조정
//            size_image($_FILES['bf_file'], 400, 400, $dest_file, 'multi', $i);
            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
            $tmp_file = $tmp_name;

            $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);
        }
    }

    for ($i = 0; $i < count($upload); $i++) {

        $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$idx}',
                         bf_no = '{$i}',
                         bf_source = '{$upload[$i]['source']}',
                         bf_file = '{$upload[$i]['file']}',
                         bf_content = '{$bf_content[$i]}',
                         bf_download = 0,
                         bf_filesize = '{$upload[$i]['filesize']}',
                         bf_width = '{$upload[$i]['image']['0']}',
                         bf_height = '{$upload[$i]['image']['1']}',
                         bf_type = '{$upload[$i]['image']['2']}',
                         bf_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);

    }

    echo $result;

}elseif ($mode == "call_req"){

    $result = update_query("new_car_wash",'cw_idx',array("call_req" => 'Y',"cw_idx" => $_REQUEST['idx']));

    echo $result;


}else if($mode == 'manager_parking_image'){

    $tmp_file = $_FILES['image']['tmp_name'];
    $filesize = $_FILES['image']['size'];
    $filename = $_FILES['image']['name'];
    $filename = get_safe_filename($filename);


    if (is_uploaded_file($tmp_file)) {


        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
            preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
            return false;
        }
        //=================================================================


        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);

        $dest_file = G5_DATA_PATH . '/file/car_wash/' . $upload['file'];
        $upload['image'] = $timg;

        //이미지 크기조정
//        size_image($_FILES['bf_file'], 400, 400, $dest_file, 'multi', $i);
        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['image']['error']);
        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $sql = "select bf_no from {$g5['board_file_table']} where bo_table = 'car_wash' and wr_id = '{$_REQUEST['idx']}' order by bf_no desc limit 1";
        $bf_no = sql_fetch($sql)['bf_no'];

        if ($error_code == "1") {
            $sql = " insert into {$g5['board_file_table']}
                    set bo_table = 'car_wash',
                         wr_id = '{$_REQUEST['idx']}',
                         bf_no = '" . ($bf_no + 1) . "',
                         bf_source = '{$_FILES['image']['name']}',
                         bf_file = '{$upload['file']}',
                         bf_download = 0,
                         bf_filesize = '{$filesize}',
                         bf_width = '{$upload['image']['0']}',
                         bf_height = '{$upload['image']['1']}',
                         bf_type = '{$upload['image']['2']}',
                         ma_id = '{$member['mb_id']}',
                         bf_datetime = '" . G5_TIME_YMDHIS . "' ";
            sql_query($sql);

            alert("주차구역사진이 추가되었습니다.",G5_BBS_URL.'/my_order_view?idx='.$_REQUEST['idx']);

        }else{
            alert("오류입니다. 다시 시도 해주세요.",G5_BBS_URL.'/my_order_view?idx='.$_REQUEST['idx']);
        }

    }

}else if($mode == 'manager_image_del'){

    $sql = "delete from {$g5['board_file_table']} where bf_file = '{$_REQUEST['file']}' ";
    $result = sql_query($sql);

    @unlink(G5_DATA_PATH.'/file/car_wash/'.$_REQUEST['file']);

    echo $result;

}else if($mode == 'mb_2_chk'){

    $sql = "select * from g5_member where mb_id = '{$_REQUEST['val']}' ";
    $result = sql_query($sql);
    $row = sql_fetch($sql);

    if (sql_num_rows($result) > 0){
        die( "추천인: ".$row['mb_id']. " 이 맞습니까?");
    }else{
        die ('not_member');
    }

}else if($mode == 'go_car_dup'){

    $where = "";
    if ($_REQUEST['type'] == "mb_id"){
        $where = "mb_id != '{$member['mb_id']}' and";
    }
    $sql = "select count(*) cnt from new_gogac_car where {$where} car_no = '".str_replace( ' ' , '',$_REQUEST["car_no"])."' ";
    $result = sql_fetch($sql);

    echo $result['cnt'];

} else if($mode == "add_fcm"){

	set_session("fcm_token",$regId);

	$sql = "select * from `member_gcm` where `RegID` = '$regId' and `mb_id` = '$mb_id'";
	$row = sql_fetch($sql);

	if($row == null){
		$sql = "insert into `member_gcm` set
					`mb_id` = '$mb_id',
					`RegID` = '$regId',
					`app_type` = '$app_type'";

		sql_query($sql);
	} else {

	}


}