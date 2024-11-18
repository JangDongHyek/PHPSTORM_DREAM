<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

$is_register = false;

$name = get_session("name");
$name = mb_convert_encoding($name,"UTF-8", "EUC-KR");
$phoneNo = get_session("phoneNo");
$ci = get_session("ci");
$di = get_session("di");
$ss_gender = get_session("gender");
$birthDay = get_session("birthDay");


if($w == ""){
    if(empty($ci)){
        alert("본인인증 후 이용해주세요.",G5_URL);
        exit;
    }
    if(empty($di)){
        alert("본인인증 후 이용해주세요.",G5_URL);
        exit;
    }

    $sql = "select * from `g5_member` where `mb_9` = '$ci'";
    $row = sql_fetch($sql);
    if(!empty($row)){
        // 본인인증 관련 모든 세션삭제
        un_kmc();
        $is_register = true;
    }

    $gender = "남";
    if($ss_gender == "1"){
        $gender = "여";
    }

    $member['mb_name'] = $name;
    $member['mb_hp'] = $phoneNo;
    $member['mb_birth'] = $birthDay;
    $member['mb_sex'] = $gender;
} else {

    if(!empty($name)){
        $member['mb_name'] = $name;
    }

    if(!empty($phoneNo)){
        $member['mb_hp'] = $phoneNo;
    }

    if(!empty($birthDay)){
        $birthDateObj = DateTime::createFromFormat('Ymd', $birthDay);
        $now = new DateTime();
        $interval = $now->diff($birthDateObj);
        $is_under_age = false;
        if ($interval->y < 14) {
            // 본인인증 관련 모든 세션삭제
            un_kmc();
            $is_under_age = true;
        }
        $member['mb_birth'] = $birthDay;
    }

    if($ss_gender != ""){
        $gender = "남";
        if($ss_gender == "1"){
            $gender = "여";
        }

        $member['mb_sex'] = $gender;
    }


}


//메일수신
$mb_mailling_yes    =  $member['mb_mailling']   ? 'checked="checked"' : '';
$mb_mailling_no     = !$member['mb_mailling']   ? 'checked="checked"' : '';

// SMS 수신
$mb_sms_yes         =  $member['mb_sms']        ? 'checked="checked"' : '';
$mb_sms_no          = !$member['mb_sms']        ? 'checked="checked"' : '';

//
?>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=41982c9bef00b4da7a700cd6f86deef4&libraries=services"></script>
<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
    ?>
    <script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
    <?php
}else{
    ?>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <?php
}
?>

<style>
    .agr_wrap {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .agr_wrap > div{
        display: flex;
        align-items: center;
        grid-gap: 15px;
    }
    .agr_wrap label{
        display: inline-flex !important;
        align-items: center;
        grid-gap: 5px;
        padding: 5px 0;
        color: #999;
        font-size: .9em;
    }
</style>

<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <input type="hidden" name="mb_sns_type" value="<?php echo $mb_sns_type;?>">
    <input type="hidden" name="mb_type" id="mb_type" value="<?php echo $mb_type;?>">
    <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php } ?>

