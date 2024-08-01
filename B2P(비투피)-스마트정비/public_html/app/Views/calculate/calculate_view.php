
<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "정산 관리";
?>


<?php echo view('calculate/calcu_head', $this->data); ?>

<div id="app">
    <calculate-main mb_id="<?=$this->data['member']['mb_id']?>"></calculate-main>
</div>


<?php
$this->data['jl']->vueLoad();

echo view("component/calculate-main");
echo view("component/calculate-paging");
?>

<?php echo view('order/order_modal', $this->data); ?>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>