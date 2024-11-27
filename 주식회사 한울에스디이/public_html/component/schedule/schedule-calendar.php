<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section class="schedule_gant">
        <div class="gant_header">
            <template v-for="date in dates">
                <div class="period_wrap">
                    <div class="month">
                        <p>{{date}}</p>
                    </div>
                    <div class="day">
                        <ul>
                            <li v-for="item in getDaysInMonth(date)" :class="{'weekend' : isWeekend(date,item)}">{{item}}</li>
                        </ul>
                    </div>
                </div>
            </template>

        </div>
        <div class="gant_cont">
            <template v-for="YM in dates">
                <div class="column_wrap">
                    <template v-for="title in titles">
                        <div class="section_title">{{title}}</div>
                        <div class="day">
                            <ul>
                                <li v-for="D in getDaysInMonth(YM)" :class="{'weekend' : isWeekend(YM,D)}">
                                    <p>{{getItem(YM,D,title,'memo')}}</p>
                                </li>
                            </ul>

                        </div>
                    </template>

                </div>
            </template>

        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            project : { type : Object, default : {} },
            schedule : { type : Array, default : [] },
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 1,
                    count : 0,
                    order_by_desc : "insert_date",
                },

                data : [],
                modal : false,
                dates : [],
                titles : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getTitle();

        },
        mounted: function(){
            this.$nextTick(() => {
                //this.fillDays()


            });
        },
        methods: {
            getItem(YM,D,title,key) {
                D = String(D);
                let day = D.padStart(2,"0");
                let date = YM + "-" + day;
                let data;
                for(let i =0; i<this.schedule.length; i++) {
                    let schedule = this.schedule[i];

                    if(schedule.schedule_start_date == date && schedule.group_a == title) data = schedule;
                }

                if(data) return data[key];

                return '';
            },
            async getTitle() {
                try {
                    let filter = {
                        project_idx : this.project.idx,
                        column : "group_a",
                        order_by_asc: "group_a",
                    }
                    let res = await this.jl.ajax("distinct",filter,"/api/project_schedule");
                    this.titles = res.data
                }catch (e) {
                    alert(e.message)
                }
            },
            getMonthsBetween(startDate, endDate) {
                const start = new Date(startDate); // 시작 날짜 객체
                const end = new Date(endDate); // 끝 날짜 객체
                const months = [];

                // 현재 날짜를 시작 날짜로 초기화
                let current = new Date(start.getFullYear(), start.getMonth(), 1);

                while (current <= end) {
                    // 현재 연-월을 YYYY-MM 형식으로 추가
                    const year = current.getFullYear();
                    const month = String(current.getMonth() + 1).padStart(2, '0');
                    months.push(`${year}-${month}`);

                    // 다음 달로 이동
                    current.setMonth(current.getMonth() + 1);
                }

                return months;
            },
            isWeekend(dateString, day) {
                // dateString 형식: "YYYY-MM"
                const [year, month] = dateString.split('-').map(Number); // 연도와 월 분리
                // Date 객체 생성 (month는 1부터 시작하므로 그대로 사용)
                const date = new Date(year, month - 1, day);
                // getDay() 메서드로 요일 확인 (0: 일요일, 6: 토요일)
                const dayOfWeek = date.getDay();
                // 토요일(6) 또는 일요일(0)이라면 true 반환
                return dayOfWeek === 0 || dayOfWeek === 6;
            },
            getDaysInMonth(dateString) {
                // dateString 형식: "YYYY-MM"
                const [year, month] = dateString.split('-').map(Number); // 연도와 월 분리
                return new Date(year, month, 0).getDate(); // 해당 월의 마지막 날 계산
            }
        },
        computed: {

        },
        watch : {
            project() {
                this.dates = this.getMonthsBetween(this.project.start_date,this.project.end_date);
            }
        }
    });
</script>

<style>

</style>