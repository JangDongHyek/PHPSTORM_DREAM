<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile07">
        <div>
            <h4>상주 가능 여부를 선택해 주세요</h4>
            <dl>
                <dd>
                    <select>
                        <option>상주 가능</option>
                        <option>상주 불가능</option>
                    </select>
                </dd>
            </dl>
            <!--상주 가능 선택시-->
            <dl>
                <dt>희망 근무 형태</dt>
                <dd class="flex select">
                    <input type="checkbox"><label>파트타임</label>&nbsp;
                    <input type="checkbox"><label>풀타임</label>
                </dd>
            </dl>
            <dl>
                <dt>희망 근무지</dt>
                <dd>
                    <select>
                        <option>서대문/마포/은평</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>현재 상태</dt>
                <dd>
                    <select>
                        <option>프로젝트 찾는 중</option>
                        <option>프로젝트 투입 중</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>근무 시작 가능일</dt>
                <dd>
                    <input type="date">
                </dd>
            </dl>
            <dl>
                <dt>희망 월급</dt>
                <dd class="flex">
                    <input type="text" placeholder="최소(천원단위)">&nbsp;원<span>~</span><input type="text" placeholder="최대(천원단위)">&nbsp;원
                </dd>
            </dl>
            <!--상주 가능 선택시-->
        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {

        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/example.php", objs);
                if (res) {
                    this.jl.log(res)
                    this.data = res.response.data
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