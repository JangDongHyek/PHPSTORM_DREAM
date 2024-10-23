<section class="request">
	<form name="searchFrm" autocomplete="off">
		<div class="panel">
			<p>총 <span class="green">0</span>개 </p>
			<div>
				<select name="sfl">
					<option value="title">제목</option>
				</select>
				<input class="search-bar" name="stx" type="search" value="" placeholder="검색어를 입력하세요">
				<button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
			</div>
		</div>
	</form>

	<div class="box3">
		<div class="table adm">
			<table>
				<colgroup>
					<col width="20px">
					<col width="30px">
					<col width="auto">
					<col width="100px">
					<col width="200px">
				</colgroup>
				<thead>
				<tr>
					<th>No.</th>
					<th>상태</th>
					<th>요청검색어</th>
					<th>요청일</th>
					<th>요청자(아이디)</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>-</td>
					<td>
						<select style="margin-bottom: 0">
							<option>미확인</option>
							<option>확인</option>
							<option>입고</option>
						</select>
					</td>
					<td>요청검색어</td>
					<td>요청일</td>
					<td>요청자(아이디)</td>
				</tr>
				<tr><td colspan="20" class="noDataAlign">등록된 요청이 없습니다.</td></tr>
				</tbody>
			</table>
		</div>

		<div class="paging">
			<div class="pagingWrap">
				<!--처음-->

				<!--이전-->

				<!--페이지-->

				<!--다음-->

				<!--마지막-->
			</div>
		</div>
	</div>
</section>
