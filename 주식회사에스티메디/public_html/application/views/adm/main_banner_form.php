<!--관리자 배너관리 등록/수정-->
<section class="popupupd">
	<form name="popup" autocomplete="off">
		<input type="hidden" name="idx" value="<?=$viewData['idx']?>"/>

		<div class="panel">
			<label class="title">배너제목</label>
			<input type="text" name="title" placeholder="배너제목을 입력하세요" class="title" required maxlength="30" value="<?=$viewData['title']?>"/>
			<span>
                <button type="button" class="btn btn_gray" onclick="history.back()">목록</button>
                <button type="submit" class="btn btn_blue"><?=empty($viewData['idx'])?'등록':'수정'?></button>
            </span>
		</div>
		<div class="box">
			<input type="hidden" name="target" value="C">

			<p class="name">노출상태</p>
			<p class="line">
				<select>
					<option>노출</option>
					<option>승인</option>
				</select>
			</p>
			<p class="name">우선순위</p>
			<p class="line">
				<input type="number" name="" value=""/>높을수록 우선
			</p>
			<p class="name">문구</p>
			<label>※ 미입력시 이미지만 나타납니다.</label>
			<p class="line">
				메인 문구<input type="text" name="" value=""/>
				서브 문구<input type="text" name="" value=""/>
			</p>
			<p class="name">연결링크</p>
			<p class="line">
				<input type="text" name="" value=""/>
			</p>
			<p class="name">이미지</p>
			<label>※ 권장 크기 1300*250 (반응형 가로*200px)</label>
			<dl class="file_wrap">
				<dd>
					<button type="button" class="btn btn_black" onclick="addImage()">이미지 첨부</button>
					<div class="img_prev">
						<?
						// 이미지 미리보기
						if ($viewData['file_nm'] != '') {
							$imgPath = UPLOAD_FOLDERS['POPUP'] . $viewData['file_nm'];
							$imgSrc = ASSETS_URL.'/'.uploadFileRemoveServerPath($imgPath);
							?>
							<img src="<?=$imgSrc?>">
							<button type="button" class="btn btn_whiteline" onclick="deleteFile()">삭제</button>
						<? } else { ?>
							<img src="">
						<? } ?>
					</div>
				</dd>
			</dl>
			<!-- file upload hidden -->
			<div class="hide">
				<input type="file" name="file1" onchange="fileUpload(this)" accept="image/*">
				<input type="hidden" name="fileName" value="<?=$viewData['file_nm']??''?>" />
			</div>
		</div>
	</form>
</section>
