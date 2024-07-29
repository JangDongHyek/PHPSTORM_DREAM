<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="mypage_cont">
        <div class="box">
            <h3>프로필관리</h3>

            <div id="profile_form">

                <div class="myinfo_wrap" >
                    <form id = 'imgfrm'>
                        <input type="file" name="mb_icon" id="mb_icon" onchange="getImgPrev(this);" accept="image/*" style="display: none">

                        <div class="area_photo">
                            <div class="photo basic" id="img_area" onclick="file_click();">
                                <?php
                                $icon_file = G5_DATA_PATH.'/file/member/'.$member['mb_no'].'.jpg';
                                if (file_exists($icon_file)) {
                                    $icon_url = G5_DATA_URL.'/file/member/'.$member['mb_no'].'.jpg';
                                    echo '<img src="'.$icon_url.'" alt="">';
                                }else{
                                    echo '<img src="'.G5_IMG_URL .'/img_smile.jpg">';
                                }
                                ?>
                            </div>
                            <span class="upload"><i class="fa-solid fa-camera-retro"></i></span>
                        </div>
                    </form>
                </div>
                <nav class="lnb">
                    <div class="inr">
                        <ul>
                            <li><a href="" @click="event.preventDefault(); section = 1;" :class="{'active' : section == 1}">기본정보</a></li>
                            <li><a href="" @click="event.preventDefault(); section = 2;" :class="{'active' : section == 2}">전문/상세분야</a></li>
                            <li><a href="" @click="event.preventDefault(); section = 3;" :class="{'active' : section == 3}">보유기술</a></li>
                            <li><a href="" @click="event.preventDefault(); section = 4;" :class="{'active' : section == 4}">학력 전공/자격증</a></li>
                            <li><a href="" @click="event.preventDefault(); section = 5;" :class="{'active' : section == 5}">경력기간/사항</a></li>
                            <li><a href="" @click="event.preventDefault(); section = 6;" :class="{'active' : section == 6}">희망 시급</a></li>
                            <li><a href="" @click="event.preventDefault(); section = 7;" :class="{'active' : section == 7}">상주 여부</a></li>
                            <li><a href="" @click="event.preventDefault(); section = 8;" :class="{'active' : section == 8}">프로젝트 이력</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="tab_cont">
                    <profile-section1 v-if="section == 1" :user="data"></profile-section1>
                    <profile-section2 v-if="section == 2" :user="data"></profile-section2>
                    <profile-section3 v-if="section == 3" :user="data"></profile-section3>
                    <profile-section4 v-if="section == 4" :user="data"></profile-section4>
                    <profile-section5 v-if="section == 5" :user="data"></profile-section5>
                    <profile-section6 v-if="section == 6" :user="data"></profile-section6>
                    <profile-section7 v-show="section == 7" :user="data" ref="section7"></profile-section7>
                    <profile-section8 v-if="section == 8" :user="data"></profile-section8>
                </div>


                <br>
                <div class="btn_confirm">
                    <input type="button" class="btn_submit ft_btn" id="pay_submit" value="프로필 등록 및 수정" accesskey="s" @click="updateData">
                </div>

            </div>

        </div>

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    mb_no: this.mb_no
                },
                data : {},
                section : 1,
                origin_nick : "",
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
            this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            checkNick : function() {
                if(this.data.mb_nick.trim() == "") {
                    alert("닉네임을 입력해주세요.")
                    return false;
                }
                var method = "get";
                var filter = {mb_nick : this.data.mb_nick};

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/g5_member.php", objs);
                if (res) {
                    this.jl.log(res)
                    if(res.response.count > 0 && this.origin_nick != this.data.mb_nick) {
                        alert("존재하는 닉네임입니다.")
                        return false
                    }

                    return true
                }
            },
            updateData : function() {
                if(!this.checkNick()) {
                    return false;
                }

                if(this.data.job_categories.length > 3) {
                    alert("전문분야는 최대 3개까지 가능합니다");
                    return false;
                }

                if(this.data.job_skills.length > 20) {
                    alert("보유기술은 최대 20개까지 가능합니다");
                    return false;
                }

                if(this.$refs.section7.checkMonth(this.data.job_work_smonth)) {
                    alert("희망월급의 최소부분을 확인해주세요.");
                    return false;
                }

                if(this.$refs.section7.checkMonth(this.data.job_work_emonth)) {
                    alert("희망월급의 최대부분을 확인해주세요.");
                    return false;
                }

                this.data.mb_profile = true;

                var method = "update";
                var obj = JSON.parse(JSON.stringify(this.data));

                var objs = {
                    _method: method,
                    obj: JSON.stringify(obj)
                };

                var res = ajax("/api/g5_member.php", objs);
                if (res) {
                    alert("완료되었습니다.");
                }
            },
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/g5_member.php", objs);
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