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

        // -- 수정 (예약상태 표시)
        var prev_month = yy+'.'+(addZero(mm+1)); // 이전달
        var state;
        $.ajax({
            url : g5_admin_url + "/ajax.reser_info.php",
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

        // 월 이동 후 다시 금월로 돌아왔을 시 금일 레슨 표기
        // console.log(init.monList[mm]);
        // console.log(addZero(new Date().getMonth()+1));
        // prev_month == getToday('month')
        // if(init.monList[mm] == addZero(new Date().getMonth()+1)) {
        //     console.log('월 이동', getToday());
        //     $('.pt02').text(getToday()); // 일자
        //     $('.pt04').addClass('hide'); // 노쇼
        //     $.ajax({
        //         url : g5_admin_url + "/ajax.pro_lesson.php",
        //         data: {reser_date : getToday(), pro_mb_no : pro_mb_no},
        //         type: 'POST',
        //         success : function(data) {
        //             $('.psch_list ul').html(data);
        //
        //             $('.pt03').text($('.lc_count').text()+'건');
        //             if($('.lc_noshow_count').text() != '0') {
        //                 $('.pt04').removeClass('hide');
        //                 $('.pt04').text('노쇼 : ' + $('.lc_noshow_count').text()+'건');
        //             }
        //         },
        //     });
        // }
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
                trtd += '</div>';

                // -- 수정 (레슨 있는 일자 표시)
                for(var k=0; k<state.length; k++) {
                    if (state[k]['date'] == init.addZero(countDay)) {
                        trtd += '<div class="les_yes"></div>';

                        state.shift();
                    }
                }
                // -- 수정

                trtd += '</td>';
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

        if (e.target.classList.contains('day')) {
            if (init.activeDTag) {
                init.activeDTag.classList.remove('day-active');
            }
            day = Number(e.target.textContent);

            // -- 수정
            var reser_date = $('.cal-year').text()+'.'+$('.cal-month').text()+'.'+addZero(day);

            loadDate(day, e.target.cellIndex);
            $('.today').removeClass('today');
            e.target.classList.add('today');
            init.activeDTag = e.target;
            init.activeDate.setDate(day);
            $('.pt04').addClass('hide')

            // -- 수정 (선택 일자 레슨 조회(예약완료 건))
            showLoadingBar();
            $.ajax({
                url : g5_admin_url + "/ajax.pro_lesson.php",
                data: {reser_date : reser_date, pro_mb_no : pro_mb_no},
                type: 'POST',
                success : function(data) {
                    $('.psch_list ul').html(data);

                    $('.pt02').html(reser_date);
                    $('.pt03').text($('.lc_count').text()+'건');
                    if($('.lc_noshow_count').text() != '0') {
                        $('.pt04').removeClass('hide');
                        $('.pt04').text('노쇼 : ' + $('.lc_noshow_count').text()+'건');
                    }
                },
                complete : function() {
                    hideLoadingBar();
                }
            });
            // -- 수정
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
});
