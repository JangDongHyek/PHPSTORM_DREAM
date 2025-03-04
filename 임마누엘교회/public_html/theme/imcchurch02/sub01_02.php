
<link href="<?php echo G5_THEME_URL; ?>/skin/submenu/basic/style.css" rel="stylesheet" type="text/css">
<div class="sub_margin">
<div class="sub_nav">
    <section>
        <div id="left">
            <dl>
                <div class="dd">
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01" class="" target=""><i class="fa-solid fa-arrow-left"></i></a></dd>
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_02" class="<?php if($co_id == "sub01_02"){ echo "on";}?>" target="">담임목사</a></dd>
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_02_02" class="<?php if($co_id == "sub01_02_02"){ echo "on";}?>" target="">부교역자</a></dd>
                    <dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub01_02_03" class="<?php if($co_id == "sub01_02_03"){ echo "on";}?>" target="">장로소개</a></dd>
                    </div>
            </dl>
        </div><!--#left-->
    </section>
</div>
</div>
<div id="sub01_01" class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
    <? if(defined('_INDEX_')) {?>
    <? }else if($co_id == "sub01_02"){ ?>
    <section id="sub01_01" class="sub01_01_01">
        <div class="inr">
            <div class="img_wrap">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub01_01_01.jpg" alt="">
            </div>
            <div class="sub_layout">
                <div class="titwrap">
                    <h3><span>담임목사</span>김정국</h3>
                </div>
                <div class="conwrap">
                    <div class="grid_dl">
                        <dl>
                            <dt>강원도 평창 중학교</dt>
                            <dt>미국 Claremont 고등학교</dt>
                            <dt>Azusa Pacific University 수료 (종교철학)</dt>
                            <dt>Southern Cross College 수료 (신학과)</dt>
                            <dt>Western Sydney University 졸업 (Sociology / Communication)</dt>
                            <dt>협성대학교 대학원 졸업 (기독교 교육)</dt>
                            <dt>Claremont 대학원 실천신학 박사과정</dt>
                            <dt>해병대 수색대 719기</dt>
                            <dt>2004~2008 홍천 서지방 삼포교회 담임</dt>
                            <dt>2008~ 임마누엘교회 담임</dt>
                            <dt>2023~ 서울남연회 제20대 송파지방 감리사</dt>
                        </dl>
                    </div>
                </div>

                <div class="conslide">

                    <div class="swiper sub-slider">
                        <div class="swiper-wrapper">
                            <?php for($i=1;$i<10;$i++){?>
                                <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub01_01/00<?php echo $i ?>.jpg" alt=""></div>
                            <?php }?>
                            <?php for($i=10;$i<46;$i++){?>
                                <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub01_01/0<?php echo $i ?>.jpg" alt=""></div>
                            <?php }?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <script>
                    var swiper = new Swiper(".sub-slider", {
                        slidesPerView: 2,
                        spaceBetween: 10,
                        autoHeight: true,
                        loop :true,
                        pagination: {
                            el: ".swiper-pagination",
                            type: "fraction",
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 2,
                                spaceBetween: 10,
                            },
                            768: {
                                slidesPerView: 4,
                                spaceBetween: 10,
                            },
                            1024: {
                                slidesPerView: 6,
                                spaceBetween: 10,
                            },
                        },
                    });
                </script>
            </div>
        </div>
    </section>

    <? }else if($co_id == "sub01_02_02"){ ?>
    <section class="sub sub01_01_02">
        <div>
            <div class="inr v2">
                <h2>부목사</h2>
                <ul class="grid3">
                    <li class="first">
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/01_sub01_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>김다니엘 <span>목사</span></h3>
                            <p>기획 / 링커부 / 정보문서선교부</p>
                            <p>전화 : (내선)224,213 / (직통)070-4172-5690,5664</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/02_sub01_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>이두희 <span>목사</span></h3>
                            <p>4,12교구 / 2남선교회 / 7남선교회 / 의료·이미용선교회</p>
                            <p>전화 : (내선)268 / (직통)070-4172-5683</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/03_sub01_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>안준호 <span>목사</span></h3>
                            <p>5,9교구 / 8남선교회 / 스포츠선교부 / 예배부</p>
                            <p>전화 : (내선)210 / (직통)070-4172-5666</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/04_sub01_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>김준식 <span>목사</span></h3>
                            <p>7,10교구 / 아브라함선교회 / 1남선교회</p>
                            <p>전화 : (내선)207 / (직통)070-4172-5663</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/05_sub01_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>김준혁 <span>목사</span></h3>
                            <p>3,11교구 / 3남선교회 / 5남선교회 / IMC전도부</p>
                            <p>전화 : (내선)244 / (직통)02-2202-3035</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/06_sub01_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>문준영 <span>목사</span></h3>
                            <p>1,8교구 / 6남선교회 / 11남선교회 / 미술선교회</p>
                            <p>전화 : (내선) 412 / (직통) 070-4172-5677</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/07_sub01_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>박기의 <span>목사</span></h3>
                            <p>2,6교구 / 모세선교회 / 4남선교회 / 새가족부</p>
                            <p>전화 : (내선)222 / (직통)070-4172-5673</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <div class="inr v2">
                <h2>교육부</h2>
                <ul class="grid3">
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/01_sub01_02_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>유고은 <span>목사</span></h3>
                            <p>고등부</p>
                            <p>전화 : (내선) 219 / (직통) 070-4172-5665</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/02_sub01_02_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>박기은 <span>간사</span></h3>
                            <p>중등부</p>
                            <p>전화 : (내선) 412 / (직통) 070-4172-5677</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/03_sub01_02_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>김재은 <span>사모</span></h3>
                            <p>드림2부</p>
                            <p>전화 : (내선) 219 / (직통) 070-4172-5665</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/04_sub01_02_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>백승우 <span>간사</span></h3>
                            <p>드림1부</p>
                            <p>전화 : (내선) 413 / (직통) 070-4172-568</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/05_sub01_02_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>유혜미 <span>사모</span></h3>
                            <p>유치부</p>
                            <p>전화 : (내선)223 / (직통) 070-4172-5669</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/06_sub01_02_02_02.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>이희우 <span>사모</span></h3>
                            <p>영아부</p>
                            <p>전화 : (내선) 288 / (직통) 070-4172-5682</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <div class="inr v2">
                <h2>전도사</h2>
                <ul class="grid3">
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/01_sub01_02_02_03.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>장금록 <span>전도사</span></h3>
                            <p>3,4,5,6교구 / 2,5,8,11여선교회</p>
                            <p>전화 : (내선) 217 / (직통) 070-4172-5675</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/02_sub01_02_02_03.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>김혜란 <span>전도사</span></h3>
                            <p>2,7,9,10교구 / 마리아,3,6,9,12여선교회</p>
                            <p>전화 : (내선) 216 / (직통) 070-4172-5671</p>
                        </div>
                    </li>
                    <li>
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/03_sub01_02_02_03.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>황은영 <span>전도사</span></h3>
                            <p>1,8,11,12교구 / 사라,1,4,7,10여선교회</p>
                            <p>전화 : (내선) 410 / (직통) 070-4172-5672</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <div class="inr v2">
                <h2>찬양사역자</h2>
                <ul class="grid3">
                    <li class="first">
                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub/01_sub01_02_04.jpg" alt="">
                        </div>
                        <div class="titwrap">
                            <h3>유주현 <span>리더<br>IMC 워십팀 리더</span></h3>
                            <p>IMC Worship</p>
                            <p>전화 : (내선) 414 / (직통) 070-4172-5723</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <? }else if($co_id == "sub01_02_03"){ ?>
    <div class="sub sub01_01_03">
        <div class="inr v2">
            <h2>헌신장로</h2>
            <ul class="grid4">
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/01_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 중 욱<span>장로</span></h3>
                        <p>2교구</p>
                        <p>예배부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/02_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>고 광 덕<span>장로</span></h3>
                        <p>12교구</p>
                        <p>경조1부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/03_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>황 기 석<span>장로</span></h3>
                        <p>3교구</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/04_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>조 남 수<span>장로</span></h3>
                        <p>11교구</p>
                        <p>장학부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/05_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>류 근 선<span>장로</span></h3>
                        <p>11교구</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/06_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>박 현 종<span>장로</span></h3>
                        <p>3교구</p>
                        <p>해외선교부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/07_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>정 봉 순<span>장로</span></h3>
                        <p>1교구</p>
                        <p>전도부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/08_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>이 정 희<span>장로</span></h3>
                        <p>5교구</p>
                        <p>새가족부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/09_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 희 권<span>장로</span></h3>
                        <p>10교구</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/10_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 해 동<span>장로</span></h3>
                        <p>6교구</p>
                        <p>경조1부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/11_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>전 은 석<span>장로</span></h3>
                        <p>6교구</p>
                        <p>전도부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/12_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>박 상 만<span>장로</span></h3>
                        <p>9교구</p>
                        <p>정보문서선교부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/13_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 수 항<span>장로</span></h3>
                        <p>8교구</p>
                        <p>재무부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/14_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>최 승 석<span>장로</span></h3>
                        <p>7교구</p>
                        <p>관리부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/15_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>이 준 우<span>장로</span></h3>
                        <p>4교구</p>
                        <p>사회부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/16_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>심 현 보<span>장로</span></h3>
                        <p>9교구</p>
                        <p>링커부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/17_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>박 한 빈<span>장로</span></h3>
                        <p>12교구</p>
                        <p>스포츠선교부,경조2부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/18_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>강 인 규<span>장로</span></h3>
                        <p>1교구</p>
                        <p>문화부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/19_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>문 성 철<span>장로</span></h3>
                        <p>7교구</p>
                        <p>특수선교부 부장</p>
                    </div>
                </li>
                <!--li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/20_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>박 경 호<span>장로</span></h3>
                        <p>5교구</p>
                    </div>
                </li-->
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/21_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 수 락<span>장로</span></h3>
                        <p>2교구</p>
                        <p>경조2부 부장</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/22_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>한 재 갑<span>장로</span></h3>
                        <p>8교구</p>
                        <p>재무부 총무</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/23_sub01_03_01.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>한 수 환<span>장로</span></h3>
                        <p>4교구</p>
                        <p>교육부 부장</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="inr v2">
            <h2>원로장로</h2>
            <ul class="grid4">
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/01_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>유 진 철<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/02_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>이 기 원<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/03_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>우 철 수<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/04_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>이 화 남<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/05_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 종 림<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/06_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 남 용<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/07_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>이 세 웅<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/08_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 광 수<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/09_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>한 상 용<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/10_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>장 만 준<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/11_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>임 한 규<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/12_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>박 현 덕<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/13_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 재 준<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/14_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>심 부 일<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/15_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>박 경 자<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/16_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>서 옥 순<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/17_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 봉 택<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/18_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>윤 석 구<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/19_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>박 재 명<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/20_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>권 중 량<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/21_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 성 열<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/22_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 용 일<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/23_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 부 규<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/24_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 형 식<span>장로</span></h3>
                        <p>(명예장로)</p>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/25_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>염 정 식<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/26_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>이 재 용<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/27_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>이 일<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/28_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 복 산<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/29_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>장 석 록<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/30_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 종 희<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/31_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>윤 천 영<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/32_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>정 현 모<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/33_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 기 정<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/34_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>지 석 문<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/35_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>한 상 원<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/36_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>박 남 필<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/37_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 기 중<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/38_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>이 성 희<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/39_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>주 항 수<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/40_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>정 상 근<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/41_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>정 성 수<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/42_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 현 용<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/43_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 재 선<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/44_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>진 창 기<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/45_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>최 창 환<span>장로</span></h3>
                    </div>
                </li>
                <li>
                    <div class="img_wrap">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/46_sub01_03_02.jpg" alt="">
                    </div>
                    <div class="titwrap">
                        <h3>김 채 숙<span>장로</span></h3>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <? }else if($bo_table == "" || $co_id == ""){ ?>
<? } ?>
</div>