<?php
$pid = "class";
include_once("./app_head.php");

?>
    <div id="class" class="main">
        <div class="slogan">
            <h3>제44과</h3>
            <h2>❝<b>구원 받은 성도의 삶</b>❞</h2>
            <a  href="./file/44.pdf" download="제44과 | 구원 받은 성도의 삶.pdf" class="btn btn_color btn-large" >공부하기</a>
        </div>
        <div class="box_radius box_white">
            <h6>속회소식</h6>
            <div class="box_gray">
                <p>
                    1.속장교육 : 10월 30일 오전 11시. 목요기도회 후. 베들레헴성전<br>
                    많은 참석 바랍니다.<br>
                    2.연합속회 : 11월 7일 오전 11시. 예루살렘성전.<br>
                    연합속회 후 교구별로 점심식사가 있습니다.
                </p>
            </div>
                <div class="table">
                    <p class="flex jc-sb ai-c">
                        <b>이전 소식</b>
                        <a class="more" href="class_noti">+ 더보기</a>
                    </p>
                    <div class="table">
                        <table>
                            <tbody><!--3개만-->
                            <tr>
                                <td><p class="cut" onclick="location.href='./class_noti_view'">1.속장교육 : 10월 30일 오전 11시. 목요기도회 후. 베들레헴성전</p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="grid grid2">
                <button class="btn" type="button" onclick="location.href='./class_form'">속회보고</button>
                <button class="btn" type="button" onclick="location.href='./class_list'">속회예배현황</button>
                <button class="btn" type="button" onclick="location.href='./class_leader'">목회자탭</button>
                <button class="btn" type="button" onclick="window.open('https://www.bskorea.or.kr/bible/korbibReadpage.php')">성경읽기</button>
            </div>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>