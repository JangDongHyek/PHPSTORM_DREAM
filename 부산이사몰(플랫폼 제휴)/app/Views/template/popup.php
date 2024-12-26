<div id="popup" class="popup">
    <div class="popup01" data-popup-id="popup01">
        <div class="popup_inner">
            <div class="logo">
                <img src="../img/common/logo_mark_white.svg">
            </div>
            <h1>부산이사몰 <span>리뉴얼 안내</span></h1>
            <div class="text">
                더 나은 서비스와 사용자 경험을 제공하기 위해<br>
                홈페이지와 앱이 새롭게 리뉴얼되었습니다!<br>
                업데이트된 내용을 확인하려면 아래 버튼을 클릭하세요.
            </div>
            <div class="btn_wrap">
                <button onclick="window.open('https://play.google.com/store/apps/details?id=com.knn24form.knn24form', '_blank')">안드로이드 다운로드</button>
                <button onclick="window.open('https://apps.apple.com/kr/app/%EB%B6%80%EC%82%B0%EC%9D%B4%EC%82%AC%EB%AA%B0/id6738668836', '_blank')">IOS 다운로드</button>
            </div>
        </div>
        <div class="close_wrap">
            <button onclick="closePopup24Hours('popup01')">24시간 동안 보지 않기</button>
            <button onclick="closePopup('popup01')">닫기 <i class="fa-sharp fa-thin fa-xmark"></i></button>
        </div>
    </div>
</div>

<script>
    // 팝업 표시 여부 확인
    const checkPopupVisibility = () => {
        const popups = document.querySelectorAll('.popup01');
        let anyPopupVisible = false;

        popups.forEach(popup => {
            const popupId = popup.getAttribute('data-popup-id'); // data-popup-id로 구분
            const hideUntil = localStorage.getItem(`${popupId}_hideUntil`);
            if (!hideUntil || new Date() > new Date(hideUntil)) {
                popup.style.display = 'block'; // 표시
                anyPopupVisible = true; // 표시된 팝업이 있음
            } else {
                popup.style.display = 'none'; // 숨김
            }
        });

        // 모든 팝업이 숨겨지면 #popup 컨테이너도 숨김
        const popupContainer = document.getElementById('popup');
        popupContainer.style.display = anyPopupVisible ? 'block' : 'none';
    };

    // 그냥 닫기
    const closePopup = (popupId) => {
        const popup = document.querySelector(`.popup01[data-popup-id="${popupId}"]`);
        if (popup) {
            popup.style.display = 'none';
        }
        checkAllPopupsClosed(); // 모든 팝업이 닫혔는지 확인
    };

    // 24시간 동안 닫기
    const closePopup24Hours = (popupId) => {
        const hideUntil = new Date();
        hideUntil.setHours(hideUntil.getHours() + 24); // 24시간 후 시간 설정
        localStorage.setItem(`${popupId}_hideUntil`, hideUntil);
        closePopup(popupId);
    };

    // 모든 팝업이 닫혔는지 확인 후 #popup 숨김
    const checkAllPopupsClosed = () => {
        const visiblePopups = document.querySelectorAll('.popup01');
        const anyVisible = Array.from(visiblePopups).some(popup => popup.style.display !== 'none');
        const popupContainer = document.getElementById('popup');
        popupContainer.style.display = anyVisible ? 'block' : 'none';
    };

    // 페이지 로드 시 팝업 확인
    window.onload = checkPopupVisibility;

</script>

