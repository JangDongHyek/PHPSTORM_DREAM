/**
 * 관리자공통 유틸리티 모듈
 */
const admUtils = (function () {
    return {
        //업체 삭제
        async deleteCompany(e) {
            e.preventDefault();

            const checkedBoxes = document.querySelectorAll('input[name="check"]:checked');

            if (checkedBoxes.length === 0) {
                utils.showToast('최소 한 개 이상의 회원을 선택해야 합니다.')
                return false;
            }

            const confirmResult = await utils.showConfirm('선택 항목을 삭제하시겠습니까?');
            if (confirmResult.isConfirmed !== true) return false;

            const formData = new FormData();
            const memberIds = Array.from(checkedBoxes).map(box => box.value);

            memberIds.forEach((id) => {
                formData.append('idx[]', id); // 'idx[]'로 배열 형태로 추가
            });

            const response = await API.fetchData('/api/deleteCompany', formData);

            if (response['success'] === true) {
                utils.showToast('완료 했습니다', () => location.reload());
            }
        },
    }
})();
