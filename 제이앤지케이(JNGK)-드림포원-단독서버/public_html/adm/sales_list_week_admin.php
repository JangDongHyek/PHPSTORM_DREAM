<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_sales as sa left join g5_member as mb on mb.mb_no = sa.mb_no ";

$sql_search = ' where 1=1 ';

$today = date('Y-m-d');
// == 이번주 시작일, 종료일 ==
$time = explode(" ",microtime());
$s = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +0/* 시작일 기준 */, date("Y",$time[1]));
$e = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +6/* 종료일 기준 */, date("Y",$time[1]));
$start = date("Y-m-d", $s); // 이번주 시작일
$end = date("Y-m-d", $e); // 이번주 종료일
// == 이번주 시작일, 종료일 ==

if(!empty($_GET['start_date'])) {
    $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start_date}') ";
} else {
    $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') >= '{$start}') ";
}

if(!empty($_GET['end_date'])) {
    $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end_date}') ";
} else {
    $sql_search .= " and (date_format(pay_date, '%Y-%m-%d') <= '{$end}') ";
}

// 센터명 선택 시
$center = 'center1';
if(!empty($_GET['center'])) {
    $center = $_GET['center'];
    $sql_search .= " and mb.center_code = '{$center}' ";
} else {
    $sql_search .= " and mb.center_code = '{$center}' ";
}

// 프로명 선택 시
$pro = '';
if(!empty($_GET['pro'])) {
    $pro = $_GET['pro'];
    $sql_search .= " and mb.pro_mb_no = '{$pro}' ";
}

/*if (!$sst) {
    $sst = "mb_reg_date";
    $sod = "desc";
}*/

$sql_group = " group by mb.center_code, `date`, mb.pro_mb_no ";
$sql_order = " order by `date` ";

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

$sunday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE())  -1 ) as sunday from dual " )['sunday']; // 이번주의 첫일(일요일)
$friday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE()) + 5 ) as friday from dual " )['friday']; // 이번주의 마지막일(토요일)

