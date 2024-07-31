<?php 
    echo view('common/header_adm'); 
    $pid = "qna_write";
    $header_name = "Q&A";
?>



<div id="adm_content">
    <?php echo view('common/jejo_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">고객센터</h6>
            <div class="menu02">
                <a href="<?=base_url('/jejo/notice_list')?>">공지사항</a>
                <a href="<?=base_url('/jejo/qna_list')?>" class="active">Q&A</a>
            </div>
        </div>


        <div class="write_wrap">
            <div class="top_wrap">
                <h1>문의 등록하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('/jejo/qna_list')?>" class="btn btn-sm btn-gray">목록</a>
                    <a href="<?=base_url('/jejo/qna_list')?>" class="btn btn-sm btn-blue">등록</a>
                </div>
            </div>
            <div class="box">
                <div class="input_text">
                    <p>등록자</p>
                    <input type="text" placeholder="입력하세요" class="border_gray" value="강유선">
                </div>

                <div class="input_phone">
                    <p>연락처</p>
                    <div class="input_checkbox">
                        <input type="checkbox" id="sms01" name="sms">
                        <label for="sms01"><i class="fa-duotone fa-square-check"></i>SMS 답변받기</label>
                    </div>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="010" ck>010</option>
                            <option value="010">010</option>
                            <option value="010">010</option>
                        </select>
                    </div>
                    -
                    <input type="text" placeholder="4자리" class="border_gray" maxlength='4' value="1234">
                    -
                    <input type="text" placeholder="4자리" class="border_gray" maxlength='4' value="5678">
                </div>

                <div class="input_form input_email">
                    <p>이메일</p>
                    <input type="text" placeholder="입력하세요" class="border_gray" value="dreamforone">
                    @
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="naver.com">naver.com</option>
                            <option value="naver.com">naver.com</option>
                            <option value="naver.com">naver.com</option>
                        </select>
                    </div>

                </div>

                <p>제목</p>
                <input type="text" placeholder="입력하세요" class="border_gray" value="불편한데 개선좀 부탁드릴게요 제발요">

                <div class="input_textarea grid_1">
                    <p>답변</p>

                    <textarea name="" id="" class="border_gray">불편한데 개선좀 부탁드릴게요 제발요
불편한데 개선좀 부탁드릴게요 제발요
불편한데 개선좀 부탁드릴게요 제발요</textarea>
                </div>

                <div class="input_text">
                    <p>첨부파일</p>
                    <input type="file" class="border_gray">
                </div>

                <div class="input_textarea grid_1">
                    <p>PC사양정보</p>

                    <textarea name="" id="" class="border_gray">- 브라우저 헤더정보 : Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36
- 브라우저 코드네임 : Mozilla
- 브라우저 이름 : Netscape
- 브라우저 버전 : 5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36
- PC플랫폼 : MacIntel</textarea>


                    <button class="btn btn-write" style="width:100%;grid-column: 2 / 3;">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </button>
                </div>


            </div>
        </div>
    </div>
</div>


<?php echo view('common/footer'); ?>
