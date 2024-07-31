
<?php 
    echo view('common/header_adm'); 
    $pid = "manager01_01_write";
    $header_name = "B2P 직원 관리";
?>

<script>
    $(document).ready(function(){
        $('.adm_menu > li:nth-child(1)').addClass('active');
    })
</script>


<div id="adm_content">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">관리자 관리</h6>
            <div class="menu02">
                <a href="./manager01_01_list" class="active">B2P 직원 관리</a>
                <a href="./manager01_02_list">제조사/ 정비업체 관리</a>
                <a href="./manager01_03_list">정비업체 지점 관리</a>
            </div>
        </div>

        <div class="write_wrap">
            <div class="top_wrap">
                <h1>직원 등록하기</h1>
                <div class="btn_wrap">
                    <a href="./manager01_01_list" class="btn btn-sm btn-gray">목록</a>
                    <a href="./manager01_01_list" class="btn btn-sm btn-blue">저장</a>
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

                <div class="wrap">
                    <div class="input_text">
                        <p><span class="color-blue">(필수)</span>이름</p>
                        <input type="text" placeholder="입력하세요" class="border_gray">
                    </div>
                    <div class="input_phone">
                        <p><span class="color-blue">(필수)</span>연락처</p>
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