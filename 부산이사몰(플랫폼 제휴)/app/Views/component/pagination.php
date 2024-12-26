<?php
// 페이징 (fetchData)
// 페이징 파라미터
$qstr = getQueryString(['page', 'token']);
?>
<div class="paging">
    <div class="pagingWrap">
        <?php if (empty($paging)):?>
            <a href="javascript:void(0)" class="active">1</a>
        <?php else:?>
            <?php if($paging['page'] > 1 && $paging['totalPage'] > 0): // 처음?>
                <a href="?page=1&<?=$qstr?>" class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
            <?php endif; ?>

            <?php if ($paging['currentBlock'] > 1): // 이전?>
            <a href="?page=<?=$paging['startPage']-1?>&<?=$qstr?>" class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
            <?php endif; ?>

            <?php
            //  페이지
                if ($paging['totalPage'] != 0):
                    foreach (range(1, $paging['totalPage'])  as $number):
                        if($number >= $paging['startPage'] && $number <= $paging['endPage']):
                            $action = "?page=".$number."&".$qstr;
                            if($paging['page'] == $number) $action = "javascript:void(0)";
            ?>
             <a href="<?=$action?>" class="<?=($paging['page'] == $number) ? 'active' : ''?>"><?=$number?></a>
            <?php endif;
                endforeach;
                endif;
            ?>
            <?php if ($paging['totalBlock'] > 1 && $paging['totalBlock'] != $paging['currentBlock']): // 다음 ?>
                <a href="?page=<?=$paging['endPage']+1?>&<?=$qstr?>" class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
            <?php endif; ?>
            <?php if ($paging['page'] < $paging['totalPage']): // 마지막 ?>
                <a href="?page=<?=$paging['totalPage']?>&<?=$qstr?>" class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>
