<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <item-bs-modal :modal="modal" @close="$emit('close')">
            <template v-slot:header>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">적립금 신청하기</h4>
            </template>

            <!-- body -->
            <template v-slot:default>
                <form id="modal_form">
                    <input type="hidden" id="type" name="type" value="<?=$type?>">
                    <div id="cashback_form">
                        <dl class="">
                            <dt>
                                <span class="color-red">(필수)</span>
                                신청인 성명
                            </dt>
                            <dd>
                                <input type="text" class="input_form" placeholder='입력하세요' id="mb_name" name="mb_name">
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <span class="color-red">(필수)</span>
                                해피라이프 이용일자
                            </dt>
                            <dd>
                                <input type="date" class="input_form" id="use_date" name="use_date">
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <span class="color-red">(필수)</span>
                                신청인 휴대폰
                            </dt>
                            <dd class="input_phone">
                                <input type="tel" class="input_form" placeholder='입력하세요' id="mb_hp" name="mb_hp">
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <span class="color-red">(필수)</span>
                                이용인 성명
                            </dt>
                            <dd>
                                <input type="text" class="input_form" placeholder='입력하세요' id="use_name" name="use_name">
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <span class="color-red">(필수)</span>
                                신청인 고객사명
                            </dt>
                            <dd>
                                <input type="text" class="input_form" placeholder='입력하세요' id="mb_company" name="mb_company">
                            </dd>
                        </dl>
                        <div class="agr_form">
                            <h6>
                                <span class="color-red">(필수)</span>
                                약관 동의
                            </h6>
                            <ul>
                                <li>
                                    <? if($type == "현대이지웰") { ?>
                                        <textarea class="input_form" disabled>
▶ 복지관 적립금은 상품 가입 후 익월 말 일괄 적립되며, 유효 기간은 1년 입니다.
▶ 해당 서비스를 통해 적립된 금액은 복지관에서 상품 구매 시 사용할 수 있습니다.
▶ 구매 시 적립금 사용 후 주문을 취소하는 경우, 환불은  동일하게 적립금으로 이루어지며, 환불 규정은 이지웰 이용 약관에 따릅니다.
                                                </textarea>
                                    <?} ?>

                                    <input type="checkbox" id="is_agree" name="is_agree" value="Y">
                                    <label for="is_agree"><i class="fa-solid fa-square-check"></i>위 약관에 동의합니다.</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </template>


            <template v-slot:footer>

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
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",
                filter : {},
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