$sql = " select DATE_FORMAT(DATE_SUB(`pay_date`, INTERVAL (DAYOFWEEK(`pay_date`)-1) DAY), '%Y-%m-%d') as start,
                DATE_FORMAT(DATE_SUB(`pay_date`, INTERVAL (DAYOFWEEK(`pay_date`)-7) DAY), '%Y-%m-%d') as end,
                DATE_FORMAT(`pay_date`, '%Y%U') AS `date`,
                DATE_FORMAT(`pay_date`, '%Y') AS `year`,
                DATE_FORMAT(`pay_date`, '%m') AS `month`,
                FLOOR((DATE_FORMAT(pay_date,'%d')+(DATE_FORMAT(DATE_FORMAT(pay_date,'%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month,
                sum(`cash_price`) as cash_price, sum(`credit_card_price`) as credit_card_price, sum(`check_card_price`) as check_card_price, sum(`fees`) as fees, mb.mb_center, mb.mb_charge_pro, sum(`pro_extra_pay`) as pro_extra_pay
        {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
//echo $sql;

$colspan = 8; // 합계 추가 시 9으로 변경
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
/*#state_div ul.tabs {margin: 0;padding: 0;float: left;list-style: none;height: 40px;border-left: 1px solid #eee;width: 100%;font-size:15px;}
#state_div ul.tabs li {float: left; text-align:center; cursor: pointer; width:120px; height: 40px; line-height: 35px;border: 1px solid #eee; border-left: none; background: #fafafa; overflow: hidden; position: relative;}
#state_div ul.tabs li.active {background: #FFFFFF; border-bottom: 1px solid #FFFFFF;}*/
.mb_tbl table tr td a:hover {text-decoration: underline;color:#000;cursor:pointer;}
</style>

<div id="tab_box">
    <ul class="tab">
        <li class="" id="tab1"><a href="javascript:void(0);" onclick="tabClick('당일매출');">당일매출</a></li>
        <li class="" id="tab2"><a href="javascript:void(0);" onclick="tabClick('월간매출');">월간매출</a></li>
        <li class="current" id="tab3"><a href="javascript:void(0);">주간매출</a></li>
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('연간매출');">연간매출</a></li>
    </ul>
</div><!--#tab_box-->

<div id="state_div">
    <ul class="tabs" style="margin-bottom: 10px;">
        <?php
        $sql = " select * from g5_center ";
        $center_result = sql_query($sql);

        for($k=0; $center_row=sql_fetch_array($center_result); $k++) {
            $center_name = explode(' 아카데미', $center_row['center_name'])[0];
            ?>
            <li <? if ($center == $center_row['center_code']) echo 'class="active"'; ?> data-lv="<?=$center_row['center_code']?>"><?=$center_name?></li>
            <?php
        }
        ?>
    </ul>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="text-align: right;">
<!--기간검색-->
<div class="lre_ldate">
    <?=$listall?>
    <input type="date" name="start_date" value="<?php echo empty($_GET['start_date']) ? $sunday : $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?php echo empty($_GET['end_date']) ? $friday : $_GET['end_date'] ?>" class="input_ldate"/>
    <input type="hidden" id="center" name="center" value="<?=$_REQUEST['center']?>">
    <input type="hidden" id="pro" name="pro" value="<?=$_REQUEST['pro']?>">
    <input type="submit" class="btn_ldate" value="검색">
</div><!--.lre_ldate-->
</form>

<div class="local_ov01 local_ov">
    <div class="lre_list_tit">
        주간매출
        <span class="les_sdate">
            기간 :
            <?php
            if(!empty($_GET['start_date']) && !empty($_GET['end_date'])) { echo $_GET['start_date'].' ~ '.$_GET['end_date']; }
            else if(!empty($_GET['start_date'])) { echo $_GET['start_date'].' ~ '; }
            else if(!empty($_GET['end_date'])) { echo ' ~ '.$_GET['end_date']; }
            else { echo $sunday.' ~ '.$friday; }
            ?>
            <?/*=$sunday*/?><!-- ~ --><?/*=$friday*/?>
        </span>
        <span class="" style="float:right;" id="total_sales">
            총 합계 :
        </span>
    </div>
    <!--주간매출 기간 : <?/*=$sunday*/?> ~ --><?/*=$friday*/?>
</div>

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
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
    </colgroup>
    <thead>
	<tr>
        <th>센터</th>
		<th>주차</th>
        <th>프로명</th>
		<th>현금</th>
        <th>신용카드</th>
        <th>체크카드</th>
		<th>현금+카드</th>
        <th>수수료</th>
        <th>수당</th>
        <th>매출</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $total_sales = 0;
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);

        $total = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1;
        $total_sales += $total*1;

        /*$sql_group2 = " GROUP BY mb.center_code, `date`, mb.pro_mb_no with rollup ";
        $sql_having2 = " having `date` is not null and cnt > 1 ";*/
    ?>
	<tr class="<?php echo $bg; ?>">
        <td><?=$row['mb_center']?></td>
        <td><?=$row['year']?>년 <?=$row['month']?>월 <?=$row['week_of_month']?>주</td>
        <td><?=$row['mb_charge_pro']?></td>
        <td><?php if(!empty($row['cash_price'])) { echo number_format($row['cash_price']*1); }?></td>
        <td><?php if(!empty($row['credit_card_price'])) { echo number_format($row['credit_card_price']*1); }?></td>
        <td><?php if(!empty($row['check_card_price'])) { echo number_format($row['check_card_price']*1); }?></td>
        <td><?=number_format($total)?></td>
        <td><?php if(!empty($row['fees'])) { echo number_format($row['fees']*1); }?></td>
        <td><?php if(!empty($row['pro_extra_pay'])) { echo number_format($row['pro_extra_pay']*1); }?></td>
        <td><?=number_format($total)?></td>
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

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'."&start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date']."&center=".$_REQUEST['center']."&pro=".$_REQUEST['pro'].'&amp;page='); ?>

<script>
$(function() {
    $('#total_sales').text("총 합계 : <?=number_format($total_sales)?>");

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
    if(value == '월간매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list_month_admin.php?center=<?=$center?>');
    } else if(value == '연간매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list_year_admin.php?center=<?=$center?>');
    } else if(value == '당일매출') {
        location.replace('<?=G5_ADMIN_URL?>/sales_list_admin.php?center=<?=$center?>');
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

$("#state_div .tabs li").on("click", function() {
    var lv = $(this).data("lv")
    var para = document.location.href.split("?");
    var params = ""
    if (lv != "") {
        params += "?center=" + lv;
    }

    location.replace(g5_admin_url + "/sales_list_week_admin.php" + params)
});
</script>

<?php
include_once ('./admin.tail.php');
?>
