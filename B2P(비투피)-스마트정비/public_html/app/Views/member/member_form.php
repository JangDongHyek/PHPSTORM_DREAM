<?php
echo view('common/header_adm');
echo view('common/adm_head');
alert($msg);


?>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>



        <? if($w == "u"){ ?>
        <style>
            .tit_wrap {display: none}
        </style>
        <?}?>

        <? if($member['mb_level'] >= 9) { ?>
        <?php echo view('member/member_head', $this->data); ?>
        <?}?>


        <div class="write_wrap">
            <form id="member_form">
                <?= csrf_field() ?>
                <input type="hidden" id="w" name="w" value="<?=$w?>">
                <input type="hidden" id="mb_no" name="mb_no" value="<?=$mb['mb_no']?>">
                <input type="hidden" id="member_type" name="member_type" value="<?=$member_type?>">
                <div class="top_wrap">
                    <h1><?=$title?> <?=$submit_name?></h1>
                    <div class="btn_wrap">
                        <? if($member['mb_level'] >= 9) { ?>
                            <a href="<?=base_url("member/list?member_type=".$member_type)?>" class="btn btn-sm btn-gray">목록</a>
                        <?}?>

                        <button type="button" onclick="form_submit()" class="btn btn-sm btn-blue"><?=$submit_name?></button>
                    </div>
                </div>
                <div class="box">
                    <?/* if($member_type == "other") { ?>
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span>구분</p>
                        <div class="input_select">
                            <select class="border_gray" id="mb_type" name="mb_type">
                                <option value="제조사" <?=get_selected($mb['mb_type'], "제조사")?>>제조사</option>
                                <!--                                <option value="정비업체" <?=get_selected($mb['mb_type'], "정비업체")?>>정비업체</option>-->
                            </select>
                        </div>
                        <p class="msg-text" >error message</p>
                    </div>
                        <input type="hidden" id="mb_level" name="mb_level" value="2">
                    <?} else {?>
                        <input type="hidden" id="mb_type" name="mb_type" value="직원">
                        <input type="hidden" id="mb_level" name="mb_level" value="9">
                    <?}*/?>

                    <? if($member_type == "other") { ?>
                        <input type="hidden" id="mb_type" name="mb_type" value="제조사">
                        <input type="hidden" id="mb_level" name="mb_level" value="2">
                    <?} else {?>
                        <input type="hidden" id="mb_type" name="mb_type" value="직원">
                        <input type="hidden" id="mb_level" name="mb_level" value="9">
                    <?}?>

                    <div class="input_form input_text">
                        <p><span class="color-blue">(필수)</span>아이디</p>
                        <div class="input_phone2">
                            <input type="text" placeholder="입력하세요" class="border_gray" id="mb_id" name="mb_id" value="<?=$mb['mb_id']?>" <?=$readonly?>>
                            <? if($w == "") { ?>
                                <button type="button" class="btn btn-lg btn-white text-sm" onclick="chk_mbid()">중복확인</button>
                            <?}?>

                        </div>
                        <p class="msg-text" >아이디가 빈값입니다.</p>
                    </div>


                    <div class="wrap">
                        <div class="input_text">
                            <p><span class="color-blue">(필수)</span>비밀번호</p>
                            <input type="password" placeholder="입력하세요" class="border_gray" id="mb_password" name="mb_password" value="<?=$mb['mb_password']?>">
                            <p class="msg-text" >error message</p>
                        </div>
                        <div class="input_text">
                            <p><span class="color-blue">(필수)</span>비밀번호 확인</p>
                            <input type="password" placeholder="입력하세요" class="border_gray" id="mb_password2" name="mb_password2" value="<?=$mb['mb_password2']?>">
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>

                    <div class="wrap">
                        <div class="input_text">
                            <p><span class="color-blue">(필수)</span>실무자 이름</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="mb_name" name="mb_name" value="<?=$mb['mb_name']?>">
                            <p class="msg-text" >error message</p>
                        </div>
                        <div class="input_text">
                            <p><span class="color-blue">(필수)</span>실무자 연락처</p>
                            <div class="input_phone2">
                                <input type="text" placeholder="입력하세요" class="border_gray" maxlength='13' id="mb_hp" name="mb_hp" value="<?=$mb['mb_hp']?>">
                                <input type="button" class="btn btn-lg btn-white text-sm" value="본인인증">
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>
                    <div class="wrap">
                        <div class="input_form input_text">
                            <?
                                $mb_email_arr = explode("@",$mb['mb_email']);
                                $mb_email_id = $mb_email_arr[0];
                                $mb_email_domain = $mb_email_arr[1];
                                $mb_email_domain_hidden = "";
                            ?>
                            <p><span class="color-blue">(필수)</span>실무자 이메일</p>

                            <div class="input_email">
                                <input type="text" placeholder="입력하세요" class="border_gray" id="mb_email" name="mb_email" value="<?=$mb_email_id?>">
                                @
                                <div class="input_select">
                                    <? if(in_array($mb_email_domain, $email_list) || $w == "") {
                                        $mb_email_domain_hidden = "hidden";
                                        ?>

                                        <select class="border_gray" id="select_mb_email_domain">
                                            <?
                                            for($i=0; $i<count($email_list); $i++) {?>
                                                <option value="<?=$email_list[$i]?>" <?php echo get_selected($mb_email_domain, $email_list[$i] ); ?>><?=$email_list[$i]?></option>
                                            <?}
                                            ?>
                                            <option value="">직접입력</option>
                                        </select>
                                    <?}?>
                                    <input type="text" class="border_gray" placeholder="이메일 도메인을 입력하세요" id="mb_email_domain" name="mb_email_domain" <?=$mb_email_domain_hidden?> value="<?=empty($mb_email_domain) ? 'naver.com' : $mb_email_domain?>">
                                </div>
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>

                        <div class="input_form input_text">
                            <p><span class="color-blue">(필수)</span>실무자 카카오ID</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="mb_kakao" name="mb_kakao" value="<?=$mb['mb_kakao']?>">
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>

                    <? if($member_type == "other") { ?>
                    <div class="wrap">
                        <div class="input_form input_text">
                            <p><span class="color-blue">(필수)</span>회사이름</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="cp_name" name="cp_name" value="<?=$mb['cp_name']?>">
                            <p class="msg-text" >error message</p>
                        </div>

                        <div class="input_form input_text">
                            <?
                            $cp_email_arr = explode("@",$mb['cp_email']);
                            $cp_email_id = $cp_email_arr[0];
                            $cp_email_domain = $cp_email_arr[1];
                            $cp_email_domain_hidden = "";
                            ?>
                            <p><span class="color-blue">(필수)</span>회사 이메일</p>

                            <div class="input_email">
                                <input type="text" placeholder="입력하세요" class="border_gray" id="cp_email" name="cp_email" value="<?=$cp_email_id?>">
                                @
                                <div class="input_select">
                                    <? if(in_array($cp_email_domain, $email_list) || $w == "") {
                                        $cp_email_domain_hidden = "hidden";
                                        ?>

                                        <select class="border_gray" id="select_cp_email_domain">
                                            <?
                                            for($i=0; $i<count($email_list); $i++) {?>
                                                <option value="<?=$email_list[$i]?>" <?php echo get_selected($cp_email_domain, $email_list[$i] ); ?>><?=$email_list[$i]?></option>
                                            <?}
                                            ?>
                                            <option value="">직접입력</option>
                                        </select>
                                    <?}?>
                                    <input type="text" class="border_gray" placeholder="이메일 도메인을 입력하세요" id="cp_email_domain" name="cp_email_domain" <?=$cp_email_domain_hidden?> value="<?=empty($cp_email_domain) ? 'naver.com' : $cp_email_domain?>">
                                </div>
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>

                    <div class="wrap">
                        <div class="input_form input_text">
                            <p><span class="color-blue">(필수)</span>사업자주소</p>

                            <div class="input_search">
                                <input type="text" placeholder="주소를 검색하세요" readonly class="border_gray" id="cp_addr1" name="cp_addr1" value="<?=$mb['cp_addr1']?>" onclick="daum_zip('cp_zip','cp_addr1','cp_addr2','cp_addr3','cp_addr4','cp_addr1');">
                            </div>
                            
                            <p class="msg-text" >error message</p>
                        </div>
                        <div class="input_form input_text">
                            <p>상세주소</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="cp_addr2" name="cp_addr2" value="<?=$mb['cp_addr2']?>">
                        </div>
                        <input type="hidden" placeholder="입력하세요" class="border_gray" id="cp_zip" name="cp_zip" value="<?=$mb['cp_zip']?>">
                        <input type="hidden" placeholder="입력하세요" class="border_gray" id="cp_addr3" name="cp_addr3" value="<?=$mb['cp_addr3']?>">
                        <input type="hidden" placeholder="입력하세요" class="border_gray" id="cp_addr4" name="cp_addr4" value="<?=$mb['cp_addr4']?>">
                    </div>

                    <div class="wrap">
                        <div class="input_form input_text">
                            <p><span class="color-blue">(필수)</span>사업자등록번호(고유번호)</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="cp_no" name="cp_no" value="<?=$mb['cp_no']?>">
                            <p class="msg-text" >error message</p>
                        </div>
                        <div class="input_form input_text">
                            <p><span class="color-blue">(필수)</span>사업장등록증 첨부</p>
                            <div class="input_file">
                                <input type="file" class="border_gray" value="첨부하기" id="cp_file" name="cp_file">
                                <input type="button" class="btn btn-lg btn-white text-sm" value="이미지 보기" id="show_file" name="show_file">
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>

                    <div class="wrap">
                        <div class="input_text">
                            <p>업태</p>
                            <div id="business_type_container">
                                <?
                                if(!empty($mb['business_type'])){
                                    $business_types = explode(",",$mb['business_type']);
                                    for($i=0; $i<count($business_types); $i++){
                                        $business_type = $business_types[$i];
                                        ?>
                                        <div class="input_busi">
                                            <input type="text" class="border_gray" placeholder="업태" name="business_type[]" value="<?=$business_type?>">
                                            <button type="button" class="btn btn-white btn-close"><i class="fa-regular fa-xmark"></i></button>
                                            <?
                                            if($i==count($business_types)-1 && count($business_types) > 0){ ?>
                                                <button type="button" class="btn btn-blue btn-plus"><i class="fa-regular fa-plus"></i></button>
                                            <?}
                                            ?>
                                        </div>
                                    <?}
                                } else { ?>
                                    <div class="input_busi">
                                        <input type="text" class="border_gray" placeholder="업태" name="business_type[]">
                                        <button type="button" class="btn btn-blue btn-plus"><i class="fa-regular fa-plus"></i></button>
                                    </div>
                                <?}?>
                            </div>
                            <div id="business_type" style="display: none"></div>
                            <p class="msg-text" >error message</p>
                        </div>


                        <div class="input_text">
                            <p>종목</p>
                            <div id="business_item_container">
                                <?
                                if(!empty($mb['business_item'])){
                                    $business_items = explode(",",$mb['business_item']);
                                    for($i=0; $i<count($business_items); $i++){
                                        $business_item = $business_items[$i];
                                        ?>
                                        <div class="input_busi">
                                            <input type="text" class="border_gray" placeholder="업태" name="business_item[]" value="<?=$business_item?>">
                                            <button type="button" class="btn btn-white btn-close"><i class="fa-regular fa-xmark"></i></button>
                                            <?
                                            if($i==count($business_items)-1 && count($business_items) > 0){ ?>
                                                <button type="button" class="btn btn-blue btn-plus"><i class="fa-regular fa-plus"></i></button>
                                            <?}
                                            ?>
                                        </div>
                                    <?}
                                } else { ?>
                                    <div class="input_busi">
                                        <input type="text" class="border_gray" placeholder="업태" name="business_item[]">
                                        <button type="button" class="btn btn-blue btn-plus"><i class="fa-regular fa-plus"></i></button>
                                    </div>
                                <?}?>
                            </div>
                            <div id="business_item" style="display: none"></div>
                            <p class="msg-text" >error message</p>
                        </div>

                    </div>

                    <div>
                        <p>통신판매업 신고번호</p>
                        <div class="radi_wrap">
                            <?
                                $mall_register_no = $mb['mall_register_no'];
                                if($mall_register_no == "미신고"){
                                    $seller_status_3 = "checked";
                                } else if (strlen($mall_register_no) === 1 && $mall_register_no >= '0' && $mall_register_no <= '2') {
                                    $seller_status_2 = "checked";
                                } else {
                                    $seller_status_1 = "checked";
                                }
                            ?>

                            <input type="radio" id="radi_direct_input" name="seller_status" value="1" <?=$seller_status_1?>>
                            <label for="radi_direct_input">
                                <i class="fa-duotone fa-circle-check"></i>
                                직접입력
                                <div class="input_text">
                                    <input type="text" class="border_gray" placeholder="신고번호를 입력해주세요" id="direct_input_number" value="<?=$mall_register_no?>">
                                </div>
                            </label>

                            <input type="radio" id="radi_exempt" name="seller_status" value="2" <?=$seller_status_2?>>
                            <label for="radi_exempt">
                                <i class="fa-duotone fa-circle-check"></i>
                                신고 면제 대상
                                <div class="input_select">
                                    <i class="fa-light fa-angle-down"></i>
                                    <select class="border_gray" id="exempt_reason" name="exempt_reason">
                                        <option value="0" <? echo get_selected($mall_register_no, "0")?>>신고 면제 사유</option>
                                        <option value="1" <? echo get_selected($mall_register_no, "1")?>>간이과세자</option>
                                        <option value="2" <? echo get_selected($mall_register_no, "2")?>>전년 통신판매 50회 미만</option>
                                    </select>
                                </div>
                            </label>

                            <input type="radio" id="radi_not_reported" name="seller_status" value="3" <?=$seller_status_3?>>
                            <label for="radi_not_reported">
                                <i class="fa-duotone fa-circle-check"></i>
                                미신고
                            </label>
                            <input type="hidden" id="mall_register_no" name="mall_register_no" value="<?=$mall_register_no?>">
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>
                    <div class="wrap">
                        <div class="input_text">
                            <p><span class="color-blue">(필수)</span>대표</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="cp_owner" name="cp_owner" value="<?=$mb['cp_owner']?>">
                                <p class="msg-text" >error message</p>
                        </div>
                        <div class="input_text">
                            <p><span class="color-blue">(필수)</span>대표 연락처</p>
                            <div class="input_phone2">
                                <input type="text" class="border_gray" maxlength='13' id="cp_hp" name="cp_hp" value="<?=$mb['cp_hp']?>">
                                <input type="button" class="btn btn-lg btn-white text-sm" value="본인인증">
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>

                    <div class="input_form input_grid3">
                        <p><span class="color-blue">(필수)</span>계좌정보</p>
                        <div>
                        <div class="input_select">
                            <select class="border_gray" id="bank_code" name="bank_code">
                                <option value="" <?php echo get_selected($mb['bank_code'], ""); ?>>은행선택</option>
                                <?
                                        for($i=0; $i<count($bank_list); $i++) {
                                            $bank_info = $bank_list[$i];

                                            ?>
                                <option value="<?=$bank_info['code']?>" <?php echo get_selected($mb['bank_code'], $bank_info['code']); ?>><?=$bank_info['name']?></option>
                                <?}
                                    ?>
                            </select>
                        </div>
                        <p class="msg-text" >error message</p>
                        </div>

                        <div>
                            <input type="text" placeholder="예금주 입력하세요" class="border_gray" id="bank_owner" name="bank_owner" value="<?=$mb['bank_owner']?>">
                            <p class="msg-text" >error message</p>
                        </div>
                        
                        <div class="input_bank">
                            <input type="text" placeholder="계좌번호 입력하세요" class="border_gray" id="bank_num" name="bank_num" value="<?=$mb['bank_num']?>">

                            <input type="button" class="btn btn-lg btn-white text-sm" value="계좌인증">
                            <p class="msg-text" >error message</p>
                        </div>
                        
                        
                    </div>

                    <!--상점소개-->
                    <div class="input_seller">
                        <div>
                            <p>판매사원 여부</p>
                            <div class="btn_wrap seller_wrap">
                                <input type="checkbox" id="seller_gmarket" name="seller_gmarket" value="gmarket" <?php echo get_checked($mb['seller_gmarket'], 'T'); ?>>
                                <label class="btn" for="seller_gmarket">G마켓</label>
                                <input type="checkbox" id="seller_action" name="seller_action" value="action" <?php echo get_checked($mb['seller_action'], 'T'); ?>>
                                <label class="btn" for="seller_action">옥션</label>
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>

                        <div>
                            <p>스토어 주소</p>
                            <div class="input_url">
                                <input type="text" placeholder="입력하세요" class="border_gray" id="store_url" name="store_url" value="<?=$mb['store_url']?>">
                                <input type="button" class="btn btn-lg btn-white text-sm" value="연결확인" onclick="chk_url()">
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>


                    <!-- 선택 약관 -->
                    <div class="wrap">
                        <div>
                            <p>
                                <span class="color-blue">(선택)</span>개인정보 수집 및 이용에 관한 사항 동의
                                <a class="text-sm color-gray btn-more" onclick="agr03_modal()">
                                    보기
                                    <i class="fa-regular fa-chevron-right"></i>
                                </a>
                            </p>
                            <div class="input_select">

                                <select class="border_gray" id="privacy_collection_agreement" name="privacy_collection_agreement">
                                    <option value="T" <?php echo get_selected($mb['privacy_collection_agreement'], 'T'); ?>>동의</option>
                                    <option value="F" <?php echo get_selected($mb['privacy_collection_agreement'], 'F'); ?>>미동의</option>
                                </select>
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>
                        <div>
                            <p>
                                <span class="color-blue">(선택)</span>마켓할인 지원 프로그램 서비스 동의
                                <a class="text-sm color-gray btn-more" onclick="agr01_modal()">
                                    보기
                                    <i class="fa-regular fa-chevron-right"></i>
                                </a>
                            </p>
                            <div class="input_select">

                                <select class="border_gray" id="market_discount_agreement" name="market_discount_agreement">
                                    <option value="T" <?php echo get_selected($mb['market_discount_agreement'], 'T'); ?>>동의</option>
                                    <option value="F" <?php echo get_selected($mb['market_discount_agreement'], 'F'); ?>>미동의</option>
                                </select>
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>
<!--
                        <div>
                            <p>
                                <span class="color-blue">(권장)</span>신용카드사 제휴채널 프로모션 서비스 동의
                                <a class="text-sm color-gray btn-more" onclick="agr02_modal()">
                                    보기
                                    <i class="fa-regular fa-chevron-right"></i>
                                </a>
                            </p>
                            <div class="input_select">

                                <select class="border_gray" id="credit_card_promotion_agreement" name="credit_card_promotion_agreement">
                                    <option value="T" <?php echo get_selected($mb['credit_card_promotion_agreement'], 'T'); ?>>동의</option>
                                    <option value="F" <?php echo get_selected($mb['credit_card_promotion_agreement'], 'F'); ?>>미동의</option>
                                </select>
                            </div>
                            <p class="msg-text" >error message</p>
                        </div>
-->
                    </div>
                    <?}?>


                    <!-- 외부직원이면서 B2P 직원인 경우에만 보이도록 -->
                    <? if($member_type == "other" && $member['mb_level'] >= 9) { ?>
                    <div class="input_form input_grid3">
                        <p>수수료</p>
                        <div class="fee_box">
                            <p class="text-guide">플랫폼</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="charge_platform" name="charge_platform" value="<?=$mb['charge_platform']?>">원
                            <p class="msg-text" >error message</p>
                        </div>
                        <div class="fee_box">
                            <p class="text-guide">쇼핑몰</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="charge_mall" name="charge_mall" value="<?=$mb['charge_mall']?>">원
                            <p class="msg-text" >error message</p>
                        </div>
                        <div class="fee_box">
                            <p class="text-guide">PG</p>
                            <input type="text" placeholder="입력하세요" class="border_gray" id="charge_pg" name="charge_pg" value="<?=$mb['charge_pg']?>">원
                            <p class="msg-text" >error message</p>
                        </div>
                    </div>

                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span>직불승인</p>
                        <div class="input_select">
                            <select class="border_gray" id="debit_approval" name="debit_approval">
                                <option value="Y" <?=get_selected($mb['debit_approval'],"Y") ?>>승인</option>
                                <option value="N" <?=get_selected($mb['debit_approval'],"N") ?>>미승인</option>
                            </select>
                        </div>
                        <p class="msg-text" >error message</p>
                    </div>
                    <?}?>

                    <? if($member['mb_level'] >= 9) { ?>
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span>승인 여부</p>
                        <div class="input_select">
                            <select class="border_gray" id="is_sign" name="is_sign">
                                <option value="Y" <?=get_selected($mb['is_sign'],"Y") ?>>승인</option>
                                <option value="N" <?=get_selected($mb['is_sign'],"N") ?>>미승인</option>
                            </select>
                        </div>
                        <p class="msg-text" >error message</p>
                    </div>
                    <?}?>

                </div>
            </form>
        </div>

