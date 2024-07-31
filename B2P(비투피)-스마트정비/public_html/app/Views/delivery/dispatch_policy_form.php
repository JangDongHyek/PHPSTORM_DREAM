<?php 
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "발송정책 관리";
?>
        <?php echo view('delivery/delivery_head', $this->data); ?>
        <div class="write_wrap">
            <div class="top_wrap">
                <h1>대표 발송정책 수정하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('delivery/dispatchPolicy')?>" class="btn btn-sm btn-gray">목록</a>
                    <button type="button" onclick="setDispatchPolicy()" class="btn btn-sm btn-blue">저장</button>
                </div>
            </div>
            <form id="shipping_policy_form" name="shipping_policy_form">
                <input type="hidden" id="w" name="w" value="<?=$w?>">
                <input type="hidden" id="dispatchPolicyNo" name="dispatchPolicyNo" value="">
                <input type="hidden" id="readyDurationDay" name="readyDurationDay" value="2">
                <input type="hidden" id="dispatchCloseTime" name="dispatchCloseTime" value="11:00">
                <div class="box">
                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>발송정책</p>
                        <div class="input_select">
                            <select class="border_gray" id="dispatchType" name="dispatchType">
                                <option value="A">당일발송</option>
                                <option value="B">순차발송</option>
                                <option value="D">요청일발송</option>
                                <option value="E">주문제작발송</option>
                                <option value="F">발송일미정</option>
                            </select>
                        </div>
                    </div>

                    <div class="input_form input_text" id="dispatch_info">
                        <p><span class="color-blue">(필수)</span>발송 정보</p>
                        <div class="input_select">
                            <select class="border_gray" id="dispatchCloseTimeSelect" name="dispatchCloseTimeSelect">
                                <?php
                                for ($hour = 11; $hour <= 17; $hour++) {
                                    echo "<option value='{$hour}:00'>발송마감시간 {$hour}시 00분까지</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input_select" id="readyDurationDaySelectWrapper">
                            <select class="border_gray" id="readyDurationDaySelect" name="readyDurationDaySelect">
                                <?php
                                for ($day = 2; $day <= 4; $day++) {
                                    echo "<option value='{$day}'>주문 후 {$day}일 내 발송</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

<script>

    let isAjaxIng = false;

    // 주소록 가져오기
    function setDispatchPolicy() {
        if (isAjaxIng) {
            return;
        }
        isAjaxIng = true;



        let api_type = "<?=GMAC?>";
        let formData = new FormData($('#shipping_policy_form')[0]);
        formData.append("api_type",api_type);

        $.ajax({
            url: "<?=base_url('/delivery/setDispatchPolicy')?>",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                let gm = "<?=GM?>";
                let ac = "<?=AC?>";
                if (data[gm].code == "200" && data[ac].code == "200") {
                    swal(data[gm].msg).then(function () {
                        location.href = "<?=base_url('/delivery/dispatchPolicy')?>";
                    });
                } else {
                    let gm_code = data[gm].code;
                    let ac_code = data[ac].code;
                    let gm_body = JSON.parse(data[gm].msg.body);
                    let ac_body = JSON.parse(data[ac].msg.body);
                    if(gm_code != "200" && ac_code != "200"){
                        swal("[지마켓 오류]"+gm_body['message'] + " [옥션 오류]" +ac_body['message']);
                    } else if(gm_code != "200"){
                        swal("[지마켓 오류]"+gm_body['message']);
                    } else if(ac_body != "200"){
                        swal("[옥션 오류]" +ac_body['message']);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error occurred:', status);
            },
            complete: function() {
                isAjaxIng = false;
            }
        });
    }


    function updateForm() {
        var dispatchType = $("#dispatchType").val();
        $("#dispatchCloseTimeSelect").closest('.input_select').hide();
        $("#readyDurationDaySelectWrapper").hide();
        $("#dispatch_info").hide();

        if (dispatchType === 'A') {
            $("#dispatchCloseTimeSelect").closest('.input_select').show();
            $("#dispatchCloseTime").val("11:00");
            $("#readyDurationDay").val('');
            $("#dispatch_info").show();
        } else if (dispatchType === 'B') {
            $("#dispatchCloseTime").val('00:00');
            $("#readyDurationDaySelectWrapper").show();
            $("#readyDurationDaySelectWrapper option[value='10']").hide();
            $("#readyDurationDaySelectWrapper option[value='2'], #readyDurationDaySelectWrapper option[value='3'], #readyDurationDaySelectWrapper option[value='4']").show();
            $("#readyDurationDaySelect").val("2");
            $("#readyDurationDay").val($("#readyDurationDaySelect").val());
            $("#dispatch_info").show();
        } else if (dispatchType === 'E') {
            $("#dispatchCloseTime").val('00:00');
            $("#readyDurationDay").val('10');
        } else {
            $("#dispatchCloseTime").val('00:00');
            $("#readyDurationDay").val('');
        }
    }

    $("#dispatchType").change(function() {
        updateForm();
    });

    $("#dispatchCloseTimeSelect").change(function() {
        var dispatchCloseTime = $("#dispatchCloseTimeSelect").val();
        $("#dispatchCloseTime").val(dispatchCloseTime);
    });

    $("#readyDurationDaySelect").change(function() {
        var readyDurationDay = $("#readyDurationDaySelect").val();
        $("#readyDurationDay").val(readyDurationDay);
    });

    // 초기화 시 기본값 설정
    updateForm();
</script>

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>