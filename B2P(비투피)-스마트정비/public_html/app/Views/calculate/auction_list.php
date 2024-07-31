
<?php
echo view('common/header_adm');
echo view('common/adm_head');
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
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>판매 진행별 합계내역 | 검색결과 <span class="color-blue">10개</span></h1>
                </div>
                <p class="text-guide">(판매진행상태를 클릭하면 하단에 진행상태별로 합계 및 상세내역이 출력됩니다.)</p>
            </div>
            <div class="table">
                <table>
                    <colgroup>
                        <col width="200px">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>구분</th>
                        <th><a href="" class="txt-under txt-blue">입금확인</a></th>
                        <th><a href="" class="txt-under txt-blue">매출기준</a></th>
                        <th><a href="" class="txt-under txt-blue">구매 미결정</a></th>
                        <th><a href="" class="txt-under txt-blue">구매 결정</a></th>
                        <th><a href="" class="txt-under txt-blue">정산완료</a></th>
                    </tr></thead>
                    <tbody>
                    <tr>
                        <td>주문건수</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>상품판매</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>배송비</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>취소위약금/환불금차감</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>정산대상</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>서비스이용료</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>서비스이용료(선결제배송비)</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>상품판매 상세내역 | 검색결과 <span class="color-blue">10개</span> <button class="btn btn-blue btn-mini">엑셀다운</button></h1>
                </div>
                <p class="text-guide">(주문번호를 클릭 하면 결제금액 상세정보를 확인할 수 있습니다.)</p>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>결제번호</th>
                        <th>주문번호</th>
                        <th>상품번호</th>
                        <th>상품명</th>
                        <th>고객ID</th>
                        <th>주문일</th>
                        <th>입금확인일</th>
                        <th>발송일</th>
                        <th>배송완료일</th>
                        <th>환불일</th>
                        <th>매출기준일</th>
                        <th>구매결정일</th>
                        <th>정산방식</th>
                        <th>정산예정일</th>
                        <th>정산완료일</th>
                        <th>주문수량</th>
                        <th>상품 판매가</th>
                        <th>옵션상품 판매가</th>
                        <th>옥션 상품별 할인</th>
                        <th>옥션 구매자 쿠폰 할인</th>
                        <th>판매자 할인</th>
                        <th>결제금액</th>
                        <th>판매자 정산요청가</th>
                        <th>옵션상품 정산요청가</th>
                        <th>공제/환급금</th>
                        <th>판매자 최종정산금</th>
                        <th>기본 서비스 이용료</th>
                        <th>기본이용료 감면</th>
                        <th>서비스이용료</th>
                        <th>카테고리 기본이용료</th>
                        <th>카테고리 기본이용료율</th>
                        <th>옥션 상품 쿠폰</th>
                        <th>옥션 구매 쿠폰</th>
                        <th>옥션 추가 쿠폰</th>
                        <th>판매자 분담 옥션 구매자 쿠폰 할인</th>
                        <th>판매자 분담 옥션 상품별 할인</th>
                        <th>판매자 할인구성 1</th>
                        <th>판매자 할인구성 2</th>
                        <th>판매자구분</th>
                        <th>과세구분</th>
                        <th>묶음배송번호</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>결제번호</td>
                        <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                        <td>상품번호</td>
                        <td>상품명</td>
                        <td>고객ID</td>
                        <td>주문일</td>
                        <td>입금확인일</td>
                        <td>발송일</td>
                        <td>배송완료일</td>
                        <td>환불일</td>
                        <td>매출기준일</td>
                        <td>구매결정일</td>
                        <td>정산방식</td>
                        <td>정산예정일</td>
                        <td>정산완료일</td>
                        <td>주문수량</td>
                        <td>상품 판매가</td>
                        <td>옵션상품 판매가</td>
                        <td>옥션 상품별 할인</td>
                        <td>옥션 구매자 쿠폰 할인</td>
                        <td>판매자 할인</td>
                        <td>결제금액</td>
                        <td>판매자 정산요청가</td>
                        <td>옵션상품 정산요청가</td>
                        <td>공제/환급금</td>
                        <td>판매자 최종정산금</td>
                        <td>기본 서비스 이용료</td>
                        <td>기본이용료 감면</td>
                        <td>서비스이용료</td>
                        <td>카테고리 기본이용료</td>
                        <td>카테고리 기본이용료율</td>
                        <td>옥션 상품 쿠폰</td>
                        <td>옥션 구매 쿠폰</td>
                        <td>옥션 추가 쿠폰</td>
                        <td>판매자 분담 옥션 구매자 쿠폰 할인</td>
                        <td>판매자 분담 옥션 상품별 할인</td>
                        <td>판매자 할인구성 1</td>
                        <td>판매자 할인구성 2</td>
                        <td>판매자구분</td>
                        <td>과세구분</td>
                        <td>묶음배송번호</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination_wrap">
                <a href="" class="page-prev"><i class="fa-regular fa-angle-left"></i></a>
                <div class="page-now">1 / 3</div>
                <a href="" class="page-next"><i class="fa-regular fa-angle-right"></i></a>
            </div>
        </div><!--상품판매 상세내역-->
        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>배송비 상세내역 | 검색결과 <span class="color-blue">10개</span> <button class="btn btn-blue btn-mini">엑셀다운</button></h1>
                </div>
                <p class="text-guide">(대표주문번호 및 대표상품명은 배송완료 후 보여집니다.)</p>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>결제번호</th>
                        <th>묶음배송번호</th>
                        <th>고객ID</th>
                        <th>배송비 결제일</th>
                        <th>상품대금 입금확인일</th>
                        <th>환불일</th>
                        <th>매출기준일</th>
                        <th>정산방식</th>
                        <th>정산완료일</th>
                        <th>배송비</th>
                        <th>배송수수료</th>
                        <th>배송비 정산액</th>
                        <th>배송비종류</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>결제번호</td>
                        <td>묶음배송번호</td>
                        <td>고객ID</td>
                        <td>배송비 결제일</td>
                        <td>상품대금 입금확인일</td>
                        <td>환불일</td>
                        <td>매출기준일</td>
                        <td>정산방식</td>
                        <td>정산완료일</td>
                        <td>배송비</td>
                        <td>배송수수료</td>
                        <td>배송비 정산액</td>
                        <td>배송비종류</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination_wrap">
                <a href="" class="page-prev"><i class="fa-regular fa-angle-left"></i></a>
                <div class="page-now">1 / 3</div>
                <a href="" class="page-next"><i class="fa-regular fa-angle-right"></i></a>
            </div>
        </div><!--배송비 상세내역-->
        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>취소위약금 및 환불금차감 배송비 상세내역 | 검색결과 <span class="color-blue">10개</span> <button class="btn btn-blue btn-mini">엑셀다운</button></h1>
                </div>
                <br>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>결제번호</th>
                        <th>주문번호</th>
                        <th>묶음배송번호</th>
                        <th>고객ID</th>
                        <th>환불일</th>
                        <th>매출기준일</th>
                        <th>정산방식</th>
                        <th>정산완료일</th>
                        <th>금액</th>
                        <th>배송수수료</th>
                        <th>배송비 정산액</th>
                        <th>종류</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>결제번호</td>
                        <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                        <td>묶음배송번호</td>
                        <td>고객ID</td>
                        <td>환불일</td>
                        <td>매출기준일</td>
                        <td>정산방식</td>
                        <td>정산완료일</td>
                        <td>금액</td>
                        <td>배송수수료</td>
                        <td>배송비 정산액</td>
                        <td>종류</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination_wrap">
                <a href="" class="page-prev"><i class="fa-regular fa-angle-left"></i></a>
                <div class="page-now">1 / 3</div>
                <a href="" class="page-next"><i class="fa-regular fa-angle-right"></i></a>
            </div>
        </div><!--취소위약금 및 환불금차감 배송비 상세내역-->

        <div class="sch_wrap">
            <p class="tit">결제수단별 합계내역 검색
                <a class="btn btn-gray btn-md male-auto" href="" >조건초기화</a>
                <button class="btn btn-blue btn-md" onclick="">검색하기</button>
            </p>
            <div class="box flexwrap  gap10">
                <div class="w48">
                    <p>일자구분</p>
                    <div class="input_date">
                        <div class="input_select w150px">
                            <select class="border_gray">
                                <option value="D1" selected="">입금(환불)일</option>
                                <option value="D3">매출기준일</option>
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
                    </div>
                </div>
                <div class="w15 flex gap5 male-auto">
                    <p>상품 주문 건수</p>
                    <h1><span class="color-blue">10</span>건</h1>
                </div>
                <div class="w15 flex gap5">
                    <p>배송비 결제 건수</p>
                    <h1><span class="color-blue">10</span>건</h1>
                </div>
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>검색결과 <span class="color-blue">10개</span> <button class="btn btn-blue btn-mini">엑셀다운</button></h1>
                </div>
                <br>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>결제구분</th>
                        <th>증빙발생대상</th>
                        <th>정상 건수</th>
                        <th>정상 금액</th>
                        <th>취소 건수</th>
                        <th>취소 금액</th>
                        <th>합계 건수</th>
                        <th>합계 금액</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>결제구분</td>
                        <td>증빙발생대상</td>
                        <td>정상 건수</td>
                        <td>정상 금액</td>
                        <td>취소 건수</td>
                        <td>취소 금액</td>
                        <td>합계 건수</td>
                        <td>합계 금액</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination_wrap">
                <a href="" class="page-prev"><i class="fa-regular fa-angle-left"></i></a>
                <div class="page-now">1 / 3</div>
                <a href="" class="page-next"><i class="fa-regular fa-angle-right"></i></a>
            </div>
        </div><!--취소위약금 및 환불금차감 배송비 상세내역-->
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>