<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="mypage_cont">
        <div class="box">
            <div id="smartwizard">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="#step-1" @click="navEvent('step-1',$event)"><div class="num">1</div> <span>기본정보</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-2" @click="navEvent('step-2',$event)"><div class="num">2</div> <span>전문 분야/기술</span></a></li>
<!--                    <li class="nav-item"><a class="nav-link" href="#step-3" @click="navEvent('step-3',$event)"><div class="num">3</div> <span>전문기술</span></a></li>-->
                    <li class="nav-item"><a class="nav-link" href="#step-3" @click="navEvent('step-3',$event)"><div class="num">4</div> <span>학력 및 자격증</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-4" @click="navEvent('step-4',$event)"><div class="num">5</div> <span>경력사항</span></a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#step-6" @click="navEvent('step-5',$event)"><div class="num">6</div> <span>희망 시급</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-7" @click="navEvent('step-6',$event)"><div class="num">7</div> <span>상주 여부</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-8" @click="navEvent('step-7',$event)"><div class="num">8</div> <span>프로젝트 이력</span></a></li>-->
                </ul>

                <div id="profile_form" class="tab-content">
                    <profile-section1 v-if="section == 'step-1'" :user="data"></profile-section1>
                    <profile-section2 v-if="section == 'step-2'" :user="data"></profile-section2>
