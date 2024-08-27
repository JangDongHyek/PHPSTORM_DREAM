<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
body{background: #f6f8fa;}
</style>


<!-- 청소유형 선택 -->

<div id="my_car" class="clean part">
    

    <h1>청소하실<span> 건물유형</span>을<br />선택해 주세요.</h1>
    <ul class="lg_box">
    	<li><a id="1" onclick="select(this)" href="<?php echo G5_BBS_URL ?>/my_service_clean.php?cub=1&ct=<?= $_REQUEST["ct"]?>">아파트<span><i class="far fa-city"></i></span></a></li>
        <li><a id="2" onclick="select(this)" href="<?php echo G5_BBS_URL ?>/my_service_clean.php?cub=2&ct=<?= $_REQUEST["ct"]?>">주택<span><i class="far fa-home-lg-alt"></i></span></a></li>
        <li><a id="3" onclick="select(this)" href="<?php echo G5_BBS_URL ?>/my_service_clean.php?cub=3&ct=<?= $_REQUEST["ct"]?>">오피스텔<span><i class="far fa-building"></i></span></a></li>
        <li><a id="4" onclick="select(this)" href="<?php echo G5_BBS_URL ?>/my_service_clean.php?cub=4&ct=<?= $_REQUEST["ct"]?>">공장/상가<span><i class="far fa-industry-alt"></i></a></li>
    </ul><!--lg_box-->
    
</div><!--my_car clean part-->

<!-- 청소유형 선택 -->
<script>
    function select(f){
        var id = f.id;
        var now_class = $("#"+id).attr("class");
        if (now_class != 'on') {
            $('#' + id).addClass('on');
            $('#' + id).siblings().removeClass('on');
        }else{
            $('#' + id).removeClass('on');
        }
    }
</script>