<?php
global $pid;
$pid = "job_list";
$sub_id = "job_list";
include_once('./_common.php');

$g5['title'] = '구인구직';
include_once('./_head.php');
?>


    <div id="banner" class="black mt0">
        <h6><b class="txt_color3">잡고 구인구직이 처음인가요?</b></h6>
        <h6 class="txt_bold2 txt_white">잡고 회원을 위한</h6>
        <h6 class="txt_thin txt_white">다양한 채용의 장!</h6>
        <button type="button" class="btn btn_black" onclick="location.href='<?php echo G5_URL ?>/new_jobs.php'">구인구직 안내 <i class="fa-solid fa-right"></i></button>
    </div>


    <div id="jobs">
        <!--  마켓  -->
        <div class="in">

            <div class="tab-menu">
                <span class="tab-link active" data-tab="all">전체</span>
                <button class="tab-link" data-tab="tab1">공고 목록</button>
                <button class="tab-link" data-tab="tab2">구직 목록</button>
            </div>

            <section class="grid grid2">
                <div id="tab1" class="tab-content active">

                    <h2 class="title">이런 인재를 찾아요 <strong>구인 목록</strong></h2>
                    <div class="list">
                        <?php
                        for ($i = 0; $i < 8; $i++) {
                            ?>
                            <div class="thm" onclick="location.href='<?php echo G5_BBS_URL ?>/job_view.php'">
                                <div class="info">
                                    <div class="flex ai-c jc-sb">
                                        <h6>업체명 | ~09/30</h6>
                                        <div class="heart" name="">
                                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                                        </div>
                                    </div>
                                    <div class="tit">공고제목</div>
                                    <p class="flex ai-c">시 구 ·&nbsp;<b class="txt_color"> 월 0원</b>
                                        <b class="male-auto">+</b>
                                    </p>
                                </div>
                            </div><!--thm-->

                        <?php } ?>
                    </div><!--list-->
                </div>

                <div id="tab2" class="tab-content active">
                    <h2 class="title">제게 주목해주세요! <strong>구직 목록</strong></h2>
                    <div class="list">
                        <?php
                        for ($i = 0; $i < 8; $i++) {
                            ?>
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

                        <?php } ?>
                    </div><!--list-->
                </div>
            </section>
        </div><!--in-->

    </div><!--jobs-->


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabLinks = document.querySelectorAll('.tab-link');
            const section = document.querySelector('section');
            const listDivs = document.querySelectorAll('.list');

            tabLinks.forEach(link => {
                link.addEventListener('click', function () {
                    const tabName = this.getAttribute('data-tab');

                    // 모든 탭 콘텐츠 숨기기
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.classList.remove('active');
                    });

                    if (tabName === 'all') {
                        // "전체" 탭 클릭 시 #tab1과 #tab2를 모두 active로 설정
                        document.getElementById('tab1').classList.add('active');
                        document.getElementById('tab2').classList.add('active');

                        // section에 다시 grid grid2 클래스 추가
                        section.classList.add('grid', 'grid2');

                        // listDiv에서 grid, grid2 클래스 제거
                        listDivs.forEach(list => {
                            list.classList.remove('grid', 'grid2');
                        });
                    } else {
                        // 특정 탭 클릭 시 해당 탭만 active로 설정
                        document.getElementById(tabName).classList.add('active');

                        // section의 모든 클래스 제거
                        section.className = '';

                        // 모든 list div에 grid grid2 클래스 추가
                        listDivs.forEach(list => {
                            list.classList.add('grid', 'grid2');
                        });
                    }

                    // 모든 탭 링크에서 active 클래스 제거
                    tabLinks.forEach(link => link.classList.remove('active'));

                    // 클릭한 탭 링크에 active 클래스 추가
                    this.classList.add('active');
                });
            });
        });
    </script>
<?php
include_once('./_tail.php');
?>