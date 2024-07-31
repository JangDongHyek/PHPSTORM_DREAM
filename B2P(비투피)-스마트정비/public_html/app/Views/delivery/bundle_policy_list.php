<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "배송비 관리";
?>
<style>
    #adm_content .con_wrap .sch_wrap .box .sch01{
        grid-template-columns: 150px 1fr 150px;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 > p{
        grid-column: 1/4;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 > .info_adress{
        grid-column: 2/3;
        display: flex;
        flex-wrap: wrap;
        grid-gap: 7px 20px;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 > .info_adress > span:first-child{
        width: 100%;
        display: block;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 .btn-blue{
        font-size: 1em;
    }
    #adm_content .con_wrap .table > table > thead > tr > th,
    #adm_content .con_wrap .table > table > tbody > tr > td{
        text-align: center!important;
    }
</style>



        <?php echo view('delivery/delivery_head', $this->data); ?>

        <div class="sch_wrap">
            <p class="tit">검색결과</p>
            <div class="box">
                <div class="sch01" style="width: 100%;">
                    <p>검색하기</p>
                    <div class="input_select">
                        <select class="border_gray">
                            <option value="출고지 주소">출고지</option>
                        </select>
                    </div>

                    <div class="input_select">
                        <select class="border_gray" id="placeNo" name="placeNo">
                            <option value="">출고지를 선택하세요</option>
                            <?
                                $places_list = $places_data['list'];
                                foreach ($places_list as $index => $list_data){?>
                                    <option value="<?=$list_data['placeNo']?>"><?=$list_data['placeName']?></option>
                                <?}
                            ?>
                        </select>
                    </div>
                    <!--<button class="btn btn-blue"></button>-->
                    
<!--                    <div class="info_adress">
                        <span>
                            경기도 화성시 마도면 마도로620번길 43HK Tech Corporation (우 : 18541 )
                        </span>
                        <span>묶음계산방식 : 가장 큰값</span>
                        <span>도서산간 추가배송비 : 제주도 4000원 & 기타 4000원</span>
                    </div>-->
                </div>
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1 style="display:none;"><span class="color-blue">배송지 관리 목록 10개</span>/ 총 100개</h1>
                </div>

                <div class="wrap">
                    <button class="btn btn-write" id="registerButton">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </button>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th width="130px">수정</th>
                            <th>묶음배송 출고(하)지 코드</th>
                            <th>배송비 종류</th>
                            <th>배송비 조건/금액</th>
                            <th>결제 여부</th>

                        </tr>
                    </thead>
                    <tbody id="tbody">
                            <tr>
                                <td colspan="99">
                                    출고지를 선택해주세요.
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>


<script>
    let isAjaxIng = false;

    $('#placeNo').change(function(){
        let placeNo = $(this).val();
        if (isAjaxIng) {
            return;
        }
        isAjaxIng = true;

        let api_type = "<?=GMAC?>";
        let formData = new FormData();

        formData.append("placeNo", placeNo);
        formData.append("api_type", api_type);

        $('#tbody').empty();
        if(!placeNo){
            $('#tbody').html('<tr><td colspan="99">출고지를 선택해주세요. </td></tr>');
            isAjaxIng = false;
            return false;
        }

        $.ajax({
            url: "<?=base_url('/delivery/getBundlePolicy')?>",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.total_count > 0) {
                    $.each(data.list, function(index, item) {
                        let feeType = "무료";
                        let shippingFeeCondition = "";
                        if(item.feeType == "2") {
                            feeType = "유료";
                        } else if(item.feeType == "3") {
                            feeType = "조건부 무료";
                            shippingFeeCondition = item.shippingFeeCondition + "원 이상 구매시 ";
                        }
                        
                        let fee = 0;
                        if(item.fee != ""){
                            fee = item.fee;
                        }

                        let payment_option = "-";
                        if(item.payment_option == "1"){
                            payment_option = "선결제만 가능";
                        }
                        if(item.payment_option == "3"){
                            payment_option = "착불만 가능";
                        }
                        if(item.payment_option == "2"){
                            payment_option = "착불/선결제 가능";
                        }

                        let row = `
                                    <tr>
                                        <td>
                                            <a href="<?=base_url("delivery/bundlePolicyForm")?>?w=u&idx=${item.idx}&placeNo=${item.placeNo}" class="btn btn-sm btn-skyblue">수정</a>
                                        </td>
                                        <td>${item.policyNo}</td>
                                        <td>${feeType}</td>
                                        <td>${shippingFeeCondition} ${fee}원</td>
                                        <td>${payment_option}</td>

                                    </tr>
                                `;
                        $('#tbody').append(row);
                    });
                } else {
                    $('#tbody').append(`<tr><td colspan="99">데이터가 없습니다..</td></tr>`);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error occurred:', status);
            },
            complete: function() {
                isAjaxIng = false;
            }
        });
    });

    $('#registerButton').click(function(){
        let selectedValue = $('#placeNo').val();
        if(selectedValue){
            let baseUrl = '<?=base_url('delivery/bundlePolicyForm')?>';
            let newUrl = baseUrl + '?placeNo=' + selectedValue;
            window.location.href = newUrl;
        } else {
            swal('출고지를 선택하세요');
        }
    });
</script>

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>