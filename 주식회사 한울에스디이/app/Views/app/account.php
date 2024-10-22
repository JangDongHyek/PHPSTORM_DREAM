<!-- 시행사(직원) : 계정관리 -->
</div>
<?php
if(!$project) return false;
?>
<section class="list_table" id="app">
    <account-list :project_idx="project_idx"></account-list>
</section>


<?php $jl->vueLoad();?>
<?php $jl->componentLoad("account");?>
<?php $jl->componentLoad("slot/slot-modal");?>
<?php $jl->componentLoad("part/pagination-component");?>

<script>
    const project_idx = "<?=$project['idx']?>"

</script>
