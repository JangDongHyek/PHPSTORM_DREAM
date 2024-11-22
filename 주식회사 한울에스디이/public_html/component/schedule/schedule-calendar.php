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
            <template v-for="date in dates">
                <div class="column_wrap">
                    <div class="section_title">101동</div>
                    <div class="day">
                        <ul>
                            <li v-for="item in getDaysInMonth(date)" :class="{'weekend' : isWeekend(date,item)}">
                                <p>1</p>
                                <p>2</p>
                            </li>
                        </ul>

                    </div>

                    <div class="section_title">102동</div>
                    <div class="day">
                        <ul>
                            <li v-for="item in getDaysInMonth(date)" :class="{'weekend' : isWeekend(date,item)}"></li>
                        </ul>

                    </div>
                </div>
            </template>

        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            project : { type : Object, default : {} }
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
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            //this.getData();

        },
        mounted: function(){
            this.$nextTick(() => {
                //this.fillDays()


            });
        },
        methods: {
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