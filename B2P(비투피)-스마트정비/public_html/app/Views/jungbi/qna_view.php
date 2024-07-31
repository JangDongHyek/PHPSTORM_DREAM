<?php 
    echo view('common/header_adm'); 
    $pid = "qna_list";
    $header_name = "Q&A";
?>

<script>
    $(document).ready(function(){
        $('.adm_menu > li:nth-child(6)').addClass('active');
    })
</script>


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

        <div class="view_wrap">
            <div class="top_wrap">
                <h1>문의 상세보기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('/jejo/qna_list')?>" class="btn btn-sm btn-gray">목록</a>
                    <a href="<?=base_url('/jejo/qna_list')?>" class="btn btn-sm btn-blue">저장</a>
                </div>
            </div>
            <div class="box">
                <dl class="view_form">
                    <dt>등록자</dt>
                    <dd>강유선(100001)</dd>
                </dl>
                <dl class="view_form">
                    <dt>등록일</dt>
                    <dd>2023.02.25</dd>
                </dl>
                <dl class="view_form">
                    <dt>조회수</dt>
                    <dd>8</dd>
                </dl>
                <dl class="view_form">
                    <dt>전화번호</dt>
                    <dd>010-9369-6878</dd>
                </dl>
                <dl class="view_form">
                    <dt>휴대폰</dt>
                    <dd>010-9369-6878</dd>
                </dl>
                <dl class="view_form">
                    <dt>이메일</dt>
                    <dd>rkddbtjs990530@naver.com</dd>
                </dl>
                <dl class="view_form">
                    <dt>첨부파일</dt>
                    <dd>0Byte.jpg(0Byte)</dd>
                </dl>
                <dl class="view_form">
                    <dt>제조사</dt>
                    <dd>-</dd>
                </dl>
                <dl class="view_form">
                    <dt>답변받기</dt>
                    <dd>sms</dd>
                </dl>
                <dl class="view_form grid_1">
                    <dt>PC사양정보</dt>
                    <dd>- 브라우저 헤더정보 : Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36
- 브라우저 코드네임 : Mozilla
- 브라우저 이름 : Netscape
- 브라우저 버전 : 5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36
- PC플랫폼 : MacIntel</dd>
                </dl>
                <dl class="view_form grid_1">
                    <dt>제목</dt>
                    <dd>불편한데 개선좀 부탁드릴게요 제발요</dd>
                </dl>
                <dl class="view_form grid_1">
                    <dt>내용</dt>
                    <dd>불편한데 개선좀 부탁드릴게요 제발요
불편한데 개선좀 부탁드릴게요 제발요
불편한데 개선좀 부탁드릴게요 제발요</dd>
                </dl>
            </div>
        </div>
        

        <div class="write_wrap">
            <div class="top_wrap">
                <h1>문의 답변</h1>
            </div>
            <div class="box">

                <div class="input_form">
                    <p>상태</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="답변완료">답변완료</option>
                            <option value="답변완료">답변완료</option>
                            <option value="답변완료">답변완료</option>
                        </select>
                    </div>
                </div>
                <div class="input_form">
                    <p>답변자</p>
                    <input type="text" placeholder="입력하세요" class="border_gray" value="조미애(jomiae)">
                </div>
                <div class="input_form">
                    <p>답변날짜</p>
                    <input type="date" placeholder="입력하세요" class="border_gray" value="2024-03-13">
                </div>
                
                <div class="input_textarea grid_1">
                    <p>답변</p>
                    
                    <textarea name="" id="" class="border_gray">안녕하세요
ㅇㅇㅇ담당자입니다.
부득이하게 ㅇㅇ해드릴수밖에 없는점 양해부탁드립니다.
감사합니다.</textarea>
                   <button class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                   </button>
                </div>
            
            </div>
        </div>
    </div>
</div>


<?php echo view('common/footer'); ?>
