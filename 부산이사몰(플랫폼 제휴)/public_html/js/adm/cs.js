/**
 * cs 게시판 목록
 */

(function () {
    'use strict';

    const checkAll = document.querySelector('#checkAll');
    const csDel = document.querySelector('#csDel');

    document.addEventListener('DOMContentLoaded', () => {
        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();

        eventListeners();
    });
    
    function eventListeners() {
        // 체크 박스
        checkAll.addEventListener('click', utils.checkboxes);

        //선택 삭제
        csDel.addEventListener('click', csDeletUpload);
    }

    async function csDeletUpload(e){
        e.preventDefault();

        const checkedBoxes = document.querySelectorAll('input[name="check"]:checked');

        if (checkedBoxes.length === 0) {
            utils.showToast('최소 한 개 이상의 선택해야 합니다.')
            return false;
        }

        const confirmResult = await utils.showConfirm('선택 항목을 삭제하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData();
        // 선택된 idx 값 수집하여 FormData에 추가
        Array.from(checkedBoxes).forEach((box, index) => {
            formData.append('idx[]', box.value); // 'ids[]'로 배열 형태로 추가
        });

        const response = await API.fetchData('/api/csDeletUpload', formData);
        console.log(response)

        if(response.success){
            utils.showToast('삭제 되었습니다.', ()=>{
                location.reload();
            });
        } else {
            let message = '삭제에 실패 되었습니다.';
            message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
            utils.showAlert(message);
        }

    }
})();