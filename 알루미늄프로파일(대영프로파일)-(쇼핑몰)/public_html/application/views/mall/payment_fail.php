<!--주문서 결제실패 페이지-->
<div id="payment">
	<? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

    <div class="box">
	<h3>주문이 정상적으로 완료되지 않았습니다.</h3>
	<div>결제실패사유 : <?=$errorMessage?></div>
	<div>확인 후 다시 주문해 주세요.</div>
        <br>

	<button class="btn btn_gray" type="button" onclick="location.href='<?=PROJECT_URL?>/cart'">장바구니</button>
	<button class="btn btn_green" type="button" onclick="location.href='<?=PROJECT_URL?>'">메인으로</button>
    </div>
</div>
