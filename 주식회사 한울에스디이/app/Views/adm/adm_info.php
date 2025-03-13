<!--관리자정보-->
</div>

<section class="">
    <button type="button" class="btn btn-blue" onclick="updateUser()">정보 변경</button>
    <div class="box-gray">
        <div class="form_wrap" id="admin_form">
            <input type="hidden" id="idx" value="<?=$admin['idx']?>">
            <div>
                <label for="">아이디</label>
                <input type="text" name="" id="user_id" value="<?=$admin['user_id']?>" placeholder="아이디" disabled/>
                <label for="">비밀번호</label>
                <input type="password" name="" id="change_user_pw" placeholder="비밀번호" required="비밀번호를 입력해주세요."/>
                <label for="">비밀번호 확인</label>
                <input type="password" name="" id="change_user_pw_re" placeholder="비밀번호 확인"/>
            </div>
        </div>
    </div>
</section>

<?php $jl->jsLoad(); ?>

<script>
    async function updateUser() {
        let obj = jl.js.getFormById("admin_form");
        let required = jl.js.getFormRequired("admin_form")
        let options = {required : required};

        try {
            if(!obj.idx) throw new Error("잘못된 접근입니다.");
            if(obj.change_user_pw != obj.change_user_pw_re) throw new Error("비밀번호와 확인 비밀번호가 다릅니다..")

            let res = await jl.ajax("update",obj,"/api/user",options);
            alert("변경되었습니다.")
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>