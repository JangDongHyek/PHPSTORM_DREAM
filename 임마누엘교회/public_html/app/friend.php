<?php
$pid = "friend";
include_once("./app_head.php");

?>
    <div id="friend">
        <div class="slogan">
            <h5>IMC 교우의 소식을 들으시고<br>
                위로, 축하, 격려, 기도를 해주세요.</h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./friend_form'">소식작성하기</button>
        </div>
        <div class=" box_radius box_white">
            <h6>교우소식 보기</h6>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>구분</th>
                        <th>교구/이름</th>
                        <th>제목</th>
                        <th>시작일</th>
                        <th>종료일</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr onclick="location.href='./friend_view'">
                        <td>장례</td>
                        <td>13/안드레</td>
                        <td><p class="cut">안드레 권사 부친상</p></td>
                        <td>24.8.20</td>
                        <td>24.8.20</td>
                    </tr>
                    <tr onclick="location.href='./friend_view'">
                        <td>장례</td>
                        <td>13/안드레</td>
                        <td><p class="cut">안드레 권사 부친상</p></td>
                        <td>24.8.20</td>
                        <td>24.8.20</td>
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

<?php
include_once("./app_tail.php");
?>