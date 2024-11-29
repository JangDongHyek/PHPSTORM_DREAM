<?php
include_once("./_common.php");

/** 레슨 종료일 들어가지 않는 데이터 일괄 업데이트 시 사용 **/

//$sql = " SELECT * from g5_member WHERE history_idx IS NOT NULL AND lesson_idx IS NOT NULL AND lesson_idx != 0 AND lesson_start_date != '0000-00-00' and (mb_state = 'new_member' or mb_state = 're_member') and center_code != 'center8' order by mb_no";
//$sql = " select * from g5_member where mb_no in (6945,7029,7068,7149,7255,7293,7521,7576,7656,7671,7692,8128,8485,8693,8886,9026,9083,9158,9195,9252,9725,10314,10326,10382,11551,11567,11578,11579,11598,11599,11602,11615,11626,11644,11656,11666,11671,11699,11701,11702,11713,11723,11727,11740,11771,11813,11855,11857,11875,11904,11929,11964,11998,12063,12319,12337,12342,12344,12346,12446,12505,12529,12545,12551,12611,12639,12659,12790,12791,12928,12930,12943,13009,13127,13358,13394,13498,13564,13612,13614,13824,13885,13911,13924) order by mb_no desc";
$sql = " select * from jngk.g5_member_history as his
         left join g5_member as mb on his.idx = mb.history_idx
         where 
         his.lesson_start_date != '0000-00-00' and his.lesson_end_date = '0000-00-00' and his.lesson_idx != 0 and his.reg_date like '2021-10-%' and mb.lesson_end_date = '0000-00-00'
         order by his.idx desc";
$result = sql_query($sql);

//$mb_no = '';
for($i=0; $row = sql_fetch_array($result); $i++) {
    $lesson = sql_fetch(" select * from g5_lesson where idx = {$row['lesson_idx']}; "); // 레슨정보

    $pattern = '/([a-zA-Z0-9])+/';
    $lesson_count = explode('/', $lesson['lesson_count'])[1];
    preg_match_all($pattern, $lesson_count, $match);
    $num = implode('', $match[0]);

    if(strpos($lesson_count, '주') !== false) {
        $term = 'week';
    } else if(strpos($lesson_count, '개월') !== false) {
        $term = 'months';
    } else if(strpos($lesson_count, '년') !== false) {
        $term = 'years';
    }

    $lesson_start_date = $row['lesson_start_date']; // 레슨시작일
    $timestamp = strtotime($lesson_start_date . " +" . $num . $term . " +10 days");
    $lesson_end_date = date('Y-m-d', $timestamp); // 레슨종료일

    $timestamp = strtotime($lesson_end_date . " +101 days");
    $no_register_date = date('Y-m-d', $timestamp);

//    echo $lesson_end_date.'<br>';
//    echo $no_register_date.'<br>';
//    echo $row['idx'].'<br>';

    $sql = " update g5_member set lesson_end_date = '{$lesson_end_date}', no_register_date = '{$no_register_date}' where mb_no = {$row['mb_no']} and history_idx = '{$row['idx']}'; ";
//    echo $sql.'<br>';
//    sql_query($sql);

    $sql = " update g5_member_history set lesson_end_date = '{$lesson_end_date}' where idx = {$row['idx']} ";
//    echo $sql.'<br>';
//    sql_query($sql);
}
echo $i;
?>