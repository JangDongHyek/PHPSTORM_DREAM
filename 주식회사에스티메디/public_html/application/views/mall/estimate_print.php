
<link href="<?=ASSETS_URL?>/css/estimate_print.css?v=<?=CSS_VER?>" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0, maximum-scale=3, user-scalable=yes">
<section class="grid_print" onclick="print()">
	<h3 class="text-center">견적서</h3>
	<div class="table flex top">
		<div class="info">
			<h6>2024년 10월 16일</h6>
			<h6>에스티메디 귀하</h6>
			<p>아래와 같이 견적합니다</p>
		</div>
		<table>
			<colgroup>
				<col width="15%">
				<col width="*">
				<col width="15%">
				<col width="25%">
			</colgroup>
			<tbody>
			<tr>
				<th>등록번호</th>
				<td colspan="3">631-87-02972</td>
			</tr>
			<tr>
				<th>상호</th>
				<td>에스티메디</td>
				<th>성명</th>
				<td></td>
			</tr>
			<tr>
				<th>주소</th>
				<td colspan="3">부산광역시 동래구 온천장로 114-12, 502호(온천동, 쿤스트하우스)</td>
			</tr>
			<tr>
				<th>전화번호</th>
				<td colspan="3">TEL : 051-715-1730</td>
			</tr>
			</tbody>
		</table>
	</div>
	<h6 class="table_total">
		<span>견적금액</span>
		<span>
			일금 영 <b><em class="korUnit" data-number="900750"></em>원</b>
			<b>( ￦<em>900,750</em>)</b> ※부가세 포함</span>
	</h6>
	<div class="table_wrap table">
		<table>
			<colgroup>
				<col style="width: 4%">
				<col style="width: 12%">
				<col style="width: 6%">
				<col style="width: 5%">
				<col style="width: 7%">
				<col style="width: 9%">
				<col style="width: 14%">
				<col style="width: 7%">
				<col style="width: 12%">
				<col style="width: 13%">
				<col style="width: 11%">
			</colgroup>
			<thead>
			<tr>
				<th></th>
				<th>제품명</th>
				<th>포장단위</th>
				<th>수량</th>
				<th>약가</th>
				<th>총수량</th>
				<th>기존합계</th>
				<th>ST단가</th>
				<th>대체품목</th>
				<th>ST합계</th>
				<th>절감금액</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td alt="No.">
					<p>1</p>
				</td>
				<td alt="제품명">
					<p>산텐플루메토론0.02점안액/5ml</p>
				</td>
				<td alt="포장단위" class="text_right">
					<p><em>포장단위</em>100</p>
				</td>
				<td alt="수량">
					<p><em>수량</em>100</p>
				</td>
				<td alt="약가" class="text_right">
					<p><em>약가</em>1,165</p>
				</td>
				<td alt="총수량" class="text_right">
					<p><em>총수량</em>100</p>
				</td>
				<td alt="기존합계" class="text_right">
					<p><b><em>기존합계</em>116,500</b></p>
				</td>
				<td alt="ST단가" class="text_right">
					<p><em>ST단가</em><b>825</b></p>
				</td>
				<td alt="대체품목">
					<p>
						<b>후메론점안액0.02%/5ml</b>
					</p>
				</td>
				<td alt="ST합계" class="text_right">
					<p><em>ST합계</em><b>825</b></p>
				</td>
				<td alt="절감금액" class="text_right">
					<p class="txt_red"><em>절감금액</em><b>34,000</b></p>
				</td>
			</tr>
			<?php for ($i = 0; $i < 10; $i++) { ?>
				<tr>
					<td alt="No.">
						<p class="temp">-</p>
					</td>
					<td alt="제품명">
						<p class="temp">제품명</p>
					</td>
					<td alt="포장단위" class="text_right">
						<p class="temp">포장단위</p>
					</td>
					<td alt="수량" class="text_right">
						<p class="temp">0</p>
					</td>
					<td alt="약가" class="text_right">
						<p class="temp">0</p>
					</td>
					<td alt="총수량" class="text_right">
						<p class="temp">0</p>
					</td>
					<td alt="기존합계" class="text_right">
						<p class="temp">0</p>
					</td>
					<td alt="ST단가" class="text_right">
						<p class="temp">0</p>
					</td>
					<td alt="대체품목">
						<p class="temp">대체품목</p>
					</td>
					<td alt="ST합계" class="text_right">
						<p class="temp">0</p>
					</td>
					<td alt="절감금액" class="text_right">
						<p class="temp">0</p>
					</td>
				</tr>
			<?php }	?>
			<tr class="bg2">
				<td alt="계" colspan="6" class="text_right">
					기존합계
				</td>
				<td alt="기존합계" colspan="2" class="text_right">
					<p>0</p>
				</td>
				<td alt="계" colspan="1" class="text_right">
					ST합계
				</td>
				<td alt="ST합계" colspan="2" class="text_right">
					<p>0</p>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<script>
		// 한자어 숫자 변환을 위한 단위와 숫자 배열
		const units = ['', '만', '억', '조', '경'];
		const digits = ['', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구'];
		const positions = ['', '십', '백', '천'];

		// 숫자를 한글로 변환하는 함수
		function numberToKorean(num) {
			if (num === 0) return '영';
			let result = '';
			let unitIndex = 0;

			while (num > 0) {
				// 네 자리씩 처리 (천, 만, 억 단위)
				let part = num % 10000;
				if (part !== 0) {
					result = convertPart(part) + units[unitIndex] + result;
				}
				unitIndex++;
				num = Math.floor(num / 10000);
			}

			return result.trim();
		}

		// 네 자리 이하 숫자를 한글로 변환하는 함수
		function convertPart(part) {
			let partResult = '';
			const strPart = String(part);
			const len = strPart.length;

			for (let i = 0; i < len; i++) {
				const digit = Number(strPart[i]);
				if (digit !== 0) {
					partResult += digits[digit] + positions[len - i - 1];
				}
			}

			return partResult;
		}

		// .korUnit 클래스를 가진 모든 span에 변환된 한글 숫자 적용
		document.querySelectorAll('.korUnit').forEach(span => {
			const num = parseInt(span.getAttribute('data-number'), 10);
			if (!isNaN(num)) {
				span.textContent = numberToKorean(num);
			}
		});
	</script>
</section>
