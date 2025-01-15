<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="box_radius box_white table">
            <p><b class="icon icon_color">장례</b></p>
            <h6 class="txt_color">13교구 | 안드레 권사</h6>
            <p>기간 | 24.8.20 - 24.8.22 </p>
            <hr>
            <h6>안드레 권사 부친상</h6><!--제목-->
            <p>함께 기도 부탁드립니다</p><!--내용-->
            <hr>
            <p class="flex gap10">
                <b class="icon icon_line w100px">장소</b>주소지
                <button type="button" class="btn btn_gray btn_mini male-auto">복사</button>
            </p>

            <!--<external-daum-map></external-daum-map>-->

            <p class="flex gap10">
                <b class="icon icon_line w100px">마음전할곳</b>은행 계좌번호 (예금주)
                <button type="button" class="btn btn_gray btn_mini male-auto">복사</button>
            </p>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary: {type: String, default: ""},
            },
            data: function () {
                return {
                    jl: null,
                    component_idx: "",

                    paging: {
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    data: {},
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async postData() {
                    let method = this.primary ? "update" : "insert";
                    let data = {
                        table: "",
                    }

                    // object의 필수값을 설정하는 option
                    let required = [
                        {name : "",message : ""},
                    ]
                    let options = {required : required};

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }

                },
                async getData() {
                    let filter = {
                        table: "user",
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
                        this.paging.count = res.count;
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>