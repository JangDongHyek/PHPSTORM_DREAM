<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <slot-modal :modal="modal" @close="$emit('close')" title="담당자 계정 등록">
            <template v-slot:default>
                <div class="form_wrap" >
                    <label for="">소속사명</label>
                    <input type="text" v-model="company_name" placeholder="소속사명" required="소속사를 입력해주세요."/>
                    <label for="">아이디</label>
                    <input type="text" id="user_id" placeholder="아이디" required="아이디를 입력해주세요"/>
                    <label for="">비밀번호</label>
                    <input type="password" id="change_user_pw" placeholder="비밀번호"/>
                    <label for="">비밀번호 확인</label>
                    <input type="password" id="user_pw_re" placeholder="비밀번호 확인"/>
                    <label for="">이름</label>
                    <input type="text" id="company_person" placeholder="이름" required="이름을 입력해주세요."/>
                    <label for="">연락처</label>
                    <input type="tel" id="company_person_phone" placeholder="연락처" required="연락처를 입력해주세요."/>
                    <label for="">담당</label>
                    <!--<select id="company_position">-->
                    <!--    <option value="콘크리트 타설">콘크리트 타설</option>-->
                    <!--</select>-->
                    <input type="checkbox" value="콘크리트 타설" id="company_position">콘크리트 타설
                    <input type="checkbox" value="테스트 카테고리" id="company_position">테스트 카테고리
                    <label for="">비고</label>
                    <input type="text" id="notes" placeholder="비고"/>
                </div>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-primary" >등록 완료</button>
            </template>
        </slot-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
            primary : {type : String, default : ""},
            project_idx : {type : String, default : ""},
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
                data : {
                    project : this.project_idx,
                    level : "20",
                    allow : "true",
                },
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

        }
    });
</script>

<style>

</style>