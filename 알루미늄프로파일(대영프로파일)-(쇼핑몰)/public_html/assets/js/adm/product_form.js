/**
 * 관리자 상품 등록/수정
 */
const productFrm = document.productFrm; // 상품 폼
const noImageUrl = baseUrl + 'assets/img/common/noimg.jpg';

$(function () {
	// summernote
	$('#editor').summernote(getSummerNoteSettings(true));

	// 수정시
	if (productFrm.idx.value != "") {
		// content load
		if (productFrm.content) {
			$('#editor').summernote('code', productFrm.content.value);
		}

		// 사진 미리보기 load
		if (uploadImageFiles && uploadImageFiles.length > 0) {
			uploadImageFiles.forEach(file => {
				createHtmlPrevImage(file.source, file.filename);
			});
		}
	}

});

document.addEventListener('keyup', (e) => {
	// 판매가격이면 콤마 추가
	if (e.target && (e.target.name == 'prodPrice')) {
		e.target.value = addCommaNumber(toNumber(e.target.value));
	}
});

// 상품 등록/수정
document.addEventListener('submit', async (e) => {
	e.preventDefault();
	var productFrm = document.productFrm;
	const gubun = productFrm.idx.value == 0? "등록" : "수정";
	const confirmResult = await showConfirm(`상품을 ${gubun}하시겠습니까?`);
	if (confirmResult.isConfirmed !== true) return false;

	const formData = new FormData(productFrm);
	formData.append('content', $('#editor').summernote('code')); // summernote bind

	const response = await fetchData('/apiAdmin/registerProduct', formData);


	if (response.result) {
		// showAlert(`${gubun}이 완료되었습니다.`, () => {
			location.href = baseUrl + 'adm/product';
		// });
	} else {
		showAlert(`${gubun}에 실패했습니다.`);
	}
});



/**
 * 상품,옵션 이미지 업로드
 */
// 이미지 추가 (최대 5개)
const addProductImage = () => {
	const imgs = productFrm.querySelectorAll('.newpic-upload .thumb_img');
	if (imgs.length > 4) {
		showAlert(`사진은 최대 5장까지 등록이 가능합니다.`);
		initFileHandler();
		return false;
	}

	document.querySelector('input[name=file1]').click();
}

// 업로드 처리
const fileUpload = async (input) => {
	const file = input.files[0];
	if (file == undefined || !file) return;
	// const originFileName = file.name;

	// 최대용량체크
	const maxSizeMB = 8; // 8mb
	const maxByte = maxSizeMB * 1024 * 1024;
	const fileByte = file.size;

	if (fileByte > maxByte) {
		showAlert(`${maxSizeMB}MB 이하 파일만 등록이 가능합니다.`);
		initFileHandler(input);
		return false;
	}

	// 확장자체크
	const fileType = file.name.split('.').pop().toLowerCase();
	const allowedTypes = ['jpg', 'jpeg', 'png'];

	if (!allowedTypes.includes(fileType)) {
		showAlert(`이미지 파일(jpg, jpeg, png)만 등록이 가능합니다.`);
		initFileHandler(input);
		return false;
	}

	const formData = new FormData();
	formData.append('uploaded_file', file);
	formData.append('target', 'PRODUCT');

	const response = await fetchData('/file/upload', formData);
	console.log(response);
	if (response.result) {
		createHtmlPrevImage(response.source, response.filename);
	} else {
		showAlert(`사진 업로드에 실패했습니다.<br>다시 시도해 주세요.`);
	}

	initFileHandler(input);
}

// 파일업로드 초기화
const initFileHandler = (file) => {
	if (file) file.value = '';
	document.querySelector('[name=file1]').value = '';
}

// 사진삭제
const deleteImage = async (button) => {
	const confirmResult = await showConfirm(`사진을 삭제 하시겠습니까?`);
	if (confirmResult.isConfirmed !== true) return false;

	const parent = button.closest('div.newpic-preview');
	parent.remove();
}

// 사진등록 html 생성
const createHtmlPrevImage = (source, filename) => {
	const imageUrl = baseUrl + source;
	const html = `
		<div class="newpic-preview">
			<div class="thumb_img"><img src="${imageUrl}"></div>
			<button type="button" class="newpic-del" onclick="deleteImage(this)"><i class="fa-solid fa-close"></i></button>
			<input type="hidden" name="prodImage[]" value="${filename}">
		</div>`;

	document.querySelector('#prevImageWrap').innerHTML += html;
}


