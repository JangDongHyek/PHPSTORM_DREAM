<?
include_once("./_common.php");

/* 240611 승인기능없이 미리 작성되는게 승인역활함 wc
if($member['mb_contract'] != 'Y' && !$is_admin){
    alert('계약서 작성승인을 기다려주세요.',G5_URL);
}
*/
$pop = $_GET['pop'];
if ($w == 'u') {
    $mb_id = $_REQUEST['mb_id'];
    if ($mb_id != $member['mb_id'] && !$is_admin) {
        alert('자기자신의 계약서만 볼수있습니다.', G5_URL);
    }
    $mb = get_member($mb_id);
    if (!$mb) {
        alert('해당맴버가 없습니다.', G5_URL);
    }
    $sql = "select count(*) as cnt from g5_member_contract where mb_id = '{$mb_id}' and use_yn <> 'N'";
    $contract_row_cnt = sql_fetch($sql)['cnt'];

    if ($contract_row_cnt) {
        $sql = "select * from g5_member_contract where mb_id = '{$mb_id}' and use_yn <> 'N' order by co_no desc limit 1";
        $contract_row = sql_fetch($sql);
    } else {
        if (!$is_admin) {
            alert('계약서 작성승인을 기다려주세요. \n관리자가 선 작성중입니다. ', G5_URL);
        }
    }

} else {
    $mb_id = $_REQUEST['mb_id'];

    if (!$mb_id) {
        $mb_id = $member['mb_id'];
    }
    $mb = get_member($mb_id);
    $sql = "select count(*) as cnt from g5_member_contract where mb_id = '{$mb_id}' and use_yn <> 'N'";
    $contract_row_cnt = sql_fetch($sql)['cnt'];
    if (!$is_admin) {
        if ($contract_row_cnt) {
            alert('작성중인 계약서가 있습니다.', G5_BBS_URL . '/contract_form.php?w=u&mb_id=' . $mb_id);
        } else {
            alert('계약서 작성승인을 기다려주세요. \n관리자가 선 작성중입니다. ', G5_URL);
        }
    }
}

$g5['title'] = '회원가입 계약서 작성';
include_once('./_head.php');
?>
<!-- pdf 라이브러리 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<!-- pdf 끝 -->

<!-- 서명 라이브러리 -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<style>
    .admin_only {
        pointer-events: none;
    }



    body {
        background: #F6F6F6;
    }

    .mbskin {
        background: #fff;
        margin: 100px auto !important;
    }

    #mem_chk {
        border-top: none !important;
    }

    .sign_wrapper {
        position: relative;
        width: 226px !important;
        height: 130px !important;;
        border: 1px solid #000;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .sign_wrapper img {
        position: absolute;
        width: 224px !important;;
        height: 128px !important;;
        left: 0;
        top: 0;
        z-index: 1;
        opacity: 0.3;
        pointer-events: none;
    }

    .sign_pad {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background-color: white;
    }

    .sign_wrapper canvas {
        width: 100%;
        height: 100%;
    }

    .sign_clear {
        position: absolute;
        right: 0;
        top: 0;
        border: none;
        font-size: 12px;
        padding: 7px;
        line-height: 1em;
    }

    .contract_wrap > div {
        padding: 55px 50px 10px !important
    }

    .contract_wrap .ver2 .matching p:last-child input[type=text] {
        width: 200px
    }

    <?php if($pop){ ?>
    body {
        background-color: white
    }

    #scont_wrap2 {
        padding: 10px
    }

    #svisual {
        display: none;
        opacity: 0;
        visibility: hidden
    }

    #sub_title {
        display: none;
        opacity: 0;
        visibility: hidden
    }

    #hd_wrapper {
        display: none;
        opacity: 0;
        visibility: hidden
    }

    #footer {
        display: none;
        opacity: 0;
        visibility: hidden
    }

    #hd {
        display: none;
        opacity: 0;
        visibility: hidden
    }

    <?php } ?>
</style>
<!-- 서명 끝 -->

