<?php
$sub_menu = "220200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_bunker_trader as bt left join g5_member as mb on mb.mb_id = bt.mb_id ";

$sql_search = " where 1=1 ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " (bt.{$sfl} like '%{$stx}%') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

// 신청일 일자 검색
if(!empty($_REQUEST['st_date']) && !empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' and date_format(wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
} else if(!empty($_REQUEST['st_date']) && empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' ";
} else if(empty($_REQUEST['st_date']) && empty(!$_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
}

if (!$sst) {
    $sst = "idx";
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

$sql = " select bt.*, mb.mb_name, mb.mb_bunker {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '벙커트레이더';
include_once ('./admin.head.php');

$colspan = 12;

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>

<style>
    .mb_tbl table {text-align: center;}
    input[type=date] {
        border: 1px solid !important;
    }
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    전체 <?php echo number_format($total_count) ?> 건
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "bt.mb_id"); ?>>아이디</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
    <span style="display: inline; margin-left: 15px">
    <input type="date" id="st_date" value="<?php echo $_REQUEST['st_date'] ?>" name="st_date" max="<?=date('yy-m-d')?>"> ~
    <input type="date" id="ed_date" value="<?php echo $_REQUEST['ed_date'] ?>" name="ed_date" max="<?=date('yy-m-d')?>">
</span>
    <input type="submit" class="btn_submit" value="검색">
</form>

<div class="local_desc01 local_desc">
    <p>※ <?=$listall?>을 클릭하면 검색조건이 초기화 됩니다.</p>
</div>

<form name="fwithdrawlist" id="fwithdrawlist" method="post" action="./point_list_delete.php" onsubmit="return fwithdrawlist_submit(this);">
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
                <th>No.</th>
                <th><?php echo subject_sort_link('bt.mb_id') ?>아이디</th>
                <th><?php echo subject_sort_link('bt.mb_name') ?>이름</th>
                <th>은행</th>
                <th>계좌번호</th>
                <th>예금주</th>
                <th>주민번호</th>
                <th>승인상태</th>
                <th>신청일</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_no = $total_count - ($rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $bg = 'bg'.($i%2);
                $reg_number1 = explode('-',Decrypt($row['registration_number']))[0];
                $reg_number2 = explode('-',Decrypt($row['registration_number']))[1];
                ?>
                <tr class="<?php echo $bg; ?>">
                    <td><?=$list_no?></td>
                    <td><?=$row['mb_id']?></td>
                    <td><?=$row['mb_name']?></td>
                    <td><?=$bank_list[$row['bank']]?></td>
                    <td><?=$row['account_number']?></td>
                    <td><?=$row['account_holder']?></td>
                    <td><?=$reg_number1.'-'.$reg_number2?></td>
                    <td>
                        <select style="width: 50%;" name="state" onchange="status_change(<?=$row['idx']?>, this.value, '<?=$row['mb_id']?>')">
                            <?php if($row['state'] == '승인대기') { ?>
                            <option <? if ($row['state'] == '승인대기') echo "selected"; ?> value="승인대기">승인대기</option>
                            <?php } ?>
                            <option <? if ($row['state'] == '승인완료') echo "selected"; ?> value="승인완료">승인완료</option>
                            <option <? if ($row['state'] == '승인거절') echo "selected"; ?> value="승인거절">승인거절</option>
                        </select>
                    </td>
                    <td><?=substr($row['wr_datetime'], 0, 10)?></td>
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

    <!--<div class="btn_list01 btn_list">
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
    </div>-->

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
    function fwithdrawlist_submit(f)
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

    // 신청 상태 변경
    function status_change(idx, val, mb_id) {
        $.ajax({
            url: g5_admin_url+"/ajax.bunker_state_change.php",
            type: "POST",
            data: {
                "idx": idx,
                "state": val,
                "mb_id": mb_id,
                "mode": "trader",
            },
            success: function(data) {
                if (data != 1) {
                    alert("상태 변경에 실패하였습니다.\n새로고침 후 다시 시도해주세요.");
                } else {
                    alert("상태가 변경되었습니다.");
                    location.href = location.href;
                }
            }
        });
    }
</script>

<?php
include_once ('./admin.tail.php');
?>