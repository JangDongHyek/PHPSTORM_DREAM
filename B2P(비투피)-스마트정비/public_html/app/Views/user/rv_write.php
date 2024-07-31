<?php
echo view('common/header_user');
echo view('common/user_head');
?>


<div id="<?php echo $pid ?>">
    <div class="user_con">
        <dl class="input_form">
            <dt class="input_title">지점선택</dt>
            <dd>
                <div class="input_select">
                    <select class="border_gray">
                        <option value="시/도">시/도</option>
                        <option value="서울시">서울시</option>
                    </select>
                </div>
                <div class="input_select">
                    <select class="border_gray">
                        <option value="구/면/읍">구/면/읍</option>
                        <option value="영등포구">영등포구</option>
                    </select>
                </div>
                <div class="input_select" onclick="select_shop_modal();">
                    <select class="border_gray">
                        <option value="지점선택">지점선택</option>
                    </select>
                </div>
            </dd>
        </dl>

    </div>
    <dl class="data_form">
        <dt>
            <h6 class="input_title">예약일 선택</h6>
            <div class="table-caption">
                <div class="today">
                    <span class="circle"></span>
                    <p>오늘</p>
                </div>
                <div class="rv-se">
                    <span class="circle"></span>
                    <p>예약선택</p>
                </div>
                <div class="rv-ok">
                    <span class="circle"></span>
                    <p>예약가능</p>
                </div>
            </div>
        </dt>

        <dd>
        <dd id="calander_dd">
            <div id="month_top">
                <div class="month_tbox">
                    <div class="mtb_arrow mtb_al btn-cal prev" id="prev"><i class="fa-regular fa-chevron-left"></i></div>
                    <div class="mtb_num">2024년 4월</div>
                    <div class="mtb_arrow mtb_ar btn-cal next" id="next"><i class="fa-regular fa-chevron-right"></i></div>
                </div>
                <!--.month_tbox-->
            </div>
            <!--#month_top-->
            <div id="calendar">
                <!--#cal_help-->
                <div class="my-calendar clearfix">
                    <!--<div class="clicked-date">
                                    <div class="cal-day"></div>
                                    <div class="cal-date"></div>
                                </div>-->
                    <div class="calendar-box">
                        <div class="ctr-box clearfix" style="display: none;">
                            <button type="button" title="prev" class="btn-cal prev">
                            </button>
                            <span class="cal-year"></span>년
                            <span class="cal-month"></span>월
                            <button type="button" title="next" class="btn-cal next">
                            </button>
                        </div>
                        <table class="cal-table">
                            <thead>
                                <tr>
                                    <th>일</th>
                                    <th>월</th>
                                    <th>화</th>
                                    <th>수</th>
                                    <th>목</th>
                                    <th>금</th>
                                    <th>토</th>
                                </tr>
                            </thead>
                            <tbody class="cal-body">
                                <tr>
                                    <td>
                                        <div class="day disable">31</div>
                                    </td>
                                    <td>
                                        <div class="day disable">1</div>
                                    </td>
                                    <td>
                                        <div class="day disable">2</div>
                                    </td>
                                    <td>
                                        <div class="day disable">3</div>
                                    </td>
                                    <td>
                                        <div class="day disable">4</div>
                                    </td>
                                    <td>
                                        <div class="day disable">5</div>
                                    </td>
                                    <td>
                                        <div class="day disable">6</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="day disable">7</div>
                                    </td>
                                    <td>
                                        <div class="day disable">8</div>
                                    </td>
                                    <td>
                                        <div class="day disable">9</div>
                                    </td>
                                    <td>
                                        <div class="day disable">10</div>
                                    </td>
                                    <td>
                                        <div class="day disable">11</div>
                                    </td>
                                    <td>
                                        <div class="day disable">12</div>
                                    </td>
                                    <td>
                                        <div class="day disable">13</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="day disable">14</div>
                                    </td>
                                    <td>
                                        <div class="day today able_day">15</div>
                                    </td>
                                    <td>
                                        <div class="day able_day">16</div>
                                    </td>
                                    <td>
                                        <div class="day able_day">17</div>
                                    </td>
                                    <td>
                                        <div class="day able_day">18</div>
                                    </td>
                                    <td>
                                        <div class="day able_day">19</div>
                                    </td>
                                    <td>
                                        <div class="day disable">20</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="day disable">21</div>
                                    </td>
                                    <td>
                                        <div class="day able_day">22</div>
                                    </td>
                                    <td>
                                        <div class="day able_day">23</div>
                                    </td>
                                    <td>
                                        <div class="day able_day">24</div>
                                    </td>
                                    <td>
                                        <div class="day able_day re_se">25</div>
                                    </td>
                                    <td>
                                        <div class="day able_day re_ok">26</div>
                                    </td>
                                    <td>
                                        <div class="day disable">27</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="day disable">28</div>
                                    </td>
                                    <td>
                                        <div class="day able_day re_ok">29</div>
                                    </td>
                                    <td>
                                        <div class="day able_day">30</div>
                                    </td>
                                    <td>
                                        <div month="05" class="day able_day">1</div>
                                    </td>
                                    <td>
                                        <div month="05" class="day able_day">2</div>
                                    </td>
                                    <td>
                                        <div month="05" class="day able_day">3</div>
                                    </td>
                                    <td>
                                        <div month="05" class="day disable">4</div>
                                    </td>
                                </tr>
                            </tbody>
                            <!--
                                        상태 별 클래스값
                                        .today    오늘날짜
                                        .re_se  예약선택
                                        .re_ok  예약가능
                                        -->
                        </table>
                    </div>
                </div>
                <!-- // .my-calendar -->


            </div>
            <!--#calendar-->
        </dd>
        <dd id="reserve_dd">
            <input type="radio" id="time01" name="rv_time" >
            <label for="time01">
                <div class="tit">
                    영등포점<span class="color-gray">2023.12.12</span>
                </div>
                <div class="color-blue">09:00</div>
            </label>

            <input class="" type="radio" id="time02" name="rv_time" >
            <label for="time02">
                <div class="tit">
                    영등포점<span class="color-gray">2023.12.12</span>
                </div>
                <div class="color-blue">10:00</div>
            </label>

           
