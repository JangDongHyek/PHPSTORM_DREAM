<!--관리자 비교견적 샘플 등록/수정-->
<section class="estimateupd">
	<form name="estimate" autocomplete="off">
		<input type="hidden" name="idx" value=""/>

		<div class="panel">
			<label class="title">샘플 제목</label>
			<input type="text" name="title" placeholder="샘플 제목을 입력하세요" class="title" required maxlength="30" value=""/>
			<span>
                <button type="button" class="btn btn_gray" onclick="history.back()">목록</button>
                <button type="submit" class="btn btn_blue">등록</button>
            </span>
		</div>
		<div class="box">
			<p class="name">우선순위</p>
			<p class="line">
				<input type="number" name="" value="" /> 높을수록 우선
			</p>
			<p class="name">샘플내용</p>
			<div class="table">
				<table>
					<thead>
						<tr>
							<th>No.</th>
							<th>품명</th>
							<th>기존단가</th>
							<th>타사단가</th>
							<th>ST단가</th>
							<th>수량</th>
							<th><button type="submit" class="btn btn_blue">추가</button></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td><input type="text" name="" value="" required /></td>
							<td><input type="number" name="" value="" required /></td>
							<td><input type="number" name="" value="" required /></td>
							<td><input type="number" name="" value="" required /></td>
							<td><input type="number" name="" value="" required /></td>
							<td><button type="submit" class="btn btn_line">삭제</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</form>
</section>