<!--	상황별 메세지-->
    <? if($is_under_age == true || $is_register == true) { ?>
        <article class="box-article">
            <div class="box-body register_msg">

                <? if($is_under_age == true) { ?>
                    <!-- 본인인증 시 14세 미만일 경우-->
                    <h1 class="">죄송합니다. 14세 미만은 가입이 불가능합니다.</h1>
                    <a href="<?php echo G5_URL ?>" class="btn02">메인으로 돌아가기</a>
                <?}?>


                <? if($is_register == true) { ?>
                    <!--   중복회원 가입 시-->
                    <h1 class="">이미 가입된 휴대폰 번호입니다.</h1>
                    <p class="">회원아이디 및 비밀번호가 기억 안나실 때는 아이디/비밀번호 찾기를 이용하십시오</p>
                    <a href="./kmc.php?type=f" class="btn02">아이디 비밀번호 찾기</a>
                    <a href="./login.php" class="btn02">로그인 하기</a>
                <?}?>
            </div>
        </article>
	<? } else { ?>
        <article class="box-article">
            <div class="box-body">
                <h3>회원 정보 입력</h3>
                <dl>
                    <dd>
                        <label for="reg_mb_id">아이디</label>
                        <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="frm_input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="아이디" <?php if($w=="u") echo "readonly";?>>
                    </dd>
                    <!--
                                    <dd class="status_icons text-right">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </dd>
                    -->
                    <dd class="status_text text-right">
                        필수
                    </dd>
                    <dd></dd>
                </dl>

                <dl>
                    <dd>
                        <label for="reg_mb_password">비밀번호</label>
                        <input type="password" name="mb_password" id="reg_mb_password" class="frm_input <?php echo $required ?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="비밀번호">
                    </dd>
                    <!--
                                    <dd class="status_icons text-right">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </dd>
                    -->
                    <dd class="status_text text-right">
                        필수
                    </dd>
                    <dd></dd>
                </dl>

                <dl>
                    <dd>
                        <label for="mb_password_re">비밀번호확인</label>
                        <input type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input <?php echo $required ?>" minlength="6" maxlength="20" <?php echo $required ?> placeholder="비밀번호확인">
                    </dd>
                    <!--
                                    <dd class="status_icons text-right">
                                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                    </dd>
                    -->
                    <dd class="status_text text-right">
                        필수
                    </dd>
                    <dd></dd>
                </dl>
                <div class="flex">
                <dl>
                    <dd>
                        <label for="reg_mb_name">이름</label>
                        <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" class="frm_input <?php echo $required ?>" <?php echo $required ?> placeholder="이름" readonly>
                    </dd>

                    <!--
                                    <dd class="status_icons text-right">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </dd>
                    -->
                    <dd class="status_text text-right">
                        필수
                    </dd>
                    <dd></dd>
                </dl>
                <a href="<?=G5_URL?>/bbs/kmc.php?type=ru" class="btn_frmline">이름변경</a>
                </div>
                <dl>
                    <dd>
                        <label for="reg_mb_hp">휴대번호</label>
                        <input type="tel" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="frm_input <?php echo $required ?>" <?php echo $required ?> placeholder="휴대번호" minlength="10" maxlength="14" readonly>

                       
                       <div class="agr_wrap">
                           <span>휴대폰 수신동의</span>
                           <div>
                              
                            <label for="mb_sms_yes">
                            <input type="radio" name="mb_sms" value="1" id="mb_sms_yes" <?php echo $mb_sms_yes; ?>>예
                            </label>

                            <label for="mb_sms_no">
                            <input type="radio" name="mb_sms" value="0" id="mb_sms_no" <?php echo $mb_sms_no; ?>>아니오
                            </label>
                            </div>
                        </div>

                    </dd>
                    <!--
                                    <dd class="status_icons text-right">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </dd>
                    -->
                    <dd class="status_text text-right">
                        필수
                    </dd>
                    <dd></dd>
                </dl>

                <dl>
                    <dd>
                        <label for="reg_mb_email">E-mail</label>
                        <input type="text" name="mb_email" id="reg_mb_email" class="frm_input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
                        
                        
                        
                       <div class="agr_wrap">
                           <span>E-mail 수신동의</span>
                           <div>
                                <label for="mb_mailling_yes">
                                    <input type="radio" name="mb_mailling" value="1" id="mb_mailling_yes" <?php echo $mb_mailling_yes; ?>>
                                    예
                                </label>
                                <label for="mb_mailling_no">
                                    <input type="radio" name="mb_mailling" value="0" id="mb_mailling_no" <?php echo $mb_mailling_no; ?>>
                                    아니오
                                </label>
                            </div>
                        </div>
                        
                        

                    </dd>
                    <!--
                                    <dd class="status_icons text-right">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </dd>
                    -->
                    <dd class="status_text text-right">
                        필수
                    </dd>
                    <dd></dd>
                </dl>

                <dl>
                    <dd>
                        <label for="">성별</label>
                        <input type="text" value="<?php echo $member['mb_sex'] ?>" name="mb_sex" id="mb_sex" readonly class="frm_input <?php echo $required ?>">
                    </dd>
                    <dd class="status_text text-right">
                        필수
                    </dd>
                    <dd></dd>
                </dl>
                <dl>
                    <dd>
                        <label for="">생년월일</label>
                        <input type="text" value="<?php echo $member['mb_birth'] ?>" name="mb_birth" id="mb_birth" readonly class="frm_input <?php echo $required ?>">
                    </dd>
                    <dd class="status_text text-right">
                        필수
                    </dd>
                    <dd></dd>
                </dl>

                <dl>
                    <dd>
                        <label for="reg_mb_name">주소</label>
                        <label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                        <input type="text" name="mb_zip" placeholder="우편번호" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6" readonly>
                        <button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                        <label for="reg_mb_addr1" class="sound_only">주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                        <input type="text" name="mb_addr1" placeholder="주소" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?>" size="50"><br>
                        <label for="reg_mb_addr2" class="sound_only">상세주소</label>
                        <input type="text" name="mb_addr2" placeholder="상세주소" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="frm_input frm_address" size="50">
                        <br>
                        <input type="hidden" name="mb_addr3" placeholder="참고항목" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="frm_input frm_address" size="50" readonly="readonly">
                        <input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
                    </dd>
                    <!--
                                    <dd class="status_icons text-right">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </dd>
                    -->
                    <dd></dd>
                </dl>

                <!--
			<dl>
				<dd>
					<label for="reg_mb_nick">닉네임</label>
					<input type="text" name="mb_nick" id="reg_mb_nick" class="frm_input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="2" maxlength="20" <?php echo $required ?> placeholder="닉네임" value="<?php echo $member['mb_nick']; ?>">
				</dd>
				<dd class="status_icons text-right">
					<i class="fa fa-check" aria-hidden="true"></i>
				</dd>
				<dd></dd>
			</dl>
-->


            </div>

            <?php if($w == ""){ ?>
                <div class="box-body">
                    <h3>약관동의</h3>
                    <dl class="agree-row">
                        <dd data-for="reg_chk1">
                            <input type="checkbox" name="reg_chk[]" id="reg_chk1" value="">
                            <label for="reg_chk1">모든 약관에 동의합니다.</label>
                        </dd>
                    </dl>

                    <dl class="agree-row agree-v-con">
                        <dd data-for="reg_req1">
                            <input type="checkbox" name="reg_req[]" id="reg_req1" value="1">
                            <label for="reg_req1">이용약관 동의 (필수)</label>
                        </dd>
                        <dd class="text-right"><input type="button" value="내용보기" class="btn btn-danger btn-agr"></dd>
                        <dd><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                    </dl>

                    <dl class="agree-row agree-v-con">
                        <dd data-for="reg_req2">
                            <input type="checkbox" name="reg_req[]" id="reg_req2" value="1">
                            <label for="reg_req2">개인정보처리방침 동의 (필수)</label>
                        </dd>
                        <dd class="text-right"><input type="button" value="내용보기" class="btn btn-danger btn-agr"></dd>
                        <dd><!--<textarea readonly><?php /*echo get_text($config['cf_privacy']) */?></textarea>-->
                            <div style="font-weight:200; background-color:#fff; width:100%; height:140px; color:#646464; padding:10px; overflow-y: scroll; border: 1px solid #eee;">
                                (주)장스푸드(이하 "회사"라 합니다)는 회사가 운영하는 웹사이트 및 애플리케이션을 통해 제공되는 서비스(이하 “서비스”라 함) 이용자의 자유와 권리 보호를 위하여,
                                "정보 통신망 이용 촉진 및 정보 보호 등에 관한 법률(이하 "정보통신망법"이라함)" 및 "개인정보보호법" 등 개인정보와 관련된 법령이 정한 바를 준수하여 적법하게 개인정보를 처리하고 안전하게 관리하고 있습니다. 이에 “개인정보보호법” 제30조에 따라 이용자에게 개인정보 처리에 관한 절차 및 기준을 안내하고, 이와 관련된 고충을 신속하고 원활하게 처리할 수 있도록 하기 위하여 다음과 같이 개인정보처리 방침을 수립 및 공개합니다.<br>
                                <br>
                                회사는 이용자의 개인정보를 수집ㆍ이용ㆍ제공하는 경우 반드시 사전에 이용자에게 해당 내용을 알리고 동의절차를 거치며, 이용자가 동의하지 않을 경우에는 이용자의 개인정보를 수집ㆍ이용ㆍ제공 하지 않습니다. 단, 동의를 거부하는 경우 서비스의 전부 또는 일부 이용이 제한될 수 있습니다.<br>
                                <br>
                                1. 개인정보의 수집항목 및 수집 방법<br>
                                1) 회사는 회원가입, 서비스 제공 등을 위해 아래와 같은 개인정보를 수집하고 있습니다.<br>
                                - 이름, 아이디, 비밀번호, 휴대폰번호, 이메일, 주소, 성별, 생년월일<br>
                                - 서비스 이용 과정에서 아래와 같은 정보들이 자동 수집될 수 있습니다.<br>
                                접속 IP 정보, 쿠키, 방문 일시, OS종류, 브라우저 종류, 위치정보, 카드번호<br>
                                <br>
                                2) 개인정보 수집방법<br>
                                - 회원가입 시 개인정보보호정책과 이용약관 동의 절차<br>
                                - 온라인 주문, 전화, 팩스, 상담게시판, 이메일, 이벤트 및 프로모션 응모<br>
                                <br>
                                2. 개인정보의 수집 및 이용목적<br>
                                1) 회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br>
                                ① 회원 관리<br>
                                - 서비스제공 및 서비스 이용에 따른 본인확인, 중복가입 및 부정이용 방지<br>
                                - 서비스 이용에 따른 민원 사항 처리, 불만처리, 고지사항 안내<br>
                                - 이벤트 경품 배송 시 주소 및 연락처 확인<br>
                                ② 온라인 주문 및 결제<br>
                                ③ 통계 및 마케팅 광고에 활용<br>
                                - 신규 서비스 개발, 맞춤 서비스 제공 및 마케팅, 서비스 이용 통계 및 설문<br>
                                - 이벤트 등 광고성 정보 제공<br>
                                <br>
                                3. 개인정보의 보유 및 이용기간<br>
                                원칙적으로 회사는 개인정보의 수집 및 이용목적이 달성된 후 또는 탈퇴 후 지체 없이 파기합니다.<br>
                                <br>
                                4. 개인정보 파기절차 및 방법<br>
                                회사는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기하며파기절차 및 방법은 다음과 같습니다.<br>
                                <br>
                                1) 파기절차<br>
                                회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 사유에 따라(개인정보의 보유 및 이용기간 참조) 일정 기간 저장된 후 파기되어집니다.<br>
                                별도 DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 보유되는 이외의 다른 목적으로 이용되지 않습니다.<br>
                                <br>
                                2) 파기방법<br>
                                DB에 입력한 정보 등 전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제하며, 문서 등 종이에 출력된 개인정보는 분쇄기로 파쇄합니다.<br>
                                <br>
                                5. 개인정보의 제 3자 제공<br>
                                회사는 이용자들의 개인정보를 명시한 범위 내에서 사용하며, 이용자의 사전 동의 없이는 동 범위를 초과하여 이용하거나 원칙적으로 이용자의 개인정보를 외부에 제공하지 않습니다.<br>
                                단, 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구(영장 발부 등)가 있는 경우 개인정보 제3자 제공에 대한 별도 동의 없이 제공할 수 있습니다.<br>
                                <br>
                                6. 개인정보의 위탁<br>
                                회사는 이용자의 민원사항에 대한 처리 등 원활한 업무 수행을 위하여 다음과 같이 개인정보 처리 업무를 외부 전문업체에 위탁하여 운영하고 있습니다.<br>
                                또한, 위탁계약 시 개인정보보호의 안전을 기하기 위하여 개인정보보호 관련 법규의 준수, 개인정보에 관한 제3자 제공 금지 및 사고시의 책임부담 등을 명확히 규정하고 당해 계약 내용을 서면 및 전자적으로 보관하고 있습니다. 동 업체가 변경될 경우, 회사는 변경된 업체 명을 공지사항 내지 개인정보처리방침 화면을 통해 고지하도록 하겠습니다.<br>
                                <br>
                                <div class="tbl">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>수탁업체</th>
                                        <th>위탁업무 내용</th>
                                        <th>개인정보의 보유 및 이용기간</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>㈜드림포원</td>
                                        <td>시스템 서비스 운영, 고객상담</td>
                                        <td>회원탈퇴시 혹은 위탁계약의 종료시까지</td>
                                    </tr>
                                    <tr>
                                        <td>㈜한국모바일인증㈜</td>
                                        <td>본인인증</td>
                                        <td>해당 업체에서 이미 보유하고 있는 개인정보이기 때문에 별도로 저장하지 않음</td>
                                    </tr>
                                    <tr>
                                        <td>더화이트커뮤니케이션㈜</td>
                                        <td>고객 상담 서비스 & 서비스 오퍼레이션</td>
                                        <td>보유기간 경과, 개인정보 처리 목적 달성, 위탁계약의 해지 및 만료시까지</td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <br>
                                7. 이용자 및 법정대리인의 권리와 그 행사 방법<br>
                                1) 개인정보의 열람ㆍ정정<br>
                                이용자는 언제든지 개인정보를 열람하거나 정정하실 수 있습니다. 특히, 회원은 언제든지 회사 사이트의 “정보수정” 메뉴를 통하여 회원님의 개인정보를 열람, 정정 처리하실 수 있으며, 회사는 이용자가 개인정보 열람 및 정정을 쉽게 할 수 있도록 여러 가지 조치를 하고 있습니다. 이용자가 개인정보를 열람하거나 정정하고자 할 경우에는 회사 개인정보보호책임자에게 서면, 전화, 이메일로 연락하시면 지체 없이 조치하겠습니다.<br>
                                이용자가 개인정보의 오류에 대한 정정을 요청한 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 통지하여 정정이 이루어지도록 하겠습니다.<br>
                                단, 회사가 이용자로부터 개인정보 오류에 대한 정정을 요구를 받았을 때에도 아래의 경우에 한하여는 조치를 취하지 못 할 수 있습니다. 회사는 조치를 취하지 못하는 사유를 이용자에게 통지할 것입니다.<br>
                                - 이용자 본인 또는 제3자의 생명, 재산, 신체 또는 권익을 현저하게 해할 우려가 있는 경우<br>
                                - 회사의 업무에 현저한 지장을 미칠 우려가 있는 경우<br>
                                - 다른 법령을 위반하는 경우<br>
                                이 경우에도 회사는 오류에 대한 정정이 완료되기 전까지는 개인정보를 이용하거나 제공하지 않습니다.<br>
                                <br>
                                2) 개인정보 수집, 이용, 제공에 대한 동의철회<br>
                                회원 가입, 개인정보의 수집, 이용, 제공에 대해 이용자가 동의한 내용을 이용자는 언제든지 철회하실 수 있습니다. 회사는 이용자가 개인정보 동의 철회를 쉽게 할 수 있도록 여러 가지 조치를 하고 있습니다. 동의 철회는 회사 개인정보보호책임자 또는 고객센터에 서면, 전화, 이메일로 연락하시면 지체 없이 개인정보의 삭제 등 필요한 조치를 취하겠습니다. 회사는 이용자의 요청에 의해 해지 또는 삭제된 개인정보는 "개인정보 파기절차 및 방법”에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다. 또한 잘못된 개인정보를 제휴사에게 이미 제공한 경우에는 제휴사에 지체 없이 통지하여 개인정보 삭제 등 필요한 조치를 취하겠습니다.<br>
                                <br>
                                8. 개인정보 자동수집 장치의 설치, 운영 및 그 거부에 관한 사항<br>
                                1) 쿠키(Cookie)의 정의<br>
                                쿠키(Cookie)는 웹사이트를 운영하는데 이용되는 서버가 이용자의 컴퓨터로 전송하는 아주 작은 텍스트 파일로서 이용자의 컴퓨터 하드디스크에 저장되고 있습니다. 따라서 여러분 스스로가 쿠키의 설치 및 수집에 대해 자율적으로 선택할 수 있으므로 수집을 거부할 수 있습니다. 다만, 쿠키의 저장을 거부할 경우 로그인이 필요한 일부 서비스의 이용에 제한이 생길 수 있습니다.<br>
                                2) 쿠키 설정 거부 방법<br>
                                -Internet Explorer의 경우<br>
                                브라우저 상단의 "도구" 메뉴 > "인터넷 옵션" 메뉴 > "개인정보" 탭 > 직접설정<br>
                                - Chrome의 경우<br>
                                웹 브라우저 우측 상단의 "설정" 선택 > "설정" 화면 하단의 "고급" 설정 버튼 선택 > 개인정보 및 보안 섹션의 "콘텐츠 설정" 버튼 > "쿠키" 섹션에서 직접 설정<br>
                                <br>
                                9. 개인정보의 기술적, 관리적 보호 대책<br>
                                회사는 이용자의 개인정보를 처리함에 있어 개인정보가 분실, 도난, 유출, 변조 또는 훼손되지 않도록 안정성 확보를 위하여 다음과 같은 기술적, 관리적, 물리적 대책을 강구하고 있습니다.<br>
                                <br>
                                1) 기술적 대책<br>
                                ① 회사는 이용자의 개인정보를 취급함에 있어 개인정보가 분실, 도난, 누출, 변조 또는 훼손되지 않도록 안정성 확보를 위하여 다음과 같은 기술적 대책을 강구하고 있습니다.
                                ② 이용자의 개인정보는 비밀번호에 의해 보호되며, 파일 및 전송 데이터를 암호화 하고 있습니다.<br>
                                ③ 회사는 암호알고리즘을 이용하여 네트워크 상의 개인정보를 안전하게 전송할 수 있는 보안장치(SSL, VPN)를 채택하고 있습니다.<br>
                                ④ 해킹 등 외부 침입에 대비하여 각 서버마다 방화벽 등을 이용하여 보안에 만전을 기하고 있습니다.<br>
                                <br>
                                2) 관리적 대책<br>
                                ① 회사는 이용자의 개인정보에 대한 접근권한을 최소한의 인원으로 제한하고 있습니다.<br>
                                그 최소한의 인원에 해당하는 자는 다음과 같습니다.<br>
                                - 이용자를 직접 상대로 하여 마케팅 업무를 수행하는 자<br>
                                - 개인정보보호책임자 및 담당자 등 개인정보관리업무를 수행하는 자<br>
                                - 기타 업무상 개인정보의 취급이 불가피한 자<br>
                                ② 회사는 개인정보의 안전성 확보를 위해 내부관리계획을 수립하여 시행하며, 임직원 등에 대한 정기적인 교육을 시행하고 있습니다.<br>
                                <br>
                                3) 물리적 대책<br>
                                ① 회사는 개인정보를 보관할 수 있는 별도의 보관장소를 두고 있는 경우, 그 출입을 통제하고 있습니다.<br>
                                ② 회사는 개인정보가 포함된 서류, 보조저장매체 등이 있는 경우 잠금 장치를 하여 보관하고 있습니다.<br>
                                <br>
                                10. 개인정보에 관한 민원서비스<br>
                                회사는 고객의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 아래와 같이 관련 부서 및 개인정보관리책임자를 지정하고 있습니다.<br>
                                <br>
                                개인정보보호책임자 성명: 이루리 팀장<br>
                                소속 : 전략경영부문<br>
                                메일 : ruri85@jangs-food.com<br>
                                문의전화 : 02-6213-0196<br>
                                <br>
                                개인정보보호담당자 성명: 이영하 매니저<br>
                                소속 : 전략경영부문<br>
                                메일 : summer@jangs-food.com<br>
                                문의전화 : 02-6213-0141<br>
                                <br>
                                기타 개인정보침해에대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다<br>
                                <br>
                                기타개인정보침해에대한신고, 상담정보<br>
                                개인정보침해신고센터(국번없이)118http://privacy.kisa.or.kr<br>
                                대검찰청사이버수사과(국번없이)1301http://www.spo.go.kr<br>
                                경찰청사이버안전국(국번없이)182http://cyberbureau.police.go.kr<br>
                                개인정보분쟁조정위원회1833-6972http://www.kopico.go.kr<br>
                                <br>
                                11. 부칙<br>
                                시행일 : 이 약관은 2024년 03월 14일부터 시행합니다.<br>
                            </div>

                        </dd>
                    </dl>

                    <dl class="agree-row agree-v-con">
                        <dd data-for="reg_req3">
                            <input type="checkbox" name="reg_req[]" id="reg_req3" value="1">
                            <label for="reg_req3">위치기반 서비스 이용 동의 (필수)</label>
                        </dd>
                        <dd class="text-right"><input type="button" value="내용보기" class="btn btn-danger btn-agr"></dd>
                        <dd><textarea readonly>제1장 총칙

