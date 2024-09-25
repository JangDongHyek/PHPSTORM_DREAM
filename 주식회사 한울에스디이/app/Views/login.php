<div class="wrap_bg">
    <div class="mb_wrap login box_white">
        <div class="logo">
            <h1><img src="<?=base_url()?>/img/common/logo_v.svg" alt="엔알글로벌"/></h1>
        </div>
        <div class="login_form">
                <form name="signin" method="post" autocomplete="off">
                    <label for="">아이디</label>
                    <input type="text" name="id" placeholder="아이디"/>
                    <label for="">비밀번호</label>
                    <input type="password" name="password" placeholder="비밀번호"/>
                    <button type="button" class="btn btn_large btn_darkblue" onclick="location.href='./'">로그인</button>
                </form>
                <a href="./signUp" class="btn btn_wide btn_gray">서비스 가입</a>
                <a href="./findPw" class="btn btn_wide btn_line">아이디/비밀번호 찾기</a>
            </div>
        <div class="login_ft">
            <p class="ft_copy">Copyright 2024. NRSYSTEM. All rights reserved.</p>
        </div>
    </div>
</div>
