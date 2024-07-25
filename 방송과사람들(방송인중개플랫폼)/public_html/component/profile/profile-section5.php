<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile05">
        <div>
            <h4>경력기간</h4>
            <dl>
                <dt>총 경력기간을 선택해 주세요</dt>
                <dd>
                    <select>
                        <option>신입</option>
                        <option>1년</option>
                        <option>2년</option>
                        <option>3년</option>
                        <option>4년</option>
                        <option>5년</option>
                        <option>6년</option>
                        <option>7년</option>
                        <option>8년</option>
                        <option>9년</option>
                        <option>10년</option>
                        <option>11년</option>
                        <option>12년</option>
                        <option>13년</option>
                        <option>14년</option>
                        <option>15년</option>
                        <option>16년 이상</option>
                    </select>
                </dd>
            </dl>
            <div class="box_blue" id="tip">
                <p>TIP</p>
                <ul>
                    <li>전문 분야와 직접적으로 연관된 총 경력 기간을 선택해 주세요.</li>
                </ul>
            </div>
        </div>
        <div>
            <h4>경력 사항</h4>
            <p class="red_point">
                <input type="checkbox" id="freelancer-checkbox" name="freelancer">
                <label for="freelancer-checkbox">프리렌서인 경우, 체크해주세요</label>
            </p>
            <dl>
                <dt>회사명</dt>
                <dd>
                    <input type="text" placeholder="회사명 입력">
                </dd>
            </dl>
            <dl>
                <dt>근무부서</dt>
                <dd>
                    <input type="text" placeholder="근무부서 입력">
                </dd>
            </dl>
            <dl>
                <dt>직위</dt>
                <dd>
                    <input type="text" placeholder="직워 입력">
                </dd>
            </dl>
            <dl>
                <dt>근무지</dt>
                <dd>
                    <select>
                        <option>시/도 선택</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>근무기간</dt>
                <dd>
                    <div class="flex">
                        <select>
                            <option>년</option>
                        </select>
                        &nbsp;
                        <select>
                            <option>개월</option>
                        </select>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>증빙자료 첨부(선택)</dt>
                <dd>
                    <div id="addFile">
                        <a class="btn">파일 첨부</a>
                        <span>증빙자료 파일 첨부</span>
                    </div>
                </dd>
            </dl>

        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            user: {type: Object, default: {}}
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