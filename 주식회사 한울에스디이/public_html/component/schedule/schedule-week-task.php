<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="week_task">
        <div class="week_top flex ai-c jc-sb">
            <div class="task_info flex ai-c">
                <h4>101동 [24F] A-1 &gt; 거푸집</h4> <span class="icon icon_gray">담당자</span>&nbsp;&nbsp;김설주
            </div>
            <div class="week_navigation flex ai-c">
                <div class="week_date">
                    <button class="prev" @click="settingDate(-7)"><i class="fa-light fa-angle-left"></i><!--이전주--></button>
                    <strong>{{jl.dateToWeekly(now_date.format())}}</strong> <span>{{start_date.format()}} ~ {{end_date.format()}}</span>
                    <button class="next" @click="settingDate(+7)"><i class="fa-light fa-angle-right"></i><!--다음주--></button>
                </div>
                <button class="btn btn_darkblue">금주 작업 저장</button>
            </div>
        </div>
        <div class="week_wrap">
            <div class="week_header">
                <div class="border"></div>
                <div class="border">구분</div>
                <div class="border">내용</div>
            </div>
            <div class="week_content">
                <dl class="day_section" v-for="day,index in 7">
                    <dt class="day_header border">
                        <p>{{getDay(index)}}</p>
                        <!--<button class="btn btn_mini btn_grayblue">구분 추가</button>-->
                    </dt>
                    <dd>
                        <div class="day_content">
                            <div class="input_wrap border">
                                <input type="text" class="input_category" readonly :value="schedule[index].content" />
                                <!--<button class="btn btn_mini btn_black">내용 추가</button>-->
                            </div>
                            <ul class="task_list">
                                <li class="task_item border">
                                    <div class="flex ai-c">
                                        <input type="text" class="input_task" placeholder="상세 작업 내용을 입력하세요" value="현장청소 및 정리" />
                                        <button class="btn btn_mini btn_gray">삭제</button>
                                    </div>
                                    <button class="btn btn_mini btn_line">업로드</button>
                                    <button class="btn btn_mini btn_blue" data-toggle="modal" data-target="#downloadModal">다운로드</button>
                                    <span class="file_info">230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx <strong>외 2건</strong></span>
                                </li>
                                <!--<li class="task_item border">-->
                                <!--    <div class="flex ai-c">-->
                                <!--        <input type="text" class="input_task" placeholder="상세 작업 내용을 입력하세요" />-->
                                <!--        <button class="btn btn_mini btn_gray">삭제</button>-->
                                <!--    </div>-->
                                <!--    <button class="btn btn_mini btn_line">업로드</button>-->
                                <!--</li>-->
                            </ul>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>


    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
            primary : {type : String, default : ""},
            project_idx : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    primary : this.primary
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {

                },

                start_date : "", // 일요일
                now_date : "", // 오늘날짜
                end_date : "", // 토요일

                schedule : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.settingDate();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            async getSchedule(date) {
                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    add_query : ` and '${date}' BETWEEN schedule_start_date AND schedule_end_date `,
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/api/jl");
                    return res;
                }catch (e) {
                    alert(e.message)
                }
            },
            getDay(index) {
                const days = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];

                let date = new Date(this.start_date);
                date.setDate(date.getDate() + index);

                // 요일 가져오기 (0: 일요일, 1: 월요일, ... 6: 토요일)
                const dayOfWeek = date.getDay();

                // 날짜 가져오기
                const day = date.getDate();

                // "수요일 (18)" 형식의 문자열 반환
                return `${days[dayOfWeek]} (${day})`;
            },
            async settingDate(day = 0) {
                let date
                if(this.now_date) {
                    date = new Date(this.now_date); // 원본 복사
                    date.setDate(date.getDate() + day);   // day 만큼 날짜를 더함
                }else {
                    date = new Date();

                }

                // 오늘 요일 (0: 일요일, 1: 월요일, ..., 6: 토요일)
                const dayOfWeek = date.getDay();

                // 주의 시작일 (월요일 기준)
                const startOfWeek = new Date(date);
                startOfWeek.setDate(date.getDate() - dayOfWeek + (dayOfWeek === 0 ? -6 : 1)); // 월요일 기준

                // 주의 끝일 (일요일 기준)
                const endOfWeek = new Date(startOfWeek);
                endOfWeek.setDate(startOfWeek.getDate() + 6);

                this.now_date = date;
                this.start_date = startOfWeek;
                this.end_date = endOfWeek;

                let currentDate = new Date(startOfWeek);
                let temp = {
                    content : "일정없음"
                }

                this.schedule = [];

                while(currentDate <= this.end_date) {
                    let res = await this.getSchedule(currentDate.format())
                    currentDate.setDate(currentDate.getDate() + 1);

                    if(res['count']) this.schedule.push(res['data'][0]);
                    else this.schedule.push(this.jl.copyObject(temp));
                }

                console.log(this.schedule);
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>