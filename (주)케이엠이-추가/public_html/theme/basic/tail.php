<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
	<? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    </div><!--#container_index-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
	<? } ?> 
</div>

<!-- } 콘텐츠 끝 -->

<hr>


<!-- 하단 시작 { -->
    <footer class="footer-kme mt-auto w-100 poppins-400">
        <div class="container-lg d-lg-flex align-items-center justify-content-between py-5">
            <div class="mb-4 mb-lg-0 me-5"><a href="../index.html" target="_self">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_w.svg" alt="<?php echo $config['cf_title']; ?>" style="width: 200px;">
                </a></div>
            <hr class="bg-light web-none">
            <!-- <div class="border-bottom my-4"></div> -->
            <div class="mx-0 mx-lg-5">
                <div class="d-lg-flex align-items-center">
                    <div class="text-light me-5 mb-3 mb-lg-0">
                        <div class="fs-5 fw-bold mb-1"><?php echo $config['cf_2_subj']; ?></div>
                        <div><?php echo $config['cf_2']; ?></div>
                    </div>
                    <div class="text-light">
                        <div class="fs-5 fw-bold mb-1"><?php echo $config['cf_3_subj']; ?></div>
                        <div class="d-lg-flex">
                            <div class="d-flex mb-1">
                                <i class="bi bi-telephone me-2"></i>
                                <a href="tel:+82-51-327-2670" class="text-light text-under"><?php echo $config['cf_3']; ?></a>
                            </div>
                            <div class="mx-4 mobile-none">|</div>
                            <div class="d-flex mb-1">
                                <i class="bi bi-printer me-2"></i>
                                <div><?php echo $config['cf_4']; ?></div>
                            </div>
                            <div class="mx-4 mobile-none">|</div>
                            <div class="d-flex">
                                <i class="bi bi-send me-2"></i>
                                <div><a class="text-light text-under" href="mailto:<?php echo $config['cf_5']; ?>"
                                        target="_blank"><?php echo $config['cf_5']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="fs-6_5 text-secondary"><?php echo $config['cf_1']; ?></div>
                    <div class="fs-6_5 text-secondary">Copyright (c) 2024 <?php echo $config['cf_title']; ?> Co., Ltd. All right reserved.
                        <?php if ($is_member) {  ?>
                            <?php if ($is_admin) {  ?>
                            <?php }  ?>
                            <a href="<?php echo G5_BBS_URL ?>/logout.php" class="adm">로그아웃</a>
                        <?php } else {  ?>
                            <a href="<?php echo G5_BBS_URL ?>/login.php" class="adm">관리자로그인</a>
                        <?php }  ?>
                    </div>
                </div>
            </div>
            <div class="d-flex ms-auto pt-4 pt-lg-0 pb-1 pb-lg-0 ms-5 certi">
                <div class="me-1"><img src="<?php echo G5_THEME_IMG_URL ?>/common/iso9001_white.svg" data-hover="<?php echo G5_THEME_IMG_URL ?>/common/iso9001.svg"></div>
                <div class="me-1"><img src="<?php echo G5_THEME_IMG_URL ?>/common/iecex_white.svg" data-hover="<?php echo G5_THEME_IMG_URL ?>/common/iecex.svg"></div>
                <div class="me-1"><img src="<?php echo G5_THEME_IMG_URL ?>/common/dnv_white.svg" data-hover="<?php echo G5_THEME_IMG_URL ?>/common/dnv.svg"></div>
                <div class="me-1"><img src="<?php echo G5_THEME_IMG_URL ?>/common/design_white.svg" data-hover="<?php echo G5_THEME_IMG_URL ?>/common/design.svg"></div>
                <div class="me-1"><img src="<?php echo G5_THEME_IMG_URL ?>/common/venture_white.svg" data-hover="<?php echo G5_THEME_IMG_URL ?>/common/venture.svg"></div>
            </div>
        </div>

    </footer>
  
    <!--스크롤시 나타나는 상하단버튼-->
    <div id="gobtn">
        <a href="#hd" class="btnTop"><span></span>브라우저 최상단으로 이동합니다</a>
    </div>


<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>
<script>
    //인증아이콘
    document.querySelectorAll('.certi .me-1 img').forEach(function(img) {
        img.addEventListener('mouseover', function() {
            this.src = this.getAttribute('data-hover');
        });

        img.addEventListener('mouseout', function() {
            this.src = this.src.replace('.svg', '_white.svg');
        });
    });
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>