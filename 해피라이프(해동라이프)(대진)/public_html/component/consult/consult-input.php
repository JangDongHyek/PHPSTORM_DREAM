<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="container">
        <div class="form-group">
            <label for="phone"><span class="required">(필수)</span> 타입</label>
            <div>
                <select v-model="data.type">
                    <option value="베네피아">베네피아</option>
                    <option value="이제너두">이제너두</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="name"><span class="required">(필수)</span> 성명</label>
            <input type="text" id="name" placeholder="입력하세요" v-model="data.name">
        </div>

        <div class="form-group">
            <label for="phone"><span class="required">(필수)</span> 휴대폰</label>
            <div class="phone-input">
                <select id="phone" v-model="data.phone[0]">
                    <option value="010">010</option>
                    <option value="011">011</option>
                    <option value="016">016</option>
                    <option value="019">019</option>
                </select>
                <span>-</span>
                <input type="text" placeholder="4자리" v-model="data.phone[1]" maxlength="4">
                <span>-</span>
                <input type="text" placeholder="4자리" v-model="data.phone[2]" maxlength="4">
            </div>
        </div>

        <div class="form-group">
            <label for="company"><span class="required">(필수)</span> 고객사명</label>
            <input type="text" id="company" placeholder="입력하세요" v-model="data.company">
        </div>

        <div class="form-group">
            <label for="company">비고</label>
            <textarea v-model="data.content"></textarea>
        </div>

        <button class="register-button" @click="postData()">고객등록</button>
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
                filter : {

                },
                required : [
                    {name : "type",message : "타입을 선택해주세요."},
                    {name : "name",message : "성명을 입력해주세요."},
                    {name : "company",message : "고객사명을 입력해주세요."},
                ],
                data : {
                    type : "",
                    name : "",
                    phone : ["010","",""],
                    company : "",
                    content : ""
                },
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            postData : async function() {
                let method = this.primary ? "update" : "insert";
                let options = {required : this.required};

                if(this.data.phone[1] == "" || this.data.phone[2] == "") {
                    alert("핸드폰번호를 입력해주세요.")
                    return false;
                }

                let data = this.jl.copyObject(this.data);
                console.log(data);
                data.phone = data.phone.join("-");
                try {
                    let res = await this.jl.ajax(method,data,"/api/consult.php",options);

                    alert("등록되었습니다");
                    window.location.reload();
                }catch (e) {
                    alert(e.message)
                }

            },
            getData: async function () {
                let filter = {primary: this.primary}

                try {
                    let res = await this.jl.ajax("get",filter,"/api/consult.php");
                    res.data[0].phone = res.data[0].phone.split("-");
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
    .container {
        width: 50%;
        margin: 0 auto;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .required {
        color: #007bff;
    }

    input[type="text"], select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        margin-top: 5px;
        height: auto;
    }

    .phone-input {
        display: flex;
        gap: 10px;
    }

    .phone-input select,
    .phone-input input {
        width: calc(33% - 7px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .phone-input span {
        display: flex;
        align-items: center;
    }
</style>