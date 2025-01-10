<style>
    #ctt {
        display: none;
    }

</style>

<div id="sub03_01" class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
    <? if(defined('_INDEX_')) {?>
    <? }else if($co_id == "sub03_01_main"){ ?>

    <div class="vedio_wrap">
       <video id="sub03_01_main" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub03_01_main.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                    poster: "../vedio/sub03_01_main_thumb.jpg",
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
                var player = videojs('sub03_01_main', options);
                player.src([{
                    src: '../vedio/sub03_01_main.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>


    <div class="inr">
        <div class="header_text">
            <!--서브타이틀-->
            <h1>링커(Linkers)란?</h1>
            <!--서브타이틀-->

            <p>
                [LINK] ‘연결하다, 잇다’ 

                기성세대와 다음세대를 연결하는 자들, 세상과 교회를 연결하는 자들 이라는 의미로 
                우리 IMC는 청년들을 링커라 부릅니다.

                링커부에 오신 여러분을 환영합니다! 여러분과 교회 또한, 연결하는 링커가 되겠습니다.</p>
        </div>

    </div>

    <div class="sub03_01_sec sub_03_01_main">
        <div class="inr">
            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide01.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide02.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide03.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide04.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide05.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide06.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide07.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide08.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide09.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide10.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide11.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide12.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide13.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide14.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide15.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainslide16.png" alt=""></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="sub_main grid3">
       <div class="tit">We are IMC Linkers!</div>
        <div class="inr banWrap">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_03_01">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainban01.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        1링커
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_03_02">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainban02.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        2링커
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub03_03_03">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_mainban03.png" alt="">
                <div class="textWrap">
                    <h6>
                        <span class="go_linker">Go!</span>
                        3링커
                    </h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
        </div>
    </div>
    
    
    <? }else if($co_id == "sub03_03_01"){ ?>
    <div class="main_wrap">
        <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainban.png" alt="">
    </div>


    <div class="sub03_01_sec sub03_03_01">

        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1>1링커(age : 35~45)</h1>
                <!--서브타이틀-->

                <p>
                1링커는 사회 속 다양한 분야의 선배로서 더 많은 고민과 도전을 경험한 링커들로 구성되어 있습니다.
                때로는 시행착오를 겪고 있는 링커들에게 쉼터가 되어주고, 좋은 신앙인의 모델이 되기 위해 노력하며 
                성장해가고 있습니다.
                사회와 가정, 교회에서 우뚝 솟아있는 높은 산이 되기 보다 오름직한 동산이 되길 꿈꾸는 신앙 공동체! 
                1링커로 여러분을 초대합니다.    
                </p>
            </div>

        </div>
    </div>
    <div class="sub03_01_sec sub03_03_02">

        <div class="inr">

            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide01.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide02.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide03.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide04.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide05.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide06.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide07.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide08.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide09.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide10.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_01_mainslide11.png" alt=""></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="sub_03_sec sub03_03_03 btn_wrap">
        <div class="inr">
            <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=sub02_01_02" target="_blank">
                <p>새가족 등록</p>
                <i class="fa-solid fa-book-heart"></i>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=sub03_qna">
                <p>문의하기</p>
                <i class="fa-regular fa-messages-question"></i>
            </a>
            <a href="http://www.instagram.com" target="_blank">
               <p>인스타그램</p>
                <i class="fa-brands fa-instagram"></i>
            </a>
        </div>
    </div>
    
    
    <? }else if($co_id == "sub03_03_02"){ ?>
    <div class="main_wrap">
        <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainban.png" alt="">
    </div>


    <div class="sub03_01_sec sub03_03_01">

        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1>2링커(age : 27~34)</h1>
                <!--서브타이틀-->

                <p>
                2링커는 이제 사회의 구성원으로 살아가고 있는 링커들로 구성되어 있습니다.
                어엿한 사회인으로써 세상 속에서 어떤 그리스도인의 모습으로 살아가는 것이 건강한 신앙인인가를 함께 나누며 
                성장해가고 있습니다.
                링커중의 링커! 건강한 성장공동체! 2링커로 여러분을 초대합니다.
                </p>
            </div>

        </div>
    </div>
    <div class="sub03_01_sec sub03_03_02">

        <div class="inr">

            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide01.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide02.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide03.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide04.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide05.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide06.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide07.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide08.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide09.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide10.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide11.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_02_mainslide12.png" alt=""></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="sub_03_sec sub03_03_03 btn_wrap">
        <div class="inr">
            <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=sub02_01_02" target="_blank">
                <p>새가족 등록</p>
                <i class="fa-solid fa-book-heart"></i>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=sub03_qna">
                <p>문의하기</p>
                <i class="fa-regular fa-messages-question"></i>
            </a>
            <a href="https://www.instagram.com/imc_l2v?igsh=MXNyd2x2amZ2OG9xYQ" target="_blank">
               <p>인스타그램</p>
                <i class="fa-brands fa-instagram"></i>
            </a>
        </div>
    </div>
    
    
    
    
    <? }else if($co_id == "sub03_03_03"){ ?>
    <div class="main_wrap">
        <img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_03_mainban.png" alt="">
    </div>


    <div class="sub03_01_sec sub03_03_01">

        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1>3링커(age : 20~26)</h1>
                <!--서브타이틀-->

                <p>
                3링커는 이제 성인이 되어 다양한 전공의 대학생활과 사회구성원이 되어가는 과정에 몸담고 있는 링커들로 구성되어 있습니다.
                성인으로서 건강한 신앙인이 되기 위한 건강한 고민과 노력을 함께 하며 성장해가고 있습니다.
                젊음으로 역동적인 믿음생활의 꽃을 피우는 3링커 공동체로 여러분을 초대합니다.
                </p>
            </div>

        </div>
    </div>
    <div class="sub03_01_sec sub03_03_02">

        <div class="inr">

            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_03_mainslide01.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_03_mainslide02.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_03_mainslide03.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_03_mainslide04.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_03_mainslide05.png" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub03/sub03_01_03_mainslide06.png" alt=""></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="sub_03_sec sub03_03_03 btn_wrap">
        <div class="inr">
            <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=sub02_01_02" target="_blank">
                <p>새가족 등록</p>
                <i class="fa-solid fa-book-heart"></i>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=sub03_qna">
                <p>문의하기</p>
                <i class="fa-regular fa-messages-question"></i>
            </a>
            <a href="https://www.instagram.com/imc_3linkers?igsh=NzJzb3A0OHlyd2Zr" target="_blank">
               <p>인스타그램</p>
                <i class="fa-brands fa-instagram"></i>
            </a>
        </div>
    </div>
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <? } ?>
</div>
