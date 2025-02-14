<?php
$sub_id = "my_profile01";
include_once('./_common.php');

@mkdir(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);
@mkdir(G5_DATA_PATH . '/file/' . 'member_add', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'member_add', G5_DIR_PERMISSION);

$mb_id = $_POST['mb_id'];
$page = $_POST['page']; // 이동할 페이지 (인터뷰 or 취미/관심사)

$sql_common = " mb_nick = '{$_POST['mb_nick']}', 
                mb_live_si = '{$_POST['si_live']}', 
                mb_live_gu = '{$_POST['gu_live']}', 
                mb_church = '{$_POST['mb_church']}', 
                mb_church_show = '{$_POST['mb_church_show']}',
                mb_pastor = '{$_POST['mb_pastor']}',
                mb_church_si = '{$_POST['si_church']}',
                mb_church_gu = '{$_POST['gu_church']}', 
                mb_church_dong = '{$_POST['dong_church']}',
                mb_social_role = '{$_POST['mb_social_role']}', 
                mb_job = '{$mb_job}',
                mb_blood_type = '{$_POST['mb_blood_type']}', 
                mb_character_type = '{$_POST['mb_character_type']}',
                mb_confession = '{$_POST['mb_confession']}',
                mb_height = '{$_POST['mb_height']}',
                mb_weight = '{$_POST['mb_weight']}',
                mb_profile1 = 'Y' ";

$sql = " update {$g5['member_table']} set {$sql_common} where mb_id = '{$mb_id}' ";
sql_query($sql);

$mb_no = sql_fetch(" select mb_no from {$g5['member_table']} where mb_id = '{$mb_id}' ")['mb_no'];

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

// 추가서류 등록
//for($i=0; $i<count($_FILES['addFiles']['name']); $i++) {
//    if(!empty($_FILES['addFiles']['name'])) {
//        // 카달로그 파일 업로드
//        $tmp_file = $_FILES['addFiles']['tmp_name'][$i];
//        $filesize = $_FILES['addFiles']['size'][$i];
//        $filename = $_FILES['addFiles']['name'][$i];
//        $filename = get_safe_filename($filename);
//        $img_file = fileUpload_up(G5_DATA_PATH . "/file/member_add/", $filename, $tmp_file); // 경로, 파일명, 임시파일명
//
//        // 추가서류 DB INSERT
//        sql_query(" insert into g5_member_img_add set mb_no='{$mb_no}', img_source = '{$filename}', img_file = '{$img_file}', img_filesize = '{$filesize}', img_datetime = '" . G5_TIME_YMDHIS . "' ");
//    }
//}

die('success');
//goto_url(G5_BBS_URL.'/'.$page.'?mb_id='.$mb_id);
?>