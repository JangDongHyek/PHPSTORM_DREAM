<!--1:1문의-->
</div>

<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 7건</strong>
            <select name="sfl">
                <option value="">구분</option>
                <option value="">미답변</option>
                <option value="">답변완료</option>
            </select>

            <div class="search">
                <select name="sfl">
                    <option value="">아이디</option>
                    <option value="">제목</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="40px">
                <col width="auto">
                <col width="200px">
                <col width="200px">
                <col width="100px">
                <col width="100px">
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th>제목</th>
                <th class="text-center">작성자</th>
                <th class="text-center">답변상태</th>
                <th class="text-center">등록날짜</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>2</th>
                <td><a href="./qnaView">계정 추가 확인 부탁드립니다.</a></td>
                <td class="text-center">김혁수(qwer1234)</td>
                <td class="text-center"><strong class="icon icon_gray">미답변</strong></td>
                <td class="text-center">2018-06.18</td>
                <td class="text-center"><button class="btn btn_mini btn_black" onclick="location.href='qnaView'">상세</button></td>
            </tr>
            <tr>
                <th>1</th>
                <td><a href="./qnaView">자동 결제가 오류가 납니다.</a></td>
                <td class="text-center">주지현(abcd33)</td>
                <td class="text-center"><strong class="icon icon_sky">답변완료</strong></td>
                <td class="text-center">2018-06.18</td>
                <td class="text-center"><button class="btn btn_mini btn_black" onclick="location.href='qnaView'">상세</button></td>
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
