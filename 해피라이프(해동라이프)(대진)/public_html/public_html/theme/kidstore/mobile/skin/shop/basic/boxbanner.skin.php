<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{

    if ($i==0) echo '<aside id="sbn_side" class="sbn"><h2>쇼핑몰 배너</h2><div class="side_bn">'.PHP_EOL;
    //print_r2($row);
    // 테두리 있는지
    $bn_border  = ($row['bn_border']) ? ' class="sbn_border"' : '';;
    // 새창 띄우기인지
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
    if (file_exists($bimg))
    {
        $banner = '';
        $size = getimagesize($bimg);
        echo '<div class="item">'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_SHOP_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'&amp;url='.urlencode($row['bn_url']).'"'.$bn_new_win.'>';
        }
        echo $banner.'<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" alt="'.$row['bn_alt'].'" width="'.$size[0].'" height="'.$size[1].'"'.$bn_border.'>';
        if($banner)
            echo '</a>'.PHP_EOL;
        echo '</div>'.PHP_EOL;
    }
}
if ($i>0) echo '</div><button type="button" id="sbn_side_close" class="close-btn"><b>X</b> 닫기</button>
</aside>'.PHP_EOL;
?>
<script>
$(document).ready(function() {
    $(".side_bn").owlCarousel({
        autoPlay : false,
        navigation : true, 
        pagination: true, 
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
    });
});

$(function(){
    $("#sbn_side_close").on("click", function() {
        set_cookie("ck_top_banner_close", 1, 24, g5_cookie_domain);
        $("#sbn_side").hide();
    });
});
 </script>