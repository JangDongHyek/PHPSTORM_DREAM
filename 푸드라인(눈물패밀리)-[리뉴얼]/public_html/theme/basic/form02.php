<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
include_once(G5_THEME_PATH.'/head.php');
?>


<div id="idx_wrapper">
        <!--<div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">L</span>INE SERVICE</span>
            <h3>
                <p class="wow fadeInUp" data-wow-delay="0.4s">사장님이 믿고 맡기는 푸드<span class="txtRed">라</span>인</p>
                <p class="wow fadeInUp" data-wow-delay="0.5s">신뢰와 안심, 그리고 항상 더 나은 서비스</p>
            </h3>
        </div>-->
        
		   <div class="scontents wow fadeInDownBig" data-wow-delay="0.3s">



		<div class="scon_left">
			<div class="sub_title_wr wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
				<h2 class="sub_title">배달대행 문의</h2>
				<p class="sub_desc">기업 본사 배달제휴 문의</p>
			</div>
		</div>

		<div class="scon_right">
			<div class="delivery_list">
				<ul>
					<li class=" other">
						<a href="<?php echo G5_URL ?>/form01.php">						
							<strong>일반 매장 배달대행 문의</strong>
						</a>
					</li>
					<li class="active other">
						<a href="<?php echo G5_URL ?>/form02.php">		
							<strong>기업 본사 배달제휴 문의</strong>
						</a>
					</li>
				</ul>
			</div>

			<div class="formWarp">
				<iframe name="bnk_ifr_aa" id="bnk_ifr_aa" style="display:none;"></iframe>
				<form name="fwrite" id="fwrite" action="https://onnaplus.com/bbs/onlinewrite_update.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" target="bnk_ifr_aa">
					<input type="hidden" name="w" value="">
					<input type="hidden" name="bo_table" value="onlinewrite">					<input type="hidden" name="on_category" value="기업 본사 배달제휴 문의">
					<input type="hidden" name="fname" value="fwrite">
					<input type="hidden" name="on_subject" value="기업 본사 배달제휴 문의">

					<div class="formArea">
						<ul>							
							<li>
								<dl>
									<dt>
										<span>이름/직급</span><span class="red">*</span>
									</dt>
									<dd>
										<input type="text" name="on_name" placeholder="예) 홍길동/대리" required="">
									</dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>
										<span>연락처</span><span class="red">*</span>
									</dt>
									<dd>
										<input type="text" name="on_hp" placeholder="예) 010-1234-5678 " required="">
									</dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>
										<span>법인명(브랜드명)</span><span class="red">*</span>
									</dt>
									<dd>
										<input type="hidden" name="on_1_subj" value="법인명(브랜드명)">
										<input type="text" name="on_1" placeholder="법인명(브랜드명)" required="">
									</dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>
										<span>희망 배달 품목</span><span class="red">*</span>
									</dt>
									<dd>
										<input type="hidden" name="on_2_subj" value="희망 배달 품목">
										<input type="text" name="on_2" placeholder="희망 배달 품목" required="">
									</dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>
										<span>희망 배달 지역</span><span class="red">*</span>
									</dt>
									<dd>
										<input type="hidden" name="on_3_subj" value="희망 배달 지역">
										<input type="text" name="on_3" placeholder="예) 강남구, 서초구 일대 / 부산 / 전국구 등" required="">
									</dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>
										<span>이메일</span><span class="red">*</span>
									</dt>
									<dd>
										<input type="text" name="on_email" id="" placeholder="예) email@email.com" required="" value="">
									</dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>
										<span>문의 사항 (300자 이내)</span>
									</dt>
									<dd>
										 <textarea placeholder="자유롭게 문의 사항을 남겨 주세요" name="on_content" maxlength="300"></textarea>
									</dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>
										<span>자동등록방지</span><span class="red">*</span>
									</dt>
									<dd>
										
<script>var g5_captcha_url  = "https://onnaplus.com/plugin/kcaptcha";</script>
<script src="https://onnaplus.com/plugin/kcaptcha/kcaptcha.js"></script>
<fieldset id="captcha" class="captcha m_captcha">
<legend><label for="captcha_key">자동등록방지</label></legend><audio id="captcha_audio" controls="" src="https://onnaplus.com/data/cache/kcaptcha-e657fc527eea685697ca8f3015062fad_1739928275.mp3?t=1739928274387"></audio>
<img src="https://onnaplus.com/plugin/kcaptcha/kcaptcha_image.php?t=1739928274350" alt="" id="captcha_img"><input type="text" name="captcha_key" id="captcha_key" required="" class="captcha_box required" size="6" maxlength="6">
<button type="button" id="captcha_reload"><span></span>새로고침</button>
<span id="captcha_info">자동등록방지 숫자를 순서대로 입력하세요.</span>
</fieldset>									</dd>
								</dl>
							</li>
						</ul>
					</div>
					<div class="agree">
						<div class="agree_list" style="text-align:left;">
							<p></p><table width="99%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
	<td height="25" class="align_left" style="line-height: 18px; border:0px;"><strong>개인정보의 수집목적 및 이용 </strong></td>
</tr>
<tr>
	<td class="align_left" style="line-height: 18px; border:0px;">
		개인정보를 수집하는 목적은 푸드라인만의 정보와 맞춤회된 서비스를 제공하기 위하여 필요한 최소한의 정보만 수집하고 있습니다.<br><br>
		푸드라인에 등록하신 모든 회원과 방문객의 개인정보는 기본 수집 목적 이외에 다른 용도로 이용하거나 회원님의 동의 없이 제3자에게 제공할 수 없으며 회원정보와 관련한 회원이 피해를 입을 경우 이에 대한 모든 책임은 푸드라인에서 집니다.<br><br>
		개인정보수집 또는 이용에 대한 동의 철회시 푸드라인은(는) 개인정보를 수집하지 않으며 개인정보는 철회와 동시에 삭제됩니다.
	</td>
