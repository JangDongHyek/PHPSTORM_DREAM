<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_SMS5_PATH.'/sms5.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin">

    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
	<input type="hidden" name="mb_1" value="<?=$member[mb_1]?>">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php }  ?>

        <div class="tbl_frm01 tbl_wrap">
            <div class="box_red">
                <!--<i class="fa-duotone fa-circle-exclamation"></i>--> 진실하고 정확한 정보를 입력해 주세요.
            </div>
            <br>
            <h3>프로필 기본정보 입력</h3>
            <div class="grid" style="background-color: #fff7f8">

                <dl>
                    <dt>거주지역구분</dt>
                    <dd><select name="mb_addr_div" id="mb_addr_div" required>
                            <option>지역 선택</option>
                            <?php
                            foreach (array_keys($mb_addr_div_arr) as $item) {
                            ?>
                                <option value="<?=$item?>" <?=$member['mb_addr_div'] == $item ? 'selected' : ''?>><?=$mb_addr_div_arr[$item]?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>결혼여부</dt>
                    <dd class="select grid grid4">
                        <input type="radio" id="radio1" name="mb_merry" value="초혼" <?=$member['mb_merry'] == '초혼' ? 'checked' : ''?> checked><label for="radio1">초혼</label>
                        <input type="radio" id="radio2" name="mb_merry" value="재혼" <?=$member['mb_merry'] == '재혼' ? 'checked' : ''?>><label for="radio2">재혼</label>
                        <input type="radio" id="radio3" name="mb_merry" value="썸혼" <?=$member['mb_merry'] == '썸혼' ? 'checked' : ''?>><label for="radio3" class="block" tooltip="자녀없이 이혼한  돌싱">썸혼</label>
                        <input type="radio" id="radio4" name="mb_merry" value="황혼" <?=$member['mb_merry'] == '황혼' ? 'checked' : ''?>><label for="radio4" class="block" tooltip="60세이후 혼자">황혼</label>
                    </dd>
                </dl>
                <dl>
                    <dt>성별</dt>
                    <dd class="v_center">
                        <input type="radio" id="female" name="mb_sex" value="F" <?=$member['mb_sex'] == 'F' ? 'checked' : ''?> checked><label for="female">여자</label>
                        <input type="radio" id="male" name="mb_sex" value="M" <?=$member['mb_sex'] == 'M' ? 'checked' : ''?>><label for="male">남자</label>
                    </dd>
                </dl>
                <dl>
                    <dt><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></dt>
                    <dd>
                        <?php if ($config['cf_cert_use']) { ?>
                        <span class="frm_info">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</span>
                        <?php } ?>
                        <input placeholder="이름" type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="<?php echo $required ?> <?php echo $readonly ?>" size="10">
                        <?php
                        if($config['cf_cert_use']) {
                            if($config['cf_cert_ipin'])
                                echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>'.PHP_EOL;
                            if($config['cf_cert_hp'])
                                echo '<button type="button" id="win_hp_cert" class="btn_frmline">휴대폰 본인확인</button>'.PHP_EOL;

                            echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
                        }
                        ?>
                        <?php
                        if ($config['cf_cert_use'] && $member['mb_certify']) {
                            if($member['mb_certify'] == 'ipin')
                                $mb_cert = '아이핀';
                            else
                                $mb_cert = '휴대폰';
                        ?>
                        <div id="msg_certify">
                            <strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
                        </div>
                        <?php } ?>
                    </dd>
                </dl>
                <dl>
                    <dt class="flex">
                        <label>생년월일</label>

                        <div class="v_center">
                            <input type="radio" id="radio9" name="mb_birth_div" class="md-radiobtn" value="양력" <?=$member['mb_birth_div'] == '양력' ? 'checked' : ''?> checked>
                            <label for="radio9">양력 </label>
                            <input type="radio" id="radio10" name="mb_birth_div" class="md-radiobtn" value="음력" <?=$member['mb_birth_div'] == '음력' ? 'checked' : ''?>>
                            <label for="radio10">음력 </label>
                        </div>
                    </dt>
                    <dd class="flex">
                        <input class="" type="text" placeholder="예시) 19840101 형태로" name="mb_birth" id="mb_birth" value="<?=$member['mb_birth']?>" required/>
                        <input class="" type="text" placeholder="태어난 시간(선택)" name="mb_birth_time" id="mb_birth_time" value="<?=$member['mb_birth_time']?>" required/>
                    </dd>
                </dl>
                <dl>
                    <dt><label>직업 정보</label></dt>
                    <dd>
                        <select name="mb_job_div">
                            <?php
                            foreach (array_keys($mb_job_arr) as $item) {
                                ?>
                                <option value="<?=$item?>" <?=$member['mb_job_div'] == $item ? 'selected' : ''?>><?=$mb_job_arr[$item]?></option>
                                <?php
                            }
                            ?>
                            <!-- 나머지 옵션들 -->
                        </select>
                        <input type="text" placeholder="직장명" name="mb_job_title" value="<?=$member['mb_job_title']?>" required/>
                        <input type="text" placeholder="직장 위치" name="mb_job_addr" value="<?=$member['mb_job_addr']?>" required/>
                        <input type="text" placeholder="직원수(사업자만)" name="mb_job_people" value="<?=$member['mb_job_people']?>"/>
                        <input type="text" placeholder="창립일자(사업자만)" name="mb_job_date" value="<?=$member['mb_job_date']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt><label>연봉&연수입</label></dt>
                    <dd><input type="text" placeholder="연봉 & 보너스 & 금융수익 & 임대수익 포함" name="mb_job_price" value="<?=$member['mb_job_price']?>" required/></dd>
                </dl>
                <dl style="display: none">
                    <dt><label>고등학교</label></dt>
                    <dd>
                        <input type="text" placeholder="학교명" name="mb_highschool" id="mb_highschool" value="<?=$member['mb_highschool']?>"/>
                        <input type="text" placeholder="소재지" name="mb_highschool2" id="mb_highschool2" value="<?=$member['mb_highschool2']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt><label>대학교/전문대</label></dt>
                    <dd>
                        <input type="text" placeholder="학교명" name="mb_university" id="mb_university" value="<?=$member['mb_university']?>" required/>
                        <input type="text" placeholder="소재지" name="mb_university2" id="mb_university2" value="<?=$member['mb_university2']?>"/>
                        <input type="text" placeholder="학과" name="mb_university3" id="mb_university3" value="<?=$member['mb_university3']?>"/>
                        <input type="text" placeholder="졸업년도" name="mb_university4" id="mb_university4" value="<?=$member['mb_university4']?>" oninput="maxLengthCheck(this)" maxlength="4"/>
                    </dd>
                </dl>
                <dl>
                    <dt><label>대학원(석사)</label></dt>
                    <dd>
                        <input type="text" placeholder="학교명" name="mb_master" id="mb_master" value="<?=$member['mb_master']?>" required/>
                        <input type="text" placeholder="소재지" name="mb_master2" id="mb_master2" value="<?=$member['mb_master2']?>"/>
                        <input type="text" placeholder="학과" name="mb_master3" id="mb_master3" value="<?=$member['mb_master3']?>"/>
                        <input type="text" placeholder="졸업년도" name="mb_master4" id="mb_master4" value="<?=$member['mb_master4']?>" oninput="maxLengthCheck(this)" maxlength="4"/>
                    </dd>
                </dl>
                <dl>
                    <dt><label>대학원(박사)</label></dt>
                    <dd>
                        <input type="text" placeholder="학교명" name="mb_doctor" id="mb_doctor" value="<?=$member['mb_doctor']?>" required/>
                        <input type="text" placeholder="소재지" name="mb_doctor2" id="mb_doctor2" value="<?=$member['mb_doctor2']?>"/>
                        <input type="text" placeholder="학과" name="mb_doctor3" id="mb_doctor3" value="<?=$member['mb_doctor3']?>"/>
                        <input type="text" placeholder="졸업년도" name="mb_doctor4" id="mb_doctor4" value="<?=$member['mb_doctor4']?>" oninput="maxLengthCheck(this)" maxlength="4"/>
                    </dd>
                </dl>
                <dl>
                    <dt><label for="">종교</label></dt>
                    <dd>
                        <select name="mb_religion" required>
                            <option value="무교" <?=$member['mb_religion'] == '무교' ? 'selected' : ''?>>무교</option>
                            <option value="기독교" <?=$member['mb_religion'] == '무교' ? 'selected' : ''?>>기독교</option>
                            <option value="불교" <?=$member['mb_religion'] == '무교' ? 'selected' : ''?>>불교</option>
                            <option value="천주교" <?=$member['mb_religion'] == '무교' ? 'selected' : ''?>>천주교</option>
                            <option value="기타" <?=$member['mb_religion'] == '무교' ? 'selected' : ''?>>기타</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt><label>신체 정보</label></dt>
                    <dd><input type="text" placeholder="키 (cm)" name="mb_height" value="<?=$member['mb_height']?>" oninput="maxLengthCheck(this)" maxlength="3" required/>
                        <input type="text" placeholder="몸무게 (kg)" name="mb_weight" value="<?=$member['mb_weight']?>" oninput="maxLengthCheck(this)" maxlength="3" required/></dd>
                </dl>
                <dl>
                    <dt><label>형제관계</label></dt>
                    <dd><input type="text" placeholder="ex) 2남 1녀 중 막내" name="mb_family" value="<?=$member['mb_family']?>" required/> </dd>
                </dl>
                <dl>
                    <dt><label>부모님 정보</label></dt>
                    <dd><input type="text" placeholder="아버지 직업" name="mb_dad" value="<?=$member['mb_dad']?>" required/>
                        <input type="text" placeholder="아버지 학력" name="mb_dad2" value="<?=$member['mb_dad2']?>" required/>
                        <input type="text" placeholder="어머니 직업" name="mb_mom" value="<?=$member['mb_mom']?>" required/>
                        <input type="text" placeholder="어머니 학력" name="mb_mom2" value="<?=$member['mb_mom2']?>" required/>
                        <input type="text" placeholder="부모님 소유 자산 금액" name="mb_family_money" value="<?=$member['mb_family_money']?>"/></dd>
                    <input type="text" placeholder="부모님 연락처" name="mb_family_hp" id="reg_mb_family_hp" value="<?=$member['mb_family_hp']?>" oninput="maxLengthCheck(this)" maxlength="13"/>
                </dl>
                <dl>
                    <dt><label>본인 소유 동산 자산</label></dt>
                    <dd><input type="text" placeholder="현금 & 예금 & 차량 등 동산 자산 내역" name="mb_money" value="<?=$member['mb_money']?>" required/></dd>
                </dl>
                <dl>
                    <dt><label>본인 소유 부동산 자산</label></dt>
                    <dd><input type="text" placeholder="본인 소유 부동산 자산 내역" name="mb_money2" value="<?=$member['mb_money2']?>" required/></dd>
                </dl>
                <!--건강상의 이상유무-->
                <dl>
                    <dt>
                        <label>자기소개 [ 상대방에게 공개되는 내용 ]</label>
                    </dt>
                    <dd>
                        <textarea class="form-control" name="mb_profile" required><?=$member['mb_profile']?></textarea>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>기피사항 [ 매니저만 확인하는 내용 ]</label>
                    </dt>
                    <dd>
                        <textarea class="form-control" name="mb_memo_call" required><?=$member['mb_memo_call']?></textarea>
                    </dd>
                </dl>
                <dl>
                    <dt><label>취미</label></dt>
                    <dd><input type="text" placeholder="취미" name="mb_hobby" value="<?=$member['mb_hobby']?>" required/> </dd>
                </dl>
                <dl>
                    <dt><label for="reg_mb_tel">연락처<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label></dt>
                    <dd>
                        <p class="flex ai-c">
                        <input placeholder="연락처" type="text" name="mb_tel" value="<?php echo get_hp(get_text($member['mb_tel']),1) ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="<?php echo $config['cf_req_tel']?"required":""; ?>" oninput="maxLengthCheck(this)" maxlength="13">

                            <?php if($w == ''){ ?>
                            <button type="button" class="btn btn_black" style="margin-bottom: 8px;" onclick="serti_sms()" id="serti_btn">인증</button>
                            <button type="button" class="btn btn_black" style="display: none;margin-bottom: 8px;" id="serti_btn_ok">완료</button>
                            <?php } ?>
                        </p>


                            <dd class="serti_no" id="serti_block">
                                <div class="serti_phoneBox">
                                    <input type="text" id='serti' name="serti" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" value="" maxlength="4" class="serti_phone" placeholder="인증번호">
                                    <span class="serti_phoneRight" id="serti_text"></span>
                                </div>
                                <p class="serti_tip serti_no" id="serti_tip" style="display:none"></p>
                            </dd>
                        </p>
                    </dd>
                </dl>
                <!-- 본인인증 관련 -->
                <style media="screen">
                    #serti_block{display:none ;height:auto;margin:0 auto;}
                    .serti_title{margin: 19px 0 8px;font-size: 22px;font-weight: 700;}
                    .serti_phoneBlock{position: relative; margin-top: 10px;padding: 0 125px 0 0;height:51px;}
                    .serti_phone{display: block;position: relative;width: 132px;padding:5px;outline:0;border: 1px solid #dadada;background: #fff;box-sizing: border-box;z-index: 10;}
                    .serti_phone:focus{border:1px solid #000}
                    .serti_phoneBox{position: relative;width: 135px;}
                    .serti_btn{width: 115px;height: 22px;padding: 7px;border:1px solid #dadada;text-align:center;background:#000;color:#fff;cursor:pointer;}
                    .serti_phoneRight{position: absolute;display: inline-block;top: 0px;right: 10px;background: 0 0;z-index: 10;line-height: 26px;display: inline-block;}
                    .serti_no .serti_phone{border:1px solid red}
                    .serti_ok .serti_phone{border:1px solid #08a600}
                    .serti_no .serti_phoneRight{color:red}
                    .serti_ok .serti_phoneRight{color:#08a600}
                    .serti_no .serti_phoneRight:after{background: url(<?php echo $board_skin_url ?>/img/input_x.png) no-repeat 0 0;background-size: 15px 15px;}
                    .serti_ok .serti_phoneRight:after{background: url(<?php echo $board_skin_url ?>/img/input_v.png) no-repeat 0 0;background-size: 15px 15px;}
                    .serti_phoneRight:after{content: '';display: inline-block;width: 15px;height: 15px;margin-left: 4px;margin-top: -3px;vertical-align: middle;}
                    .serti_tip{display: block;margin: 9px 0 -2px;font-size: 12px;line-height: 14px;}
                    .serti_tip.serti_no{color: red;}
                    .serti_tip.serti_ok{color: #08a600;}
                </style>
                <script type="text/javascript">
                    var serti_num;
                    var serti_phone;
                    var serti_result = false;
                    var company= '마리엔결혼정보';
                    var callback='033-342-4888';
                    var serti_count = 0;
                    function serti_sms(){
                        if(serti_count>=2){
                            alert('인증번호 발송 초과');
                            return false;
                        }
                        //array 파싱해서 저장
                        serti_phone = $('#reg_mb_tel').val().replaceAll('-','');

                        if(!serti_phone){
                            alert('연락처를 입력 후 인증을 해주세요.');
                            return false;
                        }

                        $.ajax({
                            cache : false,
                            url : "<?php echo G5_BBS_URL ?>/ajax.get_certy_sms.php", // 요기에
                            type : 'POST',
                            data : {phone:serti_phone,company:company},
                            success : function(data) {
                                console.log(data);
                                alert('인증번호가 발송되었습니다.');
                                serti_num = data.substring(6,10);
                                $('#serti').val('');
                                $('#serti_block').show();
                                serti_count++;
                            },
                        }); // $.ajax */
                    }

                    $('#serti').keyup(function(e){
                        var inputVal = $(this).val();
                        if(serti_num==inputVal){
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
                            $("#reg_mb_tel" ).prop('readonly', true);
                            
                            serti_result = true;
                        }else{
                            $('#serti_block').removeClass('serti_ok');
                            $('#serti_block').addClass('serti_no');
                            $('#serti_tip').removeClass('serti_ok');
                            $('#serti_tip').show();
                            $('#serti_tip').addClass('serti_no');
                            $('#serti_tip').text('인증번호를 다시 확인해주세요.');
                            $('#serti_text').text('불일치');

                            serti_result = false;
                        }
                    });
                </script>
                <!-- 본인인증 끝 -->
                <dl>
                    <dt><label for="reg_mb_email"><strong>E-mail</strong>(*아이디 필수)<strong class="sound_only">필수</strong></label></dt>
                    <dd>
                        <input placeholder="E-mail" type="text" name="mb_id" value="<?php echo isset($member['mb_id'])?$member['mb_id']:''; ?>" id="reg_mb_id" required class="email required" size="70" maxlength="100" <?php echo $w == 'u' ?'readonly':''; ?> >
                    </dd>
                </dl>
                <dl>
                    <dt><label for="reg_mb_email"><strong>비밀번호</strong>(*필수)<strong class="sound_only">필수</strong></label></dt>
                    <dd class="flex">
                        <input name="mb_password" id="reg_mb_password" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20" placeholder="비밀번호">
                        <input type="password" type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20" placeholder="비밀번호확인">
                    </dd>
                </dl>
            </div>
            <br>
            <div class="grid">

                <!--이미지 추가-->
                <?php if($w == 'u'){ ?>
                    <dl>
                        <dt>사진 첨부</dt>
                        <dd id="imageInput_focus">
                            <div class="imageInput_wrap">
                                <span class="txt_purple">※이미지를 클릭하시면 대표이미지가 설정됩니다.</span>
                                <!-- 이미지 미리보기 컨테이너 -->
                                <div id="preview-container">
                                <?php
                                    $sql = "select * from g5_board_file where bo_table = 'member_img' and wr_id = '{$member['mb_no']}' order by FIELD(`bf_best`, 'Y', '');";
                                    $member_img = sql_query($sql);
                                ?>

                                <?php for ( $i = 0 ; $img_row = sql_fetch_array($member_img) ; $i++){
                                    $before_image = G5_DATA_PATH."/file/member_img/".$img_row['bf_file'];
                                    $before_image = G5_DATA_URL."/file/member_img/".thumbnail(basename($before_image), dirname($before_image), dirname($before_image), 290, 231, false);
                                ?>
                                    <?php if($i == 0){ ?>
                                        <div class="preview-item representative" onclick="setRepresentativeImage(this,'<?=$img_row['bf_no']?>')">
                                                <img src="<?=$before_image?>" class="preview-image">
                                        </div>
                                    <?php }else{ ?>
                                        <div class="preview-item" onclick="setRepresentativeImage(this ,'<?=$img_row['bf_no']?>')">
                                            <img src="<?=$before_image?>" class="preview-image">
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                </div>
                            </div>
                        </dd>
                    </dl>
                <?php }else{ ?>
                    <dl>
                        <dt>사진 첨부</dt>
                        <dd id="imageInput_focus">
                            <div class="imageInput_wrap">
                                <!-- 이미지 선택 버튼 -->
                                <label for="imageInput" id="imageInput_label" class="custom-image-input"><i class="fa-light fa-camera"></i> 이미지 추가</label>
                                <input type="file" name="bf_file2[]" id="imageInput" accept="image/*" style="display:none">
                                <label for="imageInput2" id="imageInput2_label" class="custom-image-input" style="display: none"><i class="fa-light fa-camera"></i> 이미지 추가</label>
                                <input type="file" name="bf_file2[]" id="imageInput2" accept="image/*" style="display: none">
                                <br>
                                <!--
                                <span class="txt_purple">※이미지를 클릭하시면 대표이미지가 설정됩니다.</span>
                                -->
                                <!-- 이미지 미리보기 컨테이너 -->
                                <div id="preview-container"></div>
                            </div>
                        </dd>
                    </dl>
                <?php } ?>
                <!--이미지 추가-->
                <?php if($w == ''){ ?>
                <dl class="addFile">
                    <dt>증명서 첨부</dt>
                    <dd id="addFile1" class="grid grid2">
                        <strong>혼인관계 증명서</strong>
                        <p>
                            <a id="attachBtn1" class="btn btn_black">파일첨부</a> <span id="fileInfo1">파일을 선택하세요.</span>
                            <button type="button" onclick="deleteFile(1)" class="btn">삭제</button>
                            <input type="hidden" id="fileName1" name="fileName[1]">
                            <input type="file" name="bf_file[]" id="fileInput1" style="display: none;" onchange="updateFileInfo(1)">
                        </p>
                    </dd>
                    <dd id="addFile2" class="grid grid2">
                        <strong>가족관계증명서</strong>
                        <p>
                            <a id="attachBtn2" class="btn btn_black">파일첨부</a> <span id="fileInfo2">파일을 선택하세요.</span>
                            <button type="button" onclick="deleteFile(2)" class="btn">삭제</button>
                            <input type="hidden" id="fileName2" name="fileName[2]">
                            <input type="file" name="bf_file[]" id="fileInput2" style="display: none;" onchange="updateFileInfo(2)">
                        </p>
                    </dd>
                    <dd id="addFile3" class="grid grid2">
                        <strong>재직증명서</strong>
                        <p>
                            <a id="attachBtn3" class="btn btn_black">파일첨부</a> <span id="fileInfo3">파일을 선택하세요.</span>
                            <button type="button" onclick="deleteFile(3)" class="btn">삭제</button>
                            <input type="hidden" id="fileName3" name="fileName[3]">
                            <input type="file" name="bf_file[]" id="fileInput3" style="display: none;" onchange="updateFileInfo(3)">
                        </p>
                    </dd>
                    <dd id="addFile4" class="grid grid2">
                        <strong>최종학교졸업증명서</strong>
                        <p>
                            <a id="attachBtn4" class="btn btn_black">파일첨부</a> <span id="fileInfo4">파일을 선택하세요.</span>
                            <button type="button" onclick="deleteFile(4)" class="btn">삭제</button>
                            <input type="hidden" id="fileName4" name="fileName[4]">
                            <input type="file" name="bf_file[]" id="fileInput4" style="display: none;" onchange="updateFileInfo(4)">
                        </p>
                    </dd>

                    <dd id="addFile5" class="grid grid2">
                        <strong>기타증명서</strong>
                        <p>
                            <a id="attachBtn5" class="btn btn_black">파일첨부</a> <span id="fileInfo5">파일을 선택하세요.</span>
                            <button type="button" onclick="deleteFile(5)" class="btn">삭제</button>
                            <input type="hidden" id="fileName5" name="fileName[5]">
                            <input type="file" name="bf_file[]" id="fileInput5" style="display: none;" onchange="updateFileInfo(5)">
                        </p>
                    </dd>
                </dl>
                <?php } ?>
                <dl>
                    <dt><label>최종 학력</label></dt>
                    <dd>
                        <select name="mb_education">
                            <?php
                            foreach (array_keys($mb_education_arr) as $item) {
                                ?>
                                <option value="<?=$item?>" <?=$member['mb_education'] == $item ? 'selected' : ''?>><?=$mb_education_arr[$item]?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </dd>
                </dl>
                <!-- 가리기 -->



                <dl>
                    <dt><label>현재 주민등록상 주소</label></dt>
                    <dd><input type="text" placeholder="주소" name="mb_addr1" value="<?=$member['mb_addr1']?>"/></dd>
                </dl>
                <dl>
                    <dt><label>동거인 정보</label></dt>
                    <dd><input type="text" placeholder="ex) 부모님과 함께 / 혼자 / 동생과 함께 등" name="mb_inmate" value="<?=$member['mb_inmate']?>"/></dd>
                </dl>



                <dl>
                    <dt>
                        <label>미팅 가능 지역</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="ex. 서울경기인근 / 주변지역만 등" name="mb_meeting" value="<?=$member['mb_meeting']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>선호하는 이상형 직업</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="ex. 무관 / 대기업 / 사업가 등" name="mb_love_job" value="<?=$member['mb_love_job']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>선호하는 이상형의 나이</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="ex. 무관 / 몇 년생부터 몇 년생까지" name="mb_love_age" value="<?=$member['mb_love_age']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>선호하는 이상형의 키</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="ex. 무관 / OOOcm 이상" name="mb_love_height" value="<?=$member['mb_love_height']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>선호하는 이상형의 연봉</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="ex. 무관 / OOOO만원 이상" name="mb_love_money" value="<?=$member['mb_love_money']?>" />
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>선호하는 이상형의 자산</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="ex. 무관 / OOOO원 이상" name="mb_love_money2" value="<?=$member['mb_love_money2']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>선호하는 이상형의 종교</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="ex. 무관 / 선호 or 기피 정보" name="mb_love_religion" value="<?=$member['mb_love_religion']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>선호하는 이상형의 학력</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="ex. 무관 / OOO졸업 이상" name="mb_love_education" value="<?=$member['mb_love_education']?>"/>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label>신체적/정신적 문제 여부</label>
                    </dt>
                    <dd>
                        <input type="text" placeholder="미팅 상대가 미리 알아야할 내용이라면 적어주세요" name="mb_problem" value="<?=$member['mb_problem']?>"/>
                    </dd>
                </dl>

                <dl>
                    <dt><label>재혼인 경우만 적어주세요</label></dt>
                    <dd>
                    <input type="text" placeholder="자녀수 ex) 아들1(몇년생) 딸1(몇년생)" name="mb_digamy" value="<?=$member['mb_digamy']?>">
                    <input type="text" placeholder="양육자 (배우자 / 본인)" name="mb_digamy2" value="<?=$member['mb_digamy2']?>">
                    <input type="text" placeholder="결혼년도" name="mb_digamy3" value="<?=$member['mb_digamy3']?>">
                    <input type="text" placeholder="이혼년도" name="mb_digamy4" value="<?=$member['mb_digamy4']?>">
                    <input type="text" placeholder="이혼사유" name="mb_digamy5" value="<?=$member['mb_digamy5']?>">
                    <input type="text" placeholder="상대 자녀 양육 가능한지?" name="mb_digamy6" value="<?=$member['mb_digamy6']?>">
                    </dd>
                </dl>


            </div>
            <br>
            <div class="box_red" style="position:relative">
                <label for="agree" style="width:95%">위에 기재한 내용은 모두 진실하며 결혼을 진행함에 있어 의학적 법률적으로 문제가 없음을 확인합니다</label>
                <input type="checkbox" id="agree" name="agree" style="position:absolute; right:10px; top:18px">
            </div>
        </div>
        <div class="agree_wrap">
            <h3>약관 동의</h3>
            <ul>
                <li>
                    <p class="flex ai-c"><input type="checkbox" id="agree01" name="agree" /><label for="agree01">이용약관 동의(필수)</label></p>
                    <button data-toggle="modal" data-target="#agreeModal" class="btn">약관보기</button>
                </li>
                <li>
                    <p class="flex ai-c"><input type="checkbox" id="agree02" name="agree" /><label for="agree02">개인정보수집 및 이용 동의(필수)</label></p>
                    <button data-toggle="modal" data-target="#privacyModal" class="btn">약관보기</button>
                </li>
                <li>
                    <p class="flex ai-c"><input type="checkbox" id="agree03" name="agree" /><label for="agree03">제3자 개인정보 제공 동의(필수)</label></p>
                    <button data-toggle="modal" data-target="#agreeModal" class="btn">약관보기</button>
                </li>
            </ul>
        </div>
    <div class="btn_confirm">
        <input type="submit" value="<?php echo $w==''?'작성완료':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
        <!--<a href="<?php /*echo G5_URL */?>" class="btn_cancel">취소</a>-->
    </div>
    </form>

    <script>

        $(document).ready(function () {

            $(function () {

                $('#reg_mb_hp, #reg_ad_hp, #reg_mb_tel, #reg_mb_family_hp').keydown(function (event) {
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
                })
            });

        });

    $(function() {
        $("#reg_zip_find").css("display", "inline-block");

        <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        $("#win_ipin_cert").click(function() {
            if(!cert_confirm())
                return false;

            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
            certify_win_open('kcb-ipin', url);
            return;
        });

        <?php } ?>
        <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        $("#win_hp_cert").click(function() {
            if(!cert_confirm())
                return false;

            <?php
            switch($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                case 'lg':
                    $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                    $cert_type = 'lg-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
            return;
        });
        <?php } ?>
    });

    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
        <?php if($ip == '121.140.204.65'){ ?>
            //return true;
        <?php } ?>

        // 이름 검사
        if (f.w.value=="") {
            if (f.mb_name.value.length < 1) {
                alert("이름을 입력하십시오.");
                f.mb_name.focus();
                return false;
            }

            /*
            var pattern = /([^가-힣\x20])/i;
            if (pattern.test(f.mb_name.value)) {
                alert("이름은 한글로 입력하십시오.");
                f.mb_name.select();
                return false;
            }
            */
        }

        if(checkHan(f.mb_name.value) == false){
            f.mb_name.focus();
            alert("이름은 한글로만 입력해 주세요.");
            return false;
        }

        <?php if($w == ''){ ?>
        // 아이디 중복체크
        var msg = reg_mb_id_check();
        if (msg != "") {
            alert(msg);
            f.mb_id.focus();
            return false;
        }
        <?php } ?>


    <?php if($w == ''){ ?>
        if(!serti_result){
            alert('본인인증을 완료해주세요.');
            $('#reg_mb_tel').focus();
            return false;
        }
        <?php } ?>



        if (f.w.value == "") {
            if (f.mb_password.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password.focus();
                return false;
            }
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            alert("비밀번호가 같지 않습니다.");
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password_re.focus();
                return false;
            }
        }




        <?php if($w == ''){ ?>

        const previewContainer = document.getElementById('preview-container');

        /*if (previewContainer.childElementCount != 2) {
            alert('사진을 2개 첨부해주세요.');
            $('#imageInput_focus').focus();
            return false;
        }

        if(!$('#fileInput1').val()){
            alert('혼인관계 증명서를 업로드해주세요.');
            $('#addFile1').focus();
            return false;
        }

        if(!$('#fileInput2').val()){
            alert('가족관계 증명서를 업로드해주세요.');
            $('#addFile2').focus();
            return false;
        }

        if(!$('#fileInput3').val()){
            alert('재직증명서를 업로드해주세요.');
            $('#addFile3').focus();
            return false;
        }

        if(!$('#fileInput4').val()){
            alert('최종학교졸업증명서를 업로드해주세요.');
            $('#addFile4').focus();
            return false;
        }*/


        if(!$('#agree').is(':checked')){
            alert('법률적으로 문제가 없음 확인에 동의해주세요.');
            $('#agree').focus();
            return false;
        }

        if(!$('#agree01').is(':checked')){
            alert('이용약관을 동의해주세요.');
            $('#agree01').focus();
            return false;
        }

        if(!$('#agree02').is(':checked')){
            alert('개인정보수집 및 이용에 동의해주세요.');
            $('#agree02').focus();
            return false;
        }

        if(!$('#agree03').is(':checked')){
            alert('제3자 개인정보 제공에 동의해주세요.');
            $('#agree03').focus();
            return false;
        }
        <?php } ?>



        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>

</div>
<!-- } 회원정보 입력/수정 끝 -->



<!-- 이용약관 동의(필수) -->
<div class="modal fade" id="agreeModal" tabindex="-1" aria-labelledby="agreeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agreeModalLabel">이용약관 동의(필수)</h5>
            </div>
            <div class="modal-body"><?php echo get_text($config['cf_stipulation']) ?></div>
        </div>
    </div>
</div>

<!-- 개인정보수집 및 이용 동의(필수) -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">개인정보수집 및 이용 동의(필수)</h5>
            </div>
            <div class="modal-body"><?php echo get_text($config['cf_privacy']) ?></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //이미지 업로드
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

        ///////제품등록 이미지 업로드
        // 이미지 선택 시 미리보기 기능 실행
        document.getElementById('imageInput').addEventListener('change', handleImageSelect);
        document.getElementById('imageInput2').addEventListener('change', handleImageSelect);



        function handleImageSelect(event) {
            const previewContainer = document.getElementById('preview-container');
            const files = event.target.files;
            const maxImages = 2; // 최대 이미지 개수
            const currentImageCount = previewContainer.querySelectorAll('.preview-item').length;

            // 이미지 개수 체크
            if (currentImageCount + files.length > maxImages) {
                alert('이미지는 최대 2개까지 업로드할 수 있습니다.');
                return;
            }

            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function (e) {

                    $('#'+event.target.id).hide();
                    $('#'+event.target.id +'_label').hide();

                    if (previewContainer.childElementCount === 1) {

                    }else{
                        $('#imageInput2_label').show();
                    }

                    const previewItem = document.createElement('div');
                    previewItem.classList.add('preview-item');

                    const previewImage = document.createElement('img');
                    previewImage.classList.add('preview-image');
                    previewImage.src = e.target.result;

                    const deleteButton = document.createElement('button');
                    deleteButton.classList.add('delete-button');
                    deleteButton.innerHTML = '<i class="fa-light fa-xmark"></i>';

                    deleteButton.addEventListener('click', function() {
                        previewContainer.removeChild(previewItem);
                        //$('#'+event.target.id).show();

                        $('#'+event.target.id +'_label').show();
                        $('#'+event.target.id).val('');

                        if (previewContainer.childElementCount === 1) {

                        }else{
                            $('#imageInput2_label').hide();
                        }



                    });


                    const setRepresentativeButton = document.createElement('button');
                    setRepresentativeButton.classList.add('set-representative-button');
                    setRepresentativeButton.innerHTML = '대표 이미지로 설정';
                    setRepresentativeButton.addEventListener('click', function() {
                        //setRepresentativeImage(previewImage.src);
                    });

                    previewItem.appendChild(previewImage);
                    previewItem.appendChild(deleteButton);
                    previewItem.appendChild(setRepresentativeButton);
                    previewContainer.appendChild(previewItem);

                    // 이미지 클릭 시 대표 이미지로 설정
                    previewImage.addEventListener('click', function() {
                        //setRepresentativeImage(previewImage);
                    });

                    // 첫 번째 이미지를 대표 이미지로 설정
                    if (previewContainer.childElementCount === 1) {
                        setRepresentativeImage(previewImage);
                    }
                };

                reader.readAsDataURL(file); // 파일을 Data URL로 변환하여 미리보기에 사용
            }

            // 선택한 파일 초기화 (같은 파일을 다시 선택해도 change 이벤트 발생하도록)
            //event.target.value = '';
        }





        //증명서첨부





        // 삭제 및 첨부 버튼 이벤트 핸들러
        for (var i = 1; i <= 5; i++) {
            document.getElementById('attachBtn' + i).addEventListener('click', function(index) {
                return function() {
                    document.getElementById('fileInput' + index).click();
                };
            }(i));

            document.getElementById('fileInput' + i).addEventListener('change', function(index) {
                return function() {
                    updateFileInfo(index);
                };
            }(i));
        }



    });

    // 대표 이미지로 설정하는 함수
    function setRepresentativeImage(imageElement,bf_no = '') {
        // 기존에 대표 이미지로 설정된 이미지에서 클래스 제거
        const previousRepresentative = document.querySelector('.preview-item.representative');
        if (previousRepresentative) {
            previousRepresentative.classList.remove('representative');
        }

        // 대표 이미지로 설정된 이미지에 클래스 추가
        imageElement.closest('.preview-item').classList.add('representative');


        //alert('대표 이미지로 설정되었습니다.');
        // 여기에 대표 이미지로 설정하는 로직을 추가하세요

        if(bf_no != ''){
            $.ajax({
                type: "POST",
                url: g5_bbs_url+"/ajax.set_best_img.php",
                data: {
                    "bf_no": bf_no,
                    "wr_id": '<?=$member['mb_no']?>',
                    "bo_table": 'member_img'
                },
                cache: false,
                async: false,
                success: function(data) {
                    result = data;
                    console.log(result);
                }
            });
        }
    }

    // 파일 첨부 시 파일명 업데이트
    function updateFileInfo(index) {
        var input = document.getElementById('fileInput' + index);
        var fileInfo = document.getElementById('fileInfo' + index);
        var fileNameField = document.getElementById('fileName' + index);

        var file = input.files[0];
        if (file) {
            fileInfo.textContent = file.name;
            fileNameField.value = file.name;
        } else {
            fileInfo.textContent = '파일을 선택하세요.';
            fileNameField.value = '';
        }
    }

    // 삭제 버튼 클릭 시 파일 정보 초기화
    function deleteFile(index) {
        var fileInfo = document.getElementById('fileInfo' + index);
        var fileNameField = document.getElementById('fileName' + index);

        fileInfo.textContent = '파일을 선택하세요.';
        fileNameField.value = '';
        // 추가적인 파일 삭제 로직을 여기에 추가할 수 있습니다.
    }
</script>