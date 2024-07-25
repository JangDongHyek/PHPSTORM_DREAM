<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile08">
        <div class="history_form">
            <h4>프로젝트 진행 이력</h4>
            <dl>
                <dt class="flex" @click="modal = true;">
                    <input id="inputField" class="disabled-input" disabled type="text" type="text" placeholder="이력을 입력해주세요">
                    <button id="addButton"><i class="fa-light fa-plus"></i></button>
                </dt>
                <dd class="tag">
                    <template v-for="item,index in user.job_project">
                        <p >
                            <a href="" @click="event.preventDefault(); project_index = index; modal = true">{{item.title}} {{item.sdate}} ~ {{item.edate}}</a>
                            <a class="del" href="" @click="event.preventDefault(); user.job_project.splice(index,1);"><i class="fa-light fa-xmark"></i></a>
                        </p>
                    </template>
                </dd>
            </dl>
            <div class="modal" :style="{display : modal ? 'block' : 'none'}">
                <div class="modal-content">
                    <div class="modal-title">
                        <h5>프로젝트 진행 이력</h5>
                        <span class="close" @click="closeModal"><i class="fa-light fa-xmark"></i></span>
                    </div>
                    <div class="modal-scroll">
                        <dl>
                            <dt>주제</dt>
                            <dd>
                                <input type="text" placeholder="주제 입력" v-model="project.title">
                            </dd>
                        </dl>
                        <dl>
                            <dt>수행분야</dt>
                            <dd>
                                <select v-model="project.type">
                                    <option value="">선택해 주세요</option>
                                    <option value="공공">공공</option>
                                    <option value="금융">금융</option>
                                    <option value="IT/통신">IT/통신</option>
                                    <option value="쇼핑몰/유통">쇼핑몰/유통</option>
                                    <option value="여행">여행</option>
                                    <option value="기타">기타</option>
                                </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt>진행기간</dt>
                            <dd class="flex">
                                <input type="date" v-model="project.sdate"><span>~</span><input type="date" v-model="project.edate">
                            </dd>
                            <dd class="setting">
                                <input type="checkbox" id="btnToggle2" v-model="project.ing">
                                <label class="control">진행중</label>
                            </dd>
                        </dl>
                    </div>
                    <div class="modal-btn">
                        <button @click="!isNaN(parseInt(project_index)) ? udpateProject() : addProject()">적용</button>
                    </div>
                </div>
            </div>

        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            user: {type: Object, default: {}}
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {
                    job_project : [],
                },

                project_index : "",
                project : {
                    title : "",
                    type : "",
                    sdate : "",
                    edate : "",
                    ing : false
                },
                org_project : {},
                modal : false,
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            closeModal : function() {
                if(!isNaN(parseInt(this.project_index))) {
                    this.user.job_project[this.project_index] = this.jl.copyObject(this.org_project);
                }
                this.project = this.jl.initObject(this.project);
                this.project_index = "";

                this.modal = false;
            },
            udpateProject : function() {
                this.user.job_project[this.project_index] = this.jl.copyObject(this.project);
                this.project = this.jl.initObject(this.project);
                this.project_index = "";

                this.modal = false;
            },
            addProject : function() {
                if(!this.project.title) {
                    alert("주제를 입력해주세요.");
                    return false;
                }
                if(!this.project.type) {
                    alert("수행분야를 선택해주세요.");
                    return false;
                }
                if(!this.project.sdate) {
                    alert("시작일을 입력해주세요.");
                    return false;
                }
                if(!this.project.edate) {
                    alert("종료일을 입력해주세요.");
                    return false;
                }
                
                this.user.job_project.push(this.jl.copyObject(this.project));
                this.project = this.jl.initObject(this.project);
                console.log(this.user.job_project)
                console.log(this.project)
                this.modal = false;
            },
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/example.php", objs);
                if (res) {
                    this.jl.log(res)
                    this.data = res.response.data
                }
            }
        },
        computed: {

        },
        watch : {
            modal : function() {
                if(this.modal) {
                    if(!isNaN(parseInt(this.project_index))) {
                        this.project = this.jl.copyObject(this.user.job_project[this.project_index]);
                        this.org_project = this.jl.copyObject(this.project);
                    }
                }
            }
        }
    });
</script>

<style>
    .disabled-input {
        pointer-events: none; /* 클릭 이벤트를 무시하도록 설정 */
    }
</style>