
<?php
echo view('common/header_adm');
$header_name = "주문 관리";
?>


<div id="adm_content" class="order">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap">
        <?php echo view('order/order_head', $this->data); ?>

        <div class="sch_wrap">
            <p class="tit">검색조건 <button class="btn btn-blue btn-mini">초기화</button></p>
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
                    <p>주문일</p>
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
                    <button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#orderCancelModal">판매취소</button>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>아이디</th>
                        <th>주문번호</th>
                        <th>결제기한</th>
                        <th>주문자명</th>
                        <th>주문자ID</th>
                        <th>상품번호</th>
                        <th>상품명</th>
                        <th>수량</th>
                        <th>주문옵션</th>
                        <th>추가구성</th>
                        <th>사은품</th>
                        <th>사은품 관리코드</th>
                        <th>덤</th>
                        <th>덤 관리코드</th>
                        <th>판매단가</th>
                        <th>판매금액</th>
                        <th>판매자 관리코드</th>
                        <th>주문종류</th>
                        <th>SKU번호 및 수량</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>아이디 <div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div></td>
                        <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                        <td>결제기한</td>
                        <td>주문자명</td>
                        <td>주문자ID</td>
                        <td><a target="_blank">상품번호</a></td>
                        <td>상품명</td>
                        <td>수량</td>
                        <td>주문옵션</td>
                        <td>추가구성</td>
                        <td>사은품</td>
                        <td>사은품 관리코드</td>
                        <td>덤</td>
                        <td>덤 관리코드</td>
                        <td>판매단가</td>
                        <td>판매금액</td>
                        <td>판매자 관리코드</td>
                        <td>주문종류</td>
                        <td>SKU번호 및 수량</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>아이디 <div class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></div></td>
                        <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                        <td>결제기한</td>
                        <td>주문자명</td>
                        <td>주문자ID</td>
                        <td><a target="_blank">상품번호</a></td>
                        <td>상품명</td>
                        <td>수량</td>
                        <td>주문옵션</td>
                        <td>추가구성</td>
                        <td>사은품</td>
                        <td>사은품 관리코드</td>
                        <td>덤</td>
                        <td>덤 관리코드</td>
                        <td>판매단가</td>
                        <td>판매금액</td>
                        <td>판매자 관리코드</td>
                        <td>주문종류</td>
                        <td>SKU번호 및 수량</td>
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
    </div>
</div>


<?php echo view('order/order_modal', $this->data); ?>
<?php echo view('common/footer'); ?>