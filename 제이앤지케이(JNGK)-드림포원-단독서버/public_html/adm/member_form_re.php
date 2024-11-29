<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$mb_no = $_GET['mb_no'];

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '등록';
}
else if ($w == 'u')
{
    $mb = get_member_no($mb_no);
    /*if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');*/

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '등록';

    for($i=0; $i<count($mb); $i++) {
        $mb[array_values($mb)[$i]] = get_text($mb[array_values($mb)[$i]]);
    }
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

// 각 센터 신용카드, 체크카드에 대한 수수료 정보
$sql = " select * from g5_center_fees where center_code = '{$member['center_code']}' ";
$fees = sql_fetch($sql);
$credit_card_fees = $fees['credit_card_fees'];
$check_card_fees = $fees['check_card_fees'];

$g5['title'] .= '회원'.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_javascript('<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>', 0);
//add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<style>
    .readonly { background: #f2f2f2 !important; }
</style>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<!--<input type="hidden" name="mb_state" value="<?/*=$mb['mb_state']*/?>">-->
<input type="hidden" name="mb_level" value="<?=$mb['mb_level']?>">
<input type="hidden" name="del_mb_img" value="">
<input type="hidden" name="mb_no" value="<?=$mb['mb_no']?>">
<input type="hidden" name="mb_re_reg_date" value="Y">

<div id="adm_mw_box">
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_5">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_state">회원 상품 구분<?php echo $sound_only ?></label></th>
                <td>
                 <div class="checks">
                    <input type="radio" id="state1" name="mb_state" value="re_member" checked>
                    <label for="state1">재등록회원</label>
                 </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="tbl_frm01 tbl_wrap member_state new_member">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_5">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="mb_center">센터/아카데미<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="mb_center" value="<?php echo $member['mb_center'] ?>" id="mb_center" class=" frm_input readonly" size="30" readonly><br>
            <?php
            $center_code = sql_fetch(" select center_code from g5_center where center_name = '{$member['mb_center']}' ")['center_code'];
            ?>
            <input type="hidden" name="center_code" id="center_code" value="<?=$center_code?>">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="pro_mb_no">담당프로<?php echo $sound_only ?></label></th>
        <td>
        <?php if($member['mb_level'] == 8) { ?> <!-- 프로 로그인 시 담당 프로 고정 -->
            <input type="text" name="mb_charge_pro_name" value="<?php echo $member['mb_name'] ?>" id="mb_charge_pro_name" class=" frm_input readonly" size="30" readonly>
            <input type="hidden" name="pro_mb_no" value="<?php echo $member['mb_no'] ?>" id="pro_mb_no">
            <br>
        <?php } ?>
        <?php if($member['mb_level'] == 9) { ?>
            <select class="frm_select" name="pro_mb_no" id="pro_mb_no">
                <option value="">이름 선택</option>
                <?php
                $sql = " select * from {$g5['member_table']} where mb_category = '프로' and mb_center = '{$member['mb_center']}' and (pro_leave_date = '0000-00-00' or pro_leave_date > date_format(now(), '%Y-%m-%d')) ";
                $result = sql_query($sql);

                for($i=0; $row=sql_fetch_array($result); $i++) {
                    $selected = '';
                    if($mb['pro_mb_no'] == $row['mb_no']) { $selected = 'selected'; } // 담당프로 자동 선택
                    ?>
                    <option value="<?=$row['mb_no']?>" <?=$selected?>><?=$row['mb_name']?></option>
                <?php } ?>
            </select>
        <?php } ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_goods_name">레슨정보<?php echo $sound_only ?></label></th>
        <td>
            <select class="frm_select frm_sel" name="lesson_idx" id="lesson_idx">
                <option value="">레슨 선택</option>
                <?php
                $sql = " select le.* from g5_lesson as le left join g5_center ce on ce.center_code = le.center_code where ce.center_name = '{$member['mb_center']}' and le.use_yn = 'Y' ";
                $result = sql_query($sql);

                for($i=0; $row=sql_fetch_array($result); $i++) {
                ?>
                <option value="<?=$row['idx']?>"><?=$row['lesson_name']?> / <?=$row['lesson_time']?> / <?=$row['lesson_count']?> / <?=number_format($row['lesson_price'])?></option>
                <?php } ?>
            </select>
            <p>원하시는 레슨형태를 선택해주세요</p>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="lesson_start_date">레슨시작일<strong class="sound_only">필수</strong></label>
        </th>
        <td>
            <input type="date" name="lesson_start_date" value="" id="lesson_start_date"  class="frm_input"><!-- 일자 -->
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_goods_name">결제정보<?php echo $sound_only ?></label></th>
        <td>
            <div class="checks">
                <input type="radio" id="pay_cash" name="pay_option" value="현금" checked <?php if($mb['pay_option'] == '현금') echo 'checked="checked"'; ?>>
                <label for="pay_cash">현금</label>
                <input type="radio" id="pay_card" name="pay_option" value="신용카드" <?php if($mb['pay_option'] == '신용카드') echo 'checked="checked"'; ?>>
                <label for="pay_card">신용카드</label>
                <input type="radio" id="pay_check_card" name="pay_option" value="체크카드" <?php if($mb['pay_option'] == '체크카드') echo 'checked="checked"'; ?>>
                <label for="pay_check_card">체크카드</label>
                <input type="radio" id="pay_cash_credit_card" name="pay_option" value="현금+신용카드" <?php if($mb['pay_option'] == '현금+신용카드') echo 'checked="checked"'; ?>>
                <label for="pay_cash_credit_card">현금+신용카드</label>
                <input type="radio" id="pay_cash_check_card" name="pay_option" value="현금+체크카드" <?php if($mb['pay_option'] == '현금+체크카드') echo 'checked="checked"'; ?>>
                <label for="pay_cash_check_card">현금+체크카드</label>
            </div><!--.checks-->
            <span class="cash"><input type="text" name="cash_price" value="<?php echo empty($mb['cash_price']) ? '' : number_format($mb['cash_price']) ?>" id="cash_price"  class="required frm_input" size="30" placeholder="금액(현금)" style="margin-bottom: 5px;text-align: right;" onkeyup="add_comma(this);" onblur="price_cal('re_member','cash', this.value);">원<br></span>
            <span class="card" style="display: none;"><input type="text" name="card_price" value="<?php echo empty($mb['credit_card_price']) ? number_format($mb['check_card_price']) : number_format($mb['credit_card_price']) ?>" id="card_price"  class="required frm_input" size="30" placeholder="금액(카드)" style="margin-bottom: 5px;text-align: right;" onkeyup="add_comma(this);" onblur="price_cal('new_member','card', this.value);">원<br></span>
            <input type="text" name="fees" value="<?php echo $mb['fees'] ?>" id="fees" class="frm_input readonly" size="30" placeholder="수수료" style="margin-bottom: 5px;text-align: right;" onkeyup="add_comma(this);" readonly>원<br>
            <span class="company" style="display: none;"><input type="text" name="card_company" value="<?php echo $mb['card_company'] ?>" id="card_company" required class="required frm_input" size="30" placeholder="카드사" style="margin-bottom: 5px;"><br></span>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_info">개인정보<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="30" minlength="2" maxlength="20" placeholder="이름" style="margin-bottom: 5px;"><br>
            <input type="text" name="mb_hp1" value="<?php echo explode('-', $mb['mb_hp'])[0] ?>" id="mb_hp1" required class="required frm_input" size="5" maxlength="3" placeholder="ex)010" style="margin-bottom: 5px;" onkeyup="number_check(this)"> -
            <input type="text" name="mb_hp2" value="<?php echo explode('-', $mb['mb_hp'])[1] ?>" id="mb_hp2" required class="required frm_input" size="5" maxlength="4" placeholder="ex)1234" style="margin-bottom: 5px;" onkeyup="number_check(this)"> -
            <input type="text" name="mb_hp3" value="<?php echo explode('-', $mb['mb_hp'])[2] ?>" id="mb_hp3" required class="required frm_input" size="5" maxlength="4" placeholder="ex)1234" style="margin-bottom: 5px;" onkeyup="number_check(this)"><br>
            <input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100"  class=" frm_input email" size="30" placeholder="E-mail" style="margin-bottom: 5px;"><br>
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" maxlength="100"  class=" frm_input frm_add" size="50" placeholder="주소" style="margin-bottom: 5px;" onclick="sample2_execDaumPostcode()">
            <input type="button" value="우편번호" class="btn" style="margin-bottom: 5px;" onclick="sample2_execDaumPostcode()"><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" maxlength="100"  class=" frm_input frm_add" size="50" placeholder="상세주소">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_birth">생년월일<strong class="sound_only">필수</strong></label></th>
        <td>
            <!--<input type="text" name="mb_birth" id="mb_birth" value="<?/*=$mb['mb_birth']*/?>" class=" frm_input" size="30">-->
            <select name="birth_year" id="birth_year" class="frm_select">
            </select>
            <select name="birth_month" id="birth_month" class="frm_select">
            </select>
            <select name="birth_day" id="birth_day" class="frm_select">
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_recommend">추천인<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_recommend" value="<?php echo $mb['mb_recommend'] ?>" id="mb_recommend" maxlength="100"  class=" frm_input" size="30" placeholder="추천인 회원명"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_img">회원사진<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="file" id="mb_img" name="mb_img[]" onchange="getImgPrev(this)" accept="image/*">
            <div id="mb_img_prev" class="img_prev_wrap">
            <?
            if ($w == "u") {
                $sql = " select * from g5_member_img where mb_no = '{$mb['mb_no']}' ";
                $file = sql_fetch($sql);

                if(!empty($file['img_file'])) {
            ?>
                <div class="prev_area mb_icon">
                    <input type="hidden" id="img_idx" name="img_idx" value="<?=$file['idx']?>">
                    <button type="button" class="btn_del" onclick="mbImgDel('u');" style="position: absolute;">X</button>
                    <div class="img_bd"><img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>" width="150px" height="150px"></div>
                </div>
            <?
                }
            }
            ?>
            </div>
        </td>
    </tr>
    <tr>
        <th scope="row" colspan="2"><label for="mb_career">골프 경력사항<p>(해당되는 문항에 체크해주세요)</p><strong class="sound_only">필수</strong></label></th>
    </tr>

    <tr>
        <td colspan="2">
        <div class="golf_box">
            <div class="golf_box_li">
                <label for="score" class="golf_box_t">점수</label>

                <div class="checks">
                <input type="radio" id="score1" name="mb_score" value="81↓" checked <?php if($mb['mb_score'] == '81↓') echo 'checked="checked"'; ?>>
                <label for="score1">81↓</label>
                <input type="radio" id="score2" name="mb_score" value="82~90" <?php if($mb['mb_score'] == '82~90') echo 'checked="checked"'; ?>>
                <label for="score2">82~90</label>
                <input type="radio" id="score3" name="mb_score" value="91~99" <?php if($mb['mb_score'] == '91~99') echo 'checked="checked"'; ?>>
                <label for="score3">91~99</label>
                <input type="radio" id="score4" name="mb_score" value="100~108" <?php if($mb['mb_score'] == '100~108') echo 'checked="checked"'; ?>>
                <label for="score4">100~108</label>
                <input type="radio" id="score5" name="mb_score" value="109" <?php if($mb['mb_score'] == '109') echo 'checked="checked"'; ?>>
                <label for="score5">109</label>
                </div>
            </div>
            <div class="golf_box_li">
                <label for="career" class="golf_box_t">골프 경력</label>
                <div class="checks">
                <input type="radio" id="career1" name="mb_career" value="초보" checked <?php if($mb['mb_career'] == '초보') echo 'checked="checked"'; ?>>
                <label for="career1">초보</label>
                <input type="radio" id="career2" name="mb_career" value="1년 이하" <?php if($mb['mb_career'] == '1년 이하') echo 'checked="checked"'; ?>>
                <label for="career2">1년 이하</label>
                <input type="radio" id="career3" name="mb_career" value="1~3년" <?php if($mb['mb_career'] == '1~3년') echo 'checked="checked"'; ?>>
                <label for="career3">1~3년</label>
                <input type="radio" id="career4" name="mb_career" value="3~5년" <?php if($mb['mb_career'] == '3~5년') echo 'checked="checked"'; ?>>
                <label for="career4">3~5년</label>
                <input type="radio" id="career5" name="mb_career" value="5년 이상" <?php if($mb['mb_career'] == '5년 이상') echo 'checked="checked"'; ?>>
                <label for="career5">5년 이상</label>
                </div>
            </div>
            <div class="golf_box_li">
                <label for="lesson" class="golf_box_t">레슨 경험</label>
                <div class="checks">
                <input type="radio" id="lesson1" name="mb_lesson" value="있다" checked <?php if($mb['mb_lesson'] == '있다') echo 'checked="checked"'; ?>>
                <label for="lesson1">있다</label>
                <input type="radio" id="lesson2" name="mb_lesson" value="없다" <?php if($mb['mb_lesson'] == '없다') echo 'checked="checked"'; ?>>
                <label for="lesson2">없다</label>
                <span style="margin-left: 20px;"></span><label for="lesson">만약 있다면 : <input type="text" class="frm_input" name="mb_lesson_de" size="5" value="<?=$mb['mb_lesson_de']?>"> 개월 정도</label>
                </div>
            </div>
            <div class="golf_box_li">
                <label for="rounding" class="golf_box_t">평균 라운딩 수</label>
                <div class="checks">
                <input type="radio" id="rounding1" name="mb_rounding" value="2번 이상/주" checked <?php if($mb['mb_rounding'] == '2번 이상/주') echo 'checked="checked"'; ?>>
                <label for="rounding1">2번 이상/주</label>
                <input type="radio" id="rounding2" name="mb_rounding" value="1번/주" <?php if($mb['mb_rounding'] == '1번/주') echo 'checked="checked"'; ?>>
                <label for="rounding2">1번/주</label>
                <input type="radio" id="rounding3" name="mb_rounding" value="1~2번/월" <?php if($mb['mb_rounding'] == '1~2번/월') echo 'checked="checked"'; ?>>
                <label for="rounding3">1~2번/월</label>
                <input type="radio" id="rounding4" name="mb_rounding" value="1번 이하/월" <?php if($mb['mb_rounding'] == '1번 이하/월') echo 'checked="checked"'; ?>>
                <label for="rounding4">1번 이하/월</label>
                </div>
            </div>
        </div><!--.golf_box-->
        </td>
    </tr>

    <tr>
        <th scope="row" colspan="2" class="th_pln"><label for="mb_wish">가장 개선하고 싶은 부분이나 담당 프로에게 바라는 점<strong class="sound_only">필수</strong></label></th>
    </tr>

    <tr>
        <td colspan="2"><textarea name="mb_wish" id="mb_wish" class="frm_text" placeholder="회원님의 희망사항을 알려주세요!" rows="3"></textarea></td>
    </tr>

    <tr>
        <th scope="row" colspan="2" class="th_pln"><label for="mb_wish">이용약관 및 회원 준수 사항<p>(약관의 동의가 필요합니다)</p><strong class="sound_only">필수</strong></label></th>
    </tr>

    <tr>
        <td colspan="2">
            <textarea class="frm_text" style="margin-bottom: 5px;" readonly><?=$config['cf_stipulation']?></textarea><br>
            <input type="checkbox" name="agree_chk" id="agree" value="Y"> <label for="agree" style="margin-bottom: unset;">이용약관 및 회원 준수사항에 동의합니다.</label>
        </td>
    </tr>

    <tr>
        <th scope="row" colspan="2" class="th_pln"><label for="mb_notice">Notice<strong class="sound_only">필수</strong></label></th>
    </tr>
    <tr>
        <td colspan="2"><textarea placeholder="메모할 내용을 입력하세요." name="mb_notice" class="frm_text" ></textarea></td>
    </tr>
    </tbody>
    </table>

</div><!--#adm_mw_box-->

<div class="adm_mw_btn">
    <!--<input type="submit" value="확인" class="btn_submit" accesskey='s'>-->
    <input type="button" class="btn_adm_ok" id="btn" value="재등록하기" onclick="form_ajax();">
    <!--<a href="./member_list.php?<?php /*echo $qstr */?>">목록</a>-->
    <a href="<?=G5_ADMIN_URL?>/member_list.php" class="btn_adm_cancel">취소하기</a>
</div><!--.adm_mw_btn-->
</form>

<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <i class="fas fa-times-square" id="btnCloseLayer" style="width:40px; height:40px; color:#000; font-size:2.2em; cursor:pointer;position:absolute;right:-15px;bottom:-15px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></i>
</div>

<!-- autocomplete -->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<!-- autocomplete -->
<script>
$(function() {
    // 회원 사진
    if('<?=$file['img_file']?>' != '') {
        $('#mb_img').attr('style', 'display:none;');
    }

    selectDate('<?=$mb['mb_birth']?>');

    // 결제 방식 선택
    $("input:radio[name='pay_option']").change(function() {
        var option = $(this).val();

        $('.cash input').val('');
        $('.card input').val('');
        $('.company input').val('');
        $('#fees').val('');

        if(option == '현금') {
            $('.cash').show();
            $('.card').hide();
            $('.company').hide();
        } else if(option == '신용카드' || option == '체크카드') {
            $('.cash').hide();
            $('.card').show();
            $('.company').show();
        } else {
            $('.cash').show();
            $('.card').show();
            $('.company').show();
        }
    });
});

var element_layer = document.getElementById('layer');
function closeDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    element_layer.style.display = 'none';
}

function sample2_execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                // document.getElementById("sample2_extraAddress").value = extraAddr;

            } else {
                // document.getElementById("sample2_extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            // document.getElementById('sample2_postcode').value = data.zonecode;
            document.getElementById("mb_addr1").value = addr +' '+extraAddr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("mb_addr2").focus();

            // iframe을 넣은 element를 안보이게 한다.
            // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            element_layer.style.display = 'none';
        },
        width : '100%',
        height : '100%',
        maxSuggestItems : 5
    }).embed(element_layer);

    // iframe을 넣은 element를 보이게 한다.
    element_layer.style.display = 'block';

    // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
    initLayerPosition();
}

// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
function initLayerPosition(){
    var width = "450"; //우편번호서비스가 들어갈 element의 width 350
    var height = "500"; //우편번호서비스가 들어갈 element의 height 400
    var borderWidth = 1; //샘플에서 사용하는 border의 두께

    // 위에서 선언한 값들을 실제 element에 넣는다.
    element_layer.style.width = width + 'px';
    element_layer.style.height = height + 'px';
    element_layer.style.border = borderWidth + 'px solid';
    // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
    element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
    element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}

// 파일업로드 미리보기
var filesTempArr = [];
var file_idx = 0;
function getImgPrev(input) {
    var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp)$/;

    if (!reg_ext.test(input.files[0].name)) {
        alert("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
        return false;
    }

    // 최대용량 체크
    var	max_size_mb = 5, //5mb
        max_byte = max_size_mb * 1024 * 1024,
        file_byte = input.files[0].size;

    if (file_byte > max_byte) {
        alert("최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
        $("#mb_img").val("");
        return false;
    }

    var files = input.files;
    var files_arr = Array.prototype.slice.call(files);

    for (var i = 0; i<input.files.length; i++) {
        filesTempArr.push(files_arr[i]);
    }

    // 미리보기
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var src = e.target.result;
            var html = '<div class="prev_area mb_icon">';
            html += '<input type="hidden" id="img_idx" name="img_idx">';
            html += '<button type="button" class="btn_del" onclick="mbImgDel(\'w\');" style="position: absolute;">X</button>';
            html += '<div class="img_bd">';
            html += '<img src="'+ src +'" width="150px" height="150px">';
            html += '</div>';
            html += '</div>';

            $("#mb_img_prev").html('').append(html);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

var del_file_idx = '';
function mbImgDel(mode) {
    if (confirm("이미지를 삭제하시겠습니까?")) {
        if (mode == "u") {
            if($('#img_idx').val() != '') {
                del_file_idx += $('#img_idx').val() + ',';
            }
            // document.fmember.del_mb_img.value = "1";
        } else if (mode == "w") {
            $("#mb_img").val("");
            $("#mb_img").replaceWith($("#mb_img").clone(true));
        }

        $("#mb_img_prev").html("");
        delete filesTempArr[0]; // 파일 여러개 업로드 시 0 수정 필요
        $('#mb_img').attr('style', 'display:block;');
    }
}

function fmember_submit(f)
{
    return true;
}

var is_post = false; // 중복 post 체크
function form_ajax() {
    if(is_post) {
        return false;
    }
    is_post = true;

    // 유효성 체크 =============================================

    var state = $('input:radio[name=mb_state]:checked').val();
    // console.log(state);

    // === 재등록회원 ===
    if(state == 're_member') {
        if($('#pro_mb_no').val() == '') {
            alert('담당프로를 선택하세요.');
            is_post = false;
            return false;
        }
        if($('#lesson_idx').val() == '') {
            alert('레슨을 선택하세요.');
            is_post = false;
            return false;
        }
        if($('#lesson_start_date').val() == '') {
            alert('레슨시작일을 입력하세요.');
            is_post = false;
            return false;
        }
        var pay = $('input:radio[name=pay_option]:checked').val();
        if(pay == '현금') {
            if($('#cash_price').val() == '') {
                alert('금액을 입력하세요.');
                is_post = false;
                return false;
            }
        }
        else if(pay == '신용카드' || pay == '체크카드') {
            if($('#card_price').val() == '') {
                alert('금액을 입력하세요.');
                is_post = false;
                return false;
            }
            if($('#card_company').val() == '') {
                alert('카드사를 입력하세요.');
                is_post = false;
                return false;
            }
        }else {
            if($('#cash_price').val() == '') {
                alert('금액(현금)을 입력하세요.');
                is_post = false;
                return false;
            }
            if($('#card_price').val() == '') {
                alert('금액(카드)을 입력하세요.');
                is_post = false;
                return false;
            }
            if($('#card_company').val() == '') {
                alert('카드사를 입력하세요.');
                is_post = false;
                return false;
            }
        }
        // if($('#fees').val() == '') {
        //     alert('수수료를 입력하세요.');
        //     return false;
        // }
        if($('#mb_name').val() == '') {
            alert('이름을 입력하세요.');
            is_post = false;
            return false;
        }
        if($('#mb_hp1').val() == '' || $('#mb_hp2').val() == '' || $('#mb_hp3').val() == '') {
            alert('휴대폰번호를 입력하세요.');
            is_post = false;
            return false;
        }
        // 이용약관 동의 확인
        var agree = $('input:checkbox[name=agree_chk]:checked').val();
        if(agree != 'Y') {
            alert('이용약관 및 회원 준수사항에 동의해주세요.');
            is_post = false;
            return false;
        }

        // 레슨 상품 금액 확인 (결제정보에 입력한 금액과 일치하는지)
        if (!lessonPriceCheck()) {
            is_post = false;
            return false;
        }
    }
    // === 재등록회원 ===

    // 유효성 체크 =============================================

    var duplicate_check = true;
    $.ajax({
        url: g5_admin_url + "/ajax.member_duplicate.php",
        data: {
            mb_name: $('#mb_name').val(),
            center_code: $('#center_code').val(),
            pro_mb_no: $('#pro_mb_no').val(),
        },
        type: 'POST',
        async: false,
        success: function (data) {
            if (data != 0) {
                if (confirm("동일한 정보가 있습니다. 그래도 저장하시겠습니까?")) {
                } else {
                    duplicate_check = false;
                }
            }
        },
    });

    if (!duplicate_check) {
        is_post = false;
        return false;
    }

    // 회원 사진 삭제 체크
    $('input[name=del_mb_img]').val(del_file_idx.slice(0,-1));

    var form = $('form')[0];
    var formData = new FormData(form);

    for (var i = 0; i < filesTempArr.length; i++) {
        formData.append("file[]", filesTempArr[i]);
    }

    $.ajax({
        url : g5_admin_url + "/member_form_update.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success : function(data) {
            if(data){
                alert('저장되었습니다.');
                // location.replace(g5_admin_url+'/member_form.php?sst=&sod=&sfl=&stx=&page=0&w=u&mb_no='+data);
                location.replace(g5_admin_url+'/member_list.php');
            }
        },
    });
}

// 생년월일 선택
function selectDate(data) {
    var toDay = new Date();
    var year  = toDay.getFullYear();
    var month = (toDay.getMonth()+1);
    var day   = toDay.getDate();

    // 년도 설정
    var select_year = "<option value=''>선택</option>";
    for (var i=year; i>=1900; i--) {
        select_year += "<option value='" + i + "' >" + i + "</option>";
    }
    $('#birth_year').html(select_year);

    // 월,일 설정
    var select_month = "<option value=''>선택</option>";
    var select_day = "<option value=''>선택</option>";
    for (var i=1; i<=31; i++) {
        var val = "";
        if (i < 10) {
            val = "0" + new String(i);
        } else {
            val = new String(i);
        }

        if (i < 13) {
            select_month += "<option value='" + val + "'>" + val + "</option>";
        }

        select_day += "<option value='" + val + "'>" + val + "</option>";
    }
    $('#birth_month').html(select_month);
    $('#birth_day').html(select_day);

    // 금일 세팅
    /*$("#birth_year").val(year);
    $("#birth_month").val(month);
    $("#birth_day").val(day);*/

    if(data != '') {
        var birth = data.split('.');
        $("#birth_year").val(birth[0]);
        $("#birth_month").val(birth[1]);
        $("#birth_day").val(birth[2]);
    }
}

function searchMember() {
    $.ajax({
        type: 'POST',
        url: g5_admin_url + "/ajax.search_member.php",
        dataType: 'json',
        data: {
            member: $('#search_member').val(),
        },
        success: function (data) {
            if(data.length > 0) {
                var html = '';
                for(var i=0; i<data.length; i++) {
                    var url = g5_admin_url+'/member_form_re.php';

                    html += '<a href="'+url+'" style="cursor: pointer;text-decoration: none;">';
                    html += '<div class="search_mr_box">';
                    html += '<span class="smb">'+data[i]['mb_id_no']+'</span>';
                    html += '<span class="smb">'+data[i]['mb_name']+'</span>';
                    if(data[i]['mb_birth'] != '') {
                        html += '<span class="smb_birth">생년월일 '+data[i]['mb_birth']+'</span>';
                    }
                    html += '</div>';
                    html += '</a>';
                }

                $('#search_member_result').html(html);
            }
            else {
                $('#search_member_result').html('검색된 회원이 없습니다.');
            }
        },
    });

    /*$('#search_member').autocomplete({
        source: function (request, response) { // 자동 완성 대상
            $.ajax({
                type: 'POST',
                url: g5_admin_url + "/ajax.search_member.php",
                dataType: 'json',
                data: {
                    member: $('#search_member').val(),
                },
                success: function (data) {
                    response(
                        $.map(data, function (item) {
                            return {
                                label: item.mb_name, // UI에 보여지는 글자
                                mb_name: item.mb_name,
                            }
                        })
                    )
                }
            });
        },
        select: function (event, ui) { // 아이템 선택 시
        },
        focus: function (event, ui) { // 포커스
            return false; // 한글 에러 잡는 용도로 사용
        },
    });*/
}


//휴대전화 '-'자동생성
function inputPhoneNumber(obj) {
    var number = obj.value.replace(/[^0-9]/g, "");
    var phone = "";

    if(number.length < 4) {
        return number;
    } else if(number.length < 8) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3);
    } else if(number.length < 12) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 4);
        phone += "-";
        phone += number.substr(7);
    } else {
        phone += number.substr(0, 4);
        phone += "-";
        phone += number.substr(4, 4);
        phone += "-";
        phone += number.substr(8);
    }
    obj.value = phone;
}

