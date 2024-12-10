<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

$mb_id = $w == 'u' ? isset($_SESSION['ss_mb_id']) ? trim($_SESSION['ss_mb_id']) : '' : trim($_POST['mb_id']);
if(!$mb_id)
    alert('회원아이디 값이 없습니다. 올바른 방법으로 이용해 주십시오.');

$mb_password    = trim($_POST['mb_password']);
$mb_password_re = trim($_POST['mb_password_re']);
$mb_name        = trim($_POST['mb_name']);
$mb_email       = trim($_POST['mb_email']);
$mb_hp          = trim($_POST['mb_hp']);
$mb_zip1        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 0, 3) : "";
$mb_zip2        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 3)    : "";
$mb_addr1       = trim($_POST['mb_addr1']);
$mb_addr2       = trim($_POST['mb_addr2']);
$mb_birth       = trim($_POST['mb_birth']);
$mb_gender      = trim($_POST['mb_gender']);
$mb_maritalStatus = trim($_POST['mb_maritalStatus']);
$mb_house       = trim($_POST['mb_house']);
$name_signature = trim($_POST['name_signature']);
$sign_signature = trim($_POST['sign_signature']);
$mb_1           = isset($_POST['mb_1']) ? trim($_POST['mb_1']) : "";
$mb_2           = isset($_POST['mb_2']) ? trim($_POST['mb_2']) : "";
$mb_3           = isset($_POST['mb_3']) ? trim($_POST['mb_3']) : "";
$mb_4           = isset($_POST['mb_4']) ? trim($_POST['mb_4']) : "";
$mb_5           = isset($_POST['mb_5']) ? trim($_POST['mb_5']) : "";
$mb_6           = isset($_POST['mb_6']) ? trim($_POST['mb_6']) : "";
$mb_7           = isset($_POST['mb_7']) ? trim($_POST['mb_7']) : "";
$mb_8           = isset($_POST['mb_8']) ? trim($_POST['mb_8']) : "";
$mb_9           = isset($_POST['mb_9']) ? trim($_POST['mb_9']) : "";
$mb_10          = isset($_POST['mb_10']) ? trim($_POST['mb_10']) : "";
$mb_12          = isset($_POST['mb_12']) ? trim($_POST['mb_12']) : "";

if ($w == '' || $w == 'u') {
    $mb_name = clean_xss_tags($mb_name);
    $mb_email = get_email_address($mb_email);
    $mb_hp = clean_xss_tags($mb_hp);
    $mb_addr1 = clean_xss_tags($mb_addr1);
    $mb_addr2 = clean_xss_tags($mb_addr2);

    if ($w == '' && !$mb_password)
        alert('비밀번호가 넘어오지 않았습니다.');
    if($w == '' && $mb_password != $mb_password_re)
        alert('비밀번호가 일치하지 않습니다.');

    if ($w == '') {
        if ($msg = exist_mb_id($mb_id)) alert($msg);
    }
}

$mb_zip1        = preg_replace('/[^0-9]/', '', $mb_zip1);
$mb_zip2        = preg_replace('/[^0-9]/', '', $mb_zip2);

$sql_certify = ", agency_no = '{$_POST['agency_no']}'";

if ($w == '') {
    $mb_password = get_encrypt_string($mb_password);
    $sql = "INSERT INTO {$g5['member_table']} SET
            mb_id = '{$mb_id}',
            mb_password = '{$mb_password}',
            mb_name = '{$mb_name}',
            mb_email = '{$mb_email}',
            mb_hp = '{$mb_hp}',
			 mb_zip1 = '{$mb_zip1}',
			 mb_zip2 = '{$mb_zip2}',
            mb_addr1 = '{$mb_addr1}',
            mb_addr2 = '{$mb_addr2}',
            mb_birth = '{$mb_birth}',
            mb_gender = '{$mb_gender}',
            mb_maritalStatus = '{$mb_maritalStatus}',
            mb_house = '{$mb_house}',
            mb_today_login = '".G5_TIME_YMDHIS."',
			 mb_datetime = '".G5_TIME_YMDHIS."',
			 mb_ip = '{$_SERVER['REMOTE_ADDR']}',
			 mb_level = '{$mb_level}',
			 mb_recommend = '{$mb_recommend}',
			 mb_login_ip = '{$_SERVER['REMOTE_ADDR']}',
			 mb_mailling = '{$mb_mailling}',
			 mb_sms = '{$mb_sms}',
			 mb_open = '{$mb_open}',
			 mb_open_date = '".G5_TIME_YMD."',
            mb_1 = '{$mb_1}',
            mb_2 = '{$mb_2}',
            mb_3 = '{$mb_3}',
            mb_4 = '{$mb_4}',
            mb_5 = '{$mb_5}',
            mb_6 = '{$mb_6}',
            mb_7 = '{$mb_7}',
            mb_8 = '{$mb_8}',
            mb_9 = '{$mb_9}',
            mb_10 = '{$mb_10}',
            mb_12 = '{$mb_12}',
            is_ccm = 'T'
            {$sql_certify}";
    sql_query($sql);
} else if ($w == 'u') {
    $sql_password = $mb_password ? ", mb_password = '" . get_encrypt_string($mb_password) . "'" : "";
    $sql = "UPDATE {$g5['member_table']} SET
            mb_name = '{$mb_name}',
            mb_email = '{$mb_email}',
            mb_hp = '{$mb_hp}',
            mb_level = '{$mb_level}',
			 mb_zip1 = '{$mb_zip1}',
			 mb_zip2 = '{$mb_zip2}',
            mb_addr1 = '{$mb_addr1}',
            mb_addr2 = '{$mb_addr2}',
            mb_birth = '{$mb_birth}',
            mb_gender = '{$mb_gender}',
            mb_maritalStatus = '{$mb_maritalStatus}',
            mb_house = '{$mb_house}',
            mb_1 = '{$mb_1}',
            mb_2 = '{$mb_2}',
            mb_3 = '{$mb_3}',
            mb_4 = '{$mb_4}',
            mb_5 = '{$mb_5}',
            mb_6 = '{$mb_6}',
            mb_7 = '{$mb_7}',
            mb_8 = '{$mb_8}',
            mb_9 = '{$mb_9}',
            mb_10 = '{$mb_10}',
            mb_12 = '{$mb_12}',
            is_ccm = 'T'
            {$sql_password}
            {$sql_certify}
            WHERE mb_id = '$mb_id'";
    sql_query($sql);
}
include_once(G5_THEME_PATH.'/head.sub.php');
$swal_title = "회원가입";
$swal_msg = "회원가입이 완료되었습니다.";
if ($w == 'u') {
    $swal_title = "회원정보수정";
    $swal_msg = "회원정보가 수정되었습니다.";
}

?>
<script>
    swal("<?=$swal_title?>", "<?=$swal_msg?>", "success", {
        button: "확인",
    }).then(function(result) {
        location.href = g5_url + "/index.php";
    });
</script>
?>
