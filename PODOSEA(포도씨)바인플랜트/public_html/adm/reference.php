<?php
$sub_menu = "240100";
include_once('./_common.php');
/**
 * 자료실 판매/구매내역
 */
auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_reference_room ";
$sql_search = " where del_yn = 'N' ";

// 카테고리
if(!empty($lv)) {
    $sql_search .= " and rr_category = '{$lv}' ";
}

// 검색
if(!empty($stx)) {
    $sql_search .= " and {$sfl} like '%{$stx}%' ";
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

$g5['title'] = '자료실';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
// echo $sql;
$result = sql_query($sql);

$colspan = 16;
?>

<style>
.mb_tbl table {text-align: center;}
.btn_submit {
    padding: 0 5px;
    height: 24px;
    border: 0;
    color: #fff;
    vertical-align: middle;
    cursor: pointer;
}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
    <option value="rr_subject"<?php echo get_selected($_GET['sfl'], "rr_subject"); ?>>제목</option>
    <option value="rr_contents"<?php echo get_selected($_GET['sfl'], "rr_contents"); ?>>내용</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="btn_add01 btn_add">
    <ul class="cate">
        <li <? if ($lv == "전체" || $lv == "") echo 'class="on"'; ?> data-lv="">전체</li>
        <li <? if ($lv == "양식/서식") echo 'class="on"'; ?> data-lv="양식/서식">양식/서식</li>
        <li <? if ($lv == "비즈니스(산업)") echo 'class="on"'; ?> data-lv="비즈니스(산업)">비즈니스(산업)</li>
        <li <? if ($lv == "보고서/회의") echo 'class="on"'; ?> data-lv="보고서/회의">보고서/회의</li>
        <li <? if ($lv == "노하우") echo 'class="on"'; ?> data-lv="노하우">노하우</li>
        <li <? if ($lv == "리포트/논문") echo 'class="on"'; ?> data-lv="리포트/논문">리포트/논문</li>
        <li <? if ($lv == "기타") echo 'class="on"'; ?> data-lv="기타">기타</li>
    </ul>
    <a href="javascript:void(0)" style="visibility: hidden">&nbsp;</a>
</div>

<!--<div class="local_desc01 local_desc">
    <p>* 포도씨에게 직접 의뢰한 건이 표시됩니다.</p>
</div>-->

<form name="fbunker" id="fbunker" method="post">
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
        <col width="5%">
        <col width="5%">
        <col width="5%">
        <col width="*">
        <col width="15%">
        <col width="5%">
        <col width="5%">
        <col width="5%">
        <col width="5%">
    </colgroup>
    <thead>
	<tr>
        <th>No.</th>
        <th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
        <th>카테고리</th>
        <th>제목</th>
        <th>해시태그</th>
        <th>가격</th>
        <th>다운로드 수</th>
        <th>등록일</th>
        <th>관리</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows * ($page - 1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./reference_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['idx'].'">보기</a>';
        $bg = 'bg'.($i%2);

        $down_cnt = sql_fetch(" select count(*) as cnt from g5_reference_room_download where reference_idx = '{$row['idx']}' ")['cnt'];
    ?>
	<tr class="<?php echo $bg; ?>">
        <td><?=$list_no?></td>
        <td><?=$row['mb_id']?></td>
        <td><?=$row['rr_category']?></td>
        <td><?=$row['rr_subject']?></td>
        <td><?=$row['rr_hashtag']?></td>
        <td><?=$row['rr_is_free']=='Y'?'무료':number_format($row['rr_price']).'원'?></td>
        <td><?=number_format($down_cnt).'회'?></td>
		<td><?=substr($row['wr_datetime'],0,10)?></td>
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
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>-->

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&lv='.$lv.'&amp;page='); ?>

<script>
// 구분 변경
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

    location.href = g5_admin_url + "/reference.php" + params;
});
</script>

<?php
include_once ('./admin.tail.php');
?>
