<!--회원 상세/등록-->
<section class="from">
    <div>
        <button type="button" class="btn btn_small btn_line" onclick="location.href='./member'">목록</button>
        <button type="button" class="btn btn_small btn_color" onclick="">등록 완료</button>
    </div>
    <div id="user_form">
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
                    <dt><label for="">이메일</label></dt>
                    <dd><input type="text" name="" id="" placeholder="이메일"/></dd>
                </dl>
            </div>
        </div>
        <!--//일반회원-->
        <br>
        <!--사업자회원-->
        <div class="box_gray" id="businessMemberForm">
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
                    <dt><label for="contactNumber">담당자 연락처</label></dt>
                    <dd><input type="text" name="contactNumber" id="contactNumber" placeholder="담당자 연락처"/></dd>
                    <dt><label for="">이메일</label></dt>
                    <dd><input type="text" name="" id="" placeholder="이메일"/></dd>

                </dl>
            </div>
        </div>
            <!--사업자회원 보유 업체리스트-->
            <hr>
            <div class="flex ai-c jc-sb">
                <h4>등록된 이사업체</h4>
                <div>
                    <button type="button" class="btn btn_gray" onclick="">삭제</button>
                    <button type="button" class="btn btn_color" onclick="location.href='./companyForm'">업체 등록</button>
                </div>
            </div>
            <div class="table">
                <table>
                    <colgroup>
                        <col width="5%">
                        <col width="*">
                        <col width="10%">
                        <col width="*">
                        <col width="*">
                        <col width="10%">
                        <col width="*">
                        <col width="10%">
                        <!--<col width="10%">-->
                        <col width="5%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th><input type="checkbox" /></th>
                        <th>업체명</th>
                        <th>지역</th>
                        <th>주소</th>
                        <th>연락처</th>
                        <th>관허</th>
                        <th>서비스</th>
                        <th>등록일</th>
                        <!--<th>광고여부</th>-->
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td>현대이사몰</td>
                        <td>부산 > 강서구</td>
                        <td>[611-080] 부산 연제구 연산동</td>
                        <td>050-1234-5678</td>
                        <td>현대이사몰 체인점</td>
                        <td>포장이사, 반포장이사, 일반이사, 원룸이사</td>
                        <td>2024-09-30</td>
                        <!--<td>-</td>-->
                        <td><button class="btn btn_line" onclick="location.href='./companyForm'">수정</button></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td>현대이사몰</td>
                        <td>부산 > 강서구</td>
                        <td>[611-080] 부산 연제구 연산동</td>
                        <td>050-1234-5678</td>
                        <td>현대이사몰 체인점</td>
                        <td>포장이사, 반포장이사, 일반이사, 원룸이사</td>
                        <td>2024-09-30</td>
                        <!--<td>-</td>-->
                        <td><button class="btn btn_line" onclick="location.href='./companyForm'">수정</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <!--//사업자회원-->
    </div>
</section>
