<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');



$mb_id = trim($_POST['mb_id']);

// 휴대폰번호 체크
$mb_hp = hyphen_hp_number($_POST['mb_hp']);
$mb_tel = str_replace('-','',$_POST['mb_tel']);


// 인증정보처리
if($_POST['mb_certify_case'] && $_POST['mb_certify']) {
    $mb_certify = $_POST['mb_certify_case'];
    $mb_adult = $_POST['mb_adult'];
} else {
    $mb_certify = '';
    $mb_adult = 0;
}


//추가된 컬럼
$mb_birth          = isset($_POST['mb_birth'])            ? trim(clean_xss_tags($_POST['mb_birth']))          : "";
$mb_birth_time          = isset($_POST['mb_birth_time'])            ? trim(clean_xss_tags($_POST['mb_birth_time']))          : "";
$mb_birth_div          = isset($_POST['mb_birth_div'])            ? trim(clean_xss_tags($_POST['mb_birth_div']))          : "";
$mb_addr_div          = isset($_POST['mb_addr_div'])            ? trim(clean_xss_tags($_POST['mb_addr_div']))          : "";
$mb_merry          = isset($_POST['mb_merry'])            ? trim(clean_xss_tags($_POST['mb_merry']))          : "";
$mb_sex         = isset($_POST['mb_sex'])            ? trim(clean_xss_tags($_POST['mb_sex']))          : "";
$mb_religion          = isset($_POST['mb_religion'])            ? trim(clean_xss_tags($_POST['mb_religion']))          : "";
$mb_education          = isset($_POST['mb_education'])            ? trim(clean_xss_tags($_POST['mb_education']))          : "";
$mb_highschool          = isset($_POST['mb_highschool'])            ? trim(clean_xss_tags($_POST['mb_highschool']))          : "";
$mb_highschool2          = isset($_POST['mb_highschool2'])            ? trim(clean_xss_tags($_POST['mb_highschool2']))          : "";
$mb_university          = isset($_POST['mb_university'])            ? trim(clean_xss_tags($_POST['mb_university']))          : "";
$mb_university2          = isset($_POST['mb_university2'])            ? trim(clean_xss_tags($_POST['mb_university2']))          : "";
$mb_university3          = isset($_POST['mb_university3'])            ? trim(clean_xss_tags($_POST['mb_university3']))          : "";
$mb_university4          = isset($_POST['mb_university4'])            ? trim(clean_xss_tags($_POST['mb_university4']))          : "";
$mb_master          = isset($_POST['mb_master'])            ? trim(clean_xss_tags($_POST['mb_master']))          : "";
$mb_master2          = isset($_POST['mb_master2'])            ? trim(clean_xss_tags($_POST['mb_master2']))          : "";
$mb_master3          = isset($_POST['mb_master3'])            ? trim(clean_xss_tags($_POST['mb_master3']))          : "";
$mb_master4          = isset($_POST['mb_master4'])            ? trim(clean_xss_tags($_POST['mb_master4']))          : "";
$mb_doctor          = isset($_POST['mb_doctor'])            ? trim(clean_xss_tags($_POST['mb_doctor']))          : "";
$mb_doctor2          = isset($_POST['mb_doctor2'])            ? trim(clean_xss_tags($_POST['mb_doctor2']))          : "";
$mb_doctor3          = isset($_POST['mb_doctor3'])            ? trim(clean_xss_tags($_POST['mb_doctor3']))          : "";
$mb_doctor4          = isset($_POST['mb_doctor4'])            ? trim(clean_xss_tags($_POST['mb_doctor4']))          : "";
$mb_job_div          = isset($_POST['mb_job_div'])            ? trim(clean_xss_tags($_POST['mb_job_div']))          : "";
$mb_job_title          = isset($_POST['mb_job_title'])            ? trim(clean_xss_tags($_POST['mb_job_title']))          : "";
$mb_job_addr          = isset($_POST['mb_job_addr'])            ? trim(clean_xss_tags($_POST['mb_job_addr']))          : "";
$mb_job_people          = isset($_POST['mb_job_people'])            ? trim(clean_xss_tags($_POST['mb_job_people']))          : "";
$mb_job_date          = isset($_POST['mb_job_date'])            ? trim(clean_xss_tags($_POST['mb_job_date']))          : "";
$mb_job_price          = isset($_POST['mb_job_price'])            ? trim(clean_xss_tags($_POST['mb_job_price']))          : "";
$mb_money          = isset($_POST['mb_money'])            ? trim(clean_xss_tags($_POST['mb_money']))          : "";
$mb_money2          = isset($_POST['mb_money2'])            ? trim(clean_xss_tags($_POST['mb_money2']))          : "";
$mb_inmate          = isset($_POST['mb_inmate'])            ? trim(clean_xss_tags($_POST['mb_inmate']))          : "";
$mb_family          = isset($_POST['mb_family'])            ? trim(clean_xss_tags($_POST['mb_family']))          : "";
$mb_family_money          = isset($_POST['mb_family_money'])            ? trim(clean_xss_tags($_POST['mb_family_money']))          : "";
$mb_dad          = isset($_POST['mb_dad'])            ? trim(clean_xss_tags($_POST['mb_dad']))          : "";
$mb_dad2          = isset($_POST['mb_dad2'])            ? trim(clean_xss_tags($_POST['mb_dad2']))          : "";
$mb_mom          = isset($_POST['mb_mom'])            ? trim(clean_xss_tags($_POST['mb_mom']))          : "";
$mb_mom2          = isset($_POST['mb_mom2'])            ? trim(clean_xss_tags($_POST['mb_mom2']))          : "";
$mb_hobby          = isset($_POST['mb_hobby'])            ? trim(clean_xss_tags($_POST['mb_hobby']))          : "";
$mb_height          = isset($_POST['mb_height'])            ? trim(clean_xss_tags($_POST['mb_height']))          : "";
$mb_weight          = isset($_POST['mb_weight'])            ? trim(clean_xss_tags($_POST['mb_weight']))          : "";
$mb_meeting          = isset($_POST['mb_meeting'])            ? trim(clean_xss_tags($_POST['mb_meeting']))          : "";
$mb_love_job          = isset($_POST['mb_love_job'])            ? trim(clean_xss_tags($_POST['mb_love_job']))          : "";
$mb_love_age          = isset($_POST['mb_love_age'])            ? trim(clean_xss_tags($_POST['mb_love_age']))          : "";
$mb_love_height          = isset($_POST['mb_love_height'])            ? trim(clean_xss_tags($_POST['mb_love_height']))          : "";
$mb_love_money          = isset($_POST['mb_love_money'])            ? trim(clean_xss_tags($_POST['mb_love_money']))          : "";
$mb_love_money2          = isset($_POST['mb_love_money2'])            ? trim(clean_xss_tags($_POST['mb_love_money2']))          : "";
$mb_love_religion          = isset($_POST['mb_love_religion'])            ? trim(clean_xss_tags($_POST['mb_love_religion']))          : "";
$mb_love_education          = isset($_POST['mb_love_education'])            ? trim(clean_xss_tags($_POST['mb_love_education']))          : "";
$mb_problem          = isset($_POST['mb_problem'])            ? trim(clean_xss_tags($_POST['mb_problem']))          : "";
$mb_memo_call          = isset($_POST['mb_memo_call'])            ? trim(clean_xss_tags($_POST['mb_memo_call']))          : "";
$mb_digamy          = isset($_POST['mb_digamy'])            ? trim(clean_xss_tags($_POST['mb_digamy']))          : "";
$mb_digamy2          = isset($_POST['mb_digamy2'])            ? trim(clean_xss_tags($_POST['mb_digamy2']))          : "";
$mb_digamy3          = isset($_POST['mb_digamy3'])            ? trim(clean_xss_tags($_POST['mb_digamy3']))          : "";
$mb_digamy4          = isset($_POST['mb_digamy4'])            ? trim(clean_xss_tags($_POST['mb_digamy4']))          : "";
$mb_digamy5          = isset($_POST['mb_digamy5'])            ? trim(clean_xss_tags($_POST['mb_digamy5']))          : "";
$mb_digamy6          = isset($_POST['mb_digamy6'])            ? trim(clean_xss_tags($_POST['mb_digamy6']))          : "";

