<?php
$pid = "equip_form";
include_once("./app_head.php");

?>
    <div id="rental" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./rental_equip'"><i class="fa-solid fa-arrow-left"></i> 비품 대여 목록</button>
        <div class="box_radius box_white table">
            <ul class="tabs">
                <li class="tab-link current" data-tab="tab-1">신청하기</li>
                <li class="tab-link" data-tab="tab-2">나의 대여 신청</li>
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
                            <td>행사장소 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
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
                            <td>수령인 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>신청자재 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                                <p class="text_left">* 수량이 2개 이상인 경우 수량도 표기해 주세요</p>
                            </td>
                        </tr>
                        <tr>
                            <td>수령일시</td>
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
                            <td>반납인 <span class="txt_color">*</span></td>
                            <td>
                                <input type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>반납일시</td>
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
                            <td>숙지사항<br>체크 <span class="txt_color">*</span></td>
                            <td class="text_left">
                                <label><input type="checkbox">1. 다음 예약을 위해 반납일시를 엄수해주시기 바랍니다.</label><br>
                                <label><input type="checkbox">2. 대여 물품이 분실, 파손 된 경우에 반드시 해당 부서에 고지하셔야 하며 수리 및 재구매로 인한 비용을 청구할 수 있습니다.</label>
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
                    <h6>위와 같이 대여를 신청합니다.</h6>
                    <p>※주의사항 : 기재해주신 연락처로 확정문자를 받으셔야 예약이 확정됩니다. <br>
                        해당 일시에 예약신청이 먼저 되어 있거나 교회의 일정이 있을 경우
                        원하시는 일시에 대여가 불가할 수 있습니다.</p>
                </div>
                <br>
                <button type="button" class="btn btn_color btn-large" onclick="location.href='./rental_equip'">신청하기</button>
            </div>

            <div id="tab-2" class="tab-content">

                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>사용일</th>
                            <th>신청인</th>
                            <th>신청부서</th>
                            <th>신청자재</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr onclick="location.href='./equip_view'">
                            <td>24.09.01</td>
                            <td>전민웅 집사</td>
                            <td>제10남선교회</td>
                            <td>텐트 2</td>
                            <td>
                                <button type="button" class="btn btn_mini btn_gray">보기</button>
                            </td>
                        </tr>
                        <tr onclick="location.href='./equip_view'">
                            <td>24.09.01</td>
                            <td>전민웅 집사</td>
                            <td>제10남선교회</td>
                            <td>텐트 2</td>
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