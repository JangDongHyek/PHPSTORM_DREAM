/**
 * 관리자 연락처관리
 */
(function () {
    'use strict';
    const form = document.forms['searchFrm'];

    const upFile = document.querySelector('#uploadFile');

    const fileInput = document.querySelector('#fileInput');

    document.addEventListener('DOMContentLoaded', async () => {
        eventListeners();

        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();
    });

    function eventListeners(){
        form.addEventListener('submit', handleContactUp);

        upFile.addEventListener('click', uploadFile);

        fileInput.addEventListener('change', excelUpload);
    }

    async function handleContactUp(e){
        e.preventDefault();

        const formCheck = checkFormData();
        if (!formCheck) return false;

        const formData = new FormData(form);

        const response = await API.fetchData('/api/contactInsert', formData);
        console.log(response)
        if (response.result){
            utils.showAlert('등록이 완료되었습니다.', () => {
                location.reload()
            });
        }else{
            let message = '등록에 실패했습니다.';
            message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
            utils.showAlert(message);
        }
    }

    // 폼 검증
    function checkFormData() {

        const companyName = form.cname.value;
        if (!companyName) {
            utils.showToast('이름을 입력해주세요.', form.cname.focus())
            return false;
        }

        const areaSi = form.number.value;
        if (areaSi === "") {
            utils.showToast('휴대폰번호를 선택해 주세요.', form.number.focus())
            return false;
        }
        return true;
    }

    function uploadFile() {
        document.getElementById('fileInput').click();
    }

    function excelUpload(event) {
        const file = event.target.files[0];
        if (file) {
            console.log('선택한 파일:', file.name);
            // 여기서 파일을 처리하는 로직을 추가할 수 있습니다.
        }
    }


})();