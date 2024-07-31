<script>

    let selectedValues = [];

    // all_check 체크박스를 클릭하면 나머지 체크박스를 모두 선택 또는 해제
    $("#all_check").click(function(){
        if(this.checked){
            $("input[name='goods_checkbox[]']").each(function(){
                this.checked = true;
                selectedValues.push($(this).val());
            });
        } else {
            $("input[name='goods_checkbox[]']").each(function(){
                this.checked = false;
            });
            selectedValues = [];
        }
    });

    // 개별 체크박스를 클릭하면 해당 체크박스의 value를 배열에 추가 또는 제거
    $("input[name='goods_checkbox[]']").click(function(){
        if(this.checked){
            selectedValues.push($(this).val());
        } else {
            const index = selectedValues.indexOf($(this).val());
            if(index > -1){
                selectedValues.splice(index, 1);
            }
        }
    });


    function setGoodsBatch(formData) {
        if(isAjaxIng){
            return;
        }
        isAjaxIng = true;

        let api_type = "<?=GMAC?>";
        formData.append("api_type", api_type);
        formData.append("selectedValues", selectedValues);

        showLoading(true);
        $.ajax({
            url: "<?=base_url('/goods/setGoodsBatch')?>",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);

                // tbody 초기화
                $('#goodsEditDoneTbody').empty();

                // 데이터 처리
                $.each(data, function(goodsNo, response){
                    const body = JSON.parse(response.body);
                    const resultCode = response.code;
                    const message = body.message;
                    let status, failureReason;

                    if (resultCode == 200 || resultCode == 201) {
                        status = '완료';
                        failureReason = '-';
                    } else {
                        status = '실패';
                        failureReason = message || '-';
                    }

                    // 테이블에 행 추가
                    $('#goodsEditDoneTbody').append(`
                    <tr>
                    <td>${goodsNo}</td>
                    <td>${status}</td>
                    <td>${failureReason}</td>
                    </tr>
                    `);
                });

                $('#goodsEditDoneModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error occurred:', status);
            },
            complete: function() {
                showLoading(false);
                isAjaxIng = false;
                $("#goodsStateModal").modal("hide");
                $("#goodsPeriodModal").modal("hide");
                $("#goodsPriceModal").modal("hide");
                $("#goodsStockModal").modal("hide");
                $("#goodsDcModal").modal("hide");
                $("#goodsDeliveryModal").modal("hide");
                $("#goodsPromoModal").modal("hide");
                $("#goodsMaxModal").modal("hide");
                $("#goodsBenefitModal").modal("hide");
                $("#goodsMoreModal").modal("hide");
                $("#goodsCompareModal").modal("hide");
                $("#goodsSmileModal").modal("hide");
                $("#goodsDonateModal").modal("hide");

                //$("#goodsEditDoneModal").modal('show');
            }
        });
    }
</script>

<!-- 판매 상태 일괄 변경 -->
<div class="modal fade" id="goodsStateModal" tabindex="-1" aria-labelledby="goodsStateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-narrow">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsStateModalLabel">판매 상태 일괄 변경</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <select class="border_gray" id="select_goodsState" name="select_goodsState">
                    <option value="T">판매가능</option>
                    <option value="F">판매중지</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsStateModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>

<!--  판 매 상 태 일 괄 변 경 -->
<script>

    function goodsStateModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsStateModal").modal("show");
    }
    
    function goodsStateModal_submit() {
        let goodsBatch_type = "goodsState";

        let formData = new FormData();
        formData.append("goodsBatch_type",goodsBatch_type);
        formData.append("select_goodsState", $("#select_goodsState").val());
        setGoodsBatch(formData);
    }
    
</script>
<!--  판 매 상 태 일 괄 변 경 -->

<!-- 판매 기간 일괄 변경 -->
<div class="modal fade" id="goodsPeriodModal" tabindex="-1" aria-labelledby="goodsPeriodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-narrow">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsPeriodModalLabel">판매 기간 일괄 변경</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="border_gray" id="select_goodsPeriod" name="select_goodsPeriod">
                    <option value="-1">무제한</option>
                    <option value="15">15일</option>
                    <option value="30">30일</option>
                    <option value="60">60일</option>
                    <option value="90">90일</option>
                </select>
                <!--날짜선택시-->
                <input type="date" value="9999-12-31" id="date_endSellDate" name="date_endSellDate" class="border_gray"/>
                <!--날짜선택시-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsPeriodModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>

<!-- 판 매 기 간 일 괄 변 경 -->
<script>
    function goodsPeriodModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsPeriodModal").modal("show");
    }

    function goodsPeriodModal_submit() {
        let goodsBatch_type = "goodsPeriod";

        let formData = new FormData();
        formData.append("goodsBatch_type",goodsBatch_type);
        formData.append("select_goodsPeriod", $("#select_goodsPeriod").val());
        setGoodsBatch(formData);
    }

    $('#select_goodsPeriod').change(function() {
        let period = $(this).val();
        let endDate = $('#date_endSellDate');
        if (period == '-1') {
            // 무제한일 경우
            endDate.val('9999-12-31');
        } else {
            // 오늘 날짜 가져오기
            let today = new Date();
            // 선택한 기간을 더하기
            today.setDate(today.getDate() + parseInt(period));
            // yyyy-mm-dd 형식으로 변환
            let year = today.getFullYear();
            let month = ('0' + (today.getMonth() + 1)).slice(-2);
            let day = ('0' + today.getDate()).slice(-2);
            let formattedDate = year + '-' + month + '-' + day;
            // 날짜 입력 필드에 설정
            endDate.val(formattedDate);
        }
    });

</script>
<!-- 판 매 기 간 일 괄 변 경 -->

<!-- 판매가 변경 -->
<div class="modal fade" id="goodsPriceModal" tabindex="-1" aria-labelledby="goodsPriceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsPriceModalLabel">판매가 변경</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">판매가 변경</li>
                    <!--<li class="tab-link" data-tab="tab-2">엑셀 일괄 수정</li>-->
                </ul>

                <div id="tab-1" class="tab-content current">
                    <!--<h1 class="box_white">
                        * 선택한 상품 <span class="color-blue">0</span>개의 판매가를 변경합니다.
                    </h1>-->
                    <br>
                    <!--<div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div>-->
                    <div class="flex ai-c">
                        <input type="text" class="border_gray" id="input_goodsPrice" name="input_goodsPrice"/>
                        <select class="border_gray w25" id="select_goodsPrice_unit" name="select_goodsPrice_unit">
                            <option value="1">원</option>
                            <option value="2">%</option>
                        </select>
                        <select class="border_gray w25" id="select_goodsPrice_type" name="select_goodsPrice_type">
                            <option value="up">인상</option>
                            <option value="down">인하</option>
                            <option value="set">으로 변경</option>
                        </select>
                    </div>
