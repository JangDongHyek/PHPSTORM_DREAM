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
                    <select v-model="data.category_a" @change="getCategoryB()">
                        <option value="" disabled>선택해주세요.</option>
                        <option v-for="category_a in categoryA" :value="category_a.category_a">{{category_a.category_a}}</option>
                    </select>

                    <select v-if="data.category_a" v-model="data.category_b" @change="getGroupA()">
                        <option value="" disabled>선택해주세요.</option>
                        <option v-for="category_b in categoryB" :value="category_b.category_b">{{category_b.category_b}}</option>
                    </select>

                    <select v-if="data.category_b" v-model="data.group_a" @change="getGroupB()">
                        <option value="" disabled>선택해주세요.</option>
                        <option v-for="group_a in groupA" :value="group_a.group_a">{{group_a.group_a}}</option>
                    </select>

                    <select v-if="data.group_a" v-model="data.group_b" @change="getGroupC()">
                        <option value="" disabled>선택해주세요.</option>
                        <option v-for="group_b in groupB" :value="group_b.group_b">{{group_b.group_b}}</option>
                    </select>

                    <select v-if="data.group_b" v-model="data.group_c">
                        <option value="" disabled>선택해주세요.</option>
                        <option v-for="group_c in groupC" :value="group_c.group_c">{{group_c.group_c}}</option>
                    </select>
                    <!--<input type="checkbox" value="콘크리트 타설" id="company_position">콘크리트 타설-->
                    <!--<input type="checkbox" value="테스트 카테고리" id="company_position">테스트 카테고리-->
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

                    category_a : "",
                    category_b : "",
                    group_a : "",
                    group_b : "",
                    group_c : "",
                },

                temp : {},

                categoryA : [],
                categoryB : [],

                groupA : [],
                groupB : [],
                groupC : [],

                load : false,
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            this.temp = this.jl.copyObject(this.data);

            this.getCategoryA();
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

                let required = [
                    {name : "company_name",message : "소속사를 입력해주세요."},
                    {name : "user_id",message : "아이디를 입력해주세요."},
                    {name : "company_person",message : "이름을 입력해주세요."},
                    {name : "company_person_phone",message : "연락처를 입력해주세요."},

                    {name : "category_a",message : "카테고리를 끝까지 선택해주세요."},
                    {name : "category_b",message : "카테고리를 끝까지 선택해주세요."},
                    {name : "group_a",message : "카테고리를 끝까지 선택해주세요."},
                    {name : "group_b",message : "카테고리를 끝까지 선택해주세요."},
                    {name : "group_c",message : "카테고리를 끝까지 선택해주세요."},
                ];

                let options = {required : required};

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
            async getGroupC() {
                if(this.load) {
                    this.data.group_c = "";
                }

                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    column : "group_c",
                    where : [
                        {key : "category_a", value : this.data.category_a, operator : ""},
                        {key : "category_b", value : this.data.category_b, operator : ""},
                        {key : "group_a", value : this.data.group_a, operator : ""},
                        {key : "group_b", value : this.data.group_b, operator : ""},
                    ],
                }
                try {
                    let res = await this.jl.ajax("distinct",filter,"/jl/JlApi");

                    this.groupC = res.data;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getGroupB() {
                if(this.load) {
                    this.data.group_b = "";
                    this.data.group_c = "";
                }

                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    column : "group_b",
                    where : [
                        {key : "category_a", value : this.data.category_a, operator : ""},
                        {key : "category_b", value : this.data.category_b, operator : ""},
                        {key : "group_a", value : this.data.group_a, operator : ""},
                    ],
                }
                try {
                    let res = await this.jl.ajax("distinct",filter,"/jl/JlApi");

                    this.groupB = res.data;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getGroupA() {
                if(this.load) {
                    this.data.group_a = "";
                    this.data.group_b = "";
                    this.data.group_c = "";
                }

                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    column : "group_a",
                    where : [
                        {key : "category_a", value : this.data.category_a, operator : ""},
                        {key : "category_b", value : this.data.category_b, operator : ""}
                    ],
                }
                try {
                    let res = await this.jl.ajax("distinct",filter,"/jl/JlApi");

                    this.groupA = res.data;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getCategoryB() {
                if(this.load) {
                    this.data.category_b = "";
                    this.data.group_a = "";
                    this.data.group_b = "";
                    this.data.group_c = "";
                }

                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    column : "category_b",
                    where : [
                        {key : "category_a", value : this.data.category_a, operator : ""}
                    ],
                }
                try {
                    let res = await this.jl.ajax("distinct",filter,"/jl/JlApi");

                    this.categoryB = res.data;
                }catch (e) {
                    alert(e.message)
                }
            },
            async getCategoryA() {
                console.log(this.data);
                let filter = {
                    table : "project_schedule",
                    project_idx : this.project_idx,
                    column : "category_a"
                }
                try {
                    let res = await this.jl.ajax("distinct",filter,"/jl/JlApi");

                    this.categoryA = res.data;
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
            async modal() {
                console.log(this.primary);
                if(this.modal) {
                    if(this.primary) {
                        await this.getData();
                        await this.getCategoryA();
                        await this.getCategoryB();
                        await this.getGroupA();
                        await this.getGroupB();
                        await this.getGroupC();

                        this.load = true;
                    }else {
                        this.load = true;
                    }
                }
                else {
                    this.data = this.jl.copyObject(this.temp);
                    this.load = false;
                }
            }
        }
    });
</script>

<style>

</style>