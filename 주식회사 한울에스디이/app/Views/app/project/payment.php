<!-- 기성관리 -->
</div>
<?php
if(!$project) return false;
?>
<section class="payment list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 0건</strong>
            <select name="sfl">
                <option value="">콘크리트</option>
            </select>
            <input type="date" name="sdt" placeholder="날짜 선택" value="">
            ~
            <input type="date" name="edt" placeholder="날짜 선택" value="">
            <div class="search">
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button class="btn btn-darkblue male-auto">저장</button>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col style="width:200px">
                <col style="width:250px">
                <col style="width:7.5%">
                <col style="width:7.5%">
                <col style="width:7.5%">
                <col style="width:7.5%">
                <col style="width:10%">
                <col style="width:75px">
                <col style="width:220px">
                <col style="width:70px">
            </colgroup>
            <thead>
            <tr>
                <th rowspan="2">구역 / 카테고리</th>
                <th rowspan="2">품명 [규격]</th>
                <th>입력 수량</th>
                <th>재료비</th>
                <th>노무비</th>
                <th>경비</th>
                <th>합계</th>
                <th rowspan="2">오차율(%)</th>
                <th rowspan="2">확정금액</th>
                <th rowspan="2">확정</th>
            </tr>
            <tr>
                <th>업로드 수량</th>
                <th>재료비</th>
                <th>노무비</th>
                <th>경비</th>
                <th>합계</th>
            </tr>
            </thead>
            <tbody>
                <tr class="total">
                    <th rowspan="2"><i class="fa-light fa-angle-down"></i> 101동 1층 A구역</th>
                    <td rowspan="2"></td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td rowspan="2"><b class="txt-red">-2.5%</b></td>
                    <td rowspan="2" class="text-right">0</td>
                    <td rowspan="2">25.04.19</td>
                </tr>
                <tr>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                </tr>
                <tr class="sub-total" style="display:none;">
                    <td rowspan="2">콘크리트</td>
                    <td rowspan="2">소계</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td rowspan="2"><b class="txt-red">-2.5%</b></td>
                    <td rowspan="2"><input type="number" class="text-right w200px"></td>
                    <td rowspan="2"><input type="checkbox" checked/> 25.04.19</td>
                </tr>
                <tr style="display:none;">
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                </tr>
                <tr class="detail" style="display:none;">
                    <td rowspan="2">콘크리트</td>
                    <td rowspan="2"><span class="icon icon-gray">단가</span> 레미콘 [25-30-150]</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td rowspan="2"><b class="txt-red">-2.5%</b></td>
                    <td rowspan="2" colspan="2"></td>
                </tr>
                <tr style="display:none;">
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                </tr>
                <tr class="detail" style="display:none;">
                    <td rowspan="2">콘크리트</td>
                    <td rowspan="2"><span class="icon icon-green">옵션</span> 레미콘타설 [버림]</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td rowspan="2"><b class="txt-red">-2.5%</b></td>
                    <td rowspan="2" colspan="2"></td>
                </tr>
                <tr style="display:none;">
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".total").forEach(function (row) {
            row.addEventListener("click", function () {
                let nextRow = row.nextElementSibling;
                let icon = row.querySelector("i");
                let firstSkipped = false; // 첫 번째 다음 행은 숨기지 않음
                let isHidden = false; // 숨길 상태인지 판단

                // 두 번째 이후의 행들의 현재 상태를 확인하여 토글 상태를 결정
                let checkRow = nextRow;
                while (checkRow && !checkRow.classList.contains("total")) {
                    if (!firstSkipped) {
                        firstSkipped = true; // 첫 번째는 스킵
                    } else if (checkRow.style.display === "none") {
                        isHidden = true; // 숨겨진 행이 하나라도 있으면 열어야 함
                        break;
                    }
                    checkRow = checkRow.nextElementSibling;
                }

                firstSkipped = false; // 다시 초기화 후 본격적으로 토글 실행
                while (nextRow && !nextRow.classList.contains("total")) {
                    if (!firstSkipped) {
                        firstSkipped = true; // 첫 번째는 그대로 두고
                    } else {
                        nextRow.style.display = isHidden ? "table-row" : "none"; // 상태에 따라 토글
                    }
                    nextRow = nextRow.nextElementSibling;
                }

                // 아이콘 업데이트
                if (isHidden) {
                    icon.classList.remove("fa-angle-down");
                    icon.classList.add("fa-angle-up");
                } else {
                    icon.classList.remove("fa-angle-up");
                    icon.classList.add("fa-angle-down");
                }
            });
        });
    });

</script>

