<!--장바구니-->
<div id="cart">
    <? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

	<div class="vertical_wrap">
		<div class="list_wrap">
			<div class="chk_all">
                <input type="checkbox" id="chkAll" onclick="selectAllCart(this, 'checkIdx')"/> <label for="chkAll">전체 선택</label>
			</div>
			<div class="product_cart box">
				<h5>장바구니에 담은 상품</h5>
				<div class="cart_list">
					<ul id="cartList">
                        <?php
                        // 기본배송비, 조건부무료배송금액
                        $deliveryFee = (int)$configData['cf_delivery_fee'];
                        $freeShipOverAmt = (int)$configData['cf_free_ship_over_amt'];

                        foreach($listData as $list) {
                            $cartIdx = $list['cart_idx']; // 장바구니 인덱스
                            $soldOut = $list['soldout_yn'] == 'Y'; // 임시품절 여부

                            //보험가 적용하는 회원들 따로 가격
                            if ($member['INSU_CHECK'] == 'Y') {
                                $list['prod_price'] = $list['INSU_PRICE'];
                            }
                        ?>
                        <li id="li<?=$cartIdx?>">
                            <div class="div_pro">
                                <input type="checkbox" name="checkIdx" value="<?=$cartIdx?>" id="cart<?=$cartIdx?>" <?=$soldOut?'disabled':''?>/>
                                <!--<a href="<?=PROJECT_URL?>/medicinal/<?=$list['product_idx']?>" target="_blank" style="margin-left: 10px;">-->
                                <label for="cart<?=$cartIdx?>"  style="margin-left: 10px;font-weight: unset;">
                                    <!--div class="thumb_img"><img src="<?=$list['prod_thumb']?>"></div-->
                                    <div class="div_name">
                                        <h5><strong><?=$list['PRODUCT_NM']?></strong></h5>
                                        <span>제조사 <strong><?=$list['MAKER_NM']?></strong> |</span>
                                        <span>성분분류명 <strong><?=$list['CONS_CD']?></strong> |</span>
                                        <span>단위 <strong><?=$list['PRODUCT_STANDARD']?></strong> |</span>
                                        <span>재고수량  <strong><?=number_format($list['STOCK_QTY'])?></strong></span>
                                    </div>
                                </label>
								<p class="p_price prodPrice"><?=number_format(removeComma($list['prod_price']))?>원</p>
                            </div>
                            <div class="div_option">
                                <div>
                                    <dl>
                                        <dt></dt>
                                        <dd>
                                            <div class="number_controller">
                                                <button type="button" onclick="changeCount(this, -1)"><i class="fa-regular fa-minus"></i></button>
                                                <input type="number" name="inputNumber" value="<?=$list['product_cnt']?>" onkeyup="this.value=numberChk(this.value);changeCount(this, this.value, true)"/>
                                                <button type="button" onclick="changeCount(this, 1)"><i class="fa-regular fa-plus"></i></button>
                                            </div>
                                            <!--<p class="p_price"><?/*=number_format($list['product_cnt']*$list['prod_price'])*/?>원</p>-->
                                            <!--<a class="delete"><i class="fa-light fa-close"></i></a>-->
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <p class="p_price2">
                                <span><?=number_format($list['product_cnt']*removeComma($list['prod_price']))?>원</span>
                                <a class="delete" onclick="deleteCart(<?=$cartIdx?>)"><i class="fa-light fa-close"></i></a>
                            </p>
                        </li>
                        <?php } ?>
					</ul>
                    <?php
                    if(count($listData) == 0) { ?>
                    <div style="text-align: center;padding:20% 0">장바구니가 비어 있습니다.</div>
                    <?php } ?>
				</div>
			</div>
		</div>
		<div class="sticky">
			<div class="total">
				<dl class="price_info">
					<dt>총 상품금액</dt>
                    <dd><span id="prodPriceDisplay">0</span>원</dd>
					<dt>배송비</dt>
					<dd><i class="fa-solid fa-plus-circle"></i> <span id="deliFreeDisplay">0</span>원</dd>
				</dl>
				<div class="total_price">
					<p class="text">총 결제금액</p>
					<p class="price txt_blue"><span id="totalPriceDisplay">0</span>원</p>
				</div>
				<div class="btn_wrap">
					<a class="btn btn_middle btn_blueline" onclick="deleteCart(null, null, true);">장바구니 비우기</a>
					<a class="btn btn_middle btn_blue" onclick="buy()">선택상품 주문하기</a>
				</div>

                <input type="hidden" name="deliveryFee" value="<?=$deliveryFee?>"/><!--배송비-->
                <input type="hidden" name="freeShipOverAmt" value="<?=$freeShipOverAmt?>"/><!--조건부금액(이상무료)-->
			</div>
		</div>
	</div>

    <?/* 선택상품주문하기 - 주문서작성 */?>
    <form name="order" method="post">
    </form>
