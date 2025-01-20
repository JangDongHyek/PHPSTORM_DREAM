<!--관리자 기본 배송비 설정-->
<div class="modal fade" id="defaultDeliveryModal" tabindex="-1" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">기본 배송비 설정</h5>
			</div>
			<div class="modal-body">
				<label>기본 배송비</label>
				<input type="text" name="deliveryFee" placeholder="배송비를 입력하세요" value="<?=number_format((int)$configData['cf_delivery_fee'])?>"/>
				<label>무료 배송 조건 (입력금액 미만일때 배송비 부과)</label>
				<input type="text" name="freeShipOverAmt" placeholder="최소 조건 비용을 입력하세요" value="<?=number_format((int)$configData['cf_free_ship_over_amt'])?>"/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">닫기</button>
				<button type="button" class="btn btn_green" onclick="setDefaultDelivery('save')">저장</button>
			</div>
		</div>
	</div>
</div>
