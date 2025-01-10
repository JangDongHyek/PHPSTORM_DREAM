<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="visual">
        <div class="area_txt">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_slogun.png" class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.8s">
        </div>
        <ul class="sliderbx">
            <li class="mv01"></li>
            <li class="mv02"></li>
            <li class="mv03"></li>
        </ul>
        <?php
        echo latest('notice', 'notice', 1);
        ?>
    </div>
    <!-- //visual -->
</div><!--  #idx_wrapper -->
<!--<div class="fixed_bg"></div>-->

<div id="content" class="wow fadeInUp animated" data-wow-delay="0.9s" data-wow-duration="0.8s">
    <section id="s2">
        <div class="inr">
            <div class="area_txt">
                <h1>새가족 여러분을<br>환영합니다!</h1>
<!--                <h6>자주쓰는 메뉴 바로가기</h6>-->
                <p>IMC에 오신 새가족 여러분을 <br>진심으로 환영하고 사랑합니다</p>
            </div>
            <div class="area_btn">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub02_02" class="btn_quick">
                    <i class="fa-solid fa-house-heart"></i>
                    <p>새가족 안내</p>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=sub02_01" class="btn_quick">
                    <i class="fa-solid fa-book-heart"></i>
                    <p>새가족 등록</p>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub07_01" class="btn_quick">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>찾아오시는 길</p>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_05" class="btn_quick">
                    <i class="fa-solid fa-timer"></i>
                    <p>예배시간 안내</p>
                </a>
<!--
                <a href="" class="btn_quick">
                    <i class="fa-solid fa-podcast color_skyblue"></i>
                    <p>생방송링크</p>
                </a>
                <a href="" class="btn_quick">
                    <i class="fa-solid fa-newspaper color_skyblue"></i>
                    <p>온라인주보</p>
                </a>
                <a href="" class="btn_quick">
                    <i class="fa-solid fa-pen-nib color_skyblue"></i>
                    <p>성경필사</p>
                </a>
                <a href="" class="btn_quick">
                    <i class="fa-solid fa-hands-praying color_skyblue"></i>
                    <p>기도요청</p>
                </a>
                <a href="" class="btn_quick">
                    <i class="fa-solid fa-book-bible color_skyblue"></i>
                    <p>성경읽기</p>
                </a>
                <a href="" class="btn_quick">
                    <i class="fa-solid fa-cross color_skyblue"></i>
                    <p>묵상 QT</p>
                </a>
-->
            </div>
        </div>
    </section>
    <section id="s3">
        <div class="inr banWrap">
        
        <a href="http://origin.imc.or.kr/wp-login.php" target="_blank">
           <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub06_ban03.png" alt="">
            <div class="textWrap">
                <h6>성경 필사<i class="fa-solid fa-arrow-up-right"></i></h6>
            </div>
        </a>
        
        <a href="https://www.bskorea.or.kr/bible/korbibReadpage.php" target="_blank">
           <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub06_ban01.png" alt="">
            <div class="textWrap">
                <h6>성경 읽기<i class="fa-solid fa-arrow-up-right"></i></h6>
            </div>
        </a>
        
        <a href="https://www.bskorea.or.kr/prog/read3_1.php" target="_blank">
           <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub06_ban02.png" alt="">
            <div class="textWrap">
                <h6>매일 묵상<i class="fa-solid fa-arrow-up-right"></i></h6>
            </div>
        </a>
        
        <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=prayer">
           <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub02_ban04.png" alt="">
            <div class="textWrap">
                <h6>기도 요청<i class="fa-solid fa-arrow-up-right"></i></h6>
            </div>
        </a>
        </div>
    </section>
    <section id="s4">
       <div class="inr">
        <!--	    slick slide-->
        <div class="wheel-slide">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_01_main">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/s4_02.png" alt="">
                <div class="textWrap">
                    <i class="fa-solid fa-link color_blue"></i>
                    <h6>링커부</h6>
