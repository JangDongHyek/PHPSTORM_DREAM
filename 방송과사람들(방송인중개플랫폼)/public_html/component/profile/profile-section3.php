<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile03">
        <div>
            <h4>전문기술을 선택해 주세요</h4>
            <dl>
                <dd>
                    <button class="select openModalBtn" data-modal="modal3" @click="data.job_skills = jl.copyObject(user.job_skills); modal = true">전문기술</button>

                    <div id="modal3" class="modal" :style="{display : modal ? 'block' : 'none'}">
                        <div class="modal-content">
                            <div class="modal-title">
                                <h5>전문기술을 선택해 주세요</h5>
                                <span class="close" @click="data.job_skills = jl.copyObject(user.job_skills); modal = false;"><i class="fa-light fa-xmark"></i></span>
                            </div>
                            <div class="modal-search">
                                <i class="fa-light fa-magnifying-glass"></i><input type="search" placeholder="기술 검색" v-model="search_tab" @input="search_tab = event.target.value;">
                            </div>
                            <div class="modal-scroll">
                                <div class="tabs-container">
                                    <div class="tabs">
                                        <template v-for="item in searchTabs">
                                            <div class="tab" :class="{'active' : tab == item.idx}" data-tab="tab1" @click="tab = item.idx">{{item.name}}</div>
                                        </template>
                                    </div>
                                    <div class="tab-content">
                                        <div id="tab" class="content" v-if="tab && subTab" style="display: block">
                                            <div class="select">
                                                <template v-for="item,index in subTab.childs">
                                                    <input type="checkbox" :id="'checkbox'+index" :value="item.name" v-model="data.job_skills">
                                                    <label :for="'checkbox'+index">{{item.name}}</label>
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
                <dt class="flex"><strong>전문기술</strong><a class="del" href="" @click="event.preventDefault(); user.job_skills=[]">전체삭제</a></dt>
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
                전문기술은 최대 20개까지입니다.
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
                tabs : [],
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
            this.jl = new Jl('<?=$componentName?>');
            this.getData();
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
            async getData() {
                var method = "get";
                var filter = {
                    parent_idx : "jl_null"
                }

                var res = await this.jl.ajax(method,filter,"/api/skills.php");
                if (res) {
                    this.tabs = res.data;
                    console.log(res);
                    //this.jl.log(res)
                    //this.data = res.response.data
                }
            }
        },
        computed: {
            searchTabs : function() {
                if(!this.search_tab) return this.tabs;

                var filter_tabs = this.tabs.filter(item => item.name.includes(this.search_tab))
                return filter_tabs;
            },
            subTab : function() {
                if(!this.tab) return undefined;

                return this.tabs.find(item => item['idx'] === this.tab)

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