제1조 (목적) 본 약관은 이용자(위치기반 서비스 약관에 동의한 자를 말합니다. 이하 "이용자"라고 합니다)가 (주)장스푸드(이하 "회사"라고 합니.)가 제공하는 위치기반서비스(이하 "서비스"라고 합니다)를 이용함에 있어 회사와 이용자의 권리·의무 및 책임사항을 규정함을 목적으로 합니다.

제2조 (이용약관의 효력 및 변경) ① 본 약관은 서비스를 신청한 고객 또는 개인위치정보주체가 본 약관에 동의하고 회사가 정한 소정의 절차에 따라 서비스의 이용자로 등록함으로써 효력이 발생합니다. ② 이용자가 온라인에서 본 약관의 "동의하기" 버튼을 클릭하였을 경우 본 약관의 내용을 모두 읽고 이를 충분히 이해하였으며, 그 적용에 동의한 것으로 봅니다. ③ 회사는 위치정보의 보호 및 이용 등에 관한 법률, 콘텐츠산업 진흥법, 전자상거래 등에서의 소비자보호에 관한 법률, 소비자 기본법 약관의 규제에 관한 법률 등 관련법령을 위배하지 않는 범위에서 본 약관을 개정할 수 있습니다. ④ 회사가 약관을 개정할 경우에는 기존약관과 개정약관 및 개정약관의 적용일자와 개정사유를 명시하여 현행약관과 함께 그 적용일자 7일 전부터 적용일 이후 상당한 기간 동안 홈페이지 등에 사전 공지한다. ⑤ 회사가 전항에 따라 이용자에게 통지하면서 공지 또는 공지ᆞ고지일로부터 개정약관 시행일 7일 후까지 거부의사를 표시하지 아니하면 이용약관에 승인한 것으로 봅니다. 이용자가 개정약관에 동의하지 않을 경우 이용자는 이용계약을 해지할 수 있습니다.