</div>

<script>
    $(function () {
        // 체크박스 전체선택
        document.querySelector('#chkAll').click();
        calcCartTotalPrice();
    });

    // 전체선택
    const selectAllCart = (element, name) => {
        const checkboxes = document.querySelectorAll(`input[name="${name}"]`);
        checkboxes.forEach((checkbox) => {
            if (!checkbox.disabled) {
                checkbox.checked = element.checked;
                calcCartTotalPrice();
            }
        });
    }

    // 장바구니 수량 변경 (버튼)
    const changeCount = async (e, value, input=false) => {
        const parent = e.closest('li');
        const numberElement = parent.querySelector(`[name=inputNumber]`); // 구매수량
        const price = toNumber(removeComma(parent.querySelector(`.div_pro .p_price`).textContent)); // 상품금액

        // 변경수량
        let changeCount = !input ? toNumber(numberElement.value) + value : value;
        changeCount = Math.max(changeCount, 1);

        numberElement.value = changeCount;
        parent.querySelector(`.p_price2 span`).textContent = addCommaNumber(price * changeCount)+"원"; // 상품 총금액

        // 장바구니 수량 업데이트
        const cartIdx = parent.querySelector('[name=checkIdx]').value;
        await fetchData(`/api/updateCartOption`, {cartIdx, changeCount});

        calcCartTotalPrice();
    }

    // 장바구니 삭제 (1개, 선택삭제, 전체삭제)
    const deleteCart = async (cartIdx=0, isSelected=false, isClear=false) => {
        // 선택삭제시 체크박스 확인
        const checkboxes = document.querySelectorAll('[name=checkIdx]:checked');
        if (isSelected) {
            if (checkboxes.length == 0) {
                showAlert('삭제할 상품을 선택해 주세요.');
                return false;
            }
        }

        let message = (isClear)? '장바구니를 모두 비우시겠습니까?' : '선택하신 상품을 삭제하시겠습니까?';
        const confirmResult = await showConfirm(message);
        if (confirmResult.isConfirmed !== true) return false;

        let jsonData = {cartIdxArr: [cartIdx], isClear: isClear}

        if (isSelected) {
            jsonData.cartIdxArr = [];
            checkboxes.forEach(input => {
                jsonData.cartIdxArr.push(input.value);
            });
        }

        // 삭제
        const response = await fetchData(`/api/deleteCart`, jsonData);
        if (response.result) {
            location.reload();
        } else {
            showAlert('장바구니 삭제에 실패했습니다. 다시 시도해 주세요.', () => {
                location.reload();
            });
        }
    }

    // 장바구니 총금액 계산
    const calcCartTotalPrice = () => {
        const list = document.querySelectorAll("#cartList li");
        let productPrice = 0;

        if (document.querySelectorAll('[name=checkIdx]').length >= 1) {
            // 1. 상품별 합계
            list.forEach(row => {
                const checked = row.querySelector('[name=checkIdx]').checked;
                if (checked) {
                    const priceStr = row.querySelector('.p_price2 span').innerText;
                    const price = toNumber(priceStr);
                    productPrice += price;
                }
            });
        }

        // 2. 배송비 계산
        let freeShipOverAmt = toNumber(document.querySelector('[name=freeShipOverAmt]').value); // (설정)조건부무료금액
        let deliveryFee = toNumber(document.querySelector('[name=deliveryFee]').value); // (설정)배송료
        // 조건부무료
        if (freeShipOverAmt <= productPrice) deliveryFee = 0

        // 3. 총금액 (1+2)
        let totalPrice = toNumber(productPrice + deliveryFee);
        document.querySelector('#prodPriceDisplay').innerHTML = addCommaNumber(productPrice);
        document.querySelector('#deliFreeDisplay').innerHTML = addCommaNumber(deliveryFee);
        document.querySelector('#totalPriceDisplay').innerHTML = addCommaNumber(totalPrice);
    }

    // 체크박스 선택/해제
    const checkboxes = document.querySelectorAll('#cartList input[type=checkbox]');
    checkboxes.forEach(input => {
        input.addEventListener('change', calcCartTotalPrice);
    });

    // 선택상품 주문하기
    const buy = () => {
        const form = document.order;
        form.innerHTML = '';

        const checkboxes = document.querySelectorAll('[name=checkIdx]:checked');
        if (checkboxes.length == 0) {
            return showAlert('주문할 상품을 선택해 주세요.');
        }

        checkboxes.forEach(input => {
            let html = `<input type="hidden" name="cartIdx[]" value="${input.value}" />`;
            form.insertAdjacentHTML('beforeend', html);
        });

        // 주문서 이동
        form.action = baseUrl + 'orderSheet';
        form.submit();
    }
</script>
