<?php
// 상품후기/상품문의 목록
foreach($listData as $list) {
    $isMyWrite = ($list['mb_id'] == $this->session->userdata('member')['mb_id']); // 내가쓴글이면
    $isComment = $list['commentCnt'] > 0; // 답변있으면
?>
<li onclick="openBoardModal('view', '<?=$category?>', '<?=$list['idx']?>')">
    <p class="p_num"><?=$paging['listNo']?></p>
    <p class="p_title"><?=$list['title']?></p>
    <p class="p_user"><?=$list['cn_name']?></p>
    <?php if($category == 'p_qna') { ?>
    <!--<p class="p_state"><span class="icon <?/*=$list['state']=='0'?'line':''*/?>"><?/*=QNA_STATUS[$list['state']]*/?></span></p>-->
    <p class="p_state"><span class="icon <?=$isComment?'':'line'?>"><?=$isComment?'답변완료':'미답변'?></span></p>
    <?php } ?>

    <p class="p_date">
        <?=replaceDateFormat($list['reg_date'])?>
        <br>
        <button class="btn btn_line <?=$isMyWrite?'':'hide'?>" onclick="openBoardModal('update', '<?=$category?>', '<?=$list['idx']?>');event.stopPropagation()">수정</button>
        <button class="btn <?=$isMyWrite?'':'hide'?>" onclick="deleteBoard('<?=$list['idx']?>');event.stopPropagation()">삭제</button>
    </p>
</li>
<?php
    $paging['listNo']--;
}
if ($paging['totalCount'] == 0) { ?>
<li class="nodata" style="width: 100%; text-align: center;">등록된 글이 없습니다.</li>
<?php } ?>

<? include_once VIEWPATH . 'component/pagination_html.php'; // 페이징?>

<input type="hidden" name="reviewCnt" value="<?=$reviewCnt?>">
<input type="hidden" name="qnaCnt" value="<?=$qnaCnt?>">