제3조 (관계법령의 적용) 본 약관은 신의성실의 원칙에 따라 공정하게 적용하며, 본 약관에 명시되지 아니한 사항에 대하여는 관계법령 또는 상관례에 따릅니다.

제4조 (위치기반 서비스의 내용) 회사가 제공하는 위치기반서비스는 아래와 같습니다.
· 위치정보 수집대상의 실시간 위치확인
· 주변 매장 찾기 : 사용자의 현재 위치를 기반으로 주변 매장 위치 등의 정보를 제공

제5조 (서비스 이용요금) ① 회사가 제공하는 서비스는 기본적으로 무료입니다. 단, 별도의 유료 서비스의 경우 해당 서비스에 명시된 요금을 지불하여야 사용 가능합니다. ② 회사는 유료 서비스 이용요금을 회사와 계약한 전자지불업체에서 정한 방법에 의하거나 회사가 정한 청구서에 합산하여 청구할 수 있습니다. ③ 유료서비스 이용을 통하여 결제된 대금에 대한 취소 및 환불은 회사의 결제 이용약관 등 관계법에 따릅니다. ④ 이용자의 개인정보도용 및 결제사기로 인한 환불요청 또는 결제자의 개인정보 요구는 법률이 정한 경우 외에는 거절될 수 있습니다. ⑤ 무선 서비스 이용 시 발생하는 데이터 통신료는 별도이며 가입한 각 이동통신사의 정책에 따릅니다. ⑥ MMS 등으로 게시물을 등록할 경우 발생하는 요금은 이동통신사의 정책에 따릅니다.

