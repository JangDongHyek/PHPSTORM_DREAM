<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

//23.04.11 기존 ajax로하는거 오류너무떠서 하나씩하는걸로 다시구현 wc

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/file/member_add', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/file/member_add', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

$mb_no = $_REQUEST['mb_no'];

// 가변 파일 업로드
$file_upload_msg = '';
$upload = array();
for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image']    = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
        $file_idx;
        $upload[$i]['del_check'] = true;
        $row = sql_fetch(" select * from g5_member_img_add where idx = '{$file_idx}' ");
        @unlink(G5_DATA_PATH.'/file/member_add/'.$row['bf_file']);
    }
    else
        $upload[$i]['del_check'] = false;

    $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
    $filesize  = $_FILES['bf_file']['size'][$i];
    $filename  = $_FILES['bf_file']['name'][$i];
    $filename  = get_safe_filename($filename);




    if (!preg_match("/\.($config[cf_image_extension])$/i", $_FILES['bf_file']['name'][$i]) && $_FILES['bf_file']['name'][$i]) {
        $file_upload_msg .= '\"'.$filename.'\" 이미지 파일만 업로드가 가능합니다!.\\n';
        continue;
    }


    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['bf_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['bf_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // *관리자가 아니면서* 삭제, 설정한 업로드 사이즈보다 크다면 건너뜀
        $board['bo_upload_size'] = 10485760; //10M설정
        if ($filesize > $board['bo_upload_size']) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
            preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
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
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

        $dest_file = G5_DATA_PATH.'/file/member_add/'.$upload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        // 추가서류 DB INSERT
        $result = sql_query(" insert into g5_member_img_add set mb_no='{$mb_no}', img_source = '{$filename}', img_file = '{$upload[$i]['file']}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");

    }
}

//완료되면 완료된거구 아니면 오류메세지 띄어줌
if ($file_upload_msg){
    alert($file_upload_msg, G5_HTTP_BBS_URL.'/file_upload_form.php');
}else{
    if($_REQUEST["page"]){
        goto_url(G5_BBS_URL . "/" . $_REQUEST["page"] . "?mb_id=".$mb_id);
        //alert('업로드 완료되었습니다.', G5_BBS_URL . "/" . $_REQUEST["page"] . "?mb_id=".$mb_id);
    }else{
        alert('업로드 완료되었습니다.', G5_BBS_URL."/file_upload_form.php?mb_id=".$mb_id);
    }
    //goto_url(G5_BBS_URL . "/" . $_REQUEST["page"] . "?mb_id=".$mb_id);
}




