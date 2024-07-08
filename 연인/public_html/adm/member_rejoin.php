<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '중복가입이력';
include_once(G5_PATH.'/head.sub.php');

$row = sql_fetch(" SELECT mb_name, mb_birth, mb_sex, mb_hp, mb_si, mb_gu FROM g5_member WHERE mb_id = '{$mb_id}' ");
if (!$row) {
	echo "<script>alert('회원정보를 불러오는데 실패하였습니다. 다시 시도해 주세요.'); window.close();</script>";
	exit;
}

// 회원정보
$mb_name = $row['mb_name'];
$mb_birth = $row['mb_birth'];
$mb_sex = $row['mb_sex'];
$mb_hp = $row['mb_hp'];
$mb_si = $row['mb_si'];
$mb_gu = $row['mb_gu'];
$mb_age = (date("Y")+1) - substr($mb_birth, 0, 4);

// 중복가입이력
$rejoin = memberRejoinList($mb_hp, $mb_birth);

?>

<script>
// 새창팝업
function getWinPop(mode, mb_id) {
	var pop_w = 700, pop_h = 600, url = "", title = "연인";

	switch (mode) {
		case "profile" :	// 회원프로필
			url = g5_admin_url + "/member_form.php?w=u&mb_id=" + mb_id;
			pop_w = 1200;
			pop_h = 800;
			title = "회원프로필";
			break;

		case "list" :		// 소개이력
			pop_w = 750;
			url = g5_admin_url + "/matching_list_pop.php?mb_id=" + mb_id;
			title = "소개이력";
			break;
	}

	var left = Math.floor((window.innerWidth - pop_w) / 2),
		top = Math.floor((window.innerHeight - pop_h) / 2);

	var ts = new Date().getTime();
	title += " " + ts;

	window.open(url, title,"width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
}
</script>

<div id="popup_wrap" class="match">
	<p>중복가입이력</p>
	<div class="tbl_head02 tbl_wrap">
		<!-- 회원정보 -->
		<? include_once("./member_info_pop.php"); ?>
		<!-- //회원정보 -->

		<!-- 이력 -->
		<br>
		<table>
		<caption>중복가입이력</caption>
		<colgroup>
			<col width="">
		</colgroup>
		<thead>
		<tr>
			<th>No.</th>
			<th>회원구분</th>
			<th>이름</th>
			<th>성별</th>
			<th>연락처</th>
			<th>가입일자</th>
			<th>프로필</th>
			<th>소개이력</th>
		</tr>
		</thead>
		<tbody>
		<? if (count($rejoin) == 0) { ?>
		<tr>
			<td colspan="7" style="text-align:center;">정보가 없습니다.</td>
		</tr>
		<?
		} else {
			$list_no = count($rejoin);
			foreach ($rejoin AS $key=>$val) {
		?>
		<tr style="text-align:center;">
			<td><?=$list_no?></td>
			<td><?=$val['mb_status']?></td>
			<td><?=$val['mb_name']?></td>
			<td><?=$val['mb_sex']?></td>
			<td><?=$val['mb_hp']?></td>
			<td><?=substr($val['mb_datetime'], 2, 8)?></td>
			<td><button type="button" class="btn01" onclick="getWinPop('profile', '<?=$val['mb_id']?>')">보기</button></td>
			<td><button type="button" class="btn01" onclick="getWinPop('list', '<?=$val['mb_id']?>')">보기</button></td>
		</tr>
		<? $list_no--; }} ?>
		</tbody>
		</table>

		<br>
		<div class="btn_confirm01 btn_confirm">
			<a href="javascript:void(0);" onclick="getWinClose();">닫기</a>
		</div>
	</div>

</div>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>