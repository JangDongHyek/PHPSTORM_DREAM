<?php
include_once('./_common.php');

// an_open ==> open : 전체공개 / private : 비공개

if($w == "") { // 등록
    // 답변 DB INSERT
    $sql = " insert into g5_helpme_answer set helpme_idx = '{$helpme_idx}', mb_id = '{$member['mb_id']}', an_contents = '{$an_contents}', an_hashtag = '{$an_hashtag}', an_open = '{$an_open}', wr_datetime = '".G5_TIME_YMDHIS."'; ";
    sql_query($sql);

    // 질문 DB UPDATE - 상태 변경 ==> 채택 시에 답변 완료 상태 변경으로 수정
    // sql_query(" update g5_helpme set he_answer_state = '답변완료' where idx ='{$helpme_idx}'; ");

    alert('Answer has been registered.', G5_BBS_URL.'/help_view.php?idx='.$helpme_idx, false);
}
else { // 수정
    $help = sql_fetch(" select * from g5_helpme where idx = '{$helpme_idx}' ");
    if($help['he_answer_state'] == '답변완료') {
        alert('The answer is complete and cannot be edited.', G5_BBS_URL.'/help_view.php?idx='.$helpme_idx);
    }

    // 답변 DB UPDATE
    $sql = " update g5_helpme_answer set an_contents = '{$an_contents}', an_hashtag = '{$an_hashtag}', an_open = '{$an_open}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$helpme_an_idx}'; ";
    sql_query($sql);

    alert('Answer has been edited.', G5_BBS_URL.'/help_view.php?idx='.$helpme_idx, false);
}
?>