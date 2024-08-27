<?php
$sub_menu = "250100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$g5['title'] .= '기업세차관리';
include_once('./admin.head.php');

$sql = "select * from new_company_car_wash where cc_idx = '{$_REQUEST["idx"]}' ";
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
                <div style="margin-bottom: 10px"><input id="modal_mb_name" type="text" ><button>검색</button></div>
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
<input type="hidden" name="mode" value="service_company_form">
<input type="hidden" name="cc_idx" value="<?php echo $view['cc_idx'] ?>">

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
        <th scope="row"><label for="cc_company">회사명</label></th>
        <td>
            <input type="text" name="cc_company" value="<?php echo $view['cc_company'] ?>" id="cc_company"  class=" frm_input" >
        </td>
        <th scope="row"><label for="cc_homepage">홈페이지</label></th>
        <td>
            <input type="text" name="cc_homepage" value="<?php echo $view['cc_homepage'] ?>" id="cc_homepage"  class=" frm_input" >
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cc_manager">담당자정보</label></th>
        <td style="width: 40%;">
            <input type="text" name="cc_manager" value="<?php echo $view['cc_manager'] ?>" id="cc_manager" placeholder="담당자명" class=" frm_input" >
            <input type="text" name="cc_email" value="<?php echo $view['cc_email'] ?>" id="cc_email" placeholder="이메일" class=" frm_input" size="30" >
            <input type="text" name="cc_hp" value="<?php echo $view['cc_hp'] ?>" id="cc_hp" placeholder="휴대폰번호" class=" frm_input" >
            <input type="text" name="cc_fax" value="<?php echo $view['cc_fax'] ?>" id="cc_fax" placeholder="팩스" class=" frm_input" >
        </td>
        <th scope="row"><label for="cc_w_addr1">주차형태</label></th>
        <td>
            <select name="cc_place" value="<?php echo $view['cc_place'] ?>" id="cc_place"  class=" frm_input">
                <?php for ($i = 1; $i <= count($place_list); $i++) {?>
                    <option <? if ($view['cc_place'] == $i ) echo "selected"; ?> value="<?=$i?>"><?=$place_list[$i]?></option>
                <?php }?>
            </select>
        </td>
        
    </tr>
    <tr>
        <th scope="row"><label for="cc_w_addr1">주소</label></th>
        <td colspan="3">
            <input type="text" name="cc_w_addr1" value="<?php echo $view['cc_w_addr1'] ?>" id="cc_w_addr1"  class=" frm_input"  onclick="sample2_execDaumPostcode()" placeholder="주소" size="100">
            <input type="text" name="cc_w_addr2" value="<?php echo $view['cc_w_addr2'] ?>" id="cc_w_addr2"  class=" frm_input"  placeholder="상세주소">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cc_number">최소 신청 가능 대수</label></th>
        <td>
            <input type="text" name="cc_number" value="<?php echo $view['cc_number'] ?>" id="cc_number"  class=" frm_input" >
        </td>
        <th scope="row"><label for="cc_in_yn">내부세차</label></th>
        <td>
            <select name="cc_in_yn" id="cc_in_yn">
                <option value="">포함안함</option>
                <option <? if ($view['cc_in_yn'] == "1" ) echo "selected"; ?> value="1">일반</option>
                <option <? if ($view['cc_in_yn'] == "2" ) echo "selected"; ?> value="2">프리미엄</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cc_memo">기타 요청사항</label></th>
        <td colspan="3">
            <textarea type="text" name="cc_memo" id="cc_memo"  class=" frm_input" ><?php echo $view['cc_memo'] ?></textarea>
        </td>

    </tr>
    <tr>
        <th scope="row"><label for="mb_name">진행상황</label></th>
        <td>
            <select name="cc_step" id="cc_step">

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
            <input type="hidden" id="ma_id" value="<?= $view["ma_id"]?>" name="ma_id">
            <span style="margin-right: 10px" id="td_ma_id"><?= $view["ma_id"]?></span>
            <?php if ($view["cc_step"] == 0 || $view["cc_step"] == 1){?>
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
    <?php if ($_REQUEST["w"] == "u"){?>
    <tr>
        <th scope="row" "><label for="mb_nick">등록날짜</label></th>
        <td><?php echo $view['wr_datetime'] ?></td>
        <th scope="row" "><label for="mb_nick">고객 아이디</label></th>
        <td ><?php echo $view['mb_id'] ?></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <?php } ?>
    <a href="./adm_company_service_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>


<script>



    function sample2_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                // document.getElementById('sample4_postcode').value = data.zonecode;
                document.getElementById("cc_w_addr1").value = roadAddr;
                // document.getElementById("sample4_jibunAddress").value = data.jibunAddress;

                // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                if(roadAddr !== ''){
                    document.getElementById("cc_w_addr1").value = roadAddr+extraRoadAddr;
                }
            }
        }).open();
    }

    $(document).ready(function() {

        $("[name='cc_step']").val(<?= $view['cc_step']?>);
        $("[name='cc_in_yn']").val('<?= $view['cc_in_yn']?>');

        $('#myButton').click(function (e) {
            $('#myModal').modal();
        });

    });


    function manager_sel() {

        $('#myModal').modal("hide"); //닫기
        $('#myModal').on('hidden.bs.modal', function () {

            $("#ma_id").val($('input[name="modal_mb_id"]:checked').val());
            $("#td_ma_id").html($('input[name="modal_mb_id"]:checked').val());
            $("input:radio[name='modal_mb_id']").attr("checked", false);
        });

    }

    function manager_search() {

        var mb_name = $('#modal_mb_name').val();

        $.ajax({
            url: g5_admin_url+"/adm.controller.php",
            method: 'post',
            data: {"mb_name": mb_name,
                "mode":"manager_search"},
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
include_once('./admin.tail.php');
?>
