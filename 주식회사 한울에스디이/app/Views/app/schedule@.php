<!-- 작업관리 -->
</div>
<div class="schedule">
<div class="grid grid2">
    <section class="schedule_type">
        <div class="flex ai-c jc-sb">
            <div class="area_filter">
                <input type="search" name="stx" placeholder="검색어 입력" value=""><button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
            <div class="btn_wrap">
                <button class="btn btn_small btn_blueline">작업구역관리</button>
                <button class="btn btn_small btn_darkblue"><img src="<?=base_url()?>img/common/excel_blue.svg"> 가져오기</button>
                <button class="btn btn_small btn_line"><img src="<?=base_url()?>img/common/excel_green.svg"> 내보내기</button>
            </div>
        </div>
        <table>
            <colgroup>
                <col width="auto">
                <col width="80px">
                <col width="70px">
                <col width="100px">
                <col width="100px">
                <col width="100px">
                <col width="100px">
            </colgroup>
            <thead>
                <tr>
                    <th>공종 및 상세</th>
                    <th>담당자</th>
                    <th>상태</th>
                    <th>시작예정일</th>
                    <th>마감예정일</th>
                    <th>시작일</th>
                    <th>마감</th>
                </tr>
            </thead>
            <tbody>
                <tr class="title_sort">
                    <th colspan="7"><i class="fa-solid fa-caret-down"></i> 콘크리트 타설</th>
                </tr>
                <tr class="title_zone">
                    <th colspan="7">101동 [27F] A-1</th>
                </tr>
                <tr class="title_work">
                    <th>거푸집</th>
                    <td><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="김설주" data-toggle="modal" data-target="#pmSearchModal"/></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray">예정</option>
                            <option value="green">진행</option>
                            <option value="blue" selected>완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                </tr>
                <tr>
                    <th>현장준비 및 기초 작업</th>
                    <td></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray">예정</option>
                            <option value="green">진행</option>
                            <option value="blue" selected>완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                </tr>
                <tr>
                    <th>거푸집 설치 및 보강</th>
                    <td></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray">예정</option>
                            <option value="green">진행</option>
                            <option value="blue" selected>완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                </tr>
                <tr class="title_work">
                    <th>철근</th>
                    <td><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="" data-toggle="modal" data-target="#pmSearchModal"/></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray">예정</option>
                            <option value="green">진행</option>
                            <option value="blue">완료</option>
                            <option value="black" selected>대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                </tr>
                <tr>
                    <th>철근 배치 및 체크</th>
                    <td></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray" selected>예정</option>
                            <option value="green">진행</option>
                            <option value="blue">완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                </tr>
                <tr>
                    <th>철근 연결 및 보강</th>
                    <td></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray" selected>예정</option>
                            <option value="green">진행</option>
                            <option value="blue">완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                </tr>
                <tr>
                    <th>철근 검수 및 조정</th>
                    <td></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray" selected>예정</option>
                            <option value="green">진행</option>
                            <option value="blue">완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                </tr>
                <tr class="title_zone">
                    <th colspan="7">101동 [27F] A-2</th>
                </tr>
                <tr class="title_work">
                    <th>거푸집</th>
                    <td><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="김설주" data-toggle="modal" data-target="#pmSearchModal"/></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray">예정</option>
                            <option value="green" selected>진행</option>
                            <option value="blue">완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                </tr>
                <tr>
                    <th>현장준비 및 기초 작업</th>
                    <td></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray" selected>예정</option>
                            <option value="green">진행</option>
                            <option value="blue">완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                </tr>
                <tr class="title_sort">
                    <th colspan="7"><i class="fa-solid fa-caret-down"></i> 콘크리트 타설</th>
                </tr>
                <tr class="title_zone">
                    <th colspan="7">101동 [27F] A-1</th>
                </tr>
                <tr class="title_work">
                    <th>거푸집</th>
                    <td><input class="inputPm" type="text" name="" id="" placeholder="담당자 지정" value="김설주" data-toggle="modal" data-target="#pmSearchModal"/></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray">예정</option>
                            <option value="green" selected>진행</option>
                            <option value="blue">완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                </tr>
                <tr>
                    <th>현장준비 및 기초 작업</th>
                    <td></td>
                    <td>
                        <select class="statusSelect">
                            <option value="gray" selected>예정</option>
                            <option value="green">진행</option>
                            <option value="blue">완료</option>
                            <option value="black">대기</option>
                        </select>
                    </td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value="2024-05-02"/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                    <td><input type="date" name="" id="" value=""/></td>
                </tr>
            </tbody>
        </table>
    </section>
    <section class="schedule_status">
        <div class="schedule-container">
            <div class="schedule-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th colspan="31">2023-05</th>
                        </tr>
                        <tr>
                            <th>01</th>
                            <th>02</th>
                            <th>03</th>
                            <th>04</th>
                            <th>05</th>
                            <th>06</th>
                            <th>07</th>
                            <th>08</th>
                            <th>09</th>
                            <th>10</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>
