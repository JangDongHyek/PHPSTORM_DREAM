<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";


$sql_search = " where mb_level in (2,3) ";

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

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
	$sql_search .= " and mb_id != 'lets080' and mb_id != 'admin' ";

if (!$sst) {
    $sst = "mb_datetime";
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

/*// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];*/

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
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
    총회원수 <?php echo number_format($total_count) ?>명<!-- 중,
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php /*echo $sfl */?>&amp;stx=<?php /*echo $stx */?>">차단 <?php /*echo number_format($intercept_count) */?></a>명,
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php /*echo $sfl */?>&amp;stx=<?php /*echo $stx */?>">탈퇴 <?php /*echo number_format($leave_count) */?></a>명-->
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_company_name"<?php echo get_selected($_GET['sfl'], "mb_company_name"); ?>>회사명</option>
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

<?php if ($is_admin == 'super') { ?>
<div class="btn_add01 btn_add">
    <ul class="cate">
        <li <? if ($lv == "") echo 'class="on"'; ?> data-lv="">전체</li>
        <li <? if ($lv == "일반") echo 'class="on"'; ?> data-lv="일반">일반</li>
        <li <? if ($lv == "기업") echo 'class="on"'; ?> data-lv="기업">기업</li>
    </ul>
    <a href="./member_form.php" id="member_add" style="visibility: hidden;">회원추가</a>
    <?php if($private) { ?>
    <!--<a href="./member_exceldownload.php">엑셀다운로드</a>-->
    <?php } ?>
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
        <?php if($private) { ?>
        <!--<th scope="col">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>-->
        <?php } ?>
        <th>No.</th>
        <th>구분</th>
		<th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th>닉네임</th>
		<th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
        <th>회사명</th>
		<th>휴대폰</th>
		<th>이메일</th>
        <th>수신동의</th>
        <th>등급</th>
        <th>NM</th>
        <th>BUNKER</th>
		<th>가입일</th>
        <th>이용상태</th>
		<th>관리</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows * ($page - 1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_no='.$row['mb_no'].'">보기</a>';
        $bg = 'bg'.($i%2);

        $txtColor = empty($row['mb_intercept_date']) ? 'blue' : 'red';
    ?>
	<tr class="<?php echo $bg; ?>">
        <?php if($private) { ?>
        <!--<td>
            <input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
        </td>-->
        <?php } ?>
        <td><?=$list_no?></td>
        <td><?=$row['mb_category']?></td>
		<td><?=$row['mb_id']?></td>
		<td><?=$row['mb_nick']?></td>
		<td><?=get_text($row['mb_name'])?></td>
        <td><?=$row['mb_company_name']?></td>
		<td><?=$row['mb_hp']?></td>
		<td><?=$row['mb_email']?></td>
        <td><?=$row['mb_push']?></td>
        <td><?=$row['mb_grade']?></td>
        <td><?=number_format($row['mb_grade_point'])?></td>
        <td><?=number_format($row['mb_bunker'])?></td>
		<td><?=substr($row['mb_datetime'],0,10)?></td>
        <td style="color: <?=$txtColor?>"><?=empty($row['mb_intercept_date']) ? '정상' : '정지';?></td>
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

<?php if($private) { ?>
<!--<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="이용정지" onclick="document.pressed=this.value">
</div>-->
<?php } ?>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&lv='.$lv.'&amp;page='); ?>

<script>
function fmemberlist_submit(f) {
    if (!is_checked("chk[]")) {
        alert("이용정지할 회원을 선택하세요.");
        return false;
    }

    if(document.pressed == "이용정지") {
        if(!confirm("이용정지 처리하시겠습니까?")) {
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
