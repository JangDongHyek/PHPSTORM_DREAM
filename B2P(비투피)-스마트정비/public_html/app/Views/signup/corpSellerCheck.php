<?php
    echo view('common/header_adm');
    $pid = "corpSellerCheck";
    $header_name = "사업자등록번호 확인";
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui/1.12.1/i18n/datepicker-ko.js"></script>

<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>사업자 등록 정보를 확인할게요</h1>
            <p>아래의 정보를 입력해주세요.</p>
        </div>
        <form class="form_wrap" id="company_form" name="company_form">

            <p class="tit">상호</p>
            <input type="text" class="border_gray" placeholder="상호를 입력해주세요."  id="company_name" name="company_name" value="<?=$company_name?>">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

            <p class="tit">사업자등록정보(고유번호)</p>
            <input type="number" class="border_gray" placeholder="사업자등록번호 -없이 10자리 입력해주세요." id="company_no" name="company_no" value="<?=$company_no?>">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

            <p class="tit">등록명의자/대표자</p>
            <input type="text" class="border_gray" placeholder="대표자 성함을 입력해주세요."  id="company_owner" name="company_owner" value="<?=$company_owner?>">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

            <p class="tit">개업일자</p>
            <input type="date" class="border_gray" placeholder="개업일자를 입력해주세요."  id="company_open" name="company_open" value="<?=$company_open?>">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            
            <p class="guide-text">사업자 정보 확인(인증)에 문제가 있는 경우,
사업자등록증 사본 파일을 첨부하고 연락처 적은 이메일을
NICE평가정보, biz_submit@nice.co.kr로 보내주세요.

사업자등록번호 도용하여 가입 시, 형사 처벌을 받을 수 있습니다.</p>
            <div id="chk_company" hidden></div>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            <!--<a class="btn btn-blue btn-comp" href="<?/*=base_url('/signup/selfCerti')*/?>">인증하기</a>-->
            <button type="button" onclick="chk_companyNo()" class="btn btn-blue btn-comp">인증하기</button>

        </form>
    </div>
</div>

<script>

    $(function() {
        $.datepicker.setDefaults($.datepicker.regional['ko']); // 한글 설정
        $("#company_open").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "-100:+10"
        });
    });

    let isAjaxIng = false;
    function chk_companyNo() {
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;
        $('.msg-text').hide();

        //삭제해야함
        if("<?=$pass?>" == "T"){
            location.href = "<?=base_url('signup/infoSale')?>";
        }


        let formData = new FormData($('#company_form')[0]);
        $.ajax({
            url: '<?= base_url("signup/chkCompanyNo")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    swal("인증되었습니다.").then(function () {
                        location.href = "<?=base_url('signup/infoSale')?>";
                    });
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
</script>


<?php echo view('common/footer'); ?>