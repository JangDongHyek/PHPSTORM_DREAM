<!--고객센터 등록/수정 폼-->
<? include_once VIEWPATH. 'component/summer_note_resource.php'; // summernote?>

<div id="board">
    <div class="area_top">
		<? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>
		<? include_once VIEWPATH . '_common/lnb_cs.php'; // 고객센터 LNB ?>
    </div>

	<form name="write" autocomplete="off">
		<input type="hidden" name="idx" value="<?=$boardData['idx']?>">
		<input type="hidden" name="category" value="<?=$category?>">

		<div class="btn_wrap">
			<button type="submit" class="btn btn_small btn_blue">등록</button>
		</div>

		<div class="board_write">
			<div class="box">
				<div class="form">
					<?if($category == 'qna' || $category == 'group_order') { // 고객문의/단체주문문의 비밀글 작성가능 ?>
					<div style="margin:5px 0;">
						<input type="checkbox" name="secretYn" value="Y" id="secretYn" <?=$boardData['secret_yn']=='Y'?'checked':''?>>
						<label for="secretYn">비밀글</label>
					</div>
					<?}?>
					<input type="text" name="title" placeholder="제목을 작성해주세요" required value="<?=$boardData['title']?>">
					<div class="editor" style="margin:5px 0;background:#FFF;">
						<!-- 상세설명 -->
						<div id="editor"></div>
						<textarea name="content" style="display: none;"><?=$boardData['content']?></textarea>
					</div>
				</div>
				<div>
					<dl>
						<dd id="addFile1" style="margin-bottom: 5px;">
							<a class="btn btn_black">파일첨부</a>
							<span>파일을 선택하세요..</span>
						</dd>
						<dd id="addFile2">
							<a class="btn btn_black">파일첨부</a>
							<span>파일을 선택하세요..</span>
						</dd>
					</dl>
					<input type="hidden" name="fileName[1]" value="">
					<input type="hidden" name="fileName[2]" value="">
					<input type="hidden" name="orgFileName[1]" value="">
					<input type="hidden" name="orgFileName[2]" value="">
				</div>
			</div>
		</div>
	</form>
	<!-- file upload hidden -->
	<div class="hide">
		<input type="file" name="file1" onchange="fileUpload(this, 1);">
		<input type="file" name="file2" onchange="fileUpload(this, 2);">
	</div>
</div>

<script>
	const uploadAttachFiles = <?=json_encode($attachedFile)?>;
</script>
<!-- 게시판등록/수정 JS -->
<script src="<?=ASSETS_URL?>/js/mall/board_form.js?v=<?=JS_VER?>"></script>
