<?php
include_once('./_common.php');

/**
 ** 답변에 대한 댓글 등록('')/수정('u')/삭제('d')
 **/

if($w == '') {
    // 댓글 등록
    sql_query(" insert into g5_helpme_answer_reply set helpme_an_idx = {$helpme_an_idx}, mb_id = '{$member['mb_id']}', contents = '{$contents}', wr_datetime = '".G5_TIME_YMDHIS."'; ");
    $reply_idx = sql_insert_id();

    // 등급포인트 - 댓글 등록 시 1NM 적립 (답변 당 1개의 댓글만 인정)
    $my_reply = sql_fetch(" select count(*) as count from g5_helpme_answer_reply where helpme_an_idx = '{$helpme_an_idx}' and mb_id = '{$member['mb_id']}' ")['count']; // 내가 쓴 댓글 개수
    if($my_reply <= 1) { // 위에서 댓글 INSERT 진행으로 처음 등록 == 1개로 처리
        gradePointInsert($member['mb_id'], '적립', '댓글', '1', '헬프미 댓글 등록', '', 'g5_helpme_answer_reply', $reply_idx);
    }
}
if($w == 'u') {
    // 댓글 수정
    sql_query(" update g5_helpme_answer_reply set contents = '{$contents}', up_datetime = '".G5_TIME_YMDHIS."' where idx = {$reply_idx}; ");
}
if($w == 'd') {
    // 댓글 삭제
    sql_query(" update g5_helpme_answer_reply set del_yn = 'Y' where idx = {$reply_idx}; ");
}

$reply_count = selectCount('g5_helpme_answer_reply', 'helpme_an_idx', $helpme_an_idx); // 답변에 대한 댓글 총 개수

$sql_reply = " select re.*, mb.mb_nick from g5_helpme_answer_reply as re left join g5_member as mb on re.mb_id = mb.mb_id where helpme_an_idx = {$helpme_an_idx} order by wr_datetime desc ";
$result_reply = sql_query($sql_reply);

for($a=0; $reply=sql_fetch_array($result_reply); $a++) {
?>
<li>
    <h3><?=getNickOrId($reply['mb_id'])?></h3>
    <span><?=$reply['contents']?></span>
    <em><?=str_replace('-','.',substr($reply['wr_datetime'],0,10))?></em>

    <?php if($member['mb_id'] == $reply['mb_id']) { ?>
    <!-- 댓글 수정 삭제 -->
    <ul class="edit">
        <li class="modify"><a href="javascript:reply_action_info(<?=$helpme_an_idx?>, <?=$reply['idx']?>, '<?=$reply['contents']?>');">수정</a></li>
        <li class="delete"><a href="javascript:reply_action(<?=$helpme_an_idx?>, 'd', <?=$reply['idx']?>);">삭제</a></li>
    </ul>
    <!-- //댓글 수정 삭제 -->
    <?php } ?>
</li>
<?php
}
?>
<input type="hidden" class="reply_count" value="<?=$reply_count?>">
