/**
 * admin. 회원관리
 */

(function () {
    'use strict';

    const allMemberRadio = document.getElementById('allMember');
    const generalMemberRadio = document.getElementById('generalMember');
    const businessMemberRadio = document.getElementById('businessMember');
    const realtorMemberRadio = document.getElementById('realtorMember');
    const changeState = document.getElementById('changeState');
    const checkAll = document.getElementById('checkAll');

    document.addEventListener('DOMContentLoaded', () => {
        // 파라미터 추가
        allMemberRadio.addEventListener('change', changeUrl);
        // 파라미터 추가
        generalMemberRadio.addEventListener('change', changeUrl);
        // 파라미터 추가
        businessMemberRadio.addEventListener('change', changeUrl);
        // 파라미터 추가
        realtorMemberRadio.addEventListener('change', changeUrl);

        // 상태 변경
        changeState.addEventListener('click', changeAuth);
        // 모두 체크
        checkAll.addEventListener('click', Checkboxes);

        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();
    });

    // 모두 체크
    function Checkboxes() {
        const checkboxes = document.querySelectorAll('input[name="check"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAll.checked;
        });
    }

    // 파라미터 추가
    function changeUrl() {
        console.log('aasdwd')
        const url = new URL(window.location.href);

        url.search = '';

        if (allMemberRadio.checked) {
            url.searchParams.set('type', 'all');
        } else if (generalMemberRadio.checked) {
            url.searchParams.set('type', '2');
        } else if (businessMemberRadio.checked) {
            url.searchParams.set('type', '5');
        } else if (realtorMemberRadio.checked) {
            url.searchParams.set('type', '8');
        }
        window.location.href = url.href;
    }

    // 상태 변경
    function changeAuth() {

        const checkedBoxes = document.querySelectorAll('input[name="check"]:checked');

        if (checkedBoxes.length === 0) {
            utils.showToast('최소 한 개 이상의 회원을 선택해야 합니다.')
            return false;
        }

        const formData = new FormData();
        const memberIds = Array.from(checkedBoxes).map(box => box.value);

        const html = `
            <div>변경하실 상태를 선택하세요.</div>
            <select name="changeAuth" class="w100">
                <option value="">선택하세요</option>
                <option value="N">정상</option>
                <option value="W">승인대기</option>
                <option value="H">보류</option>
                <option value="S">탈퇴</option>
            </select>
        `;

        Swal.fire({
            title: '승인상태 변경',
            html: html,
            showCancelButton: true,
            confirmButtonText: '완료',
            cancelButtonText: '닫기',
            preConfirm: async () => {
                const selectedValue = document.querySelector('select[name="changeAuth"]').value;
                if (!selectedValue) {
                    // pre 체크 가능
                    Swal.showValidationMessage('변경할 상태를 선택하세요.');
                    return false;
                }

                formData.append('status', selectedValue);

                memberIds.forEach((id) => {
                    formData.append('idx[]', id); // 'idx[]'로 배열 형태로 추가
                });

                // then()말고 여기서 처리시
                const response = await API.fetchData('/api/addReport', formData);

                if (response['success'] === true) {
                    utils.showToast('완료 했습니다', () => location.reload());
                }

            },
        }).then(async (result) => {
            if (result.isConfirmed) {
                //
            }
        });
    }


})();
