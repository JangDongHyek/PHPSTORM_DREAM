<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
                <caption>상품 목록</caption>
                <thead>
                <tr>
                    <th>no</th>
                    <th>아이디</th>
                    <th>상품명</th>
                    <th>기능</th>
                    <th>승인</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg0" v-for="item,index in data">
                    <td>{{item.jl_no_reverse}}</td>
                    <td>
                        <span v-if="item.$g5_member">{{item.$g5_member.mb_id}}</span>
                    </td>
                    <td>{{item.name}}</td>
                    <td>
                        <a :href="'./product_view.php?idx=' + item.idx + '&mb_no=' + item.member_idx">보기</a>
                        <a @click="deleteData(item);">삭제</a>
                    </td>
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
        methods: {
            async deleteData(item) {
                if(! await this.jl.confirm("정말 삭제하시겠습니까?")) return false;
                if(item.approval) {
                    await this.jl.alert("승인된 상품은 삭제할수없습니다.");
                    return false;
                }
                let method = "delete";
                //let method = "where_delete";

                let filter = {
                    table : "member_product",
                    primary : item.idx, // delete일시 primary 카깂을 넣으면된다 primary 키값이 아니라면 삭제 안됌

                    file_use : false, // 저장된 파일 삭제할지 안할지 삭제할시 데이터의 컬럼명 이들어가야한다
                    file_columns : ["exam1","exma2"] // 파일값이 저장된 컬럼

                    // where_delete 일시
                }
                try {
                    //if(!this.data.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
                    let res = await this.jl.ajax(method,filter,"/jl/JlApi.php");
                    alert("삭제되었습니다.");
                    window.location.reload();
                }catch (e) {
                    alert(e.message)
                }
            },
            async putData(item) {
                let product = {idx : item.idx, approval : item.approval};
                try {

                    let res = await this.jl.ajax("update",product,"/api2/member_product.php");
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
                    let res = await this.jl.ajax("get",this.filter,"/api2/member_product.php");
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