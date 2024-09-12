<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>주차 계산</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        button {
            margin: 10px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 id="current-week"></h1>
    <h2 id="week-range"></h2>
    <button onclick="changeWeek(-1)">이전 주</button>
    <button onclick="changeWeek(1)">다음 주</button>
</div>

<script>
    let currentDate = new Date("2024-07-03"); // 현재 날짜
    let currentWeekOffset = 0; // 주차 변경을 위한 오프셋 값

    // 해당 월 기준으로 주차를 계산하는 함수
    function getWeekOfMonth(date) {
        let firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1); // 해당 월의 첫 번째 날
        let firstMonday = new Date(firstDayOfMonth.setDate(firstDayOfMonth.getDate() + (1 - firstDayOfMonth.getDay() + 7) % 7)); // 해당 월의 첫 번째 월요일
        let currentMonday = new Date(date.setDate(date.getDate() - (date.getDay() + 6) % 7)); // 현재 주의 월요일

        // 해당 월의 첫 번째 월요일로부터 몇 번째 주차인지 계산
        let weekNumber = Math.ceil((currentMonday - firstMonday) / (7 * 24 * 60 * 60 * 1000)) + 1;

        // 첫 번째 월요일 이전 날짜는 1주차로 고정
        if (currentMonday < firstMonday) {
            weekNumber = 1;
        }

        return weekNumber;
    }

    // 주차의 시작 날짜와 끝 날짜를 계산하는 함수
    function getWeekRange(date) {
        let startOfWeek = new Date(date.setDate(date.getDate() - (date.getDay() + 6) % 7)); // 현재 주의 월요일
        let endOfWeek = new Date(startOfWeek); // 현재 주의 일요일
        endOfWeek.setDate(startOfWeek.getDate() + 6); // 월요일에서 6일 더해서 일요일로 설정
        return {
            start: formatDate(startOfWeek),
            end: formatDate(endOfWeek)
        };
    }

    // 날짜를 YYYY-MM-DD 형식으로 포맷하는 함수
    function formatDate(date) {
        let year = date.getFullYear();
        let month = date.getMonth() + 1; // getMonth는 0부터 시작하므로 +1
        let day = date.getDate();
        return `${year}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}`;
    }

    // 주차 업데이트 함수
    function updateWeekDisplay() {
        let displayDate = currentDate // 현재 날짜 복사
        displayDate.setDate(displayDate.getDate() + currentWeekOffset * 7); // 오프셋에 따라 날짜 변경
        let weekNumber = getWeekOfMonth(displayDate); // 변경된 날짜 기준으로 주차 계산
        let weekRange = getWeekRange(new Date(displayDate)); // 주의 시작일과 끝일 계산

        // 주차 정보와 주의 날짜 범위 출력
        document.getElementById('current-week').textContent =
            `${displayDate.getFullYear()}년 ${displayDate.getMonth() + 1}월 ${weekNumber}주차`;
        document.getElementById('week-range').textContent =
            `시작일: ${weekRange.start}, 종료일: ${weekRange.end}`;
    }

    // 주차 변경 함수
    function changeWeek(direction) {
        currentWeekOffset += direction; // 방향에 따라 주차를 변경 (1: 다음 주, -1: 이전 주)
        updateWeekDisplay(); // 화면에 변경된 주차 표시
    }

    // 처음 화면 로드 시 주차 표시
    updateWeekDisplay();
</script>
</body>
</html>
