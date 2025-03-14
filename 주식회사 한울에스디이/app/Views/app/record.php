<!-- 내역관리 > 수량산출서 -->
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
                    <option value="">품명</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button type="button" class="btn btn_darkblue" data-toggle="modal" data-target="#recordFormModal">수량 등록</button>
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
                <th class="text-right">수량</th>
                <th class="text-right">단가</th>
                <th class="text-right">금액</th>
                <th>비고</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="text-center">4</th>
                <th>안전발판</th>
                <td>400×1829mm</td>
                <td class="text-center">매</td>
                <td class="text-right">178,948</td>
                <td class="text-right">18,500</td>
                <td class="text-right">3,310,538</td>
                <td>-</td>
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


