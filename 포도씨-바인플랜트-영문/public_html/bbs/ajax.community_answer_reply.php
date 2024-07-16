<?php
include_once('./_common.php');

/**
 ** 댓글에 대한 답글 등록('')/수정('u')/삭제('d')
 **/

if($w == '') {
    // 답글 등록
    sql_query(" insert into g5_community_answer_reply set community_an_idx = {$community_an_idx}, mb_id = '{$member['mb_id']}', contents = '{$contents}', wr_datetime = '".G5_TIME_YMDHIS."'; ");
}
if($w == 'u') {
    // 답글 수정
    sql_query(" update g5_community_answer_reply set contents = '{$contents}', up_datetime = '".G5_TIME_YMDHIS."' where idx = {$reply_idx}; ");
}
if($w == 'd') {
    // 답글 삭제
    sql_query(" update g5_community_answer_reply set del_yn = 'Y' where idx = {$reply_idx}; ");
}

$reply_count = selectCount_n('g5_community_answer_reply', 'community_an_idx='.$community_an_idx, 'del_yn is null'); // 답변에 대한 댓글 총 개수

$sql_reply = " select re.*, mb.mb_nick from g5_community_answer_reply as re left join g5_member as mb on re.mb_id = mb.mb_id where community_an_idx = {$community_an_idx} and re.del_yn is null order by wr_datetime desc ";
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
        <li class="modify"><a href="javascript:reply_action_info(<?=$community_an_idx?>, <?=$reply['idx']?>, '<?=$reply['contents']?>');">Edit</a></li>
        <li class="delete"><a href="javascript:reply_action(<?=$community_an_idx?>, 'd', <?=$reply['idx']?>);">Delete</a></li>
    </ul>
    <!-- //댓글 수정 삭제 -->
    <?php } ?>
</li>
<?php
}
?>
<input type="hidden" class="reply_count" value="<?=$reply_count?>">