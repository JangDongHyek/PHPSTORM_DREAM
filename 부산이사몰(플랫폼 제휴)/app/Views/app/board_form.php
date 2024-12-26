<div id="board">

    <div class="btn_wrap">
        <a class="btn btn_small btn_color" href="./boardForm">
            등록
        </a>
    </div>

    <div class="board_form">
        <div class="box">
            <div class="form">
                <div>
                    <input type="checkbox" name="noticeYn" value="Y" id="noticeYn">
                    <label for="noticeYn">공지사항</label>&nbsp;&nbsp;
                    <input type="checkbox" name="secretYn" value="Y" id="secretYn">
                    <label for="secretYn">비밀글</label>
                </div>
                <hr>
                <input type="text" placeholder="제목을 작성해주세요">
                <div class="editor"><textarea placeholder="상세내용을 작성해주세요"></textarea></div>
            </div>
            <div>
                <dl>
                    <dd id="addFile1" style="margin-bottom: 5px;">
                        <a class="btn btn_black">파일첨부</a>
                        <span>파일을 선택하세요..</span>
                    </dd>
                    <dd id="addFile2">
                        <a class="btn btn_black">파일첨부</a>
                        <span>파일을 선택하세요..</span>
                    </dd>
                </dl>
                <input type="hidden" name="fileName[1]" value="">
                <input type="hidden" name="fileName[2]" value="">
                <input type="hidden" name="orgFileName[1]" value="">
                <input type="hidden" name="orgFileName[2]" value="">
            </div>
        </div>

    </div>



</div>
