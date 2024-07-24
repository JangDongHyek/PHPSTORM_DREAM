<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile04">
        <div>
            <h4>학력전공</h4>
            <dl>
                <dt>학교명</dt>
                <dd><input type="text" id="" placeholder="학교명 입력" value=""></dd>
            </dl>
            <dl>
                <dt>전공</dt>
                <dd><input type="text" id="" placeholder="전공 입력" value=""></dd>
            </dl>
            <dl>
                <dt>상태</dt>
                <dd><select>
                        <option>이수</option>
                        <option>졸업</option>
                        <option>재학</option>
                        <option>휴학</option>
                    </select></dd>
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
            <div class="box_blue" id="tip">
                <p>TIP</p>
                <ul>
                    <li>증빙 자료 첨부하시면 담당자 검토후 확인 마크<i class="fa-sharp fa-solid fa-badge-check"></i>를 달아드립니다.</li>
                    <li><strong>첨부가능자료 : 재학증명서, 졸업증명서,성적증명서</strong></li>
                </ul>
            </div>
        </div>
        <div>
            <h4>보유 자격증</h4>
            <dl>
                <dt>자격증명</dt>
                <dd><input type="text" id="" placeholder="자격증명 입력" value=""></dd>
            </dl>
            <dl>
                <dt>발급기관</dt>
                <dd><input type="text" id="" placeholder="발급기관 입력" value=""></dd>
            </dl>
            <dl>
                <dt>발급일</dt>
                <dd><input type="date" id="" value=""></dd>
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
            <div class="box_blue" id="tip">
                <p>TIP</p>
                <ul>
                    <li>증빙 자료 첨부하시면 담당자 검토후 확인 마크<i class="fa-sharp fa-solid fa-badge-check"></i>를 달아드립니다.</li>
                    <li><strong>첨부가능자료 : 자격증사본</strong></li>
                </ul>
            </div>
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