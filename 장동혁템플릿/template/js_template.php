<?php $jl->jsLoad()?>

<script>
    async function getUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        //let obj = jl.js.getFormById("form_id");
        let obj = jl.js.getUrlParams();

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
</script>