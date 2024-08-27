<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
body{background: #f6f8fa;}
</style>


<!-- 세차 차량선택 -->

<div id="my_car" class="part">
    <div class="cont">
        <h2><?= $cdt_list[$cdt] ?></h2>
    <? if($cdt == "3") {  ?>
        <p>워터리스 외부세차 + 고광택왁스 + 휠세정 + 타이어코팅</p>
    <? }else if($cdt == "4"){ ?>
        <p>워터리스 외부세차 + 고광택왁스 + 휠세정 + 타이어코팅</p>
    <? }else if($cdt == "1"){ ?>
        <p>워터리스 외부세차 + 고광택왁스 + 휠세정 + 타이어코팅</p>
    <? }else if($cdt == "2"){ ?>
        <p>워터리스 외부세차 + 고광택왁스 + 휠세정 + 타이어코팅</p>
    <? }else if($cdt == "5"){ ?>
        <p>실내세차 이물질 제거 + 바닥매트 세정 + 가벼운 얼룩 제거 + 틈새 먼지 제거</p>
    <? } ?>
    </div>
    <h1>세차하실<span> 차량 종류</span>를<br />선택해 주세요.<strong class="pt"><span class="big">"특대 차량"</span>은 세차가 불가함을 알려드립니다.</strong></h1>
    <ul class="lg_box">
    	<li><a id="1" onclick="select(this)" href="<?php echo G5_BBS_URL ?>/my_service.php?<?= $url_param ?>1">소형/중형<span><i class="far fa-taxi"></i></span></a></li>
        <li><a id="2" onclick="select(this)" href="<?php echo G5_BBS_URL ?>/my_service.php?<?= $url_param ?>2">대형<span><i class="far fa-car-side"></i></span></a></li>
    </ul><!--lg_box-->
    
</div><!--my_car part-->

<!-- 세차 차량선택 -->
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