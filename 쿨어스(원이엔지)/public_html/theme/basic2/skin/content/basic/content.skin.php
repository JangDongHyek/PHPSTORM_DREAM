<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>

<? if($co_id == "pro02_01"){ ?>
    <?php include_once(G5_THEME_PATH.'/pro02_01.php');?>
<? } else if($co_id == "pro05_01"){ ?>
    <?php include_once(G5_THEME_PATH.'/pro02_02.php');?>
<? }else { ?>

    <article id="ctt" class="ctt_<?php echo $co_id; ?>">
        <header>
            <h1><?php echo $g5['title']; ?></h1>
        </header>

        <div id="ctt_con">
            <?php echo $str; ?>
        </div>

    </article>
<? } ?>
