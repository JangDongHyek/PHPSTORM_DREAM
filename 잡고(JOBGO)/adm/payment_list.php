<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$month1 = $_REQUEST['month1'];
$month2 = $_REQUEST['month2'];


$sql_common = " from new_request_pay as rp  ";


$sql_search = " where 1=1 ";


if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_work' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($month1 != "" && $month2 != ""){

    $sql_search .= "AND date_format(rp.wr_datetime, '%Y-%m-%d') >= '{$month1}'
        AND date_format(rp.wr_datetime, '%Y-%m-%d') <= '{$month2}'";
}

if (!$sst) {
    $sst = "rp.wr_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
//$rows = 1;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a style = "font-weight: bold" href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '출금요청현황';
include_once('./admin.head.php');

$sql = " select rp.* {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$sql = "select sum(rp_amt) sum_rp_amt from new_request_pay rp {$sql_search} ";

$price_result = sql_fetch($sql);


$colspan = 16;
?>

<!--<link href="--><?php //echo G5_THEME_CSS_URL; ?><!--/bootstrap.min.css" rel="stylesheet" type="text/css"><!--부트스트랩-->-->


<style>
    .mb_tbl table {text-align: center;}
    .delay_reason {margin-top: 5px}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총게시글 <?php echo number_format($total_count) ?> 개 &nbsp&nbsp|&nbsp&nbsp
    총 요청금액 <?php echo number_format($price_result['sum_rp_amt']) ?> 원 &nbsp&nbsp|&nbsp&nbsp
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>

    <select name="sfl" id="sfl" onchange="sfl_change();">
        <option value="rp.mb_id"<?php echo get_selected($_GET['sfl'], "rp.mb_id"); ?>>전문가 아이디</option>
        <option value="rp_proc"<?php echo get_selected($_GET['sfl'], "rp_proc"); ?>>상태</option>
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
    <span id="stx_span" style="display: inline"><input type="submit" class="btn_submit" value="검색"></span>
    <span style="display: inline; margin-left: 15px">
        <input onchange="date_change()" type="date" id="stx_month1" value="<?php echo $month1 ?>" name="month1" max="<?=date('yy-m-d')?>">
        <input onchange="date_change()" type="date" id="stx_month2" value="<?php echo $month2 ?>" name="month2" max="<?=date('yy-m-d')?>">
        <input type="button" class="btn_submit" style="background: grey" value="오늘" onclick="click_day()">
        <input type="button" class="btn_submit" style="background: grey" value="한달" onclick="click_month()">
    </span>
</form>

<div class="local_desc01 local_desc">
    <p>※ <?=$listall?>을 클릭하면 검색조건이 초기화 됩니다.</p>
    <p>※ 현재 보유금액 : 해당 사용자의 모든 출금금액을 차감하고 사용자가 출금요청할 수 있는 금액</p>
</div>

<form name="fmemberlist" id="fmemberlist" action="./payment_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
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
<!--                <th scope="col">-->
<!--                    <label for="chkall" class="sound_only">회원 전체</label>-->
<!--                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">-->
<!--                </th>-->
                <th>no</th>
                <th>상태</th>
                <th>전문가 아이디</th>
                <th>(은행명)계좌번호/예금주</th>
<!--                <th>출금 전 금액</th>-->
                <th>현재 보유금액</th>
                <th>요청금액</th>
                <!--                <th>출금 후 금액</th>-->
                <th>지급보류일</th>
                <th>지급완료일</th>
                <th>출금요청일</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $rows;
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $idx_arr = explode('-',$row['Moid']);
                $idx = $idx_arr[1];

                $s_mod = '<br><br><a href="./delay_reason_update.php?wm=u&rp_idx='.$row['rp_idx'].'" class="delay_reason" target="delay_reason">보류사유 보기</a>';

                $bg = 'bg'.($i%2);
                $mb = get_member($row['mb_id']);
//                $after_pay = $row['rp_now_amt'] - $row['rp_amt']

                ?>
                <tr class="<?php echo $bg; ?>">
<!--                    <td>-->
<!--                        <input type="hidden" name="gp_idx[--><?php //echo $i ?><!--]" value="--><?php //echo $row['gp_idx'] ?><!--" id="gp_idx_--><?php //echo $i ?><!--">-->
<!--                        <input type="checkbox" name="chk[]" value="--><?php //echo $i ?><!--" id="chk_--><?php //echo $i ?><!--">-->
<!--                    </td>-->
                    <td><?=$list_no?></td>
                    <td width="5%">
                        <select name="gp_type" onchange="proc_change(<?=$row['rp_idx']?>,this.value)">
                            <option <? if ($row['rp_proc'] == '1') echo "selected"; ?> value="1">대기</option>
                            <option <? if ($row['rp_proc'] == '2') echo "selected"; ?> value="2">완료</option>
                            <option <? if ($row['rp_proc'] == '3') echo "selected"; ?> value="3">보류</option>
                        </select>
                        <?php // 보류사유 보기
                        if ($row['rp_proc'] == '3'){
                           echo $s_mod;
                         } ?>
                    </td>
                    <!--                    <td>--><?//=$a_tag?><!--</td>-->
                    <td><a href="?sfl=rp.mb_id&amp;stx=<?php echo $mb['mb_id'] ?>"><?=$mb['mb_id']?></a></td>
                    <td><?= $mb['mb_1'] != "" ? '('.$bank_list[$mb['mb_1']].')'.$mb['mb_3'].'/'.$mb['mb_2']: "계좌 등록안함"; ?></td>
<!--                    <td>--><?//=number_format($row['rp_now_amt'])?><!--</td>-->
                    <td><?=number_format($mb['mb_6'])?></td>

                    <td><?=number_format($row['rp_amt'])?></td>
<!--                    <td>--><?//= $row['rp_minus_amt'] != null ? number_format($row['rp_minus_amt']): "";?><!--</td>-->
                    <td><?= $row['rp_proc'] == 3 ? substr($row['delay_datetime'],2,8) : "";?></td>
                    <td><?= $row['rp_proc'] == 2 ? substr($row['complete_datetime'],2,8) : "";?></td>
                    <td><?=substr($row['wr_datetime'],2,8)?></td>
<!--                    <td>--><?//=$s_mod?><!--</td>-->
                </tr>

                <? /*
    <tr class="<?php echo $bg; ?>">

        <td headers="mb_list_chk" class="td_chk" rowspan="2">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td headers="mb_list_id" rowspan="2" class="td_name sv_use"><?php echo $mb_id ?></td>
        <td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
        <td headers="mb_list_cert" colspan="6" class="td_mbcert">
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="ipin" id="mb_certify_ipin_<?php echo $i; ?>" <?php echo $row['mb_certify']=='ipin'?'checked':''; ?>>
            <label for="mb_certify_ipin_<?php echo $i; ?>">아이핀</label>
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="hp" id="mb_certify_hp_<?php echo $i; ?>" <?php echo $row['mb_certify']=='hp'?'checked':''; ?>>
            <label for="mb_certify_hp_<?php echo $i; ?>">휴대폰</label>
        </td>
        <td headers="mb_list_mobile" class="td_tel"><?php echo get_text($row['mb_hp']); ?></td>
        <td headers="mb_list_auth" class="td_mbstat">
            <?php
            if ($leave_msg || $intercept_msg) echo $leave_msg.' '.$intercept_msg;
            else echo "정상";
            ?>
            <?php echo get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level']) ?>
        </td>
        <td headers="mb_list_lastcall" class="td_date"><?php echo substr($row['mb_today_login'],2,8); ?></td>
        <td headers="mb_list_grp" rowspan="2" class="td_numsmall"><?php echo $group ?></td>
        <td headers="mb_list_mng" rowspan="2" class="td_mngsmall"><?php echo $s_mod ?> <?php echo $s_grp ?></td>
    </tr>
    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_nick" class="td_name sv_use"><div><?php echo $mb_nick ?></div></td>
        <td headers="mb_list_mailc" class="td_chk"><?php echo preg_match('/[1-9]/', $row['mb_email_certify'])?'<span class="txt_true">Yes</span>':'<span class="txt_false">No</span>'; ?></td>
        <td headers="mb_list_open" class="td_chk">
            <label for="mb_open_<?php echo $i; ?>" class="sound_only">정보공개</label>
            <input type="checkbox" name="mb_open[<?php echo $i; ?>]" <?php echo $row['mb_open']?'checked':''; ?> value="1" id="mb_open_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_mailr" class="td_chk">
            <label for="mb_mailling_<?php echo $i; ?>" class="sound_only">메일수신</label>
            <input type="checkbox" name="mb_mailling[<?php echo $i; ?>]" <?php echo $row['mb_mailling']?'checked':''; ?> value="1" id="mb_mailling_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_sms" class="td_chk">
            <label for="mb_sms_<?php echo $i; ?>" class="sound_only">SMS수신</label>
            <input type="checkbox" name="mb_sms[<?php echo $i; ?>]" <?php echo $row['mb_sms']?'checked':''; ?> value="1" id="mb_sms_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_adultc" class="td_chk">
            <label for="mb_adult_<?php echo $i; ?>" class="sound_only">성인인증</label>
            <input type="checkbox" name="mb_adult[<?php echo $i; ?>]" <?php echo $row['mb_adult']?'checked':''; ?> value="1" id="mb_adult_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_deny" class="td_chk">
            <?php if(empty($row['mb_leave_date'])){ ?>
            <input type="checkbox" name="mb_intercept_date[<?php echo $i; ?>]" <?php echo $row['mb_intercept_date']?'checked':''; ?> value="<?php echo $intercept_date ?>" id="mb_intercept_date_<?php echo $i ?>" title="<?php echo $intercept_title ?>">
            <label for="mb_intercept_date_<?php echo $i; ?>" class="sound_only">접근차단</label>
            <?php } ?>
        </td>
        <td headers="mb_list_tel" class="td_tel"><?php echo get_text($row['mb_tel']); ?></td>
        <td headers="mb_list_point" class="td_num"><a href="point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>
        <td headers="mb_list_join" class="td_date"><?php echo substr($row['mb_datetime'],2,8); ?></td>
    </tr>
	*/ ?>

                <?php
                $list_no--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>
<!--    <div style="float: left!important;" class="btn_add01 btn_add">-->
<!--        <button type="submit">지급처리</button>-->
<!--    </div>-->

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>


<script>

    $(document).ready(function () {
        sfl_change('ready');

        $(".delay_reason").click(function(){
            window.open(this.href, "delay_reason", "left=100,top=100,width=400,height=450");
            return false;
        });

    })


    function click_month() {
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


    }
    function proc_change(idx,val) {

        //보류일 경우 모달 띄워서 사유 입력
        if (val == 3 ){
            window.open(g5_admin_url+'/delay_reason_update.php?rp_idx='+idx, 'delay_reason',"left=100,top=100,width=400,height=450");
            return false;
        }

        proc_ajax(idx,val)

    }

    function proc_ajax(idx,val) {

        $.ajax({
            url: g5_admin_url+"/adm.ajax.controller.php",
            type: "POST",
            data: {
                "idx": idx,
                "proc" : val,
                "mode": "proc_change"
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
        if (sfl.val() == 'rp_proc'){
            $('#stx_span').html('<select name="stx" id="stx" class=" frm_input" value="<?php echo $stx ?>">' +
                '<option value = "1">대기</option>' +
                '<option value = "2">완료</option>' +
                '<option value = "3">보류</option>' +
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
