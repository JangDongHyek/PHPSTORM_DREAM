<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <article id="contest_view">
            <header>
                <div id="contest">
                    <div class="inr">
                        <div class="list cf">
                            <div class="thm">
                                <div class="mg">
                                    <!--<span class="pri">PRIME</span>prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                                    <div class="heart" id="heart_div_18">
                                        <button type="button" class="heart off" onclick="like_chk('on',18,'competition')"><i class="fa-light fa-heart"></i></button><!--좋아요 누르기전 -->
                                    </div>
                                    <a :href="'./contest_view.php?idx='+data.idx">

                                        <div class="mg_in">
                                            <div class="over">
                                                <img :src="jl.root + data.main_image[0].src">
                                            </div>
                                        </div><!--클라이언트 로고-->
                                    </a>
                                </div><!--mg-->

                                <a :href="'./contest_view.php?idx='+data.idx">

                                    <div class="info">
                                        <!-- 재능강의 작성자 정보 -->
                                        <div id="lecture_writer_list">
                                            <div class="mb">
                                                <div class="mb_info">
                                                    <p><i class="fas fa-user-circle"></i>&nbsp;{{data.$g5_member.mb_nick}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tit">{{data.subject}}</div><!--프로젝트 제목(최대1줄까지만 추출, 나머지는 ... 처리함)-->
                                        <div class="cont">{{data.content}}</div><!--프로젝트 설명(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                                        <div class="rate cf">
                                            <div class="star"><span><i class="fal fa-eye"></i> 0회</span><span>0명의 참여자</span></div>
                                            <div class="heart_hit"><span><i class="fal fa-calendar-week"></i></span> {{data.status ? '승인' : '심사중' }} </div><!--심시기간-->
                                        </div>
                                        <div class="price">희망 제작비용 {{data.price}}만원</div><!--상품가격-->
                                    </div>
                                </a>

                            </div>
                        </div><!--list-->
                    </div><!--in-->
                </div><!--//contest-->
            </header>

            <div class="wrapper inr">
                <div class="tabs cf">
                    <input name="tabs" id="tab1" checked="" type="radio">
                    <label for="tab1"><span class="hidden-xs">프로젝트 </span>의뢰 내용</label>
                    <input name="tabs" id="tab2" type="radio">
                    <label for="tab2"><span class="hidden-xs">프로젝트 </span>참여<span class="badge">0</span></label>
                    <input name="tabs" id="tab3" type="radio">
                    <label for="tab3">문의사항<span class="badge">0</span></label>

                    <!--프로젝트 내용-->
                    <div id="tab-content1" class="tab-content">
                        <div class="contest_cont">

                            <section>
                                <h3><i class="far fa-newspaper"></i> 프로젝트 의뢰내용</h3>
                                <div class="cont client">
                                    <dl>
                                        <dt>제목</dt>
                                        <dd></dd>
                                    </dl>
                                    <dl>
                                        <dt>클라이언트 명</dt>
                                        <dd></dd>
                                    </dl>
                                    <dl>
                                        <dt>서비스 설명</dt>
                                        <dd></dd>
                                    </dl>
                                </div>
                            </section>

                            <section>
                                <h3><i class="fal fa-images"></i> 참고할 자료가 있으신가요?<span>(최대 3작품 선택)</span></h3>
                                <div class="cont sample">

                                    <ul>
                                        <li><a href="">다운로드</a></li>
                                    </ul>
                                </div>
                            </section>

                            <section>
                                <h3><i class="fal fa-images"></i> 원하시는 관련키워드를 선택해주세요.</h3>
                                <div class="cont">
                                    <span class="hash">z</span>
                                </div>
                            </section>

                            <section>
                                <h3><i class="fal fa-folder-tree"></i> 프로젝트 상세내용</h3>
                                <div class="cont" style="white-space: pre-wrap;">2</div>
                            </section>
                        </div><!--//contest_cont-->
                    </div>

                    <div id="tab-content2" class="tab-content">
                        <!--프로젝트 참여 작성자 및 관리자일때-->

                        <div class="contest_cont partici">
                            <ul>
                                <li>
                                    <dl>
                                        <a href="modal">
                                            <div class="mem_area" style="background:url(<?=$url?>) no-repeat center center; background-size:; background-color:#A8A8A8">
                                                <div class="trophy"></div>
                                            </div>
                                        </a>
                                        <input type="radio" style="display: inline!important;" name="comp_win" value="">
                                        <i class="fas fa-user-circle"></i>&nbsp
                                        <dd class="date"></dd>
                                    </dl>
                                </li>
                            </ul>

<!--                            <div class="text-center empty_list" style="margin-top: 30px">-->
<!--                                <i class="far fa-image-polaroid fa-4x"></i>-->
<!--                                <p class="t_padding17">프로젝트 참여자가 없습니다. </p>-->
<!--                            </div>-->
                        </div><!--//contest_cont-->




                        <div class="text-center empty_list" style="margin-top: 30px">
                            <i class="far fa-eye-slash fa-4x"></i>
                            <p class="t_padding17">현재 진행 중인 콘테스트의 참여작은 <br />개최 의뢰자만 확인 가능합니다.</p>
                        </div>

                        <div class="text-center empty_list" style="margin-top: 30px">
                            <i class="far fa-eye-slash fa-4x"></i>
                            <p class="t_padding17">공모작 참가가 마감된 게시물 입니다.</p>
                        </div>

                        <div class="contest_cont partici">
                            <ul>
                                <li>
                                    <dl>
                                        <a href="modal">

                                            <div class="mem_area" style="background:url(<?=$url?>) no-repeat center center; background-size:cover">
                                                <div class="trophy"></div>
                                            </div>
                                        </a>
                                        <input type="radio" style="display: inline!important;" name="comp_win" value="<?=$apply_my_row['ap_idx']?>">
                                        <i class="fas fa-user-circle"></i>&nbsp
                                        <dd class="date"></dd>
                                    </dl>
                                </li>
                            </ul>
                        </div>


                        <div class="btn_partici text-right">
                                <a href="javascript:comp_win_idx(<?=$row['cp_idx']?>)"><i class="far fa-trophy-alt"></i> 당선자 선정</a>
                                <a href="javascript:comp_apply_modal()">프로젝트 참여하기</a>
                                참여자에게 금액이 지급완료되었습니다.
                        </div>
                    </div>

                    <!--참여작 보기-->
                    <div id="tab-content3" class="tab-content">
                        <div class="contest_cont">

                            <section class="cmt">
                                <textarea name="competition_comment_0" id="competition_comment_0" required="" maxlength="5000" placeholder="문의사항을 입력해주세요"></textarea>
                                <input type="button" onclick="competition_comment_update('0')" id="cmt_btn_submit" value="댓글입력" accesskey="s">
                                <p>*관련 문의사항만 등록해 주세요. 불만, 비방성 댓글은 의뢰자나 관리자에 의해 경고 없이 삭제될 수 있으며, 사이트 이용 제한이 발생할 수 있습니다.</p>
                            </section>

                            <section>
                                <!--<h3><i class="fal fa-images"></i> 프로젝트 문의사항 <span>(4)</span></h3>-->
                                <div id="item_review">
                                    <div class="in">
                                        <div class="rev cf">

                                                <div class="text-center empty_list">
                                                    <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                                    <p class="t_padding17">등록된 문의사항이 없습니다.</p>
                                                </div>

                                                <div class="list cf">
                                                    <a href="">
                                                        <div class="mg">
                                                                <img src="<?php echo G5_THEME_IMG_URL ?>/sub/default.png">
                                                        </div><!--서비스 썸네일 추출-->
                                                        <div class="info">
                                                            <div class="nick"><span><i class="fas fa-user-circle"></i></span>mb_nick</div><!--닉네임 일부분 노출-->
                                                            <div class="txt" style="white-space: pre-wrap">content</div>
                                                            <div class="date">
                                                                <div class="star">wr_date</div>
                                                            </div>
                                                            <div class="btn_gr">
                                                                <ul>
                                                                        <li><a onclick="toggle_visibility('reply_<?=$comment["comment_idx"]?>');">답변</a></li>
                                                                        <li><a href="javascript:competition_comment_del(<?=$comment["comment_idx"]?>)">삭제</a></li>
                                                                </ul>

                                                            </div>
                                                            <div id="reply_div_<?=$comment['comment_idx']?>">
                                                                    <div class="reply">
                                                                        wr_content
                                                                            <a href="javascript:competition_comment_del(<?=$reply["comment_idx"]?>)"><span style="float: right">삭제</span></a>
                                                                    </div>

                                                            </div>
                                                            <div style="display: none">
                                                                <section class="cmt">
                                                                    <textarea placeholder="답변을 입력해주세요"></textarea>
                                                                    <input type="button" value="답변입력">
                                                                </section>
                                                            </div>
                                                        </div>

                                                    </a>
                                                </div>
                                        </div><!--rev-->
                                    </div><!--in-->
                                        <div class="review_more"><a href="">더 보기</a></div>
                                </div>
                            </section>
                        </div><!--//contest_cont-->
                    </div>

                </div><!--//tabs-->
            </div>

        </article>
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

                data: {},
                arrays : [],

                options : {
                    required : [
                        {name : "",message : ``},
                    ],
                    href : "",
                },

                filter : {
                    table : "project",
                    primary : this.primary,

                    page: 1,
                    limit: 1,
                    count: 0,

                    extensions : [
                        {table : "g5_member", foreign : "user_idx"}
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

            if(this.primary) this.data = await this.jl.getData(this.filter);
//await this.jl.getsData(this.filter,this.arrays);

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