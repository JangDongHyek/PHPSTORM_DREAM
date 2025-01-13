<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="prayer">
        <div class="slogan">
            <h5>이와 같이 성령도 우리의 연약함을 도우시나니 우리는 마땅히 기도할 바를 알지 못하나<br class="hidden-xs">
                오직 성령이 말할 수 없는 탄식으로 우리를 위하여 친히 간구하시느니라 <span>롬 8:26</span></h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./pray_form'">기도요청하기</button>
        </div>
        <div class="box_radius box_white">
            <h6><i class="fa-solid fa-person-praying"></i> 함께 기도해주세요!</h6>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>날짜</th>
                        <th>기도요청자</th>
                        <th>기도제목</th>
                        <th>구분</th>
                        <th>응답</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr onclick="location.href='./pray_view'" v-for="board in boards">
                        <td>{{board.wr_datetime.split(' ')[0]}}</td>
                        <td>{{board.wr_name}}</td>
                        <td><p class="cut">기도제목 예시입니다.</p></td>
                        <td>긴급</td>
                        <td>진행</td>
                    </tr>
                    <tr onclick="location.href='./pray_view'">
                        <td>24.09.01</td>
                        <td>전민웅 집사</td>
                        <td><p class="cut">기도제목 예시입니다.</p></td>
                        <td>일반</td>
                        <td>완료</td>
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
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary: {type: String, default: ""}
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

                    boards : [],
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                await this.getBoard();
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

                    if (this.data) data = Object.assign(data, this.data); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php");
                    } catch (e) {
                        alert(e.message)
                    }

                },
                async getBoard() {
                    let filter = {
                        table: "g5_write_prayer",
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.boards = res.data
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