<!--회원가입 계약서 작성-->
<div class="contract" id="pdfArea">
    <div class="contract_wrap">

        <div class="titleArea">
            <p><?php echo $config['cf_title']; ?></p>
            <h1>국내 결혼 중개 마리엔 회원가입 계약서</h1>
        </div>

        <form id="contractform" name="contractform" action="<?= G5_BBS_URL ?>/contract_update.php"
              onsubmit="return contractform_submit(this);" method="post" enctype="multipart/form-data"
              autocomplete="off">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="mb_id" value="<?= $mb['mb_id'] ?>" readonly>

            <div class="form">
                <div class="box_red" style="display:none">
                    <i class="fa-duotone fa-circle-exclamation"></i> 허위 정보 입력으로 인하여 발생하는 모든 민/형사상 책임은 본인에게 있음에 동의합니다.
                </div>
                <br>
                <div class="grid grid2">
                    <div class="form_wrap">
                        <h3>甲(가입자)</h3>
                        <div class="grid grid2">
                            <dl class="grid grid2">
                                <?php if ($w == 'u'){ ?>
                                <dt>회원성명</dt>
                                <dd><?= $contract_row['mb_name'] ?></dd>
                                <dt>생년월일</dt>
                                <dd><?= $contract_row['mb_birth'] ?></dd>
                                <dt>휴대폰번호</dt>
                                <dd><p class="flex ai-c">
                                        <input type="tel" id="mb_tel" name="mb_tel" value="<?= $contract_row['mb_tel'] ?>">
                                        <?php if (!$contract_row['contract_sign_2']) { ?>
                                            <button type="button" class="serti_btn" onclick="serti_sms()" id="serti_btn">인증</button>
                                            <button type="button" class="serti_btn" style="display: none;" id="serti_btn_ok">완료</button>
                                        <?php } ?>
                                        <div class="serti_no" id="serti_block">
                                            <div class="serti_phoneBox">
                                                <input type="text" id='serti' name="serti"
                                                       onKeyup="this.value=this.value.replace(/[^0-9]/g,'');serti_check();" onkeydown="serti_check()" onblur="serti_check()" value="" maxlength="4"
                                                       class="serti_phone" placeholder="인증번호">
                                                <span class="serti_phoneRight" id="serti_text"></span>
                                            </div>
                                            <p class="serti_tip serti_no" id="serti_tip" style="display:none"></p>
                                        </div>
                                <?php }else{ ?>
                                <dt>회원성명</dt>
                                <dd><input type="text" name="mb_name" value="<?= $mb['mb_name'] ?>" readonly></dd>
                                <dt>생년월일</dt>
                                <dd><input type="date" name="mb_birth"
                                           value="<?= date('Y-m-d', strtotime($mb['mb_birth'])) ?>" readonly></dd>
                                <dt>휴대폰번호</dt>
                                <dd><p class="flex ai-c"><input type="tel" id="mb_tel" name="mb_tel" value="<?= $mb['mb_tel'] ?>">
                                        <?php } ?>
                            </dl>




                            <!-- 본인인증 관련 -->
                            <style media="screen">
                                #serti_block {
                                    display: none;
                                    height: auto;
                                    margin: 0 auto;
                                }

                                .serti_title {
                                    margin: 19px 0 8px;
                                    font-size: 22px;
                                    font-weight: 700;
                                }

                                .serti_phoneBlock {
                                    position: relative;
                                    margin-top: 10px;
                                    padding: 0 125px 0 0;
                                    height: 51px;
                                }

                                .serti_phone {
                                    display: block;
                                    position: relative;
                                    width: 132px;
                                    padding: 5px;
                                    outline: 0;
                                    border: 1px solid #dadada;
                                    background: #fff;
                                    box-sizing: border-box;
                                    z-index: 10;
                                }

                                .serti_phone:focus {
                                    border: 1px solid #000
                                }

                                .serti_phoneBox {
                                    position: relative;
                                    width: 100%;
                                    margin-top: 10px;
                                    border: 1px solid #ff3061;
                                    border-radius: 4px;
                                }

                                .serti_btn {
                                    width: 50px;
                                    height: 40px;
                                    padding: 7px;
                                    border: 0;
                                    text-align: center;
                                    background: #000;
                                    color: #fff;
                                    cursor: pointer;
                                }

                                .serti_phoneRight {
                                    position: absolute;
                                    display: inline-block;
                                    top: 0px;
                                    right: 10px;
                                    background: 0 0;
                                    z-index: 10;
                                    line-height: 26px;
                                    display: inline-block;
                                    top: 50%;
                                    transform: translateY(-50%);
                                    text-align: right;
                                }

                                .serti_no .serti_phone {
                                    border: 0;
                                }

                                .serti_ok .serti_phone {
                                    border: 1px solid #08a600
                                }

                                .serti_no .serti_phoneRight {
                                    color: #ff3061
                                }

                                .serti_ok .serti_phoneRight {
                                    color: #08a600
                                }

                                .serti_no .serti_phoneRight:after {
                                    background: url(./img/common/input_x.png) no-repeat 0 0;
                                    background-size: 15px 15px;
                                }

                                .serti_ok .serti_phoneRight:after {
                                    background: url(./img/common/input_v.png) no-repeat 0 0;
                                    background-size: 15px 15px;
                                }

                                .serti_phoneRight:after {
                                    content: '';
                                    display: inline-block;
                                    width: 15px;
                                    height: 15px;
                                    margin-left: 4px;
                                    margin-top: -3px;
                                    vertical-align: middle;
                                }

                                .serti_tip {
                                    display: block;
                                    margin: 9px 0 -2px;
                                    font-size: 12px;
                                    line-height: 14px;
                                }

                                .serti_tip.serti_no {
                                    color: #ff3061;
                                }

                                .serti_tip.serti_ok {
                                    color: #08a600;
                                }
                                input#mb_tel{width:177px; }
                            </style>


                            <script type="text/javascript">
                                var serti_num;
                                var serti_phone;
                                var serti_result = false;
                                var company = '마리엔';
                                var serti_count = 0;

                                function serti_sms() {
                                    if (serti_count >= 2) {
                                        alert('인증번호 발송 초과');
                                        return false;
                                    }
                                    //array 파싱해서 저장
                                    serti_phone = $('#mb_tel').val().replaceAll('-', '');

                                    if (!serti_phone) {
                                        alert('연락처를 입력 후 인증을 해주세요.');
                                        return false;
                                    }

                                    $.ajax({
                                        cache: false,
                                        url: "<?php echo G5_BBS_URL ?>/ajax.get_certy_sms.php", // 요기에
                                        type: 'POST',
                                        data: {phone: serti_phone, company: company},
                                        success: function (data) {
                                            //console.log(data);
                                            alert('인증번호가 발송되었습니다.');
                                            serti_num = data.substring(6, 10);
                                            $('#serti').val('');
                                            $('#serti_block').show();
                                            serti_count++;
                                        },
                                    }); // $.ajax */
                                }

                                function serti_check(){
                                    var inputVal = $('#serti').val();
                                    if (serti_num == inputVal) {
                                        $('#serti_block').removeClass('serti_no');
                                        $('#serti_block').addClass('serti_ok');
                                        $('#serti_tip').removeClass('serti_no');
                                        $('#serti_tip').show();
                                        $('#serti_tip').addClass('serti_ok');
                                        $('#serti_tip').text('인증되었습니다.');
                                        $('#serti_text').text('일치');
                                        $('#serti_btn_ok').show();
                                        $('#serti_btn').hide();
                                        $('#serti_block').hide();
                                        $("#campaign_mb_hp").prop('readonly', true);

                                        serti_result = true;
                                    } else {
                                        $('#serti_block').removeClass('serti_ok');
                                        $('#serti_block').addClass('serti_no');
                                        $('#serti_tip').removeClass('serti_ok');
                                        $('#serti_tip').show();
                                        $('#serti_tip').addClass('serti_no');
                                        $('#serti_tip').text('인증번호를 다시 확인해주세요.');
                                        $('#serti_text').text('불일치');

                                        serti_result = false;
                                    }
                                }

                                $('.mb_hp').keydown(function (event) {
                                    var key = event.charCode || event.keyCode || 0;
                                    $text = $(this);
                                    if (key !== 8 && key !== 9) {
                                        if ($text.val().length === 3) {
                                            $text.val($text.val() + '-');
                                        }
                                        if ($text.val().length === 8) {
                                            $text.val($text.val() + '-');
                                        }
                                    }
                                    return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
                                    // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
                                    // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
                                });

                            </script>
                            <!-- 본인인증 끝 -->
                            <dl>
                                <?php if ($contract_row['contract_sign']) { ?>
                                    <dt>서명</dt>
                                    <dd class="sign_wrapper">
                                        <?= $contract_row['contract_sign'] ?>
                                        <canvas class="sign_pad" id="canvas1" style="display: none"></canvas>
                                    </dd>
                                <?php } else { ?>
                                    <dt>서명</dt>
                                    <dd class="sign_wrapper">
                                        <canvas class="sign_pad" id="canvas1"></canvas>
                                        <button class="sign_clear" type="button"
                                                onclick="sign_clear(signaturePad1,'sign_1');">지움
                                        </button>
                                        <input type="text" id="sign_1" name="contract_sign">
                                    </dd>
                                <?php } ?>
                            </dl>
                        </div>
                    </div>
                    <div class="form_wrap">
                        <h3>乙(사업자)</h3>
                        <dl class="grid grid2">
                            <dt>상호</dt>
                            <dd><strong><?php echo $config['cf_title']; ?></strong>(사업자등록번호 : 370-33-01298)</dd>
                            <dt>사업장 주소</dt>
                            <dd>부산광역시 해운대구 해운대로 794, 1403호(좌동,엘리움)</dd>
                            <dt>국내결혼신고번호</dt>
                            <dd>부산-해운—국내-24-0001호</dd>
                            <dt>대표자 성명</dt>
                            <dd class="flex ai-c">진호근 <span class="a_sign">(서명)</span></dd>
                        </dl>
                    </div>
                </div>
                <div class="sign">
                    <p>갑과 을간의 회원가입계약을 다음과 같이 체결합니다.</p>

                    <?php if ($w == 'u') { ?>
                        <div class="flex ai-c jc-c">계약일
                            <?= $contract_row['contract_datetime'] ?>
                            <br class="hidden-md visible-xs">담당매니저
                            <?= $contract_row['contract_manager'] ?>
                        </div>

                    <?php } else { ?>
                        <div class="flex ai-c jc-c">계약일
                            <input type="date" name="contract_datetime" value="<?= date('Y-m-d') ?>">
                        </div>

                    <?php } ?>

                </div>

                <div class="info">
                    <!--재작업-->
                    <div class="box_white ver2">
                        <dl class="prepaid <?= $is_admin ? '' : 'admin_only' ?>">
                            <dt>가입형태</dt>
                            <dd>
                                <p>
                                    <input type="checkbox" id="prepaid1" name="membershipType"
                                           value="prepaid" <?= ($contract_row['prepaidAmount1']) ? 'checked' : '' ?>>
                                    <label for="prepaid1">선불제</label>
                                </p>
                                <p>가입금액 <input type="text" id="prepaidAmount1" name="prepaidAmount1" class="won"
                                               value="<?= number_format($contract_row['prepaidAmount1']) ?>">원</p>
                            </dd>
                            <dd>
                                <p>
                                    <input type="checkbox" id="postpaid1" name="membershipType"
                                           value="postpaid" <?= ($contract_row['postpaidAmount1']) ? 'checked' : '' ?>>
                                    <label for="postpaid1">후불제</label>
                                </p>
                                <p>가입금액 <input type="text" id="postpaidAmount1" name="postpaidAmount1" class="won"
                                               value="<?= number_format($contract_row['postpaidAmount1']) ?>">원</p>
                            </dd>
                        </dl>

                        <dl class="matching <?= $is_admin ? '' : 'admin_only' ?>">
                            <dt>
                                매칭방법
                                <div style="font-size:0.8em">환불규정은 기본 매칭 횟수를 적용합니다. 제안매칭은 서비스 매칭입니다. <br />
                                <div style="color:#FF0000;">이 계약의 매칭서비스 기간은 가입일로부터 1년입니다.</div></div>
                            </dt>
                            <dd>
                                <p>
                                    <input type="checkbox" id="basicMatching" name="basicMatching"
                                           value="basic" <?= ($contract_row['basicMatchingCount']) ? 'checked' : '' ?>>
                                    <label for="basicMatching">기본매칭 (상대프로필과 사진제공, 미팅에 동의한 매칭)</label>
                                </p>
                                <p>
                                    <input type="text" id="basicMatchingCount" name="basicMatchingCount"
                                           value="<?= ($contract_row['basicMatchingCount']) ?>">회
                                </p>
                            </dd>
                            <dd>
                                <p>
                                    <input type="checkbox" id="suggestedMatching" name="suggestedMatching"
                                           value="suggested" <?= ($contract_row['suggestedMatchingCount']) ? 'checked' : '' ?>>
                                    <label for="suggestedMatching">제안매칭 (상대프로필 제공, 사진 미제공, 커플매니저의 추천 수용) </label>
                                </p>
                                <p>
                                    <input type="text" id="suggestedMatchingCount" name="suggestedMatchingCount"
                                           value="<?= ($contract_row['suggestedMatchingCount']) ?>">회
                                </p>
                            </dd>
                            <dd>
                                <p>
                                    <input type="checkbox" id="perMatchFeeMatching" name="matchingMethod"
                                           value="perMatchFee" <?= ($contract_row['perMatchFeeMatchingCount']) ? 'checked' : '' ?>>
                                    <label for="perMatchFeeMatching">회당매칭비(기본매칭과 제안매칭이 완료된 후 추가 매칭을 원할 때 1회당
                                        매칭비용) </label>
                                </p>
                                <p>
                                    <input type="text" id="perMatchFeeMatchingCount" name="perMatchFeeMatchingCount"
                                           class="won"
                                           value="<?= number_format($contract_row['perMatchFeeMatchingCount']) ?>">원
                                </p>
                            </dd>
                        </dl>
                        <dl class="<?= $is_admin ? '' : 'admin_only' ?> flex">
                            <dt>성혼사례금 <!--(성혼시 상대 직업군에 해당되는 금액을 1회한 입금한다)--></dt>
                            <dd><input type="text" id="matchingPrice1" name="matchingPrice1" class="won"
                                                   value="<?= number_format($contract_row['matchingPrice1']) ?>">원</dd>
                            <!--<dd>일반직과 성혼시 <p><input type="text" id="matchingPrice1" name="matchingPrice1" class="won"
                                                   value="<?= number_format($contract_row['matchingPrice1']) ?>">원</p>
                            </dd>
                            <dd>전문직과 성혼시 <p><input type="text" id="matchingPrice2" name="matchingPrice2" class="won"
                                                   value="<?/*= number_format($contract_row['matchingPrice2']) */?>">원</p>
                            </dd>
                            <dd>재력가와 결혼시 <p><input type="text" id="matchingPrice3" name="matchingPrice3" class="won"
                                                   value="<?/*= number_format($contract_row['matchingPrice3']) */?>">원</p>
                            </dd>-->
                        </dl>
                        <dl>
                            <dt>특약사항</dt>
                            <dd>
                                <?php if($contract_row['contract_sign_2']){ ?>
                                    <div style="white-space:pre;"><?= $contract_row['contrack_text'] ?></div>
                                <?php }else{ ?>
                                <textarea name="contrack_text"
                                          value="<?= $contract_row['contrack_text'] ?>"><?= $contract_row['contrack_text'] ?></textarea>
                                <?php } ?>
                            </dd>
                        </dl>
                        <div class="box_gray">
                            성혼사례금은 회사의 만남주선에 의하여 성혼(결혼식, 동거, 사실혼, 혼인신고)이 되면 7일 이내에 알리고 지불합니다.<br/> (제휴업체 회원과의 성혼도 포함되며,
                            위 성혼을 알리지 않거나 성혼사례금을 지불하지 아니하면, 그 2배를 지급하여야 합니다.)
                            <input type="checkbox" id="check_4">
                        </div>
                        <br>

                        <div>
                            3. 계약해지 시 회원가입비는 「소비자분쟁해결기준」 (결혼중개업, 공정거래위원회고시)에 따라 환급합니다.
                            <div class="table">
                                <table>
                                    <tbody>
                                    <tr>
                                        <th style="font-size:1.1em; color:#FF0000">사업자(을)의 책임 있는 사유로 계약해제 및 해지 시 환급기준</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>1. 회원가입계약 성립 후 정보(프로필) 제공 전에 해지된 경우: 가입비 환급 및 가입비의 10% 배상<br /> 
                                          2. 정보(프로필) 제공 후
                                          만남일자 확정 전에 해지된 경우: 가입비 환급 및 가입비의 15% 배상<br />
                                          3. 만남일자 확정 후에 해지된 경우: 가입비 환급 및 가입비의 20% 배상<br />
                                          4. 1회 만남 후 해지된 경우: <br />
                                          (횟수제) 가입비*(잔여 횟수/총횟수)+가입비의 20% 환급 <br />
                                          (기간제) 가입비* (잔여
                                          일수/총일수)+가입비의 20% 환급</strong> </td>
                                    <tr>
                                        <th style="font-size:1.1em; color:#FF0000">사업자(을)의 책임 없는 사유로 계약해제 및 해지시 환급기준
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>1. 회원가입계약 성립 후 정보(프로필) 제공 전에 해지된 경우: 가입비의 90% 환급<br />
                                          2. 정보(프로필) 제공 후 만남일자 확정 전에
                                          해지된 경우: 가입비의 85% 환급<br />
                                          3. 만남일자 확정 후에 해지된 경우: 가입비의 80% 환급<br />
                                          4. 1회 만남 후 해지된 경우: <br />
                                          (횟수제) 가입비의 80%* (잔여횟수/총횟수) 환급 <br />
                                          (기간제) 가입비의 80%* (잔여일수/총일수)
                                          환급 </strong></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            4. 기타 본 계약서에서 정하지 않은 사항은 「국내결혼중개 표준약관에 의합니다.<br>
                            5. 갑은 회원약관을 이해하고 확인하였습니다. <input type="checkbox" id="check_5">&nbsp;<a class="btn btn_black"
                                                                                                   data-toggle="modal"
                                                                                                   data-target="#agreeModal"><strong>회원약관보기</strong></a>
                            <br>

                            6. 매칭회원소개는 회원의 성공적인 결혼을 위해 협력사의 회원을 추천받아 매칭할 수 있습니다. 이에 동의 합니다. <input type="checkbox"
                                                                                                   id="check_6"><br>
                            7. 갑은 을에게 회원 본인 여부 및 결혼여부를 확인하기 위하여 가족관계증명서 및 혼인관계증명서, 졸업증명서등 제반 서류를 발급 및 확인 할 수 있는 권리를
                            위임합니다. <input type="checkbox" id="check_7" onclick="agent_toggle()">
                            <br>
                            <p class="box">
                                <a class="btn btn_black" href="<?php echo G5_URL ?>/down/위임장.hwp"><strong><i
                                                class="fa-light fa-arrow-down-to-bracket"></i> 위임장 다운로드</strong></a>
                                <span>※ 위임장 다운로드 및 작성 후, <a href="https://pf.kakao.com/_jcbeG" target="_blank"
                                                            class="kakak_ch">카카오 채널 <i><img
                                                    src="<?php echo G5_THEME_IMG_URL; ?>/common/kakao_ch.svg"></i></a> 친구 추가 후 위임장을 보내주시기 바랍니다.</span>
                            </p>

                            8. 회원 소개 이후에 회원간의 개인적인 만남을 통한 금전적인 거래 등 각종 문제발생 시 을은 책임이 전혀 없습니다. <input
                                    type="checkbox" id="check_8"><br>
                            <strong>9. 갑은 올로부터 본 계약서의 내용을 충분히 설명들었으며, 계약서 사본을 교부받았음을 확인합니다.</strong> <input
                                    type="checkbox" id="check_9">

                        </div>
                        <br>
                        <br>
                        <dl class="agent">
                            <dt><i class="fa-duotone fa-feather-pointed"></i> 부모와 지인이 대신 계약을 진행하는 경우에 작성해 주세요.</dt>
                            <dd><p>계약자(신청인)는 회원
                                    <strong><?php if ($w == 'u') { ?><?= $contract_row['mb_name'] ?><?php } else { ?>
                                            <input type="text" name="mb_name" value="<?= $mb['mb_name'] ?>"
                                                   readonly><?php } ?></strong>님의 동의를 얻어 이 계약이 진행됨을 확인하고 향후 개인정보 보호법등 관련
                                    모든 책임을 대신할 것을 서약합니다.</p></dd>
                            <dd>
                                <div class="grid">
                                    <?php if ($contract_row['mb_name']) { ?>
                                        <p>회원성명</p><p><?= $contract_row['mb_name'] ?></p>
                                    <?php } else { ?>
                                        <p>회원성명</p><p><input type="text" name="mb_name" value="<?= $mb['mb_name'] ?>"
                                                             readonly></p>
                                    <?php } ?>

                                    <?php if ($contract_row['agent_name']) { ?>
                                        <p>신청인(대리인)</p><p><?= $contract_row['agent_name'] ?>
                                            관계(<?= $contract_row['agent_relation'] ?>)</p>
                                    <?php } else { ?>
                                        <p>신청인(대리인)</p><p><input type="text" id="agent_name" name="agent_name"
                                                                 value="<?= $contract_row['agent_name'] ?>" readonly="readonly">
                                            <span>관계(<input type="text" id="agent_relation" name="agent_relation"
                                                            value="<?= $contract_row['agent_relation'] ?>"
                                                            style="width: 100px;" readonly="readonly">)</span></p>
                                    <?php } ?>

                                    <?php if ($contract_row['agent_name']) { ?>
                                        <p>담당매니저</p><p><?= $contract_row['contract_manager'] ?></p>
                                    <?php } else { ?>
                                        <p>담당매니저</p><p><input type="text" name="contract_manager" class="w200"
                                                              value="<?= $contract_row['contract_manager'] ?>"></p>
                                    <?php } ?>

                                </div>
                            </dd>
                            <dd>
                                <div class="flex">
                                    <?php if ($contract_row['contract_sign_2']) { ?>
                                        <p>회원 서명</p>
                                        <p class="sign_wrapper">
                                            <?= $contract_row['contract_sign_2'] ?>
                                            <canvas class="sign_pad" id="canvas2" style="display: none"></canvas>
                                        </p>
                                    <?php } else { ?>
                                        <p>회원 서명</p>
                                        <p class="sign_wrapper">
                                            <canvas class="sign_pad" id="canvas2"></canvas>
                                            <button class="sign_clear" type="button"
                                                    onclick="sign_clear(signaturePad2,'sign_2');">지움
                                            </button>
                                            <input type="text" id="sign_2" name="contract_sign_2">
                                        </p>
                                    <?php } ?>

                                    <?php if ($contract_row['contract_sign_3']) { ?>
                                        <p>대리인 서명</p>
                                        <p class="sign_wrapper">
                                            <?= $contract_row['contract_sign_3'] ?>
                                            <canvas class="sign_pad" id="canvas3" style="display: none"></canvas>
                                        </p>

                                    <?php } else { ?>
                                        <p>신청인 서명</p>
                                        <p class="sign_wrapper">
                                            <canvas class="sign_pad" id="canvas3"></canvas>
                                            <button class="sign_clear" type="button"
                                                    onclick="sign_clear(signaturePad3,'sign_3');">지움
                                            </button>
                                            <input type="text" id="sign_3" name="contract_sign_3">
                                        </p>
                                    <?php } ?>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <br>
                    <div class="box_red" style="display:none">
                        <i class="fa-duotone fa-circle-exclamation"></i> 허위 정보 입력으로 인하여 발생하는 모든 민/형사상 책임은 본인에게 있음에
                        동의합니다.
                    </div>
                    <!--<button onclick="sign_save()"></button>-->
                    <br>
                </div>
            </div>
    </div>
