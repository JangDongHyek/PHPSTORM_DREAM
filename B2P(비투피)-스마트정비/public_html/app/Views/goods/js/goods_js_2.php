<script>
    let optionCounter = $('#div_optionName').children().length+1;

    function updateOptionButtons() {
        const optType = $('input[name="optsType"]:checked').val();
        const nameDivs = $('#div_optionName .input_select');
        const valueDivs = $('#div_optionValue .option-value');

        const minOptions = optType === 'i' ? 1 : 2;
        const maxOptions = optType === 'i' ? 5 : 3;



        // 첫 번째 옵션의 추가 버튼 표시
        $('.option-value .add-btn').hide();
        $('#div_optionValue .option-value:first .add-btn').toggle(nameDivs.length < maxOptions);

        // 최소 옵션 개수일 때 삭제 버튼 숨기기
        $('.option-value .delete-btn').show();
        $('#div_optionValue .option-value:first .delete-btn').hide();
    }

    function addOption() {
        const optionId = `option-${optionCounter++}`;
        const nameHtml = `<div class="input_select option-name" data-id="${optionId}">
                            <input type="text" placeholder="옵션명을 입력해주세요." name="makeOptionName[]" class="border_gray" value="">
                          </div>`;
        const valueHtml = `<div class="flex gap10 option-value" data-id="${optionId}">
                            <input type="text" placeholder="콤마(‘,’)로 구분해서 입력해주세요" name="makeOptionValue[]" class="border_gray" value="">
                            <button type="button" class="flex gap5 btn btn-blue add-btn"><i class="fa-light fa-plus"></i>추가</button>
                            <button type="button" class="flex gap5 btn btn-white delete-btn" data-id="${optionId}"><i class="fa-light fa-xmark"></i>삭제</button>
                          </div>`;
        $('#div_optionName').append(nameHtml);
        $('#div_optionValue').append(valueHtml);

        updateOptionButtons();
    }

    function deleteOption(button) {
        const optionId = $(button).data('id');
        $(`#div_optionName .input_select[data-id="${optionId}"]`).remove();
        $(`#div_optionValue .option-value[data-id="${optionId}"]`).remove();
        updateOptionButtons();
    }

    function initializeOptions() {
        const optType = $('input[name="optsType"]:checked').val();
        const optionNameDiv = $('#div_optionName');

        if (optionNameDiv.children().length === 0) {
            if (optType === 'i') {
                // 단독형 기본 1개
                addOption();
            } else if (optType === 'c') {
                // 조합형 기본 2개
                addOption();
                addOption();
            }
        }

        updateOptionButtons();
    }

    $(document).on('click', '.add-btn', function () {
        addOption();
    });

    $(document).on('click', '.delete-btn', function () {
        deleteOption(this);
    });

    $('input[name="optsType"]').change(function () {
        $('#div_optionValue').empty();
        $('#div_optionName').empty();
        initializeOptions();
    });

    // 초기화 시 기본 옵션 설정
    initializeOptions();

    // 옵션 목록에 추가 버튼 클릭 시
    $('#add_options').click(function() {
        var selectedOptionType = $('input[name="optsType"]:checked').val();
        var optionList = $('#option_list');
        var optionTableHead = $('#option_table_head');
        optionList.empty();
        optionTableHead.empty();

        var optionNames = $('input[name="makeOptionName[]"]').map(function() {
            return $(this).val();
        }).get();

        var optionValues = $('input[name="makeOptionValue[]"]').map(function() {
            return $(this).val();
        }).get();

        var isStockManagerChecked = $('#optionStockmanager').is(':checked');

        if (selectedOptionType === "i") {
            // 단독형 옵션 처리

            // 테이블 헤드 생성
            var headRow = '<tr>';
            headRow += '<th width="50px"><div class="input_checkbox"><input type="checkbox" id="option-selectall"><label for="option-selectall"><i class="fa-duotone fa-square-check txt-lg"></i></label></div></th>';
            headRow += '<th>옵션명</th>';
            headRow += '<th>옵션값</th>';
            headRow += '<th>추가금 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionExtraPrice">일괄수정</button></th>';
            headRow += '<th class="stock-column">재고수량 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionStock">일괄수정</button></th>';
            headRow += '<th>판매상태 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionSaleStatus">일괄수정</button></th>';

            headRow += '<th>노출여부 <button type="button" class="btn btn-sm btn-white batch_update" data-field="optionDisplayStatus">일괄수정</button></th>';
            headRow += '<th>삭제</th>';
            headRow += '</tr>';
            optionTableHead.append(headRow);

            // 테이블 바디 생성
            optionNames.forEach(function(optionName, index) {
                var values = optionValues[index].split(',');
                values.forEach(function(value, rowIndex) {
                    var row = '<tr>';
                    row += '<td><div class="input_checkbox"><input type="checkbox" class="row-select" id="checkbox_option_' + index + rowIndex + '"><label for="checkbox_option_' + index + rowIndex + '"><i  class="fa-duotone fa-square-check txt-lg"></i></label></div></td>';
                    row += '<td><span>' + optionName + '</span><input type="hidden" name="optionName[]" value="' + optionName + '"></td>';
                    row += '<td><input type="text" name="optionValue[]" value="' + value.trim() + '" class="border_gray"></td>';
                    row += '<td><input type="text" name="optionExtraPrice[]" value="0" class="border_gray"></td>';
                    row += '<td class="stock-column"><input type="text" name="optionStock[]" value="99999" class="border_gray"></td>';
                    row += '<td><div class="input_select"><select name="optionSaleStatus[]" class="border_gray"><option value="T">판매가능</option><option value="F">품절</option></select></div></td>';

                    row += '<td><div class="input_select"><select name="optionDisplayStatus[]" class="border_gray"><option value="T">노출</option><option value="F">미노출</option></select></div></td>';
                    row += '<td><button type="button" class="btn btn-sm btn-white delete-row">삭제</button></td>';
                    row += '</tr>';
                    optionList.append(row);
                });
            });
        } else if (selectedOptionType === "c") {
            // 조합형 옵션 처리

            if (optionValues.some(function(value) { return value.trim() === ""; })) {
                alert('옵션 값을 입력해 주세요.');
                return;
            }

            // 테이블 헤드 생성
            var headRow = '<tr>';
            headRow += '<th width="50px"><div class="input_checkbox"><input type="checkbox" id="option-selectall"><label for="option-selectall"><i class="fa-duotone fa-square-check txt-lg"></i></label></div></th>';
            optionNames.forEach(function(optionName) {
                headRow += '<th>' + optionName + '<input type="hidden" name="optionName[]" value="' + optionName + '"></th>';
            });
            headRow += '<th>추가금<button type="button" class="btn btn-sm btn-white batch_update" data-field="optionExtraPrice">일괄수정</button></th>';
            headRow += '<th class="stock-column">재고수량<button type="button" class="btn btn-sm btn-white batch_update" data-field="optionStock">일괄수정</button></th>';
            headRow += '<th>판매상태<button type="button" class="btn btn-sm btn-white batch_update" data-field="optionSaleStatus">일괄수정</button></th>';

            headRow += '<th>노출여부<button type="button" class="btn btn-sm btn-white batch_update" data-field="optionDisplayStatus">일괄수정</button></th>';
            headRow += '<th>삭제</th>';
            headRow += '</tr>';
            optionTableHead.append(headRow);

            // 테이블 바디 생성
            var combinations = generateCombinations(optionValues);
            combinations.forEach(function(combination, rowIndex) {
                var row = '<tr id="row_combo_option_' + rowIndex + '">';
                row += '<td><div class="input_checkbox"><input type="checkbox" id="checkbox_combo_option_' + rowIndex + '" class="row-select"><label for="checkbox_combo_option_' + rowIndex + '"><i class="fa-duotone fa-square-check txt-lg"></i></label></div></td>';
                combination.forEach(function(value, colIndex) {
                    row += '<td><input type="text" name="optionValue'+colIndex+'[]" value="' + value + '" class="border_gray"></td>';
                });
                row += '<td><input type="text" name="optionExtraPrice[]" value="0" class="border_gray"></td>';
                row += '<td class="stock-column"><input type="text" name="optionStock[]" value="99999" class="border_gray"></td>';
                row += '<td><div class="input_select"><select name="optionSaleStatus[]" class="border_gray"><option value="T">판매가능</option><option value="F">품절</option></select></div></td>';

                row += '<td><div class="input_select"><select name="optionDisplayStatus[]" class="border_gray"><option value="T">노출</option><option value="F">미노출</option></select></div></td>';
                row += '<td><button type="button" class="btn btn-sm btn-white delete-row" data-id="row_combo_option_' + rowIndex + '">삭제</button></td>';
                row += '</tr>';
                optionList.append(row);
            });
        }

        // 초기 상태에 따라 재고수량 컬럼 표시/숨김 설정
        if (isStockManagerChecked) {
            $('.stock-column').show();
        } else {
            $('.stock-column').hide();
        }

        if (optionList.children().length === 0) {
            optionList.html('<tr class="nodata_tr"><td colspan="9"><p><i class="fa-duotone fa-circle-exclamation"></i>적용된 옵션값이 없습니다</p></td></tr>');
        }
    });

    // 조합 생성 함수
    function generateCombinations(optionValues) {
        var combinations = [];
        function helper(arr, i) {
            var values = optionValues[i].split(',');
            for (var j = 0; j < values.length; j++) {
                var a = arr.slice(0); // 클론 생성
                a.push(values[j].trim());
                if (i == optionValues.length - 1)
                    combinations.push(a);
                else
                    helper(a, i + 1);
            }
        }
        helper([], 0);
        return combinations;
    }

    // 재고수량 관리 체크박스 상태에 따라 재고수량 필드 표시/숨김
    $('#optionStockmanager').change(function() {
        var isChecked = $(this).is(':checked');
        if (isChecked) {
            $('.stock-column').show();
        } else {
            $('.stock-column').hide();
        }
    });

    $('#delete_selected').click(function() {
        $('.row-select:checked').closest('tr').remove();
    });

    $(document).on('click', '.delete-row', function() {
        var parentTd = $(this).closest('tr');
        parentTd.remove();
    });

    $(document).on('click', '#option-selectall', function() {
        var isChecked = $(this).prop('checked');
        $('.row-select').prop('checked', isChecked);
    });

    // 일괄 수정 버튼 클릭 이벤트 핸들러
    $(document).on('click', '.batch_update', function() {
        var field = $(this).data('field');
        var selectedRows = $('.row-select:checked').closest('tr');

        if (selectedRows.length === 0) {
            swal("수정할 행을 선택해주세요.");
            return;
        }

        var swalHtml;
        var inputType;

        switch(field) {
            case 'optionExtraPrice':
                swalHtml = '<input id="swal-input" class="swal2-input w100" placeholder="추가금">';
                inputType = 'input';
                break;
            case 'optionStock':
                swalHtml = '<input id="swal-input" class="swal2-input w100" placeholder="재고수량">';
                inputType = 'input';
                break;
            case 'optionSaleStatus':
                swalHtml = '<select id="swal-input" class="swal2-input w100"><option value="T">판매가능</option><option value="F">품절</option></select>';
                inputType = 'select';
                break;
            case 'optionDisplayStatus':
                swalHtml = '<select id="swal-input" class="swal2-input w100"><option value="T">노출</option><option value="F">미노출</option></select>';
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
                swal('선택된 행이 수정되었습니다.');
            }
        });
    });

    $('input[name="useOptionText"]').change(function() {
        if ($(this).val() === 'T') {
            $('#div_textOption').show();
        } else {
            $('#div_textOption').hide();
        }
    });

    const $textOptionContainer = $('#div_textOptionNameList');
    const $displayOptionContainer = $('#div_displaydiv_textOptionNameList');

    function updateTextButtons() {
        const $textOptionDivs = $textOptionContainer.find('.input_select.option-name');
        const $displayOptionDivs = $displayOptionContainer.find('.option-value');

        $textOptionDivs.each(function(index) {
            const $removeButton = $displayOptionDivs.eq(index).find('.remove-button-text');
            const $addButton = $displayOptionDivs.eq(index).find('.add-button-text');

            if ($textOptionDivs.length === 1) {
                $removeButton.hide();
                $addButton.show();
            } else if ($textOptionDivs.length >= 2 && $textOptionDivs.length <= 4) {
                $removeButton.show();
                $addButton.toggle(index === $textOptionDivs.length - 1);
            } else if ($textOptionDivs.length === 5) {
                $removeButton.show();
                $addButton.hide();
            }
        });
    }

    function addTextOption() {
        const textOptionHtml = `
            <div class="input_select option-name">
                <input type="text" name="textOptionName[]" placeholder="옵션명을 입력해주세요." class="border_gray" value="">
            </div>
        `;
        const displayOptionHtml = `
            <div class="flex gap10 option-value">
                <div class="input_select option-name w50">
                    <select class="border_gray" name="displayTextOptionName[]">
                        <option value="T">노출</option>
                        <option value="F">비노출</option>
                    </select>
                </div>
                <button type="button" class="flex gap5 btn btn-white remove-button-text"><i class="fa-light fa-minus"></i>삭제</button>
                <button type="button" class="flex gap5 btn btn-blue add-button-text"><i class="fa-light fa-plus"></i>추가</button>
            </div>
        `;

        $textOptionContainer.append(textOptionHtml);
        $displayOptionContainer.append(displayOptionHtml);

        updateTextButtons();
    }

    function removeTextOption(index) {
        $textOptionContainer.find('.input_select.option-name').eq(index-1).remove();
        $displayOptionContainer.find('.option-value').eq(index-1).remove();
        updateTextButtons();
    }

    $displayOptionContainer.on('click', '.add-button-text', function() {
        addTextOption();
    });

    $displayOptionContainer.on('click', '.remove-button-text', function() {
        const index = $(this).closest('.option-value').index('.option-value');
        removeTextOption(index);
    });

    updateTextButtons();

</script>