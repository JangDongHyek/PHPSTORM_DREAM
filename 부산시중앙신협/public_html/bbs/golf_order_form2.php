<?
include_once("./_common.php");

$g5['title'] = '더스크린골프 예약';
$pid = "golf_order_form";
include_once('./_head.php');

//date_default_timezone_set('Asia/Seoul');

if($member == null || $member[mb_id] == null || $member[mb_id] == ""){
	alert("해당 서비스는 ".$level_arr["2"].",".$level_arr["3"].",".$level_arr["4"]."만 사용가능합니다.",G5_URL);
}

//조합원, vip , vvip만 사용가능

if ($member["mb_level"] <= 2){
    alert("해당 서비스는 ".$level_arr["2"].",".$level_arr["3"].",".$level_arr["4"]."만 사용가능합니다.",G5_URL);
}
//영업시간에만 열림

if($today == null || $today == ""){
	$now_date = time();
	$today = date("Y-m-d", $now_date);
} else {
	$now_date = strtotime($today . " 10:00:00");

	
}

//alert($now_date."   //   ".strtotime($today." 09:00:00")."   //   ".strtotime($today." 18:00:00") . "   //  " . strtotime($today . " 10:00:00"));

$yoil_arr = array("일","월","화","수","목","금","토");
$yoil = $yoil_arr[date('w', $now_date)];

if($member["mb_level"] < 8 ){
    if ( ($now_date < strtotime($today." 09:00:00") || $now_date > strtotime($today." 18:00:00")) || ($yoil == "토" || $yoil == "일")) {
        alert("영업일 및 영업시간(월~금 09:00~18:00, 공휴일 및 주말제외)만 예약가능합니다.", G5_URL);
    }
}

if ($private){
//    $member = get_member('maria7947');
}


$sql = "select * from `v5_holiday_list` where `date` >= '$today' order by `date` desc limit 20 ";
$re = sql_query($sql);
$holiday_list = array();
while($row = sql_fetch_array($re)){
	$row['date'] = str_replace("-","",$row['date']);

	if(str_replace("-","",$today) == $row['date']){
		alert("영업일 및 영업시간(월~금 09:00~18:00, 공휴일 및 주말제외)만 예약가능합니다.", G5_URL);
	}

	$holiday_list[] = $row['date'];
}

