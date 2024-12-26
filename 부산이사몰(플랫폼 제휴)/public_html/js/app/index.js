/**
 * 메인
 */
(function () {
    'use strict';

    const request = document.querySelector('#request');

    const type = document.querySelector('select[name="movingType"]'); //이사 서비스
    const schedDate = document.querySelector('input[name="schedDate"]'); // 이사일
    const origin =  document.querySelector('input[name="origin"]'); //출발지
    const bourne = document.querySelector('input[name="bourne"]'); // 도착지
    const mbName = document.querySelector('input[name="mbName"]'); // 이름
    const mbHp = document.querySelector('input[name="mbHp"]'); // 전화번호
    const mbIdx = document.querySelector('input[name="mbIdx"]');

    const dt = document.getElementById("selected");
    const dropdown = document.querySelector(".dropdown");
    const dropdownList = document.querySelector(".dropdown_list");
    const dropdownLinks = document.querySelectorAll(".dropdown_list a");

    /*const checkboxes = document.querySelectorAll('input[name="area[]"]')
    const typereg = document.querySelectorAll('#typereg');
    const service = document.querySelectorAll('#service');*/

    document.addEventListener('DOMContentLoaded', () => {

        eventListeners();
        removeTargetBlankForWebView();
    });

    function isWebView() {
        const userAgent = navigator.userAgent || navigator.vendor || window.opera;
        return /wv/.test(userAgent) || (/iPhone|iPad|iPod/.test(userAgent) && /AppleWebKit/.test(userAgent) && !/Safari/.test(userAgent));
    }

    function removeTargetBlankForWebView() {
        console.log(isWebView())
        if (isWebView()) {
            const links = document.querySelectorAll('a[target="_blank"]');
            links.forEach(link => {
                link.removeAttribute('target');
            });
        }
    }

    // 탭 클릭 시 서비스 값 업데이트
    document.querySelectorAll('.nav-tabs a').forEach(tab => {
        tab.addEventListener('click', function() {
            const serviceValue = this.getAttribute('data-service');
            document.getElementById('service').value = serviceValue;
        });
    });

    // 라디오 버튼 변경 시 URL 업데이트
    document.querySelectorAll('input[name^="area["]').forEach(radio => {
        radio.addEventListener('change', function() {
            const typereg = document.getElementById('typereg').value;
            const service = document.getElementById('service').value;
            const selectedArea = this.value;

            // URL 생성
          /*  const url = new URL(window.location.href);*/
            const url = new URL(window.location.origin + '/company');
            url.searchParams.set('type', typereg);
            url.searchParams.set('service', service);
            url.searchParams.set('reg', selectedArea);

            // 페이지 이동
            window.location.href = url.toString();
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        // 저장된 탭 정보 가져오기
        const activeTab = localStorage.getItem('activeTab') || '#area01'; // 기본 탭 설정

        // 해당 탭 활성화
        document.querySelector(`a[href="${activeTab}"]`).click();

        // 탭 클릭 이벤트 리스너 추가
        const tabs = document.querySelectorAll('.nav-tabs a');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                localStorage.setItem('activeTab', tab.getAttribute('href')); // 클릭한 탭 저장
            });
        });
    });


    function eventListeners(){

        /*checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', ({target}) => {
                if (target.checked) {
                    window.location.href = `${window.location.pathname}?type=${typereg.value}&service=${service.value}&reg=${target.value}`;
                }
            });
        });*/
        // 드롭다운을 클릭할 때 목록을 토글
        dt.addEventListener("click", function () {
            dropdownList.style.display = dropdownList.style.display === "block" ? "none" : "block";
        });

        // 목록의 항목을 클릭했을 때 dt 업데이트 및 목록 닫기
        dropdownLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault();  // 기본 동작 방지
                dt.textContent = this.textContent;  // 선택한 값으로 dt 업데이트
                dropdownList.style.display = "none";  // 드롭다운 닫기
                window.location.href = this.href;  // 페이지 이동
            });
        });

        // 페이지 외부를 클릭하면 드롭다운 닫기
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target)) {
                dropdownList.style.display = "none";
            }
        });

        request.addEventListener('click',requestUpload);
    }

    document.querySelector('#estimateButton').addEventListener('click', function(event) {
        if (!isLoggedIn) {
            event.preventDefault();
            utils.showToast('로그인이 필요합니다.')
            return false;
        }

        $('#estimateModal').modal('show');
    });

    async function requestUpload(e){
        e.preventDefault();


        const formCheck = await checkFormData();
        if (!formCheck) return false;

        const formData = new FormData();


        formData.append('schedDate' ,schedDate.value);
        formData.append('movingType' , type.value);
        formData.append('origin',origin.value);
        formData.append('bourne',bourne.value);
        formData.append('mbName' ,mbName.value);
        formData.append('mbHp' , mbHp.value);
        formData.append('mbidx' , mbIdx.value);

        utils.showLoading(true);
        setTimeout(async ()=>{
            const response = await API.fetchData('/api/estimate', formData);

            if (response.result) {
                utils.showAlert('이사견적 신청이 완료되었어요.', () => {
                    location.reload();
                });

            } else {
                let message = '이사견적 신청이 실패했어요.';
                message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                utils.showAlert(message);
            }
        },800);
    }

    function checkFormData(){
        if(!mbIdx.value){
            utils.showToast('로그인을 해주세요.', setTimeout(async ()=>{location.href = baseUrl+'login'},800));
            return false;
        }

        if(!type.value){
            utils.showToast('이사 서비스를 선택해주세요');
            return false;
        }

        if(!schedDate.value){
            utils.showToast('이사 예정일은 입력해주세요.');
            return false;
        }

        if(!origin.value){
            utils.showToast('출발지를 입력해주세요.');
            return false;
        }

        if(!bourne.value){
            utils.showToast('도착지를 입력해주세요.');
            return false;
        }

        if(!mbName.value){
            utils.showToast('고객님의 성함을 입력해주세요.');
            return false;
        }

        if(!mbHp.value){
            utils.showToast('고객님의 연락처를 입력해주세요.');
            return false;
        }

        const agree02 = document.getElementById('agree02');
        if (!agree02.checked) { // 동의
            utils.showToast('개인정보처리방침에 동의 해주세요.')
            return false;
        }
        return true;
    }

})();