<div class="wrap_bg">
    <div class="mb_wrap login box_white">
        <div class="logo">
            <h1>
                <a href="<?=base_url()?>"><img src="<?=base_url()?>/img/common/logo.svg" alt="부산이사몰"/></a>
            </h1>
        </div>
        <div class="login_form">
            <form name="login" autocomplete="off">
                <label for="">아이디</label>
                <input type="text" name="id" placeholder="아이디"/>
                <label for="">비밀번호</label>
                <input type="password" name="password" placeholder="비밀번호"/>
                <button type="submit" class="btn btn_large btn_color">로그인</button>
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
                    <li><a class="btn btn_large btn_yellow" data-sns-type="kakao">카카오톡 로그인</a></li>
                    <li><a class="btn btn_large btn_green" data-sns-type="naver">네이버 로그인</a></li>
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
<script src="<?= base_url()?>js/app/login.js?<?=JS_VER?>"></script>