제6조 (서비스내용변경 통지 등) ① 회사가 서비스 내용을 변경하거나 종료하는 경우 회사는 이용자의 등록된 전자우편 주소로 이메일을 통하여 서비스 내용의 변경 사항 또는 종료를 통지할 수 있습니다. ② 전항의 경우 불특정 다수인을 상대로 통지를 함에 있어서는 웹사이트 등 기타 회사의 공지사항을 통하여 이용자들에게 통지할 수 있습니다.

제7조 (서비스이용의 제한 및 중지) ① 회사는 아래에 해당하는 사유가 발생한 경우에는 이용자의 서비스 이용을 제한하거나 중지시킬 수 있습니다. 가. 이용자가 회사 서비스의 운영을 고의 또는 중과실로 방해하는 경우 나. 서비스용 설비 점검, 보수 또는 공사로 인하여 부득이한 경우 다. 전기통신사업법에 규정된 기간통신사업자가 전기통신 서비스를 중지했을 경우 라. 국가비상사태, 서비스 설비의 장애 또는 서비스 이용의 폭주 등으로 서비스 이용에 지장이 있는 때 마. 기타 중대한 사유로 인하여 회사가 서비스 제공을 지속하는 것이 부적당하다고 인정하는 경우 ② 회사는 전항의 규정에 의하여 서비스의 이용을 제한하거나 중지한 때에는 그 사유 및 제한기간 등을 이용자에게 알려야 합니다.

