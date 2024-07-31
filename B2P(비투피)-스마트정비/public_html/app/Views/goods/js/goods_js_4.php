<script>

    $(function() {
        getDeliveryCompany();
    });

    function getDeliveryCompany() {
        let api_type = "<?=GMAC?>";
        let formData = new FormData();

        formData.append("api_type", api_type);

        $.ajax({
            url: "<?=base_url('/goods/getDeliveryCompany')?>",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.error('Error occurred:', status);
            },
            complete: function() {
                isAjaxIng = false;
            }
        });
    }

    $('#addImgBtn').click(function(e) {
        e.preventDefault();

        // 현재 추가된 input 필드 개수
        var currentCount = $('#addtionalImg div .flex').length;

        // 14개 이하일 때만 추가
        if (currentCount < 14) {
            $('#addtionalImg').append(`
                        <div class="flex">
                            <input class="border_gray" name="addtionalImg[]" placeholder="링크를 입력해주세요">
                            <button type="button" class="flex gap5 btn btn-white removeBtn"><i class="fa-light fa-xmark"></i>삭제</button>
                        </div>
                    `);
        } else {
            alert('최대 14개의 이미지만 추가할 수 있습니다.');
        }
    });

    // Event delegation to handle dynamically added remove buttons
    $('#addtionalImg').on('click', '.removeBtn', function(e) {
        e.preventDefault();
        $(this).parent().remove(); // 부모 요소인 .flex를 제거
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

    $('#quickService').change(function() {
        if (this.checked) {
            $('#deliQuickBox').show();
        } else {
            $('#deliQuickBox').hide();
        }
    });

    $('#visitAndTake').change(function() {
        if (this.checked) {
            $('#deliPickBox').show();
        } else {
            $('#deliPickBox').hide();
        }
    });

    $('input[name="visitAndTakeType"]').change(function() {
        if ($('#priceDiscount').is(':checked')) {
            $('#priceDiscountBox').show();
            $('#giftBox').hide();
        } else if ($('#gift').is(':checked')) {
            $('#giftBox').show();
            $('#priceDiscountBox').hide();
        } else {
            $('#priceDiscountBox').hide();
            $('#giftBox').hide();
        }
    });

    // Initialize the display based on the initial state of checkboxes
    if ($('#quickService').is(':checked')) {
        $('#deliQuickBox').show();
    } else {
        $('#deliQuickBox').hide();
    }

    if ($('#visitAndTake').is(':checked')) {
        $('#deliPickBox').show();
    } else {
        $('#deliPickBox').hide();
    }

    // Initialize the display based on the initial state of radio buttons
    if ($('#priceDiscount').is(':checked')) {
        $('#priceDiscountBox').show();
        $('#giftBox').hide();
    } else if ($('#gift').is(':checked')) {
        $('#giftBox').show();
        $('#priceDiscountBox').hide();
    } else {
        $('#priceDiscountBox').hide();
        $('#giftBox').hide();
    }

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
        let bundelDeliveryTmplId = $("#bundelDeliveryTmplId").val();
        if(placeNo != "" && bundelDeliveryTmplId){
            getDeliveryTmplIdList(placeNo, bundelDeliveryTmplId);
        }

    });

    $('input[name="useAddonService"]').change(function() {
        if ($(this).val() == 'T') {
            $('#div_useAddonService').show();
        } else {
            $('#div_useAddonService').hide();
        }
    });

    let addonServiceCounter = $('#div_addonServiceName').children().length+1;

    function updateButtons() {
        const nameDivs = $('#div_addonServiceName .input_select');
        const valueDivs = $('#div_addonServiceValue .addonService-value');

        const minAdonServices = 1;
        const maxAddonServices = 5;

        // 첫 번째 옵션의 추가 버튼 표시
        $('.addonService-value .add_addon-btn').hide();
        $('#div_addonServiceValue .addonService-value:first .add_addon-btn').toggle(nameDivs.length < maxAddonServices);

        // 최소 옵션 개수일 때 삭제 버튼 숨기기
        if (nameDivs.length <= minAdonServices) {
            $('.addonService-value .delete_addon-btn').hide();
        } else {
            $('.addonService-value .delete_addon-btn').show();
            $('#div_addonServiceValue .addonService-value:first .delete_addon-btn').hide();
        }
    }

    function addaddonService() {
        const addonServiceId = `addonService-${addonServiceCounter++}`;
        const nameHtml = `<div class="input_select addonService-name" data-id="${addonServiceId}">
                            <input type="text" placeholder="옵션명을 입력해주세요." name="makeAddonServiceName[]" class="border_gray" value="">
                          </div>`;
        const valueHtml = `<div class="flex gap10 addonService-value" data-id="${addonServiceId}">
                            <input type="text" placeholder="콤마(‘,’)로 구분해서 입력해주세요" name="makeAddonServiceValue[]" class="border_gray" value="">
                            <button type="button" class="flex gap5 btn btn-blue add_addon-btn"><i class="fa-light fa-plus"></i>추가</button>
                            <button type="button" class="flex gap5 btn btn-white delete_addon-btn" data-id="${addonServiceId}"><i class="fa-light fa-xmark"></i>삭제</button>
                          </div>`;
        $('#div_addonServiceName').append(nameHtml);
        $('#div_addonServiceValue').append(valueHtml);
        updateButtons();
    }

    function deleteaddonService(button) {
        const addonServiceId = $(button).data('id');
        $(`#div_addonServiceName .input_select[data-id="${addonServiceId}"]`).remove();
        $(`#div_addonServiceValue .addonService-value[data-id="${addonServiceId}"]`).remove();
        updateButtons();
    }

    function initializeaddonServices() {
        if ($('#div_addonServiceName').children().length === 0) {
            addaddonService();
        }


        updateButtons();
    }

    $(document).on('click', '.add_addon-btn', function () {
        addaddonService();
    });

    $(document).on('click', '.delete_addon-btn', function () {
        deleteaddonService(this);
    });

    // 초기화 시 기본 옵션 설정
    initializeaddonServices();

    // 옵션 목록에 추가 버튼 클릭 시
    $('#add_addons').click(function() {
        var addonList = $('#addon_list');
        var addonTableHead = $('#addon_table_head');
        addonList.empty();
        addonTableHead.empty();

        var addonNames = $('input[name="makeAddonServiceName[]"]').map(function() {
            return $(this).val();
        }).get();

        var addonValues = $('input[name="makeAddonServiceValue[]"]').map(function() {
            return $(this).val();
        }).get();

        // 단독형 옵션 처리

        // 테이블 헤드 생성
        var headRow = '<tr>';
        headRow += '<th width="50px"><div class="input_checkbox"><input type="checkbox" id="addon-selectall"><label for="addon-selectall"><i class="fa-duotone fa-square-check txt-lg"></i></label></div></th>';
        headRow += '<th>추가구성명</th>';
        headRow += '<th>추가구성값</th>';
        headRow += '<th>추가금<button type="button" class="btn btn-sm btn-white batch_addon_update" data-field="addonExtraPrice">일괄수정</button></th>';
        headRow += '<th class="stock-column">재고수량<button type="button" class="btn btn-sm btn-white batch_addon_update" data-field="addonStock">일괄수정</button></th>';
        headRow += '<th>판매상태<button type="button" class="btn btn-sm btn-white batch_addon_update" data-field="addonSaleStatus">일괄수정</button></th>';

        headRow += '<th>노출여부<button type="button" class="btn btn-sm btn-white batch_addon_update" data-field="addonDisplayStatus">일괄수정</button></th>';
        headRow += '<th>삭제</th>';
        headRow += '</tr>';
        addonTableHead.append(headRow);

        // 테이블 바디 생성
        addonNames.forEach(function(addonName, index) {
            var values = addonValues[index].split(',');
            values.forEach(function(value, rowIndex) {
                var row = '<tr>';
                row += '<td><div class="input_checkbox"><input type="checkbox" class="row-select" id="checkbox_addon_' + index + rowIndex + '"><label for="checkbox_addon_' + index + rowIndex + '"><i class="fa-duotone fa-square-check txt-lg"></i></label></div></td>';
                row += '<td><span>' + addonName + '</span><input type="hidden" name="addonName[]" value="' + addonName + '"></td>';
                row += '<td><input type="text" name="addonValue[]" value="' + value.trim() + '" class="border_gray"></td>';
                row += '<td><input type="text" name="addonExtraPrice[]" value="0" class="border_gray"></td>';
                row += '<td class="stock-column"><input type="text" name="addonStock[]" value="99999" class="border_gray"></td>';
                row += '<td><div class="input_select"><select name="addonSaleStatus[]" class="border_gray"><option value="T">판매가능</option><option value="F">품절</option></select></div></td>';

                row += '<td><div class="input_select"><select name="addonDisplayStatus[]" class="border_gray"><option value="T">노출</option><option value="F">미노출</option></select></div></td>';
                row += '<td><button type="button" class="btn btn-sm btn-white delete-row">삭제</button></td>';
                row += '</tr>';
                addonList.append(row);
            });
        });

        if (addonList.children().length === 0) {
            addonList.html('<tr class="nodata_tr"><td colspan="9"><p><i class="fa-duotone fa-circle-exclamation"></i>적용된 옵션값이 없습니다</p></td></tr>');
        }
    });


    $('#delete_addon_selected').click(function() {
        $('.row-select:checked').closest('tr').remove();
    });

    $(document).on('click', '.delete-row', function() {
        var parentTd = $(this).closest('tr');
        parentTd.remove();
    });

    $(document).on('click', '#addon-selectall', function() {
        var isChecked = $(this).prop('checked');
        $('.row-select').prop('checked', isChecked);
    });

    // 일괄 수정 버튼 클릭 이벤트 핸들러
    $(document).on('click', '.batch_addon_update', function() {
        var field = $(this).data('field');
        var selectedRows = $('.row-select:checked').closest('tr');

        if (selectedRows.length === 0) {
            swal("수정할 행을 선택해주세요.");
            return;
        }

        var swalHtml;
        var inputType;

        switch(field) {
            case 'addonExtraPrice':
                swalHtml = '<input id="swal-input" class="swal2-input" placeholder="추가금">';
                inputType = 'input';
                break;
            case 'addonStock':
                swalHtml = '<input id="swal-input" class="swal2-input" placeholder="재고수량">';
                inputType = 'input';
                break;
            case 'addonSaleStatus':
                swalHtml = '<select id="swal-input" class="swal2-input"><option value="T">판매가능</option><option value="F">품절</option></select>';
                inputType = 'select';
                break;
            case 'addonDisplayStatus':
                swalHtml = '<select id="swal-input" class="swal2-input"><option value="T">노출</option><option value="F">미노출</option></select>';
                inputType = 'select';
                break;
            default:
                swalHtml = '';
                inputType = 'input';
        }

        Swal.fire({
            title: '일괄 수정',
            html: swalHtml,
            focusConfirm: false,
            preConfirm: () => {
                return {
                    value: $('#swal-input').val()
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var newValue = result.value.value;

                selectedRows.each(function() {
                    if (inputType === 'input') {
                        $(this).find('input[name^="' + field + '"]').val(newValue);
                    } else if (inputType === 'select') {
                        $(this).find('select[name^="' + field + '"]').val(newValue);
                    }
                });
                swal("선택된 행이 수정되었습니다.");
            }
        });
    });



</script>