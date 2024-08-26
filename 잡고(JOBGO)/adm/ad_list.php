<?php
$sub_menu = "360100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

// ===== 광고종료일시에 따라 상태 자동 변경
$sql = " select * from new_advertisement ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    $end_date = substr($row['ad_end_date'], 0, 10);
    if(!empty($end_date) && $end_date != '0000-00-00' && date('Y-m-d') > substr($row['ad_end_date'], 0, 10)) { // 광고종료일시 지났을 경우 진행종료로 상태 변경
        sql_fetch(" update new_advertisement set ad_status='진행종료' where idx={$row['idx']}; ");
    }
}
// =====

$sql_common = " from new_advertisement as ad ";

$sql_search = " where 1=1 ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'ad_status' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "ad.wr_datetime";
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

$listall = '<a style = "font-weight: bold" href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '광고신청현황';
include_once('./admin.head.php');

$sql = " select ad.* {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 8;
?>

<style>
    .mb_tbl table {text-align: center;}
    .tbl_head02 thead th {
        padding: 5px 0;
        border: 1px solid #d1dee2;
        background: #e5ecef;
        color: #383838;
        font-size: 0.95em;
        letter-spacing: -0.1em;
    }
    .tbl_head02 tbody td {
        padding: 5px 3px;
        line-height: 1.4em;
        word-break: break-all;
    }
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총게시글 <?php echo number_format($total_count) ?> 개
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>

    <select name="sfl" id="sfl" onchange="sfl_change();">
        <option value="ad.mb_id"<?php echo get_selected($_GET['sfl'], "ad.mb_id"); ?>>전문가 아이디</option>
        <option value="ad_status"<?php echo get_selected($_GET['sfl'], "ad_status"); ?>>상태</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <span id="stx_span" style="display: inline"><input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input"></span>
    <span id="stx_span" style="display: inline"><input type="submit" class="btn_submit" value="검색"></span>
    <!--<span style="display: inline; margin-left: 15px">
        <input onchange="date_change()" type="date" id="stx_month1" value="<?php /*echo $month1 */?>" name="month1" max="<?/*=date('yy-m-d')*/?>">
        <input onchange="date_change()" type="date" id="stx_month2" value="<?php /*echo $month2 */?>" name="month2" max="<?/*=date('yy-m-d')*/?>">
        <input type="button" class="btn_submit" style="background: grey" value="오늘" onclick="click_day()">
        <input type="button" class="btn_submit" style="background: grey" value="한달" onclick="click_month()">
    </span>-->
</form>

<div class="local_desc01 local_desc">
    <p>※ <?=$listall?>을 클릭하면 검색조건이 초기화 됩니다.</p>
    <p>※ '진행중'으로 상태 변경 시 광고시작일시와 광고종료일시가 자동 입력됩니다. (광고 기간은 1주일 단위입니다.)</p>
</div>

<form name="fmemberlist" id="fmemberlist" action="./ad_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
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
                <th>no</th>
                <th>상태</th>
                <th>전문가아이디</th>
                <th>이름</th>
                <th>휴대폰</th>
                <th>상품</th>
                <th>마일리지</th>
                <th>광고시작일시</th>
                <th>광고종료일시</th>
                <th>광고잔여일</th>
                <th>광고신청일</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $rows;
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $bg = 'bg'.($i%2);
                $mb = get_member($row['mb_id']);

                $category = '';
                if($row['ad_category'] == '1') { $category = '메인 상단'; }
                else if($row['ad_category'] == '2') { $category = '메인 하단'; }
                else if($row['ad_category'] == '3') { $category = '카테고리 상단'; }
                else if($row['ad_category'] == '4') { $category = '플러스'; }

                // 광고 잔여 일 계산 (진행 중인 광고만)
                $end_date = $row['ad_end_date'];
                if(date('Y-m-d') > $end_date) { // 종료예정일이 없거나 종료예정일이 지났을 경우 d_day = 0;
                    $d_day = 0;
                } else {
                    $d_day = ( strtotime($end_date) - strtotime(date('Y-m-d')) ) / 86400; // 남은 일자 계산
                }
            ?>
                <tr class="<?php echo $bg; ?>">
                    <td><?=$list_no?></td>
                    <td width="5%">
                        <select name="gp_type" onchange="status_change(<?=$row['idx']?>,this.value)">
                            <option <? if ($row['ad_status'] == '진행대기') echo "selected"; ?> value="진행대기">진행대기</option>
                            <option <? if ($row['ad_status'] == '진행중') echo "selected"; ?> value="진행중">진행중</option>
                            <option <? if ($row['ad_status'] == '진행종료') echo "selected"; ?> value="진행종료">진행종료</option>
                        </select>
                    </td>
                    <td><a href="?sfl=ad.mb_id&amp;stx=<?php echo $mb['mb_id'] ?>"><?=$mb['mb_id']?></a></td>
                    <td><?=$mb['mb_name']?></td>
                    <td><?=$mb['mb_hp']?></td>
                    <td><?=$category?> 배너를 구입하였습니다.</td>
                    <td><?=number_format($row['ad_fee'])?>원</td>
                    <td><?php echo $row['ad_start_date'] == '0000-00-00 00:00:00' ? '' : substr($row['ad_start_date'], 0, 10)?></td>
                    <td><?php echo $row['ad_end_date'] == '0000-00-00 00:00:00' ? '' : substr($row['ad_end_date'], 0, 10)?></td>
                    <td><?=$d_day?>일</td>
                    <td><?=substr($row['wr_datetime'],0,10)?></td>
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


<script>

    $(document).ready(function () {
        sfl_change('ready');
    })

    /*function click_month() {
        $('#stx_month1').val('<?=date("Y-m-d", strtotime("-1 months"))?>');
        $('#stx_month2').val('<?=date("Y-m-d")?>');

        date_change()
    }

    function click_day() {
        $('#stx_month1').val('<?=date("Y-m-d")?>');
        $('#stx_month2').val('<?=date("Y-m-d")?>');

        date_change()
    }
    
    function date_change() {
        var month1 = $('#stx_month1').val();
        var month2 = $('#stx_month2').val();
        var params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (month1 != "" || month2 != ""){
            params = "?month1=" + month1 + "&month2="+ month2;
        }

        if (stx != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx;
        }

        location.href = g5_admin_url + "/payment_list.php"+ params;
    }*/

    // 상태 변경
    function status_change(idx, val) {
        status_ajax(idx, val)
    }

    function status_ajax(idx, val) {
        $.ajax({
            url: g5_admin_url+"/adm.ajax.controller.php",
            type: "POST",
            data: {
                "idx": idx,
                "status" : val,
                "mode": "ad_status_change"
            },
            success: function(data) {
                if (data != 1) {
                    alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                }else{
                    alert("상태가 변경되었습니다.");
                    location.href = location.href
                }
            }
        });
    }

    //검색 조건이 상태일 경우 select 박스로 변경
    function sfl_change(type) {
        var sfl = $('#sfl');
        if (sfl.val() == 'ad_status'){
            $('#stx_span').html('<select name="stx" id="stx" class=" frm_input" value="<?php echo $stx ?>">' +
                '<option value = "진행대기">진행대기</option>' +
                '<option value = "진행중">진행중</option>' +
                '<option value = "진행종료">진행종료</option>' +
                '</select>');
            //검색 후 셀렉트값 넣어줌
            $("#stx").val($('#fmemberlist [name = "stx"]').val()).prop("selected", true);
        }else{
            if (type != "ready") {
                $('#stx_span').html('<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input">');
                $("#stx").val("");
            }
        }
    }
</script>

<?php
include_once ('./admin.tail.php');
?>
