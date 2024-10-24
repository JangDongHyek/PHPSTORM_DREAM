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
		<section id="first02">
			<div class="inr">
				<img src="<?= ASSETS_URL ?>/img/main/clip.png" class="clip">
				<div class="info">
					<h6>STmedi <strong>에스티메디</strong>&nbsp;견적서</h6>
				</div>
				<div class="flex js info">
					<p>공급자 <strong>에스티메디</strong>&nbsp;</p>
					<span>
					<p>견적일 : <?php echo date('Y/m/d ', time()); ?></p>
					<p>&nbsp;| &nbsp; 견적번호 : <?php echo date('Ymd', time()); ?>0001</p>
				</span>
				</div>
				<div class="box_red">
					<p>
						<i class="fa-solid fa-triangle-exclamation"></i> 제품이 검색되지 않을 시, 성분명으로 검색해보세요.
					</p>
				</div>

				<div class="btn_wrap btn_list">
					<a class="btn btn_large btn_line" href="./estimate"><i class="fa-duotone fa-solid fa-floppy-disk"></i> 견적 저장</a>
					<a class="btn btn_large btn_line" href="./estimatePrint" target="_blank"><i class="fa-duotone fa-solid fa-print"></i> 견적 출력</a>
					<a class="btn btn_large btn_line" id=""><i class="fa-duotone fa-solid fa-bags-shopping"></i> 바로 구매</a>
				</div>
				<section class="list_wrap">
					<div class="table_total">
						<h5 class="origin">
							<span>기존 견적 금액</span>
							<span><b>￦<em class="price-wrapper"><div class="price-slash"></div>1,563,250</em></b></span>
							<span class="txt_red txt_bold">&nbsp;<i class="fa-solid fa-down"></i> 58%</span>
						</h5>
						<h5>
							<span>ST 견적 금액</span>
							<span>일금 영 <b><em class="korUnit" data-number="900750"></em>원</b></span>
							<span><b>( ￦<em>900,750</em>)</b> ※부가세 포함</span>
						</h5>
					</div>
					<div class="table_wrap table">
						<table>
							<thead>
							<tr>
								<th>No.</th>
								<th>제품명</th>
								<th>포장단위</th>
								<th>수량</th>
								<th>약가</th>
								<th>총수량</th>
								<th>기존합계</th>
								<th>ST단가</th>
								<th>대체품목</th>
								<th>ST합계</th>
								<th>절감금액</th>
							</tr>
							</thead>
							<tbody>
								<tr>
									<td alt="No.">
										<p>1 <button type="button" class="btn btn_mini btn_black"><i class="fa-solid fa-trash"></i></button></p>

									</td>
									<td alt="제품명">
										<input type="text" value="산텐플루메토론0.02점안액/5ml">
									</td>
									<td alt="포장단위" class="text_right">
										<p><em>포장단위</em>100</p>
									</td>
									<td alt="수량">
										<div class="number_controller">
											<button type="button" onclick="changeCount(, -1)"><i class="fa-regular fa-minus"></i></button>
											<input type="number" name="inputNumber" value="1" onkeyup="this.value=numberChk(this.value);changeCount(, this.value, true)" id="inputNumber">
											<button type="button" onclick="changeCount(, 1)" id="Count_add1102"><i class="fa-regular fa-plus"></i></button>
										</div>
									</td>
									<td alt="약가" class="text_right">
										<p><em>약가</em>1,165</p>
									</td>
									<td alt="총수량" class="text_right">
										<p><em>총수량</em>100</p>
									</td>
									<td alt="기존합계" class="text_right">
										<p><b><em>기존합계</em>116,500</b></p>
									</td>
									<td alt="ST단가" class="text_right">
										<p><em>ST단가</em><b>825</b></p>
									</td>
									<td alt="대체품목">
										<p>
											<b>후메론점안액0.02%/5ml</b>
											<button type="button" data-toggle="modal" data-target="#moreModal1" class="btn btn_mini btn_black">변경</button>
										</p>
									</td>
									<td alt="ST합계" class="text_right">
										<p><em>ST합계</em><b>825</b></p>
									</td>
									<td alt="절감금액" class="text_right">
										<p class="txt_red"><em>절감금액</em><b>34,000</b></p>
									</td>
								</tr>
							<?php for ($i = 0; $i < 19; $i++) { ?>
								<tr>
									<td alt="No.">
										<p class="temp">-</p>
									</td>
									<td alt="제품명" onclick="medicinalSearchPopup()">
										<input type="text" value="제품을 선택하세요." readonly>
									</td>
									<td alt="포장단위" class="text_right">
										<p class="temp">포장단위</p>
									</td>
									<td alt="수량" class="text_right">
										<p class="temp">0</p>
									</td>
									<td alt="약가" class="text_right">
										<p class="temp">0</p>
									</td>
									<td alt="총수량" class="text_right">
										<p class="temp">0</p>
									</td>
									<td alt="기존합계" class="text_right">
										<p class="temp">0</p>
									</td>
									<td alt="ST단가" class="text_right">
										<p class="temp">0</p>
									</td>
									<td alt="대체품목">
										<p class="temp">대체품목</p>
									</td>
									<td alt="ST합계" class="text_right">
										<p class="temp">0</p>
									</td>
									<td alt="절감금액" class="text_right">
										<p class="temp">0</p>
									</td>
								</tr>
							<?php }	?>
								<tr>
									<td colspan="99">
										<button type="button" class="btn btn_mini btn_black">추가</button>
									</td>
								</tr>
							<tr class="bg2">
								<td alt="계" colspan="6" class="text_right">
									기존합계
								</td>
								<td alt="기존합계" colspan="2" class="text_right">
									<p>1,563,250</p>
								</td>
								<td alt="계" colspan="1" class="text_right">
									ST합계
								</td>
								<td alt="ST합계" colspan="2" class="text_right">
									<p>900,750</p>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					<div class="total_table table flex">
						<table>
							<colgroup>
								<col style="width: 50%">
								<col style="width: 50%">
							</colgroup>
							<thead>
								<tr>
									<th>기존 합계</th>
									<th>ST 합계</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1,563,250</td>
									<td>900,750</td>
								</tr>
							</tbody>
						</table>
						<table>
							<colgroup>
								<col style="width: 50%">
								<col style="width: 50%">
							</colgroup>
							<thead>
								<tr>
									<th>차액</th>
									<th>절감 %</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>662,500</td>
									<td class="txt_red">58%</td>
								</tr>
							</tbody>
						</table>
					</div>
					<script>
						// 한자어 숫자 변환을 위한 단위와 숫자 배열
						const units = ['', '만', '억', '조', '경'];
						const digits = ['', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구'];
						const positions = ['', '십', '백', '천'];

						// 숫자를 한글로 변환하는 함수
						function numberToKorean(num) {
							if (num === 0) return '영';
							let result = '';
							let unitIndex = 0;

							while (num > 0) {
								// 네 자리씩 처리 (천, 만, 억 단위)
								let part = num % 10000;
								if (part !== 0) {
									result = convertPart(part) + units[unitIndex] + result;
								}
								unitIndex++;
								num = Math.floor(num / 10000);
							}

							return result.trim();
						}

						// 네 자리 이하 숫자를 한글로 변환하는 함수
						function convertPart(part) {
							let partResult = '';
							const strPart = String(part);
							const len = strPart.length;

							for (let i = 0; i < len; i++) {
								const digit = Number(strPart[i]);
								if (digit !== 0) {
									partResult += digits[digit] + positions[len - i - 1];
								}
							}

							return partResult;
						}

						// .korUnit 클래스를 가진 모든 span에 변환된 한글 숫자 적용
						document.querySelectorAll('.korUnit').forEach(span => {
							const num = parseInt(span.getAttribute('data-number'), 10);
							if (!isNaN(num)) {
								span.textContent = numberToKorean(num);
							}
						});
					</script>
				</section>
			</div>
		</section>

		<button type="button" class="btn btn_ani btn_large" onclick="location.href='./medicinal'"><i class="fa-solid fa-pills"></i> 의약품 바로구매</button>


		<!-- 동일성분약품 Modal -->
		<div class="modal fade more_modal" id="moreModal1" tabindex="-1" aria-labelledby="moreModal1Label"
			 aria-hidden="true">
			<div class="modal-dialog wide">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="drugs_list_cons_modal">
						<div class="box">
							<p class="txt_bold txt_blue">선택 의약품</p>
							<div class="flex jc-sb basic">
								<div>
									<p class="p_name">레바미피드 100mg</p>
								</div>
								<div class="area_text">
									<p class="p_price">40,000원</p>
								</div>
							</div>
						</div>
						<div class="search">
							<input type="search" name="hstx" id="" placeholder="원하시는 제품을 검색하세요" value=""/>
							<button type="button" class="btn" onclick=""><i class="fa-regular fa-magnifying-glass"></i>
							</button>
						</div>

						<p class="txt_bold txt_blue">대체약</p>
						<ul class="drugs_list">
							<li>
								<div class="flex">
									<input type="checkbox" name="" id="more1" value="5">
									<label for="more1">
										<div>
											<p class="p_name">레바미피드 100mg</p>
											<span>제조사 <strong>구매문의</strong> |</span>
											<span>단위 <strong>500T</strong> |</span>
											<span>대체약  <strong>무코스타</strong></span>
										</div>
										<div class="area_text">
											<p class="p_price">40,000원</p>
										</div>
									</label>
								</div>
							</li>

						</ul>
						<div class="paging">
							<div class="pagingWrap">
								<!--처음-->

								<!--이전-->

								<!--페이지-->
								<a class="active" href="javascript:void(0)">1</a>
								<a class="" onclick="callContent()" href="?page=2&amp;">2</a>
								<a class="" href="?page=3&amp;">3</a>
								<a class="" href="?page=4&amp;">4</a>
								<a class="" href="?page=5&amp;">5</a>

								<!--다음-->
								<a class="next disabled" href="?page=11&amp;"><i class="fa-light fa-chevron-right"></i></a>

								<!--마지막-->
								<a class="last disabled" href="?page=101&amp;"><i
										class="fa-light fa-chevrons-right"></i></a>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<!--
						<button type="button" class="btn btn_middle btn_gray" data-dismiss="modal">닫기</button>
						-->
						<button type="button" class="btn btn_middle btn_blue" data-dismiss="modal">선택 완료</button>
					</div>
				</div>
			</div>
		</div>


		<form name="order" autocomplete="off" method="post">
			<input type="hidden" name="productIdx" value=""/> <!--상품인덱스-->
			<input type="hidden" name="productCnt" value=""/> <!--구매수량-->
			<input type="hidden" name="totalPrice" value=""/> <!--총상품금액-->
			<input type="hidden" name="totalPrice2" value=""/> <!--총 원가 상품금액-->
		</form>

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
