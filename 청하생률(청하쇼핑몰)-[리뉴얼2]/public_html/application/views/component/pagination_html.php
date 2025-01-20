<?php
// 페이징 (fetchHtml)
?>
<div class="paging">
    <div class="pagingWrap">
        <!--처음-->
        <?php if ($paging['page'] > 1 && $paging['totalPage'] > 0) { ?>
        <a onclick="fetchHtmlPaging(1, <?=$frm?>, <?=$func?>)"><i class="fa-light fa-chevrons-left"></i></a>
        <?php } ?>

        <!--이전-->
        <?php if ($paging['currentBlock'] > 1) { ?>
        <a class="prev disabled" onclick="fetchHtmlPaging(<?=$paging['startPage']-1?>, <?=$frm?>, <?=$func?>)"><i class="fa-light fa-chevron-left"></i></a>
        <?php } ?>

        <!--페이지-->
        <?php
        if ($paging['totalPage'] != 0) {
            foreach (range(1, $paging['totalPage']) as $number) {
                if ($number >= $paging['startPage'] && $number <= $paging['endPage']) {
                    $action = 'onclick="fetchHtmlPaging('.$number.', '.$frm.', '.$func.')"';
                    if($paging['page'] == $number) $action = '';
        ?>
        <a class="<?=($paging['page'] == $number) ? 'active' : ''?>" <?=$action?>><?=$number?></a>
        <?php } } } ?>

        <!--다음-->
        <?php if ($paging['totalBlock'] > 1 && $paging['totalBlock'] != $paging['currentBlock']) { ?>
        <a class="next disabled" onclick="fetchHtmlPaging(<?=$paging['endPage']+1?>, <?=$frm?>, <?=$func?>)"><i class="fa-light fa-chevron-right"></i></a>
        <?php } ?>

        <!--마지막-->
        <?php if ($paging['page'] < $paging['totalPage']) { ?>
        <a class="last disabled" onclick="fetchHtmlPaging(<?=$paging['totalPage']?>, <?=$frm?>, <?=$func?>)"><i class="fa-light fa-chevrons-right"></i></a>
        <?php } ?>
    </div>
</div>