<!--                    <br>
                    <div class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></div>
                    <div class="flex ai-c">
                        <input type="text" class="border_gray"/>
                        <select class="border_gray w25">
                            <option>원</option>
                            <option>%</option>
                        </select>
                        <select class="border_gray w25">
                            <option>인상</option>
                            <option>인하</option>
                            <option>으로 변경</option>
                        </select>
                    </div>-->
                    <br>
                    <p class="guide">
                        10원단위로 입력 가능합니다. 원단위는 절삭됩니다.<br>
                        이벤트 참여 상품 등 일부 상품은 판매가가 변경되지 않을 수 있습니다.
                    </p>
                </div>

                <div id="tab-2" class="tab-content">
                    <h1 class="box_white">
                        * 상품정보를 양식에 맞게 입력하여 업로드 해주세요.
                    </h1>
                    <button type="button" class="btn btn-blue btn-md w100">양식 다운로드</button>
                    <br>
                    <br>
                    <form id="FileUploadForm" class="flex">
                        <input id="FileuploadName" type="text" class="border_gray">
                        <button type="button" class="btn btn-gray btn-md w100px">파일 선택</button>
                    </form>
                    <br>
                    <p class="guide">
                        10원 단위로 입력 가능합니다. 정률변경 시 원단위는 절삭됩니다.<br>
                        이벤트 참여 상품 등 일푸 상품은 판매가가 변경되지 않을 수 있습니다.<br>
                        판매가 엑셀 일괄 변경은 최대 500개 까지 가능합니다.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsPriceModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>

<!-- 판 매 가 변 경 -->
<script>
    function goodsPriceModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsPriceModal").modal("show");
    }

    function goodsPriceModal_submit() {
        let goodsBatch_type = "goodsPrice";

        let formData = new FormData();
        formData.append("goodsBatch_type",goodsBatch_type);
        formData.append("input_goodsPrice",$("#input_goodsPrice").val().trim());
        formData.append("select_goodsPrice_unit",$("#select_goodsPrice_unit").val());
        formData.append("select_goodsPrice_type",$("#select_goodsPrice_type").val());
        setGoodsBatch(formData);
    }
</script>
<!-- 판 매 가 변 경 -->

<!-- 할인 설정 -->
<div class="modal fade" id="goodsDcModal" tabindex="-1" aria-labelledby="goodsDcModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsDcModalLabel">할인 설정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-3">할인 설정</li>
                    <!--<li class="tab-link" data-tab="tab-4">엑셀 일괄 수정</li>-->
                </ul>

                <div id="tab-3" class="tab-content current">
                    <!--<h1 class="box_white">
                        * 선택한 상품 <span class="color-blue">0</span>개의 할인을 변경합니다.
                    </h1>-->
                    <br>

                    <div class="select flex gap20">
                        <input type="radio" id="sellerUseDiscount1" name="sellerUseDiscount" value="T">
                        <label for="sellerUseDiscount1">
                            <i class="fa-duotone fa-circle-check"></i>설정함
                        </label>
                        <input type="radio" id="sellerUseDiscount2" name="sellerUseDiscount" value="F" checked>
                        <label for="sellerUseDiscount2">
                            <i class="fa-duotone fa-circle-check"></i>설정안함
                        </label>
                    </div>
                    <br>
                    <div class="box_whiteline2" id="div_disCountPrice" style="display: none">
                        <div class="input_unit2">
                            <input type="text" id="sellerDisCountPrice" name="sellerDisCountPrice" placeholder="숫자만 입력해주세요." class="border_gray">
                            <div class="input_select">
                                <select class="border_gray" id="sellerDiscountType" name="sellerDiscountType">
                                    <option value="2">%</option>
                                    <option value="1">원</option>
                                </select>
                            </div>
                        </div>
                        <p class="flex gap5 text-guide"><i class="fa-duotone fa-circle-exclamation"></i>100원이상 10원단위로 입력, 판매가 대비 70%까지 입력해주세요.</p>
                        <br>
                        <!--할인설정-->
                        <div class="flex gap20 box_white">
                            <div class="input_checkbox">
                                <input type="checkbox" id="sellerDiscountDday" name="sellerDiscountDday" value="T">
                                <label for="sellerDiscountDday" style="padding: 0">
                                    <i class="fa-duotone fa-square-check"></i> 특정기간 할인
    </label>
                                <div class="input_date" id="div_sellerDiscountDday" style="padding-top: 20px">
                                    <input type="date" class="border_gray" id="sellerDiscountStartDate" name="sellerDiscountStartDate">
                                    ~
                                    <input type="date" class="border_gray" id="sellerDiscountEndDate" name="sellerDiscountEndDate">
                                </div>
                            </div>
                        </div><!--특정기간 할인-->
                    </div>
                </div>

                <div id="tab-4" class="tab-content">
                    <h1 class="box_white">
                        * 상품정보를 양식에 맞게 입력하여 업로드 해주세요.
                    </h1>
                    <button type="button" class="btn btn-blue btn-md w100">양식 다운로드</button>
                    <br>
                    <br>
                    <form id="FileUploadForm" class="flex">
                        <input id="FileuploadName" type="text" class="border_gray">
                        <button type="button" class="btn btn-gray btn-md w100px">파일 선택</button>
                    </form>
                    <br>
                    <p class="guide">
                        최소 100원 이상, 10원 단위 입력, 판매가 대비 70%까지 입력해주세요.
                        <br>
                        할인 엑셀 일괄 변경은 최대 500개 까지 가능합니다.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsDcModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 할 인 변 경 -->
<script>
    function goodsDcModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsDcModal").modal("show");
    }

    function goodsDcModal_submit() {
        let goodsBatch_type = "goodsDc";

        let formData = new FormData();
        formData.append("goodsBatch_type",goodsBatch_type);
        formData.append("sellerUseDiscount",$("input[name='sellerUseDiscount']:checked").val().trim());
        formData.append("sellerDisCountPrice",$("#sellerDisCountPrice").val().trim());
        formData.append("sellerDiscountType",$("#sellerDiscountType").val());
        formData.append("sellerDiscountDday",$("#sellerDiscountDday").val());
        formData.append("sellerDiscountStartDate",$("#sellerDiscountStartDate").val());
        formData.append("sellerDiscountEndDate",$("#sellerDiscountEndDate").val());
        setGoodsBatch(formData);
    }

    $("input[name=sellerUseDiscount]").on('change',function () {
        if($(this).val() == "T"){
            $("#div_disCountPrice").show();
        } else {
            $("#div_disCountPrice").hide();
        }
    });
</script>
<!-- 할 인 변 경 -->

