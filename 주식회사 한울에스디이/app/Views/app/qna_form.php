<!--1:1문의-->
</div>

<section class="from">
    <div>
        <button type="button" class="btn btn-line" onclick="location.href='./qna'">목록</button>
        <button type="button" class="btn btn-blue" onclick="postBoard()">등록 완료</button>
    </div>
    <div class="box-gray" id="board_form">
        <input type="hidden" id="code" value="qna">
        <div class="form">
            <input type="text" name="title" id='title' placeholder="제목을 작성해주세요" required="제목을 작성해주세요" value="">
            <div class="editor">
                <textarea name="content" id="content" placeholder="상세 내용을 작성해 주세요" required="상세 내용을 작성해 주세요"></textarea>
            </div>
        </div>
        <div>
            <dl>
                <dd id="addFile1" style="margin-bottom: 5px;">
                    <div id="preview"></div>
                    <input type="file" id="upfile" multiple style="display: none">
                    <label for="upfile">
                        <a class="btn btn-black btn-mini">파일첨부</a>
                        <span>파일을 선택하세요..</span>
                    </label>
                </dd>
            </dl>
        </div>
    </div>
</section>

<?php $jl->jsLoad();?>

<script>
    let upfile = jl.js.hookFileEvent("upfile","preview")



    async function postBoard() {
        let obj = jl.js.getFormById("board_form");
        obj['upfiles'] = jl.js.hookFileEvent("upfile","preview")
        let required = jl.js.getFormRequired("board_form")
        let options = {required : required};

        try {
            //if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")

            let res = await jl.ajax("insert",obj,"/api/board",options);
            //this.data = res.data[0]
            alert("완료되었습니다.");
            window.location.href = "./qna";
        }catch (e) {
            alert(e.message)
        }
    }
</script>
