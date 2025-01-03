<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <item-bs-modal :modal="modal" @close="$emit('close')">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <div class="form_wrap" >
                    <label for="">소속사명</label>
                    <input type="text" v-model="data.company_name" placeholder="소속사명"/>
                    <label for="">아이디</label>
                    <input type="text" v-model="data.user_id" placeholder="아이디"/>
                    <label for="">비밀번호</label>
                    <input type="password" v-model="data.change_user_pw" placeholder="비밀번호"/>
                    <label for="">비밀번호 확인</label>
                    <input type="password" v-model="data.user_pw_re" placeholder="비밀번호 확인"/>
                    <label for="">이름</label>
                    <input type="text" v-model="data.company_person" placeholder="이름"/>
                    <label for="">연락처</label>
                    <input type="tel" v-model="data.company_person_phone" placeholder="연락처"/>
                    <label for="">담당</label>
                    <!--<select id="company_position">-->
                    <!--    <option value="콘크리트 타설">콘크리트 타설</option>-->
                    <!--</select>-->
                    <input type="checkbox" value="콘크리트 타설" id="company_position">콘크리트 타설
                    <input type="checkbox" value="테스트 카테고리" id="company_position">테스트 카테고리
                    <label for="">비고</label>
                    <input type="text" v-model="data.notes" placeholder="비고"/>
                </div>
            </template>


            <template v-slot:footer>
                <button type="button" class="btn btn-primary" @click="postData()">등록 완료</button>
            </template>
        </item-bs-modal>
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

                paging : {
                    page : 1,
                    limit : 1,
                    count : 0,
                },
                required : [
                    {name : "company_name",message : "소속사를 입력해주세요."},
                    {name : "user_id",message : "아이디를 입력해주세요."},
                    {name : "company_person",message : "이름을 입력해주세요."},
                    {name : "company_person_phone",message : "연락처를 입력해주세요."},
                ],
                data : {
                    project : this.project_idx,
                    level : "20",
                    allow : "true",
                    company_name : "",
                    user_id : "",
                    change_user_pw : "",
                    user_pw_re : "",
                    company_person : "",
                    company_person_phone : "",

                    notes : "",
                },

                temp : {},
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.temp = this.jl.copyObject(this.data);

            this.getCategoryA();
            this.getCategoryB();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        updated : function() {

        },
        methods: {
            async postData() {
                let method = this.primary ? "update" : "insert";
                let options = {required : this.required};

                let data = this.jl.copyObject(this.data);
                data['table'] = "user"
                data['hashes'] = [];

                if(method == "insert") {
                    data['exists'] = [
                        {
                            where : [
                                {key : "user_id", value : this.data.user_id, operator : ""}
                            ],
                            message : "이미 사용중인 아이디입니다."
                        }
                    ];

                    data['hashes'].push({key : "user_pw_re", convert : "user_pw"});
                }
                else {
                    data['hashes'].push({key : "change_user_pw", convert : "user_pw"});
                }

                try {
                    let res = await this.jl.ajax(method,data,"/jl/JlApi",options);
                    alert("완료 되었습니다");
                    window.location.reload();
                }catch (e) {
                    alert(e.message)
                }

            },
            async getCategoryB() {
                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    column : "category_b",
                    where : [
                        {key : "category_a", value : "철근콘크리트공사", operator : ""}
                    ],
                }
                try {
                    let res = await this.jl.ajax("distinct",filter,"/jl/JlApi");
                }catch (e) {
                    alert(e.message)
                }
            },
            async getCategoryA() {
                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    column : "category_a"
                }
                try {
                    let res = await this.jl.ajax("distinct",filter,"/jl/JlApi");
                }catch (e) {
                    alert(e.message)
                }
            },
            async getData() {
                let filter = {
                    table : "user",
                    primary : this.primary
                }
                try {
                    let res = await this.jl.ajax("get",filter,"/jl/JlApi");
                    this.data = res.data[0]
                }catch (e) {
                    alert(e.message)
                }
            }

        },
        computed: {

        },
        watch : {
            modal() {
                console.log(this.primary);
                if(this.modal) if(this.primary) this.getData();
                else this.data = this.jl.copyObject(this.temp);
            }
        }
    });
</script>

<style>

</style>