<div id="order_sheet">
    <? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

	<form name="order" id="app">
	<div class="vertical_wrap">
		<div class="list_wrap">
			<?/*
 			<!--제품-->
			<!--<div class="drugs_cart box">
				<details>
					<summary><h5>약재 주문서</h5></summary>
					<div class="details">
						<div class="cart_list">
							<ul>
								<li>
									<div class="div_pro">
										<div class="thumb_img"><img src="/img/common/noimg.jpg"></div>
										<p>[국내산] 어성초 300g</p>
									</div>
									<p class="p_price">8,900원</p>
									<div>20개</div>
									<p class="p_price2">133,500원<a class="delete"><i class="fa-light fa-close"></i></a></p>
								</li>
								<li>
									<div class="div_pro">
										<div class="thumb_img"><img src="/img/common/noimg.jpg"></div>
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
			*/?>

			<div class="product_cart box">
				<details open>
					<summary><h5>상품 주문서</h5></summary>
					<div class="details">
						<div class="cart_list">
							<ul>
								<?
								$subtotalPrice = 0; // 상품총금액
								$availPayCodeList = []; // 결제가능한 수단 (상품에서 지정된)
								$isShipFreeProduct = false; // 무료배송 상품

								foreach ($listData as $list) {
									$price = (int)$list['prod_price']; // 상품가격
									$count = (int)$list['product_cnt']; // 장바구니수량
                                    $cut_length = (int)$list['cut_length'];
                                    $processing_idx = (int)$list['processing_idx'];

									$itemAmt = ($price * ($cut_length / 1000)) * $count + 330;

									$subtotalPrice += $itemAmt;

									$tmpPayList = explode(",", $list['pay_method_list']); // 결제수단 추가
									$availPayCodeList = array_merge($availPayCodeList, $tmpPayList);

									if ($list['shipping_free_yn']=='Y') $isShipFreeProduct = true;

									$uid = $list['product_idx'];
								?>
                                <li>
                                    <div class="div_pro">
                                        <div class="thumb_img"><img src="<?=$list['prod_thumb']?>"></div>
                                        <div class="div_name">
                                            <strong><?=$list['prod_name']?></strong>
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

									<? // 상품상세정보 ?>
									<input type="hidden" name="productIdx[<?=$uid?>]" value="<?=$list['product_idx']?>"/>
									<input type="hidden" name="productName[<?=$uid?>]" value="<?=$list['prod_name']?>"/>
									<input type="hidden" name="productPrice[<?=$uid?>]" value="<?=$price?>"/>
									<input type="hidden" name="productCnt[<?=$uid?>]" value="<?=$count?>"/>
                                    <input type="hidden" name="cut_length[<?=$uid?>]" value="<?=$cut_length?>"/>
                                    <input type="hidden" name="processing_idx[<?=$uid?>]" value="<?=$processing_idx?>"/>
									<? // 장바구니 인덱스 ?>
									<input type="hidden" name="cartIdx[]" value="<?=$list['cart_idx']?>"/>
                                </li>
								<?}?>
							</ul>
						</div>
					</div>
				</details>
			</div>
			<!--//제품-->

			<!--주문서-->
			<div>
				<div class="boxline">
					<details open>
						<summary><h5>배송 정보</h5></summary>
						<div class="details">
							<div class="delivery">
								<div>
									<h6>주문자</h6>
									<p><label>성함</label><input type="text" name="ordName" id="ordName" placeholder="성함" value="<?=$member['mb_name']?>" maxlength="30"></p>
									<p><label>기본주소</label><input type="text" name="ordAddr" placeholder="기본주소" value="<?=$member['cn_addr']?>"></p>
									<p><label>상세주소</label><input type="text" name="ordAddrDetail" placeholder="상세주소" value="<?=$member['cn_addr_detail']?>" maxlength="100"></p>
									<p><label>연락처</label><input type="text" name="ordTel" id="ordTel" placeholder="연락처" value="<?=$member['mb_hp']?>" class="telCheck"></p>
									<input type="hidden" name="ordZcode" placeholder="우편번호" value="<?=$member['cn_zcode']?>">
								</div>
								<div>
									<h6>받는 사람
										<span class="circle">
                                            <input type="checkbox" id="sameInfo" name="sameInfo"> <label for="sameInfo"> 주문자 정보와 동일</label>
                                        </span>
									</h6>
									<p><label>성함</label><input type="text" name="recName" placeholder="성함" maxlength="30"></p>
									<p><label>기본주소</label><input type="text" name="recAddr" placeholder="기본주소"></p>
									<p><label>상세주소</label><input type="text" name="recAddrDetail" placeholder="상세주소" maxlength="100" onchange="getSendCost2()"></p>
									<p><label>연락처</label><input type="text" name="recTel" placeholder="연락처" class="telCheck"></p>
									<p><label>배송요청사항</label><input type="text" name="recMemo" placeholder="배송 요청사항" maxlength="100"></p>
									<input type="hidden" name="recZcode" placeholder="우편번호" >
								</div>
							</div>
						</div>
					</details>
				</div>
			</div>
			<!--//주문서-->
		</div>

		<?php
		// 사용가능한 결제수단
		$availPayCodeList = array_unique($availPayCodeList);
		$availPaymentList = [];
		foreach ($availPayCodeList as $code) {
			$availPaymentList[$code] = ENABLE_PAYMENT_METHODS[$code];
		}
		$paymentList = $availPaymentList;

		// 미수업체인 경우 결제수단 `월말결제` 노출
		if ($member['misu_yn'] === 'Y') {
			unset($paymentList['CASH']); // 현금결제 삭제
			$reversedArray = array_reverse($paymentList, true);
			$reversedArray['CREDIT'] = '월말결제'; // 외상결제 맨앞 추가
			$paymentList = array_reverse($reversedArray, true);
		}
		?>
		<div class="sticky">
			<div class="payment">
				<h5>결제정보</h5>
				<div class="areatop">
					<p class="circle">
						<?
						// 결제수단
						$key=1;
						foreach ($paymentList AS $payType=>$payName) {
						?>
						<input type="radio" id="pay<?=$key?>" name="payMethod" value="<?=$payType?>" <?=$key==1?"checked":"";?> onclick="changePayMethod(this.value)"/>
						<label for="pay<?=$key?>"> <?=$payName?></label>
						<? $key++; } ?>
					</p>
                    <div class="box" id="cash_info_wrap" style="display: none;">
                        <h5>발행목록</h5>
                        <p class="circle">
                            <input type="radio" id="is1" name="cashIssueType" value="1" onclick="changeIssueType(this.value)" checked=""> <label for="is1"> 계산서</label>
                            <input type="radio" id="is2" name="cashIssueType" value="2" onclick="changeIssueType(this.value)"> <label for="is2"> 현금영수증</label>
                            <input type="radio" id="is3" name="cashIssueType" value="3" onclick="changeIssueType(this.value)"> <label for="is3"> 미발행</label>
                        </p>
                        <!--계산서-->
                        <div class="issue" id="issue_tab1">
                            <div class="account">
                                <dl>
                                    <dt>입금계좌</dt>
                                    <dd>[<?=ACCOUNT_LIST_PRODUCT['계산서']['number']?>] (예금주 : <?=ACCOUNT_LIST_PRODUCT['계산서']['name']?>)</dd>
                                </dl>
                            </div>

                            <div class="form">
                                <label>사업자번호</label><input type="text" name="invoiceBizNum" placeholder="사업자번호" value="<?=$member['biz_rno']?>">
                                <label>이메일</label><input type="text" name="invoiceEmail" placeholder="이메일" value="<?=$member['cn_email']?>">
                                <label>대표자</label><input type="text" name="invoiceRepName" placeholder="대표자" value="<?=$member['rep_name']?>">
                            </div>
                        </div>
                        <!--//계산서-->
                        <!--현금영수증-->
                        <div class="issue" id="issue_tab2" style="display: none;">
                            <div class="account">
                                <dl>
                                    <dt>입금계좌</dt>
                                    <dd>[<?=ACCOUNT_LIST_PRODUCT['현금영수증']['number']?>] (예금주 : <?=ACCOUNT_LIST_PRODUCT['현금영수증']['name']?>)</dd>
                                </dl>
                            </div>
                            <div class="form">
                                <label>발급분류</label>
                                <select name="cashReceiptType" onchange="changeCashReceiptType(this)">
									<option value="1" data-num="<?=$member['mb_hp']?>">개인</option>
									<option value="2" data-num="<?=$member['biz_rno']?>">사업자</option>
                                </select>
                                <label id="labelReceiptAuth">발급휴대폰번호</label>
								<input type="text" name="cashReceiptAuthNum" placeholder="발급번호" value="<?=$member['mb_hp']?>" maxlength="15">
                            </div>
                        </div>
                        <!--//현금영수증-->
                        <!--미발행-->
                        <div class="issue" id="issue_tab3" style="display: none;">
                            <div class="account">
                                <dl>
                                    <dt>입금계좌</dt>
                                    <dd>[<?=ACCOUNT_LIST_PRODUCT['미발행']['number']?>] (예금주 : <?=ACCOUNT_LIST_PRODUCT['미발행']['name']?>)</dd>
                                </dl>
                            </div>
                        </div>
                        <!--//미발행-->
                    </div>
					<?/*<div class="box point">
						<h6>포인트결제 <strong> (보유포인트 : 5,999P)</strong><input type="hidden" name="myPoint" value="5999"></h6>
						<div class="flex">
							<p>사용적립포인트&nbsp;&nbsp;</p>
							<input type="text" name="usePoint" value="0">&nbsp;&nbsp;P
						</div>
					</div>*/?>
				</div>
			</div>
			<div class="total">
				<?
				// 기본배송비, 조건부무료배송금액
				$deliveryFee = (int)$configData['cf_delivery_fee'];
				$freeShipOverAmt = (int)$configData['cf_free_ship_over_amt'];
                $deliveryFee2 = 0; //추가배송비

				// 무료배송 (조건부무료금액 이상 or 무료배송상품이 존재)
				if ($freeShipOverAmt <= $subtotalPrice || $isShipFreeProduct) {
					$deliveryFee = 0;
				}

				// 총주문금액 (결제금액은 사용포인트 입력에 따라 프론트에서 변동) -- 현재 사용포인트 없음
				$orderPrice = $subtotalPrice + $deliveryFee;

				// 할인금액 (현재 할인없음)
				$discountPrice = 0;

				// 결제금액
				$totalPrice = (int)$orderPrice - (int)$discountPrice;

				?>
				<input type="hidden" name="subtotalPrice" value="<?=$subtotalPrice?>"/><!--상품금액-->
				<input type="hidden" name="deliveryFee" value="<?=$deliveryFee?>"/><!--배송료-->
                <input type="hidden" name="deliveryFee2" value="<?=$deliveryFee2?>"/><!--추가배송료-->
				<input type="hidden" name="orderPrice" value="<?=$orderPrice?>"/><!--총주문금액-->
				<input type="hidden" name="discountPrice" value="<?=$discountPrice?>"/><!--할인금액-->
				<input type="hidden" name="totalPrice" value="<?=$totalPrice?>"/><!--결제금액-->
                <input type="hidden" name="totalPrice_old" value="<?=$totalPrice?>"/><!--결제금액-->

				<dl class="price_info">
					<dt>총 상품금액</dt>
					<dd><?=number_format($subtotalPrice)?>원</dd>
					<dt>배송비</dt>
					<dd><i class="fa-solid fa-plus-circle"></i> <?=number_format($deliveryFee)?>원</dd>


                    <dt id="deliveryFee2_box1" style="display: none">추가배송비</dt>
                    <dd id="deliveryFee2_box2" style="display: none"><i class="fa-solid fa-plus-circle"></i> <span id="deliveryFee2_cost_txt">0</span>원</dd>

				</dl>
				<div class="total_price">
					<p class="text">총 결제금액</p>
					<p class="price txt_green" id="totalPrice_txt"><?=number_format($totalPrice)?>원</p>
				</div>
				<div class="btn_wrap">
					<a class="btn btn_middle btn_green" onclick="productOrderSubmit()">결제하기</a>
				</div>

			</div>
		</div>
	</div>
	</form>
</div>


<? include_once VIEWPATH . 'component/daum_addr_popup.php'; // 다음주소 ?>
<? include_once VIEWPATH . 'component/innopay_form.php'; // 이노페이 ?>

<!-- 주문서 js -->
<script src="<?=ASSETS_URL?>/js/mall/order_sheet.js?v=<?=JS_VER?>"></script>
