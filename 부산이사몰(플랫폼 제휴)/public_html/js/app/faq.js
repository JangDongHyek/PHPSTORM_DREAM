(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', (event) => {
        eventListeners();
    });

    function eventListeners() {
        //FAQ 삭제
        document.querySelectorAll('.deleteFaq').forEach(button => {
            button.addEventListener('click', faqDelete);
        });

        //FAQ 수정 페이지
        document.querySelectorAll('.editFaq').forEach(button => {
            button.addEventListener('click', faqEditPage);
        })
    }

    async function faqEditPage(e) {
        const idx = e.target.getAttribute('data-faq');

        const confirmResult = await utils.showConfirm('선택 항목을 수정하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        const url = `./faqForm?idx=${idx}`;
        window.location.href = url;
    }

    //FAQ 삭제
    async function faqDelete(e) {
        const idx = e.target.getAttribute('data-faq');

        const confirmResult = await utils.showConfirm('선택 항목을 삭제하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData();
        formData.append('idx', idx);

        const response = await API.fetchData('/api/faqDelete', formData);

        if (response.result) {
            location.reload();
        }
    }
})();