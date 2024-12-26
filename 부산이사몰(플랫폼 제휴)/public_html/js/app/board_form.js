/**
 * 게시판
 */
(function () {
    'use strict';

    const form = document.forms['board'];
    const deleteFiles = [];
    let isPopup = false;


    document.addEventListener('DOMContentLoaded', async () => {

        // 목록에서 상세 이동
        /*document.querySelectorAll('.notice').forEach(item => {
            console.log('aaaa')
            item.addEventListener('click', function (event) {

                event.preventDefault();
                const bo = document.querySelector('input[name="bo"]').value;
                const boardId = this.getAttribute('data-board');
                const url = `./boardView?bo=${bo}&idx=${boardId}`;
                window.location.href = url;
            });
        });
*/

        eventListeners();
    });

    function eventListeners() {
        //등록
        form.addEventListener('submit', handleSubmit);

        form.addEventListener('change', async (e) => {
            switch (e.target.id) {
                case 'addFile1' :
                case 'addFile2' :
                    await handleFileUpload(e.target);
                    break;
            }
        });

        form.addEventListener('click', async (e) => {
            switch (e.target.name) {
                case 'fileOrgName[1]' :
                case 'fileOrgName[2]' :
                    await deleteFile(e.target);
                    break;
            }
        })
    }


    async function handleSubmit(e) {
        e.preventDefault();

        const form = e.target;

        if (form.title.value == '') {
            return utils.showToast('제목을 입력해 주세요.');
        }

        const formData = new FormData(form);
        formData.append('content', $('#editor').summernote('code'));
        // 삭제파일 추가
        deleteFiles.forEach((file, index) => {
            formData.append(`deleteFiles[${index}]`, file);
        });

        form.querySelector('[type=submit]').disabled = true;
        const response = await API.fetchData('/api/registerBoard', formData);

        if (response.result) {
            history.back();
        } else {
            form.querySelector('[type=submit]').disabled = false;
            const message = response.message ? response.message : ``;
            utils.showError(message);
        }

    }

    //파일 업로드
    async function handleFileUpload(input) {
        const folder = (form.boardType.value);
        const response = await fileUploader.single(input, 'BOARD', 'createIdx', 8, folder);

        input.value = '';

        if (!response.result) {
            return utils.showError('파일첨부에 실패했어요.<br>잠시 후 다시 시도해 주세요.');
        }
        const viewName = response.originFileName;
        const uploadFile = response.data.name;
        console.log(uploadFile)
        switch (input.id) {
            case 'addFile1' :
                form.querySelector('[name="fileOrgName[1]"]').value = viewName;
                form.querySelector('[name="fileName[1]"]').value = uploadFile;
                break;
            case 'addFile2' :
                form.querySelector('[name="fileOrgName[2]"]').value = viewName;
                form.querySelector('[name="fileName[2]"]').value = uploadFile;
                break;
        }

        if (isPopup) handlePrevPopImg(response.data.source);
    }

    // 업로드파일 삭제
    async function deleteFile(input) {
        const index = getFileIndex(input.name);
        if (input.value == '' || index == null) return;

        const confirmResult = await utils.showConfirm('선택 파일을 삭제하시겠어요?');
        if (confirmResult.isConfirmed !== true) return false;

        const fileName = form.querySelector(`[name="fileName[${index}]"]`).value;
        deleteFiles.push(fileName);
        input.value = ''; // fileOrgName

        if (isPopup) handlePrevPopImg();
    }

    function getFileIndex(name) {
        const nameMatch = name.match(/fileOrgName\[(\d+)\]/);
        if (nameMatch && nameMatch.length > 1) {
            return nameMatch[1];
        } else {
            return null;
        }
    }

    // (팝업) 이미지 미리보기
    function handlePrevPopImg(source) {
        if (source == undefined) {
            form.querySelector('.prevImg').innerHTML = '';
        } else {
            form.querySelector('.prevImg').innerHTML = `<img src="${source}" class="w600px"/>`;
        }
    }

})();