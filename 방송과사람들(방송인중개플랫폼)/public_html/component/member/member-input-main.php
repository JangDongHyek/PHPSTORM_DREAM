<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <article class="box-article">
        <div id="join_info">
            <form id="signupForm">
                <!-- Step 1 -->
                <div class="step active" id="step1">
                    <div class="box_line">
                        <h2>{{ mode == 'w' ? '회원가입' : '회원정보'}}</h2>

                        <div class="box-body">
                            <dl class="row">
                                <dt>아이디<i class="fa-solid fa-asterisk"></i></dt>
                                <dd>
                                    <input type="text" name="mb_id" value="" id="reg_mb_id" class="regist-input required" minlength="3" maxlength="15" placeholder="아이디를 입력해 주세요.">
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>
                                <dl class="row">
                                    <dt>비밀번호<i class="fa-solid fa-asterisk"></i></dt>
                                    <dd>
                                        <input type="password" name="mb_password" id="reg_mb_password" class="regist-input" minlength="4" maxlength="20" placeholder="비밀번호를 입력해 주세요.">
                                    </dd>
                                    <dd class="error col-xs-12"></dd>
                                </dl>

                                <dl class="row password">
                                    <dt>비밀번호확인<i class="fa-solid fa-asterisk"></i></dt>
                                    <dd>
                                        <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input" <?=$required?> minlength="4" maxlength="20" placeholder="비밀번호를 한번 더 입력해 주세요.">
                                    </dd>
                                    <dd class="error col-xs-12"></dd>
                                </dl>
                        </div>

                        <template v-if="mode == 'w' ">
                            <div id="join_agr">
                                <div class="cek_all">
                                    <label class="selector">
                                        <input type="checkbox" id="all_chk" name="all_chk">
                                        <span><i></i>약관전체동의</span>
                                    </label>
                                </div>
                                <div class="box-body">

                                    <dl class="row agree-row">
                                        <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                                            <input type="checkbox" name="reg_req[]" id="reg_req1" value="0">
                                            <label for="reg_req1"><span></span><em>이용약관 동의 (필수)</em></label>
                                            <!-- <i></i> 이용약관 동의 (필수) -->
                                        </dd>
                                        <dd class="col-xs-4 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                                        <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                                    </dl>

                                    <dl class="row agree-row">
                                        <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                                            <input type="checkbox" name="reg_req[]" id="reg_req2" value="0">
                                            <label for="reg_req2"><span></span><em>개인정보처리방침 동의 (필수)</em></label>
                                            <!--<i></i> 개인정보처리방침 동의 (필수) -->
                                        </dd>
                                        <dd class="col-xs-3 text-right"><input type="button" value="내용보기" class="btn btn-agr"></dd>
                                        <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                                    </dl>

                                </div>
                            </div>
                        </template>



                    </div>

                    <div class="btn_confirm">
                        <button type="button"class="btn_submit ft_btn" onclick="nextStep()">다음</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step" id="step2">
                    <div class="box_line">
                        <h2>프로필</h2>
                        <div class="box-body">
                            <dl class="row">
                                <dt>닉네임<i class="fa-solid fa-asterisk"></i></dt>
                                <dd>
                                    <input type="text" name="" value="" id="reg_mb_id" class="regist-input required" minlength="1" maxlength="2" required placeholder="닉네임을 입력해 주세요.">
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>
                            <dl class="row">
                                <dt>성별<i class="fa-solid fa-asterisk"></i></dt>
                                <dd class="box_in">
                                    <input type="radio" id="gender_male" name="mb_sex" value="male" />
                                    <label for="gender_male">남성</label>
                                    <input type="radio" id="gender_female" name="mb_sex" value="female" />
                                    <label for="gender_female">여성</label>
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>
                            <dl class="row">
                                <dt>생년월일<i class="fa-solid fa-asterisk"></i></dt>
                                <dd>
                                    <input type="date" name="" value="" id="reg_mb_id" class="regist-input required" required placeholder="생년월일을 입력해 주세요.">
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>

                            <dl class="row">
                                <dt>프로필사진</dt>
                                <dd>
                                    <!-- 숨겨진 파일 입력 요소 -->
                                    <input type="file" name="mb_icon" id="mb_icon" accept="image/*" style="display: none;">

                                    <!-- 프로필 사진 영역 -->
                                    <div class="area_photo basic" for="mb_icon" style="cursor: pointer;">
                                        <img id="profileImg" :src="jl.root + '/img/img_smile.jpg' " alt="Default Profile Photo">
                                    </div>
                                </dd>
                            </dl>

                            <dl class="row">
                                <dt>현재직업</dt>
                                <dd>
                                    <div class="input">
                                        <input type="text" name="" id="" class="regist-input" minlength="3" maxlength="50" placeholder="현재직업을 입력해 주세요." value="">
                                    </div>
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>
                            <dl class="row">
                                <dt>관심분야</dt>
                                <dd>
                                    <div class="input">
                                        <input type="text" name="" id="" class="regist-input" minlength="3" maxlength="50" placeholder="관심분야 입력해 주세요." value="">
                                    </div>
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>

                            <br>
                            <p class="txt_color text-center">※정확한 프로필 설정은 매칭에 도움이 됩니다.</p>
                            <br>

                        </div>
                    </div>
                        <a class="btn_cancel">회원탈퇴</a>
                        <button type="button"  class="btn_cancel" >이전</button>
                    <div class="btn_confirm">
                        <input type="button" class="btn_submit ft_btn" id="pay_submit" value="cc" accesskey="s">
                    </div>
                </div>

            </form>
        </div>
    </article>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mode : {type : Boolean, default : false},
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {},
                required : [
                    {name : "",message : ""},
                ],
                data : {

                },
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async postData() {
                let method = this.primary ? "update" : "insert";
                let options = {required : this.required};
                try {
                    //if(this.data.change_user_pw != this.data.user_pw_re) throw new Error("비밀번호와 비밀번호 확인이 다릅니다.");

                    let res = await this.jl.ajax(method,this.data,"/api/user",options);

                    alert("완료 되었습니다");
                    window.location.reload();
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/example.php");
                    this.data = res.data[0]
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