<?php
include_once("./_common.php");

/**
 * 요금기준
 * 평일 1일: 1만원
 * 주말(금,토,일,공휴일): 1만5천원, 1일 주차시 2만원
 *
 * 250102. 한시적 할인
 * 평일 1일: 8천원
 * 주말(금,토,일,공휴일): 1만원, 1일 주차시 2만원
 *
 * 250103. 자정 기준 일수 계산
 */
function calculateParkingFee(array $post, array $holidays = [])
{
    $weekDayPrice = 8000; // 평일
    $weekendPrice = 10000; // 주말
    $oneDayWeekendPrice = 10000; // 주말(1일)

    try {
        $startDateTime = new DateTime($post['startDate'] . ' ' . $post['startTime']);
        $endDateTime = new DateTime($post['endDate'] . ' ' . $post['endTime']);

        if ($endDateTime < $startDateTime) {
            return json_encode([
                'status' => 'error',
                'message' => '도착예정일시가 이용예정일시보다 작을 수 없습니다.'
            ]);
        }

        // 자정 기준 일수 계산
        // 시작일과 종료일의 날짜만 추출하여 비교
        $startDate = new DateTime($post['startDate']);
        $endDate = new DateTime($post['endDate']);

        // DatePeriod를 사용하여 경유하는 날짜들을 계산
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($startDate, $interval, $endDate->modify('+1 day'));

        // 날짜 수 계산
        $days = 0;
        foreach ($dateRange as $date) {
            $days++;
        }

        $fee = 0;
        $currentDate = clone $startDateTime;

        for ($i = 0; $i < $days; $i++) {
            $dayOfWeek = (int)$currentDate->format('w');
            $currentDateStr = $currentDate->format('Y-m-d');
            $currentMD = $currentDate->format('m-d');

            $isWeekend = ($dayOfWeek == 5 || $dayOfWeek == 6 || $dayOfWeek == 0);
            $isHoliday = in_array($currentDateStr, $holidays) || in_array($currentMD, $holidays);

            if ($isWeekend || $isHoliday) {
                if ($days == 1) {
                    $fee = $oneDayWeekendPrice;
                    break;
                }
                $fee += $weekendPrice;
            } else {
                $fee += $weekDayPrice;
            }

            $currentDate->modify('+1 day');
        }

        /*
        // 시간기준으로 1일 체크
        // diff() 대신에 시간 차이를 직접 계산
        $diffHours = ($endDateTime->getTimestamp() - $startDateTime->getTimestamp()) / 3600;
        $days = ceil($diffHours / 24);  // 24시간으로 나누고 올림 처리
        if ($days < 1) $days = 1;

        $fee = 0;
        $currentDate = clone $startDateTime;

        for ($i = 0; $i < $days; $i++) {
            $dayOfWeek = (int)$currentDate->format('w');
            $currentDateStr = $currentDate->format('Y-m-d');
            $currentMD = $currentDate->format('m-d');

            $isWeekend = ($dayOfWeek == 5 || $dayOfWeek == 6 || $dayOfWeek == 0);
            // 전체 날짜(Y-m-d) 또는 월일(m-d) 형식 모두 체크
            $isHoliday = in_array($currentDateStr, $holidays) || in_array($currentMD, $holidays);

            if ($isWeekend || $isHoliday) {
                if ($days == 1) {
                    $fee = 20000;
                    break;
                }
                // $fee += 15000;
                $fee += 10000;

            } else {
                // $fee += 10000;
                $fee += 8000;
            }

            $currentDate->modify('+1 day');
        }
        */

        return json_encode([
            'status' => 'success',
            'data' => [
                'fee' => $fee,
                'days' => $days
            ]
        ]);

    } catch (Exception $e) {
        return json_encode([
            'status' => 'error',
            'message' => '요금조회에 실패했습니다. 잠시 후 다시 시도해 주세요.',
            // 'message' => $e->getMessage()
        ]);
    }
}

// 공휴일
$holidays = [
    '2024-12-25',  // 특정일
    '01-01',
    '03-01',
    '05-05',
    '06-06',
    '08-15',
    '10-03',
    '10-09',
    '12-25',
];

echo calculateParkingFee($_POST, $holidays);