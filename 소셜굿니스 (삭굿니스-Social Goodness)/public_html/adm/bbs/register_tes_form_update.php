<?php
include_once('./_common.php');

@mkdir(G5_DATA_PATH . '/file/' . 'tes', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'tes', G5_DIR_PERMISSION);

$te_no = $_POST['te_no'];
$te_time = $_POST['te_start_hour'].$_POST['te_start_minute'].'~'.$_POST['te_end_hour'].$_POST['te_end_minute'];
$w = $_POST['w'];
$del_file = $_POST['del_file'];
$del_file = explode(',', $del_file);

//if(!$mb_id)
//    alert('올바른 방법으로 이용해 주십시오.', G5_URL);

if($w == '') { // 등록
    $sql_common = " mb_no = {$_SESSION['ss_mb_no']}, te_action = '등록', te_name = '{$_POST['te_name']}', te_tel = '{$_POST['te_tel']}', te_category = 'tes', ";
    $sql_common .= " te_time = '{$te_time}', te_state = '정상', te_reg_state = '등록 요청 중', te_reg_date = now(), te_address = '{$_POST['te_address']}', ";
    $sql_common .= " te_menu = '{$_POST['te_menu']}', te_latitude = '{$_POST['te_latitude']}', te_longitude = '{$_POST['te_longitude']}', ";
    $sql_common .= " te_payment_rate = '{$_POST['te_payment_rate']}', te_category_detail = '{$_POST['te_category_detail']}' ";

    $sql = " insert into g5_tes set {$sql_common} ";
    $result = sql_query($sql);
    $te_no = sql_insert_id();
}
else if($w == 'u') { // 수정
    $sql_common = " te_action = '수정', te_name = '{$_POST['te_name']}', te_tel = '{$_POST['te_tel']}', te_time = '{$te_time}', ";
    $sql_common .= " te_reg_state = '수정 요청 중', te_address = '{$_POST['te_address']}', te_menu = '{$_POST['te_menu']}', ";
    $sql_common .= " te_latitude = '{$_POST['te_latitude']}', te_longitude = '{$_POST['te_longitude']}', ";
    $sql_common .= " te_payment_rate = '{$_POST['te_payment_rate']}', te_category_detail = '{$_POST['te_category_detail']}' ";

    $sql = " update g5_tes set {$sql_common} where te_no = '{$te_no}' ";
    $result = sql_query($sql);
}
else if($w == 'd') { // 해지
    $sql_common = " te_cancel = '해지 요청 중', te_cancel_request_date = now() ";

    $sql = " update g5_tes set {$sql_common} where te_no = '{$te_no}' ";
    $result = sql_query($sql);
}

// 파일 삭제
for($i = 0; $i < count($del_file); $i++) {
    $sql = " select * from g5_file where fi_no = {$del_file[$i]} ";
    $row = sql_fetch($sql);

    unlink(G5_DATA_PATH . '/file/tes/' . $row['fi_file']);

    $sql = " delete from g5_file where fi_no = {$del_file[$i]} ";
    sql_query($sql);
}

// 파일 등록
for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
    $upload[$i]['file'] = '';
    $upload[$i]['source'] = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image'] = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

    $tmp_file = $_FILES['file']['tmp_name'][$i];
    $filesize = $_FILES['file']['size'][$i];
    $filename = $_FILES['file']['name'][$i];
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
        $dest_file = G5_DATA_PATH . '/file/tes/' . $upload[$i]['file'];

        //이미지 크기조정
        //size_image($_FILES['file'], 200, 200, $dest_file, 'multi', $i);

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['file']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $sql = " insert into g5_file set 
                     fi_table = 'g5_tes', mb_no = '{$_SESSION['ss_mb_no']}', tb_no = '{$te_no}', fi_source = '{$upload[$i]['source']}',
                     fi_file = '{$upload[$i]['file']}', fi_download = 0, fi_filesize = '{$upload[$i]['filesize']}',
                     fi_width = '{$upload[$i]['image']['0']}', fi_height = '{$upload[$i]['image']['1']}', 
                     fi_type = '{$upload[$i]['image']['2']}', fi_datetime = '" . G5_TIME_YMDHIS . "', fi_folder = 'tes' ";
        sql_query($sql);
    }
}

goto_url(G5_BBS_URL.'/mypage.php');
?>