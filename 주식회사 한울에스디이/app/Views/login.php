<?php
//$session = session();
//$user = $session->get("user");
//var_dump($user);
?>

<div class="wrap_bg">
    <div class="mb_wrap login box-white">
        <div class="logo">
            <h1><img src="<?=base_url()?>/img/common/logo_v.svg" alt="엔알글로벌"/></h1>
        </div>
        <div class="login_form">
                <form name="signin" id="login_form" method="post" autocomplete="off">
                    <label for="">아이디</label>
                    <input type="text" name="id" id="user_id" placeholder="아이디"/>
                    <label for="">비밀번호</label>
                    <input type="password" name="password" id="user_pw" placeholder="비밀번호" onkeydown="if(event.key == 'Enter')getUser()"/>
                    <button type="button" class="btn btn-large btn-darkblue" onclick="getUser()">로그인</button>
                </form>
                <a href="./signUp" class="btn btn-wide btn-gray">서비스 가입</a>
                <a href="./findPw" class="btn btn-wide btn-line">아이디/비밀번호 찾기</a>
            </div>
        <div class="login_ft">
            <p class="ft_copy">Copyright 2024. NRSYSTEM. All rights reserved.</p>
        </div>
    </div>
</div>

<?php $jl->jsLoad()?>

<script>
    async function getUser() {
        let obj = jl.js.getInputById(['user_id','user_pw']);
        //let obj = jl.js.getFormById("form_id");

        try {
            if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")
            if(obj.user_pw == "") throw new Error("비밀번호를 입력해주세요.")

            let res = await jl.ajax("login",obj,"/api/user");

            if(res.admin) window.location.href = jl.root + "adm";
            else window.location.href = jl.root + "app"

        }catch (e) {
            alert(e.message)
        }
    }

    <?php if (session()->getFlashdata('swal_warning')) : ?>
    Swal.fire({
        icon: 'warning',
        title: '알림',
        text: '<?= session()->getFlashdata('swal_warning') ?>',
        confirmButtonText: '확인'
    });
    <?php endif; ?>
</script>
