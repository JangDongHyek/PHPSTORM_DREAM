<?php 
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "출고지 관리";
?>
<style>
</style>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

        <?php echo view('delivery/delivery_head', $this->data); ?>
        <div class="write_wrap">
            <div class="top_wrap">
                <h1>출고지 등록하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('delivery/placesList')?>" class="btn btn-sm btn-gray">목록</a>
                    <button onclick="setPlaces()" class="btn btn-sm btn-blue">저장</button>
                </div>
            </div>
            <form id="places_form" name="places_form">
                <input type="hidden" id="w" name="w" value="<?=$w?>">
                <input type="hidden" id="placeNo" name="placeNo" value="<?=$places_data['placeNo']?>">
                <div class="box">

                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>출고지명</p>
                        <input type="text" placeholder="입력하세요" class="border_gray" id=placeName" name="placeName" value="<?=$places_data['placeName']?>">
                    </div>

                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>주소</p>
                        <div class="input_select">
                            <select class="border_gray" id=addrNo" name="addrNo">
                                <?
                                    $address_list = $address_data['list'];
                                    $address = $address_list[0]['addr1']." ".$address_list[0]['addr2'];
                                    $homeTel = $address_list[0]['homeTel'];
                                    $cellPhone = $address_list[0]['cellPhone'];
                                    foreach ($address_list as $index => $list_data){
                                        if($places_data['addrNo'] == $list_data['addrNo']){
                                            $address = $list_data['addr1']." ".$list_data['addr2'];
                                        }
                                        ?>
                                        <option value="<?=$list_data['addrNo']?>" <?=get_selected($places_data['addrNo'],$list_data['addrNo'])?>><?=$list_data['addrName']?></option>
                                    <?}
                                ?>
                            </select>
                        </div>
                        <p class="text-guide" id="juso">
                            <?=$address?>
                        </p>
                    </div>

                    <!--<div class="input_form input_text">
                        <p>전화번호</p>
                        <div class="input_select">
                            <input type="text" placeholder="-을 제외한 숫자를 입력하세요" class="border_gray" id="homeTel" name="homeTel">
                        </div>
                    </div>
                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>휴대전화</p>
                        <div class="input_select">
                            <input type="text" placeholder="-을 제외한 숫자를 입력하세요" class="border_gray" id="homeTel" name="homeTel">
                        </div>
                    </div>-->


                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>묶음계산방식</p>
                        
                        <div class="input_select">
                            <select class="border_gray" id="imposeType" name="imposeType">
                                <option value="1" <?= get_selected($places_data['placeName'], 1)?>>배송비 중 가장 작은 값으로 부과</option>
                                <option value="2" <?= get_selected($places_data['placeName'], 2)?>>배송비 중 가장 큰 값으로 부과</option>
                            </select>
                        </div>
                    </div>


                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>도서산간 추가 배송비 설정</p>
<!--                        <a href="" class="btn btn-sm btn-gray2">제주 및 도서산간 해당 지역정보</a>-->
                        <div class="input_mauntain_address">
                            제주도 및 그 부속도서
                            <input type="number" class="border_gray" id="jejuAdditionalShippingFee" name="jejuAdditionalShippingFee" value="<?=$places_data['jejuAdditionalShippingFee']?>">
                            원
                        </div>
                        <div class="input_mauntain_address">
                            도서지방 및 산간지방
                            <input type="number" class="border_gray" id="backwoodsAdditionalShippingFee" name="backwoodsAdditionalShippingFee" value="<?=$places_data['backwoodsAdditionalShippingFee']?>">
                            원
                        </div>
                    </div>
                </div>
            </form>
        </div>

<script>
    let isAjaxIng = false;

    // 주소록 가져오기
    function setPlaces() {
        if (isAjaxIng) {
            return;
        }
        isAjaxIng = true;

        let api_type = "<?=GMAC?>";
        let formData = new FormData($('#places_form')[0]);
        formData.append("api_type", api_type);

        $.ajax({
            url: "<?=base_url('/delivery/setPlaces')?>",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                if (data[api_type].code == "200") {
                    swal(data[api_type].msg).then(function () {
                        location.href = "<?=base_url('/delivery/placesList')?>";
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