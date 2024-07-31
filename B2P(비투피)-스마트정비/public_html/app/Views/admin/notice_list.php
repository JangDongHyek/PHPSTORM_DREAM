
<?php 
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "공지사항";
?>



        <?php echo view('admin/board_head', $this->data); ?>

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
                    <a href="<?=base_url('/admin/noticeWrite')?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th width='100px'>No</th>
                            <th>제목</th>
                            <th width='130px'>글쓴이</th>
                            <th width='130px'>등록일</th>
                            <th width='130px'>편집</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr_notice">
                            <td>notice</td>
                            <td>[안내]  새롭게 단장하였습니다.</td>
                            <td>관리자</td>
                            <td>2023.02.25</td>
                            <td>
                                <div class="btn_wrap">
                                    <a href="<?=base_url('/admin/noticeWrite')?>" class="btn btn-sm btn-skyblue">수정</a>
                                    <a onclick="confirm_modal()" class="btn btn-sm btn-gray">삭제</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>[안내]  새롭게 단장하였습니다.</td>
                            <td>관리자</td>
                            <td>2023.02.25</td>
                            <td>
                                <div class="btn_wrap">
                                    <a href="<?=base_url('/admin/noticeWrite')?>" class="btn btn-sm btn-skyblue">수정</a>
                                    <a onclick="confirm_modal()" class="btn btn-sm btn-gray">삭제</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>[안내]  새롭게 단장하였습니다.</td>
                            <td>관리자</td>
                            <td>2023.02.25</td>
                            <td>
                                <div class="btn_wrap">
                                    <a href="<?=base_url('/admin/noticeWrite')?>" class="btn btn-sm btn-skyblue">수정</a>
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
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>