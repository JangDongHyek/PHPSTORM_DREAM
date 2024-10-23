<section class="member">
    <form name="member" autocomplete="off" method="post">
        <div class="flex">
            <button type="button" class="btn btn_gray" onclick="location.href='<?=PROJECT_URL?>/adm/member'">목록</button>
            <span>

                <?php if($isModify) { ?>
                    <?php if($memberData['auth_yn'] == 'Y') { ?>
                    <button type="button" class="btn btn btn_black" onclick="authCheck('N')">회원 승인취소</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn btn_blue" onclick="authCheck('Y')">회원 승인</button>
                    <?php } ?>
                <?php } ?>
                <button type="submit" class="btn btn_red"><?=$isModify?'수정':'등록'?>하기</button>
            </span>
        </div>
        <br>
        <input type="hidden" name="idx" value="<?=$memberData['idx']?>">
        <input type="hidden" name="level" value="<?=$memberData['mb_level']?>">
        <div class="box">
            <h3>기본 정보</h3>
            <div class="flex">
                <div>
                    <label>아이디</label><input type="text" name="id" value="<?=$memberData['mb_id']?>" placeholder="아이디" <?=$isModify?'readonly':''?>/>
                    <label>비밀번호</label><input type="password" name="password" placeholder="비밀번호"/>
                    <label>비밀번호확인</label><input type="password" name="passwordChk" placeholder="비밀번호확인"/>
                    <label>거래처번호</label><input type="text" name="CUSTOMER_CODE" id="CUSTOMER_CODE" value="<?=$memberData['CUSTOMER_CODE']?>" placeholder="거래처번호" minlength="5" maxlength="5"/>
                </div>
				<div>
					<label>병원명</label><input type="text" name="name" value="<?=$memberData['mb_name']?>" placeholder="병원명"/>
					<label>요양기관번호</label><input type="text" name="bizType" value="<?=$memberData['biz_type']?>" placeholder="요양기관번호"/>
					<label>전화번호</label><input type="text" name="tel" value="<?=$memberData['cn_tel']?>" placeholder="전화번호"/>
					<label>팩스번호</label><input type="text" name="fax" value="<?=$memberData['cn_fax']?>" placeholder="팩스번호"/>
					<label>이메일</label><input type="email" name="email" value="<?=$memberData['cn_email']?>" placeholder="이메일"/>
				</div>
            </div>
        </div>
        <div class="box">
            <h3>추가 정보</h3>
            <div class="flex jc-sb">
				<div>
					<label>기본주소</label><input type="text" name="addr" value="<?=$memberData['cn_addr']?>" placeholder="기본주소"/>
					<label>상세주소</label><input type="text" name="addrDetail" value="<?=$memberData['cn_addr_detail']?>" placeholder="상세주소"/>
					<label>우편번호</label><input type="text" name="zipCode" value="<?=$memberData['cn_zcode']?>" placeholder="우편번호" READONLY/>
				</div>

                <div>
                    <?
                    // 사업자번호 없음체크
                    $isEmptyBrno = ($isModify && $memberData['biz_rno']=="");
                    ?>
                    <label>사업자등록번호</label><input type="text" name="brno" value="<?=$memberData['biz_rno']?>" placeholder="사업자등록번호" <?=$isEmptyBrno? "readonly" : ""?>/>
                    <div>
                        <input type="checkbox" name="emptyBrno" id="emptyBrno" value="y" <?=$isEmptyBrno? "checked" : ""?>>
                        <label for="emptyBrno">사업자번호 없음</label>
                    </div>
                    <dl class="file_wrap">


                        <dt>사업자등록증</dt>
                        <dd id="addFile1">
                            <a class="btn btn_black">파일첨부</a>
                            <?php
                            $file_nm_biz = $memberData['file_nm_biz'] ?? null;
                            if(empty($file_nm_biz)) {
                                ?>
                                <span>파일을 선택하세요..</span>
                            <? } else { ?>
                                <span><a href="<?=PROJECT_URL?>/file/download?path=uploads/clinic/<?=$file_nm_biz?>"><?=$file_nm_biz?></a></span>
                            <?php } ?>
                            <input type="hidden" name="fileName[1]" value="<?=$file_nm_biz?>">
                        </dd>
                    </dl>
                </div>
				<div>
					<label>담당자</label><input type="text" name="repName" value="<?=$memberData['rep_name']?>" placeholder="담당자이름"/>
					<label>담당자 연락처</label><input type="text" name="hp" value="<?=$memberData['mb_hp']?>" placeholder="담당자 연락처"/>
				</div>
            </div>
        </div>
        <div style="display: none">
            <label>한의원명</label><input type="text" name="clinicName" value="<?=$memberData['cn_name']?>" placeholder="한의원명"/>
            <input type="text" name="birth" value="<?=$memberData['mb_birth']?>" placeholder="생년월일(8자리)"/>
            <div class="group_select">
                <label>그룹</label>
                <select name="groupIdx">
                    <option value="">선택</option>
                    <? foreach ($groupList as $key=>$value) { ?>
                        <option value="<?=$key?>" <?=$memberData['group_idx']==$key?'selected':''?>><?=$value?></option>
                    <? } ?>
                </select>

            </div>


            <!--
                    <dl class="file_wrap">
                        <dt>원외탕전실 계약서</dt>
                        <dd id="addFile2">
                            <a class="btn btn_black">파일첨부</a>
                            <?php
            $file_nm_contract = $memberData['file_nm_contract'] ?? null;
            if(empty($file_nm_contract)) {
                ?>
                            <span>파일을 선택하세요..</span>
                            <? } else { ?>
                            <span><a href="<?=PROJECT_URL?>/file/download?path=uploads/clinic/<?=$file_nm_contract?>"><?=$file_nm_contract?></a></span>
                            <?php } ?>
                            <input type="hidden" name="fileName[2]" value="<?=$file_nm_contract?>">
                        </dd>
                    </dl>
                    <a href="<?=PROJECT_URL?>/file/download?path=file/contract.hwp" class="btn btn_large btn_greenline">계약서 파일 다운로드</a>
                    -->
        </div>
    </form>
    <!-- file upload hidden -->
    <div class="hide">
        <input type="file" name="file1" onchange="fileUpload(this, 1);">
        <input type="file" name="file2" onchange="fileUpload(this, 2);">
    </div>
</section>

<? include_once VIEWPATH . 'component/daum_addr_popup.php'; // 다음주소 ?>

<!--회원관리 JS-->
<script src="<?=ASSETS_URL?>/js/adm/member_form.js?v=<?=JS_VER?>"></script>
