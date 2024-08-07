<?php
$sub_menu = "200120";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '회원문자목록';
include_once('./admin.head.php');

// 페이징
$sql = " SELECT COUNT(*) AS cnt FROM g5_sms";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$list_rows = 20;	//$config['cf_page_rows'];				// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);				// 전체페이지
if ((int)$page > $total_page) $page = $total_page;

if ($page < 1) $page = 1;
$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가

$list_page_rows = 10;										// 한블록 개수
$list_no = $total_count - ($list_rows * ($page - 1));		// 글번호(내림차순)

// 리스트
$sql = "SELECT * FROM g5_sms ORDER BY idx DESC ";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);



if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") {
	// 230209. sms, mms 발송개수 
	$add_query = ""; //" where sms_date >= '2021-05-01 00:00:00' ";
	$sql2 = "select idx, sms_type, sms_img1, sms_img2, (length(sms_rcv_id) - length(replace(sms_rcv_id, ',', '')) +1) as cnt from g5_sms {$add_query} order by idx desc";
	$result2 = sql_query($sql2);
	$result_cnt2 = sql_num_rows($result2);
	$send_count = ['sms'=>0, 'lms'=>0, 'mms'=>0];

	for ($ii = 0; $rs = sql_fetch_array($result2); $ii++) {
		if ($rs['sms_type'] == 4) $send_count['sms'] += (int)$rs['cnt'];
		else if ($rs['sms_type'] == 6) {
			if ($rs['sms_img1'] == '' && $rs['sms_img2'] == '') $send_count['lms'] += (int)$rs['cnt'];  
			else $send_count['mms'] += (int)$rs['cnt'];
		}
	}
}

?>

<? /*
<!-- 검색창 -->
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
	<select name="sfl">
		<option value="">선택하세요</option>
	</select>
	<input type="text" name="stx" class="frm_input">
	<input type="button" class="btn_submit" value="검색">
</form>
<!-- //검색창 -->
*/ ?>

<? if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") { ?>
<div>
	<strong>발송개수</strong> sms: <?=$send_count['sms']?>건, mms: <?=$send_count['mms']?>, lms: <?=$send_count['lms']?>건
</div>
<br>
<? } ?>

<!-- 회원목록 -->
<div class="tbl_head01 tbl_wrap left">
	<table>
	<caption>회원목록</caption>
	<colgroup>
	<col width="10%">
	<col width="10%">
	<col width="15%">
	<col width="15%">
	<col width="*">
	<col width="15%">
	</colgroup>
	<thead>
	<tr>
		<th>No.</th>
		<th>구분</th>
		<th>발신일자</th>
		<th>발신번호</th>
		<th>내용</th>
		<th>수신회원</th>
	</tr>
	</thead>
	<tbody>
	<? if ($result_cnt == 0) { ?>
	<tr><td colspan='6'>발송내역이 없습니다.</td></tr>
	<?
	} else {
		while($row = sql_fetch_array($result)) {

		// mms 이미지
		$mms_img = "";
		if ($row['sms_img1'] != "" && file_exists($row['sms_img1'])) {
			$mms_img = str_replace(G5_DATA_PATH, G5_DATA_URL, $row['sms_img1']);
		}
		$mms_img2 = "";
		if ($row['sms_img2'] != "" && file_exists($row['sms_img2'])) {
			$mms_img2 = str_replace(G5_DATA_PATH, G5_DATA_URL, $row['sms_img2']);
		}

		// 구분
		$sms_type = ($row['sms_type'] == '4')? 'SMS' : 'MMS';
		if ($row['sms_type'] == '6' && $mms_img == '' && $mms_img2 == '') $sms_type = 'LMS';

		// 수신회원
		$member_cnt = explode(',', $row['sms_rcv_id']);
	?>
	<tr>
		<td><?=$list_no?></td>
		<td><?=$sms_type?></td>
		<td><?=date('Y-m-d H:i:s', strtotime($row['sms_date']))?></td>
		<td><?=$row['sms_send_num']?></td>
		<td class="td_left">
			<? if ($mms_img != "") { ?>
			<div><img src="<?=$mms_img?>" style="max-height: 100px;"></div>
			<? } ?>
			<? if ($mms_img2 != "") { ?>
			<div><img src="<?=$mms_img2?>" style="max-height: 100px;"></div>
			<? } ?>
			<?=nl2br($row['sms_msg'])?>
		</td>
		<td>
			<!-- 수신회원 -->
			<a href="javascript:void(0)" onclick="getPopup(<?=$row['idx']?>)" style="font-weight: 750;"><?=count($member_cnt)?>명</a>
		</td>
	</tr>
	<? 
		$list_no--;
		}
	}
	?>
	</tbody>
	</table>
</div>

<script>
// 새창팝업 가운데 불러오기
function getPopup(idx) {
	var pop_w = window.innerWidth/2,
		pop_h = window.innerHeight/2,
		left = Math.floor((window.innerWidth - pop_w) / 2),
		top = Math.floor((window.innerHeight - pop_h) / 2);

	window.open(g5_admin_url + "/sms_view.php?idx=" + idx, "회원문자목록 상세", "width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");	
}
</script>