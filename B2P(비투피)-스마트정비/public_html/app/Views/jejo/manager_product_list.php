
<?php 
    echo view('common/header_adm'); 
    $pid = "manager_product_list";
    $header_name = "제품 관리";
?>


<div id="adm_content">
    <?php echo view('common/jejo_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">제품 관리</h6>
            <div class="menu02">
                <a href="<?=base_url('/jejo/manager_product_list')?>" class="active">제품 관리</a>
                <a href="<?=base_url('/jejo/manager_stock_list')?>">재고 관리</a>
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
                    <p>업체명</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="선택하세요">선택하세요</option>
                            <option value="선택하세요">선택하세요</option>
                            <option value="선택하세요">선택하세요</option>
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

                <div class="wrap">
                    <a href="<?=base_url('/jejo/manager_product_write')?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th width='100px'>No</th>
                            <th>판매처</th>
                            <th>제품코드</th>
                            <th>제품</th>
                            <th width='200px'>제품상세</th>
                            <th>제품사</th>
                            <th>재고량</th>
                            <th>판매단가</th>
                            <th>수수료(플랫폼)</th>
                            <th>수수료(쇼핑몰)</th>
                            <th>업데이트</th>
                            <th width='100px'>상태</th>
                            <th width='130px'>편집</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>지마켓</td>
                            <td>105</td>
                            <td>엔진오일</td>
                            <td>현대펠이세이트 엔진오일</td>
                            <td>동진산업</td>
                            <td>105</td>
                            <td>10,000</td>
                            <td>5,000</td>
                            <td>15,000</td>
                            <td>2023.12.14</td>
                            <td>
                                <div class="input_select2">
                                    <i class="fa-solid fa-sort-down"></i>
                                    <select name="" id="">
                                        <option value="승인" selected>승인</option>
                                        <option value="미승인">미승인</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="btn_wrap">
                                    <a href="<?=base_url('/jejo/manager_product_write')?>" class="btn btn-sm btn-skyblue">수정</a>
                                    <a onclick="confirm_modal()" class="btn btn-sm btn-gray">삭제</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>지마켓</td>
                            <td>105</td>
                            <td>엔진오일</td>
                            <td>현대펠이세이트 엔진오일</td>
                            <td>동진산업</td>
                            <td>105</td>
                            <td>10,000</td>
                            <td>5,000</td>
                            <td>15,000</td>
                            <td>2023.12.14</td>
                            <td>
                                <div class="input_select2">
                                    <i class="fa-solid fa-sort-down"></i>
                                    <select name="" id="">
                                        <option value="승인">승인</option>
                                        <option value="미승인" selected>미승인</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="btn_wrap">
                                    <a href="<?=base_url('/jejo/manager_product_write')?>" class="btn btn-sm btn-skyblue">수정</a>
                                    <a onclick="confirm_modal()" class="btn btn-sm btn-gray">삭제</a>
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