제8조 (개인위치정보의 이용·제공 및 보유근거·기간) ① 회사는 개인위치정보를 이용하여 서비스를 제공하고자 하는 경우에는 미리 이용약관에 명시한 후 개인위치정보주체의 동의를 얻어야 합니다. ② 이용자의 권리와 그 행사방법은 제소 당시의 이용자의 주소에 의하며, 주소가 없는 경우에는 거소를 관할하는 지방법원의 전속관할로 합니다. 다만, 제소 당시 이용자의 주소 또는 거소가 분명하지 않거나 외국 거주자의 경우에는 민사소송법상의 관할법원에 제기합니다. ③ 회사는 개인위치정보를 이용자가 지정하는 제3자에게 제공하는 경우에는 개인위치정보를 수집한 당해 통신 단말장치로 매회 이용자 에게 제공받는 자, 제공 일시 및 제공목적을 즉시 통보합니다.

제9조 (개인위치정보주체의 권리) ① 이용자는 회사에 대하여 언제든지 개인위치정보를 이용한 위치기반서비스 제공 및 개인위치정보의 제3자 제공에 대한 동의의 전부 또는 일부를 철회할 수 있습니다. 이 경우 회사는 수집한 개인위치정보 및 위치정보 이용, 제공사실 확인자료를 파기합니다. ② 이용자는 회사에 대하여 언제든지 개인위치정보의 수집, 이용 또는 제공의 일시적인 중지를 요구할 수 있으며, 회사는 이를 거절할 수 없고 이를 위한 기술적 수단을 갖추고 있습니다. ③ 이용자는 회사에 대하여 아래 각 호의 자료에 대한 열람 또는 고지를 요구할 수 있고, 당해 자료에 오류가 있는 경우에는 그 정정을 요구할 수 있습니다. 이 경우 회사는 정당한 사유 없이 이용자의 요구를 거절할 수 없습니다. 가. 본인에 대한 위치정보 수집, 이용, 제공사실 확인자료 나. 본인의 개인위치정보가 위치정보의 보호 및 이용 등에 관한 법률 또는 다른 법률 규정에 의하여 제3자에게 제공된 이유 및 내용 ④ 이용자는 제1항 내지 제3항의 권리행사를 위해 회사의 소정의 절차를 통해 요구할 수 있습니다.

제10조 (위치정보관리책임자의 지정) ① 회사는 위치정보를 적절히 관리·보호하고 개인위치정보주체의 불만을 원활히 처리할 수 있도록 실질적인 책임을 질 수 있는 지위에 있는 자를 위치정보관리책임자로 지정해 운영합니다. ② 위치정보관리책임자는 위치기반서비스를 제공하는 부서의 부서장으로서 구체적인 사항은 본 약관의 부칙에 따릅니다.

제11조 (손해배상) ① 회사가 위치정보의 보호 및 이용 등에 관한 법률 제15조 내지 제26조의 규정을 위반한 행위로 이용자에게 손해가 발생한 경우 이용자는 회사에 대하여 손해배상 청구를 할 수 있습니다. 이경우 회사는 고의, 과실이 없음을 입증하지 못하는 경우 책임을 면할 수 없습니다. ② 이용자가 본 약관의 규정을 위반하여 회사에 손해가 발생한 경우 회사는 이용자에 대하여 손해배상을 청구할 수 있습니다. 이 경우 이용자는 고의, 과실이 없음을 입증하지 못하는 경우 책임을 면할 수 없습니다. ③ 전항에도 불구하고 천재지변, 전쟁 등과 같은 불가항력의 상태가 있는 경우 발생한 손해에 대해서는 책임을 부담하지 않습니다.

