//상하단바로가기 버튼
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('.goHd').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});


//와우js
$(document).ready(function(){
	new WOW().init();
});



//헤드 스크롤반응
$(document).ready(function(){
		// 스크롤이 발생 될 때
		$(window).scroll(function(){
			var sct = $(window).scrollTop();
			if(sct>=130){
				// #header에 클래스on이 추가됨.
				//$("#hd").addClass("on");
				};
			// 만약 sct의 값이 150미만이면
			if(sct<=130){
				//$("#hd").removeClass("on");
				}
		}); //스크롤이벤트끝
});



// swal 기본 스타일
function showAlert(message, destroyEvent, timer) {
	if (timer == undefined) timer = 0;

	swal.fire({
		html: message,
		confirmButtonText: '확인',
		timer: (timer > 0)? timer : 0,
		timerProgressBar: (timer > 0)? true : false,
		didDestroy: () => {
			if (destroyEvent) destroyEvent();
		}
	});
}

// confirm
function showConfirm(title, message) {
	return Swal.fire({
		title: title,
		html: message,
		confirmButtonText: '확인',
		denyButtonText: '취소',
		showDenyButton: true
	});
}

// toast 팝업
function showToast(message, callback = null, duration = 1200) {
	const Toast = Swal.mixin({
		toast: true,
		// position: 'top-center',
		showConfirmButton: false,
		timer: duration,
		timerProgressBar: true,
	});

	Toast.fire({
		//icon: 'success',
		title: message,
		didDestroy: () => {
			if (callback) callback();
		}
	});
}

// 공통 error
function showError(html, isRefresh, destroyEvent) {
	Swal.fire({
		icon: 'error',
		title: '요청 작업 실패',
		html: html? html : '서버에 일시적인 오류가 발생했어요.<br>잠시 후 다시 시도해 주세요.',
		confirmButtonText: '확인',
		// showCancelButton: true,
		// cancelButtonText: '닫기',
		timer: 3000,
		timerProgressBar: true,
		didDestroy: () => {
			if (destroyEvent) destroyEvent();
			else if (isRefresh) location.reload();
		},
	});
}

document.addEventListener('DOMContentLoaded', function() {
	const tabButtons = document.querySelectorAll('.tab-button');
	const tabContents = document.querySelectorAll('.tab-content');

	tabButtons.forEach(button => {
		button.addEventListener('click', function() {
			// 모든 탭 버튼과 콘텐츠에서 active 클래스 제거
			tabButtons.forEach(btn => btn.classList.remove('active'));
			tabContents.forEach(content => content.classList.remove('active'));

			// 선택된 탭 버튼과 연결된 콘텐츠에 active 클래스 추가
			const tabId = this.getAttribute('data-tab');
			this.classList.add('active');
			document.getElementById(tabId).classList.add('active');
		});
	});
});
