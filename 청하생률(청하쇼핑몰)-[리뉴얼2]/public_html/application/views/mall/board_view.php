<!--고객센터 상세-->
<div id="board">
	<div class="area_top">
		<? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>
		<? include_once VIEWPATH . '_common/lnb_cs.php'; // 고객센터 LNB ?>
	</div>

    <div class="btn_wrap">
        <?if($isAdminAccount || $member['mb_id']==$boardData['mb_id']){?>
		<a class="btn btn_small" onclick="deleteBoard('<?=$boardData['idx']?>')">삭제</a>
        <a class="btn btn_small btn_gray" href="<?=PROJECT_URL?>/boardForm/<?=$boardData['idx']?>?cate=<?=$category?>">수정</a>
		<?}?>
        <a class="btn btn_small btn_gray" href="javascript:history.back()">목록</a>
    </div>

    <div class="board_view">
        <div class="boxline">
            <div class="title">
                <strong><?=$boardData['title']?></strong>
                <div class="info">
                    작성자 <p><?=$boardData['mb_name']?></p>
                    작성일 <p><?=replaceDateFormat($boardData['reg_date'], 14)?></p>
					조회수 <p><?=number_format($boardData['view_cnt'])?></p>

                    <?if ($category == 'review') { ?>
                        <!--
                        별점 <p><?=number_format($boardData['star'])?></p>
                        -->
                    <?php } ?>
                    
                </div>
            </div>

			<?if(count($attachedFile) > 0) { ?>
			<!--첨부파일 다운로드-->
			<div class="attached_file">
				<strong><i class="fa-light fa-folder-download"></i> 첨부파일</strong>
				<?$downloadUri = PROJECT_URL.'/file/download?path='.uploadFileRemoveServerPath(UPLOAD_FOLDERS['BOARD']);?>
				<?foreach ($attachedFile AS $file) { ?>

                    <?if ($category == 'review') { ?>
                        <div><img src="<?=$downloadUri?><?=$file['fileName']?>"  style="width: 150px"></div>
                    <?php }else{ ?>
                        <div><a href="<?=$downloadUri?><?=$file['fileName']?>" target="_blank"><?=$file['orgFileName']?></a></div>
                    <?php } ?>
				<?}?>
			</div>
			<?}?>

            <div class="view">
				<?=$boardData['content']?>
            </div>

			<?if ($category == 'qna') { ?>
			<!--답변-->
            <div class="answer">
				<?if(count($commentData) == 0) {?>
				<dl>관리자의 답변을 기다리는 중입니다.</dl>

				<?} else { ?>
				<?foreach ($commentData AS $comment) { ?>
				<dl>
					<dt>
						<i class="fa-light fa-arrow-turn-down-right"></i> 작성자 <strong>관리자</strong> 답변일 <strong><?=replaceDateFormat($comment['reg_date'],14)?></strong>
						<?if($isAdminAccount) {?>
						<button type="button" class="btn" onclick="modifyAnswer(this, '<?=$comment['idx']?>')">수정</button>
						<button type="button" class="btn" onclick="deleteAnswer('<?=$comment['idx']?>')">삭제</button>
						<?}?>
					</dt>
					<dd class="content"><?=nl2br($comment['content'])?></dd>
				</dl>
				<?}}?>


				<?if($isAdminAccount) { // 관리자만 답변가능 ?>
                <div class="answer_write">
					<input type="hidden" name="boardIdx" value="<?=$boardData['idx']?>">
					<input type="hidden" name="commentIdx" value="0">
                    <textarea name="answer" placeholder="답변을 등록해 주세요"></textarea>
                    <button type="button" class="btn btn_green" onclick="registerAnswer()">답변등록</button>
                </div>
				<?}?>
            </div>
			<!--//답변-->
			<? } ?>
        </div>
    </div>
</div>

<script>
	// 게시글 삭제
	const deleteBoard = async (idx) => {
		const confirmResult = await showConfirm(`글을 삭제 하시겠습니까?`);
		if (confirmResult.isConfirmed !== true) return false;

		const moveUrl = `${baseUrl}board` + window.location.search;
		await commonActionRegister('/api/deleteBoard', {idx}, '삭제', moveUrl);
	}

	// 답변 등록/수정
	const registerAnswer = async (idx) => {
		const answerElement = document.querySelector('textarea[name=answer]');
		const answer = answerElement.value;
		if (answer.length == 0) {
			return showAlert('답변을 입력해 주세요.', () => {
				answerElement.focus();
			});
		}
		const boardIdx = document.querySelector('[name=boardIdx]').value;
		const commentIdx = document.querySelector('[name=commentIdx]').value;

		const gubun = (commentIdx == '')? '등록' : '수정';
		const confirmResult = await showConfirm(`답변을 ${gubun}하시겠습니까?`);
		if (confirmResult.isConfirmed !== true) return false;

		await commonActionRegister('/api/registerComment', {answer, boardIdx, commentIdx}, gubun, '', false);
	}

	// 답변수정 textarea bind
	const modifyAnswer = (elem, idx) => {
		const parent = elem.closest('dl');
		const originAnswer = parent.querySelector('.content').innerText;

		document.querySelector('[name=commentIdx]').value = idx;
		document.querySelector('[name=answer]').value = originAnswer;
		document.querySelector('[name=answer]').focus();
	}

	// 답변 삭제
	const deleteAnswer = async (idx) => {
		const confirmResult = await showConfirm(`선택하신 답변을 삭제하시겠습니까?`);
		if (confirmResult.isConfirmed !== true) return false;

		await commonActionRegister('/api/deleteComment', {idx}, '삭제', '', false);
	}
</script>
