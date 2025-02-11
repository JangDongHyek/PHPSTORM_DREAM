<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
                <caption>상품 목록</caption>
                <thead>
                <tr>
                    <th>no</th>
                    <th>아이디</th>
                    <th>제목</th>
                    <th>기능</th>
                    <th>승인</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg0" v-for="item,index in arrays">
                    <td>{{item.jl_no_reverse}}</td>
                    <td>
                        <span v-if="item.$g5_member">{{item.$g5_member.mb_id}}</span>
                    </td>
                    <td>{{item.subject}}</td>
                    <td>
                        <a :href="'./project_view.php?idx=' + item.idx">보기</a>
                        <a>삭제</a>
                    </td>
                    <td>
                        <div class="toggle-switch">
                            <input type="checkbox" :id="'toggle'+index"  v-model="item.status" @change="jl.postData(item,'project',{return : true})"/>
                            <label :for="'toggle'+ index"></label>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <item-pagination :filter="filter" @change="filter.page = $event; jl.getsData(filter,arrays);"></item-pagination>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
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

                filter : {
                    table : "project",
                    primary : this.primary,
                    page: 1,
                    limit: 1,
                    count: 0,

                    extensions : [
                        {table : "g5_member", foreign : "user_idx"}
                    ],
                },

                data: {},
                arrays : [],

                load : false,
            };
        },
        async created() {
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

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
            async putData(item) {

            },
        },
        computed: {},
        watch: {}
    });

</script>

<style>
    /* 토글 스위치 전체 컨테이너 */
    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
    }

    /* 체크박스 숨기기 */
    .toggle-switch input[type="checkbox"] {
        display: none;
    }

    /* 스위치 배경 */
    .toggle-switch label {
        display: block;
        width: 100%;
        height: 100%;
        background-color: #ccc;
        border-radius: 15px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    /* 스위치의 핸들 (동그란 버튼) */
    .toggle-switch label::after {
        content: "";
        position: absolute;
        top: 3px;
        left: 3px;
        width: 24px;
        height: 24px;
        background-color: #fff;
        border-radius: 50%;
        transition: transform 0.3s;
    }

    /* 체크박스가 체크된 상태일 때 */
    .toggle-switch input[type="checkbox"]:checked + label {
        background-color: #4caf50; /* ON 상태 색상 */
    }

    /* 체크박스가 체크된 상태에서 핸들 위치 이동 */
    .toggle-switch input[type="checkbox"]:checked + label::after {
        transform: translateX(30px); /* 핸들 이동 거리 */
    }
</style>