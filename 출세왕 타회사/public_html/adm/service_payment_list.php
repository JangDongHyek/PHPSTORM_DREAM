<?php
$sub_menu = "260000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['car_wash_table']} cw left join g5_member mem on cw.mb_id = mem.mb_id ";

$sql_search = " where 1=1 ";
//$sql_search = " where 1=1 and car_date_type = 2 ";


if ($_REQUEST["cw_step"] != ""){
    $sql_search .= "and cw_step = '{$_REQUEST["cw_step"]}'";
}

//정기 or 한달만이거나  그게아닌 단기일때 결제했냐?
$sql_search .= "and ( ( car_date_type = '1' or car_date_type = '2' ) or is_payment = 'Y')";

if ($_REQUEST["start_date"] != "" ){
    if ($_REQUEST["end_date"] == ""){
        $_REQUEST["end_date"] = G5_TIME_YMD;
    }
    $sql_search .= "and date_format(cw.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST["start_date"] }'
                    AND date_format(cw.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST["end_date"]}'";
    // 23.04.21 기존꺼 기간정하고 페이지넘기면 있던 오류 수정해줌 wc
    $qstr .= '&amp;start_date=' . urlencode($_REQUEST["start_date"]);
    $qstr .= '&amp;end_date=' . urlencode($_REQUEST["end_date"]);
}

if ($stx != "") {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'cw_step' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "wr_datetime";
    $sod = "desc";
}

//진행사항 필터
if ($_REQUEST["cw_step"] != ""){
    $sql_search .= "and cw_step = '{$_REQUEST["cw_step"]}'";
    if($cw_step)
        $qstr .= '&amp;cw_step=' . urlencode($cw_step);
}

//상품명
if ($_REQUEST["car_date_type"] != ""){
    $sql_search .= "and car_date_type = '{$_REQUEST["car_date_type"]}'";


    if ($car_date_type)
        $qstr .= '&amp;car_date_type=' . urlencode($car_date_type);
}

//차 사이즈 필터
if ($_REQUEST["car_size"] != ""){
    $sql_search .= "and car_size = '{$_REQUEST["car_size"]}'";
    if ($car_size)
        $qstr .= '&amp;car_size=' . urlencode($car_size);
}

//끝



$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = ' <a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall"><button style="border: 1px solid #ccc">전체목록</button></a> ※마지막 결제일로부터 한달 후 결제하기 버튼이 활성화됩니다.';

$g5['title'] = '결제 관리';
include_once('./admin.head.php');

$sql = " select mem.mb_point,cw.* {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";


$result = sql_query($sql);


$colspan = 16;

$sql = "select mb_id,mb_name,mb_hp from {$g5['member_table']} where mb_level = 3 and mb_1 = 'Y' ";
$mem_result = sql_query($sql);

$sst = ($sst == 'mem.mb_name') ? "mb_name" : $sst;
?>


<style>
    .mb_tbl table {text-align: center;}

</style>

