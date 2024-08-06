<?php
?>

<script type="text/x-template" id="naver-editor-template">
    <textarea :name="name" v-bind:id="name" rows="10" cols="100" style="width:100%; height:30px; display:none;"></textarea>
</script>

<script type="text/javascript" src="<?=G5_URL?>/plugin/editor/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
<script>
    Vue.component('naver-editor', {
        template: "#naver-editor-template",
        props: {
            content : {type : String,default: ""},
            name : {type : String,default: "content"},
        },
        data: function(){
            return {
                default_content : [],
            };
        },
        created: function(){
            // default_content = []
            // content = ""
            // 에디터 내용을 저장하고싶을땐 부모컴포넌트의 data.content = this.default_content.getById["content"].getIR().replaceAll('"',"'")
            this.init();

        },
        mounted: function(){

        },
        methods: {
            connectData : function(object,key) {
                object[key] = this.default_content.getById[this.name].getIR().replaceAll('"',"'")
            },
            init : function() {
                var component = this;
                var default_content = this.default_content;
                var sLang = "ko_KR";	// 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR
                this.$nextTick(function() {
                    nhn.husky.EZCreator.createInIFrame({
                        oAppRef: default_content,
                        elPlaceHolder: component.name,
                        sSkinURI: "<?=G5_URL?>/plugin/editor/smarteditor2/SmartEditor2Skin.html",
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