<?php
$sub_menu = "100510";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if($w == "w"){
	sql_query("insert into g5_ipconfig set ip_code = '{$ip_code}'");
	goto_url("./ipconfig.php");
}else if($w == "u"){
	sql_query("update g5_ipconfig set ip_code = '{$ip_code}' where ip_id = '{$ip_id}'");
	goto_url("./ipconfig.php");
}else if($w == "d"){
	sql_query("delete from g5_ipconfig where ip_id = '{$ip_id}'");
	goto_url("./ipconfig.php");
}

$g5['title'] = '접속아이피관리';
include_once('./admin.head.php');

$result = sql_query("select * from g5_ipconfig");
?>

<form id="fwrite" name="fwrite" class="local_sch01 local_sch" method="post" action="">
<input type="hidden" name="w" value="w">

<div style="font-size:1.1em; font-weight:bold; font-family:dotum; ">
※사무실 혹은 본인의 IP를 입력해주시길 바랍니다. <br/>
※이 기능은 확인된 아이피에서만 테스트를 위한 기능입니다. <br/>
※사용 함수명 : ipconfig($ip) <br/>
※ForOne Ip(2개) : 사무실 - 115.94.232.186, 회의실 - 59.20.188.117
</div>
<br/><br/>
<label for="ip_code" class="sound_only">IP<strong class="sound_only"> 필수</strong></label>
<input type="text" name="ip_code" value="" id="ip_code" required class="required frm_input" maxlength="14">
<input type="submit" class="btn_submit" value="추가">
</form>

<div class="tbl_head01 tbl_wrap" style="width:400px;">
    <table>
    <caption>접속가능 IP 목록</caption>
	<table>
		<thead>
		<tr>
			<th scope="row">접속가능IP</th>
			<th scope="row">수정/삭제</th>
		</tr>
		</thead>
		<?php for($i=0; $i<$row=sql_fetch_array($result); $i++){ ?>
		<tr>
			<td>
				<input type="text" name="ip_code[]" id="ip_code<?php echo $i; ?>" value="<?php echo $row['ip_code'] ?>" required class="required frm_input" maxlength="14" style="width:100%;">
			</td>
			<td>
				<input type="button" value="수정" onclick="codeEdit('<?php echo $row['ip_id']?>', '<?php echo $i; ?>');">
				<input type="button" value="삭제" onclick="codeDel('<?php echo $row['ip_id']?>');">
			</td>
		</tr>
		<?php } ?>
	</table>
</div>

<script>

function codeEdit(ip_id, i){
	location.href = './ipconfig.php?w=u&ip_id=' + ip_id + '&ip_code=' + document.getElementById("ip_code"+i).value;
}

function codeDel(ip_id){
	location.href = './ipconfig.php?w=d&ip_id=' + ip_id;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
