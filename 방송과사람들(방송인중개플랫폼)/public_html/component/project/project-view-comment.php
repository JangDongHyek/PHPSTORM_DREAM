<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="qna-view">
            <h6>문의 댓글</h6>
            <div>
                <textarea placeholder="문의 내용을 입력하세요." v-model="row.content"></textarea>
                <button type="button" class="qna-btn" @click="jl.postData(row,options)">문의 등록</button>
            </div>
            <h6>답변 내용</h6>
            <div>
                <div class="empty" v-if="rows.length == 0">
                    <i class="fa-solid fa-comment-question"></i>
                    등록된 문의가 없어요.
                </div>
                <ul v-else>
                    <li v-for="item in rows">

                        <div class="profile">
                            <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                            <span>{{item.$g5_member.mb_nick}}</span>
                            <div class="btn-wrap">
                                <button type="button" class="answer-btn" v-if="item.user_idx == mb_no"
                                    @click="jl.deleteData(item,{table:'project_comment',callback : callbackMethod})">삭제</button><!--본인-->
                                <button type="button" class="answer-btn" v-if="project.user_idx == mb_no"
                                    @click="row_comment.comment_idx ? row_comment.comment_idx = '' : row_comment.comment_idx = item.idx">답변</button><!--의뢰자-->
                            </div>
                        </div>
                        <p>{{item.content}}</p>
                        <div class="answer" v-for="reply in item.$project_comment">
                            <p>{{reply.content}}</p>
                            <div class="btn-wrap" v-if="project.user_idx == mb_no"><!--본인-->
                                <button type="button" class="answer-btn" @click="putReply(reply)">수정</button>
                                <button type="button" class="answer-btn"
                                    @click="jl.deleteData(reply,{table:'project_comment',callback : callbackMethod})">삭제</button>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="answer-field" v-if="row_comment.comment_idx">
                    <textarea placeholder="문의 내용을 입력하세요." v-model="row_comment.content"></textarea>
                    <button type="button" class="qna-btn" @click="jl.postData(row_comment,options)">답변 등록</button>
                </div>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type: String, default: ""},
            project : {type: Object, default: null},
        },
        data: function () {
            return {
                load : false,
                jl: null,
                component_idx: "",

                row: {
                    user_idx : this.mb_no,
                    project_idx : this.project.idx,
                    comment_idx : '',
                    content : "",
                },
                row_comment : {
                    user_idx : this.mb_no,
                    comment_idx : '',
                    content : "",
                },
                rows : [],

                options : {
                    table : 'project_comment',
                    file_use : false,
                    required : [
                        {name : "user_idx",message : `로그인이 필요한 기능입니다.`},
                        {name : "content",message : `내용을 입력해주세요.`},
                    ],
                    callback : this.callbackMethod,
                },

                filter : {
                    table : "project_comment",
                    project_idx : this.project.idx,
                    page: 1,
                    limit: 9999,
                    count: 0,

                    extensions : [
                        {table : "g5_member", foreign : "user_idx", as : ""}, // as값이있다면 $테이블명이아닌 $as값으로 가져온다
                    ],

                    relations : [
                        {table : "project_comment" ,foreign : "comment_idx",type : 'data'},
                    ],
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


            this.load = true;
        },
        async mounted() {
            await this.jl.getsData(this.filter,this.rows);
            this.$emit('commentLength',this.filter.count)
            this.$nextTick(() => {

            });
        },
        updated() {

        },
        methods: {
            async callbackMethod(res) {
                this.filter.page = 1;
                this.row.content = '';
                this.row.comment_idx = '';
                this.row_comment.comment_idx = "";
                this.row_comment.content = "";
                await this.jl.getsData(this.filter,this.rows);
                this.$emit('commentLength',this.filter.count)
                console.log(this.filter.count);
            },

            putReply(reply) {
                if(this.row_comment.comment_idx) {
                    this.row_comment.comment_idx = ""
                    this.row_comment.idx = ""
                    this.row_comment.content = ""
                }else {
                    this.row_comment = this.jl.copyObject(reply)
                }
            }
        },
        computed: {

        },
        watch: {

        }
    });

</script>

<style>

</style>