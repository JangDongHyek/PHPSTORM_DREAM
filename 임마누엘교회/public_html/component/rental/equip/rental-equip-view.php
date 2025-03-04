<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white table">
            <h6>{{data.$g5_member.mb_name}} {{data.$g5_member.mb_1}}</h6>
            <p>연락처 | {{data.phone}}</p>
            <hr>
            <p><b class="icon icon_gray">신청부서</b> {{data.department}} </p>
            <p><b class="icon icon_gray">행사명</b> {{data.subject}} </p>
            <p><b class="icon icon_gray">행사장소</b> {{data.place}} </p>
            <p><b class="icon icon_gray">행사날짜</b> {{data.use_date.formatDate({type :'.'})}} </p>
            <p><b class="icon icon_gray">신청자재</b> {{data.request}} </p>
            <p><b class="icon icon_gray">수령인</b> {{data.recipient}} </p>
            <p><b class="icon icon_gray">수령일시</b> {{data.dates1}} {{data.times1}}</p>
            <p><b class="icon icon_gray">반납인</b> {{data.returner}} </p>
            <p><b class="icon icon_gray">반납일시</b> {{data.dates2}} {{data.times2}}</p>
            <button class="btn btn_large btn_gray2" type="button" @click="jl.deleteData(data,{table:'rental_equip',message : '예약 취소시 데이터는 삭제됩니다 삭제하시겠습니까?',href : './rental_equip'})">예약 취소</button>
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
                        table : "rental_equip",
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

                    await this.jl.postData(this.data, {table : 'rental_equip'});
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