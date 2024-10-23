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
					</div>
				</div>
				<div style="display: ">
					<p>병원 정보</p>
					<div class="form_wrap">
						<div>
							<input type="text" name="name" placeholder="병원명" value="<?=$member['mb_name']?>">
							<input type="text" name="bizType" placeholder="요양기관번호" value="<?=$member['biz_type']?>">
							<input type="text" name="tel" placeholder="전화번호" value="<?=$member['cn_tel']?>">
							<input type="text" name="fax" placeholder="팩스번호" value="<?=$member['cn_fax']?>">
							<input type="email" name="email" placeholder="이메일" value="<?=$member['cn_email']?>">
						</div>
					</div>
				</div>
				<div>
					<p>회원 정보</p>
					<div class="form_wrap">
						<div>
							<input type="text" name="addr" placeholder="기본주소" onkeyup="openDaumAddress()" value="<?=$member['cn_addr']?>">
							<input type="text" name="addrDetail" placeholder="상세주소" value="<?=$member['cn_addr_detail']?>">
							<input type="hidden" name="zipCode" value="<?=$member['cn_zcode']?>">
						</div>
						<br>

						<?if (!$isMyPage) { ?>
							<div>
								<dl class="file_wrap">
									<dt>사업자등록증</dt>
									<dd id="addFile1">
										<a class="btn btn_black">파일첨부</a> <span>파일을 선택하세요..</span>
										<input type="hidden" name="fileName[1]">
									</dd>
								</dl>
							</div>
						<?}?>

						<br>
                        <div>
							<input type="text" name="repName" placeholder="담당자(관리자)" value="<?=$member['rep_name']?>">
                            <input type="text" name="hp" placeholder="담당자 연락처" value="<?=$member['mb_hp']?>">
                        </div>
                    </div>
                </div>
                <div style="display: none">
                    <? $emptyBrno = ($isMyPage && empty($member['biz_rno'])); ?>
                    <div>
                        <!--<input type="hidden" name="lat">
                        <input type="hidden" name="lng">-->
                    </div>
                    <input type="text" name="clinicName" placeholder="한의원명" value="<?=$member['cn_name']?>">
                    <input type="text" name="brno" placeholder="사업자등록번호 또는 면허번호" value="<?=$member['biz_rno']?>" <?=$emptyBrno?'readonly':''?>>
                    <input type="checkbox" name="emptyBrno" id="emptyBrno" value="y" <?=$emptyBrno?'checked':''?>>
                    <label for="emptyBrno">사업자번호 없음</label>
                    <input type="text" name="birth" placeholder="생년월일 (8자리)" value="<?=$member['mb_birth']?>">
                </div>
                <div class="btn_wrap">
                    <button type="submit" class="btn btn_large btn_blue"><?=$isMyPage?'정보수정':'회원가입'?></button>
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
