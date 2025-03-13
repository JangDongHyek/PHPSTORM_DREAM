<!-- 작업관리 > 작업공정표 -->
</div>
<?php
if(!$project) return false;
?>
<div class="schedule-list">
    <div class="flex ai-c jc-sb">
        <div class="area_filter">
            <input type="search" name="stx" placeholder="검색어 입력" value=""><button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
        </div>
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
            <div id="daily-schedule" class="schedule-wrapper">
                <div id="daily-month-header" class="month-header"></div>
                <div id="daily-days" class="schedule"></div>
            </div>
        </section>
    </div>

    <script>
        const dailyMonthHeader = document.getElementById('daily-month-header');
        const dailyContainer = document.getElementById('daily-days');

        const startDate = new Date('2025-03-01');
        const endDate = new Date('2025-04-30');
        const today = new Date();
        const totalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
        const dailyDayWidth = 40;

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

        function applyTodayToTasks() {
            document.querySelectorAll('.schedule-row .day').forEach(el => {
                el.classList.remove('today');
            });

            let todayIndex = -1;

            document.querySelectorAll('.day').forEach((day, index) => {
                const currentDate = new Date(startDate);
                currentDate.setDate(startDate.getDate() + index);

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
            }
        }

        function addSchedule(start, end, name, className = '') {
            const startIndex = Math.floor((start - startDate) / (1000 * 60 * 60 * 24));
            const endIndex = Math.floor((end - startDate) / (1000 * 60 * 60 * 24));
            const duration = endIndex - startIndex + 1;

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

                    if (!['zone-title', 'zone-sub'].includes(className)) {
                        task.onclick = () => openTaskPopup(name, start, end);
                    }
                    taskDiv.appendChild(task);
                }
                taskRow.appendChild(taskDiv);
            }
            dailyContainer.appendChild(taskRow);
            applyTodayToTasks();
        }

        function addScheduleDaily(start, end, usedDateRanges, name, className = '') {
            const taskRow = document.createElement('div');
            taskRow.className = 'schedule-row';

            for (let i = 0; i < totalDays; i++) {
                const taskDiv = document.createElement('div');
                taskDiv.className = 'day';
                taskDiv.style.width = `${dailyDayWidth}px`;

                const currentDate = new Date(startDate);
                currentDate.setDate(startDate.getDate() + i);

                if (currentDate >= start && currentDate <= end) {
                    const task = document.createElement('div');

                    // 🔍 사용한 날짜인지 확인 (연속된 범위 내에 포함되면 사용한 날짜)
                    const isUsed = usedDateRanges.some(range => {
                        const rangeStart = new Date(range.start);
                        const rangeEnd = new Date(range.end);
                        return currentDate >= rangeStart && currentDate <= rangeEnd;
                    });

                    if (isUsed) {
                        task.className = `task ${className}`; // 사용한 날짜 (●)
                        task.textContent = name;
                    } else {
                        task.className = `task none`; // 사용하지 않은 날짜 (빈칸)
                        task.textContent = '　';
                    }

                    task.style.width = `${dailyDayWidth - 20}px`;

                    if (task.textContent !== '') {
                        task.onclick = () => openTaskPopup(name, currentDate, currentDate);
                    }
                    taskDiv.appendChild(task);
                }

                taskRow.appendChild(taskDiv);
            }

            dailyContainer.appendChild(taskRow);
            applyTodayToTasks();
        }



        function openTaskPopup(name, start, end) {
            const url = `./taskForm`;
            const popupOptions = "width=1600,height=800,scrollbars=yes,resizable=yes";
            window.open(url, "TaskFormPopup", popupOptions);
        }

        renderDailyView();

        addSchedule(new Date('2025-03-01'), new Date('2025-04-24'), '101동', 'zone-title');
        addSchedule(new Date('2025-03-01'), new Date('2025-03-20'), '1층', 'zone-sub');
        const usedDateRangesA = [
            { start: '2025-03-01', end: '2025-03-11' },
            { start: '2025-03-13', end: '2025-03-15' }
        ];
        addScheduleDaily(new Date('2025-03-01'), new Date('2025-03-15'), usedDateRangesA, '●', 'red');

        const usedDateRangesB = [
            { start: '2025-03-01', end: '2025-03-20' }
        ];
        addScheduleDaily(new Date('2025-03-11'), new Date('2025-03-20'), usedDateRangesB, '●', 'blue');

        addSchedule(new Date('2025-03-21'), new Date('2025-04-24'), '2층', 'zone-sub');

        const usedDateRangesC = [
            { start: '2025-03-21', end: '2025-04-07' },
        ];
        addScheduleDaily(new Date('2025-03-21'), new Date('2025-04-10'), usedDateRangesC, '●', 'green');

        const usedDateRangesD = [
        ];
        addScheduleDaily(new Date('2025-04-11'), new Date('2025-04-24'), usedDateRangesD, '●', 'gray');
    </script>

</div>
