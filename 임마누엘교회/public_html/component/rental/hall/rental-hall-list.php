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
                <tr onclick="location.href='./hall_view'">
                    <td>24.09.01</td>
                    <td>전민웅 집사</td>
                    <td>제10남선교회</td>
                    <td>찬양대석(좌)</td>
                    <td>
                        <button type="button" class="btn btn_mini btn_gray">보기</button>
                    </td>
                </tr>
                <tr onclick="location.href='./hall_view'">
                    <td>24.09.01</td>
                    <td>전민웅 집사</td>
                    <td>제10남선교회</td>
                    <td>찬양대석(좌)</td>
                    <td>
                        <button type="button" class="btn btn_mini btn_gray">보기</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="b-pagination-outer">
            <ul id="border-pagination">


                <li><a href="javascript:void(0)" class="active">1</a></li>
                <li><a href="?page=2&amp;" class="">2</a></li>
                <li><a href="?page=3&amp;" class="">3</a></li>
                <li><a href="?page=4&amp;" class="">4</a></li>


                <li><a href="?page=4&amp;">»</a></li>

            </ul>
        </div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
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
                        table : "",
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
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

            },
            computed: {

            },
            watch: {

            }
        }});

</script>

<style>

</style>