// vue3 최신버전
function vue3Load(app_name) {
    if (Jl_vue.some(item => item.app_name == app_name)) {
        alert("중복되는 앱이 있습니다.")
        return false;
    }

    const app = Vue.createApp({
        data() {
            return Jl_data;
        },
        methods: Jl_methods,
        computed: Jl_computed,
        watch: Jl_watch,
        components: {},
        created() {
            this.jl = new Jl(app_name, "#42B883");
        },
        mounted() {

        }
    });

    for (const component of Jl_components) {
        app.component(component.name,component.object)
    }

    app.mount(`#${app_name}`); // 특정 DOM에 마운트
    Jl_vue.push({ app_name, app }); // 배열에 앱 인스턴스 저장
}
//vue2 구버전
function vue2Load(app_name) {
    Vue[app_name] = new Vue({
        el: "#" + app_name,
        data: Jl_data,
        methods: Jl_methods,
        watch: Jl_watch,
        components: {},
        computed: Jl_computed,
        created: function(){
            this.jl = new Jl(app_name,"#42B883");
        },
        mounted: function(){

        }
    });
}

class JlVue {
    constructor(jl) {
        this.jl = jl;
    }
}