$sql_add = '';
if ($mb_birth_time){ $sql_add .= " , mb_birth_time = '".$mb_birth_time."' "; }
if ($mb_birth){ $sql_add .= " , mb_birth = '".$mb_birth."' "; }
if ($mb_birth_div){ $sql_add .= " , mb_birth_div = '".$mb_birth_div."' "; }
if ($mb_addr_div){ $sql_add .= " , mb_addr_div = '".$mb_addr_div."' "; }
if ($mb_merry){ $sql_add .= " , mb_merry = '".$mb_merry."' "; }
if ($mb_sex){ $sql_add .= " , mb_sex = '".$mb_sex."' "; }
if ($mb_religion){ $sql_add .= " , mb_religion = '".$mb_religion."' "; }
if ($mb_education){ $sql_add .= " , mb_education = '".$mb_education."' "; }
if ($mb_highschool){ $sql_add .= " , mb_highschool = '".$mb_highschool."' "; }
if ($mb_highschool2){ $sql_add .= " , mb_highschool2 = '".$mb_highschool2."' "; }
if ($mb_university){ $sql_add .= " , mb_university = '".$mb_university."' "; }
if ($mb_university2){ $sql_add .= " , mb_university2 = '".$mb_university2."' "; }
if ($mb_university3){ $sql_add .= " , mb_university3 = '".$mb_university3."' "; }
if ($mb_university4){ $sql_add .= " , mb_university4 = '".$mb_university4."' "; }
if ($mb_master){ $sql_add .= " , mb_master = '".$mb_master."' "; }
if ($mb_master2){ $sql_add .= " , mb_master2 = '".$mb_master2."' "; }
if ($mb_master3){ $sql_add .= " , mb_master3 = '".$mb_master3."' "; }
if ($mb_master4){ $sql_add .= " , mb_master4 = '".$mb_master4."' "; }
if ($mb_doctor){ $sql_add .= " , mb_doctor = '".$mb_doctor."' "; }
if ($mb_doctor2){ $sql_add .= " , mb_doctor2 = '".$mb_doctor2."' "; }
if ($mb_doctor3){ $sql_add .= " , mb_doctor3 = '".$mb_doctor3."' "; }
if ($mb_doctor4){ $sql_add .= " , mb_doctor4 = '".$mb_doctor4."' "; }
if ($mb_job_div){ $sql_add .= " , mb_job_div = '".$mb_job_div."' "; }
if ($mb_job_title){ $sql_add .= " , mb_job_title = '".$mb_job_title."' "; }
if ($mb_job_addr){ $sql_add .= " , mb_job_addr = '".$mb_job_addr."' "; }
if ($mb_job_people){ $sql_add .= " , mb_job_people = '".$mb_job_people."' "; }
if ($mb_job_date){ $sql_add .= " , mb_job_date = '".$mb_job_date."' "; }
if ($mb_job_price){ $sql_add .= " , mb_job_price = '".$mb_job_price."' "; }
if ($mb_money){ $sql_add .= " , mb_money = '".$mb_money."' "; }
if ($mb_money2){ $sql_add .= " , mb_money2 = '".$mb_money2."' "; }
if ($mb_inmate){ $sql_add .= " , mb_inmate = '".$mb_inmate."' "; }
if ($mb_family){ $sql_add .= " , mb_family = '".$mb_family."' "; }
if ($mb_family_money){ $sql_add .= " , mb_family_money = '".$mb_family_money."' "; }
if ($mb_dad){ $sql_add .= " , mb_dad = '".$mb_dad."' "; }
if ($mb_dad2){ $sql_add .= " , mb_dad2 = '".$mb_dad2."' "; }
if ($mb_mom){ $sql_add .= " , mb_mom = '".$mb_mom."' "; }
if ($mb_mom2){ $sql_add .= " , mb_mom2 = '".$mb_mom2."' "; }
if ($mb_hobby){ $sql_add .= " , mb_hobby = '".$mb_hobby."' "; }
if ($mb_height){ $sql_add .= " , mb_height = '".$mb_height."' "; }
if ($mb_weight){ $sql_add .= " , mb_weight = '".$mb_weight."' "; }
if ($mb_meeting){ $sql_add .= " , mb_meeting = '".$mb_meeting."' "; }
if ($mb_love_job){ $sql_add .= " , mb_love_job = '".$mb_love_job."' "; }
if ($mb_love_age){ $sql_add .= " , mb_love_age = '".$mb_love_age."' "; }
if ($mb_love_height){ $sql_add .= " , mb_love_height = '".$mb_love_height."' "; }
if ($mb_love_money){ $sql_add .= " , mb_love_money = '".$mb_love_money."' "; }
if ($mb_love_money2){ $sql_add .= " , mb_love_money2 = '".$mb_love_money2."' "; }
if ($mb_love_religion){ $sql_add .= " , mb_love_religion = '".$mb_love_religion."' "; }
if ($mb_love_education){ $sql_add .= " , mb_love_education = '".$mb_love_education."' "; }
if ($mb_problem){ $sql_add .= " , mb_problem = '".$mb_problem."' "; }
if ($mb_memo_call){ $sql_add .= " , mb_memo_call = '".$mb_memo_call."' "; }
if ($mb_digamy){ $sql_add .= " , mb_digamy = '".$mb_digamy."' "; }
if ($mb_digamy2){ $sql_add .= " , mb_digamy2 = '".$mb_digamy2."' "; }
if ($mb_digamy3){ $sql_add .= " , mb_digamy3 = '".$mb_digamy3."' "; }
if ($mb_digamy4){ $sql_add .= " , mb_digamy4 = '".$mb_digamy4."' "; }
if ($mb_digamy5){ $sql_add .= " , mb_digamy5 = '".$mb_digamy5."' "; }
if ($mb_digamy6){ $sql_add .= " , mb_digamy6 = '".$mb_digamy6."' "; }


