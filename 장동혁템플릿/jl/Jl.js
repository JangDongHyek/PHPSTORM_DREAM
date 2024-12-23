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

                    if(typeof object[req.name] === "string") {
                        if(object[req.name].trim() == "") {
                            reject(new Error(req.message));
                            return false;
                        }
                    }

                    if(typeof object[req.name] === "number") {

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

    // vue에서 파일업로드시 지정된 오브젝트 key에 파일 데이터 반환해주는 함수
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
    매개변수 값이 대문자인지 확인하는 함수
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

    // 매개변수 날짜타입의 데이터를 한글식 날로 변경
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

    // 문자형식의 날짜를 매개변수 로 삽입시 년월 몇번째주 인지 반환하는함수
    dateToWeekly(dateString) {
        // 입력받은 문자열을 Date 객체로 변환
        const date = new Date(dateString);
        if (isNaN(date)) {
            return '유효하지 않은 날짜';
        }

        const year = date.getFullYear(); // 연도
        const month = date.getMonth() + 1; // 월 (0부터 시작하므로 +1)
        const day = date.getDate(); // 날짜 (1일부터 시작)

        // 해당 월의 첫 번째 날과 첫째 날의 요일 (0: 일요일, ..., 6: 토요일)
        const firstDayOfMonth = new Date(year, date.getMonth(), 1);
        const firstDayWeekday = firstDayOfMonth.getDay(); // 요일 (0 ~ 6)

        // 첫 주가 시작되는 기준: 첫째 날의 요일을 보정하여 주 계산 시작
        const adjustedDay = day + firstDayWeekday - 1; // 요일 보정
        const week = Math.ceil(adjustedDay / 7); // 주 계산

        return `${year}년 ${month}월 ${week}번째 주`;
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

    //Objects 들중 매개변수에 넣은 키값에 해당하는 값들을 배열로 반환하는 함수
    getObjectsToKey(array, key) {
        // 결과 값을 저장할 배열
        const result = [];

        // 배열 순회
        array.forEach(obj => {
            // 객체에 키가 존재하면 값 추가
            if (obj.hasOwnProperty(key)) {
                result.push(obj[key]);
            }
        });

        // 값이 담긴 배열 반환
        return result;
    }

    // 참조값이 숫자만으로 이러우져있는지 확인하는 함수
    isNumber(str) {
        return !/[^0-9]/.test(str);
    }

    //숫자 키입력만 허용하고 나머지는 안되게 onkeyup="jl.isNumberKey(event)" @keydown="jl.isNumberKey" 아래 형제함수도 추가해줘야함
    isNumberKey(event) {
        const charCode = event.keyCode || event.which;
        // 숫자 키(0-9), 백스페이스, Delete, 화살표 키만 허용
        if (
            (charCode >= 48 && charCode <= 57) || // 상단 숫자 키
            (charCode >= 96 && charCode <= 105) || // 숫자 키패드
            charCode === 8 || // 백스페이스
            charCode === 46 || // Delete
            (charCode >= 37 && charCode <= 40) // 화살표 키
        ) {
            return true; // 입력 허용
        }
        event.preventDefault(); // 입력 차단
        return false;
    }

    // 매개변수인 url 값이 정규식에 해당하는 유튜브 링크이면 영상의 키값을 추출하는 함수
    extractYoutube(url) {
        const regex = /(?:https?:\/\/(?:www\.)?(?:youtube\.com\/.*[?&]v=|youtu\.be\/))([^&?]+)/;
        const match = url.match(regex);
        return match ? match[1] : null; // Video ID가 있으면 반환, 없으면 null 반환
    }


    // 위에 isNumberKey 함수랑 셋트인녀석 한글은 js에서 막을수가없어서 값에서 제거해줘야함 @input="jl.isNumberKeyInput"
    isNumberKeyInput(event) {
        const sanitizedValue = event.target.value.replace(/[^0-9]/g, '');
        event.target.value = sanitizedValue;

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

        console.group(
            `%c${function_name} %c(${this.name})`,
            `background: ${background}; color: ${color}; font-weight: bold; font-size: 12px; padding: 5px; border-radius: 1px; margin-left : 10px;`,
            'color: gray; font-size: 12px; margin-left: 5px;'
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