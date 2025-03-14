<?php
$componentName = str_replace(".php","",basename(__FILE__));
$pathParts = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
$context_name = end($pathParts);
?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div v-if="load">
        <div class="zone">
            <div class="flex ai-c jc-sb">
                <button class="btn btn-small btn-blue" @click="modal.primary = '' ; modal.status = true;">구역 추가</button>
                <button class="btn btn-small btn-darkblue male-auto">저장</button>
            </div>
            <div class="flex">
                <div class="left">
                    <div class="sticky">
                        <button type="button" class="btn btn-gray w100" data-toggle="modal" data-target="#sectionModal">구역 추가</button>
                        <ul>
                            <li class="active"><a href="#build1"><i class="fa-duotone fa-grid-horizontal"></i>&nbsp;101동 <button class="btn btn-mini btn-line" data-toggle="modal" data-target="#sectionModal">설정</button></a> </li>
                            <li class=""><a href="#build2"><i class="fa-duotone fa-grid-horizontal"></i>&nbsp;102동 <button class="btn btn-mini btn-line" data-toggle="modal" data-target="#sectionModal">설정</button></a></li>
                        </ul>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>동</th>
                            <th>층</th>
                            <th>구역</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="build1">
                            <td rowspan="3">
                                <h3>101동</h3>
                                <button class="btn btn-mini btn-blueline">층 추가</button>
                                <button class="btn btn-mini btn-line">삭제</button>
                            </td>
                            <td rowspan="2"><b>1층</b> <button class="btn btn-mini btn-blueline">구역 추가</button> <button class="btn btn-mini btn-line">삭제</button></td>
                            <td><div class="flex"><input type="text" value="A 구역" placeholder="구역명"> <button class="btn btn-mini btn-line">삭제</button></div></td>
                        </tr>
                        <tr>
                            <td><div class="flex"><input type="text" value="B 구역" placeholder="구역명"> <button class="btn btn-mini btn-line">삭제</button></div></td>
                        </tr>
                        <tr>
                            <td rowspan="1"><b>2층</b> <button class="btn btn-mini btn-blueline">구역 추가</button> <button class="btn btn-mini btn-line">삭제</button></td>
                            <td><div class="flex"><input type="text" value="A 구역" placeholder="구역명"> <button class="btn btn-mini btn-line">삭제</button></div></td>
                        </tr>
                        <tr id="build2">
                            <td rowspan="5">
                                <h3>102동</h3>
                                <button class="btn btn-mini btn-blueline">층 추가</button>
                                <button class="btn btn-mini btn-line">삭제</button>
                            </td>
                            <td><b>1층</b> <button class="btn btn-mini btn-blueline">구역 추가</button> <button class="btn btn-mini btn-line">삭제</button></td>
                            <td>구역 없음</td>
                        </tr>
                        <tr>
                            <td><b>2층</b> <button class="btn btn-mini btn-blueline">구역 추가</button> <button class="btn btn-mini btn-line">삭제</button></td>
                            <td>구역 없음</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <zone-input :modal="modal" :project_idx="project_idx"></zone-input>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                project_idx : { type: String, default: "" },
                primary : { type: String, default: "" },
            },
            data: function () {
                return {
                    load : false,
                    jl: null,
                    component_idx: "",
                    context_name : "<?=$context_name?>",
                    context : null,

                    row: {},
                    rows : [],

                    options : {
                        table : "",
                        file_use : false,
                        required : [
                            {name : "",message : ``},
                        ],
                        href : "",
                    },

                    filter : {
                        table : "",
                        primary : this.primary,
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    modal : {
                        status : false,
                        load : false,
                        primary : "",
                        data : {},
                        class_1 : "sectionModal",
                        class_2 : "",
                    },

                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
                const className = this.context_name.charAt(0).toUpperCase() + this.context_name.slice(1) + "Common";
                if (typeof window[className] !== 'undefined') {
                    this.context = new window[className](this.jl);
                }
            },
            async mounted() {
                if(this.primary) this.row = await this.jl.getData(this.filter);
                //await this.jl.getsData(this.filter,this.rows);

                this.load = true;

                this.$nextTick(() => {

                });
            },
            updated() {

            },
            methods: {

            },
            computed: {

            },
            watch: {
                async "modal.status"(value,old_value) {
                    if(value) {
                        this.modal.load = true;
                    }else {
                        this.modal.load = false;
                        this.modal.data = {};
                    }
                }
            }
        }});

</script>

<style>

</style>