$mb_zip1 = substr($_POST['mb_zip'], 0, 3);
$mb_zip2 = substr($_POST['mb_zip'], 3);

$sql_common = "  mb_name = '{$_POST['mb_name']}',
                 mb_nick = '{$_POST['mb_nick']}',
                 mb_email = '{$_POST['mb_email']}',
                 mb_homepage = '{$_POST['mb_homepage']}',
                 mb_tel = '{$mb_tel}',
                 mb_hp = '{$mb_hp}',
                 mb_certify = '{$mb_certify}',
                 mb_adult = '{$mb_adult}',
                 mb_zip1 = '$mb_zip1',
                 mb_zip2 = '$mb_zip2',
                 mb_addr1 = '{$_POST['mb_addr1']}',
                 mb_addr2 = '{$_POST['mb_addr2']}',
                 mb_addr3 = '{$_POST['mb_addr3']}',
                 mb_addr_jibeon = '{$_POST['mb_addr_jibeon']}',
                 mb_signature = '{$_POST['mb_signature']}',
                 mb_leave_date = '{$_POST['mb_leave_date']}',
                 mb_intercept_date='{$_POST['mb_intercept_date']}',

                 mb_mailling = '{$_POST['mb_mailling']}',
                 mb_sms = '{$_POST['mb_sms']}',
                 mb_open = '{$_POST['mb_open']}',
                 mb_profile = '{$_POST['mb_profile']}',
                 mb_level = '{$_POST['mb_level']}',
                 mb_1 = '{$_POST['mb_1']}',
                 mb_2 = '{$_POST['mb_2']}',
                 mb_3 = '{$_POST['mb_3']}',
                 mb_4 = '{$_POST['mb_4']}',
                 mb_5 = '{$_POST['mb_5']}',
                 mb_6 = '{$_POST['mb_6']}',
                 mb_7 = '{$_POST['mb_7']}',
                 mb_8 = '{$_POST['mb_8']}',
                 mb_9 = '{$_POST['mb_9']}',
                 mb_10 = '{$_POST['mb_10']}' ";

