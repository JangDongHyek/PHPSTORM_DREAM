// Vue 인스턴스 생성
Vue.data    = {};
Vue.methods = {};
Vue.watch   = {};
Vue.components = {};
Vue.computed = {};
Vue.created = [];
Vue.mounted = [];

function consoleLog(obj) {
    console.group('User Information');
    console.log(obj);
    console.trace();
    console.groupEnd();
}

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
    //if(url.indexOf(".php") == -1) url = url + ".php";
    for (var i in objs) {
        form.append(i, objs[i]);
    }

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

                if (res.data) {
                    var obj = res.data;
                    for (field in obj) {
                        if (field.indexOf("_id") !== -1) continue;
                        try {
                            obj[field] = JSON.parse(obj[field]);
                        } catch (e) {

                        }
                    }
                    res.data = obj;
                }
            }
        }
    });

    return result;
}

class JL {
    constructor(name,background = "#35495e") {
        this.name = name;

        if(!JL_dev) return false;
        console.log(
            '%c' + name,
            `background: ${background}; color: white; font-weight: bold; font-size: 14px; padding: 5px; border-radius: 3px;`
        );
    }

    log(obj) {
        if(!JL_dev) return false;
        const parsedStack = this.parseStackTrace(new Error().stack);
        var function_name = parsedStack[1].function.replace('a.','');
        console.group('%c' + function_name,
            `background: #627BF9; color: white; font-weight: bold; font-size: 12px; padding: 5px; border-radius: 1px; margin-left : 10px;`
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