제12조 (규정의 준용) ① 본 약관은 대한민국법령에 의하여 규정되고 이행됩니다. ② 본 약관에 규정되지 않은 사항에 대해서는 관련법령 및 상관습에 의합니다.

제13조 (분쟁의 조정 및 기타) ① 회사는 위치정보와 관련된 분쟁에 대해 당사자간 협의가 이루어지지 아니하거나 협의를 할 수 없는 경우에는 위치정보의 보호 및 이용 등에 관한 법률 제28조의 규정에 의한 방송통신 위원회에 재정을 신청할 수 있습니다. ② 회사 또는 고객은 위치정보와 관련된 분쟁에 대해 당사자간 협의가 이루어지지 아니하거나 협의를 할 수 없는 경우에는 개인정보보호법 제43조의 규정에 의한 개인정보분쟁조정위원회에 조정을 신청할 수 있습니다.

제14조 (회사 정보 및 위치정보 관리책임자)
회사의 상호 및 주소는 다음과 같습니다.
상호 : (주)장스푸드
주소 : 서울시 서초구 매헌로 40
문의전화 : 02-6213-0196

회사는 다음과 같이 위치정보 관리책임자를 지정하여 이용자들이 서비스 이용과정에서 발생한 민원사항 처리를 비롯하여 개인위치정보주체의 권리 보호를 위해 힘쓰고 있습니다.

위치정보 관리책임자 : 이루리 팀장 (개인정보 보호책임자 겸직)
메일 : ruri85@jangs-food.com
문의전화 : 02-6213-0196

부 칙

제1조 (시행일) 이 약관은 2024년 03월 14일부터 시행합니다.
</textarea></dd>
                    </dl>

                </div>
            <?php } ?>

            <div class="btn_flex">
                <input type="submit" class="btn btn-danger btn-submit btn-large" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" accesskey="s">
                <a href="<?=G5_URL?>/bbs/member_confirm.php?url=<?=G5_URL?>/bbs/member_leave.php" class="btn btn-large">회원탈퇴</a>
            </div>
        </article>
    <?}?>
	

    </form>
</div>


<script>
$(function (){
	// 아이디 체크
	
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var reg_mb_id = $(this);

		// 아이디 정규표현식
		var regId = /^[a-z0-9]{4,12}$/;
		
		if (regId.test(mb_id)){ 
			$(this).closest("dl").find("i").css("color", "#1EC545");
			$(this).closest("dl").find("dd:last-child").html("");
		}else{
			$(this).closest("dl").find("i").css("color", "#FF4040");
			$(this).closest("dl").find("dd:last-child").css("color", "#FF4040").html("아이디는 영문과 숫자, 4 ~ 12자리까지 가능합니다.");
			
			return false;
		}
		
		// 아작스로 중복 아이디가 있는지 체크 1
		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type":"mb_id", "val":mb_id}, function (result){
			if(result == "0"){  // ajax.mb_register.php 의 echo $row['cnt']; 값을 가져옴
				reg_mb_id.closest("dl").find("i").css("color", "#1EC545"); //될때 초록색 박스 i 는 icon 의 약자
				reg_mb_id.closest("dl").find("dd:last-child").html(""); // 마지막 dd 의 css 스타일 사용
			}else{
				reg_mb_id.closest("dl").find("i").css("color", "#FF4040");
				reg_mb_id.closest("dl").find("dd:last-child").css("color", "#FF4040").html("사용중인 아이디입니다.");
			}
		});
	});

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this).val();
		var reg_mb_password = $(this);

		// 바뀌면 무조건 틀렸다로 표시.
		if($("#reg_mb_password_re").val() != mb_password){
			$("#reg_mb_password_re").closest("dl").find("i").css("color", "#FF4040");
			$("#reg_mb_password_re").closest("dl").find("dd:last-child").css("color", "#FF4040").html("비밀번호가 다릅니다.");
		}else{
			$("#reg_mb_password_re").closest("dl").find("i").css("color", "#1EC545");
			$("#reg_mb_password_re").closest("dl").find("dd:last-child").html("");
		}

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if (regPassword.test(mb_password)){ 
			$(this).closest("dl").find("i").css("color", "#1EC545");
			$(this).closest("dl").find("dd:last-child").html("");
		}else{
			$(this).closest("dl").find("i").css("color", "#FF4040");
			$(this).closest("dl").find("dd:last-child").css("color", "#FF4040").html("비밀번호는 8자~15자 영문,숫자,특수문자가 포함 되어야 합니다.");
		}
	});

	$("#reg_mb_password_re").keyup(function (){
		var mb_password_re = $(this).val();
		var mb_password = $("#reg_mb_password").val();

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if(mb_password == mb_password_re){
			$(this).closest("dl").find("i").css("color", "#1EC545");
			$(this).closest("dl").find("dd:last-child").html("");
		}else{
			$(this).closest("dl").find("i").css("color", "#FF4040");
			$(this).closest("dl").find("dd:last-child").css("color", "#FF4040").html("비밀번호가 다릅니다.");
		}
	});


	$("#reg_mb_name").keyup(function (){
		var mb_name = $(this).val();
		var reg_mb_name = $(this);

		// 이름 정규표현식
		var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

		if (regName.test(mb_name)){ 
			$(this).closest("dl").find("i").css("color", "#1EC545");
			$(this).closest("dl").find("dd:last-child").html("");
		}else{
			$(this).closest("dl").find("i").css("color", "#FF4040");
			$(this).closest("dl").find("dd:last-child").css("color", "#FF4040").html("2글자 이상 한글만 입력해주세요.");
		}
	});

	$("#reg_mb_hp").keyup(function (){
		var mb_hp = $(this).val();
		var reg_mb_hp = $(this);

		// 휴대폰 정규표현식
		// /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
		var regHp = /^\d{10,12}$/;

		if (regHp.test(mb_hp)){
			$(this).closest("dl").find("i").css("color", "#1EC545");
			$(this).closest("dl").find("dd:last-child").html("");
		}else{
			$(this).closest("dl").find("i").css("color", "#FF4040");
			$(this).closest("dl").find("dd:last-child").css("color", "#FF4040").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력하세요.");
		}
	});

