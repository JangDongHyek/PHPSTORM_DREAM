<?php $jl->jsLoad()?>

<script>
    const jl = new Jl();

    async function getUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("form_id");

        try {
            if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")

            let res = await jl.ajax("get",obj,"/api/user");
            this.data = res.data[0]
        }catch (e) {
            alert(e.message)
        }
    }
</script>