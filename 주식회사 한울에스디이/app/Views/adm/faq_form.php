<!--자주묻는질문-->
</div>

<section class="from">
    <div>
        <button type="button" class="btn btn_line" onclick="location.href='./faq'">목록</button>
        <button type="button" class="btn btn_blue" onclick="postBoard()">등록 완료</button>
    </div>
    <div class="box_gray grid grid2" id="board_form">
        <input type="hidden" id="code" value="faq">
        <input type="hidden" id="idx" value="">
        <dl class="form_wrap">
            <dt>구분</dt>
            <dd>
                <select id="category">
                    <option value="주문/결제">주문/결제</option>
                    <option value="이용방법">이용방법</option>
                </select>
            </dd>
            <dt><label for="">질문</label></dt>
            <dd><input type="text" id="title" required="질문을 입력해주세요." placeholder="질문을 입력해주세요"/></dd>
            <dt><label for="">답변</label></dt>
            <dd><textarea id="content" required="답변을 입력해주세요." placeholder="답변을 입력해주세요"></textarea></dd>
        </dl>
    </div>
</section>

<? $jl->jsLoad(); ?>
<script>
    getUser()

    async function getUser() {
        let obj = jl.js.getUrlParams();
        if(!obj['idx']) return false;
        try {
            let res = await jl.ajax("get",obj,"/api/board");
            jl.js.setElement(res['data'][0]);
        }catch (e) {
            alert(e.message)
        }
    }

    async function postBoard() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("board_form");
        let method = obj['idx'] ? 'update' : 'insert';
        //let obj = jl.js.getUrlParams();
        let required = jl.js.getFormRequired("board_form")
        let options = {required : required};

        try {

            let res = await jl.ajax(method,obj,"/api/board",options);
            alert("완료되었습니다.");
            window.location.href = "./faq"
        }catch (e) {
            alert(e.message)
        }
    }
</script>