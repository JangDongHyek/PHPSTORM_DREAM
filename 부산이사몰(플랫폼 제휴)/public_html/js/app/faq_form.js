(function () {
    'use strict';

    const form = document.forms['faq'];

    document.addEventListener('DOMContentLoaded', (event) => {
        eventListeners();
    });

    function eventListeners() {
        form.addEventListener('submit', handleFaqUpload);
    }

    async function handleFaqUpload(e) {
        e.preventDefault();

        const formCheck = checkFormData();
        if (!formCheck) return;

        const formData = new FormData(form);
        utils.showLoading(true);

        try {
            const response = await API.fetchData('/api/faqUpload', formData);
            utils.showLoading(false); // 로딩 해제

            if (response.result) {

                if (form.idx.value) {
                    history.back();
                } else {
                    const confirmResult = await utils.showConfirm('더 등록할 내용이 있습니까?');
                    console.log(!confirmResult)
                    if (!confirmResult.isConfirmed) {
                        history.back();
                    } else {
                        location.reload();
                    }
                }

            }
        } catch (error) {
            console.error(error);
            utils.showLoading(false); // 로딩 해제
            utils.showToast('문제가 발생했습니다. 다시 시도해주세요.');
        }
    }

    function checkFormData() {
        const category = form.category.value;
        if (!category) {
            utils.showToast('카테고리를 선택해주세요');
            return false;
        }

        const title = form.title.value;
        if (!title) {
            utils.showToast('질문을 작성해주세요');
            return false;
        }

        const content = form.content.value;
        if (!content) {
            utils.showToast('답변 내용을 입력해주세요.');
            return false;
        }
        return true;
    }

})();