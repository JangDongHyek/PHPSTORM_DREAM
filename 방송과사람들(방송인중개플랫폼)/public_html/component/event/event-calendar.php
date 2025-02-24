<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="calendar_check">
            <div class="title">
                <h6>출석하기</h6>
                <button class="attendance-btn" id="markAttendance" @click="jl.postData(row,options)">출석하기</button>
            </div>

            <div class="calendar-container">
                <div class="month-title" id="month-title">{{currentMonth}}</div>
                <div class="flex">

                    <div class="streak" id="streak-display">연속 출석 <b>{{total_attend}}일</b></div>
                    <b>
                        <span>오늘</span>
                        <span>출석</span>
                    </b>
                </div>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>일</th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th>토</th>
                        </tr>
                        </thead>

                        <tbody id="calendar-body">
                        <tr v-for="week in calendar" :key="week.id">
                            <template v-for="day in week">
                                <td  v-if="![2,7,14].includes(day.attend)" :key="day.date" :class="{'today': day.isToday, 'inactive': !day.isCurrentMonth, 'checked' : day.checked}">
                                    <p class="day-text">{{ day.date }}</p>
                                    <p v-if="day.isToday" class="special">오늘</p>
                                    <p v-else>&nbsp;</p>
                                </td>
                                <td v-else :class="{'today': day.isToday}">
                                    <i class="fa-solid fa-star" :class="'day-'+day.attend"></i>
                                    <p>{{day.attend}}일차</p>
                                </td>
                            </template>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!--calendar_check-->
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type: String, default: ""},
            primary : {type: String, default: ""},
        },
        data: function () {
            return {
                load : false,
                jl: null,
                component_idx: "",

                row: {
                    table : "event_attend",
                    user_idx : this.mb_no,
                    attend_date : "now()",

                    exists : [
                        {
                            where : [
                                {key : "user_idx", value : this.mb_no},
                                {key : "attend_date", value : "CURDATE()"}
                            ],
                            message : "오늘은 이미 출석을 완료하였습니다."
                        }
                    ],
                },
                rows : [],

                options : {
                    table : "event_attend",
                    required : [
                        {name : "user_idx",message : `로그인이 필요한 기능입니다.`},
                    ],
                    href : "",
                },

                filter : {
                    table : "",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                modal : {
                    status : false,
                    data : {},
                },

                today: '',
                currentMonth: '',
                streak: 0,
                calendar: [],
                first_day : "",
                last_day : "",

                total_attend : 0,

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.data = await this.jl.getData(this.filter);
//await this.jl.getsData(this.filter,this.arrays);
            this.initializeCalendar();

            this.load = true;
        },
        mounted() {
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            async initializeCalendar() {
                const today = new Date();
                this.today = `${today.getMonth() + 1}월 ${today.getDate()}일`;
                this.currentMonth = `${today.getMonth() + 1}월`;

                const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
                const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

                this.first_day = firstDay;
                this.last_day = lastDay;

                if(this.mb_no)  await this.jl.getsData({
                    table:"event_attend",
                    user_idx:this.mb_no,
                    between : [
                        {key : "attend_date", start : this.first_day.format(), end: this.last_day.format()}
                    ],
                },this.rows);

                let calendar = [];
                let week = [];
                const startDay = firstDay.getDay();

                // Fill empty days before the first day
                for (let i = 0; i < startDay; i++) {
                    week.push({ date: '', isCurrentMonth: false });
                }

                let total_attend = 0;

                for (let date = 1; date <= lastDay.getDate(); date++) {
                    const current = new Date(today.getFullYear(), today.getMonth(), date);
                    const isToday = current.toDateString() === today.toDateString();

                    let attend_data = this.jl.findObject(this.rows,"attend_date",current.format());
                    let checked = attend_data ? true : false;
                    let attend = 0;
                    if(attend_data) {
                        total_attend++;
                        attend = total_attend;
                    }

                    week.push({
                        date: date, isToday: isToday, isCurrentMonth: true, checked : checked,
                        attend : attend,
                    });

                    if (week.length === 7) {
                        calendar.push(week);
                        week = [];
                    }
                }

                this.total_attend = total_attend;

                // Fill empty days after the last day
                while (week.length < 7) {
                    week.push({ date: '', isCurrentMonth: false });
                }
                if (week.length) calendar.push(week);

                this.calendar = calendar;
            },
        },
        computed: {

        },
        watch: {

        }
    });

</script>

<style>

</style>