
<?php 
    echo view('common/header_adm'); 
    $pid = "ship_list";
    $header_name = "배송 관리";
?>

<div id="adm_content">
    <?php echo view('common/jejo_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">판매 관리</h6>
            <div class="menu02">
                <a href="<?=base_url('/jejo/sell_list')?>">판매 관리</a>
                <a href="<?=base_url('/jejo/ship_list')?>" class="active">배송 관리</a>
                <a href="<?=base_url('/jejo/cancel_list')?>">구매변경/취소</a>
            </div>
        </div>

        <div class="sch_wrap">
            <p class="tit">검색결과</p>
            <div class="box">
                <div class="sch01">
                    <p>검색하기</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="선택하세요">선택하세요</option>
                            <option value="선택하세요">선택하세요</option>
                            <option value="선택하세요">선택하세요</option>
                        </select>
                    </div>

                    <div class="input_search">
                        <input type="text" placeholder="검색어를 입력하세요" class="border_gray">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
                <div class="sch02">
                    <p>판매처</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="선택하세요">선택하세요</option>
                            <option value="선택하세요">선택하세요</option>
                            <option value="선택하세요">선택하세요</option>
                        </select>
                    </div>
                </div>
                <div class="sch02">
                    
                    <p>날짜선택</p>
                    <div class="input_select">
                        <!--i class="fa-duotone fa-calendar"></i-->
                        <input type="date" class="border_gray">
                    </div>
                    </div>
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1><span class="color-blue">검색결과 10개</span>/ 총 100개</h1>
                    <div class="input_select2">
                        <select>
                            <option value="10개씩 보기">10개씩 보기</option>
                            <option value="20개씩 보기">20개씩 보기</option>
                            <option value="30개씩 보기">30개씩 보기</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>주문번호</th>
                            <th>판매처</th>
                            <th>제품코드</th>
                            <th>제품명</th>
                            <th>제조사</th>
                            <th>주문자</th>
                            <th>가격</th>
                            <th>수량</th>
                            <th>판매액</th>
                            <th>배송비</th>
                            <th>구매타입</th>
                            <th>예약상태</th>
                            <th>구매일</th>
                            <th>상태</th>
                            <th width='130px'>편집</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>3966954720</td>
                            <td>지마켓</td>
                            <td>1056</td>
                            <td>엔진오일</td>
                            <td>찬원실업</td>
                            <td>감성범</td>
                            <td>20,000</td>
                            <td>2</td>
                            <td>40,000</td>
                            <td>3,000</td>
                            <td>정비예약</td>
                            <td>문자발송</td>
                            <td>2023.12.14</td>
                            <td>구매확정</td>
                            <td>
                                <div class="btn_wrap">
                                    <a onclick="shipping02_modal();" class="btn btn-sm btn-skyblue">송장</a>
                                    <a onclick="confirm_modal();" class="btn btn-sm btn-gray">취소</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3966954720</td>
                            <td>지마켓</td>
                            <td>1056</td>
                            <td>엔진오일</td>
                            <td>찬원실업</td>
                            <td>감성범</td>
                            <td>20,000</td>
                            <td>2</td>
                            <td>40,000</td>
                            <td>3,000</td>
                            <td>정비예약</td>
                            <td>문자발송</td>
                            <td>2023.12.14</td>
                            <td>구매확정</td>
                            <td>
                                <div class="btn_wrap">
                                    <a onclick="shipping02_modal();" class="btn btn-sm btn-skyblue">송장</a>
                                    <a onclick="confirm_modal();" class="btn btn-sm btn-gray">취소</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3966954720</td>
                            <td>지마켓</td>
                            <td>1056</td>
                            <td>엔진오일</td>
                            <td>찬원실업</td>
                            <td>감성범</td>
                            <td>20,000</td>
                            <td>2</td>
                            <td>40,000</td>
                            <td>3,000</td>
                            <td>정비예약</td>
                            <td>예약완료</td>
                            <td>2023.12.14</td>
                            <td>구매확정</td>
                            <td>
                                <div class="btn_wrap">
                                    <a onclick="shipping02_modal();" class="btn btn-sm btn-skyblue">송장</a>
                                    <a onclick="confirm_modal();" class="btn btn-sm btn-gray">취소</a>
                                </div>
                            </td>
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

<?php echo view('common/footer'); ?>