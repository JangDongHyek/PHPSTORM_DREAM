<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section class="schedule_gant" id="gantCont">
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
        <div class="gant_cont" >
            <template v-for="YM in dates">
                <div class="column_wrap">
                    <template v-for="title in titles">
                        <div class="section_title">{{title.group_a}}</div>
                        <div class="day">
                            <ul>
                                <li v-for="D in getDaysInMonth(YM)" :class="getClass(YM,D,title.group_a)">
                                    <!--<p>{{getItem(YM,D,title,'memo')}}</p>-->
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
    Jl_components.push({name : "<?=$componentName?>",object : {
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
                this.enableDragScroll();

            });
        },
        methods: {
            enableDragScroll() {
                const gantCont = document.getElementById("gantCont");
                let isDragging = false;
                let startX;
                let scrollLeft;

                // 마우스 누름 이벤트
                gantCont.addEventListener("mousedown", (e) => {
                    isDragging = true;
                    startX = e.pageX - gantCont.offsetLeft;
                    scrollLeft = gantCont.scrollLeft;
                    gantCont.style.cursor = "grabbing";
                });

                // 마우스 이동 이벤트
                gantCont.addEventListener("mousemove", (e) => {
                    if (!isDragging) return;
                    e.preventDefault(); // 기본 동작 방지 (선택 방지)
                    const x = e.pageX - gantCont.offsetLeft;
                    const walk = (x - startX); // 움직인 거리 계산
                    gantCont.scrollLeft = scrollLeft - walk;
                });

                // 마우스 놓음/나감 이벤트
                gantCont.addEventListener("mouseup", () => {
                    isDragging = false;
                    gantCont.style.cursor = "grab";
                });

                gantCont.addEventListener("mouseleave", () => {
                    isDragging = false;
                    gantCont.style.cursor = "grab";
                });
            },
            getClass(YM,D,title,key) {
                let day = String(D);
                day = day.padStart(2,"0");
                let date = YM + "-" + day;
                let target_date = new Date(date);

                let data;
                for(let i =0; i<this.schedule.length; i++) {
                    let schedule = this.schedule[i];
                    let start_date = new Date(schedule.schedule_start_date);
                    let end_date = new Date(schedule.schedule_end_date);

                    if(target_date >= start_date && target_date <= end_date && schedule.group_a == title) data = schedule;
                }

                if(data) return 'active';

                let weekend = this.isWeekend(YM,D);

                if(weekend) return 'weekend';
            },
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
    }});
</script>

<style>

</style>