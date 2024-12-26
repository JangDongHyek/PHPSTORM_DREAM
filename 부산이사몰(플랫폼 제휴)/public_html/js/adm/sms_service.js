// 관리자 문자발송
const hpElement = document.querySelector('input[name=hp]');
const msgElement = document.querySelector('textarea[name=message]');
const photoWrap = document.querySelector('#photoWrap');
const dataCode = document.querySelectorAll('[data-code]'); //수신자 내역
// let mmsBase64Str = '';
// let mmsByteArray = '';
let mmsFileName = '';

// 수신번호 검색
if (hpElement) {
    hpElement.addEventListener('keyup', (e) => {
        e.target.value = utils.addHyphenTel(e.target.value);
        if (e.keyCode == 13) addHp();
    });
}

// 단문/장문 라디오 선택
document.querySelectorAll('[name=msgType]').forEach(radio => {
    radio.addEventListener('change', () => {
        if (radio.value == 'm') {
            photoWrap.classList.remove('hide');
        } else {
            photoWrap.classList.add('hide');
            removeMMS(true);
        }
    });
});

// 메시지 입력
if (msgElement) {
    msgElement.addEventListener('input', checkMsgType);
}

// 장문,단문,mms 체크
function checkMsgType() {
    const byte = getStringByte(msgElement.value);
    document.querySelector('[data-id="byte"]').innerHTML = utils.addCommaNumber(byte);

    if (mmsFileName != '') {
        document.querySelector('[name=msgType][value="m"]').checked = true;
        return;
    }

    const msgType = document.querySelectorAll('[name=msgType]');
    msgType.forEach(radio => {
        if (byte <= 90 && radio.value == 's') { // 단문
            radio.checked = true;
            photoWrap.classList.add('hide');
            removeMMS(true);

        } else if (byte > 90 && radio.value == 'm') { // 장문
            radio.checked = true;
            photoWrap.classList.remove('hide');
        }
    });
}

// 직접입력 휴대폰번호 추가
function addHp() {
    if (hpElement.value.length != 13) return showAlert('휴대폰번호를 올바르게 입력해 주세요.');

    addReceivedList([hpElement.value]);
    hpElement.value = '';
}

// 수신번호 목록 추가
function addReceivedList(numberData) {
    const container = document.querySelector('#receiveList');
    const maxLength = 500;
    numberData.forEach(item => {
        if (document.querySelectorAll('input[name="number[]"]').length >= maxLength) {
            return utils.showAlert('최대 1,000건까지 발송 가능합니다.');
        }

        const split = item.split('/');
        const hp = split[0];
        const name = split[1] ?? '';
        const trElement = `
                <tr>
                    <td><input type="text" name="number[]" value="${hp}" readonly/></td>
                    <td><input type="text" name="cname[]" value="${name}" readonly/></td>
                    <td><button class="btn btn_colorline" type="button" onclick="deleteHp(this)">삭제</button></td>
                </tr>
            `;
        container.insertAdjacentHTML('beforeend', trElement);
    });
}

// 삭제
async function deleteHp(element) {
    const confirmResult = await utils.showConfirm('수신번호를 삭제하시겠습니까?');
    if (confirmResult.isConfirmed !== true) return false;

    element.closest('tr').remove();
}

// MMS 사진 첨부
async function handleMMSImage(e) {
    const file = e.files[0];

    if (file == undefined || !file) return;

    // 파일크기 (1mb 이하)
    if (file.size > 1048576) return utils.showAlert('파일 크기는 1MB 이하이어야 합니다.');

    // 파일 형식 체크 (JPEG 이미지)
    if (!file.type.match('image/jpeg')) return utils.showAlert('파일 형식은 JPEG이어야 합니다.');

    // 사진 업로드
    const formData = new FormData();
    formData.append('uploaded_file', file);
    formData.append('target', 'MMS');

    const response = await API.fetchData('/file/upload', formData);
    if (!response.result) return utils.showAlert('사진 추가에 실패했습니다.');

    mmsFileName = response.name;

    document.querySelector('#mmsImgPrev').style.backgroundImage = `url('${response.source}')`;
    checkMsgType();

    // 미리보기
    // const reader = new FileReader();
    // reader.onload = function(e) {
    //     const imgBase64Str = e.target.result;
    //     mmsBase64Str = imgBase64Str.replace("data:", "").replace(/^.+,/, ""); // Base64 추출
    //
    //     document.querySelector('#mmsImgPrev').style.backgroundImage = `url('${imgBase64Str}')`;
    //     checkMsgType();
    //
    //     // 바이트배열
    //     const readerAsArrayBuffer = new FileReader();
    //     readerAsArrayBuffer.onload = function(e) {
    //         const arrayBuffer = e.target.result;
    //         mmsByteArray = new Uint8Array(arrayBuffer);
    //         console.log(mmsByteArray);
    //     };
    //     readerAsArrayBuffer.readAsArrayBuffer(file);
    // };
    // reader.readAsDataURL(file);
}