</tr>
<tr>
	<td height="25" class="align_left" style="line-height: 18px; border:0px;"><br><strong>수집하는 개인정보 항목 및 수집방법</strong></td>
</tr>
<tr>
	<td class="align_left" style="line-height: 18px; border:0px;">푸드라인은(는) 이용자의 정보 수집시 서비스 제공에 필요한 최소한의 정보만을 수집하며 민감한 개인정보의 수집을 엄격히 제한하고 있습니다.<br><br>
		<table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
		<tbody>
		<tr>
			<td class="align_left" style="line-height: 18px; border:0px; padding:5px;" bgcolor="#efefef">* 필수사항 : 이름, 매장정보, 사업자정보, 회사명, 주소, 연락처</td>
		</tr>
		<tr>
			<td class="align_left" style="line-height: 18px; border:0px; padding:5px;" bgcolor="#efefef">* 선택사항 : 이메일주소</td>
		</tr>
		</tbody>
		</table>
		<br>
	</td>
</tr>
<tr>
	<td height="25" class="align_left" style="line-height: 18px; border:0px;"><strong>개인정보의 보유 및 이용기간</strong></td>
</tr>
<tr>
	<td class="align_left" style="line-height: 18px; border:0px;">
		푸드라인은(는) 방문객께서 푸드라인이(가) 제공하는 서비스를 받는 동안 개인정보를 계속 보유하며 맞춤화된 서비스 제공을 위해 이용하게 됩니다. 다만 방문객께서 탈퇴를 원하시거나 푸드라인 약관에 의거 방문객자격 상실의 경우에는 등록된 방문객의 정보는 완전히 삭제되며 어떠한 용도로도 열람 또는 이용할 수 없도록 처리됩니다.
	</td>
</tr>
</tbody></table><p></p>
						</div>
						<input type="checkbox" required="" id="cka">&nbsp;<label for="cka">개인정보처리방침에 동의</label>
					</div>
					<div class="online_bt">
						<button type="submit" class="btn_ok" id="btn_submit">제출하기 <i class="fa-solid fa-angles-right"></i></button>
					</div>
				</form>
			</div>
		</div>
		
        <!--<div class="line">
            <div class="wow fadeInDownBig" animation-duration="1s" data-wow-delay="0s"></div>
            <div class="wow fadeInRightBig" animation-duration="1s" data-wow-delay="0.5s"></div>
        </div>-->
    </div>


    


    <!--<section class="idx_review">
        <div class="titleArea">
            <span class="wow fadeInDown" data-wow-delay="0.3s">FOOD<span class="txtRed">LINE</span> STORY</span>
            <h3 class="wow fadeInUp" data-wow-delay="0.4s">푸드<span class="txtRed">라</span>인 스토리</h3>
        </div>
        <div class="swiper swiperReview wow fadeInUp" data-wow-delay="0.5s">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_01.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="imgArea">
                            <img src="<?php /*echo G5_THEME_IMG_URL */?>/sub/introduce_02.jpg">
                        </div>
                        <div class="txtArea">
                            <span>Customer-centric</span>
                            <p>푸드라인은‘고객중심적’입니다.</p>
                            <div>“현장은 곧 고객이다"는 신념으로 현장에서 일어나는 실질적인 문제를 찾아 해결합니다.</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </section>-->
    <section class="idx_overview wow fadeInDown" data-wow-delay="0.3s">
        <div class="inr">
            <div class="text">
                <div class="line wow fadeInLeft" data-wow-delay="0.4s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/foodline.png">
                </div>
                <h4>
                    <p class="wow fadeInLeft" data-wow-delay="0.5s">언제나, 정직하게 모두를 위한 기회 실현이</p>
                    <p class="txtRed wow fadeInRight" data-wow-delay="0.6s">푸드라인이 열어가겠습니다.</p>
                </h4>
                <div class="conts wow fadeInLeft" data-wow-delay="0.7s">
                    편리하고 효율적인 시스템과 전문적인 컨설팅을 통해 <br>
                    최상의 서비스를 약속드립니다. <br>
                    라이더와 가맹점 모두가 상생하는 미래, 푸드라인이 만듭니다.
                </div>
            </div>
        </div>
    </section>
</div>
    <script>
        // Initialize Swiper when the DOM is ready
        document.addEventListener('DOMContentLoaded', function () {
            //메인
            var mySwiper = new Swiper('.swiperVisual', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 6000, // milliseconds
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            //서비스
            var swiper = new Swiper(".swiperService", {
                scrollbar: {
                    el: ".swiper-scrollbar",
                    hide: false,
                },
                mousewheel: {
                    enabled: true,
                },
            });

            //리뷰
            var swiper = new Swiper(".swiperReview", {
                slidesPerView: 1,
                spaceBetween: 30,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                loop: true, // Enable looping
                autoplay: {
                    delay: 3000, // Set the delay in milliseconds
                    disableOnInteraction: false, // Allow manual navigation while autoplay is active
                },
                breakpoints: {
                    // When window width is <= 768px, set slidesPerView to 1
                    1200: {
                        slidesPerView: 3,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                },
            });
        });
    </script>

<?php
include_once(G5_PATH.'/tail.php');
?>