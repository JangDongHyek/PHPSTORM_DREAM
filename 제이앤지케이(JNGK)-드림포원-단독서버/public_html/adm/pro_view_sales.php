<?php
$sub_menu = "210100";
include_once('./_common.php');

// ***** 현재 페이지 수정 시 adm/sales_list_admin.php, adm/sales_list.php 같이 수정 *****

/** 팀장 - 프로선택 - 매출관리 **/

auth_check($auth[$sub_menu], 'w');

$mb_no = $_GET['mb_no'];

$mb = get_member_no($mb_no);
$pro_name = $mb['mb_name'];

$sql_common = " from g5_sales as sa left join g5_member as mb on mb.mb_no = sa.mb_no ";

$sql_search = " where 1=1 and mb.use_yn = 'Y' and sa.pro_mb_no = '{$mb_no}' ";

if ($_REQUEST['lv'] == '당일매출') {
    $today = date('Y-m-d');
    if(!empty($_GET['start_date'])) {
        $start = $_GET['start_date'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$today}') ";
    }
    if(!empty($_GET['end_date'])) {
        $end = $_GET['end_date'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$today}') ";
    }
} else if ($_REQUEST['lv'] == '월간매출') {
    if(!empty($_GET['start_date'])) {
        $start = substr($_GET['start_date'], 0, 7);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') >= '{$start}') ";
    } else {
        $today = date('Y-m');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') >= '{$today}') ";
    }
    if(!empty($_GET['end_date'])) {
        $end = substr($_GET['end_date'], 0, 7);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') <= '{$end}') ";
    } else {
        $today = date('Y-m');
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m') <= '{$today}') ";
    }
} else if ($_REQUEST['lv'] == '주간매출') {
    $today = date('Y-m-d');
    // == 이번주 시작일, 종료일 ==
    $time = explode(" ",microtime());
    $s = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +0/* 시작일 기준 */, date("Y",$time[1]));
    $e = mktime(0,0,0, date("m",$time[1]), date("d",$time[1]) - date("w",$time[1]) +6/* 종료일 기준 */, date("Y",$time[1]));
    $start = date("Y-m-d", $s); // 이번주 시작일
    $end = date("Y-m-d", $e); // 이번주 종료일
    // == 이번주 시작일, 종료일 ==
    if(!empty($_GET['start_date'])) {
        $start = $_GET['start_date'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') >= '{$start}') ";
    }
    if(!empty($_GET['end_date'])) {
        $end = $_GET['end_date'];
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y-%m-%d') <= '{$end}') ";
    }
} else { // 연간매출
    $today = date('Y');
    if(!empty($_GET['start_date'])) {
        $start = substr($_GET['start_date'], 0, 4);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') >= '{$start}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') >= '{$today}') ";
    }
    if(!empty($_GET['end_date'])) {
        $end = substr($_GET['end_date'], 0, 4);
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') <= '{$end}') ";
    } else {
        $sql_search .= " and (date_format(sa.mb_reg_date, '%Y') <= '{$today}') ";
    }
}

if($_REQUEST['lv'] == '당일매출') {
$sql_ = " DATE(sa.mb_reg_date) as date "; // count 용
$sql_group = " GROUP BY date, mb.mb_no ";
$sql_order = " order by date asc ";
}
else if($_REQUEST['lv'] == '월간매출') {
$sql_ = " MONTH(sa.mb_reg_date) as month "; // count 용
$sql_group = " GROUP BY month, mb.mb_no ";
$sql_order = " order by date asc ";
}
else if($_REQUEST['lv'] == '주간매출') {
$sql_ = " DATE_FORMAT(sa.mb_reg_date, '%Y%U') AS date "; // count 용
$sql_group = " GROUP BY date, mb.mb_no ";
$sql_order = " order by DATE(sa.mb_reg_date) asc ";
}
else { // 연간매출
$sql_ = " YEAR(sa.mb_reg_date) as year "; // count 용
$sql_group = " GROUP BY year, mb.mb_no ";
$sql_order = " order by date asc ";
}

$sql = " select {$sql_} {$sql_common} {$sql_search} {$sql_group} ";
$result = sql_query($sql);
$total_count = sql_num_rows($result);
//$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
//$row = sql_fetch($sql);
//$total_count = $row['cnt'];

