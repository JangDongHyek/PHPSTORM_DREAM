<?php 
    echo view('common/header_adm');
    $pid = "infoSale";
    $header_name = "정산정보";
?>

<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>정산정보를 입력해주세요</h1>
            <p class="tit">※ 법인 계좌만 인증 가능합니다.</p>
        </div>
        <form action="" class="form_wrap" id="account_form" name="account_form">

            <p class="tit">예금주명</p>
            <input type="text" class="border_gray" placeholder="예금주명을 입력해주세요." value='' id="bank_owner" name="bank_owner">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

            <p class="tit">계좌번호</p>
            <input type="number" class="border_gray" placeholder="계좌번호를 입력해주세요." value='' id="bank_num" name="bank_num">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

            <p class="tit">은행</p>
            <select id="bank_code" name="bank_code" class="border_gray">
                <option value="" selected>은행을 선택하세요</option>
                <?

                    for($i=0; $i<count($bank_list); $i++){
                        $bank = $bank_list[$i];
                        ?>
                        <option value="<?=$bank['code']?>"><?=$bank['name']?></option>
                    <?}
                ?>
            </select>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            
            <p class="tit">사업자등록번호</p>
            <input type="number" class="border_gray" placeholder="사업자등록번호를 입력해주세요." value='<?=$company_no?>' disabled>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

            <a id="result" class="btn btn-blueline btn-modal" onclick="chk_bankAccount()">
                계좌인증하기
                <i class="fa-light fa-angle-right"></i>
            </a>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
<!--
            <p class="tit">정산방법</p>
            
            <div class="form_wrap wh-box" id="radi_infoSale">
                <input type="radio" id="radi_infoSale01" name="radi_infoSale">
                <label for="radi_infoSale01" class="">
                    <div><i class="fa-duotone fa-circle-check"></i> 계좌로 송금받기</div>
                    <p class="text-sm color-gray">계좌를 등록해주세요</p>
                </label>
                
                <input type="radio" id="radi_infoSale02" name="radi_infoSale">
                <label for="radi_infoSale02" class="">
                    <div><i class="fa-duotone fa-circle-check"></i> 판매예치금으로 적립하기</div>
                </label>
            </div>
            

            <p class="tit">G통장 비밀번호</p>
            <input type="text" class="border_gray" placeholder="뛰어쓰기 없이 영문, 숫자, 특수문자 조합 8-15자" value=''>
            
            <p class="tit">비밀번호 확인</p>
            <input type="text" class="border_gray" placeholder="비밀번호 확인" value=''>
-->


        </form>


        <!--<button type="button" onclick="chk_accountForm()" class="btn btn-blue btn-comp">가입하기</button>-->
    </div>
</div>

<script>
    let isAjaxIng = false;

    function chk_bankAccount() {
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;
        $('.msg-text').hide();

        let formData = new FormData($('#account_form')[0]);
        $.ajax({
            url: '<?= base_url("auth/chkBankAccount")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    isAjaxIng = false;
                    chk_accountForm();
                } else {
                    err_msg(data.err_id, data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
            }
        });
    }

    function chk_accountForm() {
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;
        $('.msg-text').hide();

        let formData = new FormData($('#account_form')[0]);
        $.ajax({
            url: '<?= base_url("signup/chkAccountForm")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    isAjaxIng = false;
                    register_member();
                } else {
                    err_msg(data.err_id, data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
            }
        });
    }

    function register_member() {
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;
        $('.msg-text').hide();

        let formData = new FormData($('#account_form')[0]);
        $.ajax({
            url: '<?= base_url("signup/registerMember")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    location.href = "<?=base_url('signup/signComp')?>";
                } else {
                    swal(data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
            }
        });


    }
</script>


<?php echo view('common/footer'); ?>
