<?php
$sub_menu = "250300";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from new_car_wash ";


$sql_search = " where call_req = 'Y' ";



if (!$sst) {
    $sst = "up_datetime";
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

$g5['title'] = '연락요청관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;


?>


<style>
    .mb_tbl table {text-align: center;}

</style>

<!-- 모달 영역 -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="modal_idx" value="">
                <button style="float: right; border-style: none; background: white" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">메모</h4>
            </div>
            <div class="modal-body">
                <textarea id="call_memo" maxlength="200" style="height: 93px; width: 560px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="memo_update()">저장</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" onchange="sfl_change();">
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>성함</option>
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
                <th>서비스 상세보기</th>
                <th>주소</th>
                <th>주차장소</th>
                <th>고객정보</th>
                <th>매니저정보</th>
                <th>세차일정</th>
                <th>접수일</th>
                <th>메모</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $config['cf_page_rows'];
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $background = "";
                if($row["call_memo"] == ""){
                    $background = "white";
                }else{
                    $background = "#bababa";
                }
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
                    <td><a href="<?=G5_ADMIN_URL."/adm_service_form.php?w=u&idx=".$row["cw_idx"]?>">상세보기</a></td>
                    <td><?= $row['car_w_addr1']." ".$row['car_w_addr2']?></td>
                    <td><?= $row['car_place']." ".$row['car_place2']?></td>
                    <td><?= $row['mb_name']."/".$row['mb_hp']?></td>
                    <td><?= $manage_mb['mb_name']."/".$manage_mb['mb_hp'] ?></td>
                    <td><?php
                        $date = $row['car_w_date'];
                        //정기세차가 아닐경우
                        if ($row['car_date_type'] != 2){
                            $yoil = array("일","월","화","수","목","금","토");

                            $day = explode('-',$date);
                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ".'('.$yoil[date('w', strtotime($date))].') '.$row['car_w_date2'];

                        }else{
                            echo '매주 '.$date.'요일';

                        } ?></td>
                    <td><?=substr($row['wr_datetime'],2,8)?></td>
                    <td><button type="button" onclick="modal_on(<?=$row['cw_idx']?>,'<?=$row["call_memo"]?>')" style="border: 1px solid #f1f1f1; background:<?=$background?>">보기/수정</button></td>

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

    })

    function modal_on(idx,memo){
        $("#modal_idx").val(idx);
        $("#call_memo").val(memo);
        $('#myModal').modal();

    }


    function swal_func(text) {

        swal({
            title: "경고창",
            text: text,
            icon: "error",
            button: "확인",
        });

    }

    function memo_update() {

        var idx = $("#modal_idx").val();
        var memo = $("#call_memo").val();
        $.ajax({
            url: g5_admin_url+"/adm.controller.php",
            method: 'post',
            data: {
                "cw_idx": idx,
                "call_memo": memo,
                "mode":"memo_update"},
            // dataType: "html",
            success: function(data) {

                if (data != ""){
                    swal("저장되었습니다.").then((value) => {
                        location.href= data;
                    })
                }else{
                    swal_func("저장에 실패하였습니다. 다시 시도해주세요.")
                }


            },
            error:function(request,status,error){
                alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            }
        });

    }

</script>

<?php
include_once ('./admin.tail.php');
?>
