<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="item_write">
        <div class="inr v2">
            <h3>서비스등록</h3>
            <div class="snb">
                <ul class="list_step">
                    <li id="">
                        <a href="" @click="event.preventDefault(); $emit('changeTab',1);">
                            <em>1</em>
                            <span>기본정보</span>
                        </a>
                    </li>
                    <li id="" class="active">
                        <a href="" @click="event.preventDefault(); $emit('changeTab',2);">
                            <em>2</em>
                            <span>서비스 설명</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="" @click="event.preventDefault(); $emit('changeTab',3);">
                            <em>3</em>
                            <span>이미지 등록</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box_list">
                <div class="box_content">
                    <div class="box_write02">
                        <h4>서비스설명</h4>
                        <div class="cont">
                            <naver-editor :content="product.service" ref="naverEditor" v-if="visible"></naver-editor>
                        </div>
                    </div>
                    <!--<div class="box_write02">
						<h4>수정·재진행</h4>
						<div class="cont">
							<textarea name = "i_update_content"><?/*=$view['i_update_content']*/?></textarea>
						</div>
					</div>-->
                    <div class="box_write02">
                        <h4>취소 및 환불 규정</h4>
                        <div class="cont">
                            <div class="box_refund">
                                <span>취소 및 환불규정은 판매하시는 서비스의 관련 법령에 따라 일괄 적용됩니다.</span>
                                <div @click="modal = true;" class="btn_info">취소 및 환불규정 보기</div>
                            </div>
                        </div>
                    </div>

                    <slot-modal :modal="modal" title="취소 및 환불규정 보기" @close="modal = false">
                        <div class="cont ref" style="white-space: pre-wrap;">내용</div><!--cont-->
                    </slot-modal>
                    
                    
                    <div class="box_write02">
                        <h4>자주 묻는 질문</h4>
                        <div class="cont faq">
                            <div class="faq_active">
                                <dl class="box_gray" v-for="item,index in product.questions">
                                    <a class="del" href="" @click="event.preventDefault(); product.questions.splice(index,1)"><i class="fa-regular fa-trash"></i></a>
                                    <dt>
                                        <strong>Q.</strong>
                                        <input type="text" placeholder="자주 묻는 질문을 입력해주세요" v-model="item.question">
                                    </dt>
                                    <dd>
                                        <strong>A.</strong>
                                        <textarea type="text" placeholder="답변을 입력해주세요" v-model="item.answer"></textarea>
                                    </dd>
                                </dl>
                            </div>
                            <button class="btn_add" @click="product.questions.push({})"><i class="fa-light fa-plus"></i> 질문 추가</button>
                        </div>
                    </div>
                    <div class="box_write02">
                        <h4>상품 정보 제공 고지</h4>
                        <div class="cont">
                            <div class="box_gray">
                                <dl class="grid2">
                                    <dt>서비스 제공자</dt>
                                    <dd><input type="text" v-model="product.product_info1" placeholder="서비스 제공자"></dd>
                                    <dt>취소·환불 조건</dt>
                                    <dd><input type="text" v-model="product.product_info2" placeholder="최소 및 환불 규정 참조"></dd>
                                    <dt>인증·허가사항</dt>
                                    <dd><input type="text" v-model="product.product_info3" placeholder="상품 상세 참조"></dd>
                                    <dt>취소·환불방법</dt>
                                    <dd><input type="text" v-model="product.product_info4" placeholder="취소 및 환불 규정 참조"></dd>
                                    <dt>이용조건</dt>
                                    <dd><input type="text" v-model="product.product_info5" placeholder="상품 상세 참조"></dd>
                                    <dt>소비자 상담전화</dt>
                                    <dd><input type="text" v-model="product.product_info6" placeholder="예) (고객센터)1234-1234"></dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="area_btn">

                <a class="btn_prev" href="" @click="event.preventDefault(); $emit('changeTab',1)">이전</a>
                <a class="btn_next" href="" @click="event.preventDefault(); $emit('changeTab',3)">다음</a>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            product : {type : Object, default : null},
            content : {type : String, default : ""},
            name : {type : String, default : ""},
            tab : {type : Number, default : 0},
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },

                modal : false,

                visible : false
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');

        },
        mounted: function(){
            this.$nextTick(() => {
            });
        },
        methods: {

        },
        computed: {

        },
        watch : {
            tab : function(){
                if(this.tab == 2) this.visible = true;
            }
        }
    });
</script>

<style>

</style>