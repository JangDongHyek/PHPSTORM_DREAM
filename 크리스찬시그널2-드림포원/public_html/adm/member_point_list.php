<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_member_point as mp 
                left join g5_member as mb on mb.mb_id = mp.mb_id
                left join g5_member as mb2 on mb2.mb_id = mp.rel_mb_id
                where 1=1 ";

if (!empty($stx)) {
    $sql_common .= "and {$sfl} like '%{$stx}%'";
}

if (!$sst) {
    $sst = "idx";
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

$g5['title'] = '만나관리';
include_once('./admin.head.php');

$sql = " select mp.*, mb.mb_name, mb.mb_nick, mb2.mb_name as rel_mb_name {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 8;
?>

<style>
.mb_tbl table {text-align: center;}
.btn_add ul.cate {
    list-style: none;
    margin: 0;
    padding: 0;
}
.btn_add .cate li.on {
    background: #f2f5f9;
    font-weight: 700;
}
.btn_add .cate li:nth-child(1) {
    border-left: 1px solid #ccc;
}
.btn_add .cate li {
    float: left;
    padding: 10px;
    border: 1px solid #ccc;
    border-left: 0;
    width: 85px;
    text-align: center;
    cursor: pointer;
}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 <?php echo number_format($total_count) ?>건
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb.mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="point_content"<?php echo get_selected($_GET['sfl'], "point_content"); ?>>내용</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="btn_add01 btn_add">
    <!--<ul class="cate">
        <li <?/* if ($lv == "전체" || $lv == "") echo 'class="on"'; */?> data-lv="">전체</li>
        <li <?/* if ($lv == "지급") echo 'class="on"'; */?> data-lv="지급">지급내역</li>
        <li <?/* if ($lv == "차감") echo 'class="on"'; */?> data-lv="차감">차감내역</li>
    </ul>-->
    <a onclick="openPopup();">만나 지급/차감</a>
</div>

<form name="fmemberlist" id="fmemberlist" method="post">
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
		<th>No.</th>
		<th>아이디</th>
        <th>이름</th>
		<th>닉네임</th>
        <th>구분</th>
        <th>내용</th>
        <th>만나</th>
        <th>잔액</th>
        <th>변경일</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $k = $total_count-($rows*($page-1)); // 글번호
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        $mb2 = get_member($row['mb_id']);

    ?>
	<tr class="<?php echo $bg; ?>">
		<td><?=$k?></td>
		<td><?=$row['mb_id']?></td>
        <td><?=$row['mb_name']?></td>
		<td><?=$row['mb_nick']?></td>
        <td><?=$row['point_category']?></td>
        <td><?=$row['point_content']?> <?php if(strpos($row['point_content'], '사진 조회') !== false) { echo '('.$row['rel_mb_name'].')'; } ?></td>
        <td><?=number_format($row['point'])?></td>
        <td><?=number_format($mb2['cw_point'])?></td>
     
        <td><?=substr($row['wr_datetime'],0,10)?></td>
	</tr>
    <?php
        $k--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">만나 정보가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    function openPopup() {
        var url = "./point_form.php";

        window.open(url, "point", "left=100,top=100,width=550,height=650,scrollbars=yes,resizable=yes");
    }
</script>

<?php
include_once ('./admin.tail.php');
?>