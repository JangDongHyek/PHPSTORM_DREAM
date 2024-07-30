<?php
$sub_menu = "250110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from new_company_car_wash cc left join g5_member mem on cc.ma_id = mem.mb_id ";


$sql_search = " where 1=1 ";


if ($stx != "") {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'cc_step' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " {$sfl} like '%{$stx}%' ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "wr_datetime";
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

$listall = ' <a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall"><button style="border: 1px solid #ccc">전체목록</button></a>';

$g5['title'] = '기업세차확인';
include_once('./admin.head.php');

$sql = " select cc.* {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;

//대기, 배차, 완료, 취소 count
$sql = "SELECT (SELECT COUNT(cc_idx) From new_company_car_wash WHERE cc_step = 0) wait,
(SELECT COUNT(cc_idx) From  new_company_car_wash WHERE cc_step = 1) assign,
(SELECT COUNT(cc_idx) From  new_company_car_wash WHERE cc_step = 2) complete,
(SELECT COUNT(cc_idx) From  new_company_car_wash WHERE cc_step = 3) cancel
from  new_company_car_wash LIMIT 1";

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
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>"></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" onchange="sfl_change();">
        <option value="cc.mb_id"<?php echo get_selected($_GET['sfl'], "cc.mb_id"); ?>>아이디</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>매니저성함</option>
        <option value="cc_step"<?php echo get_selected($_GET['sfl'], "cc_step"); ?>>진행상황</option>
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
    <input type="submit" class="btn_submit" value="검색">
</form>
<?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
<div class="btn_add01 btn_add" style="float: left">
    <button  id="myButton">매니저등록</button>
</div>
<div class="btn_add01 btn_add" style="float: right">
    <a href="./adm_company_service_form.php">서비스등록</a>
</div>
<?php } ?>
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
                <th><?php echo subject_sort_link('cc_step') ?>진행상황</a></th>
                <th>회사명</th>
                <th>담당자(휴대번호)</th>
                <th>주소</th>
                <th>주차형태</th>
                <th>최소 신청가능 대수</th>
                <th>접수자 아이디</th>
                <th>매니저아이디</th>
                <th>매니저성함</th>
                <th>접수일</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $config['cf_page_rows'];
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $s_mod = '<a href="./adm_company_service_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['cc_idx'].'">보기/수정</a>';
                $bg = 'bg'.($i%2);
                //mb_work 콤마단위로 끊어서 배열로 만들어줌.
                $mb_work_arr = explode(',', $row['mb_work'] );
                $manage_mb = get_member($row['ma_id']);
                ?>
                <tr class="<?php echo $bg; ?>">
                    <td>
                        <input type="checkbox" name="chk[]" value="<?php echo $row['cc_idx'] ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td><?=$list_no?></td>
                    <td><?= $step_list[$row["cc_step"]]?></td>
                    <td><?=$row["cc_company"]?></td>
                    <td><?=$row["cc_manager"]."(".hyphen_hp_number($row["cc_hp"]).")" ?></td>
                    <td><?= $row['cc_w_addr1']." ".$row['cc_w_addr2'] ?></td>
                    <td><?=$place_list[$row['cc_place']]?></td>
                    <td><?=$row['cc_number']?></td>
                    <td><a href="./member_form.php?<?=$qstr?>&amp;w=u&amp;mb_id=<?=$row['mb_id']?>"><?=$row['mb_id']?></a></td>
                    <td><a href="./member_form.php?<?=$qstr?>&amp;w=u&amp;mb_id=<?=$row['ma_id']?>"><?=$row['ma_id']?></a></td>
                    <td><?=$manage_mb['mb_name']?></td>
                    <td><?=substr($row['wr_datetime'],2,8)?></td>
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

        if (sfl.val() == 'cc_step' || sfl.val() == 'car_date_type'){
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

</script>

<?php
include_once ('./admin.tail.php');
?>
