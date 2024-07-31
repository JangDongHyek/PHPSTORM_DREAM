
<?php 
    echo view('common/header_adm');
    $pid = "seller";
    $header_name = "가입유형";
?>

<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>B2P에 오신것을 환영해요</h1>
            <p>지금 회원 가입 하신 후 다양한 서비스를 만나보세요!</p>
        </div>
        <form action="" class="form_wrap" id="radi_seller_wrap">
<!--            <p class="tit">tit</p>-->
<!--
            <input type="radio" id="radi_seller01" name="radi_seller">
            <label for="radi_seller01" class="border_gray">
                <i class="fa-duotone fa-circle-check"></i> 개인 판매회원
            </label>
-->
            <input type="radio" id="radi_seller02" name="radi_seller" checked>
            <label for="radi_seller02" class="border_gray">
                <i class="fa-duotone fa-circle-check"></i> 사업자 판매회원
                <div class="guide-box">
                    <i class="fa-duotone fa-circle-exclamation"></i>
                    사업자 판매회원으로 가입하려면 사업자등록증이 필요합니다. 사본을 미리 준비해주세요.
                </div>
            </label>
<!--
            <input type="radio" id="radi_seller03" name="radi_seller">
            <label for="radi_seller03" class="border_gray">
                <i class="fa-duotone fa-circle-check"></i> 해외직구 판매회원
                <div class="guide-box">
                    <i class="fa-duotone fa-circle-exclamation"></i>
                    해외직구 판매회원으로 가입하려면 사업자등록증이 필요합니다. 사본을 미리 준비해주세요.
                </div>
            </label>
-->
            
<!--
            <p class="tit">tit</p>
            <input type="text" class="border_gray" placeholder="입력하세요">
-->
            
            <a class="btn btn-blue btn-comp" href="<?=base_url('/signup/corpSellerCheck')?>">다음</a>
        </form>
    </div>
</div>


<?php echo view('common/footer'); ?>