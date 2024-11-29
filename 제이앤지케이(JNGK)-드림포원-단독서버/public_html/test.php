<?php
include_once("./_common.php");

die(0);
/**
 * 엑셀다운로드
 */

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$cate."주문내역.xls" );     //filename = 저장되는 파일명을 설정합니다.
header( "Content-Description: PHP4 Generated Data" );

$sql = "SELECT 
            g5_member.mb_no,
            mb_charge_pro,
            mb_name,
            IFNULL(lesson_start_date, '') AS lesson_start_date,
            IFNULL(lesson_end_date, '') AS lesson_end_date,
            mb_hp,
            mb_center,
            history_idx,
            g5_lesson.lesson_name
        FROM
            g5_member
                LEFT JOIN
            g5_lesson ON g5_member.lesson_idx = g5_lesson.idx
        WHERE
            g5_member.center_code = 'center6'
                AND mb_level = 2
                AND g5_member.use_yn = 'Y'
                AND mb_state IN ('new_member' , 're_member')
                AND mb_hp NOT IN ('' , '--',
                '010-1111-1111',
                '000-0000-0000',
                '010-0000-0000',
                '010-1234-1234')
        ORDER BY lesson_start_date IS NULL, lesson_start_date ";
$result = sql_query($sql);

$_excel = "
<table border='1'>
    <tr>
       <td>프로명</td>
       <td>회원명</td>
       <td>레슨종료일자</td>
       <td>레슨시작일자</td>
       <td>전화번호</td>
       <td>센터명</td>
       <td>레슨명</td>
       <td>레슨잔여회차</td>
";

while ($row = sql_fetch_array($result)) {
    $info = sql_fetch(" select md.lesson_remain_count, his.lesson_name from g5_lesson_diary as md right outer join g5_member_history as his on md.history_idx = his.idx where his.idx = '{$row['history_idx']}' order by md.idx desc limit 1 ");
    $lesson_name = explode('/', $info['lesson_name'])[0];
    $lesson_count = explode('/', $info['lesson_name'])[2];
    if($info['lesson_remain_count'] === null) { $lesson_remain_count = $lesson_count; } // 레슨일지 미작성 (잔여회차 데이터 NULL)
    else { $lesson_remain_count = $info['lesson_remain_count'].'회'; }
    if($info['lesson_remain_count'] === 0 || $lesson_remain_count < 0) { $lesson_remain_count = '0회'; } // 레슨일지 전체 작성 완료(잔여회자가 0) || 잔여회차가 마이너스

    $_excel .= "
    <tr>
        <td>".$row['mb_charge_pro']."</td>
        <td>".$row['mb_name']."</td>
        <td>".$row['lesson_end_date']."</td>
        <td>".$row['lesson_start_date']."</td>
        <td>".$row['mb_hp']."</td>
        <td>".$row['mb_center']."</td>
        <td>".$row['lesson_name']."</td>
        <td>".$lesson_remain_count."/".$lesson_count."</td>
   </tr>
    ";
}

$_excel .= "</table>";

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $_excel;

die(0);

// $tokens[0]="fj8OquJBTkpqpXwCUwV0R9:APA91bEgbsU7A1wYfkyHQdjnQw-DEgmMyTgujicc2gpghXTAfSJDonOcQ_3UQLyc1bmoOILnHOuPgpCdIX26mTPFUDFfLnc13AN5dE6e3nXJQkJMwLQW2PluleDt3Q8LbaOKchAQKJb-";
// $message=array(
//             "subject"=>"테스트입니다.",
//             "message"=>"테스트입니다.",
//             //"goUrl"=>G5_ADMIN_URL."/lesson_reser.php?start_damete={$reser_date}&end_date={$reser_date}",
//             "goUrl"=>"https://www.jngk.kr/",
//         );
// $fcm=sendFcm($tokens, $message);
// echo $fcm;
