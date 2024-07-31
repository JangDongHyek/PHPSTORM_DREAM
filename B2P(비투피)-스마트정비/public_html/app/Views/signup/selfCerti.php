<?php 
    echo view('common/header_adm');
    $pid = "selfCerti";
    $header_name = "휴대폰 본인인증";
?>

<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>실무자 휴대폰 본인인증을 진행해주세요</h1>
            <p>사업자등록정보 인증이 완료되었어요<br>실무자 휴대폰 본인인증을 진행해주세요</p>
        </div>
        <form id="company_form" name="company_form" class="form_wrap">
<!--            <p class="tit">상호</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?/*=$company_name*/?>' disabled>-->
            <!--            <p class="msg-text">msg</p>-->

<!--            <p class="tit">사업자등록번호(고유번호)</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?/*=$company_no*/?>' disabled>-->
            <!--            <p class="msg-text">msg</p>-->

<!--            <p class="tit">등록명의자/대표자</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?/*=$company_owner*/?>' disabled>-->
            <!--            <p class="msg-text">msg</p>-->

            <!--<p class="tit">휴대폰번호</p>
            <input type="tel" class="border_gray" placeholder="대표자 휴대폰번호를 입력해주세요" id="compnay_hp" name="compnay_hp">
            -->
            <button type="button" onclick="chkAuth()" class="btn btn-blue btn-certi">인증요청</button>

<!--            <p class="tit">휴대폰 인증</p>
            <p class="guide-text">나이스평가정보에서 인증받은 휴대전화번호를 사용하고 있습니다.</p>
            <div class="input_certi">
                <input type="text" class="border_gray" placeholder="대표자 휴대폰번호를 입력해주세요" id="compnay_hp" name="company_name" value=''>
                <button class="btn btn-blue btn-certi">인증요청</button>
            </div>
            <p class="msg-text comp">인증번호가 전송되었습니다.(유효시간:05:00)</p>
            <div class="input_certi">
                <input type="text" class="border_gray" placeholder="인증번호 입력" id="certi_num" name="certi_num" value=''>
                <button class="btn btn-gray btn-certi">인증확인</button>
            </div>-->
<!--            실패시-->
            <!--<p class="msg-text">인증번호를 다시 확인해주세요.</p>-->
            
<!--            완료시-->
<!--            <p class="msg-text comp">본인인증이 완료되었습니다.</p>-->
        </form>
        
        
<!--
        <form action="" class="form_wrap">
                        
            <p class="tit">기존 G마켓 ID</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='dreamfor***' disabled>
        </form>
        <form action="" class="form_wrap wh-box" id="check_service">
            <p class="tit">
                <strong>가입하실 서비스를 골라주세요</strong>
            </p>
            <input type="checkbox" id="ch_gmarket">
            <label for="ch_gmarket">
                <div>
                    <span class="ic"></span>
                    G마켓
                </div>
                <p class="text-sm color-gray">가입됨</p>
            </label>


            <input type="checkbox" id="ch_action">
            <label for="ch_action">
                <div>
                    <span class="ic"></span>
                    옥션
                </div>
                <p class="text-lg color-gray"><i class="fa-duotone fa-square-check"></i></p>
            </label>


            <div class="guide-box">
                    <span class="color-blue"><i class="fa-regular fa-check"></i> 필수</span>
                     <span class="color-black">
                         ESM PLUS 마스터 ID 연동 동의
                     </span>
            </div>
        </form>
-->

           <!-- <button class="btn btn-blue btn-comp" onclick="chk_companyHp()">다음단계로</button>-->
    </div>
</div>

<script>

    let isAjaxIng = false;

    function chkAuth() {

        location.href = "<?=base_url('auth/psAuth')?>?auth_type=sign";
    }

    function chk_companyHp() {
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;

        let compnay_hp = $("#compnay_hp").val();

        //삭제해야함
        if("<?=$pass?>" == "T"){
            location.href = "<?=base_url('signup/regiAgr')?>";
        }

        if(compnay_hp == ""){
            swal('올바른 휴대폰 번호를 입력해주세요.');
            isAjaxIng = true;
        }


    }
    
</script>

<?php echo view('common/footer'); ?>
