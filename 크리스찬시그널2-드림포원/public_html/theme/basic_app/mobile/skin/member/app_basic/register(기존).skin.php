<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>

<!-- 알림사항 모달팝업 -->
<div id="basic_modal">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fas fa-map-marker-exclamation"></i> 알림사항</h4>
            </div>
            <div class="modal-body">
                가입자격 조건을 읽어보시고 모두 체크해 주세요.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">확인</button>
            </div>
        </div>
    </div>
</div>
</div><!--basic_modal-->
<!-- 알림사항 모달팝업 -->


<div class="mbskin agr_check">

<form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">

    <h2 class="title_top">크리스천 시그널<strong><span class="point">가입자격</span>을 확인합니다.</strong></h2>
    <h3 class="stitle">회원가입을 위한 필수 확인요건입니다. 아래 영역을 모두 체크해 주세요.</h3>

    <div id="join_agr">
        <h2 class="hide">가입자격 체크</h2>
        <div class="join_point">
            <div class="chk_ico" data-for="rept1">
                <input type="checkbox" name="rept[]" id="rept1" value="0" onclick="ag_check(this)">
                <label for="rept1"><strong>미혼</strong> 크리스천입니다. (20~49세 가입가능)</label>
                <div class="pnt">* <span>혼인이력</span> 있거나 <span>현재 교제 중</span>인 분은<strong>가입 불가</strong></div>
            </div>

            <div class="chk_ico" data-for="rept2">
                <input type="checkbox" name="rept[]" id="rept2" value="0" onclick="ag_check(this)">
                <label for="rept2"><strong>건강한 교회</strong>에 소속된 성도입니다.</label>
                <div class="pnt">* 신천지, 다락방 등 <span>이단</span>으로 규정된 단체의 신자는<strong>가입 불가</strong></div>
            </div>

            <div class="chk_ico" data-for="rept3">
                <input type="checkbox" name="rept[]" id="rept3" value="0" onclick="ag_check(this)">
                <label for="rept3"><strong>진실한 만남</strong>을 위해 기도하고 있습니다.</label>
                <div class="pnt">* 상대방을 존중하고 배려하는 <span>매너를 갖추지 못한 분</span>은<strong>가입 불가</strong></div>
            </div>
        </div>
    </div><!--//join_chk-->

    <div class="btn_confirm">
        <input type="submit" class="btn_submit btn btn-primary btn-lg" value="가입신청하기">
    </div>

</form>

<script>
function ag_check(obj) {
    if (obj.value == "0") {
        obj.value = "1";
    } else {
        obj.value = "0";
    }
}

function fregister_submit(f) {
    // 가입 자격 확인
    if ($("#rept1").prop("checked") == false || $("#rept2").prop("checked") == false || $("#rept3").prop("checked") == false) {
        $('#myModal').modal('show');
        return false;
    }

    return true;
}
</script>

</div>