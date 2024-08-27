<?php
$sub_menu = "250100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$g5['title'] .= '서비스관리';
include_once('./admin.head.php');

if($_GET['cw_step']){
    $qstr .= '&cw_step='.$_GET['cw_step'];
}

$sql = "select * from {$g5['car_wash_table']} where cw_idx = '{$_REQUEST["idx"]}' ";
$view = sql_fetch($sql);

$sql = "select * from {$g5['board_file_table']} where wr_id = '{$_REQUEST['idx']}' and bo_table = 'car_wash' ";
$result = sql_query($sql);
$cnt = sql_num_rows($result);

$sql = "select mb_id,mb_name,mb_hp from {$g5['member_table']} where mb_level = 3 and mb_1 = 'Y'";
$mem_result = sql_query($sql);

$sql = "select * from new_complete_history where cw_idx = '{$_REQUEST["idx"]}' and update_yn = 'N' order by ch_idx desc ";
$complete_result = sql_query($sql);

//결제금액
$sql = "select Amt from new_payment where Moid like '%-".$_REQUEST['idx']."' ";
$price = number_format(sql_fetch($sql)["Amt"]);
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
                <div style=" margin-bottom: 8px">
                    <input id="modal_mb_name" type="text"><button>검색</button>
                </div>
                <div style=" margin-bottom: 8px">
                    <input name="modal_mb_id" type="radio" value=""><span style="margin-left: 10px;">매니저 지정없음</span>
                </div>
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
<input type="hidden" name="mode" value="service_form">
<input type="hidden" name="cw_idx" value="<?php echo $view['cw_idx'] ?>">
<input type="hidden" name="re_url" value="<?php echo $_REQUEST['re_url'] ?>">


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
        <th scope="row"><label for="car_date_type">상품명<?php echo $sound_only ?></label></th>
        <td style=" width :40%">
            <select name="car_date_type" id="car_date_type">

                <?php for($i = 1; $i <= count($cdt_list); $i++){
                    echo "<option value='".$i."'>".$cdt_list[$i]."</option>";
                } ?>

            </select>
			<? /*
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
			*/ ?>
        </td>
        <th scope="row"><label for="car_type">차사이즈</label></th>
        <td>
            <select name="car_size" id="car_size">

                <?php for($i = 1; $i <= count($cs_list); $i++){
                    echo "<option value='".$i."'>".$cs_list[$i]."</option>";
                } ?>

            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="up_address">차량정보</label></th>
        <td>
            <input type="text" name="car_no" value="<?php echo $view['car_no'] ?>" id="car_no"  class=" frm_input" size="15" placeholder="차번호">
            <input type="text" name="car_type" value="<?php echo $view['car_type'] ?>" id="car_type"  class=" frm_input" size="20" placeholder="차종">
            <input type="text" name="car_color" value="<?php echo $view['car_color'] ?>" id="car_color"  class=" frm_input" size="15" placeholder="차색상">
            <a href="<?=G5_BBS_URL?>/view_image.php?bo_table=car_photo&fn=<?=$view['car_no'].".jpg"?>" class = "view_image">차량사진</a>
        </td>
        <th scope="row"><label for="car_in_yn">내부세차</label></th>
        <td>
            <select name="car_in_yn" id="car_in_yn">
                <option value="Y">포함</option>
                <option value="N">포함안함</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="car_w_date">세차일정</label></th>
        <td>
            <?php if ($view["car_date_type"] != 2){ ?>
            <input type="date" name="car_w_date" id="car_w_date"  class="frm_input" >
            <input type="time" name="car_w_date2" value="<?php echo $view['car_w_date2'] ?>" id="car_w_date2"  class=" frm_input" >
            <?php }else{ ?>
            <select name="car_w_date" id="car_w_date">
                <option value="">요일선택</option>
                <option value="월"> 월요일</option>
                <option value="화"> 화요일</option>
                <option value="수"> 수요일</option>
                <option value="목"> 목요일</option>
                <option value="금"> 금요일</option>
                <option value="토"> 토요일</option>
                <option value="일"> 일요일</option>
            </select>
            <?php } ?>
        </td>
        <th scope="row"><label for="car_addr1">세차장소</label></th>
        <td>
            <input type="text" name="car_w_addr1" value="<?php echo $view['car_w_addr1'] ?>" id="car_w_addr1" onclick="sample2_execDaumPostcode()" placeholder= "주소" class=" frm_input" size="50">
            <input type="text" name="car_w_addr2" value="<?php echo $view['car_w_addr2'] ?>" id="car_w_addr2" placeholder="상세주소"  class=" frm_input" size="20">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="car_memo">요청사항</label></th>
        <td>
            <input type="text" name="car_memo" value="<?php echo $view['car_memo'] ?>" id="car_memo"  class=" frm_input" size="55">
        </td>
        <th scope="row"><label for="mb_name">고객정보</label></th>
        <td>
            <input type="text" name="mb_name" value="<?php echo $view['mb_name'] ?>" id="mb_name"  class=" frm_input"  placeholder="고객명">
            <input type="text" name="mb_hp" value="<?php echo $view['mb_hp'] ?>" id="mb_hp"  class=" frm_input" size="30" placeholder="핸드폰번호">
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="pay">예상금액<strong class="sound_only">필수</strong></label></th>
        <td>
            <?php  $pay = $money_list[$view['car_date_type']."".$view['car_size']];
            $in_pay = $view['car_in_yn'] == 'Y' ? '10000': "";
            $final_pay = $pay + $in_pay;
            echo number_format($final_pay); ?>
        </td>

        <th scope="row"><label for="final_pay">최종금액</label></th>
        <td><input type="text" name="final_pay" onkeyup="numberWithCommas(this.value,'final_pay')" value="<?php echo number_format($view['final_pay']) ?>" id="final_pay" class="frm_input" size="30">
            <strong>결제금액 :</strong> <?=$price?>원
            <strong style="margin-left: 15px">결제여부 : </strong><?= ($view['is_payment'] == "Y") ? "완료": "미완료"?>
            <strong style="margin-left: 15px">쿠폰 : </strong><?= $view['cp_id']?>
        </td>
    </tr>
    <?php if ($w == "u"){ ?>
    <tr>
        <th scope="row"><label for="pay">사진</label></th>
        <td>
            <?php
            if ($cnt == 0 ){
                echo '없음';
            }else{
                // 파일 출력
                if($cnt != 0) {
                    for ($b = 0; $file = sql_fetch_array($result); $b++) {
                        echo '<a href="'.G5_BBS_URL.'/view_image.php?bo_table=car_wash&fn='.$file['bf_file'].'" class = "view_image"><img style = "width:100px" src="'.G5_DATA_URL.'/file/car_wash/'.$file['bf_file'].'">';;
                    }
                }
            }
            ?>
        </td>
        <th scope="row"><label for="pay">사진메모</label></th>
        <td>
            <input type="text" name="car_picture_memo" value="<?php echo $view['car_picture_memo'] ?>" id="car_picture_memo"  class=" frm_input" size="52">
        </td>

    </tr>
    <?php } ?>
    <tr>
        <th scope="row"><label for="mb_name">진행상황</label></th>
        <td>
            <select name="cw_step" id="cw_step">

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
            <input type="hidden" value="<?= $view["ma_id"]?>" id = "ma_id" name="ma_id">
            <span style="margin-right: 10px" id="td_ma_id"><?= $view["ma_id"]?></span>
            <?php if ($view["cw_step"] == 0 || $view["cw_step"] == 1){?>
            <input type="button" value="선택" id="myButton">
            <?php } ?>
        </td>

    </tr>

    <tr>
        <th scope="row"><label for="mb_name">정산상황<label></th>
        <td>
            <select name="ma_step" id="ma_step">
                <?php for ($i = 0; $i < count($step_list); $i++) {
                    if ($view['ma_step'] == $i) {
                        echo "<option value=\"$i\"  selected>$step_list[$i]</option>";
                    } else {
                        echo "<option value=\"$i\"  >$step_list[$i]</option>";
                    }
                }
                ?>
            </select>
            <p> * 정기세차를 완료할 시 진행으로 자동으로 변경됩니다. </p>
        </td>
        <th scope="row"><label for="mb_name">정산금액</label></th>
        <td>
            <input type="text" name="ma_payment" onkeyup="numberWithCommas(this.value,'ma_payment')" value="<?php echo number_format($view['ma_payment']*1) ?>" id="ma_payment" class="frm_input" size="30">

            <!-- 매니저가 받는금액 -->
            <?php if ($view['complete_cnt'] == 0) { $view['complete_cnt'] = 1; } ?>
            <strong>
                매니저 예상금액:
            </strong>
            <?= number_format($view['complete_cnt'] * $ma_money_list[$view["car_date_type"]]) ?>
            원
        </td>

    </tr>
    <tr>
        <th scope="row"><label for="mb_name">정산날짜</label></th>
        <td>
            <input name="ma_payment_datetime" type="datetime-local" value="<?=$view['ma_payment_datetime']?>" class="frm_input">
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
    <?php if ($w == "u"){ ?>
    <tr>
        <th scope="row" "><label for="mb_nick">등록날짜</label></th>
        <td><?php echo $view['wr_datetime'] ?></td>
        <th scope="row" "><label for="mb_nick">등록자 아이디</label></th>
        <td><?php echo $view['mb_id'] ?></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>
<?php if ($w == "u" && $view["car_date_type"] < 3){ ?>
<div class="tbl_head02 tbl_wrap mb_tbl">
    <table style="text-align: center">

        <thead>
        <tr>
            <th>완료회차</th>
            <th>완료일자</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($complete_result); $i++) {

            ?>
            <tr>
                <td><?= $row["total_cnt"] ?>회</td>
                <td><?=date("Y-m-d H시 i분",strtotime($row["ch_datetime"]))?></td>
            </tr>


            <?php
        }
        if ($i == 0)
            echo "<tr><td colspan=\"9\" class=\"empty_table\">자료가 없습니다.</td></tr>";
        ?>
        </tbody>
    </table>
</div>
<?php } ?>
<div class="btn_confirm01 btn_confirm">
    <?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <?php } ?>
    <?php if($_REQUEST['re_url']){ ?>
        <a href="./<?=$_REQUEST['re_url']?>.php?<?php echo $qstr ?>">목록</a>
    <?php }else{ ?>
        <a href="./adm_service_list.php?<?php echo $qstr ?>">목록</a>
    <?php } ?>

