<!-- 작업관리 > 계획공정표 -->
</div>
<?php
if(!$project) return false;
?>
<div class="schedule-list">
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
        <div class="flex">
            <button class="view-btn btn active" onclick="showView('weekly', this)">주별</button>
            <button class="view-btn btn" onclick="showView('daily', this)">일별</button>
        </div>

    <div class="grid grid2">
        <section class="schedule_task">
            <div class="task_header colgroup">
                <div class="border">작업 구역</div>
                <div class="border">담당자</div>
                <div class="border">상태</div>
                <div class="border">시작예정일</div>
                <div class="border">마감예정일</div>
                <div class="border">시작일</div>
                <div class="border">마감일</div>
            </div>

            <div class="section_title zone_title">
                <i class="fa-solid fa-caret-down"></i> 101동
            </div>

            <div class="section_content">
                <div class="zone_title c1" >
                    <i class="fa-solid fa-caret-down"></i> 1층
                </div>

                <div class="section_content">
                    <div class="task_content_dl">
                        <div class="colgroup task_item">
                            <div class="border">A구역</div>
                            <div class="border"><input type="text" placeholder="담당자"/></div>
                            <div class="border">
                                <select class="statusSelect red">
                                    <option value="예정" >예정</option>
                                    <option value="진행">진행</option>
                                    <option value="조기">조기</option>
                                    <option value="완료">완료</option>
                                    <option value="초과" selected>초과</option>
                                </select>
                            </div>
                            <div class="border"><input type="date" value="2025-03-01" /></div>
                            <div class="border"><input type="date" value="2025-03-10" /></div>
                            <div class="border"><input type="date" value="2025-03-01" /></div>
                            <div class="border"><input type="date" value="2025-03-15" /></div>
                        </div>
                    </div>
                </div>

                <div class="section_content">
                    <div class="task_content_dl">
                        <div class="colgroup task_item">
                            <div class="border">B구역</div>
                            <div class="border"><input type="text" placeholder="담당자"/></div>
                            <div class="border">
                                <select class="statusSelect blue">
                                    <option value="예정" >예정</option>
                                    <option value="진행">진행</option>
                                    <option value="조기">조기</option>
                                    <option value="완료" selected>완료</option>
                                    <option value="초과">초과</option>
                                </select>
                            </div>
                            <div class="border"><input type="date" value="2025-03-11" /></div>
                            <div class="border"><input type="date" value="2025-03-20" /></div>
                            <div class="border"><input type="date" value="2025-03-11"/></div>
                            <div class="border"><input type="date" value="2025-03-20"/></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section_content">
                <div class="zone_title c1" >
                    <i class="fa-solid fa-caret-down"></i> 2층
                </div>

                <div class="section_content">
                    <div class="task_content_dl">
                        <div class="colgroup task_item">
                            <div class="border">A구역</div>
                            <div class="border"><input type="text" placeholder="담당자"/></div>
                            <div class="border">
                                <select class="statusSelect green">
                                    <option value="예정">예정</option>
                                    <option value="진행">진행</option>
                                    <option value="조기" selected>조기</option>
                                    <option value="완료">완료</option>
                                    <option value="초과">초과</option>
                                </select>
                            </div>
                            <div class="border"><input type="date" value="2025-03-21" /></div>
                            <div class="border"><input type="date" value="2025-04-10" /></div>
                            <div class="border"><input type="date" value="2025-03-21"/></div>
                            <div class="border"><input type="date" value="2025-04-07"/></div>
                        </div>
                    </div>
                </div>

                <div class="section_content">
                    <div class="task_content_dl">
                        <div class="colgroup task_item">
                            <div class="border">B구역</div>
                            <div class="border"><input type="text" placeholder="담당자"/></div>
                            <div class="border">
                                <select class="statusSelect">
                                    <option value="예정" selected>예정</option>
                                    <option value="진행">진행</option>
                                    <option value="조기">조기</option>
                                    <option value="완료">완료</option>
                                    <option value="초과">초과</option>
                                </select>
                            </div>
                            <div class="border"><input type="date" value="2025-04-11" /></div>
                            <div class="border"><input type="date" value="2025-04-24" /></div>
                            <div class="border"><input type="date" /></div>
                            <div class="border"><input type="date" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="calendar">
            <div id="daily-schedule" class="schedule-wrapper hidden">
                <div id="daily-month-header" class="month-header"></div>
                <div id="daily-days" class="schedule"></div>
            </div>

            <div id="weekly-schedule" class="schedule-wrapper">
                <div id="weekly-month-header" class="month-header"></div>
                <div id="weekly-weeks" class="schedule"></div>
            </div>
        </section>
    </div>
    <script>
        const dailyMonthHeader = document.getElementById('daily-month-header');
        const dailyContainer = document.getElementById('daily-days');
        const weeklyMonthHeader = document.getElementById('weekly-month-header');
        const weeklyContainer = document.getElementById('weekly-weeks');

        const startDate = new Date('2025-03-01');
        const endDate = new Date('2025-04-30');
        const today = new Date();
        const totalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
        const dailyDayWidth = 40;
        const weeklyDayWidth = 80;

        function renderDailyView() {
            dailyContainer.innerHTML = '';
            dailyMonthHeader.innerHTML = '';

            const dayRow = document.createElement('div');
            dayRow.className = 'schedule-row';

            let marchDays = 0, aprilDays = 0;

            for (let i = 0; i < totalDays; i++) {
                const currentDate = new Date(startDate);
                currentDate.setDate(startDate.getDate() + i);

                const dayDiv = document.createElement('div');
                dayDiv.className = 'day';
                dayDiv.style.width = `${dailyDayWidth}px`;
                dayDiv.textContent = `${currentDate.getDate()}`;

                if (currentDate.toDateString() === today.toDateString()) {
                    dayDiv.classList.add('today');
                }

                dayRow.appendChild(dayDiv);

                if (currentDate.getMonth() === 2) marchDays++;
                else if (currentDate.getMonth() === 3) aprilDays++;
            }

            dailyContainer.appendChild(dayRow);
            dailyMonthHeader.appendChild(createMonthLabel('2025년 3월', marchDays * dailyDayWidth));
            dailyMonthHeader.appendChild(createMonthLabel('2025년 4월', aprilDays * dailyDayWidth));

            applyTodayToTasks();
        }

        function createMonthLabel(monthName, width) {
            const label = document.createElement('div');
            label.className = 'month-label';
            label.style.width = `${width}px`;
            label.textContent = monthName;
            return label;
        }

        function getMonthlyWeekIndex(targetDate) {
            const year = targetDate.getFullYear();
            const month = targetDate.getMonth();
            const day = targetDate.getDate();

            let weekNum = Math.ceil(day / 7); // 7일 단위로 주차 계산
            if (month === 2 || month === 3) { // 3월 & 4월 모두 최대 5주 제한
                weekNum = Math.min(weekNum, 5);
            }
            console.log(`📌 getMonthlyWeekIndex() → ${targetDate.toLocaleDateString()} → ${weekNum}주차`);

            return weekNum;
        }


        function getWeeksInMonth(year, month) {
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            let totalWeeks = Math.ceil(daysInMonth / 7);

            if (month === 2 || month === 3) { // 3월, 4월 최대 5주
                totalWeeks = Math.min(totalWeeks, 5);
            }

            return totalWeeks;
        }


        function renderWeeklyView() {
            weeklyContainer.innerHTML = '';
            weeklyMonthHeader.innerHTML = '';

            let weeksByMonth = {
                2: [], // 3월
                3: []  // 4월
            };

            [3, 4].forEach(month => {
                let totalWeeks = getWeeksInMonth(2025, month - 1);
                weeksByMonth[month - 1] = Array.from({ length: totalWeeks }, (_, index) => ({
                    start: index * 7 + 1,
                    end: Math.min((index + 1) * 7, new Date(2025, month, 0).getDate())
                }));
            });

            // 🔹 월 헤더 추가
            weeklyMonthHeader.appendChild(createMonthLabel('2025년 3월', weeksByMonth[2].length * weeklyDayWidth));
            weeklyMonthHeader.appendChild(createMonthLabel('2025년 4월', weeksByMonth[3].length * weeklyDayWidth));

            const weekRow = document.createElement('div');
            weekRow.className = 'schedule-row';

            // 🔹 3월 주차 생성
            weeksByMonth[2].forEach((week, index) => {
                const weekDiv = document.createElement('div');
                weekDiv.className = 'week';
                weekDiv.style.width = `${weeklyDayWidth}px`;
                weekDiv.textContent = `${index + 1}주차`;
                weekRow.appendChild(weekDiv);
            });

            // 🔹 4월 주차 생성
            weeksByMonth[3].forEach((week, index) => {
                const weekDiv = document.createElement('div');
                weekDiv.className = 'week';
                weekDiv.style.width = `${weeklyDayWidth}px`;
                weekDiv.textContent = `${index + 1}주차`;
                weekRow.appendChild(weekDiv);
            });

            weeklyContainer.appendChild(weekRow);
            applyTodayToTasks();
        }

        function applyTodayToTasks() {
            document.querySelectorAll('.schedule-row .day, .schedule-row .week').forEach(el => {
                el.classList.remove('today');
            });
            document.querySelectorAll('.today-line').forEach(line => line.remove());

            let todayIndex = -1;

            document.querySelectorAll('.day').forEach((day, index) => {
                const dayText = parseInt(day.textContent.replace('일', ''), 10);
                const currentDate = new Date(startDate);
                currentDate.setDate(startDate.getDate() + index); // 실제 날짜 계산

                if (
                    currentDate.getDate() === today.getDate() &&
                    currentDate.getMonth() === today.getMonth() &&
                    currentDate.getFullYear() === today.getFullYear()
                ) {
                    todayIndex = index;
                    day.classList.add('today');
                }
            });


            if (todayIndex !== -1) {
                document.querySelectorAll('.schedule-row').forEach(row => {
                    const dayCells = row.querySelectorAll('.day');
                    if (dayCells[todayIndex]) {
                        dayCells[todayIndex].classList.add('today');
                    }
                });

                const todayWeekIndex = getMonthlyWeekIndex(today);

                document.querySelectorAll('.week').forEach((week, index) => {
                    if (index + 1 === todayWeekIndex) {
                        week.classList.add('today');
                        const todayLine = document.createElement('div');
                        todayLine.className = 'today-line';
                        week.appendChild(todayLine);
                    }
                });

                document.querySelectorAll('.schedule-row').forEach(row => {
                    const weekCells = row.querySelectorAll('.week');
                    if (weekCells[todayWeekIndex - 1]) {
                        const todayLine = document.createElement('div');
                        todayLine.className = 'today-line';
                        weekCells[todayWeekIndex - 1].appendChild(todayLine);
                    }
                });
            }
        }

        function getWeeklySpan(start, end) {
            const startWeek = getMonthlyWeekIndex(start);
            const endWeek = getMonthlyWeekIndex(end);

            let totalWeeks;

            if (start.getMonth() === end.getMonth()) {
                totalWeeks = endWeek - startWeek + 1;
            } else {
                // 월이 다르면, 개별 월의 주차 계산 후 합산
                const lastMarchWeek = getMonthlyWeekIndex(new Date(2025, 2, 31));
                const startMonthWeeks = lastMarchWeek - startWeek + 1;
                const endMonthWeeks = endWeek;
                totalWeeks = startMonthWeeks + endMonthWeeks;
            }

            console.log(`📌 ${start.toLocaleDateString()} ~ ${end.toLocaleDateString()} → ${totalWeeks}주차`);
            return totalWeeks;
        }



        function addSchedule(start, end, name, className = '') {
            const startIndex = Math.floor((start - startDate) / (1000 * 60 * 60 * 24));
            const endIndex = Math.floor((end - startDate) / (1000 * 60 * 60 * 24));
            const duration = endIndex - startIndex + 1;

            // ✅ 데일리 일정 추가
            const taskRow = document.createElement('div');
            taskRow.className = 'schedule-row';

            for (let i = 0; i < totalDays; i++) {
                const taskDiv = document.createElement('div');
                taskDiv.className = 'day';
                taskDiv.style.width = `${dailyDayWidth}px`;

                if (i === startIndex) {
                    const task = document.createElement('div');
                    task.className = `task ${className}`;
                    task.textContent = name;
                    task.style.width = `${duration * dailyDayWidth - 20}px`;

                    // ✅ 특정 클래스 제외 후 클릭 이벤트 추가
                    if (!['zone-title', 'zone-sub'].includes(className)) {
                        task.onclick = () => openTaskPopup(name, start, end);
                    }
                    taskDiv.appendChild(task);
                }
                taskRow.appendChild(taskDiv);
            }
            dailyContainer.appendChild(taskRow);

            // ✅ 위클리 일정 추가
            const totalSpan = getWeeklySpan(start, end);
            const startWeek = getMonthlyWeekIndex(start);
            const totalWeeksMarch = getWeeksInMonth(2025, 2);
            const totalWeeksApril = getWeeksInMonth(2025, 3);

            const weekTaskRow = document.createElement('div');
            weekTaskRow.className = 'schedule-row';
            let weekOffset = (start.getMonth() === 2) ? 0 : totalWeeksMarch;

            let taskAdded = false;

            for (let i = 1; i <= (totalWeeksMarch + totalWeeksApril); i++) {
                const weekTaskDiv = document.createElement('div');
                weekTaskDiv.className = 'week';
                weekTaskDiv.style.width = `${weeklyDayWidth}px`;

                console.log(`   - [LOOP] i: ${i}, startWeek + weekOffset: ${startWeek + weekOffset}`);

                // ✅ 정확한 주차에서 일정 추가
                if (!taskAdded && i === (startWeek + weekOffset)) {
                    console.log(`   🚀 ${name} 일정이 ${i}주차에 추가됨!`);
                    const task = document.createElement('div');
                    task.className = `task ${className}`;
                    task.textContent = name;
                    task.style.width = `${totalSpan * weeklyDayWidth - 20}px`;
                    // ✅ 특정 클래스 제외 후 클릭 이벤트 추가
                    if (!['zone-title', 'zone-sub'].includes(className)) {
                        task.onclick = () => openTaskPopup(name, start, end);
                    }
                    weekTaskDiv.appendChild(task);
                    taskAdded = true;
                }

                weekTaskRow.appendChild(weekTaskDiv);
            }

            weeklyContainer.appendChild(weekTaskRow);
            applyTodayToTasks();


        }

        function showView(view, btn) {
            document.querySelectorAll('.view-btn').forEach(button => button.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('daily-schedule').classList.toggle('hidden', view !== 'daily');
            document.getElementById('weekly-schedule').classList.toggle('hidden', view !== 'weekly');
        }

        function openTaskPopup(name, start, end) {
            const url = `./taskForm`;
            const popupOptions = "width=1600,height=800,scrollbars=yes,resizable=yes";

            window.open(url, "TaskFormPopup", popupOptions);
        }

        renderDailyView();
        renderWeeklyView();
        addSchedule(new Date('2025-03-01'), new Date('2025-04-24'), '101동', 'zone-title');
        addSchedule(new Date('2025-03-01'), new Date('2025-03-20'), '1층', 'zone-sub');
        addSchedule(new Date('2025-03-01'), new Date('2025-03-10'), 'A구역', 'red');
        addSchedule(new Date('2025-03-11'), new Date('2025-03-20'), 'B구역', 'blue');
        addSchedule(new Date('2025-03-21'), new Date('2025-04-24'), '2층', 'zone-sub');
        addSchedule(new Date('2025-03-21'), new Date('2025-04-10'), 'A구역', 'green');
        addSchedule(new Date('2025-04-11'), new Date('2025-04-24'), 'B구역', 'gray');
    </script>
</div>