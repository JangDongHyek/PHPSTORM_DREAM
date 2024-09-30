<?php
$sub_menu = "220100";
include_once('./_common.php');

/**
 * 주문내역
 */

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_order as ord left join g5_dosirak as do on do.idx = ord.dosirak_idx left join g5_member as mb on mb.mb_id = ord.mb_id left join g5_member as mb2 on mb2.mb_id = ord.rider ";
$sql_search = " where 1=1 and ord.dosirak_idx != 0 ";

// 검색어
if($stx) {
    $sql_search .= " and {$sfl} like '%{$stx}%' ";
}

// 배달시작일 최신순으로 정렬
if (!$sst) {
    $sst = "delivery_date";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod}, ord.wr_datetime desc ";

// 정기배달/행사용/샐러드팩
if(!empty($cate)) {
  $sql_search .= " and do_category = '{$cate}' ";
}

// 수정된 건만 조회
if($mod == 'Y') {
    $sql_search .= " and mod_yn = 'Y' and read_yn = 'N' ";
} else {
    $sql_search .= " and read_yn is not null ";
}

// 주문일 검색
if(!empty($_REQUEST['st_date']) && !empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' and date_format(ord.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
} else if(!empty($_REQUEST['st_date']) && empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' ";
} else if(empty($_REQUEST['st_date']) && empty(!$_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(ord.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
}

// 배달시작일 검색
if(!empty($_REQUEST['st_date2']) && !empty($_REQUEST['ed_date2'])) {
    $sql_search .= " and date_format(ord.delivery_date, '%Y-%m-%d') >= '{$_REQUEST['st_date2']}' and date_format(ord.delivery_date, '%Y-%m-%d') <= '{$_REQUEST['ed_date2']}' ";
} else if(!empty($_REQUEST['st_date2']) && empty($_REQUEST['ed_date2'])) {
    $sql_search .= " and date_format(ord.delivery_date, '%Y-%m-%d') >= '{$_REQUEST['st_date2']}' ";
} else if(empty($_REQUEST['st_date2']) && empty(!$_REQUEST['ed_date2'])) {
    $sql_search .= " and date_format(ord.delivery_date, '%Y-%m-%d') <= '{$_REQUEST['ed_date2']}' ";
}

$sql = " select count(*) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall" style="text-decoration: unset !important;">전체목록</a>';

$g5['title'] = '주문내역';
include_once('./admin.head.php');

$sql = " select ord.*, do.do_category, mb.mb_name {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
// if($private) { echo $sql; }
$result = sql_query($sql);

$cnt1 = sql_fetch("select count(*) as cnt {$sql_common} {$sql_search} and order_state = '주문접수' ")['cnt'];
$cnt2 = sql_fetch("select count(*) as cnt {$sql_common} {$sql_search} and order_state = '배달중' ")['cnt'];
$cnt3 = sql_fetch("select count(*) as cnt {$sql_common} {$sql_search} and order_state = '배달완료'")['cnt'];

// 메뉴별 수량
$menuInfo = sql_fetch("select do.do_name, sum(order_amount) as sumCount {$sql_common} {$sql_search} ");

$colspan = 16;
?>

<style>
    .mb_tbl table {text-align: center;}
    .tr_blue {color: blue; font-weight: bold; }
    .tr_red {color: red; font-weight: bold;}
    .hide {visibility: hidden;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 <?php echo number_format($total_count) ?>건 <br> <span style="color: #3568da">주문접수 <?=number_format($cnt1)?> 건 | 배달중 <?=number_format($cnt2)?> 건 | 배달완료 <?=number_format($cnt3) ?> 건</span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb.mb_name"<?php echo get_selected($_GET['sfl'], "mb.mb_name"); ?>>업체명&현장명</option>
        <option value="ord.do_name"<?php echo get_selected($_GET['sfl'], "ord.do_name"); ?>>메뉴명</option>
        <option value="mb2.mb_name"<?php echo get_selected($_GET['sfl'], "mb2.mb_name"); ?>>담당기사</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
    <input type="submit" class="btn_submit" value="검색">

    <span style="display: inline; margin-left: 15px">주문일
    <input type="date" id="st_date" value="<?php echo $_REQUEST['st_date'] ?>" name="st_date" max="<?=date('yy-m-d')?>" onchange="document.fsearch.submit();"> ~
    <input type="date" id="ed_date" value="<?php echo $_REQUEST['ed_date'] ?>" name="ed_date" max="<?=date('yy-m-d')?>" onchange="document.fsearch.submit();">
    </span>
    <span style="display: inline; margin-left: 15px">배달시작일
    <input type="date" id="st_date2" value="<?php echo $_REQUEST['st_date2'] ?>" name="st_date2" max="<?=date('yy-m-d')?>" onchange="document.fsearch.submit();"> ~
    <input type="date" id="ed_date2" value="<?php echo $_REQUEST['ed_date2'] ?>" name="ed_date2" max="<?=date('yy-m-d')?>" onchange="document.fsearch.submit();">
    </span>
    <input type="hidden" name="cate" value="<?=$cate?>">
    <input type="hidden" id="mod" name="mod" value="N">
</form>

<div class="local_desc01 local_desc">
    <p>※ <span class="tr_blue">파란색</span>으로 표시된 내역은 주문 내용이 수정된 건 입니다.</p>
    <p>※ <span class="tr_red">빨간색</span>으로 표시된 내역은 신규 회원의 첫 주문 건 입니다.</p>
    <p>※ 수정된 건만 조회하고자 할 경우 <a class="tr_blue" style="text-decoration: underline;cursor: pointer;font-weight: bold;" onclick="$('#mod').val('Y');document.fsearch.submit();">여기</a>를 눌러주세요.</p>
    <p>※ 전체 주문 내역을 조회하고자 할 경우 <span style="text-decoration: unset;font-weight: bold;"><?=$listall?></span>을 눌러주세요.</p>
</div>

<?php if ($is_admin == 'super') { ?>
<div class="btn_add01 btn_add">
    <ul class="cate">
        <li <? if ($cate == "") echo 'class="on"'; ?> data-lv="">전체</li>
        <li <? if ($cate == "정기배달") echo 'class="on"'; ?> data-lv="정기배달">정기배달</li>
        <li <? if ($cate == "행사용") echo 'class="on"'; ?> data-lv="행사용">행사용</li>
        <li <? if ($cate == "샐러드팩") echo 'class="on"'; ?> data-lv="샐러드팩">샐러드팩</li>
    </ul>
    <a href="./excel_download.php?<?=$qstr?>&cate=<?=$cate?>&st_date=<?=$st_date?>&ed_date=<?=$ed_date?>&st_date2=<?=$st_date2?>&ed_date2=<?=$ed_date2?>" id="order_excel" <?php if( empty($cate)) { ?>class="hide"<?php } ?>>엑셀다운로드</a>
</div>
<?php } ?>

<form name="fdosirak" id="fdosirak" action="./dosirak_list_update.php" onsubmit="return fdosirak_submit(this);" method="post">
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
        <col width="7%">
        <col width="7%">
        <col width="13%">
        <col width="13%">
        <!--<col width="5%">-->
        <col width="10%">
        <col width="5%">
        <col width="*">
        <col width="5%">
        <col width="5%">
        <col width="5%">
    </colgroup>
    <thead>
	<tr>
        <!--<th>No.</th>-->
        <th>주문시간</th>
        <th><?php echo subject_sort_link('wr_datetime')?>주문일</a></th>
        <?php if($cate == '행사용') { ?>
        <th><?php echo subject_sort_link('event_date')?>행사날짜</a></th>
        <?php } else { // 정기배달 or 샐러드팩?>
        <th><?php echo subject_sort_link('delivery_date')?>배달시작일</a></th>
        <?php } ?>
        <th>업체명&현장명</th>
        <th>받는사람</th>
        <!--<th>구분</th>-->
		<th>메뉴명</th>
        <th>수량</th>
        <th>메모</th>
        <th>금액</th>
        <th><?php echo subject_sort_link2($st_date, $ed_date, $st_date2, $ed_date2, 'rider')?>담당기사</a></th>
		<!--<th>발열도시락변경여부</th>-->
		<th>관리</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows*($page-1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        if($private) { $param = '&st_date2='.$st_date2.'&ed_date2='.$ed_date2; }
        $s_mod = '<a href="./order_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['idx'].$param.'">보기</a>';

        $bg = 'bg'.($i%2);
        $color = '';
        if($row['mod_yn'] == 'Y') {
            $color = 'tr_blue';
        }

        // 첫주문 체크
        $ord_count = sql_fetch("select count(idx) as count from g5_order where mb_id = '{$row['mb_id']}' ")['count'];
        if($ord_count == 1) $color = 'tr_red';

        // 주문일 - 수정된 주문은 수정일 표시
        $order_date = $row['wr_datetime'];
        if($row['mod_yn'] == 'Y') {
            $order_date = $row['up_datetime'];
        }

        $rider = get_member($row['rider']);
    ?>
	<tr class="<?php echo $bg; ?> <?=$color?>">
        <!--<td><?/*=$list_no*/?></td>-->
        <td><?=substr($order_date, 11, 5)?></td>
        <td><?=substr($order_date, 0, 10)?></td>
        <?php if($cate == '행사용') { ?>
        <td><?=substr($row['event_date'], 0, 10)?></td>
        <?php } else { // 정기배달 or 샐러드팩?>
        <td><?=substr($row['delivery_date'], 0, 10)?></td>
        <?php } ?>
        <td><?=$row['mb_name']?></td>
        <td><?=$row['order_name']?></td>
        <!--<td><?=$row['do_category']?></td>-->
		<td><?=$row['do_name']?></td>
        <td><?=number_format($row['order_amount'])?>개</td>
        <td><?=$row['order_memo']?></td>
		<td><?=number_format($row['total_price'])?>원</td>
        <td><?=$rider['mb_name']?></td>
		<!--<td><?/*=$row['order_warm']=="Y" ? "변경" : "변경안함"*/?></td>-->
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

    <?php if($sfl == "ord.do_name" && !empty($stx) && $total_count != 0) { // 메뉴명 검색 ?>
    <span style="font-weight: bold; font-size: 20px;position: relative;top: 8px;float: left">※ <?=$menuInfo['do_name']?> : <?=number_format($menuInfo['sumCount'])?>개</span>
    <?php } ?>
</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&cate='.$cate.'&st_date='.$st_date.'&ed_date='.$ed_date.'&st_date2='.$st_date2.'&ed_date2='.$ed_date2.'&mod='.$mod.'&amp;page='); ?>

<script>
// 구분변경
$("ul.cate li").on("click", function() {
    var cate = $(this).data("lv"),
        params = "",
        sfl = $("#sfl").val(),
        stx = $("#stx").val(),
        st_date = $('#st_date').val(),
        ed_date = $('#ed_date').val(),
        st_date2 = $('#st_date2').val(),
        ed_date2 = $('#ed_date2').val();

    if (cate != "") {
        params += "?cate=" + cate;
    }

    if (stx != "") {
        params += (params == "")? "?" : "&";
        params += "sfl=" + sfl + "&stx=" + stx;
    }

    if(st_date != "" || ed_date != "") {
        params += (params == "")? "?" : "&";
        params += "st_date=" + st_date + "&ed_date=" + ed_date;
    }

    if(st_date2 != "" || ed_date2 != "") {
        params += (params == "")? "?" : "&";
        params += "st_date2=" + st_date2 + "&ed_date2=" + ed_date2;
    }

    location.href = g5_admin_url + "/order_list.php" + params;
});

function fdosirak_submit(f) {
    if (!is_checked("chk[]")) {
        alert("삭제할 메뉴를 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "메뉴삭제") {
        if(!confirm("선택한 메뉴를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
