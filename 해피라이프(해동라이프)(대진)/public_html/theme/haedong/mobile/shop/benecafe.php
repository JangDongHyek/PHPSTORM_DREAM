<?php
include_once(G5_PATH."/jl/JlConfig.php");
//include_once('./_common.php');
//include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');

add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/benepia_landing.css?ver='.date('Y h:i:s A').'">', 10);
?>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/all.min.css">

<div id="benepia_landing">
    <section class="s1">
        <div class="container">
                <div class="preApply_slg">
                    <h7><strong>그리움을</strong> 간직하겠습니다</h7>
                    <p>마지막 가시는 길 외롭지 않도록 가족의 마음으로 모시겠습니다</p>
                </div>
                <button type="button" class="preApply_btn wow animate__animated animate__fadeInDown animate__delay-0.5s" style="position:relative; z-index:1;" @click="modal = true;">
                    <p>무료 사전장례상담 신청</p>
                    <span>* 장례지도사 + 3년이상 유경험</span>
                </button>
            <div class="text-center mt10 wow animate__animated animate__fadeInDown animate__delay-0.5s">
                1877-2919으로 언제든 편안하게 상담하실 수 있습니다.</div>
            <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s" style="position:relative; z-index:1;">
                <div class="tit_wrap">
                    <h6 class="color-black">월납입금 없이 바로 이용 가능한</h6>
                    <h1>
                        <span class="color-black">해피라이프</span><br>
                        후불 상조
                    </h1>
                </div>
            </div>


            <!--
            <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s">
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/flower2.png" alt="">
                </div>
            </div>
-->
        </div>
        <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/s05_bg.png" class="s1_bg">
    </section>
    <section class="s6">
        <div class="container">

            <div class="con_wrap">
                <ul class="text_wrap">
                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5 class="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/logo_black.png" class="logo"><br>특장점
                            </h5>
                        </div>
                    </div>


                    <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s">
                        <li>
                            <strong class="step-num">
                                <span>01.</span>
                            </strong>
                            <h5 class="color-red">후불제 맞춤상품</h5>
                            <p>기존 상조 상품의 거품을 제거하고 월납입금 불입이 <br class="hidden-xs">필요없는 복지몰 후불제 상조 상품</p>
                        </li>
                        <li>
                            <strong class="step-num">
                                <span>02.</span>
                            </strong>
                            <h5 class="color-red">복지몰 혜택</h5>
                            <p>특별할인과 함께 더 많은 혜택을 받으세요</p>
                        </li>
                        <li>
                            <strong class="step-num">
                                <span>03.</span>
                            </strong>
                            <h5 class="color-red">우수한 인력</h5>
                            <p>해피라이프의 풍부한 현장 경험과 노하우를 갖춘 <br class="hidden-xs">전문팀장들이 고인을 모십니다</p>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </section>



    <section class="s7">
        <div class="container">

            <div class="con_wrap">
                <div class="text_wrap">

                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5><img src="<?php echo G5_THEME_IMG_URL ?>/landing02/logo_black.png" class="logo"><br>서비스 이용안내</h5>
                        </div>
                    </div>

                    <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s">
                        <ul class="">
                            <li>
                                <span class="box-num">01.</span>
                                <h5>
                                    장례발생 시<br>
                                    <strong class="under-red">복지몰 전용 24시간 상황실</strong>
                                </h5>
                                <h2>
                                    <span class="color-red">1899-2919</span> 로 전화주세요
                                </h2>
                            </li>
                            <li>
                                <span class="box-num">02.</span>
                                <h5>상조 서비스 이용 후<br><strong class="under-red">복지몰 특별 할인가</strong></h5>
                                <h2><span class="color-red">229만원 결제</span></h2>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="s8">
        <div class="container">

            <div class="con_wrap">
                <div class="text_wrap">

                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5><img src="<?php echo G5_THEME_IMG_URL ?>/landing02/logo_black.png" class="logo"><br>후불상조</h5>
                        </div>

                       <a data-toggle="modal" > <!--data-target="#modal_benecafe"-->
                            <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/product_benecafe.png" alt="" class="s8_img01">
                        </a>
                    </div>

                </div>
            </div>


            <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s btn_wrap">
                <a class="btn btn-black">24시간 복지몰 전용</a>
                <a class="btn btn-white">전화 1899-2919</a>
            </div>
        </div>
    </section>


    <section class="s4">
        <div class="container">

            <div class="con_wrap">
                <div class="text_wrap">

                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5 class="color-black">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/logo_black.png" class="logo"><br>장례 진행절차
                            </h5>
                            <!--
                            <p>
                                해피라이프 전문 장례인력 프리미엄 서비스
                            </p>
