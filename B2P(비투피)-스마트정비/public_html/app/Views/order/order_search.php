
<?php
echo view('common/header_adm');
$header_name = "주문통합검색";
?>


<div id="adm_content" class="order">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap order_search">
        <?php echo view('order/order_head', $this->data); ?>

    </div>
</div>


<?php echo view('order/order_modal', $this->data); ?>
<?php echo view('common/footer'); ?>