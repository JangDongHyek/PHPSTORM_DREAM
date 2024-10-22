<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div class="area_filter flex ai-c jc-sb">
            <div class="flex ai-c">
                <strong class="total">총 4건</strong>
                <div class="search">
                    <select name="sfl">
                        <option value="">소속사명</option>
                        <option value="">이름</option>
                        <option value="">아이디</option>
                        <option value="">연락처</option>
                    </select>
                    <input type="search" name="stx" placeholder="검색어 입력" value="">
                    <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </div>
            <button type="button" class="btn btn_darkblue" @click="modal = true">계정 등록</button>
        </div>
        <div class="table">
            <table>
                <colgroup>
                    <col width="20px">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                    <col width="auto">
                </colgroup>
                <thead>
                <tr>
                    <th></th>
                    <th>소속사명</th>
                    <th>아이디</th>
                    <th class="text-center">이름</th>
                    <th class="text-center">연락처</th>
                    <th class="text-center">담당</th>
                    <th class="text-center">비고</th>
                    <th class="text-center">등록일</th>
                    <th class="text-center">관리</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th class="text-center">4</th>
                    <th>대우건설</th>
                    <td>nr_global01</td>
                    <td class="text-center">안재홍</td>
                    <td class="text-center">010-1234-1234</td>
                    <td class="text-center">거푸집 엔지니어</td>
                    <td class="text-center">경력 10년</td>
                    <td class="text-center">2024.06.19</td>
                    <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
                </tr>
                <tr>
                    <th class="text-center">3</th>
                    <th>대우건설</th>
                    <td>nr_global01</td>
                    <td class="text-center">이주현</td>
                    <td class="text-center">010-1234-1234</td>
                    <td class="text-center">레미콘 품질 관리자</td>
                    <td class="text-center">-</td>
                    <td class="text-center">2024.06.19</td>
                    <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
                </tr>
                <tr>
                    <th class="text-center">2</th>
                    <th>대우건설</th>
                    <td>nr_global01</td>
                    <td class="text-center">진준수</td>
                    <td class="text-center">010-1234-1234</td>
                    <td class="text-center">철근 배근 엔지니어</td>
                    <td class="text-center">-</td>
                    <td class="text-center">2024.06.19</td>
                    <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
                </tr>
                <tr>
                    <th class="text-center">1</th>
                    <th>대우건설</th>
                    <td>nr_global01</td>
                    <td class="text-center">김설주</td>
                    <td class="text-center">010-1234-1234</td>
                    <td class="text-center">기계 엔지니어</td>
                    <td class="text-center">-</td>
                    <td class="text-center">2024.06.19</td>
                    <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="paging">
            <div class="pagingWrap">
                <a class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
                <a class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
                <a class="active">1</a>
                <a>2</a>
                <a>3</a>
                <a>4</a>
                <a>5</a>
                <a>6</a>
                <a>7</a>
                <a class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
                <a class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
            </div>
        </div>

        <account-input :modal="modal" @close="modal = false;" :project_idx="project_idx"></account-input>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            project_idx : {type : String, default : ""},
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    page : 0,
                    limit : 0,
                    count : 0,
                    search_key1 : "",
                    search_value1_1 : "",
                    search_value1_2 : "",
                    search_like_key1 : "",
                    search_like_value1 : "",
                    not_key1 : "",
                    not_value1 : "",
                    in_key1 : "",
                    in_value : [],
                    order_by_desc : "insert_date",
                    order_by_asc : "",
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {},
                modal : false,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            async postData() {
                let method = this.primary ? "update" : "insert";
                let options = {required : this.required};
                try {
                    let res = await this.jl.ajax(method,this.data,"/api/example.php",options);
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/example.php");
                    this.data = res.data[0]
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {
            search_key1() {
                this.search_value1_1 = "";
                this.search_value1_2 = "";
            }
        }
    });
</script>

<style>

</style>