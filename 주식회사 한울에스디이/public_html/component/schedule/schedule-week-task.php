<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="week_task" v-if="load">
        <div class="week_top flex ai-c jc-sb">
            <div class="task_info flex ai-c">
                <h4>{{user.category_a}} {{user.category_b}} {{user.group_a}} {{user.group_b}} {{user.group_c}}</h4> <span class="icon icon_gray">담당자</span>&nbsp;&nbsp;{{user.company_person}}
            </div>
            <div class="week_navigation flex ai-c">
                <div class="week_date">
                    <button class="prev" @click="settingDate(-7)"><i class="fa-light fa-angle-left"></i><!--이전주--></button>
                    <strong>{{jl.dateToWeekly(now_date.format())}}</strong> <span>{{start_date.format()}} ~ {{end_date.format()}}</span>
                    <button class="next" @click="settingDate(+7)"><i class="fa-light fa-angle-right"></i><!--다음주--></button>
                </div>
                <button class="btn btn_darkblue" @click="postScheduleData();">금주 작업 저장</button>
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
                                <input v-if="schedule[index]" type="text" class="input_category" readonly :value="schedule[index].content" />
                                <button class="btn btn_mini btn_black" @click="addScheduleData(index)">내용 추가</button>
                            </div>
                            <ul class="task_list">
                                <li class="task_item border" v-for="item,index2 in schedule_data[index]">
                                    <div class="flex ai-c">
                                        <input type="text" class="input_task" placeholder="상세 작업 내용을 입력하세요" v-model="item.content" />
                                        <button class="btn btn_mini btn_gray" @click="deleteScheduleData(index,index2)">삭제</button>
                                    </div>
                                    <label class="btn btn_mini btn_line" :for="'f'+index2">업로드</label>
                                    <input type="file" style="display: none" :id="'f'+index2" @change="jl.changeFile($event,item,'file',this);">
                                    <!--<button class="btn btn_mini btn_line">업로드</button>-->
                                    <!--<button class="btn btn_mini btn_blue" data-toggle="modal" data-target="#downloadModal">다운로드</button>-->

                                    <span class="file_info" v-if="item.file">{{item.file.name}}</span>
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
            modal : {type : Boolean, default : false},
            primary : {type : String, default : ""},
            project_idx : {type : String, default : ""},
            user_idx : {type : String, default : ""},
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

                user : null,
                load : false,

                schedule_data : [
                    [],[],[],[],[],[],[]
                ],
            };
        },
        async created(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            await this.getUser();
            await this.settingDate();

            this.load = true;

            console.log(this.user_idx)
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            async getScheduleData(date) {
                let filter = {
                    table : "project_schedule_data",
                    project_idx : this.project_idx,
                    user_idx : this.user_idx,
                    work_date : date,
                }

                try {
                    return await this.jl.ajax("get",filter,"/jl/JlApi.php");
                }catch (e) {
                    alert(e.message)
                }
            },
            async postScheduleData() {
                for(const schedule_data of this.schedule_data) {
                    for(let item of schedule_data) {
                        let method = item.idx ? "update" : "insert";
                        item['table'] = "project_schedule_data";
                        item['file_use'] = true
                        try {
                            let res = await this.jl.ajax(method,item,"/jl/JlApi.php");
                        }catch (e) {
                            alert(e.message)
                            return false;
                        }
                    }
                }
                alert("저장되었습니다.");
                await this.settingDate();
            },
            async deleteScheduleData(index,index2) {
                let schedule_data = this.schedule_data[index];
                if(!schedule_data[index2].idx) {
                    schedule_data.splice(index2,1);
                    return false;
                }

                if(!confirm("삭제시 저장과 상관없이 삭제됩니다 삭제하시겠습니까?")) return false;

                let data = {
                    table : "project_schedule_data",
                    primary : schedule_data[index2].idx,
                    file_use : true, // 저장된 파일 삭제할지 안할지 삭제할시 데이터의 컬럼명 이들어가야한다
                    file_columns : ["file"] // 파일값이 저장된 컬럼
                }

                try {
                    let res = await this.jl.ajax("remove",data,"/jl/JlApi");
                    await this.settingDate();
                    alert("삭제되었습니다.");


                }catch (e) {
                    alert(e.message)
                }

            },
            addScheduleData(index) {
                let obj = {
                    project_idx : this.project_idx,
                    user_idx : this.user_idx,
                    content : "",
                    file : "",
                    work_date : this.getDay(index,true).format(),
                };

                this.schedule_data[index].push(obj)
                //this.$set(this.schedule_data,index,obj);
            },
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
            async getSchedule(date) {
                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    add_query : ` and '${date}' BETWEEN schedule_start_date AND schedule_end_date `,
                    category_a : this.user.category_a,
                    category_b : this.user.category_b,
                    group_a : this.user.group_a,
                    group_b : this.user.group_b,
                    group_c : this.user.group_c,
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/api/jl");
                    return res;
                }catch (e) {
                    alert(e.message)
                }
            },
            getDay(index,dateType = false) {
                const days = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];

                let date = new Date(this.start_date);
                date.setDate(date.getDate() + index);

                if(dateType) return date;

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
                this.schedule_data = [
                    [],[],[],[],[],[],[]
                ];
                let index = 0;
                while(currentDate <= this.end_date) {
                    let res = await this.getSchedule(currentDate.format())
                    if(res['count']) this.schedule.push(res['data'][0]);
                    else this.schedule.push(this.jl.copyObject(temp));

                    res = await this.getScheduleData(currentDate.format());
                    if(res['count']) this.schedule_data[index] = res.data;

                    index++;
                    currentDate.setDate(currentDate.getDate() + 1);
                }

            }
        },
        computed: {

        },
        watch : {

        }
    }});
</script>

<style>

</style>