-->
                        </div>
                    </div>


                    <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s">
                        <div class="process">
                            <dl>
                                <div class="img_wrap">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/process01.png" alt="">
                                </div>
                                <dt>01. 장례발생</dt>
                                <dd>365일 24시간<br>상황실 운영</dd>
                            </dl>
                            <dl>
                                <div class="img_wrap">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/process02.png" alt="">
                                </div>
                                <dt>02. 장례접수</dt>
                                <dd>복지몰 전용 대표번호 <br>1899-2919 24시간 365일</dd>
                            </dl>
                            <dl>
                                <div class="img_wrap">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/process03.png" alt="">
                                </div>
                                <dt>03. 장례지도사 출동</dt>
                                <dd>전국 2시간 이내 출동</dd>
                            </dl>
                            <dl>
                                <div class="img_wrap">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/process04.png" alt="">
                                </div>
                                <dt>04. 장례상담</dt>
                                <dd>진행 절차, 예법 안내<br>일정협의, 장례식장 예약</dd>
                            </dl>
                            <dl>
                                <div class="img_wrap">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/process05.png" alt="">
                                </div>
                                <dt>05. 장례진행</dt>
                                <dd>접객도우미 배치, 장의 <br>차량배차, 상복/제단, <br>수의(입관), 의전</dd>
                            </dl>
                            <dl>
                                <div class="img_wrap">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/process06.png" alt="">
                                </div>
                                <dt>06. 장례종료</dt>
                                <dd>상조서비스 이용금액 <br>후불정산 행정 절차안내</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="s5">
        <div class="container">

            <div class="con_wrap">
                <div class="text_wrap">
                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5 class="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/logo_black.png" class="logo"><br>드리는 약속
                            </h5>
                        </div>
                    </div>

                    <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s">
                        <ul class="promiss">
                            <li>
                                <span class="box-num">01</span>
                                <div><span class="color-red under-red">전문 장례 의전 팀장</span>(국가공인자격소지자) 인력 구성합니다.</div>
                            </li>
                            <li>
                                <span class="box-num">02</span>
                                <div><span class="color-red under-red">365일 24시간</span> 전천후 행사출동 가능합니다.</div>
                            </li>
                            <li>
                                <span class="box-num">03</span>
                                <div><span class="color-red under-red">전국 의전망</span> 보유로 어디든 장례의전행사 진행합니다 </div>
                            </li>
                            <li>
                                <span class="box-num">04</span>
                                <div><span class="color-red under-red">최고급 의전 서비스</span>를 약속드리겠습니다.</div>
                            </li>
                            <li>
                                <span class="box-num">05</span>
                                <div><span class="color-red under-red">합리적인 비용</span>으로 최고급 의전서비스 제공을 약속드리겠습니다.</div>
                            </li>
                            <li>
                                <span class="box-num">06</span>
                                <div>상가에 <span class="color-red under-red">장례예법과 상황</span>에 따라 적절히 조율하여 제공하겠습니다.</div>
                            </li>
                        </ul>

                        <div class="img_wrap">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/s5_img01.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container fix_btn">
        <a target="#" class="btn btn-beige">24시간 복지몰 전용</a>
        <a href="tel:1899-2919" class="btn btn-white">전화 1899-2919</a>
    </div>

    <consult-modal :modal="modal" @close="modal = false;" type="이제너두" tel="1899-2919"></consult-modal>


</div>


