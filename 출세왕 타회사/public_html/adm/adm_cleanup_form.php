<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$g5['title'] .= '서비스관리';
include_once('./admin.head.php');

$sql = "select * from {$g5['cleanup_table']} where cu_idx = '{$_REQUEST["idx"]}' ";
$view = sql_fetch($sql);

$sql = "select mb_id,mb_name,mb_hp from {$g5['member_table']} where mb_level = 3 and mb_1 = 'Y'";
$mem_result = sql_query($sql);


// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
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

<form name="fmember" id="fmember" action="<?= G5_ADMIN_URL ?>/adm.controller.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="mode" value="cleanup_form">
<input type="hidden" name="cu_idx" value="<?php echo $view['cu_idx'] ?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="cu_type">상품명<?php echo $sound_only ?></label></th>
        <td style=" width :40%">
            <select name="cu_type" id="cu_type">

                <?php for($i = 1; $i <= count($ct_list); $i++){
                    echo "<option value='".$i."'>".$ct_list[$i]."</option>";
                } ?>

            </select>
			<? /*
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
			*/ ?>
        </td>
        <th scope="row"><label for="cu_building">건물유형</label></th>
        <td>
            <select name="cu_building" id="cu_building">

                <?php for($i = 1; $i <= count($cub_list); $i++){
                    echo "<option value='".$i."'>".$cub_list[$i]."</option>";
                } ?>

            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="car_w_date">청소일정</label></th>
        <td>
            <input type="date" name="cu_date" id="cu_date"  class="frm_input" value="<?php echo $view['cu_date'] ?>" >
            <input type="time" name="cu_time" value="<?php echo $view['cu_time'] ?>" id="cu_time"  class=" frm_input" >
        </td>
        <th scope="row"><label for="cu_addr2">청소장소</label></th>
        <td>
            <input type="text" name="cu_addr1" value="<?php echo $view['cu_addr1'] ?>" id="cu_addr1"  class=" frm_input" size="40">
            <input type="text" name="cu_addr2" value="<?php echo $view['cu_addr2'] ?>" id="cu_addr2"  class=" frm_input" size="20">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cu_memo">요청사항</label></th>
        <td>
            <input type="text" name="cu_memo" value="<?php echo $view['cu_memo'] ?>" id="cu_memo"  class=" frm_input" size="55">
        </td>
        <th scope="row"><label for="cu_mb_name">고객정보</label></th>
        <td>
            <input type="text" name="cu_mb_name" value="<?php echo $view['cu_mb_name'] ?>" id="cu_mb_name"  class=" frm_input"  placeholder="고객명">
            <input type="text" name="cu_mb_hp" value="<?php echo $view['cu_mb_hp'] ?>" id="cu_mb_hp"  class=" frm_input" size="30" placeholder="핸드폰번호">
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="pay">예상금액<strong class="sound_only">필수</strong></label></th>
        <td>
            <?php  echo number_format($view['final_pay'])?>
        </td>

        <th scope="row"><label for="final_pay">최종금액</label></th>
        <td><input type="text" name="final_pay" onkeyup="numberWithCommas(this.value)" value="<?php echo number_format($view['final_pay']) ?>" id="final_pay" class="frm_input" size="30">
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="mb_name">진행상황</label></th>
        <td>
            <select name="cu_step" id="cu_step">

                <?php for($i = 0; $i < count($step_list); $i++){
                    echo "<option value='".$i."'>".$step_list[$i]."</option>";
                } ?>
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
            <p> * 진행상황을 임의로 수정 시, 접수일자는 수정불가하며<br>취소일자 및 완료일자는 관리자가 수정한 일자로 고객에게 보여지게 됩니다. </p>
        </td>
        <th scope="row"><label for="mb_name">매니저 아이디</label></th>
        <td>
            <input type="hidden" value="<?= $view["ma_id"]?>" name="ma_id">
            <span style="margin-right: 10px"><?= $view["ma_id"]?></span>
            <?php if ($view["cw_step"] == 0 || $view["cw_step"] == 1){?>
            <input type="button" value="선택" id="myButton">
            <?php } ?>
        </td>

    </tr>
	<? /*
	<tr>
        <th scope="row"><label for="mb_memo">메모</label></th>
        <td colspan="3"><textarea name="mb_memo" id="mb_memo"><?php echo $mb['mb_memo'] ?></textarea></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_level">회원 권한</label></th>
        <td><?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?></td>
        <th scope="row">포인트</th>
        <td><a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $mb['mb_id'] ?>" target="_blank"><?php echo number_format($mb['mb_point']) ?></a> 점</td>
    </tr>
    <tr>
		<th scope="row"><label for="mb_homepage">홈페이지</label></th>
        <td><input type="text" name="mb_homepage" value="<?php echo $mb['mb_homepage'] ?>" id="mb_homepage" class="frm_input" maxlength="255" size="15"></td>
        <th scope="row"><label for="mb_tel">전화번호</label></th>
        <td><input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row">본인확인방법</th>
        <td colspan="3">
            <input type="radio" name="mb_certify_case" value="ipin" id="mb_certify_ipin" <?php if($mb['mb_certify'] == 'ipin') echo 'checked="checked"'; ?>>
            <label for="mb_certify_ipin">아이핀</label>
            <input type="radio" name="mb_certify_case" value="hp" id="mb_certify_hp" <?php if($mb['mb_certify'] == 'hp') echo 'checked="checked"'; ?>>
            <label for="mb_certify_hp">휴대폰</label>
        </td>
    </tr>
    <tr>
        <th scope="row">본인확인</th>
        <td>
            <input type="radio" name="mb_certify" value="1" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>>
            <label for="mb_certify_yes">예</label>
            <input type="radio" name="mb_certify" value="" id="mb_certify_no" <?php echo $mb_certify_no; ?>>
            <label for="mb_certify_no">아니오</label>
        </td>
        <th scope="row"><label for="mb_adult">성인인증</label></th>
        <td>
            <input type="radio" name="mb_adult" value="1" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>>
            <label for="mb_adult_yes">예</label>
            <input type="radio" name="mb_adult" value="0" id="mb_adult_no" <?php echo $mb_adult_no; ?>>
            <label for="mb_adult_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row">주소</th>
        <td colspan="3" class="td_addr_line">
            <label for="mb_zip" class="sound_only">우편번호</label>
            <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
            <label for="mb_addr1">기본주소</label><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
            <label for="mb_addr2">상세주소</label>
            <br>
            <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
            <label for="mb_addr3">참고항목</label>
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_icon">회원아이콘</label></th>
        <td colspan="3">
            <?php echo help('이미지 크기는 <strong>넓이 '.$config['cf_member_icon_width'].'픽셀 높이 '.$config['cf_member_icon_height'].'픽셀</strong>로 해주세요.') ?>
            <input type="file" name="mb_icon" id="mb_icon">
            <?php
            $mb_dir = substr($mb['mb_id'],0,2);
            $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
            if (file_exists($icon_file)) {
                $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
                echo '<img src="'.$icon_url.'" alt="">';
                echo '<input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1">삭제';
            }
            ?>
        </td>
    </tr>
    <tr>
        <th scope="row">메일 수신</th>
        <td>
            <input type="radio" name="mb_mailling" value="1" id="mb_mailling_yes" <?php echo $mb_mailling_yes; ?>>
            <label for="mb_mailling_yes">예</label>
            <input type="radio" name="mb_mailling" value="0" id="mb_mailling_no" <?php echo $mb_mailling_no; ?>>
            <label for="mb_mailling_no">아니오</label>
        </td>
        <th scope="row"><label for="mb_sms_yes">SMS 수신</label></th>
        <td>
            <input type="radio" name="mb_sms" value="1" id="mb_sms_yes" <?php echo $mb_sms_yes; ?>>
            <label for="mb_sms_yes">예</label>
            <input type="radio" name="mb_sms" value="0" id="mb_sms_no" <?php echo $mb_sms_no; ?>>
            <label for="mb_sms_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_open">정보 공개</label></th>
        <td colspan="3">
            <input type="radio" name="mb_open" value="1" id="mb_open_yes" <?php echo $mb_open_yes; ?>>
            <label for="mb_open_yes">예</label>
            <input type="radio" name="mb_open" value="0" id="mb_open_no" <?php echo $mb_open_no; ?>>
            <label for="mb_open_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_signature">서명</label></th>
        <td colspan="3"><textarea  name="mb_signature" id="mb_signature"><?php echo $mb['mb_signature'] ?></textarea></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_profile">자기 소개</label></th>
        <td colspan="3"><textarea name="mb_profile" id="mb_profile"><?php echo $mb['mb_profile'] ?></textarea></td>
    </tr>
	*/ ?>

    <tr>
        <th scope="row" "><label for="mb_nick">등록날짜</label></th>
        <td><?php echo $view['wr_datetime'] ?></td>
        <th scope="row" "><label for="mb_nick">고객 아이디</label></th>
        <td><?php echo $view['mb_id'] ?></td>
    </tr>

    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <?php } ?>
    <a href="./adm_cleanup_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<script>

    $(document).ready(function() {
        $("[name='cu_type']").val(<?= $view['cu_type']?>);
        $("[name='cu_building']").val(<?= $view['cu_building']?>);
        $("[name='cu_step']").val('<?= $view['cu_step']?>');
        $('#myButton').click(function (e) {
            $('#myModal').modal();
        });
    });

    //콤마찍기
    function numberWithCommas(x) {
        x = x.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
        x = x.replace(/,/g,''); // ,값 공백처리
        $("#final_pay").val(x.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
    }

    function manager_sel() {

        var ma_id = $('input[name="modal_mb_id"]:checked').val();
        var arr = new Array();
        arr[0] = <?=$_REQUEST['idx']?>;

        $.ajax({
            url: g5_admin_url+"/adm.controller.php",
            method: 'post',
            data: {"ma_id": ma_id,
                "idx": arr,
                "mode":"cu_manager_sel"},
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
                    if(data != "") {
                        swal_func(data);
                    }else{
                        swal_func("새로고침 후 다시 시도해주세요.");
                    }
                }
            }
        });
    }



</script>

<?php
include_once('./admin.tail.php');
?>
