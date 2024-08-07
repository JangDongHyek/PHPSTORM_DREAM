<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sct_sort_href = $_SERVER['SCRIPT_NAME'].'?';
if($ca_id)
    $sct_sort_href .= 'ca_id='.$ca_id;
else if($ev_id)
    $sct_sort_href .= 'ev_id='.$ev_id;
if($skin)
    $sct_sort_href .= '&amp;skin='.$skin;
$sct_sort_href .= '&amp;sort=';

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);

?>

<div class="list-sort">
    <div class="hidden-xs">
        <div class="pull-right">
            <a href="<?php echo $sct_sort_href; ?>it_price&amp;sortodr=asc"><i class="fas fa-long-arrow-alt-down"></i> 낮은가격순</a>
            <a href="<?php echo $sct_sort_href; ?>it_price&amp;sortodr=desc"><i class="fas fa-long-arrow-alt-up"></i> 높은가격순</a>
            <a href="<?php echo $sct_sort_href; ?>it_name&amp;sortodr=asc"><i class="fas fa-list-ul"></i> 상품명순</a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="dropdown visible-xs">
        <a id="sortLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-black btn-block">
            상품정렬<span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="sortLabel">
            <li><a href="<?php echo $sct_sort_href; ?>it_price&amp;sortodr=asc"><i class="fas fa-long-arrow-alt-down"></i> 낮은가격순</a></li>
            <li><a href="<?php echo $sct_sort_href; ?>it_price&amp;sortodr=desc"><i class="fas fa-long-arrow-alt-up"></i> 높은가격순</a></li>
            <li><a href="<?php echo $sct_sort_href; ?>it_name&amp;sortodr=asc"><i class="fas fa-list-ul"></i> 상품명순</a></li>
<!--            <li role="separator" class="divider"></li>-->
        </ul>
    </div>
</div>


<!-- 상품 정렬 선택 시작 {
<section id="sct_sort">
    <h2>상품 정렬</h2>

    <ul>
        <li><a href="<?php echo $sct_sort_href; ?>it_price&amp;sortodr=asc" class="btn01">낮은가격순</a></li>
        <li><a href="<?php echo $sct_sort_href; ?>it_price&amp;sortodr=desc" class="btn01">높은가격순</a></li>
        <li><a href="<?php echo $sct_sort_href; ?>it_name&amp;sortodr=asc" class="btn01">상품명순</a></li>
    </ul>
</section>
<!-- } 상품 정렬 선택 끝 -->