<?php $jl->jsLoad()?>

<script>
    async function postData() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("form_id");
        //let obj = jl.js.getUrlParams();

        let required = jl.js.getFormRequired("board_form")
        let options = {required : required};

        try {
            //if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")

            let res = await jl.ajax("get",obj,"/api/user",options);
            this.data = res.data[0]
        }catch (e) {
            alert(e.message)
        }
    }

    async function getUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        //let obj = jl.js.getFormById("form_id");
        let obj = jl.js.getUrlParams();

        try {
            let res = await jl.ajax("get",obj,"/api/user");
            this.data = res.data[0]
        }catch (e) {
            alert(e.message)
        }
    }

    async function deleteData(idx) {
        if(!idx) return false;

        if(!confirm("정말 삭제하시겠습니까?")) return false;

        let obj = {idx : idx}

        try {
            let res = await jl.ajax("delete",obj,"/api/exam");
            alert("삭제되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>