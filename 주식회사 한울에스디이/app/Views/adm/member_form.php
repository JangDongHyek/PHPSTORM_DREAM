<!--서비스 이용자 관리-->
<!--메인 : 대시보드-->
<div class="flex ai-c">
    <p class="txt_bold txt_darkblue">현재 서비스 이용중인 업체 7건</p>
</div>
</div>

<section class="from">
    <div>
        <button type="button" class="btn btn_line" onclick="location.href='./member'">목록</button>
        <button type="button" class="btn btn_blue">등록 완료</button>
    </div>
    <div class="box_gray grid grid2">
        <dl class="form_wrap">
            <dt>구분</dt>
            <dd>
                <input type="radio" name="userType" id="company" checked/><label for="company">시행사</label>
                <input type="radio" name="userType" id="contractor"/><label for="contractor">시공사</label>
            </dd>
            <dt><label for="companyName">회사명</label></dt>
            <dd><input type="text" name="companyName" id="companyName" placeholder="회사명"/></dd>
            <dt><label for="memberId">아이디</label></dt>
            <dd><input type="text" name="memberId" id="memberId" placeholder="아이디"/></dd>
            <dt><label for="password">비밀번호</label></dt>
            <dd><input type="password" name="password" id="password" placeholder="비밀번호"/></dd>
            <dt><label for="password_confirm">비밀번호 확인</label></dt>
            <dd><input type="password" name="password_confirm" id="password_confirm" placeholder="비밀번호 확인"/></dd>
        </dl>
        <dl class="form_wrap">
            <dt><label for="companyCEO">대표자명</label></dt>
            <dd><input type="text" name="companyCEO" id="companyCEO" placeholder="대표자명"/></dd>
            <dt><label for="businessRegistration">사업자등록번호</label></dt>
            <dd><input type="text" name="businessRegistration" id="businessRegistration" placeholder="사업자등록번호"/></dd>
            <dt><label for="contactPerson">담당자</label></dt>
            <dd><input type="text" name="contactPerson" id="contactPerson" placeholder="담당자"/></dd>
            <dt><label for="contactNumber">담당자 연락처</label></dt>
            <dd><input type="text" name="contactNumber" id="contactNumber" placeholder="담당자 연락처"/></dd>
        </dl>
    </div>
</section>


