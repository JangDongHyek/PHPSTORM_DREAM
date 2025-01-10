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

        <a href="" id="main_notice">
            <div class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
                <div class="txt">
                    <p class="color_skyblue">중요교회 소식</p>
                    <h4>LIVE IMC TV 방송안내</h4>
                    <h6>2024-02-14</h6>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- //visual -->
</div><!--  #idx_wrapper -->
<!--<div class="fixed_bg"></div>-->

<div id="content" class="wow fadeInUp animated" data-wow-delay="0.9s" data-wow-duration="0.8s">
    <section id="s2">
        <div class="inr">
            <div class="area_txt">
                <h1>quick menu</h1>
                <h6>자주쓰는 메뉴 바로가기</h6>
                <p>우리 모두가 꿈꿔온 행복한 교회<br>열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복,<br>비전이 있는 축복의 통로, 임마누엘교회로 초대합니다</p>
            </div>
            <div class="area_btn">
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
            </div>
        </div>
    </section>
    <section id="s3">
        <div class="inr">
            <div class="area_txt">
                <h1>start imc</h1>
                <h6 class="colr_blue">새가족 등록</h6>
                <p>우리 모두가 꿈꿔온 행복한 교회<br>열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복,<br>비전이 있는 축복의 통로, 임마누엘교회로 초대합니다</p>
                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>
<!--
            <div class="area_btn hidden-xs">
                <a class="banner_img1">
                    <p>커리큘럼 안내<i class="fa-solid fa-arrow-up-right"></i></p>
                </a>
                <div class="wrap">
                    <a class="banner_img2">
                        <p>교육 컨텐츠<i class="fa-solid fa-arrow-up-right"></i></p>
                    </a>
                    <a class="banner_img3">
                        <p>새가족 인터뷰<i class="fa-solid fa-arrow-up-right"></i></p>
                    </a>
                </div>
            </div>
-->

            <div class="area_btn area_btn_slider visible-xs">
                <a class="banner_img1">
                    <p>커리큘럼 안내<i class="fa-solid fa-arrow-up-right"></i></p>
                </a>
                <a class="banner_img2">
                    <p>교육 컨텐츠<i class="fa-solid fa-arrow-up-right"></i></p>
                </a>
                <a class="banner_img3">
                    <p>새가족 인터뷰<i class="fa-solid fa-arrow-up-right"></i></p>
                </a>
            </div>
        </div>
    </section>
    <section id="s4">
        <!--	    slick slide-->
        <div class="wheel-slide">
            <a href="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/s4_01.png" alt="">
                <div class="textWrap">
                    <i class="fa-solid fa-coins color_blue"></i>
                    <h6>나의 달란트</h6>
                    <p>나의 포인트 현황과<br>기부 내역을 확인해보세요</p>
                </div>
            </a>
            <a href="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/s4_02.png" alt="">
                <div class="textWrap">
                    <i class="fa-solid fa-coins color_blue"></i>
                    <h6>교우소식</h6>
                    <p>임마누엘 교우님들의<br>소식을 빠르게 알아보세요</p>
                </div>
            </a>
            <a href="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/s4_03.png" alt="">
                <div class="textWrap">
                    <i class="fa-solid fa-coins color_blue"></i>
                    <h6>온라인 헌금</h6>
                    <p>헌금봉헌에 불편을 겪고계신 성도님들을 위해<br>온라인 헌금 안내를 만들었어요</p>
                </div>
            </a>
        </div>
        <div class="area_txt">
            <h1>Connect IMC</h1>
            <h6 class="colr_blue">임마누엘마당</h6>
            <p>우리 모두가 꿈꿔온 행복한 교회<br>열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복,<br>비전이 있는 축복의 통로, 임마누엘교회로 초대합니다</p>
            <a href="" class="btn-mv">
                자세히보기<i class="fa-solid fa-arrow-up-right"></i>
            </a>
        </div>
    </section>
    <section id="s5">
        <div class="inr">
            <div class="area_txt">
                <h1>Link IMC</h1>
                <h6 class="color_blue">youtube</h6>

                <div class="youtube_txt">
                    <h4>[주일4부 IMC Linkers] 221211 Worship Songs</h4>
                    <p>#ImcWorship #찬양 #청년예배
                        #임마누엘교회
                        #임마누엘 #예수보다더큰사랑
                        #그맑고환한밤중에 #사랑이오셨네 </p>
                </div>

                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>
            <div class="area_youtube active">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/RgF6JJEnWtI?si=oLe3DXWSX5dDRmA0&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>
                <a class="btn-mv">
                    <span class="ic_right"><i class="fa-solid fa-arrow-right"></i></span>
                    영상 바로가기
                </a>
            </div>
            <div class="area_youtube">
               
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/Kvu5I_KsApc?si=p38vc8TqjaGGt1Yo&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>
                <a class="btn-mv">
                    <span class="ic_right"><i class="fa-solid fa-arrow-right"></i></span>
                    영상 바로가기
                </a>
            </div>
            <div class="area_youtube">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/KWrs7L9xoPs?si=ut6sdtgm4qULVyEQ&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>
                <a class="btn-mv">
                    <span class="ic_right"><i class="fa-solid fa-arrow-right"></i></span>
                    영상 바로가기
                </a>
            </div>
            <div class="area_youtube">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/u8zxfyoWS30?si=vrisWrnjQ8YF9m4u&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>
                <a class="btn-mv">
                    <span class="ic_right"><i class="fa-solid fa-arrow-right"></i></span>
                    영상 바로가기
                </a>
            </div>

        </div>
    </section>
</div>



<?php
include_once(G5_PATH.'/tail.php');
?>
