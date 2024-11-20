<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>

<article id="ctt" class="ctt_<?php echo $co_id; ?>">
    <p class="wow bounceIn t_margin30 b_margin40" style="width:100%; border-top:1px solid #e0e0e0;" data-wow-delay="0.9s"></p>
    <div id="ctt_con" class="clearfix">
        <?php echo $str; ?>
    </div>

</article>