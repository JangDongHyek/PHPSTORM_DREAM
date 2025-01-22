<?php
$sub_menu = "100510";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if($mode=="edit"){
	sql_query("update g5_ipconfig set ip_code = '{$ip_code}' where ip_id = '{$ip_id}'");
	goto_url("./ipconfig.php");
}

$g5['title'] = '접속아이피관리';
include_once('./admin.head.php');

$row = sql_fetch("select * from g5_ipconfig");
?>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="post" action="">
<input type="hidden" name="mode" value="edit">
<input type="hidden" name="ip_id" value="<?php echo $row['ip_id']?>">

<div style="font-size:1.1em; font-weight:bold; font-family:dotum; ">
※사무실 혹은 본인의 IP를 입력해주시길 바랍니다. <br/>
※이 기능은 확인된 아이피에서만 테스트를 위한 기능입니다. <br/>
※사용 함수명 : ipconfig($ip)
</div>
<br/><br/>
<label for="ip_code" class="sound_only">IP<strong class="sound_only"> 필수</strong></label>
<input type="text" name="ip_code" value="<?php echo $row['ip_code'] ?>" id="ip_code" required class="required frm_input" maxlength="14">
<input type="submit" class="btn_submit" value="수정">
</form>

<?php
include_once ('./admin.tail.php');
?>
