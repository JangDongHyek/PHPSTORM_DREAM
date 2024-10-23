<section class="member agency">
	<form name="member" autocomplete="off" method="post">
		<div class="flex">
			<button type="button" class="btn btn_gray" onclick="location.href='./agency'">목록</button>
			<span>
                <button type="submit" class="btn btn_red">등록하기</button>
            </span>
		</div>
		<br>
		<input type="hidden" name="idx" value="">
		<input type="hidden" name="level" value="">

		<div class="box">
			<h3>계정 정보</h3>
			<div class="flex">
				<div>
					<div>
						<label>상태</label>
						<select>
							<option value="">승인</option>
							<option value="">중지</option>
						</select>
					</div>
					<label>아이디</label><input type="text" name="id" value="" placeholder="아이디">
					<label>성명</label><input type="text" name="name" value="" placeholder="성명">
					<label>비밀번호</label><input type="password" name="password" placeholder="비밀번호">
					<label>비밀번호확인</label><input type="password" name="passwordChk" placeholder="비밀번호확인">
				</div>
			</div>
		</div>
		<div class="box">
			<h3>에이전시 정보</h3>
			<div class="flex jc-sb">
				<div>
					<div class="group_select">
						<label>구분</label>
						<select name="agency_div">
							<option value="">선택</option>
							<option value="병원">병원</option>
							<option value="약국">약국</option>
							<option value="기타">기타</option>
						</select>
					</div>
					<label>업체명</label><input type="text" name="clinicName" value="" placeholder="업체명">
					<label>대표자명</label><input type="text" name="repName" value="" placeholder="대표자명">
					<label>이메일</label><input type="email" name="email" value="" placeholder="이메일">
				</div>
				<div>
					<label>기본주소</label><input type="text" name="addr" value="" placeholder="기본주소">
					<label>상세주소</label><input type="text" name="addrDetail" value="" placeholder="상세주소">
					<input type="hidden" name="zipCode" value=""> <!--우편번호-->
					<label>연락처</label><input type="text" name="tel" value="" placeholder="연락처">
					<label>팩스번호</label><input type="text" name="fax" value="" placeholder="팩스번호">
				</div>
				<div>
					<label>사업자등록번호/면허번호</label><input type="text" name="brno" value="" placeholder="사업자등록번호 또는 면허번호">
					<div>
						<input type="checkbox" name="emptyBrno" id="emptyBrno" value="y">
						<label for="emptyBrno">사업자번호 없음 (개인/프리랜서)</label>
					</div>
					<dl class="file_wrap">
						<dt>사업자등록증(면허증)</dt>
						<dd id="addFile1">
							<a class="btn btn_black">파일첨부</a>
							<span>파일을 선택하세요..</span>
							<input type="hidden" name="fileName[1]" value="">
						</dd>
					</dl>
				</div>
			</div>

		</div>

		<div class="box link_list">
			<h3>연결 업체 <span class="txt_blue">2개</span></h3>
			<div class="flex jc-sb">
				<div>

					<div class="table adm">
						<table>
							<colgroup>
								<col width="20px">
								<col width="30px">
								<col width="100px">
								<col width="*">
								<col width="*">
								<col width="*">
								<col width="*">
								<col width="*">
								<col width="*">
								<col width="30px">
							</colgroup>
							<thead>
							<tr>
								<th>NO.</th>
								<th>구분</th>
								<th>아이디</th>
								<th>업체명</th>
								<th>대표자명</th>
								<th>연락처</th>
								<th>사업자등록번호</th>
								<th>주소</th>
								<th>업체 연결일</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>2</td>
								<td>병원</td>
								<td>hospital</td>
								<td>드림병원</td>
								<td>김의사</td>
								<td>010-3030-3030</td>
								<td>010-03-03030</td>
								<td>경북 구미시 1공단로 15-37 상세주소</td>
								<td>24.06.11</td>
								<td>
									<button type="button" class="btn btn_black">해제</button>
								</td>
							</tr>
							<tr>
								<td>1</td>
								<td>약국</td>
								<td>pharmacy</td>
								<td>드림약국</td>
								<td>김약사</td>
								<td>010-3030-3030</td>
								<td>010-03-03030</td>
								<td>경북 구미시 1공단로 15-37 상세주소</td>
								<td>24.06.11</td>
								<td>
									<button type="button" class="btn btn_black">해제</button>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					<?/*
					<form name="search" autocomplete="off" method="post">
						<div>
							<h5><strong>업체 검색</strong></h5>
							<div class="search flex">
								<input class="search-bar w100" name="stx" id="stx" type="search" value="" placeholder="업체명/아이디/대표자를 입력하세요" onkeypress="if(event.keyCode=='13'){ event.preventDefault();agencySearchMember();}">
								<button type="button" class="btn_search" onclick="agencySearchMember()"><i class="fa-light fa-magnifying-glass"></i></button>
							</div>
							<div id="agency_members_list" class="flex flexwrap gap10 start">

							</div>
						</div>
					</form>
					<div class="box_white box">

						<h5><strong>검색 리스트</strong></h5>
						<div class="table adm">
							<table>
								<colgroup>
									<col width="20px">
									<col width="30px">
									<col width="100px">
									<col width="*">
									<col width="*">
									<col width="*">
									<col width="*">
									<col width="*">
									<col width="30px">
								</colgroup>
								<thead>
								<tr>
									<th>NO.</th>
									<th>구분</th>
									<th>아이디</th>
									<th>업체명</th>
									<th>대표자명</th>
									<th>연락처</th>
									<th>사업자등록번호</th>
									<th>주소</th>
									<th></th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>2</td>
									<td>병원</td>
									<td>hospital</td>
									<td>드림병원</td>
									<td>김의사</td>
									<td>010-3030-3030</td>
									<td>010-03-03030</td>
									<td>경북 구미시 1공단로 15-37 상세주소</td>
									<td>
										<button type="button" class="btn btn_green">선택</button>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>약국</td>
									<td>pharmacy</td>
									<td>드림약국</td>
									<td>김약사</td>
									<td>010-3030-3030</td>
									<td>010-03-03030</td>
									<td>경북 구미시 1공단로 15-37 상세주소</td>
									<td>
										<button type="button" class="btn btn_green">선택</button>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					*/?>
				</div>
			</div>
		</div>
	</form>
</section>
