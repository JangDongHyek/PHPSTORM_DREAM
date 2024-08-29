<?php
global $pid;
$pid = "my_jobs";
$sub_id = "my_jobs";
include_once('./_common.php');

$g5['title'] = '구인구직 관리';
include_once('./_head.php');

?>


    <article id="mypage" class="jobs">


        <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
            <h3>구인구직 관리</h3>

            <div class="wrapper">
                <div class="tabs cf">
                    <ul>
                        <li id="tab1"><a href="javascript:a_tab('1');">지원 공고<span class="badge">0</span></a></li>
                        <li id="tab2"><a href="javascript:a_tab('2');">찜한 공고<span class="badge">0</span></a></li>
                        <li id="tab3"><a href="javascript:a_tab('3');">구인 요청<span class="badge">0</span></a></li>
                        <li id="tab4"><a href="javascript:a_tab('4');">내 이력서<span class="badge">0</span></a></li>
                    </ul>

                    <!--지원 공고-->
                    <div id="tab-content1" class="tab-content">
                        <div id="my_list" class="jobs">
                            <div class="in">
                                <div class="list">
                                    <div class="thm">
                                        <div class="info">
                                            <a href="<?php echo G5_BBS_URL ?>/job_view.php">
                                                <div class="txt_up">업체명</div>
                                                <div class="tit">공고명</div>
                                                <div class="date">지원일 <span>24.01.01</span></div>
                                            </a>
                                        </div>
                                        <div class="btn_wrap">
                                            <button type="button" class="btn btn_line btn_middle">
                                                지원 취소
                                            </button>
                                            <button type="button" class="btn btn_gray3 btn_middle" disabled>
                                                결과 대기
                                            </button>
                                            <button type="button" class="btn btn_color2 btn_middle">
                                                열람 완료
                                            </button>
                                        </div>
                                    </div><!--thm-->
                                    <div class="thm">
                                        <div class="info">
                                            <a href="<?php echo G5_BBS_URL ?>/job_view.php">
                                                <div class="txt_up">업체명</div>
                                                <div class="tit">공고명</div>
                                                <div class="date">지원일 <span class="txt_through">24.01.01</span></div>
                                            </a>
                                        </div>
                                        <div class="btn_wrap">
                                            <button type="button" class="btn btn_gray3 btn_middle" disabled>
                                                취소된 지원
                                            </button>
                                            <button type="button" class="btn btn_red2 btn_middle">
                                                열람 불가
                                            </button>
                                        </div>
                                    </div><!--thm-->
                                    <div class="thm">
                                        <div class="info">
                                            <a href="<?php echo G5_BBS_URL ?>/job_view.php">
                                                <div class="txt_up">업체명</div>
                                                <div class="tit">공고명</div>
                                                <div class="date">지원일 <span>24.01.01</span></div>
                                            </a>
                                        </div>
                                        <div class="btn_wrap">
                                            <button type="button" class="btn btn_gray3 btn_middle" disabled>
                                                결과 대기
                                            </button>
                                            <button type="button" class="btn btn_color btn_middle">
                                                개별 통보
                                            </button>
                                            <button type="button" class="btn btn_gray3 btn_middle" disabled>
                                                열람 완료
                                            </button>
                                        </div>
                                    </div><!--thm-->
                                </div><!--list-->
                            </div><!--in-->
                        </div>
                    </div>

                    <!--찜한 공고-->
                    <div id="tab-content2" class="tab-content box-article">
                        <div id="my_jobs">
                            <div class="list">
                                <?php
                                for ($i = 0; $i < 3; $i++) {
                                    ?>
                                    <div class="thm" onclick="location.href='<?php echo G5_BBS_URL ?>/job_view.php'">
                                        <div class="info">
                                            <div class="flex ai-c jc-sb">
                                                <h6>업체명 | ~09/30</h6>
                                                <div class="heart" name="">
                                                    <button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>
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
                        </div><!--my_jobs-->
                    </div>

                    <!--구인 요청-->
                    <div id="tab-content3" class="tab-content">
                        <div id="my_list" class="jobs v2">
                            <div class="in">
                                <div class="list">
                                    <h3 class="date">24.08.08 (월)</h3>
                                    <div class="thm">
                                        <div class="info">
                                            <a href="<?php echo G5_BBS_URL ?>/job_view.php">
                                                <div><a class="txt_color">기업 정보<i class="fa-regular fa-chevron-right"></i></a></div>
                                                <div class="tit">[업체명] 연락처 요청</div>
                                            </a>
                                        </div>
                                        <div class="btn_wrap">
                                            <button type="button" class="btn btn_red2 btn_large">
                                                거절
                                            </button>
                                            <button type="button" class="btn btn_color2 btn_large">
                                                수락
                                            </button>
                                        </div>
                                    </div><!--thm-->
                                    <div class="thm">
                                        <div class="info">
                                            <a href="<?php echo G5_BBS_URL ?>/job_view.php">
                                                <div><a class="txt_color">기업 정보<i class="fa-regular fa-chevron-right"></i></a></div>
                                                <div class="tit">[업체명] 채팅 요청</div>
                                            </a>
                                        </div>
                                        <div class="btn_wrap">
                                            <button type="button" class="btn btn_red2 btn_large">
                                                거절
                                            </button>
                                            <button type="button" class="btn btn_color2 btn_large">
                                                수락
                                            </button>
                                        </div>
                                    </div><!--thm-->
                                    <div class="thm">
                                        <div class="info">
                                            <a href="<?php echo G5_BBS_URL ?>/job_view.php">
                                                <div><a class="txt_color">기업 정보<i class="fa-regular fa-chevron-right"></i></a></div>
                                                <div class="tit">[업체명] 연락처 요청</div>
                                            </a>
                                        </div>
                                        <div class="btn_wrap">
                                            <button type="button" class="btn btn_gray3 btn_large" disabled>
                                                거절된 요청
                                            </button>
                                        </div>
                                    </div><!--thm-->
                                    <div class="thm">
                                        <div class="info">
                                            <a href="<?php echo G5_BBS_URL ?>/job_view.php">
                                                <div><a class="txt_color">기업 정보<i class="fa-regular fa-chevron-right"></i></a></div>
                                                <div class="tit">[업체명] 채팅 요청</div>
                                            </a>
                                        </div>
                                        <div class="btn_wrap">
                                            <button type="button" class="btn btn_color2 btn_large">
                                                채팅으로 이동
                                            </button>
                                        </div>
                                    </div><!--thm-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--내 이력서-->
                    <div id="tab-content4" class="tab-content">
                        <div id="my_jobs">
                            <div class="list">
                                <h3 class="date">24.08.08 (월)</h3>
                                <div class="thm" >
                                    <div class="info">
                                        <div class="flex ai-c gap5">
                                            <span class="icon icon_color">대표 이력서</span>
                                            <h6 class="txt_color">관심 분야 | 디자인/웹개발</h6>
                                        </div>
                                        <div class="tit" onclick="location.href='<?php echo G5_BBS_URL ?>/job_want_view.php'">이력서 제목</div>
                                        <p class="flex ai-c">시 구 ·&nbsp;<b>성별 만나이</b>&nbsp;· 고용형태
                                            <button type="button" class="btn btn_line male-auto" onclick="location.href='<?php echo G5_BBS_URL ?>/job_want_form.php'">수정</button>
                                        </p>
                                    </div>
                                </div><!--thm-->
                                <h3 class="date">24.08.01 (월)</h3>
                                <div class="thm">
                                    <div class="info">
                                        <div class="flex ai-c gap5">
                                            <h6 class="txt_color">관심 분야 | 디자인/웹개발</h6>
                                        </div>
                                        <div class="tit" onclick="location.href='<?php echo G5_BBS_URL ?>/job_want_view.php'">이력서 제목</div>
                                        <p class="flex ai-c">시 구 ·&nbsp;<b>성별 만나이</b>&nbsp;· 고용형태
                                            <button type="button" class="btn btn_line male-auto" onclick="location.href='<?php echo G5_BBS_URL ?>/job_want_form.php'">수정</button>
                                            <button type="button" class="btn btn_color">대표 설정</button>
                                        </p>
                                    </div>
                                </div><!--thm-->
                            </div><!--list-->
                        </div>
                    </div>

                </div><!--//tabs-->
            </div>
        </section>
    </article>

    <script>

        function a_tab(id) {
            location.href = g5_bbs_url + "/my_jobs.php?tab="+id
        }

    </script>


<?php

include_once('./_tail.php');
?>