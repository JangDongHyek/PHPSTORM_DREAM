<?php
$sub_menu = "200400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where mb_level in (2,3) and secession = 'Y' ";

// 회원구분
if(!empty($lv)) {
    $sql_search .= " and mb_category = '{$lv}' ";
}

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
    $sst = "secession_date";
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

$g5['title'] = '탈퇴신청내역';
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
    총 <?php echo number_format($total_count) ?>건
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

<?php if ($is_admin == 'super') { ?>
<div class="btn_add01 btn_add">
    <ul class="cate">
        <li <? if ($lv == "") echo 'class="on"'; ?> data-lv="">전체</li>
        <li <? if ($lv == "일반") echo 'class="on"'; ?> data-lv="일반">일반</li>
        <li <? if ($lv == "기업") echo 'class="on"'; ?> data-lv="기업">기업</li>
    </ul>
    <a href="./member_form.php" id="member_add" style="visibility: hidden;">회원추가</a>
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
    <thead>
	<tr>
		<th scope="col">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th>No.</th>
        <th>구분</th>
		<th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th>닉네임</th>
		<th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
		<th>휴대폰</th>
		<th>이메일</th>
        <th>등급</th>
        <th>NM</th>
        <th>BUNKER</th>
		<th>가입일</th>
        <th>탈퇴신청일</th>
		<th>관리</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows * ($page - 1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">보기</a>';
        $bg = 'bg'.($i%2);
    ?>
	<tr class="<?php echo $bg; ?>">
		<td>
			<input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
		</td>
        <td><?=$list_no?></td>
        <td><?=$row['mb_category']?></td>
		<td><?=$row['mb_id']?></td>
		<td><?=$row['mb_nick']?></td>
		<td><?=get_text($row['mb_name'])?></td>
		<td><?=$row['mb_hp']?></td>
		<td><?=$row['mb_email']?></td>
        <td><?=$row['mb_grade']?></td>
        <td><?=number_format($row['mb_grade_point'])?></td>
        <td><?=number_format($row['mb_bunker'])?></td>
		<td><?=substr($row['mb_datetime'],0,10)?></td>
        <td><?=substr($row['secession_date'],0, 10)?></td>
		<td><?=$s_mod?></td>
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

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="회원탈퇴" onclick="document.pressed=this.value">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&lv='.$lv.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert("탈퇴할 회원을 선택하세요.");
        return false;
    }

    if(document.pressed == "회원탈퇴") {
        if(!confirm("탈퇴처리하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

// 회원구분 변경
$("ul.cate li").on("click", function() {
    var level = $(this).data("lv"),
        params = "",
        sfl = $("#sfl").val(),
        stx = $("#stx").val();

    if (level != "") {
        params += "?lv=" + level;
    }

    if (stx != "") {
        params += (params == "")? "?" : "&";
        params += "sfl=" + sfl + "&stx=" + stx;
    }

    location.href = g5_admin_url + "/member_list.php" + params;
});
</script>

<?php
include_once ('./admin.tail.php');
?>