<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

@mkdir(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);

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
$mb_birth = $_POST['birth_year'].'.'.$_POST['birth_month'].'.'.$_POST['birth_day'];
if($mb_birth == '..') { $mb_birth = ''; }

$sql_common = " mb_email = '{$_POST['mb_email']}',
                mb_birth = '{$mb_birth}',
                mb_addr1 = '{$_POST['mb_addr1']}',
                mb_addr2 = '{$_POST['mb_addr2']}',
                mb_recommend = '{$_POST['mb_recommend']}',
                mb_score = '{$_POST['mb_score']}',
                mb_career = '{$_POST['mb_career']}', 
                mb_lesson = '{$_POST['mb_lesson']}',
                mb_lesson_de = '{$_POST['mb_lesson_de']}',
                mb_rounding = '{$_POST['mb_rounding']}',
                mb_wish = '{$_POST['mb_wish']}',
                mb_center = '{$_POST['mb_center']}',
                mb_name = '{$_POST['mb_name']}',
                mb_hp = '{$mb_hp}',
                mb_notice = '{$_POST['mb_notice']}',
                mb_category = '프로',
                mb_level = '8',
                lesson_code = '{$lesson_code}',
                center_code = '{$_POST['center_code']}',
                mb_pro_profile = '{$_POST['mb_pro_profile']}',
                pro_enter_date = '{$_POST['pro_enter_date']}',
                pro_leave_date = '{$_POST['pro_leave_date']}'
                ";


if ($w == '')
{
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name']);

    $sql = " insert into {$g5['member_table']} 
             set 
             mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', 
             mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', {$sql_common} ";
    sql_query($sql);

    $sql = " select mb_no from {$g5['member_table']} where mb_id = '{$mb_id}' and use_yn = 'Y' ";
    $mb_no = sql_fetch($sql)['mb_no'];

    // 예약시간설정 g5_lesson_time_set_pro (오전 6시~오후 11시 기본 설정)
    $result = sql_query(" select * from g5_lesson_time_set; ");
    for($i=0; $row=sql_fetch_array($result); $i++) {
        $sql = " insert into g5_lesson_time_set_pro set mb_no = {$mb_no}, time_set_idx = {$row['idx']}, use_yn = 'Y', reg_date = now(); ";
        sql_query($sql);
    }
}
else if ($w == 'u')
{
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
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


// == 수당 정보 ==
sql_query("DELETE FROM g5_pro_extra_pay WHERE idx IN ({$_POST['extra_pay_del_idx']});"); // 수당 정보 삭제

$extra_pay_idx = $_POST['extra_pay_idx'];
for($i=0; $i<count($extra_pay_idx); $i++) {
    $min_price = str_replace(',','',$_POST['min_price'][$i]);
    $max_price = str_replace(',','',$_POST['max_price'][$i]);
    $pay_percent = $_POST['pay_percent'][$i];

    $sql_common2 = " min_price = '{$min_price}', 
                     max_price = '{$max_price}',
                     pay_percent = '{$pay_percent}'
                   ";

    if(!empty($extra_pay_idx[$i])) { // 수정
        $sql = " update g5_pro_extra_pay set mod_date = '".G5_TIME_YMDHIS."', {$sql_common2} where idx = {$extra_pay_idx[$i]} ";
        sql_query($sql);
    }
    else { // 등록
        $sql = " insert into g5_pro_extra_pay set pro_mb_no = {$mb_no}, reg_date = '".G5_TIME_YMDHIS."', {$sql_common2} ";
        sql_query($sql);
    }
}
// == 수당 정보 ==


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

die($mb_no);
//goto_url('./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>