// 금액 천단위 콤마
function add_comma(data) {
    var price = data.value;
    price = price.replaceAll(/,/gi, "");
    $('#'+data.id).val(number_format(price));
}

function getToday(){
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;    //1월이 0으로 되기때문에 +1을 함.
    var date = now.getDate();

    return year + "-" + addZero(month) + "-" + addZero(date);
}

function addZero(num) {
    return (num < 10) ? '0' + num : num;
}

// 예약 시간 선택 (예약시간, 프로예약정보idx)
function reser_select(reser_time, pro_info_idx) {
    // input type = 'radio' 처럼 동작
    $('input[type="checkbox"][name="ck_reser_time"]').prop('checked', false);
    $("input[name=ck_reser_time][value='" + reser_time + "']").prop("checked", true);

    $('#one_point_le_time').val(reser_time);
    $('#one_point_reser_time').val(reser_time); // formdata
}

// 입력한 금액에 따른 수수료 계산 -- DB g5_center_fees
function price_cal(state, option, price) {
    price = price.replace(/,/gi, "");

    var pay_option = $('input[name="pay_option"]:checked').val(); // 결제방법

    // *현금 수수료에 대한 내용 없음
    var fees = '';
    if(option == 'card') {
        if (pay_option == '신용카드' || pay_option == '현금+신용카드') {
            fees = price * '<?=$credit_card_fees?>' / 100;
        } else if (pay_option == '체크카드' || pay_option == '현금+체크카드') {
            fees = price * '<?=$check_card_fees?>' / 100;
        }

        fees = number_format(fees.toString());
        $('#fees').val(fees);
    }
}
</script>

<?php
include_once('./admin.tail.php');
?>
