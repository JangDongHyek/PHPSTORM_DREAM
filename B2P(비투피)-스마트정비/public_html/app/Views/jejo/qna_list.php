<?php 
    echo view('common/header_adm'); 
    $pid = "qna_list";
    $header_name = "Q&A";
?>


<div id="adm_content">
    <?php echo view('common/jejo_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">고객센터</h6>
            <div class="menu02">
                <a href="<?=base_url('/jejo/notice_list')?>">공지사항</a>
                <a href="<?=base_url('/jejo/qna_list')?>" class="active">Q&A</a>
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
                    <p>분류별</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="선택하세요">선택하세요</option>
                            <option value="선택하세요">선택하세요</option>
                            <option value="선택하세요">선택하세요</option>
                        </select>
                    </div>
                </div>
                <div class="sch03">

                    <p>기간설정</p>
                    <div class="input_select">
                        <!--i class="fa-duotone fa-calendar"></i-->
                        <input type="date" class="border_gray">
                    </div>
                    ~
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
                    <a href="<?=base_url('/jejo/qna_write')?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th width='100px'>No</th>
                            <th>제조사</th>
                            <th>제목</th>
                            <th>첨부</th>
                            <th>등록자</th>
                            <th>등록일</th>
                            <th>답변자</th>
                            <th>상태</th>
                            <th>답변날짜</th>
                            <th width='130px'>편집</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>-</td>
                            <td>불편한데 개선좀 부탁드릴게요 제발요</td>
                            <td>-</td>
                            <td>강유선(100001)</td>
                            <td>2023.02.25</td>
                            <td>조미애(jomiae)</td>
                            <td>문의중</td>
                            <td>-</td>
                            <td>
                                <div class="btn_wrap">
                                    <a href="<?=base_url('/jejo/qna_view')?>" class="btn btn-sm btn-skyblue">상세</a>
                                    <a onclick="confirm_modal()" class="btn btn-sm btn-gray">삭제</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>-</td>
                            <td>불편한데 개선좀 부탁드릴게요 제발요</td>
                            <td>-</td>
                            <td>강유선(100001)</td>
                            <td>2023.02.25</td>
                            <td>조미애(jomiae)</td>
                            <td>문의중</td>
                            <td>2023-12-12</td>
                            <td>
                                <div class="btn_wrap">
                                    <a href="<?=base_url('/jejo/qna_view')?>" class="btn btn-sm btn-skyblue">상세</a>
                                    <a onclick="confirm_modal()" class="btn btn-sm btn-gray">삭제</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>-</td>
                            <td>불편한데 개선좀 부탁드릴게요 제발요</td>
                            <td>-</td>
                            <td>강유선(100001)</td>
                            <td>2023.02.25</td>
                            <td>조미애(jomiae)</td>
                            <td>문의중</td>
                            <td>2023-12-12</td>
                            <td>
                                <div class="btn_wrap">
                                    <a href="<?=base_url('/jejo/qna_view')?>" class="btn btn-sm btn-skyblue">상세</a>
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
