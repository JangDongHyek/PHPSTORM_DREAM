<!--1.2 회원가입-->
<div class="wrap_bg">
    <div class="mb_wrap signup">
        <div class="box_white">
        <h2>서비스 가입</h2>
        <div class="sign_form">
            <form id="user_form" name="signin" method="post" autocomplete="off">
                <input type="hidden" id="level" value="5">
                <input type="hidden" id="allow" value="">
                <input type="hidden" id="parent" value="">

                <h3>사용자 정보</h3>
                <div class="box_gray grid grid2">
                    <dl class="form_wrap">
                        <dt>구분</dt>
                        <dd>
                            <input type="radio" name="user_type" id="user_type" name="user_type" checked value="시행사"/><label for="user_type_company">시행사</label>
                            <input type="radio" name="user_type" id="user_type" name="user_type"  value="시공사"/><label for="user_type_contractor">시공사</label>
                        </dd>
                        <label for="company_name">회사명</label>
                        <input type="text" name="company_name" id="company_name" placeholder="회사명"/>
                        <label for="username">아이디</label>
                        <input type="text" name="username" id="user_id" placeholder="아이디"/>
                        <label for="password">비밀번호</label>
                        <input type="password" name="password" id="user_pw" placeholder="비밀번호"/>
                        <label for="password_confirm">비밀번호 확인</label>
                        <input type="password" name="password_confirm" id="user_pw_re" placeholder="비밀번호 확인"/>
                    </dl>
                    <dl class="form_wrap">
                        <dt>&nbsp;</dt>
                        <dd>&nbsp;</dd>
                        <label for="representative_name">대표자명</label>
                        <input type="text" name="representative_name" id="company_owner" placeholder="대표자명"/>
                        <label for="contact_person">담당자</label>
                        <input type="text" name="contact_person" id="company_person" placeholder="담당자"/>
                        <label for="contact_number">담당자 연락처</label>
                        <input type="text" name="contact_number" id="company_person_phone" placeholder="담당자 연락처"/>
                    </dl>
                </div>
                <button type="button" class="btn btn_middle btn_darkblue" onclick="postUser()">가입완료</button>
            </form>
        </div>

    </div>
</div>

<?$jl->jsLoad();?>

<script>
    async function postUser() {
        let obj = jl.js.getFormById("user_form");

        if(obj.company_name == "") {
            alert("회사명을 입력해주세요.");
            return false;
        }

        if(obj.user_id == "") {
            alert("아이디를 입력해주세요.");
            return false;
        }

        if(obj.user_pw == "") {
            alert("비밀번호를 입력해주세요.");
            return false;
        }

        if(obj.user_pw_re == "") {
            alert("비밀번호 확인을 입력해주세요.");
            return false;
        }

        if(obj.company_owner == "") {
            alert("대표자명을 입력해주세요.");
            return false;
        }

        if(obj.company_person == "") {
            alert("담당자를 입력해주세요.");
            return false;
        }

        if(obj.company_person_phone == "") {
            alert("담당자 연락처를 입력해주세요.");
            return false;
        }

        if(obj.user_pw != obj.user_pw_re) {
            alert("비밀번호와 확인 비밀번호가 다릅니다.");
            return false;
        }


        try {
            let res = await jl.ajax("insert",obj,"/api/user");

            alert("가입이 완료되었습니다.");
            window.location.href="login"
        }catch (e) {
            alert(e.message)
        }

    }
</script>
