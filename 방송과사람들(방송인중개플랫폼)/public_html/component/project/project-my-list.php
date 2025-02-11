<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="list cf">
            <div class="thm" v-for="item in arrays">
                <div class="mg">
                    <!--<span class="pri">PRIME</span>prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                    <div class="heart" id="heart_div_18">
                        <button type="button" class="heart off" onclick="like_chk('on',18,'competition')"><i class="fa-light fa-heart"></i></button><!--좋아요 누르기전 -->
                    </div>
                    <a :href="'./contest_view.php?idx='+item.idx">

                        <div class="mg_in">
                            <div class="over">
                                <img :src="jl.root + item.main_image[0].src">
                            </div>
                        </div><!--클라이언트 로고-->
                    </a>
                </div><!--mg-->

                <a :href="'./contest_view.php?idx='+item.idx">

                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                            <div class="mb">
                                <div class="mb_info">
                                    <p><i class="fas fa-user-circle"></i>&nbsp;{{item.$g5_member.mb_nick}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tit">{{item.subject}}</div><!--프로젝트 제목(최대1줄까지만 추출, 나머지는 ... 처리함)-->
                        <div class="cont">{{item.content}}</div><!--프로젝트 설명(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                        <div class="rate cf">
                            <div class="star"><span><i class="fal fa-eye"></i> 0회</span><span>0명의 참여자</span></div>
                            <div class="heart_hit"><span><i class="fal fa-calendar-week"></i></span> {{item.status ? '승인' : '심사중' }} </div><!--심시기간-->
                        </div>
                        <div class="price">희망 제작비용 {{item.price}}만원</div><!--상품가격-->
                    </div>
                </a>

            </div>
        </div><!--list-->

        <item-pagination :filter="filter" @change="filter.page = $event; jl.getsData(filter,arrays);"></item-pagination>
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
                    user_idx : this.mb_no,

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

            //if(this.primary) this.data = await this.jl.getData(this.filter);
            await this.jl.getsData(this.filter,this.arrays);

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