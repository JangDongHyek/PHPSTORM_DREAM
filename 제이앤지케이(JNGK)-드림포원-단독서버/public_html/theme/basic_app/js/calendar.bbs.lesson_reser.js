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
        $('.cal-date').val(date);
        $('.cal-day').val(init.dayList[dayIn]);
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

        document.querySelector('.cal-month').textContent = init.monList[mm];
        document.querySelector('.cal-year').textContent = yy;
        document.querySelector('.mtb_num').textContent = yy + '년 ' + init.monList[mm] + '월';

        // -- 수정 (예약상태 표시)
        var prev_month = yy+'.'+(addZero(mm+1)); // 이전달
        var state;
        $.ajax({
            url : g5_bbs_url + "/ajax.reser_state_info.php",
            data: {year_month : prev_month, pro_mb_no : pro_mb_no, last_day : new Date(yy, mm+1, 0).getDate()},
            type: 'POST',
            dataType: 'json',
            async: false,
            success : function(data) {
                if(data){
                    state = data;
                }
            },
        });
        // -- 수정

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

                    // -- 수정 (예약상태 표시)
                    var add_class = '';
                    for(var k=0; k<state.length; k++) {
                        if (state[k]['date'] == init.addZero(countDay + 1) && markToday !== countDay + 1) {
                            if(state[k]['state'] == '예약대기') { add_class = 're_wait'; }
                            if(state[k]['state'] == '예약완료') { add_class = 're_done'; }
                            if(state[k]['state'] == '노쇼') { add_class = 'noshow'; }
                            if(state[k]['state'] == '레슨완료') { add_class = 'le_done'; }

                            state.shift();
                        }
                    }
                    trtd += '<td><div class="day ' + add_class ;

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
        $('.check_bx').html('<p>예약 가능 시간이 없습니다.</p>');
        $('#reser_time').val(''); // 날짜 재선택 시 초기화
        $('#time_set_idx').val(''); // 날짜 재선택 시 초기화
        // -- 수정

        if (e.target.classList.contains('day')) {
            if (init.activeDTag) {
                init.activeDTag.classList.remove('day-active');
            }
            day = Number(e.target.textContent);

            // -- 수정
            if((day + "").length < 2) {
                day = "0" + day;
            }
            reser_date = $('.cal-year').text()+'.'+$('.cal-month').text()+'.'+day;
            if(reser_date < today) { // 지난 일자는 이벤트 해제
                return false;
            }

            // === 20.12.31 금일부터 +일주일까지만 예약, 나머지 일자는 이벤트 해제
            var d = new Date();
            var dayOfMonth = d.getDate();
            d.setDate(dayOfMonth + 7);
            var one_week = getDateStr(d);
            if(reser_date > one_week) {
                swal('일주일 이내로 예약 가능합니다.');
                return false;
            }
            // === 금일부터 +일주일까지만 예약, 나머지 일자는 이벤트 해제

            // === 21.01.25 레슨 시작 일자 이전 시 예약 불가 알림창
            if(reser_date < $('#lesson_start_date').val()) {
                swal('레슨 시작일 전입니다.');
                return false;
            }

            // === 21.01.22 레슨 미등록 시 알림창
            if($('#lesson_idx').val() == '') {
                swal('레슨이 없습니다.');
                return false;
            }

            // === 21.01.14 종료일자 이후에는 예약 불가, 이벤트 해제
            if(reser_date > $('#lesson_end_date').val()) {
                swal('레슨이 종료되었습니다.');
                return false;
            }
            // -- 수정

            loadDate(day, e.target.cellIndex);
            e.target.classList.add('day-active');
            init.activeDTag = e.target;
            init.activeDate.setDate(day);
        }

        // 수정
        $('.lere_today').html('<span>선택한 날짜</span>'+reser_date);
        $('.lere_btn01').removeClass('hide');
        $('.lere_modify').addClass('hide');
        $('#reser_date').val(reser_date); // form
        if(reser_date != '') {
            showLoadingBar();
            $.ajax({
                url : g5_bbs_url + "/ajax.lesson_time_set.php",
                data: {reser_date : reser_date, pro_mb_no : pro_mb_no},
                type: 'POST',
                success : function(data) {
                    if(data) {
                        $('.check_bx').html(data); // 프로레슨정보(예약가능시간)
                    }

                    $('#myModal').modal('show');
                },
                complete : function() {
                    hideLoadingBar();
                }
            });
        }
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

    function getDateStr(myDate){
        var year = myDate.getFullYear();
        var month = (myDate.getMonth() + 1);
        var day = myDate.getDate();

        return  year + '.' + addZero(month) + '.' + addZero(day);
    }
});