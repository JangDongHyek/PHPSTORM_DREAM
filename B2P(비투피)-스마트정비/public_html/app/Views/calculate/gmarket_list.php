
<?php
echo view('common/header_adm');
echo view('common/adm_head');
?>


        <?php echo view('calculate/calcu_head', $this->data); ?>

        <ul class="tabs">
            <li class="tab-link current" data-tab="tab-1">판매내역</li>
            <li class="tab-link" data-tab="tab-2">미정산내역</li>
        </ul>

        <div id="tab-1" class="tab-content current">
            <div class="">

                <div class="sch_wrap">
                    <p class="tit">검색조건
                        <a class="btn btn-gray btn-md male-auto" href="" >조건초기화</a>
                        <button class="btn btn-blue btn-md" onclick="">검색하기</button>
                    </p>
                    <div class="box flexwrap">
                        <div>
                            <p>일자구분</p>
                            <div class="input_date">
                                <div class="input_select w150px">

                                    <select class="border_gray">
                                        <option value="D1" selected="">입금확인일</option>
                                        <option value="D2">배송일</option>
                                        <option value="D3">배송완료일</option>
                                        <option value="D7">구매결정일</option>
                                        <option value="D4">환불일</option>
                                        <option value="D5">정산예정일</option>
                                        <option value="D6">정산완료일</option>
                                        <option value="D9">매출기준일</option>
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
                                    <input type="radio" id="date1" name="" value="date">
                                    <label for="date1">오늘</label>
                                    <input type="radio" id="date2" name="" value="date">
                                    <label for="date2">일주일</label>
                                    <input type="radio" id="date3" name="" value="date">
                                    <label for="date3">한달</label>
                                    <input type="radio" id="date4" name="" value="date">
                                    <label for="date4">3개월</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p>검색하기</p>
                            <div class="flex gap5">
                                <div class="input_select">

                                    <select class="border_gray">
                                        <option value="장바구니번호">장바구니번호</option>
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
                                <col style="width:150px;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th rowspan="3" >구분</th>
                                <th rowspan="3"><a href="" class="txt-under txt-blue">입금확인</a></th>
                                <th rowspan="3"><a href="" class="txt-under txt-blue">발송처리</a></th>
                                <th rowspan="3"><a href="" class="txt-under txt-blue">배송완료</a></th>
                                <th rowspan="3"><a href="" class="txt-under txt-blue">매출기준</a></th>
                                <th colspan="3">정산예정</th>
                            </tr>
                            <tr>
                                <th colspan="2">구매결정</th>
                                <th rowspan="2"><a href="" class="txt-under txt-blue">구매 미결정</a></th>
                            </tr>
                            <tr>
                                <th><a href="" class="txt-under txt-blue">정산완료</a></th>
                                <th><a href="" class="txt-under txt-blue">정산 미완료</a></th>
                            </tr>
                            </thead>
                            <!-- //[WPRT-1138] -->
                            <tbody>
                            <tr>
                                <td class="td_bg">체결건수</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">상품판매</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">배송비</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">구매자부담/환급금</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">정산대상</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">서비스이용료</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">서비스이용료<br>(선결제 배송비)</td>
                                <td>0</td>
                                <td>0</td>
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
                                <th>장바구니번호</th>
                                <th>주문번호</th>
                                <th>상품번호</th>
                                <th>상품명</th>
                                <th>고객명</th>
                                <th>주문일</th>
                                <th>입금확인일</th>
                                <th>배송일</th>
                                <th>배송완료일</th>
                                <th>환불일</th>
                                <th>구매결정일</th>
                                <th>정산방식</th>
                                <th>정산예정일</th>
                                <th>정산완료일</th>
                                <th>주문수량</th>
                                <th>판매가격</th>
                                <th>필수선택상품금액</th>
                                <th>추가구성상품금액</th>
                                <th>옵션상품</th>
                                <th>G마켓 상품별 할인</th>
                                <th>G마켓 구매자 쿠폰 할인</th>
                                <th>판매자 상품별 할인</th>
                                <th>고객결제금(구. 구매대금)</th>
                                <th>판매자 정산요청가(구. 공급원가)</th>
                                <th>필수선택정산요청가</th>
                                <th>추가구성정산요청가</th>
                                <th>공제/환급금</th>
                                <th>공제/환급금(서비스이용료 미포함)</th>
                                <th>판매자 최종정산금</th>
                                <th>기본이용료</th>
                                <th>기본이용료 감면</th>
                                <th>서비스이용료</th>
                                <th>카테고리 기본이용료</th>
                                <th>카테고리 기본이용료율</th>
                                <th>G마켓 상품 쿠폰</th>
                                <th>G마켓 구매 쿠폰</th>
                                <th>G마켓 추가 쿠폰</th>
                                <th>판매자 분담 G마켓 구매자 쿠폰 할인</th>
                                <th>판매자 분담 G마켓 상품별 할인</th>
                                <th>해외배송비</th>
                                <th>결제방식</th>
                                <th>딜러구분</th>
                                <th>보류사유</th>
                                <th>과세구분</th>
                                <th>비고</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>장바구니번호</td>
                                <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                                <td>상품번호</td>
                                <td>상품명</td>
                                <td>고객명</td>
                                <td>주문일</td>
                                <td>입금확인일</td>
                                <td>배송일</td>
                                <td>배송완료일</td>
                                <td>환불일</td>
                                <td>구매결정일</td>
                                <td>정산방식</td>
                                <td>정산예정일</td>
                                <td>정산완료일</td>
                                <td>주문수량</td>
                                <td>판매가격</td>
                                <td>필수선택상품금액</td>
                                <td>추가구성상품금액</td>
                                <td>옵션상품</td>
                                <td>G마켓 상품별 할인</td>
                                <td>G마켓 구매자 쿠폰 할인</td>
                                <td>판매자 상품별 할인</td>
                                <td>고객결제금(구. 구매대금)</td>
                                <td>판매자 정산요청가(구. 공급원가)</td>
                                <td>필수선택정산요청가</td>
                                <td>추가구성정산요청가</td>
                                <td>공제/환급금</td>
                                <td>공제/환급금(서비스이용료 미포함)</td>
                                <td>판매자 최종정산금</td>
                                <td>기본이용료</td>
                                <td>기본이용료 감면</td>
                                <td>서비스이용료</td>
                                <td>카테고리 기본이용료</td>
                                <td>카테고리 기본이용료율</td>
                                <td>G마켓 상품 쿠폰</td>
                                <td>G마켓 구매 쿠폰</td>
                                <td>G마켓 추가 쿠폰</td>
                                <td>판매자 분담 G마켓 구매자 쿠폰 할인</td>
                                <td>판매자 분담 G마켓 상품별 할인</td>
                                <td>해외배송비</th>
                                <td>결제방식</td>
                                <td>딜러구분</td>
                                <td>보류사유</td>
                                <td>과세구분</td>
                                <td>비고</td>
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
                                <th>장바구니번호</th>
                                <th>대표주문번호</th>
                                <th>대표상품번호</th>
                                <th>대표상품명</th>
                                <th>고객명</th>
                                <th>체결일</th>
                                <th>입금확인일</th>
                                <th>매출기준일</th>
                                <th>배송일</th>
                                <th>배송완료일</th>
                                <th>환불일</th>
                                <th>구매결정일</th>
                                <th>정산방식</th>
                                <th>배송비</th>
                                <th>서비스이용료(선결제배송비)</th>
                                <th>배송비정산금액</th>
                                <th>정산예정일</th>
                                <th>배송비상세</th>
                                <th>매출주문번호</th>
                                <th>정산완료일</th>
                                <th>결제방식</th>
                                <th>배송비타입</th>
                                <th>송장번호</th>
                                <th>배송비유형</th>
                                <th>추가배송비종류</th>
                                <th>보류사유</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>장바구니번호</td>
                                <td>대표주문번호</td>
                                <td>대표상품번호</td>
                                <td>대표상품명</td>
                                <td>고객명</td>
                                <td>체결일</td>
                                <td>입금확인일</td>
                                <td>매출기준일</td>
                                <td>배송일</td>
                                <td>배송완료일</td>
                                <td>환불일</td>
                                <td>구매결정일</td>
                                <td>정산방식</td>
                                <td>배송비</td>
                                <td>서비스이용료(선결제배송비)</td>
                                <td>배송비정산금액</td>
                                <td>정산예정일</td>
                                <td>배송비상세</td>
                                <td>매출주문번호</td>
                                <td>정산완료일</td>
                                <td>결제방식</td>
                                <td>배송비타입</td>
                                <td>송장번호</td>
                                <td>배송비유형</td>
                                <td>추가배송비종류</td>
                                <td>보류사유</td>
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
                            <h1>구매자 부담/환급금 상세내역 | 검색결과 <span class="color-blue">10개</span> <button class="btn btn-blue btn-mini">엑셀다운</button></h1>
                        </div>
                        <br>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                            <tr>
                                <th>장바구니번호</th>
                                <th>대표주문번호</th>
                                <th>대표상품번호</th>
                                <th>대표상품명</th>
                                <th>고객명</th>
                                <th>체결일</th>
                                <th>입금확인일</th>
                                <th>매출기준일</th>
                                <th>배송일</th>
                                <th>배송완료일</th>
                                <th>환불일</th>
                                <th>구매결정일</th>
                                <th>정산방식</th>
                                <th>배송비</th>
                                <th>서비스이용료(선결제배송비)</th>
                                <th>배송비정산금액</th>
                                <th>정산예정일</th>
                                <th>배송비상세</th>
                                <th>매출주문번호</th>
                                <th>정산완료일</th>
                                <th>결제방식</th>
                                <th>배송비타입</th>
                                <th>송장번호</th>
                                <th>배송비유형</th>
                                <th>추가배송비종류</th>
                                <th>보류사유</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>장바구니번호</td>
                                <td>대표주문번호</td>
                                <td>대표상품번호</td>
                                <td>대표상품명</td>
                                <td>고객명</td>
                                <td>체결일</td>
                                <td>입금확인일</td>
                                <td>매출기준일</td>
                                <td>배송일</td>
                                <td>배송완료일</td>
                                <td>환불일</td>
                                <td>구매결정일</td>
                                <td>정산방식</td>
                                <td>배송비</td>
                                <td>서비스이용료(선결제배송비)</td>
                                <td>배송비정산금액</td>
                                <td>정산예정일</td>
                                <td>배송비상세</td>
                                <td>매출주문번호</td>
                                <td>정산완료일</td>
                                <td>결제방식</td>
                                <td>배송비타입</td>
                                <td>송장번호</td>
                                <td>배송비유형</td>
                                <td>추가배송비종류</td>
                                <td>보류사유</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination_wrap">
                        <a href="" class="page-prev"><i class="fa-regular fa-angle-left"></i></a>
                        <div class="page-now">1 / 3</div>
                        <a href="" class="page-next"><i class="fa-regular fa-angle-right"></i></a>
                    </div>
                </div><!--구매자 부담/환급금 상세내역-->

                <div class="sch_wrap">
                    <p class="tit">결제수단별 합계내역 검색
                        <a class="btn btn-gray btn-md male-auto" href="" >조건초기화</a>
                        <button class="btn btn-blue btn-md" onclick="">검색하기</button>
                    </p>
                    <div class="box flexwrap  gap10">
                        <div class="w48">
                            <p>입금확인/환불일</p>
                            <div class="input_date">
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
                                <th>상품 구매대금</th>
                                <th>배송비</th>
                                <th>합계(매출액)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>결제구분</td>
                                <td>상품 구매대금</td>
                                <td>배송비</td>
                                <td>합계(매출액)</td>
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
            </div>
        </div><!--tab-->

        <div id="tab-2" class="tab-content">
            <div>

                <div class="sch_wrap">
                    <p class="tit">검색조건
                        <a class="btn btn-gray btn-md male-auto" href="" >조건초기화</a>
                        <button class="btn btn-blue btn-md" onclick="">검색하기</button>
                    </p>
                    <div class="box flexwrap">

                        <div>
                            <p>정산보류내역</p>
                            <div class="input_radio">
                                <input type="checkbox" id="chk01" name="chk01" value="T">
                                <label for="chk01">
                                    전체기간조회
                                </label>
                            </div>
                        </div>
                        <div>
                            <p>일자구분</p>
                            <div class="input_date">
                                <div class="input_select w150px">

                                    <select class="border_gray">
                                        <option value="D1" selected="">입금확인일</option>
                                        <option value="D3">배송완료일</option>
                                        <option value="D7">구매결정일</option>
                                        <option value="D5">정산예정일</option>
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
                        <div>
                            <p>검색하기</p>
                            <div class="flex w100 gap5">
                                <div class="select flex nowrap">
                                    <input type="radio" id="sum1" name="" value="sum">
                                    <label for="sum1">합계</label>
                                    <input type="radio" id="sum2" name="" value="sum">
                                    <label for="sum2">상세</label>
                                </div>
                                <div class="input_select">

                                    <select class="border_gray">
                                        <option value="장바구니번호">장바구니번호</option>
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
                            <h1>합계내역</h1>
                        </div>
                        <p class="text-guide">미정산 내역의 처리방법은 매뉴얼에 있습니다.</p>
                    </div>
                    <div class="table">
                        <table>
                            <colgroup>
                                <col style="width:150px;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th rowspan="2">구분</th>
                                <th colspan="2">미정산금액</th>
                                <th colspan="2">정산대기</th>
                                <th colspan="2">정산보류</th>
                            </tr>
                            <tr>
                                <th>건수</th>
                                <th>금액</th>
                                <th>건수</th>
                                <th>금액</th>
                                <th>건수</th>
                                <th>금액</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="td_bg">상품판매</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">배송비</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">전체</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div><!--합계내역-->
                <div class="result_wrap">
                    <div class="top_text">
                        <div class="wrap w100 flex">
                            <h1>정산보류 구분별 합계내역</h1>
                        </div>
                    </div>
                    <div class="table">
                        <table cellpadding="0" cellspacing="1">
                            <colgroup>
                                <col style="width:150px;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th rowspan="2">구분</th>
                                <th colspan="2">지급보류(정산중지)</th>
                                <th colspan="2">취소/반품 진행</th>
                                <th colspan="2">정산서류 미제출</th>
                                <th colspan="2">장기 미배송</th>
                                <th colspan="2">환불 미결정</th>
                                <th colspan="2">구매자 미수취 신고</th>
                            </tr>
                            <tr>
                                <th>건수</th>
                                <th>금액</th>
                                <th>건수</th>
                                <th>금액</th>
                                <th>건수</th>
                                <th>금액</th>
                                <th>건수</th>
                                <th>금액</th>
                                <th>건수</th>
                                <th>금액</th>
                                <th>건수</th>
                                <th>금액</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="td_bg">상품판매</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">배송비</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td class="td_bg">전체</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div><!--정산보류 구분별 합계내역-->
                <div class="result_wrap">
                    <div class="top_text">
                        <div class="wrap w100 flex">
                            <h1>미정산 상품판매 상세내역 | 검색결과 <span class="color-blue">10개</span> <button class="btn btn-blue btn-mini">엑셀다운</button></h1>
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                            <tr>
                                <th>장바구니번호</th>
                                <th>주문번호</th>
                                <th>상품번호</th>
                                <th>상품명</th>
                                <th>고객명</th>
                                <th>주문일</th>
                                <th>입금확인일</th>
                                <th>배송완료일</th>
                                <th>환불일</th>
                                <th>구매결정일</th>
                                <th>정산방식</th>
                                <th>구매자결제금</th>
                                <th>구매대금</th>
                                <th>정산금액</th>
                                <th>미정산상태</th>
                                <th>보류사유</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>장바구니번호</td>
                                <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                                <td>상품번호</td>
                                <td>상품명</td>
                                <td>고객명</td>
                                <td>주문일</td>
                                <td>입금확인일</td>
                                <td>배송완료일</td>
                                <td>환불일</td>
                                <td>구매결정일</td>
                                <td>정산방식</td>
                                <td>구매자결제금</td>
                                <td>구매대금</td>
                                <td>정산금액</td>
                                <td>미정산상태</td>
                                <td>보류사유</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination_wrap">
                        <a href="" class="page-prev"><i class="fa-regular fa-angle-left"></i></a>
                        <div class="page-now">1 / 3</div>
                        <a href="" class="page-next"><i class="fa-regular fa-angle-right"></i></a>
                    </div>
                </div><!--미정산 상품판매 상세내역-->
                <div class="result_wrap">
                    <div class="top_text">
                        <div class="wrap w100 flex">
                            <h1>미정산 배송비 상세내역 | 검색결과 <span class="color-blue">10개</span> <button class="btn btn-blue btn-mini">엑셀다운</button></h1>
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                            <tr>
                                <th>장바구니번호</th>
                                <th>대표주문번호</th>
                                <th>대표상품번호</th>
                                <th>대표상품명</th>
                                <th>고객명</th>
                                <th>주문일</th>
                                <th>입금확인일</th>
                                <th>배송완료일</th>
                                <th>환불일</th>
                                <th>구매결정일</th>
                                <th>정산방식</th>
                                <th>배송비</th>
                                <th>배송비 정산금액</th>
                                <th>배송비유형</th>
                                <th>추가배송비종류</th>
                                <th>미정산상태</th>
                                <th>보류사유</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>장바구니번호</td>
                                <td>대표주문번호</td>
                                <td>대표상품번호</td>
                                <td>대표상품명</td>
                                <td>고객명</td>
                                <td>주문일</td>
                                <td>입금확인일</td>
                                <td>배송완료일</td>
                                <td>환불일</td>
                                <td>구매결정일</td>
                                <td>정산방식</td>
                                <td>배송비</td>
                                <td>배송비 정산금액</td>
                                <td>배송비유형</td>
                                <td>추가배송비종류</td>
                                <td>미정산상태</td>
                                <td>보류사유</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination_wrap">
                        <a href="" class="page-prev"><i class="fa-regular fa-angle-left"></i></a>
                        <div class="page-now">1 / 3</div>
                        <a href="" class="page-next"><i class="fa-regular fa-angle-right"></i></a>
                    </div>
                </div><!--미정산 배송비 상세내역-->
            </div>
        </div><!--tab-->


<?php
echo view('common/adm_tail');
echo view('common/footer');
?>