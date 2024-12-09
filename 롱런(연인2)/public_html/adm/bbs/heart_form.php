<?php
$sub_menu = "600200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '하트발급요청 글쓰기';
include_once('../admin.head.php');

$idx = (int)$_GET['idx'];
$file_count = 2;
$files = array();

if ($idx > 0) { // 수정
    $sql = "SELECT A.*, B.mb_name FROM g5_bbs_heart A LEFT JOIN g5_member B ON A.mb_no = B.mb_no 
            WHERE A.del_yn = 'N' AND A.idx = '{$idx}'";
    $write = sql_fetch($sql);
    if (!$write) alert("존재하지 않는 글 입니다.");

    // 첨부파일 가져오기
    $files = getBbsFiles('heart', $idx);

} else {
    $write = array();
    $write['writer_no'] = $member['mb_no'];
}

?>

<section id="bo_w" class="max1200">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" onsubmit="return formSubmit(this);" autocomplete="off">
        <input type="hidden" name="idx" value="<?=$idx?>">
        <input type="hidden" name="writer_no" value="<?=$write['writer_no']?>">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <colgroup>
                    <col style="width:15%" />
                    <col style="width:auto" />
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="subject">제목</label></th>
                    <td>
                        <input type="text" name="subject" value="<?=$write['subject']?>" id="subject" required class="frm_input required" maxlength="200" size="100">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="src_field">요청 회원명</label></th>
                    <td>
                        <!-- 회원아이디, 회원명 -->
                        <input type="hidden" name="mb_no" value="<?=$write['mb_no']?>">
                        <input type="text" name="mb_name" id="src_field" value="<?=$write['mb_name']?>" class="frm_input required" maxlength="30" placeholder="회원명 입력" required>
                        <button type="button" class="btn_frmline mb_srch" onclick="getMemberList();">회원검색</button>
                        <div id="srch_result"></div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="content">내용</label></th>
                    <td><textarea name="content" style="height:300px;"><?=$write['content']?></textarea></td>
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
    // 회원명 필드
    document.fwrite.mb_name.addEventListener("keyup", function () {
        document.fwrite.mb_no.value = "";
    });
    document.fwrite.mb_name.addEventListener("keydown", function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            getMemberList();
        }
    });

    // 작성완료
    function formSubmit(f) {
        if (f.mb_name.value == "") {
            if (confirm("회원명을 등록하지 않으셨습니다. 환불요청 등록을 하시겠습니까?") == false) {
                return false;
            }
        } else {
            if (f.mb_no.value == "") {
                alert("회원선택이 필요합니다.");
                getMemberList();
                return false;
            }
        }

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

        // ajax submit
        let frmData = new FormData($(f)[0]);
        frmData.append("mode", "heartWrite");

        
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
                location.href = "./heart.php";
            } else {
                alert("등록에 실패했습니다. 잠시 후 다시 시도해 주세요.");
            }
        }).fail(function(data, textStatus, errorThrown) {
            console.log("[serverUploadImage] : [error] : ", xhr);
            alert("등록에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        });

        return false;
    }

    // 회원명 검색
    function getMemberList() {
        var f = document.fwrite,
            mb_name = f.mb_name.value;

        if (mb_name.length < 2) {
            alert("회원명을 2자이상 입력하세요.");
            f.mb_name.focus();
            return false;
        }

        $.ajax({
            type : "post",
            url : g5_admin_url + "/ajax.member_srch.php",
            data : {"mb_name" : mb_name},
            dataType : "html",
            beforeSend : function() {
                $("#srch_result").hide().html("");
            },
            success : function(html) {
                $("#srch_result").html(html).slideDown(500);
            },
            error : function(xhr,status,error) {
                alert("검색결과를 불러오는데 실패하였습니다. 다시 시도해 주세요.");
                $("#srch_result").slideUp(500).html("");
            }
        });
    }

    // 회원명 선택
    function setMember(name, no) {
        var f = document.fwrite;
        f.mb_no.value = no;
        f.mb_name.value = name;
        $("#srch_result").slideUp(500).html("");
    }
</script>

<?php
include_once ('../admin.tail.php');
?>
