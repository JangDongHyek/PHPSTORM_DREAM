<!-- 시행사(직원) : 계정관리 -->
</div>
<?php
if(!$project) return false;
?>
<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 4건</strong>
            <div class="search">
                <select name="sfl">
                    <option value="">소속사명</option>
                    <option value="">이름</option>
                    <option value="">아이디</option>
                    <option value="">연락처</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button type="button" class="btn btn_darkblue" data-toggle="modal" data-target="#accountFormModal">계정 등록</button>
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
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th>소속사명</th>
                <th>아이디</th>
                <th class="text-center">이름</th>
                <th class="text-center">연락처</th>
                <th class="text-center">담당</th>
                <th class="text-center">비고</th>
                <th class="text-center">등록일</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="text-center">4</th>
                <th>대우건설</th>
                <td>nr_global01</td>
                <td class="text-center">안재홍</td>
                <td class="text-center">010-1234-1234</td>
                <td class="text-center">거푸집 엔지니어</td>
                <td class="text-center">경력 10년</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
            </tr>
            <tr>
                <th class="text-center">3</th>
                <th>대우건설</th>
                <td>nr_global01</td>
                <td class="text-center">이주현</td>
                <td class="text-center">010-1234-1234</td>
                <td class="text-center">레미콘 품질 관리자</td>
                <td class="text-center">-</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
            </tr>
            <tr>
                <th class="text-center">2</th>
                <th>대우건설</th>
                <td>nr_global01</td>
                <td class="text-center">진준수</td>
                <td class="text-center">010-1234-1234</td>
                <td class="text-center">철근 배근 엔지니어</td>
                <td class="text-center">-</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
            </tr>
            <tr>
                <th class="text-center">1</th>
                <th>대우건설</th>
                <td>nr_global01</td>
                <td class="text-center">김설주</td>
                <td class="text-center">010-1234-1234</td>
                <td class="text-center">기계 엔지니어</td>
                <td class="text-center">-</td>
                <td class="text-center">2024.06.19</td>
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

