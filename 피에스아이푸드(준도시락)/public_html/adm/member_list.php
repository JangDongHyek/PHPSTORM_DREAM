<?php
$sub_menu = "200100";
include_once('./_common.php');

// 회원관리

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";
$sql_search = " where mb_level = 2 ";
$sql_order = " order by mb_datetime desc ";

if ($stx) {
    $sql_search .= " and {$sfl} like '%{$stx}%' ";
}

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<style>
    .mb_tbl table {text-align: center;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 <?php echo number_format($total_count) ?>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>업체명&현장명</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">
</form>

<!--<div class="local_desc01 local_desc">
    <p>회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.</p>
</div>-->

<?php if ($is_admin == 'super' && $private) { ?>
<!--<div class="btn_add01 btn_add">-->
<!--    <a href="./excel_download_member.php?--><?//=$qstr?><!--" id="member_excel">엑셀다운로드</a>-->
<!--</div>-->
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
		<!--<th scope="col">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>-->
        <th>No.</th>
		<th>아이디</th>
		<th>업체명&현장명</th>
		<th>휴대번호</th>
        <th>명세서수신이메일</th>
        <th>결제방법</th>
        <th>SNS가입</th>
		<th>가입일</th>
		<th>관리</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows*($page-1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">보기/수정</a>';

        $bg = 'bg'.($i%2);

        $sns = '';
        if($row['sns'] == 'naver') {
            $sns = '네이버';
        } else if($row['sns'] == 'kakao') {
            $sns = '카카오';
        }
    ?>
	<tr class="<?php echo $bg; ?>">
		<!--<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
        <td><?=$list_no?></td>
		<td><?=$row['mb_id']?></td>
		<td><?=get_text($row['mb_name'])?></td>
		<td><?=$row['mb_hp']?></td>
        <td><?=$row['send_email']?></td>
        <td><?=$row['payment']?></td>
        <td><?=$sns?></td>
		<td><?=substr($row['mb_datetime'],0,10)?></td>
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

<!--<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>-->
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fmemberlist_submit(f) {
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
