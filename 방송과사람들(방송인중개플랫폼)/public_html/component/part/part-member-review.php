<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="box">
        <div class="review_total">
            <h3>5.0</h3>
            <div class="area_star">
                <div class="img_star v45">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <span class="review">3개 리뷰</span>
            </div>
        </div>
        <ul class="review_list">
            <li>
                <div class="title">
                    <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user01.jpg"></div>
                    <div class="profile_info">
                        <h4>김**</h4><!-- 이름 -->
                        <div class="area_star">
                            <div class="img_star v45">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <em>5.0</em>
                            <span class="data">21.09.15</span>
                        </div>
                    </div>
                </div>
                <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                <div class="cont" id="content">
                    저는 최근에 중요한 가족 행사를 맞아 전문가님께 사진 촬영을 의뢰했습니다. 솔직히 말해서, 결과물에 대해 기대가 컸는데, 그 기대를 훨씬 뛰어넘는 경험이었습니다.

                    우선, 촬영 당일 전문가님께서는 촬영 장소에 일찍 도착하여 모든 장비를 세팅하고 준비해 주셨습니다. 이는 그분의 철저한 준비성과 전문성을 단적으로 보여주었습니다. 또한, 촬영 내내 편안하고 자연스러운 분위기를 만들어 주셔서 저희 가족 모두가 긴장하지 않고 즐겁게 촬영에 임할 수 있었습니다.
                </div>
                <div class="button" id="toggleButton" onclick="toggleContent()">더보기</div>
            </li>
            <li>
                <div class="title">
                    <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user03.jpg"></div>
                    <div class="profile_info">
                        <h4>k**</h4><!-- 이름 -->
                        <div class="area_star">
                            <div class="img_star v45">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <em>5.0</em>
                            <span class="data">21.09.15</span>
                        </div>
                    </div>
                </div>
                <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                <div class="cont">
                    꼼꼼히 확인하시고 좋은 결과물 만들어주십니다~
                </div>
            </li>
            <li>
                <div class="title">
                    <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user02.jpg"></div>
                    <div class="profile_info">
                        <h4>k**</h4><!-- 이름 -->
                        <div class="area_star">
                            <div class="img_star v45">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <em>5.0</em>
                            <span class="data">21.09.15</span>
                        </div>
                    </div>
                </div>
                <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                <div class="cont">
                    항상 믿고 쓰는 전문가님 항상 감사드립니다
                </div>
            </li>
            <li>
                <div class="title">
                    <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user01.jpg"></div>
                    <div class="profile_info">
                        <h4>김**</h4><!-- 이름 -->
                        <div class="area_star">
                            <div class="img_star v45">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <em>5.0</em>
                            <span class="data">21.09.15</span>
                        </div>
                    </div>
                </div>
                <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                <div class="cont">
                    항상 믿고 쓰는 전문가님 항상 감사드립니다
                </div>
            </li>
            <li>
                <div class="title">
                    <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user03.jpg"></div>
                    <div class="profile_info">
                        <h4>k**</h4><!-- 이름 -->
                        <div class="area_star">
                            <div class="img_star v45">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <em>5.0</em>
                            <span class="data">21.09.15</span>
                        </div>
                    </div>
                </div>
                <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                <div class="cont">
                    꼼꼼히 확인하시고 좋은 결과물 만들어주십니다~
                </div>
            </li>
        </ul>
        <div class="btn_more"><span>더보기</span></div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
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
        updated : function() {

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