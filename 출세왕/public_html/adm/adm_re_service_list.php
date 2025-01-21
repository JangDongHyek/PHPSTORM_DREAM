<?php
$sub_menu = "250200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from new_re_car_wash rw left join new_car_wash cw on rw.cw_idx = cw.cw_idx ";


$sql_search = " where 1=1 ";


if ($stx != "") {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'rw_step' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}



if (!$sst) {
    $sst = "rw.wr_datetime";
    $sod = "desc";
}

$rw_step = $_REQUEST["rw_step"];
//진행사항 필터
if ($_REQUEST["rw_step"] != ""){
    $sql_search .= "and rw_step = '{$_REQUEST["rw_step"]}'";
    if($rw_step)
        $qstr .= '&amp;rw_step=' . urlencode($rw_step);
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

$g5['title'] = '재작업관리';
include_once('./admin.head.php');

$sql = " select *,rw.rw_idx as rw_idx,rw.*,rw_step as rw_step,rw.wr_datetime rw_datetime {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;

//대기, 배차, 완료, 취소 count
$sql = "SELECT (SELECT COUNT(rw_idx) From new_re_car_wash WHERE rw_step = 0) wait,
(SELECT COUNT(rw_idx) From  new_re_car_wash WHERE rw_step = 1) assign,
(SELECT COUNT(rw_idx) From  new_re_car_wash WHERE rw_step = 2) complete,
(SELECT COUNT(rw_idx) From  new_re_car_wash WHERE rw_step = 3) cancel
from  {$g5['car_wash_table']} LIMIT 1";

$assign_cnt = sql_fetch($sql);

$sql = "select mb_id,mb_name,mb_hp from {$g5['member_table']} where mb_level = 3 and mb_1 = 'Y' ";
$mem_result = sql_query($sql);

?>


<style>
    .mb_tbl table {text-align: center;}

</style>



<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    대기 : <?= $assign_cnt['wait']?>건, 진행 : <?= $assign_cnt['assign']?>건, 완료 : <?= $assign_cnt['complete']?>건, 취소 : <?= $assign_cnt['cancel']?>건
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>"></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" onchange="sfl_change();">
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>성함</option>
        <option value="rw_step"<?php echo get_selected($_GET['sfl'], "rw_step"); ?>>진행상황</option>
        <option value="car_date_type"<?php echo get_selected($_GET['sfl'], "car_date_type"); ?>>세차종류</option>
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

    <input type ="hidden" id="rw_step" name="rw_step" value="<?= $_REQUEST['rw_step']?>" >
    <input type ="hidden" id="car_date_type" name="car_date_type" value="<?= $_REQUEST['car_date_type']?>" >
    <input type ="hidden" id="car_size" name="car_size" value="<?= $_REQUEST['car_size']?>" >

    <input type="submit" class="btn_submit" value="검색">
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
<!--                <th scope="col">-->
<!--                    <label for="chkall" class="sound_only">회원 전체</label>-->
<!--                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">-->
<!--                </th>-->
                <th>no</th>
                <th>재작업진행상황
                    <select onchange="sst_change2(this.value,'rw_step')">
                        <option value="" <?php if($_GET['rw_step']==0){ echo 'selected'; } ?>>선택</option>
                        <?php for($i = 0; $i < count($step_list); $i++){
                            if ($_GET['rw_step'] == $i) {
                                echo "<option value=\"$i\" onclick=\"sst_change2($i,'rw_step')\" selected>$step_list[$i]</option>";
                            }else{
                                echo "<option value=\"$i\" onclick=\"sst_change2($i,'rw_step')\" >$step_list[$i]</option>";
                            }
                        } ?>
                    </select>
                </th>
                <th>완료횟수</th>
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
                <th>재작업일정</th>
                <th>성함</th>
                <th>매니저성함</th>
                <th>접수일</th>
                <th>완료일</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $config['cf_page_rows'];
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $s_mod = '<a href="./adm_re_service_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['rw_idx'].'">보기/수정</a>';
                $bg = 'bg'.($i%2);
                //mb_work 콤마단위로 끊어서 배열로 만들어줌.
                $mb_work_arr = explode(',', $row['mb_work'] );
                $manage_mb = get_member($row['ma_id']);
                ?>
                <tr class="<?php echo $bg; ?>">
<!--                    <td>-->
<!--                        <input type="checkbox" name="chk[]" value="--><?php //echo $row['cw_idx'] ?><!--" id="chk_--><?php //echo $i ?><!--">-->
<!--                    </td>-->
                    <td><?=$list_no?></td>
                    <td><?= $step_list[$row["rw_step"]]?></td>
                    <td><?=$row['rw_complete_cnt']?></td>
                    <td onclick="sst_change2(<?= $row["car_date_type"]?>,'car_date_type')"><?= $cdt_list[$row["car_date_type"]]?></td>
                    <td><?php
                        $date = $row['rw_date'];
                        //정기세차가 아닐경우
                        $yoil = array("일","월","화","수","목","금","토");
                        if ($date != NULL ) {
                            $day = explode('-', $date);
                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  " . '(' . $yoil[date('w', strtotime($date))] . ') ' .date('H:i',strtotime($row['rw_date2']));
                        }
                        ?></td>
                    <td><?=$row['mb_name']?></td>
                    <td><?=$manage_mb['mb_name']?></td>
                    <td><?=substr($row['rw_datetime'],2,8)?></td>
                    <td><?=substr($row['complete_datetime'],2,8)?></td>
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

        return true;
    }
    //검색 조건이 작업일 경우 select 박스로 변경
    function sfl_change(type) {

        var sfl = $('#sfl');

        if (sfl.val() == 'rw_step' || sfl.val() == 'car_date_type'){
            option_list(sfl.val());
        }else{
            if (type != "ready") {
                $('#stx_span').html('<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input">');
                $("#stx").val("");
            }
        }

    }

    function option_list(type) {

        $.ajax({
            url: g5_admin_url+"/adm.controller.php",
            data: {"type": type, "mode":"list_option"},
            dataType: "html",
            success: function(data) {
                $('#stx_span').html(data);

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

    function sst_change2(val,sst){
        $("#"+ sst).val(val);
        $("#fsearch").submit();
    }

    function cw_step_change(val){

        location.href = g5_admin_url + "/adm_re_service_list.php?<?=$qstr?>&cw_step=" + val;

    }
</script>

<?php
include_once ('./admin.tail.php');
?>
