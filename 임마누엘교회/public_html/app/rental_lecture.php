<?php
$pid = "rental_lecture";
include_once("./app_head.php");

?>
    <div id="rental">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental'"><i class="fa-solid fa-arrow-left"></i> 대관 신청 메인</button>
        <div class="slogan">
            <h6>15층 IMC 라운지 / 13층 단체숙소 / 드림 1,2부실 / 에벤에셀홀</h6>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./lecture_form'">신청하기</button>
        </div>
        <div class="box_radius box_white">
            <h6><i class="fa-solid fa-presentation-screen"></i> 교육관 예약현황</h6>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>사용일</th>
                        <th>신청인</th>
                        <th>신청부서</th>
                        <th>장소</th>
                        <th>관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr onclick="location.href='./lecture_view'">
                        <td>24.09.01</td>
                        <td>전민웅 집사</td>
                        <td>제10남선교회</td>
                        <td>찬양대석(좌)</td>
                        <td>
                            <button type="button" class="btn btn_mini btn_gray">보기</button>
                        </td>
                    </tr>
                    <tr onclick="location.href='./lecture_view'">
                        <td>24.09.01</td>
                        <td>전민웅 집사</td>
                        <td>제10남선교회</td>
                        <td>찬양대석(좌)</td>
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