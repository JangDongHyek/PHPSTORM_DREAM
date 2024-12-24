<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/s_shop.php');
    return;
}

$g5['title'] = '고객지원';
include_once('./_head.php');
?>

<!-- 내용 시작 { -->
    <div>
       고객지원 그룹 예시<br><br><br>
    </div>
    <div>
       <center><img Src="<?php echo G5_SHOP_URL ?>/img/s_shop.png"></center><br><br><br>
    </div>
    <section id="sidx_lat">
       <h2>쇼핑몰 최신글</h2>
       <?php echo latest('shop_basic', 's_notice', 5, 30); ?>
       <?php echo latest('shop_basic', 's_free', 5, 25); ?>
       <?php echo latest('shop_basic', 'qa', 5, 20); ?>
    </section>
<!-- } 내용 끝 -->

<?php
include_once('./_tail.php');
?>