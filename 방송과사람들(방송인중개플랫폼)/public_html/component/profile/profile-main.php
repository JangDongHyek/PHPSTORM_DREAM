<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="mypage_cont">
        <div class="box">
            <div id="smartwizard">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="#step-1" @click="section = getHashValue('step-1')"><div class="num">1</div> <span>기본정보</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-2" @click="section = getHashValue('step-2')"><div class="num">2</div> <span>전문/상세분야</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-3" @click="section = getHashValue('step-3')"><div class="num">3</div> <span>학력 전공/자격증</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-4" @click="section = getHashValue('step-4')"><div class="num">4</div> <span>경력기간/사항</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-5" @click="section = getHashValue('step-5')"><div class="num">5</div> <span>희망 시급</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-6" @click="section = getHashValue('step-6')"><div class="num">6</div> <span>상주 여부</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#step-7" @click="section = getHashValue('step-7')"><div class="num">7</div> <span>프로젝트 이력</span></a></li>
                </ul>

                <div id="profile_form" class="tab-content">
                    <profile-section1 v-if="section == 'step-1'" :user="data"></profile-section1>
                    <profile-section2 v-if="section == 'step-2'" :user="data"></profile-section2>
                    <!--                    <profile-section3 v-if="section == 3" :user="data"></profile-section3>-->
                    <profile-section4 v-if="section == 'step-3'" :user="data"></profile-section4>
                    <profile-section5 v-if="section == 'step-4'" :user="data"></profile-section5>
                    <profile-section6 v-if="section == 'step-5'" :user="data"></profile-section6>
                    <profile-section7 v-show="section == 'step-6'" :user="data" ref="section6"></profile-section7>
                    <profile-section8 v-if="section == 'step-7'" :user="data"></profile-section8>
                </div>

                <div class="btn_confirm">
                    <button class="btn btn-prev" @click="changeStep('prev')">이전</button>
                    <button id="next-btn" class="btn_submit" @click="changeStep('next')">저장하고 다음</button>
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

            this.section = this.getHashValue();
            console.log(this.section);

        },
        methods: {
            async changeStep(change) {
                if(change == "next") {
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