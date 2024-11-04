
<link href="<?=ASSETS_URL?>/css/estimate_print.css?v=<?=CSS_VER?>" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0, maximum-scale=3, user-scalable=yes">
<section class="grid_print" onclick="print()" id="vueApp">
    <estimate-print primary="<?=$request_get['idx']?>" mb_id="<?=$member['mb_id']?>" INSU_CHECK="<?=$member['INSU_CHECK']?>"></estimate-print>
</section>

<?php $jl->vueLoad('vueApp');?>
<?php $jl->componentLoad('estimate');?>
