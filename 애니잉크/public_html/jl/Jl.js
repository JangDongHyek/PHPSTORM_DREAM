function vueLoad(app_name) {
    Vue[app_name] = new Vue({
        el: "#" + app_name,
        data: Jl_data,
        methods: Jl_methods,
        watch: Jl_watch,
        components: Jl_components,
        computed: Jl_computed,
        created: function(){
            this.jl = new Jl(app_name,"#42B883");
        },
        mounted: function(){

        }
    });
}

Number.prototype.format = function (n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

class Jl {
    constructor(name = "Jl.js",background = "#35495e") {
        this.name = name;
        this.root = Jl_base_url;
        this.editor = Jl_editor;

        // 의존성주입 패턴
        if (typeof JlJavascript !== 'undefined') {
            this.js = new JlJavascript(this);
        }
        if (typeof JlVue !== 'undefined') {
            this.vue = new JlVue(this);
        }

        let textColor = "white"

        if(name == "Jl.js") {
            background = "#f0db4f"; // JavaScript 로고의 노란색
            textColor = "#323330"; // 어두운 색으로 글자 색상 지정
        }

        if(Jl_dev) {
            console.log(
                '%c' + name,
                `background: ${background}; color: ${textColor}; font-weight: bold; font-size: 14px; padding: 5px; border-radius: 3px;`
            );
        }

        // Proxy를 사용해  의존성으로 사용하고있는 함수 jl 인스턴스에서 불러오기
        return new Proxy(this, {
            get: (target, prop) => {
                if (prop in target) {
                    return target[prop];
                } else if (target.js && prop in target.js) {
                    return target.js[prop].bind(target.js);
                } else if (target.vue && prop in target.vue) {
                    return target.vue[prop].bind(target.vue);
                } else {
                    return undefined;
                }
            }
        });



    }

    INIT(object = {}) {
        this.js.JS_INIT(object);
    }

    ajax(method,obj,url,options = {}) {
        if(!obj) new Error("obj 가 존재하지않습니다.");

        return new Promise((resolve, reject) => {
            var object = this.copyObject(obj);

            if("required" in options) {
                for (let i = 0; i < options.required.length; i++) {
                    let req = options.required[i];
                    if(req.name == "") continue;

                    if(object[req.name].trim() == "") {
                        reject(new Error(req.message));
                        return false;
                    }
                }
            }

            var objects = {_method : method};
            objects = this.processObject(objects,object);

            //form 으로 데이터가공
            var form = new FormData();
            for (let i in objects) {
                let data = objects[i];
                if(Array.isArray(data)) {
                    data.forEach(file => {
                        form.append(i+"[]", file);

                    })
                }else {
                    form.append(i, objects[i]);

                }
            }

            // 통신부분
            var xhr = new XMLHttpRequest();
            xhr.open('POST', Jl_base_url + url, true);
            xhr.responseType = "download" in options ? 'blob' : "json";

            let res = null
            let jl = this;

            xhr.onload = function () {
                res = xhr.response;
                if (xhr.status === 200) {
                    if("download" in options && options.download) {
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(res);
                        link.download = options.download;  // 다운로드할 파일 이름 설정
                        link.click();

                        // 메모리 해제를 위해 URL 객체를 폐기
                        window.URL.revokeObjectURL(link.href);
                    }else {
                        if (!res.success) {
                            let message = res.message + "\n";

                            if(Jl_dev) {
                                if(res.file_0) {
                                    message += `${res.file_0} : ${res.line_0} Line\n`;
                                }
                                if(res.file_1) {
                                    message += `${res.file_1} : ${res.line_1} Line\n`;
                                }
                                if(res.file_2) {
                                    message += `${res.file_2} : ${res.line_2} Line\n`;
                                }
                            }
                            reject(new Error(message));
                        }
                    }
                    jl.log(res,function_name);
                    resolve(res);

                } else {
                    reject(new Error("xhr Status 200 아님"));
                    console.log(xhr.statusText);
                }
            };

            xhr.onerror = function () {
                reject(new Error("xhr on error 발생"));
            };

            xhr.send(form);

            // 로그 부분
            try {
                // IOS 같은경우 에러를 일으켜 함수명 추적이 불가능해 js 에러가 발생해 그뒤 로직이 꼬임 에러 발생시 문제없이 넘어가게 try catch 추가
                const parsedStack = this.parseStackTrace(new Error().stack);
                var function_name = parsedStack[1].function.replace('a.','');
            }catch (e) {
                var function_name = "IOS Error";
            }
        });
    }

    loadJS(path) {
        var scriptElement = document.createElement('script');
        scriptElement.src = this.root + path;

        scriptElement.onload = function() {
            jl.log(`${path} Script Load`,"","#66cdaa");
        };

        scriptElement.onerror = function() {
            jl.log(`${path} Script Error`,"","#66cdaa");
        };

        document.head.appendChild(scriptElement);
    }

    commonFile(files,obj,key,permission) {
        if(Array.isArray(obj[key])) {
            for (let i = 0; i < files.length; i++) {
                var file = files[i];
                if(!file.type) {
                    alert("파일 타입을 읽을수 없습니다.");
                    return false;
                }

                if(permission.length > 0 && !permission.includes(file.type)) {
                    alert("혀용되는 파일 형식이 아닙니다.");
                    return false;
                }

                if(file.type.startsWith('image/')) {
                    //이미지 미리보기 파일 데이터에 추가
                    const reader = new FileReader();
                    reader.onload = (function(f) {
                        return function(e) {
                            f.preview = e.target.result;
                            obj[key].push(f); // 비동기로 파일을 읽는 중이라 onload 안에 넣어줘야 파일을 다 읽고 데이터가 완벽하게 들어간다
                        };
                    })(file); // 클로저 사용
                    reader.readAsDataURL(file);
                }
            }


        }else {
            file = files[0]
            if (file) {
                if(!file.type) {
                    alert("파일 타입을 읽을수 없습니다.");
                    return false;
                }

                if(permission.length > 0 && !permission.includes(file.type)) {
                    alert("혀용되는 파일 형식이 아닙니다.");
                    return false;
                }

                if(file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (function(f) {
                        return function(e) {
                            f.preview = e.target.result;
                            obj[key] = (f); // 비동기로 파일을 읽는 중이라 onload 안에 넣어줘야 파일을 다 읽고 데이터가 완벽하게 들어간다
                        };
                    })(file); // 클로저 사용
                    reader.readAsDataURL(file);
                }

            } else {
                obj[key]  = '';
            }
        }
    }

    dropFile(event,obj,key,permission = []) {
        this.commonFile(event.dataTransfer.files,obj,key,permission);
        this.log(obj[key])
    }

    changeFile(event,obj,key,permission = []) {
        this.commonFile(event.target.files,obj,key,permission)
        this.log(obj[key])
    }

    /*
    밀리 세컨드 단위로 고유값을 만다는 함수 주문번호로도 사용가능하다
     */
    generateUniqueId(length = 15) {
        const timestamp = Date.now().toString(); // 현재 시간을 밀리초 단위로 문자열로 변환 * 13자
        const randomPart = Math.floor(Math.random() * 100).toString(); // 2자리 랜덤 숫자 생성
        return timestamp + randomPart; // 15자 (동일한 밀리세컨드안에 주문이 들어갈경우 중복될 확률 1퍼)
    }

    /*
    프로퍼티 값이 대문자인지 확인하는 함수
     */
    isUpperCase(str) {
        return str === str.toUpperCase();
    }

    // 반환값은 일치하는 객체를 반환 없을시 undefined
    findObject(arrays,key,value,like = false,index = false) {
        if(index) {
            if(like) {
                return arrays.findIndex(obj => obj[key].includes(value));
            }else {
                return arrays.findIndex(obj => obj[key] === value);
            }
        }else {
            if(like) {
                return arrays.find(obj => obj[key].includes(value));
            }else {
                return arrays.find(obj => obj[key] === value);
            }
        }
    }

    findsObject(arrays,key,value,like = false) {
        if(like) {
            return arrays.filter(obj => obj[key].includes(value));
        }else {
            return arrays.filter(obj => obj[key] === value);
        }
    }

    // ajax로 데이터 보내기전 가공
    processObject(objs,obj) {
        objs = this.copyObject(objs);
        obj = this.copyObject(obj);

        for (const key in obj) {
            if (obj.hasOwnProperty(key)) {
                if(key[0] == "$") delete obj[key]; //첫글자가 $일경우 조인데이터이기때문에 삭제
                const value = obj[key];
                if (value instanceof File) {
                    objs[key] = value;
                    delete obj[key];
                }else if(Array.isArray(value)) {
                    value.forEach(function(item) {
                        if(item instanceof File) {
                            objs[key] = value;
                            delete obj[key];
                        }
                    });
                }
            }
        }

        objs.obj = JSON.stringify(obj);
        return objs;
    }

    changeFile(event,obj,key) {
        const file = event.target.files[0];
        console.log(file)
        if (file) {
            obj[key] = file;
        } else {
            obj[key]  = '';
        }
    }

    copyObject(obj) {
        // 파일 객체는 복사하지 않고 그대로 반환
        if (obj instanceof File) {
            return obj;
        }

        // 배열일 경우
        if (Array.isArray(obj)) {
            return obj.map(item => this.copyObject(item));
        }

        // 객체일 경우
        if (obj !== null && typeof obj === 'object') {
            const copy = {};
            for (const key in obj) {
                if (obj.hasOwnProperty(key)) {
                    copy[key] = this.copyObject(obj[key]);
                }
            }
            return copy;
        }

        // 원시 타입일 경우 (숫자, 문자열, 불리언 등)
        return obj;
    }

    /*
    object 의 키값을 빈값으로 만들어 반환
     */
    initObject(obj) {
        var result = this.copyObject(obj)
        for (let key in result) {
            if (typeof result[key] === "number") {
                result[key] = 0;
            } else if(typeof result[key] === "object"){
                if(result[key] instanceof File) result[key] = "";
                else if(Array.isArray(result[key])) result[key] = [];
                else result[key] = {}
            } else {
                result[key] = "";
            }
        }
        return result;
    }

    // 프로퍼티 날짜타입의 데이터를 한글식 날로 변경
    dateToKorean(dateString,time = false) {
        if (!dateString || dateString === '0000-00-00' || dateString === '0000-00-00 00:00:00') {
            return '유효하지 않은 날짜';
        }

        const months = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
        const dateParts = dateString.split(/[- :]/);

        const year = dateParts[0];
        const month = months[parseInt(dateParts[1], 10) - 1];
        const day = dateParts[2].replace(/^0/, '');
        const hour = dateParts[3] ? dateParts[3].replace(/^0/, '') : null;
        const minute = dateParts[4] ? dateParts[4].replace(/^0/, '') : null;
        const second = dateParts[5] ? dateParts[5].replace(/^0/, '') : null;

        let formattedDate = `${year}년 ${month} ${day}일`;

        if (hour !== null && minute !== null && second !== null) {
            if(time) formattedDate += ` ${hour}시 ${minute}분 ${second}초`;

        }

        return formattedDate;
    }

    // 숫자와 문자가섞인 문자열데이터를 숫자만 가져오는 정규식
    getNumbersOnly(str) {
        return str.replace(/\D/g, '');
    }

    // 숫자를 원화 한글 발음으로 반환한다
    numberToKorean(num) {
        const units = ['', '십', '백', '천'];
        const bigUnits = ['', '만', '억', '조', '경'];
        const koreanNumbers = ['', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구'];

        if (num === 0) return '영원';

        let result = '';
        let bigUnitIndex = 0;

        while (num > 0) {
            let chunk = num % 10000;
            num = Math.floor(num / 10000);

            if (chunk > 0) {
                let chunkResult = '';
                for (let i = 0; chunk > 0; i++) {
                    const digit = chunk % 10;
                    chunk = Math.floor(chunk / 10);
                    if (digit > 0) {
                        chunkResult = (digit === 1 && i > 0 ? '' : koreanNumbers[digit]) + units[i] + chunkResult;
                    }
                }
                result = chunkResult + bigUnits[bigUnitIndex] + result;
            }
            bigUnitIndex++;
        }

        return result;
    }

    // 참조값이 숫자만으로 이러우져있는지 확인하는 함수
    isNumber(str) {
        return !/[^0-9]/.test(str);
    }

    //숫자 키입력만 허용하고 나머지는 안되게 onkeyup="jl.isNumberKey(event)" @keydown="jl.isNumberKey"
    isNumberKey(event) {
        const charCode = event.keyCode || event.which;
        // 숫자 키 코드 (0-9 및 숫자 키패드 0-9)와 백스페이스, Delete 키만 허용
        if (
            (charCode >= 48 && charCode <= 57) ||
            (charCode >= 96 && charCode <= 105) ||
            charCode === 8 ||
            charCode === 46
        ) {
            return true;
        }
        event.preventDefault(); // 숫자가 아닌 경우 입력 차단
        return false;
    }

    formatNumber(value,comma = false) {
        value = value.replace(/[^0-9]/g, '');

        if(comma) return isNaN(parseInt(value)) ? value : parseInt(value).format();

        return value;
    }

    formatPhone(value,hyphen = true) {
        var length = hyphen ? 13 : 11

        // 최대 길이를 13자로 제한
        if (value.length > length) {
            value = value.slice(0, length);
        }

        // 숫자만 남기기
        value = value.replace(/\D/g, '');

        // 포맷팅: XXX-XXXX-XXXX
        if (hyphen && value.length > 3 && value.length <= 7) {
            value = value.replace(/(\d{3})(\d+)/, '$1-$2');
        } else if (hyphen && value.length > 7) {
            value = value.replace(/(\d{3})(\d{4})(\d+)/, '$1-$2-$3');
        }


        // 입력값 업데이트
        return value;
    }

    log(obj,name="",background = "#35495e",color = "white") {
        if(!Jl_dev) return false;

        if(!name) {
            const parsedStack = this.parseStackTrace(new Error().stack);
            var function_name = parsedStack[1].function.replace('a.','');
        }else {
            function_name = name
        }

        console.group('%c' + function_name,
            `background: ${background}; color: ${color}; font-weight: bold; font-size: 12px; padding: 5px; border-radius: 1px; margin-left : 10px;`
        );
        console.log(obj);
        console.groupEnd();
    }

    // 에러를 일으켜 에러 추적하여 함수명 알아내는 함수
    parseStackTrace(stack) {
        const lines = stack.split('\n');
        const frames = lines.map(line => {
            const match = line.match(/at\s+(.+?)\s+\((.+):(\d+):(\d+)\)/);
            if (match) {
                return {
                    function: match[1],
                    file: match[2],
                    line: parseInt(match[3], 10),
                    column: parseInt(match[4], 10)
                };
            }
            return null;
        }).filter(frame => frame !== null);

        return frames;
    }
}