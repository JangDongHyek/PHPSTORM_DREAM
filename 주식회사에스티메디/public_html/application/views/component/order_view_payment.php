<!--상세보기 결제정보-->
<details open="">
    <summary><h5>결제 정보</h5></summary>
    <div class="details">
        <div class="payment">
            <div class="how"><p>주문상태 <span class="btn_black"><?=ORDER_RECIPE_STATUS[$orderData['ord_status']]?></span></p></div>
            <? if ($orderData['tracking_no']) { ?>
                <div class="payment_info">
                    <!--카드결제-->

                    <?//배송정보?>
                    <div>
                        <dl><dt>택배사</dt><dd>
                                <?foreach (COURIER_CODE AS $code=>$name) {?>
                                    <?=$code==$orderData['courier']? $name :""?>
                                <?}?>
                            </dd></dl>

                        <dl><dt>운송장번호</dt><dd><?=$orderData['tracking_no']?></dd></dl>
                    </div>

                </div>
                <br>
            <? } ?>

            <div class="how"><p>결제수단 <span class="btn_gray"><?=PAYMENT_METHODS[$orderData['pay_method']]?></span></p></div>
            <div class="payment_info">
                <? if ($orderData['pay_method'] == 'CARD') { ?>
                    <!--카드결제-->
                    <div>
                        <dl><dt>결제정보</dt><dd><?=$payData['fn_name']?>카드(<?=(int)$payData['card_quota']==0?"일시불":(int)$payData['card_quota']."개월"?>)</dd></dl>
                        <dl><dt>결제금액</dt><dd><?=number_format($payData['amt'])?>원</dd></dl>
                        <dl><dt>승인일시</dt><dd><?=date("Y.m.d H:i", strtotime($payData['reg_date']))?></dd></dl>
                    </div>

				<? } else if ($orderData['pay_method'] == 'VBANK') { ?>
					<!--가상계좌-->
					<div>
						<?
						// 입금기한
						$expTs = strtotime($payData['vbank_exp_date'] . " 23:59:59");
						$expDate = date("Y.m.d", $expTs);
						if ($expTs < time()) { // 가상계좌 입금기한 만료
							?>
							<dl><p class="txt_blue">입금기한이 만료되어 결제가 불가능합니다.</p></dl>
						<?} else { ?>
							<dl><dt>입금은행</dt><dd><?=$payData['vbank_name']?></dd></dl>
							<dl><dt>입금계좌</dt><dd><?=$payData['vbank_num']?></dd></dl>
							<dl><dt>입금자명</dt><dd><?=$payData['vbank_account_name']?></dd></dl>
							<dl><dt>입금기한</dt><dd><?=date("Y.m.d", strtotime($payData['vbank_exp_date']))?>까지</dd></dl>
							<dl><dt>입금금액</dt><dd><?=number_format($payData['amt'])?>원</dd></dl>
						<?}?>
					</div>

                <? } else if ($orderData['pay_method'] == 'CASH') {?>
                    <!--현금결제-->
                    <div>
                        <dl><dt>주문시간</dt><dd><?=replaceDateFormat($orderData['reg_date'], 14)?></dd></dl>
                    </div>
                    <div class="account info">
                        <p class="title">입금계좌정보</p>
                        <?
                        if ($orderData['cash_issue_type'] == '1') { // 계산서
                            $accountNo = ACCOUNT_LIST_PRODUCT['계산서']['number'];
                            $accountName = ACCOUNT_LIST_PRODUCT['계산서']['name'];
                        } else if ($orderData['cash_issue_type'] == '2') { // 현금영수증
                            $accountNo = ACCOUNT_LIST_PRODUCT['현금영수증']['number'];
                            $accountName = ACCOUNT_LIST_PRODUCT['현금영수증']['name'];
                        } else { // 미발행
                            $accountNo = ACCOUNT_LIST_PRODUCT['미발행']['number'];
                            $accountName = ACCOUNT_LIST_PRODUCT['미발행']['name'];
                        }
                        ?>
                        <dl><dt>입금계좌</dt><dd><?=$accountNo?></dd></dl>
                        <dl><dt>예금주</dt><dd><?=$accountName?></dd></dl>
                    </div>
                    <div class="info">
                        <p class="title">영수증 발행정보 <strong><?=CASH_ISSUE_TYPE[$orderData['cash_issue_type']]?></strong></p>
                        <?if ($orderData['cash_issue_type'] == '1') { // 계산서?>
                            <dl><dt>사업자번호</dt><dd><?=$orderData['invoice_biz_num']?></dd></dl>
                            <dl><dt>이메일</dt><dd><?=$orderData['invoice_email']?></dd></dl>
                            <dl><dt>대표자</dt><dd><?=$orderData['invoice_rep_name']?></dd></dl>
                        <?} else if ($orderData['cash_issue_type'] == '2') { // 현금영수증?>
                            <!--개인 or 사업자-->
                            <dl><dt><?=CASH_RECEIPT_TYPE[$orderData['cash_receipt_type']]?></dt><dd><?=$orderData['cash_receipt_auth_num']?></dd></dl>
                        <?} else {?>
                            <dl>미발행</dl>
                        <?}?>
                    </div>

                <? } else if ($orderData['pay_method'] == 'CREDIT') {?>
                    <!--월말결제-->
                    <div>
                        <dl><dt>주문시간</dt><dd><?=replaceDateFormat($orderData['ord_date'], 14)?></dd></dl>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</details>
