<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="postcode-container" style="border:1px solid #ddd; padding:10px; width:100%; height:400px; overflow:auto;"></div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                modal : {type : Boolean, default : false},
                primary: {type: String, default: ""},
            },
            data: function () {
                return {
                    jl: null,
                    component_idx: "",

                    paging: {
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    data: {},
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
            },
            mounted() {
                this.$nextTick(() => {
                    this.openPostcode();
                });
            },
            updated() {

            },
            methods: {
                openPostcode() {
                    let component = this;
                    const container = document.getElementById("postcode-container");
                    const postcode = new daum.Postcode({
                        oncomplete: (data) => {
                            // 검색 결과에서 필요한 데이터 추출
                            this.address = data.roadAddress || data.jibunAddress;
                            this.postcode = data.zonecode;
                            component.$emit("select",data);
                        },
                        onresize: (size) => {
                            container.style.height = size.height + "px";
                        },
                        width: "100%",
                        height: "100%"
                    });
                    // Postcode를 container에 embed
                    postcode.embed(container);
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>
    #postcode-container {
        border: 1px solid #ddd;
        padding: 10px;
        width: 100%;
        height: 400px;
        overflow: auto;
    }
</style>