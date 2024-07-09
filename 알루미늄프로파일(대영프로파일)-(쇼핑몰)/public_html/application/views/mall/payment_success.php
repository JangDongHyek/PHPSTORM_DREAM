<!--주문서 결제성공 페이지-->
<div id="payment">
	<? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

    <div class="box">
		<h3>주문이 완료되었습니다.</h3>
		<div>주문번호: <?=$order['ord_no']?></div>
        <dl>
            <dt>배송지정보</dt>
            <dd>
                <p><?=$order['rec_name']?> (<?=$order['rec_tel']?>)</p>
                <p><?=$order['rec_addr']?> <?=$order['rec_detail']?></p>
            </dd>
        </dl>
    </div>

    <div class="boxline">
		<h3>결제정보</h3>
		<? if ($order['pay_method'] == 'CARD') { ?>
		<!-- 1. 카드결제-->
		<div>결제수단: <?=$payment['fn_name']?>카드(<?=(int)$payment['card_quota']==0?"일시불":(int)$payment['card_quota']."개월"?>)</div>
		<div>승인일시: <?=date("Y.m.d H:i", strtotime($payment['reg_date']))?></div>
		<div>결제금액: <strong><?=number_format($payment['amt'])?>원</strong></div>
		<!--// 1. 카드결제 -->

		<? } else if ($order['pay_method'] == 'CASH' || $order['pay_method'] == 'CREDIT') {?>
		<!-- 2. 현금결제 or 월말결제 -->
		<div>결제수단: <?=$order['pay_method'] == 'CASH'?'현금결제':'월말결제'?></div>
		<?
		if ($order['pay_method'] == 'CASH') {
			if ($order['cash_issue_type'] == '1') { // 계산서
				$accountNo = ACCOUNT_LIST_PRODUCT['계산서']['number'];
				$accountName = ACCOUNT_LIST_PRODUCT['계산서']['name'];
			} else if ($order['cash_issue_type'] == '2') { // 현금영수증
				$accountNo = ACCOUNT_LIST_PRODUCT['현금영수증']['number'];
				$accountName = ACCOUNT_LIST_PRODUCT['현금영수증']['name'];
			} else { // 미발행
				$accountNo = ACCOUNT_LIST_PRODUCT['미발행']['number'];
				$accountName = ACCOUNT_LIST_PRODUCT['미발행']['name'];
			}
		?>
		<div>입금계좌: <?=$accountNo?></div>
		<div>예금주: <?=$accountName?></div>
		<div>입금금액: <strong><?=number_format($payment['amt'])?>원</strong></div>
		<? } // CASH?>
		<!--// 2. 현금결제 or 월말결제 -->

		<? } else if ($order['pay_method'] == 'VBANK') { ?>
		<!-- 3. 가상계좌 -->
		<div>결제수단: 가상계좌</div>
		<div>입금은행: <?=$payment['vbank_name']?></div>
		<div>입금계좌: <?=$payment['vbank_num']?></div>
		<div>입금자명: <?=$payment['vbank_account_name']?></div>
		<div>입금기한: <?=date("Y.m.d", strtotime($payment['vbank_exp_date']))?>까지</div>
		<div>입금금액: <strong><?=number_format($payment['amt'])?>원</strong></div>
		<!--// 3. 가상계좌 -->

		<? } else if ($order['pay_method'] == 'POINT') { ?>
		<!-- 4. 포인트결제 -->
		<div>결제수단: 포인트결제</div>
		<div>승인일시: <?=date("Y.m.d H:i", strtotime($payment['reg_date']))?></div>
		<div>결제금액: <strong><?=number_format($payment['amt'])?>원</strong></div>
		<!--// 4. 포인트결제 -->
		<? } ?>
    </div>

	<br>
	<button class="btn btn_gray" type="button" onclick="location.href='<?=PROJECT_URL?>/order'">주문배송조회</button>
	<button class="btn btn_green" type="button" onclick="location.href='<?=PROJECT_URL?>'">메인으로</button>

</div>
