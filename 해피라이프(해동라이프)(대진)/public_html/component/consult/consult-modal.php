<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <item-bs-modal :modal="modal" @close="$emit('close')">
            <template v-slot:header>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title">무료 사전장례상담 신청</h5>
            </template>

            <!-- body -->
            <template v-slot:default>
                <dl class="">
                    <dt>
                        <span class="color-red">(필수)</span>
                        신청인 성명
                    </dt>
                    <dd>
                        <input type="text" v-model="data.name" class="input_form" placeholder='입력하세요'>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="color-red">(필수)</span>
                        신청인 휴대폰
                    </dt>
                    <dd class="input_phone">
                        <select class="input_form" v-model="data.phone1">
                            <option value="010">010</option>
                            <option value="011">011</option>
                        </select>
                        -
                        <input type="text" v-model="data.phone2" class="input_form" placeholder='4자리'>
                        -
                        <input type="text" v-model="data.phone3" class="input_form" placeholder='4자리'>
                    </dd>
                </dl>
                <div class="agr_form">
                    <ul>
                        <li>
                            <input type="checkbox" id="agr01" v-model="agree">
                            <label for="agr01">
                                <p><i class="fa-solid fa-square-check"></i>개인정보처리방침 동의</p>
                                <button type="button" class="btn" data-toggle="modal" data-target="#privacyModal">약관보기</button>
                            </label>
                        </li>
                    </ul>
                </div>
            </template>


            <template v-slot:footer>
                <button type="button" class="bttn btn-save" @click="postData();">사전 장례상담 신청</button>
            </template>
        </item-bs-modal>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            modal : {type : Boolean, default : false},
            type : {type : String, default : ""},
            primary : {type : String, default : ""},
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {},
                required : [
                    {name : "name",message : "이름을 입력해주세요."},
                    {name : "phone2",message : "휴대폰 번호를 입력해주세요."},
                    {name : "phone3",message : "휴대폰 번호를 입력해주세요."},
                ],
                data : {
                    type : this.type,
                    name : "",
                    phone : "",
                    company : "",
                    content : "",
                    phone1 : "010",
                    phone2 : "",
                    phone3 : "",
                },
                agree : false,

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
                this.data.phone = this.phone;
                console.log(this.data);
                try {
                    if(!this.agree) throw new Error("개인 정보처리 방침에 동의 해주세요.");

                    let res = await this.jl.ajax(method,this.data,"/api/consult.php",options);

                    alert("완료 되었습니다");
                    window.location.reload();
                }catch (e) {
                    alert(e.message)
                }

            },
            async getData() {
                try {
                    let res = await this.jl.ajax("get",this.filter,"/api/consult.php");
                    //this.data = res.data[0]
                    alert("신청 되었습니다.");
                    window.location.reload();
                }catch (e) {
                    alert(e.message)
                }
            }
        },
        computed: {
            phone() {
                return [this.data.phone1,this.data.phone2,this.data.phone3].join('-');
            }
        },
        watch : {

        }
    });
</script>

<style>

</style>