<!-- 재고 변경 -->
<div class="modal fade" id="goodsStockModal" tabindex="-1" aria-labelledby="goodsStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsStockModalLabel">재고 변경</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?/*<h1 class="box_white">
                    * 선택한 상품 <span class="color-blue">0</span>개의 재고를 변경합니다.
                </h1>
                <div class="select flex gap20">
                    <input type="radio" id="" name="Stock" value="T">
                    <label for="">
                        <i class="fa-duotone fa-circle-check"></i> 설정함
                    </label>
                    <input type="radio" id="" name="Stock" value="F">
                    <label for="">
                        <i class="fa-duotone fa-circle-check"></i> 설정안함
                    </label>
                </div>*/?>
                    <div class="flex ai-c gap5">
                        <input type="text" class="border_gray" id="input_goodsStock" name="input_goodsStock"/> 개
                    </div>
                    <br>
                    <p class="guide">
                        옵션 사용 상품의 재고는 옵션관리 영역에서 변경 가능합니다.
                        <br>
                        재고를 미입력하거나 0이하로 입력 시 99,999로 입력됩니다.
                    </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsStockModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 재 고 변 경 -->
<script>
    function goodsStockModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsStockModal").modal("show");
    }

    function goodsStockModal_submit() {
        let goodsBatch_type = "goodsStock";

        let formData = new FormData();
        formData.append("goodsBatch_type",goodsBatch_type);
        formData.append("input_goodsStock", $("#input_goodsStock").val().trim());
        setGoodsBatch(formData);
    }
</script>
<!-- 재 고 변 경 -->

