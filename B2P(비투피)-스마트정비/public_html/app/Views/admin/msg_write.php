
<?php 
    echo view('common/header_adm');
echo view('common/adm_head');
    $header_name = "메시지 관리";
?>



        <?php echo view('admin/board_head', $this->data); ?>
        <div class="coming_soon">
            <p class="">내용 준비중입니다.</p>
        </div>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>
