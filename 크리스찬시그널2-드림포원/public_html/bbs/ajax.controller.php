<?php
include_once('./_common.php');

$mode = $_REQUEST["mode"];
$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
if ($mode == "my_profile01"){

    $mb_id = $_REQUEST['mb_id'];
    $idx = $_REQUEST["idx"];

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'mh_') === 0) {

                if ($key != "mh_style_memo" && $key != "mh_job_memo"&& $key != "mh_hope_content") {
                    $comma_text = "";
                    for ($i = 0; $i < count($value); $i++) {
                        $comma_text .= "," . $value[$i];
                    }
                    $comma_text = substr($comma_text, 1);

                }else{
                    $comma_text = $value;

                }

                $sql_common .= $key . "='" . $comma_text . "',";
        }
    }

    if ($idx == "") {
        $sql = "insert into g5_member_hope set " . $sql_common . " mb_id = '{$mb_id}' ,wr_datetime = '" . G5_TIME_YMDHIS . "'";

        sql_query($sql);
        $idx = sql_insert_id();
    }else{
        $sql = "update g5_member_hope set ".$sql_common." mb_id = '{$mb_id}' where idx = '{$idx}' ";
        sql_query($sql);
    }


    $sql = "update g5_member set mb_join_type = '{$_REQUEST["mb_join_type"]}' where mb_id = '{$mb_id}' ";
    sql_query($sql);


    if ($idx != 0){
        goto_url(G5_BBS_URL . "/" . $_REQUEST["page"] . "?mb_id=".$mb_id);
    }else{
        alert("실패했습니다. 다시시도해주세요.");
    }

}elseif ($mode == "my_profile02"){


    $mb_id = $_REQUEST['mb_id'];
    $idx = $_REQUEST["idx"];
    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'mi_') === 0) {

            $sql_common .= $key . "='" . $value . "',";
        }
    }

    if ($_REQUEST["mi_church_open"] == ""){
        $sql_common .= " mi_church_open='',";
    }
    if ($idx == "") {
        $sql = "insert into new_member_interview set " . $sql_common . " mb_id = '{$mb_id}' ,wr_datetime = '" . G5_TIME_YMDHIS . "'";
        sql_query($sql);
        $idx = sql_insert_id();
    }else{
        $sql = "update new_member_interview set ".$sql_common." mb_id = '{$mb_id}' where idx = '{$idx}' ";
        sql_query($sql);

    }


    if ($idx != 0){
        goto_url(G5_BBS_URL . "/" . $_REQUEST["page"] . "?mb_id=".$mb_id);
    }else{
        alert("실패했습니다. 다시시도해주세요.");
    }


}elseif ($mode == "my_profile03"){


    $mb_id = $_REQUEST['mb_id'];
    $mb = get_member($mb_id);

    // 취미/관심사
    $sql = "delete from g5_member_hobby where mb_no = '{$mb["mb_no"]}' ";
    sql_query($sql);

    if(!empty($_POST['hobby_code'])) {
        $code = explode(',', $_POST['hobby_code']);

        for($i=0; $i<count($code); $i++) {
            $hobby_code = explode('_', $code[$i]);
            if($hobby_code[0] == 'hobby') $code_name = "취미";
            if($hobby_code[0] == 'exercise') $code_name = "운동";
            if($hobby_code[0] == 'movie') $code_name = "영화";
            if($hobby_code[0] == 'music') $code_name = "음악";
            if($hobby_code[0] == 'tv') $code_name = "TV";

            sql_query(" insert into g5_member_hobby set mb_no = '{$mb["mb_no"]}', co_code = '{$hobby_code[1]}', co_code_name = '{$code_name}' ");
        }
    }

    $sql = "update g5_member set ";

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'mb_') === 0) {
            if ($key != "mb_id") {
                $sql .= $key . "='" . $value . "',";
            }
        }
    }

    $sql .=" mb_nick_date = '".G5_TIME_YMD."' ";
    $sql .=" where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    $sql = "update new_member_interview set ";

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'mi_') === 0) {

            $sql .= $key . "='" . $value . "',";
        }
    }

    $sql .= "mb_id = '{$mb_id}' where mb_id = '{$mb_id}' ";
    sql_query($sql);

    if ($result == 1){
        goto_url(G5_BBS_URL . "/" . $_REQUEST["page"] . "?mb_id=".$mb_id);
    }else{
        alert("실패했습니다. 다시시도해주세요.");
    }


}elseif ($mode == "my_profile04"){


// 파일 삭제
    $del_mb_img = explode(',', $_POST['del_mb_img']);
    for($i = 0; $i < count($del_mb_img); $i++) {
        $sql = " select * from g5_member_img where idx = {$del_mb_img[$i]} ";
        $row = sql_fetch($sql);

        unlink(G5_DATA_PATH . '/file/member/' . $row['img_file']);

        $sql = " delete from g5_member_img where idx = {$del_mb_img[$i]} ";
        sql_query($sql);
    }

// 파일 등록
//print_r($_REQUEST);
//print_r($_FILES);exit;
    for ($i = 0; $i < count($_FILES['mb_img']['name']); $i++) {
        $upload[$i]['file'] = '';
        $upload[$i]['source'] = '';
        $upload[$i]['filesize'] = 0;
        $upload[$i]['image'] = array();
        $upload[$i]['image'][0] = '';
        $upload[$i]['image'][1] = '';
        $upload[$i]['image'][2] = '';

        $tmp_file = $_FILES['mb_img']['tmp_name'][$i];
        $filesize = $_FILES['mb_img']['size'][$i];
        $filename = $_FILES['mb_img']['name'][$i];
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
            $dest_file = G5_DATA_PATH . '/file/member/' . $upload[$i]['file'];

            //이미지 크기조정
            //size_image($_FILES['file'], 200, 200, $dest_file, 'multi', $i);

            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
            $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_img']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);

            // 대표사진 변경 시
            $sql_add = '';
            if(isset($_REQUEST['img_idx_1']) && empty($_REQUEST['img_idx_1']) && $i == 0) {
                $sql_add = " , thumb = 'Y' ";
            }

            $sql = " insert into g5_member_img set mb_no = '{$mb_no}', img_source = '{$upload[$i]['source']}', img_file = '{$upload[$i]['file']}', 
                                               img_filesize = '{$upload[$i]['filesize']}', img_width = '{$upload[$i]['image']['0']}', img_height = '{$upload[$i]['image']['1']}', 
                                               img_type = '{$upload[$i]['image']['2']}', img_datetime = '" . G5_TIME_YMDHIS . "' {$sql_add} ";
            sql_query($sql);
        }
    }
    $sql = "update g5_member set mb_9 = 'N' where mb_no = '{$mb_no}'";
    sql_query($sql);
    die('success');

}elseif ($mode == "my_profile05"){

    $sql = "update g5_member set ";

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'mb_') === 0) {

            $sql .= $key . "='" . $value . "',";
        }
    }

    $sql .= "mb_id = '{$mb_id}' where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    if ($result == 1){
        goto_url(G5_BBS_URL . "/" . $_REQUEST["page"] . "?mb_id=".$mb_id);
    }else{
        alert("실패했습니다. 다시시도해주세요.");
    }

}elseif ($mode == "my_profile06"){
/*
    $point_add = 240;
    $acc_point = $member['cw_point'] + 240;
    $point_content = '서류제출 만나적립';

    $mb_id = $member["mb_id"];

    $sql = "select count(*) cnt from g5_member_point where profile_name = '서류제출' and mb_id = '{$mb_id}' ";
    $cnt =sql_fetch($sql)["cnt"];

    if ($cnt == 0) {
        // 회원 포인트 업데이트
        $sql = " update g5_member set cw_point = cw_point + {$point_add}, acc_cw_point = acc_cw_point + {$point_add} where mb_id = '{$mb_id}' ";
        $result = sql_query($sql);

        // 회원 포인트 이력
        $sql = " insert into g5_member_point set profile_name = '서류제출',mb_id = '{$mb_id}', point_category = '적립',
            point = {$point_add}, acc_point = {$acc_point}, point_content = '{$point_content}', wr_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }
*/
    goto_url(G5_BBS_URL . "/" . $_REQUEST["page"] . "?mb_id=".$mb_id);


}elseif ($mode == "section_manna"){


    $mb_no = $_POST['mb_no'];


    // 21.05.06 프로필 정보 볼 경우 80만나 차감
    $mb = sql_fetch(" select * from g5_member where mb_no = {$mb_no}; "); // 프로필사진 회원정보
    $mb_id = $member['mb_id'];

    //기본포인트 80으로 설정 --> 23.10.24 array로빼줌 만나 wc
    $point_wc = $manna_arr['education'];

    //23.04.04 나의정보는 50만나로 변경 --> 23.10.24 array로빼줌 만나 wc
    if($_REQUEST['section'] == "나의정보"){
        $point_wc = $manna_arr['myprofile'];
    }

    $acc_point = $member['cw_point'] - $point_wc;
    $point_content = $mb['mb_nick'] ." ".$_REQUEST['section'].' 조회';


    //학벌/연봉/재산정보일 경우 사용자에게 승인요청
    if ($_REQUEST['section'] == "학벌/연봉/재산정보") {
        $sql = "select count(*) cnt from new_info_question where want_mb_no = '{$mb_no}' and wonder_mb_no = '{$member['mb_no']}' ";

        $cnt = sql_fetch($sql)["cnt"];
        if ($cnt > 0){
            die('이미 신청한 내역이 있습니다.');
        }
        if($member['cw_point'] < $point_wc) {
            die('만나가 부족합니다.');
        }

        $sql = "insert into new_info_question set want_mb_no = '{$mb_no}', wonder_mb_no = '{$member["mb_no"]}', wr_datetime = '" . G5_TIME_YMDHIS . "', iq_yn='W' ";
        $result = sql_query($sql);

        // 23.11.16 푸시
        if($mb['alarm'] == 'ON') {
            $sql = " select * from g5_fcm where mb_id = '{$mb['mb_id']}' ";
            $fRow = sql_fetch($sql);
            $tokens = array($fRow[token]);
            $message = array(
                "subject"=>"크리스찬시그널",
                "message"=>"학벌/연봉/재산정보 열람신청이 되었습니다.",
                "goUrl"=>"",
            );
            $fcm=sendFcm($tokens, $message);
            $fcm=sendFcmIOS($tokens, $message);
        }

    }

    // 포인트 없을 시 조회 불가
    //23.04.04 나의정보는 50만나로 변경 변수로 다관리함
    if($member['cw_point'] < $point_wc) {
        die('만나가 부족합니다.');
    }






// 회원 포인트 이력
    $sql = " insert into g5_member_point set profile_name = '{$_REQUEST['section']}',mb_id = '{$mb_id}', point_category = '차감', point = {$point_wc}, acc_point = {$acc_point}, point_content = '{$point_content}', wr_datetime = '".G5_TIME_YMDHIS."', rel_mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);

// 회원 포인트 업데이트
    $sql = " update g5_member set cw_point = cw_point - {$point_wc} where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

//장바구니 회원에 추가
    $sql = " select count(*) as count from g5_member_cart where mb_no = '{$member['mb_no']}' and cart_mb_no = '{$mb_no}' ";
    $count = sql_fetch($sql)['count'];

    if($count == 0) {

        $sql = "insert into g5_member_cart set mb_no = '{$member["mb_no"]}',cart_mb_no = '{$mb_no}', wr_datetime= '".G5_TIME_YMDHIS."' ";
        sql_query($sql);

    }


    if($result) { die('success'); }

}elseif ($mode == "section_manna_check"){
    $mb = sql_fetch(" select * from g5_member where mb_no = {$_REQUEST["mb_no"]}; "); // 프로필사진 회원정보

    $sql = "select count(*) cnt from g5_member_point where profile_name = '{$_REQUEST['section']}' and rel_mb_id = '{$mb["mb_id"]}' and mb_id = '{$member['mb_id']}' ";
    $cnt = sql_fetch($sql)["cnt"];

    if ($_REQUEST['section'] == "학벌/연봉/재산정보" && $cnt > 0){

        $sql = "select iq_yn from new_info_question where wonder_mb_no = '{$member['mb_no']}' and want_mb_no = '{$mb["mb_no"]}' ";
        $yn = sql_fetch($sql)["iq_yn"];

        if ($yn == "Y"){
            die('success');
        }else if ($yn == "N"){
            die('info_n');
        }else{
            die('info_w');
        }
    }

    if ($cnt > 0){
        die('success');
    }else{
        die('fail');
    }

}elseif ($mode == "section_minus"){

    $mb_no = $_POST['mb_no'];

    $mb = sql_fetch(" select * from g5_member where mb_no = {$mb_no}; "); // 프로필사진 회원정보
    $mb_id = $member['mb_id'];
    $acc_point = $member['cw_section_cnt'] - 1;

    $point_content = $mb['mb_nick'] ." ".$_REQUEST['section'].' 섹션횟수로 조회';


    if($member['cw_point'] < 1) {
        die('fail');
    }

// 회원 포인트 이력
    $sql = " insert into g5_member_point set profile_name = '{$_REQUEST['section']}',mb_id = '{$mb_id}', point_category = '섹션차감', point = 1, acc_point = {$acc_point}, point_content = '{$point_content}', wr_datetime = '".G5_TIME_YMDHIS."', rel_mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);

// 회원 포인트 업데이트
    $sql = " update g5_member set cw_section_cnt = cw_section_cnt - 1 where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    if($result) { die('success'); }

}elseif ($mode == "attend_check") {
    $mb_id = $member["mb_id"];
    $sql = "select * from new_attend_check where mb_id = '{$mb_id}' order by ac_idx desc limit 1";
    $ac = sql_fetch($sql);
    $day = $ac["ac_day"] + 1;

    //같은날 체크 X
    if (date("Y-m-d",strtotime($ac["wr_datetime"])) == G5_TIME_YMD ){
        die(json_encode(array("result" => "chk_no")));
    }

    //연달아 출석안하면 1일차로 돌아가기, 7일 넘으면 다시 1일차부터
    if (date("Y-m-d",strtotime($ac["wr_datetime"]."+1 days")) != G5_TIME_YMD || $day > 7 ){
        $day = 1;
    }

    if ($day == "7"){
        $point_add = 60;
    }else{
        $point_add = 30;
    }

    $acc_point = $member['cw_point'] + $point_add;
    $point_content = '출석체크 '.$day."일차";


    // 회원 포인트 업데이트
    $sql = " update g5_member set cw_point = cw_point + {$point_add}, acc_cw_point = acc_cw_point + {$point_add} where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    $sql = " insert into new_attend_check set ac_day = '{$day}',
                                            mb_id = '{$mb_id}',
                                             wr_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
    $idx = sql_insert_id();

    // 회원 포인트 이력
    $sql = " insert into g5_member_point set profile_name = '출석체크',mb_id = '{$mb_id}', point_category = '적립',
            point = {$point_add}, acc_point = {$acc_point}, point_content = '{$point_content}', wr_datetime = '".G5_TIME_YMDHIS."', rel_idx = '{$idx}', rel_table = 'new_attend_check' ";
    sql_query($sql);

    die(json_encode(array(
        "result" => "success",
        "day" => $day
    )));


}elseif ($mode== "req_info"){

    $sql = "update new_info_question set iq_yn = '{$_REQUEST["req"]}' where iq_idx = '{$_REQUEST["idx"]}' ";
    $result = sql_query($sql);

    if ($_REQUEST["req"] == "N") {
        $section = "학벌/연봉/재산정보";
        $point_add = 80;
        $mb = get_member_no($_REQUEST["wonder_mb_no"]);

        $acc_point = $mb['cw_point'] + $point_add;
        $point_content = $member["mb_nick"] . " " . $section . " 열람 거절";


        // 회원 포인트 업데이트
        $sql = " update g5_member set cw_point = cw_point + {$point_add}, acc_cw_point = acc_cw_point + {$point_add} where mb_id = '{$mb["mb_id"]}' ";
        $result = sql_query($sql);

        // 회원 포인트 이력
        $sql = " insert into g5_member_point set profile_name = '{$section}',mb_id = '{$mb["mb_id"]}', point_category = '적립',
            point = {$point_add}, acc_point = {$acc_point}, point_content = '{$point_content}', wr_datetime = '" . G5_TIME_YMDHIS . "', rel_idx = '{$_REQUEST["idx"]}', rel_table = 'new_info_question' ";
        sql_query($sql);
    }

    echo $result;

}elseif ($mode == "cart_in"){

    $mb_no = $_REQUEST['mb_no'];

    $sql = " select count(*) as count from g5_member_cart where mb_no = '{$member['mb_no']}' and cart_mb_no = '{$mb_no}' ";
    $count = sql_fetch($sql)['count'];

    if($count > 0) {
        die('fail');
    } else {
        $sql = "insert into g5_member_cart set mb_no = '{$member["mb_no"]}',cart_mb_no = '{$_REQUEST["mb_no"]}', wr_datetime= '".G5_TIME_YMDHIS."' ";
        $result = sql_query($sql);

        die('success');
    }
}elseif ($mode == "cart_out"){
    $love_mb_no = explode(',',$_POST['del_member']);

    for($i=0; $i<count($love_mb_no); $i++) {
        sql_query(" delete from g5_member_cart where cart_mb_no = '{$love_mb_no[$i]}' ");
    }

    die('success');
}elseif ($mode == "member_out_res"){

    if ($member["mb_8"] > 0){
        die('이미 탈퇴신청을 하셨습니다. 관리자 승인 후 탈퇴가 완료됩니다.');
    }

    $sql = "update g5_member set mb_8 = '1' where mb_no = '{$member["mb_no"]}' ";
    sql_query($sql);

    die('success');


}elseif ($mode == "adm_profile"){

    $sql = "insert into new_adm_profile set ap_content = '{$_REQUEST["ap_content"]}', mb_id = '{$member["mb_id"]}', wr_datetime = '".G5_TIME_YMDHIS."' ";
    $result = sql_query($sql);
    $idx = sql_insert_id();
// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
    @mkdir(G5_DATA_PATH.'/file/adm_apply/', G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.'/file/adm_apply/', G5_DIR_PERMISSION);

    for ($i = 0; $i < count($_FILES['mb_img']['name']); $i++) {
        $upload[$i]['file'] = '';
        $upload[$i]['source'] = '';
        $upload[$i]['filesize'] = 0;
        $upload[$i]['image'] = array();
        $upload[$i]['image'][0] = '';
        $upload[$i]['image'][1] = '';
        $upload[$i]['image'][2] = '';

        $tmp_file = $_FILES['mb_img']['tmp_name'][$i];
        $filesize = $_FILES['mb_img']['size'][$i];
        $filename = $_FILES['mb_img']['name'][$i];
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
            $dest_file = G5_DATA_PATH . '/file/adm_apply/' . $upload[$i]['file'];

            //이미지 크기조정
            //size_image($_FILES['file'], 200, 200, $dest_file, 'multi', $i);

            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
            $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_img']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);

            $sql = " insert into {$g5['board_file_table']}
                    set bo_table = 'adm_apply',
                         wr_id = '{$idx}',
                         bf_no = '{$i}',
                         bf_source = '{$upload[$i]['source']}',
                         bf_file = '{$upload[$i]['file']}',
                         bf_content = '',
                         bf_download = 0,
                         bf_filesize = '{$upload[$i]['filesize']}',
                         bf_width = '{$upload[$i]['image']['0']}',
                         bf_height = '{$upload[$i]['image']['1']}',
                         bf_type = '{$upload[$i]['image']['2']}',
                         bf_datetime = '".G5_TIME_YMDHIS."' ";
            sql_query($sql);
        }
    }

    $sql = "update g5_member set mb_9 = 'N' where mb_no = '{$member['mb_no']}'";
    sql_query($sql);
    
    echo $result;
}elseif ($mode == "proc_change"){

    //완료 시 완료일자
    if ($_REQUEST["proc"] == 1) {
        $datetime = ',complete_datetime = "' . G5_TIME_YMDHIS . '" ';
    }

    $sql = "update new_adm_profile set ap_proc = '{$_REQUEST["proc"]}' where ap_idx = {$_REQUEST["idx"]} ";
    $result = sql_query($sql);

    if ($result == 1){
        echo $result;
    }else{
        die("실패했습니다. 새로고침 후 다시 시도해주세요.");
    }

}

