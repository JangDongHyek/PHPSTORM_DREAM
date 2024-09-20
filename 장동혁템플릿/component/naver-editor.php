<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <textarea :name="name" v-bind:id="name" rows="10" cols="100" style="width:100%; height:300px; display:none;"></textarea>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            content : {type : String,default: ""},
            name : {type : String,default: "content"},
        },
        data: function(){
            return {
                jl : null,
                default_content : [],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            let jl = this.jl;

            this.jl.loadJS(Jl_editor_js);


            /*
            JL.php 에 editor 경로를 입력해줘야합니다.
            ** 그누보드일경우 photo_uploader/popup/php/index.php 파일의 해쉬검증부분 삭제후 사용해야합니다
            ex) $is_editor_upload = true
             */
        },
        mounted: function(){
            this.init();

        },
        methods: {
            getContent : function() {
                return this.default_content.getById[this.name].getIR().replaceAll('"',"'")
            },
            init : function() {
                var component = this;
                var default_content = this.default_content;
                var sLang = "ko_KR";	// 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR
                this.$nextTick(function() {
                    nhn.husky.EZCreator.createInIFrame({
                        oAppRef: default_content,
                        elPlaceHolder: component.name,
                        sSkinURI: component.jl.root + component.jl.editor,
                        htParams : {
                            bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                            bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                            bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                            bSkipXssFilter : true,		// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                            I18N_LOCALE : sLang,
                            fOnBeforeUnload : function(){}
                        }, //boolean
                        fOnAppLoad : function(){
                            //기존 저장된 내용의 text 내용을 에디터상에 뿌려주고자 할때 사용
                            default_content.getById[component.name].exec("PASTE_HTML", [component.content]);
                        },
                        fCreator: "createSEditor2"
                    });
                    default_content.outputBodyHTML = function(){
                        default_content.getById[component.name].exec("UPDATE_CONTENTS_FIELD", []);
                    }
                });
            }
        }
    });
</script>