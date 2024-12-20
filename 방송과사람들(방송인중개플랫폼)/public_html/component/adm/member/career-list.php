<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
                <caption>리스트</caption>
                <thead>
                <tr>
                    <th>no</th>
                    <th>아이디</th>
                    <th>프리랜서</th>
                    <th>회사명</th>
                    <th>근무부서</th>
                    <th>직위</th>
                    <th>근무지</th>
                    <th>기간</th>
                    <th>파일</th>
                    <th>승인</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg0" v-for="item,index in data">
                    <td>{{item.jl_no_reverse}}</td>
                    <td>{{item.$g5_member.mb_id}}</td>
                    <td>{{item.free == 1 ? 'O' : 'X'}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.dept}}</td>
                    <td>{{item.position}}</td>
                    <td>{{item.address}}</td>
                    <td>{{item.year}}년{{item.month}}개월</td>
                    <td><a :href="jl.root+item.upfile.src" :download="item.upfile.name">{{item.upfile.name}}</a></td>
                    <td>
                        <div class="toggle-switch">
                            <input type="checkbox" :id="'toggle'+index"  v-model="item.approval" @change="putData(item)"/>
                            <label :for="'toggle'+ index"></label>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <item-pagination :filter="filter" @change="changePage"></item-pagination>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 1,
                    limit : 10,
                    count : 0,
                    order_by_desc : "insert_date",
                },

                data : [],
                modal : false,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            async putData(item) {
                let product = {
                    table : "member_career",
                    idx : item.idx,
                    approval : item.approval
                };
                try {

                    let res = await this.jl.ajax("update",product,"/jl/JlApi.php");
                }catch (e) {
                    alert(e.message)
                }

            },
            changePage(page) {
                this.filter.page = page;

                this.getData();
            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api2/member_career.php");
                    this.data = res.data
                    this.filter.count = res.count;
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {

        }
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