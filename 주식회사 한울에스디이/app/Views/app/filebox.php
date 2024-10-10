<!-- 시행사(직원) : 파일함 -->
</div>
<?php
if(!$project) return false;
?>
<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 6건</strong>
            <input type="date" name="sdt" placeholder="날짜 선택" value="">
            ~
            <input type="date" name="edt" placeholder="날짜 선택" value="">
            <div class="search">
                <select name="sfl">
                    <option value="">파일명</option>
                    <option value="">등록자</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button type="button" class="btn btn_line"><i class="fa-light fa-arrow-down-to-line"></i> 다운로드</button>
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
                <th class="text-center"></th>
                <th>파일명</th>
                <th class="text-center">용량</th>
                <th class="text-center">등록자</th>
                <th class="text-center">등록위치</th>
                <th class="text-center">등록일</th>
                <th class="text-center">다운</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="text-center"><input type="checkbox"/></th>
                <td>230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx</td>
                <td class="text-center">758KB</td>
                <td class="text-center">안재홍</td>
                <td class="text-center">금일작업</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">다운로드</button></td>
            </tr>
            <tr>
                <th class="text-center"><input type="checkbox"/></th>
                <td>230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx</td>
                <td class="text-center">758KB</td>
                <td class="text-center">안재홍</td>
                <td class="text-center">주간공정표</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">다운로드</button></td>
            </tr>
            <tr>
                <th class="text-center"><input type="checkbox"/></th>
                <td>230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx</td>
                <td class="text-center">758KB</td>
                <td class="text-center">안재홍</td>
                <td class="text-center">파일함</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">다운로드</button></td>
            </tr>
            <tr>
                <th class="text-center"><input type="checkbox"/></th>
                <td>230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx</td>
                <td class="text-center">758KB</td>
                <td class="text-center">안재홍</td>
                <td class="text-center">주간공정표</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">다운로드</button></td>
            </tr>
            <tr>
                <th class="text-center"><input type="checkbox"/></th>
                <td>230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx</td>
                <td class="text-center">758KB</td>
                <td class="text-center">안재홍</td>
                <td class="text-center">주간공정표</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">다운로드</button></td>
            </tr>
            <tr>
                <th class="text-center"><input type="checkbox"/></th>
                <td>230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx</td>
                <td class="text-center">758KB</td>
                <td class="text-center">안재홍</td>
                <td class="text-center">주간공정표</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">다운로드</button></td>
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