?>

    <link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
    <style>
        .sub_title:before{
            content:"Order"; display:block;  font-size:18px; font-weight:600; color:#3e59a8;
        }
        #ft_copy{ display:none;}
        .product_list > li {
            padding: 0;
            margin: 0 0 20px;
        }
        @media screen and (min-width:767px) {
            .sub_title:before{  font-size:22px; margin-bottom:10px;}
            #ft_copy{ display:block;}
            #ft{ display:none;}
        }
        .disable{
            color: #f1f1f1!important;
        }






        .btm_nav_box.top_ver{
            z-index: 1;
            display: none;
        }
        .btm_nav_box .link_title.ver2{
            text-align: center;
        }
    </style>

    <div id="container">
    <div id="scont">
    <!--      주문서-->
    <section class="bg_box btm_nav_box top_ver" style="display:block;">
    <div class="autoW">
        <div class="link_title ver2" data-aos="fade-down">예약하기
            <p>온라인 예약서비스로 여러분을 모십니다.</p></div>
    </div>
    <div id="members">
        <!--
            <section class="bg_section ver_golf">
                <h3 class="h3_tit elice"><span class="text-focus-in">THE</span> <span class="text-focus-in">SCREEN</span> <span class="text-focus-in">GOLF</span><p data-aos="fade-up" data-aos-delay="1000">차별화된 스크린골프 레슨 프로그램</p></h3>
                <div class="scroll-icon-box">
                    <div class="mouse">
                      <div class="wheel"></div>
                    </div>
                    <div class="dots">
                      <span class="unu"></span>
                      <span class="doi"></span>
                      <span class="trei"></span>
                    </div>
                </div>
            </section>

            <div class="sections" id="skrollr-body" data-600="z-index:2">
                <section class="tab tab1">
                    <div class="backgrounds">
                        <div class="bg bg-1-1" data-0="opacity:0;z-index:0;background:rgba(255, 255, 255, 0)" data-400="opacity:1;z-index:2;background:rgba(255, 255, 255, .3)" data-600="opacity:1;z-index:2;background:rgba(255, 255, 255, 1)"></div>
                    </div>
                </section>
            </div>
        -->


        <section class="mem01 bg_box">
            <div class="autoW">
                <form name="frm" id="frm" action="ajax.controller.php" method="post">
                    <input type="hidden" name="mode"value="golf_reserve_form">
                    <input type="hidden" name="url"value="<?=$_SERVER['REQUEST_URI']?>">
                    <input type="hidden" id="gr_date" name="gr_date">
                    <input type="hidden" id="use_point" name="use_point" value="0">

                    <div class="new_cont_text">
                        <h3>THE SCREEN GOLF</h3>
                        <div id="rev_form">
                            <dl class="section_choice">
                                <dt>1. 예약장소를 선택하세요</dt>
                                <dd>
                                    <input type="radio" id="bat01" name="gr_room" value="1" checked>
                                    <label for="bat01">타석 1</label>
                                    <input type="radio" id="bat02" name="gr_room" value="2">
                                    <label for="bat02">타석 2</label>
                                    <input type="radio" id="bat03" name="gr_room" value="3">
                                    <label for="bat03">타석 3</label>

                                    <input type="radio" id="screen01" name="gr_room" value="4">
                                    <label for="screen01">스크린룸 1</label>
                                    <input type="radio" id="screen02" name="gr_room" value="5">
                                    <label for="screen02">스크린룸 2</label>

                                </dd>
                            </dl>
                            <dl class="time_choice">
                                <dt>2. 예약할 날짜와 시간을 선택하세요</dt>
                                <dd id="calander_dd">
                                    <div id="month_top">
                                        <div class="month_tbox">
                                            <div class="mtb_arrow mtb_al btn-cal prev" id="prev">이전달</div>
                                            <div class="mtb_num"></div>
                                            <div class="mtb_arrow mtb_ar btn-cal next" id="next">다음달</div>
                                        </div>
                                        <!--.month_tbox-->
                                    </div>
                                    <!--#month_top-->
                                    <div id="calendar">
                                        <!--달력부분
                        <button type="button" class="" data-toggle="modal" data-target="#myModal">
                        날짜클릭 하면 예약모달 창
                        </button>-->

                                        <!--달력 동그라미 표시-->
                                        <div id="cal_help">
                                            <ul>
                                                <li class="ch01"><span>오늘날짜</span></li>
                                                <li class="ch02"><span>선택일자</span></li>
                                                <!--											<li class="ch03"><span>예약대기</span></li>-->
                                            </ul>
                                        </div>
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
                                                    </tbody>
                                                    <!--
                                        예약/레슨상태 별 클래스값
                                        .today    오늘날짜
                                        .re_done  예약완료
                                        .re_wait  예약대기
                                        -->
                                                </table>
                                            </div>
                                        </div>
                                        <!-- // .my-calendar -->


                                    </div>
                                    <!--#calendar-->
                                </dd>
                                <dd id="reserve_dd">
                                    <!--								<div class="date_choice">-->

                                    <!--								</div>-->

                                </dd>
                            </dl>
                            <dl class="reason_visit" id="gr_cnt_dl">
                                <dt>3. 인원을 선택하세요</dt>
                                <dd>
                                    <select name="gr_cnt">
                                        <option value="">인원</option>

                                        <?php for ($i=1; $i <=4; $i++){ ?>
                                            <option value="<?=$i?>"><?=$i?>인</option>
                                        <?php }?>
                                    </select>
                                </dd>
                            </dl>
                            <dl class="reason_visit">
                                <dt><span id="four_span">4.</span> 결제방법을 선택하세요</dt>
                                <dd>
                                    <input  type="radio" name="gr_payment_method" id="pay01_input" value="point">
                                    <label id="pay01" for="pay01_input">
                                        <span class="label_btn">포인트 결제</span>
                                    </label>

                                    <div class="pay_point_wrap" id="pay_point">
                                        <dl>
                                            <dt>현재 포인트</dt>
                                            <dd><span><?=number_format($member[mb_point])?></span>P</dd>
                                        </dl>
                                        <dl>
                                            <dt>사용 포인트</dt>
                                            <dd>-<span class="point">100</span>P</dd>
                                        </dl>
                                    </div>

                                    <input  type="radio" name="gr_payment_method" id="pay02_input" value="bank">
                                    <label id="pay02" style="display: none" for="pay02_input">무통장 입금</label>
                                    <!--                    <input type="radio" id="pay03" name="gr_payment_method" value="card">-->
                                    <!--                    <label for="pay03">카드 결제</label>-->
                                </dd>
                            </dl>
                        </div>

                        <a href="javascript:frm_submit()"  class="btn_complet">예약하기</a>
                    </div>
                </form>
                <div class="new_cont_info">
                    <div class="dlBox">
                        <dl>
                            <dt>위치</dt>
                            <dd>부산시중앙신협 본점 4층</dd>
                        </dl>
                        <dl>
                            <dt>영업시간</dt>
                            <dd>월요일 - 금요일 / 09:00 AM - 18:00 PM</dd>
                        </dl>
                        <dl>
                            <dt>문의</dt>
                            <dd>051-611-1255</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg_box btm_nav_box">
            <div class="autoW">
                <div class="link_title" data-aos="fade-down">EVENT <a href="./board.php?bo_table=event">바로가기</a></div>

                <h2 data-aos="fade-down">더골프</h2>
                <ul class="btm_nav" data-aos="fade-down" data-aos-delay="100">
                    <li><a href="./content.php?co_id=golf_center">더스크린골프</a></li>
                    <li class="on"><a href="./content.php?co_id=golf_center_res">더스크린골프 예약</a></li>
                    <li><a href="./content.php?co_id=golf_center_info">골프클럽안내</a></li>
                </ul>


            </div>
        </section>

    </div>

    <script>
        //head에서 저장한 holiday 배열 불러오기
        var holiday_list = <?php echo json_encode($holiday_list); ?>;
		var today_js = "<?=$today?>";
        $(document).ready(function () {

			var mb_level = <?=$member["mb_level"]?>;
			if(Number(mb_level) <= 2){
				swal("이용권한이 없습니다.").then(function(){
                        location.href = g5_url
                });
			}
				
            $("#bat01").click();
            //holiday_req("<?//=date("Y",strtotime(G5_TIME_YMD))?>//","<?//=date("m",strtotime(G5_TIME_YMD))?>//")
            //holiday_req("<?//=date("Y",strtotime(G5_TIME_YMD))?>//","<?//=date("m",strtotime(G5_TIME_YMD))*1 -1?>//")
            

            //휴일일 경우 페이지 접근 X
            // 수 - vvip만 접근가능
            // 목 = vip, vvip만
            // 금 = vip, vvip, 조합원 모두 가능

			for(let i=0;i<holiday_list.length; i++){
				let date = holiday_list[i];
				console.log(date);
				if(date == today_js){
					swal("영업일 및 영업시간(월~금 09:00~18:00, 공휴일 및 주말제외)만 예약가능합니다.").then(function(){
                        //location.href = g5_url
                    });
				}
			}
        });

        ///달력
        function addDays(date, days) {
            var result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
        }

        var last_ten_date = "";

		// 날짜 정보 가져오기
		var now_time = "<?=$now_date?>";
		var today = new Date(now_time*1000); // 한국 시간으로 date 객체 만들기(오늘)
		//테스트시 사용
		<?php if ($private){ ?>
		// today = addDays(today, -1);
		<?php } ?>
		var thisMonth = new Date(today.getFullYear(), today.getMonth(), today.getDate());
		// 달력에서 표기하는 날짜 객체
		var currentYear = thisMonth.getFullYear(); // 달력에서 표기하는 연
		var currentMonth = thisMonth.getMonth(); // 달력에서 표기하는 월
		var currentDate = thisMonth.getDate(); // 달력에서 표기하는 일

        function calendarInit() {
            renderCalender(thisMonth);
        }
            function renderCalender(thisMonth) {
                // 렌더링을 위한 데이터 정리
                currentYear = thisMonth.getFullYear();
                currentMonth = thisMonth.getMonth();
                currentDate = thisMonth.getDate();

				var mb_level = <?=$member["mb_level"]?>;
				

                // 이전 달의 마지막 날 날짜와 요일 구하기
                var startDay = new Date(currentYear, currentMonth, 0);
                var prevDate = startDay.getDate();
                var prevDay = startDay.getDay()+1;

                // 이번 달의 마지막날 날짜와 요일 구하기
                var endDay = new Date(currentYear, currentMonth + 1, 0);
                var nextDate = endDay.getDate();
                var nextDay = endDay.getDay()+1;


                var ten_num = 0;

				// 각 일 수 이후의 날짜를 계산합니다.
				var oneDayAfter = new Date();
				oneDayAfter.setDate(today.getDate() + 1);

				var twoDaysAfter = new Date();
				twoDaysAfter.setDate(today.getDate() + 2);

				var threeDaysAfter = new Date();
				threeDaysAfter.setDate(today.getDate() + 3);

				var fourDaysAfter = new Date();
				fourDaysAfter.setDate(today.getDate() + 4);

				// 년도, 월, 일 값을 가져와서 문자열로 변환합니다.
				var year1 = oneDayAfter.getFullYear();
				var month1 = ('0' + (oneDayAfter.getMonth() + 1)).slice(-2);
				var day1 = ('0' + oneDayAfter.getDate()).slice(-2);

				var year2 = twoDaysAfter.getFullYear();
				var month2 = ('0' + (twoDaysAfter.getMonth() + 1)).slice(-2);
				var day2 = ('0' + twoDaysAfter.getDate()).slice(-2);

				var year3 = threeDaysAfter.getFullYear();
				var month3 = ('0' + (threeDaysAfter.getMonth() + 1)).slice(-2);
				var day3 = ('0' + threeDaysAfter.getDate()).slice(-2);

				var year4 = fourDaysAfter.getFullYear();
				var month4 = ('0' + (fourDaysAfter.getMonth() + 1)).slice(-2);
				var day4 = ('0' + fourDaysAfter.getDate()).slice(-2);

				// "yyyy-mm-dd" 형식으로 날짜를 출력합니다.
				var formattedDate1 = year1 + month1 + day1;
				var formattedDate2 = year2 + month2 + day2;
				var formattedDate3 = year3 + month3 + day3;
				var formattedDate4 = year4 + month4 + day4;

				let is_ho1 = false;
				let is_ho2 = false;
				let is_ho3 = false;
				let is_ho4 = false;
				if(today.toString().indexOf("Mon") == 0 ) {
					ten_num = 4;
					for(let i=0;i<holiday_list.length; i++){
						let holiday = holiday_list[i];
						if(formattedDate1 == holiday) is_ho1 = true;
						if(formattedDate2 == holiday) is_ho2 = true;
						if(formattedDate3 == holiday) is_ho3 = true;
						if(formattedDate4 == holiday) is_ho4 = true;

						if(is_ho1 && is_ho2) {
							if(mb_level == 5){
								ten_num = 9;
							}
						}

						if(is_ho1 && is_ho2 && is_ho3) {
							if(mb_level == 4){
								ten_num = 9;
							}
						}

						if(is_ho1 && is_ho2 && is_ho3 && is_ho4) {
							if(mb_level == 3){
								ten_num = 9;
							}
						}
							
					}
				} else if(today.toString().indexOf("Tue") == 0 ) {
					ten_num = 3;
					for(let i=0;i<holiday_list.length; i++){
						let holiday = holiday_list[i];
						if(formattedDate1 == holiday) is_ho1 = true;
						if(formattedDate2 == holiday) is_ho2 = true;
						if(formattedDate3 == holiday) is_ho3 = true;
						if(formattedDate4 == holiday) is_ho4 = true;

						if(is_ho1) {
							if(mb_level == 5){
								ten_num = 8;
							}
						}

						if(is_ho1 && is_ho2) {
							if(mb_level == 4){
								ten_num = 8;
							}
						}

						if(is_ho1 && is_ho2 && is_ho3) {
							if(mb_level == 3){
								ten_num = 8;
							}
						}
							
					}
				} else if(today.toString().indexOf("Wed") == 0 ) {
					if(mb_level == 5){
						ten_num = 7;
					} else if(mb_level == 4){
						ten_num = 2;
					} else if(mb_level == 3){
						ten_num = 2;
					}

					for(let i=0;i<holiday_list.length; i++){
						let holiday = holiday_list[i];
						if(formattedDate1 == holiday) is_ho1 = true;
						if(formattedDate2 == holiday) is_ho2 = true;
						if(formattedDate3 == holiday) is_ho3 = true;
						if(formattedDate4 == holiday) is_ho4 = true;

						if(is_ho1) {
							if(mb_level == 4){
								ten_num = 7;
							}
						}

						if(is_ho1 && is_ho2) {
							if(mb_level == 3){
								ten_num = 7;
							}
						}
							
					}

				} else if(today.toString().indexOf("Thu") == 0 ) {
					if(mb_level == 5){
						ten_num = 6;
					} else if(mb_level == 4){
						ten_num = 6;
					} else if(mb_level == 3){
						ten_num = 1;
					}

					for(let i=0;i<holiday_list.length; i++){
						let holiday = holiday_list[i];
						if(formattedDate1 == holiday) is_ho1 = true;
						if(formattedDate2 == holiday) is_ho2 = true;
						if(formattedDate3 == holiday) is_ho3 = true;
						if(formattedDate4 == holiday) is_ho4 = true;

						if(is_ho1 && is_ho2) {
							if(mb_level == 3){
								ten_num = 6;
							}
						}
							
					}
				} else if(today.toString().indexOf("Fri") == 0 ) {
					ten_num = 5;
				} else if(today.toString().indexOf("Sat") == 0 ) {
					ten_num = 0;
				} else if(today.toString().indexOf("Sun") == 0 ) {
					ten_num = 0;
				}

				ten_num = ten_num + 2;


                var final_currentMonth = currentMonth + 1;
                if (final_currentMonth.toString().length == 1){
                    final_currentMonth = "0" + final_currentMonth;
                }

                //VIP

                // 현재 월 표기
                $('.mtb_num').text(currentYear + '년 ' + (currentMonth + 1)+"월");
                // 렌더링 html 요소 생성
                var html = "";

                var week = 0;
                for (var i = prevDate - prevDay + 1; i <= prevDate; i++) {
                    if (week%7 ==0){
                        html += '<tr>'
                    }
                    html += '<td><div class=" disable">' + i + '</div></td>'
                    if (week > 6){
                        html += '</tr>'
                    }
                    week ++;
                }

                // 이번달
                for (var i = 1; i <= nextDate; i++) {
                    var disable = "able_day";

                    //공휴일 X
                    var day = i;
                    if (i.toString().length == 1){
                        day = "0"+i;
                    }
                    final_date = currentYear.toString() + final_currentMonth + day;
                    var date = new Date(currentYear, currentMonth, i);

					for(let hh=0;hh<holiday_list.length; hh++){
						let holiday = holiday_list[hh];
						if (holiday == final_date){
							disable = "disable";
							break;
						}
					}

                    

                    //주말 X, 화요일에 다음달 넘어가면 ten_num 더해지는 오류있어서 화요일은 ten_num 더해지지않게함.
                    if (date.toString().indexOf("Sat") == 0 || date.toString().indexOf("Sun") == 0) {
						disable = "disable";
						if (today < date) {
							//ten_num++;
						}
					}

                    //이미 지난날 X(today 는 다른곳에서 활성화 시켜줌)
                    if (today > date) {
                        disable = "disable";
                    }


                    //영업일 10일 이내만 예약가능
                    var now = new Date();
                    var ten_date = addDays(today,ten_num);
                    if (last_ten_date != ""){
                        ten_date = last_ten_date
                    }
                    if (i == endDay.getDate() && today.getMonth() == currentMonth ){
                        last_ten_date = ten_date;
                    }

                    <?php if ($member["mb_level"] < 8 ){ ?>
                        if (date > ten_date ){
                            disable = "disable";
                        }
                    <?php } ?>

                    //tr생성
                    if (week%7 ==0){
                        html += '<tr>'
                    }
                    html += '<td><div class="day '+disable+'" >' + i + '</div></td>'

                    if (week == 6 ||week == 13 || week == 20 || week == 27 || week == 34  ){
                        html += '</tr>'
                    }
                    week ++;

                }
                // 다음달
                for (var i = 1; i <= (7 - nextDay == 7 ? 0 : 7 - nextDay); i++) {
                    //공휴일 X
                    var day = i;
                    day = ('00' + i).slice(-2);
                    var next_month = ('00' + (currentMonth+1)).slice(-2);
					if(currentMonth+2 == 13){
						next_final_date = (currentYear+1).toString() + '01' + day;
						console.log(next_final_date);
					} else {
						next_final_date = currentYear.toString() + ('00' + (currentMonth+2)).slice(-2) + day;
					}
                    
                    var date = new Date(currentYear, next_month, day);
                    disable = "able_day";

					for(let hh=0;hh<holiday_list.length; hh++){
						let holiday = holiday_list[hh];
						if (holiday == next_final_date){
							disable = "disable";
							break;
						}
					}

                    //주말 X
                    if (date.toString().indexOf("Sat") == 0 || date.toString().indexOf("Sun") == 0){
                        disable = "disable";
                    }
                    <?php if ($member["mb_level"] < 8 ){ ?>
                        if (date > last_ten_date){
                            disable = "disable";
                        }
                    <?php } ?>
                    // console.log("last_ten_date:" +next_final_date);
                    // console.log("date:" +date);
                    // console.log("disable:" + disable)
                    // console.log("date:" + date)
                    // console.log("last_ten_date:" + last_ten_date)

                    //이미 지난날 X
                    if (today > date) {
                        disable = "disable";
                    }

                    //오늘 표시
                    if (today.getFullYear()+""+ today.getMonth()+""+('00' + today.getDate()).slice(-2) ==  next_final_date){
                        disable = "able_day";

                    }

                    html += '<td><div month = "'+('00' + (currentMonth+2)).slice(-2) +'" class="day '+disable+'">' + i + '</div></td>'
                }

                $(".cal-body").html(html);

                // 오늘 날짜 표기
                if (today.getMonth() == currentMonth) {
                    todayDate = today.getDate();
                    // console.log(todayDate);
                    var currentMonthDate = document.querySelectorAll('.day');

                    currentMonthDate[todayDate -1].classList.add('today');
                    currentMonthDate[todayDate -1].classList.add('able_day');
                    currentMonthDate[todayDate -1].classList.remove('disable');

                    //쉬는날이면 막기
					for(let hh=0;hh<holiday_list.length; hh++){
						let holiday = holiday_list[hh];
						if (holiday == currentYear.toString() + final_currentMonth + ('00' +todayDate).slice(-2) >= 0){
							currentMonthDate[todayDate -1].classList.add('disable');
							currentMonthDate[todayDate -1].classList.remove('able_day');
							break;
						}
					}

                }

                $('.able_day').on('click', function() {

					let final_currentYear = currentYear;
					let final_currentMonth = currentMonth + 1;
                    var day = $(this).text();

                    $(".day").removeClass("re_done");
                    $(this).addClass("re_done");


                    if (final_currentMonth.toString().length == 1){
                        final_currentMonth = "0" + final_currentMonth;
                    }
                    if ($(this).attr("month") != undefined){
                        final_currentMonth = $(this).attr("month");
                    }

					if(final_currentMonth >= 13){
						final_currentYear = final_currentYear + 1;
						final_currentMonth = "01";
					}

                    day = ('00' + day).slice(-2);

                    $.ajax({
                        type: "POST",
                        url: g5_bbs_url+"/ajax.controller.php",
                        data: {
                            "mode": "golf_reserve_time",
                            "room": $('input[name="gr_room"]:checked').val(),
                            "date": final_currentYear+"-"+final_currentMonth+"-"+day
                        },
                        success: function(html) {

                            $("#reserve_dd").find("input:radio[name='gr_time']").remove()
                            $("#reserve_dd").find('label').remove()
                            $("#gr_date").val(final_currentYear+"-"+final_currentMonth+"-"+day);


                            $('#reserve_dd').append(html);
                        }
                    });


                });
				
            }


        ///달력끝
        var is_dup = false;
        function frm_submit(){

            if ($("#gr_date").val() < "<?=G5_TIME_YMD?>" || $("#gr_date").val() == "" ){
                swal("날짜를 다시 확인해주세요.");
                return false;
            }else if ($('input[name="gr_time"]:checked').val() == undefined ){
                swal("시간을 선택해주세요.");
                return false;
            }else if ($('[name="gr_cnt"]').val() == "" && $("[name=gr_room]:checked").val() > 3 ){
                swal("인원을 선택하세요.");
                return false;
            }else if ($('input[name="gr_payment_method"]:checked').val() == undefined ){
                swal("결제방법을 선택하세요.");
                return false;
            }

            if (is_dup){
                swal("처리중입니다. 잠시만기다려주세요.");
                return false;

            }
            is_dup = true;


            var use_point = Number($("#use_point").val());

            if(use_point != 0){

                var mb_point = "<?=$member[mb_point]?>";

                if(mb_point == ""){
                    swal("잘못된 접근입니다.");
                    return false;
                }

                if(mb_point < use_point) {
                    swal("포인트가 부족합니다.");
                    return false;
                }
            }

			var mb_level = <?=$member["mb_level"]?>;
			if(Number(mb_level) <= 2){
				swal("이용권한이 없습니다.").then(function(){
                        location.href = g5_url
                });
				return false;
			}



            $('#frm').submit();
        }
        $('[name = gr_room]').on('click',function(){
            $("#use_point").val("0");
            var val = $(this).val();
            $("[name=gr_payment_method]").attr("checked",false);
            $(".able_day").removeClass("re_done");
            $("#gr_date").val("");
            $("[name='gr_time']").attr("checked",false);
            $("#reserve_dd").html("");
            $("#pay_point").hide();
            //스크린룸
            if (val > 3){

                $("#pay02").css("display","block");
                $("#pay01").css("display","none");
                $("#gr_cnt_dl").css("display","block");
                $("#four_span").text("4.");
            }else{

                $("#pay01").css("display","block");
                $("#pay02").css("display","none");
                $("#gr_cnt_dl").css("display","none");
                $("#four_span").text("3.");
            }
        });


        $('#pay01_input').click(function(){
            $("#use_point").val(100);
            $("#pay_point").show();
        });

		// 이전달로 이동
		$("#prev").on('click', function() {
			thisMonth = new Date(currentYear, currentMonth - 1, 1);
			// holiday_req(currentYear,currentMonth - 1);
			renderCalender(thisMonth);
			$("#reserve_dd").find("input:radio[name='gr_time']").remove()
			$("#reserve_dd").find('label').remove()
		});

		// 다음달로 이동
		$("#next").on('click', function() {
			thisMonth = new Date(currentYear, currentMonth + 1, 1);
			renderCalender(thisMonth);
			$("#reserve_dd").find("input:radio[name='gr_time']").remove()
			$("#reserve_dd").find('label').remove()
		});


		calendarInit();


    </script>
<?php
include_once('./_tail.php');
?>