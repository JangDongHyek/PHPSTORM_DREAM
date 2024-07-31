
<?php 
    echo view('common/header_adm'); 
    $pid = "delivery_info_list";
    $header_name = "출고지 관리";
?>
<style>
    #adm_content .con_wrap .sch_wrap .box .sch01{
        grid-template-columns: 150px 1fr 150px;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 > p{
        grid-column: 1/4;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 .btn-blue{
        font-size: 1em;
    }
    #adm_content .con_wrap .table{    
        overflow-x: scroll;

    }
    #adm_content .con_wrap .table > table > thead > tr > th,
    #adm_content .con_wrap .table > table > tbody > tr > td{
        text-align: center!important;
    }
</style>


<div id="adm_content">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">배송정보 관리</h6>
            <div class="menu02">
                <a href="<?=base_url('admin/delivery_info_list')?>" class="active">출고지 관리</a>
            </div>
        </div>

        <div class="sch_wrap">
            <p class="tit">검색결과</p>
            <div class="box">
                <div class="sch01" style="width: 100%;">
                    <p>검색하기</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="출고지명">출고지명</option>
                        </select>
                    </div>

                    <div class="input_search">
                        <input type="text" placeholder="검색어를 입력하세요" class="border_gray">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <button class="btn btn-blue">초기화</button>
                </div>
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1><span class="color-blue">출고지 목록 10개</span>/ 총 100개</h1>
                    <div class="input_select2">
                        <select>
                            <option value="10개씩 보기">10개씩 보기</option>
                            <option value="20개씩 보기">20개씩 보기</option>
                            <option value="30개씩 보기">30개씩 보기</option>
                        </select>
                    </div>
                </div>

                <div class="wrap">
                    <a href="<?=base_url('admin/delivery_info_write')?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th width='130px'>수정</th>
                            <th>출고지명</th>
                            <th>주소</th>
                            <th>대표 출고지</th>
                            <th>전화번호</th>
                            <th>휴대전화</th>
                            <th>묶음계산방식</th>
                            <th>도서산간 추가배송비</th>
                            <th>등록일</th>
                            <th>수정일</th>
                            <th>설정상품</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="<?=base_url('admin/delivery_info_write')?>" class="btn btn-sm btn-skyblue">수정</a>
                            </td>
                            <td>HK Tech Corporation</td>
                            <td>경기도 화성시 마도면 마도로620번길 43HK Tech Corporation</td>
                            <td>-</td>
                            <td>070-4486-0587</td>
                            <td>010-5833-4843</td>
                            <td>가장 큰값</td>
                            <td>제주도 4000원<br>기타 4000원</td>
                            <td>2023.09.06.</td>
                            <td>2023.09.06.</td>
                            <td>O</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url('admin/delivery_info_write')?>" class="btn btn-sm btn-skyblue">수정</a>
                            </td>
                            <td>HK Tech Corporation</td>
                            <td>경기도 화성시 마도면 마도로620번길 43HK Tech Corporation</td>
                            <td>-</td>
                            <td>070-4486-0587</td>
                            <td>010-5833-4843</td>
                            <td>가장 큰값</td>
                            <td>제주도 4000원<br>기타 4000원</td>
                            <td>2023.09.06.</td>
                            <td>2023.09.06.</td>
                            <td>O</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url('admin/delivery_info_write')?>" class="btn btn-sm btn-skyblue">수정</a>
                            </td>
                            <td>HK Tech Corporation</td>
                            <td>경기도 화성시 마도면 마도로620번길 43HK Tech Corporation</td>
                            <td>-</td>
                            <td>070-4486-0587</td>
                            <td>010-5833-4843</td>
                            <td>가장 큰값</td>
                            <td>제주도 4000원<br>기타 4000원</td>
                            <td>2023.09.06.</td>
                            <td>2023.09.06.</td>
                            <td>
                                    <a onclick="confirm_modal()" class="btn btn-sm btn-gray">삭제</a>
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