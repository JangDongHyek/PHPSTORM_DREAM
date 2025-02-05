<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>사용일</th>
                    <th>신청인</th>
                    <th>신청부서</th>
                    <th>장소</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in arrays">
                    <td>{{item.use_date.formatDate({simple : true, type : '.'})}}</td>
                    <td>{{item.$g5_member.mb_name}} {{item.$g5_member.mb_1}}</td>
                    <td>{{item.department}}</td>
                    <td>{{item.use_place}}</td>
                    <td>
                        <button type="button" class="btn btn_mini btn_gray" @click="jl.href('./hall_view.php?idx='+item.idx)">보기</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <item-paging :paging="filter" @change="filter.page = $event; this.jl.getsData(filter,arrays);"></item-paging>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
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
                        table : "rental_hall",
                        page: 1,
                        limit: 10,
                        count: 0,
                        user_idx : this.mb_no,
                        extensions : [
                            {table : "g5_member", foreign : "user_idx"}
                        ],
                    },

                    modal : {
                        status : false,
                        data : {},
                    },

                    member : {},

                    rend : false,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(!this.mb_no) {
                    await this.jl.alert("로그인이 필요한 페이지입니다.");
                    window.history.back();
                }

                await this.jl.getsData(this.filter,this.arrays);

                this.load = true;
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {

            },
            computed: {

            },
            watch: {

            }
        }});

</script>

<style>

</style>