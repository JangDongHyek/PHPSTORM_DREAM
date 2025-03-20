<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="weekly-schedule" class="schedule-wrapper">
            <div id="weekly-month-header" class="month-header">
                <template v-for="month in getMonthsBetween(start_date,end_date)">
                    <div class="month-label" :style="{ width : (80 * getTotalWeeksOfMonth(month)) + 'px' }">{{month.split('-')[0]}}년 {{month.split('-')[1]}}월</div>
                </template>
            </div>

            <div id="weekly-weeks" class="schedule">
                <div class="schedule-row">
                    <template v-for="month in getMonthsBetween(start_date,end_date)">
                        <template v-for="week in getTotalWeeksOfMonth(month)">
                            <div class="week" :class="{'today' : (month+'-'+week) == getWeekOfMonth(jl.getToday())}" style="width: 80px;">{{week}}주차</div>
                        </template>
                    </template>
                </div>

                <!-- 동에대한 반복 -->
                <template v-for="block in blocks">
                    <div class="schedule-row">
                        <template v-for="month in getMonthsBetween(start_date,end_date)">
                            <template v-for="week in getTotalWeeksOfMonth(month)">
                                <div class="week" :class="{'today' : (month+'-'+week) == getWeekOfMonth(jl.getToday())}" style="width: 80px;">

                                    <!-- 기간에 일치했을때 -->
                                    <template v-if="isWeekBetween(month+'-'+week,block.$minmax[0].min_date,block.$minmax[0].max_date)">
                                        <!-- 기간의 첫째날만 -->
                                        <template v-if="getWeekOfMonth(month+'-'+week) == getWeekOfMonth(block.$minmax[0].min_date)">
                                            1
                                        </template>
                                    </template>
                                    <!-- 해당기간이아닐때 -->
                                    <template v-if="!isWeekBetween(month+'-'+week,block.$minmax[0].min_date,block.$minmax[0].max_date)">
                                        <div class="week"  style="width: 80px;"></div>
                                    </template>
                                </div>

                            </template>
                        </template>
                    </div>

                </template>

            </div>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                blocks : { type: Array, default: [] },
                start_date : { type: String, default: "" },
                end_date : { type: String, default: "" },
                primary : { type: String, default: "" },
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",
                    context_name : "<?=$context_name?>",
                    context : null,

                    row: {},
                    rows : [],

                    options : {
                        table : "",
                        file_use : false,
                        required : [
                            {name : "",message : ``},
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
                        load : false,
                        primary : "",
                        data : {},
                        class_1 : "",
                        class_2 : "",
                    },

                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
                const className = this.context_name.charAt(0).toUpperCase() + this.context_name.slice(1) + "Common";
                if (typeof window[className] !== 'undefined') {
                    this.context = new window[className](this.jl);
                }
            },
            async mounted() {
                if(this.primary) this.row = await this.jl.getData(this.filter);
                //await this.jl.getsData(this.filter,this.rows);

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                getWeekDifference(date1, date2) {
                    let week1 = this.getWeekOfMonth(date1);
                    let week2 = this.getWeekOfMonth(date2);

                    // 같은 연도, 같은 월이면 주차 차이만 반환
                    if (week1.year === week2.year && week1.month === week2.month) {
                        console.log(week2.week - week1.week);
                        return week2.week - week1.week;
                    }

                    let totalWeeks = 0;

                    // 첫 번째 날짜의 해당 월 마지막 주차 계산
                    let totalWeeksInMonth1 = this.getTotalWeeksOfMonth(`${week1.year}-${String(week1.month).padStart(2, '0')}`);
                    totalWeeks += (totalWeeksInMonth1 - week1.week); // 남은 주차 수 추가

                    // 중간 월 계산
                    let currentYear = week1.year;
                    let currentMonth = week1.month + 1;
                    while (currentYear < week2.year || (currentYear === week2.year && currentMonth < week2.month)) {
                        totalWeeks += this.getTotalWeeksOfMonth(`${currentYear}-${String(currentMonth).padStart(2, '0')}`);

                        // 다음 달로 이동
                        if (currentMonth === 12) {
                            currentMonth = 1;
                            currentYear++;
                        } else {
                            currentMonth++;
                        }
                    }

                    // 두 번째 날짜가 속한 월의 주차 추가
                    totalWeeks += week2.week;

                    console.log(totalWeeks);
                    return totalWeeks;
                },

                isWeekBetween(targetDate, startDate, endDate) {
                    let targetWeek = this.getWeekOfMonth(targetDate);
                    let startWeek = this.getWeekOfMonth(startDate);
                    let endWeek = this.getWeekOfMonth(endDate);

                    return targetWeek >= startWeek && targetWeek <= endWeek;
                },

                getWeekOfMonth(dateString) {
                    let date = new Date(dateString);
                    let year = date.getFullYear();
                    let month = date.getMonth();
                    let firstDay = new Date(year, month, 1).getDay(); // 해당 달 1일의 요일 (0 = 일요일)
                    let dayOfMonth = date.getDate();

                    // Windows 기준 (일요일 시작) 주차 계산
                    let weekNumber = Math.ceil((dayOfMonth + firstDay) / 7);

                    // "YYYY-MM" 형식으로 반환
                    return `${year}-${String(month + 1).padStart(2, '0')}-${weekNumber}`;
                },

                getTotalWeeksOfMonth(yyyyMm) {
                    let [year, month] = yyyyMm.split('-').map(Number);
                    let firstDay = new Date(year, month - 1, 1).getDay(); // 월 1일의 요일 (0=일요일)
                    let lastDate = new Date(year, month, 0).getDate(); // 해당 월의 마지막 날짜

                    // Windows 기준 (일요일 시작) 주차 계산
                    return Math.ceil((lastDate + firstDay) / 7);
                },

                getMonthsBetween(startDate, endDate) {
                    let months = new Set();
                    let start = new Date(startDate);
                    let end = new Date(endDate);

                    while (start <= end) {
                        let year = start.getFullYear();
                        let month = (start.getMonth() + 1).toString().padStart(2, "0"); // 두 자리로 변환
                        months.add(`${year}-${month}`);
                        start.setMonth(start.getMonth() + 1);
                    }

                    return [...months].sort();
                }
            },
            computed: {

            },
            watch: {
                async "modal.status"(value,old_value) {
                    if(value) {
                        this.modal.load = true;
                    }else {
                        this.modal.load = false;
                        this.modal.data = {};
                    }
                }
            }
        }});

</script>

<style>

</style>