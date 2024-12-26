<!--1.3 아이디/비밀번호 찾기-->
<div class="wrap_bg">
    <div class="mb_wrap">
        <div class="box_white">
            <span class="txt_color">부산이사몰 회원</span>
            <h2>아이디/비밀번호 찾기</h2>

            <div class="find_form">
                <div class="form">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#find_id" aria-controls="find_id" role="tab"
                                                                      data-toggle="tab" aria-expanded="true">아이디 찾기</a>
                            </li>
                            <li role="presentation" class=""><a href="#find_pw" aria-controls="find_pw" role="tab"
                                                                data-toggle="tab" aria-expanded="false">비밀번호 찾기</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="find_id">
                                <form name="findId" autocomplete="off">
                                    <!--아이디찾기-->
                                    <input type="radio" name="memberType" id="normalMember" value="normal" checked>
                                    <label for="normalMember">일반회원</label>&nbsp;&nbsp;
                                    <input type="radio" name="memberType" id="businessMember" value="business">
                                    <label for="businessMember">사업자회원</label>&nbsp;&nbsp;

                                    <div class="form_wrap">
                                        <!-- 일반회원 폼 -->
                                        <div id="normalMemberForm">
                                            <input type="text" name="mbName" placeholder="이름">
                                            <input type="text" name="mbHp" placeholder="휴대폰번호" data-format="tel">
                                        </div>
                                        <!-- 사업자회원 폼 -->
                                        <div id="businessMemberForm" style="display:none;">
                                            <input type="text" name="cmbName" placeholder="대표자명"> <!-- 수정된 부분 -->
                                            <input type="text" name="bizNo" placeholder="사업자등록번호"
                                                   data-format="business">
                                        </div>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="submit" id="btnFindId" class="btn btn_large btn_color">조회하기
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="find_pw">
                                <form name="findPw" autocomplete="off">
                                    <!--비밀번호찾기-->
                                    <div class="form_wrap">
                                        <input type="text" name="memberId" placeholder="아이디">
                                        <div class="flex">
                                            <input type="text" name="phone" id="phone" placeholder="휴대폰번호"
                                                   data-format="tel">
                                            <button type="button" class="btn btn_colorline" id="authBtn">인증</button>
                                        </div>
                                        <div class="auth_num" id="authNum" style="display:none;">
                                            <input type="text" name="authCode" placeholder="인증번호 입력">
                                            <p class="txt_red" id="timer">60초</p>
                                        </div>
                                    </div>

                                    <div class="btn_wrap">
                                        <button type="submit" id="btnFindPw" class="btn btn_large btn_color">임시 비밀번호 확인
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="findView"></div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script src="<?= base_url() ?>js/app/find_pw.js?<?= JS_VER ?>"></script>
<script>
    // 라디오 버튼 변경 시 폼 보이기/감추기
    const normalMemberForm = document.getElementById('normalMemberForm');
    const businessMemberForm = document.getElementById('businessMemberForm');

    document.getElementById('normalMember').addEventListener('change', function () {
        normalMemberForm.style.display = 'block';
        businessMemberForm.style.display = 'none';
    });

    document.getElementById('businessMember').addEventListener('change', function () {
        normalMemberForm.style.display = 'none';
        businessMemberForm.style.display = 'block';
    });


</script>