<!-- 배송정보 변경 -->
<div class="modal fade" id="goodsDeliveryModal" tabindex="-1" aria-labelledby="goodsDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsDeliveryModalLabel">배송정보 변경</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="box_white">
                    * 아래 항목 중 변경할 항목을 선택하세요.
                </h1>
                <br>
                <div class="flex select">
                    <input type="checkbox" id="use_shippingMethod" name="use_shippingMethod" /><label for="use_shippingMethod">배송방법</label>
                    <input type="checkbox" id="use_shippingPolicy" name="use_shippingPolicy" /><label for="use_shippingPolicy">발송정책</label>
                    <input type="checkbox" id="use_shippingBundle" name="use_shippingBundle" /><label for="use_shippingBundle">묶음배송/배송비</label>
                    <input type="checkbox" id="use_shippingReturn" name="use_shippingReturn"/><label for="use_shippingReturn">반품정보</label>
                </div>
                <div class="box_white2" id="div_use_shippingMethod" style="display: none">
                    <p>배송방법</p>
                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="shippingType1" name="shippingType" value="1" checked>
                            <label for="shippingType1"><i class="fa-duotone fa-circle-check"></i> 택배,소포,등기</label>
                        </div>
                        <div class="input_radio">
                            <input type="radio" id="shippingType2" name="shippingType" value="2">
                            <label for="shippingType2"><i class="fa-duotone fa-circle-check"></i> 직접배송</label>
                        </div>
                    </div>

                    <div class="box_white" id="div_shippingType">
                        <p>택배사</p>
                        <div class="input_select">

                            <select class="border_gray" id="companyNo" name="companyNo">
                                <option value="">선택</option>
                                <?
                                foreach ($delivery_company_list as $index => $data){ ?>
                                    <option value="<?=$data['code']?>" <?=get_selected($shippingArr['companyNo'],$data['code'])?>><?=$data['name']?></option>
                                <?}
                                ?>
                            </select>
                        </div>
                    </div><!--택배사-->
                    <div class="box_white">
                        <p>추가 배송방법</p>
                        <div class="flex gap20">
                            <div class="input_checkbox">
                                <input type="checkbox" id="quickService" name="quickService" value="T">
                                <label for="quickService"><i class="fa-duotone fa-circle-check"></i>퀵서비스</label>
                            </div>
                        </div>
                    </div>
                    <!--추가 배송방법-->

                    <div class="box_white" id="div_deliQuickBox" style="display: none"> <!--퀵서비스 선택시-->
                        <div class="input_form ">
                            <p>퀵서비스 가능지역</p>
                            <div class="flex gap20 flexwrap">
                                <?
                                $quickRegions = $quickServiceJiyuck['quickRegions'];
                                $quickGyeonggi = $quickServiceJiyuck['quickGyeonggi'];

                                $shippingEnableRegionCodeArr = explode(",",$quickServiceArr['shippingEnableRegionCode']);

                                $useQuickGyeonggi = false;
                                foreach ($shippingEnableRegionCodeArr as $index => $code){
                                    if (substr($code, 0, 2) === "02") {
                                        $useQuickGyeonggi = true;
                                    }
                                }

                                foreach ($quickRegions as $code => $name) { ?>
                                    <div class="input_checkbox">
                                        <input type="checkbox" id="quick_<?=$code?>" name="quickList[]" value="<?=$code?>" <?=get_checked(in_array($code,$shippingEnableRegionCodeArr),true)?>>
                                        <label for="quick_<?=$code?>">
                                            <i class="fa-duotone fa-circle-check"></i><?=$name?>
                                        </label>
                                    </div>
                                <?}?>

                                <div class="input_checkbox" id="div_gyeonggiList" style="display: <?=get_displayed($useQuickGyeonggi,true)?>">
                                    <?
                                    foreach ($quickGyeonggi as $code => $name) { ?>

                                        <input type="checkbox" id="gyeonggiList_<?=$code?>" name="gyeonggiList[]" value="<?=$code?>" <?=get_checked(in_array($code,$shippingEnableRegionCodeArr),true)?>>
                                        <label for="gyeonggiList_<?=$code?>">
                                            <i class="fa-duotone fa-circle-check"></i><?=$name?>
                                        </label>

                                    <?}
                                    ?>
                                </div>
                            </div>
                        </div><!--퀵서비스 가능지역-->
                        <br>
                        <div class="input_form ">
                            <p>퀵서비스 업체명</p>
                            <div class="input_unit">
                                <input type="text" class="border_gray w50" placeholder="업체명을 입력해주세요" id="quickCompanyName" name="quickCompanyName" value="<?=$quickServiceArr['companyName']?>">
                            </div>
                        </div><!--퀵서비스 업체명-->
                        <div class="input_form ">
                            <p>퀵서비스 연락처</p>
                            <div class="input_unit">
                                <input type="text" class="border_gray w50" placeholder="'-'를 제외한 숫자만 입력해주세요" id="quickCompanyHp" name="quickCompanyHp" value="<?=$quickServiceArr['phoneNo']?>">
                            </div>
                        </div><!--퀵서비스 연락처-->
                    </div>
                </div><!-- 배송방법 -->
                <div class="box_white2" id="div_use_shippingPolicy" style="display: none">
                    <p>발송정책</p>
                    <select class="border_gray" id="select_shippingPolicy" name="select_shippingPolicy">
                        <option value="">발송정책</option>
                        <?
                        foreach ($dispatch_policy_data as $index => $data){ ?>
                            <option value="<?="{$data['gmarket_reg_no']},{$data['auction_reg_no']}"?>" <?=get_selected($sf_policyNo, "{$data['gmarket_reg_no']},{$data['auction_reg_no']}")?>><?=$data['dispatch_policy']." > ".$data['dispatch_info']?></option>
                        <?}
                        ?>
                    </select>
                </div><!--발송정책-->
                <div class="box_white2" id="div_use_shippingBundle" style="display: none">
                    <p>묶음배송/배송비</p>
                    <p>출고지</p>
                    <div class="input_select">
                        <select class="border_gray" id="placeNo" name="placeNo">
                            <option value="">선택해주세요</option>
                            <?
                            $places_list = $places_data['list'];

                            foreach ($places_list as $index => $data) {?>
                                <option value="<?=$data['placeNo']?>" <?=get_selected($placeNo, $data['placeNo'])?>><?=$data['placeName']?></option>
                            <?}
                            ?>
                        </select>
                    </div><!--출고지-->
                    <p class="flex gap5 text-guide">
                        <i class="fa-duotone fa-circle-exclamation"></i>출고지 주소록은 '배송정보관리'메뉴에서 관리가 가능합니다.
                    </p>
                    <br>
                    <p>묶음배송</p>
                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="shippingPolicyFeeType1" name="shippingPolicyFeeType" value="1">
                            <label for="shippingPolicyFeeType1"><i class="fa-duotone fa-circle-check"></i>설정함</label>
                        </div>

                        <div class="input_radio">
                            <input type="radio" id="shippingPolicyFeeType2" name="shippingPolicyFeeType" value="2" checked>
                            <label for="shippingPolicyFeeType2"><i class="fa-duotone fa-circle-check"></i>설정안함(개별배송)</label>
                        </div>
                    </div>
                    <!--묶음배송-->

                    <div class="input_form secondBox" id="div_shippingPolicyFeeType1" style="display: <?=get_displayed($useBundle,true)?>">
                        <p><span class="color-blue">(필수)</span> 배송비 선택</p><!--묶음배송시/배송비 선택-->
                        <div class="input_select">
                            <input type="hidden" id="bundelDeliveryTmplId" value="<?=$shippingArr['policy']['bundle']['deliveryTmplId']?>">
                            <select class="border_gray" id="deliveryTmplId" name="deliveryTmplId">
                                <option value="">출고지를 먼저 선택해주세요.</option>
                            </select>
                        </div>

                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>배송비는 '배송정보관리'메뉴에서만 관리가 가능합니다.
                        </p>
                        <!--묶음배송시/배송비 선택-->
                    </div>
                    <div class="input_form secondBox" id="div_shippingPolicyFeeType2" style="display: <?=get_displayed($useBundle,false)?>">
                        <?
                        $eachArr = $shippingArr['policy']['each'];
                        $useEach = false;
                        if(!empty($eachArr)){
                            $useEach = true;
                        }
                        ?>

                        <p><span class="color-blue">(필수)</span> 배송비 선택</p><!--개별배송시/배송비-->
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="eachFeeType1" name="eachFeeType" value="1" <?=get_checked($eachArr['feeType'], "1")?>>
                                <label for="eachFeeType1">
                                    <i class="fa-duotone fa-circle-check"></i>무료
                                </label>
                            </div>
                            <div class="input_radio">
                                <input type="radio" id="eachFeeType2" name="eachFeeType" value="2" <?=get_checked($eachArr['feeType'], "2")?>>
                                <label for="eachFeeType2">
                                    <i class="fa-duotone fa-circle-check"></i>유료
                                </label>
                            </div>
                            <div class="input_radio">
                                <input type="radio" id="eachFeeType3" name="eachFeeType" value="3" <?=get_checked($eachArr['feeType'], "3")?>>
                                <label for="eachFeeType3">
                                    <i class="fa-duotone fa-circle-check"></i>조건부 무료
                                </label>
                            </div>
                            <!--            <div class="input_radio">
                                            <input type="radio" id="eachFeeType4" name="eachFeeType" value="4">
                                            <label for="eachFeeType4">
                                                <i class="fa-duotone fa-circle-check"></i>수량별 차등
                                            </label>
                                        </div>-->
                        </div>
                        <div id="div_paid" class="input_unit" style="display: <?=get_displayed($eachArr['feeType'], "2")?>; margin-top: 15px">
                            <input type="text" class="border_gray w50" id="basic_delivery_price" name="basic_delivery_price" value="<?=$eachArr['fee']?>">원
                        </div>
                        <div id="div_conditional" class="flex" style="display: <?=get_displayed($eachArr['feeType'], "3")?>; margin-top: 15px">
                            <div class="input_unit">
                                배송비 : <input type="text" class="border_gray w50"  id="condition_delivery_price" name="condition_delivery_price" value="<?=$eachArr['fee']?>">원
                            </div>

                            <div class="input_unit">
                                <input type="text" class="border_gray w50" id="condition_over_price" name="condition_over_price" value="<?=$eachArr['details'][0]['Condition']?>">원 이상 구매시 무료
                            </div>

                        </div>
                    </div>
                </div>
                <div id="div_use_shippingReturn" style="display: none">
                    <div class="box_white2">
                        <p>반품/교환</p>
                        <p>반품/교환지</p>
                        <select class="border_gray" id="returnAndExchangeAddrNo" name="returnAndExchangeAddrNo">
                            <option value="">선택해주세요</option>
                            <?
                            $address_list = $address_book_data['list'];

                            foreach ($address_list as $index => $data) {?>
                                <option value="<?=$data['addrNo']?>" <?=get_selected($returnAndExchangeArr['addrNo'],$data['addrNo'])?>><?=$data['addrName']." (".$data['addr1']." ". $data['addr2'] . ")"?></option>
                            <?}
                            ?>
                        </select>
                        <p class="text-guide">
                            주소 (우편번호)
                        </p>
                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>출고지 주소록은 '배송정보관리'메뉴에서 관리가 가능합니다.
                        </p><!--반품/교환지-->
                        <br>
                        <p>반품/교환 배송비(편도)</p>
                        <br>
                        <div class="input_unit"><!--유료시-->
                            <input type="text" class="border_gray" value="0" id="returnAndExchange" name="returnAndExchange">원
                        </div>
                    </div><!--반품/교환 배송비-->

                    <p class="guide">개편 전 버전에서 반품배송비가 공란으로 입력된 상품은 배송정보 수정 시 반품배송비가 무료로 설정됩니다. 설정된 반품배송비를 확인해주세요.<br>
                        그룹에 속한 상품은 배송비를 변경할 경우 그룹 내 상품에서 제외될 수 있으므로 유의하시기 바랍니다.<br>
                        스마일배송 상품은 배송정보 변경이 불가합니다. 무료배송 설정은 "기타 정보수정 > 스마일배송 배송비 설정" 기능을 이용하세요.
                    </p>
                </div>
                <!-- 반품교환 -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsDeliveryModal_submit()">수정</button>
            </div>

        </div>
    </div>
