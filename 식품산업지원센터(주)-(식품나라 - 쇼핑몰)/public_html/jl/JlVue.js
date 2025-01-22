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


    download(data) {
        if(!data.src) {
            alert("다운로드의 참조 데이터가 잘못됐습니다.");
            return false;
        }
        // 동적으로 a 태그 생성
        const link = document.createElement('a');
        link.href = this.jl.root + data.src;
        link.download = data.name; // 다운로드할 파일 이름 설정
        link.style.display = 'none';

        document.body.appendChild(link);
        link.click(); // 클릭 이벤트로 다운로드 트리거
        document.body.removeChild(link); // DOM에서 제거
    }

    href(url) {
        window.location.href = url;
    }
    open(url) {
        window.open(url);
    }

    async postData(data,required = [],callback = null) {
        let options = {required : required};
        let method = data.primary ? 'update' : 'insert';

        try {
            if(!data.table) throw new Error("테이블값이 존재하지않습니다.");

            let res = await this.jl.ajax(method, data, "/jl/JlApi.php",options);

            if(callback) {
                await callback(res)
            }else {
                await this.jl.alert("완료되었습니다.");
                window.location.reload();
            }
        } catch (e) {
            await this.jl.alert(e.message)
        }

    }

    async getData(filter,callback = null) {
        try {
            if(!filter.table) throw new Error("테이블값이 존재하지않습니다.");

            let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");

            if(callback) {
                await callback(res)
            }else {
                return res.data[0];
            }
            this.data = res.data[0]
        } catch (e) {
            await this.jl.alert(e.message)
        }
    }

    async getsData(filter,callback = null) {
        try {
            if(!filter.table) throw new Error("테이블값이 존재하지않습니다.");

            let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");

            if(callback) {
                await callback(res)
            }else {
                filter.count = res.count;
                return res.data
            }
        } catch (e) {
            await this.jl.alert(e.message)
        }
    }

    async deleteData(data,callback) {
        if(! await this.jl.confirm("정말 삭제하시겠습니까?")) return false;

        try {
            if(!filter.table) throw new Error("테이블값이 존재하지않습니다.");
            let res = await this.jl.ajax("delete",data,"/jl/JlApi.php");

            if(callback) {
                await callback(res)
            }else {
                await this.jl.alert("완료되었습니다.");
                window.location.reload();
            }
        }catch (e) {
            alert(e.message)
        }
    }
}