<?php
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_message as me left join g5_member as send on me.send_mb_id = send.mb_id left join g5_member as receive on me.receive_mb_id = receive.mb_id where 1=1 ";

if (!empty($stx)) {
    $sql_common .= "and (send.mb_name like '%{$stx}%' or receive.mb_name like '%{$stx}%') ";
}

if (!$sst) {
    $sst = "message_date";
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

$g5['title'] = '메세지현황';
//include_once('./admin.head.php');

$sql = " select me.*, send.mb_name as send_mb_name, receive.mb_name as receive_mb_name {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 6;

if (defined('G5_IS_ADMIN')) {
    if (!defined('_THEME_PREVIEW_'))
        echo '<link rel="stylesheet" href="' . G5_ADMIN_URL . '/css/admin.css">' . PHP_EOL;
} else {
    echo '<link rel="stylesheet" href="' . G5_CSS_URL . '/' . (G5_IS_MOBILE ? 'mobile' : 'default') . '.css">' . PHP_EOL;
}
?>

<style>
.mb_tbl table {text-align: center; font-size: 13px;}
.mb_tbl table td div {
    overflow:hidden; word-wrap:break-word; display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; text-overflow:ellipsis;
}
</style>

<h1 style="margin-top: 20px;"><?=$g5['title']?></h1>

<div class="local_ov01 local_ov">
    <?php /*echo $listall */?>
    총 메세지 수 <?php echo number_format($total_count) ?>건
</div>

<!--<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_name"<?php /*echo get_selected($_GET['sfl'], "mb_name"); */?>>이름</option>
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

<div class="tbl_head02 tbl_wrap mb_tbl" style="margin-top: 20px;">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col width="5%">
        <col width="12%">
        <col width="12%">
        <col width="*">
        <col width="10%">
        <col width="5%">
    </colgroup>
    <thead>
	<tr>
		<!--<th scope="col">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>-->
		<th>No.</th>
		<th>보낸 이름</th>
        <th>받는 이름</th>
		<th>메세지</th>
		<th>전송일시</th>
        <th>관리</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $k = $total_count;
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./popup.message_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['idx'].'">보기</a>';
        $bg = 'bg'.($i%2);
    ?>
	<tr class="<?php echo $bg; ?>">
		<!--<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
		<td><?=$k?></td>
		<td><?=$row['send_mb_name']?></td>
        <td><?=$row['receive_mb_name']?></td>
        <td><div><?=$row['message']?></div></td>
		<td><?=substr($row['message_date'],0,16)?></td>
        <td><?=$s_mod?></td>
	</tr>
    <?php
        $k--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">메세지 현황 정보가 없습니다.</td></tr>";
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