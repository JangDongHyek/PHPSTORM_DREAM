/**
 * 게시판 view
 */
(function () {
    'use strict';
    const form = document.forms['comment']; // 댓글 등록 폼
    const del = document.querySelector('#delete'); // 게시글 삭제 버튼
    const status = document.querySelector('#csStatus'); // 진행 상태
    const csIdx = document.querySelector('#csIdx'); // 해당 게시판 idx

    document.addEventListener('DOMContentLoaded', () => {
        eventListeners();
    });

    function eventListeners() {


        // 댓글 등록
        if (form) form.addEventListener('submit', handleComment);

        // 댓글 삭제 버튼
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', commandDelete);
        });

        // 댓글 수정 토글
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', toggleEditForm);
        });

        // 댓글 수정 제출
        document.querySelectorAll('.comment-form form').forEach(form => {
            form.addEventListener('submit', handleCommentEdit);
        });

        // 게시글 삭제 버튼
        if (del) del.addEventListener('click', handleDelete);

        status.addEventListener('change',changeStatus);
    }

    // 댓글 수정 폼 토글
    function toggleEditForm(e) {
        e.preventDefault();
        const button = e.target;
        const dl = button.closest('dl');
        const content = dl.querySelector('dd'); // 댓글 내용
        const formContainer = dl.nextElementSibling; // 댓글 수정 폼 컨테이너

        if (formContainer && formContainer.classList.contains('comment-form')) {
            const isFormVisible = formContainer.style.display === 'block';
            content.style.display = isFormVisible ? 'block' : 'none';
            formContainer.style.display = isFormVisible ? 'none' : 'block';
        }
    }

    // 댓글 삭제
    async function commandDelete(e) {
        const idx = e.target.getAttribute('data-coidx');
        const formData = new FormData();
        formData.append('idx', idx);
        formData.append('upload', 'del');

        try {
            const response = await API.fetchData('/api/commentUpload', formData);
            if (response.result) {
                utils.showAlert('답글 삭제가 완료되었습니다.', () => location.reload());
            } else {
                showError(response.message, '답글 삭제에 실패했습니다.');
            }
        } catch (error) {
            showError(null, '서버 오류가 발생했습니다.');
        }
    }

    // 댓글 등록
    async function handleComment(e) {
        e.preventDefault();
        const form = e.target;

        if (!checkFormData()) return;

        const formData = new FormData(form);

        try {
            const response = await API.fetchData('/api/commentUpload', formData);
            if (response.result) {
                utils.showAlert('답글 등록이 완료되었습니다.', () => location.reload());
            } else {
                showError(response.message, '답글 등록에 실패했습니다.');
            }
        } catch (error) {
            showError(null, '서버 오류가 발생했습니다.');
        }
    }

    // 댓글 수정
    async function handleCommentEdit(e) {
        e.preventDefault();
        const form = e.target;
        const upload = form.querySelector('input[name="idx"]').getAttribute('data-up');

        const formData = new FormData(form);
        formData.append('upload', upload);

        try {
            const response = await API.fetchData('/api/commentUpload', formData);
            if (response.result && upload === 'edit') {
                utils.showAlert('답글 수정이 완료되었습니다.', () => location.reload());
            } else {
                showError(response.message, '답글 수정에 실패했습니다.');
            }
        } catch (error) {
            showError(null, '서버 오류가 발생했습니다.');
        }
    }

    // 게시글 삭제
    async function handleDelete(e) {
        e.preventDefault();
        const dataIdx = e.target.getAttribute('data-idx');

        const confirmResult = await utils.showConfirm('삭제하시겠어요?');
        if (!confirmResult.isConfirmed) return;

        const formData = new FormData();
        formData.append('idx', dataIdx);

        try {
            const response = await API.fetchData('/api/boardDel', formData);
            if (response.success) {
                utils.showAlert('삭제 완료되었습니다.', () => history.back());
            } else {
                showError(response.message, '삭제에 실패했습니다.');
            }
        } catch (error) {
            showError(null, '서버 오류가 발생했습니다.');
        }
    }

    // 폼 데이터 유효성 검사
    function checkFormData() {
        const content = document.forms['comment'].content.value;
        if (!content) {
            utils.showToast('답변을 입력해주세요.', document.forms['comment'].content.focus());
            return false;
        }
        return true;
    }

    // 오류 메시지 표시
    function showError(message, defaultMsg) {
        let errorMsg = defaultMsg;
        if (message) errorMsg += `<br>(${message})`;
        else errorMsg += '<br>잠시 후 다시 시도해 주세요.';
        utils.showAlert(errorMsg);
    }

    // 처리 상태 변경
    async function changeStatus(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('idx', csIdx.value);
        formData.append('status',e.target.value);

        const response = await API.fetchData('/api/changeCsStatus', formData);
        if (response.success) {
            location.reload();
        }else{
            let message = response.message ? response.message : `오류가 발생하였습니다.`;
            utils.showAlert(message);
        }
    }
})();
