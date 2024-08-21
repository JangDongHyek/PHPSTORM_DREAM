<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div>

            <product-input-tab1 v-show="tab == 1" ref="tab1"
                                :product="data" :mb_no="mb_no" @changeTab="tab = $event"
            ></product-input-tab1>

            <product-input-tab2 v-show="tab == 2" ref="tab2"
                                :product="data" :mb_no="mb_no" @changeTab="tab = $event" :default_content="default_content"
                                :tab="tab"
            ></product-input-tab2>

            <product-input-tab3 v-show="tab == 3"
                                :product="data" :mb_no="mb_no" @changeTab="tab = $event" @postData="postData();"
            ></product-input-tab3>

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary: {type: String, default: ""},
            mb_no: {type: String, default: ""}
        },
        data: function () {
            return {
                jl: null,
                filter: {},
                tab: 1,
                default_content : [], //naver-editor 참조 변수

                data: {
                    //common
                    idx: "",
                    member_idx: this.mb_no,

                    //tab1
                    portfolios : [],
                    name: "",
                    category_idx: "",
                    gender: "",
                    age: "",
                    area: [],
                    weekend: [],
                    types: [],
                    styles: [],
                    keywords: [],
                    package : false,
                    basic : {name : "",description : "",price : "",work : "", modify : ""},
                    standard : {name : "",description : "",price : "",work : "", modify : ""},
                    deluxe : {name : "",description : "",price : "",work : "", modify : ""},
                    premium : {name : "",description : "",price : "",work : "", modify : ""},
                    //추가옵션부분은 회의 끝나면 추가

                    //tab2
                    service: "",
                    questions: [],
                    product_info1: "",
                    product_info2: "",
                    product_info3: "",
                    product_info4: "",
                    product_info5: "",
                    product_info6: "",

                    //tab3
                    main_image_array: [],
                    content_image_array: [],
                    movie_file_array: [],
                    movie_link: [],
                },
            };
        },
        created: function () {
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function () {
            this.$nextTick(() => {
                if(this.primary) this.getData();

            });
        },
        methods: {
            postData: function () {
                if(this.data.portfolios.length > 5) {
                    alert("포트폴리오는 5개까지만 가능합니다.");
                    return false;
                }

                if(this.data.keywords.length > 5) {
                    alert("검색 키워드는 5개까지만 가능합니다.");
                    return false;
                }

                if(this.data.package) {
                    if(!this.data.standard.name || !this.data.deluxe.name || !this.data.premium.name) {
                        alert("가격정보의 제목은 필수값입니다.");
                        return false;
                    }

                    if(this.data.standard.name.length > 20 || this.data.deluxe.name.length > 20 || this.data.premium.name.length > 20) {
                        alert("가격정보의 제목은 20글자까지 가능합니다.");
                        return false;
                    }

                    if(!this.data.standard.description || !this.data.deluxe.description || !this.data.premium.description) {
                        alert("가격정보의 설명은 필수값입니다.");
                        return false;
                    }

                    if(this.data.basic.name.description > 60 || this.data.basic.name.description > 60 || this.data.basic.name.description > 60) {
                        alert("가격정보의 내용은 60글자까지 가능합니다.");
                        return false;
                    }

                    if(!this.data.standard.price || !this.data.deluxe.price || !this.data.premium.price) {
                        alert("가격정보의 가격은 필수값입니다.");
                        return false;
                    }

                    if(!this.data.standard.work || !this.data.deluxe.work || !this.data.premium.work) {
                        alert("가격정보의 작업 기간은 필수값입니다.");
                        return false;
                    }

                    if(!this.data.standard.modify || !this.data.deluxe.modify || !this.data.premium.modify) {
                        alert("가격정보의 수정 횟수는 필수값입니다.");
                        return false;
                    }
                }else {
                    if(!this.data.basic.name) {
                        alert("가격정보의 제목은 필수값입니다.");
                        return false;
                    }

                    if(this.data.basic.name.length > 20) {
                        alert("가격정보의 제목은 20글자까지 가능합니다.");
                        return false;
                    }

                    if(!this.data.basic.description) {
                        alert("가격정보의 설명은 필수값입니다.");
                        return false;
                    }

                    if(this.data.basic.name.description > 60) {
                        alert("가격정보의 내용은 60글자까지 가능합니다.");
                        return false;
                    }

                    if(!this.data.basic.price) {
                        alert("가격정보의 가격은 필수값입니다.");
                        return false;
                    }

                    if(!this.data.basic.work) {
                        alert("가격정보의 작업 기간은 필수값입니다.");
                        return false;
                    }

                    if(!this.data.basic.modify) {
                        alert("가격정보의 수정 횟수는 필수값입니다.");
                        return false;
                    }
                }

                if(!this.data.main_image_array.length) {
                    alert("메인 이미지 1장은 필수입니다.");
                    return false;
                }
                if(this.data.main_image_array.length > 1) {
                    alert("메인 이미지는 1장까지 가능합니다");
                    return false;
                }
                if(this.data.content_image_array.length > 10) {
                    alert("상세 이미지는 10장까지 가능합니다");
                    return false;
                }
                if(this.data.movie_file_array.length > 8) {
                    alert("동영상 등록은 8개까지 가능합니다");
                    return false;
                }
                if(this.data.movie_link.length > 10) {
                    alert("동영상 링크 등록은 10개까지 가능합니다");
                    return false;
                }

                //naverEditor 값 필드에 담기
                this.$refs.tab2.$refs.naverEditor.connectData(this.data,'service')

                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method, this.data, "/api/member_product.php");

                if (res) {
                    alert("완료하였습니다.");
                    window.location.href= `${this.jl.root}/bbs/mypage_item.php`
                }
            },
            getData: function () {
                var filter = {primary: this.primary}
                var res = this.jl.ajax("get", filter, "/api/member_product.php");

                if (res) {
                    this.data = res.response.data[0]
                    this.$refs.tab1.parent_category_idx = this.data.CATEGORY.data[0].parent_idx;
                }
            }
        },
        computed: {},
        watch: {
            tab: function () {
                window.scrollTo(0, 0)
            }
        }
    });
</script>

<style>

</style>