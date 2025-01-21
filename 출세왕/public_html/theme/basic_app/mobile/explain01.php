<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>


<style>
    .tabwrap{}
    .tab_menu{
        display: flex;
        white-space: nowrap;
        /* overflow: auto; */
    }
    .tab_menu li{
        position: relative;
        width: 50%;
        text-align: center;
    }
    .tab_menu li a{
        color: #1a7cff;
        position: relative;
        display: block;
        padding: 0 16px;
        color: #222;
        font-size: 15px;
        line-height: 46px;
        -webkit-transition: 0.3s;
        transition: 0.3s;
    }
    .tab_menu li.active{
        background: #1a7cff;
    }
    .tab_menu li.active a{
        color: #fff;
    }
    .tab_menu li.active a img{
        filter: invert(100%) sepia(0%) saturate(7500%) hue-rotate(77deg) brightness(106%) contrast(100%);
    }

    .tab_cont{
        padding-top: 20px;
    }
    .tab_cont li{
        display: none; /* 일단숨김 */
    }
    .tab_cont li.active{
        display: unset;
    }
    .tab_cont li .inner{}







    /* detail */
    .detail{

    }
    .detail .inner{
        width: 90%;
        margin: 0 auto;
        padding-top: 50px;
    }
    .title{
        font-size: 1.7em;
        color: #000;
        margin: 20px 0 8px 0;
        text-align: center;
    }
    .title strong{
        margin-left: 6px;
        color: #1a7cff;
    }
    h3{
        font-size: 1.12em;
        color: #999;
        text-align: center;
        margin-bottom: 20px;
        margin-top: 20px;
        line-height: 1.6;
    }
    .detail img{
        width: 100%;
    }





</style>


    <div id="explain01">
        <!-- <div class="tabwrap">
            <ul class="tab_menu">
                <li class="active">
                    <a href="javascript:void(0)">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/app/ico_iscs.svg" class="w20">
                        이사청소
                    </a>
                </li>
                <li><a href="javascript:void(0)"><img src="/app/ico_iscs.svg" class="w20">입주청소</a></li>
                <li><a href="javascript:void(0)"><img src="/app/ico_iscs.svg">기업세차</a></li>
                <li><a href="javascript:void(0)"><img src="/app/ico_iscs.svg">외부세차</a></li>
                <li><a href="javascript:void(0)"><img src="/app/ico_iscs.svg">정기세차 맛보기</a></li>
                <li><a href="javascript:void(0)"><img src="/app/ico_iscs.svg">실내세차 1회</a></li>
                <li><a href="javascript:void(0)"><img src="/app/ico_iscs.svg">정기세차</a></li>
            </ul>
            <ul class="tab_cont">
                <li class="active">
                    <div class="inner">
                        <div>
                            111
                        </div>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div>
                            222
                        </div>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div>
                            333
                        </div>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div>
                            444
                        </div>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div>
                            555
                        </div>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div>
                            666
                        </div>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div>
                            777
                        </div>
                    </div>
                </li>
            </ul>
        </div> -->

        <div class="detail">
            <div class="inner">
                <h2 class="title cf"><span>국내 1등</span><strong>이사청소</strong></h2>
                <h3>설명 들어가는 자리 설명 들어가는 자리 설명 들어가는 자리 설명 들어가는 자리 설명 들어가는 자리 설명 들어가는 자리 설명 들어가는 자리입니다.</h3>

                <img src="https://successking.softwow.co.kr:443/theme/basic_app/img/app/cjsc_01.png">
            </div>
        </div>
    </div>




<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>