<!-- 구역관리 -->
</div>
<?php
if(!$project) return false;

1
?>

<div id="app">
    <zone-list project_idx="<?=$project['idx']?>"></zone-list>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad('zone');
$jl->componentLoad('/zone/part');
$jl->componentLoad('external');
?>