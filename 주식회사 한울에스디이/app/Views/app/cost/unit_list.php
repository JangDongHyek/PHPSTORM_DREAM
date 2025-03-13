
<section class="list_table unit-list">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 3건</strong>
            <div class="search">
                <select name="sfl">
                    <option value="">품명</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button type="button" class="btn btn-darkblue" onclick="location.href='<?=base_url()?>/app/pricelist'">단가 등록</button>
    </div>
    <div class="table">

        <table>
            <thead>
            <tr>
                <th>공종 ID</th>
                <th>품 명</th>
                <th>단 위</th>
                <th>재료비 단가</th>
                <th>재료비 금액</th>
                <th>노무비 단가</th>
                <th>노무비 금액</th>
                <th>경비 단가</th>
                <th>경비 금액</th>
                <th>합계 단가</th>
                <th>합계 금액</th>
            </tr>
            </thead>
            <tbody>
            <!-- U101 -->
            <tr class="main main-U101">
                <th rowspan="1">U101</th>
                <th class="toggle-btn" onclick="toggleDetails('U101')">컨테이너 가설 사무소 <span id="toggle-icon-U101">▼</span></th>
                <td></td>
                <td class="text-center">2,900,000</td> <!-- 단가 합계 -->
                <td class="text-center">913,500</td> <!-- 금액 합계 -->
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">3,503,555</td>
                <td class="text-center">1,517,055</td>
            </tr>
            <tr class="details-U101 hidden">
                <td>컨테이너하우스, 사무실용, 3.0×6.0+2.6m</td>
                <td>개</td>
                <td class="text-center">2,900,000</td>
                <td class="text-center">913,500</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">2,900,000</td>
                <td class="text-center">913,500</td>
            </tr>
            <tr class="details-U101 hidden">
                <td>조립식 가설건축물 설치</td>
                <td>개</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">402,370</td>
                <td class="text-center">402,370</td>
                <td class="text-center">402,370</td>
                <td class="text-center">402,370</td>
            </tr>
            <tr class="details-U101 hidden">
                <td>조립식 가설건축물 해체</td>
                <td>개소</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">0.00</td>
                <td class="text-center">201,185</td>
                <td class="text-center">201,185</td>
                <td class="text-center">201,185</td>
                <td class="text-center">201,185</td>
            </tr>

            <!-- U201 -->
            <tr class="main main-U201">
                <th rowspan="1">U201</th>
                <th class="toggle-btn" onclick="toggleDetails('U201')">철근 배근 <span id="toggle-icon-U201">▼</span></th>
                <td></td>
                <td class="text-center">4,300</td> <!-- 단가 합계 -->
                <td class="text-center">430,000</td> <!-- 금액 합계 -->
                <td class="text-center">2,200</td>
                <td class="text-center">220,000</td>
                <td class="text-center">900</td>
                <td class="text-center">90,000</td>
                <td class="text-center">7,400</td> <!-- 총합 -->
                <td class="text-center">740,000</td> <!-- 총 금액 -->
            </tr>
            <tr class="details-U201 hidden">
                <td>철근 배치 및 정리</td>
                <td>㎡</td>
                <td class="text-center">2,500</td>
                <td class="text-center">250,000</td>
                <td class="text-center">1,200</td>
                <td class="text-center">120,000</td>
                <td class="text-center">500</td>
                <td class="text-center">50,000</td>
                <td class="text-center">4,200</td>
                <td class="text-center">420,000</td>
            </tr>
            <tr class="details-U201 hidden">
                <td>철근 간격 조정</td>
                <td>㎡</td>
                <td class="text-center">1,800</td>
                <td class="text-center">180,000</td>
                <td class="text-center">1,000</td>
                <td class="text-center">100,000</td>
                <td class="text-center">400</td>
                <td class="text-center">40,000</td>
                <td class="text-center">3,200</td>
                <td class="text-center">320,000</td>
            </tr>

            <!-- U202 -->
            <tr class="main main-U202">
                <th rowspan="1">U202</th>
                <th class="toggle-btn" onclick="toggleDetails('U202')">철근 연결 및 보강 <span id="toggle-icon-U202">▼</span></th>
                <td>-</td>
                <td class="text-center">11,500</td> <!-- 단가 합계 -->
                <td class="text-center">800,000</td> <!-- 금액 합계 -->
                <td class="text-center">6,100</td>
                <td class="text-center">470,000</td>
                <td class="text-center">1,300</td>
                <td class="text-center">110,000</td>
                <td class="text-center">18,900</td> <!-- 총합 -->
                <td class="text-center">1,380,000</td> <!-- 총 금액 -->
            </tr>
            <tr class="details-U202 hidden">
                <td>철근 겹침 이음</td>
                <td>kg</td>
                <td class="text-center">1,500</td>
                <td class="text-center">300,000</td>
                <td class="text-center">1,100</td>
                <td class="text-center">220,000</td>
                <td class="text-center">300</td>
                <td class="text-center">60,000</td>
                <td class="text-center">2,900</td>
                <td class="text-center">580,000</td>
            </tr>
            <tr class="details-U202 hidden">
                <td>철근 기계식 이음</td>
                <td>개</td>
                <td class="text-center">10,000</td>
                <td class="text-center">500,000</td>
                <td class="text-center">5,000</td>
                <td class="text-center">250,000</td>
                <td class="text-center">1,000</td>
                <td class="text-center">50,000</td>
                <td class="text-center">16,000</td>
                <td class="text-center">800,000</td>
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
    function toggleDetails(id) {
        let rows = document.querySelectorAll(`.details-${id}`);
        let mainRow = document.querySelector(`.main-${id}`);
        let icon = document.getElementById(`toggle-icon-${id}`);

        let isHidden = rows[0].classList.contains('hidden');
        rows.forEach(row => row.classList.toggle('hidden'));

        // `rowspan` 업데이트
        if (isHidden) {
            mainRow.firstElementChild.setAttribute('rowspan', rows.length + 1);
            icon.innerHTML = "▲";
        } else {
            mainRow.firstElementChild.setAttribute('rowspan', "1");
            icon.innerHTML = "▼";
        }
    }
</script>