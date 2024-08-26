<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="' . $member_skin_url . '/js/epggea.js"></script>', 100);


?>
<style>
    .box-article .box-body .row {
        background: #fff
    }

    .tab-content {
        display: none;
        float: left;
        width: 100%;
        padding: 0 0 1em 0;
        background: #fff;
    }

    #reply {
        display: none
    }
</style>


<!--마이페이지-->

<article id="mypage">

    <?php include_once($member_skin_path . '/mypage_left_menu.php'); ?>

    <section id="right_view">
        <h3>광고 신청</h3>

        <!--광고 신청-->
        <div class="wrapper">
            <div class="tabs cf">

                <ul class="forth">
                    <li id="tab1"><a href="<?php echo G5_BBS_URL ?>/my_ad_request.php?tab=1">메인 상단</a></li>
                    <li id="tab2"><a href="<?php echo G5_BBS_URL ?>/my_ad_request.php?tab=2">메인 하단</a></li>
                    <li id="tab3"><a href="<?php echo G5_BBS_URL ?>/my_ad_request.php?tab=3">카테고리 상단</a></li>
                    <li id="tab4"><a href="<?php echo G5_BBS_URL ?>/my_ad_request.php?tab=4">플러스</a></li>
                </ul>

                <!--메인 상단-->
                <div id="tab-content1" class="tab-content">
                    <!--잡고 마일리지-->
                    <div class="cash_idx02">
                        <ul>
                            <li>
                                <dl>
                                    <dt>1주일 광고비용</dt>
                                    <dd>99,000<span>원</span></dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>현재 마일리지</dt>
                                    <dd><?=number_format(floor($mb['mb_7']))?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_purchase.php"><span class="account">마일리지 구매</span></a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--//잡고 마일리지-->
                    <p class="t_margin25">메인페이지 상단에 노출되는 광고입니다. 꾸준한 광고를 원하시는 분들께
                        추천합니다.<br/><span>※ 중복 신청 불가합니다.</span></p>
                    <h4>노출 위치<span>노출 순서 랜덤</span></h4>
                    <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ad_01.png" alt="" class="imgWidth"></div>
                    <div>
                        <button onclick="ad_request('1', '99000');">광고 신청하기</button>
                    </div>
                </div>

                <!--메인 하단-->
                <div id="tab-content2" class="tab-content box-article">
                    <!--잡고 마일리지-->
                    <div class="cash_idx02">
                        <ul>
                            <li>
                                <dl>
                                    <dt>1주일 광고비용</dt>
                                    <dd>55,000<span>원</span></dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>현재 마일리지</dt>
                                    <dd><?=number_format(floor($mb['mb_7']))?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_purchase.php"><span class="account">마일리지 구매</span></a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--//잡고 마일리지-->
                    <p class="t_margin25">메인페이지 하단에 노출되는 광고입니다. 꾸준한 광고를 원하시는 분들께
                        추천합니다.<br/><span>※ 중복 신청 불가합니다.</span></p>
                    <h4>노출 위치<span>노출 순서 랜덤</span></h4>
                    <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ad_02.png" alt="" class="imgWidth"></div>
                    <div>
                        <button onclick="ad_request('2', '55000');">광고 신청하기</button>
                    </div>
                </div>

                <!--카테고리 상단-->
                <div id="tab-content3" class="tab-content">
                    <!--잡고 마일리지-->
                    <div class="cash_idx02">
                        <ul>
                            <li>
                                <dl>
                                    <dt>1주일 광고비용</dt>
                                    <dd>33,000<span>원</span></dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>현재 마일리지</dt>
                                    <dd><?=number_format(floor($mb['mb_7']))?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_purchase.php"><span class="account">마일리지 구매</span></a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--//잡고 마일리지-->
                    <p class="t_margin25">카테고리 페이지 상단에 노출되는 광고입니다. 저렴한 비용으로 노출을 원하시는 분들께
                        추천합니다.<br/><span>※ 중복 신청 불가합니다.</span></p>
                    <h4>노출 위치<span>노출 순서 랜덤</span></h4>
                    <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ad_03.png" alt="" class="imgWidth"></div>
                    <div>
                        <button onclick="ad_request('3', '33000');">광고 신청하기</button>
                    </div>
                </div>
                
                <!--플러스 광고-->
                <div id="tab-content4" class="tab-content">
                    <!--잡고 마일리지-->
                    <div class="cash_idx02">
                        <ul>
                            <li>
                                <dl>
                                    <dt>1주일 광고비용</dt>
                                    <dd>11,000<span>원</span></dd>
                                </dl>
                            </li>

                            <li>
                                <dl>
                                    <dt>현재 마일리지</dt>
                                    <dd><?=number_format(floor($mb['mb_7']))?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_purchase.php"><span class="account">마일리지 구매</span></a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <!--//잡고 마일리지-->
                    <p class="t_margin25">카테고리 페이지 잡고 플러스에 노출되는 광고입니다. 저렴한 비용으로 노출을 원하시는 분들께
                        추천합니다.<br/><span>※ 중복 신청 불가합니다.</span></p>
                    <h4>노출 위치<span>노출 순서 랜덤</span></h4>
                    <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/ad_04.png" alt="" class="imgWidth"></div>
                    <div>
                        <button onclick="ad_request('4', '11000');">광고 신청하기</button>
                    </div>
                </div>

            </div><!--//tabs-->
        </div>
    </section>

