<?php
$pid = "faq_form";
include_once("./app_head.php");

?>
    <div id="faq" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./faq'"><i class="fa-solid fa-arrow-left"></i> 자주하는질문 목록</button>
        <div class="box_radius box_white table">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>질문 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td>
                                <textarea></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>답변 <span class="txt_color">*</span></td>
                        </tr>
                        <tr>
                            <td>
                                <textarea></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./faq'">등록하기</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>