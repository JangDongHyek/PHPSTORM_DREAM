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
                            <div class="week" :class="{'today' : getWeekStartDate(month,week) == getWeekStartDate(jl.getToday())}" style="width: 80px;">{{week}}주차</div>
                        </template>
                    </template>
                </div>

                <!-- 동에대한 반복 -->
                <template v-for="block in blocks">
                    <div class="schedule-row">
                        <template v-for="month in getMonthsBetween(start_date,end_date)">
                            <template v-for="week,block_idx in getTotalWeeksOfMonth(month)">
                                <div class="week" :class="{'today' : getWeekStartDate(month,week) == getWeekStartDate(jl.getToday())}" style="width: 80px;">

                                    <!-- 기간에 일치했을때 -->
                                    <template v-if="isWeekBetween(month,week,block.$minmax[0].min_date,block.$minmax[0].max_date)">
                                        <!-- 기간의 첫째날만 -->
                                        <template v-if="firstCheck(month,week,block,'block',block_idx)">
                                            <div class="task zone-title" :style="{ width : (80 * getWeekDifference(block.$minmax[0].min_date,block.$minmax[0].max_date)) + 'px' }" >{{block.name}}</div>
                                        </template>
                                    </template>
                                    <!-- 해당기간이아닐때 -->
                                    <template v-if="!isWeekBetween(month,week,block.$minmax[0].min_date,block.$minmax[0].max_date)">
                                        <div class="week"  style="width: 80px;"></div>
                                    </template>
                                </div>

                            </template>
                        </template>
                    </div>

                    <!-- 층에대한 반복-->
                    <template v-for="floor in block.$floors">
                        <div class="schedule-row">
                            <template v-for="month in getMonthsBetween(start_date,end_date)">
                                <template v-for="week,floor_idx in getTotalWeeksOfMonth(month)">
                                    <div class="week" :class="{'today' : getWeekStartDate(month,week) == getWeekStartDate(jl.getToday())}" style="width: 80px;">

                                        <!-- 기간에 일치했을때 -->
                                        <template v-if="isWeekBetween(month,week,floor.$minmax[0].min_date,floor.$minmax[0].max_date)">
                                            <!-- 기간의 첫째날만 -->
                                            <template v-if="firstCheck(month,week,floor,'floor',floor_idx)">
                                                <div class="task zone-title" :style="{ width : (80 * getWeekDifference(floor.$minmax[0].min_date,floor.$minmax[0].max_date)) + 'px' }" >{{floor.name}}</div>
                                            </template>
                                        </template>
                                        <!-- 해당기간이아닐때 -->
                                        <template v-if="!isWeekBetween(month,week,floor.$minmax[0].min_date,block.$minmax[0].max_date)">
                                            <div class="week"  style="width: 80px;"></div>
                                        </template>
                                    </div>

                                </template>
                            </template>
                        </div>

                        <!-- 구역반복 -->
                        <template v-for="area in floor.$areas">
                            <div class="schedule-row">
                                <template v-for="month in getMonthsBetween(start_date,end_date)">
                                    <template v-for="week,area_idx in getTotalWeeksOfMonth(month)">
                                        <div class="week" :class="{'today' : getWeekStartDate(month,week) == getWeekStartDate(jl.getToday())}" style="width: 80px;">

                                            <!-- 기간에 일치했을때 -->
                                            <template v-if="isWeekBetween(month,week,area.$minmax[0].min_date,area.$minmax[0].max_date)">
                                                <!-- 기간의 첫째날만 -->
                                                <template v-if="firstCheck(month,week,area,'area',area_idx)">
                                                    <div class="task red" :style="{ width : (80 * getWeekDifference(area.$minmax[0].min_date,area.$minmax[0].max_date)) + 'px' }" >{{area.name}}</div>
                                                </template>
                                            </template>
                                            <!-- 해당기간이아닐때 -->
                                            <template v-if="!isWeekBetween(month,week,area.$minmax[0].min_date,block.$minmax[0].max_date)">
                                                <div class="week"  style="width: 80px;"></div>
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

                    check_blocks : [],
                    check_floors : [],
                    check_areas : [],
                    checks : [],

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
                firstCheck(month, week, data, type, index) {
                    let arr = this.checks;
                    if(this.getWeekStartDate(month, week) == this.getWeekStartDate(data.$minmax[0].min_date)) {
                        const key = `${type}_${data.$minmax[0].min_date}`;

                        let obj = {
                            idx : key,
                            month : month,
                            week : week,
                        }

                        let exists = arr.find(item => item.idx == key);

                        if (exists) {
                            if(exists.month == month && exists.week == week) {
                                console.log(key,month,week)
                                return true;
                            }
                        }else {
                            arr.push(obj);
                        }

                    }

                    return false;
                },
                getWeekDifference(startDate, endDate) {
                    // 시작, 끝 날짜의 주 시작 일요일을 찾기
                    let startWeekStart = new Date(this.getWeekStartDate(startDate));
                    let endWeekStart = new Date(this.getWeekStartDate(endDate));

                    // 밀리초 단위 차이를 주 단위로 변환
                    let diffTime = endWeekStart - startWeekStart;
                    let diffWeeks = Math.round(diffTime / (1000 * 60 * 60 * 24 * 7));
                    return diffWeeks + 1;
                },

                isWeekBetween(targetMonth,week, startDate, endDate) {
                    let targetWeek = this.getWeekStartDate(targetMonth,week);
                    let startWeek = this.getWeekStartDate(startDate);
                    let endWeek = this.getWeekStartDate(endDate);

                    return targetWeek >= startWeek && targetWeek <= endWeek;
                },

                getWeekStartDate(dateInput, weekNum = null) {
                    let date;

                    if (weekNum !== null) {
                        // 주차 기반 계산: 해당 월의 1일 기준으로 시작
                        let [year, month] = dateInput.split('-').map(Number);
                        date = new Date(year, month - 1, 1); // 해당 월 1일

                        let firstDayOfMonth = date.getDay(); // 요일 (0=일)
                        let offsetToSunday = -firstDayOfMonth; // 그 주 일요일까지 이동 (음수 가능)

                        // 첫 번째 주의 일요일 구하기
                        let firstSunday = new Date(year, month - 1, 1 + offsetToSunday);

                        // N주차면 (N-1)주 더한 날짜
                        firstSunday.setDate(firstSunday.getDate() + (weekNum - 1) * 7);

                        date = firstSunday;
                    } else {
                        // 단일 날짜 입력 처리
                        if (typeof dateInput === 'string') {
                            date = new Date(dateInput);
                        } else {
                            return null; // 잘못된 입력
                        }

                        let day = date.getDay(); // 0 = 일
                        date.setDate(date.getDate() - day); // 일요일로 이동
                    }

                    let year = date.getFullYear();
                    let month = String(date.getMonth() + 1).padStart(2, '0');
                    let day = String(date.getDate()).padStart(2, '0');

                    return `${year}-${month}-${day}`;
                },

                //해당 월이 몇주차까지있는지
                getTotalWeeksOfMonth(yyyyMm) {
                    let [year, month] = yyyyMm.split('-').map(Number);
                    let firstDay = new Date(year, month - 1, 1).getDay(); // 월 1일의 요일 (0=일요일)
                    let lastDate = new Date(year, month, 0).getDate(); // 해당 월의 마지막 날짜

                    // Windows 기준 (일요일 시작) 주차 계산
                    return Math.ceil((lastDate + firstDay) / 7);
                },

                //시작일부터 종료일의 월을 배열로 가져오는
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