<!--           선택불가시간 .disable-->
            <input class="disable" disabled="" type="radio" id="time03" name="rv_time" >
            <label class="disable" for="time03">
                <div class="tit">
                    영등포점<span class="color-gray">2023.12.12</span>
                </div>
                <div class="color-blue">11:00</div>
            </label>
            
            

            <input class="" type="radio" id="time04" name="rv_time" >
            <label for="time04">
                <div class="tit">
                    영등포점<span class="color-gray">2023.12.12</span>
                </div>
                <div class="color-blue">12:00</div>
            </label>
        </dd>
    </dl>

    <div class="rv_conrim_form">
        <h6 class="input_title">정비내역</h6>
        <dl>
            <dd>
                <span>정비내역</span>
                <span class="color-gray">100256</span>
            </dd>
            <dd>
                <span>부품코드</span>
                <span class="color-gray">S1025</span>
            </dd>
            <dd>
                <span>상품명</span>
                <span class="color-gray">브레이크 패드</span>
            </dd>
            <dd>
                <span>정비시간</span>
                <span class="color-gray">2023.12.12 09:00</span>
            </dd>
        </dl>
        <dl>
            <dd>
                <span>지점</span>
                <span class="color-gray">오토 오이시스 영등포점 (A503)</span>
            </dd>
            <dd>
                <span>주소</span>
                <span class="color-gray">서울시 영등포구 제일 영등포점 신기로 401</span>
            </dd>
            <dd>
                <span>전화번호</span>
                <span class="color-gray">02-232-2323</span>
            </dd>
        </dl>
    </div>

    <div class="user_info_form">
        <h6 class="input_title">예약정보 입력</h6>
        <dl class="input_form">
            <dt>예약자명<span class="text-sm color-blue">필수</span></dt>
            <dd>
                <div class="input_form input_text">
                    <input type="text" placeholder="입력하세요" class="border_gray" value="강남철">
                </div>
            </dd>
        </dl>
        <dl class="input_form">
            <dt>핸드폰번호<span class="text-sm color-blue">필수</span></dt>
            <dd>
                <div class="input_form input_text">
                    <input type="text" placeholder="입력하세요" class="border_gray" value="010-1234-5678">
                </div>
            </dd>
        </dl>
        <dl class="input_form">
            <dt>차량번호<span class="text-sm color-blue">필수</span></dt>
            <dd>
                <div class="input_form input_text">
                    <input type="text" placeholder="입력하세요" class="border_gray" value="가1234">
                </div>
            </dd>
        </dl>
        <dl class="input_form">
            <dt>비고</dt>
            <dd>
                <div class="input_form input_text">
                    <textarea name="" id="" placeholder="기타사항이 있으시면 남겨주세요" class="border_gray"></textarea>
                </div>
            </dd>
        </dl>
    </div>


    <a class="btn btn-blue" onclick="rv_agr_modal();">예약하기</a>
</div>



<script>
    
    //달력 예약선택
    $('.able_day').on('click', function() {
        $(".day").removeClass("re_se");
        $(this).addClass("re_se");
    });

</script>



<?php
echo view('common/user_tail');
echo view('common/footer');
?>
