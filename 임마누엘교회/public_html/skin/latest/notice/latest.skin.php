<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->


<?php for ($i = 0; $i < count($list); $i++) { ?>
    <a href="<?php echo $list[$i]['href']; ?>" id="main_notice">
        <div class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
            <div class="txt">
                <p class="color_skyblue">중요교회 소식</p>
                <!-- 글 제목 -->
                <h4><?php echo $list[$i]['subject']; ?></h4>
                <!-- 작성 날짜 -->
                <h6><?php echo date('Y-m-d', strtotime($list[$i]['wr_datetime'])); ?></h6>
            </div>
            <div class="icon">
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </div>
    </a>
<?php } ?>

    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li>게시물이 없습니다.</li>
    <?php }  ?>

<?php echo $bo_subject; ?>