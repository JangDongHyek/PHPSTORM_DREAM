<?php
$sub_menu = 290100;
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " FROM g5_point A LEFT JOIN g5_member B On A.mb_id = B.mb_id WHERE (1) ";

// (대리점 로그인시) 본인 대리점만 조회
if ($member['mb_level'] != "10") {
    $sql_common .= " AND B.agency_no = '{$member['mb_no']}' ";
} else {
    // (관리자) 대리점 카테고리 선택가능
    if ($sca != "")
        $sql_common .= " AND B.agency_no = '{$sca}' ";
}

// 검색
if ($stx) {
    if ($sfl == "mb_name" || $sfl == "mb_hp")
        $sql_common .= " AND B.{$sfl} LIKE '%{$stx}%' ";
    else if ($sfl == "idx")
        $sql_common .= " AND A.po_rel_id = '{$stx}' AND A.po_rel_table = 'call' ";
    else if ($sfl == "content")
        $sql_common .= " AND A.po_content LIKE '%{$stx}%' ";
}

if (!$sst) {
    $sst = "A.po_id";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

// 페이징
$sql = " select count(*) as cnt {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 50; //$config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);			// 전체 페이지 계산
if ($page < 1) $page = 1;							// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;					// 시작 열을 구함

$list_page_rows = 10;										// 한블록 개수
$list_no = $total_count - ($rows * ($page - 1));	// 글번호(내림차순)

// 리스트
$sql = " select A.*, B.mb_name, B.agency_no, B.mb_hp {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = '포인트현황';
include_once('./admin.head.php');

// 220907. 전체 합계 (잔여포인트 합계)
$total = sql_fetch("SELECT SUM(mb_point) AS sum FROM g5_member WHERE mb_point !=0 AND mb_level > 0;");

?>
<style>
.tbl_head02 td.right {text-align: right; padding-right: 5px;}
.call_index {color: #7d7d7d; font-size: 11px; margin: 0 5px;}
.local_ov.top > div {display: inline-block;}
</style>

<div class="local_ov01 local_ov top">
    <a href="./<?=basename($_SERVER["PHP_SELF"])?>" class="ov_listall">전체목록</a>
    총 <?php echo number_format($total_count) ?>개
    <div>(전체 합계 <?=number_format($total['sum'])?>점)</div>
</div>

<form id="fsearch" name="fsearch" class="local_sch" method="get" autocomplete="off">
    <div class="local_sch01">
        <label for="sfl" class="sound_only">검색대상</label>
        <?
        if ($member['mb_level'] == "10") {
            $rst = sql_query("SELECT mb_no, mb_nick FROM g5_member WHERE mb_level = '9' ORDER BY mb_nick ASC;");
            $rst_cnt = sql_num_rows($rst);
            if ($rst_cnt > 0) {
                ?>
                <select name="sca" onchange="document.fsearch.submit();">
                    <option value="">대리점전체</option>
                    <? while($agency = sql_fetch_array($rst)) { ?>
                        <option value="<?=$agency['mb_no']?>" <? if ($sca == $agency['mb_no']) echo "selected"; ?>><?=$agency['mb_nick']?></option>
                    <? } ?>
                </select>
                <?
            }
        }
        ?>
        <select name="sfl" id="sfl">
            <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>고객명</option>
            <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
            <option value="content"<?php echo get_selected($_GET['sfl'], "content"); ?>>포인트 내용</option>
            <option value="idx"<?php echo get_selected($_GET['sfl'], "idx"); ?>>콜번호</option>
        </select>
        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
        <input type="submit" class="btn_submit" value="검색">
    </div>
</form>

<form name="flist" id="flist" action="" onsubmit="return flist_submit(this);" method="post">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap" style="text-align: center;">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col width="4%">
                <col width="10%">
                <col width="12%">
                <col width="10%">
                <col width="8%">
                <col width="*">
                <col width="6%">
                <col width="6%">
                <col width="11%">
            </colgroup>
            <thead>
            <tr>
                <th>No.</th>
                <th>대리점</th>
                <th>이름</th>
                <th>요금</th>
                <th>휴대폰번호</th>
                <th>포인트 내용</th>
                <th>포인트</th>
                <th>잔여포인트</th>
                <th>일시</th>
                <!--<th>비?고</th>-->
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $bg = 'bg'.($i%2);
                $mb_id = $row['mb_id'];

                // 대리점
                $agency = sql_fetch("SELECT mb_nick FROM g5_member WHERE mb_no = '{$row['agency_no']}'");

                // 충전/차감 포인트
                $po_point = number_format($row['po_point']);
                if ((int)$row['po_use_point'] > 0) $po_point = "-".number_format($row['po_use_point']);

                // 포인트내용
                //$po_content = $row['po_content'];
                $po_content = ((int)$row['po_rel_id'] > 0 && $row['po_rel_table'] == "call")?
                    "<a href='./call_list.php?idx=".$row['po_rel_id']."'>".$row['po_content']." <span class='call_index'>".$row['po_rel_id']."</span></a>"
                    : $row['po_content'];
                ?>
                <tr class="<?=$bg?>">
                    <td><?=number_format($list_no)?></td>
                    <td><?=$agency['mb_nick']?></td>
                    <td><a href="./member_form.php?w=u&mb_id=<?=$mb_id?>"><?=$row['mb_name']?></a></td>
                    <td><?=$row['po_charge_memo']?></td>
                    <td><?=$row['mb_hp']?></td>
                    <td><?=$po_content?></td>
                    <td class="right"><?=$po_point?></td>
                    <td class="right"><?=number_format($row['po_mb_point'])?></td>
                    <td><?=date("Y-m-d H:i:s", strtotime($row['po_datetime']))?></td>
                    <!--<td><?/*=$point_actions[$row['po_rel_action']]*/?></td>-->
                </tr>
                <?php
                $list_no--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"15\" class=\"empty_table\">내역이 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

</form>

<? echo get_paging($list_page_rows, $page, $total_page, '?'.$qstr); ?>

<?php
include_once ('./admin.tail.php');
?>
