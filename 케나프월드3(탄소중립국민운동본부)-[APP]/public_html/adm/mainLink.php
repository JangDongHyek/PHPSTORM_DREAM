<?php
$sub_menu = "600400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '메인링크 관리';
include_once('./admin.head.php');

$cf_8_value = $_POST["cf_8"];
$cf_9_value = $_POST["cf_9"];

if($cf_8_value || $cf_9_value) {
	$cf_8_value = str_replace("http://", "", $cf_8_value);
	$cf_8_value = str_replace("https://", "", $cf_8_value);
	$cf_9_value = str_replace("http://", "", $cf_9_value);
	$cf_9_value = str_replace("https://", "", $cf_9_value);

	$sql = "UPDATE g5_config SET cf_8 = '{$cf_8_value}', cf_9 = '{$cf_9_value}'";
	sql_query($sql);
	goto_url(G5_ADMIN_URL . "/mainLink.php");
}
?>

<section>
    <h2 class="h2_frm"></h2>
    <form name="linkFrm" method="post" action="?" autocomplete="off">
		<div class="tbl_frm01 tbl_wrap">
			<table>
				<colgroup>
					<col class="grid_4">
					<col>
				</colgroup>
				<tr>
					<th scope="row"><label for="cf_8">동영상 링크<strong class="sound_only">필수</strong></label></th>
					<td>
						<input type="text" name="cf_8" id="cf_8" class="frm_input" size="80" value="<?=$config["cf_8"]?>">
						<a href="<? echo ($config["cf_8"])? "http://".$config["cf_8"] : "javascript:void(0)" ?>" target="_blank">바로가기</a>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="cf_9">블로그 링크<strong class="sound_only">필수</strong></label></th>
					<td>
						<input type="text" name="cf_9" id="cf_9" class="frm_input" size="80" value="<?=$config["cf_9"]?>">
						<a href="<? echo ($config["cf_9"])? "http://".$config["cf_9"] : "javascript:void(0)" ?>" target="_blank">바로가기</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="btn_confirm01 btn_confirm">
			<input type="submit" value="확인" class="btn_submit">
		</div>
    </form>
</section>

<?php
include_once ('./admin.tail.php');
?>