</div>
</form>

<script>

    $(document).ready(function() {
        $("[name='car_date_type']").val(<?= $view['car_date_type']?>);
        $("[name='car_size']").val(<?= $view['car_size']?>);
        $("[name='car_w_date']").val('<?= $view['car_w_date']?>');
        $("[name='cw_step']").val(<?= $view['cw_step']?>);
        $("[name='car_in_yn']").val('<?= $view['car_in_yn']?>');

        $("a.view_image").click(function() {
            window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=400,height=400,resizable=yes, scrollbars=1,status=no");
            return false;
        });

        $('#myButton').click(function (e) {
            $('#myModal').modal();
        });

    });

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
                document.getElementById("car_w_addr1").value = roadAddr;
                // document.getElementById("sample4_jibunAddress").value = data.jibunAddress;

                // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                if(roadAddr !== ''){
                    document.getElementById("car_w_addr1").value = roadAddr+extraRoadAddr;
                }
            }
        }).open();
    }


    function fmember_submit(f)
    {
        if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
            alert('아이콘은 gif 파일만 가능합니다.');
            return false;
        }

        return true;
    }

    //콤마찍기
    function numberWithCommas(x,id) {
        x = x.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
        x = x.replace(/,/g,''); // ,값 공백처리
        $("#"+ id).val(x.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
    }



    function manager_sel() {

        $('#myModal').modal("hide"); //닫기
        $('#myModal').on('hidden.bs.modal', function () {

            $("#ma_id").val($('input[name="modal_mb_id"]:checked').val());
            $("#td_ma_id").html($('input[name="modal_mb_id"]:checked').val());
            $("input:radio[name='modal_mb_id']").attr("checked", false);
            $("#cw_step").val("1");
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
    
    function car_file_open() {

    }



</script>

<?php
include_once('./admin.tail.php');
?>
