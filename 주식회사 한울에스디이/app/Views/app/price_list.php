<!-- 내역관리 > 단가목록표 -->
</div>

<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 4건</strong>
            <div class="search">
                <select name="sfl">
                    <option value="">품명</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button type="button" class="btn btn_darkblue" data-toggle="modal" data-target="#priceFormModal">단가 등록</button>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="20px">
                <col width="auto">
                <col width="auto">
                <col width="100px">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="200px">
                <col width="100px">
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th>품명</th>
                <th>규격</th>
                <th class="text-center">단위</th>
                <th class="text-right">재료비</th>
                <th class="text-right">노무비</th>
                <th class="text-right">경비</th>
                <th class="text-right">합계</th>
                <th>비고</th>
                <th class="text-center">품샘개요</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="text-center">4</th>
                <th>터파기</th>
                <td>-</td>
                <td class="text-center">M3</td>
                <td class="text-right">274</td>
                <td class="text-right">3,914</td>
                <td class="text-right">343</td>
                <td class="text-right">4,531</td>
                <td>-</td>
                <td class="text-center">-</td>
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


