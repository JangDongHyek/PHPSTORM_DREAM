<!--견적서-->
<div id="estimate">
	<? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

    <estimate-list mb_id="<?=$member['mb_id']?>"></estimate-list>

</div>

<?php $jl->vueLoad('estimate');?>
<?php $jl->componentLoad('estimate');?>
<?php $jl->componentLoad('item');?>
