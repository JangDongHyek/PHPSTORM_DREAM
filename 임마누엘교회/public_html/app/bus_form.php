<?php
$pid = "bus_form";
include_once("./app_head.php");

?>
    <div id="rental" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_bus'"><i class="fa-solid fa-arrow-left"></i> 버스 대관 목록</button>
        <div class="box_radius box_white table">
            <ul class="tabs">
                <li class="tab-link current" data-tab="tab-1">신청하기</li>
                <li class="tab-link" data-tab="tab-2">나의 사용 신청</li>
            </ul>

            <div id="tab-1" class="tab-content current">
                <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
                <div class="table">
                    <table>
                        <tbody>
                        <tr class="top">
                            <td>신청부서 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr class="top">
                            <td>행사명 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr class="top">
                            <td>탑승인원 <span class="txt_color">*</span></td>
                            <td>
                                <input type="number">
                            </td>
                        </tr>
                        <tr>
                            <td>신청차량 <span class="txt_color">*</span></td>
                            <td>
                                <div class="gap5 select nowrap">
                                    <input type="radio" name="state" id="s1" value="1">
                                    <label class="w100" for="s1">31인승</label>
                                    <input type="radio" name="state" id="s2" value="2" checked="">
                                    <label class="w100" for="s2">24인승</label>
                                    <input type="radio" name="state" id="s3" value="3" checked="">
                                    <label class="w100" for="s3">31+24인승</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>날짜선택 <span class="txt_color">*</span></td>
                            <td>
                                <div class="date-container">
                                    <input type="date" class="date-input" aria-label="날짜 선택" />
                                    <label for="date-input" class="date-placeholder-label">날짜를 선택해주세요</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>도착행선지 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>교회출발시간 <span class="txt_color">*</span></td>
                            <td>
                                <div class="date-container">
                                    <input type="time" class="time-input" />
                                    <label for="date-input" class="date-placeholder-label">시간을 선택해주세요</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>출발행선지 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>현지출발시간 <span class="txt_color">*</span></td>
                            <td>
                                <div class="date-container">
                                    <input type="time" class="time-input" />
                                    <label for="date-input" class="date-placeholder-label">시간을 선택해주세요</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>당일외출발</td>
                            <td>
                                <div class="flex wrap">
                                    <div class="date-container">
                                        <input type="date" class="date-input" aria-label="날짜 선택" />
                                        <label for="date-input" class="date-placeholder-label">날짜를 선택해주세요</label>
                                    </div>

                                    <div class="date-container">
                                        <input type="time" class="time-input" />
                                        <label for="date-input" class="date-placeholder-label">시간을 선택해주세요</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>신청인 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>연락처 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="guide">
                    <h6>위와 같이 버스 사용을 신청합니다.</h6>
                    <p>※주의사항 : 1.기재해주신 연락처로 확정문자를 받으셔야 예약이 확정됩니다. <br>
                        해당 일시에 예약신청이 먼저 되어 있거나 필수 운행 일정이 있을 경우
                        원하시는 일시에 사용이 불가할 수 있습니다.<br>
                        2.운행비용에 대한 안내를 사무실에서 반드시 확인하시길 바랍니다.</p>
                </div>
                <br>
                <button type="button" class="btn btn_color btn-large" onclick="location.href='./rental_bus'">신청하기</button>
            </div>

            <div id="tab-2" class="tab-content">

                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>사용일</th>
                            <th>신청인</th>
                            <th>신청부서</th>
                            <th>차량</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr onclick="location.href='./bus_view'">
                            <td>24.09.01</td>
                            <td>전민웅 집사</td>
                            <td>제10남선교회</td>
                            <td>31인승</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_gray">보기</button>
                            </td>
                        </tr>
                        <tr onclick="location.href='./bus_view'">
                            <td>24.09.01</td>
                            <td>전민웅 집사</td>
                            <td>제10남선교회</td>
                            <td>31인승</td>
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
        document.addEventListener("DOMContentLoaded", function() {
            const dateInputs = document.querySelectorAll('.time-input');

            dateInputs.forEach(dateInput => {
                // 포커스 시 'hide' 클래스를 추가하여 안내 문구를 숨김
                dateInput.addEventListener('focus', () => {
                    dateInput.classList.add('filled');
                }, { once: true }); // { once: true } 옵션으로 이벤트가 한 번만 실행되도록 설정
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