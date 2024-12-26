

<div id="board">
    <form name="faq" autocomplete="off">
        <input type="hidden" name="idx" value="<?=$faqData['idx']?>">
        <div class="btn_wrap">
            <button type="submit" class="btn btn_small btn_color">등록</button>
        </div>

        <div class="board_form">
            <div class="box">
                <div class="form">
                    <div>
                        <select name="category">
                            <option value="자주묻는질문유형" <?=($faqData['category'] === '자주묻는질문유형') ? 'selected' : ''?> >자주 묻는 질문 유형</option>
                            <option value="견적문의" <?=($faqData['category'] === '견적문의') ? 'selected' : ''?>>견적문의</option>
                            <option value="광고문의" <?=($faqData['category'] === '광고문의') ? 'selected' : ''?>>광고문의</option>
                            <option value="기타" <?=($faqData['category'] === '기타') ? 'selected' : ''?>>기타</option>
                        </select>
                    </div>
                    <hr>
                    <input type="text" name="title" value="<?=$faqData['title'] ?? ''?>" placeholder="질문을 작성해주세요">
                    <div class="editor">
                        <textarea name="content" placeholder="답변 내용을 작성해주세요"><?=$faqData['content'] ?? ''?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="<?= base_url()?>js/app/faq_form.js?<?=JS_VER?>"></script>
