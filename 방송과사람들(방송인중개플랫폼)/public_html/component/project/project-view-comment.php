<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="qna-view">
            <h6>문의 댓글</h6>
            <div>
                <textarea placeholder="문의 내용을 입력하세요."></textarea>
                <button type="button" class="qna-btn">문의 등록</button>
            </div>
            <h6>답변 내용</h6>
            <div>
                <div class="empty">
                    <i class="fa-solid fa-comment-question"></i>
                    등록된 문의가 없어요.
                </div>
                <ul>
                    <li>

                        <div class="profile">
                            <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                            <span>지원자</span>
                            <div class="btn-wrap">
                                <button type="button" class="answer-btn">삭제</button><!--본인-->
                                <button type="button" class="answer-btn">답변</button><!--의뢰자-->
                            </div>
                        </div>
                        <p>문의 내용입니다.</p>
                        <div class="answer">
                            <p>답변 내용입니다.</p>
                            <div class="btn-wrap"><!--본인-->
                                <button type="button" class="answer-btn">수정</button>
                                <button type="button" class="answer-btn">삭제</button>
                            </div>
                        </div>
                        <div class="answer-field">
                            <textarea placeholder="문의 내용을 입력하세요."></textarea>
                            <button type="button" class="qna-btn">답변 등록</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type: String, default: ""},
        },
        data: function () {
            return {
                load : false,
                jl: null,
                component_idx: "",

                row: {},
                rows : [],

                options : {
                    file_use : false,
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
                    count: 0,
                },

                modal : {
                    status : false,
                    data : {},
                },

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            //if(this.primary) this.row = await this.jl.getData(this.filter);
//await this.jl.getsData(this.filter,this.rows);

            this.load = true;
        },
        mounted() {
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {

        },
        computed: {

        },
        watch: {

        }
    });

</script>

<style>

</style>