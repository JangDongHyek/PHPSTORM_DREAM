<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

/*@mkdir(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);*/

//print_r($_FILES['file']);exit;
//print_r($_POST);exit;

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

//check_admin_token();

$mb_id = trim($_POST['mb_id']);
$mb_no = trim($_POST['mb_no']);

// 휴대폰번호 체크
//$mb_hp = hyphen_hp_number($_POST['mb_hp']);
$mb_hp = $_POST['mb_hp1'].'-'.$_POST['mb_hp2'].'-'.$_POST['mb_hp3'];
//if($mb_hp) {
//    $result = exist_mb_hp($mb_hp, $mb_id);
//    if ($result)
//        alert($result);
//}

// 생년월일
//$mb_birth = $_POST['birth_year'].'.'.$_POST['birth_month'].'.'.$_POST['birth_day'];

// 센터 DB
$sql = " select if(max(substring(center_code, 7)+0) is null, 0, max(substring(center_code, 7)+0)) as center_code from g5_center ";
$center_code = sql_fetch($sql)['center_code'];
//$center_code = explode('center', $code)[1];
$center_code = 'center' . ($center_code + 1);

$sql_common = " mb_email = '{$_POST['mb_email']}',
                mb_center = '{$_POST['center_name']}',
                mb_name = '{$_POST['center_mb_name']}',
                mb_hp = '{$mb_hp}',
                mb_notice = '{$_POST['mb_notice']}',
                mb_category = '팀장',
                mb_level = '9'
                ";

                /*mb_birth = '{$mb_birth}',
                mb_addr1 = '{$_POST['mb_addr1']}',
                mb_addr2 = '{$_POST['mb_addr2']}',*/

if ($w == '')
{
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name']);

    $sql = " insert into {$g5['member_table']} 
             set 
             mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', 
             mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', center_code = '{$center_code}', {$sql_common} ";
    sql_query($sql);

    $sql = " select mb_no from {$g5['member_table']} where mb_id = '{$mb_id}' and use_yn = 'Y' ";
    $mb_no = sql_fetch($sql)['mb_no'];

    // 센터 DB 등록
    $sql = " insert into g5_center 
             set 
             center_code = '{$center_code}', center_name = '{$_POST['center_name']}', 
             center_mb_no = '{$mb_no}', center_mb_name = '{$_POST['center_mb_name']}',
             reg_date = '".G5_TIME_YMDHIS."', open_date = '{$_POST['open_date']}', close_date = '{$_POST['close_date']}', memo = '{$_POST['memo']}' ";
    sql_query($sql);

    alert("센터 정보가 등록되었습니다.", G5_ADMIN_URL.'/center_list.php', false);
}
else if ($w == 'u')
{
    // 센터명 변경 시
    $tmp_center = sql_fetch(" select * from g5_center where idx = '{$center_idx}' ");
    $tmp_center_name = $tmp_center['center_name']; // 변경 전 센터명
    if($center_name != $tmp_center_name) {
        // 회원 정보에 저장된 센터명 함께 변경
        sql_query("update g5_member set mb_center = '{$center_name}' where center_code = '{$tmp_center['center_code']}' ");
    }

    $mb = get_member_no($mb_no);

    /*if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');*/

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    if ($_POST['mb_id'] == $member['mb_id'] && $_POST['mb_level'] != $mb['mb_level'])
        alert($mb['mb_id'].' : 로그인 중인 관리자 레벨은 수정 할 수 없습니다.');

    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."' ";
    else
        $sql_password = "";

    $sql = " update {$g5['member_table']} set {$sql_common} {$sql_password} {$sql_certify} where mb_no = '{$mb_no}' ";
    sql_query($sql);

    // 센터 DB 수정
    $sql = " update g5_center 
             set 
             center_name = '{$_POST['center_name']}', center_mb_name = '{$_POST['center_mb_name']}', mod_date = '".G5_TIME_YMDHIS."', open_date = '{$_POST['open_date']}', close_date = '{$_POST['close_date']}', memo = '{$_POST['memo']}'
             where idx = '{$_POST['center_idx']}' ";
    sql_query($sql);

    alert("센터 정보가 수정되었습니다.", G5_ADMIN_URL.'/center_list.php', false);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

/*
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
        $dest_file = G5_DATA_PATH . '/file/member/' . $upload[$i]['file'];

        //이미지 크기조정
        //size_image($_FILES['file'], 200, 200, $dest_file, 'multi', $i);

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_img']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $sql = " insert into g5_member_img set mb_no = '{$mb_no}', img_source = '{$upload[$i]['source']}', img_file = '{$upload[$i]['file']}',
                                               img_filesize = '{$upload[$i]['filesize']}', img_width = '{$upload[$i]['image']['0']}', img_height = '{$upload[$i]['image']['1']}',
                                               img_type = '{$upload[$i]['image']['2']}', img_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }
}
*/

//die($mb_no);
//goto_url(G5_ADMIN_URL.'/center_list.php');
?>
