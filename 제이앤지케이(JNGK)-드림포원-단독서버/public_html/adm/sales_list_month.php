<?php
$sub_menu = "230100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_sales as sa left join g5_member as mb on mb.mb_no = sa.mb_no ";

$sql_search = ' where 1=1 ';
if($member['mb_level'] == 8) { // 프로
    $sql_search .= " and mb.pro_mb_no = '{$member['mb_no']}' ";
}
if($member['mb_level'] == 9) { // 팀장
    $sql_search .= " and mb.center_code = '{$member['center_code']}' ";
}

if(!empty($_GET['start_date'])) {
    $year = explode('-', $start_date)[0];
    $sql_search .= " and (pay_date >= '{$start_date}') ";
} else {
    $today = date('Y').'-01';
    $sql_search .= " and (date_format(pay_date, '%Y-%m') >= '{$today}') ";
}

if(!empty($_GET['end_date'])) {
    $sql_search .= " and (pay_date <= '{$end_date}') ";
} else {
    $today = date('Y-m');
    $sql_search .= " and (date_format(pay_date, '%Y-%m') <= '{$today}') ";
}

/*if (!$sst) {
    $sst = "mb_reg_date";
    $sod = "desc";
}*/


$sql_group = " GROUP BY `month`, mb.pro_mb_no ";
$sql_order = " order by `month` asc ";

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
$sql = " select MONTH(`pay_date`) AS `month`, YEAR(`pay_date`) AS 'year', 
         sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, 
         sum(`fees`) as fees, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay
         {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
//echo $sql;

$colspan = 9; // 합계 추가 시 10으로 변경
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
        <li class="" id="tab1"><a href="javascript:void(0);" onclick="tabClick('당일매출');">당일매출</a></li>
        <li class="current" id="tab2"><a href="javascript:void(0);">월간매출</a></li>
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('주간매출');">주간매출</a></li>
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('연간매출');">연간매출</a></li>
    </ul>
</div><!--#tab_box-->

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="text-align: right;">
<!--기간검색-->
<div class="lre_ldate">
    <?/*=$listall*/?>
    <input type="date" name="start_date" value="<?php echo empty($_GET['start_date']) ? '' : $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?php echo empty($_GET['end_date']) ? '' : $_GET['end_date'] ?>" class="input_ldate"/>
    <input type="hidden" id="sales_option" name="sales_option" value="월간매출">
    <input type="submit" class="btn_ldate" value="검색">
</div><!--.lre_ldate-->
</form>

<div class="local_ov01 local_ov">
    <div class="lre_list_tit">
        월간매출
        <span class="les_sdate">
            기간 :
            <?php
            if(!empty($_GET['start_date']) && !empty($_GET['end_date'])) { echo $_GET['start_date'].' ~ '.$_GET['end_date']; }
            else if(!empty($_GET['start_date'])) { echo $_GET['start_date'].' ~ '; }
            else if(!empty($_GET['end_date'])) { echo ' ~ '.$_GET['end_date']; }
            else { echo date('Y').'-01'.' ~ '.date('Y-m'); }
            ?>
            <?/*=date('Y').'-01'*/?><!-- ~ --><?/*=date('Y-m')*/?>
        </span>
        <span class="" style="float:right;" id="total_sales">
            총 합계 :
        </span>
    </div>
    <!--월간매출 기간 : <?/*=date('Y').'-01'*/?> ~ --><?/*=date('Y-m')*/?>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table id="static">
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col width="10%">
        <col width="10%" class="lv_op">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <!--<col width="10%" class"lv_op">-->
    </colgroup>
    <thead>
	<tr>
		<th>월</th>
        <th class="lv_op">프로명</th>
		<th>현금</th>
        <th>신용카드</th>
        <th>체크카드</th>
		<th>현금+카드</th>
        <th>수수료</th>
        <th>수당</th>
        <th>매출</th>
        <!--<th class="lv_op">합계</th>-->
	</tr>
    </thead>
    <tbody>
    <?php
    $total_sales = 0;
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        //$bg = 'bg'.($i%2);

        $total = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1;
        $total_sales += $total*1;

        /*$search = $row['year'].'-'.$row['month'];
        $sql_search2 = " WHERE 1 = 1 AND mb.center_code = '{$member['center_code']}' and DATE_FORMAT(pay_date, '%Y-%m') = '{$search}' ";
        $sql_having2 = " having `month` is not null and cnt > 1 ";
        $sql2 = " select MONTH(`pay_date`) as `month`,
                  sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, sum(`fees`) as fees, 
                  card_company, mb.mb_charge_pro, sum(1) as cnt
                  {$sql_common} {$sql_search2} {$sql_group} with rollup {$sql_having2} ";
        $temp = sql_fetch($sql2);
        $sum = $temp['cash_price']*1 + $temp['credit_card_price']*1 + $temp['check_card_price']*1;*/
    ?>
	<tr class="<?php echo $bg; ?>">
        <td><?=$row['month']?>월</td>
        <td class="lv_op"><?=$row['mb_charge_pro']?></td>
        <td><?php if(!empty($row['cash_price'])) { echo number_format($row['cash_price']*1); }?></td>
        <td><?php if(!empty($row['credit_card_price'])) { echo number_format($row['credit_card_price']*1); }?></td>
        <td><?php if(!empty($row['check_card_price'])) { echo number_format($row['check_card_price']*1); }?></td>
        <td><?=number_format($total)?></td>
        <td><?php if(!empty($row['fees'])) { echo number_format($row['fees']*1); }?></td>
        <td><?php if(!empty($row['pro_extra_pay'])) { echo number_format($row['pro_extra_pay']*1); }?></td>
        <td><?=number_format($total)?></td>
        <!--<td class="lv_op"><?php /*if(!empty($sum)) { echo number_format($sum).'_'.$row['month']; } else { echo number_format($total).'_'.$row['month']; } */?></td>-->
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date'].'&amp;page='); ?>

<script>
$(function() {
    $('#total_sales').text("총 합계 : <?=number_format($total_sales)?>");

    // 관리자(팀장)과 최고관리자만 프로명 조회
    if('<?=$member['mb_level']?>' == '8') {
        $('.lv_op').attr('style', 'display:none;');
    }

    /*$('#static').rowspan(0); // 같은 값을 가진 열 병합 (0 : colIdx)
    $('#static').rowspan(8); // 같은 값을 가진 열 병합 (8 : colIdx)

    // 다른 일자의 같은 값을 가진 합계 때문에 처리
    // * 일자가 달라도 합계 열이 병합되는 문제 *
    // * 처리방법* 1. 일자를 붙여서 합계 데이터 표기 2. 열 병합 3. 일자 제거
    $('td:nth-child(9)').each(function() {
        $(this).html($(this).html().split('_')[0]);
    });*/
});

// 탭선택
function tabClick(value) {
    // $('#sales_option').val(value);
    if(value == '당일매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list.php?sales_option='+value);
    } else if(value == '연간매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list_year.php?sales_option='+value);
    } else if(value == '주간매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list_week.php?sales_option='+value);
    }
    // fsearch.submit();
}

// 같은 값을 가진 열 병합
$.fn.rowspan = function (colIdx, isStats) {
    return this.each(function () {
        var that;
        $('tr', this).each(function (row) {
            $('td:eq(' + colIdx + ')', this).filter(':visible').each(function (col) {

                if ($(this).html() == $(that).html() && (!isStats || isStats && $(this).prev().html() == $(that).prev().html() )) {
                    rowspan = $(that).attr("rowspan") || 1;
                    rowspan = Number(rowspan) + 1;

                    $(that).attr("rowspan", rowspan);

                    // do your action for the colspan cell here
                    $(this).hide();

                    //$(this).remove();
                    // do your action for the old cell here

                } else {
                    that = this;
                }

                // set the that if not already set
                that = (that == null) ? this : that;
            });
        });
    });
};
</script>

<?php
include_once ('./admin.tail.php');
?>
