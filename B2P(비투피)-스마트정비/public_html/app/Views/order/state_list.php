
<?php
echo view('common/header_adm');
$header_name = "주문 관리";
?>


<div id="adm_content" class="order">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap state_list">
        <?php echo view('order/order_head', $this->data); ?>
        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1 class="">판매자 계정(ID)별 발송 설정 관리</h1>
                </div>
            </div>
            <div class="table">
                <table>
                    <caption>판매자 계정(ID)별 발송 설정 관리</caption>
                    <colgroup>
                        <col>
                        <col style="width: 120px;">
                        <col style="width: 290px;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>사이트</th>
                        <th>판매자ID</th>
                        <th>기본발송 설정</th>
                        <th>토요일 발송여부</th>
                        <th>휴무일 설정</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div>
                            <strong class="">G</strong>마켓
                        </td>
                        <td>
                            <span class="">b2pcorp</span>
                        </td>
                        <td>
                            <div class="">
                                <p>발송일미정</p>
                                <button type="button" class="btn btn-mini btn-white"><span>수정</span></button>
                            </div>
                        </td>
                        <td>
                            <div class="data_setting">
                                <p>발송 안함</p>
                                <button type="button" class="btn btn-mini btn-white"><span>수정</span></button>
                            </div>
                        </td>
                        <td>
                            <div class="data_setting">
                                <p>없음</p>
                                <button type="button" class="btn btn-mini btn-white"><span>조회 및 수정</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></div>
                            <strong class="">A</strong>옥션
                        </td>
                        <td>
                            <span class="">b2pcorp</span>
                        </td>
                        <td>
                            <div class="data_setting">
                                <p>발송일미정</p>
                                <button type="button" class="btn btn-mini btn-white"<span>수정</span></button>
                            </div>
                        </td>
                        <td>
                            <div class="data_setting">
                                <p>발송 안함</p>
                                <button type="button" class="btn btn-mini btn-white"<span>수정</span></button>
                            </div>
                        </td>
                        <td>
                            <div class="data_setting">
                                <p>없음</p>
                                <button type="button" class="btn btn-mini btn-white"<span>조회 및 수정</span></button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="today_wrap">
            <div class="flex jc-sb" onclick="">
                <p>오늘 발송할 주문</p>
                <h1><span class="color-blue">10</span>건</h1>
            </div>
            <div class="flex jc-sb" onclick="">
                <p>노출 제한된 상품</p>
                <h1><span class="color-blue">10</span>건</h1>
            </div>
            <div class="flex jc-sb" onclick="">
                <p>발송 문제 주문</p>
                <h1><span class="color-blue">10</span>건</h1>
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>검색결과 <span class="color-blue">10개</span> <button class="btn btn-blue btn-mini">엑셀다운</button></h1>
                    <div class="input_select2 male-auto">
                                                <select class="">
                            <option value="10개씩 보기">10개씩 보기</option>
                            <option value="20개씩 보기">20개씩 보기</option>
                            <option value="30개씩 보기">30개씩 보기</option>
                        </select>
                    </div>
                </div>
                <div class="wrap w100 flex">
                    <? /* 발송문제주문 선택시
                    <form class="flex gap5">
                        <p>집계일</p>
                        <div class="input_select">
                            <!--i class="fa-duotone fa-calendar"></i-->
                            <input type="date" class="border_gray" id="startDate" name="startDate">
                        </div>

                        <div class="flex">
                            <div class="input_select">

                                <select class="border_gray w100">
                                    <option value="주문번호">주문번호</option>
                                    <option value="상품번호">상품번호</option>
                                </select>
                            </div>
                            <div class="input_search">
                                <input type="text" placeholder="검색어를 입력하세요" class="border_gray">
                                <button><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                     </form>
                    */ ?>
                    <button type="button" class="btn btn-white btn-mini" onclick="location.href='./send_list'">발송처리 바로가기</button>
                </div>
            </div>
            <div class="table">
                <table>
                    <colgroup>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>아이디</th>
                        <th>상품번호</th>
                        <th>주문번호</th>
                        <th>상품명</th>
                        <th>주문일자</th>
                        <th>발송마감일</th>
                        <th>발송유형</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div>아이디</td>
                        <td>상품번호</td>
                        <td>주문번호</td>
                        <td>상품명</td>
                        <td>주문일자</td>
                        <td>발송마감일</td>
                        <td>발송유형</td>
                    </tr>
                    <tr>
                        <td><div class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></div>아이디</td>
                        <td>상품번호</td>
                        <td>주문번호</td>
                        <td>상품명</td>
                        <td>주문일자</td>
                        <td>발송마감일</td>
                        <td>발송유형</td>
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
        <div class="sch_wrap">
            <p class="tit">발송할 주문 도움말</p>
            <div class="box flexwrap gap5">
                <p>· 발송마감일이 오늘이거나 이미 발송마감일이 지난 주문이 표시됩니다.</p>
                <p>· 발송처리 메뉴에서 상세내용 확인 및 발송처리가 가능합니다.</p>
                <p>· 발송마감일까지 발송이 안 된 경우 배송지연으로 구분됩니다.</p>
                <p>· 발송예정일을 입력해도 발송마감일까지 발송이 안 된 경우 배송지연으로 구분됩니다.</p>
            </div>
        </div>
    </div>
</div>


<?php echo view('common/footer'); ?>