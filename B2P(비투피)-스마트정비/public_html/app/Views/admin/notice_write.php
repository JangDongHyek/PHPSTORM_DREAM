
<?php 
    echo view('common/header_adm');
echo view('common/adm_head');
    $header_name = "공지사항";
?>


        <?php echo view('admin/board_head', $this->data); ?>

        <div class="write_wrap">
            <div class="top_wrap">
                <h1>공지사항 등록하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('/admin/notice')?>" class="btn btn-sm btn-gray">목록</a>
                    <a href="<?=base_url('/admin/notice')?>" class="btn btn-sm btn-blue">저장</a>
                </div>
            </div>
            <div class="box">

                <div class="input_form">
                    <p>공지유형</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="중요공지">중요공지</option>
                        </select>
                    </div>
                </div>
                <div class="input_text">
                    <p>제목</p>
                    <input type="password" placeholder="입력하세요" class="border_gray">
                    <p class="text-guide">※ 중요공지인 경우 항상 상단에 노출됩니다.</p>
                </div>
                
                <div class="input_textarea">
                    <p>내용</p>
                    <textarea name="" id="" class="border_gray">앞으로도 완벽한 지원을 약속드립니다.</textarea>
                </div>
                
                <div class="input_text">
                    <p>첨부파일</p>
                    <input type="file" class="border_gray">
                </div>
            </div>
        </div>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>