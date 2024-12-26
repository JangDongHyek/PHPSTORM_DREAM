<?php include_once APPPATH."Views/component/summer_note_resource.php"; // summernote ?>
<!--이사업체등록-->
<section class="from">
    <form name="conform" autocomplete="off">
        <input type="hidden" name="boardType" value="cs">
        <input type="hidden" name="idx" value="<?=$boardData['idx']??0?>"/>
        <div>
            <button type="button" class="btn btn_small btn_line" onclick="location.href='<?=base_url()?>adm/cs'">목록</button>
            <button type="submit" class="btn btn_small btn_color">등록 완료</button>
        </div>
        <hr>
        <div class="box_gray">
            <div>
                <strong >옵션</strong>
                <input type="checkbox" id="chk" name="fixYn" <?= ($boardData['fix_yn'] ?? '')==='Y'? 'checked' :'' ?> value="Y">
                <label for="chk">공지 (상단고정)</label>
            </div>
            <hr>
            <div class="grid grid2">
                <dd class="flex">
                    <input type="text" name="mbName" id="mbName" value="<?=$boardData['mb_name'] ?? ''?>" placeholder="담당자명"/>
                    <input type="text" name="mbHp" id="mbHp" value="<?=$boardData['mb_hp'] ?? ''?>" data-format="tel" placeholder="담당자 연락처"/>
                </dd>
            </div>
            <br>
            <dl class="grid grid">
                <dd><input type="text" name="title" id="title" value="<?=$boardData['title'] ?? ''?>" placeholder="제목을 입력하세요."/></dd>
            </dl>
            <br>
            <div class="editor">
                <div id="editor"></div>
                <textarea name="serviceDesc" class="hidden"><?=$boardData['content']??''?></textarea>
            </div>

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

    </form>
</section>
<?php /*include_once APPPATH."Views/component/daum_addr_popup.php" */?>
<script src="<?= base_url()?>js/adm/cs_form.js?<?=JS_VER?>"></script>

<script>
    // 수정시 바인딩]
    document.addEventListener('DOMContentLoaded', () => {
        $('#editor').summernote('code', document.querySelector('[name="serviceDesc"]').value);
    })

    // submit
    //document.querySelector('[name="serviceDesc"]').value = $('#editor').summernote('code');

    $('#editor').summernote(getSummerNoteSettings('editor', true, false, true));

</script>