<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="schedule_weekly">
        <div class="week_top flex ai-c jc-sb">
            <div class="task_info flex ai-c">
                <span class="icon icon_gray">담당자</span>&nbsp;&nbsp;{{user.company_person}}
            </div>
            <div class="week_navigation flex ai-c">
                <div class="week_date">
                    <button class="prev" @click="settingDate(-7)"><i class="fa-light fa-angle-left"></i><!--이전주--></button>
                    <strong>{{jl.dateToWeekly(now_date.format())}}</strong> <span>{{start_date.format()}} ~ {{end_date.format()}}</span>
                    <button class="next" @click="settingDate(+7)"><i class="fa-light fa-angle-right"></i><!--다음주--></button>
                </div>
                <button class="btn btn_darkblue">주간 공정 저장</button>
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
                    </dt>
                    <dd>
                        <div class="day_content">
                            <div class="input_wrap border">
                                <input type="text" class="input_category" placeholder="구분 내용을 입력하세요" value="현장 준비 및 기초 작업" disabled />
                            </div>
                            <ul class="task_list">
                                <li class="task_item border">
                                    <div class="flex ai-c">
                                        <input type="text" class="input_task" placeholder="상세 작업 내용을 입력하세요" value="현장청소 및 정리" disabled />
                                        <input type="text" placeholder="작업 변경 및 특이사항 입력" value="현장접근로가 부분적으로 막혔으므로 추가 청소 필요">
                                        <select class="statusSelect">
                                            <option value="gray">예정</option>
                                            <option value="green">진행</option>
                                            <option value="blue">완료</option>
                                            <option value="black" selected>보류</option>
                                            <option value="red">피드백</option>
                                        </select>
                                    </div>
                                    <button class="btn btn_mini btn_line">업로드</button>
                                    <button class="btn btn_mini btn_blue" data-toggle="modal" data-target="#downloadModal">다운로드</button>
                                    <span class="file_info">230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx <strong>외 2건</strong></span>
                                </li>
                                <li class="task_item border">
                                    <div class="flex ai-c">
                                        <input type="text" class="input_task" placeholder="상세 작업 내용을 입력하세요" value="기초 측정 및 마킹" disabled />
                                        <input type="text" placeholder="작업 변경 및 특이사항 입력">
                                        <select class="statusSelect">
                                            <option value="gray">예정</option>
                                            <option value="green">진행</option>
                                            <option value="blue" selected>완료</option>
                                            <option value="black">보류</option>
                                        </select>
                                    </div>
                                    <button class="btn btn_mini btn_line">업로드</button>
                                    <button class="btn btn_mini btn_blue" data-toggle="modal" data-target="#downloadModal">다운로드</button>
                                    <span class="file_info">230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx <strong>외 2건</strong></span>
                                </li>
                                <li class="task_item border">
                                    <div class="flex ai-c">
                                        <input type="text" class="input_task" placeholder="상세 작업 내용을 입력하세요" value="레벨 및 라인 확인" disabled />
                                        <input type="text" placeholder="작업 변경 및 특이사항 입력">
                                        <select class="statusSelect">
                                            <option value="gray">예정</option>
                                            <option value="green">진행</option>
                                            <option value="blue" selected>완료</option>
                                            <option value="black">보류</option>
                                        </select>
                                    </div>
                                    <button class="btn btn_mini btn_line">업로드</button>
                                    <button class="btn btn_mini btn_blue" data-toggle="modal" data-target="#downloadModal">다운로드</button>
                                    <span class="file_info">230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx <strong>외 2건</strong></span>
                                </li>
                            </ul>
                        </div>
                    </dd>
                </dl>

            </div>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
        template: "#<?=$componentName?>-template",
        props: {
            project_idx : {type : String, default : ""},
            user_idx : {type : String, default : ""},
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
                
                start_date : "", // 일요일
                now_date : "", // 오늘날짜
                end_date : "", // 토요일

                user : {},
            };
        },
        async created(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            //this.getData();
            this.getUser();
            this.settingDate();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async getUser() {
                let filter = {
                    table : "user",
                    idx : this.user_idx
                }

                try {
                    let res = await this.jl.ajax("get",filter,"/jl/JlApi");
                    this.user = res.data[0]
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
            settingDate(day = 0) {
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

                console.log(date.format());
            },
            getClass() {
                // 보류 블랙 완료 블루 피드백 레드 진행 그린 예정 그레이
            },
        },
        computed: {

        },
        watch : {

        }
    }});
</script>

<style>

</style>