<?php include_once APPPATH."Views/component/summer_note_resource.php"; // summernote ?>
<div id="board">
    <form name="board" autocomplete="off">
        <div class="btn_wrap">
            <button type="submit" class="btn btn_small btn_color">등록</button>
        </div>

        <div class="board_form">
            <input type="hidden" name="boardType" value="<?=$get['bo']?>">
            <input type="hidden" name="idx" value="<?=$boardData['idx']??0?>"/>
            <div class="box">
                <div class="form">
                    <div>
                        <input type="checkbox" name="fixYn" value="Y" <?=($boardData['fix_yn'] === 'Y') ? 'checked' : '' ?> id="noticeYn">
                        <label for="noticeYn">공지사항</label>&nbsp;&nbsp;
                        <input type="checkbox" name="secretYn" value="Y" <?=($boardData['secret_yn'] === 'Y') ? 'checked' : '' ?> id="secretYn">
                        <label for="secretYn">비밀글</label>
                    </div>
                    <hr>
                    <input type="text" name="title" placeholder="제목을 작성해주세요" value="<?=$boardData['title']?>">
                    <div class="editor">
                        <!--<textarea placeholder="상세내용을 작성해주세요"></textarea>-->
                        <div id="editor"></div>
                        <textarea name="serviceDesc" class="hidden"><?=$boardData['content']??''?></textarea>
                    </div>
                </div>
                <!--<div>
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
                </div>-->
                <div>
                    <dl>
                        <dd class="flex ai-c">
                            <input type="text" name="fileOrgName[1]" placeholder="파일을 선택하세요.." readonly value="<?=$fileData[1]['orgName']??''?>"/>
                            <label for="addFile1" class="btn btn_black btn_h40">파일첨부</label>
                        </dd>
                        <dd class="flex ai-c">
                            <input type="text" name="fileOrgName[2]" placeholder="파일을 선택하세요.." readonly value="<?=$fileData[2]['orgName']??''?>"/>
                            <label for="addFile2" class="btn btn_black btn_h40">파일첨부</label>
                        </dd>
                    </dl>
                    <input type="file" id="addFile1" class="hide"/>
                    <input type="file" id="addFile2" class="hide"/>
                    <input type="hidden" name="fileName[1]" value="<?=$fileData[1]['name']??''?>"/>
                    <input type="hidden" name="fileName[2]" value="<?=$fileData[2]['name']??''?>"/>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    // 수정시 바인딩]
    document.addEventListener('DOMContentLoaded', () => {
        $('#editor').summernote('code', document.querySelector('[name="serviceDesc"]').value);
    })

    // submit
    //document.querySelector('[name="serviceDesc"]').value = $('#editor').summernote('code');

    $('#editor').summernote(getSummerNoteSettings('editor', true, false, true));
</script>
<script src="<?= base_url()?>js/app/board_form.js?<?=JS_VER?>"></script>