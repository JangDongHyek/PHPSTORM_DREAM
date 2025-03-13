<!-- 내역관리 > 단가목록표 -->
</div>

<section id="app" class="price-list">

    <cost-price-list project_idx="<?=$project['idx']?>"></cost-price-list>

</section>

<?
$jl->vueLoad('app');
$jl->componentLoad('/cost/price');
$jl->componentLoad('/external');
$jl->componentLoad('/item');
?>