</div>
<!-- 배 송 방 법 변 경 -->
<script>
    function goodsDeliveryModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsDeliveryModal").modal("show");
    }

    function goodsDeliveryModal_submit() {
        let goodsBatch_type = "goodsDelivery";

        let formData = new FormData();
        formData.append("goodsBatch_type",goodsBatch_type);

        // 모든 input 요소 처리
        $("#goodsDeliveryModal input").each(function() {
            let input = $(this);
            if (input.attr('type') === 'checkbox' || input.attr('type') === 'radio') {
                if (input.is(':checked')) {
                    formData.append(input.attr('name'), input.val());
                }
            } else {
                formData.append(input.attr('name'), input.val().trim());
            }
        });

        // 모든 select 요소 처리
        $("#goodsDeliveryModal select").each(function() {
            let select = $(this);
            formData.append(select.attr('name'), select.val());
        });

        setGoodsBatch(formData);
    }

    // 배송방법 체크박스
    $('#use_shippingMethod').change(function() {
        if ($(this).is(':checked')) {
            $('#div_use_shippingMethod').show();
            $('#div_use_shippingMethod').css({"margin-top": "20px"})
        } else {
            $('#div_use_shippingMethod').hide();
        }
    });

    // 발송정책 체크박스
    $('#use_shippingPolicy').change(function() {
        if ($(this).is(':checked')) {
            $('#div_use_shippingPolicy').show();
            $('#div_use_shippingPolicy').css({"margin-top": "20px"})
        } else {
            $('#div_use_shippingPolicy').hide();
        }
    });

    // 묶음배송/배송비 체크박스
    $('#use_shippingBundle').change(function() {
        if ($(this).is(':checked')) {
            $('#div_use_shippingBundle').show();
            $('#div_use_shippingBundle').css({"margin-top": "20px"})
        } else {
            $('#div_use_shippingBundle').hide();
        }
    });

    // 반품정보 체크박스
    $('#use_shippingReturn').change(function() {
        if ($(this).is(':checked')) {
            $('#div_use_shippingReturn').show();
            $('#div_use_shippingReturn').css({"margin-top": "20px"})
        } else {
            $('#div_use_shippingReturn').hide();
        }
    });

    $("input[name='shippingType']").change(function () {
        if ($(this).val() == "1") {
            $("#div_shippingType").show();
        } else {
            $("#div_shippingType").hide();
        }
    });

    $('#quickService').change(function() {
        if ($(this).is(':checked')) {
            $('#div_deliQuickBox').show();
        } else {
            $('#div_deliQuickBox').hide();
        }
    });

    $("#quick_0200").change(function () {
        if ($(this).is(':checked')) {
            $('#div_gyeonggiList').show();
        } else {
            $('#div_gyeonggiList').hide();
        }
    });

    $('input[name="shippingType"]').change(function() {
        if ($(this).val() == '1') {
            $('#div_shippingType').show();
        } else {
            $('#div_shippingType').hide();
        }
    });

    if ($('input[name="shippingType"]:checked').val() == '1') {
        $('#div_shippingType').show();
    } else {
        $('#div_shippingType').hide();
    }


    $('input[type="checkbox"][name="quickList[]"]').change(function() {
        let value = $(this).val();

        if(value == "0200"){
            if($(this).is(':checked')){
                $("#div_gyeonggiList").show();
            } else {
                $("#div_gyeonggiList").hide();
            }
        }
    });

    $("#placeNo").change(function () {
        let placeNo = $("#placeNo").val();
        getDeliveryTmplIdList(placeNo);
    });

    function getDeliveryTmplIdList(placeNo, bundelDeliveryTmplId=""){
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;

        if(placeNo == ""){
            $('#deliveryTmplId').html('<addon value="">출고지를 먼저 선택해주세요</addon>');
            isAjaxIng = false;
            return ;
        }

        $('#deliveryTmplId').html('<addon value="">선택해주세요</addon>');

        let formData = new FormData();
        formData.append("placeNo",placeNo);
        $.ajax({
            url: '<?= base_url("goods/getDeliveryTmplIdList")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                let bundle_policies_list = data.list;
                if (bundle_policies_list.length === 0) {
                    $('#deliveryTmplId').html('<addon value="">선택된 출고지에는 묶음배송정책이 없습니다.</addon>');
                } else {
                    bundle_policies_list.forEach(function(data) {
                        var feeType = "무료";
                        if(data.feeType == "2") {
                            feeType = "배송비:" + (data.fee).toLocaleString() + "원";
                        } else if(data.feeType == "3") {
                            feeType = (data.shippingFeeCondition).toLocaleString() + "원 이상 구매시 무료";
                        }

                        var isPrepayment = ", 선불:O";
                        if(!data.isPrepayment){
                            isPrepayment = ", 선불:X";
                        }

                        var isCashOnDelivery = ", 착불:O";
                        if(!data.isCashOnDelivery){
                            isCashOnDelivery = ", 착불:X";
                        }

                        var text = feeType + isPrepayment + isCashOnDelivery;

                        let textSelected = "";
                        if(bundelDeliveryTmplId == data.policyNo){
                            textSelected = "selected";
                        }

                        var addon = $('<option '+textSelected+'></option>').val(data.policyNo).text(text);
                        $('#deliveryTmplId').append(addon);
                    });
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
            }
        });
    }

    $(function() {
        let placeNo = $("#placeNo").val();
        console.log(placeNo);
        let bundelDeliveryTmplId = $("#bundelDeliveryTmplId").val();
        if(placeNo != "" && bundelDeliveryTmplId){
            getDeliveryTmplIdList(placeNo, bundelDeliveryTmplId);
        }

    });

    $('input[name="shippingPolicyFeeType"]').change(function() {
        if ($(this).val() == '1') {
            $('#div_shippingPolicyFeeType2').hide();
            $('#div_shippingPolicyFeeType1').show();
        } else if ($(this).val() == '2') {
            $('#div_shippingPolicyFeeType1').hide();
            $('#div_shippingPolicyFeeType2').show();
        }
    });

    $('input[name="eachFeeType"]').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue == '1') {
            $('#div_paid').hide();
            $('#div_conditional').hide();
        } else if (selectedValue == '2') {
            $('#div_paid').show();
            $('#div_conditional').hide();
        } else if (selectedValue == '3') {
            $('#div_paid').hide();
            $('#div_conditional').show();
        }
    });
</script>
<!-- 배 송 방 법 변 경 -->

<!-- 프로모션 문구 -->
<div class="modal fade" id="goodsPromoModal" tabindex="-1" aria-labelledby="goodsPromoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsPromoModalLabel">프로모션 문구</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="flex ai-c gap5">
                    <input type="text" class="border_gray" id="input_goodsPromo" name="input_goodsPromo"/>
                </div>
                <br>
                <p class="guide">
                    프로모션 문구는 상품명을 포함하여 최대 한글 50자, 영문/숫자 100자까지 입력 가능합니다.
                    <br>
                    1+1행사 중, 사은품 증정 등 판매 촉진을 위한 문구를 입력해보세요.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsPromoModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 프 로 모 션 문 구 -->
<script>
    function goodsPromoModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsPromoModal").modal("show");
    }

    function goodsPromoModal_submit() {
        let goodsBatch_type = "goodsPromo";

        let formData = new FormData();
        formData.append("goodsBatch_type",goodsBatch_type);
        formData.append("input_goodsPromo", $("#input_goodsPromo").val().trim());
        setGoodsBatch(formData);
    }
