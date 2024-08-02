// Vue 인스턴스 생성
Vue.data    = {test : JL_base_url};
Vue.methods = {};
Vue.watch   = {};
Vue.components = {};
Vue.computed = {};
Vue.created = [];
Vue.mounted = [];

function vueLoad(app_name) {
    Vue[app_name] = new Vue({
        el: "#" + app_name,
        data: Vue.data,
        methods: Vue.methods,
        watch: Vue.watch,
        components: Vue.components,
        computed: Vue.computed,
        created: function(){
            if(!JL_dev) return false;
            this.jl = new JL(app_name,"#42B883");
            for(var i=0; i<Vue.created.length; i++){
                Vue.created[i](this);
            }
        },
        mounted: function(){
            for(var i=0; i<Vue.mounted.length; i++){
                Vue.mounted[i](this);
            }
        }
    });
}

Number.prototype.format = function (n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

function ajax(url,objs) {

    var form = new FormData();

    for (var i in objs) {
        var obj = objs[i];
        if(Array.isArray(obj)) {
            obj.forEach(file => {
                form.append(i+"[]", file);

            })
        }else {
            form.append(i, objs[i]);

        }
    }

    // 폼데이터 로그
    // for (var pair of form.entries()) {
    //     console.log(pair[0] + ': ' + pair[1]);
    // }

    var result = null;
    $.ajax({
        url: JL_base_url + url,
        method: "post",
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        async: false,
        cache: false,
        data: form,
        dataType: "json",
        success: function (res) {
            if (!res.success) alert(res.message);
            else {
                result = res;
                try {

                    // 가져온 데이터 JSON.parse 가능하면 가공 안하면 업데이트나 할때 오류남
                    if (res.response.data.length > 0) {
                        for (let i = 0; i < res.response.data.length; i++) {
                            var obj = res.response.data[i];
                            for (field in obj) {
                                if (field.indexOf("_id") !== -1) continue;
                                try {
                                    obj[field] = JSON.parse(obj[field]);
                                } catch (e) {

                                }
                            }
                            res.response.data[i] = obj;
                        }

                    }
                }catch(ee) {

                }
            }
        }
    });

    return result;
}

class JL {
    constructor(name,background = "#35495e") {
        this.name = name;
        this.root = JL_base_url
        if(!JL_dev) return false;
        console.log(
            '%c' + name,
            `background: ${background}; color: white; font-weight: bold; font-size: 14px; padding: 5px; border-radius: 3px;`
        );
    }

    ajax(method,obj,url) {
        var object = this.copyObject(obj);

        var objects = {_method : method};
        objects = this.processObject(objects,object);

        var res = ajax(url, objects);

        const parsedStack = this.parseStackTrace(new Error().stack);
        var function_name = parsedStack[1].function.replace('a.','');

        this.log(res,function_name);

        return res
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

    processObject(objs,obj) {
        objs = this.copyObject(objs);
        obj = this.copyObject(obj);

        for (const key in obj) {
            if (obj.hasOwnProperty(key)) {
                const value = obj[key];
                if (value instanceof File) {
                    objs[key] = value;
                    delete obj[key];
                }else if(Array.isArray(value)) {
                    value.forEach(function(item) {
                        if(item instanceof File) {
                            objs[key] = obj[key]
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
        if(!JL_dev) return false;

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