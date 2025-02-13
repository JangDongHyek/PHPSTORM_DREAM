<? 
include_once('./_common.php');

$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_list";
$pid = "project_list";
?>
    <div id="nav_area">
        <nav id="gnb">
            <h2>메인메뉴</h2>
            <ul id="gnb_1dul">
                <li class="gnb_1dli all_menu">
                    <a class="gnb_1da">
                        <i class="fa-light fa-bars"></i> 전체메뉴
                    </a>
                    <ul class="gnb_2dul">
                        <li class="gnb_2dli">
                            <a class="gnb_2da">프로젝트</a>
                            <div class="gnb_2dli_list" style="display: none;">
                                <ul class="gnb_2dul ver02" style="display: none;">
                                    <li class="gnb_2dli"><a class="gnb_2da">전체 프로젝트</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <span class="main-category">프로젝트</span>
            <div class="menu-container">
                <div id="target_scroll" class="menu-wrapper">
                    <ul id="gnb_1dul" class="menu">
                        <li class="gnb_1dli single_menu">
                            <a class="gnb_1da">전체<span></span></a>
                        </li>
                    </ul>
                </div>
                <button class="scroll-button left-button end">
                    <i class="fa-light fa-angle-left"></i>
                </button>
                <button class="scroll-button right-button">
                    <i class="fa-light fa-angle-right"></i>
                </button>
            </div>
        </nav>
    </div>

    <!--서브 상단 배너-->
<div class="swiper subSwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/visual01.jpg">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/visual01.jpg">
        </div>
    </div>
    <div class="swiper-pagination"></div>
</div>
<script>
    var swiper = new Swiper('.subSwiper', {
        spaceBetween: 0,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
<!--//서브 상단 배너-->

<!-- 순서 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <ul id="sort_list" class="sort_list_mobile">
                        <li class="active">최신순</li>
                        <li>추천순</li>
                        <li>별점순</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<div id="area_project">
    <div class="inr">
        <ul id="area_history"><li><a href="">홈</a></li> <!----> <li><a href="" class="current">프로젝트</a></li></ul>
        <div id="list_top">
            <div class="total">총 2건</div>
            <div class="sort_list"><span data-toggle="modal" data-target="#listModal">최신순</span></div>
        </div>
        <ul class="project-list">
            <li class="project-item">
                <a href="./project_view.php" class="project-link">
                    <div class="thumb">
                        <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로젝트 이미지">
                    </div>
                    <div class="project-cont">
                        <div class="project-info">
                            <div class="project-category">
                                1차 카테고리 · 2차 카테고리
                                <button type="button" class="bookmark"><i class="fa-light fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                            </div>
                            <h2 class="project-title">프로젝트명</h2>
                            <p class="project-desc">프로젝트 설명입니다.</p>
                        </div>
                        <div class="project-user">
                            <div class="user-info">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="유저 프로필" class="user-img">
                                <span class="user-name">의뢰인</span>
                            </div>
                            <div class="view-count">👁️ 1,662</div>
                        </div>
                    </div>
                    <ul class="prize-info">
                        <li><span>🏆 총 상금</span> 80만 원</li>
                        <li><span>📌 참여작</span> 21개</li>
                        <li><span>📅 진행 기간</span> 6일</li>
                        <li><span>📆 날짜</span> 25.02.05 ~ 25.02.11</li>
                    </ul>
                </a>
            </li>
            <li class="project-item">
                <a href="./project_view.php" class="project-link">
                    <div class="thumb">
                        <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로젝트 이미지">
                    </div>
                    <div class="project-cont">
                        <div class="project-info">
                            <div class="project-category">
                                1차 카테고리 · 2차 카테고리
                                <button type="button" class="bookmark"><i class="fa-solid fa-bookmark"></i></button>
                            </div>
                            <h2 class="project-title">프로젝트명</h2>
                            <p class="project-desc">프로젝트 설명입니다.</p>
                        </div>
                        <div class="project-user">
                            <div class="user-info">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="유저 프로필" class="user-img">
                                <span class="user-name">의뢰인</span>
                            </div>
                            <div class="view-count">👁️ 1,662</div>
                        </div>
                    </div>
                    <ul class="prize-info">
                        <li><span>🏆 총 상금</span> 80만 원</li>
                        <li><span>📌 참여작</span> 21개</li>
                        <li><span>📅 진행 기간</span> 6일</li>
                        <li><span>📆 날짜</span> 25.02.05 ~ 25.02.11</li>
                    </ul>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php
include_once('./_tail.php');
?>