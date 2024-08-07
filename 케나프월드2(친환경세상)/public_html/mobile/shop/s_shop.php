<?php
include_once('./_common.php');

$g5['title'] = '고객지원';
include_once(G5_MSHOP_PATH.'/_head.php');
?>

<!-- 내용 시작 { -->
<div style="margin:10px;">
    <div>
       고객지원 그룹 예시<br><br><br>
    </div>
    <div style="text-align:center">
       <img Src="<?php echo G5_MSHOP_URL ?>/img/s_shop.png" style="max-width:100%; height:auto;"><br><br><br>
    </div>
    <section id="sidx_lat">
       <h2>쇼핑몰 최신글</h2>
       <?php echo latest('shop_basic', 's_notice', 5, 30); ?>
       <?php echo latest('shop_basic', 's_free', 5, 25); ?>
       <?php echo latest('shop_basic', 'qa', 5, 20); ?>
    </section>
</div>
<!-- } 내용 끝 -->

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>