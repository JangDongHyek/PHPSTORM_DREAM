<?php
$pid = "lecture_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="rental" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_lecture'"><i class="fa-solid fa-arrow-left"></i> 교육관 대관 목록</button>
        <div class="box_radius box_white table">
            <ul class="tabs">
                <li class="tab-link" :class="{'current' : tab == 1}" data-tab="tab-1" @click="tab = 1">신청하기</li>
                <li class="tab-link" :class="{'current' : tab == 2}" data-tab="tab-2" @click="tab = 2">나의 대관 신청</li>
            </ul>

            <rental-lecture-input v-show="tab == 1" mb_no="<?=$member['mb_no']?>"></rental-lecture-input>

            <rental-lecture-my-list v-show="tab == 2" mb_no="<?=$member['mb_no']?>"></rental-lecture-my-list>


        </div>
    </div>
</div>


<?
$jl->vueLoad('app');
$jl->componentLoad("/rental/lecture");
$jl->componentLoad("/item");
?>

    <script>
        Jl_data.tab = "1";
    </script>

<?php
include_once("./app_tail.php");
?>