<?php
/**
 * 기본형게시판 글쓰기
 */
include_once('./_common.php');
include_once('./_board.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = $title;
include_once('../admin.head.php');

$idx = (int)$_GET['idx'];
$files = array();

if ($idx > 0) { // 수정
    $sql = "SELECT A.*, B.mb_name 
            FROM g5_bbs_basic A LEFT JOIN g5_member B ON A.writer_no = B.mb_no 
            WHERE A.del_yn = 'N' AND A.tbl_name = '{$tbl_name}' AND A.idx = '{$idx}'";
    $write = sql_fetch($sql);
    if (!$write) alert("존재하지 않는 글 입니다.");

    // 첨부파일 가져오기
    $files = getBbsFiles($tbl_name, $idx);

} else {
    $write = array();
    $write['writer_no'] = $member['mb_no'];
}

// 파라미터 str
$qstr = getQueryString($_GET, ['idx']);

// 카테고리 (칼럼만)
$category = [];
if ($tbl_name == "column") {
    $category = ['칼럼', '추천'];
}

?>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/summernote.min.css">
<script src="../js/bootstrap.min.js"></script>
<script src="../js/summernote.min.js"></script>
<script src="../js/summernote-ko-KR.js"></script>

<section id="bo_w" class="max1200">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" onsubmit="return formSubmit(this);" autocomplete="off">
        <input type="hidden" name="idx" value="<?=$idx?>">
        <input type="hidden" name="writer_no" value="<?=$write['writer_no']?>">
        <input type="hidden" name="tbl_name" value="<?=$tbl_name?>">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <colgroup>
                    <col style="width:15%" />
                    <col style="width:auto" />
                </colgroup>
                <tbody>
                <? if (count($category) > 0) { ?>
                <tr>
                    <th scope="row"><label for="category">카테고리</label></th>
                    <td>
                        <select name="category" id="category">
                            <?foreach ($category AS $key=>$val) { ?>
                            <option value="<?=$val?>" <?=$write['category']==$val? "selected" : ""?>><?=$val?></option>
                            <?}?>
                        </select>
                    </td>
                </tr>
                <? } ?>
                <tr>
                    <th scope="row"><label for="subject">제목</label></th>
                    <td>
                        <input type="text" name="subject" value="<?=$write['subject']?>" id="subject" required class="frm_input required" maxlength="200" size="100">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="content">내용</label></th>
                    <td>
                        <div id="editor"></div>
                        <textarea name="content" id="content" style="height:300px;display: none;"><?=$write['content']?></textarea>
                    </td>
                </tr>

                <? for ($i=0; $i<$file_count; $i++) { ?>
                <tr>
                    <th scope="row"><label for="file<?=$i+1?>">사진 #<?=$i+1?></label></th>
                    <td>
                        <input type="file" name="img_file[]" accept="image/*" onchange="uploadImgFiles(this)">
                        <?
                        // 업로드 파일존재
                        if ($files[$i]) {
                        ?>
                        <div class="file_rows">
                            <input type="checkbox" name="del_file[]" id="df<?=$i?>" value="<?=$files[$i]['file_name']?>">
                            <label for="df<?=$i?>"> 파일삭제</label>
                            <a target="_blank" href="<?=$files[$i]['source']?>">(<?=$files[$i]['origin_name']?>)</a>
                        </div>
                        <? } ?>
                    </td>
                </tr>
                <? } ?>

                </tbody>
            </table>
        </div>

        <div class="btn_confirm">
            <input type="submit" value="작성완료" accesskey="s" class="btn_submit">
            <button type="button" class="btn_cancel" onclick="history.back()">취소</button>
        </div>
    </form>

</section>

<script>
    $(function() {
        // summernote
        $('#editor').summernote({
            height: 300, //(mobilecheck())? 150 : 300,
            lang: 'ko-KR',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                //['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['undo', 'redo']], //'fullscreen',
            ],
            //placeholder: '상세내용을 입력해 주세요',
        });

        if (document.fwrite.idx.value != "") {
            $('#editor').summernote('code', $("textarea[name=content]").val());
        }
    });

    // 작성완료
    function formSubmit(f) {
        if (f.idx.value != "") {
            // 수정시 파일삭제 자동체크 처리
            let files = document.querySelectorAll("input[name='img_file[]']");
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                if (file.value != "") {
                    let del = $(file).parent("td").find("[name='del_file[]']");
                    del.prop("checked", true);
                }
            }
        }

        // summernote bind
        f.content.value = $('#editor').summernote('code');

        // ajax submit
        let frmData = new FormData($(f)[0]);
        frmData.append("mode", "basicWrite");

        $.ajax({
            url: "./ajax.board_update.php",
            data: frmData,
            type: "POST",
            async: false,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
        }).done(function(response, textStatus, xhr) {
            let data = JSON.parse(response);
            // console.log(data);
            if (data.result) {
                location.href = "./list.php?<?=$qstr?>";
            } else {
                alert("등록에 실패했습니다. 잠시 후 다시 시도해 주세요.");
            }
        }).fail(function(data, textStatus, errorThrown) {
            console.log("[serverUploadImage] : [error] : ", xhr);
            alert("등록에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        });

        return false;
    }
</script>

<?php
include_once ('../admin.tail.php');
?>
