<!--1.2 회원가입-->
<div class="wrap_bg">
    <div class="mb_wrap signup">
        <div class="box_white">
        <h2>서비스 가입</h2>
        <div class="sign_form">
            <form name="signin" method="post" autocomplete="off">
                <h3>사용자 정보</h3>
                <div class="box_gray grid grid2">
                    <dl class="form_wrap">
                        <dt>구분</dt>
                        <dd>
                            <input type="radio" name="user_type" id="user_type_company" checked=""/><label for="user_type_company">시행사</label>
                            <input type="radio" name="user_type" id="user_type_contractor"/><label for="user_type_contractor">시공사</label>
                        </dd>
                        <label for="company_name">회사명</label>
                        <input type="text" name="company_name" id="company_name" placeholder="회사명"/>
                        <label for="username">아이디</label>
                        <input type="text" name="username" id="username" placeholder="아이디"/>
                        <label for="password">비밀번호</label>
                        <input type="password" name="password" id="password" placeholder="비밀번호"/>
                        <label for="password_confirm">비밀번호 확인</label>
                        <input type="password" name="password_confirm" id="password_confirm" placeholder="비밀번호 확인"/>
                    </dl>
                    <dl class="form_wrap">
                        <dt>&nbsp;</dt>
                        <dd>&nbsp;</dd>
                        <label for="representative_name">대표자명</label>
                        <input type="text" name="representative_name" id="representative_name" placeholder="대표자명"/>
                        <label for="contact_person">담당자</label>
                        <input type="text" name="contact_person" id="contact_person" placeholder="담당자"/>
                        <label for="contact_number">담당자 연락처</label>
                        <input type="text" name="contact_number" id="contact_number" placeholder="담당자 연락처"/>
                    </dl>
                </div>
                <button type="button" class="btn btn_middle btn_darkblue" onclick="location.href='./'">가입완료</button>
            </form>
        </div>

    </div>
</div>
