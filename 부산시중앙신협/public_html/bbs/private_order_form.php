<?
include_once("./_common.php");

$g5['title'] = '프라이빗 방문예약';
$pid = "private_order_form";
include_once('./_head.php');

if ($member["mb_id"] != "admin"){
    alert("서비스 준비중입니다.",G5_URL);
}

if (!$is_member){
    alert("회원만 이용 가능한 서비스 입니다.",G5_BBS_URL."/login.php?url=".$_SERVER["REQUEST_URI"]);
}

if ($member["mb_level"] <= 3){
    alert("해당 서비스는 ".$level_arr["3"].",".$level_arr["4"]."만 사용가능합니다.",G5_URL);
}


?>

<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>
    .sub_title:before {
        content: "Order";
        display: block;
        font-size: 18px;
        font-weight: 600;
        color: #3e59a8;
    }

    #ft_copy {
        display: none;
    }

    .product_list>li {
        padding: 0;
        margin: 0 0 20px;
    }


    @media screen and (min-width:767px) {
        .sub_title:before {
            font-size: 22px;
            margin-bottom: 10px;
        }

        #ft_copy {
            display: block;
        }

        #ft {
            display: none;
        }
    }

    .disable {
        color: #f1f1f1 !important;
    }

    .btm_nav_box.top_ver {
        z-index: 1;
        display: none;
    }
    .btm_nav_box .link_title.ver2{
        text-align: center;
    }

    .btm_nav_box{
        /*		display: none;*/
    }
    #members section{
        margin: 82px 0 0;
    }

    @media(max-width:1024px){
        #members section{
            margin: 60px 0 0;
        }
        #members section.bg_section{
            display: none;
        }
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
<!--	<section class="bg_section ver_priv">-->
<!--		<h3 class="h3_tit elice text-focus-in">PRIVATE CENTER<p data-aos="fade-up" data-aos-delay="1000">스마트 시스템과 사람중심의 금융 서비스를 지향하는 신협의 프라이빗 센터</p>-->
<!--		</h3>-->
<!--		<div class="scroll-icon-box">-->
<!--			<div class="mouse">-->
<!--				<div class="wheel"></div>-->
<!--			</div>-->
<!--			<div class="dots">-->
<!--				<span class="unu"></span>-->
<!--				<span class="doi"></span>-->
<!--				<span class="trei"></span>-->
<!--			</div>-->
<!--		</div>-->
<!--	</section>-->

<!--
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
				<input type="hidden" name="mode" value="private_reserve_form">
				<input type="hidden" name="url" value="<?=$_SERVER['REQUEST_URI']?>">
				<input type="hidden" name="pr_date" id="pr_date" value="">
				<div class="new_cont_text">
					<h3>PRIVATE CENTER</h3>
					<div id="rev_form">
						<dl class="section_choice">
							<dt>1. 창구를 선택하세요</dt>
                            <dd>
                                <?php for ($i = 1; $i <= count($pr_window_arr); $i++ ){ ?>
                                    <input type="radio" id="vip0<?=$i?>" name="pr_window" value="<?=$i?>" <?php if ($i == 1) echo "checked" ?> >
                                    <label for="vip0<?=$i?>"><?=$pr_window_arr[$i]?></label>
                                <?php } ?>
                            </dd>
						</dl>
						<dl class="time_choice">
							<dt>2. 예약할 날짜와 시간을 선택하세요</dt>
							<dd id="calander_dd">
								<div id="month_top">
									<div class="month_tbox">
										<div class="mtb_arrow mtb_al btn-cal prev">이전달</div>
										<div class="mtb_num"></div>
										<div class="mtb_arrow mtb_ar btn-cal next">다음달</div>
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
						<dl class="reason_visit">
							<dt>3. 방문 사유를 입력하세요</dt>
							<dd>
								<textarea name="pr_memo" id="pr_memo" placeholder="방문사유를 입력하세요"></textarea>
							</dd>
						</dl>
					</div>

					<a href="javascript:frm_submit()" class="btn_complet">예약하기</a>
				</div>
			</form>
			<div class="new_cont_info">
				<?php /*
				<a href="#" target="_blank"><img src="../theme/basic/img/sub/ico_kakao.png" alt="카카오톡"></a>
				<a href="#" target="_blank"><img src="../theme/basic/img/sub/ico_insta.png" alt="인스타그램"></a> */?>
				<div class="dlBox">
					<dl>
						<dt>위치</dt>
						<dd>부산시중앙신협 본점 </dd>
					</dl>
					<dl>
						<dt>영업시간</dt>
						<dd>월요일 - 금요일 / 09:30 AM - 16:00 PM(공휴일 제외)</dd>
					</dl>
					<dl>
						<dt>문의</dt>
						<dd>051-611-1255</dd>
					</dl>
				</div>
			</div>
		</div>
	</section>



