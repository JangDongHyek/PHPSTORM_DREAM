<!--1:1문의-->
</div>

<section class="board_view">

    <div class="area_top">
        <span class="btn-wrap">
        <button type="button" class="btn btn-whiteline" onclick="history.back()">목록</button>
            <!--<button class="btn btn-black" onclick="location.href='./cs.form.php'">답변</button>
        <button class="btn btn-blue2" onclick="location.href='./ad.form.php'">수정</button>-->
        </span>
    </div>
    <div class="box-gray">
        <div class="title">
            <strong><?=$board['title']?></strong>
            <div class="info">
                작성자 <p><?=$board['USER']['company_person']?>(<?=$board['USER']['user_id']?>)</p>
                작성일 <p><?=$board['insert_date']?></p>
            </div>
        </div>
        <div class="view">
            <?=nl2br(htmlspecialchars($board['content']))?>
        </div>

        <div class="download">
            <label>첨부 파일</label>
            <p>
                <? foreach($board['upfiles'] as $f) {?>
                    <a href="<?=$jl->URL.$f['src']?>" download="<?=$f['name']?>"><i class="fas fa-folder-download"></i><?=$f['name']?></a><br>
                <?}?>
            </p>
        </div>

        <div class="answer">
            <? foreach($board['REPLY']['data'] as $r) {?>
                <?
                if($r['USER']['level'] < 1) $name = "관리자";
                else $name = $r['USER']['company_person']."({$r['USER']['user_id']})";
                ?>
                <dl>
                    <dt><i class="fa-light fa-arrow-turn-down-right"></i> 작성자 <strong><?=$name?></strong> 답변일 <strong><?=$r['insert_date']?></strong>
                        <!--<a class="btn btn-mini btn-gray">수정</a>-->
                        <?if($user['idx'] == $r['user_idx']) {?>
                            <a class="btn btn-mini btn-gray" onclick="deleteReply('<?=$r['idx']?>')">삭제</a>
                        <?}?>
                    </dt>
                    <dd><?=nl2br(htmlspecialchars($r['content']))?></dd>
                </dl>
            <?}?>
            <!--<div class="answer_write">
                <textarea placeholder="답변을 등록해 주세요"></textarea>
                <a class="btn btn-blueline2">답변등록</a>
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
        <div class="editor answer_write" id="reply_form">
            <input type="hidden" id="board_idx" value="<?=$board['idx']?>">
            <div class="flex ai-c">
                <label>답변 작성</label>
            </div>
            <div class="editor">
                <textarea id="content" placeholder="답변내용을 작성해주세요" required="답변내용을 작성해주세요"></textarea>
            </div>
            <button type="button" class="btn btn-blue" onclick="postReply()">등록하기</button>
        </div>


    </div>


</section>

<?php $jl->jsLoad();?>

<script>
    async function deleteReply(idx) {
        if(!confirm("정말 삭제하시겠습니까?")) return false;
        let obj = {idx : idx}

        try {
            let res = await jl.ajax("remove",obj,"/api/board_reply");
            alert("삭제되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }

    async function postReply() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("reply_form");
        //let obj = jl.js.getUrlParams();

        let required = jl.js.getFormRequired("reply_form")
        let options = {required : required};

        try {
            //if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")

            let res = await jl.ajax("insert",obj,"/api/board_reply",options);
            alert("작성되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>