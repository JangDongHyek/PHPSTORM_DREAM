<!--서비스 이용자 관리-->
<div class="flex ai-c">
    <p class="txt_bold txt_darkblue">현재 서비스 이용중인 업체 7건</p>
</div>
</div>

<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 7건</strong>
            <select name="sfl">
                <option value="">구분</option>
                <option value="">시행사</option>
                <option value="">시공사</option>
            </select>

            <div class="search">
                <select name="sfl">
                    <option value="">회사명</option>
                    <option value="">대표자명</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn_blueline">선택 승인</button>
            <button type="button" class="btn btn_gray">선택 승인 취소</button>
            <button type="button" class="btn btn_blue" onclick="location.href='./memberForm'">등록</button>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="20px">
                <col width="auto">
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
                <th><input type="checkbox"/></th>
                <th>회사명</th>
                <th class="text-center">구분</th>
                <th class="text-center">대표자명</th>
                <th class="text-center">담당자</th>
                <th class="text-center">담당자 연락처</th>
                <th class="text-center">사용기간</th>
                <th class="text-center">승인상태</th>
                <th class="text-center">등록날짜</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th><input type="checkbox"/></th>
                <th>브라이트 빌더스</th>
                <td class="text-center">시행사</td>
                <td class="text-center">김영준</td>
                <td class="text-center">김민수</td>
                <td class="text-center">010-5567-5487</td>
                <td class="text-center">2018.06.18 - 2018.09.17 (3개월)</td>
                <td class="text-center"><strong class="icon icon_sky">미승인</strong></td>
                <td class="text-center">2018-06.18</td>
                <td class="text-center"><button class="btn btn_mini btn_black" onclick="location.href='./memberForm'">수정</button></td>
            </tr>
            <tr>
                <th><input type="checkbox"/></th>
                <th>블루 플래닛 건설</th>
                <td class="text-center">시공사</td>
                <td class="text-center">김영준</td>
                <td class="text-center">김민수</td>
                <td class="text-center">010-5567-5487</td>
                <td class="text-center">2018.06.18 - 2018.09.17 (3개월)</td>
                <td class="text-center"><strong class="icon icon_gray">승인</strong></td>
                <td class="text-center">2018-06.18</td>
                <td class="text-center"><button class="btn btn_mini btn_black" onclick="location.href='./memberForm'">수정</button></td>
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
