<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load" class="captcha-container">
        <template v-if="!row[field]">
            <img :src="image" class="captcha-img">
            <input type="text" class="captcha-input" v-model="captcha_code" placeholder="입력하세요">
            <button class="captcha-refresh" @click="getCaptcha()">
                <!-- SVG 새로고침 아이콘 -->
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.36-3.36L23 10"></path>
                    <path d="M20.49 15a9 9 0 0 1-14.36 3.36L1 14"></path>
                </svg>
            </button>

            <button class="captcha-submit" @click="checkCaptcha()">확인</button>
        </template>

        <template v-else>
            <h2>완료되었습니다.</h2>
        </template>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                row : {type: Object, default: {}},
                field : {type: String, default: ""},
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",

                    image : "",
                    captcha_code : "",
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
            },
            async mounted() {
                if(this.jl.isEmptyObject(this.row)) {
                    await this.jl.alert("row값이 빈 객체입니다.");
                    return false;
                }
                if(!this.field){
                    await this.jl.alert("field값이 빈 값입니다.");
                    return false;
                }
                console.log(typeof this.row[this.field]);
                if(typeof this.row[this.field] !== "boolean"){
                    await this.jl.alert("field값이 boolean타입이아닙니다");
                    return false;
                }
                if(this.row[this.field]){
                    await this.jl.alert("기본값이 false가 아닙니다");
                    return false;
                }

                await this.getCaptcha();

                this.load = true;
            },
            updated() {

            },
            methods: {
                async getCaptcha() {
                    await this.jl.ajax("captcha_image",{},"/jl/JlApi.php").then(response => {
                        this.image = response.src;
                    });
                },

                async checkCaptcha() {
                    await this.jl.ajax("captcha_check",{captcha_code : this.captcha_code},"/jl/JlApi.php").then(response => {
                        this.row[this.field] = true;
                    }).catch(async (error) => {
                        await this.jl.alert(error)
                    });
                }
            },
            computed: {

            },
            watch: {

            }
        }});

</script>

<style>
    .captcha-container {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #f8f8f8;
        width: max-content;
    }

    .captcha img {
        height: 50px;
        width: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .captcha-refresh, .captcha-submit {
        width: 35px;
        height: 35px;
        border: none;
        background: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .captcha-refresh svg {
        width: 20px;
        height: 20px;
        stroke: #007bff;
        transition: transform 0.3s ease;
    }

    .captcha-refresh:hover svg {
        transform: rotate(180deg);
    }

    .captcha-input {
        width: 120px;
        height: 35px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        text-align: center;
        flex-grow: 1;
    }

    .captcha-input:focus {
        border-color: #007bff;
        outline: none;
    }

    /* 확인 버튼 스타일 */
    .captcha-submit {
        background: #007bff;
        color: white;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        width: 60px;
        transition: background 0.3s ease;
    }

    .captcha-submit:hover {
        background: #0056b3;
    }


</style>