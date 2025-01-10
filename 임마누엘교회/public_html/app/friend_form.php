<?php
$pid = "friend_form";
include_once("./app_head.php");

?>
    <div id="friend" class="form">
        <div class="box_radius box_white">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <table>
                    <tbody>
                    <tr class="top">
                        <td>이름 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="이름">
                        </td>
                    </tr>
                    <tr>
                        <td>직분 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="직분">
                        </td>
                    </tr>
                    <tr>
                        <td>교구 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="교구">
                        </td>
                    </tr>
                    <tr>
                        <td>유형 <span class="txt_color">*</span></td>
                        <td>
                            <div class="gap5 select grid grid4">
                                <input type="radio" name="cate" id="c1" value="1">
                                <label class="w100" for="c1">장 례</label>
                                <input type="radio" name="cate" id="c2" value="2" checked="">
                                <label class="w100" for="c2">결 혼</label>
                                <input type="radio" name="cate" id="c3" value="3" checked="">
                                <label class="w100" for="c3">입 원</label>
                                <input type="radio" name="cate" id="c4" value="4" checked="">
                                <label class="w100" for="c4">수 술</label>
                                <input type="radio" name="cate" id="c5" value="5" checked="">
                                <label class="w100" for="c5">개 업</label>
                                <input type="radio" name="cate" id="c6" value="6" checked="">
                                <label class="w100" for="c6">출 산</label>
                                <span>
                                    <input type="radio" name="cate" id="c7" value="7" checked="">
                                    <label class="w100" for="c7">기타</label>
                                    <input type="text" placeholder="직접 입력">
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>기간 <span class="txt_color">*</span></td>
                        <td>
                            <div class="flex gap5 date">
                                <span><input type="date"> 부터</span>
                                <span><input type="date"> 까지</span>
                            </div>
                            <p class="text_left">* 기간이 만료된 소식은 자동삭제 됩니다.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>제목 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="제목">
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
                        <td>장소안내</td>
                        <td>
                            <div class="flex gap5 ai-c">
                                <input type="text" placeholder="주소입력">
                                <button type="button" class="btn btn_gray btn_h40">검색</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>마음전할곳</td>
                        <td>
                            <div class="flex gap5 ai-c">
                                <input type="text" placeholder="은행">
                                <input type="text" placeholder="예금주">
                            </div>
                            <input type="text" placeholder="계좌번호">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./friend'">등록하기</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>