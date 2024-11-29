<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_sales as sa left join g5_member as mb on mb.sales_idx = sa.idx ";

$today = date('Y-m-d');

$sql_search = ' where 1=1 ';

if(!empty($_GET['start_date'])) {
    $sql_search .= " and (date_format(pay_date, '%Y-%m') >= '{$start_date}') ";
} else {
    $sql_search .= " and (date_format(pay_date, '%Y-%m') >= '{$today}') ";
}

if(!empty($_GET['end_date'])) {
    $sql_search .= " and (date_format(pay_date, '%Y-%m') <= '{$end_date}') ";
} else {
    $sql_search .= " and (date_format(pay_date, '%Y-%m') <= '{$today}') ";
}
/*if (!$sst) {
    $sst = "mb_reg_date";
    $sod = "desc";
}*/

//$sql_order = " order by {$sst} {$sod} ";
$sql_group = " group by mb.center_code, sa.pay_date ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall" style="padding-right: 15px;">전체</a>';

$g5['title'] = '매출현황';
include_once('./admin.head.php');

$sql = " select mb.mb_center, sa.pay_date, sum(sa.cash_price) as cash_price, sum(sa.card_price) as card_price, sum(sa.fees) as fees
        {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
//echo $sql;
$colspan = 7;
?>

<style>
.mb_tbl table {text-align: center;}
#fsearch .lre_ldate .input_ldate {
    height: 33px;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 0 10px;
}
#fsearch .lre_ldate .btn_ldate {
    height: 33px;
    border: 1px solid #444;
    border-radius: 3px;
    padding: 0 10px;
    background: #444;
    color: #fff;
    margin-left: 5px;
}
.les_sdate {
    font-size: 15px;
    font-weight: 500;
    color: #999;
    margin-bottom: 10px;
}
</style>

<div id="tab_box">
    <ul class="tab">
        <li class="current" id="tab1"><a href="javascript:void(0);">당일매출</a></li>
        <li class="" id="tab2"><a href="javascript:void(0);" onclick="tabClick('월간매출');">월간매출</a></li>
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('주간매출');">주간매출</a></li>
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('연간매출');">연간매출</a></li>
    </ul>
</div><!--#tab_box-->

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="text-align: right;">
<!--기간검색-->
<div class="lre_ldate">
    <?=$listall?>
    <input type="date" name="start_date" value="<?php echo empty($_GET['start_date']) ? date('Y-m-d') : $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?php echo empty($_GET['end_date']) ? date('Y-m-d') : $_GET['end_date'] ?>" class="input_ldate"/>
    <input type="hidden" id="sales_option" name="sales_option" value="">
    <input type="submit" class="btn_ldate" value="검색">
</div><!--.lre_ldate-->
</form>

<div class="local_ov01 local_ov">
    <div class="lre_list_tit">
        당일매출
        <span class="les_sdate">기간 : <?=date('Y-m-d')?> ~ <?=date('Y-m-d')?></span><br>
    </div>
    <!--당일매출 기간 : <?/*=date('Y-m-d')*/?> ~ --><?/*=date('Y-m-d')*/?>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap mb_tbl">

    <?php
    $sql = " select * from g5_center ";
    $center_result = sql_query($sql);

    for($k=0; $center=sql_fetch_array($center_result); $k++) {
        $sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb.center_code = '{$center['center_code']}' {$sql_order} ";
        $row = sql_fetch($sql);
        $total_count = $row['cnt'];

        $rows = $config['cf_page_rows'];
        $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
        if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
        $from_record = ($page - 1) * $rows; // 시작 열을 구함

        $sql = " select mb.mb_center, sa.pay_date, sum(sa.cash_price) as cash_price, sum(sa.card_price) as card_price, sum(sa.fees) as fees
                {$sql_common} {$sql_search} and mb.center_code = '{$center['center_code']}' {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
        $result = sql_query($sql);
    ?>
    <span style="font-size: 15px;"><?=$center['center_name']?></span>
    <table style="margin-bottom: 15px;">
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <colgroup>
            <!--<col width="10%">-->
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
        </colgroup>
        <thead>
        <tr>
            <!--<th>센터</th>-->
            <th>일자</th>
            <th>현금</th>
            <th>카드</th>
            <th>현금+카드</th>
            <th>수수료</th>
            <th>매출</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $bg = 'bg'.($i%2);

            $total = $row['cash_price']*1 + $row['card_price']*1;
            ?>
            <tr class="<?php echo $bg; ?>">
                <!--<td><?/*=$row['mb_center']*/?></td>-->
                <td><?=substr($row['pay_date'], 0, 10)?></td>
                <td><?=number_format($row['cash_price']*1)?></td>
                <td><?=number_format($row['card_price']*1)?></td>
                <td><?=number_format($row['cash_price']*1 + $row['card_price']*1)?></td>
                <td><?=number_format($row['fees']*1)?></td>
                <td><?=number_format($total)?></td>
            </tr>
        <?php
        }
        if ($i == 0)
            echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
        ?>
        </tbody>
    </table>
    <?php
    }
    ?>

</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date'].'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
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

// 회원-탭선택
function tabClick(value) {
    // $('#sales_option').val(value);
    if(value == '월간매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list_month.php?sales_option='+value);
    } else if(value == '연간매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list_year.php?sales_option='+value);
    } else if(value == '주간매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list_week.php?sales_option='+value);
    }
    // fsearch.submit();
}

// 회원-레슨일지(팝업) ==> 페이지로 변경 가능성도 있음
function lesson_diary(mb_no) {
    var url = "./lesson_diary_form.php?mb_no="+mb_no;

    //window.open(url, "add_lesson_diary", "left=100,top=100,width='"+screen.availWidth+"',height='"+screen.availHeight+"',scrollbars=yes,resizable=yes");
    window.open(url, "add_lesson_diary", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
}
</script>

<?php
include_once ('./admin.tail.php');
?>
