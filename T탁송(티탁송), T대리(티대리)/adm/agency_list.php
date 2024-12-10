<?php
$sub_menu = 150100;
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} where mb_level = '9' ";

// 검색
if ($stx) {
	if ($sfl == "mb_1") {	//사업자번호
		$sql_common .= " AND {$sfl} like '%".preg_replace("/[^0-9]*/s", "", $stx)."%' ";
	} else {
	    $sql_common .= " AND {$sfl} like '%{$stx}%' ";
	}
}

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

// 페이징
$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);			// 전체 페이지 계산
if ($page < 1) $page = 1;							// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;					// 시작 열을 구함
$list_no = $total_count - ($rows * ($page - 1));	// 글번호(내림차순)

// 리스트
$sql = " select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = '대리점관리';
include_once('./admin.head.php');


?>


<style>
.mb_tbl table {text-align: center;}
.btn_area {float: right;}
.btn_area a {font-size: 0.95em; background: #999; padding: 3px 5px; color: #FFF; border-radius: 2px;}

#stx {
    -webkit-ime-mode:active;
    -moz-ime-mode:active;
    -ms-ime-mode:active;
    ime-mode:active;
}
</style>


<div class="local_ov01 local_ov">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>" class="ov_listall">전체목록</a>
    총 대리점 <?php echo number_format($total_count) ?>개
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" autocomplete="off">
	<label for="sfl" class="sound_only">검색대상</label>
	<select name="sfl" id="sfl">
		<option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>대리점명</option>
		<option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
		<option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
		<option value="mb_1"<?php echo get_selected($_GET['sfl'], "mb_1"); ?>>사업자번호</option>
	</select>
	<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input" >
	<input type="submit" class="btn_submit" value="검색">
</form>

<div class="local_desc01 local_desc">
    <p>승인여부가 [승인완료] 되어야 대리점 사용이 가능합니다.</p>
</div>

<?php if ($is_admin == 'super') { ?>
<div class="btn_add01 btn_add">
    <a href="./agency_form.php" id="member_add">대리점 등록</a>
</div>
<?php } ?>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
	<colgroup>
		<col width="3%">
		<col width="3%">
		<col width="7%">
		<col width="*">
		<col width="7%">
		<col width="7%">
		<col width="10%">
		<col width="7%">
		<col width="*">
		<col width="7%">
		<col width="3%">
		<col width="7%">
		<col width="5%">
		<col width="*">
		<col width="*">
	</colgroup>
    <thead>
	<tr>
		<th scope="col">
            <label for="chkall" class="sound_only">전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
		<th>No.</th>
		<th>승인여부</th>
		<th><?php echo subject_sort_link('mb_nick') ?>대리점명</a></th>
		<th>대표번호</th>
		<th><?php echo subject_sort_link('mb_1') ?>사업자번호</a></th>
		<th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
		<th>관리자메모</th>
		<th>연락처</th>
		<th>주소</th>
		<th>포인트</th>
		<th>가입일</th>
		<th>관리</th>
		<th>계약서</th>
	</tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$bg = 'bg'.($i%2);
        $mb_id = $row['mb_id'];

		if ($member['agency_no'] == "0") {
			// 대리점 agency_no 본인걸로 업데이트해줌
			sql_query("UPDATE g5_member SET agency_no = '{$row['mb_no']}' WHERE mb_id = '{$mb_id}'");
		}
    ?>
	<tr class="<?=$bg?>">
		<td>
			<input type="hidden" name="mb_id[<?=$i?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?=$i?>">
            <input type="checkbox" name="chk[]" value="<?=$i?>" id="chk_<?=$i?>">
		</td>
		<td><?=$list_no?></td>
		<td>
			<select name="mb_use[<?=$i?>]" data-idx="<?=$i?>">
				<option value="Y" <? if ($row['mb_use'] == "Y") echo "selected"; ?>>승인완료</option>
				<option value="N" <? if ($row['mb_use'] != "Y") echo "selected"; ?>>미승인</option>
			</select>
		</td>
		<td>
			<?=get_text($row['mb_nick'])?>
			<? if ($member['mb_level'] == "10") { ?>
			<div class="btn_area">
				<a href="./member_list.php?tab=1&sca=<?=$row['mb_no']?>" target="_blank">고객</a>
				<a href="./member_list.php?tab=2&sca=<?=$row['mb_no']?>" target="_blank">기사</a>
			</div>
			<? } ?>
		</td>
		<td><?=$row['mb_11']?></td>
		<td><?=getBizNum($row['mb_1'])?></td>
		<td><?=$mb_id?></td>
		<td><?=get_text($row['mb_name'])?></td>
		<td><?=nl2br($row['mb_memo'])?></td>
		<td><?=$row['mb_hp']?></td>
		<td><?=iconv_substr($row['mb_addr1'], 0, 2, "utf-8")?></td>
		<td><?=number_format($row['mb_point'])?></td>
		<td><?=substr($row['mb_datetime'],2,8)?></td>
		<td><a href="./agency_form.php?w=u&mb_id=<?=$mb_id?><? if (strlen($qstr) > 0) echo "&".$qstr; ?>">수정</a></td>
        <td><a href="javascript:void(0)" onclick="openContract('<?=$mb_id?>')">보기</a></td>
	</tr>
    <?php
		$list_no--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"10\" class=\"empty_table\">내역이 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
    <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
    <input type="submit" name="act_button" value="상태변경" onclick="document.pressed=this.value">
</div>

</form>

<?
$paging_params = get_paging_params($qstr);
echo get_paging($config['cf_write_pages'], $page, $total_page, '?'.$paging_params);
?>

<script>
$(".mb_tbl select").on("change", function() {
	var idx = $(this).data("idx");
	if (typeof idx != "undefined") {
		$("#chk_" + idx).prop("checked", true);
	}
});

function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "상태변경") {
        if(!confirm("선택한 대리점의 상태를 변경하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

// 계약서보기
var child = "";
function openContract(mb_id) {
    var pop_w = 500,
        pop_h = 700,
        left = Math.floor((window.innerWidth - pop_w) / 2),
        top = Math.floor((window.innerHeight - pop_h) / 2);

    child = window.open(g5_admin_url + "/member_contract.php?lv=9&mb_id=" + mb_id, "기사 계약서", "width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
}
</script>

<?php
include_once ('./admin.tail.php');
?>
