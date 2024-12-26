<section class="ad">
    <section class="list_table">
        <div id="search_form">
            <div class="panel flex ai-c jc-sb">
                <div class="flex ai-c">
                    <p class="total">총 <strong class="txt_color">142</strong> 건</p>
                    <div class="panel_box">
                    <span class="select">
                        <input type="radio" id="dtr0" name="dtRange" class="red" value="0" checked="">
                        <!----><label for="dtr0">전체</label>
                        <input type="radio" id="dtr1" name="dtRange" class="red" value="1">
                        <!----><label for="dtr1">오늘</label>
                        <input type="radio" id="dtr2" name="dtRange" class="red" value="2">
                        <!----><label for="dtr2">이번주</label>
                        <input type="radio" id="dtr3" name="dtRange" class="red" value="3">
                        <!----><label for="dtr3">이번달</label>
                    </span>
                        <div class="flex">
                            <input type="date" name="sdt" value="">
                            <p>~</p>
                            <input type="date" name="edt" value="">
                        </div>
                    </div>
                    <div class="search_wrap">
                        <select id="">
                            <option value="">아이디</option>
                            <option value="">회사명</option>
                        </select>
                        <div class="search">
                            <input type="search" id="search_value2" placeholder="검색어 입력" value="" keyEvent.enter="onSearch">
                            <button type="button" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
                <div class="btn_wrap">
                    <!--<button type="button" class="btn btn_colorline" >선택 승인</button>
                    <button type="button" class="btn btn_gray" >선택 승인 취소</button>
                    <button type="button" class="btn btn_color" onclick="location.href='./memberForm'">회원 등록</button>-->
                </div>
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
                    <th>결제일자</th>
                    <th>회사명(아이디)</th>
                    <th>광고내역</th>
                    <th>결제금액</th>
                    <th>결제정보</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td>24.01.02</td>
                    <td>부산이사몰(knn24form02)</td>
                    <td>
                        <p>기본 상품(+추가 2개)</p>
                        <p>메인 노출 상품</p>
                    </td>
                    <td>400,000원</td>
                    <td>국민카드(7019)</td>
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
</section>