<section class="sample">
	<form name="searchFrm" autocomplete="off">
		<div class="panel">
			<p>총 <span class="green"><?=$data['count']?></span>개 </p>
			<div>
				<select name="sfl">
					<option value="title">제목</option>
				</select>
				<input class="search-bar" name="stx" type="search" value="" placeholder="검색어를 입력하세요">
				<button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
			</div>
			<span>
                <button type="button" class="btn btn_black" onclick="commonActionDelete();">선택 삭제</button>
                <button type="button" class="btn btn_blue" onclick="location.href='./estiSampleForm'">샘플 등록</button>
            </span>
		</div>
	</form>

	<div class="box3">
		<div class="table adm">
			<table>
				<colgroup>
					<col width="20px">
					<col width="30px">
					<col width="100px">
					<col width="*">
					<col width="140px">
					<col width="140px">
				</colgroup>
				<thead>
				<tr>
					<th><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
					<th>No.</th>
					<th>우선순위</th>
					<th>제목</th>
					<th>등록일</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
                <? foreach($data['data'] as $d) {?>
				<tr>
					<td><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></td>
					<td><?=$d['jl_no']?></td>
					<td><input type="number" value="<?=$d['priority']?>"></td>
					<td><?=$d['title']?></td>
					<td><?=explode(" ",$d['insert_date'])[0]?></td>
					<td>
						<button type="button" class="btn btn_whiteline">수정</button>
						<button type="button" class="btn btn_redline">삭제</button>
					</td>
				</tr>
                <?}?>
                <?if(!$data['count']){?>
				<tr><td colspan="20" class="noDataAlign">등록된 샘플이 없습니다.</td></tr>
                <?}?>
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
