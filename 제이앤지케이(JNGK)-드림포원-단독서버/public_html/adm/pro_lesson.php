<?php
//$sub_menu = "210100";
include_once('./_common.php');

/**
 * 프로 - 레슨스케줄
 * 22.06.14 속도 저하로 인한 쿼리 수정 (백업본 - pro_lesson_220614bak.php)
 */

$g5['title'] .= '레슨 스케줄';
include_once('./admin.head.php');

$mb_no = $member['mb_no'];

$sql = " select count(*) as count from g5_lesson_reser as re left join g5_member as mb on mb.mb_no = re.mb_no where re.pro_mb_no = {$mb_no} and re.reser_date = date_format(curdate(), '%Y.%m.%d') and (re.reser_state = '예약완료' || re.reser_state = '노쇼') ";
$count = sql_fetch($sql)['count'];

$weekNo = sql_fetch(" select FLOOR((DATE_FORMAT(NOW(),'%d')+(DATE_FORMAT(DATE_FORMAT(NOW(),'%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month from dual; ")['week_of_month']; // 이번주의 주차

$this_sunday = sql_fetch(" SELECT ADDDATE( CURDATE(), - WEEKDAY(CURDATE()) + 6 ) as sunday from dual " )['sunday']; // 이번주의 마지막일(일요일)
$timestamp = strtotime($this_sunday . " +1 days");
$next_monday = date('Y-m-d', $timestamp); // 다음주의 첫날(월요일)
$this_ym = explode('-',$this_sunday)[0].'-'.explode('-',$this_sunday)[1];
$next_ym = explode('-',$next_monday)[0].'-'.explode('-',$next_monday)[1];
if($this_ym != $next_ym) { // 일요일과 월요일이 년월이 다를 경우
    $next_weekNo = sql_fetch(" select FLOOR((DATE_FORMAT('{$this_sunday}','%d')+(DATE_FORMAT(DATE_FORMAT('{$this_sunday}','%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month from dual; ")['week_of_month']; // 다음주의 주차
} else {
    $next_weekNo = sql_fetch(" select FLOOR((DATE_FORMAT('{$next_monday}','%d')+(DATE_FORMAT(DATE_FORMAT('{$next_monday}','%Y-%m-%01'),'%w')-1))/7)+1 as week_of_month from dual; ")['week_of_month']; // 다음주의 주차
}

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!--<script src="<?php /*echo G5_THEME_JS_URL */?>/calendar.adm.pro.js"></script>-->
<script src="<?php echo G5_THEME_JS_URL ?>/calendar.adm.pro_lesson.js?v=<?=G5_JS_VER?>"></script>
<style>
    .clearfix:after { content: ''; display: block; clear: both; float: none; }
	#pro_schedule{ border:0;}
    /* ======== Calendar ======== */
    .my-calendar {width: inherit; padding:30px 00px 0px;text-align: center; cursor: default;/* border:1px solid #ddd;*/}
    .my-calendar .clicked-date {border-radius: 25px;margin-top: 36px;float: left;width: 42%;padding: 46px 0 26px;background: #ddd;}
    .my-calendar .calendar-box {/*float: right;*/width: 100%;/*padding-left: 30px;*/}
    .clicked-date .cal-day {font-size: 24px;}
    .clicked-date .cal-date {font-size: 130px;}
    .ctr-box {padding: 0 16px; margin-bottom:25px;font-size: 30px; font-weight:bold; color:#222; position:relative;}
    .ctr-box .btn-cal {/*position: relative;float: left;*/width:40px;height:40px; border-radius:50%; font-size:25px;cursor: pointer;border: none;
	background:#eee; line-height:40px; text-align:center; outline:none; position:absolute; top:5px; left:5%;}
    .ctr-box .btn-cal:after {/*content: '<';*/position: absolute;top: 0;left: 0;width: 100%;height: 100%;line-height: 25px;font-weight: bold;font-size: 20px;}
    .ctr-box .btn-cal.next {/*float: right;*/ left:auto; right:5%;}
    .ctr-box .btn-cal.next:after {/*content: '>';*/}
    .cal-table { width: 100%;}
    .cal-table th { width: 14.2857%; padding-bottom:10px; border-bottom:1px solid #ddd; font-size: 16px; color:#999;text-align: center; font-weight:normal;}
    .cal-table td { padding:0px 0;height:75px;font-size:20px;vertical-align: middle; border:0; text-align:center; font-weight:400; position:relative;}
    .cal-table .day { position: relative;cursor: pointer;/* width:60px; height:60px;*/ line-height:60px;border-radius: 50%; margin:0 auto;}
    .cal-table .les_yes { background:#f3d421; width:7px; height:7px; border-radius:50px; position:absolute; bottom:13px; left:50%; margin-left:-3.5px;}
    .cal-table .today { background: #ffd255;border-radius: 50px;color: #fff;}
    .cal-table .prev {/* color: #c2c2c2;*/}
    .cal-table .day-active { background: #ff8585;border-radius: 50px;color: #fff;}
    .cal-table .has-event:after { content: '';display: block;position: absolute;left: 0;bottom: 0;width: 100%;height: 4px;background: #FFC107;}

    /* 주 단위 */
	.my-calendar2 .ctr-box { text-align:center; font-size:27px; position:relative;}
	.my-calendar2 .ctr-box:before{ display:block; content:""; width:10px; height:10px; border-radius:50%; background:#ffd255; position:absolute; top:15px; left:8%;}
	.my-calendar2 .ctr-box:after{ display:block; content:""; width:10px; height:10px; border-radius:50%; background:#ffd255; position:absolute; top:15px; right:8%;}
    .my-calendar2 .ctr-box .btn-cal.week-next {float: right;}
	.my-calendar2 .cal-table{ border-top:1px solid #eee; border-bottom:1px solid #eee;}
	.my-calendar2 .cal-table tr th{ padding:20px 0 0px 0; border-bottom:0;}
	.my-calendar2 .cal-table td{ height:auto; padding:5px 0 20px 0;}
    .my-calendar2 .cal-table .week-day { position: relative;cursor: pointer; width:40px; height:40px; line-height:40px;border-radius: 50%; margin:0 auto;}
    .my-calendar2 .cal-table .week-today { background: #ffd255;border-radius: 50%;color: #fff;}

    /* 레슨완료 표기 */
    #pro_sch_box .psch_list .lc_member .le_comp {
        display: inline-block;
        vertical-align: top;
        font-size: 13px;
        background: #f35f51;
        line-height: 24px;
        padding: 0 8px;
        border-radius: 20px;
        color: #fff;
    }
</style>


<div id="tab_box">
    <ul class="tab">
        <li class="current le_tab" id="tab1"><a href="javascript:void(0);" onclick="tabClick('month');">월 단위</a></li>
        <li class="le_tab" id="tab2"><a href="javascript:void(0);" onclick="tabClick('week');">주 단위</a></li>
    </ul>
</div><!--#tab_box-->


<div id="adm_width">
    <div id="pro_schedule" style="min-height: 0px !important;">

        <!-- 레슨 스케줄 - 월 단위 -->
        <div class="my-calendar clearfix month">
            <!--<div class="clicked-date">
                <div class="cal-day"></div>
                <div class="cal-date"></div>
            </div>-->
            <div class="calendar-box">
                <div class="ctr-box clearfix">
                    <button type="button" title="prev" class="btn-cal prev"><i class="far fa-angle-left"></i></button>
                    <span class="cal-year"></span>년
                    <span class="cal-month"></span>월
                    <button type="button" title="next" class="btn-cal next"><i class="far fa-angle-right"></i></button>
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
                </table>
            </div>
        </div>

        <!-- 레슨 스케줄 - 주 단위(이번주) -->
        <div class="my-calendar2 clearfix week hide">
            <div class="calendar-box">
                <div class="ctr-box clearfix">
                    <!--<button type="button" title="prev" class="btn-cal week-prev"><i class="far fa-angle-left"></i></button>-->
                    <span class="cal-week-year"></span>년
                    <span class="cal-week-month"></span>월
                    <span class="cal-week"></span>주
                    <!--<button type="button" title="next" class="btn-cal week-next"><i class="far fa-angle-right"></i></button>-->
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
                    <tbody class="cal-week-body">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 레슨 스케줄 - 주 단위(다음주) -->
        <div class="my-calendar2 clearfix week hide" style="margin-top: 50px;">
            <div class="calendar-box">
                <div class="ctr-box clearfix">
                    <!--<button type="button" title="prev" class="btn-cal week-prev"><i class="far fa-angle-left"></i></button>-->
                    <span class="cal-week-year-next"></span>년
                    <span class="cal-week-month-next"></span>월
                    <span class="cal-week_next"></span>주
                    <!--<button type="button" title="next" class="btn-cal week-next"><i class="far fa-angle-right"></i></button>-->
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
                    <tbody class="cal-week-body-next">
                    </tbody>
                </table>
            </div>
        </div>

    </div><!--#pro_schedule-->


    <div id="pro_sch_box">
        <div class="psch_today">
            <div class="pt01">선택 날짜 레슨</div>
            <div class="pt02"><?=date('Y.m.d')?></div>
            <div class="pt03"><?=$count?>건</div>
            <div class="pt04 hide"></div>
        </div><!--.psch_today-->

        <div class="psch_list">
            <!--ajax.pro_lesson-->
            <ul></ul>
        </div><!--.psch_list-->
    </div><!--#pro_sch_box-->
</div>

<script>
    var pro_mb_no = '<?=$mb_no?>';
    $(function() {
        getThisWeek();
        lessonInfo();
    });

    // 해당 주의 첫번째 일자와 마지막 일자 구함 ==> 해당 주의 일~토 일자 구함
    function getThisWeek(date, op) {
        if(date == undefined) { date = getToday(); }
        if('<?=$ios_flag?>') {
            date = date.split(".");
            var now = new Date(date[0], date[1], date[2]);
            var nowMonth = now.getMonth();
        } else {
            var now = new Date(date);
            var nowMonth = now.getMonth() + 1;
        }
        var nowDayOfWeek = now.getDay(); // 요일(?)
        var nowDay = now.getDate();
        var nowYear = now.getYear();
        nowYear += (nowYear < 2000) ? 1900 : 0;

        var prev_month = nowYear+'.'+addZero(nowMonth);
        if(op == undefined) { // 이번주
           $.ajax({
                url : g5_admin_url + "/ajax.week_calendar.php",
                data: {year_month : prev_month, pro_mb_no : pro_mb_no},
                type: 'POST',
                success : function(data) {
                    if(data){
                        $('.cal-week-body').html(data);
                    }
                },
            });
        }
        else { // 다음주
            var state;
            $.ajax({
                url : g5_admin_url + "/ajax.reser_info.php",
                data: {year_month : prev_month, pro_mb_no : pro_mb_no},
                type: 'POST',
                dataType: 'json',
                async: false,
                success : function(data) {
                    if(data){
                        state = data;
                    }
                },
            });

            // 주 일~토 일자 표시
            var html = '<tr>';
            var last = new Date(nowYear, nowMonth, 0).getDate(); // 금월 마지막일
            for(var i=0; i<7; i++) {
                var day = '';
                var add_class = '';
                if(i == 0) {
                    day = new Date(nowYear, nowMonth, nowDay).getDate(); // day = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek).getDate();
                } else {
                    day = new Date(nowYear, nowMonth, nowDay + i).getDate(); // day = new Date(nowYear, nowMonth, nowDay + (i - nowDayOfWeek)).getDate();
                }

                if(day > last) { // 금월 마지막일까지 표시 후 for문 종료
                    /*now.setDate(now.getDate() + 1);
                    var now = new Date(now);
                    var nowDayOfWeek = now.getDay(); // 요일(?)
                    var nowDay = now.getDate();
                    var nowMonth = now.getMonth() + 1;
                    var nowYear = now.getYear();*/
                    break;
                }

                if(getToday('date') == day) { // 금일에 노란색 표시
                    add_class = ' week-today ';
                }

                if('<?=$ios_flag?>') {
                    html += '<td><div class="week-day '+addZero(day)+' '+add_class+'" onclick="lessonInfo(\''+addZero(day)+'\',\'next\');">'+day+'</div>';
                }
                else {
                    html += '<td><div class="week-day '+addZero(day)+' '+add_class+'" onclick="lessonInfo(\''+addZero(day)+'\',\'next\');">'+day+'</div>';
                }

                // 레슨 있는 일자 표시
                for(var k=0; k<state.length; k++) {
                    if (state[k]['date'] == addZero(day)) {
                        html += '<div class="les_yes"></div>';

                        state.shift();
                    }
                }

                html += '</td>';
            }
            html += '</tr>';

            $('.cal-week-body-next').html(html);
        }
    }

    // 월 단위, 주 단위 탭 선택
    var tab = 'month';
    function tabClick(op) {
        if(op == 'month') {
            tab = 'month';

            $('.le_tab').removeClass('current');
            $('#tab1').addClass('current');
            $('.month').removeClass('hide');
            $('.week').addClass('hide');

            //$.getScript( '<?php echo G5_THEME_JS_URL ?>/calendar.adm.pro_lesson.js' );
            lessonInfo();
        }
        else {
            tab = 'week';

            $('.le_tab').removeClass('current');
            $('#tab2').addClass('current');
            $('.week').removeClass('hide');
            $('.month').addClass('hide');

            $('.cal-week-year').text('<?=date('Y')?>');
            $('.cal-week-month').text('<?=date('m')?>');
            $('.cal-week').text('<?=$weekNo?>'); // 몇번째 주인지 표기

            // 다음주 표기
            var next_date = '<?=$this_sunday?>'.replace(/-/gi,'.');
            $('.cal-week-year-next').text('<?=$this_sunday?>'.split('-')[0]);
            $('.cal-week-month-next').text('<?=$this_sunday?>'.split('-')[1]);
            $('.cal-week_next').text('<?=$next_weekNo?>'); // 몇번째 주인지 표기

            getThisWeek();
            getThisWeek(next_date, 'next');
            lessonInfo();
        }
    }

    // 오늘 일자 구함
    function getToday(op){
        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;    //1월이 0으로 되기때문에 +1을 함.
        var date = now.getDate();

        if(op == 'month') {
            return year + "." + addZero(month);
        } else if(op == 'date') {
            return date;
        } else {
            return year + "." + addZero(month) + "." + addZero(date);
        }
    }

    function addZero(num) {
        return (num < 10) ? '0' + num : num;
    }

    // 선택 일자 레슨 정보
    function lessonInfo(date, op) {
        // date 없으면 오늘 일자 레슨 표시
        if(date == undefined) {
            date = getToday('date');
            date = addZero(date);
        }

        $('.week-today').removeClass('week-today'); // 주단위에서 선택된 날짜

        // 이번주 다음주 구분
        var class_name = 'cal-week-body';
        if(op == 'next') { class_name = 'cal-week-body-next'; }
        if($('.week .'+class_name+' div').hasClass(date)) {
            $('.week .'+class_name+' div.'+date).addClass('week-today'); // 선택 일자 값을 가진 div에 클래스 추가
        }

        var reser_date = "";
        if(tab == 'month') reser_date = $('.cal-year').text() + '.' + $('.cal-month').text() + '.' + date; // month
        else reser_date = $('.cal-week-year').text() + '.' + $('.cal-week-month').text() + '.' + date; // week
        // console.log('date: ', date);
        // console.log('reser_date', reser_date);

        $('.pt01').text('선택 날짜 레슨');
        $('.pt02').text(reser_date);
        $.ajax({
            url : g5_admin_url + "/ajax.pro_lesson.php",
            data: {reser_date : reser_date, pro_mb_no : pro_mb_no},
            type: 'POST',
            success : function(data) {
                $('.psch_list ul').html(data);

                $('.pt03').text($('.lc_count').text()+'건');
                $('.pt04').addClass('hide'); // 노쇼
                if($('.lc_noshow_count').text() != '0') {
                    $('.pt04').removeClass('hide');
                    $('.pt04').text('노쇼 : ' + $('.lc_noshow_count').text()+'건');
                }
            },
            beforeSend : function() {
                showLoadingBar();
            },
            complete : function() {
                hideLoadingBar();
            }
        });
    }

    // 레슨일지 팝업
    function open_lesson_diary(mb_no) {
        var url = "./lesson_diary_form.php?mb_no="+mb_no+"&path=sch";

        if('<?=$ios_flag?>' || '<?=$android_flag?>') {
            location.href = url;
        }

        window.open(url, "", "left=100,top=100,width=1000,height=800,scrollbars=yes,resizable=yes");
    }
</script>

<?php
include_once('./admin.tail.php');
?>
