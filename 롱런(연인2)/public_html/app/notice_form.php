<?php
$pid = "notice_form";
include_once("./app_head.php");
?>
<div id="notice_form" class="board">
    <div class="frm">
        <div class="area_top">
            <select class="frm_input">
                <option>공지</option>
            </select>
            <dl>
                <dt>제목</dt>
                <dd><input type="text" class="frm_input"></dd>
            </dl>
        </div>
        <textarea placeholder="내용을 등록해주세요"></textarea>
    </div>
    <div class="ft_btn">
        <a class="btn_submit">등록하기</a>
    </div>
</div>


<?php
include_once ("./app_tail.php");
?>