if ($w == '')
{
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name'].'\\n닉네임 : '.$mb['mb_nick'].'\\n메일 : '.$mb['mb_email']);

    sql_query(" insert into {$g5['member_table']} set mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', {$sql_common} {$sql_add} ");
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    if ($_POST['mb_id'] == $member['mb_id'] && $_POST['mb_level'] != $mb['mb_level'])
        alert($mb['mb_id'].' : 로그인 중인 관리자 레벨은 수정 할 수 없습니다.');

    $mb_dir = substr($mb_id,0,2);

    // 회원 아이콘 삭제
    if ($del_mb_icon)
        @unlink(G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.gif');

    // 아이콘 업로드
    if (is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
        if (!preg_match("/(\.gif)$/i", $_FILES['mb_icon']['name'])) {
            alert($_FILES['mb_icon']['name'] . '은(는) gif 파일이 아닙니다.');
        }

        if (preg_match("/(\.gif)$/i", $_FILES['mb_icon']['name'])) {
            @mkdir(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);
            @chmod(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);

            $dest_path = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.gif';

            move_uploaded_file($_FILES['mb_icon']['tmp_name'], $dest_path);
            chmod($dest_path, G5_FILE_PERMISSION);

            if (file_exists($dest_path)) {
                $size = getimagesize($dest_path);
                // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                if ($size[0] > $config['cf_member_icon_width'] || $size[1] > $config['cf_member_icon_height']) {
                    @unlink($dest_path);
                }
            }
        }
    }

    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."' ";
    else
        $sql_password = "";

    if ($passive_certify)
        $sql_certify = " , mb_email_certify = '".G5_TIME_YMDHIS."' ";
    else
        $sql_certify = "";

    $sql = " update {$g5['member_table']}
                set {$sql_common}
                     {$sql_add}
                     {$sql_password}
                     {$sql_certify}
                where mb_id = '{$mb_id}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


// 사용자 코드 실행
@include_once ($member_skin_path.'/register_form_update.tail.skin.php');

goto_url('./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>