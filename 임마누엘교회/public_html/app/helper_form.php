<?php
$pid = "helper_form";
include_once("./app_head.php");

?>
    <div id="helper" class="form">
        <div class="box_radius box_white">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <table>
                    <tbody>
                    <tr class="top">
                        <td>종류선택<span class="txt_color">*</span></td>
                        <td>
                            <div class="gap5 select grid grid3">
                                <input type="radio" name="cate" id="c1" value="1">
                                <label class="w100" for="c1">행사보조</label>
                                <input type="radio" name="cate" id="c2" value="2" checked="">
                                <label class="w100" for="c2">예배스탭</label>
                                <input type="radio" name="cate" id="c3" value="3" checked="">
                                <label class="w100" for="c3">식당봉사</label>
                                <input type="radio" name="cate" id="c4" value="4">
                                <label class="w100" for="c4">야외행사</label>
                                <input type="radio" name="cate" id="c5" value="5" checked="">
                                <label class="w100" for="c5">개인용무</label>
                                <input type="radio" name="cate" id="c6" value="6" checked="">
                                <label class="w100" for="c6">기타</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>신청부서(인) <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td>일시 <span class="txt_color">*</span></td>
                        <td>
                            <div class="date-container">
                                <input type="date" class="date-input" aria-label="날짜 선택" />
                                <label for="date-input" class="date-placeholder-label">날짜를 선택해주세요</label>
                            </div>
                            <div class="gap5 select grid grid3">
                                <input type="radio" name="day" id="d1" value="1">
                                <label class="w100" for="d1">오전</label>
                                <input type="radio" name="day" id="d2" value="2" checked="">
                                <label class="w100" for="d2">오후</label>
                                <input type="radio" name="day" id="d3" value="3" checked="">
                                <label class="w100" for="d3">종일</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>간략내용 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="15자 내외로 작성해주세요" maxlength="15">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">상세내용 <span class="txt_color">*</span></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea placeholder="내용을 입력하세요"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>요청자 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>연락처 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>지원마감</td>
                        <td>
                            <div class="date-container">
                                <input type="date" class="date-input" aria-label="날짜 선택" />
                                <label for="date-input" class="date-placeholder-label">날짜를 선택해주세요</label>
                            </div>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./helper'">등록하기</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInputs = document.querySelectorAll('.date-input');

            dateInputs.forEach(dateInput => {
                // 포커스 시 'hide' 클래스를 추가하여 안내 문구를 숨김
                dateInput.addEventListener('focus', () => {
                    dateInput.classList.add('filled');
                }, { once: true }); // { once: true } 옵션으로 이벤트가 한 번만 실행되도록 설정
            });
        });
    </script>
<?php
include_once("./app_tail.php");
?>