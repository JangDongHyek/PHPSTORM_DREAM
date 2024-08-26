<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from new_payment as pa 
                left join g5_member as mbp on mbp.mb_id = pa.userId
                left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1)
                left join new_pay_talent as pta on pta.pta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', -1)
                left join g5_member as mbs on mbs.mb_id = ta.mb_id" ;

$sql_search = " where 1=1 ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " (mbp.{$sfl} like '%{$stx}%' || mbs.{$sfl} like '%{$stx}%') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($big_ctg) {
    $sql_search .= " and ta_category1 = ".$big_ctg ;
}
if ($small_ctg) {
    $sql_search .= " and ta_category2 = ".$small_ctg ;
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
    $sql_search .= " and (mbs.mb_id != 'lets080' and mbp.mb_id != 'lets080') ";

if (!$sst) {
    $sst = "pa.wr_datetime";
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

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '재능거래현황';
include_once('./admin.head.php');

$sql = " select 
         pa.*, mbs.mb_id as sale_mb_id, mbs.mb_nick as sale_mb_nick, mbp.mb_id as pay_mb_id, mbp.mb_nick as pay_mb_nick,
         ta.ta_idx, ta.ta_title, ta.ta_category1, ta.ta_category2, pta.pta_info, pta.pta_pay, pta.pta_title, pta.pta_content, pta.pta_select1
         {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 13;
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
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>"></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="big_ctg" value="<?php echo $big_ctg ?>">
    <input type="hidden" name="small_ctg" value="<?php echo $small_ctg ?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <? /*
        <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
        <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
        <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
        <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
        <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
        <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
        */ ?>
    </select>

    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <span id="stx_span" style="display: inline"><input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input"></span>
    <input type="submit" class="btn_submit" value="검색">
</form>
<form id="fsearch2" name="fsearch2" class="local_sch01 local_sch" method="get">
    <label for="big_ctg" class="sound_only">검색대상</label>
    <select name="big_ctg" id="big_ctg" onchange="ctg_change('big');">
        <option value="">상위카테고리</option>
        <?php
        $code = common_code('ctg','code_ctg','json');
        for ($i = 0; $i < count($code); $i++){ ?>
            <option value="<?php echo $code[$i]['idx'] ?>"<?php echo get_selected($_GET['big_ctg'],$code[$i]['idx']) ?> ><?=$code[$i]['name']?></option>
        <?php } ?>
    </select>
    <select name="small_ctg" id="small_ctg" onchange="ctg_change('small');">
        <option value="">하위카테고리</option>
        <?php
        if ($big_ctg != "") {
        $code = common_code($big_ctg,'code_p_idx','json');
        for ($i = 0; $i < count($code); $i++){ ?>
            <option value="<?php echo $code[$i]['idx'] ?>"<?php echo get_selected($_GET['small_ctg'],$code[$i]['idx']) ?> ><?=$code[$i]['name']?></option>
        <?php }
        }?>
    </select>
</form>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="big_ctg" value="<?php echo $big_ctg ?>">
    <input type="hidden" name="small_ctg" value="<?php echo $small_ctg ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <!--<col width="3%">
                <col width="7%">
                <col width="10%">
                <col width="8%">
                <col width="8%">
                <col width="*">
                <col width="3%">
                <col width="10%">
                <col width="7%">
                <col width="5%">
                <col width="5%">
                <col width="5%">
                <col width="7%">-->
            </colgroup>
            <thead>
            <tr>
                <th>no</th>
                <th>상위카테고리</th>
                <th>하위카테고리</th>
                <th><?php echo subject_sort_link('mbs.mb_id') ?>판매자아이디</th>
                <th><?php echo subject_sort_link('mbs.mb_nick') ?>판매자닉네임</th>
                <th><?php echo subject_sort_link('mbp.mb_id') ?>구매자아이디</th>
                <!--<th><?php /*echo subject_sort_link('mbp.mb_nick') */?>구매자닉네임</th>-->
                <th>재능명</th>
                <th>수량</th>
<!--                <th>가격정보</th>-->
                <th>가격</th>
                <th>작업일</th>
                <th>남은시간</th>
                <th>진행상태</th>
                <th>진행상태변경일</th>
                <th>거래일시</th>
                <!--<th>관리</th>-->
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = 15;
            $list_no = $total_count - ($rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $bg = 'bg'.($i%2);
                /*$s_mod = '<a href="./talent_deal_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['ta_idx'].'">보기/수정</a>';*/

                $pta_info = '';
                if($row['pta_info'] == 1) {
                    $pta_info = 'STANDARD.';
                } else if($row['pta_info'] == 2) {
                    $pta_info = 'DELUXE.';
                } else if($row['pta_info'] == 3) {
                    $pta_info = 'PREMIUM.';
                }

                // 진행 시작일에 맞춰서 남은 시간 계산 필요 (진행시작일 + 작업일)
                $d_day = 0;
                $cancel_btn = "";
                if($row['status'] == '진행중') {
                    $status_date = substr($row['status_date'],0,10); // 진행시작일

                    $timestamp = strtotime($status_date . " +" . $row['pta_select1']*$row['GoodsCnt'] . " days"); // 진행시작일 + 작업일
                    $end_date = date('Y-m-d', $timestamp); // 진행종료일(예정)

                    $d_day = ( strtotime($end_date) - strtotime(date('Y-m-d')) ) / 86400; // 남은 일자 계산
                }elseif ($row['status'] == '취소' && $row['comp_chk'] == NULL){
                    $cancel_btn = '<br><button type="button" onclick="re_pay('.$row['pa_idx'].','.$row['Amt'].','."'".$row['seller_id']."'".')" style="border: 1px solid black; background: #7a8db8;color: white; ">환불처리</button>';
                }
                /*else if($row['status'] == '완료') {
                    $expected_date = date('Y-m-d', strtotime($status_date . " +" . $row['pta_select1']*$row['GoodsCnt'] . " days")); // 진행종료일(예정)
                    if(substr($row['end_date'],0,10) <= $expected_date) { // 예정일 전에 작업이 끝났거나 예정일에 작업이 끝났을 경우
                        $d_day = ( strtotime($expected_date) - strtotime(substr($row['end_date'],0,10))) / 86400; // 남은 일자 계산
                    } else { // 예정일이 지나서 작업이 끝났을 경우
                        $d_day = ( strtotime(substr($row['end_date'],0,10)) - strtotime($expected_date)) / 86400; // 남은 일자 계산
                    }
                }*/

                $pta_idx = explode("-",$row["Moid"])[2];

            ?>
                <tr class="<?php echo $bg; ?>">
                    <td><?=$list_no?></td>
                    <td><?php $code = common_code($row['ta_category1'], 'code_idx','json'); echo $code[0]['name']; ?></td>
                    <td><?php $code = common_code($row['ta_category2'], 'code_idx','json'); echo $code[0]['name']; ?></td>
                    <td><?=$row['sale_mb_id']?></td>
                    <td><?=$row['sale_mb_nick']?></td>
                    <td><?=$row['pay_mb_id']?></td>
                    <!--<td><?/*=$row['pay_mb_nick']*/?></td>-->
                    <td><?=$row['ta_title']?></td>
                    <td><?=number_format($row['GoodsCnt'])?></td>
<!--                    <td>--><?//=$pta_info.' '.$row['pta_title']?><!--</td>-->
                    <td><?=number_format($row['Amt'])?>원<?=($pta_idx == 0) ? "(직접입력)" : ""?></td>
                    <td><?=$row['pta_select1']*$row['GoodsCnt']?>일</td> <!-- 작업일은 작업일 * 수량-->
                    <td><?php echo $row['status'] == '진행중' ? $d_day.'일' : '' ?></td>
                    <td><?=$row['status'].$cancel_btn?></td>
                    <td><?=substr($row['status_date'],0,10)?></td>
                    <td><?=substr($row['wr_datetime'],0,16)?></td>
                    <!--<td><?/*=$s_mod*/?></td>-->
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
    // 카테고리 검색
    function ctg_change(type) {
        var big_ctg = $("#big_ctg").val();
        if (type == 'small'){
            var small_ctg = $("#small_ctg").val();
        }else{
            var small_ctg = "";
        }
        var params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (stx != "" || big_ctg != "" || small_ctg != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx+ "&big_ctg=" + big_ctg + "&small_ctg=" + small_ctg;
        }
        if(big_ctg != "" && small_ctg == "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx+ "&big_ctg=" + big_ctg;
        }

        location.href = g5_admin_url + "/talent_deal_list.php" + params;
    }

    //취소 시 환불처리
    function re_pay(pa_idx,amt,seller_id) {

        $.ajax({
            url: g5_admin_url+"/adm.ajax.controller.php",
            type: "POST",
            data: {
                "pa_idx": pa_idx,
                "Amt": amt,
                "seller_id" : seller_id,
                "mode": "re_pay"
            },
            success: function(data) {
                if (data != 1) {
                    alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                }else{
                    alert("환불처리가 완료되었습니다..");
                    location.href = location.href
                }
            }
        });

    }
</script>

<?php
include_once ('./admin.tail.php');
?>