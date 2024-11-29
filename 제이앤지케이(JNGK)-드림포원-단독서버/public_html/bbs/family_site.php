<?php
include_once('./_common.php');

$g5['title'] = '아카데미 지점현황';
include_once('./_head.php');

?>
<link rel="stylesheet" href="<?= G5_CSS_URL ?>/style.css">
<style>
#container{ padding-bottom:0;}
#ft{ display:none;}
</style>

<div id="family">

    <?php
    $sql = " select * from g5_center where idx != 13 ";
    $result = sql_query($sql);

    for($i=0; $row=sql_fetch_array($result); $i++) {
        $fsite_box = "fsite_box";
        $fs_txt = "";
        if($i%2 != 0) {
            $fsite_box = "fsite_box2";
            $fs_txt = "fs_txt2";
        }
    ?>
    <div class="fs_box <?=$fsite_box?>"><a href="<?=G5_BBS_URL?>/site_pro.php?center_code=<?=$row['center_code']?>">
        <div class="fs_txt <?=$fs_txt?>">
            <span>JNGK Family site</span>
            <h1><?=$row['center_name']?></h1>
            <div class="btn_go">바로가기</div>
        </div><!--.fs_txt--></a>
    </div><!--.fsite_box-->
    <?php
    }
    ?>

	<!--<div class="fs_box fsite_box"><a>
    	<div class="fs_txt">
        	<span>JNGK Family site</span>
            <h1>워커힐 아카데미</h1>
            <div class="btn_go">바로가기</div>
        </div></a>
    </div>
	<div class="fs_box fsite_box2"><a>
    	<div class="fs_txt fs_txt2">
        	<span>JNGK Family site</span>
            <h1>남서울 아카데미</h1>
            <div class="btn_go">바로가기</div>
        </div></a>
    </div>
	<div class="fs_box fsite_box"><a>
    	<div class="fs_txt">
        	<span>JNGK Family site</span>
            <h1>북악 아카데미</h1>
            <div class="btn_go">바로가기</div>
        </div></a>
    </div>
	<div class="fs_box fsite_box2"><a>
    	<div class="fs_txt fs_txt2">
        	<span>JNGK Family site</span>
            <h1>삼성 아카데미</h1>
            <div class="btn_go">바로가기</div>
        </div></a>
    </div>
	<div class="fs_box fsite_box"><a>
    	<div class="fs_txt">
        	<span>JNGK Family site</span>
            <h1>서초 아카데미</h1>
            <div class="btn_go">바로가기</div>
        </div></a>
    </div>
	<div class="fs_box fsite_box2"><a>
    	<div class="fs_txt fs_txt2">
        	<span>JNGK Family site</span>
            <h1>세종필드 아카데미</h1>
            <div class="btn_go">바로가기</div>
        </div></a>
    </div>
	<div class="fs_box fsite_box"><a>
    	<div class="fs_txt">
        	<span>JNGK Family site</span>
            <h1>부산 센텀시티 아카데미</h1>
            <div class="btn_go">바로가기</div>
        </div></a>
    </div>-->

</div>





<?php
include_once('./_tail.php');
?>