<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<form id="fprofile" name="fprofile" method="post" action="./profile_event_update.php">
<div class="greet01 mb_gt info">
    <h2 class="title"><strong>나만의 프로필</strong> 작성해보기</h2>
    <div class="my_info">
        <div class="mg info"><img src="../theme/basic_app/img/app/sg04.png"></div>
        <div class="form-group">
            <h3 class="sts">좋아하는 색</h3>
            <div class="selc_box cf">
                <span><input type="radio" name="color" id="color_1" value="1" class="m_info" checked=""><label for="color_1">빨간색</label></span>
                <span><input type="radio" name="color" id="color_2" value="2" class="m_info"><label for="color_2">파란색</label></span>
                <span><input type="radio" name="color" id="color_3" value="3" class="m_info"><label for="color_3">노란색</label></span>
                <span><input type="radio" name="color" id="color_4" value="4" class="m_info"><label for="color_4">초록색</label></span>
                <span><input type="radio" name="color" id="color_5" value="5" class="m_info"><label for="color_5">보라색</label></span>
            </div>
        </div>

        <div class="form-group">
            <h3 class="sts">좋아하는 꽃</h3>
            <div class="selc_box cf">
                <span><input type="radio" name="flower" id="fw_1" value="1" class="m_info" checked=""><label for="fw_1">장미</label></span>
                <span><input type="radio" name="flower" id="fw_2" value="2" class="m_info"><label for="fw_2">튤립</label></span>
                <span><input type="radio" name="flower" id="fw_3" value="3" class="m_info"><label for="fw_3">백합</label></span>
                <span><input type="radio" name="flower" id="fw_4" value="4" class="m_info"><label for="fw_4">라일락</label></span>
                <span><input type="radio" name="flower" id="fw_5" value="5" class="m_info"><label for="fw_5">해바라기</label></span>
                <span><input type="radio" name="flower" id="fw_6" value="6" class="m_info"><label for="fw_6">수선화</label></span>
                <span><input type="radio" name="flower" id="fw_7" value="7" class="m_info"><label for="fw_7">개나리</label></span>
                <span><input type="radio" name="flower" id="fw_8" value="8" class="m_info"><label for="fw_8">안개꽃</label></span>
                <span><input type="radio" name="flower" id="fw_9" value="9" class="m_info"><label for="fw_9">민들레</label></span>
                <span><input type="radio" name="flower" id="fw_10" value="10" class="m_info"><label for="fw_10">진달래</label></span>
            </div>
        </div>

        <div class="form-group">
            <h3 class="sts">좋아하는 스포츠</h3>
            <div class="selc_box cf">
                <span><input type="radio" name="sports" id="spt_1" value="1" class="m_info" checked=""><label for="spt_1">야구</label></span>
                <span><input type="radio" name="sports" id="spt_2" value="2" class="m_info"><label for="spt_2">축구</label></span>
                <span><input type="radio" name="sports" id="spt_3" value="3" class="m_info"><label for="spt_3">농구</label></span>
                <span><input type="radio" name="sports" id="spt_4" value="4" class="m_info"><label for="spt_4">골프</label></span>
                <span><input type="radio" name="sports" id="spt_5" value="5" class="m_info"><label for="spt_5">수영</label></span>
                <span><input type="radio" name="sports" id="spt_6" value="6" class="m_info"><label for="spt_6">볼링</label></span>
                <span><input type="radio" name="sports" id="spt_7" value="7" class="m_info"><label for="spt_7">테니스</label></span>
                <span><input type="radio" name="sports" id="spt_8" value="8" class="m_info"><label for="spt_8">배드민턴</label></span>
                <span><input type="radio" name="sports" id="spt_9" value="9" class="m_info"><label for="spt_9">탁구</label></span>
                <span><input type="radio" name="sports" id="spt_10" value="10" class="m_info"><label for="spt_10">자전거</label></span>
            </div>
        </div>

        <div class="form-group">
            <h3 class="sts">연령대</h3>
            <div class="selc_box cf">
                <span><input type="radio" name="age" id="age_1" value="1" class="m_info" checked=""><label for="age_1">20대</label></span>
                <span><input type="radio" name="age" id="age_2" value="2" class="m_info"><label for="age_2">30대</label></span>
                <span><input type="radio" name="age" id="age_3" value="3" class="m_info"><label for="age_3">40대</label></span>
                <span><input type="radio" name="age" id="age_4" value="4" class="m_info"><label for="age_4">50대</label></span>
            </div><!--selc-->
        </div>

        <div class="form-group">
            <h3 class="sts">사시는 지역</h3>
            <div class="selc_box cf">
                <span><input type="radio" name="area" id="area_1" value="1" class="m_info" checked=""><label for="area_1">서울</label></span>
                <span><input type="radio" name="area" id="area_2" value="2" class="m_info"><label for="area_2">부산</label></span>
                <span><input type="radio" name="area" id="area_3" value="3" class="m_info"><label for="area_3">대구</label></span>
                <span><input type="radio" name="area" id="area_4" value="4" class="m_info"><label for="area_4">인천</label></span>
                <span><input type="radio" name="area" id="area_5" value="5" class="m_info"><label for="area_5">광주</label></span>
                <span><input type="radio" name="area" id="area_6" value="6" class="m_info"><label for="area_6">대전</label></span>
                <span><input type="radio" name="area" id="area_7" value="7" class="m_info"><label for="area_7">울산</label></span>
                <span><input type="radio" name="area" id="area_8" value="8" class="m_info"><label for="area_8">세종</label></span>
                <span><input type="radio" name="area" id="area_9" value="9" class="m_info"><label for="area_9">경기</label></span>
                <span><input type="radio" name="area" id="area_10" value="10" class="m_info"><label for="area_10">강원</label></span>
                <span><input type="radio" name="area" id="area_11" value="11" class="m_info"><label for="area_11">충북</label></span>
                <span><input type="radio" name="area" id="area_12" value="12" class="m_info"><label for="area_12">충남</label></span>
                <span><input type="radio" name="area" id="area_13" value="13" class="m_info"><label for="area_13">전북</label></span>
                <span><input type="radio" name="area" id="area_14" value="14" class="m_info"><label for="area_14">전남</label></span>
                <span><input type="radio" name="area" id="area_15" value="15" class="m_info"><label for="area_15">경북</label></span>
                <span><input type="radio" name="area" id="area_16" value="16" class="m_info"><label for="area_16">경남</label></span>
                <span><input type="radio" name="area" id="area_17" value="17" class="m_info"><label for="area_17">제주</label></span>
            </div><!--selc-->
        </div>

        <div class="form-group">
            <h3 class="sts">연락처 입력<span>연락처를 남겨주시면 자세한 상담 드리겠습니다^^</span></h3>
            <div>
                <input type="tel" name="tel" value="" id="tel" class="txt_info" maxlength="13" placeholder="연락처를 입력해 주세요" onkeyup="inputPhoneNumber(this);">
            </div><!--selc-->
        </div>

        <div class="form-group mg_none">
            <div class="fine"><a href="javascript:void(0);" onclick="form_submit();">작성완료</a></div>
        </div>

    </div><!--my_info-->
</div><!--greet01 mb_gt-->
</form>

<script>
function form_submit() {
    if($.trim($('#tel').val()).length == 0) {
        swal('연락처를 입력해주세요.');
        return false;
    }

    $('#fprofile').submit();
}

//휴대전화 '-'자동생성
function inputPhoneNumber(obj) {
    var number = obj.value.replace(/[^0-9]/g, "");
    var phone = "";

    if(number.length < 4) {
        return number;
    } else if(number.length < 7) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3);
    } else if(number.length < 11) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 3);
        phone += "-";
        phone += number.substr(6);
    } else {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 4);
        phone += "-";
        phone += number.substr(7);
    }
    obj.value = phone;
}
</script>