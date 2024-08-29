<?php
global $pid;
$pid = "job_view";
$sub_id = "job_view";
include_once('./_common.php');

$g5['title'] = '내 이력서';
include_once('./_head.php');
?>

    <article id="item_view" class="jobs">

        <h2 class="title flex ai-c jc-sb">내 이력서
            <button type="button" class="btn btn_color">저장</button>
        </h2>
        <div class="job_info">
            <div class="flex ai-c gap10">
                <header class="w100">
                    <input type="text" class="w100 txt_up txt_bold" placeholder="이력서 제목">
                </header>
            </div>

            <section class="job_want form">
                <h3 class="title">관심분야</h3>
                <div class="select">
                    <span><input type="checkbox" id="category-1"><label for="category-1">기획/전략</label></span>
                    <span><input type="checkbox" id="category-2"><label for="category-2">마케팅/홍보/조사</label></span>
                    <span><input type="checkbox" id="category-3"><label for="category-3">회계/세무/재무</label></span>
                    <span><input type="checkbox" id="category-4"><label for="category-4">인사/노무/HRD</label></span>
                    <span><input type="checkbox" id="category-5"><label for="category-5">총무/사무/법무</label></span>
                    <span><input type="checkbox" id="category-6"><label for="category-6">IT개발/데이터</label></span>
                    <span><input type="checkbox" id="category-7"><label for="category-7">디자인</label></span>
                    <span><input type="checkbox" id="category-8"><label for="category-8">영업/판매/무역</label></span>
                    <span><input type="checkbox" id="category-9"><label for="category-9">고객상담/TM</label></span>
                    <span><input type="checkbox" id="category-10"><label for="category-10">구매/자재/물류</label></span>
                    <span><input type="checkbox" id="category-11"><label for="category-11">상품기획/MD</label></span>
                    <span><input type="checkbox" id="category-12"><label for="category-12">운전/운송/배송</label></span>
                    <span><input type="checkbox" id="category-13"><label for="category-13">서비스</label></span>
                    <span><input type="checkbox" id="category-14"><label for="category-14">생산</label></span>
                    <span><input type="checkbox" id="category-15"><label for="category-15">건설/건축</label></span>
                    <span><input type="checkbox" id="category-16"><label for="category-16">의료</label></span>
                    <span><input type="checkbox" id="category-17"><label for="category-17">연구/R&D</label></span>
                    <span><input type="checkbox" id="category-18"><label for="category-18">교육</label></span>
                    <span><input type="checkbox" id="category-19"><label for="category-19">미디어/문화/스포츠</label></span>
                    <span><input type="checkbox" id="category-20"><label for="category-20">금융/보험</label></span>
                </div><br>

                <h3 class="title flex ai-c jc-sb">학력사항
                    <button type="button" class="btn btn_color2">추가</button>
                </h3>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>기간</th>
                                <th>명칭</th>
                                <th>세부</th>
                                <th>성적</th>
                                <th>비고</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><select>
                                        <option>졸업</option>
                                        <option>중퇴</option>
                                        <option>재학</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn_white">삭제</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="job_want form">
                <h3 class="title flex ai-c jc-sb">경력사항
                    <button type="button" class="btn btn_color2">추가</button>
                </h3>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>기간</th>
                            <th>근무지</th>
                            <th>세부</th>
                            <th>직급</th>
                            <th>퇴사사유</th>
                            <th>-</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td>
                                <button type="button" class="btn btn_white">삭제</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="job_want form">
                <h3 class="title">희망지역</h3>
                <div>
                    <label>지역 선택 1</label>
                    <div class="flex ai-c gap10">
                        <select name="si[1]" class="purple w50">
                            <option value="">지역 선택</option>
                            <option value="서울">서울</option>
                            <option value="경기">경기</option>
                            <option value="인천">인천</option>
                            <option value="부산">부산</option>
                            <option value="대구">대구</option>
                            <option value="대전">대전</option>
                            <option value="광주">광주</option>
                            <option value="울산">울산</option>
                            <option value="세종">세종</option>
                            <option value="충북">충북</option>
                            <option value="충남">충남</option>
                            <option value="전북">전북</option>
                            <option value="전남">전남</option>
                            <option value="경북">경북</option>
                            <option value="경남">경남</option>
                            <option value="강원">강원</option>
                            <option value="제주">제주</option>
                        </select>
                        <select name="gu[1]" class="black w50">
                            <option value="">구 선택</option>
                        </select>
                    </div>
                    <br>
                    <label>지역 선택 2</label>
                    <div class="flex ai-c gap10">
                        <select name="si[2]" class="purple w50">
                            <option value="">지역 선택</option>
                            <option value="서울">서울</option>
                            <option value="경기">경기</option>
                            <option value="인천">인천</option>
                            <option value="부산">부산</option>
                            <option value="대구">대구</option>
                            <option value="대전">대전</option>
                            <option value="광주">광주</option>
                            <option value="울산">울산</option>
                            <option value="세종">세종</option>
                            <option value="충북">충북</option>
                            <option value="충남">충남</option>
                            <option value="전북">전북</option>
                            <option value="전남">전남</option>
                            <option value="경북">경북</option>
                            <option value="경남">경남</option>
                            <option value="강원">강원</option>
                            <option value="제주">제주</option>
                        </select>
                        <select name="gu[2]" class="black w50">
                            <option value="">구 선택</option>
                        </select>
                    </div>
                </div>
            </section>
            <section class="job_want form">
                <h3 class="title">희망연봉</h3>
                <div class="flex ai-c gap20">
                    <input type="number" placeholder="0"> <b>만원</b>
                    <span class="w200px"><input type="checkbox" id="money"><label for="money">회사내규에 따름</label></span>
                </div>
            </section>
            <section class="job_want form">
                <h3 class="title">대외경력</h3>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>기간</th>
                            <th>장소/업체</th>
                            <th>상세서술</th>
                            <th>-</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td>
                                <button type="button" class="btn btn_white">삭제</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="job_want form">
                <h3 class="title">자격사항</h3>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>취득일</th>
                            <th>자격증명</th>
                            <th>발급처</th>
                            <th>세부</th>
                            <th>-</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td>
                                <select>
                                    <option>최종합격</option>
                                    <option>1차합격</option>
                                    <option>2차합격</option>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn_white">삭제</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

    </article>
<?php
include_once('./_tail.php');
?>