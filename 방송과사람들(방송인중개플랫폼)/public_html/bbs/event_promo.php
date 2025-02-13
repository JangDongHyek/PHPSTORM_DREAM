<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$name = "event_promo";
$pid = "event_promo";
$g5['title'] = '이벤트&프로모션';
include_once('./_head.php');
?>


<section class="event_promo">
    <div class="calendar_check">
        <div class="title">
            <h6>출석하기</h6>
            <button class="attendance-btn" id="markAttendance">출석하기</button>
        </div>

        <div class="calendar-container">
            <div class="month-title" id="month-title"></div>
            <div class="flex">

                <div class="streak" id="streak-display">연속 출석 <b>0일</b></div>
                <b>
                    <span>오늘</span>
                    <span>출석</span>
                </b>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>일</th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th>토</th>
                    </tr>
                    </thead>
                    <tbody id="calendar-body"></tbody>
                </table>
            </div>
        </div>
        <script>
            // 새로고침 시 출석 데이터 초기화 (이 부분 주석 처리하면 유지됨)
            localStorage.clear(); // 🛑 주석 처리하면 출석 기록이 유지됨

            const today = new Date();
            const currentYear = today.getFullYear();
            const currentMonth = today.getMonth();
            const currentDate = today.getDate();
            const yesterday = currentDate - 1; // 어제 날짜

            let attendanceData = {};
            let streak = 0;
            let specialDays = {};

            // 🔹 어제 날짜도 자동 출석 처리 (주석 처리 가능)
            if (yesterday > 0) attendanceData[yesterday] = true;

            document.getElementById("month-title").innerText = `${currentMonth + 1}월`;
            document.getElementById("streak-display").innerHTML = `연속 출석 <B> ${streak}일</B>`;

            function generateCalendar() {
                const firstDay = new Date(currentYear, currentMonth, 1).getDay(); // 현재 달의 시작 요일
                const lastDate = new Date(currentYear, currentMonth + 1, 0).getDate(); // 현재 달의 마지막 날짜
                const prevLastDate = new Date(currentYear, currentMonth, 0).getDate(); // 전달의 마지막 날짜
                let calendarBody = document.getElementById("calendar-body");
                calendarBody.innerHTML = "";

                let row = document.createElement("tr");

                // 🔹 전달 날짜 추가 (빈칸을 채워야 해서 firstDay만큼 채움)
                for (let i = firstDay - 1; i >= 0; i--) {
                    let prevCell = document.createElement("td");
                    prevCell.classList.add("prev");
                    prevCell.innerHTML = `<p class="day-text">${prevLastDate - i}</p><p>&nbsp;</p>`;
                    row.appendChild(prevCell);
                }

                // 🔹 현재 달 날짜 추가
                for (let day = 1; day <= lastDate; day++) {
                    let cell = document.createElement("td");
                    let content = `<p class="day-text">${day}</p><p>&nbsp;</p>`;

                    if (day === currentDate) {
                        cell.classList.add("today");
                        content = `<p class="day-text">${day}</p><p class="special">오늘</p>`;
                    }
                    if (specialDays[day]) {
                        let specialClass = `day-${specialDays[day]}`;
                        content = `<i class="fa-solid fa-star ${specialClass}"></i><p>${specialDays[day]}일차</p>`;
                    }
                    if (attendanceData[day]) cell.classList.add("checked");

                    cell.innerHTML = content;
                    row.appendChild(cell);

                    // 🔹 한 주(7일)가 다 찼을 때 테이블 행 추가
                    if ((firstDay + day) % 7 === 0) {
                        calendarBody.appendChild(row);
                        row = document.createElement("tr");
                    }
                }

                // 🔹 다음 달 날짜 추가 (현재 달 마지막 날짜 이후, 남은 칸만큼 추가)
                let remainingCells = (firstDay + lastDate) % 7; // 현재 달이 끝난 후 남은 칸 개수
                if (remainingCells !== 0) {
                    for (let i = 1; i <= (7 - remainingCells); i++) {
                        let nextCell = document.createElement("td");
                        nextCell.classList.add("next");
                        nextCell.innerHTML = `<p class="day-text">${i}</p><p>&nbsp;</p>`;
                        row.appendChild(nextCell);
                    }
                }

                if (row.children.length > 0) {
                    calendarBody.appendChild(row);
                }
            }


            document.getElementById("markAttendance").addEventListener("click", () => {
                if (attendanceData[currentDate]) {
                    swal("이미 출석하셨습니다!");
                    return;
                }
                attendanceData[currentDate] = true;
                streak = (attendanceData[currentDate - 1] || currentDate === 1) ? streak + 1 : 1;

                // 오늘을 기준으로 특별 날짜 설정 (+2, +7, +14, +21)
                let newSpecialDays = {};
                [2, 7, 14, 21].forEach(offset => {
                    let targetDate = currentDate + offset;
                    if (targetDate <= new Date(currentYear, currentMonth + 1, 0).getDate()) {
                        newSpecialDays[targetDate] = offset;
                    }
                });

                specialDays = newSpecialDays;
                document.getElementById("streak-display").innerHTML = `연속 출석 <B> ${streak}일</B>`;
                generateCalendar();
            });

            generateCalendar();

        </script>
    </div><!--calendar_check-->
    <div class="fortune_check">
        <div class="title">
            <h6>오늘의 운세</h6>
        </div>
        <div class="fortune-btn" onclick="location.href='<?php echo G5_BBS_URL ?>/event_fortune'">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/fortune-00-1.jpg" class="hidden-xs">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/fortune-00.jpg" class="visible-xs">
            <div><i class="fa-solid fa-crystal-ball"></i> 오늘 운세 확인하기</div>
        </div>
    </div><!--fortune_check-->

    <?
    $model = new JlModel("g5_write_promo");

    $rows = $model->get(array("page"=>1,"limit" => 3))['data'];
    ?>
    <div class="promo_list">
        <div class="title">
            <h6>진행중인 프로모션</h6>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=promo"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <ul>
            <?
            $file_model = new JlModel("g5_board_file");
            foreach($rows as $row) {
                $file = $file_model->where("bo_table","promo")->where("wr_id",$row['wr_id'])->get()['data'][0];

                if($file) {
                    $src = G5_DATA_URL."/file/promo/".$file['bf_file'];
                }else {
                    $src = G5_THEME_IMG_URL."/app/visual01.jpg";
                }
            ?>
            <li>
                <a href="./board.php?bo_table=promo&wr_id=<?=$row['wr_id']?>"><img src="<?=$src?>"></a>
            </li>
            <?}?>
        </ul>
    </div><!--promo_list-->
</section>

<?
include_once('./_tail.php');
?>