<style>
    .title_wrap h2{margin-bottom: 14px;}
    .page-wrapper .page-content > div{padding: 0;}
    .title_wrap{padding: 40px 40px 0; margin-bottom: 0;}
    .container-fluid .lnb{margin-bottom: 0;}
    footer{display: none;}

    .schedule_type table{width: 100%; border-top: 1px solid #EEEEEE;}
    .schedule_type table th,
    .schedule_type table td{border-bottom: 1px solid #EEEEEE; border-right: 1px solid #EEEEEE; padding: 4px 4px; text-align: center;}
    .schedule_type table tbody th{border-right: 1px solid #EEEEEE;  padding: 10px 10px;}
    .schedule_type table thead th{color: #74747450; padding-top: 6px; padding-bottom: 6px; white-space: nowrap;}
    .schedule_type table thead th:first-of-type{padding-left: 20px; text-align: left;}
    .schedule_type table thead th:last-of-type,
    .schedule_type table tbody td:last-of-type{border-right:0;}
    .schedule_type table td .inputPm{width: 60px; cursor: pointer;}
    .schedule_type table td .inputPm::placeholder{font-size: 0.9em; letter-spacing: -0.5px;}

    .schedule_type table input{border: 0; padding: 0; margin: 0 auto; height: auto; text-align: center;}
    .schedule_type table input[type=date]{letter-spacing: -1px; position: relative;z-index: 10;}
    .schedule_type table input[type=date]:before{content: attr(placeholder);position: absolute;color: #aaa;pointer-events: none;z-index: 5;}
    .schedule_type table input[type=date]::-webkit-calendar-picker-indicator {display: none;-webkit-appearance: none;}
    .schedule_type table input[type=date]::-moz-calendar-picker-indicator {display: none;}
    .schedule_type table input[type=date]::-ms-clear {display: none;}

    .schedule_type tbody th{text-align: left;}
    .schedule_type tbody th:first-of-type{padding-left: 34px; font-weight: normal; font-size: 0.95em;}
    .schedule_type tbody th:first-of-type:before{content: "└ "; display: inline-block; margin-right: 4px; font-size: 11px; opacity: 0.5;}
    .schedule_type .title_sort th:first-of-type{background-color:#EFF0F3; color: #474747; font-weight: 600; font-size: 1.15em; padding-top: 10px; padding-bottom: 10px; padding-left: 20px; cursor: pointer;}
    .schedule_type .title_zone th:first-of-type{background-color:#E4E4E4; color: #2A2B6A; font-weight: 600; padding-left: 20px; font-size: 1em;}
    .schedule_type .title_work th:first-of-type{font-weight: 600; padding-left: 20px; font-size: 1em;}
    .schedule_type .title_work th:first-of-type:before{content: "\f107"; font-family: "Font Awesome 6 Pro"; display: inline-block; font-weight: 300; margin-rifght: 4px;}
</style>
<script>
    //스케줄 슬라이드
    document.addEventListener('DOMContentLoaded', function() {
        const menuWrapper = document.querySelector('.schedule-wrapper');
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

    //테이블 분류별 열고 접기
    document.addEventListener('DOMContentLoaded', function () {
        // Handle .title_sort click
        document.querySelectorAll('.title_sort').forEach(function (titleSort) {
            titleSort.addEventListener('click', function () {
                // Get all title_sort elements
                const titleSorts = document.querySelectorAll('.title_sort');
                const currentTitleSort = this;

                // Close all other sections
                titleSorts.forEach(function (titleSort) {
                    if (titleSort !== currentTitleSort) {
                        // Collect all rows for this title_sort
                        const rowsToHide = [];
                        let row = titleSort.nextElementSibling;
                        while (row && !row.classList.contains('title_sort')) {
                            rowsToHide.push(row);
                            row = row.nextElementSibling;
                        }

                        // Hide collected rows
                        rowsToHide.forEach(function (row) {
                            row.style.display = 'none';
                        });
                    }
                });

                // Toggle visibility of the current section
                const nextRows = [];
                let nextRow = currentTitleSort.nextElementSibling;
                while (nextRow && !nextRow.classList.contains('title_sort')) {
                    nextRows.push(nextRow);
                    nextRow = nextRow.nextElementSibling;
                }

                nextRows.forEach(function (row) {
                    if (row.style.display === 'none') {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>