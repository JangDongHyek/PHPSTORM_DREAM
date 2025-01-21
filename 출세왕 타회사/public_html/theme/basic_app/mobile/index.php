<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');

// 23.05.08 래벨2인 회원들 카드등록후 사용가능하게 wc
if($member['mb_id'] != "test01"){
    if ($member['mb_level'] == 2 && !$member['billKey']){
        alert("카드등록을 완료해야 이용가능합니다.", G5_HTTP_BBS_URL.'/card_info_form.php','error');
    }
    /*
    elseif($member['mb_level'] == 3)
    {
        alert("매니저님 안녕하세요.", G5_HTTP_BBS_URL.'/board.php?bo_table=notice_manager','msg');
    }
    */
}
?>
    <script src="/js/fancybox.umd.js"></script>
    <link rel="stylesheet" href="/js/fancybox.css" />
    <script>
        //console.log("DEV");
        try{
            //localStorage.clear();

            var varUA = navigator.userAgent.toLowerCase();
            var regExpAndroid = /easyapp_android/gi;
            var regExpIos = /easyapp_ios/gi;

            if (varUA.match(regExpAndroid)) {
                window.EasyappAOS.loadingFinish();
                localStorage.setItem("is_android","Y");
                localStorage.setItem("is_app","Y");
            } else if (varUA.match(regExpIos)) {
                localStorage.setItem("is_ios","Y");
                localStorage.setItem("is_app","Y");
            } else {
                localStorage.setItem("is_app","N");
            }
        }catch (e){
            localStorage.setItem("is_app","N");
        }finally{
            //로딩후 메니져 구분 해서 매니저 화면으로 이동
            if("<?=$member['mb_level']?>"=="3")
            {
                location.href="/bbs/board.php?bo_table=notice_manager";
            }
        }
        $(document).ready(function(){

            var url = "";
            $(document).on("click",".open_modal",function(){
                url = $(this).data("url");
                var menu = $(this).data("menu");

                new Fancybox(
                    [
                        {
                            src: "<img src='/images/an.png' class='fancy_img'>",
                            type: "html",
                        },
                        {
                            src: "<img src='/images/"+menu+".png' class='fancy_img'><button type='button' class='next_page'>모든 내용 읽고 동의.</button>",
                            type: "html",
                        },
                    ],
                    {
                        Carousel: {
                            infinite: false,
                        },
                        Images: {
                            zoom: false,
                        },
                        hideScrollbar: true,
                        backdropClick:false,
                        contentClick:false,
                        contentDblClick:false,
                        dragToClose:false,
                        Toolbar: {
                            display: {
                                middle: [],
                                right: ["close"],
                            }
                        }
                    }
                );
            })

            $(document).on("click",".open_modal2",function(){
                url = $(this).data("url");
                location.href=url;
            });

            $(document).on("click",".next_page",function () {
                location.href=url;
            })
        })
    </script>
    <style>
        .fancy_img{
            width: 100%;
            height: calc(100vh - 60px);
        }

        .next_page{
            position: absolute;
            bottom:-20px;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 42px;
            line-height: 41px;
            border-radius:10px;
            color: #fff;
            background: #3a3a3a;
        }

        #add_footer {
            text-align: center;
            padding: 20px 0;
            background: #FFF;}
        #add_footer p{padding-bottom:5px}

        #mb_service .clean.car .bx{
            display:flex;
            justify-content:center;
            margin-bottom: 0;
        }
        #mb_service .clean.car .bx .mg{
            width:70%;
            height: auto;
        }

        .btnwrap{
            text-align: center;
        }
        .btnwrap .btn{
            height: 52px;
            line-height: 41px;
            border-radius:10px;
            color: #fff;
            background: #1a7cff;
        }

        .twoBtn{
            display:flex;
        }
        .twoBtn .btn{
            width: 49%;
            background: #3a3a3a;
            color: #fff;
        }
        .twoBtn .btn:first-child{
            margin-right: 2%;
        }



        /* notice_txt */
        .notice_txt{
            position: relative;
            height: 39px;
            overflow: hidden;
        }
        .notice_txt ul{
            position: absolute;
            width: 100%;
            padding: 0 20px;
            animation: text_noti 9s infinite;
        }
        @keyframes text_noti {
            5%{top: 0}
            20%{top: -39px}
        }
        .notice_txt ul li{line-height: 39px;}
        .notice_txt ul li a{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .notice_txt ul li a .txt{
            width: 90%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .notice_txt .txt i{margin-right: 10px;}
        .notice_txt ul li i{font-weight: 600;padding-right: 2px;}
        .notice_txt ul li a{}


        /* 국내1등 출장세차서비스 */
        #mb_service .clean .bx .pt{
            position:relative;
            width: 33.333%;
            height: 0;
            padding-bottom: 33.333%;
        }
        #mb_service .clean .bx .pt::after{
            content:'';
            position:absolute;
            left: 0;top: 0;
            width: 100%;height: 100%;
            background: rgba(0,0,0,0.4);
        }
        #mb_service .clean .bx .pt a{
            display:block;
        }
        #mb_service .clean .bx .tx{
            position:absolute;
            left: 50%;top: 50%;
            transform:translate(-50%,-50%);
            z-index: 10;
            color: #fff;
            width: 100%;
            margin-top: 0;
        }
        #mb_service .clean .bx .tx strong{
            display:block;
        }
        #mb_service .clean .bx{
            padding: 0;
        }
        .twoBox .pt{
            width: 50% !important;
            height: 0 !important;
            padding-bottom: 50% !important;
        }
        #mb_service .clean.car .bx .mg{
            width: 100%;height: 100%;
        }





        #mb_service .processList{
            width:100%;
            display:flex;
            flex-flow:wrap;
            gap:10px;
        }

        #mb_service .processList li{
            width:calc(100% / 2 - 5px);
            background:#E9EEF9;
            padding:12px;
            box-sizing:border-box;
            border-radius:5px;
            text-align:center;
        }

        #mb_service .processList .full{
            width:100%;
        }

        #mb_service .processList li .ico{
            width:32px;
            display:inline-block;
            vertical-align:middle;
        }

        #mb_service .processList li .ico img{
            width:100%;
        }

        #mb_service .processList li .tx{
            font-size:14px;
            display:inline-block;
            vertical-align:middle;
            font-weight:bold;
            color:#1a7cff;
        }

    </style>

    <div id="mb_main">
        <!--메인슬라이더 시작-->
        <?
        if($member['mb_level'] == '10'){
            ?>
            <button type="button" style="width:100%;margin:10px 0;padding:10px 0;" onclick="location.href='/adm/'">관리자페이지로 이동</button>
            <?
        }
        ?>
        <!-- <div id="visual">
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/mvisual01.jpg" /></div>
                  <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/app/mvisual02.jpg" /></div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
        </div> --><!--visual-->
        <!-- Initialize Swiper -->
        <!-- <script>
          var swiper = new Swiper('.swiper-container', {
            spaceBetween: 0,
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
        </script> -->

        <? echo latest("basic", 'notice', 2, 35); ?>
<!--
        <div class="notice_txt" onclick="location.href='#'">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="txt">
                                    <i class="fa-regular fa-bullhorn"></i>
                                    공지사항이 있습니다1.
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="txt">
                                    <i class="fa-regular fa-bullhorn"></i>
                                    공지사항이 있습니다2.
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="txt">
                                    <i class="fa-regular fa-bullhorn"></i>
                                    공지사항이 있습니다3.
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
-->
        <? $bytton_text="모든 내용을 확인하였습니다."; ?>
        <div id="mb_service">
            <div class="clean car">
                <h2 class="title cf"><span>국내 1등</span><strong>출장세차 서비스</strong></h2>
                <h3>언제 어디서나 세차를 쉽고 빠르게!</h3>
                <!--<div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=3"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate03.png"></div><div class="tx">단기세차<span>1회</span></div></a></div>-->
                <!-- <div class="bx cf">
                 	<div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=3"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cjsc_01.png"></div><div class="tx"><strong>단기 세차</strong><span>1회성</span></div></a></div>
                     <div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=5"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cjsc_02.png"></div><div class="tx"><strong>실내 세차</strong><span>1회성</span></div></a></div>
                    <div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=4"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cjsc_03.png"></div><div class="tx"><strong>기업 세차</strong></div></a></div>
                 </div>-->
                <!--<div class="bx cf twoBox">
                 	<div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=1"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cjsc_04.png"></div><div class="tx"><strong>한달만<br>서비스 받아보기</strong></div></a></div>
                    <div class="pt"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=2"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cjsc_05.png"></div><div class="tx"><strong>정기 세차</strong><span>매월관리</span></div></a></div>
                 </div>-->
                <!--<div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=3"><div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/app/cate03.png"></div><div class="tx">기업세차<span>월/4회</span></div></a></div>-->

                <ul class="processList">
                    <li class="open_modal" data-url="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=3" data-menu="dan">
                        <a href="javascript:void(0)">
                            <div class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/processIco01.png"></div>
                            <div class="tx">외부세차 1회</div>
                        </a>
                    </li>

                    <li class="open_modal" data-url="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=5" data-menu="sil">
                        <a href="javascript:void(0)">
                            <div class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/processIco02.png"></div>
                            <div class="tx">실내세차 1회</div>
                        </a>
                    </li>

                    <li class="open_modal" data-url="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=2" data-menu="jung">
                        <a href="javascript:void(0)">
                            <div class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/processIco03.png"></div>
                            <div class="tx">정기세차</div>
                        </a>
                    </li>

                    <li class="open_modal" data-url="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=4" data-menu="gi">
                        <a href="javascript:void(0)">
                            <div class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/processIco04.png"></div>
                            <div class="tx">기업세차</div>
                        </a>
                    </li>

                    <li class="full open_modal" data-url="<?php echo G5_BBS_URL ?>/my_car_part.php?cdt=1" data-menu="mat">
                        <a href="javascript:void(0)">
                            <div class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/processIco05.png"></div>
                            <div class="tx">정기세차 맛보기</div>
                        </a>
                    </li>

                    <div class="clean home" style="text-align: center;clear: both;width: 100%;">
                        <h2 class="title cf"><span>국내 1등</span><strong>청소 서비스</strong></h2>
                        <h3>출장세차에 이어 클리닝 서비스까지 한번에!</h3>
                    </div>

                    <li class="open_modal2" data-url="<?php echo G5_BBS_URL ?>/my_clean_part.php?ct=1" data-menu="<?=$bytton_text;?>">
                        <a href="javascript:void(0)">
                            <div class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/processIco06.png"></div>
                            <div class="tx">입주청소</div>
                        </a>
                    </li>

                    <li class="open_modal2" data-url="<?php echo G5_BBS_URL ?>/my_clean_part.php?ct=2" data-menu="<?=$bytton_text;?>">
                        <a href="javascript:void(0)">
                            <div class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/processIco07.png"></div>
                            <div class="tx">이사청소</div>
                        </a>
                    </li>
                </ul>
<!--
                <div class="btnwrap mart20">
                    <div class="btn w_100" onclick="location.href='/explain.php'" style="margin:0"><i class="fas fa-car-wash"></i> 작업진행 프로세스 안내</div>
                </div>
-->
            </div>

            <!--clean-->
            <!--
			 <div class="clean home">
                 <h2 class="title cf"><span>국내 1등</span><strong>청소 서비스</strong></h2>
                 <h3>출장세차에 이어 클리닝 서비스까지 한번에!</h3>

                 <div class="twoBtn btnwrap">
                 	<div class="btn">
                        <a href="<?php echo G5_BBS_URL ?>/my_clean_part.php?ct=1">
                            <img class="w24 marb4" src="<?php echo G5_THEME_IMG_URL ?>/app/ejcs_ico.svg">
                            <span class="f-fff marl6">입주청소</span>
                        </a>
                    </div>
                    <div class="btn"><a href="<?php echo G5_BBS_URL ?>/my_clean_part.php?ct=2"><img class="w16 marb4" src="<?php echo G5_THEME_IMG_URL ?>/app/escs_ico.svg"><span class="f-fff marl6">이사청소</span></a></div>
                 </div>
             </div><!--clean-->


        </div><!--mb_service-->

        <!-- 임시하단 추가 220510 -->
        <div id="add_footer">
            <p><b>출세왕</b>&nbsp;&nbsp;&nbsp;대표자 : 김홍규</p>
            <p>Copyright© 출세왕 All right reserved</p>
            <p>부산광역시 강서구 영강길 31, 2층(명지동)</p>
            <p>사업자 등록번호 : 174-67-00420</p>
            <p>대표번호 : 010-6610-3103</p>
            <p>대표이메일 : gimhonggyu88@hanmail.net</p>
            <p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">이용약관</a><span class="line"></span><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보처리방침</a></p>
        </div>

    </div><!--#mb_main-->



<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>