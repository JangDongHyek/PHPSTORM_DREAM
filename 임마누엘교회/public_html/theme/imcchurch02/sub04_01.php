<style>
    #ctt {
        display: none;
    }

</style>

<div id="sub04_01" class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
    <? if(defined('_INDEX_')) {?>
    <? }else if($co_id == "sub04_01_main"){ ?>

    <div class="vedio_wrap">
       <video id="sub04_01_main" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub04_01_main.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                    poster: "../vedio/sub04_01_main_thumb.jpg",
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
                var player = videojs('sub04_01_main', options);
                player.src([{
                    src: '../vedio/sub04_01_main.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>


    <div class="inr">
        <div class="header_text">
            <!--서브타이틀-->
            <h1>모레는 세계!</h1>
            <!--서브타이틀-->

            <p>
                임마누엘교회는 선교하는 교회로서의 사명으로
                1984년 아르헨티나를 시작으로 방글라데시와 탄자니아에 연이어 선교사를 파송하였습니다.
                1990년부터 ‘오늘은 강남, 내일은 한국, 모레는 세계’라는 선교 구호 아래
                브라질 아마존, 중국, 케냐, 사이판에 선교사를 파송하였고,
                이후 현재까지 말레이시아, 필리핀, 캄보디아로 해외선교의 현장을 확장해 나가고 있습니다.
                해외선교의 지경을 넓히는 김정국 담임목사의 목회비전과 함께
                임마누엘 성도들의 기도와 헌신으로 임마누엘교회는 하나님의 지상명령에 순종하며 나아가고 있습니다.</p>
        </div>

    </div>

    <div class="menu_sec">

        <div class="inr">
            <div class="tit_wrap">
                <h6>해외선교지 소개</h6>
                <p>국기를 클릭하시면 해당 국가의 선교지 소개 페이지로 이동합니다</p>
            </div>
            <div class="menu_wrap">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_kenya">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" alt="">
                    </div>
                    <h6>KENYA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_tan">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" alt="">
                    </div>
                    <h6>TANZANIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_malay">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" alt="">
                    </div>
                    <h6>MALAYSIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_sai">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" alt="">
                    </div>
                    <h6>SAIPAN</h6>
                </a>
                <?/*a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_phili">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_phili.png" alt="">
                    </div>
                    <h6>PHILIPPINES</h6>
                </a*/?>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_cambo">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" alt="">
                    </div>
                    <h6>CAMBODIA</h6>
                </a>
            </div>
        </div>
    </div>

    <div class="sub_main grid2">
        <div class="inr banWrap">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_01">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_main_img01.jpg" alt="">
                <div class="textWrap">
                    <h6>1인1구좌 후원하기</h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=sub04_01_board">
                <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_main_img02.jpg" alt="">
                <div class="textWrap">
                    <h6>해외선교소식</h6>
                    <p>더 알아보기<i class="fa-solid fa-arrow-up-right"></i></p>
                </div>
            </a>
        </div>
    </div>
    <? }else if($co_id == "sub04_01_kenya"){ ?>
    <div class="vedio_wrap">
       <video id="sub04_01_kenya" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub04_01_kenya.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                     poster: "../vedio/sub04_01_kenya_thumb.jpg",
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
                var player = videojs('sub04_01_kenya', options);
                player.src([{
                    src: '../vedio/sub04_01_kenya.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>


    <div class="sub04_01_sec kenya01">

        <div class="inr">
            <div class="tit_wrap">
                <h1>KENYA</h1>
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" class="icon">케냐 선교 개요</h6>

                <dl>
                    <dt>원로선교사</dt>
                    <dd>안찬호, 김정희 선교사</dd>

                    <dt>선교사</dt>
                    <dd>서충만, 송미주 선교사</dd>

                    <dt>기술전문대학교수</dt>
                    <dd>김세곤, 박태숙 선교사</dd>

                    <dt>선교지</dt>
                    <dd>동아프리카 케냐 맛사이 부족</dd>

                    <dt>최초파송일</dt>
                    <dd>1991년 3월 18일</dd>
                </dl>
            </div>
            <div class="box_wrap">
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_img01.jpg" alt="">
                    </div>
                    <h6>안찬호 선교사</h6>
                    <p>(1991~2024 은퇴)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_img02.jpg" alt="">
                    </div>
                    <h6>김정희 선교사</h6>
                    <p>(1991~2024 은퇴)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_img03.jpg" alt="">
                    </div>
                    <h6>서충만 선교사</h6>
                    <p>(2022~현재)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_img04.jpg" alt="">
                    </div>
                    <h6>송미주 선교사</h6>
                    <p>(2022~현재)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_img05.jpg" alt="">
                    </div>
                    <h6>김세곤 선교사</h6>
                    <p>(2018~2023)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_img06.jpg" alt="">
                    </div>
                    <h6>박태숙 선교사</h6>
                    <p>(2018~2023)</p>
                </div>
            </div>

            <div class="slide_wrap">

            </div>



        </div>
    </div>
    <div class="sub04_01_sec kenya02">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" class="icon">파송 당시 맛사이 부족 생활상</h6>
                <p>아프리카에서 가장 용맹한 맛사이 부족이 살고 있는 현 무쿠타니 지역은 파송 당시엔 외부로부터 완전히 폐쇄된 지역이었습니다.<br>제대로 된 의복도 없이 천 하나로 몸을 두른 채 온 몸을 소똥, 오줌, 짐승의 피로 물들였고, 창과 방패 및 칼을 지니고 다니며 유목민 생활을 하며 살아가던 곳이었습니다.<br>주택은 소똥으로 지은(보마)에서 살고 있었습니다. 30년이 지난 지금도 여전히 소똥 집에서 살고 있는 곳이 많지만 일부 지역에서는 주택 개량사업을 진행하고 있습니다.<br>맛사이 부족의 명맥을 이어가기 위해 일반적으로 한 남자가 2~3명의 부인을 두고, 경우에 따라 10명 이상의 부인과 함께 사는 일부다처제의 전통을 이어오던 부족이었습니다.<br>교육의 기초 자체가 없는 곳이었으며, 외부인 출입은 절대 금기시 되어 마사이 부족을 지키는 ‘모란’이라는 젊은 전사들이 부족을 지키고 있었습니다.<br>이렇게 문명사회와 동떨어져 살아가고 있던 맛사이 땅에 안찬호, 김정희 선교사를 통해 복음의 씨앗이 뿌려지게 되었습니다.</p>
            </div>

            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide01.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide02.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide03.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide04.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide05.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide06.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide07.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide08.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide09.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide10.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide11.JPG" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide12.JPG" alt=""></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="sub04_01_sec kenya03">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" class="icon">케냐 선교현황</h6>

                <dl>
                    <dt>중고등학교</dt>
                    <dd>감리교 엘레라이 여자중고등학교, 임마누엘 남자중고등학교, 임부코 웨슬리 종합중고등학교</dd>

                    <dt>기술전문대학</dt>
                    <dd>자동차 정비학과, 의상학과, 제빵학과, 컴퓨터학과</dd>
                </dl>
            </div>
            <div class="box_wrap">
                <div class="box">
                    <div class="num_count" style="">
                        33
                    </div>
                    <h6>설립된 지역교회</h6>
                </div>
                <div class="box">
                    <div class="num_count" style="background:#C00000">
                        38
                    </div>
                    <h6>맛사이 현지목회자</h6>
                </div>
                <div class="box">
                    <div class="num_count" style="background:#00B050">
                        30
                    </div>
                    <h6>유치원</h6>
                </div>
                <div class="box">
                    <div class="num_count" style="">
                        27
                    </div>
                    <h6>초등학교</h6>
                </div>
                <div class="box">
                    <div class="num_count" style="background:#C00000">
                        3
                    </div>
                    <h6>중고등학교</h6>
                </div>
                <div class="box">
                    <div class="num_count" style="background:#00B050">
                        1
                    </div>
                    <h6>기술전문대학</h6>
                </div>
            </div>


            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide13.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide14.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide15.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide16.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide17.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide18.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide19.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide20.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide21.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide22.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide23.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_kenya_slide24.jpg" alt=""></li>
                </ul>
            </div>



        </div>
    </div>

    <div class="menu_sec">

        <div class="inr">
            <div class="tit_wrap">
                <h6>해외선교지 소개</h6>
                <p>국기를 클릭하시면 해당 국가의 선교지 소개 페이지로 이동합니다</p>
            </div>
            <div class="menu_wrap">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_kenya">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" alt="">
                    </div>
                    <h6>KENYA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_tan">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" alt="">
                    </div>
                    <h6>TANZANIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_malay">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" alt="">
                    </div>
                    <h6>MALAYSIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_sai">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" alt="">
                    </div>
                    <h6>SAIPAN</h6>
                </a>
                <?/*a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_phili">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_phili.png" alt="">
                    </div>
                    <h6>PHILIPPINES</h6>
                </a*/?>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_cambo">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" alt="">
                    </div>
                    <h6>CAMBODIA</h6>
                </a>
            </div>
        </div>
    </div>
    <? }else if($co_id == "sub04_01_tan"){ ?>
    <div class="vedio_wrap">
       <video id="sub04_01_tan" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub04_01_tan.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                     poster: "../vedio/sub04_01_tan_thumb.jpg",
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
                var player = videojs('sub04_01_tan', options);
                player.src([{
                    src: '../vedio/sub04_01_tan.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>


    <div class="sub04_01_sec tan01">

        <div class="inr">
            <div class="tit_wrap">
                <h1>TANZANIA</h1>
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" class="icon">탄자니아</h6>

                <dl>
                    <dt>선교사</dt>
                    <dd>유제영, 故 마문구 선교사</dd>

                    <dt>선교지</dt>
                    <dd>동아프리카 탄자니아</dd>

                    <dt>최초파송일</dt>
                    <dd>1984년 10월</dd>
                </dl>
            </div>
            <div class="box_wrap">
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_img01.jpg" alt="">
                    </div>
                    <h6>유제영 선교사</h6>
                    <p>(1984~현재)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_img02.jpg" alt="">
                    </div>
                    <h6>故 마문구 선교사</h6>
                    <p>(1984~2017 소천)</p>
                </div>
            </div>

            <div class="slide_wrap">

            </div>



        </div>
    </div>
    <div class="sub04_01_sec tan02">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" class="icon">파송 과정 및 배경</h6>
                <p>1980년대 초반, 아세아연합신학대학교는 제3세계 젊은이들을 초청하여 신학공부를 할 수 있는 기회를 제공하기 시작했습니다.<br>더불어 국내의 교회들과 연결하여 한국교회를 배우게 하며, 한국교회의 장학금으로 받으며 공부하여 수료한 후에는 자국으로 돌아가 현지인으로서 자국을 복음화 하게하는 프로젝트였습니다.<br>1981년 탄자니아의 중,고등학교에서 수학교사로 재직하던 매튜 비아문구(MathewByamungu, 한국식 이름 : 마문구) 청년이 아세아연합신학대학교에서 먼저 초청한 케냐의 학생이 오지 않게 되자 대체 선발 되었고, 임마누엘교회(당시 강남제일교회)와 연결이 되었습니다.<br>1984년 6월, 마문구 청년은 임마누엘교회를 통해 4년 간의 장학금 및 용돈을 지원 받으며 무사히 신학공부를 마치게 되었습니다. <br>
                    또한 당시 학교에서 일하던 유제영 전도사(아세아연합신학대학 선교실 총무)와 교제하게 되고, 집안의 반대를 극복한 후 임마누엘교회에서 김국도 목사님의 주례와 성도들의 축복 속에 결혼예배를 올리게 되었고, 그해 10월에 탄지니아 선교사로 함께 파송을 받았습니다.</p>
            </div>

        </div>
    </div>
    <div class="sub04_01_sec tan03">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" class="icon">탄자니아감리교의 태동</h6>
                <p>탄자니아 선교사로 파송을 받은 초기에 마문구 선교사가 한국으로 유학 가기 전 신앙생활을 하였던 루터교회가 아세아연합신학대학에서 수학한 학력을 인정하여 주어서 루터교에서 목사 안수를 받고 두 곳의 교회를 맡아 4년 동안 섬기게 되었습니다.<br>그러던 중 둘째 자녀를 출산한 이후 유제영 선교사의 건강이 악화되어 한국으로 귀국하게 되었고, 의사의 권고로 장기요양이라는 소견이 나오게 되자 마문구 선교사는 임마누엘교회의 지원을 받아 감리교 협성신학대학원에서 공부를 하게 되었습니다.<br>
                    1991년 2월에 협성신학대학원을 졸업하고, 3월에 대한기독교감리교회에서 외국인으로서는 처음으로 남연회에서 목사 안수를 받게 되었습니다.<br>
                    이후 건강을 회복한 유제영 선교사와 함께 다시 탄자니아로 복귀하여 1991년 6월에 탄자니아 정부에 탄자니아감리교회를 등록하고, 마문구 선교사가 세를 들어 살던 집의 거실에서 마문구 선교사의 가족 및 함께한 몇명의 친구들과 함께 1991년 6월 25일 탄자니아감리교회를 시작하는 첫 예배를 드리게 되었습니다.</p>
            </div>

        </div>
    </div>
    <div class="sub04_01_sec tan04">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" class="icon">탄자니아 선교현황</h6>

                <dl>
                    <dt>탄자니아 감리교</dt>
                    <dd>1개 총회, 6개 연회, 11개 지방회</dd>

                    <dt>기술학교</dt>
                    <dd>영어반, 컴퓨터반, 봉재반, 미용반</dd>
                </dl>
            </div>
            <div class="box_wrap">
                <div class="box">
                    <div class="num_count" style="background:#00B050">
                        166
                    </div>
                    <h6>설립된 교회</h6>
                </div>
                <div class="box">
                    <div class="num_count">
                        166
                    </div>
                    <h6>목회자</h6>
                </div>
                <div class="box">
                    <div class="num_count" style="background:#00B0F0">
                        34
                    </div>
                    <h6>유치원</h6>
                </div>
                <div class="box">
                    <div class="num_count" style="background:#00B050">
                        1
                    </div>
                    <h6>초등학교</h6>
                </div>
                <div class="box">
                    <div class="num_count">
                        1
                    </div>
                    <h6>신학대학</h6>
                </div>
                <div class="box">
                    <div class="num_count" style="background:#00B0F0">
                        1
                    </div>
                    <h6>기술대학</h6>
                </div>
            </div>



            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide01.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide02.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide03.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide04.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide05.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide06.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide07.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide08.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide09.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide10.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide11.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide12.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide13.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide14.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide15.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_tan_slide16.jpg" alt=""></li>
                </ul>
            </div>



        </div>
    </div>

    <div class="menu_sec">

        <div class="inr">
            <div class="tit_wrap">
                <h6>해외선교지 소개</h6>
                <p>국기를 클릭하시면 해당 국가의 선교지 소개 페이지로 이동합니다</p>
            </div>
            <div class="menu_wrap">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_kenya">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" alt="">
                    </div>
                    <h6>KENYA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_tan">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" alt="">
                    </div>
                    <h6>TANZANIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_malay">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" alt="">
                    </div>
                    <h6>MALAYSIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_sai">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" alt="">
                    </div>
                    <h6>SAIPAN</h6>
                </a>
                <?/*a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_phili">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_phili.png" alt="">
                    </div>
                    <h6>PHILIPPINES</h6>
                </a*/?>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_cambo">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" alt="">
                    </div>
                    <h6>CAMBODIA</h6>
                </a>
            </div>
        </div>
    </div>
    <? }else if($co_id == "sub04_01_malay"){ ?>
    <div class="vedio_wrap">
       <video id="sub04_01_malay" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub04_01_malay.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                     poster: "../vedio/sub04_01_malay_thumb.jpg",
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
                var player = videojs('sub04_01_malay', options);
                player.src([{
                    src: '../vedio/sub04_01_malay.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>


    <div class="sub04_01_sec malay01">

        <div class="inr">
            <div class="tit_wrap">
                <h1>MALAYSIA</h1>
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" class="icon">말레이시아 선교 개요</h6>

                <dl>
                    <dt>선교사</dt>
                    <dd>신정채, 송용석, 임인순, 홍성현선교사</dd>

                    <dt>선교지</dt>
                    <dd>말레이시아사라왁주</dd>

                    <dt>최초파송일</dt>
                    <dd>2004년 12월</dd>
                </dl>
            </div>
            <div class="box_wrap">
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_img01.jpg" alt="">
                    </div>
                    <h6>신정채 선교사</h6>
                    <p>(2004~현재)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_img02.jpg" alt="">
                    </div>
                    <h6>송용석 선교사</h6>
                    <p>(2004~현재)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_img03.jpg" alt="">
                    </div>
                    <h6>임인순 선교사</h6>
                    <p>(2004~현재)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_img04.jpg" alt="">
                    </div>
                    <h6>홍성현 선교사</h6>
                    <p>(2004~현재)</p>
                </div>
            </div>

            <div class="slide_wrap">

            </div>



        </div>
    </div>
    <div class="sub04_01_sec malay02">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" class="icon">말레이시아선교 History</h6>
                <p>말레이시아 사라왁주를 중심으로 사역하고 있는 신정채 선교사는 현재 Good Harvest Tranning Center 원주민 신학교 및 농업학교를 운영하면서 약 130명의 졸업생을 배출하고, 말레이시아의 Sunbeams Home 고아원과 인도네시아의 Betheaida Home 고아원을 현지 동역자들과 함께 운영하고 있습니다.<br>
                    <br>말레이시아뿐 아니라 인도네시아 수마트라섬까지 선교지를 확장하여, 주로 밀림의 원주민 부족들을 대상으로 선교사역을 펼치고 있습니다.<br>
                    <br>근래에는 동말레이시아 사라왁주 Lemenak River 교회 개척사역을 진행하여 원주민 500여명에게 세례를 베풀었고, 7개 마을의 지도자 30여명에게 집중적인 신앙 훈련을 시키고 있습니다.
                </p>
            </div>

            <div class="sub_wrap">
                <h6>1.Orang Asli in Malaysia 원주민 사역<br class="hidden-xs">(1996년도 시작)</h6>
                <p>Orang Asli 원주민은 서말레이시아에서 가장 오래 거주한 종족이며, 약 12 만 명 정도로 정글 깊은 지역에서 거주하며, 수렵, 채집, 고무농장, 팜 오일 농장의 일일 근로자로 살아가고 있습니다.<br>
                    이들은 대부분 자연종교를 믿고 있었으나 이슬람 정부의 적극적인 지원과 이슬람교의 공격적인 전도로 이슬람교로 개종한 이들이 최근에 많이 늘고 있고, 말레이시아 내 기독교 원주민 사역자의 꾸준한 노력으로 기독교로 개종한 인원이 점점 늘고 있는 추세입니다.<br>
                    Orang Asli 원주민들이 거주하는 지역을 접근하기 위해선 Jabatan Orang Asli (정부 산하 원주민지역 관리 사무소)의 허가를 받아야 해서 외국인 선교사의 활동이 제한적일 수 밖에 없습니다.<br>2003년 6월에 서말레이시아 중북부지역 파수마을에 교회를 건축하기 시작해서 9월 말 98%의 교회 건축 공정을 마쳤습니다.<br><br>
                    2003년 9월 30일 오전 9시 정부관공서 직원과 이슬람교도들(25명)은 7대의 차량(포크레인 1대 포함)을 동원해서 교회를 완전히 파괴시키고 달아났습니다. 이 사실을 곧바로 경찰서에 신고 하였고, NECF (말레이시아 복음주의 협의회)에 보고하였습니다.<br>
                    NECF에서는 변호사를 파견해 주어서 교회를 파괴한 정부행정기관을 향해서 재판을 진행시킨 결과 2004년 7월에 재판에서 승리를 거두었습니다. 이 일은 말레이시아에서 최초의 일이었습니다.<br>
                    2004년 8월 7일, 파수교회(이슬람세력에 의해서 파괴된 교회)의 재건축을 하기 위해 기공예배를 드렸습니다. 정부는 법원의 판결에 따라 복구비용을 저희에게 지불해야 함에도 불구하고 지불 연기로 건축이 잠시 중단되었으나 최근에 다시 공사를 진행한 결과 99% 공정을 한 상황입니다.<br>
                    말레이시아의 파항주 내 Jerantut 도심과 인근 원주민 지역을 중심으로 지속적인 선교지역이 확장되고 있습니다.</p>
            </div>

            <div class="sub_wrap">
                <h6>2.고아원 사역</h6>
                <p>
                    <strong>① Sunbeams Home in Kuala Lumpur, Malaysia (1997년도 시작)</strong><br><br>
                    말레이시아 Sunbeams Home (고아원/원생 48명)은 이슬람권인 말레이시아 정부로부터 1999년 공식적인 허가를 받은 사회복지기관입니다.<br>
                    고아원 사역은 현지인들로부터 많은 호응을 받고 있다는 긍정적인 요소도 있지만 반드시 많은 재정적 도움을 오랜 기간 동안 지출해야 하고, 지속적으로 돌봐야 한다는 점을 생각해야 합니다.<br>
                    고아원 원생의 대부분은 마약 중독자의 자녀, 범죄자의 자녀, 결손가정의 자녀, 정신질환자의 자녀, 부모로부터 학대 받는 자녀들로 구성되어 있습니다.<br>
                    신정채 선교사는 네비게이트의 원리(자립화,현지화)를 적용해서 현지화를 꾸준히 이룬 결과 재정의 상당 부분(98%)을 현지에서 조달하고 있습니다. 물론 현지 사역자들의 피나는 노력과 헌신이 자립화의 초석이었고, 현지 화교들의 도움과 사랑, 관심이 자립화의 원동력이었다고 볼 수 있습니다.<br><br>
                    고아원 스스로 자체 내 음식바자회, 현지 회사로부터 공급 받은 물건의 판매, 고아원 원생의 훈련된 솜씨로 만든 간단한 수예품 판매, 고아원 기금마련을 위한 공연 등으로 자립화를 이루어가고 있습니다. 이러한 사회복지 사역이 어느 정도 자리를 잡으면 다음 단계로 이슬람권 백성들 속으로 들어가서 복음사역을 해야 합니다.<br>
                    고아원 사역은 이슬람교도과의 만남을 자연스럽게 할 수 있는 장이며, 선교사 신분을 사회적으로 유지하는데 상당한 도움을 주고 있습니다.<br>
                    현재 현지 사역자들은 목회자 4명, 기사 2명, 보모 10명으로 구성되어 3교대로 150명의 원생들을 은혜 중에 잘 돌보고 있으며, 선교사의 지도력을 현지인 지도자에게 완전히 이양하여 주었습니다.
                    <br><br><br>
                    <strong>② Bethsaida Home in Dumai, Indonesia (2000년도 시작)</strong><br><br>
                    인도네시아 수마트라섬 두마이 시내에 위치한 Bethsaida Home (고아원/원생 38명)은 이슬람권인 인도네시아 정부로부터 1999년도에 공식적으로 허가를 받은 사회복지기관입니다.<br>
                    이 고아원은 현지교회 구내에 자리를 하고 있어 현지 이슬람교도들로부터 많은 호평을 받고 있으며, 그로 말미암아 두마이 도심과 주변지역으로부터 교회의 위상을 한층 높여주었습니다.<br>
                    특히 고아원 원생의 대부분은 마약 중독자의 자녀, 범죄자의 자녀, 결손가정의 자녀, 정신질환자의 자녀, 부모로부터 학대받는 자녀들로 구성되어 있습니다.<br>
                    신정채 선교사는 현지화를 꾸준히 이룬 결과 재정의 상당 부분(80%)을 현지에서 조달하고 있습니다<br><br>
                    또한 고아원이 선교센타의 역할을 감당해 주어서 주변 해안 지역에 7개의 교회를 개척하게 되었습니다. 이처럼 교회를 개척하게 된 배경에는 사회복지 사역을 통해서 이슬람교도들과의 관계를 유지함과 동시에 이슬람권 백성들 속에서 복음을 증거해야한다는 입장을 늘 견지했기 때문에 가능했습니다.<br>
                    현재 현지 사역자들은 목회자 2명, 보모 3명으로 구성되어 헌신적으로 원생들을 돌보고 있으며 선교사의 지도력을 완전히 현지인 지도자에게 이양하여 주었습니다.
                </p>
            </div>

            <div class="sub_wrap">
                <h6>3.인도네시아 수마트라섬 내 <br class="hidden-xs">리아우주 두마이도심 주변의 해안선 사역 <br class="hidden-xs">(2000년도 시작)</h6>
                <p>수마트라섬 두마이도시는 말레이시아 말라카 항구도시에서 말라카 해협을 페리로 2시간 정도 가면, 두마이시에 도착합니다.<br>
                    수마트라섬 해안선 사역은 두마이 시내에 위치한 Bethsaida Home(고아원)을 선교센타로 활용해서 선교를 하고 있습니다.<br>
                    그 결과 주변 해안 지역에 7개의 교회를 개척 및 교회 건축을 완공케 되었습니다.<br>
                    (①Basilam Baru Church, ②Bukit Timah Church, ③Bukit Batrim Church, ④Jaya Muti Church, ⑤Duri Pematang Puduh Church, ⑥Pacit-pacit Church, ⑦Lubok Sakat Church)<br>
                    <br>
                    다만 Ujung Tanang Church의 교회 건축은 지난 2004년 2월부터 이슬람교도들의 방해로 인하여 벽 공사를 마친 이후, 중단된 상태 입니다.<br>
                    그들이 교회 건축을 방해하는 이유는 교회건축현장으로부터 1km 떨어진 지역에 이슬람성전을 짓고 있는데, 이슬람사원이 있는 마을 주변에 교회 건축을 하면 불지르거나 무너뜨리겠다는 그들의 협박 내용을 이미 경찰을 통해서 연락을 받은 바 있습니다. 그후로 아직까지 경찰서로부터 안전하다는 확답을 받지 못한 채 기다리고 있는 상황입니다.<br>

                    그럼에도 불구하고 두마이 도심과 해안 주변에서 사역하는 현지 동역자들의 노력과 헌신으로 꾸준히 지역교회는 성장하고 있습니다.
                </p>
            </div>

            <div class="sub_wrap">
                <h6>4.Good Harvest Center - <br class="hidden-xs">ORANG ASLI 원주민 평신도 훈련원 사역 <br class="hidden-xs">(2004년도 시작)</h6>
                <p>원주민 신학교는 Pahang주 Raub의 중국인 마을에 자리 잡고 있으며,쿠알라룸프르부터 차량으로 1시간 30분 거리에 떨어진 곳에 위치하고 있습니다.<br>
                    이 신학교는 2003년에 두리안 농장 4,500평을 구입하여 2004년 3월에 강당, 남녀 기숙사, 휴게실, 식당 등 건축공사를 마친 이후 매달 첫 주 마다 집중 교육을 실시하고 있습니다.<br>
                    원주민 신학교는 Gospel to the poor(가난한 자에게 복음을)교단 및 Siding Injil Borneo(보르네오 복음주의) 교단과 협력해서 초교파적으로 운영하고 있는데, 이 신학교를 통해 각 원주민 마을의 기도처와 교회에서 예배를 충분히 인도할 수 있는 평신도 지도자와 목회자를 양성하는 것이 목표입니다.<br>
                    2004년 4월부터 시작된 원주민 평신도 지도자 및 신학생 집중교육은 제12차 까지 은혜 중에 진행되고 있습니다. 매회 마다 오랑 아슬리 원주민이 120~150여명씩 참여하는 등 상당한 교육적 효과를 내고 있습니다. 중심적인 교육내용은 SIB 교단에서 파송한 교수들에 의해서 기본적인 성경을 학생들에게 가르쳐 주고 있고, 간단한 농업기술은 중국계 농민형제들을 통해서 원주민 지역에서 가능한 작물을 심고 가꾸고 거두는 법을 학생들에게 가르쳐 주고 있습니다.<br>
                    또한 신학교 내 강당, 식당, 휴게실, 남녀기숙사 시설의 완공 이후 부족한 공간-창고, 대형 냉장고와 식당을 현지 중국계 교회(Gospel To The Poor)의 후원으로 지었습니다. 학생 대부분이 결혼을 한 가장인지라 장학금, 식비, 교통비 등을 한국교회와 현지 중국계교회의 협력을 통해 감당하고 있습니다.
                </p>
            </div>

            <div class="sub_wrap">
                <h6>5.동말레이시아 사라왁(Sarawak)주 <br class="hidden-xs">이반족 사역</h6>
                <p>동말레이시아의 사라왁주는 칼리만탄섬 혹은 보르네오섬이라고도 불리며, 남부로는 인도네시아와 우측으로는 석유의 부국으로 알려진 부르나이 공화국, 동북쪽으로는 말레이시아의 사바주와 경계를 이루고 있습니다. 사라왁주는 다양한 소수 민족과 그들의 문화와 전통, 거대한 규모의 원시 정글로도 유명합니다.<br>
                    사라왁주에는 BIDAYU, ORANG ULU, IBAN, KENYAH, MALAY, CHINESE, INDIAN 종족이 있는데 이중 이반족이 75만명 정도로 규모가 가장 큽니다. 이들은 대부분 강가나 정글지역 내부의 LONG HOUSE에서 집단적으로 거주하고 있습니다.<br>
                    최근에는 교육을 받은 젊은이들이 대부분 일을 찾아 도심으로 이주해서 정착생활을 하고 있습니다. 이들의 촌락은 강 주변을 따라 형성되어있기 때문에 3-7인용 보트가 주요 교통수단입니다. 농촌에 거주하는 이들 대부분은 벼농사, 고무 채취, 후추농사를 주로 하고 있으며, 가정에서는 전통 수공예품을 만들어 도심의 가게에 납품을 하는 것이 이들의 생업수단입니다.<br>
                    2001년부터 동말레이시아 사라왁주 라와스(Lawas) 도심지역의 Lumbawang 부족들의 교회를 중심으로 부흥회 인도를 3년간 계속해 왔습니다. 그 결과 라와스 지역교회들은 자생력과 더불어 많은 성장을 가져와 새로운 전환점을 가져오게 되었습니다. 그 후 사라왁주에서 부족 인구수가 가장 많은 (사라왁 인구의 31%) 이반종족 선교에 대해 새로운 관심을 갖게 되었습니다.<br><br>
                    신정채 선교사는 2004년 9~10월에 두 차례에 걸쳐 사라왁 중부 지역을 현장답사하여 선교 가능한 지역을 조사한 이후, 2004년 12월부터 임마누엘교회의 집중적인 지원에 힘입어 (Lemanak River 주변의 18개 마을, Ulu Layar지역의 10개 마을, Betong 지역의 12개 마을, Kenawi 지역의 6개 마을, Stapang 지역의 8개 마을, Sg.Tau 지역의 5개 마을, Sg.Arip 지역 2개 마을, Sg.Kemena 지역 8개 마을, Sg Pinang 지역1개 마을, Ladang 3지역 6개 마을, Balingian 지역 5개 마을, Daro 지역 5개 마을 ) 합계 86개의 마을을 개척하여 3,800여명을 개종시켜 세례를 베풀었습니다.<br>
                    임마누엘교회에서는 동말레이시아 사라왁주 시부도시에 선교센타를 지어 이반족 평신도 훈련원을 개설하여 말레이시아 이반족 감리교회 평신도 지도자들을 초청하여 꾸준히 훈련시키고 있습니다.<br>
                    이 훈련원에서는 기초적인 성경과 기독교의 문화에 대해서 가르치고 있으며, 평신도에 의한 롱하우스 이반족 사역을 할 수 있도록 집중하고 있습니다.<br>
                    이반족 평신도 지도자 훈련원(CHURCH PLANTING INSTITUTE) 에서는 이반족 평신도 지도자 훈련을 두 달에 한 번씩 정기적으로 개설하여 지속적인 교육을 실시하고 있습니다. 이반족 평신도 지도자반의 지속적인 개설의 이유는 평신도 지도자 발굴(개발된 평신도는 부족한 목회자를 대신하여 사역을 하게 될 것입니다.), 기초적인 성경공부, 올바른 기독교 문화을 가르치는데 그 목적이 있습니다.
                </p>
            </div>
        </div>
    </div>
    <div class="sub04_01_sec malay03">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" class="icon">선교사역 결실의 배경</h6>
                <p>첫째는, 하나님의 크신 은혜요, 성령님의 역사하심입니다.<br>
                    <br>둘째는, 선교하고자 하는 김정국 담임목사님의 위대한 비전과 지구촌 끝까지 영혼을 구하고자 하는 전투적인 열정, 선교사를 향한 극진한 사랑과 돌보심, 친히 열악한 오지인 사라왁 정글 깊은 곳까지 찾아오는 선교팀들과 임마누엘 교우분들의 기도의 결과라 생각합니다.<br>
                    <br>셋째는, 말레이시아 선교지에서 요청하는 선교물품들(의약품)에 대해서 한국교회의 즉각적인 응답들이 말레이시아 사라왁 선교의 결실을 이루어낸 원인이라 생각합니다.<br>
                    <br>넷째는, 현장에서 뛰는 선교사와 현지 지역 교회의 협력과 한국교회의 기도와 후원이 강인하게 결합될 때 큰 결실을 얻었습니다.
                </p>
            </div>


            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide01.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide02.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide03.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide04.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide05.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide06.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide07.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide08.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide09.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide10.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide11.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide12.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide13.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide14.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide15.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide16.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide17.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide18.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_malay_slide19.jpg" alt=""></li>
                </ul>
            </div>



        </div>
    </div>

    <div class="menu_sec">

        <div class="inr">
            <div class="tit_wrap">
                <h6>해외선교지 소개</h6>
                <p>국기를 클릭하시면 해당 국가의 선교지 소개 페이지로 이동합니다</p>
            </div>
            <div class="menu_wrap">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_kenya">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" alt="">
                    </div>
                    <h6>KENYA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_tan">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" alt="">
                    </div>
                    <h6>TANZANIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_malay">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" alt="">
                    </div>
                    <h6>MALAYSIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_sai">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" alt="">
                    </div>
                    <h6>SAIPAN</h6>
                </a>
                <?/*a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_phili">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_phili.png" alt="">
                    </div>
                    <h6>PHILIPPINES</h6>
                </a*/?>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_cambo">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" alt="">
                    </div>
                    <h6>CAMBODIA</h6>
                </a>
            </div>
        </div>
    </div>
    <? }else if($co_id == "sub04_01_sai"){ ?>
    <div class="vedio_wrap">
       <video id="sub04_01_saipan" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub04_01_saipan.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                     poster: "../vedio/sub04_01_saipan_thumb.jpg",
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
                var player = videojs('sub04_01_saipan', options);
                player.src([{
                    src: '../vedio/sub04_01_saipan.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>


    <div class="sub04_01_sec saipan01">

        <div class="inr">
            <div class="tit_wrap">
                <h1>SAIPAN</h1>
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" class="icon">사이판 선교 개요</h6>

                <dl>
                    <dt>선교사</dt>
                    <dd>이명택, 김신애 선교사</dd>

                    <dt>선교지</dt>
                    <dd>사이판</dd>

                    <dt>최초파송일</dt>
                    <dd>1990년 9월</dd>
                </dl>
            </div>
            <div class="box_wrap">
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_img01.jpg" alt="">
                    </div>
                    <h6>이명택 선교사</h6>
                    <p>(1990~현재)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_img02.jpg" alt="">
                    </div>
                    <h6>김신애 선교사</h6>
                    <p>(1990~현재)</p>
                </div>
            </div>

            <div class="slide_wrap">

            </div>



        </div>
    </div>


    <div class="sub04_01_sec saipan02">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" class="icon">사이판 국가 개요</h6>
                <p>
                    · 수도 : 사이판(Saipan). 사이판은 국호가 아니다. 이곳의 정식 국호는 북마리아나 제도(The Northern Mariana Islands)이다.
                    <br>
                    주민이 살고 있는 3개의 섬(사이판, 티니안, 로타)을 합한 14개의 섬으로 이루어진 이 나라는, 사이판이 수도이며 제일 큰 섬이며 또한 전체 인구의 90%가 이곳에 사이판에 살고 있기에 통상적으로 이 나라의 이름을 사이판이라고 부르곤 한다.
                    <br>
                    <br>
                    · 인구 : 49,481명 (2021년)
                    <br>· 면적 : 115㎢(참고로 제주도의 크기는 1,846㎢)
                    <br>· 민족 : 원주민으로는 차모로, 캐롤라이나족이 있으며, 그 외로는 한국인을 비롯한 많은 외국인들이 살고 있다.
                    <br>· 종교 : 원주민들은 거의 대부분이 천주교인이며, 이외의 사람들은 여러 종류의 신앙을 가지고 살아간다.
                </p>
            </div>
        </div>
    </div>
    <div class="sub04_01_sec saipan03">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" class="icon">선교사역</h6>
                <p>사이판은 선교의 집약적이 선교지이다. 그래서 다양한 타문화 선교를 해야 할 곳이다.
                </p>
            </div>

            <div class="sub_wrap">
                <h6>1) 한인사역</h6>
                <p>첫째는, 선교사역을 자력으로 감당하기 위해서 반드시 먼저 해야 하는 사역이었다.
                    태평양 한가운데 있는 작은 섬인 이곳은 음식재료에서부터 모든 제품들에 이르기까지 수입에 의존하기에 가격대가 비쌀 수밖에 없다. 이를 극복하기 위해선 선교의 열이 뜨거운 한인교회를 세워 한인들로 하여금 선교에 필요한 것들을 제공하게 하는 선교전략이다.
                    <br>둘째는, 선교사역에 동역하게하기 위함이다.
                    선교사만 사역을 할 수는 없다. 이곳 사이판은 작은 곳이지만 많은 나라의 사람들이 일정한 지역에 모여 살고 있기 때문이다. 저마다 받은 달란트들을 활용하여 몸으로 직접 선교에 뛰어들게 하기 위함이다.
                </p>
            </div>
            <div class="sub_wrap">
                <h6>2) 영어권 사역</h6>
                <p>
                    이곳의 공용어는 영어다. 원주민은 물론 미국인, 필리핀인 그리고 주변 섬에서 온 사람들에게는 영어로 다가갈 수 있다.
                    <br>그래서 영어권을 세워 사역을 시작하였다. 그러던 중 이곳에 UMC에 속한 안수받은 Barbara Grace Ripple목사(Ohio Theological Seminary를 졸업. 이곳에서 함께 사역하다 하와이지방 감리사로 떠나 감리사로 8년간 사역))를 만나게 되었다. 그녀는 남편(미 변호사)이 미연방에서 이곳에 파견되어 온 고위 공직자의 아내였다. 그분은 당시 사역을 접은 상태였으나, 의기가 투합되어서 영어권을 맡기게 되었다.
                    당시 오하이오 연회 감독인 Edwin C, Boulton에게 연락을 하여 그를 다시 복직하는 일에 참여를 하게 되었고, 이후 CALPAC연회로 적을 옮긴 후 영어권 Immanuel United Methodist Church로 정식 창립을 하고 함께 사역을 시작하였다.
                    세워진 이 교회는 우리 KMC가 UMC의 교회를 최초로 세워준 교회가 되었다.
                    <br>그래서 Roy Sano감독, Mary Swenson감독 그리고 Minerva Carcano감독님들이 이곳을 찾아주었고, 매년 하와이지방 감리사가 외서 Annuel Conference를 진행해 주고 있다.
                </p>
            </div>
            <div class="sub_wrap">
                <h6>3) 필리핀어권 선교</h6>
                <p>영어권에 함께 모여 있던 필리핀 교우들을 따로 분리하여 필리핀어권을 세웠다.
                    <br>이 필리핀어권은 Nakpil감독에게 연락을 하여 필리핀어권 교역자를 보내줄 것을 요청하게 되었고, 후에 마닐라 지방의 감리사인 Casuco 감리사가 이곳에 와서 창립예배를 드려주며 필리핀어권 역시 정식으로 시작하게 되었다.
                </p>
            </div>
            <div class="sub_wrap">
                <h6>4) 중국어권 선교</h6>
                <p>중국어권의 선교는 두 개의 방향으로 진행되었다.
                    <br>하나는 한족(漢族)을 향한 선교이고, 다른 하나는 조선족을 향한 선교였다.
                    <br>사이판은 중국선교를 위한 우회의 선교지로 가장 좋은 곳이었다.
                    간섭받거나 두려워할 이유가 없이, 봉제공장에서 일을 마치면 공장에서 일하던 중국인들을 교회로 데려오거나 또는 기숙사로 찾아가서 아주 자유스러운 분위기 가운데 마음껏  복음을 전할 수 있는 곳이었다. 이곳에 온 사람들은 이곳에 거주를
                </p>
            </div>
        </div>
    </div>

    <div class="sub04_01_sec saipan04">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" class="icon">선교전략과 기도요청</h6>
                <p>1) 이곳은 선교 집약적인 곳이라 생각한다. 찾아가지 않아도 쉽게 주변에서 만날 수 있는 다양한 사람들에게 자유롭게 복음을 전할 수 있기에 앞으로도 작은 섬에 다양한 나라의 사람들이 함께 살아가고 있다는 것은 선교를 위한 이점들이 많다는 것이 된다. 멀리 찾아가지 않아도 쉽게 여러 나라의 사람들을 만날 수 있으니, 만약 이곳에 거하는 다양한 사람들을 위한 공동목회의 장소를 만들어 실천해 갈 수 있으면 좋겠다.<br>
                    <br><br>
                    2) 이곳은 아름다운 관광지로 많은 사람들의 입에 오르내리고 있다. 특히 한국인들에게는 가까우면서도 안전하다는 인식 때문에 더욱 인기를 누리고 있다. 이러한 이점은 이곳에 관광을 겸한 Retreat Center를 운영할 수 있다면 좋겠다는 생각을  한다.
                    <br><br>
                    3) 이곳의 교육은 미국의 교육 시스템을 꼭 같이 운영하고 있다. 학비와 체재비가 미국 본토에 비하면 싸고 안전하기에 한국인들은 물론 타 외국인들도 자녀들을 이곳에 보내서 미국식의 교육을 시키고 있다.
                    감리교회의 신앙과 교육적 가치를 가지고 이곳에 학교를 세울 수 있다면 좋겠다고 생각한다. 미국으로 대학을 가려는 학생들에게 입학사정에서도 좋은 혜택을 받을 수 있기 때문이다.
                    <br><br>
                    이와 같은 선교전략과 방향성을 위해 기도 부탁드립니다.
                </p>
            </div>


            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide01.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide02.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide03.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide04.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide05.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide06.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide07.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide08.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide09.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_saipan_slide10.jpg" alt=""></li>
                </ul>
            </div>


        </div>
    </div>

    <div class="menu_sec">

        <div class="inr">
            <div class="tit_wrap">
                <h6>해외선교지 소개</h6>
                <p>국기를 클릭하시면 해당 국가의 선교지 소개 페이지로 이동합니다</p>
            </div>
            <div class="menu_wrap">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_kenya">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" alt="">
                    </div>
                    <h6>KENYA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_tan">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" alt="">
                    </div>
                    <h6>TANZANIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_malay">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" alt="">
                    </div>
                    <h6>MALAYSIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_sai">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" alt="">
                    </div>
                    <h6>SAIPAN</h6>
                </a>
                <?/*a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_phili">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_phili.png" alt="">
                    </div>
                    <h6>PHILIPPINES</h6>
                </a*/?>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_cambo">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" alt="">
                    </div>
                    <h6>CAMBODIA</h6>
                </a>
            </div>
        </div>
    </div>
    <? }else if($co_id == "sub04_01_cambo"){ ?>
    <div class="vedio_wrap">
       <video id="sub04_01_cambo" class="video-js vjs-default-skin" autoplay playsinline></video>
        <script>
            $(document).ready(function() {
                let options = {
                    sources: [{
                        src: "../vedio/sub04_01_cambo.mp4",
                        type: "video/mp4",
                    }],
                    playbackRates: [.5, .75, 1, 1.25, 1.5],
                     poster: "../vedio/sub04_01_cambo_thumb.jpg",
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
                var player = videojs('sub04_01_cambo', options);
                player.src([{
                    src: '../vedio/sub04_01_cambo.mp4',
                    type: 'video/mp4',
                }, ]);
            })

        </script>
    </div>


    <div class="sub04_01_sec cambo01">

        <div class="inr">
            <div class="tit_wrap">
                <h1>CAMBODIA</h1>
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" class="icon">캄보디아 선교 개요</h6>

                <dl>
                    <dt>선교사</dt>
                    <dd>김대영, 이경민 선교사</dd>

                    <dt>선교지</dt>
                    <dd>캄보디아</dd>

                    <dt>최초파송일</dt>
                    <dd>2024년 6월</dd>
                </dl>
            </div>
            <div class="box_wrap">
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_img01.jpg" alt="">
                    </div>
                    <h6>김대영 선교사</h6>
                    <p>(2024~현재)</p>
                </div>
                <div class="box">
                    <div class="img">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_img02.jpg" alt="">
                    </div>
                    <h6>이경민 선교사</h6>
                    <p>(2024~현재)</p>
                </div>
            </div>

            <div class="slide_wrap">

            </div>



        </div>
    </div>


    <div class="sub04_01_sec cambo02">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" class="icon">캄보디아 이모저모</h6>
                <p>
                    <b>캄보디아의 이름</b>은 가장 강성했던 크메르 제국으로부터 시작된다. 크메르 제국의 다른 이름인 캄부자에서 유래한 프랑스어 캉보주가 영어화된 것을 받아들였다. 구한말에는 금변국으로 불리었고, 일제강점기 시대에는 일본어식 발음인 캄보자로 대체되고, 그 이후에 캄보디아의 정권이 바뀜에 따라 근현대사에는 크메르 공화국, 민주 캄푸치아 인민공화국으로 바뀌었다가 현재 캄보디아로 불려지고 있다.
                    <br>
                    <br>
                    <b>캄보디아의 역사</b>는 1세기부터 시작되었다. 인도와의 교류를 통해 종교 등의 문화를 받아들이며 인도차이나 반도에 알려진 첫 번째 국가인 푸난을 세웠다. 9세기에 자야바르만 2세가 등장하여 자바인들로부터 독립을 선포하고 앙코르를 수도로 하는
                    왕조를 세웠다. 이것이 크메르 제국의 시작이 되었다. 13세기 초에는 약소국으로 연명을 하고 1863년에 프랑스의 보호령이 되었다. 1940년부터 1945년까지 일본이 점령하였다. 1954년 프랑스 공동체의 자치국으로 독립했지만 정치가 계속 불안정하였다. 이 시기에 1차 킬링필드(미국이 퍼부은 54만 톤의 폭탄을 투하하였다) 2차 킬링필드는 1975년부터 1978년 사이 무장 공산주의 단체에 의해 전체 인구 700만 중 200만 명에 가까운 사람들이 강제노역을 하거나 학살을 당했다. 1989년 이후 베트남이 철군하고 1991년 내전을 종식하고 입헌군주제로 바뀌고 캄보디아 왕국으로 바뀌게 되었다.
                    <br>
                    <br>
                    <b>캄보디아의 경제</b>는 주로 벼농사와 어업, 목재, 의류, 고무 등의 1차 산업에 의존하고 있다. 하지만 1999년 경제개혁 이후 5%대의 경제 성장을 꾸준히 기록하였다. 관광산업이 활성화되어서 100만 명 넘는 관광객이 찾아온다. 캄보디아는 국가 투명도지수에서 179개국 중 162위로 라오스 미얀마와 더불어 동남아 3대 부패국의 오명을 가지고 있다.
                </p>
            </div>
        </div>
    </div>
    <div class="sub04_01_sec cambo03">

        <div class="inr">
            <div class="tit_wrap">
                <h6><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" class="icon">캄보디아 기독교의 현주소</h6>
            </div>

            <div class="sub_wrap">
                <h6>캄보디아의 기독교</h6>
                <p>캄보디아의 기독교 등록 교인은 10,448명으로 알려져 있고, 캄보디아 성경은 번역이 되어있고, 예수 영화도 캄보디아어로 있다. 캄보디아의 교회수는 늘어나는데 교인은 줄어들고 있다. 이는 캄보디아 안에 개신교의 분열이 심각하다는 것을 의미한다. 캄보디아인뿐 아니라 한족들에게도 복음이 필요하다고 전해지고 있다.</p>
            </div>
            <div class="sub_wrap">
                <h6>캄보디아 개신교 선교 100주년</h6>
                <p>
                    올해(2023년)로 캄보디아 개신교 선교가 100주년을 맞이했지만, 복음화율은 여전히 1%에 정도에 불과하다. 전국 1만 4천여 마을 중, 82%에는 여전히 교회가 존재하지 않으며 현존하는 교회들조차 온전히 자립한 교회라고 보기 어렵다. 캄보디아 복음
                    화의 불을 지피려면, 각 교회들이 복음을 스스로 자신들의 민족에게 전파할 수 있는 자치/자립/자전하는 교회로 성장해야 한다.
                </p>
            </div>
            <div class="sub_wrap">
                <h6>큰 성장 가능성</h6>
                <p>캄보디아는 타종교에 대해 폐쇄적이지 않은 국가이며, 이는 아직까지는 캄보디아 내에서 기독교가 그리 영향력이 있는 종교가 아니지만, 조건만 갖춰진다면 얼마든지 크게 성장할 수 있다는 가능성을 의미한다. (이미 다양한 기독교 단체와 교단들
                    이 다수 존재)</p>
            </div>
            <br>
            <div class="conslide">
                <ul class="sub-slider05">
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide01.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide02.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide03.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide04.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide05.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide06.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide07.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide08.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide09.jpg" alt=""></li>
                    <li class="slide"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/sub04_01_cambo_slide10.jpg" alt=""></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="menu_sec">

        <div class="inr">
            <div class="tit_wrap">
                <h6>해외선교지 소개</h6>
                <p>국기를 클릭하시면 해당 국가의 선교지 소개 페이지로 이동합니다</p>
            </div>
            <div class="menu_wrap">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_kenya">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_kenya.png" alt="">
                    </div>
                    <h6>KENYA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_tan">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_tan.png" alt="">
                    </div>
                    <h6>TANZANIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_malay">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_malay.png" alt="">
                    </div>
                    <h6>MALAYSIA</h6>
                </a>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_sai">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_sai.png" alt="">
                    </div>
                    <h6>SAIPAN</h6>
                </a>
                <?/*a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_phili">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_phili.png" alt="">
                    </div>
                    <h6>PHILIPPINES</h6>
                </a*/?>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=sub04_01_cambo">
                    <div class="img_plag">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_cambo.png" alt="">
                    </div>
                    <h6>CAMBODIA</h6>
                </a>
            </div>
        </div>
    </div>
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <? } ?>
</div>
