<?php
$member = session()->get('member') ?? [];

?>
<!--광고가입신청-->
<section class="ad form">
    <form name="adverts" autocomplete="off">
        <div class="inner">
            <div class="form">
                <span class="txt_color">부산이사몰 광고회원</span>
                <h2>광고 회원가입</h2>
                <div class="banner">
                    <img src="<?=base_url()?>img/event_banner.jpg" alt="" class="pc" />
                    <img src="<?=base_url()?>img/event_banner_m.jpg" alt="" class="mobile" />
                </div>
                <form>
                    <h4>기본 정보</h4>
                    <div class="box_gray">
                        <div class="grid grid2">
                            <dl class="form_wrap">
                                <dt><label for="companyName">업체명</label></dt>
                                <dd><input type="text" name="companyName" id="companyName" value="<?=$member['company_name'] ?? ''?>" placeholder="업체명"/></dd>
                            </dl>
                            <dl class="form_wrap">
                                <dt><label for="cpTel">연락처</label></dt>
                                <dd><input type="tel" name="cpTel" id="cpTel" value="<?=$member['mb_hp'] ?? ''?>" placeholder="연락처" data-format="tel"/></dd>
                            </dl>
                        </div>
                    </div>
                    <hr>
                    <h4>광고 신청(필수입력사항)</h4>
                    <div class="guide">
                        <p>※ 광고 회원 <strong class="txt_black">월 20만원</strong> (<span class="txt_color"> <i class="fa-duotone fa-square-check"></i> 기본 3개 지역</span> 선택 포함)</p>
                        <p>※ 추가 지역 선택 시, <strong class="txt_black">지역당 10만원</strong> 추가</p>
                    </div>
                    <div class="box_gray">
                        <dl class="form_wrap">
                            <dt><label for="">광고지역 선택 <!--<strong class="txt_color">(3개)선택한 지역 개수 표기</strong>--></label></dt>
                            <dd class="flex">
                                <select name="areaSi" id="areaSi" >
                                    <option value="부산" selected>부산</option>
                                    <option value="울산">울산</option>
                                    <option value="경남">경남</option>
                                </select>

                            </dd>
                            <dd class="grid grid6" id="areaGu">

                            </dd>
                        </dl>
                    </div>
                    <br>
                    <h4>광고 선택상품</h4>
                    <div class="box_gray">
                        <div class="ad_option grid grid2">
                            <div>
                                <input type="checkbox" id="main_ad" name="mainYn" value="Y" class="absolute">
                                <label for="main_ad">
                                    <p>
                                        <span class="txt_color">타입1.</span>
                                        메인 노출 상품 <strong class="txt_black">(노출 위치당 40만원)</strong>
                                    </p>
                                    <div class="info">
                                        <div class="img">
                                            <img src="<?=base_url()?>/img/ad_type01.jpg" />
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" id="premium_ad" name="preYn" value="Y" onchange="togglePremiumArea()" class="absolute">
                                <label for="premium_ad">
                                    <p>
                                        <span class="txt_color">타입2.</span>
                                        프리미엄 지역광고 상품 <strong class="txt_black">(지역당 10만원)</strong>
                                    </p>
                                    <div class="info">
                                        <div class="img">
                                            <img src="<?=base_url()?>/img/ad_type03_01.jpg" />
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <div class="main_area" style="display: none;">
                                    <div class="box_color">
                                        <dl class="form_wrap">
                                            <dt><label>노출 위치 선택</label></dt>
                                            <dd class="select">
                                                <input type="checkbox" id="main_top_list" value="Y" name="mainTop">
                                                <label for="main_top_list">메인 상단 리스트 노출</label>

                                                <input type="checkbox" id="main_bottom_list" value="Y" name="mainBottom">
                                                <label for="main_bottom_list">메인 하단 리스트 노출</label>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="premium_area" style="display: none;">
                                <div class="box_color">
                                    <dl class="form_wrap">
                                        <dt><label for="">프리미엄 지역 선택 <!--<strong class="txt_color">(2개)선택한 지역 개수 표기</strong>--></label></dt>
                                        <dd class="flex">
                                            <select name="areaSi2" id="areaSi2" >
                                                <option value="부산" selected>부산</option>
                                                <option value="울산">울산</option>
                                                <option value="경남">경남</option>
                                            </select>
                                        </dd>
                                        <dd class="grid grid4" id="areaGu1">

                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 <?= !empty($cardInfo) ? 'hidden' : '' ?> >결제정보</h4>
                    <div class="payment" <?= !empty($cardInfo) ? 'hidden' : '' ?>>
                        <div class="select">
                            <input type="radio" name="payment" id="card" onclick="showForm('cardForm')" checked>
                            <label for="card">카드결제</label>
                            <input type="radio" name="payment" id="cms" onclick="showForm('cmsForm')" disabled> <!--disabled-->
                            <label for="cms">CMS결제</label>
                        </div>
                        <div class="box_gray">
                            <!-- 카드결제 -->
                            <?
                            $number = $cardInfo['card_num'] ?? '';
                            $chunks = str_split($number, 4);
                            ?>
                            <dl class="form_wrap" id="cardForm">
                                <dt><label for="">카드번호 입력</label></dt>
                                <dd class="flex gap5">
                                    <input type="text" name="cardNum00" id="cardNum00" maxlength="4" value="<?=$chunks[0]?>" placeholder="4자리"/>
                                    <input type="text" name="cardNum01" id="cardNum01" maxlength="4" value="<?=$chunks[1]?>" placeholder="4자리"/>
                                    <input type="text" name="cardNum02" id="cardNum02" maxlength="4" value="<?=$chunks[2]?>" placeholder="4자리"/>
                                    <input type="password" name="cardNum03" id="cardNum03" maxlength="4" value="<?=$chunks[3]?>" placeholder="4자리"/>
                                </dd>
                                <dt><label for="cardMm">유효기간</label></dt>
                                <?
                                $exp = $cardInfo['card_exp'] ?? '';
                                $yymm = str_split($exp, 2);
                                ?>
                                <dd class="flex gap5"><input type="text" name="cardMm" id="cardMm" value="<?=$yymm[1] ?? ''?>" placeholder="MM"/>
                                    <input type="text" name="cardYy" id="cardYy" value="<?=$yymm[0] ?? ''?>" placeholder="YY"/></dd>
                                <dt><label for="cardPwd">카드 비밀번호 앞 2자리</label></dt>
                                <dd class="flex gap5">
                                    <input type="password" name="cardPwd" id="cardPwd" value="<?=$cardInfo['card_pwd']?>" maxlength="2" placeholder="카드 비밀번호 앞 2자리"/>
                                </dd>
                                <dt><label for="idNum">카드인증번호</label></dt>
                                <dd><input type="text" name="idNum" id="idNum" value="<?=$cardInfo['idNum']?>" placeholder="개인: 주민번호 앞6자리 / 법인: 사업자번호 10자리"/></dd>
                            </dl>

                            <!-- CMS결제 -->
                            <dl class="form_wrap" id="cmsForm" style="display: none;">
                                <dt><label for="">은행명</label></dt>
                                <dd>
                                    <select>
                                        <option>국민은행</option>
                                    </select>
                                </dd>
                                <dt><label for="accountInfo">계좌정보 입력</label></dt>
                                <dd><input type="text" name="accountInfo" id="accountInfo" value="" placeholder="계좌정보"/></dd>
                                <dt><label for="accountHolder">예금주</label></dt>
                                <dd><input type="text" name="accountHolder" id="accountHolder" value="" placeholder="예금주"/></dd>
                            </dl>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <div class="sticky">
                    <details class="result" open>
                        <summary>
                            <h4>선택한 상품</h4>
                        </summary>
                        <input type="hidden" name="basicPrice" value=""> <!--기본가격-->
                        <input type="hidden" name="prePrice" value=""> <!-- 프리미엄 가격 -->
                        <input type="hidden" name="mainPrice" value=""> <!-- 메인가격 -->
                        <input type="hidden" name="mainTopPrice" value=""> <!-- 메인상단 -->
                        <input type="hidden" name="mainBottomPrice" value=""> <!-- 메인하단 -->
                        <input type="hidden" name="areaGu"> <!--기본 지역-->
                        <input type="hidden" name="preArea"> <!-- 프리미엄 지역 -->
                        <input type="hidden" name="orderPrice"> <!--주문 금액-->
                        <input type="hidden" name="discount"> <!--할인가격-->
                        <input type="hidden" name="totalAmt"> <!--총가격-->
                        <div class="details">
                            <div class="box_gray">
                                <ul>
                                    <li class="flex ai-c jc-sb">
                                        <div>
                                            <span class="txt_color">광고 회원</span>
                                            <p>기본 상품</p>
                                            <!--<span><i class="fa-duotone fa-circle-plus"></i> 추가 지역 2개 (+200,000원)</span>-->
                                            <span id="basicPriceSpan" style="display: none;"></span>
                                        </div>
                                        <div class="price"><span id="basicPrice">0</span>원</div>
                                    </li>
                                    <li class="flex ai-c jc-sb">
                                        <div>
                                            <span class="txt_color">선택상품 타입 1</span>
                                            <p>메인 노출 상품</p>
                                        </div>
                                        <div class="price"><span id="mainPrice">0</span>원</div>
                                    </li>
                                    <li class="flex ai-c jc-sb">
                                        <div>
                                            <span class="txt_color">선택상품 타입 2</span>
                                            <p>프리미엄 지역광고 상품</p>
                                            <!--<span><i class="fa-duotone fa-circle-plus"></i> 지역 2개 (+200,000원)</span>-->
                                            <span id="prePriceSpan" style="display: none;"></span>
                                        </div>
                                        <div class="price"><span id="prePrice">0</span>원</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="box_line">
                                <input type="checkbox" id="discount" name="discountRate" checked value="0.5">
                                <label for="">부산이사몰 오픈 할인 이벤트 50% 적용</label>
                            </div>
                        </div>
                    </details>
                    <div class="box_red flex ai-c jc-sb">
                        <p class="txt_up txt_bold">총 결제 예정 금액</p>
                        <div class="price">
                            <del id="noSale"><span id="total">0</span>원</del>
                            <strong><span id="sale">0</span>원</strong>
                        </div>
                    </div>


                    <div class="box_gray">
                        <ul>
                            <li class="flex ai-c jc-sb">
                                <div>
                                    <p>할부</p>
                                    <!--<span><i class="fa-duotone fa-circle-plus"></i> 추가 지역 2개 (+200,000원)</span>-->
                                    <span id="basicPriceSpan" style="display: none;"></span>
                                </div>
                                <select name="cardQuota">
                                    <option value="00">일시불</option>
                                    <? for($i = 1; $i <= 12; $i++):?>
                                        <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>""><?=$i?>개월</option>
                                    <? endfor;?>
                                </select>
                            </li>
                        </ul>
                    </div>
                    <button type="submit" class="btn btn_large btn_color">광고신청완료</button>
                </div>
            </div>
        </div>
    </form>

