<?php
/************************************************
콜내역

$is_customer = 기사, 고객 구분
************************************************/
include_once('./_common.php');

// 고객, 기사 구분
$is_customer = ($member['mb_level'] == "2")? true : false;

$sql_common = " FROM g5_call WHERE agency_no = '{$member['agency_no']}'";

if ($_POST['m'] == "my") {	// 콜접수내역 (내 콜만)
	if ($is_customer)		
		$sql_common .= " AND mb_id = '{$member['mb_id']}'";
	else
		$sql_common .= " AND driver_id = '{$member['mb_id']}'";

} else {					// 인덱스 (상태가 대기인 콜만)
	$sql_common .= " AND (call_status = '0' OR (call_status = '1' AND driver_id = '{$member['mb_id']}') )";
}

// 범위 쿼리 추가
// $sql_common .= "";


// 페이징
$page = $_POST['page'];
$sql = " SELECT COUNT(*) AS cnt {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$list_rows = 10;												// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);				// 전체페이지

if ((int)$page > $total_page) {
	if ($total_count == 0) {
		$page = $total_page;
	} else {
		// 마지막 페이지 없으면 종료
		die("end");
	}
}

if ($page < 1) $page = 1;
$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가

// 리스트
$sql = "SELECT * {$sql_common} ";
$sql .= "ORDER BY (CASE call_status WHEN '2' THEN 2 ELSE 1 END) ASC, idx DESC {$sql_limit}";

$result = sql_query($sql);
$result_cnt = sql_num_rows($result);


if ($_POST['m'] == "my")	// 1) 내가진행한 콜
	$empty_txt = "콜접수내역이 없습니다.";
else						// 2) 인덱스
	$empty_txt = "콜 대기중입니다.";
if ($is_customer) $empty_txt = "여정내역이 없습니다.";


// 콜내역 없으면
if ($result_cnt == 0) { 
?>
<li>
	<div style="color:<? echo ($is_customer)? "#333" : "#FFF"; ?>; padding: 20px; font-size: 1.15em;"><?=$empty_txt?></div>
</li>
<?
//  콜내역 있으면
} else {
	while($row = sql_fetch_array($result)) {
		$idx = $row['idx'];

		// 총금액
		$amt = (int)$row['call_total_price'] / 1000;
?>
<li onclick="getCallView('<?=$idx?>')" id="box<?=$idx?>">
	<? if (!$is_customer) { ?>
	<!-- 기사면 출발지까지 거리계산 -->
	<div class="km">
		<p><!--<?=$row['call_dist']?>--> 0km</p>
	</div>
	<? } ?>
	<div class="info">
		<div class="d1">
			<!--<p>출발지까지 500m</p> -->
			<p><span>출발지</span> <strong><?=$row['start_place']?></strong></p>
			<? if ($row['pass_place'] != "") { ?><p><span>경유지</span> <strong><?=$row['pass_place']?></strong></p><? } ?>
			<p><span>도착지</span> <strong><?=$row['end_place']?></strong></p>
		</div>
	</div>
	<div class="info2">
		<div class="consign">
			<span class="<?=$calltype_class[$row['call_type']]?>"><?=$calltype_name[$row['call_type']]?></span>
			<? if ((int)$row['call_5t_price'] > 0) { ?><span>2.5톤이상</span><? } ?>
		</div>
		<div class="d2">
			<? if ($is_customer) { ?>
			<!-- 고객이면 거리 노출 -->
			<span><?=$row['call_dist']?>km</span>
			<? } ?>
			<span class="price"><?=$amt?></span>
		</div>
	</div>

	<!-- 진행상태 (수정시 statusUpdate() 함수수정)-->
	<? if ($row['call_status'] == "-1") { ?><div class="state off">취소</div><? } ?>
	<? if ($row['call_status'] == "1") { ?><div class="state on">진행중</div><? } ?>
	<? if ($row['call_status'] == "2") { ?><div class="state off">진행완료</div><? } ?>

</li>
<?
	} // end while
}	// end if 
?>
