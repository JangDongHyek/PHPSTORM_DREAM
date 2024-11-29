$(document).ready(function() {
    // ================================
    // START YOUR APP HERE
    // ================================
    const init = {
        monList: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
        dayList: ['일', '월', '화', '수', '목', '금', '토'],
        today: new Date(),
        monForChange: new Date().getMonth(),
        activeDate: new Date(),
        getFirstDay: (yy, mm) => new Date(yy, mm, 1),
        getLastDay: (yy, mm) => new Date(yy, mm + 1, 0),
        nextMonth: function () {
            let d = new Date();
            d.setDate(1);
            d.setMonth(++this.monForChange);
            this.activeDate = d;
            return d;
        },
        prevMonth: function () {
            let d = new Date();
            d.setDate(1);
            d.setMonth(--this.monForChange);
            this.activeDate = d;
            return d;
        },
        addZero: (num) => (num < 10) ? '0' + num : num,
        activeDTag: null,
        getIndex: function (node) {
            let index = 0;
            while (node = node.previousElementSibling) {
                index++;
            }
            return index;
        }
    };

    const $calBody = document.querySelector('.cal-body');
    const $btnNext = document.querySelector('.btn-cal.next');
    const $btnPrev = document.querySelector('.btn-cal.prev');

    /**
     * @param {number} date
     * @param {number} dayIn
     */
    function loadDate (date, dayIn) {
        // console.log(date);
        // document.querySelector('.cal-date').textContent = date;
        // document.querySelector('.cal-day').textContent = init.dayList[dayIn];
        $('.cal-date').text(date);
        $('.cal-day').text(init.dayList[dayIn]);
    }

    /**
     * @param {date} fullDate
     */
    function loadYYMM (fullDate) {
        let yy = fullDate.getFullYear();
        let mm = fullDate.getMonth();
        let firstDay = init.getFirstDay(yy, mm);
        let lastDay = init.getLastDay(yy, mm);
        let markToday;  // for marking today date

        if (mm === init.today.getMonth() && yy === init.today.getFullYear()) {
            markToday = init.today.getDate();
        }

        // document.querySelector('.cal-month').textContent = init.monList[mm];
        // document.querySelector('.cal-year').textContent = yy;
        // document.querySelector('.mtb_num').textContent = yy + '년 ' + init.monList[mm] + '월';
        $('.cal-month').text(init.monList[mm]);
        $('.cal-year').text(yy);
        $('.mtb_num').text(yy + '년 ' + init.monList[mm] + '월');

        // -- 수정
        var prev_month = yy+'.'+(addZero(mm+1)); // 이전달

        let trtd = '';
        let startCount;
        let countDay = 0;
        for (let i = 0; i < 6; i++) {
            trtd += '<tr>';
            for (let j = 0; j < 7; j++) {
                if (i === 0 && !startCount && j === firstDay.getDay()) {
                    startCount = 1;
                }
                if (!startCount) {
                    trtd += '<td>'
                } else {
                    let fullDate = yy + '.' + init.addZero(mm + 1) + '.' + init.addZero(countDay + 1);
                    trtd += '<td><div class="day';

                    // -- 수정
                    if(countDay + 1 < markToday || prev_month < getToday('month')) { // 오늘보다 이전 일자는 회색 처리 - 클래스 추가
                        trtd += ' prev" ';
                    } else {
                        trtd += (markToday && markToday === countDay + 1) ? ' today" ' : '"';
                    }
                    // -- 수정

                    trtd += ` data-date="${countDay + 1}" data-fdate="${fullDate}">`;
                }
                trtd += (startCount) ? ++countDay : '';
                if (countDay === lastDay.getDate()) {
                    startCount = 0;
                }
                trtd += '</div></td>';
            }
            trtd += '</tr>';
        }
        $calBody.innerHTML = trtd;
    }

    /**
     * @param {string} val
     */
    function createNewList (val) {
        let id = new Date().getTime() + '';
        let yy = init.activeDate.getFullYear();
        let mm = init.activeDate.getMonth() + 1;
        let dd = init.activeDate.getDate();
        const $target = $calBody.querySelector(`.day[data-date="${dd}"]`);

        let date = yy + '.' + init.addZero(mm) + '.' + init.addZero(dd);

        let eventData = {};
        eventData['date'] = date;
        eventData['memo'] = val;
        eventData['complete'] = false;
        eventData['id'] = id;
        init.event.push(eventData);
        $todoList.appendChild(createLi(id, val, date));
    }

    loadYYMM(init.today);
    loadDate(init.today.getDate(), init.today.getDay());

    $btnNext.addEventListener('click', () => loadYYMM(init.nextMonth()));
    $btnPrev.addEventListener('click', () => loadYYMM(init.prevMonth()));

    $calBody.addEventListener('click', (e) => {
        var day = '';

        // -- 수정
        var reser_date = '';
        var today = getToday();
        $('#reser_date').val('');
        $('#reser_time').val('');
        $('#pro_info_idx').val('');
        $('.lre_res').text('');
        insert_time = [];
        delete_time = [];
        // -- 수정

        if (e.target.classList.contains('day')) {
            if (init.activeDTag) {
                init.activeDTag.classList.remove('day-active');
            }
            day = Number(e.target.textContent);

            // -- 수정
            reser_date = $('.cal-year').text()+'.'+$('.cal-month').text()+'.'+addZero(day);
            /*if(reser_date < today) { // 지난 일자는 이벤트 해제
                $('.check_bx').html('<p>예약 가능 시간이 없습니다.</p>');
                return false;
            }*/
            // -- 수정

            loadDate(day, e.target.cellIndex);
            e.target.classList.add('day-active');
            init.activeDTag = e.target;
            init.activeDate.setDate(day);
        }

        // 수정
        if(reser_date != '') {
            showLoadingBar();
            $('#reser_date').val(reser_date);
            $('#start_date').val($('.cal-year').text()+'-'+$('.cal-month').text()+'-'+addZero(day));
            $('#end_date').val($('.cal-year').text()+'-'+$('.cal-month').text()+'-'+addZero(day));
            // 예약시간설정(예약가능시간)
            setTimeout(function() {
                $.ajax({
                    url : g5_admin_url + "/ajax.lesson_time_set.php",
                    data: {reser_date : reser_date, pro_mb_no : pro_mb_no},
                    type: 'POST',
                    dataType: 'html',
                    async: false,
                    success : function(data) {
                        if(data) {
                            $('.check_bx').html(data); // 예약시간설정(예약가능시간)
                        }
                        else {
                            $('.check_bx').html('<p>예약 가능 시간이 없습니다.</p>');
                        }

                        // 레슨예약자 명단
                        //getLessonReserList(reser_date);
                        //getLessonReserList(reser_date);
                        // 241108 로직바꿈 WC
                        if($('#start_date').val()){
                            getLessonReserList($('#start_date').val(),$('#end_date').val());
                        }
                    },
                    error : function(request, status, err) {
                        alert("오류가 발생하였습니다.\ncode = "+ request.status + " message = " + request.responseText + " error = " + err);
                    },
                    complete : function() {
                        hideLoadingBar();
                    }
                });
            }, 100);
        }

        /*// 프로가 설정한 예약 가능 시간
        $.ajax({
            url : g5_bbs_url + "/ajax.lesson_pro_info.php",
            data: {reser_date : reser_date, pro_mb_no : pro_mb_no, option : 'setting'},
            type: 'POST',
            success : function(data) {
                if(data){
                    $('.tset_list ul').html(data); // 프로가 설정한 예약 가능 시간

                    if($('.tset_list ul li').length != 0) {
                        $('.lre_not').addClass('hide');
                        $('.time_set').html('<a href="javascript:void(0);" onclick="reser_setting();">시간수정 <i class="fas fa-cog"></i></a>');
                    }
                }
                else{
                    $('.lre_not').removeClass('hide');
                    $('.time_set').html('<a href="javascript:void(0);" onclick="reser_setting();">시간설정 <i class="fas fa-cog"></i></a>');
                }
            },
        });*/
    });

    function getToday(op){
        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;    //1월이 0으로 되기때문에 +1을 함.
        var date = now.getDate();

        if(op == 'month') {
            return year + "." + addZero(month);
        } else {
            return year + "." + addZero(month) + "." + addZero(date);
        }
    }

    function addZero(num) {
        return (num < 10) ? '0' + num : num;
    }
});
