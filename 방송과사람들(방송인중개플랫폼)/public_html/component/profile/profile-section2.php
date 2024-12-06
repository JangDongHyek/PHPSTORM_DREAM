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
                }
            };
        },
        created: function () {
            this.jl = new Jl('<?=$componentName?>');
            this.getCategory()
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
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