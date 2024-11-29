<?php
include_once("./_common.php");

$idx = $_POST['idx'];
$state = $_POST['state'];
$mb_no = $_POST['mb_no'];

$sql = " select mb.*, le.* from g5_member as mb left join g5_lesson as le on le.idx = mb.lesson_idx where mb.mb_no = {$mb_no} ";
$mb = sql_fetch($sql);

// 개별 승인
if(!empty($state)) {
    $reser_state = '';
    if($state == '예약대기' || $state == '승인대기') {
        $reser_state = '예약대기';
    } else if($state == '예약취소' || $state == '승인취소') {
        $reser_state = '예약취소';
    } else if($state == '노쇼' || $state == '회원노쇼') {
        $reser_state = '노쇼';
    } else {
        $reser_state = '예약완료';
    }

    // 레슨완료 데이터는 제외
    $count = sql_fetch(" select count(*) as count from g5_lesson_diary where reser_idx = '{$idx}'; ")['count'];

    if($count == 0) {
        // 예약정보
        $reser = sql_fetch(" select * from g5_lesson_reser where idx = {$idx}; ");
        $time_set_idx = sql_fetch(" select idx from g5_lesson_time_set where set_time = '{$reser['reser_time']}'; ")['idx'];

        $sql = " update g5_lesson_reser set reser_state = '{$reser_state}' ";
        if($reser_state == '예약취소') { // 예약취소시 예약가능시간idx 삭제
            $sql .= ", time_set_idx = '' ";
        } else {
            $sql .= ", time_set_idx = '{$time_set_idx}' ";
        }
        $sql .= " , state_mod_date = now() where idx = '{$idx}' ";
        sql_query($sql);


        // =====노쇼 시 회차 1회 차감 =====
        if($reser_state == '노쇼') {
            $sql = " select count(*) as count from g5_lesson_diary as ld left join g5_member as mb on ld.mb_no = mb.mb_no where mb.mb_no = {$mb_no} and ld.history_idx = {$mb['history_idx']} ";
            $diary_count = sql_fetch($sql)['count'];

            if($diary_count == 0) {
                if($mb['mb_state'] == 'one_point_lesson') { // 원포인트회원은 1회성 레슨
                    $lesson_remain_count = 0;
                } else {
                    $lesson_remain_count = explode('/', $mb['lesson_count'])[0] - 1; // 일지 등록 시 전체 회차 - 1
                }
            }
            else {
                $sql = " select min(lesson_remain_count*1) as lesson_remain_count from g5_lesson_diary where mb_no = {$mb_no} and history_idx = {$mb['history_idx']} "; // 남은 회차 조회
                $lesson_remain_count = sql_fetch($sql)['lesson_remain_count'];

                if(empty($lesson_remain_count)) { // 남은 회차 없을 경우 0
                    $lesson_remain_count = 0;
                } else {
                    $lesson_remain_count = $lesson_remain_count - 1;  // 일지 등록 시 남은 회차 - 1
                }
            }

            // 현재 회차 조회
            if(empty($lesson_remain_count)) {
                $lesson_count = 1;
            } else {
                $lesson_count = $diary_count + 1;
            }

            $sql = " insert into g5_lesson_diary set 
                     pro_mb_no = '{$reser['pro_mb_no']}',
                     history_idx = '{$mb['history_idx']}', 
                     reser_idx = '{$idx}', 
                     mb_no = '{$mb_no}', 
                     no_show='Y', 
                     lesson_code = '{$reser['lesson_code']}',
                     lesson_date = '{$reser['reser_date']}',
                     lesson_time = '{$reser['reser_time']}',
                     lesson_count = '{$lesson_count}',
                     lesson_contents = '노쇼',
                     lesson_remain_count = '{$lesson_remain_count}',
                     reg_date = now() ";
            sql_query($sql);

            if($mb['mb_state'] == 'one_point_lesson') { // 원포인트회원은 레슨완료일이 곧 레슨종료일
                //$sql = " update g5_member set lesson_start_date = date_format(now(), '%Y-%m-%d'), lesson_end_date = date_format(now(), '%Y-%m-%d'), no_register_date = now(), mb_state = 'no_register' where mb_no = {$mb_no} ";
                $sql = " update g5_member set mb_state = 'no_register' where mb_no = {$mb_no} ";
                sql_query($sql);

                /*$sql = " update g5_member_history set lesson_start_date = date_format(now(), '%Y-%m-%d'), lesson_end_date = date_format(now(), '%Y-%m-%d') where idx = '{$mb['history_idx']}' ";
                sql_query($sql);*/
            }
        }
        // =====노쇼 시 회차 1회 차감 =====

        // 21.02.05 푸시
        $reser = sql_fetch(" select * from g5_lesson_reser where idx = {$idx}; "); // 예약정보

        $sql="select * from g5_fcm where mb_id = '{$mb['mb_id']}'"; // 상태 변경 시 회원에게 알림 (회원 id 필요)
        $fRow=sql_fetch($sql);
        $tokens=array($fRow[token]);
        $text = '';
        if($reser_state == '예약완료') {
            $text = '예약완료 되었습니다.';
        }
        else if($reser_state == '예약취소') {
            $text = '예약취소 되었습니다.';
        }
        else if($reser_state == '노쇼') {
            $text = '예약은 레슨규정에 의하여 자동소멸 됩니다.';
        }
        else if($reser_state == '예약대기') {
            $text = '예약대기 되었습니다.';
        }
        $message=array(
            "subject"=>"{$reser_state}",
            "message"=>"{$mb['mb_name']} 회원님 {$reser['reser_date']}/{$reser['reser_time']} {$text}",
            //"goUrl"=>G5_ADMIN_URL."/lesson_reser.php?start_date={$reser_date}&end_date={$reser_date}",
            "goUrl"=>"",
        );
        $fcm=sendFcm($tokens,$message);
    }
}
else {
    if(empty(count($_POST['chk']))) {
        alert('승인할 레슨을 선택하세요.');
    }

    // 선택 일괄승인
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        // 레슨완료 데이터 제외
        $count = sql_fetch(" select count(*) as count from g5_lesson_diary where reser_idx = '{$_POST['idx'][$k]}'; ")['count'];

        if($count == 0) {
            $sql = " update g5_lesson_reser set reser_state = '예약완료', state_mod_date = now() where idx = '{$_POST['idx'][$k]}' and reser_state != '예약완료' ";
            sql_query($sql);
        }

        // 21.02.05 푸시
        $reser = sql_fetch(" select * from g5_lesson_reser where idx = '{$_POST['idx'][$k]}'; "); // 예약정보

        $sql="select fcm.*, mb.mb_name from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id left join g5_lesson_reser as re on re.mb_no = mb.mb_no where re.idx = '{$_POST['idx'][$k]}'";
        $fRow=sql_fetch($sql);
        $tokens=array($fRow[token]);
        $message=array(
            "subject"=>"예약완료",
            "message"=>"{$fRow['mb_name']} 회원님 {$reser['reser_date']}/{$reser['reser_time']} 예약 되었습니다.",
            //"goUrl"=>G5_ADMIN_URL."/lesson_reser.php?start_date={$reser_date}&end_date={$reser_date}",
            "goUrl"=>"",
        );
        $fcm=sendFcm($tokens, $message);
    }

    // alert('일괄승인되었습니다.', G5_ADMIN_URL.'/lesson_reser.php', false);
    goto_url(G5_ADMIN_URL.'/lesson_reser.php');
}

die('success');
?>
