<?php 
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "주소록 관리";
?>
<style>
</style>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

        <?php echo view('delivery/delivery_head', $this->data); ?>
        <div class="write_wrap">
            <div class="top_wrap">
                <h1>배송정보 등록하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('delivery/addressList')?>" class="btn btn-sm btn-gray">목록</a>
                    <button onclick="setAddress()" class="btn btn-sm btn-blue">저장</button>
                </div>
            </div>
            <form id="address_form" name="address_form">
                <input type="hidden" id="w" name="w" value="<?=$w?>">
                <input type="hidden" id="addrNo" name="addrNo" value="<?=$address_data['addrNo']?>">
                <div class="box">
                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>주소록명</p>
                        <input type="text" placeholder="입력하세요" class="border_gray" id="addrName" name="addrName" value="<?=$address_data['addrName']?>">
                    </div>

                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>판매자명</p>
                        <input type="text" placeholder="입력하세요" class="border_gray" id="representativeName" name="representativeName" value="<?=$address_data['representativeName']?>">
                    </div>

                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>주소</p>
                        <div class="input_adress">
                            <div class="flex gap10 ">
                                <input type="text" placeholder="우편번호" class="border_gray" readonly id="zipCode" name="zipCode" value="<?=$address_data['zipCode']?>">
                                <button type="button" class="btn btn-blue" onclick="daum_zip('zipCode','addr1','addr2','addr3','addr4','addr1');">우편번호 검색</button>
                            </div>
                            <input type="text" placeholder="주소" class="border_gray" readonly id="addr1" name="addr1" value="<?=$address_data['addr1']?>">
                            <input type="text" placeholder="상세주소" class="border_gray" id="addr2" name="addr2" value="<?=$address_data['addr2']?>">
                            <input type="hidden" placeholder="상세주소" class="border_gray" id="addr3" name="addr3">
                            <input type="hidden" placeholder="상세주소" class="border_gray" id="addr4" name="addr4">
                        </div>
                    </div>

                    <div class="wrap">
                        <div class="input_text">
                            <p>전화번호</p>
                            <div class="input_select">
                                <input type="text" placeholder="-을 제외한 숫자를 입력하세요" class="border_gray" id="homeTel" name="homeTel" value="<?=$address_data['homeTel']?>">
                            </div>
                        </div>
                        <div class="input_text">
                            <p>휴대전화</p>
                            <div class="input_select">
                                <input type="text" placeholder="-을 제외한 숫자를 입력하세요" class="border_gray" id="cellPhone" name="cellPhone" value="<?=$address_data['cellPhone']?>">
                            </div>
                        </div>
                    </div>
                    <div class="input_form">
                        <p>위치설명</p>
                        <input type="text" placeholder="위치명을 입력해주세요" class="border_gray" id="locationDescription" name="locationDescription" value="<?=$address_data['locationDescription']?>">
                    </div>
                </div>
            </form>
        </div>

<script>
    $('#homeTel').phoneFormat();
    $('#cellPhone').phoneFormat();

    let isAjaxIng = false;

    // 주소록 가져오기
    function setAddress() {
        if (isAjaxIng) {
            return;
        }
        isAjaxIng = true;

        let api_type = "<?=GMAC?>";
        let formData = new FormData($('#address_form')[0]);
        formData.append("api_type",api_type);

        $.ajax({
            url: "<?=base_url('/delivery/setAddress')?>",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data[api_type].code == "200") {
                    swal(data[api_type].msg).then(function () {
                        location.href = "<?=base_url('/delivery/addressList')?>";
                    });
                } else {
                    swal(data[api_type].msg);
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
