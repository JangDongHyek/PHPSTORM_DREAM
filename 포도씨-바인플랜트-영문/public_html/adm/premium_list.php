<?php
$sub_menu = "230100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_premium ";

$sql_search = " where 1 ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "wr_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '프리미엄 신청내역';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 16;
?>

<style>
.mb_tbl table {text-align: center;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 <?php echo number_format($total_count) ?> 건
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="hidden" name="lv" value="<?=$_GET['lv']?>">
<input type="submit" class="btn_submit" value="검색">

</form>

<!--<div class="local_desc01 local_desc">
    <p>회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.</p>
</div>
-->

<form name="fpremiumlist" id="fpremiumlist" action="./premium_list_update.php" onsubmit="return fpremiumlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
	<tr>
		<!--<th scope="col">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>-->
        <th>No.</th>
		<th>아이디</th>
		<th>회사(단체)명</th>
		<th>담당자성함</th>
		<th>연락처</th>
        <th>이메일</th>
        <th>포도씨 파트너명</th>
		<th>신청일</th>
		<th>처리상태</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows * ($page - 1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
    ?>
	<tr class="<?php echo $bg; ?>">
        <td><?=$list_no?></td>
        <td><?=$row['mb_id']?></td>
		<td><?=$row['company_name']?></td>
		<td><?=$row['mb_name']?></td>
		<td><?=$row['mb_hp']?></td>
		<td><?=$row['mb_email']?></td>
        <td><?=$row['partner']?></td>
        <td><?=substr($row['wr_datetime'], 0, 10)?></td>
		<td>
            <?php if($row['mb_grade'] == 'Premium') { ?>
                완료
            <?php } else { ?>
            <select style="width: 50%;" name="state" onchange="status_change(<?=$row['idx']?>, this.value, '<?=$row['mb_id']?>')">
                <option <? if ($row['state'] == '대기') echo "selected"; ?> value="대기">대기</option>
                <option <? if ($row['state'] == '완료') echo "selected"; ?> value="완료">완료</option>
            </select>
            <?php } ?>
        </td>
	</tr>
    <?php
        $list_no--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<!--<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>-->

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&lv='.$lv.'&amp;page='); ?>

<script>

// 신청 상태 변경
function status_change(idx, val) {
    $.ajax({
        url: g5_admin_url+"/ajax.premium_state_change.php",
        type: "POST",
        data: {
            "idx": idx,
            "state": val,
        },
        success: function(data) {
            if (data != 1) {
                alert("상태 변경에 실패하였습니다.\n새로고침 후 다시 시도해주세요.");
            } else {
                alert("상태가 변경되었습니다.");
                location.href = location.href;
            }
        }
    });
}
</script>

<?php
include_once ('./admin.tail.php');
?>
