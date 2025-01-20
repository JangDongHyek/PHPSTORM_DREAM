<!--외상거래등록-->
<div class="modal fade in" id="misu01" tabindex="-1" aria-labelledby="misu01Label" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="accRecFrm" autocomplete="off" method="post">
				<input type="hidden" name="idx" value>
				<div class="modal-header">
					<h5 class="modal-title" id="misu01Label">외상거래등록</h5>
				</div>
				<div class="modal-body">
					<label>일자</label><input type="date" name="date" required>
					<label>적요</label><input type="text" name="content" placeholder="거래내용을 입력하세요" required>
					<label>외상 금액</label><input type="text" name="price" placeholder="금액을 입력하세요" required>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">취소</button>
					<button type="submit" class="btn btn_green">외상 등록</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--입금내역등록-->
<div class="modal fade in" id="misu02" tabindex="-1" aria-labelledby="misu02Label" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="depFrm" autocomplete="off" method="post">
				<input type="hidden" name="idx" value>
				<div class="modal-header">
					<h5 class="modal-title" id="misu02Label">입금내역 등록</h5>
				</div>
				<div class="modal-body">
					<label>일자</label><input type="date" name="date" required>
					<label>적요</label><input type="text" name="content" placeholder="거래내용을 입력하세요" required>
					<label>입금 금액</label><input type="text" name="price" placeholder="금액을 입력하세요" required>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">취소</button>
					<button type="submit" class="btn btn_green">입금 등록</button>
				</div>
			</form>
		</div>
	</div>
</div>
