<?php
$pid = "class_form";
include_once("./app_head.php");

?>
    <div id="class" class="form">
        <div class="box_radius box_white">
            <div class="table">
                <table>
                    <tbody>
                    <tr class="top">
                        <td>소속</td>
                        <td>
                            <div class="flex ai-c gap5">
                                <input type="text"> 교구
                                <input type="text"> 속
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>속장</td>
                        <td>
                            <div class="flex ai-c gap5">
                                <input type="text" placeholder="이름" required>
                                <input type="text" placeholder="직분" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>일시 <span class="txt_color">*</span></td>
                        <td>
                            <input type="date" required>
                        </td>
                    </tr>
                    <tr>
                        <td>장소 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" required>
                        </td>
                    </tr>
                    <tr>
                        <td>인원 <span class="txt_color">*</span></td>
                        <td>
                            <div class="flex ai-c gap5">
                                <input type="number" required> 명
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>헌금 <span class="txt_color">*</span></td>
                        <td>
                            <div class="flex ai-c gap5">
                                <input type="number" required> 만원
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">특이사항 <span class="txt_color">*</span></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea placeholder="내용을 입력하세요"></textarea>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./class_list_view'">등록하기</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>