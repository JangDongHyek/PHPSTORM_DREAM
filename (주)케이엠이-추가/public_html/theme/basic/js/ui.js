
//상하단바로가기 버튼
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('.btnTop').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});


//헤드 스크롤반응 :  mobile화면에서 모바일메뉴
$(document).ready(function(){
	$(window).scroll(function(){
		var sct = $(window).scrollTop();
		if(sct>=70){
			$(".mobile_open").addClass("on");
			};
		if(sct<=70){
			$(".mobile_open").removeClass("on");
			}
	}); 
});

//메인콘텐츠 아래 위 슬라이드
	function reveal() {
	var reveals = document.querySelectorAll(".reveal");

	for (var i = 0; i < reveals.length; i++) {
	var windowHeight = window.innerHeight;
	var elementTop = reveals[i].getBoundingClientRect().top;
	var elementVisible = 150;

	if (elementTop < windowHeight - elementVisible) {
	reveals[i].classList.add("active");
} else {
	reveals[i].classList.remove("active");
}
}
}
	window.addEventListener("scroll", reveal);



//PRODUCTS 내용작업 셀렉트박스 탭
$(document).ready(function(){
	// 모든 셀렉트 박스 요소를 가져옵니다.
	const selectElements = document.querySelectorAll('.selectOption');
	// 모든 div 요소를 가져옵니다.
	const divs = document.querySelectorAll('.content-div');

	// 셀렉트 박스의 값이 변경되었을 때 실행될 함수
	function handleSelectChange(event) {
		// 선택된 셀렉트 박스
		const selectElement = event.target;
		// 선택된 옵션의 값
		const selectedValue = selectElement.value;

		// 관련 div 요소를 숨깁니다.
		divs.forEach(div => {
			if (div.id === selectedValue.slice(1)) { // 선택된 값에서 '#'을 제거한 id와 일치하는지 확인합니다.
				div.style.display = 'block'; // 일치하면 해당 div를 표시합니다.
			} else {
				div.style.display = 'none'; // 일치하지 않으면 해당 div를 숨깁니다.
			}
		});
	}

	// 모든 셀렉트 박스에 이벤트 리스너를 추가합니다.
	selectElements.forEach(select => {
		select.addEventListener('change', handleSelectChange);
	});

	// 페이지 로드 시 각 셀렉트 박스의 초기 선택 상태를 설정합니다.
	selectElements.forEach(select => {
		select.dispatchEvent(new Event('change'));
	});
});