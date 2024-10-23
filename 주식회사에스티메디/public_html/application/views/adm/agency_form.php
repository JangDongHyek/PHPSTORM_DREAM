<section class="member write">
    <form name="member" autocomplete="off" method="post">
        <div class="flex">
            <button type="button" class="btn btn_gray" onclick="location.href='<?=PROJECT_URL?>/adm/agency'">목록</button>
            <span>
                <?/*php if($isModify) { ?>
                    <?php if($memberData['auth_yn'] == 'Y') { ?>
                        <button type="button" class="btn btn btn_black" onclick="authCheck('N')">승인취소</button>
                    <?php } else { ?>
                        <button type="button" class="btn btn btn_blue" onclick="authCheck('Y')">승인</button>
                    <?php } ?>
                <?php } */?>
                <button type="submit" class="btn btn_red"><?=$isModify?'수정':'등록'?>하기</button>
            </span>
        </div>
        <br>
        <input type="hidden" name="idx" value="<?=$memberData['idx']?>">
        <input type="hidden" name="level" value="<?=$memberData['mb_level']?>">

        <div class="box">
            <h3>로그인 정보</h3>
            <div class="flex">
                <div>
                    <label>아이디</label><input type="text" name="id" id="mb_id" value="<?=$memberData['mb_id']?>" placeholder="아이디" <?=$isModify?'readonly':''?>/>
                    <label>성명</label><input type="text" name="name" value="<?=$memberData['mb_name']?>" placeholder="성명"/>
                    <label>비밀번호</label><input type="password" name="password" placeholder="비밀번호"/>
                    <label>비밀번호확인</label><input type="password" name="passwordChk" placeholder="비밀번호확인"/>
                </div>
            </div>
        </div>
        <div class="box" style="display: none">
            <h3>업체 정보</h3>
            <div class="flex jc-sb">
                <div>
                    <div class="group_select">
                        <label>구분</label>
                        <select name="agency_div">
                            <option value="">선택</option>
                            <option value="병원" <?=$memberData['agency_div'] == '병원' ? 'selected' : '' ?>>병원</option>
                            <option value="약국" <?=$memberData['agency_div'] == '약국' ? 'selected' : '' ?>>약국</option>
                            <option value="기타" <?=$memberData['agency_div'] == '기타' ? 'selected' : '' ?>>기타</option>
                        </select>
                    </div>
                    <label>업체명</label><input type="text" name="clinicName" value="<?=$memberData['cn_name']?>" placeholder="업체명"/>
                    <label>대표자명</label><input type="text" name="repName" value="<?=$memberData['rep_name']?>" placeholder="대표자명"/>
                    <label>이메일</label><input type="email" name="email" value="<?=$memberData['cn_email']?>" placeholder="이메일"/>


                </div>
                <div>
                    <label>기본주소</label><input type="text" name="addr" value="<?=$memberData['cn_addr']?>" placeholder="기본주소"/>
                    <label>상세주소</label><input type="text" name="addrDetail" value="<?=$memberData['cn_addr_detail']?>" placeholder="상세주소"/>
                    <input type="hidden" name="zipCode" value="<?=$memberData['cn_zcode']?>"/> <!--우편번호-->
                    <label>대표전화</label><input type="text" name="tel" value="<?=$memberData['cn_tel']?>" placeholder="대표전화"/>
                    <label>팩스번호</label><input type="text" name="fax" value="<?=$memberData['cn_fax']?>" placeholder="팩스번호"/>
                </div>
                <div>
                    <?
                    // 사업자번호 없음체크
                    $isEmptyBrno = ($isModify && $memberData['biz_rno']=="");
                    ?>
                    <label>사업자등록번호/면허번호</label><input type="text" name="brno" value="<?=$memberData['biz_rno']?>" placeholder="사업자등록번호 또는 면허번호" <?=$isEmptyBrno? "readonly" : ""?>/>
                    <div>
                        <input type="checkbox" name="emptyBrno" id="emptyBrno" value="y" <?=$isEmptyBrno? "checked" : ""?>checked>
                        <label for="emptyBrno">사업자번호 없음 (개인/프리랜서)</label>
                    </div>
                    <dl class="file_wrap">
                        <dt>사업자등록증(면허증)</dt>
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
            </div>

        </div>


        <?php if($memberData['idx']){ ?>
            <div class="box link_list">
                <h3>연결 업체 <span class="txt_blue" id="agency_members_cnt">0개</span></h3>
                <div class="flex jc-sb">
                    <div>
                        <div class="table adm">
                            <table>
                                <colgroup>
                                    <col width="20px">
                                    <col width="120px">
                                    <col width="100px">
                                    <col width="*">
                                    <col width="*">
                                    <col width="*">
                                    <col width="130px">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>아이디</th>
                                    <th>대표자명</th>
                                    <th>연락처</th>
                                    <th>사업자등록번호</th>
                                    <th>주소</th>
                                    <th>업체 연결일</th>
                                </tr>
                                </thead>
                                <tbody id="agency_members">
                                <tr>
                                    <td colspan="9999">연결된 업체가 없습니다.</td>
                                    <!--
                                    <td>2</td>
                                    <td>병원</td>
                                    <td>hospital</td>
                                    <td>드림병원</td>
                                    <td>김의사</td>
                                    <td>010-3030-3030</td>
                                    <td>010-03-03030</td>
                                    <td>경북 구미시 1공단로 15-37 상세주소</td>
                                    <td>24.06.11</td>
                                    <td>
                                        <button type="button" class="btn btn_black">해제</button>
                                    </td>
                                    -->
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?/*div class="box" style="display: none">
            <h3>관리회원</h3>
            <div class="flex jc-sb">
                <div>
					<label>선택된 아이디 (,로 구분)</label><input type="text" name="agency_members" id="agency_members" value="<?=$memberData['agency_members']?>" placeholder="관리회원 아이디"/>

					<form name="search" autocomplete="off" method="post">
						<div>
							<select name="sfl" id="sfl" style="display: none">
								<!--
								<option value="cname">한의원명</option>
								-->
								<option value="name" <?=$_GET['sfl']=='name'?'selected':''?>>성명</option>
								<option value="id" selected>아이디</option>
								<option value="rep_name" <?=$_GET['sfl']=='rep_name'?'selected':''?>>대표자명</option>
								<option value="cn_tel" <?=$_GET['sfl']=='cn_tel'?'selected':''?>>대표번호</option>
								<option value="biz_rno" <?=$_GET['sfl']=='biz_rno'?'selected':''?>>사업자등록번호</option>

								<option value="addr" <?=$_GET['sfl']=='addr'?'selected':''?>>주소</option>
							</select>
							<div class="search flex">
								<input class="search-bar w100" name="stx" id="stx" type="search" value="<?=$_GET['stx']?>" placeholder="회원 아이디를 입력하세요"  onKeyPress="if(event.keyCode=='13'){ event.preventDefault();agencySearchMember();}">
								<button type="button" class="btn_search" onclick="agencySearchMember()"><i class="fa-light fa-magnifying-glass"></i></button>
							</div>
							<div id="agency_members_list" class="flex flexwrap gap10 start">
								<span class="flex ai-c  gap5 wfit">
									<strong>test001</strong><button class="btn btn_line btn_mini" type="button" onclick="add_agency_members('test001')">+</button>
								</span>
							</div>
						</div>
					</form>
				</div>
    		</div>
    	</div*/?>
    <!-- file upload hidden -->
    <div class="hide">
        <input type="file" name="file1" onchange="fileUpload(this, 1);">
        <input type="file" name="file2" onchange="fileUpload(this, 2);">
    </div>
</section>

<? include_once VIEWPATH . 'component/daum_addr_popup.php'; // 다음주소 ?>

<!--회원관리 JS-->
<script src="<?=ASSETS_URL?>/js/adm/agency_member_form.js?v=<?=JS_VER?>"></script>
