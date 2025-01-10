<?php
$pid = "prayer";
include_once("./app_head.php");

?>
    <div id="prayer">
        <div class="slogan">
            <h5>이와 같이 성령도 우리의 연약함을 도우시나니 우리는 마땅히 기도할 바를 알지 못하나<br class="hidden-xs">
                오직 성령이 말할 수 없는 탄식으로 우리를 위하여 친히 간구하시느니라 <span>롬 8:26</span></h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./pray_form'">기도요청하기</button>
        </div>
        <div class="box_radius box_white">
            <h6><i class="fa-solid fa-person-praying"></i> 함께 기도해주세요!</h6>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>날짜</th>
                        <th>기도요청자</th>
                        <th>기도제목</th>
                        <th>구분</th>
                        <th>응답</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr onclick="location.href='./pray_view'">
                        <td>24.09.01</td>
                        <td>전민웅 집사</td>
                        <td><p class="cut">기도제목 예시입니다.</p></td>
                        <td>긴급</td>
                        <td>진행</td>
                    </tr>
                    <tr onclick="location.href='./pray_view'">
                        <td>24.09.01</td>
                        <td>전민웅 집사</td>
                        <td><p class="cut">기도제목 예시입니다.</p></td>
                        <td>일반</td>
                        <td>완료</td>
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