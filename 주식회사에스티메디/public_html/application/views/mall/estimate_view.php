<div id="estimate">
	<? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

    <estimate-view primary="<?=$request_get['idx']?>" mb_id="<?=$member['mb_id']?>" INSU_CHECK="<?=$member['INSU_CHECK']?>"></estimate-view>


</div>
<?php $jl->vueLoad('estimate');?>
<?php $jl->componentLoad('estimate');?>
<?php $jl->componentLoad('item');?>