/*	$("#reg_mb_nick").keyup(function (){
		var mb_nick = $(this).val();
		var reg_mb_nick = $(this);

		// 닉네임 정규표현식
		var regNick = /^[\w\Wㄱ-ㅎㅏ-ㅣ가-힣]{2,20}$/;
		
		if (regNick.test(mb_nick)){ 
			$(this).closest("dl").find("i").css("color", "#1EC545");
			$(this).closest("dl").find("dd:last-child").html("");
		}else{
			$(this).closest("dl").find("i").css("color", "#FF4040");
			$(this).closest("dl").find("dd:last-child").css("color", "#FF4040").html("2글자 이상 입력해주세요.")
			return false;
		}

		$.post(g5_bbs_url+"/ajax.mb_register.php", {"type2":"mb_nick", "val2":mb_nick}, function (result){
			if(result == "0"){  
				reg_mb_nick.closest("dl").find("i").css("color", "#1EC545");
				reg_mb_nick.closest("dl").find("dd:last-child").html("");
			}else{
				reg_mb_nick.closest("dl").find("i").css("color", "#FF4040");
				reg_mb_nick.closest("dl").find("dd:last-child").css("color", "#FF4040").html("사용중인 닉네임 입니다.");
			}
		});
	});*/
	
	$("#reg_mb_email").keyup(function (){
		var mb_email = $(this).val();
		var reg_mb_email = $(this);

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).closest("dl").find("i").css("color", "#1EC545");
			$(this).closest("dl").find("dd:last-child").html("");
		}else{
			$(this).closest("dl").find("i").css("color", "#FF4040");
			$(this).closest("dl").find("dd:last-child").css("color", "#FF4040").html("올바른 E-mail 형식으로 입력해주십시오.")
			return false;
		}
	});
	
	$("#reg_mb_level").click(function (){
		var mb_level = $(this).val();
		var reg_mb_level = $(this);

		// 이메일 정규표현식

		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		
		if (regEmail.test(mb_email)){ 
			$(this).closest("dl").find("i").css("color", "#1EC545");
			$(this).closest("dl").find("dd:last-child").html("");
		}else{
			$(this).closest("dl").find("i").css("color", "#FF4040");
			$(this).closest("dl").find("dd:last-child").css("color", "#FF4040").html("올바른 E-mail 형식으로 입력해주십시오.")
			return false;
		}
	});
	
	// 라디오 버튼
	$("#dd_type p").click(function (){
		var v = $(this).data("val");
		$("#mb_type").val(v);
		$("#dd_type p").find("i").removeClass("fa-check-o").addClass("fa-o");
		$(this).find("i").removeClass("fa-o").addClass("fa-check-o");
	});

	// 내용보기 
	$(".btn-agr").click(function (){
		var dis = $(this).parents(".agree-v-con").find("dd:last-child").css("display");
		if(dis == "none")
			$(this).parents(".agree-v-con").find("dd:last-child").slideDown(100);
		else
			$(this).parents(".agree-v-con").find("dd:last-child").slideUp(100);
	});
	// 약관동의
	
	$(".agree-row dd:first-child").click(function (){
		var ford = $(this).data("for");
		var targ = $("#" + ford);
		
		if(targ.val() == "1"){
			targ.val("");
			$(this).find("i").removeClass("fa-check-square").addClass("fa-square-o");
		}else{
			targ.val("1");
			$(this).find("i").removeClass("fa-square-o").addClass("fa-check-square");
		}
	});
});

function only_number(num){
	num = num + "";
	num = num.replace(/[^0-9]/gi, "");
	return num;
}

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 필수 체크박스
	// 조건들 확인
	
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == '') {
		if (f.mb_password.value.length < 3) {
			alert('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert('비밀번호가 같지 않습니다.');
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert('비밀번호를 3글자 이상 입력하십시오.');
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=='') {
		if (f.mb_name.value.length < 1) {
			alert('이름을 입력하십시오.');
			f.mb_name.focus();
			return false;
		}
	}

/*	// 닉네임 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	}*/

	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}



	<?php if($w == ""){ ?>
        if(!$("#reg_req1").prop('checked')){
            alert("이용약관 동의(필수)를 체크하십시오");
            return false;
        }
        if(!$("#reg_req2").prop('checked')){
            alert("개인정보처리방침 동의(필수)를 체크하십시오");
            return false;
        }

        if(!$("#reg_req3").prop('checked')){
            alert("위치기반 서비스 이용 동의(필수)를 체크하십시오");
            return false;
        }
	<?php } ?>


    return true;
}

$('#reg_chk1').change(function() {
    var isChecked = $(this).is(':checked');
    $('#reg_req1, #reg_req2, #reg_req3').prop('checked', isChecked);
});

// reg_req1, reg_req2, reg_req3 체크 상태에 따라 reg_chk1 체크/체크 해제
$('#reg_req1, #reg_req2, #reg_req3').change(function() {
    var allChecked = $('#reg_req1').is(':checked') && $('#reg_req2').is(':checked') && $('#reg_req3').is(':checked');
    $('#reg_chk1').prop('checked', allChecked);
});
</script>