</div>

<div class="btn_confirm">
    <div class="btn_wrap">
        <?php if (!$contract_row['contract_sign_2']) { ?>
            <input type="submit" value="계약서 작성 완료" id="btn_submit" class="btn_submit" accesskey="s">
        <?php } ?>
        </form>
        <?php if ($w == 'u' && $contract_row['contract_sign_2']) { ?>
            <input type="button" value="PDF저장" class="btn_submit" onclick="savePDF()">
        <?php } ?>
    </div>
</div>

<script>

    $(function () {
        //$('input').val("아이디를 입력하세요.").css("color", "#777");
        //$('input').one('focus', function(event) {   // 한번만 실행됨.
        $('.won').bind('focus', function (event) {  // 반복.
            var money = $(event.target).val();
            money = money.replace(/,/gi, "");
            $(event.target).val(money);
        });
        $('.won').blur(function (event) {
            var money = number_format($(event.target).val());
            $(event.target).val(money);
        });
    });

    function convertToKoreanNumber(val) {
        var val = val.replace(/,/gi, "");

        var numKor = ["", "일", "이", "삼", "사", "오", "육", "칠", "팔", "구", "십"];                                  // 숫자 문자
        var danKor = ["", "십", "백", "천", "", "십", "백", "천", "", "십", "백", "천", "", "십", "백", "천"];    // 만위 문자열
        var result = "";

        if (val && !isNaN(val)) {
            // CASE: 금액이 공란/NULL/문자가 포함된 경우가 아닌 경우에만 처리

            for (var i = 0; i < val.length; i++) {
                var str = "";
                var num = numKor[val.charAt(val.length - (i + 1))];
                if (num != "") str += num + danKor[i];    // 숫자가 0인 경우 텍스트를 표현하지 않음
                switch (i) {
                    case 4:
                        str += "만";
                        break;     // 4자리인 경우 '만'을 붙여줌 ex) 10000 -> 일만
                    case 8:
                        str += "억";
                        break;     // 8자리인 경우 '억'을 붙여줌 ex) 100000000 -> 일억
                    case 12:
                        str += "조";
                        break;    // 12자리인 경우 '조'를 붙여줌 ex) 1000000000000 -> 일조
                }

                result = str + result;
            }

            // Step. 불필요 단위 제거
            if (result.indexOf("억만") > 0) result = result.replace("억만", "억");
            if (result.indexOf("조만") > 0) result = result.replace("조만", "조");
            if (result.indexOf("조억") > 0) result = result.replace("조억", "조");


            result = result + "원";
        }

        $('#result_money_won').val(result);
        //return result;
    }
    /*
    var canvas = document.getElementById('signatureCanvas');
    var ctx = canvas.getContext('2d');
    var isDrawing = false;

    canvas.addEventListener('mousedown', function (e) {
        isDrawing = true;
        ctx.beginPath();
        ctx.moveTo(e.offsetX, e.offsetY);
    });

    canvas.addEventListener('mousemove', function (e) {
        if (isDrawing) {
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        }
    });

    canvas.addEventListener('mouseup', function () {
        isDrawing = false;
    });

    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

     */
