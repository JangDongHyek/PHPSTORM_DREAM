<?php 
    echo view('common/header_adm');
    $pid = "signComp";
    $header_name = "가입완료";
?>

<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>판매자님<br>환영합니다!</h1>
            <p>가입이 완료되었습니다!<br>셀러 가입 최종 확정은 심사 확인 후 메일로 안내하겠습니다.</p>
        </div>


        <a class="btn btn-blue btn-comp" href="<?=base_url('/common/login')?>">로그인하기</a>
    </div>
</div>




<?php echo view('common/footer'); ?>