<!--                    <profile-section3 v-if="section == 'step-3'" :user="data"></profile-section3>-->
                    <profile-section4 v-if="section == 'step-3'" :user="data"></profile-section4>
                    <profile-section5 v-if="section == 'step-4'" :user="data"></profile-section5>
                    <!--<profile-section6 v-if="section == 'step-6'" :user="data"></profile-section6>
                    <profile-section7 v-show="section == 'step-7'" :user="data" ref="section6"></profile-section7>
                    <profile-section8 v-if="section == 'step-8'" :user="data"></profile-section8>-->
                </div>

                <div class="btn_confirm">
                    <button class="btn btn-prev" type="button" @click="changeStep('prev')">이전</button>
                    <button id="next-btn" type="button" class="btn_submit" @click="changeStep('next')">
                        <template v-if="!admin">
                            <span v-if="section != 'step-4'">다음</span>
                            <span v-else>저장</span>
                        </template>
                        <template v-else>다음</template>
                    </button>
                </div>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type : String, default : ""},
            admin : {type : Boolean, default : false},
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    mb_no: this.mb_no
                },
                data : {},
                section : "step-1",
                origin_nick : "",

                reload : false,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {
                $('#smartwizard').smartWizard({
                    transition: {
                        animation: 'slideHorizontal' // Step content 애니메이션: none|fade|slideHorizontal|slideVertical|slideSwing|css
                    },
                    toolbar: {
                        showNextButton: false, // 다음 버튼 표시
                        showPreviousButton: false, // 이전 버튼 표시
                    },
                    onLeaveStep: function (obj, context) {
                        // 마지막 단계에 도달한 경우 버튼 텍스트 변경
                        if (context.toStep === 7) { // Step 7 is the last step
                            $('#next-btn').text('프로필 저장하기');
                        } else {
                            $('#next-btn').text('저장하고 다음');
                        }
                    }
                });


            });


            console.log(this.section);

        },
        updated : function() {
            console.log('update');
            if(!this.reload) {
                this.section = this.getHashValue();
                this.reload = true;
            }
        },
        methods: {
            navEvent(step,event) {
                let cl = Array.from(event.currentTarget.classList);
                if(cl.includes('done')) this.section = step;
            },
            async changeStep(change) {
                if(change == "next" && !this.admin) {
                    if(!await this.updateData()) return false;
                }
                $('#smartwizard').smartWizard(change)
                this.section = this.getHashValue();
                console.log(this.section);
            },
            getHashValue(val = '') {
                if(val) return val;
                // window.location.hash로 # 이후 값을 가져옴
                const hash = window.location.hash;

                // # 기호 제거 후 반환
                return hash ? hash.substring(1) : 'step-1'; // null은 #이 없을 때 반환
            },
            async checkNick() {
                if(this.data.mb_nick.trim() == "") {
                    alert("닉네임을 입력해주세요.")
                    return false;
                }
                var method = "get";
                var filter = {mb_nick : this.data.mb_nick};

                var res = await this.jl.ajax(method,filter,"/api/g5_member.php");
                if (res) {
                    this.jl.log(res)
                    if(res.response.count > 0 && this.origin_nick != this.data.mb_nick) {
                        alert("존재하는 닉네임입니다.")
                        return false
                    }

                    return true
                }
            },
            async updateData() {
                let msg = "";
                switch (this.section) {
                    case "step-1" : {
                        if(!await this.checkNick()) {
                            return false;
                        }
                        break;
                    }

                    case "step-2" : {
                        if(this.data.job_categories.length > 3) {
                            alert("전문분야는 최대 3개까지 가능합니다");
                            return false;
                        }

                        if(this.data.job_skills.length > 20) {
                            alert("보유기술은 최대 20개까지 가능합니다");
                            return false;
                        }


                        break;
                    }

                    case "step-3" : {
                        break;
                    }

                    case "step-4" : {
                        break;
                    }

                    case "step-5" : {
                        break;
                    }

                    case "step-6" : {
                        if(this.$refs.section6.checkMonth(this.data.job_work_smonth)) {
                            alert("희망월급의 최소부분을 확인해주세요.");
                            return false;
                        }

                        if(this.$refs.section6.checkMonth(this.data.job_work_emonth)) {
                            alert("희망월급의 최대부분을 확인해주세요.");
                            return false;
                        }
                        break;
                    }

                    case "step-7" : {

                        break;
                    }

                    case "step-8" : {
                        break;
                    }
                }



                this.data.mb_profile = true;

                var method = "update";
                var obj = JSON.parse(JSON.stringify(this.data));

                var res = await this.jl.ajax(method,obj,"/api/g5_member.php");
                if (res) {
                    if(this.section == 'step-4') alert('저장되었습니다.')
                    return true;
                }
            },
            async getData() {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                console.log(filter)

                var res = await this.jl.ajax(method,filter,"/api/g5_member.php");
                if (res) {
                    this.jl.log(res)
                    this.data = res.response.data[0]
                    this.origin_nick = res.response.data[0].mb_nick;

                    if(!this.data.work_area) this.data.work_area = [];
                    if(!this.data.job_categories) this.data.job_categories = [];
                    if(!this.data.job_skills) this.data.job_skills = [];
                    if(!this.data.job_work_form) this.data.job_work_form = [];
                    if(!this.data.job_project) this.data.job_project = [];
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
    @media screen and (max-width:1024px) {
        #area_my{display: none;}
        #ft{display: none;}
    }

    /*프로필 스텝위자드*/
    #profile_form.tab-content{margin: 0; padding: 0;}
    .sw>.progress{margin-bottom: 4px;}
    .sw>.progress>.progress-bar{background: #0c0cba;}

    .sw-theme-basic{border: 0;}
    .sw-theme-basic>.nav .nav-link{margin-right: 0; display: flex;align-items: center; padding: 1rem;}
    .sw>.nav .nav-link>span{line-height: 1.2em;}
    .sw-theme-basic>.nav .nav-link.active{background:#0c0cba; color: #fff!important;}
    .sw-theme-basic>.nav .nav-link.active::after{background:#0c0cba!important;}
    .sw-theme-basic>.nav .nav-link.done{color: #ccc!important; background: #eee;}
    .sw-theme-basic>.nav .nav-link.done::after{background: #ddd;}

    .sw>.tab-content>.tab-pane{visibility:visible; min-height: 200px; padding: 2rem;}
    .sw>.tab-content>.tab-pane{}

    #smartwizard .btn_confirm{display: flex; gap: 4px; padding: 0.5em 1em;}
    #smartwizard .btn_confirm button{width: 100%; height: auto}
    #smartwizard .btn_confirm .btn_submit{width: 100%; border-radius: 5px!important; padding:13px 10px; font-size: 15px!important; letter-spacing:-0.2px!important; font-weight: 500; background: #0c0cba}

    @media screen and (max-width:1024px) {
        #smartwizard .btn_confirm{position: fixed; background: #fff; width: 100%; left: 0; bottom: 0; z-index: 998;}

    }
    @media screen and (max-width: 640px){
        .sw>.nav{flex-direction: unset!important; flex-wrap:nowrap;}
        .sw>.nav .nav-link>span{display: none;}
        .sw-theme-basic>.nav .nav-link{margin-right: 0; text-align: center;}
        .sw>.nav .nav-link>.num {
            font-size: 1em;
            text-align: center;
            width: 100%;
        }
    }
</style>