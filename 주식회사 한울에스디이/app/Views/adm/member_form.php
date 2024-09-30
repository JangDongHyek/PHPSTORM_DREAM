<!--서비스 이용자 관리-->
<!--메인 : 대시보드-->
<div class="flex ai-c">
    <p class="txt_bold txt_darkblue">현재 서비스 이용중인 업체 <?=$all_users?>건</p>
</div>
</div>

<section class="from">
    <div>
        <button type="button" class="btn btn_line" onclick="location.href='./member'">목록</button>
        <button type="button" class="btn btn_blue" onclick="putUser()">등록 완료</button>
    </div>
    <div class="box_gray grid grid2" id="user_form">
        <input type="hidden" id="idx">
        <dl class="form_wrap">
            <dt>구분</dt>
            <dd>
                <input type="radio" name="user_type" id="user_type" value="시행사"/><label for="company">시행사</label>
                <input type="radio" name="user_type" id="user_type" value="시공사"/><label for="contractor">시공사</label>
            </dd>
            <dt><label for="companyName">회사명</label></dt>
            <dd><input type="text" name="company_name" id="company_name" placeholder="회사명"/></dd>
            <dt><label for="memberId">아이디</label></dt>
            <dd><input type="text" name="user_id" id="user_id" placeholder="아이디" readonly/></dd>
            <dt><label for="password">비밀번호</label></dt>
            <dd><input type="password" name="change_user_pw" id="change_user_pw" placeholder="비밀번호"/></dd>
            <dt><label for="password_confirm">비밀번호 확인</label></dt>
            <dd><input type="password" name="user_pw_re" id="user_pw_re" placeholder="비밀번호 확인"/></dd>
        </dl>
        <dl class="form_wrap">
            <dt><label for="companyCEO">대표자명</label></dt>
            <dd><input type="text" name="company_owner" id="company_owner" placeholder="대표자명"/></dd>
            <dt><label for="businessRegistration">사업자등록번호</label></dt>
            <dd><input type="text" name="company_number" id="company_number" placeholder="사업자등록번호"/></dd>
            <dt><label for="contactPerson">담당자</label></dt>
            <dd><input type="text" name="company_person" id="company_person" placeholder="담당자"/></dd>
            <dt><label for="contactNumber">담당자 연락처</label></dt>
            <dd><input type="text" name="company_person_phone" id="company_person_phone" placeholder="담당자 연락처"/></dd>
        </dl>
    </div>
</section>

<?php $jl->jsLOAD(); ?>

<script>
    getUser();
    async function putUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("user_form");
        //let obj = jl.js.getUrlParams();


        try {
            if(obj.change_user_pw != obj.user_pw_re) throw new Error("비밀번호가 비밀번호 확인이랑 다릅니다.");
            let res = await jl.ajax("update",obj,"/api/user");
            alert("수정되었습니다");
            window.location.href = "./member";
        }catch (e) {
            alert(e.message)
        }
    }

    async function getUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        //let obj = jl.js.getFormById("form_id");
        let obj = jl.js.getUrlParams();

        try {
            let res = await jl.ajax("get",obj,"/api/user");
            let data = res.data[0]
            data.user_pw = '';
            jl.js.setElement(data);
        }catch (e) {
            alert(e.message)
        }
    }
</script>