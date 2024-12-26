/**
 * 공통 검색
 */
(function () {
    'use strict';

    let form, stxInput, dateRangeInputs, sdtInput, edtInput;
    const holdSubmitCheckboxes = ['interest[]', 'area[]', 'category[]']; // 해당 체크박스는 선택시 바로 submit 안됨

    function initSearch(formName = 'searchFrm') {
        form = document[formName];
        if (!form) return;

        stxInput = form['stx'];
        dateRangeInputs = form.querySelectorAll('input[name=dtRange]');
        sdtInput = form['sdt'];
        edtInput = form['edt'];

        addEventListeners();
    }

    function addEventListeners() {
        form.addEventListener('submit', handleSubmit);

        dateRangeInputs.forEach(radio => radio.addEventListener('click', handleDateRangeChange));
        [sdtInput, edtInput].forEach(input => {
            if (input) {
                input.addEventListener('change', handleSubmit);
            }
        });

        form.querySelectorAll('select').forEach(select => {
            if (select.name === 'sfl' || select.name === 'dataType') return;
            select.addEventListener('change', handleSubmit);
        });

        form.querySelectorAll('input[type=checkbox]').forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                if (holdSubmitCheckboxes.includes(e.target.name)) {
                    handleCheckboxes(e.target.name);
                } else {
                    handleSubmit(e);
                }
            })
        });
    }

    function handleSubmit(e) {
        if (e) e.preventDefault();

        if (stxInput && stxInput.value.length === 1) {
            return utils.showToast('검색어를 2자 이상 입력해 주세요.');
        }

        disableHoldCheckboxes();
        disableEmptyInputs();

        utils.showLoading(1);
        form.submit();
    }

    function disableEmptyInputs() {
        form.querySelectorAll("input, select").forEach(element => {
            if ((element.type === 'radio' && !element.checked) || (!element.value)) {
                element.disabled = true;
            }
        });
    }

    function disableHoldCheckboxes() {
        holdSubmitCheckboxes.forEach(name => {
            form.querySelectorAll(`[name="${name}"]`).forEach(checkbox => {
                checkbox.disabled = true;
            });
        });
    }

    // 기간선택 (전체, 오늘, 이번주, 이번달)
    function handleDateRangeChange(e) {
        const dateList = utils.getStartAndEndDate(e.target.value);
        if (sdtInput) sdtInput.value = dateList.start;
        if (edtInput) edtInput.value = dateList.end;
        handleSubmit();
    }

    // 체크박스(name="name[]") get 콤마 처리
    function handleCheckboxes(name) {
        const checkboxes = form.querySelectorAll(`[name="${name}"]:checked`);
        let checkValues = Array.from(checkboxes).map(checkbox => checkbox.value);

        if (checkValues.length > 0) {
            const inputName = removeBrackets(name);
            const getInput = form.querySelector(`[type=hidden][name=${inputName}]`);
            if (getInput) getInput.value = checkValues.join(',');

            // if (!holdSubmitCheckboxes.includes(name)) {
            //     disableHoldCheckboxes();
            // }
        }
    }

    // 대괄호 제거
    function removeBrackets(str) {
        return str.replace(/[\[\]]/g, '');
    }

    // 외부 접근을 위해 전역 객체에 할당
    window.initSearch = initSearch;

})();
