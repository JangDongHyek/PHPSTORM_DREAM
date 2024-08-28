<?
/**********************************
회원관리 > 매칭 > 검색결과
- 일반회원만 (블랙/탈퇴 제외)
- 다른성별
- 진행여부 등록한 회원만 노출
**********************************/
include_once('./_common.php');
if ($member['mb_level'] != "10") exit;

// 성별
$target_mb_sex = ($mb_sex == "남")? "여" : "남";

// 공통 조건문
$sql_search = " WHERE mb_level = '2' AND mb_status = '일반' AND mb_sex = '{$target_mb_sex}' "; 
$sql_search .= " AND mb_id IN (SELECT mb_id FROM g5_member_match WHERE helper_id = '{$member['mb_id']}' AND match_status = '1') ";

// 검색어
if ($sfl == "mb_birth") {
	$stx = (date("Y") + 1) - $_POST['stx'];
}

$sql_search .= " AND {$sfl} LIKE '%{$stx}%' ";

// 리스트
$sql = "SELECT mb_no,mb_id, mb_name, mb_birth, mb_sex, mb_hp, mb_si, mb_gu, mb_switch 
		FROM g5_member
		{$sql_search} ORDER BY mb_name ASC; ";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

$srch_arr = array();

for ($i = 0; $i < $result_cnt; $i++) {

    $srch_arr[$i] = sql_fetch_array($result);
}

?>
<table>
	<thead>
	<tr>
		<th>상태</th>
		<th>이름</th>
		<th>성별</th>
		<th>나이</th>
		<th>연락처</th>
		<th>지역</th>
		<th>선택</th>
	</tr>
	</thead>
	<tbody>
	<? if ($result_cnt == 0) { ?>
	<tr><td colspan="7">검색결과가 없습니다.</td></tr>
	<?
	} else {
		foreach($srch_arr as $key=>$row) {
            $coupon_count = getMemberCoupon($row['mb_no']);
            $heart_count = getMemberHeart($row['mb_no']);

			$mb_age = (date("Y") + 1) - $row['mb_birth'];
			$params = "'{$row['mb_no']}','{$row['mb_id']}', '{$row['mb_name']}', '{$row['mb_sex']}', '{$mb_age}', '{$row['mb_hp']}', '{$row['mb_si']}', '{$row['mb_gu']}','{$coupon_count}','{$heart_count}'";
	?>
	<tr>
		<td><?=$row['mb_switch']?></td>
		<td><?=$row['mb_name']?></td>
		<td><?=$row['mb_sex']?></td>
		<td><?=$mb_age?></td>
		<td><?=$row['mb_hp']?></td>
		<td><?=$row['mb_si']?></td>
		<td><a href="javascript:void(0)" onclick="setMatchTarget(<?=$params?>);">선택</a></td>
	</tr>
	<?
		}
	}
	?>
	</tbody>
</table>