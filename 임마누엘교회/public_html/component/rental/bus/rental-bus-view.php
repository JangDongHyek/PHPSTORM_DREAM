<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white table">
            <h6>{{data.$g5_member.mb_name}} {{data.$g5_member.mb_1}}</h6>
            <p>연락처 | {{data.phone}}</p>
            <hr>
            <p><b class="icon icon_gray">신청부서</b> {{data.department}} </p>
            <p><b class="icon icon_gray">행사명</b> {{data.subject}} </p>
            <p><b class="icon icon_gray">탑승인원</b> {{data.people}} </p>
            <p><b class="icon icon_gray">신청차량</b> {{data.types}} </p>
            <p><b class="icon icon_gray">날짜</b> {{data.dates1.formatDate({type : '.'})}} </p>
            <p><b class="icon icon_gray">도착행선지</b> {{data.destination1}}} </p>
            <p><b class="icon icon_gray">교회출발시간</b> {{data.times1}} </p>
            <p><b class="icon icon_gray">출발행선지</b> {{data.destination2}} </p>
            <p><b class="icon icon_gray">현지출발시간</b> {{data.times2}} </p>
            <p v-if="data.dates2 != '0000-00-00'"><b class="icon icon_gray">당일외출발</b> {{data.dates2}} {{data.times3}}  </p>
            <p>-</p>
            <button  v-if="admin || mb_no == data.user_idx" class="btn btn_large btn_gray2" type="button" @click="jl.deleteData(data,{table:'rental_bus',message : '예약 취소시 데이터는 삭제됩니다 삭제하시겠습니까?',href : './rental_bus'})">예약 취소</button>
            <button  v-if="admin" class="btn btn_large btn_color" type="button" @click="putData()">승인</button>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                admin : {type: String, default: ""},
                mb_no : {type: String, default: ""},
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    data: {},
                    arrays : [],

                    options : {
                        required : [
                            {name : "",message : ``},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "rental_bus",
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
                        extensions : [
                            {table : "g5_member", foreign : "user_idx"}
                        ],
                    },

                    modal : {
                        status : false,
                        data : {},
                    },

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.primary) this.data = await this.jl.getData(this.filter);
                else {
                    await this.jl.alert("잘못된 접근입니다.");
                    window.history.back();
                }
                //await this.jl.getsData(this.filter,this.arrays);

                this.load = true;
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async putData() {
                    if(this.data.status) {
                        await this.jl.alert("이미 승인한 데이터입니다");
                        return false;
                    }

                    this.data.status = true;

                    await this.jl.postData(this.data, {table : 'rental_bus'});
                }
            },
            computed: {

            },
            watch: {

            }
        }});

</script>

<style>

</style>