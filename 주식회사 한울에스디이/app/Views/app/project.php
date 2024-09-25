<!--시행사 : 프로젝트 관리-->
    <div class="flex ai-c">
        <p class="txt_bold txt_darkblue">현재 진행중인 프로젝트 4건</p>
        <!--관리자는 전체 / 직원은 본인 프로젝트만!-->
    </div>
</div>

<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 3건</strong>
            <input type="date" name="sdt" placeholder="날짜 선택" value="">
            ~
            <input type="date" name="edt" placeholder="날짜 선택" value="">
            <div class="search">
                <select name="sfl">
                    <option value="">프로젝트 명</option>
                    <option value="">시공사 명</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <!--관리자만-->
        <button type="button" class="btn btn_darkblue" data-toggle="modal" data-target="#projectFormModal">프로젝트 생성</button>
        <!--관리자만-->
    </div>
        <div class="table">
            <table>
                <colgroup>
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                </colgroup>
                <thead>
                    <tr>
                        <th>프로젝트 명</th>
                        <th>공사 위치</th>
                        <th>공사 기간</th>
                        <th class="text-center">시공사명</th>
                        <th class="text-center">비용 예산(억원)</th>
                        <th class="text-center">소요 비용(억원)</th>
                        <th class="text-center">진행율</th>
                        <th class="text-center">관리</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <!--개별 프로젝트로 이동-->
                            <a href="./overall"><p class="i_green">블루워터 프라자 리모델링</p></a>
                        </th>
                        <td>당진 수청지구 도시개발사업 부지</td>
                        <td>2018. 6. 18 - 2020. 11. 30 (총 897일)</td>
                        <td class="text-center">대우건설</td>
                        <td class="text-center">5</td>
                        <td class="text-center">3</td>
                        <td class="text-center">40%</td>
                        <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
                    </tr>
                    <tr>
                        <th><!--개별 프로젝트로 이동-->
                            <a href="./overall"><p class="i_green">하늘 마을 주택 단지</p></a></th>
                        <td>서울 강남구 역삼동 상업지구</td>
                        <td>2018. 6. 18 - 2020. 11. 30 (총 897일)</td>
                        <td class="text-center">현대건슬</td>
                        <td class="text-center">1.5</td>
                        <td class="text-center">0.8</td>
                        <td class="text-center">10%</td>
                        <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
                    </tr>
                    <tr>
                        <th><!--개별 프로젝트로 이동-->
                            <a href="./overall"><p class="i_orange">주거단지 개발</p></a></th>
                        <td>경기도 수원시 영동구 공공기관 건물</td>
                        <td>2018. 6. 18 - 2020. 11. 30 (총 897일)</td>
                        <td class="text-center">한화건설</td>
                        <td class="text-center">5</td>
                        <td class="text-center">3</td>
                        <td class="text-center">40%</td>
                        <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
                    </tr>
                    <tr>
                        <th><!--개별 프로젝트로 이동-->
                            <a href="./overall"><p class="i_red">상업시설 리모델링</p></a></th>
                        <td>인천 서구 길산동 주택 건설 부지</td>
                        <td>2018. 6. 18 - 2020. 11. 30 (총 897일)</td>
                        <td class="text-center">GS건설</td>
                        <td class="text-center">1.5</td>
                        <td class="text-center">0.8</td>
                        <td class="text-center">10%</td>
                        <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
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

