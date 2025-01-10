<style>
    #ctt {
        display: none;
    }

</style>

<div id="sub03_02" class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
    <? if(defined('_INDEX_')) {?>
    <? }else if($co_id == "sub03_02_main"){ ?>

    <div class="vedio_wrap">
        <video id="sub03_02_main" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub03_02_main.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                    poster: "../vedio/sub03_02_main_thumb.jpg",
                    controls: true,
                    preload: "auto",
                    responsive: true,
                    controlBar: {
                        playToggle: true,
                        pictureInPictureToggle: false,
                        remainingTimeDisplay: true,
                        progressControl: true,
                        qualitySelector: true,
                    },
                };
                var player = videojs('sub03_02_main', options);
                player.src([{
                    src: '../vedio/sub03_02_main.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>


   <div class="sub_main">
    <div class="inr">
        <!--       <div class="tit">We are IMC Linkers!</div>-->
        <div class=" banWrap grid3">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_01">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_mainban01.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        영아부
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_02">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_mainban02.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        유치부
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_03">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_mainban03.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        ISES
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
        </div>
        <div class="banWrap grid4">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_04">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_mainban04.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        드림1부
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_05">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_mainban05.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        드림2부
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_06">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_mainban06.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        중등부
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_07">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_mainban07.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        고등부
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
        </div>
    </div>

</div>
    <? }else if($co_id == "sub03_04_01"){ ?>

    <div id="sub03_04_01">
        <div class="menu_sec">

            <div class="inr">
                <div class="tit_wrap">
                    <h6>교육부 소개</h6>
                    <p>사진을 클릭하시면 해당 소개 페이지로 이동합니다</p>
                </div>
                <div class="menu_wrap">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_01">
                        <div class="img_plag">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_01_mainban.png" alt="">
                        </div>
                        <h6>영아부</h6>
                    </a>
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_02">
                        <div class="img_plag">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_02_mainban.png" alt="">
                        </div>
                        <h6>유치부</h6>
                    </a>
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_03">
                        <div class="img_plag">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_03_mainban.png" alt="">
                        </div>
                        <h6>ISES</h6>
                    </a>
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_04">
                        <div class="img_plag">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_04_mainban.png" alt="">
                        </div>
                        <h6>드림1부</h6>
                    </a>
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_05">
                        <div class="img_plag">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_05_mainban.png" alt="">
                        </div>
                        <h6>드림2부</h6>
                    </a>
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_06">
                        <div class="img_plag">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_06_mainban.png" alt="">
                        </div>
                        <h6>중등부</h6>
                    </a>
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_04_01#sub03_04_01_07">
                        <div class="img_plag">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_07_mainban.png" alt="">
                        </div>
                        <h6>고등부</h6>
                    </a>
                </div>
            </div>
        </div>

        <section id="sub03_04_01_01" class="sub03_04">
            <div class="inr">
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_01_mainban.png" alt="">
                </div>
                <div class="sub_layout">
                    <div class="titwrap">
                        <h3 class="point_color">영아부 예배 안내</h3>
                        <!--                    <p></p>-->
                    </div>
                    
                    <div class="btnwrap">
                        <a href="https://www.youtube.com/channel/UCk0vL3QomhBnpgfYF991qXg" target="_blank"><i class="fa-brands fa-youtube"></i><p>GO! 온라인예배</p></a>
                        <a onclick="alert('준비중입니다.')"><i class="fa-brands fa-instagram"></i><p>GO! 인스타그램</p></a>
                    </div>
                    <div class="conwrap">
                        <div class="grid_dl">
                            <dl>
                                <dt>예배시간</dt>
                                <dd>주일 오전 9:00 / 11:00</dd>
                            </dl>
                            <dl>
                                <dt>예배장소</dt>
                                <dd>임마누엘교회 본관 지하 1층 영아부실</dd>
                            </dl>
                            <dl>
                                <dt>담당사역자</dt>
                                <dd>이희우 사모</dd>
                            </dl>
                            <dl>
                                <dt>영아1부 부장</dt>
                                <dd>윤순옥 권사</dd>
                            </dl>
                            <dl>
                                <dt>영아2부 부장</dt>
                                <dd>김순천 권사</dd>
                            </dl>
                            <dl>
                                <dt>슬로건</dt>
                                <dd class="point_color">하나님 말씀으로 건강하게 자라나는 영아부(누가복음 2:40)</dd>
                            </dl>
                            <dl>
                            <dt>2024년 목표</dt>
                            <dd class="point_color">하나님의 말씀과 기도로 믿음의 기초를 쌓아 건강한 하나님의 자녀로 자라나는 영아부가 되겠습니다.</dd>
                            </dl>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section id="sub03_04_01_02" class="sub03_04">
            <div class="inr">
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_02_mainban.png" alt="">
                </div>
                <div class="sub_layout">
                    <div class="titwrap">
                        <h3 class="point_color">'하랑'유치부 예배 안내</h3>
                        <!--                    <p></p>-->
                    </div>
                    
                    <div class="btnwrap">
                        <a href="https://www.youtube.com/channel/UClHu8RfjHkimYUkG09nvAbA" target="_blank"><i class="fa-brands fa-youtube"></i><p>GO! 온라인예배</p></a>
                        <a onclick="alert('준비중입니다.')"><i class="fa-brands fa-instagram"></i><p>GO! 인스타그램</p></a>
                    </div>
                    <div class="conwrap">
                        <div class="grid_dl">
                            <dl>
                                <dt>예배시간</dt>
                                <dd>주일 오전 9:00 / 11:00</dd>
                            </dl>
                            <dl>
                                <dt>예배장소</dt>
                                <dd>임마누엘교회 본관 지하 1층 유치부실</dd>
                            </dl>
                            <dl>
                                <dt>담당사역자</dt>
                                <dd>유혜미 사모</dd>
                            </dl>
                            <dl>
                                <dt>유치1부 부장</dt>
                                <dd>이계춘 권사</dd>
                            </dl>
                            <dl>
                                <dt>유치2부 부장</dt>
                                <dd>김은주 집사</dd>
                            </dl>
                            <dl>
                                <dt>슬로건</dt>
                                <dd class="point_color">지혜 쏙쏙! 믿음 쑥쑥! 유치부(갈라디아서 1:7)</dd>
                            </dl>
                            <dl>
                            <dt>2024년 목표</dt>
                            <dd class="point_color">하나님을 아는 지혜로! 믿음이 자라고 믿음의 사람으로 자라가는 유치부가 되겠습니다.</dd>
                            </dl>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section id="sub03_04_01_03" class="sub03_04">
            <div class="inr">
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_03_mainban.png" alt="">
                </div>
                <div class="sub_layout">
                    <div class="titwrap">
                        <h3 class="point_color">ISES 예배 안내</h3>
                        <!--                    <p></p>-->
                    </div>
                    
                    <div class="btnwrap">
                        <a onclick="alert('준비중입니다.')"><i class="fa-brands fa-youtube"></i><p>GO! 온라인예배</p></a>
                        <a onclick="alert('준비중입니다.')"><i class="fa-brands fa-instagram"></i><p>GO! 인스타그램</p></a>
                    </div>
                    <div class="conwrap">
                        <div class="grid_dl">
                            <dl>
                                <dt>예배시간</dt>
                                <dd>주일 오전 11:00</dd>
                            </dl>
                            <dl>
                                <dt>예배장소</dt>
                                <dd>임마누엘교회 교육관 10층 드림1부실</dd>
                            </dl>
                            <dl>
                                <dt>담당사역자</dt>
                                <dd>유고은 목사</dd>
                            </dl>
                            <dl>
                                <dt>ISES 부장</dt>
                                <dd>조혜숙 권사</dd>
                            </dl>
                            <dl>
                                <dt>슬로건</dt>
                                <dd class="point_color">Children of God's Kingdom (마가복음 10:15)</dd>
                            </dl>
                            <dl>
                                <dt>2024년 목표</dt>
                                <dd class="point_color">기쁨의 언어로 하나님 나라를 증거하는 ISES가 되겠습니다.</dd>
                            </dl>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section id="sub03_04_01_04" class="sub03_04">
            <div class="inr">
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_04_mainban.png" alt="">
                </div>
                <div class="sub_layout">
                    <div class="titwrap">
                        <h3 class="point_color">드림1부 예배 안내</h3>
                        <!--                    <p></p>-->
                    </div>
                    
                    <div class="btnwrap">
                        <a href="https://www.youtube.com/@IMC-A.D.B" target="_blank"><i class="fa-brands fa-youtube"></i><p>GO! 온라인예배</p></a>
                        <a onclick="alert('준비중입니다.')"><i class="fa-brands fa-instagram"></i><p>GO! 인스타그램</p></a>
                    </div>
                    <div class="conwrap">
                        <div class="grid_dl">
                            <dl>
                                <dt>예배시간</dt>
                                <dd>주일 오전 9:00</dd>
                            </dl>
                            <dl>
                                <dt>온라인예배</dt>
                                <dd>주일 오전 9:00(현장예배 실시간 방송)</dd>
                            </dl>
                            <dl>
                                <dt>예배장소</dt>
                                <dd>임마누엘교회 교육관 10층 드림1부실</dd>
                            </dl>
                            <dl>
                                <dt>담당사역자</dt>
                                <dd>백승우 간사</dd>
                            </dl>
                            <dl>
                                <dt>드림1부 부장</dt>
                                <dd>이지영 집사</dd>
                            </dl>
                            <dl>
                                <dt>슬로건</dt>
                                <dd class="point_color">하나님이 사랑하는 드림1부(마태복음 3:16)</dd>
                            </dl>
                            <dl>
                                <dt>2024년 목표</dt>
                                <dd class="point_color">하나님의 사랑을 깨닫고 마음에 담아 이웃에게 전하는 드림1부가 되겠습니다.</dd>
                            </dl>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section id="sub03_04_01_05" class="sub03_04">
            <div class="inr">
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_05_mainban.png" alt="">
                </div>
                <div class="sub_layout">
                    <div class="titwrap">
                        <h3 class="point_color">드림2부 예배 안내</h3>
                        <!--                    <p></p>-->
                    </div>
                    
                    <div class="btnwrap">
                        <a onclick="alert('준비중입니다.')"><i class="fa-brands fa-youtube"></i><p>GO! 온라인예배</p></a>
                        <a href="https://www.instagram.com/imc_dream2/" target="_blank"><i class="fa-brands fa-instagram"></i><p>GO! 인스타그램</p></a>
                    </div>
                    <div class="conwrap">
                        <div class="grid_dl">
                            <dl>
                                <dt>예배시간</dt>
                                <dd>주일 오전 9:00</dd>
                            </dl>
                            <dl>
                                <dt>온라인예배</dt>
                                <dd>주일 오전 9:00(오프라인예배 실시간 방송)</dd>
                            </dl>
                            <dl>
                                <dt>예배장소</dt>
                                <dd>임마누엘교회 교육관 11층 드림2부실</dd>
                            </dl>
                            <dl>
                                <dt>담당사역자</dt>
                                <dd>김재은 사모</dd>
                            </dl>
                            <dl>
                                <dt>드림2부 부장</dt>
                                <dd>김현진 권사</dd>
                            </dl>
                            <dl>
                                <dt>슬로건</dt>
                                <dd class="point_color">하나님의 꿈을 이루는 드림2부 (이사야 35:1~2)</dd>
                            </dl>
                            <dl>
                                <dt>2024년 목표</dt>
                                <dd class="point_color">
                                    메마른 이 땅에 복음의 꽃을 피우는 드림2부가 되겠습니다.
                                </dd>
                            </dl>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section id="sub03_04_01_06" class="sub03_04">
            <div class="inr">
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_06_mainban.png" alt="">
                </div>
                <div class="sub_layout">
                    <div class="titwrap">
                        <h3 class="point_color">'Kingdom' 중등부 예배 안내</h3>
                        <!--                    <p></p>-->
                    </div>
                    
                    <div class="btnwrap">
                        <a href="https://www.youtube.com/channel/UCCdp2RDUe2peeUHhCF3v5tQ" target="_blank"><i class="fa-brands fa-youtube"></i><p>GO! 온라인예배</p></a>
                        <a href="https://www.instagram.com/imc_kingdom/" target="_blank"><i class="fa-brands fa-instagram"></i><p>GO! 인스타그램</p></a>
                    </div>
                    <div class="conwrap">
                        <div class="grid_dl">
                            <dl>
                                <dt>예배시간</dt>
                                <dd>주일 오전 9:00</dd>
                            </dl>
                            <dl>
                                <dt>온라인예배</dt>
                                <dd>주일 오전 9:00(오프라인예배 실시간 방송)</dd>
                            </dl>
                            <dl>
                                <dt>예배장소</dt>
                                <dd>임마누엘교회 본관 1층 베들레헴성전</dd>
                            </dl>
                            <dl>
                                <dt>담당사역자</dt>
                                <dd>박기은 간사</dd>
                            </dl>
                            <dl>
                                <dt>1학년 부장</dt>
                                <dd>이준미 권사</dd>
                            </dl>
                            <dl>
                                <dt>2학년 부장</dt>
                                <dd>장정희 권사</dd>
                            </dl>
                            <dl>
                                <dt>3학년 부장</dt>
                                <dd>김정은 권사</dd>
                            </dl>
                            <dl>
                                <dt>슬로건</dt>
                                <dd class="point_color">Kingdom 중등부(마태복음 6:33)</dd>
                            </dl>
                            <dl>
                                <dt>2024년 목표</dt>
                                <dd class="point_color">성령의 능력으로 가정, 학교, 교회를 하나님의 나라로 세워가는 중등부가 되겠습니다.</dd>
                            </dl>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section id="sub03_04_01_07" class="sub03_04">
            <div class="inr">
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_02_07_mainban.png" alt="">
                </div>
                <div class="sub_layout">
                    <div class="titwrap">
                        <h3 class="point_color">'Goding' 고등부 예배안내</h3>
                        <!--                    <p></p>-->
                    </div>
                    
                    <div class="btnwrap">
                        <a href="https://www.youtube.com/@imc5047/featured" target="_blank"><i class="fa-brands fa-youtube"></i><p>GO! 온라인예배</p></a>
                        <a onclick="alert('준비중입니다.')"><i class="fa-brands fa-instagram"></i><p>GO! 인스타그램</p></a>
                    </div>
                    <div class="conwrap">
                        <div class="grid_dl">
                            <dl>
                                <dt>예배시간</dt>
                                <dd>주일 오전 9:00</dd>
                            </dl>
                            <dl>
                                <dt>온라인예배</dt>
                                <dd>주일 오전 9:00(오프라인예배 실시간 방송)</dd>
                            </dl>
                            <dl>
                                <dt>예배장소</dt>
                                <dd>임마누엘교회 본관 지하1층 지하체육관</dd>
                            </dl>
                            <dl>
                                <dt>담당사역자</dt>
                                <dd>유고은 목사</dd>
                            </dl>
                            <dl>
                                <dt>1학년 부장</dt>
                                <dd>서주연 권사</dd>
                            </dl>
                            <dl>
                                <dt>2학년 부장</dt>
                                <dd>신미라 권사</dd>
                            </dl>
                            <dl>
                                <dt>3학년 부장</dt>
                                <dd>김성은 부장</dd>
                            </dl>
                            <dl>
                                <dt>슬로건</dt>
                                <dd class="point_color">GOD_ING 고등부(이사야 9:7)</dd>
                            </dl>
                            <dl>
                                <dt>2024년 목표</dt>
                                <dd class="point_color">
                                    하나님이 세워가시는 열방의 비추는 고등부가 되겠습니다.
                                </dd>
                            </dl>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>



    </div>
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <? } ?>
</div>
