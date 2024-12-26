/**
 * admin. 업체등록
 */
(function () {
    'use strict';

    const form = document.forms['conform'];
    const areaSi = document.querySelector('#areaSi');
    const areaGu = document.querySelector('#area_gu');

    document.addEventListener('DOMContentLoaded', async () => {
        eventListeners();
        // 지역선택
        await utils.changeArea(areaSi, areaGu.value);
    });

    function eventListeners() {
        // 등록
        form.addEventListener('submit', handleCompanyUp);

        // 지역선택
        areaSi.addEventListener('change', async (e) => {
            await utils.changeArea(e.target);
        })
    }


    async function handleCompanyUp(e) {
        e.preventDefault();

        const formCheck = checkFormData();
        if (!formCheck) return false;

        const serviceTypes = Array.from(document.querySelectorAll('input[name="serviceType"]:checked')).map(checkbox => checkbox.value);
        const serviceTypesString = serviceTypes.join(',');
        const formData = new FormData(form);
        formData.append('serviceDesc', $('#editor').summernote('code'));
        formData.append('serviceTypes', serviceTypesString);

        const idx = formData.get('idx');

        if(idx){
            // 수정
            setTimeout(async () => {
                const response = await API.fetchData('/api/companyUpdate', formData);
                if (response.result) {
                    utils.showAlert('업체 수정이 완료되었습니다.', () => {
                        history.back();
                    });
                } else {
                    let message = '업체 수정에 실패했습니다.';
                    message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                    utils.showAlert(message);
                }
            }, 800);
        }else{
            // 등록
            setTimeout(async () => {
                const response = await API.fetchData('/api/companyUp', formData);
                if (response.result) {
                    utils.showAlert('업체 등록이 완료되었습니다.', () => {
                        history.back();
                    });
                } else {
                    let message = '업체 등록에 실패했습니다.';
                    message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                    utils.showAlert(message);
                }
            }, 800);
        }
    }

    // 폼 검증
    function checkFormData() {

        const companyName = form.companyName.value;
        if (!companyName) {
            utils.showToast('업체명을 입력해주세요.', form.companyName.focus())
            return false;
        }

        const areaSi = form.areaSi.value;
        if (areaSi === "") {
            utils.showToast('지역을 선택해 주세요.', form.areaSi.focus())
            return false;
        }

        const grant = form.grant.value;
        if (!grant) {
            utils.showToast('관허를 입력해주세요.', form.grant.focus())
            return false;
        }

        const cpTel = form.cpTel.value;
        if (!cpTel) {
            utils.showToast('연락처를 입력해주세요.', form.cpTel.focus())
            return false;
        }

        const serviceType = Array.prototype.filter.call(form.serviceType, (checkbox) => checkbox.checked).map((checkbox) => checkbox.value).join(',');
        if (!serviceType) {
            utils.showToast('서비스를 선택해주세요')
            return false;
        }
        return true;
    }


})();