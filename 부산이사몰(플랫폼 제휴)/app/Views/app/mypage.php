<section class="mypage">
    <div class="sign_form">
        <!--일반회원-->
        <div class="box_gray" id="generalMemberForm">
            <div class="grid grid2">
                <dl class="form_wrap">
                    <dt><label for="memberId">아이디</label></dt>
                    <dd><input type="text" name="memberId" id="memberId" placeholder="아이디"/></dd>
                    <dt><label for="password">비밀번호</label></dt>
                    <dd><input type="password" name="password" id="password" placeholder="비밀번호"/></dd>
                    <dt><label for="password_confirm">비밀번호 확인</label></dt>
                    <dd><input type="password" name="password_confirm" id="password_confirm" placeholder="비밀번호 확인"/></dd>
                </dl>
                <dl class="form_wrap">
                    <dt><label for="">이름</label></dt>
                    <dd><input type="text" name="" id="" placeholder="이름"/></dd>
                    <dt><label for="">연락처</label></dt>
                    <dd><input type="text" name="" id="" placeholder="연락처"/></dd>
                </dl>
            </div>
        </div>
        <!--사업자회원-->
        <div class="box_gray" id="businessMemberForm" style="display:none;">
            <div class="grid grid2">
                <dl class="form_wrap">
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
        </div>
        <br>
        <button type="button" class="btn btn_large btn_color" onclick="location.href='./'">정보 수정</button>
    </div>
</section>