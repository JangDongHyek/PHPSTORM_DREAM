<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="pdf_canvas">
        <canvas :id="component_idx"></canvas>

        <div class="flex">
            <a @click="setPage(page -1)"> <i class="fa-solid fa-left"></i> </a>
            <p><b class="txt_color">{{page}}</b> / {{last}}</p>
            <a @click="setPage(page +1)"> <i class="fa-solid fa-right"></i> </a>
            <button type="button" class="btn btn-default" data-dismiss="modal" @click="$emit('close')">닫기</button>
        </div>

    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                src : {type: String, default: ""},
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

                    file : "",

                    page : 1,
                    last : 0,
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();

                this.file = this.jl.root + this.src;

            },
            mounted() {
                this.$nextTick(() => {
                    this.initPDF();
                });
            },
            updated() {

            },
            methods: {
                setPage(page) {
                    if(page < 1) return false;
                    if(page > this.last) return false;

                    this.page = page;
                },
                initPDF() {
                    this.$nextTick(() => {
                        let component = this;
                        let canvas = document.getElementById(this.component_idx);
                        console.log(canvas);
                        let context = canvas.getContext('2d');

                        pdfjsLib.getDocument(this.file).promise.then(pdf => {
                            console.log(pdf);
                            component.last = pdf.numPages;
                            pdf.getPage(component.page).then(page => {
                                const viewport = page.getViewport({ scale: 1 });
                                canvas.width = viewport.width;
                                canvas.height = viewport.height;

                                const renderContext = {
                                    canvasContext: context,
                                    viewport: viewport,
                                };
                                page.render(renderContext);
                            });
                        });
                    });

                }
            },
            computed: {},
            watch: {
                page() {
                    this.initPDF();
                }
            }
        }});

</script>
