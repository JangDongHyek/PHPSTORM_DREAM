<?php
include_once('./_common.php');

/** 프로관리 - 전체스케줄 팝업 (ajax) - 날짜 변경 시 사용 **/

// 스케줄러 시간설정
$time = sql_query(" select * from g5_lesson_time_set order by idx");

$reser_time = array();
for($j=0; $row=sql_fetch_array($time); $j++) {
    array_push($reser_time, $row['set_time']);
}
?>

<div class="table_wrap">
    <div class="table_hd">
        <table>
            <thead>
            <tr>
                <th class="time">시간</th>
                <?php
                if($member['center_code'] == 'center1') {
                    $sql_order = " order by field(mb_no, 17) desc, pro_enter_date asc "; // 21.08.20 워커힐 임연석 프로 제일 마지막 순서로 변경 요청
                } else {
                    $sql_order = " order by pro_enter_date asc ";
                }

                $pro_list_sql = " select * from g5_member where mb_category = '프로' and center_code = '{$member['center_code']}' and (pro_leave_date = '0000-00-00' or pro_leave_date > date_format(now(), '%Y-%m-%d')) {$sql_order} ";
                $pro_list_result = sql_query($pro_list_sql);
                $pro_list_result2 = sql_query($pro_list_sql);

                $pro_mb_no = array();
                for($i=0; $row = sql_fetch_array($pro_list_result); $i++) {
                    // 해당 일짜 레슨 수 표시
                    $lesson_count = sql_fetch(" select count(*) as count from g5_lesson_reser where reser_date = '{$reser_date}' and pro_mb_no = {$row['mb_no']} ")['count'];

                    array_push($pro_mb_no, $row['mb_no']);
                    ?>
                    <th class="name"><?=$row['mb_name']?>(<?=$lesson_count?>)</th>
                    <?php
                }

                /*// 예약이 있는 시간 배열 생성
                $temp_pro = implode(',', $pro_mb_no);
                $temp_time_arr = array();
                $temp_rlt = sql_query(" select * from g5_lesson_reser where reser_date = '{$reser_date}' and pro_mb_no in({$temp_pro}); ");
                while($temp_row = sql_fetch_array($temp_rlt)) {
                    array_push($temp_time_arr, $temp_row['reser_time']);
                }
                $temp_time = array_unique($temp_time_arr);
                $exist_time = array_values($temp_time);
                sort($exist_time);*/
                ?>
            </tr>
            </thead>
        </table>
    </div>
    <table class="main-table">
        <tbody>
        <?php
        // 시간별 for
        for($t=0; $t<count($reser_time); $t++) {
            ?>
            <tr>
                <td class="time fixed-side"><?=$reser_time[$t]?></td>
                <?php
                // 예약자 표시
                for ($k=0; $k<count($pro_mb_no); $k++) {
                    $view = '';
                    //if(in_array($reser_time[$t], $temp_time)) { // 예약된 시간이 있을 경우에 쿼리 실행
                        $reser_count = sql_fetch(" select count(*) as count from g5_lesson_reser where reser_date = '{$reser_date}' and reser_time = '{$reser_time[$t]}' and pro_mb_no = {$pro_mb_no[$k]}; ")['count'];
                        if(!empty($reser_count)) {
                            $schedule_sql = " select lr.*, mb.mb_name, mb.history_idx,
                                              (select min(lesson_remain_count*1) from g5_lesson_diary where le.lesson_code = lesson_code and mb_no = mb.mb_no and history_idx = mb.history_idx order by idx desc limit 1) AS lesson_remain_count,
                                              substring_index(substring_index(le.lesson_count, '/', 1), '회', 1) as lesson_count 
                                              from g5_lesson_reser as lr 
                                              left join g5_member as mb on mb.mb_no = lr.mb_no
                                              left join g5_lesson as le on le.idx = mb.lesson_idx
                                              where reser_date = '{$reser_date}' and reser_time = '{$reser_time[$t]}' and lr.pro_mb_no = {$pro_mb_no[$k]}; ";
                            $schedule = sql_fetch($schedule_sql);

                            $diary_info = sql_fetch(" select *, min(lesson_remain_count) as lesson_remain_count from g5_lesson_diary where mb_no = '{$mb_no}' and history_idx = '{$mb['history_idx']}'; "); // 레슨일지 정보
                            $diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where history_idx = {$schedule['history_idx']} ")['count']; // 레슨일지 카운트
                            if($diary_count == 0) { // 레슨일지 카운트가 0이면 레슨일지 한번도 등록되지 않은 회원이므로 잔여회차와 레슨회차가 동일
                                $schedule['lesson_remain_count'] = $schedule['lesson_count'];
                            }

                            $view = $schedule['mb_name'].'<br>(<span>'.$schedule['lesson_remain_count'].'</span>/'.$schedule['lesson_count'].')'; // 잔여회차 / 레슨회차 표시
                        }
                    //}
                ?>
                <td class="name"><?=$view?></td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>