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
                    $lesson_count = sql_fetch(" select count(*) as count from g5_lesson_reser where reser_date = '{$reser_date}' and pro_mb_no = {$row['mb_no']} and reser_state != '예약취소' ")['count'];

                    array_push($pro_mb_no, $row['mb_no']);
                    ?>
                    <th class="name"><?=$row['mb_name']?>(<?=$lesson_count?>)</th>
                    <?php
                }

                // 스케줄 정보
                $sch_list = array(); // 스케줄
                $tmp_pro = implode(',', $pro_mb_no);
                $sch_sql = " select lr.*, mb.mb_name, mb.history_idx, le.lesson_count
                             from g5_lesson_reser as lr
                             left join g5_member as mb on mb.mb_no = lr.mb_no
                             left join g5_lesson as le on le.idx = mb.lesson_idx
                             where reser_date = '{$reser_date}' and lr.pro_mb_no in ({$tmp_pro}) and lr.reser_state != '예약취소'; ";
                $res = sql_query($sch_sql);
                $res_cnt = sql_num_rows($res);

                if($res_cnt > 0) {
                    while($rs = sql_fetch_array($res)) {
                        $view = '';
                        $diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where history_idx = {$rs['history_idx']} ")['count']; // 레슨일지 카운트
                        $lesson_count = explode('회',explode('/', $rs['lesson_count'])[0])[0]; // 레슨회차
                        if($diary_count == 0) { // 레슨일지 카운트가 0이면 레슨일지 한번도 등록되지 않은 회원이므로 잔여회차와 레슨회차가 동일
                            $remain_count = $lesson_count; // 잔여회차
                        } else {
                            $diary_info = sql_fetch(" select min(lesson_remain_count*1) as lesson_remain_count from g5_lesson_diary where mb_no = '{$rs['mb_no']}' and history_idx = '{$rs['history_idx']}'; "); // 레슨일지 정보
                            $remain_count = $diary_info['lesson_remain_count']; // 잔여회차
                        }
                        $view = $rs['mb_name'].'<br>(<span>'.$remain_count.'</span>/'.$lesson_count.')'; // 잔여회차 / 레슨회차 표시

                        $sch_list[$rs['pro_mb_no']][$rs['reser_time']] = $view;
                    }
                }

                /*for ($k=0; $k<count($pro_mb_no); $k++) {
                    $sch_sql = " select lr.*, mb.mb_name, mb.history_idx,
                                 substring_index(substring_index(le.lesson_count, '/', 1), '회', 1) as lesson_count
                                 from g5_lesson_reser as lr
                                 left join g5_member as mb on mb.mb_no = lr.mb_no
                                 left join g5_lesson as le on le.idx = mb.lesson_idx
                                 where reser_date = '{$reser_date}' and lr.pro_mb_no = {$pro_mb_no[$k]} and lr.reser_state != '예약취소'; ";
                    $res = sql_query($sch_sql);
                    $res_cnt = sql_num_rows($res);

                    if($res_cnt > 0) {
                        while($rs = sql_fetch_array($res)) {
                            $view = '';
                            $diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where history_idx = {$rs['history_idx']} ")['count']; // 레슨일지 카운트
                            $lesson_count = explode('회',explode('/', $rs['lesson_count'])[0])[0]; // 레슨회차
                            if($diary_count == 0) { // 레슨일지 카운트가 0이면 레슨일지 한번도 등록되지 않은 회원이므로 잔여회차와 레슨회차가 동일
                                $remain_count = $lesson_count; // 잔여회차
                            } else {
                                $diary_info = sql_fetch(" select min(lesson_remain_count*1) as lesson_remain_count from g5_lesson_diary where mb_no = '{$rs['mb_no']}' and history_idx = '{$rs['history_idx']}'; "); // 레슨일지 정보
                                $remain_count = $diary_info['lesson_remain_count']; // 잔여회차
                            }
                            $view = $rs['mb_name'].'<br>(<span>'.$remain_count.'</span>/'.$lesson_count.')'; // 잔여회차 / 레슨회차 표시

                            $sch_list[$pro_mb_no[$k]][$rs['reser_time']] = $view;
                        }
                    }
                }*/
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
                    $sch_data = $sch_list[$pro_mb_no[$k]][$reser_time[$t]];

                    // 스케줄 표시
                    if(count($sch_data) > 0) {
                    ?>
                    <td class="name"><?=$sch_data?></td>
                    <?php
                    }
                    else {
                    ?>
                    <td class="name"></td>
                    <?php
                    }
                ?>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
