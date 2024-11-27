<?php
include_once(G5_PATH."/jl/JlConfig.php");
// 공통 코드 포함
//include_once('./_common.php');
//include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');

// 변수 설정
$service_info = [
    '베네피아' => [
        'title' => '베네피아',
        'phone_number' => '1877-9950',
        'service_price' => '259만원',
        'cashback_amount' => '200000',
        'logo_image' => 'logo_black.png',
        'product_image' => 'product_benepia.png'
    ],
    '복지몰' => [
        'title' => '복지몰',
        'phone_number' => '1899-2919',
        'service_price' => '259만원',
        'cashback_amount' => '200000',
        'logo_image' => 'logo_black.png',
        'product_image' => 'product_benecafe.png'
    ]
];

$info = $service_info[$type];

add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/benepia_landing.css?ver='.date('Y h:i:s A').'">', 10);
?>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/all.min.css">

<div id="benepia_landing">

    <!-- Section 1 -->
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
                    <?php echo $info['phone_number']; ?>으로 언제든 편안하게 상담하실 수 있습니다.</div>

            <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s" style="position:relative; z-index:1;">
                <div class="tit_wrap">
                    <h6 class="color-black">월납입금 없이 바로 이용 가능한</h6>
                    <h1>
                        <span class="color-black">해피라이프</span><br>
                        후불 상조
                    </h1>
                </div>
            </div>
        </div>
        <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/s05_bg.png" class="s1_bg">
    </section>

    <!-- Section 6 -->
    <section class="s6">
        <div class="container">
            <div class="con_wrap">
                <ul class="text_wrap">
                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/<?php echo $info['logo_image']; ?>" class="logo"><br>특장점
                            </h5>
                        </div>
                    </div>

                    <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s">
                        <li>
                            <strong class="step-num"><span>01.</span></strong>
                            <h5 class="color-red">후불제 맞춤상품</h5>
                            <p>기존 상조 상품의 거품을 제거하고 월납입금 불입이<br>필요없는 해피라이프 후불제 상조 상품</p>
                        </li>
                        <li>
                            <strong class="step-num"><span>02.</span></strong>
                            <h5 class="color-red"><?php echo $info['title']; ?> 혜택</h5>
                            <p>캐쉬백과 함께 더 많은 혜택을 받으세요</p>
                        </li>
                        <li>
                            <strong class="step-num"><span>03.</span></strong>
                            <h5 class="color-red">우수한 인력</h5>
                            <p>해피라이프의 풍부한 현장 경험과 노하우를 갖춘<br> 전문팀장들이 고인을 모십니다</p>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </section>

    <!-- Section 7 -->
    <section class="s7">
        <div class="container">
            <div class="con_wrap">
                <div class="text_wrap">
                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5><img src="<?php echo G5_THEME_IMG_URL ?>/landing02/<?php echo $info['logo_image']; ?>" class="logo"><br>서비스 이용안내</h5>
                        </div>
                    </div>

                    <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s">
                        <ul class="">
                            <li>
                                <span class="box-num">01.</span>
                                <h5>장례발생 시<br><strong class="under-red"><?=$info['title']?> 전용 24시간 상황실</strong></h5>
                                <h2><span class="color-red"><?php echo $info['phone_number']; ?></span> 로 전화주세요</h2>
                            </li>
                            <li>
                                <span class="box-num">02.</span>
                                <h5>해피라이프 후불상조<br><strong class="under-red">전국 동일 가격</strong></h5>
                                <h2><span class="color-red"><?php echo $info['service_price']; ?> 결제</span></h2>
                            </li>
                            <li>
                                <span class="box-num">03.</span>
                                <h5>해피라이프 이용 후</h5>
                                <h2><span class="color-red">캐쉬백 <?php echo number_format($info['cashback_amount']); ?></span></h2>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section S8 -->
    <section class="s8">
        <div class="container">
            <div class="con_wrap">
                <div class="text_wrap">
                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5><img src="<?php echo G5_THEME_IMG_URL ?>/landing02/<?php echo $info['logo_image']; ?>" class="logo"><br>후불상조</h5>
                        </div>
                        <a style="cursor:pointer" onclick="open_modal()"> <!---->
                            <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/<?php echo $info['product_image']; ?>" alt="" class="s8_img01">
                        </a>
                    </div>
                </div>
            </div>
            <div class="wow animate__animated animate__fadeInUp animate__delay-0.5s btn_wrap">
                <a class="btn btn-black">24시간 <?php echo $info['title']; ?> 전용</a>
                <a class="btn btn-white">전화 <?php echo $info['phone_number']; ?></a>
            </div>
        </div>
    </section>

    <!-- Section S4 -->
    <section class="s4">
        <div class="container">
            <div class="con_wrap">
                <div class="text_wrap">
                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5 class="color-black">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/<?php echo $info['logo_image']; ?>" class="logo"><br>장례 진행절차
                            </h5>
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
                                <dd><?=$info['title']?> 전용 대표번호 <br><?=$info['phone_number']?> 24시간 365일</dd>
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

    <!-- Section S5 -->
    <section class="s5">
        <div class="container">
            <div class="con_wrap">
                <div class="text_wrap">
                    <div class="wow animate__animated animate__fadeInDown animate__delay-0.5s">
                        <div class="tit_wrap">
                            <h5>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/landing02/<?php echo $info['logo_image']; ?>" class="logo"><br>드리는 약속
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
                                <div><span class="color-red under-red">전국 의전망</span> 보유로 어디든 장례의전행사 진행합니다</div>
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
        <a href="<?php echo $info['fix_btn_link']; ?>" target="#" class="btn btn-beige">24시간 <?php echo $info['title']; ?> 전용</a>
        <a href="tel:<?php echo $info['phone_number']; ?>" class="btn btn-white">전화 <?php echo $info['phone_number']; ?></a>
    </div>

    <consult-modal :modal="modal" @close="modal = false;" type="베네피아" tel="1877-9950"></consult-modal>

