<?php
$sub_menu = "270100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_profile_event where 1=1 ";

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

$g5['title'] = '나만의프로필';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 8;
?>

<style>
.mb_tbl table {text-align: center;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 프로필 수 <?php echo number_format($total_count) ?>건
</div>

<!--<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php /*echo get_selected($_GET['sfl'], "mb_id"); */?>>아이디</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php /*echo $stx */?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>-->

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
    </colgroup>
    <thead>
	<tr>
		<!--<th scope="col">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>-->
		<th>No.</th>
		<th>좋아하는 색</th>
        <th>좋아하는 꽃</th>
		<th>좋아하는 스포츠</th>
        <th>연령대</th>
        <th>사시는 지역</th>
        <th>연락처</th>
        <th>작성일</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $k = $total_count-($rows*($page-1)); // 글번호
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
    ?>
	<tr class="<?php echo $bg; ?>">
		<td><?=$k?></td>
		<td><?=$profile_color[$row['color']]?></td>
        <td><?=$profile_flower[$row['flower']]?></td>
		<td><?=$profile_sports[$row['sports']]?></td>
        <td><?=$profile_age[$row['age']]?></td>
        <td><?=$profile_area[$row['area']]?></td>
        <td><?=$row['tel']?></td>
        <td><?=substr($row['wr_datetime'],0,10)?></td>
	</tr>
    <?php
        $k--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">나만의 프로필 정보가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
