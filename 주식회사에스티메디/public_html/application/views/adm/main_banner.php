<!--관리자 메인배너관리-->
<section class="banner">
	<form name="searchFrm" autocomplete="off">
		<div class="panel">
			<p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
			<div>
				<select name="sfl">
					<option value="title" <?=$_GET['sfl']=='title'?'selected':''?>>제목</option>
				</select>
				<input class="search-bar" name="stx" type="search" value="" placeholder="검색어를 입력하세요" />
				<button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
			</div>
			<span>
                <button type="button" class="btn btn_black" onclick="commonActionDelete();">선택 삭제</button>
                <button type="button" class="btn btn_blue" onclick="location.href='<?=PROJECT_URL?>/adm/mainBannerForm'">배너 등록</button>
            </span>
		</div>
	</form>

	<div class="box3">
		<div class="table adm">
			<table>
				<colgroup>
					<col width="20px">
					<col width="30px">
					<col width="50px">
					<col width="*">
					<col width="150px">
					<col width="100px">
					<col width="100px">
					<col width="150px">
				</colgroup>
				<thead>
				<tr>
					<th><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
					<th>No.</th>
					<th>이미지</th>
					<th>제목</th>
					<th>연결링크</th>
					<th>우선순위</th>
					<th>노출</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="checkbox" name="checkIdx" value="<?=$list['idx']?>"/></td>
						<td><?=$paging['listNo']?></td>
						<td><div class="thumb_img"><img src="<?=ASSETS_URL?>/img/common/noimg.jpg"></div></td>
						<td><?=$list['title']?></td>
						<td><a target="_blank">www.</a></td>
						<td><input type="number"></td>
						<td>
							<select>
								<option>노출</option>
								<option>승인</option>
							</select>
						</td>
						<td>
							<button type="button" class="btn btn_whiteline" onclick="location.href='<?=PROJECT_URL?>/adm/popupForm/<?=$list['idx']?>'">수정</button>
							<button type="button" class="btn btn_redline" onclick="commonActionDelete('/apiAdmin/deletePopup', '<?=$list['idx']?>')">삭제</button>
						</td>
					</tr>
					<tr><td colspan="20" class="noDataAlign">등록된 팝업이 없습니다.</td></tr>
				</tbody>
			</table>
		</div>

		<? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
	</div>
</section>