</div>

    <!--캐시백 신청폼 모달-->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_register">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">캐쉬백 신청하기</h4>
                </div>
                <div class="modal-body">
                    <form id="modal_form">
                        <input type="hidden" id="type" name="type" value="<?=$type?>">
                        <div id="cashback_form">
                            <dl class="">
                                <dt>
                                    <span class="color-red">(필수)</span>
                                    신청인 성명
                                </dt>
                                <dd>
                                    <input type="text" class="input_form" placeholder='입력하세요' id="mb_name" name="mb_name">
                                </dd>
                            </dl>
                            <dl>
                                <dt>
                                    <span class="color-red">(필수)</span>
                                    해피라이프 이용일자
                                </dt>
                                <dd>
                                    <input type="date" class="input_form" id="use_date" name="use_date">
                                </dd>
                            </dl>
                            <dl>
                                <dt>
                                    <span class="color-red">(필수)</span>
                                    신청인 휴대폰
                                </dt>
                                <dd class="input_phone">
                                    <input type="tel" class="input_form" placeholder='입력하세요' id="mb_hp" name="mb_hp">
                                </dd>
                            </dl>
                            <dl>
                                <dt>
                                    <span class="color-red">(필수)</span>
                                    이용인 성명
                                </dt>
                                <dd>
                                    <input type="text" class="input_form" placeholder='입력하세요' id="use_name" name="use_name">
                                </dd>
                            </dl>
                            <dl>
                                <dt>
                                    <span class="color-red">(필수)</span>
                                    신청인 고객사명
                                </dt>
                                <dd>
                                    <input type="text" class="input_form" placeholder='입력하세요' id="mb_company" name="mb_company">
                                </dd>
                            </dl>
                            <div class="agr_form">
                                <h6>
                                    <span class="color-red">(필수)</span>
                                    약관 동의
                                </h6>
                                <ul>
                                    <li>
                                        <? if($type == "베네피아") { ?>
                                                <textarea class="input_form" disabled>
- 캐시백 포인트는 신청 후 다음달 15일(공휴일 경우 익영업일)에 적립되며, 유효 기간은 5년 입니다. 다만, 베네피아의 운영 정책에 따라 적립 및 재적립 될 수 있습니다.
- 적립된 포인트는 베네피아 온라인몰에서 사용할 수 있습니다.
- 캐시백 포인트로 결제한 주문을 취소할 경우, 환불은 베네피아 포인트로 이루어지며, 환불 규정은 베네피아 이용 약관에 따릅니다.
- 베네피아 회원을 탈퇴할 경우, 적립된 포인트는 모두 소멸됩니다</textarea>
                                            <?} ?>

                                        <input type="checkbox" id="is_agree" name="is_agree" value="Y">
                                        <label for="is_agree"><i class="fa-solid fa-square-check"></i>위 약관에 동의합니다.</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="bttn btn-save" onclick="modal_submit()">캐쉬백 신청하기</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--메시지 모달-->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_msg">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">캐쉬백 신청하기</h4>
                </div>
                <div class="modal-body">
                    <h4 id="modal_h4">
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
                    <p> ▶ 개인정보 제공받는자 : 해피라이프 1877-9950 </p>
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
    <!-- 외부 스크립트 및 마무리 -->
    <script>
        wow = new WOW({
            animateClass: 'animate__animated' //updated default animate 4.+
        });
        wow.init();

        let is_ajax = false;
        function modal_submit() {
            if(is_ajax) return false;
            is_ajax = true;
            // 폼 데이터를 변수에 저장
            var formData = $('#modal_form').serialize();
            if(!$("#is_agree").is(":checked")){
                $("#modal_h4").html("약관에 동의해주세요.");
                $("#modal_msg").modal("show");
                is_ajax = false;
                return false;
            }
            // Ajax 요청
            $.ajax({
                url: "<?=G5_URL?>/ajax/set_bene.php",
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(data) {
                    $("#modal_h4").html(data.msg);
                    $("#modal_msg").modal("show");
                    if(data.code == "200"){
                        $("#modal_register").modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                }
            }).always(function() {
                is_ajax = false;
            });
        }

        function open_modal() {
            $('#modal_form').find('input').each(function() {
                $(this).val('');
            });
            $("#type").val("<?=$type?>");
            $("#modal_register").modal("show");
        }

        $('#mb_hp').on('input', function() {
            var number = $(this).val().replace(/[^0-9]/g, ''); // 입력값에서 숫자가 아닌 것을 모두 제거
            var formatted;

            if (number.length < 4) {
                formatted = number;
            } else if (number.length < 7) {
                formatted = number.slice(0, 3) + '-' + number.slice(3);
            } else if (number.length < 11) {
                formatted = number.slice(0, 3) + '-' + number.slice(3, 6) + '-' + number.slice(6);
            } else {
                // 길이가 11보다 큰 경우, 일반적으로 010-1234-5678 형식을 유지
                formatted = number.slice(0, 3) + '-' + number.slice(3, 7) + '-' + number.slice(7, 11);
            }

            $(this).val(formatted);  // 포맷된 문자열을 입력 필드에 설정
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const modalParam = urlParams.get('modal');

            if (modalParam === 'true') {
                document.body.classList.add('show-only-modal');
                $('#preApplyModal').modal('show'); // 모달 강제 표시
            }
        });
    </script>

    <?php
    //include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
    ?>
