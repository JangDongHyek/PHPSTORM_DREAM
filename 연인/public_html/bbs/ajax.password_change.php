<?php
/**
 * 210914 회원정보찾기시 임시비밀번호 발급
 */
include_once('./_common.php');

// 임시비밀번호 발급
$tmp_pass = getRandomString(6);
$mb_password = get_encrypt_string($tmp_pass);

$mb_id = $_POST['mb_id'];

$sql = "UPDATE g5_member SET 
        mb_password = '{$mb_password}',
        mb_10 = '{$tmp_pass}'
        WHERE mb_id = '{$mb_id}'
        ";
$result = sql_query($sql);

if (!$result) {
    die("F");
}
?>

<p>
    임시비밀번호로 변경 완료되었습니다. <br>로그인 후 비밀번호를 변경해 주세요.
</p>
<h1>* 아이디 : <span id="tmp_id"><?=$mb_id?></span></h1>
<h1>* 임시비밀번호 : <span id="tmp_pass"><?=$tmp_pass?></span></h1>
<div class="win_btn">
    <input type="button" value="로그인으로 이동" class="btn_submit" onclick="location.href='./login.php'">
    <button type="button" onclick="location.href='<?=G5_URL?>'" class="btn01">메인화면</button>
</div>