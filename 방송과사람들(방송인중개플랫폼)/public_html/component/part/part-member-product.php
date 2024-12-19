<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="swiper ftSwiper" :id="'swiper'+component_idx">
        <ul id="product_list" class="swiper-wrapper">
            <li class="swiper-slide">
                <i onclick="heart_click(15,this)" class="heart"></i>
                <a href="https://itforone.com/~broadcast/bbs/item_view.php?idx=8">
                    <div class="area_img">
                        <img src="https://itforone.com/~broadcast/data/member_product/66c83b781058149/66c83b781058149.png">
                    </div>
                    <div class="area_txt">
                        <span></span> <h3>ㅊㅋㅊㅋㄴㅊ</h3>
                        <div class="price">
                            111,111원
                        </div>
                        <div class="star">
                            <i></i><em>0</em>
                        </div>
                    </div>
                </a>
            </li>

        </ul>
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
                let swiper = new Swiper(`#swiper${this.component_idx}`, {
                    slidesPerView: 2.5,
                    spaceBetween: 10,
                    grabCursor: true,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    breakpoints: {
                        // 화면 너비가 1200px 이상일 때
                        1200: {
                            slidesPerView: 3.5,
                            spaceBetween: 20
                        },
                        // 화면 너비가 992px 이상일 때
                        950: {
                            slidesPerView: 3.5,
                            spaceBetween: 20
                        },
                        // 화면 너비가 768px 이상일 때
                        768: {
                            slidesPerView: 2.5,
                            spaceBetween: 15
                        },
                    }
                });
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