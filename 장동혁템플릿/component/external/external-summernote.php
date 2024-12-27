<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div :id="component_idx"></div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""},
            content : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                component_idx : "",

                paging : {
                    page : 1,
                    limit : 1,
                    count : 0,
                }
            };
        },
        async created(){
            this.jl = new Jl('<?=$componentName?>');
            this.component_idx = this.jl.generateUniqueId();

            let plugins = this.jl.checkPlugin(["jquery","bootstrap","summernote"]);
        },
        mounted: function(){
            let component = this;

            this.$nextTick(() => {
                $(document).ready(function() {
                    console.log(component.content);
                    $(`#${component.component_idx}`).summernote({
                        height: 400,
                        lang: 'ko-KR',
                        toolbar: [
                            // 기본 툴바 설정
                            ['font', ['bold', 'underline', 'clear']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['paragraph']], //'ul', 'ol',
                            ['insert', ['picture', 'link']], // 이미지 삽입 버튼 추가
                            // 플러그인 버튼 추가
                            ['view', ['undo', 'redo']],
                        ],
                        fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '30', '36', '50', '72'],
                        placeholder: '내용을 입력해 주세요',
                        popover: {
                            image: [
                                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                                ['float', ['floatLeft', 'customFloatCenter', 'floatRight', 'floatNone']],
                                ['remove', ['removeMedia']]
                            ]
                        },
                        callbacks: {
                            onImageUpload: async function(files) {
                                // 업로드된 파일 처리
                                for (let i = 0; i < files.length; i++) {
                                    await component.uploadImage(files[i], this);
                                }
                            },
                        }


                    });

                    if(component.content) $(`#${component.component_idx}`).summernote('code', component.content); // 에디터 내용 불러오기

                });
            });


        },
        updated : function() {

        },
        methods: {
            getContent() {
                return $(`#${this.component_idx}`).summernote('code');
            },
            async uploadImage(file,editor) {
                let method = "file";
                let data = {
                    table : "basic",
                    upfile : file,
                }
                try {
                    let res = await this.jl.ajax(method,data,"/jl/JlApi.php");

                    $(editor).summernote('insertImage', this.jl.root+"/"+res.file.src);
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