$rows = 15;
$total_page = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$colspan = 11;
if($_REQUEST['lv'] == '당일매출') {
    $sql_select = " select DATE(sa.mb_reg_date) as date, sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
                    card_company, sum(pro_extra_pay) as pro_extra_pay, mb.mb_name, sa.mb_reg_date, count(idx) as count, sum(headoffice_pay) as headoffice_pay, pay_percent ";
    $sql = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
    $sql2 = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";

    $colspan = 12;
}
else if($_REQUEST['lv'] == '월간매출') {
    $sql_select = " select MONTH(sa.mb_reg_date) AS month, DATE(sa.mb_reg_date) as date, sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
                    sum(pro_extra_pay) as pro_extra_pay, mb.mb_name, sa.mb_reg_date, count(idx) as count, sum(headoffice_pay) as headoffice_pay, pay_percent ";
    $sql = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
    $sql2 = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else if($_REQUEST['lv'] == '주간매출') {
    $sunday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE())  -1 ) as sunday from dual " )['sunday']; // 이번주의 첫일(일요일)
    $saturday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE()) + 5 ) as saturday from dual " )['saturday']; // 이번주의 마지막일(토요일)
    $sql_select = " select DATE_FORMAT(DATE_SUB(sa.mb_reg_date, INTERVAL (DAYOFWEEK(sa.mb_reg_date)-1) DAY), '%Y-%m-%d') as start,
                    DATE_FORMAT(DATE_SUB(sa.mb_reg_date, INTERVAL (DAYOFWEEK(sa.mb_reg_date)-7) DAY), '%Y-%m-%d') as end,
                    DATE_FORMAT(sa.mb_reg_date, '%Y%U') AS date,
                    DATE_FORMAT(sa.mb_reg_date, '%Y') AS year,
                    DATE_FORMAT(sa.mb_reg_date, '%m') AS month,
                    FLOOR((DATE_FORMAT(sa.mb_reg_date,'%d')+(DATE_FORMAT(DATE_FORMAT(sa.mb_reg_date,'%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month,
                    sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
                    sum(pro_extra_pay) as pro_extra_pay, mb.mb_name, sa.mb_reg_date, count(idx) as count, sum(headoffice_pay) as headoffice_pay, pay_percent ";
    $sql = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
    $sql2 = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
else { // 연간매출
    $sql_select = " select YEAR(sa.mb_reg_date) AS year, DATE(sa.mb_reg_date) AS date, sum(cash_price) as cash_price, sum(credit_card_price) as credit_card_price, sum(check_card_price) as check_card_price, sum(fees) as fees, 
                    sum(pro_extra_pay) as pro_extra_pay, mb.mb_name, sa.mb_reg_date, count(idx) as count, sum(headoffice_pay) as headoffice_pay, pay_percent ";
    $sql = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
    $sql2 = " {$sql_select} {$sql_common} {$sql_search} {$sql_group} {$sql_order} ";
}
//echo $sql;
$result = sql_query($sql);
$result2 = sql_query($sql2);

// 총 합계 == 페이징 때문에 쿼리 따로 처리
$total_cash = 0;
$total_credit = 0;
$total_check = 0;
$total_cash_card = 0;
$total_card_fees = 0;
$total_pro_fees = 0;
$total_headoffice_pay = 0;
$total_sales = 0;
for($k=0; $row2=sql_fetch_array($result2); $k++) {
    $total_cash += $row2['cash_price']*1;
    $total_credit += $row2['credit_card_price']*1;
    $total_check += $row2['check_card_price']*1;
    $total_cash_card += $row2['cash_price']*1 + $row2['credit_card_price']*1 + $row2['check_card_price']*1;
    $total_card_fees += $row2['fees']*1;
    /*$total_pro_fees += $row2['pro_extra_pay']*1;*/
    $total_pro_fees += $row2['cash_price']*1 - ($row2['pro_extra_pay']*1 + ($row2['cash_price'] * $row2['pay_percent'] / 100)); // 프로수수료(합계) = 현금(합계) - (프로수수료(합계)+(현금(합계)*프로수수료율))
    $total_headoffice_pay += $row2['headoffice_pay']*1;
    $total_sales += $row2['cash_price']*1 + $row2['credit_card_price']*1 + $row2['check_card_price']*1 - $row2['fees']*1;
}

$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?mb_no=' . $mb_no . '" class="ov_listall" style="padding-right: 15px;">전체</a>';

$g5['title'] .= $mb['mb_category'] . '관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>

<style>
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
    #state_div ul.tabs {margin: 0;padding: 0;float: left;list-style: none;height: 40px;border-left: 1px solid #eee;width: 100%;font-size:15px;}
    #state_div ul.tabs li {float: left; text-align:center; cursor: pointer; width:150px; height: 40px; line-height: 35px;border: 1px solid #eee; border-left: none; background: #fafafa; overflow: hidden; position: relative;}
    #state_div ul.tabs li.active {background: #FFFFFF; border-bottom: 1px solid #FFFFFF;}

    .btn_adm_pro_ok {
        display: inline-block;
        line-height: 35px;
        background: #f3d421;
        color: #333;
        font-size: 1.2em;
        font-weight: 600;
        border: 1px solid #f3d421;
        width: 100px;
        margin: 0 5px;
        text-align: center;
        border-radius: 30px;
    }

    /* 합계 표시줄 */
    .lre_list_tit { margin-bottom: 0px !important; }
    .total_tr th { background: unset !important; }
</style>

<div id="tab_box">
    <ul class="tab">
        <li class="" id="tab0"><a href="javascript:void(0);" onclick="tabClick('pro_view_member.php');">유효회원</a></li>
        <li class="" id="tab1"><a href="javascript:void(0);" onclick="tabClick('pro_view.php');">레슨현황</a></li>
        <li class="" id="tab2"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab2.php');">스케줄관리</a></li>
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('pro_view_atta.php');">근태관리</a></li>
        <!--<li class="" id="tab4"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab5.php');">신규/재등록 현황</a></li>-->
        <li class="current" id="tab5"><a href="javascript:void(0);">매출관리</a></li>
    </ul>
</div><!--#tab_box-->

<!--프로 프로필영역 시작//-->
<div class="adm_pro_info">
    <div class="apro_img">
        <?
        $sql = " select * from g5_member_img where mb_no = '{$mb['mb_no']}' ";
        $file = sql_fetch($sql);

        if (!empty($file['img_file'])) {
            ?>
            <img src="<?= G5_DATA_URL ?>/file/member/<?= $file['img_file'] ?>">
            <?
        } else {
            ?>
            <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif"/>
            <?php
        }
        ?>
    </div><!--.apro_img-->
    <div class="apro_name">
        <?php /*?><span style="font-weight: bold;margin-right: 10px;"><?=$mb_state?></span> 
        <span><?=$mb['mb_id_no']?></span> <?php */ ?>
        <?= $mb['mb_name'] ?> <span><?= $mb['mb_category'] ?></span>
    </div><!--.apro_name-->
    <div style="text-align: center;">
        <input type="button" class="btn_adm_pro_ok" value="정보수정" onclick="location.href='<?=G5_ADMIN_URL?>/pro_form.php?w=u&mb_no=<?=$mb_no?>'">
    </div>
</div><!--.adm_pro_info-->
<!--//프로 프로필영역 끝-->


<div id="state_div">
    <ul class="tabs" style="margin-bottom: 10px;width: 700px;">
        <li <? if ($lv == "당일매출") echo 'class="active"'; ?> data-lv="당일매출">당일매출</li>
        <li <? if ($lv == "주간매출") echo 'class="active"'; ?> data-lv="주간매출">주간매출</li>
        <li <? if ($lv == "월간매출") echo 'class="active"'; ?> data-lv="월간매출">월간매출</li>
        <li <? if ($lv == "연간매출") echo 'class="active"'; ?> data-lv="연간매출">연간매출</li>
    </ul>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="text-align: right;">
    <!--기간검색-->
    <div class="lre_ldate">
        <?/*=$listall*/?>
        <input type="button" class="btn_ldate" value="엑셀다운로드" onclick="excel_down();">
        <?php if($_REQUEST['lv'] == '주간매출') { ?>
            <input type="date" name="start_date" value="<?php echo empty($_GET['start_date']) ? $sunday : $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?php echo empty($_GET['end_date']) ? $saturday : $_GET['end_date'] ?>" class="input_ldate"/>
        <?php } else if($_REQUEST['lv'] != '당일매출') { ?>
            <input type="date" name="start_date" value="<?php echo empty($_GET['start_date']) ? '' : $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?php echo empty($_GET['end_date']) ? '' : $_GET['end_date'] ?>" class="input_ldate"/>
        <?php } else { ?>
            <input type="date" name="start_date" value="<?php echo empty($_GET['start_date']) ? date('Y-m-d') : $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?php echo empty($_GET['end_date']) ? date('Y-m-d') : $_GET['end_date'] ?>" class="input_ldate"/>
        <?php } ?>
        <input type="hidden" id="sales_option" name="sales_option" value="">
        <input type="hidden" name="lv" value="<?=$_REQUEST['lv']?>" id="lv">
        <input type="hidden" name="mb_no" value="<?=$_REQUEST['mb_no']?>" id="mb_no">
        <input type="submit" class="btn_ldate" value="검색">
    </div><!--.lre_ldate-->
</form>

<div class="tbl_head02 tbl_wrap mb_tbl">
    <div class="lre_list_tit">
        <?=$_REQUEST['lv']?>
        <span class="les_sdate">
            기간 :
            <?php
            if(!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
                if($_REQUEST['lv'] == '월간매출') { echo substr($_GET['start_date'],0,7).' ~ '.substr($_GET['end_date'],0,7); }
                else if($_REQUEST['lv'] == '연간매출') { echo substr($_GET['start_date'],0,4).' ~ '.substr($_GET['end_date'],0,4); }
                else { echo $_GET['start_date'].' ~ '.$_GET['end_date']; }
            }
            else if(!empty($_GET['start_date'])) {
                if($_REQUEST['lv'] == '월간매출') { echo substr($_GET['start_date'],0,7).' ~ '; }
                else if($_REQUEST['lv'] == '연간매출') { echo substr($_GET['start_date'],0,4).' ~ '; }
                else { echo $_GET['start_date'].' ~ ';  }
            }
            else if(!empty($_GET['end_date'])) {
                if($_REQUEST['lv'] == '월간매출') { echo ' ~ '.substr($_GET['end_date'],0,7); }
                else if($_REQUEST['lv'] == '연간매출') { echo ' ~ '.substr($_GET['end_date'],0,4); }
                else { echo ' ~ '.$_GET['end_date'];   }
            }
            else {
                if($_REQUEST['lv'] == '당일매출') {
                    echo date('Y-m-d').' ~ '.date('Y-m-d');
                } else if($_REQUEST['lv'] == '주간매출') {
                    echo $sunday.' ~ '.$saturday;
                } else if($_REQUEST['lv'] == '월간매출') {
                    echo date('Y-m').' ~ '.date('Y-m');
                } else {
                    echo date('Y');
                }
            }
            ?>
        </span>
    </div><!--.lre_list_tit-->
    <table style="border-top: unset !important;">
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <colgroup>
        </colgroup>
        <thead>
        <tr class="total_tr">
            <?php if($_REQUEST['lv'] == '당일매출') { ?>
            <th></th>
            <?php } else if($_REQUEST['lv'] == '주간매출') { ?>
            <th></th>
            <?php } else if($_REQUEST['lv'] == '월간매출') { ?>
            <th></th>
            <?php } else { ?>
            <th></th>
            <?php } ?>
            <th></th>
            <th></th>
            <th><span>합 계</span></th>
            <th><span id="total_cash"></span></th>
            <th><span id="total_credit"></span></th>
            <th><span id="total_check"></span></th>
            <th><span id="total_cash_card"></span></th>
            <?php if($_REQUEST['lv'] == '당일매출') { ?>
            <th></th>
            <?php } ?>
            <th><span id="total_card_fees"></span></th>
            <th><span id="total_pro_fees"></span></th>
            <!--<th><span id="total_headoffice_pay"></span></th>-->
            <th><span id="total_sales"></span></th>
        </tr>
        <tr style="border-top: 1px solid #444 !important;">
            <?php if($_REQUEST['lv'] == '당일매출') { ?>
            <th>일자</th>
            <?php } else if($_REQUEST['lv'] == '주간매출') { ?>
            <th>주차</th>
            <?php } else if($_REQUEST['lv'] == '월간매출') { ?>
            <th>월</th>
            <?php } else { ?>
            <th>연도</th>
            <?php } ?>
            <th>회원명</th>
            <th>등록일자</th>
            <th>건수</th>
            <th>현금</th>
            <th>신용카드</th>
            <th>체크카드</th>
            <th>현금+카드</th>
            <?php if($_REQUEST['lv'] == '당일매출') { ?>
            <th>카드사</th>
            <?php } ?>
            <th>카드수수료</th>
            <th>프로수수료</th>
            <!--<th>본사지급액</th>-->
            <th>매출</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            //$bg = 'bg'.($i%2);

            // * 합계 = 현금+카드-수수료
            $cash_card = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1;
            $total = $row['cash_price']*1 + $row['credit_card_price']*1 + $row['check_card_price']*1 - $row['fees']*1;
        ?>
            <tr class="<?php echo $bg; ?>">
                <?php if($_REQUEST['lv'] == '당일매출') { ?>
                <td><?=$row['date']?></td>
                <?php } else if($_REQUEST['lv'] == '주간매출') { ?>
                <td><?=$row['year']?>년 <?=$row['month']?>월 <?=$row['week_of_month']?>주</td>
                <?php } else if($_REQUEST['lv'] == '월간매출') { ?>
                <td><?=$row['date']?>월</td>
                <?php } else { ?>
                <td><?=$row['year']?>년</td>
                <?php } ?>
                <td><?=$row['mb_name']?></td>
                <td><?=substr($row['mb_reg_date'],0,10)?></td>
                <td><?=$row['count']?></td>
                <td><?php if(!empty($row['cash_price'])) { echo number_format($row['cash_price']*1); }?></td>
                <td><?php if(!empty($row['credit_card_price'])) { echo number_format($row['credit_card_price']*1); }?></td>
                <td><?php if(!empty($row['check_card_price'])) { echo number_format($row['check_card_price']*1); }?></td>
                <td><?=number_format($cash_card)?></td>
                <?php if($_REQUEST['lv'] == '당일매출') { ?>
                <td><?=$row['card_company']?></td>
                <?php } ?>
                <td><?php if(!empty($row['fees'])) { echo number_format($row['fees']*1); }?></td>
                <td><?php if(!empty($row['pro_extra_pay'])) { echo number_format($row['pro_extra_pay']*1); }?></td>
                <!--<td><?php /*if(!empty($row['headoffice_pay'])) { echo number_format($row['headoffice_pay']*1); }*/?></td>-->
                <td><?=number_format($total)?></td>
            </tr>
            <?php
        }
        if ($i == 0)
            echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
        ?>
        </tbody>
    </table>
    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&mb_no='.$_REQUEST['mb_no'].'&start_date='.$_REQUEST['start_date'].'&end_date='.$_REQUEST['end_date'].'&lv='.$_REQUEST['lv'].'&amp;page='); ?>
</div>

<div class="adm_mw_btn">
    <a href="<?= G5_ADMIN_URL ?>/pro_list.php" class="btn_adm_cancel">목록</a>
</div>
<!--//레슨현황 끝-->

<script>
    $(function() {
        $('#total_cash').text('<?=number_format($total_cash)?>');
        $('#total_credit').text('<?=number_format($total_credit)?>');
        $('#total_check').text('<?=number_format($total_check)?>');
        $('#total_cash_card').text('<?=number_format($total_cash_card)?>');
        $('#total_card_fees').text('<?=number_format($total_card_fees)?>');
        $('#total_pro_fees').text('<?=number_format($total_pro_fees)?>');
        $('#total_headoffice_pay').text('<?=number_format($total_headoffice_pay)?>');
        $('#total_sales').text('<?=number_format($total_sales)?>');

        // 프로수수료(합계)가 현금(합계)보다 작을 시 '-' 붙이고 빨간색
        if($('#total_pro_fees').text().replace(/,/gi,'')*1 < $('#total_cash').text().replace(/,/gi, '')*1) {
            $('#total_pro_fees').text('<?php echo $total_pro_fees < 0 ? number_format($total_pro_fees) : number_format(-$total_pro_fees) ?>');
            $('#total_pro_fees').attr('style', 'color:red;');
        }

        // 현금이 0일 경우는 '-' 붙이지 않고 검은색
        if($('#total_cash').text().replace(/,/gi, '')*1 == 0) {
            $('#total_pro_fees').text('<?php echo $total_pro_fees < 0 ? number_format(-$total_pro_fees) : number_format($total_pro_fees) ?>');
            $('#total_pro_fees').attr('style', 'color:black;');
        }
    });

    $("#state_div .tabs li").on("click", function() {
        var lv = $(this).data("lv")
        var para = document.location.href.split("?");
        var params = ""
        params += "?mb_no=<?=$mb_no?>";
        if (lv != "") {
            params += "&lv=" + lv;
        }

        location.replace(g5_admin_url + "/pro_view_sales.php" + params)
    });

    function tabClick(tab) {
        if (tab == 'pro_view_tab5.php') {
            alert('준비중입니다.');
            return false;
        }

        location.replace(g5_admin_url + '/' + tab + '?mb_no=<?=$mb_no?>');
    }

    // 엑셀 다운로드
    function excel_down() {
        var start = '<?=$start?>';
        var end = '<?=$end?>';
        console.log(start);
        var option = '<?=$_REQUEST['lv']?>';
        var pro = '<?=$mb_no?>';
        var pro_name = '<?=$pro_name?>';
        location.href = g5_admin_url + '/excel.pro_sales_status.php?start='+start+'&end='+end+'&option='+option+'&pro='+pro+'&pro_name='+pro_name;
        // location.href = g5_admin_url + '/excel.sales_list.php?start='+start+'&end='+end+'&option='+option+'&pro='+pro;
    }
</script>

<?php
include_once('./admin.tail.php');
?>