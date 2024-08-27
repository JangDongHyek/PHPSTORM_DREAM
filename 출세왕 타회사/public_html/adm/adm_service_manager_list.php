<?php
$sub_menu = "260100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['car_wash_table']} cw
                left join g5_member mem on cw.ma_id = mem.mb_id";


$sql_search = " where 1=1 ";

if ($_REQUEST["car_date_type_name"] != ""){
    $sql_search .= "and mem.mb_name like '%". $_REQUEST["car_date_type_name"]."%'" ;
}

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

//상품명
if ($_REQUEST["ma_step"] != ""){

    $flipped = array_flip($step_list);

    $flipped_result = $flipped[$_REQUEST["ma_step"]];

    $sql_search .= "and ma_step = '{$flipped_result}'";
    if ($flipped_result)
        $qstr .= '&amp;ma_step=' . urlencode($flipped_result);
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

$listall = ' <a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall"><button style="border: 1px solid #ccc">전체목록</button></a>';

$g5['title'] = '매니저 정산관리';
include_once('./admin.head.php');

$sql = " select cw.* {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;

//대기, 배차, 완료, 취소 count
$sql = "SELECT (SELECT COUNT(cw_idx) From {$g5['car_wash_table']} WHERE ma_step = 0) wait,
(SELECT COUNT(cw_idx) From  {$g5['car_wash_table']} WHERE ma_step = 1) assign,
(SELECT COUNT(cw_idx) From  {$g5['car_wash_table']} WHERE ma_step = 2) complete,
(SELECT COUNT(cw_idx) From  {$g5['car_wash_table']} WHERE ma_step = 3) cancel
from  {$g5['car_wash_table']} LIMIT 1";
$assign_cnt = sql_fetch($sql);

$sql = "select mb_id,mb_name,mb_hp from {$g5['member_table']} where mb_level = 3 and mb_1 = 'Y' ";
$mem_result = sql_query($sql);

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





<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    대기 : <?= $assign_cnt['wait']?>건, 진행 : <?= $assign_cnt['assign']?>건, 완료 : <?= $assign_cnt['complete']?>건, 취소 : <?= $assign_cnt['cancel']?>건
    <?php if ($sfl == "mem.mb_name" && $stx != ""){ ?>
        <span style="border-left: 1px solid #ccc; margin-left: 5px; padding-left: 8px">
         <?= "<span style='font-weight: bold'>".$stx ." 매니저 </span> 작업횟수 : ". $total_count."회 * " ?>
        </span>
        <input type="phone" class="frm_input" id="manager_price" onkeyup="numberWithCommas(this)">
        =
        <input type="phone" class="frm_input" readonly id="total_price" placeholder="합계" style="padding-left: 8px">
    <?php } ?>
</div>


<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" onchange="sfl_change();">
        <option value="cw.ma_id"<?php echo get_selected($_GET['sfl'], "cw.ma_id"); ?>>매니저아이디</option>
        <option value="mem.mb_name"<?php echo get_selected($_GET['sfl'], "mem.mb_name"); ?>>매니저성함</option>
        <option value="cw.mb_id"<?php echo get_selected($_GET['sfl'], "cw.mb_id"); ?>>아이디</option>
        <option value="cw.mb_name"<?php echo get_selected($_GET['sfl'], "cw.mb_name"); ?>>고객성함</option>

        <!--<option value="cw_step"<?php //echo get_selected($_GET['sfl'], "cw_step"); ?>>진행상황</option>-->
        <option value="car_date_type"<?php echo get_selected($_GET['sfl'], "car_date_type"); ?>>상품명</option>
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

    <input type="date" name="start_date" id="start_date" max="9999-12-31" value="<?=$_REQUEST["start_date"]?>">~
    <input type="date" name="end_date" id="end_date" max="9999-12-31" value="<?=$_REQUEST["end_date"]?>">
    <input type="button" class="btn_submit" style="background: grey" value="오늘" onclick="click_day()">
    <input type="button" class="btn_submit" style="background: grey" value="한달" onclick="click_month()">
    <input type="submit" class="btn_submit" value="검색">

    <input type ="hidden" id="sst" name="sst" value="">
    <input type ="hidden" id="sod" name="sod" value="">

    <input type ="hidden" id="cw_step" name="cw_step" value="<?= $_REQUEST['cw_step']?>" >
    <input type ="hidden" id="ma_step" name="ma_step" value="<?= $_REQUEST['ma_step']?>" >
    <input type ="hidden" id="car_date_type" name="car_date_type" value="<?= $_REQUEST['car_date_type']?>" >
    <input type ="hidden" id="car_size" name="car_size" value="<?= $_REQUEST['car_size']?>" >


</form>


<form name="fmemberlist" id="fmemberlist" action="./adm_service_manager_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
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
                <th>진행상황
                    <select id="cw_step_select" onchange="cw_step_change(this.value)">
                        <option value="">전체</option>
                        <?php for ($i = 0; $i < count($step_list); $i++){ ?>
                            <option value="<?=$i?>"><?= $step_list[$i] ?></option>
                        <?php } ?>
                    </select>
                </th>

                <th>정산상황
                    <select id="ma_step_select" onchange="sst_change2(this.value,'ma_step')">
                        <option value="" <?=$_GET['ma_step'] == ''? 'selected' : ''?>>전체</option>
                        <option value="대기" onclick="sst_change2('대기','ma_step')" <?=$_GET['ma_step'] == '대기' ? 'selected' : ''?>><?=$step_list[0]?></option>
                        <option value="진행" onclick="sst_change2('진행','ma_step')" <?=$_GET['ma_step'] == '진행' ? 'selected' : ''?>><?=$step_list[1]?></option>
                        <option value="완료" onclick="sst_change2('완료','ma_step')" <?=$_GET['ma_step'] == '완료' ? 'selected' : ''?>><?=$step_list[2]?></option>
                        <option value="취소" onclick="sst_change2('취소','ma_step')" <?=$_GET['ma_step'] == '취소' ? 'selected' : ''?>><?=$step_list[3]?></option>

                    </select>
                </th>
                <th  style="cursor: pointer">상품명

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
                <th onclick="sst_change2('','car_size')" style="cursor: pointer">차 사이즈</th>
                <th>차량정보</th>
                <th>아이디</th>
                <th>고객성함
                    <select id="cw_mb_name" onchange="sst_change(this.value,'cw.mb_name')">
                        <option value="desc">내림차순</option>
                        <option value="asc">오름차순</option>
                    </select>
                </th>
                <th>매니저아이디
                    <select id="ma_id" onchange="sst_change(this.value,'ma_id')">
                        <option value="desc">내림차순</option>
                        <option value="asc">오름차순</option>
                    </select>
                </th>
                <th>매니저성함
                    <select id="mem_mb_name" onchange="sst_change(this.value,'mem.mb_name')">
                        <option value="desc">내림차순</option>
                        <option value="asc">오름차순</option>
                    </select>
                </th>
                <th>완료회차</th>
                <th>예상금액</th>
                <th>정산금액</th>
                <th>정산날짜</th>
                <th>결제여부</th>
                <!--
                <th>쿠폰사용</th>
                -->
                <th>접수일
                    <select id="wr_datetime" onchange="sst_change(this.value,'wr_datetime')">
                        <option value="desc">내림차순</option>
                        <option value="asc">오름차순</option>
                    </select>
                </th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $config['cf_page_rows'];
            $list_no = $total_count - ($list_rows * ($page - 1));
            $ma_payment_all = 0;
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $s_mod = '<a href="./adm_service_form.php?'.$qstr.'&amp;w=u&amp;re_url=adm_service_manager_list&amp;idx='.$row['cw_idx'].'">보기/수정</a>';
                $bg = 'bg'.($i%2);
                //mb_work 콤마단위로 끊어서 배열로 만들어줌.
                $mb_work_arr = explode(',', $row['mb_work'] );
                $manage_mb = get_member($row['ma_id']);
                ?>
                <tr class="<?php echo $bg; ?>">
                    <td>
                        <input type="checkbox" name="chk[]" value="<?php echo $row['cw_idx'] ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td><?=$list_no?></td>
                    <td><?= $step_list[$row["cw_step"]]?></td>
                    <td><?= $step_list[$row["ma_step"]]?></td>
                    <td style="cursor: pointer" onclick="sst_change2(<?= $row["car_date_type"]?>,'car_date_type')"><?= $cdt_list[$row["car_date_type"]]?></td>
                    <td style="cursor: pointer" onclick="sst_change2(<?= $row["car_size"]?>,'car_size')"><?= $cs_list[$row["car_size"]] ?></td>
                    <td><?= $row['car_no'] ?> / <?= $row['car_type'] ?> / <?= $row['car_color'] ?></td>

                    <td><a href="./member_form.php?<?=$qstr?>&amp;w=u&amp;mb_id=<?=$row['mb_id']?>"><?=$row['mb_id']?></a></td>
                    <td><?=$row['mb_name']?></td>
                    <td><a href="./member_form.php?<?=$qstr?>&amp;w=u&amp;mb_id=<?=$row['ma_id']?>"><?=$row['ma_id']?></a></td>
                    <td><?=$manage_mb['mb_name']?></td>
                    <td><?=$row['complete_cnt']?></td>

                    <!-- 매니저가 받는금액 -->
                    <?php if ($row['complete_cnt'] == 0) { $row['complete_cnt'] = 1; } ?>
                    <td>
                        <?= number_format($row['complete_cnt']*$ma_money_list[$row["car_date_type"]]) ?>
                        <input type="hidden" name="ma_payment[<?php echo $row['cw_idx']; ?>]" value="<?=$row['complete_cnt']*$ma_money_list[$row["car_date_type"]]?>">
                    </td>

                    <td><?= number_format($row['ma_payment']*1) ?></td>

                    <?php
                    $ma_payment_all += $row['complete_cnt']*$ma_money_list[$row["car_date_type"]] - $row['ma_payment'] ;
                    ?>
                    <td><?= substr($row['ma_payment_datetime'],2,8) != '00-00-00' ? substr($row['ma_payment_datetime'],2,8) : '' ?></td>
                    <td><?= ($row['is_payment'] == "Y") ? "완료": ""?></td>
                    <!--
                    <td><?= ($row['cp_id']) ? "사용": ""?></td>
                    -->
                    <td><?= substr($row['wr_datetime'],2,8) ? substr($row['wr_datetime'],2,8) : '' ?></td>
                    <td><?=$s_mod?></td>
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

    <div class="btn_list01 btn_list">
        <input type="hidden" name="qstr" value="<?=$qstr?>">
        <input type="submit" name="act_button" value="선택정산" onclick="document.pressed=this.value">
        <?php if($sfl=='cw.ma_id' || $sfl=='mem.mb_name'){ ?>
            총 미정산금 : <?=number_format($ma_payment_all)?>
        <?php } ?>

    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&nr=".$_REQUEST['nr'].'&amp;page='); ?>

<script>
    $(document).ready(function () {
        sfl_change('ready');

        $('#myButton').click(function (e) {

            if (!is_checked("chk[]")){
                swal_func("서비스항목을 한개 이상 선택하세요.");
                return false;
            }
            $('#myModal').modal();
        });

        $("#cw_step_select").val('<?=$_REQUEST["cw_step"]?>').prop("selected", true);

        var sst_id = "<?=$sst?>";
        if (sst_id != "ma_id"){
            sst_id = sst_id.replace(".", "_")
        }
        console.log(sst_id);
        $("#"+sst_id ).val('<?=$sod?>').prop("selected", true);

    })
    $("ul.cate li").on("click", function() {
        var nr = $(this).data("nr"),
            params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (nr != "") {
            params += "?nr=" + nr;
        }

        if (stx != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx;
        }

        location.href = g5_admin_url + "/admin_work_list.php" + params;
    });
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

        if(document.pressed == "선택정산") {
            if(!confirm("선택한 자료를 정산하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }
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

    function cw_step_change(val){

        location.href = g5_admin_url + "/adm_service_manager_list.php?<?=$qstr?>&cw_step=" + val;

    }
    function ma_step_change(val){

        location.href = g5_admin_url + "/adm_service_manager_list.php?<?=$qstr?>&ma_step=" + val;

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
                if(type == "car_date_type"){
                    data =  data + "<input type='text' name='car_date_type_name' style='padding-left: 5px' class='frm_input' value='<?=$_REQUEST["car_date_type_name"]?>' placeholder='매니저성함'>";
                }
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

    function manager_sel() {
        var ma_id = $('input[name="modal_mb_id"]:checked').val();

        var send_array = Array();
        var send_cnt = 0;
        var chkbox = $("[name='chk[]']");

        for(i=0;i<chkbox.length;i++) {
            if (chkbox[i].checked == true){
                send_array[send_cnt] = chkbox[i].value;
                send_cnt++;
            }
        }


        $.ajax({
            url: g5_admin_url+"/adm.controller.php",
            method: 'post',
            data: {"ma_id": ma_id,
                "idx": send_array,
                "mode":"manager_sel"},
            // dataType: "html",
            success: function(data) {
                if(data == 1){

                    $('#myModal').modal("hide"); //닫기

                    location.reload();

                }else{
                    $('#myModal').modal("hide"); //닫기
                    $('#myModal').on('hidden.bs.modal', function () {
                        $("input:radio[name='modal_mb_id']").attr("checked", false);
                    });

                    swal_func(data);
                }
            }
        });

    }

    function numberWithCommas(x) {
        var val = x.value;
        var id = x.id;
        final_val = val.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
        final_val = final_val.replace(/,/g,''); // ,값 공백처리
        $("#"+id).val(final_val.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가

        var total_price = <?= $total_count ?> * final_val
        total_price = total_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_price").val(total_price);
    }

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

        location.href = g5_admin_url + "/adm_service_manager_list.php"+ params;


    }


</script>

<?php
include_once ('./admin.tail.php');
?>
