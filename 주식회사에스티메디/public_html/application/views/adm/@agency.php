<!--관리자 에이전시관리-->
<section class="popup">
	<form name="searchFrm" autocomplete="off">
		<div class="panel">
			<p>총 <span class="green">1</span>개 </p>
			<div>
				<select name="sfl">
					<option value="title" <?=$_GET['sfl']=='title'?'selected':''?>>성명</option>
				</select>
				<input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요" />
				<button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
			</div>
			<span>
                <button type="button" class="btn btn_green" onclick="location.href='<?=PROJECT_URL?>/adm/agencyForm'">신규 등록</button>
            </span>
		</div>
	</form>

	<div class="boxline">
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
					<col width="*">
					<col width="*">
					<col width="30px">
				</colgroup>
				<thead>
				<tr>
					<th>NO.</th>
					<th>구분</th>
					<th>아이디</th>
					<th>성명</th>
					<th>업체명</th>
					<th>대표자명</th>
					<th>연락처</th>
					<th>사업자등록번호</th>
					<th>주소</th>
					<th>연결업체</th>
					<th>등록일</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>2</td>
					<td>승인</td>
					<td>agency2</td>
					<td>김전시</td>
					<td>개인</td>
					<td>김전시</td>
					<td>010-3030-3030</td>
					<td>010-03-03030</td>
					<td>경북 구미시 1공단로 15-37 상세주소</td>
					<td>3개</td>
					<td>24.06.11</td>
					<td>
						<button type="button" class="btn btn_black">수정</button>
					</td>
				</tr>
				<tr>
					<td>1</td>
					<td>승인</td>
					<td>agency2</td>
					<td>김에이</td>
					<td>영업NO.1</td>
					<td>김에이</td>
					<td>010-3030-3030</td>
					<td>010-03-03030</td>
					<td>경북 구미시 1공단로 15-37 상세주소</td>
					<td>5개</td>
					<td>24.06.11</td>
					<td>
						<button type="button" class="btn btn_black">수정</button>
					</td>
				</tr>
				</tbody>
			</table>
		</div>

		<? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
	</div>
</section>
