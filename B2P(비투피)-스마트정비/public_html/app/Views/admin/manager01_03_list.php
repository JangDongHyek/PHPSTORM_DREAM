<?php 
    echo view('common/header_adm'); 
    $pid = "manager01_02_list";
    $header_name = "제조사/ 정비업체 관리";
?>

<script>
    $(document).ready(function(){
        $('.adm_menu > li:nth-child(1)').addClass('active');
    })
</script>


<div id="adm_content">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">관리자 관리</h6>
            <div class="menu02">
                <a href="./manager01_01_list">B2P 직원 관리</a>
                <a href="./manager01_02_list">제조사/ 정비업체 관리</a>
                <a href="./manager01_03_list" class="active">정비업체 지점 관리</a>
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
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1><span class="color-blue">검색결과 03개</span>/ 총 100개</h1>
                    <div class="input_select2">
                        <select>
                            <option value="10개씩 보기">10개씩 보기</option>
                            <option value="20개씩 보기">20개씩 보기</option>
                            <option value="30개씩 보기">30개씩 보기</option>
                        </select>
                    </div>
                </div>

<!--
                <div class="wrap">
                    <a href="./manager01_02_write" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
-->
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th width='100px'>No</th>
                            <th width='200px'>회사</th>
                            <th>지점명</th>
                            <th>지점코드</th>
                            <th>주소</th>
                            <th>영업시간</th>
                            <th>휴일</th>
                            <th>담당자</th>
                            <th>담당자연락처</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>㈜카이스트코리아</td>
                            <td>동탄점</td>
                            <td>A005</td>
                            <td>경기도 화성시 통탄대로4길</td>
                            <td>08:00 ~ 19:00</td>
                            <td>토/일/공휴일</td>
                            <td>김현진</td>
                            <td>000-0000-0000</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>㈜카이스트코리아</td>
                            <td>동탄점</td>
                            <td>A005</td>
                            <td>경기도 화성시 통탄대로4길</td>
                            <td>08:00 ~ 19:00</td>
                            <td>토/일/공휴일</td>
                            <td>김현진</td>
                            <td>000-0000-0000</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>㈜카이스트코리아</td>
                            <td>동탄점</td>
                            <td>A005</td>
                            <td>경기도 화성시 통탄대로4길</td>
                            <td>08:00 ~ 19:00</td>
                            <td>토/일/공휴일</td>
                            <td>김현진</td>
                            <td>000-0000-0000</td>
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
