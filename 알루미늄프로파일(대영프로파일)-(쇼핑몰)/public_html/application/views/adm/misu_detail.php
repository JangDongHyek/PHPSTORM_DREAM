<style>
button[disabled], button[disabled]:hover {opacity: 0.3 !important;}
</style>

<section class="order1">
    <form name="searchFrm" autocomplete="off" method="get">
        <div class="panel">
            <p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
            <div>
				<input type="date" name="sdt" value="<?=$_GET['sdt']?>" onchange="changeInputDate(this.value)"/>
				<p>~</p>
				<input type="date" name="edt" value="<?=$_GET['edt']?>" onchange="changeInputDate(this.value)"/>
            </div>
            <div>
				<span class="select">
					<?
					$dateRange = ['0'=>'전체', '1'=>'오늘', '2'=>'이번주', '3'=>'이번달'];
					foreach ($dateRange AS $key=>$val) {
						$checked = ($_GET['dtRange'] == $key) || (!$_GET['dtRange'] && $key == 0)? "checked" : "";
						$id = "dtr{$key}";
					?>
					<input type="radio" id="<?=$id?>" name="dtRange" class="green" value="<?=$key?>" <?=$checked?> onclick="changeDateRange(this.value)"/><!--
                	--><label for="<?=$id?>"><?=$val?></label>
					<?}?>
				</span>
            </div>
            <div>
                <select name="sfl">
                    <option value="content">적요</option>
                </select>
                <input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
            <button type="button" class="btn btn_green" data-toggle="modal" data-target="#misu01">외상거래 등록</button>
            <button type="button" class="btn btn_black" data-toggle="modal" data-target="#misu02">입금내역 등록</button>
        </span>
        </div>
        <div class="tagbox ">
            <dl class="search">
                <dt>입력구분</dt>
                <dd>
					<select name="regType">
						<option value="" <?=getParamMatches('regType', '', 'selected')?>>전체</option>
						<option value="1" <?=getParamMatches('regType', '1', 'selected')?>>직접입력</option>
						<option value="2" <?=getParamMatches('regType', '2', 'selected')?>>주문거래</option>
					</select>
                </dd>
                <dt>입금/외상</dt>
                <dd>
					<select name="transType">
						<option value="" <?=getParamMatches('transType', '', 'selected')?>>전체</option>
						<option value="1" <?=getParamMatches('transType', '1', 'selected')?>>입금</option>
						<option value="2" <?=getParamMatches('transType', '2', 'selected')?>>외상</option>
					</select>
                </dd>
                <dt>결제</dt>
                <dd>
                    <select name="payMethod">
						<option value="" <?=getParamMatches('payMethod', '', 'selected')?>>전체</option>
						<?
						foreach (PAYMENT_METHODS AS $key=>$val) {
							if ($key == 'CASH') continue;
						?>
						<option value="<?=$key?>" <?=getParamMatches('payMethod', "{$key}", 'selected')?>><?=$val?></option>
						<?}?>
                    </select>
                </dd>
            </dl>
            <button type="button" class="btn btn_gray btn_h40" onclick="location.href='<?=PROJECT_URL?>/adm/misu/<?=$memberIdx?>'">초기화</button>
        </div>
    </form>
</section>

<section class="misu detail">
    <div class="box_title">
        <p><strong><?=$clinicName?> (<?=$memberId?>)</strong></p>
        <div class="total">총 미수금 잔액<strong><?=number_format($misuAmt)?>원</strong></div>
    </div>

    <div class="boxline">
        <div class="table adm">
            <table class="calculate">
                <colgroup>
                    <col width="4%">
                    <col width="7%"><!--일자-->
                    <col width="7%"><!--구분-->
                    <col width="7%"><!--결제-->
                    <col width="*"><!--적요-->
                    <col width="10%"><!--매출-->
                    <col width="10%"><!--입금-->
                    <col width="10%"><!--외상-->
                    <col width="*"><!--잔액-->
                    <col width="10%"><!--관리-->
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>일자</th>
                    <th>입력구분</th>
                    <th>결제</th>
                    <th>적요</th>
                    <th>매출</th>
                    <th>입금</th>
                    <th>외상</th>
                    <th>잔액 (=외상-입금)</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
				<?php
				$allTransTypes = PAYMENT_METHODS;
				$allTransTypes['DEPOSIT'] = '입금';

				foreach($listData as $key => $list) {
					$idx = (int)$list['idx'];
					$ordIdx = (int)$list['ord_idx'];
					$btnDisabled = $ordIdx > 0? "disabled" : ""; // 주문거래 수정,삭제 불가
					$isDeposit = $list['trans_type'] == 'DEPOSIT'? 1 : 0; // 외상거래 여부
					$inputTypeStr = $ordIdx > 0? "주문거래" : "직접입력";

					// 입금 (-표기)
					$depositAmt = $isDeposit? "-" . number_format($list['deposit']) : "0";
					// $depositAmt = number_format($list['deposit']);
				?>
                <tr>
					<td><?=$paging['listNo']?></td>
					<td><?=replaceDateFormat($list['trans_date'])?></td>
					<td><?=$inputTypeStr?></td>
					<td><?=$allTransTypes[$list['trans_type']]?></td>
					<td><?=$list['trans_content']?></td>
					<td class="text_right"><span><?=number_format($list['sales_price'])?></span></td>
					<td class="text_right"><span class="txt_blue"><?=$depositAmt?></span></td>
					<td class="text_right"><span class="txt_red"><?=number_format($list['credit_price'])?></span></td>
					<td class="text_right"><span class="txt_bold"><?=number_format($list['balance'])?></span></td>
                    <td class="text-center">
						<button type="button" class="btn btn_black" onclick="openRegisterTrans(<?=$isDeposit?>, <?=$idx?>)" <?=$btnDisabled?>>수정</button>
						<button type="button" class="btn btn_greenline" onclick="deleteTrans(<?=$idx?>)" <?=$btnDisabled?>>삭제</button>
                    </td>
                </tr>
				<?php
					$paging['listNo']--;
				}
				if ($paging['totalCount'] == 0) { ?>
				<tr><td colspan="20" class="noDataAlign">등록된 거래가 없습니다.</td></tr>
				<? } ?>
                </tbody>
            </table>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
    </div>
