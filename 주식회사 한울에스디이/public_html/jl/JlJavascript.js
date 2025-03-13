// int일경우 자동으로 컴마가 붙는 프로토타입
Number.prototype.format = function (n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

// Date 타입의 변수 자동으로 포맷팅 YYYY-MM-DD 로 반환됌
Date.prototype.format = function () {
    const year = this.getFullYear();
    const month = String(this.getMonth() + 1).padStart(2, '0');
    const day = String(this.getDate()).padStart(2, '0');

    return `${year}-${month}-${day}`;
};

/**
 * 숫자(바이트 단위)를 읽기 쉬운 크기 단위로 변환하는 프로토타입
 * @param {number} decimals - 소수점 자릿수 (기본값: 2)
 * @returns {string} 읽기 쉬운 크기 단위 (예: "408 KB", "3.5 MB")
 */
Number.prototype.formatBytes = function (decimals = 2) {
    if (this === 0) return '0 Bytes';

    const k = 1024; // 1 KB = 1024 Bytes
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const dm = decimals < 0 ? 0 : decimals;

    // 단위 결정
    const i = Math.floor(Math.log(this) / Math.log(k));
    const size = parseFloat((this / Math.pow(k, i)).toFixed(dm));

    return `${size} ${sizes[i]}`;
};

String.prototype.formatDate = function(options = { time: false, type: '-', simple: true }) {
    // 기본 옵션 설정
    const defaultOptions = { time: false, type: '-', simple: true };
    const opts = Object.assign({}, defaultOptions, options); // 사용자 옵션 병합

    // 날짜와 시간 분리
    let [datePart, timePart] = this.split(' ');

    // 날짜를 '-' 기준으로 분리
    let parts = datePart.split('-');

    // simple 옵션이 true이면 연도를 두 자리로 변환
    if (opts.simple) {
        parts[0] = parts[0].slice(2); // "2024" -> "24"
    }

    // 변환된 날짜 문자열
    let formattedDate = parts.join(opts.type);

    // time 옵션이 true이면 시간 추가
    if (opts.time && timePart) {
        formattedDate += ` ${timePart}`; // 시간 추가
    }

    return formattedDate;
};

class JlJavascript {
    constructor(jl) {
        this.jl = jl;
    }

    JS_INIT(object = {}) {
        let t = this;
        document.addEventListener('DOMContentLoaded', function(){
            t.keyEvent();
            t.setElement();

            // 페이징 설정 option = {page_id : 'pagination',page : page, total_page : total_page}
            if('page_id' in object) t.setPage(object.page_id,object.page,object.total_page);
        },false)
    }

    /*
    샘플 페이지 div
    <div class="paging" id="pagination">
        <div class="pagingWrap">
            <a class="first" first><i class="fa-light fa-chevrons-left"></i></a>
            <a class="prev" prev><i class="fa-light fa-chevron-left"></i></a>
            <span pageEvent="onSearch">
                <a class="active">1</a>
            </span>
            <a class="next" next><i class="fa-light fa-chevron-right"></i></a>
            <a class="last" last><i class="fa-light fa-chevrons-right"></i></a>
        </div>
    </div>

    추가설명 페이지부분에 span 태그를 추가해줘서 page변경 이벤트 삽입 해줘야합니다.
     */
    setPage(div_id,page,total_page) {
        if(!div_id) {
            jl.log("page_id 를 찾을수없음");
            return false;
        }
        const paginationElement = document.getElementById(div_id);

        if(!total_page) {
            paginationElement.innerHTML = '';
            return false;
        }

        //page가 없거나 0일때 처리
        page = page ? page : 1;


        if (!paginationElement) {
            jl.log('페이지 div 가 없습니다');
            return;
        }

        const firstElement = paginationElement.querySelector('[first]');
        const prevElement = paginationElement.querySelector('[prev]');
        const nextElement = paginationElement.querySelector('[next]');
        const lastElement = paginationElement.querySelector('[last]');

        if(page == 1 && firstElement) {
            firstElement.remove();
            prevElement.remove();
        }
        if(page == total_page && lastElement) {
            lastElement.remove();
            nextElement.remove();
        }

        const pageSpanElement = paginationElement.querySelector('[pageEvent]');
        if (!paginationElement) {
            jl.log('pageSpan 엘리먼트가 없습니다.');
            return false;
        }

        const functionName = pageSpanElement.getAttribute('pageEvent');
        if (typeof window[functionName] !== 'function') {
            console.log("함수없음");
        }

        // 첫 번째 태그를 복사
        const pageElement = paginationElement.querySelector('[pageEvent] *');
        if (!pageElement) {
            jl.log('pageSpan에 첫번째 태그가 없습니다');
            return false;
        }


        //span 태그 초기화
        pageSpanElement.innerHTML = "";

        let start_page = page - 3
        let end_page = page + 4

        if(start_page < 1) start_page = 1
        if(end_page > total_page) end_page = total_page;

        for (let i = start_page; i <= end_page; i++) {
            let el = pageElement.cloneNode(true);
            if(i != page) el.className = '';
            el.textContent = i;

            //function으로 안감싸주면 함수가 실행이 됌
            el.addEventListener('click',function() {
                window[functionName](i);
            });

            pageSpanElement.appendChild(el)
        }

        //first,prev,next,last 버튼 이벤트추가
        if(firstElement) firstElement.addEventListener('click',function() {window[functionName](1);});
        if(prevElement) prevElement.addEventListener('click',function() {window[functionName](page - 1);});
        if(nextElement) nextElement.addEventListener('click',function() {window[functionName](page +1);});
        if(lastElement) lastElement.addEventListener('click',function() {window[functionName](total_page);});
    }

    getCurrentUrl() {
        return window.location.protocol + "//" + window.location.host + window.location.pathname;
    }

    /*
    엘리먼트에 keyEvent.key='함수명' 이렇게있는애들에게 해당 키를 누를시 이벤트를 추가해주는 함수
    샘플
    <input type="search" id="search_value2" placeholder="검색어 입력" value="" keyEvent.enter="onSearch">
    */
    keyEvent() {
        // 모든 input 태그를 순회하여 커스텀 속성을 추적
        document.querySelectorAll('input[keyEvent\\.esc]').forEach(function(inputElement) {
            inputElement.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    event.preventDefault();

                    // 해당 input 태그의 keyEvent.esc 속성 값으로 함수를 찾고 실행
                    const functionName = inputElement.getAttribute('keyEvent.esc');
                    if (typeof window[functionName] === 'function') {

                        window[functionName](); // 해당하는 함수 호출
                    }
                }
            });
        });

        document.querySelectorAll('input[keyEvent\\.enter]').forEach(function(inputElement) {
            inputElement.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();

                    // 해당 input 태그의 keyEvent.esc 속성 값으로 함수를 찾고 실행
                    const functionName = inputElement.getAttribute('keyEvent.enter');
                    if (typeof window[functionName] === 'function') {
                        window[functionName](); // 해당하는 함수 호출
                    }
                }
            });
        });
    }

    /*
    프로퍼티 엘리먼트 안에있는 input 값들을 초기화 시켜주는 함수
     */
    resetElement(elementId) {
        // 특정 ID를 가진 요소 가져오기
        const container = document.getElementById(elementId);

        if (container) {
            // 요소 안에 있는 모든 input 요소 가져오기
            const inputs = container.querySelectorAll('input');

            // 각 input 요소를 순회하며 기본값으로 초기화
            inputs.forEach((input) => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = input.defaultChecked;
                } else {
                    input.value = input.defaultValue;
                }
            });
        }
    }

    /*
    겟 파라미터의 키값 기준으로 엘리먼트를 찾아 벨류를 변경하는 함수
    data 틑 넣어주면 해당 객체값으로 엘리먼트를 찾아 벨류를 변경한다
     */
    setElement(data,join_table = "") {
        // 1. URL의 GET 파라미터 또는 전달된 data 객체를 가져옴
        let params;

        if (data) {
            params = data;
        } else {
            params = Object.fromEntries(new URLSearchParams(window.location.search).entries());
        }

        // 2. 각 파라미터를 순환하며 동일한 ID 또는 name을 가진 엘리먼트를 찾아 값 변경
        Object.keys(params).forEach((key) => {
            let value;

            // 대문자 키 일경우 joinTable로 인식 setElement 재귀
            if (this.jl.isUpperCase(key)) {
                this.setElement(params[key],key);
            } else {
                value = params[key];
            }

            if(join_table) key = `${join_table}.${key}`;


            // 값이 undefined인 경우 다음으로 건너뜀
            if (value === undefined) {
                return;
            }

            // ID로 엘리먼트 찾기 (점이 포함된 경우 escape 처리)
            let element = document.getElementById(key);

            //if (!element && key.includes('.')) {
            //    element = document.querySelector(`[id="${CSS.escape(key)}"]`);
            //}

            // 라디오나 체크박스의 경우 name으로 접근해야 하므로 ID가 없으면 name으로 찾기
            if (!element) {
                element = document.querySelector(`[name="${key}"]`);
            }

            if (element) {
                if (element.tagName === 'SELECT') {
                    // select 요소의 값 변경
                    element.value = value;
                } else if (element.type === 'checkbox' || element.type === 'radio') {
                    // 체크박스 또는 라디오 버튼의 경우, 동일한 name을 가진 요소들 전부 처리
                    const elements = document.getElementsByName(key);
                    elements.forEach((el) => {
                        el.checked = el.value === value;
                    });
                } else if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                    // input 또는 textarea 요소의 값 변경
                    element.value = value;
                } else {
                    // 그 외 모든 요소의 텍스트 설정 (div, span, p, a 등)
                    element.innerText = value;
                }
            }
        });
    }

    /*
    obj = 객체
    키값 기준으로 get 파라미터 형식으로 url을 반환
     */
    getUrlQuery(obj) {
        return Object.keys(obj)
            .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(obj[key])}`)
            .join('&');
    }

    /*
    현재 url get파라미터 값을 객체로 반환하는 함수
     */
    getUrlParams() {
        // URLSearchParams를 사용하여 쿼리 스트링을 처리
        const params = new URLSearchParams(window.location.search);
        const paramsObject = {};

        // URLSearchParams의 모든 키-값 쌍을 객체에 추가
        params.forEach((value, key) => {
            paramsObject[key] = value;
        });

        return paramsObject;
    }

    /*
    checkbox_name = checkbox 의 name
    같은 네임의 체크박스중 체크된 값만 배열로 반환
     */
    getCheckboxName(checkbox_name) {
        // 모든 체크된 체크박스 가져오기
        const checkedBoxes = document.querySelectorAll(`input[name=${checkbox_name}]:checked`);

        // 체크된 체크박스의 값을 배열로 변환
        return Array.from(checkedBoxes).map(checkbox => checkbox.value);
    }

    /*
    input = input 아이디 문자열이나 배열로 가능하다
    string 이면 값 반환
    배열이면 넣은 값을 object 형태로 반환
     */
    getInputById(input) {
        let result = {};

        if (typeof input === 'string') {
            // 문자열이면 해당 ID의 input, select, radio 값을 객체로 반환
            const element = document.getElementById(input);
            if (element) {
                // select 요소일 경우 선택된 값을 가져옴
                if (element.tagName === 'SELECT') {
                    result = element.options[element.selectedIndex].value;
                } else if (element.type === 'radio') {
                    // radio 그룹 중 체크된 값을 가져옴
                    const radioGroup = document.querySelector(`input[name="${element.name}"]:checked`);
                    if (radioGroup) {
                        result = radioGroup.value;
                    }
                } else {
                    result = element.value;
                }
            } else {
                alert(`${input} 아이디를 가진 input, select 또는 radio를 찾을 수 없습니다.`);
                return false;
            }
        } else if (Array.isArray(input)) {
            // 배열이면 배열의 각 요소를 순환하여 객체로 반환
            input.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    // select 요소일 경우 선택된 값을 가져옴
                    if (element.tagName === 'SELECT') {
                        result[id] = element.options[element.selectedIndex].value;
                    } else if (element.type === 'radio') {
                        // radio 그룹 중 체크된 값을 가져옴
                        const radioGroup = document.querySelector(`input[name="${element.name}"]:checked`);
                        if (radioGroup) {
                            result[element.name] = radioGroup.value;
                        }
                    } else {
                        result[id] = element.value;
                    }
                } else {
                    alert(`${id} 아이디를 가진 input, select 또는 radio를 찾을 수 없습니다.`);
                    return false;
                }
            });
        } else {
            console.error("이 함수는 string, array 형태로만 가능합니다.");
        }

        return result;
    }

    /*
    태그 아이디 기반으로 아이디 기반의 태그 안에 required 값을 가져와 ajax 데이터에 넣을 옵션값을 반환하는 함수
    샘플
    <input type="text" id="title" required="아이디를 입력해주세요." placeholder="질문을 입력해주세요"/>
     */
    getFormRequired(formId) {
        const formElement = document.getElementById(formId);
        const requiredElements = formElement.querySelectorAll('[required]');
        const requiredArray = [];

        requiredElements.forEach((element) => {
            const id = element.id;
            const requiredMessage = element.getAttribute('required');

            if (id) {
                requiredArray.push({
                    name: id,
                    message: requiredMessage
                });
            }
        });

        return requiredArray;
    }

    /*
    form_id = form 태그 아이디
    폼 태그 아이디 기반으로 폼 에있는 모든 데이터를 아이디 기반으로 객체 생성후 반환
     */
    getFormById(form_id) {
        const form = document.getElementById(form_id);
        if (!form) {
            alert(`${form_id} 아이디를 가진 Form 을 찾을 수 없습니다.`);
            return false;
        }

        const formData = {};
        // input, textarea, select 요소를 모두 가져옴
        const inputs = form.querySelectorAll('input, textarea, select');

        inputs.forEach((input) => {
            const id = input.id;
            if (id) {
                if (input.type === 'radio') {
                    // radio 그룹 중 체크된 값만 가져옴
                    if (input.checked) {
                        formData[id] = input.value;
                    }
                } else if (input.type === 'checkbox') {
                    // checkbox는 체크된 경우만 가져옴
                    formData[id] = input.checked ? input.value : null;
                } else if (input.tagName === 'SELECT') {
                    // select 요소는 선택된 값을 가져옴
                    formData[id] = input.options[input.selectedIndex].value;
                } else {
                    // 그 외 input, textarea 요소 처리
                    formData[id] = input.value;
                }
            }
        });

        return formData;
    }

    /*
    textarea_id = textarea 태그 아이디
    default_content = 기본값 배열 변수값을 []로 선언후 파라미터 삽입
    content = 기본텍스트값 데이터 저장된값을 js변수에 담아준후 파라미터 삽입
    에디터를 불러들이는 함수
     */
    loadEditor(textarea_id,default_content,content) {
        let jl = this.jl;
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
    불러들인 에디터의 값을 가져오는 함수
     */
    getEditorContent(textarea_id,default_content) {
        return default_content.getById[textarea_id].getIR().replaceAll('"',"'")
    }

    /*
    input_file = input 태그 아이디
    preview = div 태그 아이디
    리턴값은 인풋파일태그 obj[file_key] 부분에 리턴값넣어주면 ajax 쪽에서 알아서 가공
    */
    hookFileEvent(input_file, preview = '') {
        // 파일 입력 요소와 미리보기 컨테이너 가져오기
        let fileInput = document.getElementById(input_file);
        if (!fileInput) {
            alert(input_file + "  태그를 찾을수 없습니다.");
            return false;
        }

        // 이미 이벤트가 등록되어 있는지 확인
        if (fileInput.hookInitialized) {
            // 기존의 파일 목록 반환
            return Array.from(fileInput.files);
        }

        let previewContainer = document.getElementById(preview);
        let selectedFiles = Array.from(fileInput.files);

        fileInput.hookInitialized = true;

        fileInput.addEventListener('change', function () {
            // 새로운 파일들을 기존 파일 목록에 추가
            selectedFiles = selectedFiles.concat(Array.from(fileInput.files));

            // 새로운 파일 목록으로 `fileInput` 업데이트
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(f => dataTransfer.items.add(f));
            fileInput.files = dataTransfer.files;

            if (previewContainer) {
                previewContainer.innerHTML = ''; // 이전 미리보기 삭제

                // 각 파일에 대해 미리보기 생성
                selectedFiles.forEach(file => {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const filePreview = document.createElement('div');
                        filePreview.classList.add('file-preview');

                        // 이미지 파일인지 확인
                        if (file.type.startsWith('image/')) {
                            // 이미지 파일일 경우 이미지 미리보기 생성
                            const imgElement = document.createElement('img');
                            imgElement.src = e.target.result;
                            imgElement.width = 50;
                            imgElement.height = 50;
                            filePreview.appendChild(imgElement);
                        } else {
                            // 이미지 파일이 아닐 경우 파일명 추가
                            const fileName = document.createElement('span');
                            fileName.textContent = file.name;
                            filePreview.appendChild(fileName);
                        }

                        // 삭제 버튼 생성
                        const deleteBtn = document.createElement('button');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.textContent = 'x';
                        deleteBtn.addEventListener('click', function () {
                            // 삭제 버튼 클릭 시 미리보기 제거
                            previewContainer.removeChild(filePreview);

                            // 삭제된 파일을 `selectedFiles`에서 제거
                            selectedFiles = selectedFiles.filter(f => f !== file);

                            // 새로운 파일 목록으로 `fileInput` 업데이트
                            const newDataTransfer = new DataTransfer();
                            selectedFiles.forEach(f => newDataTransfer.items.add(f));
                            fileInput.files = newDataTransfer.files;
                        });

                        filePreview.appendChild(deleteBtn);
                        previewContainer.appendChild(filePreview);
                    }

                    // 이미지 파일일 경우에만 readAsDataURL 호출
                    if (file.type.startsWith('image/')) {
                        reader.readAsDataURL(file);
                    } else {
                        // 이미지 파일이 아닌 경우 바로 처리
                        reader.onload();
                    }
                });
            }

        });

        return selectedFiles;
    }
}