<!-- 작업관리 > 주간공정표 -->
</div>
<div id="app">
    <schedule-weekly></schedule-weekly>
</div>

<?php $jl->vueLoad("app") ?>
<?php $jl->componentLoad("schedule")?>
<style>
    .title_wrap{padding: 14px 40px 0; margin-bottom: 0;}
    .title_wrap h2{margin-bottom: 14px;}
    .page-wrapper .page-content > div{padding: 0;}
    .container-fluid .lnb{margin-bottom: 0;}
    footer{display: none;}
</style>

<script>
    //진행상태 셀렉트박스 색상 표기
    // 선택된 옵션에 따라 클래스를 업데이트하는 함수
    function updateSelectClass(selectElement) {
        var selectedValue = selectElement.value;

        // 기존 클래스 제거
        selectElement.classList.remove('gray', 'green', 'blue', 'black', 'red');

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
</script>