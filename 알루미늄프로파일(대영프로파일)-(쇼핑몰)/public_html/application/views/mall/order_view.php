<div id="order_sheet">
    <? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

    <div class="vertical_wrap">
        <div class="list_wrap">
            <div class="product_cart box">
                <details open>
                    <summary><h5>상품 주문서</h5></summary>
                    <div class="details">
                        <div class="cart_list">
                            <ul>
								<?
								foreach ($orderItemData AS $item) {
									$price = (int)$item['item_price']; // 상품가격
									$count = (int)$item['item_cnt']; // 장바구니수량
									$itemAmt = $price * $count;
								?>
                                <li>
                                    <div class="div_pro">
                                        <div class="thumb_img"><img src="<?=$item['thumbNail']?>"></div>
                                        <div class="div_name">
                                            <strong><?=$item['item_name']?></strong>
                                            <!--<p class="p_price"><?=number_format($price)?>원</p>-->
                                        </div>
                                    </div>
                                    <div class="div_option">
                                        <div>
                                            <dl>
                                                <dt><!--기본옵션--></dt>
                                                <dd>
                                                    <div class="number"><?=number_format($count)?>개</div>
                                                    <p class="p_price"><?=number_format($price)?>원</p>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <p class="p_price2"><?=number_format($itemAmt)?>원</p>
                                </li>
								<? } ?>
                            </ul>
                        </div>
                    </div>
                </details>
            </div>
			<!--제품-->
			<!--<div class="drugs_cart box">
				<details>
					<summary><h5>약재 주문서</h5></summary>
					<div class="details">
						<div class="cart_list">
							<ul>
								<li>
									<div class="div_pro">
										<div class="thumb_img"><img src="<?/*=ASSETS_URL*/?>/img/common/noimg.jpg"></div>
										<p>[국내산] 어성초 300g</p>
									</div>
									<p class="p_price">8,900원</p>
									<div>20개</div>
									<p class="p_price2">133,500원<a class="delete"><i class="fa-light fa-close"></i></a></p>
								</li>
								<li>
									<div class="div_pro">
										<div class="thumb_img"><img src="<?/*=ASSETS_URL*/?>/img/common/noimg.jpg"></div>
										<p>[베트남] 어성초 300g</p>
									</div>
									<p class="p_price">5,900원</p>
									<div>10개</div>
									<p class="p_price2">130,000원<a class="delete"><i class="fa-light fa-close"></i></a></p>
								</li>
							</ul>
						</div>
					</div>
				</details>
			</div>-->

            <!--주문서-->
            <div>
                <div class="boxline">
                    <details open>
                        <summary><h5>배송 정보</h5></summary>
                        <div class="details">
                            <div class="delivery">
                                <div>
                                    <h6>주문자</h6>
                                    <p><label>성함</label><input type="text" name="ordName" placeholder="성함" value="<?=$orderData['ord_name']?>" readonly></p>
                                    <p><label>기본주소</label><input type="text" name="ordAddr" placeholder="기본주소" value="<?=$orderData['ord_addr']?>" readonly></p>
                                    <p><label>상세주소</label><input type="text" name="ordAddrDetail" placeholder="상세주소" value="<?=$orderData['ord_addr_detail']?>" readonly></p>
                                    <p><label>전화번호</label><input type="text" name="ordTel" placeholder="전화번호" value="<?=$orderData['ord_tel']?>" class="telCheck" readonly></p>
                                    <input type="hidden" name="ordZcode" placeholder="우편번호" value="<?=$orderData['ord_zcode']?>">
                                </div>
                                <div>
                                    <h6>받는 사람</h6>
                                    <p><label>성함</label><input type="text" name="recName" placeholder="성함" value="<?=$orderData['rec_name']?>" readonly></p>
                                    <p><label>기본주소</label><input type="text" name="recAddr" placeholder="기본주소" value="<?=$orderData['rec_addr']?>" readonly></p>
                                    <p><label>상세주소</label><input type="text" name="recAddrDetail" placeholder="상세주소" value="<?=$orderData['rec_addr_detail']?>" readonly></p>
                                    <p><label>전화번호</label><input type="text" name="recTel" placeholder="전화번호" class="telCheck" value="<?=$orderData['rec_tel']?>" readonly></p>
                                    <p><label>배송요청사항</label><input type="text" name="recMemo" placeholder="배송 요청사항" value="<?=$orderData['rec_memo']?>" readonly></p>
                                    <input type="hidden" name="recZcode" placeholder="우편번호" value="<?=$orderData['rec_zcode']?>">
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>
            <!--//주문서-->
        </div>
        <div class="sticky">
            <div class="payment">
				<? include_once VIEWPATH . 'component/order_view_payment.php'; // 결제정보 ?>
            </div>
            <div class="total">
                <dl class="price_info">
                    <dt>총 상품금액</dt>
                    <dd><?=number_format($orderData['subtotal_price'])?>원</dd>
                    <dt>배송비</dt>
                    <dd><i class="fa-solid fa-plus-circle"></i> <?=number_format($orderData['delivery_fee'])?>원</dd>

                    <? if($orderData['delivery_fee2']){ ?>
                        <dt>추가 배송비</dt>
                        <dd><i class="fa-solid fa-plus-circle"></i> <?=number_format($orderData['delivery_fee2'])?>원</dd>
                    <? } ?>
                </dl>
                <div class="total_price">
                    <p class="text">총 결제금액</p>
                    <p class="price txt_green"><?=number_format($orderData['total_price'])?>원</p>
                </div>
                <div class="btn_wrap">
                    <a class="btn btn_middle btn_green" href="<?=PROJECT_URL?>/order">목록으로</a>
                </div>
            </div>
        </div>

    </div>
</div>
