<?php
$sub_menu = "650600";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '가입경로';
include_once('./admin.head.php');


// 검색조건
$t = ($_GET['t'])? $_GET['t'] : "1";	// 1:당일, 2:월별
$s_date = ($_GET['s_date'])? $_GET['s_date'] : date("Y-m-d");
$s_year = ($_GET['s_year'])? $_GET['s_year'] : date("Y");
$s_month = ($_GET['s_month'])? $_GET['s_month'] : date("m");

// 조건문
if ($t == "2") { // 월별가입
    $start_like = $s_year."-".sprintf('%02d', $s_month);
} else { // 당일가입
    $start_like = $s_date;
}
$sql_common  = " AND mb_datetime LIKE '{$start_like}%' ";

// 회원가입 조회
$sql = "SELECT mb_id, mb_datetime, mb_join_path FROM g5_member 
        WHERE mb_join_path != '' {$sql_common} ORDER BY mb_no ASC";
$result = sql_query($sql);
//$member_cnt = sql_num_rows($result);

$path_count = array();

for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $exp = explode(",", $row['mb_join_path']);
    foreach ($exp AS $key=>$val) {
        $path_count[trim($val)] += 1;
        $path_count['total'] += 1;
    }
}

?>

<style>
    .total_rows {background: #F9F9F9;}
    .total_rows td {font-weight: bold;}
</style>

<div class="local_ov01 local_ov">
    <a href="./join_path.php" class="ov_listall">전체목록</a>
</div>

<input type="hidden" name="start_like" value="<?=$start_like?>">

<!-- 검색 -->
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="radio" name="t" value="1" id="m01" <? if ($t == "1") echo "checked"; ?>><label for="m01"> 당일가입</label>
    <input type="text" name="s_date" id="s01" value="<?=$s_date?>" class="frm_input" style="margin-right: 20px;" readonly>
    <input type="radio" name="t" value="2" id="m02" <? if ($t == "2") echo "checked"; ?>><label for="m02"> 월별가입</label>
    <select name="s_year" id="s02">
        <? for ($y = 2019; $y <= date("Y"); $y++) { ?>
            <option value="<?=$y?>" <? if ($s_year == $y) echo "selected"; ?>><?=$y?></option>
        <? } ?>
    </select>
    <select name="s_month" id="s03">
        <? for ($m = 1; $m < 13; $m++) { ?>
            <option value="<?=$m?>" <? if ((int)$s_month == $m) echo "selected"; ?>><?=$m?></option>
        <? } ?>
    </select>
    <input type="submit" class="btn_submit" value="검색">
</form>
<!-- // 검색 -->

<div class="max1200" id="calc_list">
    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table class="avg">
            <colgroup>
                <? foreach (MEMBER_JOIN_PATH as $key=>$val) { ?>
                <col width="10%">
                <? } ?>
                <col width="10%">
            </colgroup>
            <thead>
            <tr>
                <? foreach (MEMBER_JOIN_PATH as $key=>$val) { ?>
                <th><?=$val?></th>
                <? } ?>
                <th>총 합계</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <? foreach (MEMBER_JOIN_PATH as $key=>$val) { ?>
                <td>
                    <?if ((int)$path_count[$key] > 0) { ?>
                    <a href="javascript:void(0)" onclick="getDetail(<?=$key?>)"><?=number_format($path_count[$key])?></a>
                    <?}
                    else echo (int)$path_count[$key];
                    ?>
                </td>
                <? } ?>
                <td><?=number_format($path_count['total'])?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        day_arr = ['일', '월', '화', '수', '목', '금', '토'];

    $(function() {
        $("#s01").datepicker({
            changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, showMonthAfterYear : true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr

        }).on("change", function() {
            $("#m01").prop("checked", true);
        });

        $("#s02, #s03").on("change", function() {
            console.log(1);
            $("#m02").prop("checked", true);
        });

    });

    function getDetail(key) {
        var pop_w = 700, pop_h = 600, title = "연인";
        var left = Math.floor((window.innerWidth - pop_w) / 2),
            top = Math.floor((window.innerHeight - pop_h) / 2);
        var ts = new Date().getTime();
        title += " " + ts;

        var url = g5_admin_url + "/join_path_pop.php?key=" + key;
        url += "&date=" + document.querySelector("[name=start_like]").value;
        url += "&type=" + document.querySelector("[name=t]:checked").value;

        window.open(url, '',"width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");
    }
</script>


<?php
include_once ('./admin.tail.php');
?>

