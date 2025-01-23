<?php
$pid = "inquiry";
include_once("./app_head.php");
?>
<div id="app">
    <div id="inquiry">
        <div class="slogan">
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./inquiry_form'">관리자 문의하기</button>
        </div>
        <div class="box_radius box_white">
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>날짜</th>
                        <th>상태</th>
                        <th>문의 제목</th>
                        <th>작성인</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>24.09.01</td>
                        <td class="txt_bold">접수</td>
                        <td><p class="cut" data-toggle="modal" data-target="#inquiryModal">속회소식 예시입니다.</p></td>
                        <td>작성인</td>
                    </tr>
                    <tr>
                        <td>24.09.01</td>
                        <td class="txt_blue txt_bold">완료</td>
                        <td><p class="cut" data-toggle="modal" data-target="#inquiryModal">속회소식 예시입니다.</p></td>
                        <td>작성인</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="b-pagination-outer">
                <ul id="border-pagination">


                    <li><a href="javascript:void(0)" class="active">1</a></li>
                    <li><a href="?page=2&amp;" class="">2</a></li>
                    <li><a href="?page=3&amp;" class="">3</a></li>
                    <li><a href="?page=4&amp;" class="">4</a></li>


                    <li><a href="?page=4&amp;">»</a></li>

                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade" id="inquiryModal" tabindex="-1" role="dialog" aria-labelledby="inquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="inquiryModalLabel">문의 내용</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="icon icon_big icon_line">작성인 (1교구 1속) <b>24.01.01</b></div>
                        문의 내용
                    </div>
                    <textarea placeholder="답변 작성"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-primary">저장</button>
                </div>
            </div>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>