</section>

<input type="hidden" id="memberId" value="<?=$memberId?>"/>
<?php include_once MODAL_PATH. "misu_form_modal.php" // 거래등록 모달 ?>



<script>
	// 검색 select 변경시
	const selectElements = searchFrm.querySelectorAll('select');
	selectElements.forEach(select => {
		if (select.name == 'sfl') return;
		select.addEventListener('change', () => {
			searchFrm.dispatchEvent(new Event('submit'));
		});
	});

	// 검색
	searchFrm.addEventListener('submit', async (e) => {
		e.preventDefault();
		const f = e.target;

		// 검색어 2글자 이상
		if (f.stx.value.length === 1) return showAlert("검색어를 2글자 이상 입력해 주세요.");

		searchFrm.submit();
	});

	const memberId = document.querySelector('#memberId').value;

	document.addEventListener('keyup', (e) => {
		// 가격이면 콤마 추가
		if (e.target && e.target.name == 'price') {
			if (e.target.closest('form').name == 'accRecFrm') { // 1. 외상거래는 마이너스 입력가능
				const val = e.target.value;
				if (val == '-') e.target.value = '-';
				else
					e.target.value = val == 0 ? '' : addCommaNumber(val, true);
			} else { // 2. 입금거래
				const val = toNumber(e.target.value);
				e.target.value = val == 0 ? '' : addCommaNumber(val);
			}
		}
	});

	// 거래등록 모달
	const openRegisterTrans = async (isDeposit, idx) => {
		let formName, modalElement;

		if (isDeposit === 1) { // 입금내역
			formName = 'depFrm';
			modalElement = $('#misu02');

		} else { // 외상거래
			formName = 'accRecFrm';
			modalElement = $('#misu01');
		}

		// 초기화
		clearForm(formName);
		const form = document[formName];

		if (idx) {
			const response = await fetchData(`/apiAdmin/misuInfo/${idx}`, "", "GET");
			if (!response.data || Object.keys(response.data).length == 0) {
				return showAlert(`정보를 불러오는데 실패했습니다.`);
			}
			//console.log(response);
			const data = response.data;
			const price = isDeposit? data.deposit : data.credit_price;
			form.idx.value = idx;
			form.date.value = data.trans_date;
			form.content.value = data.trans_content;
			form.price.value = addCommaNumber(price, true);

		} else {
			// 오늘날짜 바인딩
			form.date.value = dayjs().format('YYYY-MM-DD');
		}

		modalElement.modal();
	}

	// 거래 등록/수정
	let forms = document.querySelectorAll('form');
	forms.forEach((form) => {
		if (form.name == 'accRecFrm' || form.name == 'depFrm') {
			form.onsubmit = async (e) => {
				e.preventDefault();

				const formData = new FormData(form);
				formData.append('formName', form.name);
				formData.append('memberId', memberId);

				const response = await fetchData('/apiAdmin/registerMisu', formData);
				if (response.result) {
					location.reload();
				} else {
					return showAlert('등록에 실패했습니다.');
				}
			}
		}
	});

	// 거래 삭제
	const deleteTrans = async (idx) => {
		const confirmResult = await showConfirm('거래내역을 삭제하시겠습니까?');
		if (confirmResult.isConfirmed !== true) return false;

		const response = await fetchData('/apiAdmin/deleteMisu', {idx, memberId});
		if (response.result) {
			location.reload();
		} else {
			return showAlert('삭제에 실패했습니다.');
		}
	}


</script>
