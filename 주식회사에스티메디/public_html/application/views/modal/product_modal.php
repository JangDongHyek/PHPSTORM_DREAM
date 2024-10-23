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
				<button type="button" class="btn btn_blue" onclick="setDefaultDelivery('save')">저장</button>
			</div>
		</div>
	</div>
</div>
<!--관리자 정산 수수료 일괄 설정-->
<div class="modal fade" id="defaultFeeModal" tabindex="-1" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">정산 수수료 일괄 설정</h5>
			</div>
			<div class="modal-body">
				<label>에이전시 선택</label>
				<div class="select flex gap5 mini flexwrap" id="agency_fee_all_list">
					<span>
						<input type="checkbox" id="agencyId">
						<label for="agencyId">agencyId (업체명 | 성명)</label>
					</span>
					<span>
						<input type="checkbox" id="agencyId2">
						<label for="agencyId2">agencyId (업체명 | 성명)</label>
					</span>
					<span>
						<input type="checkbox" id="agencyId3">
						<label for="agencyId3">agencyId (업체명 | 성명)</label>
					</span>
				</div>
				<label>정산 수수료 (%)</label>
				<div class="flex ai-c">
					<input type="text" id="modal_agency_fee_all" name="" placeholder="정산 수수료를 입력하세요"/>
					%
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">닫기</button>
				<button type="button" class="btn btn_blue" onclick="setAgencyFeeAll()">일괄 적용</button>
			</div>
		</div>
	</div>
</div>
<!--관리자 정산 수수료 설정-->
<div class="modal fade" id="agencyFeeModal" tabindex="-1" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">정산 수수료 설정</h5>
				<h1 class="modal-title" id="agency_fee_title">제품명</h1>
			</div>
			<div class="modal-body">
				<form name="agency_fee_search_form" method="get">
                    <input type="search" id="agency_fee_search" name="hstx" placeholder="에이전시명/아이디" value="" onchange="getAgencyFee()" onkeydown="if (event.key === 'Enter') { event.preventDefault();getAgencyFee() }"><!--
					--><button type="button" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
				</form>
				<div class="table">
					<table>
						<tbody id="agency_fee_list">
							<tr>
								<td class="text_left">
									업체명 | 성명<br>
									<b>id</b>
								</td>
								<td class="text_right">
									<div class="flex ai-c end">
										<input type="number" name="" placeholder="정산 수수료"/>
										%
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">닫기</button>
				<button type="button" class="btn btn_blue" onclick="setAgencyFee()">저장</button>
			</div>
		</div>
	</div>
</div>
