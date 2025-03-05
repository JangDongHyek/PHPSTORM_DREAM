<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="box_radius box_white">
            <ul class="tabs">
                <li class="tab-link current" data-tab="hall">본관</li>
                <li class="tab-link" data-tab="lecture">교육관</li>
                <li class="tab-link" data-tab="bus">버스</li>
                <li class="tab-link" data-tab="equip">교회비품</li>
            </ul>
            <!-- 탭메뉴  -->
            <!-- 탭 내용 -->
            <div role="tabpanel" class="tab-content current" id="hall">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>사용일</th>
                            <th>신청일</th>
                            <th>신청부서</th>
                            <th>장소</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>사용일</td>
                            <td>신청일</td>
                            <td>신청부서</td>
                            <td>내용</td>
                            <td><button type="button" class="btn btn_mini btn_color">보기</button></td> <!--연결-->
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!--페이징 작업 바람-->
            </div>
            <div role="tabpanel" class="tab-content" id="lecture">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>사용일</th>
                            <th>신청일</th>
                            <th>신청부서</th>
                            <th>장소</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>사용일</td>
                            <td>신청일</td>
                            <td>신청부서</td>
                            <td>내용</td>
                            <td><button type="button" class="btn btn_mini btn_color">보기</button></td> <!--연결-->
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!--페이징 작업 바람-->
            </div>
            <div role="tabpanel" class="tab-content" id="bus">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>사용일</th>
                            <th>신청일</th>
                            <th>신청부서</th>
                            <th>차량</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>사용일</td>
                            <td>신청일</td>
                            <td>신청부서</td>
                            <td>내용</td>
                            <td><button type="button" class="btn btn_mini btn_color">보기</button></td> <!--연결-->
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!--페이징 작업 바람-->
            </div>
            <div role="tabpanel" class="tab-content" id="equip">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>사용일</th>
                            <th>신청일</th>
                            <th>신청부서</th>
                            <th>자재</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>사용일</td>
                            <td>신청일</td>
                            <td>신청부서</td>
                            <td>내용</td>
                            <td><button type="button" class="btn btn_mini btn_color">보기</button></td> <!--연결-->
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!--페이징 작업 바람-->
            </div>
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