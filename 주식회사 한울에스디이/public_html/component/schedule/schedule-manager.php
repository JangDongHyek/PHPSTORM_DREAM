<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">


    <div>
        <item-bs-modal :modal="modal" @close="$emit('close')">
            <template v-slot:header>

            </template>

            <!-- body -->
            <template v-slot:default>
                <div class="search_wrap">
                    <div class="area_filter flex ai-c jc-sb">
                        <div class="flex ai-c">
                            <div class="search">
                                <select id="search_key1" v-model="filter.search_key1">
                                    <option value="company_person">이름</option>
                                    <option value="user_id">아이디</option>
                                    <option value="company_person_phone">연락처</option>
                                </select>
                                <input type="search" v-model="filter.search_value1" placeholder="검색어 입력" value="">
                                <button type="submit" class="btn_search" @click="getData()"><i class="fa-regular fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="sch_field" style="display: block;">
                        <table class="sch_field_tb">
                            <thead>
                            <tr>
                                <th>아이디</th>
                                <th>이름</th>
                                <th>소속</th>
                                <th>담당</th>
                                <th>연락처</th>
                                <th>비고</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="user in data">
                                <th>{{user.id}}</th>
                                <td>{{user.company_person}}</td>
                                <td>{{user.company_name}}</td>
                                <td>{{user.company_position}}</td>
                                <td>{{user.company_person_phone}}</td>
                                <td>{{user.notes}}</td>
                                <th>
                                    <button class="btn btn_mini2 btn_line" @click="$emit('designate',user)">지정</button>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </template>


            <template v-slot:footer>

            </template>
        </item-bs-modal>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
            project : {type : Object, default : {}},
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {
                    search_key1 : "company_person",
                    search_value1 : "",
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {

                },
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

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
                    //if(this.data.change_user_pw != this.data.user_pw_re) throw new Error("비밀번호와 비밀번호 확인이 다릅니다.");

                    let res = await this.jl.ajax(method,this.data,"/api/user",options);

                    alert("완료 되었습니다");
                    window.location.reload();
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/user");
                    this.data = res.data
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {

        },
        watch : {
            project() {
                this.filter.project = this.project.idx
                this.getData();
            }
        }
    }});
</script>

<style>

</style>