</script>
<!-- 프 로 모 션 문 구 -->

<!-- 최대 구매 수량 -->
<div class="modal fade" id="goodsMaxModal" tabindex="-1" aria-labelledby="goodsMaxModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsMaxModalLabel">최대 구매 수량</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<!--                <h1 class="box_white">
                    * 선택한 상품 <span class="color-blue">0</span>개의 최대 구매 수량을 변경합니다.
                </h1>-->
                <br>
                <div class="select flex gap20">
                    <input type="radio" id="useBuyAble1" name="useBuyAble" value="T">
                    <label for="useBuyAble1">
                        <i class="fa-duotone fa-circle-check"></i> 설정함
                    </label>
                    <input type="radio" id="useBuyAble2" name="useBuyAble" value="F" checked>
                    <label for="useBuyAble2">
                        <i class="fa-duotone fa-circle-check"></i> 설정안함
                    </label>
                </div>
                <br>
                <div class="box_whiteline2" id="div_goodsMax" style="display: none">
                    <!--                    최대구매 수량 설정함일때-->
                    <p>제한설정</p>

                    <div class="flex gap20">
                        <div class="input_radio">
                            <input type="radio" id="buyableQuantity1" name="buyableQuantityChild" value="1" checked>
                            <label for="buyableQuantity1">
                                <i class="fa-duotone fa-circle-check"></i>최대구매제한
                            </label>
                        </div>
                        <div class="input_radio">
                            <input type="radio" id="buyableQuantity3" name="buyableQuantityChild" value="3">
                            <label for="buyableQuantity3">
                                <i class="fa-duotone fa-circle-check"></i>기간제한
                            </label>
                        </div>
                        <div class="input_radio">
                            <input type="radio" id="buyableQuantity2" name="buyableQuantityChild" value="2">
                            <label for="buyableQuantity2">
                                <i class="fa-duotone fa-circle-check"></i>ID당 1회 제한
                            </label>
                        </div>
                    </div>
                    <p class="flex gap10" id="p_buyableQuantity1">
                        구매자 1명이 최대 <input type="text" class="border_gray" style="width:100px" value="0" id="buyableQuantityQty" name="buyableQuantityQty">개 까지 구매가능(최대 999개)
                    </p>
                    <p class="flex gap10" style="display: none" id="p_buyableQuantity3">
                        구매자 1명이 최대 <input type="text" class="border_gray" style="width:100px" id="buyableQuantityDay" name="buyableQuantityDay">일 동안 최대<input type="text" class="border_gray" style="width:100px" id="buyableQuantityDayQty" name="buyableQuantityDayQty">개 까지 구매가능
                    </p>
                    <p class="flex gap10" style="display: none" id="p_buyableQuantity2">
                        ID당 1회 구매시 최대 <input type="text" class="border_gray" style="width:100px" id="buyableQuantityOneQty" name="buyableQuantityOneQty">개 까지 구매가능
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsMaxModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 최 대 구 매 수 량 -->
<script>
    function goodsMaxModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsMaxModal").modal("show");
    }

    function goodsMaxModal_submit() {
        let goodsBatch_type = "goodsMax";

        let formData = new FormData();
        formData.append("goodsBatch_type", goodsBatch_type);

        formData.append("useBuyAble", $("input[name='useBuyAble']:checked").val().trim())
        formData.append("buyableQuantityChild", $('input[name="buyableQuantityChild"]:checked').val());
        formData.append("buyableQuantityQty", $("#buyableQuantityQty").val().trim());
        formData.append("buyableQuantityDays", $("#p_buyableQuantity3 input:eq(0)").val().trim());
        formData.append("buyableQuantityDayQty", $("#p_buyableQuantity3 input:eq(1)").val().trim());
        formData.append("buyableQuantityOnceQty", $("#p_buyableQuantity2 input").val().trim());

        setGoodsBatch(formData);
    }

    $("input[name=useBuyAble]").on('change',function () {
        if($(this).val() == "T"){
            $("#div_goodsMax").show();
        } else {
            $("#div_goodsMax").hide();
        }
    });

    function toggleVisibility() {
        var value = $('input[name="buyableQuantityChild"]:checked').val();
        $('#p_buyableQuantity1').hide();
        $('#p_buyableQuantity2').hide();
        $('#p_buyableQuantity3').hide();

        if (value == '1') {
            $('#p_buyableQuantity1').show();
        } else if (value == '2') {
            $('#p_buyableQuantity2').show();
        } else if (value == '3') {
            $('#p_buyableQuantity3').show();
        }
    }

    $('input[name="buyableQuantityChild"]').change(function() {
        toggleVisibility();
    });
</script>
<!-- 최 대 구 매 수 량 -->

<!-- 사은품 -->
<div class="modal fade" id="goodsBenefitModal" tabindex="-1" aria-labelledby="goodsBenefitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsBenefitModalLabel">사은품</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<!--                <h1 class="box_white">
                    * 선택한 상품 <span class="color-blue">0</span>개의 사은품/덤을 변경합니다.
                </h1>-->
                <div class="box_white2">
                    <p>사은품</p>
                    <div class="select flex gap20">
                        <input type="radio" id="useBenefit1" name="useBenefit" value="T">
                        <label for="useBenefit1">
                            <i class="fa-duotone fa-circle-check"></i> 설정함
                        </label>
                        <input type="radio" id="useBenefit2" name="useBenefit" value="F" checked>
                        <label for="useBenefit2">
                            <i class="fa-duotone fa-circle-check"></i> 설정안함
                        </label>
                    </div>
                </div>
                <div style="display: none" id="div_useBenefit">
                    <div class="box_white">
                        <input type="text" class="border_gray" id="input_benefit" name="input_benefit">
                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>증정할 사은품을 입력해주세요.
                        </p>
                        <p>사은품 관리코드</p>
                        <input type="text" class="border_gray" id="input_benefit_code" name="input_benefit_code">
                    </div>
                </div>

                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsBenefitModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 사 은 품 -->
<script>
    function goodsBenefitModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsBenefitModal").modal("show");
    }

    function goodsBenefitModal_submit() {
        let goodsBatch_type = "goodsBenefit";

        let formData = new FormData();
        formData.append("goodsBatch_type", goodsBatch_type);

        formData.append("useBenefit", $("input[name='useBenefit']:checked").val().trim());
        formData.append("input_benefit", $("#input_benefit").val().trim());
        formData.append("input_benefit_code", $("#input_benefit_code").val().trim());

        setGoodsBatch(formData);
    }

    $("input[name=useBenefit]").on('change',function () {
        if($(this).val() == "T"){
            $("#div_useBenefit").show();
        } else {
            $("#div_useBenefit").hide();
        }
    });
</script>
<!-- 사 은 품 -->

