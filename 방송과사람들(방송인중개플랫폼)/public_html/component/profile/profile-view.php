<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="profile_view" class="view">
        <div class="inr">

            <div class="item_right">
                <div class="item_hd">
                    <div class="title">{{member.mb_nick}} 님의 프로필</div>
                    <!--공유하기버튼--><a class="btn_share"><i class="fa-regular fa-share-nodes"></i></a>
                </div>
                <div class="item_info">
                    <template v-for="item in job_categories">
                        <i class="cate" >{{item.name}}</i>&nbsp; <!--전문분야-->
                    </template>
                    <part-member-info :member="member" :login_mb_no="login_mb_no"></part-member-info>
                    <br>
                </div>
            </div>
            <div class="item_left">
                <div class="area_tab">
                    <nav class="lnb">
                        <div class="inr">
                            <ul>
                                <li><a href="#area_info">전문가 정보</a></li>
                                <li><a href="#area_service">서비스</a></li>
                                <li><a href="#area_portfolio">포트폴리오</a></li>
                                <li><a href="#area_review">서비스 평가</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="tab_cont">
                        <section id="area_info">
                            <h3>전문가 정보</h3>
                            <div class="box_line">
                                <h4>활동정보</h4>
                                <dl class="grid">
                                    <dt>연락 가능 시간</dt>
                                    <dd>{{member.job_sdate}}시 ~ {{member.job_edate}}시</dd>
                                    <dt>희망 시급</dt>
                                    <dd>{{member.job_hourly}}원 <span v-if="member.job_hourly_consultation">(협의가능)</span></dd>
                                    <dt>상주 가능 여부</dt>
                                    <dd>{{member.job_work_stay}}</dd>
                                    <!--상주 가능 으로 체크 했을시 추가되는 부분-->
                                    <template v-if="member.job_work_stay == '상주 가능'">
                                        <dt>희망 근무 형태</dt>
                                        <dd>
                                            <span v-for="item in member.job_work_form">{{item}}/</span>
                                        </dd>
                                        <dt>희망 근무지</dt>
                                        <dd>{{member.job_work_address}}</dd>
                                        <dt>현재상태</dt>
                                        <dd>{{member.job_work_status}}</dd>
                                        <dt>근무 시작 가능일</dt>
                                        <dd>{{member.job_work_date}}</dd>
                                        <dt>희망 월급 (세전)</dt>
                                        <dd>{{parseInt(member.job_work_smonth).format()}}원-{{parseInt(member.job_work_emonth).format()}}원</dd>
                                    </template>
                                    <!--상주 가능 으로 체크 했을시 추가되는 부분-->
                                </dl>
                            </div>
                            <div class="box_line">
                                <h4>경력 사항</h4>
                                <dl class="grid" >
                                    <template v-for="item in career">
                                        <dt>{{item.name}}</dt>
                                        <dd>{{item.year}}년 {{item.month}}개월</dd>
                                    </template>
                                </dl>
                            </div>
                            <div class="box_line">
                                <h4>관련 기술</h4>
                                <div class="tag">
                                    <span v-for="item in member.job_skills">{{item}}</span>
                                </div>
                            </div>
                            <div class="box_line">
                                <h4>학력 전공</h4>
                                <dl class="grid">
                                    <template v-for="item in school">
                                        <dt>{{item.name}}</dt>
                                        <dd>{{item.major}}({{item.state}})</dd>
                                    </template>
                                </dl>
                            </div>
                            <div class="box_line">
                                <h4>자격증</h4>
                                <dl class="grid">
                                    <template v-for="item in certify">
                                        <dt>{{item.name}}</dt>
                                        <dd>{{item.issue_date}}</dd>
                                    </template>
                                </dl>
                            </div>
                        </section>
                        <section id="area_service">
                            <h3>서비스</h3>
                            <part-member-product :mb_no="mb_no" :login_mb_no="login_mb_no"></part-member-product>
                        </section>

                        <section id="area_portfolio">
                            <h3>포트폴리오</h3>
                            <!--디자인 변경-->
                            <?php if($_SERVER['REMOTE_ADDR'] == "59.19.201.109" || $_SERVER['REMOTE_ADDR'] == "121.140.204.65"){ ?>
                                <div class="portfolio_list">
                                    <ul>
                                        <li>
                                            <div>

                                                <button>더보기</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?php }?>
                            <!--//디자인 변경-->
                            <part-member-portfolio :mb_no="mb_no" :login_mb_no="login_mb_no"></part-member-portfolio>
                        </section>

                        <section id="area_review">
                            <h3>받은 평가</h3>
                            <part-member-review :mb_no="mb_no" :login_mb_no="login_mb_no"></part-member-review>
                        </section>
                    </div>


                </div>
            </div>

        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            login_mb_no : {type : String, default : ""},
            modal : {type : Boolean, default : false},
            mb_no : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {},
                required : [
                    {name : "",message : ""},
                ],
                data : {},

                member : {},
                job_categories : [],
                career : [],
                school : [],
                certify : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getMember();
            this.getCareer();
            this.getSchool();
            this.getCertify();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            async getCertify() {
                let filter = {
                    member_idx : this.mb_no
                };

                try {
                    let res = await this.jl.ajax("get",filter,"/api2/member_certify.php");
                    this.certify = res.data;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getSchool() {
                let filter = {
                    member_idx : this.mb_no
                };

                try {
                    let res = await this.jl.ajax("get",filter,"/api2/member_school.php");
                    this.school = res.data;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getCareer() {
                let filter = {
                    member_idx : this.mb_no
                };

                try {
                    let res = await this.jl.ajax("get",filter,"/api2/member_career.php");
                    this.career = res.data;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getCategory(arrays) {
                let filter = {
                    in : [
                        { key : "idx", array : arrays}
                    ]
                };

                try {
                    let res = await this.jl.ajax("get",filter,"/api2/category.php");
                    this.job_categories = res.data;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getMember() {
                let filter = {mb_no : this.mb_no};
                try {
                    let res = await this.jl.ajax("get",filter,"/api2/g5_member.php");
                    this.member = res.data[0]

                    let job_categories = [];
                    this.member.job_categories.forEach(function(item) {
                        job_categories.push(...item.childs)
                    });

                    this.job_categories = this.getCategory(job_categories)
                }catch (e) {
                    alert(e.message)
                }
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