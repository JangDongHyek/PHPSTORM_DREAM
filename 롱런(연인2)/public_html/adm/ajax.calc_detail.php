<?
/**********************************
정산현황 > 리스트 클릭시 상세보기
**********************************/
include_once('./_common.php');

//print_r($_POST);

$adm_flag = ($member['mb_status'] == "관리자")? true : false;

$match_type = $match_type_arr[$_POST['t']];	// 계좌결제소개, 폰&카드소개, 쿠폰소개, 하트소개


// 조건문
if ($srch_t == "2") {
	$start_date = $srch_date."-01";
	$end_date = date("Y-m-d", strtotime("+1 month", strtotime($start_date))); // 다음달1일
} else {
	$start_date = $srch_date;
	$end_date = date("Y-m-d", strtotime("+1 day", strtotime($srch_date)));	// 다음날
	
}
$sql_common = " AND match_date >= '{$start_date}' AND match_date < '{$end_date}'";

$sql = "SELECT idx, mb_id, target_id FROM g5_matching
		WHERE helper_id = '{$helper_id}' AND match_type = '{$match_type}' 
		{$sql_common} 
		ORDER BY match_date DESC
		";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);


?>
<div class="tbl_head02 tbl_wrap">
	<table>
	<thead>
	<tr>
		<th>No.</th>
		<th>남자회원</th>
		<th>여자회원</th>
		<? if ($adm_flag) { ?><th>관리</th><? } ?>
	</tr>
	</thead>
	<tbody>
	<? if ($result_cnt == 0) { ?>
	<tr><td colspan="4">조회 내역이 없습니다.</td></tr>
	<? 
	} else {
		$list_num = $result_cnt;
		while($row = sql_fetch_array($result)) {
			// 회원이름조회
			$sql = "SELECT mb_name, mb_sex,
					(SELECT mb_name FROM g5_member WHERE mb_id = '{$row['target_id']}') as target_name,
					(SELECT mb_sex FROM g5_member WHERE mb_id = '{$row['target_id']}') as target_sex 
					FROM g5_member WHERE mb_id = '{$row['mb_id']}'";
			$rs = sql_fetch($sql);

			if ($rs['mb_sex'] == "남") {
				$male_name = $rs['mb_name'];
				$female_name = $rs['target_name'];
			} else {
				$male_name = $rs['target_name'];
				$female_name = $rs['mb_name'];
			}
	?>
	<tr>
		<td><?=$list_num?></td>
		<td><?=$male_name?></td>
		<td><?=$female_name?></td>
		<? if ($adm_flag) { ?><td><button type="button" class="btn02" onclick="fnListDel('<?=$row['idx']?>', '<?=$_POST['t']?>', '<?=$helper_id?>');">삭제</button></td><? } ?>
	</tr>
	<? 
			$list_num--;
		} // end while
	}
	?>
	</tbody>
	</table>
</div>