<!--캐시백 신청폼 모달-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_benecafe">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">캐쉬백 신청하기</h4>
            </div>
            <div class="modal-body">
                <div id="cashback_form">
                    <dl class="">
                        <dt>
                            <span class="color-red">(필수)</span>
                            신청인 성명
                        </dt>
                        <dd>
                            <input type="text" class="input_form" placeholder='입력하세요'>
                        </dd>
                    </dl>
                    <dl>
                        <dt>
                            <span class="color-red">(필수)</span>
                            해피라이프 이용일자
                        </dt>
                        <dd>
                            <input type="date" class="input_form">
                        </dd>
                    </dl>
                    <dl>
                        <dt>
                            <span class="color-red">(필수)</span>
                            신청인 휴대폰
                        </dt>
                        <dd class="input_phone">
                            <select class="input_form">
                                <option value="010">010</option>
                                <option value="010">010</option>
                                <option value="010">010</option>
                            </select>
                            -
                            <input type="text" class="input_form" placeholder='4자리'>
                            -
                            <input type="text" class="input_form" placeholder='4자리'>
                        </dd>
                    </dl>
                    <dl>
                        <dt>
                            <span class="color-red">(필수)</span>
                            이용인 성명
                        </dt>
                        <dd>
                            <input type="text" class="input_form" placeholder='입력하세요'>
                        </dd>
                    </dl>
                    <dl>
                        <dt>
                            <span class="color-red">(필수)</span>
                            신청인 고객사명
                        </dt>
                        <dd>
                            <input type="text" class="input_form" placeholder='입력하세요'>
                        </dd>
                    </dl>
                    <div class="agr_form">
                    <h6>
                        <span class="color-red">(필수)</span>
                        약관 동의
                    </h6>
                    <ul>
                        <li>
                            <textarea class="input_form" disabled>캐쉬백약관에 대한 설명이 들어갑니다.</textarea>
                            <input type="checkbox" id="agr01">
                            <label for="agr01"><i class="fa-solid fa-square-check"></i>위 약관에 동의합니다.</label>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="bttn btn-save" data-toggle="modal" data-target="#modal_benecafe_msg">캐쉬백 신청하기</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!--메시지 모달-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_benecafe_msg">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">캐쉬백 신청하기</h4>
            </div>
            <div class="modal-body">
                <h4>
<!--                    메시지를 넣어주세요-->
                    신청되었습니다.
                </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="bttn btn-save" data-dismiss="modal" aria-label="Close">확인</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- 무료 사전장례상담 신청 -->
<div class="modal fade preApply" id="preApplyModal" tabindex="-1" aria-labelledby="preApplyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="preApplyModalLabel">무료 사전장례상담 신청</h5>
                <div class="text-center mt10">
                    <?php echo $info['phone_number']; ?>으로 언제든 편안하게 상담하실 수 있습니다.</div>
            </div>
            <div class="modal-body">
                <dl class="">
                    <dt>
                        <span class="color-red">(필수)</span>
                        신청인 성명
                    </dt>
                    <dd>
                        <input type="text" class="input_form" placeholder='입력하세요'>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="color-red">(필수)</span>
                        신청인 휴대폰
                    </dt>
                    <dd class="input_phone">
                        <select class="input_form">
                            <option value="010">010</option>
                            <option value="010">010</option>
                            <option value="010">010</option>
                        </select>
                        -
                        <input type="text" class="input_form" placeholder='4자리'>
                        -
                        <input type="text" class="input_form" placeholder='4자리'>
                    </dd>
                </dl>
                <div class="agr_form">
                    <ul>
                        <li>
                            <input type="checkbox" id="agr01">
                            <label for="agr01">
                                <p><i class="fa-solid fa-square-check"></i>개인정보처리방침 동의</p>
                                <button type="button" class="btn" data-toggle="modal" data-target="#privacyModal">약관보기</button>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="bttn btn-save" data-toggle="modal" data-target="#">사전 장례상담 신청</button>
            </div>
        </div>
    </div>
</div>

<!--개인정보처리방침 약관-->
<div class="modal fade preApply" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="privacyModalLabel">개인정보처리방침</h5>
            </div>
            <div class="modal-body">
                <p> ▶ 개인정보 제공받는자 : 해피라이프 1899-2919 </p>
                <p> ▶ 개인정보 수집범위 : 고객명, 연락처 </p>
                <p> ▶ 개인정보 수집 및 이용목적 : 해피라이프 상담 활용(전화, SMS,카카오톡)</p>
                <p> ▶ 개인정보 보유 및 이용기간 : 개인정보는 수집 및 이용 목적 달성시까지보유하며, 이용 목적 달성 되면 파기하는 것을 원칙으로 한다
            </div>
        </div>
    </div>
</div>

<? $jl->vueLoad("benepia_landing");?>
<? $jl->componentLoad("consult/consult-modal.php");?>
<? $jl->componentLoad("item");?>
<script>
    Jl_data.modal = false;
</script>

<script>
    wow = new WOW({
        animateClass: 'animate__animated' //updated default animate 4.+
    })
    wow.init();

</script>
<?php
//include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>
