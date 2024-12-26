<!--이사업체 관리-->
<section class="service">
        <div class="panel flex ai-c jc-sb">
            <div class="flex">
                <p class="total">총 <strong class="txt_color">163</strong>개 </p>
                <div class="panel_box">
                    <div class="select">
                        <input type="radio" id="all" name="service" class="" value="0" checked>
                        <label for="all">전체</label>
                        <input type="radio" id="aircon" name="service" class="" value="1">
                        <label for="aircon">에어컨</label>
                        <input type="radio" id="cleaning" name="service" class="" value="2">
                        <label for="cleaning">이사청소</label>
                        <input type="radio" id="real-estate" name="service" class="" value="3">
                        <label for="real-estate">부동산</label>
                        <input type="radio" id="recommended" name="service" class="" value="4">
                        <label for="recommended">추천업소</label>
                    </div>
                </div>

                <div class="search_wrap">
                    <select id="">
                        <option value="">회사명</option>
                    </select>
                    <div class="search">
                        <input type="search" id="search_value2" placeholder="검색어 입력" value="" keyEvent.enter="onSearch">
                        <button type="button" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
            <div class="btn_wrap">
                <button type="button" class="btn btn_color" onclick="location.href='./serviceForm'">업체 등록</button>
            </div>
        </div>
        <div class="table">
        <table>
            <colgroup>
                <col width="5%">
                <col width="5%">
                <col width="10%">
                <col width="*">
                <col width="*">
                <col width="*">
                <col width="*">
                <col width="10%">
                <col width="5%">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" /></th>
                <th>구분</th>
                <th>지역</th>
                <th>업체명</th>
                <th>주소</th>
                <th>연락처</th>
                <th>소개</th>
                <th>등록일</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="checkbox" /></td>
                <td>에어컨</td>
                <td>부산 > 강서구</td>
                <td>부산에어컨설치연합</td>
                <td>부산 연제구 연산동</td>
                <td>051-904-1414</td>
                <td class="text-left">풍부한 기술력을 갖춘 베테랑 기술진이 에어컨 이전´설치 업무에 최상의 서비스를 제공하겠습니다!</td>
                <td>2024-09-30</td>
                <td><button class="btn btn_line">관리</button></td>
            </tr>
            </tbody>
        </table>
        </div>
        <div class="paging">
            <div class="pagingWrap">
                <a class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
                <a class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
                <a class="active">1</a>
                <a>2</a>
                <a>3</a>
                <a>4</a>
                <a>5</a>
                <a>6</a>
                <a>7</a>
                <a class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
                <a class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
            </div>
        </div>
</section>