<!--1:1문의-->
</div>

<section class="board_view">

    <div class="area_top">
        <span class="btn_wrap">
        <button type="button" class="btn btn_whiteline" onclick="history.back()">목록</button>
            <!--<button class="btn btn_black" onclick="location.href='./cs.form.php'">답변</button>
        <button class="btn btn_blue2" onclick="location.href='./ad.form.php'">수정</button>-->
        </span>
    </div>
    <div class="box_gray">
        <div class="title">
            <strong>자동결제가 오류가납니다</strong>
            <div class="info">
                작성자 <p>주지현(abcd33)</p>
                작성일 <p>2023.05.06</p>
            </div>
        </div>
        <div class="view">
            안녕하세요<br>

            자동결제 신청을 했는데, 자꾸 결제 오류가 납니다.<br><br>

            이미지 사진 첨부합니다. <br>
            빠른 처리 부탁드려요
        </div>

        <div class="download">
            <label>첨부 파일</label>
            <p>
                <a href=""><i class="fas fa-folder-download"></i> 결제오류이미지1.PNG</a><br>
                <a href=""><i class="fas fa-folder-download"></i> 결제오류이미지2.PNG</a><br>
            </p>
        </div>

        <div class="answer">
            <dl>
                <dt><i class="fa-light fa-arrow-turn-down-right"></i> 작성자 <strong>관리자</strong> 답변일 <strong>2023.05.07</strong><a class="btn btn_mini btn_gray">수정</a><a class="btn btn_mini btn_gray">삭제</a></dt>
                <dd>확인후 답변드리겠습니다.</dd>
            </dl>
            <!--<div class="answer_write">
                <textarea placeholder="답변을 등록해 주세요"></textarea>
                <a class="btn btn_blueline2">답변등록</a>
            </div>-->
        </div>
        <!--<div class="rqselect">
            <label><i class="fa-solid fa-message-check"></i> 진행 상태</label>
            <select name="csStatus" onchange="changeStatus()">
                <option value="0" selected="">접수완료</option>
                <option value="3">검토중</option>
                <option value="1">처리중</option>
                <option value="2">처리완료</option>
            </select>
        </div>-->
        <div class="editor answer_write">
            <div class="flex ai-c">
                <label>답변 작성</label>
            </div>
            <div class="editor">
                <textarea placeholder="답변내용을 작성해주세요"></textarea>
            </div>
            <button type="submit" class="btn btn_blue" id="btnSave">등록하기</button>
        </div>


    </div>


</section>



