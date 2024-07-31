
<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "취소 관리";
?>


        <?php echo view('order/order_head', $this->data); ?>

        <div class="state_wrap">
            <div class="w25 flex gap5">
                <p>전체누적</p>
                <h1><span class="color-blue">10</span>건</h1>
            </div>
            <div class="grid grid3 w100">
                <p>취소요청 <span class="color-blue">10</span>건</p>
                <p>취소중 <span class="color-blue">10</span>건</p>
                <p>취소된 거래 (1개월) <span class="color-blue">10</span>건</p>
            </div>
        </div>
        <div class="sch_wrap">
            <p class="tit">검색조건
                <a class="btn btn-gray btn-md male-auto" href="" >조건초기화</a>
                <button class="btn btn-blue btn-md" onclick="">검색하기</button></p>
            <div class="box">
                <div class="">
                    <p>검색하기</p>
                    <div class="flex gap5">
                        <div class="input_select">
                            <select class="border_gray w100">
                                <option value="주문번호">주문번호</option>
                                <option value="상품번호">상품번호</option>
                                <option value="구매자명">구매자명</option>
                                <option value="구매자ID">구매자ID</option>
                                <option value="상품명">상품명</option>
                            </select>
                        </div>
                        <div class="input_search">
                            <input type="text" placeholder="검색어를 입력하세요" class="border_gray">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p>일자</p>
                    <div class="input_date">
                        <div class="input_select">
                            <select class="border_gray">
                                <option value="ODD">주문일</option>
                                <option value="DCD">결제완료일</option>
                                <option value="CRD">취소신청일</option>
                                <option value="CFD">취소완료일</option>
                                <option value="GAD">선물수락일</option>
                            </select>
                        </div>
                        <div class="input_select">
                            <input type="date" class="border_gray" id="startDate" name="startDate">
                        </div>
                        ~
                        <div class="input_select">
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
                    <p>처리상태</p>
                    <div class="input_select">
                        <select class="border_gray">
                            <option value="">전체</option>
                            <option selected="selected" value="CR">취소요청</option>
                            <option value="CI">취소중</option>
                            <option value="CC">취소된거래</option>
                        </select>
                    </div>
                </div>
                <!--
                <div>
                    <p>주문종류</p>
                    <div class="input_select">
                        <select class="border_gray">
                            <option value="AL">전체</option>
                            <option value="NL">일반주문</option>
                            <option value="G9">G9주문</option>
                            <option value="TL">스마일배송주문</option>
                        </select>
                    </div>
                </div>
                <div>
                    <p>선물주문여부</p>
                    <div class="input_radio" style="height: 45px;">
                        <input type="checkbox" id="chk01" name="chk01" value="T">
                        <label for="chk01">
                            선물주문
                        </label>
                    </div>
                </div>
                -->
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>기간 : 00.00.00 - 00.00.00 | <span class="color-blue">검색결과 10개</span> / 총 100개</h1>
                    <div class="input_select2 male-auto">
                        <select class="">
                            <option value="10개씩 보기">10개씩 보기</option>
                            <option value="20개씩 보기">20개씩 보기</option>
                            <option value="30개씩 보기">30개씩 보기</option>
                        </select>
                    </div>
                </div>
                <div class="wrap w100 flex">
                    <button type="button" class="btn btn-blue btn-mini" onclick="orderSend_modal()">발송처리</button>
                    <button type="button" class="btn btn-white btn-mini" onclick="orderCancel_modal()()">취소처리</button>
                </div>
            </div>
            <div class="table flex nowrap">
                <table class="sticky">
                    <colgroup>
                        <col width="50px">
                        <col width="150px">
                        <col width="150px">
                        <col width="150px">
                        <col width="150px">
                    </colgroup>
                    <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>아이디</th>
                        <th>취소요청일</th>
                        <th>취소상태</th>
                        <th>주문번호</th>
                        <th>구매자명</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>아이디 <div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div></td>
                        <td>취소요청일</td>
                        <td>취소상태</td>
                        <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                        <td>구매자명</td>
                    </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                    <tr>
                        <th>구매자ID</th>
                        <th>취소사유</th>
                        <th>상세취소사유</th>
                        <th>취소완료일</th>
                        <th>상품번호</th>
                        <th>상품명</th>
                        <th>선물주문여부</th>
                        <th>선물수락일시</th>
                        <th>수량</th>
                        <th>주문옵션</th>
                        <th>추가구성</th>
                        <th>사은품</th>
                        <th>판매단가</th>
                        <td>판매금액</td>
                        <th>판매자 관리코드</th>
                        <th>판매자 상세관리코드</th>
                        <th>구매자 휴대폰</th>
                        <th>구매자 전화번호</th>
                        <th>수령인 휴대폰</th>
                        <th>수령인 전화번호</th>
                        <th>우편번호</th>
                        <th>주소</th>
                        <th>배송시 요구사항</th>
                        <th>택배사명(발송방법)</th>
                        <th>배송번호</th>
                        <th>배송비</th>
                        <th>배송비 금액</th>
                        <th>배송지연사유</th>
                        <th>SKU번호 및 수량</th>
                        <th>미수령신고일자</th>
                        <th>상품미수령철회요청일자</th>
                        <th>상품미수령이의제기일자</th>
                        <th>주문종류</th>
                        <th>장바구니번호(결제번호)</th>
                        <th>주문일자(결제확인전)</th>
                        <th>주문확인일자</th>
                        <th>발송예정일</th>
                        <th>서비스이용료</th>
                        <th>판매자쿠폰할인</th>
                        <th>(옥션)우수회원할인</th>
                        <th>복수구매할인</th>
                        <th>스마일캐시적립</th>
                        <th>제휴사명</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>구매자ID</td>
                        <td>취소사유</td>
                        <td>상세취소사유</td>
                        <td>취소완료일</td>
                        <td><a>상품번호</a></td>
                        <td>상품명</td>
                        <td>선물주문여부</td>
                        <td>선물수락일시</td>
                        <td>수량</td>
                        <td>주문옵션</td>
                        <td>추가구성</td>
                        <td>사은품</td>
                        <td>판매단가</td>
                        <td>판매금액</td>
                        <td>판매자 관리코드</td>
                        <td>판매자 상세관리코드</td>
                        <td>구매자 휴대폰</td>
                        <td>구매자 전화번호</td>
                        <td>수령인 휴대폰</td>
                        <td>수령인 전화번호</td>
                        <td>우편번호</td>
                        <td>주소</td>
                        <td>배송시 요구사항</td>
                        <td>택배사명(발송방법)</td>
                        <td>배송번호</td>
                        <td>배송비</td>
                        <td>배송비 금액</td>
                        <td>배송지연사유</td>
                        <td>SKU번호 및 수량</td>
                        <td>미수령신고일자</td>
                        <td>상품미수령철회요청일자</td>
                        <td>상품미수령이의제기일자</td>
                        <td>주문종류</td>
                        <td>장바구니번호(결제번호)</td>
                        <td>주문일자(결제확인전)</td>
                        <td>주문확인일자</td>
                        <td>발송예정일</td>
                        <th>서비스이용료</th>
                        <td>판매자쿠폰할인</td>
                        <td>(옥션)우수회원할인</td>
                        <td>복수구매할인</td>
                        <td>스마일캐시적립</td>
                        <td>제휴사명</td>
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