<?php
$sub_menu = "215100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id ";

$sql_search = " where 1=1 ";
$sql_search .= " and (date_format(now(), '%Y-%m-%d') <= cr.cr_eddate or cr_always = 'Y') and cr_state is null "; // 접수기간이 지났거나 마감된 공고는 보여주지 않음

// 검색 (검색어 입력)
if(!empty($stx)) {
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

$g5['title'] = '커리어';
include_once('./admin.head.php');

$sql = " select cr.*, mb.mb_company_name {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
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
    <option value="mb_company_name"<?php echo get_selected($_GET['sfl'], "mb_company_name"); ?>>회사명</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input" placeholder="">
<input type="submit" class="btn_submit" value="검색">
</form>

<div class="local_desc01 local_desc">
    <p>* 마감된 채용공고는 표시되지 않습니다.</p>
</div>

<form name="fcareer" id="fcareer" method="post">
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
        <th>No.</th>
        <th>회사명</th>
        <th>제목</th>
        <th>접수기간</th>
        <th>근무형태</th>
        <th>연봉</th>
        <th>채용담당자</th>
        <th>연락처</th>
        <th>등록일</th>
        <th>받은이력서</th>
        <!--<th>상태</th>-->
        <th>관리</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows * ($page - 1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./career_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['idx'].'">보기</a>';
        $bg = 'bg'.($i%2);

        $date = $row['ci_deadline_date'];
        $todate = date("Y-m-d", time());
        $dday = ( strtotime($date) - strtotime($todate) ) / 86400;

        $term = $row['cr_always'] == 'Y' ? '상시채용' : $row['cr_stdate'].'~'.$row['cr_eddate'];

        $cnt = sql_fetch(" select count(*) as cnt from g5_resume where recruit_idx = '{$row['idx']}' ")['cnt'];
    ?>
	<tr class="<?php echo $bg; ?>">
        <td><?=$list_no?></td>
        <td><?=$row['mb_company_name']?></td>
        <td><?=$row['cr_subject']?></td>
        <td><?=$term?></td>
        <td><?=$row['cr_work_type']?></td>
        <td><?=$recruit_salary[$row['cr_work_salary']]?></td>
        <td><?=$row['cr_manager']?></td>
        <td><?=$row['cr_hp']?></td>
        <td><?=substr($row['wr_datetime'],0,10)?></td>
        <!--<td><?/*=$row['cr_state']*/?></td>-->
        <td><?=$cnt?>개</td>
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

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
