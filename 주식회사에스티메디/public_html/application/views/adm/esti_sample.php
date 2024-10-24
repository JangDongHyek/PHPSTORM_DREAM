<section class="sample">
	<form name="searchFrm" autocomplete="off">
		<div class="panel">
			<p>총 <span class="green"><?=$data['count']?></span>개 </p>
			<div>
				<select name="like_key">
					<option value="title">제목</option>
				</select>
				<input class="search-bar" name="like_value" type="search" value="<?=$request_get['like_value']?>" placeholder="검색어를 입력하세요">
				<button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
			</div>
			<span>
                <button type="button" class="btn btn_black" onclick="deletesData();">선택 삭제</button>
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
					<td><input type="checkbox" name="checkIdx" value="<?=$d['idx']?>"></td>
					<td><?=$d['jl_no']?></td>
					<td><input type="number" value="<?=$d['priority']?>"></td>
					<td><?=$d['title']?></td>
					<td><?=explode(" ",$d['insert_date'])[0]?></td>
					<td>
						<button type="button" class="btn btn_whiteline" onclick="window.location.href ='estiSampleForm?idx=<?=$d['idx']?>'">수정</button>
						<button type="button" class="btn btn_redline" onclick="deleteData('<?=$d['idx']?>')">삭제</button>
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

<?php $jl->jsLoad();?>

<script>
    async function deletesData() {
        let arrays = jl.js.getCheckboxName("checkIdx")

        if(!arrays.length) {
            alert("선택된 데이터가 없습니다.");
            return false;
        }

        if(!confirm(`총 ${arrays.length} 건의 데이터를 삭제하시겠습니까?`)) return false;

        let obj = {deletes : arrays}

        try {
            let res = await jl.ajax("deletes",obj,"/api/bs_comparative");
            alert("삭제되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }

    async function deleteData(idx) {
        if(!idx) return false;

        if(!confirm("정말 삭제하시겠습니까?")) return false;

        let obj = {idx : idx}

        try {
            let res = await jl.ajax("delete",obj,"/api/bs_comparative");
            alert("삭제되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>
