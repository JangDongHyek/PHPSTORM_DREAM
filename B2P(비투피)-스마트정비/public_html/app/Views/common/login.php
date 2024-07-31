<?php
    echo view('common/header_adm');

    // 로그인 실패시 알람
    if(session()->getFlashdata('msg')){
        alert(session()->getFlashdata('msg'));
    }
?>




<div id="login">
    <div class="box">
        <div class="tit_wrap">
            <img src="/img/common/logo.png" alt="">
            <h1>로그인</h1>
        </div>
        <form id="login_form" action="<?= base_url('common/login/authenticate'); ?>" onsubmit="return login_check();" method="post">
            <?= csrf_field() ?>
            <div class="form_wrap">
                <p class="tit">아이디</p>
                <input type="text" class="border_gray" placeholder='아이디' id="mb_id" name="mb_id" required>

                <p class="tit">비밀번호</p>
                <input type="password" class="border_gray" placeholder='비밀번호' id="mb_password" name="mb_password" required>

                <button type="submit" class="btn border_blue">로그인</button>
                
            </div>
        </form>
        <a href="<?=base_url('/signup/seller')?>" class="btn btn-blue">회원가입</a>

    </div>
</div>

<script>
    function login_check() {
        let mb_id = $("#mb_id").val().trim();
        let mb_password = $("#mb_password").val().trim();

        if(mb_id == "" || mb_id.length == 0){
            Swal.fire({
                text: "아이디를 확인해주세요.",
            });
            return false;
        }

        if(mb_password == "" || mb_password.length == 0){
            Swal.fire({
                text: "비밀번호를 확인해주세요.",
            });
            return false;
        }
        return true;
    }
</script>

<?php echo view('common/footer'); ?>