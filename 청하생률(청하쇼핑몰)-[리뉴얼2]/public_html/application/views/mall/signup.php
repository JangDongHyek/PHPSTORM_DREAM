<div id="signup" class="member container">
	<? include_once VIEWPATH . '_common/navigator.php'; // 위치 ?>
	<? $isMyPage = ($pid == 'mypage'); // 내정보수정 여부 ?>

	<div class="boxline">

		<form name="signup" method="post" autocomplete="off">
			<input type="hidden" name="pid" value="<?=$pid?>">

			<div class="sign_form">
				<div>
					<p>회원 정보</p>
					<div class="form_wrap">
						<div>
							<input type="text" name="id" placeholder="아이디" value="<?=$member['mb_id']?>" <?=$isMyPage?'readonly':'';?>>
							<input type="password" name="password" placeholder="비밀번호">
							<input type="password" name="passwordChk" placeholder="비밀번호확인">
						</div>
						<div>
							<input type="text" name="name" placeholder="성명" value="<?=$member['mb_name']?>">

							<input type="text" name="hp" placeholder="휴대폰번호" value="<?=$member['mb_hp']?>">
                            <input type="email" name="email" placeholder="이메일" value="<?=$member['cn_email']?>">
						</div>
                        <div>
                            <input type="text" name="addr" placeholder="기본주소" onkeyup="openDaumAddress()" value="<?=$member['cn_addr']?>">
                            <input type="text" name="addrDetail" placeholder="상세주소" value="<?=$member['cn_addr_detail']?>">
                            <input type="hidden" name="zipCode" value="<?=$member['cn_zcode']?>">
                        </div>
					</div>
				</div>
				<div style="display: none">
					<p>한의원 정보</p>
					<div class="form_wrap">
						<div>
							<? $emptyBrno = ($isMyPage && empty($member['biz_rno'])); ?>
							<input type="text" name="clinicName" placeholder="한의원명" value="<?=$member['cn_name']?>">
							<input type="text" name="brno" placeholder="사업자등록번호 또는 면허번호" value="<?=$member['biz_rno']?>" <?=$emptyBrno?'readonly':''?>>
							<input type="checkbox" name="emptyBrno" id="emptyBrno" value="y" <?=$emptyBrno?'checked':''?>>
							<label for="emptyBrno">사업자번호 없음</label>

							<!--<input type="hidden" name="lat">
							<input type="hidden" name="lng">-->
						</div>
						<div>
                            <input type="text" name="birth" placeholder="생년월일 (8자리)" value="<?=$member['mb_birth']?>">
							<input type="text" name="repName" placeholder="대표자명" value="<?=$member['rep_name']?>">
							<input type="text" name="bizType" placeholder="업태" value="<?=$member['biz_type']?>">
							<input type="text" name="tel" placeholder="대표전화" value="<?=$member['cn_tel']?>">
							<input type="text" name="fax" placeholder="팩스번호" value="<?=$member['cn_fax']?>">
						</div>

						<?if (!$isMyPage) { ?>
						<div>
							<dl class="file_wrap">
								<dt>사업자등록증(면허증)</dt>
								<dd id="addFile1">
									<a class="btn btn_black">파일첨부</a> <span>파일을 선택하세요..</span>
									<input type="hidden" name="fileName[1]">
								</dd>
							</dl>
                            <!--
							<dl class="file_wrap">
								<dt>원외탕전실 계약서</dt>
								<dd id="addFile2">
									<a class="btn btn_black">파일첨부</a> <span>파일을 선택하세요..</span>
									<input type="hidden" name="fileName[2]">
								</dd>
							</dl>
							<a onclick="showAlert('준비중입니다.')" id="btnFileDown" class="btn btn_middle btn_greenline">계약서 파일 다운로드</a>
							-->
						</div>
						<?}?>

					</div>
				</div>
				<div class="btn_wrap">
					<button type="submit" class="btn btn_large btn_green"><?=$isMyPage?'정보수정':'회원가입'?></button>
				</div>
			</div>
		</form>
	</div>

	<!-- file upload hidden -->
	<div class="hide">
		<input type="file" name="file1" onchange="fileUpload(this, 1);">
		<input type="file" name="file2" onchange="fileUpload(this, 2);">
	</div>

</div>

<? include_once VIEWPATH . 'component/daum_addr_popup.php'; // 다음주소 ?>

<!-- 회원가입/내정보수정 js -->
<script src="<?=ASSETS_URL?>/js/mall/signup.js?v=<?=JS_VER?>"></script>
