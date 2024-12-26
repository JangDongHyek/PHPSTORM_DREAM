/**
 * CS 게시판
 */
(function () {
    'use strict';

    const form = document.forms['conform'];

    const deleteFiles = [];

    document.addEventListener('DOMContentLoaded', () => {
        eventListeners();
    });

    function eventListeners(){
        form.addEventListener('submit', csBoardUpload);

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

    async function csBoardUpload(e){
        e.preventDefault();

        const formCheck = await checkFormData();
        if (!formCheck) return false;

        const formData = new FormData(form);
        formData.append('content', $('#editor').summernote('code'));
        // 삭제파일 추가
        deleteFiles.forEach((file, index) => {
            formData.append(`deleteFiles[${index}]`, file);
        });
        const response = await API.fetchData('/api/registerBoard', formData);

        if (response.result) {
            utils.showToast('등록 되었습니다.',()=>{
                history.back();
            });
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

    function checkFormData(){
        const mbName = form.mbName.value;
        if(!mbName){
            utils.showToast('담당자명을 입력해주세요.');
            return false;
        }

        const mbHp = form.mbHp.value;
        if(!mbHp){
            utils.showToast('담당자 연락처를 입력해주세요.');
            return false;
        }

        const title = form.title.value;
        if (!title){
           utils.showToast('제목을 입력해주세요.');
           return false;
        }

        const serviceDesc = $('#editor').summernote('code');
        if (!serviceDesc) {
            utils.showToast('내용을 입력해주세요.');
            return false;
        }

        return true;

    }
})()