<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "예약 관리";
?>



        <div class="tit_wrap">
            <h6 class="menu01">예약 관리</h6>
            <div class="menu02">
                <a href="<?=base_url('/admin/reserv_list')?>" class="active">예약 관리</a>
                <!--a href="<?=base_url('/admin/calcul_list')?>">정산 리스트</a-->
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
                            <option value="지마켓">지마켓</option>
                            <option value="지마켓">지마켓</option>
                            <option value="지마켓">지마켓</option>
                        </select>
                    </div>
                </div>
                <div class="sch02">
                    
                    <p>등록일</p>
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
                            <th>예약번호</th>
                            <th>점포코드</th>
                            <th>점포명</th>
                            <th>제품명</th>
                            <th>예약일시</th>
                            <th>고객명</th>
                            <th>차량번호</th>
                            <th>차종</th>
                            <th>접수일</th>
                            <th>상태</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>3966954720</td>
                            <td>A005</td>
                            <td>지에스타워점</td>
                            <td>엔진오일</td>
                            <td>2023.12.14</td>
                            <td>강성범</td>
                            <td>1000</td>
                            <td>현대 그랜저G 2.4</td>
                            <td>2023.12.14</td>
                            <td>구매확정</td>
                        </tr>
                        <tr>
                            <td>3966954720</td>
                            <td>A005</td>
                            <td>지에스타워점</td>
                            <td>엔진오일</td>
                            <td>2023.12.14</td>
                            <td>강성범</td>
                            <td>1000</td>
                            <td>현대 그랜저G 2.4</td>
                            <td>2023.12.14</td>
                            <td>구매확정</td>
                        </tr>
                        <tr>
                            <td>3966954720</td>
                            <td>A005</td>
                            <td>지에스타워점</td>
                            <td>엔진오일</td>
                            <td>2023.12.14</td>
                            <td>강성범</td>
                            <td>1000</td>
                            <td>현대 그랜저G 2.4</td>
                            <td>2023.12.14</td>
                            <td>구매확정</td>
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
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>