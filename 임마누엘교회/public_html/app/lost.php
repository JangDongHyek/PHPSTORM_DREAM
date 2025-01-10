<?php
$pid = "lost";
include_once("./app_head.php");

?>
    <div id="lost" class="main">
        <div class="slogan">
            <button type="button" class="btn btn_colorline btn-large" onclick="location.href='./lost_report'">주웠어요</button>
            <button type="button" class="btn btn_colorline btn-large" onclick="location.href='./lost_form'">잃어버렸어요</button>
        </div>
        <div class="box_radius box_white table">
            <ul class="tabs">
                <li class="tab-link current" data-tab="tab-1">보관된 분실물</li>
                <li class="tab-link" data-tab="tab-2">신고된 분실물</li>
            </ul>

            <div id="tab-1" class="tab-content current">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>품목</th>
                            <th>습득일</th>
                            <th>습득장소</th>
                            <th>처리상태</th>
                            <th>상세</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr onclick="location.href='./lost_view'">
                            <td>품목</td>
                            <td>24.09.01</td>
                            <td>습득장소</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_red">보관중</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn_mini btn_gray">보기</button>
                            </td>
                        </tr>
                        <tr onclick="location.href='./lost_view'">
                            <td>품목</td>
                            <td>24.09.01</td>
                            <td>습득장소</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_blue">인계완료</button>
                            </td>
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

            <div id="tab-2" class="tab-content">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>품목</th>
                            <th>분실일</th>
                            <th>분실장소</th>
                            <th>처리상태</th>
                            <th>상세</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr onclick="location.href='./lost_view'">
                            <td>품목</td>
                            <td>24.09.01</td>
                            <td>분실장소</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_red">신고중</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn_mini btn_gray">보기</button>
                            </td>
                        </tr>
                        <tr onclick="location.href='./lost_view'">
                            <td>품목</td>
                            <td>24.09.01</td>
                            <td>분실장소</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_blue">찾았어요</button>
                            </td>
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
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInputs = document.querySelectorAll('.date-input');

            dateInputs.forEach(dateInput => {
                // 포커스 시 'hide' 클래스를 추가하여 안내 문구를 숨김
                dateInput.addEventListener('focus', () => {
                    dateInput.classList.add('filled');
                }, { once: true }); // { once: true } 옵션으로 이벤트가 한 번만 실행되도록 설정
            });
        });
    </script>

    <script>
        // 모든 테이블의 tbody 내 td 요소를 대상으로 클릭 이벤트 추가
        document.querySelectorAll("table.click tbody tr").forEach(row => {
            row.querySelectorAll("td:not(:first-child)").forEach(cell => {
                // "disabled" 클래스를 가진 셀은 클릭 불가
                if (!cell.classList.contains("disabled")) {
                    cell.addEventListener("click", () => {
                        cell.classList.toggle("selected"); // 선택 상태 토글
                    });
                }
            });
        });
    </script>

<script>
    $(document).ready(function(){

        $('ul.tabs li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        })

    })

</script>
<?php
include_once("./app_tail.php");
?>