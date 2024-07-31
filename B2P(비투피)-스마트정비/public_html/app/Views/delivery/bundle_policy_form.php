<?php 
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "배송비 관리";
?>
<style>
</style>

        <?php echo view('delivery/delivery_head', $this->data); ?>
        <div class="write_wrap">
            <div class="top_wrap">
                <h1>배송비 등록/수정하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('delivery/bundlePolicy')?>" class="btn btn-sm btn-gray">목록</a>
                    <button type="button" onclick="setBundlePolicy()" class="btn btn-sm btn-blue">저장</button>
                </div>
            </div>
            <form id="delivery_charge_form" name="delivery_charge_form">
                <input type="hidden" id="w" name="w" value="<?=$w?>">
                <input type="hidden" id="policyNo" name="policyNo" value="<?=$bundle_data['policyNo']?>">
                <input type="hidden" id="placeNo" name="placeNo" value="<?=$placeNo?>">
                <div class="box">
                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>배송비 종류</p>
                        <div class="deli_charg_wrap">
                            <input type="radio" id="deli_charg_free" name="feeType" value="1">
                            <label class="btn" for="deli_charg_free">무료</label>
                            <input type="radio" id="deli_charg_notfree" name="feeType" value="2">
                            <label class="btn" for="deli_charg_notfree">유료</label>
                            <input type="radio" id="deli_charg_condition" name="feeType" value="3">
                            <label class="btn" for="deli_charg_condition">조건부 무료</label>
                        </div>
                    </div>

                    <div class="input_form input_text" id="fee_section">
                        <p><span class="color-blue">(필수)</span>배송비 금액</p>
                        <div class="input_unit3">
                            <input type="text" class="border_gray" id="fee" name="fee" value="<?=$bundle_data['fee']?>">원 배송비
                        </div>
                    </div>

                    <div class="input_form input_text" id="condition_section">
                        <p><span class="color-blue">(필수)</span>조건부 무료 배송비</p>
                        <div class="input_unit3">
                            <input type="text" class="border_gray" id="shippingFeeCondition" name="shippingFeeCondition" value="<?=$bundle_data['shippingFeeCondition']?>">원 이상 구매시 무료
                        </div>
                        <p class="text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i> 조건부 무료 배송비는 상품의 판매가 기준으로 적용됩니다.
                        </p>
                    </div>

                    <div class="input_form input_text" id="payment_option_section">
                        <p><span class="color-blue">(필수)</span>배송비 결제여부</p>
                        <div class="input_select">
                            <select class="border_gray" id="payment_option" name="payment_option">
                                <option value="" <?= get_selected($bundle_data['payment_option'], "") ?>>배송비 결제여부 선택</option>
                                <option value="1" <?= get_selected($bundle_data['payment_option'], "1") ?>>선결제만 가능</option>
                                <option value="2" <?= get_selected($bundle_data['payment_option'], "2") ?>>착불/선결제 가능</option>
                                <option value="3" <?= get_selected($bundle_data['payment_option'], "3") ?>>착불만 가능</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>

        </div>

<script>

    $('input[name="feeType"]').change(function() {
        let feeType = $(this).val();

        if (feeType == '1') { // 무료
            $('#fee_section').hide();
            $('#condition_section').hide();
            $('#payment_option_section').hide();
        } else if (feeType == '2') { // 유료
            $('#fee_section').show();
            $('#condition_section').hide();
            $('#payment_option_section').show();
        } else if (feeType == '3') { // 조건부 무료
            $('#fee_section').show();
            $('#condition_section').show();
            $('#payment_option_section').show();
        }
    });

    $(document).ready(function(){
        $('#fee_section').hide();
        $('#condition_section').hide();
        $('#payment_option_section').hide();

        let feeType = "<?=$bundle_data['feeType']?>";
        if(feeType == null || feeType == "" || feeType == 1){
            $('input[name="feeType"][value="1"]').prop('checked', true).change();
        } else if(feeType == 2){
            $('input[name="feeType"][value="2"]').prop('checked', true).change();
        } else if(feeType == 3){
            $('input[name="feeType"][value="3"]').prop('checked', true).change();
        }
    });



    let isAjaxIng = false;
    function setBundlePolicy() {
        if (isAjaxIng) {
            return;
        }
        isAjaxIng = true;

        let api_type = "<?=GMAC?>";
        let formData = new FormData($('#delivery_charge_form')[0]);
        formData.append("api_type", api_type);

        $.ajax({
            url: "<?=base_url('/delivery/setBundlePolicy')?>",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data[api_type].code == "200") {
                    swal(data[api_type].msg).then(function () {
                        location.href = "<?=base_url('/delivery/bundlePolicy')?>";
                    });
                } else {
                    let body = JSON.parse(data[api_type].msg.body);
                    swal(body['message']);
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
</script>

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>