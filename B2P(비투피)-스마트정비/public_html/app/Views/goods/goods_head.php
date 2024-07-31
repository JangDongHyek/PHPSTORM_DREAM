

<div class="tit_wrap">
    <?php if(in_array($pid, ['goods_list', 'goods_write', 'manager_stock_list', 'manager_stock_write'])) {  ?>
    <h6 class="menu01">제품 현황</h6>
    <div class="menu02">
        <a href="<?=base_url('goods/')?>" class="active">제품 현황</a>
    </div>
    <?php } elseif ($pid == "goods_upload") { ?>
        <h6 class="menu01">제품 일괄등록</h6>
        <div class="menu02">
            <a href="<?=base_url('goods/upload')?>" class="active">제품 일괄등록</a>
        </div>
    <?php }?>
</div>