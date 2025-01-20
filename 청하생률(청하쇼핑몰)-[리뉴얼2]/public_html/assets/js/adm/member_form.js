<!--회원관리 JS-->
const form = document.member; // 등록 폼
const gubun = form.idx.value ? '수정' : '등록';

// 생년월일
form.birth.addEventListener('keyup', (e) => {
    e.target.value = addHyphenBirth(e.target.value);
});
// 휴대폰번호
form.hp.addEventListener('keyup', (e) => {
    e.target.value = addHyphenTel(e.target.value);
});
// 사업자등록번호
form.brno.addEventListener('keyup', (e) => {
    e.target.value = addHyphenBrno(e.target.value);
});
// 사업자등록번호 없음체크
form.emptyBrno.addEventListener('click', (e) => {
    if (e.target.checked) {
        form.brno.value = "";
        form.brno.readOnly = true;
    } else {
        form.brno.readOnly = false;
    }
});
// 주소검색 팝업열기
form.addr.addEventListener('click', (e) => {
    e.preventDefault();
    openDaumAddress();
});
// 대표전화
form.tel.addEventListener('keyup', (e) => {
    e.target.value = addHyphenTel(e.target.value);
});
// 팩스
form.fax.addEventListener('keyup', (e) => {
    e.target.value = addHyphenTel(e.target.value);
});

// 등록/수정
form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // 필수필드 검사
    form.id.value = removeWhitespace(form.id.value);
    if (form.id.value.length < 4) {
        showAlert('아이디를 4자 이상 입력해 주세요.', form.id.focus());
        return false;
    }
    if(!form.idx.value) {
        if (form.password.value.length < 4) {
            showAlert('비밀번호를 4자 이상 입력해 주세요.', form.password.focus());
            return false;
        }
    } else {
        if (form.password.value.length != 0 && form.password.value.length > 4) {
            showAlert('비밀번호를 4자 이상 입력해 주세요.', form.password.focus());
            return false;
        } else {
            if (form.password.value != form.passwordChk.value) {
                showAlert('비밀번호와 비밀번호확인이 맞지 않습니다.', form.password.focus());
                return false;
            }
        }
    }
    form.name.value = removeWhitespace(form.name.value);
    if (form.name.value.length < 2) {
        showAlert('성명을 입력해 주세요.', form.name.focus());
        return false;
    }
    /*
    if (form.birth.value.length != 10) {
        showAlert('생년월일 8자리를 올바르게 입력해 주세요.', form.birth.focus());
        return false;
    }*/
    if (form.hp.value.length < 12) {
        showAlert('휴대폰번호를 올바르게 입력해 주세요.', form.hp.focus());
        return false;
    }
    /*
    form.clinicName.value = form.clinicName.value.trim();
    if (form.clinicName.value == "") {
        showAlert('한의원명을 입력해 주세요.', form.clinicName.focus());
        return false;
    }
    if (form.brno.value == "" && !form.emptyBrno.checked) { // 없음체크 안되어있으면
        showAlert('사업자등록번호를 입력해 주세요.', form.brno.focus());
        return false;
    }*/
    if (form.addr.value == "") {
        showAlert('기본주소를 입력해 주세요.');
        return false;
    }
    if (form.zipCode.value == "") {
        showAlert('우편번호를 입력해 주세요.');
        return false;
    }
    /*
    if (form.repName.value == "") {
        showAlert('대표자명을 입력해 주세요.', form.repName.focus());
        return false;
    }
    if (form.bizType.value == "") {
        showAlert('업태를 입력해 주세요.', form.bizType.focus());
        return false;
    }
    if (form.tel.value == "") {
        showAlert('대표전화를 입력해 주세요.', form.tel.focus());
        return false;
    }
     */
    // 팩스는 필수 제외
    if (form.email.value == "") {
        showAlert('이메일을 입력해 주세요.', form.email.focus());
        return false;
    }
    /*
    if (document.querySelector('[name="fileName[1]"]').value == "" && !form.emptyBrno.checked) {
        showAlert('사업자등록증(면허증)을 업로드해 주세요.');
        return false;
    }
    if (document.querySelector('[name="fileName[2]"]').value == "") {
        showAlert('원외탕전실 계약서를 업로드해 주세요.');
        return false;
    }
    */

    const formData = new FormData(form);
    const response = await fetchData('/apiAdmin/registerMember', formData);
    // console.log(response);
    if (response.result) {
        let message = `${gubun}이 완료되었습니다.`;
        if(gubun == "등록") message += '<br>감사합니다.';
        showAlert(`${message}`, () => { location.replace(`${baseUrl}adm/member`); });
    } else {
        let message = response.message ? response.message : `${gubun}에 실패했습니다.`;
        showAlert(message);
    }
});

// 첨부파일업로드
// 사업자등록증/계약서 첨부하기
document.querySelector('#addFile1 a').addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelector('input[name=file1]').click();
});
// document.querySelector('#addFile2 a').addEventListener('click', (e) => {
//     e.preventDefault();
//     document.querySelector('input[name=file2]').click();
// });
const fileUpload = async (input, number) => {
    const file = input.files[0];
    if (file == undefined || !file) return;
    const originFileName = file.name;
    // console.log(file);

    // 최대용량체크
    const maxSizeMB = 5; // 5mb
    const maxByte = maxSizeMB * 1024 * 1024;
    const fileByte = file.size;

    if (fileByte > maxByte) {
        showAlert(`${maxSizeMB}MB 이하 파일만 등록이 가능합니다.`);
        input.value = ``;
        return false;
    }

    const formData = new FormData();
    formData.append('uploaded_file', file);
    formData.append('target', 'CLINIC');

    const response = await fetchData('/file/upload', formData);
    // console.log(response);
    const fileNameInput = document.querySelector(`input[name="fileName[${number}]"]`);
    const addFileSpan = document.querySelector(`#addFile${number} span`);

    if (response.result) {
        fileNameInput.value = response.filename;
        addFileSpan.innerHTML = originFileName; //`업로드 완료`;
    } else {
        fileNameInput.value = "";
        addFileSpan.innerHTML = `파일을 선택하세요..`;

        let msg = number==1? `사업자등록증` : `계약서`;
        msg += ` 업로드에 실패했습니다.<br>다시 시도해 주세요.`;
        showAlert(msg);
    }

    input.value = ``;
}

// 승인/승인취소
const authCheck = async (isAuth) => {
    let idxArr = [form.idx.value];

    const response = await fetchData(`/apiAdmin/updateAuthMember`, {idxArr, isAuth});
    if (response.result) {
        location.reload();
    } else {
        let message = response.message ? response.message : `변경에 실패하였습니다.`;
        showAlert(`${message}`, () => { location.reload(); });
    }
}