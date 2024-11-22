<!-- 작업관리 > 계획공정표 -->
</div>
<?php
if(!$project) return false;
?>

<div class="schedule" id="vueApp">
    <schedule-main project_idx="<?=$project['idx']?>"></schedule-main>
</div>

<?php $jl->vueLoad('vueApp');?>
<?php $jl->componentLoad('schedule');?>
<?php $jl->componentLoad('item');?>

<style>
    .title_wrap{padding: 14px 40px 0; margin-bottom: 0;}
    .title_wrap h2{margin-bottom: 14px;}
    .page-wrapper .page-content > div{padding: 0;}
    .container-fluid .lnb{margin-bottom: 0;}
    footer{display: none;}
</style>


<script>
    //스케줄 슬라이드
    document.addEventListener('DOMContentLoaded', function() {
        const menuWrapper = document.querySelector('.schedule_wrapper');
        let isDragging = false;
        let startX;
        let scrollLeft;

        menuWrapper.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX - menuWrapper.offsetLeft;
            scrollLeft = menuWrapper.scrollLeft;
            menuWrapper.style.cursor = 'grabbing';
        });

        menuWrapper.addEventListener('mouseleave', () => {
            isDragging = false;
            menuWrapper.style.cursor = 'grab';
        });

        menuWrapper.addEventListener('mouseup', () => {
            isDragging = false;
            menuWrapper.style.cursor = 'grab';
        });

        menuWrapper.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - menuWrapper.offsetLeft;
            const walk = (x - startX) * 3; // 스크롤 속도 조절
            menuWrapper.scrollLeft = scrollLeft - walk;
        });

        // 마우스 휠 이벤트 추가
        menuWrapper.addEventListener('wheel', (e) => {
            e.preventDefault();
            menuWrapper.scrollLeft += e.deltaY;
        });
    });

    //진행상태 셀렉트박스 색상 표기
        // 선택된 옵션에 따라 클래스를 업데이트하는 함수
        function updateSelectClass(selectElement) {
            var selectedValue = selectElement.value;

            // 기존 클래스 제거
            selectElement.classList.remove('gray', 'green', 'blue', 'black');

            // 새로운 클래스 추가
            if (selectedValue) {
                selectElement.classList.add(selectedValue);
            }
        }

        // 모든 .statusSelect 요소를 선택
        var statusSelects = document.querySelectorAll('.statusSelect');

        // 각 요소에 대해 클래스 업데이트
        statusSelects.forEach(function(selectElement) {
            // 선택 이벤트 리스너 추가
            selectElement.addEventListener('change', function() {
                updateSelectClass(this);
            });

            // 초기 클래스 설정
            updateSelectClass(selectElement);
        });

    //달력 불러오기
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(".datePicker", {
            dateFormat: "Y-m-d", // 원하는 날짜 형식으로 설정
            locale: "ko" // 한국어 로케일 설정
        });
    });







    //gant 일별


    // Call the function to fill the days when the script loads

    //가로스크롤 휠적용
    //document.querySelector('.schedule_gant').addEventListener('wheel', function(event) {
    //    if (event.deltaY !== 0) {
    //        this.scrollLeft += event.deltaY;
    //        event.preventDefault();
    //    }
    //});

</script>

<!--달력관련-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ko.js"></script>