<script>
    function agr01_modal() {

        Swal.fire({
            title: "마켓할인 지원 프로그램 서비스 동의",
            html: `
        <div class="agr_text">
            <p><?php echo view('agr/sell_Agr01'); ?></p>
        </div>
          `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        });
    }

    function agr02_modal() {

        Swal.fire({
            title: "신용카드사 제휴채널 프로모션 서비스 동의",
            html: `
        <div class="agr_text">
            <p><?php echo view('agr/sell_Agr02'); ?></p>
        </div>
          `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        });
    }

    function agr03_modal() {

        Swal.fire({
            title: "개인정보 수집 및 이용에 관한 사항 동의",
            html: `
        <div class="agr_text">
            <p><?php echo view('agr/un_essAgr01'); ?></p>
        </div>
          `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        });
    }

    $(document).ready(function() {
        $('#mb_hp').phoneFormat();
        $('#cp_hp').phoneFormat();

        let show_img = "";
        $('.adm_menu > li:nth-child(1)').addClass('active');



        let cp_file = "<?=$mb['cp_file']?>";
        if (cp_file != "") {
            show_img = "<?=base_url('/data/file/cp_member/'.$mb['cp_file'])?>";
        }

        $('#show_file').click(function() {
            if (show_img != "") {
                Swal.fire({
                    text: "",
                    imageUrl: show_img,
                    confirmButtonText: `확인`,
                });
            } else {
                swal("등록된 이미지가 없습니다.");
            }
        });
    });

    $('#cp_file').change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                show_img = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });


    let isAjaxIng = false;

    function form_submit() {
        if (isAjaxIng) return false;
        isAjaxIng = true;
        $('.msg-text').hide();

        let gmarket_checked = $("#seller_gmarket").is(':checked');
        let have_gmarket = 'F';
        if (gmarket_checked) {
            have_gmarket = 'T';
        }
        let action_checked = $("#seller_action").is(':checked');
        let have_action = 'F';
        if (action_checked) {
            have_action = 'T';
        }

        let formData = new FormData($('#member_form')[0]);
        formData.append("seller_gmarket", have_gmarket);
        formData.append("seller_action", have_action);

        $.ajax({
            url: '<?= base_url("member/member_form_update")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.code != 200) {
                    swal(data.msg);
                    err_msg(data.err_id, data.msg);
                } else {
                    swal(data.msg).then(function() {
                        location.href = "<?=base_url('')?>";
                    });
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {},
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


    // + 버튼 클릭 시 필드 추가
    $(document).on('click', '.btn-plus', function() {
        var container = $(this).closest('div').parent();
        var placeholderText = container.attr('id') === 'business_type_container' ? '업태' : '종목';
        var nameAttr = container.attr('id') === 'business_type_container' ? 'business_type[]' : 'business_item[]';

        var newField = `
            <div class="input_busi">
                <input type="text" class="border_gray" placeholder="${placeholderText}" name="${nameAttr}" value="">
                <button type="button" class="btn btn-white btn-close"><i class="fa-regular fa-xmark"></i></button>
                <button type="button" class="btn btn-blue btn-plus"><i class="fa-regular fa-plus"></i></button>
            </div>
        `;

        // 기존 + 버튼 제거
        $(this).closest('.input_busi').find('.btn-plus').remove();

        // 새로운 필드 추가
        container.append(newField);

        // 하나 이상의 필드가 있을 경우 모든 필드에 삭제 버튼 추가
        if (container.children().length > 1) {
            container.children().each(function() {
                if ($(this).find('.btn-close').length === 0) {
                    $(this).find('input').after('<button type="button" class="btn btn-white btn-close"><i class="fa-regular fa-xmark"></i></button>');
                }
            });
        }
    });

    // X 버튼 클릭 시 필드 삭제
    $(document).on('click', '.btn-close', function() {
        var container = $(this).closest('div').parent();
        $(this).parent().remove();

        // 모든 + 버튼 제거
        container.find('.btn-plus').remove();

        // 마지막 필드에 + 버튼 추가
        if (container.children().length > 0) {
            container.children().last().append('<button type="button" class="btn btn-blue btn-plus"><i class="fa-regular fa-plus"></i></button>');
        }

        // 필드가 하나만 남았을 경우 삭제 버튼 제거
        if (container.children().length === 1) {
            container.find('.btn-close').remove();
        }
    });



    // 업태, 종목
    function updateSellerNo() {
        let sellerNo = '';
        if ($('#radi_direct_input').is(':checked')) {
            sellerNo = $('#direct_input_number').val();
        } else if ($('#radi_exempt').is(':checked')) {
            sellerNo = $('#exempt_reason').val();
        } else if ($('#radi_not_reported').is(':checked')) {
            sellerNo = '미신고';
        }
        $('#mall_register_no').val(sellerNo);
    }

    $('#direct_input_number').on('input', updateSellerNo);
    $('#exempt_reason').on('change', updateSellerNo);
    $('input[name="seller_status"]').on('change', updateSellerNo);

    function chk_url() {
        let url = $("#store_url").val().trim();
        if (url) {
            window.open(url, '_blank');
        }
    }

    function chk_mbid(){
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;

        $('.msg-text').hide();

        let formData = new FormData($('#member_form')[0]);
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

</script>

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>