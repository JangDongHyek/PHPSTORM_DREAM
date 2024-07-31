<?php 
    echo view('common/header_adm'); 
    $pid = "member_write";
    $header_name = "정보관리";
?>


<div id="adm_content">
    <?php echo view('common/jungbi_menu'); ?>

    <div class="con_wrap">
       
        <div class="tit_wrap">
            <h6 class="menu01">관리자 관리</h6>
            <div class="menu02">
                <a href="<?=base_url('/jungbi/member_list')?>" class="active">정보관리</a>
            </div>
        </div>

        <div class="write_wrap">
            <div class="top_wrap">
                <h1>정비업체 정보 수정하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('/jungbi/member_list')?>" class="btn btn-sm btn-gray">목록</a>
                    <a href="<?=base_url('/jungbi/member_list')?>" class="btn btn-sm btn-blue">저장</a>
                </div>
            </div>
            <div class="box">


                <div class="input_form input_text">
                    <p><span class="color-blue">(필수)</span>아이디</p>
                    <input type="text" placeholder="입력하세요" class="border_gray">
                </div>

                <div class="wrap">
                    <div class="input_text">
                        <p><span class="color-blue">(필수)</span>비밀번호</p>
                        <input type="password" placeholder="입력하세요" class="border_gray">
                        <p class="text-guide">※ 비밀번호는 영,숫자포함 8~12자리입니다.</p>
                    </div>
                    <div class="input_text">
                        <p><span class="color-blue">(필수)</span>비밀번호 확인</p>
                        <input type="password" placeholder="입력하세요" class="border_gray">
                    </div>
                </div>



                <div class="input_form input_text">
                    <p><span class="color-blue">(필수)</span>회사이름</p>
                    <input type="text" placeholder="입력하세요" class="border_gray">
                </div>


                <div class="input_form input_text">
                    <p><span class="color-blue">(필수)</span>사업자번호</p>
                    <input type="text" placeholder="입력하세요" class="border_gray">
                </div>

                <div class="wrap">
                    <div class="input_text">
                        <p><span class="color-blue">(필수)</span>대표자</p>
                        <input type="text" placeholder="입력하세요" class="border_gray">
                    </div>
                    <div class="input_phone">
                        <p><span class="color-blue">(필수)</span>연락처</p>
                        <div class="input_checkbox">
                            <input type="checkbox" id="sms01" name="sms">
                            <label for="sms01"><i class="fa-duotone fa-square-check"></i>SMS</label>
                        </div>
                        <div class="input_select">
                            <select class="border_gray">
                                <option value="010">010</option>
                                <option value="010">010</option>
                                <option value="010">010</option>
                            </select>
                        </div>
                        -
                        <input type="text" placeholder="4자리" class="border_gray" maxlength='4'>
                        -
                        <input type="text" placeholder="4자리" class="border_gray" maxlength='4'>
                    </div>
                </div>

                <div class="wrap">
                    <div class="input_text">
                        <p>담당자 이름</p>
                        <input type="text" placeholder="입력하세요" class="border_gray">
                    </div>
                    <div class="input_phone">
                        <p>연락처</p>
                        <div class="input_checkbox">
                            <input type="checkbox" id="sms02" name="sms">
                            <label for="sms02"><i class="fa-duotone fa-square-check"></i>SMS</label>
                        </div>
                        <div class="input_select">
                            <select class="border_gray">
                                <option value="010">010</option>
                                <option value="010">010</option>
                                <option value="010">010</option>
                            </select>
                        </div>
                        -
                        <input type="text" placeholder="4자리" class="border_gray" maxlength='4'>
                        -
                        <input type="text" placeholder="4자리" class="border_gray" maxlength='4'>
                    </div>
                </div>

                <div class="input_form input_email">
                    <p><span class="color-blue">(필수)</span>이메일</p>
                    <input type="text" placeholder="입력하세요" class="border_gray">
                    @
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="naver.com">naver.com</option>
                            <option value="naver.com">naver.com</option>
                            <option value="naver.com">naver.com</option>
                        </select>
                    </div>

                </div>

                <div class="input_form input_grid3">
                    <p><span class="color-blue">(필수)</span>계좌정보</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="은행선택">은행선택</option>
                            <option value="은행선택">은행선택</option>
                        </select>
                    </div>

                    <input type="text" placeholder="예금주 입력하세요" class="border_gray">
                    <input type="text" placeholder="계좌번호 입력하세요" class="border_gray">

                </div>

                <div class="input_form input_grid3">
                    <p>수수료</p>
                    <div class="fee_box">
                        <p class="text-guide">플랫폼</p>
                        <input type="text" placeholder="입력하세요" class="border_gray">원
                    </div>
                    <div class="fee_box">
                        <p class="text-guide">쇼핑몰</p>
                        <input type="text" placeholder="입력하세요" class="border_gray">원
                    </div>
                    <div class="fee_box">
                        <p class="text-guide">PG</p>
                        <input type="text" placeholder="입력하세요" class="border_gray">원
                    </div>

                </div>

                <div class="input_form">
                    <p><span class="color-blue">(필수)</span>직불승인</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="승인">승인</option>
                            <option value="미승인">미승인</option>
                        </select>
                    </div>
                </div>
                <div class="input_form">
                    <p><span class="color-blue">(필수)</span>권한</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="승인">승인</option>
                            <option value="미승인">미승인</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php echo view('common/footer'); ?>
