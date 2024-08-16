<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$exc_mb_id = " mb_id != 'lets080' AND mb_leave_date = '' ";

$sql_common = " from {$g5['member_table']} WHERE (1) AND {$exc_mb_id} ";

// 조건절 추가하면 ./excel.member_list.php도 추가
if ($stx && $sfl) {
	if ($sfl == "mb_route") {
		$sql_common .= " AND (mb_route LIKE '%{$stx}%' OR mb_route_input LIKE '%{$stx}%')";
	} else {
	    $sql_common .= " AND {$sfl} LIKE '%{$stx}%'";
	}
}
if (strlen($spt) > 0) {	// 입금확인
	if ($spt == "1") {
		$sql_common .= " AND mb_bank_date != '' ";
	} else {
		$sql_common .= " AND mb_bank_date = '' ";
	}
}

$sca = ($_REQUEST['sca'] != '')? $_REQUEST['sca'] : 0;
if ((int)$sca > 0) {
	$sql_common .= " AND mb_group = '{$sca}' ";
}

if (!$sst) {
    $sst = "mb_no"; //"mb_datetime";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

// 페이징
$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_no = $total_count - ($rows * ($page - 1));		// 글번호(내림차순)

/*
// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];
*/

// 리스트
$sql = " select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);


// 증정품
$gift_list = getGiftList('all');
$gift = array();
foreach ($gift_list as $Key=>$val) {
	$gift[$val['idx']] = $val['gf_name'];
}


$g5['title'] = '회원목록';
include_once('./admin.head.php');


// 총회원수
//number_format($total_count)
$rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE {$exc_mb_id}");
$mb_cnt = number_format($rs['cnt']);	

// 입금, 미입금자수
$rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE mb_bank_date != '' AND {$exc_mb_id}");
$bk_cnt1 = number_format($rs['cnt']);

$rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE mb_bank_date = '' AND {$exc_mb_id}");
$bk_cnt2 = number_format($rs['cnt']);

?>

<div class="local_ov01 local_ov">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>" class="ov_listall">전체목록</a>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"><?=$mb_cnt?>명</span></span>
    <a href="?spt=1" class="btn_ov01"> <span class="ov_txt">입금 </span><span class="ov_num"><?=$bk_cnt1?>명</span></a>
	<a href="?spt=2" class="btn_ov01"> <span class="ov_txt">미입금 </span><span class="ov_num"><?=$bk_cnt2?>명</span></a>
	<!--
	<a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">차단 </span><span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">탈퇴  </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
	-->
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
	<label for="sfl" class="sound_only">검색대상</label>
	<select name="sfl" id="sfl">
		<option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
		<option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
		<option value="mb_route"<?php echo get_selected($_GET['sfl'], "mb_route"); ?>>가입경로</option>
		<!--
		<option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
		<option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
		<option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
		<option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
		<option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
		<option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
		<option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
		<option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
		<option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
		-->
	</select>
	<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
	<input type="submit" class="btn_submit" value="검색">

	<?
	$cate_list = $member_group;
	array_unshift($cate_list, "전체");
	?>
	<div class="tab">
		<input type="hidden" name="sca" value="<?=$sca?>">
		<? 
		foreach ($cate_list as $key=>$val) { 
			$_tmp = "";
			if ($stx != "") $_tmp = "&stx={$stx}&sfl={$sfl}";
		?>
		<a href="./member_list.php?sca=<?=$key?><?=$_tmp?>" <?if ($key == $sca) echo "class='on'"; ?>><?=$val?></a>
		<? } ?>
	</div>
</form>

<!--
<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
-->


<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
	<table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
	<colgroup>
	<!--<col width="5%">-->
	<col width="4%">
	<col width="5%">
	<col width="*">
	<col width="12%">
	<col width="*">
	<col width="*">
	<col width="*">
	<col width="8%">
	<col width="18%">
	<col width="*">
	<col width="*">
	<col width="*">
	<col width="*">
	<col width="*">
	<col width="*"> 
	<col width="*">
	</colgroup>
    <thead>
    <tr>
		<!--
        <th scope="col" rowspan="2">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
		-->
		<th scope="col" rowspan="2">No.</th>
		<th scope="col" rowspan="2">가입구분</th>
		<th scope="col" rowspan="2">가입경로</th>
		<th scope="col" rowspan="2">증정품</th>
		<th scope="col" rowspan="2">아이디</th>
		<th scope="col" rowspan="2">이름</th>
		<th scope="col" rowspan="2">성별</th>
		<th scope="col" rowspan="2">행사명</th>
		<th scope="col" rowspan="2">지역</th>
		<th scope="col" rowspan="2">생년월일</th>
		<th scope="col" rowspan="2">휴대폰</th>
		<th scope="col" rowspan="2">가입일</th>
		<th scope="col" colspan="2">입금상태</th>
		<th scope="col" rowspan="2">회원증서</th>
		<th scope="col" rowspan="2">관리</th>
	</tr>
	<tr>
		<th scope="col">가입비</th>
		<th scope="col">입금확인일</th>
	</tr>
	</thead>
	<tbody>
	<?
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		/*
		$leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);
		*/
        $bg = 'bg'.($i%2);
        $mb_id = $row['mb_id'];

		// 회원구분
		$mb_level = (int)$row['mb_level'];
		$mb_group = $member_group[$row['mb_group']];

		if ($mb_level == 10) {
			$mb_group = "관리자";
		} else if ($mb_level == 8) {
			$mb_group = "관리자(제휴)";
		}

		// 입금확인일
		$mb_bank_date = ($row['mb_bank_date'])? $row['mb_bank_date'] : "미입금";

		// 가입경로
		$mb_route = $row['mb_route'];
		if ($row['mb_route_input'] != "") $mb_route .= "<br>({$row['mb_route_input']})";

		// 회원증서
		$mb_cert = "";
		if ($row['mb_cert_img'] != "" && file_exists(MB_CERT_PATH."/".$row['mb_cert_img'])) {
			$cert_url = MB_CERT_URL."/".$row['mb_cert_img'];
			$mb_cert = '<a href="javascript:void(0)" onclick="window.open(\''.$cert_url.'\', \'_blank\')">보기</a>';
		}
	?>
	<tr class="<?=$bg?>">
		<!--
        <td>
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </td>
		-->
		<td><?=$list_no?></td>
		<td><?=$mb_group?></td>
		<td><?=$mb_route?></td>
		<td><?=$gift[$row['mb_gift_idx']]?></td>
		<td><?=$mb_id?></td>
		<td><a href="./member_view.php?mb_id=<?=$mb_id?>" style="color: #3f51b5; font-weight: bold;"><?=$row['mb_name']?></a></td>
		<td><?=$row['mb_sex']?></td>
		<td><?=$row['mb_event_name']?></td>
		<td class="td_left">
			<? if ($row['mb_zip1'] && $row['mb_zip2']) echo "(".$row['mb_zip1'].$row['mb_zip2'].") "; ?> <?=$row['mb_addr1']?>	<? if ($row['mb_addr2']) echo "<br>".$row['mb_addr2']; ?>
		</td>
		<td><?=$row['mb_birth']?></td>
		<td><?=$row['mb_hp']?></td>
		<td><?=substr($row['mb_datetime'], 0, 10)?></td>
		<!-- 가입비, 입금확인일 -->
		<td><?=number_format($row['mb_bank_amt']);?>원</td>
		<td><?=$mb_bank_date?></td>
		<td><?=$mb_cert?></td>
		<td class="td_mng"><a href="./member_form.php?w=u&mb_id=<?=$mb_id?><?if ($qstr) echo "&".$qstr; ?>" class="btn btn_03">수정</a></td>
	</tr>
	<?
		$list_no--;
	}

	if ($i == 0) {
	?>
	<tr><td colspan="20" class="empty_table">조회된 내역이 없습니다.</td></tr>
	<? } ?>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<!--
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
	-->
    <? if ($is_admin == 'super') { 
		$params = getenv("QUERY_STRING"); 
	?>
	<a href="./excel.member_list.php?<?=$params?>" class="btn btn_04">엑셀다운</a>
    <a href="./member_form.php" id="member_add" class="btn btn_01">회원추가</a>
    <? } ?>
</div>


</form>

<?php 
$paging_params = get_paging_params($qstr);
echo get_paging($config['cf_write_pages'], $page, $total_page, '?'.$paging_params);
?>

<script>
function fmemberlist_submit(f)
{
	return false;

    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }
	
    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
