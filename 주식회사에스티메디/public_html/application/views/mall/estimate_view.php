<div id="estimate">
	<? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

	<div class="btn_wrap">
		<?/*a class="btn btn_small" onclick="">삭제</a>
		<a class="btn btn_small btn_gray" href="">수정</a*/?>
		<a class="btn btn_small btn_black" href="./estimatePrint" target="_blank">출력</a>
		<a class="btn btn_small btn_blueline" href="">구매</a>
		<a class="btn btn_small btn_blue male-auto" href="./estimate">목록</a>
	</div>

	<div class="board_view">
		<div class="boxline">
			<div class="title">
				<div class="info">
					작성일 <p>24.01.11 10:05</p>
				</div>
			</div>


			<div class="view">
				<section class="list_wrap">
					<h6 class="table_total">
						<span>견적금액</span>
						<span>일금 영 <b><em class="korUnit" data-number="1234567"></em>원</b></span>
						<span><b>( ￦<em>1,234,567</em>)</b> ※부가세 포함</span>
					</h6>
					<div class="table_wrap table">
						<table>
							<thead>
							<tr>
								<th>No.</th>
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
							<?php for ($i = 0; $i < 20; $i++) { ?>
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
					<div class="total_table table flex">
						<table>
							<colgroup>
								<col style="width: 50%">
								<col style="width: 50%">
							</colgroup>
							<thead>
							<tr>
								<th>기존 합계</th>
								<th>ST 합계</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>기존 합계</td>
								<td>ST 합계</td>
							</tr>
							</tbody>
						</table>
						<table>
							<colgroup>
								<col style="width: 50%">
								<col style="width: 50%">
							</colgroup>
							<thead>
							<tr>
								<th>차액</th>
								<th>절감 %</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>차액</td>
								<td class="txt_red">절감 %</td>
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
			</div>

		</div>
	</div>
</div>
