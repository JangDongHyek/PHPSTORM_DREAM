<?php
$pid = "note_form";
include_once("./app_head.php");

?>
    <div id="note" class="form">
        <div class="box_radius box_white table">
            <table>
                <tbody>
                <tr class="top">
                    <td>주일 말씀</td>
                    <td>
                        <input type="text" value="제자가 되는 일은 쉽지 않습니다" readonly>
                        <button type="button" class="btn btn_colorline w100">설교영상 보기</button>
                    </td>
                </tr>
                <tr>
                    <td>이번주 결단</td>
                    <td>
                        <input type="text" value="남의 험담을 하지 않겠습니다" readonly>
                    </td>
                </tr>
                <tr>
                    <td>실천 기간</td>
                    <td>
                        <input type="date" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">나의 결단내용 <span class="txt_color">*</span></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="text_left">* 150자 내외로 작성할 수 있습니다.</p>
                        <textarea placeholder="내용을 입력하세요"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>공개여부 <span class="txt_color">*</span></td>
                    <td>
                        <div class="gap5 select nowrap">
                            <input type="radio" name="view" id="v1" value="1">
                            <label class="w100" for="v1">공개</label>
                            <input type="radio" name="view" id="v2" value="3" checked="">
                            <label class="w100" for="v2">비공개</label>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./prayer'">등록하기</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>