<!-- 덤 덤 덤 덤 -->
<div class="modal fade" id="goodsMoreModal" tabindex="-1" aria-labelledby="goodsMoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsMoreModalLabel">사은품/덤</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<!--                <h1 class="box_white">
                    * 선택한 상품 <span class="color-blue">0</span>개의 사은품/덤을 변경합니다.
                </h1>-->
                <div class="box_white2">
                    <p>덤</p>
                    <div class="select flex gap20">
                        <input type="radio" id="useMore1" name="useMore" value="T">
                        <label for="useMore1">
                            <i class="fa-duotone fa-circle-check"></i> 설정함
                        </label>
                        <input type="radio" id="useMore2" name="useMore" value="F" checked>
                        <label for="useMore2">
                            <i class="fa-duotone fa-circle-check"></i> 설정안함
                        </label>
                    </div>
                </div>
                <div id="div_useMore" style="display: none">
                    <div class="box_white">
                        <div class="flex gap10">
                            <input type="text" id="input_moreBase" name="input_moreBase" placeholder="덤 기준 주문수량 (1~99까지 입력 가능)" class="border_gray w100px">
                            <p>+</p>
                            <input type="text" id="input_moreBonus" name="input_moreBonus" placeholder="덤 제공 수량 (1~99까지 입력 가능)" class="border_gray w100px">
                        </div>
                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>최대 2자리 숫자까지만 입력 가능합니다. 입력예시) 1+1, 2+1.
                        </p>
                        <p>덤 관리코드</p>
                        <input type="text" class="border_gray" id="input_moreCode" name="input_moreCode">
                    </div>
                </div>


                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsMoreModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 덤 덤 덤 덤 -->
<script>
    function goodsMoreModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsMoreModal").modal("show");
    }

    function goodsMoreModal_submit() {
        let goodsBatch_type = "goodsMore";

        let formData = new FormData();
        formData.append("goodsBatch_type", goodsBatch_type);

        formData.append("useMore", $("input[name='useMore']:checked").val().trim());
        formData.append("input_moreBase", $("#input_moreBase").val().trim());
        formData.append("input_moreBonus", $("#input_moreBonus").val().trim());
        formData.append("input_moreCode", $("#input_moreCode").val().trim());

        setGoodsBatch(formData);
    }

    $("input[name=useMore]").on('change',function () {
        if($(this).val() == "T"){
            $("#div_useMore").show();
        } else {
            $("#div_useMore").hide();
        }
    });
</script>
<!-- 덤 덤 덤 덤 -->

<!-- 선물하기 설정 -->
<div class="modal fade" id="goodsGiftModal" tabindex="-1" aria-labelledby="goodsGiftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsGiftModalLabel">선물하기 설정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="box_white">
                    * 선택한 상품 <span class="color-blue">0</span>개의 선물하기 설정을 변경합니다.
                </h1>
                <div class="box_white2">
                    <p>선물하기 상품</p>
                    <div class="select flex gap20">
                        <input type="radio" id="" name="" value="T">
                        <label for="">
                            <i class="fa-duotone fa-circle-check"></i> 설정함
                        </label>
                        <input type="radio" id="" name="" value="F">
                        <label for="">
                            <i class="fa-duotone fa-circle-check"></i> 설정안함
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary">수정</button>
            </div>
        </div>
    </div>
</div>


<!-- 포털 가격비교 설정 -->
<div class="modal fade" id="goodsCompareModal" tabindex="-1" aria-labelledby="goodsCompareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsCompareModalLabel">포털 가격비교 사이트</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="box_white">
                    * 선택한 상품 <span class="color-blue">0</span>개의 포털 가격비교 사이트 등록여부를 변경합니다.
                </h1>
                <div class="box_white2">
                    <p>상품 등록</p>
                    <div class="select flex gap20">
                        <input type="radio" id="use_goodsCompare1" name="use_goodsCompare" value="T">
                        <label for="use_goodsCompare1">
                            <i class="fa-duotone fa-circle-check"></i> 설정함
                        </label>
                        <input type="radio" id="use_goodsCompare2" name="use_goodsCompare" value="F" checked>
                        <label for="use_goodsCompare2">
                            <i class="fa-duotone fa-circle-check"></i> 설정안함
                        </label>
                    </div>
                </div>
                <p class="guide">'등록함'으로 설정한 경우, 포털 가격비교 사이트를 통한 주문발생 시 판매가의 2%가 서비스 이용료로 부과됩니다.</p>
                <div id="div_goodsCompare" style="display: none">
                    <br>
                    <div class="box_white2">
                        <p>옥션 쿠폰적용</p>
                        <div class="select flex gap20">
                            <input type="radio" id="use_CouponIac1" name="use_CouponIac" value="T" checked>
                            <label for="use_CouponIac1">
                                <i class="fa-duotone fa-circle-check"></i> 설정함
                            </label>
                            <input type="radio" id="use_CouponIac2" name="use_CouponIac" value="F">
                            <label for="use_CouponIac2">
                                <i class="fa-duotone fa-circle-check"></i> 설정안함
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsCompareModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 포 털 가 격 비 교 -->
<script>
    function goodsCompareModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsCompareModal").modal("show");
    }

    function goodsCompareModal_submit() {
        let goodsBatch_type = "goodsCompare";

        let formData = new FormData();
        formData.append("goodsBatch_type", goodsBatch_type);

        formData.append("use_goodsCompare", $("input[name='use_goodsCompare']:checked").val().trim());
        formData.append("use_CouponIac", $("input[name='use_CouponIac']:checked").val().trim());

        setGoodsBatch(formData);
    }

    $("input[name=use_goodsCompare]").on('change',function () {
        if($(this).val() == "T"){
            $("#div_goodsCompare").show();
        } else {
            $("#div_goodsCompare").hide();
        }
    });
</script>
<!-- 포 털 가 격 비 교 -->

<!-- 판매자지급 스마일캐시 -->
<div class="modal fade" id="goodsSmileModal" tabindex="-1" aria-labelledby="goodsSmileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsSmileModalLabel">판매자지급 스마일캐시</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="select flex gap20">
                        <input type="radio" id="useSmile1" name="useSmile" value="T">
                        <label for="useSmile1">
                            <i class="fa-duotone fa-circle-check"></i> 설정함
                        </label>
                        <input type="radio" id="useSmile2" name="useSmile" value="F" checked>
                        <label for="useSmile2">
                            <i class="fa-duotone fa-circle-check"></i> 설정안함
                        </label>
                    </div>
                    <div id="div_useSmile" class="box_whiteline2" style="display: none; margin-top: 20px">
                        <div class="flex ai-c gap5">
                            <input type="text" class="border_gray" id="input_smile" name="input_smile"/>%
                        </div>
                        <br>
                        <p class="guide">
                            적립률은 0.5%~50%까지, 0.1%단위로 입력해주세요.
                        </p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsSmileModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 스 마 일 캐 시 -->
