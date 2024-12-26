<!--1.2 회원가입-->
<div class="wrap_bg">
    <div class="mb_wrap signup">
        <div class="box_white">
            <span class="txt_color">부산이사몰 회원</span>
            <h2>신규 회원가입</h2>
            <form name="signup" autocomplete="off">
                <input type="hidden" id="mb_level" name="mb_level" value="2">
                <!--<input type="hidden" id="auth" name="auth" value="">-->
                <input type="hidden" id="authYN" name="authYN" value="N">
                <div class="sign_form">
                    <div class="select">
                        <input type="radio" name="userType" id="generalMember" checked/>
                        <label for="generalMember"><i class="fa-duotone fa-user"></i> 일반회원</label>
                        <input type="radio" name="userType" id="businessMember"/>
                        <label for="businessMember"><i class="fa-duotone fa-buildings"></i> 사업자 회원</label>
                        <?php if($_SERVER['REMOTE_ADDR'] == "59.19.201.109" || $_SERVER['REMOTE_ADDR'] == "121.140.204.65"){ ?>
                            <input type="radio" name="userType" id="realtorMember"/>
                            <label for="realtorMember"><i class="fa-duotone fa-handshake-simple"></i> 부동산 회원</label>
                        <?php }?>

                    </div>
                    <div class="box_gray" id="generalMemberForm">
                        <div class="grid grid2">
                            <dl class="form_wrap">
                                <dt><label for="companyName" id="company_name01">회사명</label></dt>
                                <dd><input type="text" name="company_name" id="company_name" placeholder="회사명"/></dd>
                                <dt><label for="mb_id">아이디</label></dt>
                                <dd><input type="text" name="mb_id" id="mb_id" placeholder="아이디" /></dd>
                                <dt><label for="password">비밀번호</label></dt>
                                <dd><input type="password" name="mb_password" id="mb_password" placeholder="비밀번호"/></dd>
                                <dt><label for="password_confirm">비밀번호 확인</label></dt>
                                <dd><input type="password" name="password_confirm" id="password_confirm" placeholder="비밀번호 확인"/></dd>
                            </dl>
                            <dl class="form_wrap">
                                <dt><label for="mb_name" id="mb_name01">이름</label></dt>
                                <dd><input type="text" name="mb_name" id="mb_name" placeholder="이름"/></dd>
                                <dt><label for="biz_no" id="biz_no01">사업자등록번호</label></dt>
                                <dd><input type="text" name="biz_no" id="biz_no" placeholder="사업자등록번호" data-format="business"/></dd>
                                <dt><label for="mb_hp" id="mb_hp01">연락처</label></dt>
                                <dd class="flex"><input type="text" name="mb_hp" id="mb_hp" placeholder="연락처" data-format="tel"/>
                                    <button type="button" class="btn btn_colorline" id="authBtn">인증</button>
                                </dd>
                                <dl class="auth_num" id="authNum" style="display:none;">
                                    <dt><label for="mb_email">인증번호</label></dt>
                                    <dd class="flex"><input type="text" name="authCode" id="authCode" placeholder="인증번호 입력"/>
                                        <p class="txt_red" id="timer">60초</p>
                                        <button type="button" id="btnFindPw" class="btn btn_color">인증번호 확인</button>
                                    </dd>
                                    <!--<button type="button" id="btnFindPw" class="btn btn_large btn_color">인증번호 확인</button>-->
                                </dl>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="box_line form_wrap">
                    <dl>
                        <dt>
                            <input type="checkbox" id="agree01" name="agree" value="1">
                            <label for="agree01">회원이용약관 동의 <span class="txt_color">[필수]</span></label>
                        </dt>
                        <dd>
                            <div class="box_scroll">
                                <?php include APPPATH . "Views/app/provision.php"; ?>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>
                            <input type="checkbox" id="agree02" name="agree2" value="1">
                            <label for="agree02">개인정보처리방침 동의 <span class="txt_color">[필수]</span></label>
                        </dt>
                        <dd>
                            <div class="box_scroll">
                                <?php include APPPATH . "Views/app/privacy.php"; ?>
                            </div>
                        </dd>
                    </dl>
                    <br>
                    <div class="select">
                        <input type="checkbox" id="allAgree" name="allAgree" value="1">
                        <label for="allAgree" class="w100"><i class="fa-duotone fa-check"></i> 전체 동의하기</label>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn_large btn_color">가입완료</button>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url()?>js/app/signup.js?<?=JS_VER?>"></script>
<script src="<?= base_url()?>js/common/user_validator.js?<?=JS_VER?>"></script>
<!--<script>
    let countdown;
    document.getElementById('authBtn').addEventListener('click', async function (event) {
        // 기본 동작을 막아서 새로고침 방지
        event.preventDefault();

        document.getElementById('authNum').style.display = 'block';

        // 휴대폰 번호 입력란을 비활성화
        document.getElementById('mb_hp').disabled = true;


        // 타이머 설정 (60초)
        let timeLeft = 60;
        const timerElement = document.getElementById('timer');
        countdown = setInterval(function () {
            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerElement.innerText = '시간 초과';
            } else {
                timerElement.innerText = timeLeft + '초';
            }
            timeLeft--;
        }, 1000);

    });
</script>-->