<!-- 시행사(직원) : 파일함 -->
</div>
<?php
if(!$project) return false;
?>
<div id="app">
    <file-list project_idx="<?=$project['idx']?>"></file-list>
</div>

<? $jl->vueLoad('app');?>
<? $jl->componentLoad("file");?>
<? $jl->componentLoad("part");?>