<!--                    <p>나의 포인트 현황과<br>기부 내역을 확인해보세요</p>-->
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_02_main">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/s4_03.png" alt="">
                <div class="textWrap">
                    <i class="fa-solid fa-book-open-cover color_blue"></i>
                    <h6>교육부</h6>
<!--                    <p>임마누엘 교우님들의<br>소식을 빠르게 알아보세요</p>-->
                </div>
            </a>
        </div>
        
        <div class="area_txt">
            <h1 class="color_blue">다음세대</h1>
            <h6 class="color_blue">Church for tomorrow</h6>
            <p>IMC는 이 세상의 소망인 다음세대를 <br>사랑하고 섬기며 세우는 교회입니다</p>
<!--
            <a href="" class="btn-mv">
                자세히보기<i class="fa-solid fa-arrow-up-right"></i>
            </a>
-->
        </div>
        </div>
    </section>
    <section id="s6">
        <div class="inr banWrap">
            <div class="ban">
                <div class="textWrap">
                    <h6>IMC Social <br class="hidden-xs">media</h6>
                </div>
                <div class="imgWrap">
                   <a href="https://www.youtube.com/channel/UC8XsX2FEj61FL20MlTDjV8g" target="_blank" class="btn_youtube">
                       <i><img src="<?php echo G5_THEME_IMG_URL ?>/common/youtube.svg" alt=""></i>
                       <p>YouTube</p>
                   </a>
                    <a href="https://www.instagram.com/imc_worship_official/" target="_blank" class="btn_insta">
                        <i><img src="<?php echo G5_THEME_IMG_URL ?>/common/insta.svg" alt=""></i>
                        <p>Instagram</p>
                    </a>
                    <a href="https://www.facebook.com/IMCworship/" target="_blank" class="btn_facebook">
                        <i>
                            <img src="<?php echo G5_THEME_IMG_URL ?>/common/facebook.svg" alt="">
                        </i>
                        <p>Facebook</p>
                    </a>
                    <a href="https://blog.naver.com/letsdoimc" target="_blank" class="btn_blog">
                        <i><img src="<?php echo G5_THEME_IMG_URL ?>/common/blog.svg" alt=""></i>
                        <p>Naver Blog</p>
                    </a>
                </div>
            </div>
        
            <div class="ban">
                <div class="textWrap">
                    <h6>IMC App</h6>
                </div>
<!--
                <div class="imgWrap">
                   <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_ban02.png" alt="">
                </div>
-->
                    <a class="bttn" href="https://play.google.com/store/apps?hl=ko&gl=US" target="_blank">
                    앱 다운로드
                    <i class="fa-solid fa-arrow-up-right"></i>
                    </a>
            </div>
        
            <div class="ban">
                <div class="textWrap">
                    <h6>온라인 헌금 안내</h6>
                    <p>헌금봉헌에 불편을 겪고계신 <br>성도님들을 위해 온라인 헌금 안내를 만들었어요</p>
                </div>
<!--
                <div class="imgWrap">
                   <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_ban03.png" alt="">
                </div>
-->
                <a class="bttn" href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_08">
                    <i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>
        
            <div class="ban">
                <div class="textWrap">
                    <h6>부설/협력기관</h6>
                </div>
                <div class="btn_wrap">
                    <a class="bttn" href="https://www.sujungkids.com" target="_blank">
                        수정유치원<i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                    <a class="bttn" href="https://www.wpca.or.kr" target="_blank">
                        전인기독학교<i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                    <a class="bttn" href="https://bangiwelfare.or.kr/" target="_blank">
                        방이복지관<i class="fa-solid fa-arrow-up-right"></i>
                    </a>
                </div>
<!--
                <div class="imgWrap">
                   <img src="<?php echo G5_THEME_IMG_URL ?>/sub/main_ban04.png" alt="">
                </div>
-->
            </div>
        </div>
    </section>
</div>



<?php
include_once(G5_PATH.'/tail.php');
?>
