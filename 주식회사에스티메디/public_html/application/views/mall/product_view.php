<div id="products_view">
	<div class="area_top">
		<div class="area_img">
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="<?= ASSETS_URL ?>/img/sub/sample.jpg" />
                    </div>
                    <div class="swiper-slide">
						<img src="<?= ASSETS_URL ?>/img/sub/sample.jpg" />
                    </div>
                </div>
            </div>
            <div thumbsSlider="" class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
						<img src="<?= ASSETS_URL ?>/img/sub/sample.jpg" />
                    </div>
					<div class="swiper-slide">
						<img src="<?= ASSETS_URL ?>/img/sub/sample.jpg" />
					</div>
                </div>
            </div>
            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".mySwiper", {
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesProgress: true,
                });
                var swiper2 = new Swiper(".mySwiper2", {
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    thumbs: {
                        swiper: swiper,
                    },
                });
            </script>
		</div>
		<div class="area_text">
			<div class="location"><i class="fa-light fa-house-blank"></i> 홈 <i class="fa-light fa-angle-right"></i>
				<strong>소모품</strong></div>
			<h2>정맥카테터(I.V CATH)</h2>
			<div class="info">
				<dl>
					<dt>제품명</dt>
					<dd>정맥카테터(I.V CATH)</dd>
					<dt>제조사</dt>
					<dd>한국백신</dd>
				</dl>
				<dl>
					<dt>단위</dt>
					<dd>통(50ea/통)</dd>
					<dt>규격</dt>
					<dd>24G 0.75inch</dd>
				</dl>
			</div>
			<div class="delivery">
				<dl>
					<dt>배송방법</dt>
					<dd>택배(15시 이전 입금 확인시 당일발송)</dd>
					<dt>배송비</dt>
					<dd>3,500원 (60,000원 이상 구매 시 무료)</dd>
				</dl>
			</div>
			<div class="option">
				<dl>
					<dt>기본가격</dt>
					<dd><strong class="txt_sky">13,900원</strong></dd>
				</dl>
				<dl>
					<dt>구매수량</dt>
					<dd>
						<p class="number_controller">
							<button type="button" onclick="changeOptionCount(this, -1)"><i
										class="fa-regular fa-minus"></i></button>
							<input type="number" name="optCnt" value="1"/>
							<button type="button" onclick="changeOptionCount(this, 1)"><i
										class="fa-regular fa-plus"></i></button>
						</p>
					</dd>
				</dl>
                <!--선택옵션-->
				<dl style="display: none;">
					<dt>옵션선택</dt>
					<dd>
						<select name="option" onchange="addOption(this)">
							<option value="">옵션 선택</option>
							<option value="2725" data-name="1박스(30포)" data-price="39,600">1통 (+13,900원)</option>
							<option value="2726" data-name="5박스(150포)" data-price="198,000">1통 (+13,900원)
							</option>
						</select>
					</dd>
				</dl>
				<ul class="optionlist" style="display: none;">
					<li>
                        <p>1박스(30포)</p>
						<div class="flex">
							<input type="hidden" name="optIdx" value="2725">
							<input type="hidden" name="optPrice" value="39600">
							<p class="number_controller">
								<button type="button" onclick="changeOptionCount(this, -1)"><i
											class="fa-regular fa-minus"></i></button>
								<input type="number" name="optCnt" value="1">
								<button type="button" onclick="changeOptionCount(this, 1)"><i
											class="fa-regular fa-plus"></i></button>
							</p>
							<strong class="op_price">13,900원</strong>
							<button class="delete" onclick="deleteOption(this)"><i class="fa-light fa-close"></i>
							</button>
						</div>
					</li>
                    <li>
                        <p>1통</p>
                        <div class="flex">
                            <input type="hidden" name="optIdx" value="2725">
                            <input type="hidden" name="optPrice" value="39600">
                            <p class="number_controller">
                                <button type="button" onclick="changeOptionCount(this, -1)"><i
                                            class="fa-regular fa-minus"></i></button>
                                <input type="number" name="optCnt" value="1">
                                <button type="button" onclick="changeOptionCount(this, 1)"><i
                                            class="fa-regular fa-plus"></i></button>
                            </p>
                            <strong class="op_price">13,900원</strong>
                            <button class="delete" onclick="deleteOption(this)"><i class="fa-light fa-close"></i>
                            </button>
                        </div>
                    </li>
				</ul>
                <!--/선택옵션-->
			</div>
			<div class="total">
				<div class="total_price">
					<p class="text">총 상품금액</p>
					<p class="price txt_blue">13,900원</p>
				</div>
				<div class="btn_wrap">
					<a class="btn btn_middle btn_blueline">장바구니 담기</a>
					<a class="btn btn_middle btn_blue">바로 주문</a>
				</div>

			</div>
		</div>
	</div>

	<div class="area_view">
		<div role="tabpanel">

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#tab-view" aria-controls="tab-view" role="tab"
														  data-toggle="tab">상품 상세정보</a></li>
				<li role="presentation"><a href="#tab-info" aria-controls="tab-info" role="tab" data-toggle="tab">상품
						구매정보</a></li>
				<li role="presentation"><a href="#tab-review" aria-controls="tab-review" role="tab" data-toggle="tab">상품후기<strong
								class="txt_sky">(21)</strong></a></li>
				<li role="presentation"><a href="#tab-qna" aria-controls="tab-qna" role="tab"
										   data-toggle="tab">상품문의<strong class="txt_sky">(21)</strong></a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="tab-view">

					<img src="<?= ASSETS_URL ?>/img/sub/sample.jpg" />
				</div>
				<div role="tabpanel" class="tab-pane" id="tab-info">
					<dl>
						<dt>배송정보</dt>
						<dd><p>- 주문하신 제품의 판매자가 다른 경우 부분배송되며, 실제 배송 상황에 따라 1~2일 정도 차이가 발생할 수 있습니다.</p>
							<p>- 입금확인후 2~5일이내(토,일,공휴일제외)에 배송되며 도서산간지역의 경우 배송일이 추가소요 될 수 있습니다.</p>
							<p>- 제주도 및 도서산간 지역의 경우 제품수령시 추가배송비가 과금될 수 있습니다.</p>
							<p>- 단,특정 업체별로 배송료 부과 기준을 달리하는 경우에는 각 상품별로 공지된 상품설명에 따릅니다.</p>
						</dd>
					</dl>
					<dl>
						<dt>교환 및 반품정보</dt>
						<dd><strong>교환 및 반품이 가능한 경우</strong>
							<p>1. 상품 수령 후 사용하지 않으신 경우에 한하여, 상품을 받거나 공급이 개시된 날로부터 7일 이내 교환 및 반품이 가능합니다.</p>
							<p>2. 받으신 상품의 내용이 표시·광고 사항과 다른 경우에는 상품들을 받으신 날로부터 3개월 이내</p>
							<p>3. 전자상거래등에서의 소비자보호에관한법률에 규정되어 있는 소비자 청약철회 가능범위에 해당되는 경우 고객님의 단순한 변심에 의해 상품의 교환 및 반품을
								요청하시는 경우에는 상품 반송에 소요되는 비용을 고객님이 부담하셔야 합니다.</p>
						</dd>
						<dd><strong>교환 및 반품이 불가능한 경우</strong>
							<p>1. 고객님의 단순변심으로 인한 교환/반품 요청이 상품을 수령한 날로부터 7일을 경과한 경우</p>
							<p>2. 고객님의 책임 있는 사유로 상품 등의 가치가 심하게 파손되거나 훼손된 경우</p>
							<p>3. 시간이 경과되어 재판매가 곤란할 정도로 상품등의 가치가 상실된 경우 (예:신선식품 등)</p>
							<p>4. 배송된 상품이 하자없음을 확인한 후 설치가 완료된 상품의 경우</p>
							<p>5. 고객님의 요청에 따라 개별적으로 주문 제작되는 상품의 경우</p>
							<p>6. 구매하신 상품의 구성품이 누락된 경우</p>
							<p>7. 복제가 가능한 상품등의 포장을 훼손한 경우 (예:도서, DVD, CD등 복제 가능한 상품)</p>
							<p>8. 기타, 전자상거래등에서의 소비자보호에관한볍률이 정하는 소비자 청약철회 제한에 해당되는 경우</p>
						</dd>
					</dl>
					<dl>
						<dt>환불안내</dt>
						<dd><strong>교환 및 반품이 가능한 경우</strong>
							<p>1. 신용카드 결제 : 상품 회수 확인 후 해당 카드사로 청구취소 요청(약 7일 정도 소요)</p>
							<p>2. 무통장 입금 : 상품 회수 확인 후 3일 이내에 환불 처리</p>
							<p>3. 인터넷 안전결제 ISP 결제 : 상품회수 확인 후 매달 1,8,15,22일 해당 카드사로 청구취소 요청</p>
						</dd>
					</dl>
				</div>
				<div role="tabpanel" class="tab-pane" id="tab-review">
					<!-- Button trigger modal -->
					<a class="btn btn_small btn_gray" data-toggle="modal" data-target="#reviewForm">
						상품후기 작성하기
					</a>

					<div class="board_list">
						<p>총 <strong class="txt_blue">6</strong>개 </p>
						<ul>
							<li data-toggle="modal" data-target="#reviewModal">
								<p class="p_num">6</p>
								<p class="p_title">빠른 배송 감사합니다!</p>
								<p class="p_user">**병원</p>
								<p class="p_date">2023.05.06</p>
							</li>
							<li data-toggle="modal" data-target="#reviewModal">
								<p class="p_num">5</p>
								<p class="p_title">빠른 배송 감사합니다!</p>
								<p class="p_user">**병원</p>
								<p class="p_date">2023.05.06</p>
							</li>
							<li data-toggle="modal" data-target="#reviewModal">
								<p class="p_num">4</p>
								<p class="p_title">빠른 배송 감사합니다!</p>
								<p class="p_user">**병원</p>
								<p class="p_date">2023.05.06</p>
							</li>
							<li data-toggle="modal" data-target="#reviewModal">
								<p class="p_num">3</p>
								<p class="p_title">빠른 배송 감사합니다!</p>
								<p class="p_user">**병원</p>
								<p class="p_date">2023.05.06</p>
							</li>
							<li data-toggle="modal" data-target="#reviewModal">
								<p class="p_num">2</p>
								<p class="p_title">빠른 배송 감사합니다!</p>
								<p class="p_user">**병원</p>
								<p class="p_date">2023.05.06</p>
							</li>
							<li data-toggle="modal" data-target="#reviewModal">
								<p class="p_num">1</p>
								<p class="p_title">빠른 배송 감사합니다!</p>
								<p class="p_user">**병원</p>
								<p class="p_date">2023.05.06</p>
							</li>
						</ul>
						<div class="paging">
							<div class="pagingWrap">
								<a class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
								<a class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
								<a class="active">1</a>
								<a>2</a>
								<a>3</a>
								<a>4</a>
								<a>5</a>
								<a>6</a>
								<a>7</a>
								<a class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
								<a class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="tab-qna">
					<div class="qna_info">
						상품에 대한 궁금하신 점이나 서비스 이용에 불편한 점이 있으신가요?<br>
						문제가 되거나 궁금한 사항 등을 남겨주시면 정성껏 빠르게 답변해드리겠습니다.<br>
						해당 게시판의 성격과 다른 글은 사전 동의 없이 이동하거나 외부 광고성 글은 삭제하고 있으니 양해를 부탁드립니다.
						<div class="box">
							전화 문의 <strong>1234-5678</strong><br>
							평일 오전 9시~오후6시 (점심시간 12시~1시)
						</div>
					</div>
					<a class="btn btn_small btn_gray" data-toggle="modal" data-target="#qnaForm">
						문의 작성하기
					</a>

					<div class="board_list">
						<p>총 <strong class="txt_blue">6</strong>개 </p>
						<ul>
							<li data-toggle="modal" data-target="#qnaModal">
								<p class="p_num">2</p>
								<p class="p_title">빠른답변부탁드립니다.</p>
								<p class="p_state"><span class="icon line">접수완료</span></p>
								<p class="p_user">**병원</p>
								<p class="p_date">2023.05.06</p>
							</li>
							<li data-toggle="modal" data-target="#qnaModal">
								<p class="p_num">1</p>
								<p class="p_title">제품관련 질문드립니다!</p>
								<p class="p_state"><span class="icon">답변완료</span></p>
								<p class="p_user">**병원</p>
								<p class="p_date">2023.05.06</p>
							</li>
						</ul>

						<? include_once VIEWPATH . 'component/pagination.php'; // 페이징?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
