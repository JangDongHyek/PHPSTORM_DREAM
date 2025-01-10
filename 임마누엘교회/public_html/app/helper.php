<?php
$pid = "helper";
include_once("./app_head.php");

?>
    <div id="helper">
        <div class="slogan">
            <h5>성도들 간에 도움의 손길이 필요할 때 요청하고 자원하여<br>
                도움을 주고 받는 발론티어 커뮤니티입니다.</h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./helper_form'">요청하기</button>
        </div>
        <div class=" box_radius box_white">
            <h6>도움이 필요해요</h6>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>종류</th>
                        <th>일시</th>
                        <th>신청부서(인)</th>
                        <th>간략내용</th>
                        <th>상세내용</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr onclick="location.href='./helper_view'">
                        <td>행사보조</td>
                        <td>24.12.5 종일</td>
                        <td>제10여선교회</td>
                        <td><p class="cut">송파지방회 안내 스텝</p></td>
                        <td>
                            <button type="button" class="btn btn_mini btn_gray">보기</button>
                        </td>
                    </tr>
                    <tr onclick="location.href='./helper_view'">
                        <td>행사보조</td>
                        <td>24.12.5 종일</td>
                        <td>제10여선교회</td>
                        <td><p class="cut">송파지방회 안내 스텝</p></td>
                        <td>
                            <button type="button" class="btn btn_mini btn_gray">보기</button>
                        </td>
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