<div id="order_sheet">
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
											<i class="fa-duotone fa-solid fa-pills"></i>
                                            <!--div class="thumb_img"><img src="<?=$item['thumbNail']?>"></div-->
                                            <div class="div_name">
                                                <h5><strong><?=$item['item_name']?></strong></h5>
												<p class="p_info">규격 <b><?=$item['PRODUCT_STANDARD']?></b> | 제조사명 <b><?=$item['MAKER_NM']?></b></p>
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
            <!--//제품-->

            <!--주문서-->
            <form name="deliFrm" autocomplete="off">
                <input type="hidden" name="idx" value="<?=$orderData['idx']?>">
                <div>
                    <div class="boxline">
                        <details open>
                            <summary><h5>배송 정보 <button type="button" class="btn btn_blueline" onclick="modifyRecipient()">배송정보 수정</button></h5></summary>
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
                                    <div id="rec_wrap">
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
            </form>
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
                    <? if($orderData['delivery_fee2']){?>
                        <dt>추가 배송비</dt>
                        <dd><i class="fa-solid fa-plus-circle"></i> <?=number_format($orderData['delivery_fee2'])?>원</dd>
                    <? } ?>

                </dl>
                <div class="total_price">
                    <p class="text">총 결제금액</p>
                    <p class="price txt_sky"><?=number_format($orderData['total_price'])?>원</p>
                </div>
                <!--<dl class="delivery_date">
                    <dt>출고일자</dt>
                    <dd><input type="text" value="2023-07-26" readonly></dd>
                </dl>-->
                <div class="btn_wrap">
                    <a class="btn btn_middle btn_blue" onclick="history.back();">목록으로</a>
                </div>
            </div>
        </div>

    </div>
</div>

<? include_once VIEWPATH . 'component/daum_addr_popup.php'; // 다음주소 ?>

<script>
    const deliFrm = document.deliFrm;

    deliFrm.addEventListener('submit', async (e) => {
        e.preventDefault();
        return false;
    });

    // 배송정보수정
    const modifyRecipient = async () => {
        const nameField = deliFrm.querySelector('[name=recName]');
        if (nameField.readOnly) {
            deliFrm.querySelectorAll('#rec_wrap input').forEach(input => { // 받는사람
                input.readOnly = false;
                input.disabled = false;
            });
            nameField.focus();
            return;
        }

        // 필드 검사
        const fields = [
            { field: nameField, message: '받는사람 성함을 입력해 주세요.' },
            { field: deliFrm.querySelector('[name=recAddr]'), message: '받는사람 기본주소를 입력해 주세요.' },
            { field: deliFrm.querySelector('[name=recTel]'), message: '받는사람 전화번호를 입력해 주세요.' },
        ];

        for (const { field, message } of fields) {
            if (field.value == '') {
                showAlert(message, () => { field.focus() });
                return false;
            }
        }

        const confirmResult = await showConfirm('배송정보를 수정완료 하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData(deliFrm);
        const response = await fetchData('/apiAdmin/updateOrderRecipient', formData);
        // console.log(response);
        if (!response.result) {
            return showAlert('배송정보 수정에 실패했습니다.<br>잠시 후 다시 시도해 주세요.');
        } else {
            location.reload();
        }
    }

    // 주소검색 팝업열기
    document.querySelector('[name=recAddr]').addEventListener('click', (e) => {
        e.preventDefault();
        if (!e.target.readOnly) { // 수정상태면 주소검색 팝업열기
            const formNames = ['recAddr', 'recZcode', 'recAddrDetail'];
            openDaumAddress(formNames);
        }
    });
</script>
