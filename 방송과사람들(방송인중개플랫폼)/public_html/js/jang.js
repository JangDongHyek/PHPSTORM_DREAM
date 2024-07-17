// Vue 인스턴스 생성
Vue.data    = {};
Vue.methods = {};
Vue.watch   = {};
Vue.components = {};
Vue.computed = {};
Vue.created = [];
Vue.mounted = [];
document.addEventListener('DOMContentLoaded', function(){
    Vue.app = new Vue({
        el: "#app",
        data: Vue.data,
        methods: Vue.methods,
        watch: Vue.watch,
        components: Vue.components,
        computed: Vue.computed,
        created: function(){
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
}, false);

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
        url: url,
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