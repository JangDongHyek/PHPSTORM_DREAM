<?php
$sub_menu = "650400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '롱런 Q&A';
include_once('./admin.head.php');

if ($_POST['flag'] == "1") {
    $channel = trim($_POST['kakao_pf']);
	$sql = "UPDATE g5_config SET cf_kakao_pf = '{$channel}'";
	$rst = sql_query($sql);

	if ($rst) {
		$config['cf_kakao_pf'] = $channel;
	}
}
?>


<div class="max1200" id="calc_list">
	<div class="tbl_head02 tbl_wrap mb_tbl">
		<form name="frm1" action="./kakao_pf.php" method="post" autocomplete="off">
			<input type="hidden" name="flag" value="1">
			<table class="avg">
			<caption><?php echo $g5['title']; ?> 목록</caption>
			<thead>
			<tr>
				<th>1:1상담 카카오채널 URL</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td style="padding: 5px; text-align:left;">
					<input type="text" name="kakao_pf" class="frm_input" value="<?=$config['cf_kakao_pf']?>" style="width:90%;">
					<input type="submit" class="btn_frmline" value="등록">
				</td>
			</tr>
			</tbody>
			</table>
		</form>
	</div>


</div>



<?php
include_once ('./admin.tail.php');
?>

