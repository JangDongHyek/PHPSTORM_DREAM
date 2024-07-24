<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile08">
        <div class="history_form">
            <h4>프로젝트 진행 이력</h4>
            <dl>
                <dt class="flex">
                    <input id="inputField" type="text" placeholder="이력을 입력해주세요">
                    <button id="addButton"><i class="fa-light fa-plus"></i></button>
                </dt>
                <dd class="tag">
                    <p>드림포원 2021-05 ~ 2024-05 <a class="del"><i class="fa-light fa-xmark"></i></a></p>
                </dd>
            </dl>
            <dl>
                <dt>주제</dt>
                <dd>
                    <input type="text" placeholder="주제 입력">
                </dd>
            </dl>
            <dl>
                <dt>수행분야</dt>
                <dd>
                    <select>
                        <option>선택해 주세요</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>진행기간</dt>
                <dd class="flex">
                    <input type="date"><span>~</span><input type="date">
                </dd>
                <dd class="setting">
                    <input type="checkbox" id="btnToggle2">
                    <label class="control">진행중</label>
                </dd>
            </dl>
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