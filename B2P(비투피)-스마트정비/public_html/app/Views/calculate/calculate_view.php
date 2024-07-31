
<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "정산 관리";
?>


<?php echo view('calculate/calcu_head', $this->data); ?>

<div class="sch_wrap">
    <p class="tit">검색조건
        <a class="btn btn-gray btn-md male-auto" href="" >조건초기화</a>
        <button class="btn btn-blue btn-md" onclick="">검색하기</button></p>
    </p>
    <div class="box flexwrap">
        <div>
            <p>일자구분</p>
            <div class="input_date">
                <div class="input_select w150px">
                    <select class="border_gray">
                        <option value="D1" selected="">입금확인일</option>
                        <option value="D3">매출기준일</option>
                        <option value="D7">구매결정일</option>
                        <option value="D4">환불일</option>
                        <option value="D6">정산완료일</option>
                    </select>
                </div>
                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray" id="startDate" name="startDate">
                </div>
                ~
                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray" id="endDate" name="endDate">
                </div>
                <div class="select flex nowrap">
                    <input type="radio" id="date1" name="date" value="">
                    <label for="date1">오늘</label>
                    <input type="radio" id="date2" name="date" value="">
                    <label for="date2">일주일</label>
                    <input type="radio" id="date3" name="date" value="">
                    <label for="date3">한달</label>
                    <input type="radio" id="date4" name="date" value="">
                    <label for="date4">3개월</label>
                </div>
            </div>
        </div>

        <div>
            <p>검색하기</p>
            <div class="flex gap5">
                <div class="input_select">
                    <select class="border_gray">
                        <option value="결제번호">결제번호</option>
                        <option value="주문번호">주문번호</option>
                        <option value="상품번호">상품번호</option>
                    </select>
                </div>
                <div class="input_search">
                    <input type="text" placeholder="검색어를 입력하세요" class="border_gray">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="result_wrap">
    <div class="box_gray">
        <div class="monthBox" data-action="calcMonth" data-month="1">
            <h2>1월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="2">
            <h2>2월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="3">
            <h2>3월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="4">
            <h2>4월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="5">
            <h2>5월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="6">
            <h2>6월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox monthBg" data-action="calcMonth" data-month="7">
            <h2>7월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="8">
            <h2>8월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="9">
            <h2>9월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="10">
            <h2>10월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox " data-action="calcMonth" data-month="11">
            <h2>11월</h2>
            <p>0원</p>
        </div>
        <div class="monthBox" data-action="calcMonth" data-month="12">
            <h2>12월</h2>
            <p>0원</p>
        </div>
    </div>
    <div class="top_text">
        <div class="wrap w100 flex">
            <h1>정산 내역 <span class="color-blue">24.07</span></h1>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col style="width: 50px;">
                <col style="width: ;">
                <col style="width: 50px;">
            </colgroup>
            <thead>
            <tr>
                <th>No.</th>
                <th>판매일자</th>
                <th>구분</th>
                <th>판매자코드/거래처명</th>
                <th>주문번호</th>
                <th>구매자명(아이디)</th>
                <th>상품명</th>
                <th>결제방식</th>
                <th>주문금액</th>
                <th>할인금액</th>
                <th>최종결제금액</th>
                <th>누계</th>
            </tr>
            </thead>
            <tbody>
            <tr class="sum">
                <td colspan="2">기간합계</td>
                <td colspan="99"><b>0원</b></td>
            </tr>
            <tr>
                <td>1</td>
                <td>판매일자</td>
                <td><div class="box__flag box__flag--gmarket"></div></td>
                <td>판매자코드/거래처명</td>
                <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                <td>구매자명(ID)</td>
                <td>상품명</td>
                <td>카드결제</td>
                <td>0원</td>
                <td>
                    <details>
                        <summary>총 할인 0원</summary>
                        <dl>
                            <dt>판매자할인</dt>
                            <dd>-</dd>
                            <dt>쿠폰할인</dt>
                            <dd>-</dd>
                            <dt>지마켓(비투피)할인</dt>
                            <dd>-</dd>
                            <dt>스마일캐시지급</dt>
                            <dd>-</dd>
                        </dl>
                    </details>
                </td>
                <td>0원</td>
                <td>누계</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="pagination_wrap">
        <a href="" class="page-prev"><i class="fa-regular fa-angle-left"></i></a>
        <div class="page-now">1 / 3</div>
        <a href="" class="page-next"><i class="fa-regular fa-angle-right"></i></a>
    </div>

</div>

<?php echo view('order/order_modal', $this->data); ?>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>