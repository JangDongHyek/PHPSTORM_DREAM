<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <section id="profile02">
        <div>
            <h4>전문분야 및 상세 분야를 선택해 주세요</h4>
            <dl>
                <dd>
                    <button class="select openModalBtn" data-modal="modal1" @click="modal1 = true;">{{category1 ?
                        category1.name : '전문분야'}}
                    </button>

                    <div id="modal1" class="modal" :style="{display : modal1 ? 'block' : 'none'}">
                        <div class="modal-content">
                            <div class="modal-title">
                                <h5>전문 분야를 선택해 주세요</h5>
                                <span class="close" @click="modal1 = false"><i class="fa-light fa-xmark"></i></span>
                            </div>
                            <div class="modal-scroll">
                                <div class="select">
                                    <template v-for="item,index in categories">
                                        <input type="radio" v-model="cate1_idx" :value="item.idx" :id="'radio' + index"
                                               name="cate1_radio"><label :for="'radio' + index">{{item.name}}</label>
                                    </template>
                                </div>
                            </div>
                            <div class="modal-btn">
                                <button @click="modal1 = false; modal2 = true;">선택하기</button>
                            </div>
                        </div>
                    </div>
                </dd>
                <dd>
                    <button v-show="category1" class="select openModalBtn" data-modal="modal2" @click="modal2 = true;">
                        상세분야
                    </button>
                    <template v-if="!category1">
                        <button class="select" @click="alert('전문 분야를 선택해주세요')">상세분야</button>
                    </template>
                    <div id="modal2" class="modal" :style="{display : modal2 ? 'block' : 'none'}">
                        <div class="modal-content">
                            <div class="modal-title">
                                <h5>상세분야를 선택해 주세요<span class="txt_blue">최대5개</span></h5>
                                <span class="close" @click="modal2 = false"><i class="fa-light fa-xmark"></i></span>
                            </div>
                            <div class="modal-scroll">
                                <div class="select" v-if="category1">
                                    <template v-for="item,index in category1.childs">
                                        <input type="radio" :value="item.idx" :id="'radio2' + index"
                                               :checked="cate2_idx.includes(item.idx)" @click="handleCategory(item.idx)">
                                        <label :for="'radio2' + index">{{item.name}}</label>
                                    </template>
                                </div>
                            </div>
                            <div class="modal-btn">
                                <button @click="pushCategory">선택하기</button>
                            </div>
                        </div>
                    </div>
                </dd>
                <dd>(*최대 3개를 선택해 주세요)</dd>
            </dl>
            <dl v-for="item,index in user.job_categories">
                <dt class="flex"><strong>{{findCategory(item.idx).name}}</strong>
                    <a class="del" href="" @click="event.preventDefault(); user.job_categories.splice(index,1)">전체삭제</a>
                </dt>
                <dd class="tag">
                    <span v-for="child,index2 in item.childs">{{findCategory(item.idx,child).name}}
                        <a class="del" @click="item.childs.splice(index2,1)"><i class="fa-light fa-xmark"></i></a>
                    </span>
                </dd>
            </dl>

            <div class="warning-message1AA2" v-if="user.job_categories.length > 3">
                전문분야는 최대 3개까지입니다.
            </div>
        </div>

        <div>
            <h4>보유기술을 선택해 주세요</h4>
            <dl>
                <dd>
                    <button class="select openModalBtn" data-modal="modal3" @click="job_skills = jl.copyObject(user.job_skills); modal3 = true">보유기술</button>

                    <div id="modal3" class="modal" :style="{display : modal3 ? 'block' : 'none'}">
                        <div class="modal-content">
                            <div class="modal-title">
                                <h5>보유기술을 선택해 주세요</h5>
                                <span class="close" @click="job_skills = jl.copyObject(user.job_skills); modal3 = false;"><i class="fa-light fa-xmark"></i></span>
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
                                                    <input type="checkbox" :id="'checkbox'+index" :value="item.name" v-model="job_skills">
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
        data: function () {
            return {
                jl: null,
                filter: {
                    parent_idx: "",
                },
                categories: [],
                modal1: false,
                modal2: false,
                cate1_idx: "",
                cate2_idx: [],

                data: {
                    job_categories: [],
                },


                job_skills : [],
                modal3 : false,
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
        created: function () {
            this.jl = new Jl('<?=$componentName?>');
            this.getCategory()
            this.getData();
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            confirmData : function() {
                this.user.job_skills = this.job_skills;
                this.modal3 = false;
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
            },
            findCategory : function(parent,child = "") {
                if(this.categories.length == 0) return {name : ''};

                var first = this.categories.find(item => item['idx'] == parent);
                if(child) {
                    var second = first.childs.find(item => item['idx'] == child);
                    return second
                }
                console.log(first);
                return first;
            },
            handleCategory: function (idx) {
                var index = this.cate2_idx.indexOf(idx);

                if (index > -1) {
                    this.cate2_idx.splice(index, 1);
                } else if (this.cate2_idx.length > 4) {
                    event.preventDefault();
                } else {
                    this.cate2_idx.push(idx);

                }

            },
            pushCategory: function () {
                const index = this.user.job_categories.findIndex(item => item.idx === this.cate1_idx);
                if(index > -1) {
                    this.user.job_categories[index].childs = this.cate2_idx;
                }else {
                    var object = {idx : this.cate1_idx,childs : this.cate2_idx};
                    this.user.job_categories.push(object);
                }

                this.modal2 = false;
            },
            async getCategory() {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var res = await this.jl.ajax(method,filter,"/api/category.php");
                if (res) {
                    this.jl.log(res)
                    this.categories = res.response.data
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

            },
            category1: function () {
                if (this.cate1_idx) {
                    for (let i = 0; i < this.categories.length; i++) {
                        if (this.categories[i].idx == this.cate1_idx) return this.categories[i];
                    }
                }

                return null
            }
        },
        watch: {
            cate1_idx: function () {
                const index = this.user.job_categories.findIndex(item => item.idx === this.cate1_idx);
                console.log(index);
                if(index > -1) {
                    this.cate2_idx = this.user.job_categories[index].childs
                }else {
                    this.cate2_idx = [];
                }
            }
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