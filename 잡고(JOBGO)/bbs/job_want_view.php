<?php
global $pid;
$pid = "job_view";
$sub_id = "job_view";
include_once('./_common.php');

$g5['title'] = '';
include_once('./_head.php');
?>

    <article id="item_view" class="jobs">
        <div class="job_info">
            <div class="heart">
                <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
            </div>
            <div class="flex ai-c gap10">
                <header>
                    <h6 class="item_tit">이력서 제목</h6>
                    <p class="txt_color">성별 | 만나이</p>
                </header>
                <div class="btn_wrap">
                    <button type="button" class="btn btn_color2 btn_middle">연락처 요청</button>
                    <button type="button" class="btn btn_gray btn_middle">채팅 요청</button>
                </div>
            </div>
            <div id="cam_info">
                <div class="flex ai-c gap20">
                    <div>
                        <p class="flex ai-c jc-sb">
                            <span>관심분야</span>
                            <b>디자인/웹개발</b>
                        </p>
                        <p class="flex ai-c jc-sb">
                            <span>경력사항</span>
                            <b>2년 7개월</b>
                        </p>
                    </div>
                    <div>
                        <p class="flex ai-c jc-sb">
                            <span>최종학력</span>
                            <b>대학(4년제)</b>
                        </p>
                        <p class="flex ai-c jc-sb">
                            <span>희망고용</span>
                            <b>정규직</b>
                        </p>
                    </div>
                </div>
            </div>

            <section class="job_want">
                <h3 class="title">학력사항</h3>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>기간</th>
                                <th>명칭</th>
                                <th>세부</th>
                                <th>성적</th>
                                <th>비고</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2014.01.01-2017.12.31</td>
                                <td>남서고등학교</td>
                                <td>이과계열</td>
                                <td>-</td>
                                <td>졸업</td>
                            </tr>
                            <tr>
                                <td>2018.01.01-2022.12.31</td>
                                <td>남서울대학교(4년)</td>
                                <td>건축학과</td>
                                <td>4.0/4.5</td>
                                <td>졸업</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="job_want">
                <h3 class="title">경력사항</h3>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>기간</th>
                            <th>근무지</th>
                            <th>세부</th>
                            <th>직급</th>
                            <th>퇴사사유</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2022.01.01-2023.12.31</td>
                            <td>ITWORLD</td>
                            <td>개발부</td>
                            <td>사원</td>
                            <td>개인사정</td>
                        </tr>
                        <tr>
                            <td>2024.01.01~</td>
                            <td>DREAMWORLD</td>
                            <td>개발부</td>
                            <td>사원</td>
                            <td>재직중</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="job_want">
                <h3 class="title">희망고용</h3>
                <div id="want_info">
                    <p class="flex ai-c jc-sb">
                        <span>희망지역</span>
                        <b>서울전체</b>
                    </p>
                    <p class="flex ai-c jc-sb">
                        <span>희망연봉</span>
                        <b>회사내규</b>
                    </p>
                </div>
            </section>
            <section class="job_want">
                <h3 class="title">대외경력</h3>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>기간</th>
                            <th>장소/업체</th>
                            <th>상세서술</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2022.01.01-2023.12.31</td>
                            <td>IT박람회</td>
                            <td>부스 참가</td>
                        </tr>
                        <tr>
                            <td>2018.01.01-2022.12.31</td>
                            <td>앨리스개발자코스</td>
                            <td>개발자 교육 캠프 수료</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="job_want">
                <h3 class="title">자격사항</h3>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>취득일</th>
                            <th>자격증명</th>
                            <th>발급처</th>
                            <th>세부</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2023.12.31</td>
                            <td>1종 보통 운전면허</td>
                            <td>한국교통공사</td>
                            <td>최종합격</td>
                        </tr>
                        <tr>
                            <td>2022.12.31</td>
                            <td>정보처리기사</td>
                            <td>한국산업인력공단</td>
                            <td>최종합격</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div class="job_box">
            <p class="txt_color">지금 본 지원자가 마음에 든다면?</p>
            <h3><b>같은 분야의 인재를 추천해드려요!</b></h3>

            <!-- Swiper -->
            <div class="swiper sub1Swiper">
                <div class="swiper-wrapper">
                    <?php
                    for ($i = 0; $i < 4; $i++) {
                        ?>
                    <div class="swiper-slide">
                        <div class="thm" onclick="location.href='<?php echo G5_BBS_URL ?>/job_want_view.php'">
                            <div class="info">
                                <div class="flex ai-c jc-sb">
                                    <h6 class="txt_color">관심 분야 | 디자인/웹개발</h6>
                                </div>
                                <div class="tit">이력서 제목</div>
                                <p class="flex ai-c">시 구 ·&nbsp;<b>성별 만나이</b>&nbsp;· 고용형태
                                    <b class="male-auto">+</b>
                                </p>
                            </div>
                        </div><!--thm-->
                    </div>
                <?php } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <script>
                var swiper = new Swiper(".sub1Swiper", {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    autoplay: {
                        delay: 25000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        768: {
                            slidesPerView: 2.5,
                            spaceBetween: 10,
                        },
                        1024: {
                            slidesPerView: 2.5,
                            spaceBetween: 10,
                        },
                    },
                });
            </script>
            <h3><b>또래 인재를 추천해드려요!</b></h3>

            <!-- Swiper -->
            <div class="swiper sub2Swiper">
                <div class="swiper-wrapper">
                    <?php
                    for ($i = 0; $i < 4; $i++) {
                        ?>
                        <div class="swiper-slide">
                            <div class="thm" onclick="location.href='<?php echo G5_BBS_URL ?>/job_want_view.php'">
                                <div class="info">
                                    <div class="flex ai-c jc-sb">
                                        <h6 class="txt_color">관심 분야 | 디자인/웹개발</h6>
                                    </div>
                                    <div class="tit">이력서 제목</div>
                                    <p class="flex ai-c">시 구 ·&nbsp;<b>성별 만나이</b>&nbsp;· 고용형태
                                        <b class="male-auto">+</b>
                                    </p>
                                </div>
                            </div><!--thm-->
                        </div>
                    <?php } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <script>
                var swiper = new Swiper(".sub2Swiper", {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    autoplay: {
                        delay: 25000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        768: {
                            slidesPerView: 2.5,
                            spaceBetween: 10,
                        },
                        1024: {
                            slidesPerView: 2.5,
                            spaceBetween: 10,
                        },
                    },
                });
            </script>
        </div>


    </article>
<?php
include_once('./_tail.php');
?>