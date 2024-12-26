
/**
 * 로딩
 * @param show: 1(show) / 0(hide)
 */
function showLoading(show) {
    let loading = document.getElementById("loading");
    if (loading) loading.style.display = (show) ? "block" : "none";
}

/**
 * 엑셀업로드 (공통)
 * @param input: 파일업로드 element
 * @param target: 엑셀구분(메뉴명..)
 */
const commonExcelUpload = async (input, target) => {
    showLoading(1);

    const file = input.files[0];
    const formData = new FormData();
    formData.append('uploaded_file', file);
    formData.append('target', target);

    const response = await API.fetchData('/excel/upload', formData);

    if (response.result) {
        utils.showAlert(`엑셀업로드가 완료되었습니다.`, () => {
            location.reload();
        });
    } else {
        let message = `엑셀업로드에 실패했습니다.`;
        utils.showAlert(message);
        showLoading(0);
    }
}

// 바이트 계산 (한글 2byte 처리)
function getStringByte(str) {
    let bytes = 0;
    for (let i = 0; i < str.length; i++) {
        const charCode = str.charCodeAt(i);
        if (charCode >= 0xAC00 && charCode <= 0xD7A3) {
            bytes += 2;
        } else if (charCode < 0x80) {
            bytes += 1;
        } else {
            bytes += 2;
        }
    }
    return bytes;
}