// MMS 사진 삭제
async function removeMMS(isChangeType) {
    if (mmsFileName == '') return;

    if (isChangeType == undefined) {
        const confirmResult = await utils.showConfirm('사진을 삭제하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;
    }

    mmsFileName = '';
    document.querySelector('#mmsImgPrev').style.backgroundImage = `url('../img/common/noimg2.png')`;
    checkMsgType();
}

// 문자보내기
async function handleMessage() {
    checkMsgType();

    /*const remainPrice = document.querySelector('[name=amt]').value;
    if (remainPrice < 1) {
        return utils.showAlert('현재 보유금액이 부족합니다.<br>요금충전을 클릭하여<br><strong>금액 충전 후 사용이 가능</strong>합니다.');
    }*/

    if (document.querySelectorAll('input[name="number[]"]').length == 0) {
        return utils.showAlert('수신번호를 1건 이상 등록해 주세요.');
    }
    if (msgElement.value == '') {
        return utils.showAlert('메시지 내용을 입력해 주세요.');
    }

    const formData = {
        receiver: [],
        message: msgElement.value,
        imageFile: mmsFileName,
    };

    document.querySelectorAll('input[name="number[]"]').forEach(input => {
        formData.receiver.push({
            number: input.value,
            name: input.closest('tr').querySelector('[name="cname[]"]').value,
        })
    });

    let message = '문자를 발송하시겠습니까?';
    if (mmsFileName != '') message += `<br>MMS 발송시에는 수신번호를<br>최소화 해주세요.`;

    const confirmResult = await utils.showConfirm(message);
    if (confirmResult.isConfirmed !== true) return false;

    showLoading(1)

    console.log(formData)

    const response = await API.fetchData(`/api/baro/sendMessages`, formData);
    console.log(response)
    if (response.result) {
        utils.showAlert('문자발송이 완료되었습니다.<br>전송내역을 클릭하시면<br>결과를 확인하실 수 있습니다.', () => {
            location.reload();
        });

    } else {
        const message = response.message ? response.message : `문자발송에 실패했습니다.`;
        utils.showAlert(message);
    }
}


// 요금충전하기
function chargeSms(key) {
    console.log(key);
}

//수신자 내역
dataCode.forEach(idx => {
    idx.addEventListener('click', recipientList);
});

//수신자 내역
async function recipientList(e) {
    const daCode = e.target.getAttribute('data-code');
    //console.log(daCode)
    const formData = new FormData();
    formData.append('feeCode', daCode);

    const response = await API.fetchData('/api/recipientList', formData);
    console.log(response)
    $('#toListModal').modal('show');

    $('#toListModal tbody').empty();


    if (response['listData'].length > 0) {
        // 등록된 내역이 없을 때 보여주는 메시지를 숨기기
        $('#toListModal tbody tr.noDataAlign').hide();

        // 수신자 리스트를 보여주는 테이블에 데이터를 추가하기
        response['listData'].forEach((item, index) => {
            const row = `
                  <tr>
                    <td>${index + 1}</td>
                    <td>${item.to_num}</td>
                    <td>${item.to_name}</td>
                  </tr>
                `;
            $('#toListModal tbody').append(row);
        });
    } else {
        const noDataRow = `
          <tr>
            <td colspan="10" class="noDataAlign">등록된 내역이 없습니다.</td>
          </tr>
        `;
        $('#toListModal tbody').append(noDataRow);
    }

}