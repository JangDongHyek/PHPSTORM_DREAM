<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div id="daily-schedule" class="schedule-wrapper">

            <div id="daily-month-header" class="month-header">
                <template v-for="month in getMonthsBetween(start_date,end_date)">
                    <div class="month-label" :style="{ width : (40 * getLastDayOfMonth(month)) + 'px' }">{{month.split('-')[0]}}년 {{month.split('-')[1]}}월</div>
                </template>
            </div>

            <div id="daily-days" class="schedule">
                <div class="schedule-row">
                    <template v-for="month in getMonthsBetween(start_date,end_date)">
                        <template v-for="day in getLastDayOfMonth(month)">
                            <div class="day" :class="{'today' : normalizeDate(month+'-'+day) == jl.getToday()}" style="width: 40px;">{{day}}</div>
                        </template>
                    </template>
                </div>

                <!-- 동에대한 반복 -->
                <template v-for="block in blocks">
                    <div class="schedule-row">
                        <template v-for="month in getMonthsBetween(start_date,end_date)">
                            <template v-for="day in getLastDayOfMonth(month)">
                                <div class="day" :class="{'today' : normalizeDate(month+'-'+day) == jl.getToday()}" style="width: 40px;">

                                    <!-- 기간에 일치했을때 -->
                                    <template v-if="isDateBetween(month+'-'+day,block.$minmax[0].min_date,block.$minmax[0].max_date)">
                                        <!-- 기간의 첫째날만 -->
                                        <template v-if="normalizeDate(month+'-'+day,block) == block.$minmax[0].min_date">
                                                <div class="task zone-title" :style="{ width : (40 * getDateDifference(block.$minmax[0].min_date,block.$minmax[0].max_date)) + 'px' }" >{{block.name}}</div>
                                        </template>
                                    </template>
                                    <!-- 해당기간이아닐때 -->
                                    <template v-if="!isDateBetween(month+'-'+day,block.$minmax[0].min_date,block.$minmax[0].max_date)">
                                        <div class="day"  style="width: 40px;"></div>
                                    </template>
                                </div>

                            </template>
                        </template>
                    </div>

                    <!-- 층에대한 반복-->
                    <template v-for="floor in block.$floors">
                        <div class="schedule-row">
                            <template v-for="month in getMonthsBetween(start_date,end_date)">
                                <template v-for="day in getLastDayOfMonth(month)">
                                    <div class="day" :class="{'today' : normalizeDate(month+'-'+day) == jl.getToday()}" style="width: 40px;">
                                        <!-- 기간에 일치했을때 -->
                                        <template v-if="isDateBetween(month+'-'+day,floor.$minmax[0].min_date,floor.$minmax[0].max_date)">
                                            <!-- 기간의 첫째날만 -->
                                            <template v-if="normalizeDate(month+'-'+day,floor) == floor.$minmax[0].min_date">
                                                <div class="task zone-title" :style="{ width : (40 * getDateDifference(floor.$minmax[0].min_date,floor.$minmax[0].max_date)) + 'px' }" >{{floor.name}}</div>
                                            </template>
                                        </template>
                                        <!-- 해당기간이아닐때 -->
                                        <template v-if="!isDateBetween(month+'-'+day,floor.$minmax[0].min_date,floor.$minmax[0].max_date)">
                                            <div class="day" style="width: 40px;"></div>
                                        </template>
                                    </div>

                                </template>
                            </template>
                        </div>

                        <!-- 구역반복 -->
                        <template v-for="area in floor.$areas">
                            <div class="schedule-row">
                                <template v-for="month in getMonthsBetween(start_date,end_date)">
                                    <template v-for="day in getLastDayOfMonth(month)">
                                        <div class="day" :class="{'today' : normalizeDate(month+'-'+day) == jl.getToday()}" style="width: 40px;">
                                            <!-- 기간에 일치했을때 -->
                                            <template v-if="isDateBetween(month+'-'+day,area.$minmax[0].min_date,area.$minmax[0].max_date)">
                                                <!-- 기간의 첫째날만 -->
                                                <template v-if="normalizeDate(month+'-'+day,area) == area.$minmax[0].min_date">
                                                    <div class="task red" :style="{ width : (40 * getDateDifference(area.$minmax[0].min_date,area.$minmax[0].max_date)) + 'px' }" >{{area.name}}</div>
                                                </template>
                                            </template>
                                            <!-- 해당기간이아닐때 -->
                                            <template v-if="!isDateBetween(month+'-'+day,area.$minmax[0].min_date,area.$minmax[0].max_date)">
                                                <div class="day" style="width: 40px;"></div>
                                            </template>
                                        </div>

                                    </template>
                                </template>
                            </div>
                        </template>
                    </template>
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
                //if(this.primary) this.row = await this.jl.getData(this.filter);
                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                getDateDifference(date1, date2) {
                    // 날짜를 Date 객체로 변환
                    let d1 = new Date(date1);
                    let d2 = new Date(date2);

                    // 두 날짜의 차이를 밀리초(ms) 단위로 계산 후 일(day) 단위로 변환
                    let diffTime = Math.abs(d2 - d1);
                    let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // 1일 = 86,400,000ms

                    return diffDays + 1;
                },

                isDateBetween(targetDate, startDate, endDate) {
                    let target = new Date(this.normalizeDate(targetDate));
                    let start = new Date(this.normalizeDate(startDate));
                    let end = new Date(this.normalizeDate(endDate));

                    return target >= start && target <= end;
                },

                normalizeDate(dateStr) {
                    let parts = dateStr.split('-');
                    let year = parts[0];
                    let month = parts[1].padStart(2, '0'); // 월을 두 자리로 변환
                    let day = parts[2].padStart(2, '0');   // 일을 두 자리로 변환
                    return `${year}-${month}-${day}`;
                },

                getLastDayOfMonth(yyyyMm) {
                    let [year, month] = yyyyMm.split('-').map(Number);
                    const daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                    // 윤년 확인 (2월 조정)
                    if (month === 2 && ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0)) {
                        return 29; // 윤년일 경우 2월은 29일
                    }

                    return daysInMonth[month - 1]; // 해당 월의 마지막 일자 반환
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