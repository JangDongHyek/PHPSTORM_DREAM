<?php

$member = session()->get('member') ?? [];

?>
<section class="mypage">
    <form name="mypage" autocomplete="off">
        <input type="hidden" name="mb_level" value="<?=$member['mb_level']?>">
        <input type="hidden" name="idx" value="<?=$member['idx']?>">
        <div class="sign_form">
            <div class="text-right">
                <button class="btn btn_line" id="secession">회원탈퇴</button>
            </div>
            <?php if ($member['mb_level'] === '2'):?>
                <!--일반회원-->
                <div class="box_gray" id="generalMemberForm">
                    <div class="grid grid2">
                        <dl class="form_wrap">
                            <dt><label for="mb_id">아이디</label></dt>
                            <dd><input type="text" name="mb_id" id="mb_id" value="<?=$member['mb_id']?>" placeholder="아이디" readonly/></dd>
                            <dt><label for="mb_password">비밀번호</label></dt>
                            <dd><input type="password" name="mb_password" id="mb_password" placeholder="비밀번호"/></dd>
                            <dt><label for="password_confirm">비밀번호 확인</label></dt>
                            <dd><input type="password" name="password_confirm" id="password_confirm" placeholder="비밀번호 확인"/></dd>
                        </dl>
                        <dl class="form_wrap">
                            <dt><label for="mb_name">이름</label></dt>
                            <dd><input type="text" name="mb_name" id="mb_name" value="<?=$member['mb_name']?>" placeholder="이름"/></dd>
                            <dt><label for="mb_hp">연락처</label></dt>
                            <dd><input type="text" name="mb_hp" id="mb_hp" value="<?=$member['mb_hp']?>" placeholder="연락처"/></dd>
                        </dl>
                    </div>
                </div>
            <?php else:?>
                <!--사업자회원-->
                <div class="box_gray" id="businessMemberForm" >
                    <div class="grid grid2">
                        <dl class="form_wrap">
                            <dt><label for="company_name">회사명</label></dt>
                            <dd><input type="text" name="company_name" id="company_name" value="<?=$member['company_name']?>" placeholder="회사명"/></dd>
                            <dt><label for="mb_id">아이디</label></dt>
                            <dd><input type="text" name="mb_id" id="mb_id" value="<?=$member['mb_id']?>" placeholder="아이디" readonly/></dd>
                            <dt><label for="mb_password">비밀번호</label></dt>
                            <dd><input type="password" name="mb_password" id="mb_password" placeholder="비밀번호"/></dd>
                            <dt><label for="password_confirm">비밀번호 확인</label></dt>
                            <dd><input type="password" name="password_confirm" id="password_confirm" placeholder="비밀번호 확인"/></dd>
                        </dl>
                        <dl class="form_wrap">
                            <dt><label for="mb_name">대표자명</label></dt>
                            <dd><input type="text" name="mb_name" id="mb_name" value="<?=$member['mb_name']?>" placeholder="대표자명"/></dd>
                            <dt><label for="biz_no">사업자등록번호</label></dt>
                            <dd><input type="text" name="biz_no" id="biz_no" value="<?=$member['biz_no']?>" placeholder="사업자등록번호" data-format="business"/></dd>
                            <!--<dt><label for="contactPerson">담당자</label></dt>
                            <dd><input type="text" name="contactPerson" id="contactPerson"  placeholder="담당자"/></dd>-->
                            <dt><label for="mb_hp">담당자 연락처</label></dt>
                            <dd><input type="text" name="mb_hp" id="mb_hp" value="<?=$member['mb_hp']?>" placeholder="담당자 연락처"/></dd>
                            <dt><label>등록된 카드정보</label></dt>
                            <dd class="card_info">
                                <!--<p>등록된 카드정보가 없습니다.</p>-->
                                <?php if (empty($cardData)):?>
                                    <p class="flex ai-c"><button type="button" class="btn btn_mini btn_black" data-toggle="modal" data-target="#paymentModal">카드정보 등록</button>&nbsp;&nbsp;<span>등록된 카드정보가 없습니다.</span></p>
                                <?php else:?>
                                    <strong><span class="icon icon_gray">신용</span> <?=CARD_COMPANIES[$cardData['card_code']?? 0]?>(<?=mask_card_number($cardData['card_num'])?>)</strong>
                                <?php endif;?>
                            </dd>
                        </dl>
                    </div>
                </div>
            <?php endif;?>
            <br>
            <button type="submit" class="btn btn_large btn_color">정보 수정</button>
        </div>
    </form>

</section>
<?php include_once APPPATH."Views/modal/app/pay_ment_modal.php" ?>
<script src="<?= base_url()?>js/app/mypage.js?<?=JS_VER?>"></script>
<script src="<?= base_url()?>js/common/user_validator.js?<?=JS_VER?>"></script>
<script>
    const form = document.forms['mypage'];

    form.addEventListener('submit',handleMyup);

    function handleMyup(e){
        e.preventDefault();

        const formCheck = checkFormData();
        if (!formCheck) return false;

        const formData = new FormData(form);
        utils.showLoading(true);

        setTimeout(async () => {
            const response = await API.fetchData('/api/signUpload', formData);
            console.log(response)
            if (response.result) {
                utils.showAlert('수정이 완료되었어요', () => {
                    location.reload();
                });
            } else {
                let message = '수정에 실패했어요';
                message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                utils.showAlert(message);
            }
        }, 800);

    }

    function checkFormData(){
        const level = form.mb_level.value;

        if(level === '5'){
            const company = form.company_name.value;
            if(!company){
                utils.showToast('회사명을 입력해 주세요.');
                return false;
            }

            const biz_no = form.biz_no.value;
            if (!biz_no) {
                utils.showToast(' 사업자등록번호를 입력해주세요.');
                return false;
            } else if (biz_no.length !== 12) {
                utils.showToast(' 사업자등록번호를 확인해주세요.');
                return false;
            }
        }

        const username = utils.removeWhitespace(form.mb_name.value);
        const targetName = level === '2'? '이름' : '대표자명';

        if (!username) {
            utils.showToast(`${targetName}을 입력해 주세요.`);
            return false;
        } else {
            if (!userValidator.validateUserName(username)) {
                utils.showToast(`${targetName}을 올바르게 입력해 주세요. (한글)`);
                return false;
            }
        }

        const userHp = utils.addHyphenTel(form.mb_hp.value);
        if (!userHp) {
            const targetHp = level === '2' ? '연락처' : '담당자 연락처';
            utils.showToast(`${targetHp}를 입력해 주세요.`);
            return false;
        }

        if(form.mb_password.value || form.password_confirm.value){
            const pass = form.mb_password.value;
            const confirmPass = form.password_confirm.value;

            if (pass.length > 0 && pass.length < 4) {
                utils.showToast('비밀번호를 4자 이상 입력해 주세요.');
                return false;
            }

            if (pass.length > 0 && pass !== confirmPass) {
                utils.showToast('비밀번호와 비밀번호확인이 일치하지 않아요.');
                return false;
            }
        }
        return true;
    }
</script>