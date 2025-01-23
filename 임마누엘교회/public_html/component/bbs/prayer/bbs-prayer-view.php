<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="prayer.idx && rending">
        <p><b class="icon icon_gray2">상태 <i class="fa-thin fa-caret-right"></i> {{prayer.status}}</b> <b class="txt_color icon icon_line">구분 <i class="fa-thin fa-caret-right"></i> {{prayer.emergency}}</b></p>
        <h6>{{prayer.name}} {{prayer.job}} <span class="icon icon_color2">{{prayer.belong}}교구 {{prayer.parish}}속</span></h6>
        <p><i class="fa-regular fa-circle-check"></i> 요청기간 <b>{{prayer.insert_date.split(' ')[0]}} ~ {{prayer.request_date}}</b> </p>
        <hr>
        <p><b class="icon icon_line icon_big">유형 <i class="fa-thin fa-caret-right"></i> {{prayer.types2 ? prayer.types2 : prayer.types }}</b> <br> <br>
            {{prayer.content}}
        </p>
    </div>

</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                mb_no: {type: String, default: ""},
                mb_1: {type: String, default: ""},
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

                    prayer: {},

                    rending : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                let allows = ['관리자',"목회자"]

                if(this.primary) await this.getPrayer();

                if(this.prayer.republic != "전체공개" && this.prayer.user_idx != this.mb_no) {
                    if (!allows.includes(this.mb_1)) {
                        await this.jl.alert("접근 권한이 부족합니다.")
                        window.history.back();
                    }
                }

                this.rending = true;
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async getPrayer() {
                    let filter = {
                        table: "prayer",
                        primary : this.primary
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.prayer = res.data[0]
                        this.paging.count = res.count;
                    } catch (e) {
                        alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>