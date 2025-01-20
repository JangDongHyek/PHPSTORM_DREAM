<!-- 게시판등록/수정 JS -->
const boardFrm = document.write; // 등록폼
//const isProductPage = document.querySelector('[name=category]').value == 'review' || document.querySelector('[name=category]').value == 'p_qna'; // 상품페이지 여부
const isProductPage =  document.querySelector('[name=category]').value == 'review' || document.querySelector('[name=category]').value == 'p_qna'; // 상품페이지 여부

$(function () {
	// summernote
	if (!isProductPage) {
		$('#editor').summernote(getSummerNoteSettings(true));

		// 수정시
		if (boardFrm.idx.value != "") {
			// content load
			if (boardFrm.content) {
				$('#editor').summernote('code', boardFrm.content.value);
			}

			// 첨부파일 load
			if (uploadAttachFiles && uploadAttachFiles.length > 0) {
				uploadAttachFiles.forEach((file, index) => {
					createHtmlUploadFileName(true, (index+1), file.fileName, file.orgFileName);
				});
			}
		}
	}else{
		document.querySelector('[name=content]').style.display = 'block';
	}
});

// 게시판 등록/수정
boardFrm.addEventListener('submit', async (e) => {
	e.preventDefault();

	const gubun = boardFrm.idx.value == ""? "등록" : "수정";
	const confirmResult = await showConfirm(`${gubun}하시겠습니까?`);
	if (confirmResult.isConfirmed !== true) return false;

	const formData = new FormData(boardFrm);
	if(!isProductPage) formData.append('content', $('#editor').summernote('code')); // summernote bind

	const response = await fetchData('/api/registerBoard', formData);
	// console.log(response);
	if (response.result) {
		if(!isProductPage) {
			location.href = baseUrl + '/board?cate=' + boardFrm.category.value;
		} else {
			$("#boardModal").modal('hide');
			const category = boardFrm.category.value;
			const listElement = category === 'review' ? '#reviewList' : '#qnaList';

			await productBoardList2(category, document.querySelector('[name=productIdx]').value, document.querySelector(listElement));
		}
	} else {
		showAlert(`${gubun}에 실패했습니다.`);
	}
});

// 상품후기/상품문의 목록
// category: 후기/문의 구분
// productIdx: 상품인덱스
// dataElement: 목록div
const productBoardList2 = async (category, productIdx, dataElement) => {
	const param = `?category=${category}&productIdx=${productIdx}`;
	//await fetchHtml(`/api/getProductBoardList2${param}`, dataElement);

	if(productIdx){
		location.href = `../api/getProductBoardList2${param}`;
	}else{
		location.href = baseUrl + '/board?cate=' + boardFrm.category.value;
	}

	document.querySelectorAll(".reviewCntDisplay").forEach(elem => elem.textContent = document.querySelector('[name=reviewCnt]').value);
	document.querySelectorAll(".qnaCntDisplay").forEach(elem => elem.textContent = document.querySelector('[name=qnaCnt]').value);
}


// 첨부파일업로드
document.querySelector('#addFile1 a').addEventListener('click', (e) => {
	e.preventDefault();
	document.querySelector('input[name=file1]').click();
});
document.querySelector('#addFile2 a').addEventListener('click', (e) => {
	e.preventDefault();
	document.querySelector('input[name=file2]').click();
});

const fileUpload = async (input, number) => {
	const file = input.files[0];
	if (file == undefined || !file) return;
	const originFileName = file.name;
	// console.log(file);

	// 최대용량체크
	const maxSizeMB = 10; // 10mb
	const maxByte = maxSizeMB * 1024 * 1024;
	const fileByte = file.size;

	if (fileByte > maxByte) {
		showAlert(`${maxSizeMB}MB 이하 파일만 등록이 가능합니다.`);
		input.value = ``;
		return false;
	}

	const formData = new FormData();
	formData.append('uploaded_file', file);
	formData.append('target', 'BOARD');

	const response = await fetchData('/file/upload', formData);
	// console.log(response);
	createHtmlUploadFileName(response.result, number, response.filename, originFileName);
	input.value = ``;
};
// 파일첨부명 html 생성
const createHtmlUploadFileName = (flag, number, newName, orgName) => {
	const fileNameInput = document.querySelector(`input[name="fileName[${number}]"]`);
	const orgFileNameInput = document.querySelector(`input[name="orgFileName[${number}]"]`); // 원본파일명 저장
	const addFileSpan = document.querySelector(`#addFile${number} span`);

	if (flag) {
		fileNameInput.value = newName;
		orgFileNameInput.value = orgName;
		addFileSpan.innerHTML = orgName + ` <button type="button" onclick="deleteFile(${number})" class="btn">삭제</button>`; //`업로드 완료`;
	} else {
		fileNameInput.value = "";
		addFileSpan.innerHTML = `파일을 선택하세요..`;
		let msg = `첨부파일 업로드에 실패했습니다.<br>다시 시도해 주세요.`;
		showAlert(msg);
	}
}

// 첨부파일삭제
const deleteFile = async (number) => {
	const confirmResult = await showConfirm('첨부파일을 삭제하시겠습니까?');
	if (confirmResult.isConfirmed !== true) return false;

	document.querySelector(`input[name="fileName[${number}]"]`).value = '';
	document.querySelector(`#addFile${number} span`).innerHTML = '파일을 선택하세요..';
}
