<!-- 작업관리 > 계획공정표 -->
</div>
<?php
if(!$project) return false;
?>

<div id="app">
    <schedule-main project_idx="<?=$project['idx']?>"></schedule-main>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("schedule");
$jl->componentLoad("external");
?>

