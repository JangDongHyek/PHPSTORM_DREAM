<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="company_info">
        <div class="profile_box">
            <div class="profile">
                <img :src="member.profile_image">
            </div>
            <div class="profile_info" @click="goUrl()">
                <h3>{{member.mb_nick}}</h3>

                <div class="area_star">
                    <div class="img_star v45">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <em>5.0</em>
                    <span class="review">(0개 리뷰)</span>
                </div>
            </div>
        </div>
        <ul class="list_info">
            <li>
                <span>거래건수</span>
                <h3>10건</h3>
            </li>
            <li>
                <span>만족도</span>
                <h3>98%</h3>
            </li>
            <li>
                <span>회원구분</span>
                <h3>
                    개인
                </h3>
            </li>

        </ul>
        <!--자기소개글-->
        <div class="btn_ft"><a href="javascript:chatting('<?=$mb['mb_id']?>',<?=$view['i_idx']?>)" class="btn_cs">전문가에게 문의하기</a></div>
        <div class="btn_ft" v-if="login_mb_no == member.mb_no"><a class="btn_cs" :href="jl.root + '/bbs/mypage_profile.php'">프로필 등록 및 수정</a></div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            login_mb_no : {type : String, default : ""},
            member : {type : Object, default : false},
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    primary : this.primary
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {},
                member : null,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            goUrl() {
                window.location.href = this.jl.root + "/bbs/profile.php?mb_no=" + this.member.mb_no
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>