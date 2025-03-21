<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div>
        <template v-if="render">
            <product-input-tab1 v-show="tab == 1" ref="tab1" @change="parent_category = $event" @addOption="data.options.push(createOption('','custom'))"
                                :product="data" :mb_no="mb_no" @changeTab="changeTab" :admin="admin"
            ></product-input-tab1>

            <product-input-tab2 v-show="tab == 2" ref="tab2"
                                :product="data" :mb_no="mb_no" @changeTab="changeTab" :default_content="default_content"
                                :tab="tab" :admin="admin"
            ></product-input-tab2>

            <product-input-tab3 v-show="tab == 3"
                                :product="data" :mb_no="mb_no" @changeTab="changeTab" @postData="postData();" :admin="admin"
            ></product-input-tab3>
        </template>

    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary: {type: String, default: ""},
            tab : {type: String, default: ""},
            mb_no: {type: String, default: ""},
            admin : {type : Boolean, default : false},
        },
        data: function () {
            return {
                jl: null,
                filter: {},
                default_content : [], //naver-editor 참조 변수

                parent_category : null,
                render : true,

                loading : true,


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
                    region : [],
                    weekend: [],
                    types: [],
                    styles: [],
                    keywords: [],
                    package : true,
                    basic : {name : "",description : "",price : "",work : "", modify : ""},
                    standard : {name : "",description : "",price : "",work : "", modify : ""},
                    deluxe : {name : "",description : "",price : "",work : "", modify : ""},
                    premium : {name : "",description : "",price : "",work : "", modify : ""},
                    tax_invoice : "false",
                    options : [],

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

                    //common
                    registration : false,
                },
            };
        },
        created: function () {
            this.jl = new Jl('<?=$componentName?>');

            console.log(this.tab)
        },
        mounted: function () {
            this.$nextTick(() => {
                if(this.primary) {
                    this.render = false;
                    this.getData();
                }

            });
        },
        methods: {
            async changeTab(tab) {
                let now = tab -1;
                if(now == 2) {
                    this.data.service = this.$refs.tab2.$refs.summernote.getContent();
                }

                if(now == 3) {
                    if(!this.data.main_image_array.length) {
                        alert("메인 이미지 1장은 필수입니다.");
                        return false;
                    }
                    if(this.data.main_image_array.length > 1) {
                        alert("메인 이미지는 1장까지 가능합니다");
                        return false;
                    }
                    if(this.data.main_image_array[0].size > 2097152) {
                        alert("메인 이미지의 크기 제한은 2MB 입니다.");
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

                    this.data.registration = true;
                }

                this.data.table = "member_product";
                this.data.file_use = true;

                var method = this.primary ? "update" : "insert";
                let data = this.jl.copyObject(this.data);

                data.basic.price = this.jl.getNumbersOnly(data.basic.price);
                data.standard.price = this.jl.getNumbersOnly(data.standard.price);
                data.premium.price = this.jl.getNumbersOnly(data.premium.price);

                var res = await this.jl.ajax(method, data, "/jl/JlApi.php");

                if (res) {
                    if(now != 3) {
                        window.location.href= `${window.location.pathname}?tab=${tab}&idx=${res.primary}`
                    }else {
                        alert("완료하였습니다.");
                        window.location.href= `${this.jl.root}/bbs/mypage_item.php`
                        //window.location.reload();
                    }
                }
            },
            async postData() {


            },
            async getData() {
                var filter = {primary: this.primary}
                var res = await this.jl.ajax("get", filter, "/api/member_product.php");

                if (res) {
                    this.data = res.response.data[0]

                    this.render = true;
                }
            },
            createOption : function(name = "",detail = "") {
                let obj = {
                    name : name,
                    bool : false,
                    description : "",
                    detail : ""
                };

                let detail_obj = {
                    detail : "detail",
                    basic : {
                        price : "",
                        options : [],
                        option :""
                    },
                    standard : {
                        price : "",
                        options : [],
                        option :""
                    },
                    deluxe : {
                        price : "",
                        options : [],
                        option :""
                    },
                    premium : {
                        price : "",
                        options : [],
                        option :""
                    }
                };

                let custom_obj = {
                    detail : "custom",
                }

                if(detail) {
                    if(name == "시간(분) 추가") {
                        detail_obj.basic.options = ["30분","60분","90분","120분","150분","180분","210분","240분","270분","300분"];
                        detail_obj.standard.options = ["30분","60분","90분","120분","150분","180분","210분","240분","270분","300분"];
                        detail_obj.deluxe.options = ["30분","60분","90분","120분","150분","180분","210분","240분","270분","300분"];
                        detail_obj.premium.options = ["30분","60분","90분","120분","150분","180분","210분","240분","270분","300분"];
                    }
                    if(name == "기간 추가") {
                        let arrays = []
                        for (let i = 1; i < 31; i++) {
                            arrays.push(`${i}일`);
                        }
                        detail_obj.basic.options = arrays;
                    }
                    if(detail == "detail") Object.assign(obj,detail_obj);
                    else Object.assign(obj,custom_obj);
                }

                return obj
            }
        },
        computed: {

        },
        watch: {
            tab: function () {
                window.scrollTo(0, 0)
            },
            parent_category : function() {
                return false
                // 추가옵션 기능 삭제요청 24-12-18
                if(this.render) {
                    this.data.options = [];

                    // 공통 옵션
                    this.data.options.push(this.createOption("시간(분) 추가","detail"));
                    this.data.options.push(this.createOption("기간 추가","detail"));

                    switch (this.parent_category.name) {
                        case "영상·사진·음향 제작" :
                            this.data.options.push(this.createOption("상업적 이용 가능"));
                            this.data.options.push(this.createOption("원본파일제공"));
                            this.data.options.push(this.createOption("자막 삽입"));
                            this.data.options.push(this.createOption("더빙"));
                            this.data.options.push(this.createOption("배경음악"));
                            this.data.options.push(this.createOption("로고삽입"));
                            this.data.options.push(this.createOption("FULL HD(1080P)"));
                            this.data.options.push(this.createOption("색보정"));

                            break;

                        case "방송디자인·편집" :
                            this.data.options.push(this.createOption("상업적 이용 가능"));
                            this.data.options.push(this.createOption("원본파일제공"));
                            this.data.options.push(this.createOption("자막 삽입"));
                            this.data.options.push(this.createOption("이미지장수추가"));
                            this.data.options.push(this.createOption("응용디자인"));
                            this.data.options.push(this.createOption("인쇄최적화"));
                            break;

                        case "방송마케팅" :
                            break;

                        case "방송·배우·연기" :
                            break;

                        case "모델" :
                            break;

                        case "방송스태프" :
                            break;

                        case "방송·시나리오·작가" :
                            break;

                        case "뷰티·패션" :
                            this.data.options.push(this.createOption("준비물 제공 비용 추가"));
                            this.data.options.push(this.createOption("작업실 제공 추가"));
                            break;

                        case "MC·행사·이벤트" :
                            this.data.options.push(this.createOption("준비물 제공 비용 추가"));
                            this.data.options.push(this.createOption("작업실 제공 추가"));
                            break;

                        case "레슨" :
                            this.data.options.push(this.createOption("준비물 제공 비용 추가"));
                            this.data.options.push(this.createOption("강의실 제공 추가"));
                            this.data.options.push(this.createOption("레슨 횟수 추가"));
                            break;

                        case "심리상담" :
                            this.data.options.push(this.createOption("상담 요약 파일 제공"));
                            this.data.options.push(this.createOption("문서 추가 제공"));
                            break;

                        case "기타" :
                            this.data.options.push(this.createOption("이용 인원 추가"));
                            break;

                    }


                    //this.data.options.push(this.createOption("","custom"));

                    console.log(this.data.options)
                }else {
                    this.render = true;
                }
            },
        }
    });
</script>

<style>

</style>