</article>

<script>
    // 광고 신청 (category : 광고 종류, fee : 광고 비용)
    // * swal 미적용, swal 적용 필요할 경우 하단 ad_request 주석 해제 사용
    function ad_request(category, fee) {
        var option = '';
        if(category == '1') {
            option = '메인 상단';
        } else if(category == '2') {
            option = '메인 하단';
        } else if (category == '3') {
            option = '카테고리 상단';
        }else{
            option = '플러스';
        }
        option += ' / ' + number_format(fee.toString()) + '원';

        if(confirm(option + ' 광고를 신청하시겠습니까?')) {
            $.ajax({
                url: g5_bbs_url+'/ajax.ad_request.php',
                type: "POST",
                data: {
                    category : category,
                    fee : fee,
                },
                success: function (data) {
                    if (data == 'success'){
                        swal('광고 신청이 완료되었습니다.')
                            .then(()=>{
                                location.href = g5_bbs_url+'/my_ad_list.php?tab='+category;
                            });
                    }
                    else if(data == 'fail1') {
                        swal('마일리지가 부족합니다.');
                    }
                    else if(data == 'fail2') {
                        swal('이미 신청한 광고입니다.');
                    }
                },
            });
        }
    }
    
    // swal 적용 광고 신청
    /*function ad_request(category, fee) {
        var option = '';
        if(category == '1') {
            option = '메인 상단';
        } else if(category == '2') {
            option = '메인 하단';
        } else {
            option = '카테고리 상단';
        }
        option += ' / ' + number_format(fee.toString()) + '원';

        swal(option + "\n광고를 신청하시겠습니까?", {
            buttons: {
                no: 'CANCEL',
                ok: 'OK',
            },
        })
        .then((value) => {
            switch (value) {
                case "ok":
                    $.ajax({
                        url: g5_bbs_url+'/ajax.ad_request.php',
                        type: "POST",
                        data: {
                            category : category,
                            fee : fee,
                        },
                        success: function (data) {
                            if (data == 'success'){
                                swal('광고 신청이 완료되었습니다.')
                                .then(()=>{
                                    location.href = g5_bbs_url+'/my_ad_list.php';
                                });
                            }
                            else if(data == 'fail1') {
                                swal('마일리지가 부족합니다.');
                            }
                            else if(data == 'fail2') {
                                swal('이미 신청한 광고입니다.');
                            }
                        },
                    });
                    break;

                case "no":
                    break;
            }
        });
    }*/
</script>

<style>
    .swal-button-container {
        margin: 5px !important;
    }

    .swal-button swal-button--ok {
        background: #7d75dc !important;
    }
</style>
