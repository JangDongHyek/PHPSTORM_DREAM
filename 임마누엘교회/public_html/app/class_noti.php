<?php
$pid = "class_noti";
include_once("./app_head.php");

?>
    <div id="class">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./class'"><i class="fa-solid fa-arrow-left"></i> 속회방 메인</button>
        <div class="box_radius box_white">
            <h6>이전 속회 소식</h6>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>날짜</th>
                        <th>내용</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr >
                        <td>24.09.01</td>
                        <td><p class="cut" data-toggle="modal" data-target="#classNotiModal">속회소식 예시입니다.</p></td>
                    </tr>
                    <tr >
                        <td>24.09.01</td>
                        <td><p class="cut" data-toggle="modal" data-target="#classNotiModal">속회소식 예시입니다.</p></td>
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

    <div class="modal fade" id="classNotiModal" tabindex="-1" role="dialog" aria-labelledby="classNotiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="classNotiModalLabel">속회보고</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <textarea placeholder="속회소식를 작성하세요." readonly></textarea>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("./app_tail.php");
?>