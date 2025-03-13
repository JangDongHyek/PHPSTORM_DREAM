<!-- 작업관리 > 계획공정표 -->
</div>
<?php
if(!$project) return false;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.css">
<style>
    .gantt .bar-progress {fill: #2a2b6a;}
    .gantt .bar-wrapper:hover .bar-progress {fill: #14153b;}
    .gantt .tick.thick {stroke-width: 80;stroke: #5151510a;}
    .gantt .upper-text {fill: #14153b;font-weight: 800;font-size: 1.3em;}
</style>
<div class="schedule">
    <div class="flex ai-c jc-sb">
        <div class="area_filter">
            <input type="search" name="stx" placeholder="검색어 입력" value=""><button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
        </div>
        <div class="btn-wrap">
            <button class="btn btn-small btn-gray" onclick="expandAll()">전체 펼치기</button>
            <button class="btn btn-small btn-gray" onclick="collapseAll()">전체 접기</button>
            <button class="btn btn-small btn-darkblue"><img src="<?=base_url()?>img/common/excel_blue.svg"> 가져오기</button>
            <button class="btn btn-small btn-line"><img src="<?=base_url()?>img/common/excel_green.svg"> 내보내기</button>
        </div>
    </div>
    <div class="grid grid2">
        <section class="schedule_task">
            <!-- 테이블 헤더 유지 -->
            <div class="task_header colgroup">
                <div class="border">공종명 및 상세</div>
                <div class="border">담당자</div>
                <div class="border">상태</div>
                <div class="border">시작일</div>
                <div class="border">마감일</div>
            </div>

            <!-- 1단계: 101동 -->
            <div class="section_title zone_title" onclick="toggleSection(this)" data-task-id="task-101">
                <i class="fa-solid fa-caret-down"></i> 101동
            </div>

            <div class="section_content">
                <!-- 2단계: 1층 -->
                <div class="zone_title c1" onclick="toggleSection(this)" data-task-id="task-101-1">
                    <i class="fa-solid fa-caret-down"></i> 1층
                </div>

                <div class="section_content">
                    <!-- 3단계: A 구역 -->
                    <div class="zone_title c2" onclick="toggleSection(this)" data-task-id="task-101-1-A">
                        <i class="fa-solid fa-caret-down"></i> A 구역
                    </div>

                    <div class="section_content">
                        <!-- 콘크리트 작업 추가 -->
                        <div class="task_content_dl" data-task-id="task-101-1-A-1">
                            <div class="colgroup task_item">
                                <div class="border">콘크리트</div>
                                <div class="border"><input type="text" placeholder="담당자"/></div>
                                <div class="border">
                                    <select class="statusSelect">
                                        <option value="예정" selected>예정</option>
                                        <option value="진행">진행</option>
                                        <option value="완료">완료</option>
                                        <option value="보류">보류</option>
                                    </select>
                                </div>
                                <div class="border"><input type="date" value="2025-02-01" /></div>
                                <div class="border"><input type="date" value="2025-02-10" /></div>
                            </div>
                        </div>
                        <div class="task_content_dl" data-task-id="task-101-1-A-2">
                            <div class="colgroup task_item">
                                <div class="border">거푸집</div>
                                <div class="border"><input type="text" placeholder="담당자"/></div>
                                <div class="border">
                                    <select class="statusSelect">
                                        <option value="예정" selected>예정</option>
                                        <option value="진행">진행</option>
                                        <option value="완료">완료</option>
                                        <option value="보류">보류</option>
                                    </select>
                                </div>
                                <div class="border"><input type="date" value="2025-02-03" /></div>
                                <div class="border"><input type="date" value="2025-02-15" /></div>
                            </div>
                        </div>
                        <div class="task_content_dl" data-task-id="task-101-1-A-3">
                            <div class="colgroup task_item">
                                <div class="border">철근</div>
                                <div class="border"><input type="text" placeholder="담당자"/></div>
                                <div class="border">
                                    <select class="statusSelect">
                                        <option value="예정" selected>예정</option>
                                        <option value="진행">진행</option>
                                        <option value="완료">완료</option>
                                        <option value="보류">보류</option>
                                    </select>
                                </div>
                                <div class="border"><input type="date" value="2025-02-22" /></div>
                                <div class="border"><input type="date" value="2025-02-26" /></div>
                            </div>
                        </div>
                    </div>

                    <!-- 3단계: B 구역 -->
                    <div class="zone_title c2" onclick="toggleSection(this)" data-task-id="task-101-1-B">
                        <i class="fa-solid fa-caret-down"></i> B 구역
                    </div>

                    <div class="section_content">
                        <!-- 4단계: 거푸집 작업 -->
                        <div class="section_content">
                            <div class="task_content_dl" data-task-id="task-101-1-B-1">
                                <div class="colgroup task_item">
                                    <div class="border">콘크리트</div>
                                    <div class="border"><input type="text" placeholder="담당자"/></div>
                                    <div class="border">
                                        <select class="statusSelect">
                                            <option value="예정" selected>예정</option>
                                            <option value="진행">진행</option>
                                            <option value="완료">완료</option>
                                            <option value="보류">보류</option>
                                        </select>
                                    </div>
                                    <div class="border"><input type="date" class="actual-start" value="2025-02-07" /></div>
                                    <div class="border"><input type="date" class="actual-end" value="2025-02-15" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="section_content">
                            <div class="task_content_dl" data-task-id="task-101-1-B-2">
                                <div class="colgroup task_item">
                                    <div class="border">거푸집</div>
                                    <div class="border"><input type="text" placeholder="담당자"/></div>
                                    <div class="border">
                                        <select class="statusSelect">
                                            <option value="예정" selected>예정</option>
                                            <option value="진행">진행</option>
                                            <option value="완료">완료</option>
                                            <option value="보류">보류</option>
                                        </select>
                                    </div>
                                    <div class="border"><input type="date" class="actual-start" value="2025-02-10" /></div>
                                    <div class="border"><input type="date" class="actual-end" value="2025-02-18" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="section_content">
                            <div class="task_content_dl" data-task-id="task-101-1-B-3">
                                <div class="colgroup task_item">
                                    <div class="border">철근</div>
                                    <div class="border"><input type="text" placeholder="담당자"/></div>
                                    <div class="border">
                                        <select class="statusSelect">
                                            <option value="예정" selected>예정</option>
                                            <option value="진행">진행</option>
                                            <option value="완료">완료</option>
                                            <option value="보류">보류</option>
                                        </select>
                                    </div>
                                    <div class="border"><input type="date" class="actual-start" value="2025-02-19" /></div>
                                    <div class="border"><input type="date" class="actual-end" value="2025-03-01" /></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="section_content">
                <!-- 2단계: 2층 -->
                <div class="zone_title c1" onclick="toggleSection(this)" data-task-id="task-101-2">
                    <i class="fa-solid fa-caret-down"></i> 2층
                </div>

                <div class="section_content">
                    <!-- 3단계: A 구역 -->
                    <div class="zone_title c2" onclick="toggleSection(this)" data-task-id="task-101-2-A">
                        <i class="fa-solid fa-caret-down"></i> A 구역
                    </div>

                    <div class="section_content">
                        <!-- 콘크리트 작업 추가 -->
                        <div class="task_content_dl" data-task-id="task-101-2-A-1">
                            <div class="colgroup task_item">
                                <div class="border">콘크리트</div>
                                <div class="border"><input type="text" placeholder="담당자"/></div>
                                <div class="border">
                                    <select class="statusSelect">
                                        <option value="예정" selected>예정</option>
                                        <option value="진행">진행</option>
                                        <option value="완료">완료</option>
                                        <option value="보류">보류</option>
                                    </select>
                                </div>
                                <div class="border"><input type="date" value="2025-03-01" /></div>
                                <div class="border"><input type="date" value="2025-03-15" /></div>
                            </div>
                        </div>
                        <div class="task_content_dl" data-task-id="task-101-2-A-2">
                            <div class="colgroup task_item">
                                <div class="border">거푸집</div>
                                <div class="border"><input type="text" placeholder="담당자"/></div>
                                <div class="border">
                                    <select class="statusSelect">
                                        <option value="예정" selected>예정</option>
                                        <option value="진행">진행</option>
                                        <option value="완료">완료</option>
                                        <option value="보류">보류</option>
                                    </select>
                                </div>
                                <div class="border"><input type="date" value="2025-03-12" /></div>
                                <div class="border"><input type="date" value="2025-03-21" /></div>
                            </div>
                        </div>
                        <div class="task_content_dl" data-task-id="task-101-2-A-3">
                            <div class="colgroup task_item">
                                <div class="border">철근</div>
                                <div class="border"><input type="text" placeholder="담당자"/></div>
                                <div class="border">
                                    <select class="statusSelect">
                                        <option value="예정" selected>예정</option>
                                        <option value="진행">진행</option>
                                        <option value="완료">완료</option>
                                        <option value="보류">보류</option>
                                    </select>
                                </div>
                                <div class="border"><input type="date" value="2025-03-22" /></div>
                                <div class="border"><input type="date" value="2025-03-30" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="schedule_gant">
            <svg id="gantt"></svg>
        </section>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.min.js"></script>

<script>

    let gantt;
    let allTasks = [
        // 🏠 1단계: 101동 (최상위)
        { id: "task-101", name: "101동", dependencies: "" , progress: 60},

        // 🧱 2단계: 1층
        { id: "task-101-1", name: "1층", dependencies: "task-101" , progress: 50},

        // 📦 3단계: 1층 A 구역
        { id: "task-101-1-A", name: "1층 A 구역", dependencies: "task-101-1" , progress: 70},

        // 🛠️ 4단계: 1층 A 구역 작업들
        { id: "task-101-1-A-1", name: "콘크리트", start: "2025-02-01", end: "2025-02-10", progress: 100, dependencies: "task-101-1-A" },
        { id: "task-101-1-A-2", name: "거푸집", start: "2025-02-03", end: "2025-02-15", progress: 40, dependencies: "task-101-1-A" },
        { id: "task-101-1-A-3", name: "철근", start: "2025-02-22", end: "2025-02-26", progress: 0, dependencies: "task-101-1-A" },

        // 📦 3단계: 1층 B 구역
        { id: "task-101-1-B", name: "1층 B 구역", dependencies: "task-101-1" , progress: 30},

        // 🛠️ 4단계: 1층 B 구역 작업들
        { id: "task-101-1-B-1", name: "콘크리트", start: "2025-02-07", end: "2025-02-15", progress: 30, dependencies: "task-101-1-B" },
        { id: "task-101-1-B-2", name: "거푸집", start: "2025-02-10", end: "2025-02-18", progress: 30, dependencies: "task-101-1-B" },
        { id: "task-101-1-B-3", name: "철근", start: "2025-02-19", end: "2025-03-01", progress: 30, dependencies: "task-101-1-B" },

        // 🧱 2단계: 2층
        { id: "task-101-2", name: "2층", dependencies: "task-101", progress: 70},

        // 📦 3단계: 2층 A 구역
        { id: "task-101-2-A", name: "2층 A 구역", dependencies: "task-101-2" , progress: 70},

        // 🛠️ 4단계: 2층 A 구역 작업들
        { id: "task-101-2-A-1", name: "콘크리트", start: "2025-03-01", end: "2025-03-15", progress: 100, dependencies: "task-101-2-A" },
        { id: "task-101-2-A-2", name: "거푸집", start: "2025-03-12", end: "2025-03-21", progress: 40, dependencies: "task-101-2-A" },
        { id: "task-101-2-A-3", name: "철근", start: "2025-03-22", end: "2025-03-30", progress: 0, dependencies: "task-101-2-A" }
    ];


    function getParentTaskDuration(parentId) {
        let children = allTasks.filter(task =>
            typeof task.dependencies === "string" &&
            task.dependencies.startsWith(parentId) &&
            task.start && task.end
        );

        if (children.length === 0) return null;

        let start = new Date(Math.min(...children.map(task => new Date(task.start))));
        let end = new Date(Math.max(...children.map(task => new Date(task.end))));

        return {
            start: start.toISOString().split('T')[0],
            end: end.toISOString().split('T')[0]
        };
    }

    function updateParentDurations() {
        const parentList = [
            "task-101-2-A", "task-101-1-A", "task-101-1-B", // 구역별 (A 구역, B 구역)
            "task-101-2", "task-101-1", "task-101" // 층, 동
        ];

        parentList.forEach(parentId => {
            let duration = getParentTaskDuration(parentId);
            let parentTask = allTasks.find(task => task.id === parentId);

            if (!parentTask) {
                console.warn(`⛔ Warning: Task ID '${parentId}' not found in allTasks array.`);
                return;
            }

            if (duration) {
                parentTask.start = duration.start;
                parentTask.end = duration.end;
            }
        });
    }


    function toggleSection(element) {
        let section = element.nextElementSibling;
        section.classList.toggle("hidden");

        // 간트 차트 업데이트
        updateGanttVisibility();
    }

    function updateGanttVisibility() {
        updateParentDurations();

        // 현재 표시되고 있는 HTML 엘리먼트와 매칭되는 태스크만 필터링
        const visibleTasks = allTasks.filter(task => {
            let row = document.querySelector(`[data-task-id='${task.id}']`);
            return row && !row.closest(".hidden") && task.start && task.end;
        });

        // 💥 기존 Gantt 차트를 초기화 (destroy() 대신 수동 삭제)
        const ganttContainer = document.querySelector("#gantt");
        ganttContainer.innerHTML = ""; // SVG 컨테이너 초기화

        // Gantt 차트를 새로운 데이터로 다시 그리기
        gantt = new Gantt("#gantt", visibleTasks, { view_mode: "Day" });

        // Gantt 차트 레이아웃 새로고침
        updateGanttLayout();
    }

    function updateGanttLayout() {
        const taskRows = document.querySelectorAll(".task_content_dl:not(.hidden)").length;
        const ganttContainer = document.querySelector(".gantt-container");

        if (!ganttContainer) return;

        // 높이를 실제 표시되는 태스크 수에 맞게 조정
        const newHeight = Math.max(500, taskRows * 40);
        ganttContainer.style.height = `${newHeight}px`;

        // Gantt 차트의 내부 SVG 높이도 맞춰주기
        const svgElement = document.querySelector("#gantt svg");
        if (svgElement) {
            svgElement.style.height = `${newHeight}px`;
        }
    }



    document.addEventListener("DOMContentLoaded", function () {
        updateParentDurations();
        gantt = new Gantt("#gantt", allTasks, { view_mode: "Day" });
        updateGanttVisibility();

        // ✅ 월 이름을 한글화 시도
        observeGanttDateChanges();
        setInterval(formatGanttMonthNames, 1000); // ⏱️ 매초마다 재확인 및 변환
    });

    // 🕵️ **SVG 변화 감지:**
    function observeGanttDateChanges() {
        const ganttContainer = document.querySelector("#gantt");

        if (!ganttContainer) return;

        const observer = new MutationObserver(() => {
            formatGanttMonthNames(); // 변화를 감지할 때마다 한글화
        });

        observer.observe(ganttContainer, {
            childList: true,
            subtree: true,
            characterData: true
        });
    }

    // 📅 **월 영어를 한글 표기로 변환하는 함수:**
    function formatGanttMonthNames() {
        const monthMap = {
            "January": "1월",
            "February": "2월",
            "March": "3월",
            "April": "4월",
            "May": "5월",
            "June": "6월",
            "July": "7월",
            "August": "8월",
            "September": "9월",
            "October": "10월",
            "November": "11월",
            "December": "12월"
        };

        // 🎯 `text.upper-text` 정확히 타겟팅!
        const dateElements = document.querySelectorAll('text.upper-text');

        dateElements.forEach(element => {
            const originalText = element.textContent.trim();

            if (monthMap[originalText]) {
                element.textContent = monthMap[originalText];
            }
        });
    }


</script>

