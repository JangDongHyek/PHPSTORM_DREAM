<section id="ver2">

	<ul class="tabs">
		<li class="tab-link current" data-tab="tab-1">비회원</li>
		<li class="tab-link" data-tab="tab-2">첫구매 회원</li>
	</ul>

	<div id="tab-1" class="tab-content current">
		<div class="contsBtn2">
			<div class="btn_wrap">
				<button class="btn btn_large btn_ani" onclick="location.href='/signUp'">
					<div class="tooltip">원하는 약품만 담으면!</div>
					에스티메디 간편 비교견적
					<i class="fa-solid fa-hand-pointer"></i>
					<span>지금 견적 받기 <i class="fa-solid fa-chevron-right"></i></span>
				</button>
			</div>
		</div>
		<div class="contsTitle animate__animated animate__fadeInUp" id="contsTitle">
			<h2>날이 갈수록 부담되는 약제비</h2>
			<h1>비교견적으로 한번에!</h1>
			<h3><i class="fa-duotone fa-angles-down"></i></h3>
		</div>

		<!-- Swiper -->
		<ul class="swiper examSwiper">
			<ul class="nav nav-tabs swiper-pagination"></ul>
			<div class="swiper-wrapper">
                <? foreach($data['data'] as $index => $d){?>
				<div class="swiper-slide">
					<div class="tab-pane active" id="v<?=$index?>">

						<div class="contsTable table">
							<div class="scroll_comm">↔ 좌우로 스크롤 하세요 ↔</div>
							<table class="animate__animated animate__fadeIn  animate__delay-1s">
								<colgroup>
									<col width="55%">
									<col width="15%">
									<col width="15%">
									<col width="15%">
								</colgroup>
								<thead>
								<tr>
									<th>품명</th>
									<th>기존단가</th>
									<th>타사단가</th>
									<th class="bg2"><i class="fa-solid fa-badge-check"></i> ST단가</th>
								</tr>
								</thead>
								<tbody>
                                <?
                                $origin_price_total = 0;
                                $other_price_total = 0;
                                $price_total = 0;
                                ?>
                                <? foreach($d['contents'] as $c) {
                                    $origin_price_total += ($c['origin_price'] * $c['amount']);
                                    $other_price_total += ($c['other_price'] * $c['amount']);
                                    $price_total += ($c['price'] * $c['amount']);
                                ?>
								<tr>
									<td><?=$c['name']?></td>
									<td><?=$c['origin_price']?></td>
									<td><?=$c['other_price']?></td>
									<td><?=$c['price']?></td>
								</tr>
                                <?}?>
								</tbody>
							</table>

						</div>

						<!--숫자증감애니메이션-->
						<div class="counterareabg">
							<div>
								<span class="title txt_gray">기존 합계</span>
								<span class="title txt_gray2">타사 합계</span>
								<span class="title txt_blue">ST 합계 <span><?=number_format((($price_total / $origin_price_total) * 100),2)?>% 절감</span></span>
							</div>
							<div>
								<span class="counter txt_gray" data-start="0" data-end="<?=$origin_price_total?>"><br/>0</span>
								<span class="counter txt_gray2" data-start="0" data-end="<?=$other_price_total?>">0</span>
								<span class="counter txt_blue" data-start="0" data-end="<?=$price_total?>">0</span>
							</div>
						</div>
					</div>
				</div>
                <?}?>

			</div>

			<div class="contsBtn">
				<button class="btn btn_large btn_ani" onclick="location.href='/signUp'">
					<div class="tooltip">직접 비교해보세요!</div>
				비교견적 확인하기 <i class="fa-thin fa-arrow-pointer"></i></button>


				<div class="contsArea" onclick="location.href='#contsTitle'">
					<dl class="animate__animated animate__fadeInUp">

						<div>
							<dt><p class="icon animate__animated animate__flip animate__delay-1s"><i class="fa-regular fa-hand-pointer"></i></p> 쉽고 빠른 견적비교</dt>
							<dd><strong class="txtRed">클릭 한번으로 편리하게</strong>비교견적 확인하세요!</dd>
						</div>
					</dl>
					<dl class="animate__animated animate__fadeInUp">

						<div>
							<dt><p class="icon animate__animated animate__flip animate__delay-2s"><i class="fa-regular fa-money-from-bracket"></i></p> 의약품 저가구매</dt>
							<dd>에스티메디에서 의약품을<strong class="txtRed">저렴하게 구매해보세요!</strong></dd>
						</div>
					</dl>
					<dl class="animate__animated animate__fadeInUp">

						<div>
							<dt><p class="icon animate__animated animate__flip animate__delay-3s"><i class="fa-regular fa-bell-concierge"></i></p>확실한 서비스</dt>
							<dd><strong class="txtRed">간편하고 저렴한 서비스</strong>에스티메디를 이용해보세요!</dd>
						</div>
					</dl>
				</div>
			</div>

		<script>
			$(document).ready(function () {
				// 클래스가 "counter"인 모든 요소를 선택합니다.
				const $counters = $(".counter");

				// 노출 비율(%)과 애니메이션 속도(ms)을 설정합니다.
				const exposurePercentage = 100; // ex) 스크롤 했을 때 $counters 컨텐츠가 화면에 100% 노출되면 숫자가 올라갑니다.
				const duration = 1000; // ex) 1000 = 1초

				// 숫자에 쉼표를 추가할지 여부를 설정합니다.
				const addCommas = true; // ex) true = 1,000 / false = 1000

				// 숫자를 업데이트하고 애니메이션하는 함수 정의
				function updateCounter($el, start, end) {
					let startTime;

					function animateCounter(timestamp) {
						if (!startTime) startTime = timestamp;
						const progress = (timestamp - startTime) / duration;
						const current = Math.round(start + progress * (end - start));
						const formattedNumber = addCommas ? current.toLocaleString() : current;
						$el.text(formattedNumber);

						if (progress < 1) {
							requestAnimationFrame(animateCounter);
						} else {
							$el.text(addCommas ? end.toLocaleString() : end);
						}
					}

					requestAnimationFrame(animateCounter);
				}

				// 초기화 함수 정의
				function initCounters() {
					$counters.each(function () {
						const $el = $(this);
						const start = parseInt($el.data("start"));
						const end = parseInt($el.data("end"));
						// 숫자를 업데이트하고 애니메이션을 시작합니다.
						updateCounter($el, start, end);
					});
				}

				// 초기화 함수 호출
				initCounters();

				// 윈도우의 사이즈가 변경될 때마다 실행됩니다.
				$(window).on('resize', function () {
					if ($(window).width() > 1200) {
						$(window).on('scroll', function () {
							// 각 "counter" 요소에 대해 반복합니다.
							$counters.each(function () {
								const $el = $(this);
								// 요소가 아직 스크롤되지 않았다면 처리합니다.
								if (!$el.data('scrolled')) {
									// 요소의 위치 정보를 가져옵니다.
									const rect = $el[0].getBoundingClientRect();
									const winHeight = window.innerHeight;
									const contentHeight = rect.bottom - rect.top;

									// 요소가 화면에 특정 비율만큼 노출될 때 처리합니다.
									if (rect.top <= winHeight - (contentHeight * exposurePercentage / 100) && rect.bottom >= (contentHeight * exposurePercentage / 100)) {
										const start = parseInt($el.data("start"));
										const end = parseInt($el.data("end"));
										// 숫자를 업데이트하고 애니메이션을 시작합니다.
										updateCounter($el, start, end);
										$el.data('scrolled', true);
									}
								}
							});
						}).scroll(); // 초기화
					} else {
						// 윈도우 사이즈가 1200px 이하일 때 스크롤 이벤트 제거
						$(window).off('scroll');
						// 초기화 함수 호출
						initCounters();
					}
				}).resize(); // 초기화
			});
		</script>
	</div>

	<div id="tab-2" class="tab-content">
        <div id="estimate">
            <estimate-list mb_id="<?=$member['mb_id']?>" INSU_CHECK="<?=$member['INSU_CHECK']?>"></estimate-list>
        </div>

		<script>

			function medicinalSearchPopup() {
				window.open("../medicinalSearch", "popupWindow", "width=600, height=800, scrollbars=no");
			}
			function loadingClick() {
				const div = document.getElementById('loading');
				const div2 = document.getElementById('totalPrice');
				const div3 = document.getElementById('drungChecked');
				const btn1 = document.getElementById('loadingBtn');
				const btn3 = document.getElementById('resultBtn1');
				const btn4 = document.getElementById('resultBtn2');

				if (div.style.display === 'none') {
					div.style.display = 'block';
				}
				setTimeout(function () {
					btn1.style.display = 'none';
					btn3.style.display = 'block';
					btn4.style.display = 'block';
					div.style.display = 'none';
					div2.style.display = 'flex';
					div3.style.display = 'flex';
					$('.fixedPrice').css({'display': 'flex'});
					$('.noControl').css({'marginLeft': '0px'});
					$('.drugs_list').css({'pointer-events': 'none'});
				}, 3000);
			}

			function loadingClick_reset() {
				const div = document.getElementById('loading');
				const div2 = document.getElementById('totalPrice');
				const div3 = document.getElementById('drungChecked');
				const btn1 = document.getElementById('loadingBtn');
				const btn3 = document.getElementById('resultBtn1');
				const btn4 = document.getElementById('resultBtn2');

				if (div.style.display === 'block') {
					div.style.display = 'none';
				}
				btn1.style.display = 'block';
				btn3.style.display = 'none';
				btn4.style.display = 'none';
				div.style.display = 'none';
				div2.style.display = 'none';
				div3.style.display = 'none';
				$('.fixedPrice').css({'display': 'none'});
				$('.noControl').css({'marginLeft': '0px'});
				$('.drugs_list').css({'pointer-events': 'auto'});

			}


		</script>


	</div>

	<div class="contsBanner" id="visual">

		<div class="swiper mainSwiper">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<img src="<?= ASSETS_URL ?>/img/main/visual01.jpg" />
					<div class="slg">
						<h3>에스티메디 OPEN</h3>
						<p>지금 바로 비교견적 해보세요</p>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="<?= ASSETS_URL ?>/img/main/visual02.jpg" />
					<div class="slg">
						<h3>에스티메디 OPEN</h3>
						<p>지금 바로 비교견적 해보세요</p>
					</div>
				</div>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<!-- Initialize Swiper -->
		<script>
			var swiper = new Swiper(".mainSwiper", {
				pagination: {
					el: ".swiper-pagination",
					type: "fraction",
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
		</script>
	</div>

</section>
<style>
	* {
		scroll-behavior: smooth;
	}
	ul.tabs{
		margin: 0px;
		padding: 0px;
		list-style: none;
		position: fixed;
		right: 50px;
		top: 20px;
		z-index: 999;
	}
	ul.tabs li{
		background: none;
		color: #222;
		display: inline-block;
		padding: 10px 15px;
		cursor: pointer;
		background: #ededed;
		font-weight: 800;
	}

	ul.tabs li.current{
		background: #1a2a49;
		color: #fff;
	}

	.tab-content{
		display: none;
	}

	.tab-content.current{
		display: inherit;
	}


</style>

<?php $jl->vueLoad('estimate');?>
<?php $jl->componentLoad('estimate');?>
<?php $jl->componentLoad('item');?>
<?php $jl->componentLoad('modal');?>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const savedTab = localStorage.getItem('activeTab') || 'tab-1';
		activateTab(savedTab);

		const tabLinks = document.querySelectorAll('ul.tabs li');
		tabLinks.forEach(tab => {
			tab.addEventListener('click', function () {
				const tabId = this.getAttribute('data-tab');
				activateTab(tabId);
				// Save the currently active tab to localStorage
				localStorage.setItem('activeTab', tabId);
			});
		});

		function activateTab(tabId) {
			document.querySelectorAll('ul.tabs li').forEach(tab => {
				tab.classList.remove('current');
			});
			document.querySelectorAll('.tab-content').forEach(content => {
				content.classList.remove('current');
			});

			document.querySelector(`ul.tabs li[data-tab="${tabId}"]`).classList.add('current');
			document.getElementById(tabId).classList.add('current');
		}
	});
</script>
