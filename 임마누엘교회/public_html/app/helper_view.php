<?php
$pid = "helper_view";
include_once("./app_head.php");

?>
    <div id="helper" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./helper'"><i class="fa-solid fa-arrow-left"></i> 도우미 목록</button>
        <div class="box_radius box_white table">
            <p></p>
            <h6 class="txt_color"><b class="icon icon_color">행사보조</b> 제10여선교회</h6>
            <p class="txt_bold">기간 | 24.12.5 종일</p>
            <hr>
            <h6>송파지방회 안내 스탭</h6><!--제목-->
            <div class="cont"><!--내용-->
                <p style="white-space: pre-line">-송파지방회에 참석하시는 손님들을 맞이하고
                    안내해드릴 봉사자를 모집합니다.
                    -단정한 복장이 필요합니다.
                    -봉사시간 : 오전 9시~오후 3시
                </p>
            </div>
            <hr>
            <p class="flex gap10">
                <b class="icon icon_gray w100px">요청자</b> 이자영 권사
            </p>
            <p class="flex gap10">
                <b class="icon icon_gray w100px">연락처</b> 010-0000-0000
            </p>
            <p class="flex gap10">
                <b class="icon icon_gray w100px">지원마감</b> 24.12.3
            </p>
            <br>
            <button class="btn btn_large btn_blue" type="button" data-toggle="modal" data-target="#helpModal">지원하기</button>
            <br>
            <br>
            <div class="flex gap10">
                <button class="btn w100 btn_line" type="button">수정</button>
                <button class="btn w100 btn_red2" type="button">종료</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="helpModalLabel">지원하기</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>이름</label>
                    <input type="text">
                    <label>연락처</label>
                    <input type="text">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn txt_color">지원</button>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("./app_tail.php");
?>