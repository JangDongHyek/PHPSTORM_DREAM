<?php 
    echo view('common/header_adm');
    $pid = "infoBasic";
    $header_name = "기본정보 입력";
?>

<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>기본정보를 입력해주세요</h1>
        </div>
        <form id="basic_form" name="basic_form" class="form_wrap">
<!--
            <p class="tit">상호</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?=$company_name?>' id="cp_name" name="cp_name" readonly>

            <p class="tit">사업자등록번호(고유번호)</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?=$company_no?>' id="cp_no" name="cp_no" readonly>

            <p class="tit">등록명의자/대표자</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?=$company_owner?>' id="cp_owner" name="cp_owner" readonly>
-->


            

            <p class="tit">ID</p>
            <div class="input_id">
                <input type="text" class="border_gray" placeholder="뛰어쓰기 없이 영문, 숫자" value='' id="mb_id" name="mb_id">
                <button type="button" class="btn btn-blue" onclick="chk_mbid()">중복확인</button>
            </div>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            
            <p class="tit">비밀번호</p>
            <input type="password" class="border_gray" placeholder="비밀번호를 입력해주세요." value='' id="mb_password" name="mb_password">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            
            <p class="tit">비밀번호 확인</p>
            <input type="password" class="border_gray" placeholder="비밀번호 확인" value='' id="mb_password2" name="mb_password2">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            
            <p class="tit">회사 이메일</p>
            <div class="input_mail">
                <input type="text" class="border_gray" placeholder="회사 이메일을 입력하세요" value='' id="cp_email" name="cp_email"> @
                <div class="input_select">

                    <select class="border_gray" id="select_cp_email_domain">
                        <?
                        for($i=0; $i<count($email_list); $i++) {?>
                            <option value="<?=$email_list[$i]?>" <?php echo get_selected($mb_email_domain, $email_list[$i] ); ?>><?=$email_list[$i]?></option>
                        <?}
                        ?>
                        <option value="">직접입력</option>
                    </select>
                    <input type="text" class="border_gray" placeholder="이메일 도메인을 입력하세요" id="cp_email_domain" name="cp_email_domain" style="display: none" value="naver.com">
                </div>
            </div>
            <p class="msg-text" style="display: none">msg</p>

            <p class="tit">회사 연락처 <span class="color-blue">(필수)</span></p>
            <input type="tel" class="border_gray" placeholder="휴대폰 또는 사무실번호" value='<?=$cp_hp?>' id="cp_hp" name="cp_hp">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            
            
            
            <h5 class="sub_tit">실무자(관리자) 정보입력</h5>
            <p class="tit">실무자(관리자) 성명 <span class="color-blue">(필수)</span></p>
            <input type="text" class="border_gray" placeholder="실무자 성명을 입력하세요" value='<?=$mb_name?>' id="mb_name" name="mb_name" readonly>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            
            <p class="tit">실무자(관리자) 이메일</p>
            <div class="input_mail">
                <input type="text" class="border_gray" placeholder="실무자 이메일을 입력하세요" value='' id="mb_email" name="mb_email"> @
                
                <div class="input_select">

                    <select class="border_gray" id="select_mb_email_domain">
                        <?
                        for($i=0; $i<count($email_list); $i++) {?>
                            <option value="<?=$email_list[$i]?>" <?php echo get_selected($cp_email_domain, $email_list[$i] ); ?>><?=$email_list[$i]?></option>
                        <?}
                        ?>
                        <option value="">직접입력</option>
                    </select>
                    <input type="text" class="border_gray" placeholder="이메일 도메인을 입력하세요" id="mb_email_domain" name="mb_email_domain" style="display: none" value="naver.com">
                </div>
            </div>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

            <p class="tit">실무자(관리자) 연락처 <span class="color-blue">(필수)</span></p>
            <input type="tel" class="border_gray" placeholder="휴대폰 또는 사무실번호" value='<?=$mb_hp?>' id="mb_hp" name="mb_hp" readonly>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

        </form>
           
         <button type="button" onclick="chk_basicForm()" class="btn btn-blue btn-comp" >다음단계로</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#mb_hp').phoneFormat();
        $('#cp_hp').phoneFormat();
    });

    let isAjaxIng = false;
    function chk_basicForm() {
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;

        $('.msg-text').hide();

        //삭제해야함
        if("<?=$pass?>" == "T"){
            location.href = "<?=base_url('signup/infoAccount')?>";
        }


        let formData = new FormData($('#basic_form')[0]);
        $.ajax({
            url: '<?= base_url("signup/chkBasicForm")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    location.href = "<?=base_url('signup/infoAccount')?>";
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

    function chk_mbid(){
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;

        $('.msg-text').hide();

        let formData = new FormData($('#basic_form')[0]);
        $.ajax({
            url: '<?= base_url("signup/chkDuplicateMbId")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    err_msg(data.err_id, data.msg, false);
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

    $('#select_cp_email_domain').on('change', function() {
        if ($(this).val() == '') {
            $("#select_cp_email_domain").hide();
            $("#cp_email_domain").val("");
            $("#cp_email_domain").show();
        } else {
            $("#cp_email_domain").val($("#select_cp_email_domain").val());
        }
    });

    $('#select_mb_email_domain').on('change', function() {
        if ($(this).val() == '') {
            $("#select_mb_email_domain").hide();
            $("#mb_email_domain").val("");
            $("#mb_email_domain").show();
        } else {
            $("#mb_email_domain").val($("#select_mb_email_domain").val());
        }
    });

</script>

<?php echo view('common/footer'); ?>
