<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile02">
        <div>
            <h4>전문분야 및 상세 분야를 선택해 주세요</h4>
            <dl>
                <dd>
                    <button class="select openModalBtn" data-modal="modal1">{{category1 ? category1.name : '전문분야'}}</button>

                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <div class="modal-title">
                                <h5>전문 분야를 선택해 주세요</h5>
                                <span class="close"><i class="fa-light fa-xmark"></i></span>
                            </div>
                            <div class="modal-scroll">
                                <div class="select">
                                    <template v-for="item,index in data">
                                        <input type="radio" v-model="user.cate1_idx" :value="item.idx" :id="'radio' + index" name="cate1_radio"><label :for="'radio' + index">{{item.name}}</label>
                                    </template>
                                </div>
                            </div>
                            <div class="modal-btn">
                                <button>선택하기</button>
                            </div>
                        </div>
                    </div>
                </dd>
                <dd>
                    <button v-show="category1" class="select openModalBtn" data-modal="modal2">상세분야</button>
                    <template v-if="!category1">
                        <button class="select" @click="alert('전문 분야를 선택해주세요')">상세분야</button>
                    </template>
                    <div id="modal2" class="modal">
                        <div class="modal-content">
                            <div class="modal-title">
                                <h5>상세분야를 선택해 주세요<span class="txt_blue">최대5개</span></h5>
                                <span class="close"><i class="fa-light fa-xmark"></i></span>
                            </div>
                            <div class="modal-scroll">
                                <div class="select">
                                    <input type="checkbox" id="" name="" checked><label for="">로고디자인</label>
                                    <input type="checkbox" id="" name=""><label for="">브랜드 디자인·가이드</label>
                                </div>
                            </div>
                            <div class="modal-btn">
                                <button>선택하기</button>
                            </div>
                        </div>
                    </div>
                </dd>
                <dd>(*최대 3개를 선택해 주세요)</dd>
            </dl>
            <dl>
                <dt class="flex"><strong>디자인</strong><a class="del">전체삭제</a></dt>
                <dd class="tag">
                    <span>웹·모바일 디자인 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                    <span>마케팅 디자인 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                    <span>캐릭터 ·일러스트 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                </dd>
            </dl>
            <dl>
                <dt class="flex"><strong>문서·글쓰기</strong><a class="del">전체삭제</a></dt>
                <dd class="tag">
                    <span>스토리텔링 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                    <span>산업별 전문 글작성 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                </dd>
            </dl>
        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            user : {type : Object, default : {}}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    parent_idx : "",
                },
                data : [],
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
            this.getCategory()
        },
        mounted: function(){
            this.$nextTick(() => {
                // 모달 열기
                $('.openModalBtn').on('click', function() {
                    var modalId = $(this).data('modal');
                    $('#' + modalId).show();
                });

                // 모달 닫기
                $('.modal .close').on('click', function() {
                    $(this).closest('.modal').hide();
                });

                // 선택하기 버튼 클릭 시 모달 닫기
                $('.modal-btn button').on('click', function() {
                    $(this).closest('.modal').hide();
                });

                // 모달 외부 클릭 시 모달 닫기
                $(window).on('click', function(e) {
                    if ($(e.target).hasClass('modal')) {
                        $(e.target).hide();
                    }
                });
            });
        },
        methods: {
            getCategory: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/category.php", objs);
                if (res) {
                    this.jl.log(res)
                    this.data = res.response.data
                }
            }
        },
        computed: {
            category1 : function() {
                if(this.user.cate1_idx) {
                    for (let i = 0; i < this.data.length; i++) {
                        if(this.data[i].idx == this.user.cate1_idx) return this.data[i];
                    }
                }

                return null
            }
        },
        watch : {

        }
    });
</script>

<style>

</style>