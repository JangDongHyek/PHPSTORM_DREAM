$(function() {
    // 상태 변경
    var state = '';
    $("#sort_list li").click(function () {
        $('#sort_list li').removeClass('active');
        $(this).addClass('active');
        state = $(this)[0]['innerText'];

        if(state == 'Agreement Incomplete') { // 미체결 시 알림 모달
            $('#noConrirmModal').modal('show');
            $('#listModal').modal('hide');
        } else { // 미체결 외
            state_change($('#inquiry_idx').val(), state, 'N');
        }
    });
});

// 상태 변경 모달 (의뢰 idx, 의뢰 상태, 견적 개수, 견적 선택 여부)
function state_modal(idx, state, estimate_cnt, selection) {
    $('#inquiry_idx').val(idx);
    $('#sort_list li').removeClass('active');
    $('#sort_list li').hide();

    if(state == 'Processing Submission') { // 견적 있으면 견적검토중 or 거래완료 or 미체결 선택 / 견적 없으면 모달 X
        $('.li_check').show();
        $('.li_select').show();
        $('.li_no').show();
    }
    else if(state == 'Quotation Under Review') { // 거래완료 or 미체결 선택을 위한 대기 상태
        $('.li_wait').show();
        $('.li_select').show();
        $('.li_no').show();
    }
    else if(state == 'Transaction Complete') {
        $('.li_check').show();
        $('.li_wait').show();
        $('.li_no').show();
        /*if(selection != '') { // 거래 상대 회사 선택 완료 시 리뷰 작성 창
            //location.href = g5_bbs_url+'/mypage_company_detail01.php?idx='+idx;
        } else {
            $('.a_select').attr('href', g5_bbs_url+'/mypage_company_detail01.php?idx='+idx);
            $('#selectModal').modal('show');
        }*/
    }
    else if(state == 'Agreement Incomplete') {
        // 미체결 사유를 입력하였는지 확인 - 의뢰자가 미입력 시 등록, 견적 제출 회사는 조회
        getInquiryResult('no');
        $('#noModal').modal('show');
    }
    else if(state == 'dday') {
        var msg = '';
        if(estimate_cnt > 0) { // 접수된 견적은 있으나 선택 X
            msg = 'selected';
        } else { // 접수된 견적 X
            msg = 'received';
        }
        $('#finishModal .modal-body .txt .msg').text(msg);
        $('#finishModal').modal('show');
    }

    // 접수된 견적이 있고 선택된 견적이 없을 때 상태 변경 가능 && 미체결 아닐 시
    if(estimate_cnt > 0 && selection == 0 && state != 'Agreement Incomplete') {
        $('#listModal').modal('show');
    }

    $('#sort_list li').each(function () {
        if($(this)[0]['innerText'] == state) {
            $(this).addClass('active');
        }
    });
}

// 의뢰 상태 변경 (의뢰idx, 의뢰상태)
function state_change(idx, state) {
    $.ajax({
        url : g5_bbs_url + "/ajax.inquiry_state_change.php",
        data: {idx: idx, state: state},
        type: 'POST',
        success : function(data) {
            if(data) {
                $('#listModal').modal('hide');
                if(state != 'Transaction Complete' && state != 'Agreement Incomplete') {
                    swal('Status has changed.')
                        .then(()=>{
                            // mypage_company01_list();
                            // $('#listModal').modal('hide');
                            location.reload();
                        });
                }
                else if(state == 'Transaction Complete') {
                    $('.a_select').attr('href', g5_bbs_url+'/mypage_company_detail01.php?idx='+idx);
                    $('#selectModal').modal('show');
                }
                else if(state == 'Agreement Incomplete') {
                    getInquiryResult('no');
                    $('#noConrirmModal').modal('hide');
                    $('#noModal').modal('show');
                }
            }
        },
        error : function(err) {
            swal(err.status);
        }
    });
}

// 견적 마감일 시 견적기한 연장 여부 선택
function state_finish(state) {
    if(state == 'ok') {
        if($('#deadline_date').val() == '') {
            swal('Please enter a quote deadline.');
            return false;
        }
    }

    $.ajax({
        url : g5_bbs_url + "/ajax.inquiry_state_extend.php",
        data: {idx: $('#inquiry_idx').val(), state: state, date: $('#deadline_date').val()},
        type: 'POST',
        success : function(data) {
            if(data) {
                var msg = '';
                if(state == 'ok') {
                    msg = 'Quote has been extended.';
                } else {
                    msg = 'Quote has ended.';
                }
                swal(msg)
                    .then(()=>{
                        location.reload();
                    });
            }
        },
        error : function(err) {
            swal(err.status);
        }
    });
}

// 거래 미체결 사유 입력
function state_no() {
    // 전체 체크 순회
    var checkFlag = false;
    var value = '';
    $("input:checkbox[name=reason]").each(function() {
        if(this.checked) {
            checkFlag = true;
            value += this.value + ',';
        }
    });
    value = value.slice(0,-1);

    if(checkFlag) {
        $.ajax({
            url : g5_bbs_url + "/ajax.inquiry_review.php",
            data: {idx: $('#inquiry_idx').val(), checked: value, etc: $('#reason_etc').val(), mode: 'no'},
            type: 'POST',
            success : function(data) {
                if(data) {
                    swal('Reason entered.')
                        .then(()=>{
                            location.reload();
                        });
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
    else {
        swal('Please select a reason.');
        return false;
    }
}

// 거래 미체결 사유 / 리뷰 조회 -- 데이터 유무에 따라 모달창 다르게 표시
function getInquiryResult(mode) {
    // 모달 초기화
    $('#noModal .modal-header .close').attr('onclick', 'location.reload();');
    $('.writer').show();
    $('input:checkbox[name=reason]').attr('disabled', false);
    $("input:checkbox[name=reason]").each(function() {
        this.checked = false;
    });
    $('#reason_etc').attr('readonly', false).val('');

    $.ajax({
        url : g5_bbs_url + "/ajax.inquiry_result.php",
        data: {idx: $('#inquiry_idx').val(), mode: mode},
        type: 'POST',
        dataType: 'json',
        success : function(data) {
            if(data) {
                // 미체결 사유 데이터 있으면 조회
                $('.txt').show(); // 확인(창닫기) 버튼
                $('.writer').hide(); // 확인(작성) 버튼
                $('input:checkbox[name=reason]').attr('disabled', true);
                $("input:checkbox[name=reason]").each(function() {
                    if(data['review'].indexOf(this.value) != -1) {
                        this.checked = true;
                    }
                });
                $('#reason_etc').attr('readonly', true).val(data['review_etc']);

                $('#noModal .modal-header .close').attr('onclick', '');
            }
        },
        error : function(err) {
            swal(err.status);
        }
    });
}
