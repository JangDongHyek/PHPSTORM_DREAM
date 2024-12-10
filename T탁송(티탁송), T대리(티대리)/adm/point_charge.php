<?php
$sub_menu = 260200;
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " FROM g5_payment A LEFT JOIN g5_member B On A.mb_id = B.mb_id WHERE (1) ";

// 대리점 카테고리
if ($sca != "")
	$sql_common .= " AND B.agency_no = '{$sca}' ";

// 검색
if ($stx) {
	if ($sfl == "mb_name" || $sfl == "mb_hp")
		$sql_common .= " AND B.{$sfl} LIKE '%{$stx}%' ";
	else 
		$sql_common .= " AND A.{$sfl} LIKE '%{$stx}%' ";
}

if (!$sst) {
    $sst = "idx";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

// 페이징
$sql = " select count(*) as cnt {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);			// 전체 페이지 계산
if ($page < 1) $page = 1;							// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;					// 시작 열을 구함
$list_no = $total_count - ($rows * ($page - 1));	// 글번호(내림차순)

// 리스트
$sql = " select A.*, B.mb_name, B.agency_no, B.mb_hp {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = '계좌입금내역';
include_once('./admin.head.php');

?>

<div class="local_ov01 local_ov">
    <a href="./<?=basename($_SERVER["PHP_SELF"])?>" class="ov_listall">전체목록</a>
    총 <?php echo number_format($total_count) ?>개
</div>

<form id="fsearch" name="fsearch" class="local_sch" method="get">
	<div class="local_sch01">
		<label for="sfl" class="sound_only">검색대상</label>
		<? 
		if ($member['mb_level'] == "10") { 
			$rst = sql_query("SELECT mb_no, mb_nick FROM g5_member WHERE mb_level = '9' ORDER BY mb_nick ASC;");
			$rst_cnt = sql_num_rows($rst);
			if ($rst_cnt > 0) { 
		?>
		<select name="sca" onchange="document.fsearch.submit();">
			<option value="">대리점전체</option>
			<? while($agency = sql_fetch_array($rst)) { ?>
			<option value="<?=$agency['mb_no']?>" <? if ($sca == $agency['mb_no']) echo "selected"; ?>><?=$agency['mb_nick']?></option>
			<? } ?>
		</select>
		<? 
			}
		}
		?>
		<select name="sfl" id="sfl">
			<option value="pg_moid"<?php echo get_selected($_GET['sfl'], "pg_moid"); ?>>주문번호</option>
			<option value="pg_vacctNo"<?php echo get_selected($_GET['sfl'], "pg_vacctNo"); ?>>전용계좌번호</option>
			<option value="pg_vbankAcctNm"<?php echo get_selected($_GET['sfl'], "pg_vbankAcctNm"); ?>>입금자명</option>
			<option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>고객명</option>
			<option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰</option>
		</select>
		<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
		<input type="submit" class="btn_submit" value="검색">
	</div>
</form>

<form name="flist" id="flist" action="" onsubmit="return flist_submit(this);" method="post">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap" style="text-align: center;">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
	<colgroup>
		<col width="*">
	</colgroup>
    <thead>
	<tr>
		<th rowspan="2">No.</th>
		<th rowspan="2">거래일자</th>
		<th rowspan="2">이노페이 주문번호</th>
		<th rowspan="2">금액</th>
		<th colspan="2">입금정보</th>
		<th colspan="3">고객정보</th>
	</tr>
	<tr>
		<th>전용계좌번호</th>
		<th>입금자명</th>
		<th>이름</th>
		<th>휴대폰</th>
		<th>대리점</th>
	</tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$bg = 'bg'.($i%2);
        $mb_id = $row['mb_id'];

		// 대리점
		$agency = sql_fetch("SELECT mb_nick FROM g5_member WHERE mb_no = '{$row['agency_no']}'");
    ?>
	<tr class="<?=$bg?>">
		<td><?=$list_no?></td>
		<td><?=$row['pg_datetime']?></td>
		<td><?=$row['pg_moid']?></td>
		<td><?=number_format($row['pg_amt'])?>원</td>
		<td><?=$row['pg_vacctNo']?></td>
		<td><?=$row['pg_vbankAcctNm']?></td>
		<td><a href="./member_form.php?w=u&mb_id=<?=$mb_id?>"><?=$row['mb_name']?></a></td>
		<td><?=$row['mb_hp']?></td>
		<td><?=$agency['mb_nick']?></td>
	</tr>
    <?php
		$list_no--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"15\" class=\"empty_table\">내역이 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

</form>

<?php
include_once ('./admin.tail.php');
?>
