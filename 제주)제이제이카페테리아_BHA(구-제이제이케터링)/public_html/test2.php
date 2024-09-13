<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>주 계산기</title>
    <style>
        #week-info {
            font-size: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<?
// 오늘 날짜
//$today = date('Y-m-d');
$today = date('2024-09-16');

// 오늘 날짜의 요일 (1 = 월요일, 7 = 일요일)
$dayOfWeek = date('N', strtotime($today));

// 이번 주 월요일 구하기
$monday = date('Y-m-d', strtotime($today . ' -' . ($dayOfWeek - 1) . ' days'));

// 이번 주 일요일 구하기
$sunday = date('Y-m-d', strtotime($monday . ' +6 days'));

// 결과 출력
echo "오늘 날짜: " . $today . "<br>";
echo "이번 주 월요일: " . $monday . "<br>";
echo "이번 주 일요일: " . $sunday . "<br>";
?>
<body>

<div id="week-info"></div>
<button onclick="prevWeek()">이전 주</button>
<button onclick="nextWeek()">다음 주</button>

<script>
    let currentDate = new Date();

    // 주의 시작일(월요일)과 종료일(일요일)을 계산하는 함수
    function getWeekRange(date) {
        const day = date.getDay(); // 요일을 숫자로 반환 (일요일: 0, 월요일: 1, ..., 토요일: 6)
        const diffToMonday = (day === 0 ? -6 : 1) - day;
        const startOfWeek = new Date(date);
        startOfWeek.setDate(date.getDate() + diffToMonday);

        const endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6);

        return {
            start: startOfWeek,
            end: endOfWeek
        };
    }

    // 주차를 계산하는 함수
    function getWeekOfMonth(date) {
        const startOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
        const firstMonday = startOfMonth.getDay() === 1 ? startOfMonth : new Date(startOfMonth.setDate(startOfMonth.getDate() + (1 - startOfMonth.getDay() + 7) % 7));
        const currentWeekMonday = new Date(date.setDate(date.getDate() - date.getDay() + (date.getDay() === 0 ? -6 : 1)));
        return Math.ceil(((currentWeekMonday - firstMonday) / (7 * 24 * 60 * 60 * 1000)) + 1);
    }

    // 화면에 현재 주 정보 표시
    function displayWeekInfo() {
        const weekRange = getWeekRange(currentDate);
        const weekOfMonth = getWeekOfMonth(new Date(currentDate));

        document.getElementById('week-info').innerHTML = `
            <strong>${currentDate.getFullYear()}년 ${currentDate.getMonth() + 1}월 ${weekOfMonth}주차</strong>
            시작일: ${weekRange.start.toLocaleDateString()}<br>
            종료일: ${weekRange.end.toLocaleDateString()}
        `;
    }

    // 이전 주로 이동
    function prevWeek() {
        currentDate.setDate(currentDate.getDate() - 7);
        displayWeekInfo();
    }

    // 다음 주로 이동
    function nextWeek() {
        currentDate.setDate(currentDate.getDate() + 7);
        displayWeekInfo();
    }

    // 초기 주 정보 표시
    displayWeekInfo();
</script>

</body>
</html>
