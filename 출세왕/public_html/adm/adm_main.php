<?php
$sub_menu = "100000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');



$sql_common = " from {$g5['member_table']} ";

if($_SESSION['ss_mb_id'] == "lets080" || $_SESSION['ss_mb_id'] == "admin"){
    $sql_search .= " where 1=1 and mb_id!='lets080' ";
}else{
    $sql_search .= " where 1=1 and mb_id!='lets080' and mb_level < 4 ";
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
    $sql_search .= " and mb_id != 'lets080'";

if ($_GET['lv']){
    $sql_search .= " and mb_level = '{$_GET['lv']}' ";
    $lv = $_GET['lv'];
}

if ($_GET['yn'] != ""){
    $sql_search .= " and mb_1 = '{$_GET['yn']}' ";
    $qstr .= "&yn=".$_GET['yn'];
}



if (!$sst) {
    $sst = "mb_datetime";
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


$g5['title'] = 'MAIN DASH BOARD';
include_once('./admin.head.php');

//대기, 배차, 완료, 취소 count
$sql = "SELECT (SELECT COUNT(cw_idx) From {$g5['car_wash_table']} WHERE cw_step = 0) wait,
(SELECT COUNT(cw_idx) From  {$g5['car_wash_table']} WHERE cw_step = 1) assign,
(SELECT COUNT(cw_idx) From  {$g5['car_wash_table']} WHERE cw_step = 2) complete,
(SELECT COUNT(cw_idx) From  {$g5['car_wash_table']} WHERE cw_step = 3) cancel
from  {$g5['car_wash_table']} LIMIT 1";
//echo $sql;

$assign_cnt = sql_fetch($sql);

$sql = "select mb_id,mb_name,mb_hp from {$g5['member_table']} where mb_level = 3 and mb_1 = 'Y' ";
$mem_result = sql_query($sql);

?>
<br>

<!--
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="date" name="start_date" id="start_date" max="9999-12-31" value="<?=$_REQUEST["start_date"]?>">~
    <input type="date" name="end_date" id="end_date" max="9999-12-31" value="<?=$_REQUEST["end_date"]?>">
    <input type="button" class="btn_submit" style="background: grey" value="오늘" onclick="click_day()">
    <input type="button" class="btn_submit" style="background: grey" value="한달" onclick="click_month()">

    <input type="submit" class="btn_submit" value="검색">

</form>
-->

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
            <thead>
            <tr>
                <th width="33%">항목</th>
                <th width="33%">오늘</th>
                <th width="33%">최근1주일</th>
            </tr>
            </thead>
            <?
                $sql = "SELECT
                        (SELECT COUNT(*) FROM g5_member WHERE mb_datetime > CURDATE()) cnt1_1,
                        (SELECT COUNT(*) FROM g5_member WHERE mb_datetime BETWEEN DATE_ADD(NOW(), INTERVAL -1 WEEK ) AND NOW()) cnt1_2,
                        (SELECT COUNT(*) FROM new_car_wash WHERE wr_datetime > CURDATE()) cnt2_1,
                        (SELECT COUNT(*) FROM new_car_wash WHERE wr_datetime BETWEEN DATE_ADD(NOW(), INTERVAL -1 WEEK ) AND NOW()) cnt2_2,
                        (SELECT COUNT(*) FROM new_re_car_wash WHERE wr_datetime > CURDATE()) cnt3_1,
                        (SELECT COUNT(*) FROM new_re_car_wash WHERE wr_datetime BETWEEN DATE_ADD(NOW(), INTERVAL -1 WEEK ) AND NOW()) cnt3_2,
                        (SELECT COUNT(*) FROM new_review WHERE wr_datetime > CURDATE()) cnt4_1,
                        (SELECT COUNT(*) FROM new_review WHERE wr_datetime BETWEEN DATE_ADD(NOW(), INTERVAL -1 WEEK ) AND NOW()) cnt4_2,
                        (SELECT COUNT(*) FROM new_car_wash WHERE call_req = 'Y' and wr_datetime > CURDATE()) cnt5_1,
                        (SELECT COUNT(*) FROM new_car_wash WHERE call_req = 'Y' and wr_datetime BETWEEN DATE_ADD(NOW(), INTERVAL -1 WEEK ) AND NOW()) cnt5_2       
";
                $row = sql_fetch($sql);
            ?>

            <tbody>
            <tr>
                <td>가입자</td>
                <td><?=$row["cnt1_1"]?></td>
                <td><?=$row["cnt1_2"]?></td>
            </tr>
            <tr>
                <td>세차</td>
                <td><?=$row["cnt2_1"]?></td>
                <td><?=$row["cnt2_2"]?></td>
            </tr>
            <tr>
                <td>재작업</td>
                <td><?=$row["cnt3_1"]?></td>
                <td><?=$row["cnt3_2"]?></td>
            </tr>
            <tr>
                <td>건의함</td>
                <td><?=$row["cnt4_1"]?></td>
                <td><?=$row["cnt4_2"]?></td>
            </tr>
            <tr>
                <td>연락요청</td>
                <td><?=$row["cnt5_1"]?></td>
                <td><?=$row["cnt5_2"]?></td>
            </tr>
            </tbody>
        </table>

</form>

<script>

    $(document).on('click', "ul.cate_lv li, ul.cate_yn li", function(){
        var level = $(this).data("lv"),
            yn = $(this).data("yn"),
            params = "";

        if (level != undefined) {
            console.log(level);
            $("#level").val(level);
        }
        if (yn != undefined) {
            console.log(yn);
            $("#yn").val(yn);
        }


        params += "&lv=" + $("#level").val() + "&yn=" + $("#yn").val();



        var sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (stx != "") {
            params += "&sfl=" + sfl + "&stx=" + stx;
        }



        //location.href = g5_admin_url + "/member_list.php?" + params;
        location.href = g5_admin_url + "adm_main.php?&lv=&yn=N";

    });
    function click_month() {
        $('#start_date').val('<?=date("Y-m-d", strtotime("-1 months"))?>');
        $('#end_date').val('<?=date("Y-m-d")?>');

        date_change()
    }

    function click_day() {
        $('#start_date').val('<?=date("Y-m-d")?>');
        $('#end_date').val('<?=date("Y-m-d")?>');

        date_change()
    }

    function date_change() {
        var month1 = $('#start_date').val();
        var month2 = $('#end_date').val();
        var params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (month1 != "" || month2 != ""){
            params = "?start_date=" + month1 + "&end_date="+ month2;
        }

        if (stx != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx;
        }

        location.href = g5_admin_url + "/adm_main.php"+ params;


    }

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
</script>

<?php
include_once ('./admin.tail.php');
?>
