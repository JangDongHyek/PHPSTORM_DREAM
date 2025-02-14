<? 
include_once('./_common.php');

$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_view";
$pid = "project_list";
?>

<div id="area_project">
    <div class="inr">
        <ul id="area_history"><li><a href="">홈</a></li> <!----> <li><a href="" class="current">프로젝트</a></li></ul>
    </div>
    <div class="project-view">
        <div class="grid">
            <section class="left">
                <div class="thumbnail-container">
                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로젝트 이미지">
                </div>
            </section>
            <section class="right">
                <div class="info-box">
                    <div class="project-category">
                        1차 카테고리 · 2차 카테고리
                        <button type="button" class="bookmark"><i class="fa-light fa-bookmark"></i></button><!--북마크시 fa-solid fa-bookmark-->
                    </div>
                    <h2>프로젝트 제목</h2>
                    <p class="subtitle">프로젝트 설명</p>
                    <div class="profile">
                        <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                        <span>의뢰자</span>
                    </div>
                </div>
                <div class="prize-info">
                    <div class="">총 상금</div>
                    <div class="total-prize">35만 원</div>
                    <ul>
                        <li><span class="first-prize"><b>1등</b> 35만 원</span><span class="winner-count">x 1명</span></li>
                    </ul>

                </div>
                <div class="meta-info">
                    <div>진행 기간<br><b>6일</b><br><span>25.01.01 - 25.01.06</span></div>
                    <div>참여작<br><b>24개</b></div>
                    <div>조회 수<br><b>430</b></div>
                </div>
                <div class="button-container">
                    <button class="share-btn">공유하기</button>
                    <button class="apply-btn" onclick="location.href='./project_join.php'">프로젝트 지원하기</button>
                </div>
            </section>
        </div>

        <div class="tabs">
            <div class="tab active" onclick="showTab(0)">요청 사항</div>
            <div class="tab" onclick="showTab(1)">참여작 <span class="count">24</span></div>
            <div class="tab" onclick="showTab(2)">문의 댓글 <span class="count">0</span></div>
        </div>
        <div class="tab-content active">
            <div class="request-view">
                <h6>의뢰 내용</h6>
                <div>
                    <!--에디터 내용-->
                    의뢰 내용입니다.
                </div>
                <h6>참고 레퍼런스</h6>
                <div>
                    <div class="swiper sample-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <div class="swiper-slide"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <div class="swiper-slide"><img src="http://itforone.com/~broadcast/theme/basic_app/img/app/visual01.jpg"></div>
                            <div class="swiper-slide"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                            <div class="swiper-slide"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <!-- Swiper JS -->
                    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

                    <!-- Initialize Swiper -->
                    <script>
                        var swiper = new Swiper(".sample-swiper", {
                            slidesPerView: "auto",
                            spaceBetween: 10,
                            pagination: {
                                el: ".swiper-pagination",
                                clickable: true,
                            },
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="join-view">
                <h6>선정 작품</h6>
                <div>
                    <div class="empty">
                        <i class="fa-regular fa-award"></i>
                        아직 선정되지 않았어요.
                    </div>
                    <ul>
                        <li>
                            <a data-toggle="modal" data-target="#joinViewModal" >
                                <div class="img"><span class="icon_1st">1등</span><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                <p>#3</p><!--참여순서-->
                                <div class="profile">
                                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <span>지원자</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a>
                                <div class="img"><span class="icon_2nd">2등</span><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                <p>#2</p><!--참여순서-->
                                <div class="profile">
                                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <span>지원자</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a>
                                <div class="img"><span class="icon_3th">3등</span><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                <p>#1</p><!--참여순서-->
                                <div class="profile">
                                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <span>지원자</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <h6>참여 작품</h6>
                <div>
                    <div class="empty">
                        <i class="fa-duotone fa-object-subtract"></i>
                        참여한 작품이 없어요.
                    </div>
                    <ul>
                        <li>
                            <a>
                                <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                <p>#1</p><!--참여순서-->
                                <div class="profile">
                                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <span>지원자</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a>
                                <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                <p>#2</p><!--참여순서-->
                                <div class="profile">
                                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <span>지원자</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a>
                                <div class="img"><img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg"></div>
                                <p>#3</p><!--참여순서-->
                                <div class="profile">
                                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <span>지원자</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="qna-view">
                <h6>문의 댓글</h6>
                <div>
                    <textarea placeholder="문의 내용을 입력하세요."></textarea>
                    <button type="button" class="qna-btn">문의 등록</button>
                </div>
                <h6>답변 내용</h6>
                <div>
                    <div class="empty">
                        <i class="fa-solid fa-comment-question"></i>
                        등록된 문의가 없어요.
                    </div>
                    <ul>
                        <li>

                            <div class="profile">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                <span>지원자</span>
                                <div class="btn-wrap">
                                    <button type="button" class="answer-btn">삭제</button><!--본인-->
                                    <button type="button" class="answer-btn">답변</button><!--의뢰자-->
                                </div>
                            </div>
                            <p>문의 내용입니다.</p>
                            <div class="answer">
                                <p>답변 내용입니다.</p>
                                <div class="btn-wrap"><!--본인-->
                                    <button type="button" class="answer-btn">수정</button>
                                    <button type="button" class="answer-btn">삭제</button>
                                </div>
                            </div>
                            <div class="answer-field">
                                <textarea placeholder="문의 내용을 입력하세요."></textarea>
                                <button type="button" class="qna-btn">답변 등록</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade portfolio-container" id="joinViewModal" tabindex="-1" role="dialog" aria-labelledby="joinViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                    <div>
                        <div class="portfolio-header">
                            작품 상세 보기
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="portfolio-grid">
                            <div class="portfolio-info">
                                <h1 class="title">작품명</h1>
                                <p class="winner-badge">1등</p>
                                <p class="description">안녕하세요. 작품 설명은 상세 이미지를 참조 부탁드립니다.<br>
                                    우승작 선정 후 컬러, 서체, 디테일 등 자유롭게 수정 가능합니다. 감사합니다.</p>
                                <div class="profile">
                                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <span>지원자</span>
                                </div>
                                <button type="button" class="btn-down">
                                    첨부파일 다운로드
                                </button>
                            </div>
                            <div class="portfolio-image">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function showTab(tabIndex) {
            document.querySelectorAll('.tab-content').forEach((content, index) => {
                content.classList.toggle('active', index === tabIndex);
            });
            document.querySelectorAll('.tab').forEach((tab, index) => {
                tab.classList.toggle('active', index === tabIndex);
            });
        }
    </script>
<?php
include_once('./_tail.php');
?>