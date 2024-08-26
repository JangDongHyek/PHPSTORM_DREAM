<?php
$sub_menu = "370200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from new_point_history ph left join g5_member mem on ph.mb_id = mem.mb_id";

$sql_search = " where 1=1  ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($_GET['date1']){
    $sql_search .= " and (date_format(ph.wr_datetime, '%Y-%m-%d') >= '{$_GET["date1"]}'
                        AND date_format(ph.wr_datetime, '%Y-%m-%d') <= '{$_GET["date2"]}') ";
}


if (!$sst) {
    $sst  = "p_idx";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select ph.*
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';


$g5['title'] = '적립금 내역';
include_once ('./admin.head.php');

$colspan = 9;

$po_expire_term = '';
if($config['cf_point_term'] > 0) {
    $po_expire_term = $config['cf_point_term'];
}

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    전체 <?php echo number_format($total_count) ?> 건

</div>
<div id="dialog-confirm" title="적립금 설정 * 비워둘 경우 금액이 적립되지 않습니다.">

</div>
<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="date1" value="<?=$_GET['date1']?>">
    <input type="hidden" name="date2" value="<?=$_GET['date2']?>">
    <input type="hidden" name="type" value="<?=$_GET['type']?>">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mem.mb_id"<?php echo get_selected($_GET['sfl'], "mem.mb_id"); ?>>회원아이디</option>
        <option value="mem.mb_name"<?php echo get_selected($_GET['sfl'], "mem.mb_name"); ?>>회원이름</option>
        <option value="p_content"<?php echo get_selected($_GET['sfl'], "p_content"); ?>>내용</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
    <input type="submit" class="btn_submit" value="검색">
</form>
<form name="fsearch2" id="fsearch2" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="sfl" value="<?=$_GET['sfl']?>">
    <input type="hidden" name="stx" value="<?=$_GET['stx']?>">
    <input type="hidden" name="type" value="<?=$_GET['type']?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <label>기간: </label>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="date" name="date1" value="<?php echo $_GET['date1'] ?>" id="date1" class="required frm_input">~
    <input type="date" name="date2" value="<?php echo  $_GET['date2'] ?>" id="date2" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">
    <input type="button" class="btn_submit" style="background: grey" value="기간 초기화" onclick="javascript:location.href='./point_history.php?<?=$qstr?>' ">
    <input type="button" class="btn_submit" style="background: grey; float: right" value="적립금 셋팅" onclick='dialog_open()' >
</form>

<form name="fpointlist" id="fpointlist" method="post" action="./point_list_delete.php" onsubmit="return fpointlist_submit(this);">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th style="width: 3%;">no.</th>
                <th scope="col"><?php echo subject_sort_link('mem.mb_id') ?>회원아이디</a></th>
                <th scope="col">이름</th>
                <th scope="col"><?php echo subject_sort_link('rh_content') ?>적립금 내용</a></th>
                <th scope="col"><?php echo subject_sort_link('rh_point') ?>적립금</a></th>
                <th scope="col"><?php echo subject_sort_link('wr_datetime') ?>일시</a></th>
                <th scope="col">적립금합</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = 15;
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $mb = get_member($row['mb_id']);
                $bg = 'bg'.($i%2);
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td><?=$list_no?></td>
                    <td width="10%"><a href="./member_form.php?w=u&mb_id=<?=$mb['mb_id']?>"><?php echo $mb['mb_id'] ?></a></td>
                    <td class="td_mbid"><?php echo $mb['mb_name'] ?></td>
                    <td class="td_pt_log"><?php echo $row['p_content'] ?></td>
                    <td class="td_num td_pt" style="color: <?= ($row['rh_bo_table'] == '@minus_reward') ? "blue" : "red" ?>"><?= ($row['rh_bo_table'] == 'minus') ? "-" : "+" ?><?php echo number_format($row['p_point']) ?></td>
                    <td class="td_datetime"><?=substr($row['wr_datetime'],2,8)?></td>
                    <td class="td_num td_pt"><?php echo number_format($row['p_total_point']) ?></td>
                </tr>

                <?php
                $list_no--;
            }

            if ($i == 0)
                echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
            ?>
            </tbody>
        </table>
    </div>

    <!--<div class="btn_list01 btn_list">-->
    <!--    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">-->
    <!--</div>-->

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?date1=".$_GET['date1']."&amp;date2=".$_GET['date2']."&amp;type=".$_GET['type']."&amp$qstr&amp;page="); ?>

<section id="point_mng">
    <h2 class="h2_frm">개별회원 적립금 추가</h2>

    <form name="fpointlist2" method="post" id="fpointlist2" action="./new_point_update.php" autocomplete="off">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="<?php echo $token ?>">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <colgroup>
                    <col class="grid_">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="mb_id">회원아이디<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="mb_id" value="<?php echo $mb_id ?>" id="mb_id" class="required frm_input" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="po_content">포인트 내용<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="p_content" id="p_content" required class="required frm_input"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="po_point">포인트<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="p_point" id="p_point" onkeyup="numberWithCommas(this)" required class="required frm_input"></td>
                </tr>
                <?php if($config['cf_point_term'] > 0) { ?>
                    <tr>
                        <th scope="row"><label for="po_expire_term">포인트 유효기간</label></th>
                        <td><input type="text" name="po_expire_term" value="<?php echo $po_expire_term; ?>" id="po_expire_term" class="frm_input" size="5"> 일</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="submit" value="확인" class="btn_submit">
        </div>

    </form>

</section>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function fpointlist_submit(f)
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


    $(function() {
        $("#dialog-confirm").dialog({
            autoOpen : false, //resizable: false,
            height: "auto",
            width: "650",
            modal: true,
            show: {effect: "blind", duration: 100},
            hide: {effect: "blind",	duration: 100},
            buttons: {
                "등록": function() {
                    frmSubmit();
                },
                "닫기" : function() {
                    getModalClose();
                }
            }
        });
    });


    function getModalClose() {
        $("#dialog-confirm").dialog("close").html("");
    }

    function frmSubmit(){
        $("#regFrm").submit();
    }

    function dialog_open() {
        var html = " <form id=\"regFrm\" name=\"regFrm\" action=\"adm.ajax.controller.php\" method=\"post\" autocomplete=\"off\">\n" +
            "            <input type=\"hidden\" name=\"mode\" value=\"point_setting_update\">\n" +
            "        <br>" +
            "            회원 가입 시 적립금 <input type=\"text\" value=\"<?=number_format($config['cf_register_point'])?>\" name=\"cf_register_point\" id=\"cf_register_point\" onkeyup=\"numberWithCommas(this)\" class=\"frm_input\"> 점 적립\n" +
            "        <br><br>\n" +
            "        구매 시 적립금 <input type=\"text\" onkeyup=\"numberWithCommas(this)\" maxlength=3 value=\"<?=$config['cf_point_percent']?>\" name=\"cf_point_percent\" id=\"cf_point_percent\" class=\"frm_input\" style=\"width: 50px\"> % 적립\n" +
            "\n" +
            "            </form>";
        $("#dialog-confirm").html(html).dialog("open");

    }

    function numberWithCommas(x) {
        var val = x.value;
        var id = x.id;
        final_val = val.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
        final_val = final_val.replace(/,/g,''); // ,값 공백처리
        $("#"+id).val(final_val.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
    }


</script>

<?php
include_once ('./admin.tail.php');
?>