<!-- 모달 영역 -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button style="float: right" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">매니저등록</h4>
            </div>
            <div class="modal-body">
                <?php for ($i =0;$mem_row =sql_fetch_array($mem_result);$i++){?>
                    <div style=" margin-bottom: 8px">
                        <input name="modal_mb_id" type="radio" value="<?= $mem_row["mb_id"] ?>"><span style="margin-left: 10px;"><?= $mem_row["mb_name"] ?> / <?= hyphen_hp_number($mem_row["mb_hp"]) ?></span>
                    </div>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="manager_sel()">지정</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--3333
-->


<div class="local_ov01 local_ov">
    <?php echo $listall ?>
</div>


<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" onchange="sfl_change();">
        <option value="cw.mb_id"<?php echo get_selected($_GET['sfl'], "cw.mb_id"); ?>>아이디</option>
        <option value="cw.mb_name"<?php echo get_selected($_GET['sfl'], "cw.mb_name"); ?>>성함</option>

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
    접수일:
    <input type="date" name="start_date" id="start_date" max="9999-12-31" value="<?=$_REQUEST["start_date"]?>">~
    <input type="date" name="end_date" id="end_date" max="9999-12-31" value="<?=$_REQUEST["end_date"]?>">
    <input type="button" class="btn_submit" style="background: grey" value="오늘" onclick="click_day()">
    <input type="button" class="btn_submit" style="background: grey" value="한달" onclick="click_month()">
    <input type="submit" class="btn_submit" value="검색">

    <input type ="hidden" id="sst" name="sst" value="">
    <input type ="hidden" id="sod" name="sod" value="">
    <input type ="hidden" id="cw_step" name="cw_step" value="<?= $_REQUEST['cw_step']?>" >
    <input type ="hidden" id="car_date_type" name="car_date_type" value="<?= $_REQUEST['car_date_type']?>" >
    <input type ="hidden" id="car_size" name="car_size" value="<?= $_REQUEST['car_size']?>" >
</form>

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
                <th scope="col">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th>no</th>
                <?php /*<th>진행상황
                    <select id="cw_step_select" onchange="cw_step_change(this.value)">
                        <option value="">전체</option>
                        <?php for ($i = 0; $i < count($step_list); $i++){ ?>
                            <option value="<?=$i?>"><?= $step_list[$i] ?></option>
                        <?php } ?>
                    </select>
                </th>*/?>
                <th>상품명
                    <select name="car_date_type" id="car_date_type" onchange="sst_change2(this.value,'car_date_type')">
                        <option value="" <?php if($_GET['car_date_type']==0){ echo 'selected'; } ?>>전체</option>
                        <?php for($i = 1; $i <= count($cdt_list); $i++){
                            if ($_GET['car_date_type'] == $i) {
                                echo "<option value=\"$i\" onclick=\"sst_change2($i,'car_date_type')\" selected>$cdt_list[$i]</option>";
                            }else{
                                echo "<option value=\"$i\" onclick=\"sst_change2($i,'car_date_type')\" >$cdt_list[$i]</option>";
                            }

                        } ?>

                    </select>
                </th>
                <th>차 사이즈</th>
                <th>차량정보</th>
                <th>세차일정</th>
                <th>접수일</th>
                <th>아이디</th>
                <th>성함
                    <select id="cw_mb_name" onchange="sst_change(this.value,'cw.mb_name')">
                        <option value="desc">내림차순</option>
                        <option value="asc">오름차순</option>
                    </select>
                </th>
                <th>결제카드</th>
                <th>마지막 결제일</th>
                <th>현재포인트</th>
                <!-- 23.04.21 쿠폰추가 -->
                <th>누적사용포인트</th>
                <!-- 23.04.14 총누적금액 -> 누적결제대금  -->
                <th>누적결제대금</th>

                <!-- 23.04.14 예상금액 -> 누적사용금액 -->
                <th>누적사용금액</th>
                <th>차액</th>
                <th>관리</th>
                <th>결제내역 보기</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $config['cf_page_rows'];
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $bg = 'bg'.($i%2);
                $customer = get_member($row['mb_id']);

                //카드등록 된 moid
                $sql = "select ap.moid, max(ah.nextDate) as nextDate,finalDate from g5_autoPay ap
                        left join new_autopay_history ah on ap.billKey = ah.billKey where ap.BillKey = '{$customer['billKey']}' group by ap.moid,finalDate LIMIT 1 ";
                $card = sql_fetch($sql);

                //총누적결제금액
                $sql = "select sum(amt) sum from new_autopay_history where BillKey = '{$customer['billKey']}' ";
                $total_price = sql_fetch($sql)["sum"];
                //예상금액
                $sql = "select count(*) cnt from new_complete_history where cw_idx = '{$row["cw_idx"]}' and update_yn = 'N' order by ch_idx desc ";
                $complete_cnt = sql_fetch($sql)["cnt"];


                //내부세차금액
                $add_price = 0;
                if ($row["car_in_yn"] == 'Y'){
                    //$add_price = 10000;
                    $add_price = 0;
                }
                $s_mod = "";
                    // 23.04.21 실내세차 있을떄만 + 적어줌
                    //if($row["car_in_yn"] == 'Y'){
                    // 23.05.19 실내세차쪽 없애기
                    if($row['car_date_type'] == '2'){
                          $s_mod = '<input class="frm_input" type = "number" id="amt_' . $row["cw_idx"] . '" > 
                            <a style ="border:1px solid black; padding:2px" href="javascript:payment_click(\'' . $row["cw_idx"] . '\',\'' . $card["moid"] . '\',\'' . $customer['billKey'] . '\',\'' . $row['mb_id'] . '\',\'' . $customer['mb_hp'] . '\',\'' . $row['mb_name'] . '\',' . $add_price . ')">결제하기</a>';
                    }

                $s_mod2 = '<a href="'.G5_ADMIN_URL.'/service_payment_form.php?idx='.$row["cw_idx"].'">보기</a>';
                ?>
                <tr class="<?php echo $bg; ?>">
                    <td>
                        <input type="checkbox" name="chk[]" value="<?php echo $row['cw_idx'] ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td><?=$list_no?></td>
                    <td style="cursor: pointer" onclick="sst_change2(<?= $row["car_date_type"]?>,'car_date_type')"><?= $cdt_list[$row['car_date_type']]?></td>
                    <td style="cursor: pointer" onclick="sst_change2(<?= $row["car_size"]?>,'car_size')"><?= $cs_list[$row["car_size"]] ?></td>
                    <td><?= $row['car_no'] ?> / <?= $row['car_type'] ?> / <?= $row['car_color'] ?></td>
                    <td><?php

                        successking_date($row['car_w_date'],$row['car_w_date2']);
                         ?></td>
                    <td><?=substr($row['wr_datetime'],2,8)?></td>

                    <td><a href="./member_form.php?<?=$qstr?>&amp;w=u&amp;mb_id=<?=$row['mb_id']?>"><?=$row['mb_id']?></a></td>
                    <td><?=$row['mb_name']?></td>
                    <td><?=$card_list[$customer["cardCode"]]?></td>
                    <td><?=$row['car_date_type'] == '2' ? substr($card["finalDate"],2,8) : substr($row['wr_datetime'],2,8).$row['is_payment']?> </td>
                    <td><?=$row["mb_point"] ?></td>
                    <td><?=number_format($row["cp_price"]) ?> <a style ="border:1px solid black; padding:2px" href="javascript:point_click(<?=$row['cw_idx']?>,'<?=$row['mb_id']?>');">POINT+</a></td>
                    <td><?=$row['car_date_type'] == '2' ? number_format($total_price) : number_format($row['final_pay'])?></td>

                    <?if($row['car_date_type'] == '2') {?>
                    <td><?=number_format($complete_cnt*12375)?>(<?=$complete_cnt?>)</td>
                    <td><?=number_format(($complete_cnt*12375) - $total_price- $row['cp_price'])?></td>
                    <?}else {?>
                    <td>0(<?=$complete_cnt?>)</td>
                    <td><?=number_format($total_price- $row['cp_price'])?></td>
                    <?}?>
                    <td><?=$s_mod?></td>
                    <td><?=$s_mod2?></td>
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
<Div id="pop_point" style="display:none;position:absolute;padding:20px 20px 20px 20px;border:solid 1px black; background-color:#ffffff;left:40%; top:100px; width:500px; height:100px; z-index:1;">
    <input type="hidden" id="car_idx" name="car_idx"><br>
    포인트 대상 : <input type="text" id="mem_id" style="border: solid 0px;" readonly><br><br>
    포인트 입력 : <input type="text" id="pnt" name="pnt">
    <br><br>
    <input type="button" value=" 입 력 " onclick="javascript:fn_point();">&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" value=" 닫 기 " onclick="javascript:$('#pop_point').hide();">
</div>
<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&nr=".$_REQUEST['nr'].'&amp;page='); ?>

<script>
    $(document).ready(function () {
        sfl_change('ready');

        $("#cw_step_select").val('<?=$_REQUEST["cw_step"]?>').prop("selected", true);
        $("#<?=$sst?>" ).val('<?=$sod?>').prop("selected", true);

    })


    //검색 조건이 작업일 경우 select 박스로 변경
    function sfl_change(type) {

        var sfl = $('#sfl');

        if (sfl.val() == 'cw_step' || sfl.val() == 'car_date_type'){
            option_list(sfl.val());
        }else{
            if (type != "ready") {
                $('#stx_span').html('<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input">');
                $("#stx").val("");
            }
        }

    }


    function sst_change2(val,sst){
        $("#"+ sst).val(val);
        $("#fsearch").submit();
    }


    function sst_change(val,sst){
        $("#sst").val(sst);
        $("#sod").val(val);

        $("#fsearch").submit();
    }

    function option_list(type) {

        $.ajax({
            url: g5_admin_url+"/adm.controller.php",
            data: {"type": type, "mode":"list_option","is_no_company":"Y"},
            dataType: "html",
            success: function(data) {
                console.log(data);
                $('#stx_span').html(data);
                $('#cw_step_span').html(data);

                //검색 후 셀렉트값 넣어줌
                $("#stx").val($('#fmemberlist [name = "stx"]').val()).prop("selected", true);

            }
        });
    }

    function swal_func(text) {

        swal({
            title: "경고창",
            text: text,
            icon: "error",
            button: "확인",
        });

    }


    function click_month() {
        $('#start_date').val('<?=date("Y-m-d", strtotime("-1 months"))?>');
        $('#end_date').val('<?=date("Y-m-d")?>');

        date_change();
    }

    function click_day() {
        $('#start_date').val('<?=date("Y-m-d")?>');
        $('#end_date').val('<?=date("Y-m-d")?>');

        date_change();
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

        location.href = g5_admin_url + "/service_payment_list.php"+ params;

    }

    function fn_point()
    {
        if($("#pnt").val()) {

            if (confirm("포인트를 입력 하시겠습니까?")) {
                $.ajax({
                    type: "POST",
                    url: '/bbs/ajax.car_point.php',
                    data: {idx: $("#car_idx").val(), "mem_id": $("#mem_id").val(), "pnt": $("#pnt").val()},
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        alert("포인트 처리가 완료 되었습니다.");
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                        alert("통신에러");
                    }
                });
            }
        }
    }
    function point_click(idx,mb_id) {
        $("#pop_point").show();
        $("#mem_id").val(mb_id);
        $('#car_idx').val(idx);
    }

    function payment_click(idx,card_moid, billKey,mb_id,mb_hp,mb_name,add_price) {
        var url = "https://api.innopay.co.kr/api/payAutoCardBill";
        var amt = ($("#amt_"+idx).val()*1) + add_price ,
            moid = "<?=date("YmdHis")?>_<?=rand(10,99)?>";
        // test mid : testpay01m
        const data2 = JSON.stringify({
            "mid":"pgcnftp02m",
            "moid":moid,
            "shop_order_id":card_moid,
            "goodsName":"정기결제",
            "buyerName":mb_name,
            "amt":amt,
            "billKey":billKey,
            "buyerHp":mb_hp,
            "userId":mb_id,
            "zoneCode":'',
            "address":'',
            "recipientName":'',
            "recipientPhoneNo":''});

        if (confirm("결제하시겠습니까?")) {
            $.ajax({
                type: "POST",
                url: url,
                async: true,
                data: data2,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                cache: false,
                success: function (data) {
                    if(data.resultCode!="0000"){
                        alert(data.resultMsg);
                        return false;
                    }else{
                        data["shop_order_id"] = card_moid;
                        console.log(data);

                        //DB저장
                        $.ajax({
                            type : "POST",
                            url : "./auto_pay_payment.php",
                            async : true,
                            data : data,
                            dataType : "html",
                            cache : false,
                            success : function(data){
                                console.log(data.buyerName);
                                alert( numberComma(amt)+"원 결제완료되었습니다.");
                                location.reload();
                            },
                        });
                    }

                },
                error: function (data) {
                    console.log(data);
                    alert("통신에러");
                }
            });
        }
    }



    function numberComma(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

</script>

<?php
include_once ('./admin.tail.php');
?>
