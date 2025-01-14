<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>번호</th>
                    <th>기도제목</th>
                    <th>기간</th>
                    <th>수정/완료</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in prayers">
                    <td>{{item.jl_no}}</td>
                    <td><p class="cut">기도제목 예시입니다.</p></td>
                    <td>{{item.insert_date.split(' ')[0]}}-{{item.request_date}}</td>
                    <td>
                        <button type="button" class="btn btn_mini btn_line" @click="$emit('modify',item.idx)">수정</button>
                        <button type="button" @click="putPrayer(item)" class="btn btn_mini btn_colorline">완료</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <item-paging :paging="paging" @change="paging.page = $event; getPrayers();"></item-paging>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                pc: {type: Boolean, default: false},
                mb_no : {type: String, default: ""},
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

                    prayers : [],
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                if(this.mb_no) await this.getPrayers();
            },
            mounted() {
                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {
                async putPrayer(item) {
                    if(item.status == "완료") {
                        alert("이미 완료된 기도입니다.");
                        return false;
                    }
                    let method = "update";
                    let data = {
                        table: "prayer",
                        idx : item.idx,
                        status : "완료"
                    }


                    try {
                        let res = await this.jl.ajax(method, data, "/jl/JlApi.php");
                        showToast('기도가 완료되었어요');
                        await this.getPrayers();
                    } catch (e) {
                        alert(e.message)
                    }

                },
                async getPrayers() {
                    let filter = {
                        table: "prayer",
                        user_idx : this.mb_no
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.prayers = res.data
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