<div class="wrap_bg">
    <div class="mb_wrap login box_white">
        <div class="logo">
            <h1><img src="<?=base_url()?>/img/common/logo.svg" alt="부산이사몰"/></h1>
        </div>
        <div class="login_form">
            <form name="signin" method="post" autocomplete="off">
                <label for="">아이디</label>
                <input type="text" name="id" placeholder="아이디"/>
                <label for="">비밀번호</label>
                <input type="password" name="password" placeholder="비밀번호"/>
                <button type="button" class="btn btn_large btn_color" onclick="location.href='./'">로그인</button>
            </form>
            <a href="./signUp" class="btn btn_wide btn_gray">신규 회원가입</a>
            <a href="./findPw" class="btn btn_wide btn_line">아이디/비밀번호 찾기</a>
            <div class="bottom">
                <div class="flex ai-c jc-sb">
                    <hr>
                    <span>Login with</span>
                    <hr>
                </div>
                <ul>
                    <li><a class="btn btn_large btn_yellow" onclick="utils.showAlert('서비스 준비중입니다')">카카오톡 로그인</a></li>
                    <li><a class="btn btn_large btn_green" onclick="utils.showAlert('서비스 준비중입니다')">네이버 로그인</a></li>
                    <!--<li><a>애플 간편 로그인</a></li>-->
                </ul>
                <p class="text-center">가입을 진행할 경우 서비스 약관 및 개인정보처리방침에 동의한 것으로 간주합니다.</p>
            </div>
        </div>
        <div class="login_ft">
            <p class="ft_copy">Copyright 2024. KNN24. All rights reserved.</p>
        </div>
    </div>
</div>