</script>

<script>
    window.addEventListener("resize", resizeCanvas);
    //캔버스 id값으로 가져오기 jquery로하면 잘안됨..
    var canvers1 = document.getElementById("canvas1");
    var canvers2 = document.getElementById("canvas2");
    var canvers3 = document.getElementById("canvas3");

    //생성

        var signaturePad1 = new SignaturePad(canvers1);
        resizeCanvas(canvers1);
        signaturePad1.clear(); // otherwise isEmpty() might return incorrect value

        var signaturePad2 = new SignaturePad(canvers2);
        resizeCanvas(canvers2);
        signaturePad2.clear(); // otherwise isEmpty() might return incorrect value

        var signaturePad3 = new SignaturePad(canvers3);
        resizeCanvas(canvers3);
        signaturePad3.clear(); // otherwise isEmpty() might return incorrect value




    //뒷배경 동의하기 적어준거 (안씀)
    //signaturePad1.fromDataURL("./adcenter/img/sign.png");
    //signaturePad2.fromDataURL("./adcenter/img/sign.png");
    //signaturePad3.fromDataURL("./adcenter/img/sign.png");
    //signaturePad4.fromDataURL("./adcenter/img/sign.png");
    //signaturePad5.fromDataURL("./adcenter/img/sign02.png");

    //초기화버튼
    function sign_clear(obj, input) {
        document.getElementById(input).value = '';
        obj.clear();
    }

    //svg로 변환하고 데이터 복호화후 적어줌
    function sign_save() {

        var data1 = signaturePad1.toDataURL('image/svg+xml');
        var data1_svg = atob(data1.split(',')[1]);
        document.getElementById("sign_1").value = data1_svg;
        console.log(data1_svg);
        var data2 = signaturePad2.toDataURL('image/svg+xml');
        var data2_svg = atob(data2.split(',')[1]);
        document.getElementById("sign_2").value = data2_svg;
        console.log(data2_svg);

        var data3 = signaturePad3.toDataURL('image/svg+xml');
        var data3_svg = atob(data3.split(',')[1]);
        document.getElementById("sign_3").value = data3_svg;
        console.log(data3_svg);

    }

    function resizeCanvas(object) {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        //object.offsetWidth 이거 가려져있을때 0가져와서.. 그냥 절대값넣어줌
        //object.width = object.offsetWidth * ratio;
        //object.height = object.offsetHeight * ratio;
        object.width = 222 * ratio;
        object.height = 126 * ratio;
        object.getContext("2d").scale(ratio, ratio);
    }


    // One could simply use Canvas#toBlob method instead, but it's just to show
    // that it can be done using result of SignaturePad#toDataURL.
    function dataURLToBlob(dataURL) {
        // Code taken from https://github.com/ebidel/filer.js
        var parts = dataURL.split(';base64,');
        var contentType = parts[0].split(":")[1];
        var raw = window.atob(parts[1]);
        var rawLength = raw.length;
        var uInt8Array = new Uint8Array(rawLength);

        for (var i = 0; i < rawLength; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }

        return new Blob([uInt8Array], {
            type: contentType
        });
    }


    // submit 최종 폼체크
    function contractform_submit(f) {





        <?php if(!$is_admin){ ?>

        <?php if(!$contract_row['contract_sign']){ ?>
            if (signaturePad1.isEmpty()) {
                alert("가입자 서명을 작성해주세요.");
                $('#sign_1').focus();
                return false;
            } else {
                sign_save();
            }
        <?php } ?>

        <?php if(!$contract_row['contract_sign_2']){ ?>
            if(!serti_result){
                alert("문자인증을 완료해주세요.");
                $('#mb_tel').focus();
                return false;
            }
        <?php } ?>

        if (!$('#check_4').is(':checked')) {
            alert("성혼사례금 지불에 동의해주세요.");
            $('#check_4').focus();
            return false;
        }


        if (!$('#check_5').is(':checked')) {
            alert("회원약관을 이해하고 확인에 동의해주세요.");
            $('#check_5').focus();
            return false;
        }

        if (!$('#check_6').is(':checked')) {
            alert(" 협력사의 회원추천에 동의해주세요.");
            $('#check_6').focus();
            return false;
        }

        /*
        if (!$('#check_7').is(':checked')) {
            alert("권리위임에 동의해주세요.");
            $('#check_7').focus();
            return false;
        }*/

        if (!$('#check_8').is(':checked')) {
            alert("각종 문제발생 시 을은 책임없음에 동의해주세요.");
            $('#check_8').focus();
            return false;
        }

        if (!$('#check_9').is(':checked')) {
            alert("계약서 사본을 교부받았음을 확인동의해주세요.");
            $('#check_9').focus();
            return false;
        }

        <?php if(!$contract_row['contract_sign_2']){ ?>
            if (signaturePad2.isEmpty()) {
                alert("회원 서명을 작성해주세요.");
                $('#sign_2').focus();
                return false;
            } else {
                sign_save();
            }
        <?php } ?>

        if($('#check_7').is(':checked')){

            <?php if(!$contract_row['agent_name']){ ?>
                if(!$('#agent_name').val()){
                    alert("신청인(대리인)을 작성해주세요.");
                    $('#agent_name').focus();
                    return false;
                }
            <?php } ?>

            <?php if(!$contract_row['agent_relation']){ ?>
                if(!$('#agent_relation').val()){
                    alert("신청인(관계)를 작성해주세요.");
                    $('#agent_relation').focus();
                    return false;
                }
            <?php } ?>

            <?php if(!$contract_row['contract_sign_3']){ ?>
                if (signaturePad3.isEmpty()) {
                    alert("신청인 서명을 작성해주세요.");
                    $('#sign_3').focus();
                    return false;
                } else {
                    sign_save();
                }
            <?php } ?>
        }



    <?php } ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

    <?php if($contract_row['contract_sign_2']){ ?>
            $('#check_4').prop('checked',true);
            $('#check_5').prop('checked',true);
            $('#check_6').prop('checked',true);

            $('#check_4').attr("readonly", true);
            $('#check_5').attr("readonly", true);
            $('#check_6').attr("readonly", true);
        <?php if($contract_row['agent_name']){ ?>
            $('#check_7').prop('checked',true);
            $('#check_7').attr("readonly", true);
        <?php } ?>
            $('#check_8').prop('checked',true);
            $('#check_9').prop('checked',true);

            $('#check_8').attr("readonly", true);
            $('#check_9').attr("readonly", true);

    <?php } ?>

    function agent_toggle() {

        if($('#agent_name').attr("readonly")){
            $('#agent_name').attr("readonly", false);
        }else{
            $('#agent_name').attr("readonly", true);
            $('#agent_name').val('');
        }

        if($('#agent_relation').attr("readonly")){
            $('#agent_relation').attr("readonly", false);
        }else{
            $('#agent_relation').attr("readonly", true);
            $('#agent_relation').val('');
        }

    }



</script>

<script type="text/javascript">
    function savePDF() {
        //저장 영역 div id
        html2canvas($('#pdfArea')[0], {
            //logging : true,		// 디버그 목적 로그
            //proxy: "html2canvasproxy.php",
            allowTaint: true,	// cross-origin allow
            useCORS: true,		// CORS 사용한 서버로부터 이미지 로드할 것인지 여부
            scale: 2			// 기본 96dpi에서 해상도를 두 배로 증가

        }).then(function (canvas) {
            // 캔버스를 이미지로 변환
            var imgData = canvas.toDataURL('image/png');

            var imgWidth = 190; // 이미지 가로 길이(mm) / A4 기준 210mm
            var pageHeight = imgWidth * 1.414;  // 출력 페이지 세로 길이 계산 A4 기준
            var imgHeight = canvas.height * imgWidth / canvas.width;
            var heightLeft = imgHeight;
            var margin = 10; // 출력 페이지 여백설정
            var doc = new jsPDF('p', 'mm');
            var position = 0;

            // 첫 페이지 출력
            doc.addImage(imgData, 'PNG', margin, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
            // 한 페이지 이상일 경우 루프 돌면서 출력
            while (heightLeft >= 35) {			// 35
                position = heightLeft - imgHeight;
                position = position - 25 ;		// -25

                doc.addPage();
                doc.addImage(imgData, 'PNG', margin, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            // 파일 저장
            doc.save('<?=$contract_row['mb_name']?>님 계약서.pdf');
        });
    }
</script>

<?
include_once('./_tail.php');
?>