</div>

<script>

    $(document).ready(function() {

		//reserve_time("<?//=G5_TIME_YMD?>//");
        holiday_req("<?=date("Y",strtotime(G5_TIME_YMD))?>","<?=date("m",strtotime(G5_TIME_YMD))?>")
        holiday_req("<?=date("Y",strtotime(G5_TIME_YMD))?>","<?=date("m",strtotime(G5_TIME_YMD))*1 -1?>")
        //holiday_req("<?//=date("Y",strtotime(G5_TIME_YMD))?>//","<?//=date("m",strtotime(G5_TIME_YMD))-2?>//")
        //holiday_req("<?//=date("Y",strtotime(G5_TIME_YMD))?>//","<?//=date("m",strtotime(G5_TIME_YMD))?>//")

	});
    var holiday = [];
    function holiday_req(year,month) {

        var final_currentMonth = (month*1) + 1;

        if (final_currentMonth.toString().length == 1){
            final_currentMonth = "0" + final_currentMonth;
        }
        // https://www.data.go.kr/. 2년마다 갱신해줘야함.
        var xhr = new XMLHttpRequest();
        var url = 'http://apis.data.go.kr/B090041/openapi/service/SpcdeInfoService/getRestDeInfo'; /*URL*/
        var queryParams = '?' + encodeURIComponent('serviceKey') + '='+'H9zRliq4v5OaNTv0fCijnOdMN7r05Pcb1QowiP9VgmW3Kayc4YO2owHcrgXXJVD7c1EH%2FNcEJLXrfBhLXs%2Fq8w%3D%3D'; /*Service Key*/
        queryParams += '&' + encodeURIComponent('solYear') + '=' + encodeURIComponent(year); /**/
        queryParams += '&' + encodeURIComponent('solMonth') + '=' + encodeURIComponent(final_currentMonth); /**/
        xhr.open('GET', url + queryParams);
        xhr.onreadystatechange = function () {

            if (this.readyState == 4) {
                var xml = xhr.responseXML;

                var date = xml.getElementsByTagName("locdate");
                for (var i = 0; i < date.length; i++) {
                    console.log(date[i].childNodes[0].nodeValue);

                    holiday.push(date[i].childNodes[0].nodeValue);
                }
                calendarInit();

            }
        };

        xhr.send('');
    }
	function frm_submit() {

		if ($("#pr_date").val() < "<?=G5_TIME_YMD?>" || $("#pr_date").val() == "") {
			swal("날짜를 다시 확인해주세요.");
			return false;
		} else if ($('input[name="pr_time"]:checked').val() == undefined) {
			swal("시간을 선택해주세요.");
			return false;
		} else if ($("#pr_memo").val().length == 0) {
			swal("방문사유를 입력해주세요.");
			return false;
		}

		$('#frm').submit();
	}


    //달력 만들기
    /*
        달력 렌더링 할 때 필요한 정보 목록

        현재 월(초기값 : 현재 시간)
        금월 마지막일 날짜와 요일
        전월 마지막일 날짜와 요일
    */

    function calendarInit() {

        // 날짜 정보 가져오기
        var date = new Date(); // 현재 날짜(로컬 기준) 가져오기
        var utc = date.getTime() + (date.getTimezoneOffset() * 60 * 1000); // uct 표준시 도출
        var kstGap = 9 * 60 * 60 * 1000; // 한국 kst 기준시간 더하기
        var today = new Date(utc + kstGap); // 한국 시간으로 date 객체 만들기(오늘)

        var thisMonth = new Date(today.getFullYear(), today.getMonth(), today.getDate());
        // 달력에서 표기하는 날짜 객체
        var currentYear = thisMonth.getFullYear(); // 달력에서 표기하는 연
        var currentMonth = thisMonth.getMonth(); // 달력에서 표기하는 월
        var currentDate = thisMonth.getDate(); // 달력에서 표기하는 일

        // kst 기준 현재시간
        // console.log(thisMonth);

        // 캘린더 렌더링
        renderCalender(thisMonth);

        function renderCalender(thisMonth) {

            // 렌더링을 위한 데이터 정리
            currentYear = thisMonth.getFullYear();
            currentMonth = thisMonth.getMonth();
            currentDate = thisMonth.getDate();

            // 이전 달의 마지막 날 날짜와 요일 구하기
            var startDay = new Date(currentYear, currentMonth, 0);
            var prevDate = startDay.getDate();
            var prevDay = startDay.getDay()+1;

            // 이번 달의 마지막날 날짜와 요일 구하기
            var endDay = new Date(currentYear, currentMonth + 1, 0);
            var nextDate = endDay.getDate();
            var nextDay = endDay.getDay()+1;

            //영업일 10일 이내
            var ten_num = 10;

            var final_currentMonth = currentMonth + 1;
            if (final_currentMonth.toString().length == 1){
                final_currentMonth = "0" + final_currentMonth;
            }
            // console.log(prevDate, prevDay, nextDate, nextDay);

            // 현재 월 표기
            $('.mtb_num').text(currentYear + '년 ' + (currentMonth + 1)+"월");
            // 렌더링 html 요소 생성
            var html = "";

            var week = 0;
            for (var i = prevDate - prevDay + 1; i <= prevDate; i++) {
                if (week%7 ==0){
                    html += '<tr>'
                }
                html += '<td class="prev"><div class=" disable">' + i + '</div></td>'
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
                final_date = currentYear.toString() + final_currentMonth + day
                var date = new Date(currentYear, currentMonth, i);
                if (holiday.indexOf(final_date) >= 0){
                    disable = "disable";
                    if (today < date && date.toString().indexOf("Sat") !== 0 && date.toString().indexOf("Sun") !== 0) {
                        ten_num ++;
                    }
                }

                //주말 X
                if (date.toString().indexOf("Sat") == 0 || date.toString().indexOf("Sun") == 0){
                    disable = "disable";
                    if (today < date) {
                        ten_num++;
                    }
                }

                //이미 지난날 X
                if (today > date) {
                    disable = "disable";
                }

                // 오늘 날짜 표기
                if (today.getMonth() == currentMonth) {
                    todayDate = today.getDate();
                    // console.log(todayDate);
                    var currentMonthDate = document.querySelectorAll('.day');

                    // currentMonthDate[todayDate -1].classList.add('today');
                    // currentMonthDate[todayDate -1].classList.add('able_day');
                    // currentMonthDate[todayDate -1].classList.remove('disable');

                }


                //영업일 10일 이내만 예약가능
                var now = new Date();
                var ten_date =  new Date(now.setDate(now.getDate() + ten_num));
                if (date > ten_date){
                    disable = "disable";
                }

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
                html += '<td class="next"><div class="disable">' + i + '</div></td>'
            }

            $(".cal-body").html(html);


            $('.able_day').on('click', function() {

                var day = $(this).text();

                $(".day").removeClass("re_done");
                $(this).addClass("re_done");

                var final_currentMonth = currentMonth + 1;
                if (final_currentMonth.toString().length == 1){
                    final_currentMonth = "0" + final_currentMonth;
                }
                if ((day+1).toString().length == 1){
                    day = "0"+day;
                }

                $.ajax({
                    type: "POST",
                    url: g5_bbs_url+"/ajax.controller.php",
                    data: {
                        "mode": "reserve_time",
                        "window": $('input[name="pr_window"]:checked').val(),
                        "date": currentYear+"-"+final_currentMonth+"-"+day
                    },
                    success: function(html) {

                        $("#reserve_dd").find("input:radio[name='pr_time']").remove()
                        $("#reserve_dd").find('label').remove()
                        $("#pr_date").val(currentYear+"-"+final_currentMonth+"-"+day);

                        $('#reserve_dd').append(html);
                    }
                });

            });
        }

        // 이전달로 이동
        $('.prev').on('click', function() {
            thisMonth = new Date(currentYear, currentMonth - 1, 1);
            // holiday_req(currentYear,currentMonth - 1);
            setTimeout(function () {
                renderCalender(thisMonth);
            },300);
        });

        // 다음달로 이동
        $('.next').on('click', function() {
            thisMonth = new Date(currentYear, currentMonth + 1, 1);
            // holiday_req(currentYear,currentMonth + 1);
            setTimeout(function () {
                renderCalender(thisMonth);
            },300);

        });


    }

    $("[name=pr_window]").on('click', function () {
        //동그란 링 클래스 제거
        $(".day").removeClass("re_done");
        $("#pr_date").val("");
        $('#reserve_dd').html("");
    })


</script>

<?php
//include_once('./_tail.php');
?>
