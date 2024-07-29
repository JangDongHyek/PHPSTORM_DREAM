<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile03">
        <div>
            <h4>보유기술을 선택해 주세요</h4>
            <dl>
                <dd>
                    <button class="select openModalBtn" data-modal="modal3" @click="data.job_skills = jl.copyObject(user.job_skills); modal = true">보유기술</button>

                    <div id="modal3" class="modal" :style="{display : modal ? 'block' : 'none'}">
                        <div class="modal-content">
                            <div class="modal-title">
                                <h5>보유기술을 선택해 주세요</h5>
                                <span class="close" @click="data.job_skills = jl.copyObject(user.job_skills); modal = false;"><i class="fa-light fa-xmark"></i></span>
                            </div>
                            <div class="modal-search">
                                <i class="fa-light fa-magnifying-glass"></i><input type="search" placeholder="기술 검색" v-model="search_tab">
                            </div>
                            <div class="modal-scroll">
                                <div class="tabs-container">
                                    <div class="tabs">
                                        <template v-for="item in searchTabs">
                                            <div class="tab" :class="{'active' : tab == item}" data-tab="tab1" @click="tab = item">{{item}}</div>
                                        </template>
                                    </div>
                                    <div class="tab-content">
                                        <div id="tab" class="content" v-if="tab && subTab" style="display: block">
                                            <div class="select">
                                                <template v-for="item,index in subTab.tabs">
                                                    <input type="checkbox" :id="'checkbox'+index" :value="item" v-model="data.job_skills">
                                                    <label :for="'checkbox'+index">{{item}}</label>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-btn">
                                <button @click="confirmData">선택하기</button>
                            </div>
                        </div>
                    </div>
                </dd>
                <dd>(*최대 20개를 선택해 주세요)</dd>
            </dl>
            <dl>
                <dt class="flex"><strong>보유기술</strong><a class="del" href="" @click="event.preventDefault(); user.job_skills=[]">전체삭제</a></dt>
                <dd class="tag">
                    <template v-for="item,index in user.job_skills">
                        <span>
                            {{item}}
                            <a href="" class="del" @click="event.preventDefault(); user.job_skills.splice(index,1)"><i class="fa-light fa-xmark"></i></a>
                        </span>
                    </template>
                </dd>
            </dl>

            <div class="warning-message1AA2" v-if="user.job_skills.length > 20">
                보유기술은 최대 20개까지입니다.
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
                    job_skills : [],
                },
                modal : false,
                search_tab : "",
                tabs : [ "디자인", "마케팅", "번역·통역", "문서·글쓰기", "IT·프로그래밍", "세무·법무·노무",
                    "창업·사업", "운세", "직무역량 레슨", "취업·입시", "투잡·노하우", "취미 레슨", "생활서비스", "영상·사진·음향", "심리상담", "주문제작"],
                sub_tabs : [
                    {
                        name : "디자인",
                        tabs : ["Adobe Photoshop", "Adobe Illustrator", "Adobe Creative Suite", "Adobe Dreamweaver", "Adobe Flash",
                            "Adobe XD", "Indesign", "MicroSoft PowerPoint", "Paint tool sai", "sketch up", "Corel Painter", "Sketch3",
                            "Sketchapp", "Zeplin", "HTML &amp; CSS", "Keyshot", "3D MAX", "Rhino3D", "CATIA", "3D CAD", "PRO-E", "Fusion360",
                            "MAYA", "Zbrush", "Cinema4d", "Redshift", "Arnold", "Substance Painter", "CAD", "v-ray", "Figma", "after effect",
                            "auto cad", "blender", "lumion", "Live2D Cubism", "Vtube Studio", "Procreate", "Unity", "Unreal Engine", "Substance painter",
                            "Inventor", "Spark AR", "QUARKXPRESS", "인테리어 시공", "간판 시공", "ProtoPie", "SolidWorks", "Enscape", "Adobe Substance 3D",
                            "Adobe Lightroom"]
                    },
                    {
                        name : "마케팅",
                        tabs : ["마케팅테스트", "마케팅 Illustrator"]
                    },
                ],

                tab : "",
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
            confirmData : function() {
                this.user.job_skills = this.data.job_skills;
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
            searchTabs : function() {
                if(!this.search_tab) return this.tabs;

                var filter_tabs = this.tabs.filter(item => item.includes(this.search_tab))
                return filter_tabs;
            },
            subTab : function() {
                if(!this.tab) return undefined;

                return this.sub_tabs.find(item => item['name'] === this.tab)

            }
        },
        watch : {

        }
    });
</script>

<style>
    .warning-message1AA2 {
        color: red;
        font-size: 12px;
        font-weight: bold;
        border: 1px solid red;
        padding: 5px;
        margin: 10px 0;
        background-color: #ffe6e6;
        width: fit-content;
    }
</style>