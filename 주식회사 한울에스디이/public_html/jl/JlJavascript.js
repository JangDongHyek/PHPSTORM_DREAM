class JlJavascript extends Jl{

    /*
    textarea_id = textarea 태그 아이디
    default_content = 기본값 배열 변수값을 []로 선언후 파라미터 삽입
    content = 기본텍스트값 데이터 저장된값을 js변수에 담아준후 파라미터 삽입
     */
    loadEditor(textarea_id,default_content,content) {
        let jl = this;
        jl.loadJS(Jl_editor_js);

        document.addEventListener('DOMContentLoaded', function(){
            nhn.husky.EZCreator.createInIFrame({
                oAppRef: default_content,
                elPlaceHolder: textarea_id,
                sSkinURI: jl.root + jl.editor,
                htParams : {
                    bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                    bSkipXssFilter : true,		// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                    I18N_LOCALE : "ko_KR",
                    fOnBeforeUnload : function(){}
                }, //boolean
                fOnAppLoad : function(){
                    //기존 저장된 내용의 text 내용을 에디터상에 뿌려주고자 할때 사용
                    default_content.getById[textarea_id].exec("PASTE_HTML", [content]);
                },
                fCreator: "createSEditor2"
            });
            default_content.outputBodyHTML = function(){
                default_content.getById[textarea_id].exec("UPDATE_CONTENTS_FIELD", []);
            }

        },false);
    }

    /*
    textarea_id = textarea 태그 아이디
    default_content = 위에 선언한 변수값을 삽입
     */
    getEditorContent(textarea_id,default_content) {
        return default_content.getById[textarea_id].getIR().replaceAll('"',"'")
    }

    /*
    input_file = input 태그 아이디
    preview = div 태그 아이디
    리턴값은 인풋파일태그 obj[file_key] 부분에 리턴값넣어주면 ajax 쪽에서 알아서 가공
    */
    hookFileEvent(input_file,preview = '') {
        // 파일 입력 요소와 미리보기 컨테이너 가져오기
        let fileInput = document.getElementById(input_file);
        if(!fileInput) {
            alert(input_file + "  태그를 찾을수 없습니다.");
            return false;
        }
        let previewContainer = document.getElementById(preview);
        let selectedFiles = Array.from(fileInput.files);

        fileInput.addEventListener('change', function() {
            selectedFiles = selectedFiles.concat(Array.from(fileInput.files));
            //console.log(selectedFiles);

            if(previewContainer) {
                previewContainer.innerHTML = ''; // Clear previous previews

                // 각 파일에 대해 미리보기 생성
                selectedFiles.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgPreview = document.createElement('div');
                        imgPreview.classList.add('image-preview');

                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.width = 50;
                        imgElement.height = 50;

                        const deleteBtn = document.createElement('button');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.textContent = 'x';
                        deleteBtn.addEventListener('click', function() {
                            // 삭제 버튼 클릭 시 미리보기 제거
                            previewContainer.removeChild(imgPreview);

                            // 삭제된 파일을 `selectedFiles`에서 제거
                            selectedFiles = selectedFiles.filter(f => f !== file);

                            // 새로운 파일 목록으로 `fileInput` 업데이트
                            const dataTransfer = new DataTransfer();
                            selectedFiles.forEach(f => dataTransfer.items.add(f));
                            fileInput.files = dataTransfer.files;
                        });

                        imgPreview.appendChild(imgElement);
                        imgPreview.appendChild(deleteBtn);
                        previewContainer.appendChild(imgPreview);
                    }
                    reader.readAsDataURL(file);
                });
            }

        });

        return fileInput;
    }
}