</section>
<script src="<?= base_url()?>js/app/ad_form.js?<?=JS_VER?>"></script>
<script>
    //결제정보
    function showForm(formId) {
        document.getElementById('cardForm').style.display = 'none';
        document.getElementById('cmsForm').style.display = 'none';

        document.getElementById(formId).style.display = 'block';
    }

    // 메인광고 및 프리미엄 지역 선택
    function toggleAdArea() {
        const premiumAdCheckbox = document.getElementById("premium_ad");
        const mainAdCheckbox = document.getElementById("main_ad");
        const premiumArea = document.querySelector(".premium_area");
        const mainArea = document.querySelector(".main_area");

        if (premiumAdCheckbox.checked) {
            premiumArea.style.display = "block";
        } else {
            premiumArea.style.display = "none";
        }

        if (mainAdCheckbox.checked) {
            mainArea.style.display = "block";
        } else {
            mainArea.style.display = "none";
        }

        if (!premiumAdCheckbox.checked && !mainAdCheckbox.checked) {
            premiumArea.style.display = "none";
            mainArea.style.display = "none";
        }
    }

    document.getElementById("premium_ad").addEventListener("change", toggleAdArea);
    document.getElementById("main_ad").addEventListener("change", toggleAdArea);


    //선택상품
    function toggleDetails() {
        const details = document.querySelector('.result');
        if (window.innerWidth > 992) {
            details.setAttribute('open', '');
        } else {
            details.removeAttribute('open');
        }
    }

    // 초기화 및 화면 크기 변경 시 실행
    window.addEventListener('resize', toggleDetails);
    window.addEventListener('load', toggleDetails);
</script>