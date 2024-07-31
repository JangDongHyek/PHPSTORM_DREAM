<?php 
    echo view('common/header_adm'); 
    $pid = "manager_stock_list";
    $header_name = "재고 관리";
?>



<div id="adm_content">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">제품 관리</h6>
            <div class="menu02">
                <a href="<?=base_url('admin/manager_product_list')?>">제품 관리</a>
                <a href="<?=base_url('admin/manager_stock_list')?>" class="active">재고 관리</a>
            </div>
        </div>
        
        <div class="coming_soon">
            <p class="">내용 준비중입니다.</p>
        </div>
    </div>
</div>


<?php echo view('common/footer'); ?>
