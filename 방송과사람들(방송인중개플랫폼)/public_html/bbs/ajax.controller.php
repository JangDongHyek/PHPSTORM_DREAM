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
    $sql .= "mb_no = '" . $member["mb_no"] . "', ";
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
}

if ($mode == "item_write03"){

    $idx = $_REQUEST['i_idx'];

    $_REQUEST['i_price'] = str_replace ( ',' , '', $_REQUEST['i_price']);
    $i_option_arr = "";
    for ($i = 0; $i < count($_POST['option_arr']); $i++) {
        $i_option_arr .= "," . $_POST['option_arr'][$i];
    }
    $i_option_arr = substr($i_option_arr, 1);
    $_REQUEST['i_option_arr'] = $i_option_arr;


    if ($idx == "") {
        $idx = insert_query($_REQUEST, 'new_item', 'i');
    }else{
        update_query($_REQUEST, 'new_item', 'i');
    }


    $bo_table = "main_img";
    $bo_table2 = "sub_img";

    @mkdir(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);

    @mkdir(G5_DATA_PATH . '/file/' . $bo_table2, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH . '/file/' . $bo_table2, G5_DIR_PERMISSION);

    $main_del_idx = explode(',',$_REQUEST['update_main_idx']);
    $sub_del_idx = explode(',',$_REQUEST['update_sub_idx']);;

    //idx 값이 있는데 하나만 삭제했을 경우 배열생성안되서 처리해줌.
    if ($main_del_idx != 0 && count($main_del_idx) == 0){
        $main_del_idx[0] = $_REQUEST['update_main_idx'];
    }

    if ($sub_del_idx != 0 && count($sub_del_idx) == 0){
        $sub_del_idx[0] = $_REQUEST['update_sub_idx'];
    }


    //기존 데이터 삭제
    for ($i = 0; $i < count($main_del_idx); $i++){
        $sql = " select bf_file,bo_table from {$g5['board_file_table']} where bo_table = '{$bo_table}' and bf_idx = '{$main_del_idx[$i]}' ";
        $img_row = sql_fetch($sql);
        @unlink(G5_DATA_PATH . '/file/' . $img_row['bo_table'] . '/' . $img_row['bf_file']);
        $sql = "delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and bf_idx = '{$main_del_idx[$i]}' ";
        sql_query($sql);
    }

    for ($i = 0; $i < count($sub_del_idx); $i++){
        $sql = " select bf_file,bo_table from {$g5['board_file_table']} where bo_table = '{$bo_table2}' and bf_idx = '{$sub_del_idx[$i]}' ";
        $img_row = sql_fetch($sql);
        @unlink(G5_DATA_PATH . '/file/' . $img_row['bo_table'] . '/' . $img_row['bf_file']);
        $sql = "delete from {$g5['board_file_table']} where bo_table = '{$bo_table2}' and bf_idx = '{$sub_del_idx[$i]}' ";
        sql_query($sql);
    }


    for ($a = 0; $a < 2; $a++) {
        if ($a == 0) {
            $_FILES['bf_file'] = $_FILES['files'];
            $bo_table = $bo_table;
        } else {
            $_FILES['bf_file'] = $_FILES['subfiles'];
            $bo_table = $bo_table2;
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
                $upload[$i]['file'] = $i."_".abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);

                $dest_file = G5_DATA_PATH . '/file/' . $bo_table . '/' . $upload[$i]['file'];

                //            $filename = compress_image($tmp_file, $dest_file, 70); //실제 파일용량 줄이는 부분
                //            list($width, $height, $type, $attr) = getImagesize($tmp_file);

                //이미지 크기조정
                move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_img']['error'][$i]);
                //size_image($_FILES['bf_file'], 700, 466, $dest_file, 'multi', $i);

                // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
                //        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

                // 올라간 파일의 퍼미션을 변경합니다.
                chmod($dest_file, G5_FILE_PERMISSION);
            }
        }

        for ($i = 0; $i < count($_FILES['bf_file']['name']); $i++) {

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
    }




   echo G5_BBS_URL."/item_list.php";



}elseif ($mode == "area_filter"){
    $html = "";

    for ($i = 1; $i <= count($option_arr[$_REQUEST['ctg']]); $i++) {
        $chk_arr = explode(',',$_REQUEST['chk_val']);
        $chk = "";
        for ($a = 0; $a < count($chk_arr); $a++){
            if ($chk_arr[$a] == $i ){
                $chk = "checked";
            }
        }

        $html .= '<li>
                <input type="checkbox" '.$chk.' id="filter0'.($i).'" value = "'.$i.'" name="option_arr[]">
                <label for="filter0'.($i).'">
                    <span></span>
                    <em>'.$option_arr[$_REQUEST['ctg']][$i].'</em>
                </label>
            </li>';
    }

    echo $html;

}else if ($mode == "heart_click"){

    if(!$is_member){
        die(json_encode(array('msg'=>"회원만 사용할 수 있는 기능입니다.", 'url'=> G5_BBS_URL.'/login.php')));
    }

    $idx = $_REQUEST['idx'];
    $sql = "select count(*) cnt from new_heart where h_p_idx = {$idx} and mb_no = '{$member['mb_no']}' ";
    $h_cnt = sql_fetch($sql)['cnt'];

    if ($h_cnt == 0 ){

        $sql = "insert into new_heart set h_p_idx = {$idx}, mb_no = '{$member['mb_no']}', wr_datetime = '".G5_TIME_YMDHIS."' ";
        $type = 'on';
    }else{
        $sql = "delete from new_heart where h_p_idx = {$idx} and mb_no = '{$member["mb_no"]}' ";
        $type = 'off';

    }

    $result = sql_query($sql);
    if ($result == 1){
        die(json_encode(array('msg'=>"success", 'type'=> $type)));
    }else{
        die(json_encode(array('msg'=>"실패했습니다. 다시 시도 해주세요.")));

    }
}else if($mode == 'mb_icon_update'){
    $mb_id = $member['mb_no'];

    // 회원 아이콘 삭제 후 넣기
    @unlink(G5_DATA_PATH.'/file/member/'.$mb_id.'.jpg');

    // 아이콘 업로드

    if (is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
        $mb_dir = substr($mb_id, 0, 2);

        // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
        @mkdir(G5_DATA_PATH.'/file/member/', G5_DIR_PERMISSION);
        @chmod(G5_DATA_PATH.'/file/member/', G5_DIR_PERMISSION);

        $arr_name = explode('.', $_FILES['mb_icon']['name']);
        $file_ext = array_pop($arr_name); //확장자 추출 (array_pop : 배열의 마지막 원소를 빼내어 반환)

        $file_type = $_FILES['mb_icon']['type'];
        $check_ext = array('jpg', 'jpeg', 'png','JPG', 'JPEG', 'PNG'); //확장자 체크를 위한 선언부


        if (!in_array($file_ext, $check_ext)) {
            echo "허용되지 않는 확장자입니다";
            exit;

        }
//    if ($file_width > $new_file_width) { //이미지 가로사이즈가 200보다 크면 사이즈 조절
        $dest_path = G5_DATA_PATH . '/file/member/' . $mb_id. '.jpg';
        move_uploaded_file($_FILES['mb_icon']['tmp_name'], $dest_path) or die($_FILES['mb_img']['error'][$i]);
//    }
        echo 'success';
    }

}else if ($mode  == "review_write"){

    $idx = insert_query($_REQUEST, 'new_review', 'r');
    if ($idx != 0) {
        echo "success";
    }

}else if($mode == "ctg_list2"){
    $arr = ctg_list($_REQUEST["c_p_idx"]);
    $html = "<select>";
    for ($i =0; $i < count($arr); $i++){
        $html .= '<option value="'.$arr[$i]["c_idx"].'">'.$arr[$i]["c_name"].'</option>';
    }
    $html .= "</select>";
    echo $html;

}else if($mode == "save_profile"){

    @mkdir(G5_DATA_PATH.'/file/portfolio/', G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.'/file/portfolio/', G5_DIR_PERMISSION);

    $targetDir = G5_DATA_PATH.'/file/portfolio/';

    var_dump($_REQUEST);

    $sql_c = "";
    for($i=1; $i<7; $i++){
        if (!empty($_FILES["file".$i]["name"])) {
            $realName = $_FILES["file".$i]["name"];
            $fileExtension = pathinfo($_FILES["file".$i]["name"], PATHINFO_EXTENSION);
            $fileName = uniqid() . "." . $fileExtension;
            $targetFile = $targetDir . $fileName;
            if (move_uploaded_file($_FILES["file".$i]["tmp_name"], $targetFile)) {
                $sql_c .= " , `file".$i."` = '$fileName' ";
                $sql_c .= " , `file_name".$i."` = '$realName' ";
            }
        } else {
            if($_POST["file_d".$i] == "t"){
                @unlink(G5_DATA_PATH.'/file/portfolio/'.$member['file'.$i]);
                $sql_c .= " , `file".$i."` = '' ";
                $sql_c .= " , `file_name".$i."` = '' ";
            }
        }


    }


    $sql = "update `g5_member` set
       `re_time` = '$re_time',
       `start_time_h` = '$start_time_h',
       `start_time_m` = '$start_time_m',
       `end_time_h`  = '$end_time_h',
       `end_time_m` = '$end_time_m',
       `mb_about` = '$mb_about',
       `mb_nick` = '$mb_nick',
       `mb_sex` = '$mb_sex',
       `mb_birth` = '$mb_birth',
       `mb_job` = '$mb_job',
       `mb_interest` = '$mb_interest',
       `mb_profile` = '$mb_profile'
       $sql_c
       where `mb_id` = '$member[mb_id]' ";
    sql_query($sql);

    echo $sql;

}