<script>
    function goodsSmileModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsSmileModal").modal("show");
    }

    function goodsSmileModal_submit() {
        let goodsBatch_type = "goodsSmile";

        let formData = new FormData();
        formData.append("goodsBatch_type", goodsBatch_type);

        formData.append("useSmile", $("input[name='useSmile']:checked").val().trim());
        formData.append("input_smile", $("#input_smile").val().trim());

        setGoodsBatch(formData);
    }

    $("input[name=useSmile]").on('change',function () {
        if($(this).val() == "T"){
            $("#div_useSmile").show();
        } else {
            $("#div_useSmile").hide();
        }
    });
</script>
<!-- 스 마 일 캐 시 -->

<!-- 일괄 변경 완료 -->
<div class="modal fade" id="goodsEditDoneModal" tabindex="-1" aria-labelledby="goodsEditDoneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsEditDoneModalLabel">일괄 변경 완료 현황</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>상품번호</th>
                            <th>상태</th>
                            <th>실패사유</th>
                        </tr>
                        </thead>
                        <tbody id="goodsEditDoneTbody">
                        <tr>
                            <td>상품번호</td>
                            <td>완료</td>
                            <td>-</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 후원/나눔 -->
<div class="modal fade" id="goodsDonateModal" tabindex="-1" aria-labelledby="goodsDonateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodsDonateModalLabel">후원/나눔쇼핑</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>지마켓 후원쇼핑</h1>
                <div class="select flex gap20">
                    <input type="radio" id="useDonate_gmkt1" name="useDonate_gmkt" value="T">
                    <label for="useDonate_gmkt1">
                        <i class="fa-duotone fa-circle-check"></i> 설정함
                    </label>
                    <input type="radio" id="useDonate_gmkt2" name="useDonate_gmkt" value="F" checked>
                    <label for="useDonate_gmkt2">
                        <i class="fa-duotone fa-circle-check"></i> 설정안함
                    </label>
                </div>
                <div class="box_white2" id="div_useDonate_gmkt" style="display: none">
                    <p>후원금액</p>
                    <div class="input_unit">
                        <input type="text" id="money_gmkt" name="money_gmkt" placeholder="숫자만 입력해주세요." class="border_gray">
                        원<!--<div class="input_select">
                            <select class="border_gray" id="donateType_gmkt" name="donateType_gmkt">
                                <option value="2">%</option>
                                <option value="1">원</option>
                            </select>
                        </div>-->
                    </div>
                    <p class="guide">* 100원 이상 등록가능 * 판매가 80% 까지 설정 가능</p>
                    <p>누적적립한도액</p>
                    <div class="input_unit">
                        <input type="text" id="maxMoney_gmkt" name="maxMoney_gmkt" placeholder="숫자만 입력해주세요." class="border_gray">
                        원
                    </div>
                    <p class="guide">* 10,000원 이상만 등록 가능</p>
                    <p>후원분야</p>
                    <div class="input_select">
                        <select class="border_gray" id="donateType_gmkt" name="donateType_gmkt">
                            <option value="1">아동복지</option>
                            <option value="2">여성권익</option>
                            <option value="3">환경보호</option>
                            <option value="4">국제구호</option>
                            <option value="5">소비자권익</option>
                        </select>
                    </div>
                    <p>후원 시작일 - 후원 종료일</p>
                    <div class="input_date">
                        <input type="date" class="border_gray" id="donateStartDate_gmkt" name="donateStartDate_gmkt">
                        ~
                        <input type="date" class="border_gray" id="donateEndDate_gmkt" name="donateEndDate_gmkt">
                    </div>
                </div>
                <br>
                <h1>옥션 나눔쇼핑</h1>
                <div class="select flex gap20">
                    <input type="radio" id="useDonate_iac1" name="useDonate_iac" value="T">
                    <label for="useDonate_iac1">
                        <i class="fa-duotone fa-circle-check"></i> 설정함
                    </label>
                    <input type="radio" id="useDonate_iac2" name="useDonate_iac" value="F" checked>
                    <label for="useDonate_iac2">
                        <i class="fa-duotone fa-circle-check"></i> 설정안함
                    </label>
                </div>
                <div class="box_white2" style="display: none" id="div_useDonate_iac">
                    <p>나눔 시작일 - 나눔 종료일</p>
                    <div class="input_date">
                        <input type="date" class="border_gray" id="donateStartDate_iac" name="donateStartDate_iac">
                        ~
                        <input type="date" class="border_gray" id="donateEndDate_iac" name="donateEndDate_iac">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="goodsDonateModal_submit()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 후 원 나 눔 -->
<script>
    function goodsDonateModal() {
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }
        $("#goodsDonateModal").modal("show");
    }

    function goodsDonateModal_submit() {
        let goodsBatch_type = "goodsDonate";

        let formData = new FormData();
        formData.append("goodsBatch_type", goodsBatch_type);

        // 모든 input 요소 처리
        $("#goodsDonateModal input").each(function() {
            let input = $(this);
            if (input.attr('type') === 'checkbox' || input.attr('type') === 'radio') {
                if (input.is(':checked')) {
                    formData.append(input.attr('name'), input.val());
                }
            } else {
                formData.append(input.attr('name'), input.val().trim());
            }
        });

        // 모든 select 요소 처리
        $("#goodsDonateModal select").each(function() {
            let select = $(this);
            formData.append(select.attr('name'), select.val());
        });

        setGoodsBatch(formData);
    }

    $("input[name=useDonate_gmkt]").on('change',function () {
        if($(this).val() == "T"){
            $("#div_useDonate_gmkt").show();
        } else {
            $("#div_useDonate_gmkt").hide();
        }
    });

    $("input[name=useDonate_iac]").on('change',function () {
        if($(this).val() == "T"){
            $("#div_useDonate_iac").show();
        } else {
            $("#div_useDonate_iac").hide();
        }
    });
</script>
<!-- 후 원 나 눔 -->

<style>
    ul.tabs li.current {
        font-weight: 800;
        position: relative;
    }
    ul.tabs li.current::after {
        content: '';
        display: inline-block;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: #087FB2;
    }
</style>
<script>
    
    // 삭제
    function goodsDeleteModal(){
        if (selectedValues.length === 0) {
            swal("하나 이상 체크해주세요");
            return false;
        }

        Swal.fire({
            title: '정말 삭제하시겠습니까?',
            text: '삭제 처리 전 지마켓, 옥션 상품은 판매중지된 상태 이어야 합니다.',
            showCancelButton: true,
            confirmButtonText: '삭제',
            cancelButtonText: '아니오',
            reverseButtons: true,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                let goodsBatch_type = "goodsDelete";

                let formData = new FormData();
                formData.append("goodsBatch_type",goodsBatch_type);
                setGoodsBatch(formData);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // 아니오 버튼을 눌렀을 때의 동작
                console.log('삭제가 취소되었습니다.');
            }
        });
    }

    $('#goodsEditDoneModal').on('hide.bs.modal', function () {
        // 여기에 모달이 닫힐 때 실행할 코드를 작성합니다.
        location.reload();
    });

    $(document).ready(function(){

        $('ul.tabs li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        })

    })
</script>