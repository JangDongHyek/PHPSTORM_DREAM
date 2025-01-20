<?php
// 페이징 (fetchData)
// 페이징 파라미터
$qstr = getQueryString(['page', 'token']);
?>
<div class="paging">
	<div class="pagingWrap">
        <!--처음-->
        <?php if ($paging['page'] > 1 && $paging['totalPage'] > 0) { ?>
        <a class="first disabled" href="?page=1&<?=$qstr?>"><i class="fa-light fa-chevrons-left"></i></a>
        <?php } ?>

        <!--이전-->
        <?php if ($paging['currentBlock'] > 1) { ?>
        <a class="prev disabled" href="?page=<?=$paging['startPage']-1?>&<?=$qstr?>"><i class="fa-light fa-chevron-left"></i></a>
        <?php } ?>

        <!--페이지-->
        <?php
        if ($paging['totalPage'] != 0) {
            foreach (range(1, $paging['totalPage']) as $number) {
                if ($number >= $paging['startPage'] && $number <= $paging['endPage']) {
                    $action = "?page=".$number."&".$qstr;
                    if($paging['page'] == $number) $action = "javascript:void(0)";
        ?>
        <a class="<?=($paging['page'] == $number) ? 'active' : ''?>" href="<?=$action?>"><?=$number?></a>
        <?php } } } ?>

        <!--다음-->
        <?php if ($paging['totalBlock'] > 1 && $paging['totalBlock'] != $paging['currentBlock']) { ?>
        <a class="next disabled" href="?page=<?=$paging['endPage']+1?>&<?=$qstr?>"><i class="fa-light fa-chevron-right"></i></a>
        <?php } ?>

        <!--마지막-->
        <?php if ($paging['page'] < $paging['totalPage']) { ?>
        <a class="last disabled" href="?page=<?=$paging['totalPage']?>&<?=$qstr?>"><i class="fa-light fa-chevrons-right"></i></a>
        <?php } ?>
	</div>
</div>

<!--<div class="paging">
    <div class="pagingWrap">
        <a class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
        <a class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
        <a class="active">1</a>
        <a>2</a>
        <a>3</a>
        <a>4</a>
        <a>5</a>
        <a>6</a>
        <a>7</a>
        <a class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
        <a class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
    </div>
</div>-->