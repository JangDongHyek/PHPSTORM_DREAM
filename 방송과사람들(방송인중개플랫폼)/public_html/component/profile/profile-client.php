<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div class="mypage_cont">
        <div class="tab_cont">
            <h3>프로필관리</h3>

            <div id="profile_form">

                <div class="myinfo_wrap">
                    <form id='imgfrm'>
                        <input type="file" name="mb_icon" id="mb_icon" onchange="getImgPrev(this);" accept="image/*"
                               style="display: none">

                        <div class="area_photo">
                            <div class="photo basic" id="img_area" onclick="file_click();">
                                <?php
                                $icon_file = G5_DATA_PATH . '/file/member/' . $member['mb_no'] . '.jpg';
                                if (file_exists($icon_file)) {
                                    $icon_url = G5_DATA_URL . '/file/member/' . $member['mb_no'] . '.jpg';
                                    echo '<img src="' . $icon_url . '" alt="">';
                                } else {
                                    echo '<img src="' . G5_IMG_URL . '/img_smile.jpg">';
                                }
                                ?>
                            </div>
                            <span class="upload"><i class="fa-solid fa-camera-retro"></i></span>
                        </div>
                    </form>
                </div>

                <dl>
                    <dt>닉네임</dt>
                    <dd><input type="text" id="mb_nick" placeholder="활동명 or 회사명" v-model="data.mb_nick"></dd>
                </dl>

                <dl>
                    <dt>성별</dt>
                    <dd class="box">
                        <input type="radio" id="mb_sex_m" name="mb_sex" value="M" v-model="data.mb_sex">
                        <label for="mb_sex_m">남성</label>
                        <input type="radio" id="mb_sex_w" name="mb_sex" value="W" v-model="data.mb_sex">
                        <label for="mb_sex_w">여성</label>
                    </dd>
                </dl>
                <dl>
                    <dt>생년월일</dt>
                    <dd><input type="text" id="mb_birth" placeholder="생년월일" v-model="data.mb_birth"></dd>
                </dl>

                <dl>
                    <dt>현재직업</dt>
                    <dd class="box">
                        <template v-for="item,index in jobs">
                            <input type="radio" :id="'mb_job_'+index" name="mb_job" :value="item" v-model="data.mb_job">
                            <label :for="'mb_job_'+index">{{item}}</label>
                        </template>
                    </dd>
                </dl>


                <dl>
                    <dt>관심분야</dt>
                    <dd class="box">
                        <template v-for="item,index in interests">
                            <input type="checkbox" :id="'mb_interest_' + index" v-model="data.mb_interest" :value="item">
                            <label :for="'mb_interest_' + index">{{item}}</label>
                        </template>
                    </dd>
                </dl>

                <dl>
                    <dt>자기소개 글</dt>
                    <dd>
                        <textarea placeholder="소개글을 입력해주세요." maxlength="255" rows="6" spellcheck="false"
                                  name="pf_produce" id="pf_produce"
                                  style="min-height: 204px;" v-model="data.mb_about"></textarea>
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

            </div>

            <br>

            <div class="btn_confirm">
                <input type="button" class="btn_submit ft_btn" id="pay_submit" value="프로필 등록 및 수정" accesskey="s" @click="updateData">
            </div>

        </div>

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type : String,defualt : ""}
        },
        data: function () {
            return {
                jl: null,
                filter: {
                    mb_no: this.mb_no
                },
                data: {},
                origin_nick : "",
                jobs : ["직장인", "프리랜서", "자영업자", "대학생", "배우", "뮤지션", "성우", "모델", "디자이너",
                    "아트디렉터", "방송스탭", "PD", "작가", "강사", "쇼호스트", "트레이너", "크리에이터", "뷰티업종", "IT", "요식업", "무직", "기타"],
                interests : ["배우·연기", "모델", "영상·사진·음향", "영상디자인·편집", "방송마케팅", "행사·MC·이벤트",
                    "방송 스태프", "시나리오· 작가", "뷰티·패션", "레슨", "심리상담", "기타", "선택안함"],

            };
        },
        created: function () {
            this.jl = new JL('<?=$componentName?>');
            this.getData();
        },
        mounted: function () {
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
        computed: {},
        watch: {}
    });
</script>

<style>

</style>