<div id="user">
    <medicinal-list mb_id="<?=$member['mb_id']?>" INSU_CHECK="<?=$member['INSU_CHECK']?>"></medicinal-list>
</div>


<?php $jl->vueLoad("user");?>
<?php $jl->componentLoad("medicinal");?>
<?php $jl->componentLoad("item");?>
<?php $jl->componentLoad("modal");?>



<script>

    function medicinalSearchPopup() {
        window.open("../medicinalSearch", "popupWindow", "width=600, height=800, scrollbars=no");
    }
</script>