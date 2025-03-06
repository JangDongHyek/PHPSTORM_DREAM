<?php
$sub_menu = "200100";
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
add_stylesheet('<link rel="stylesheet" href="'.G5_ADMIN_URL.'/css/style.css">', 1);

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['mb_name'] = get_text($mb['mb_name']);
    $mb['mb_nick'] = get_text($mb['mb_nick']);
    $mb['mb_email'] = get_text($mb['mb_email']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);
    $mb['mb_addr1'] = get_text($mb['mb_addr1']);
    $mb['mb_addr2'] = get_text($mb['mb_addr2']);
    $mb['mb_addr3'] = get_text($mb['mb_addr3']);
    $mb['mb_signature'] = get_text($mb['mb_signature']);
    $mb['mb_recommend'] = get_text($mb['mb_recommend']);
    $mb['mb_profile'] = get_text($mb['mb_profile']);
    $mb['mb_1'] = get_text($mb['mb_1']);
    $mb['mb_2'] = get_text($mb['mb_2']);
    $mb['mb_3'] = get_text($mb['mb_3']);
    $mb['mb_4'] = get_text($mb['mb_4']);
    $mb['mb_5'] = get_text($mb['mb_5']);
    $mb['mb_6'] = get_text($mb['mb_6']);
    $mb['mb_7'] = get_text($mb['mb_7']);
    $mb['mb_8'] = get_text($mb['mb_8']);
    $mb['mb_9'] = get_text($mb['mb_9']);
    $mb['mb_10'] = get_text($mb['mb_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

// 본인확인방법
switch($mb['mb_certify']) {
    case 'hp':
        $mb_certify_case = '휴대폰';
        $mb_certify_val = 'hp';
        break;
    case 'ipin':
        $mb_certify_case = '아이핀';
        $mb_certify_val = 'ipin';
        break;
    case 'admin':
        $mb_certify_case = '관리자 수정';
        $mb_certify_val = 'admin';
        break;
    default:
        $mb_certify_case = '';
        $mb_certify_val = 'admin';
        break;
}

// 본인확인
$mb_certify_yes  =  $mb['mb_certify'] ? 'checked="checked"' : '';
$mb_certify_no   = !$mb['mb_certify'] ? 'checked="checked"' : '';

// 성인인증
$mb_adult_yes       =  $mb['mb_adult']      ? 'checked="checked"' : '';
$mb_adult_no        = !$mb['mb_adult']      ? 'checked="checked"' : '';

//메일수신
$mb_mailling_yes    =  $mb['mb_mailling']   ? 'checked="checked"' : '';
$mb_mailling_no     = !$mb['mb_mailling']   ? 'checked="checked"' : '';

// SMS 수신
$mb_sms_yes         =  $mb['mb_sms']        ? 'checked="checked"' : '';
$mb_sms_no          = !$mb['mb_sms']        ? 'checked="checked"' : '';

// 정보 공개
$mb_open_yes        =  $mb['mb_open']       ? 'checked="checked"' : '';
$mb_open_no         = !$mb['mb_open']       ? 'checked="checked"' : '';

if (isset($mb['mb_certify'])) {
    // 날짜시간형이라면 drop 시킴
    if (preg_match("/-/", $mb['mb_certify'])) {
        sql_query(" ALTER TABLE `{$g5['member_table']}` DROP `mb_certify` ", false);
    }
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_certify` TINYINT(4) NOT NULL DEFAULT '0' AFTER `mb_hp` ", false);
}

if(isset($mb['mb_adult'])) {
    sql_query(" ALTER TABLE `{$g5['member_table']}` CHANGE `mb_adult` `mb_adult` TINYINT(4) NOT NULL DEFAULT '0' ", false);
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_adult` TINYINT NOT NULL DEFAULT '0' AFTER `mb_certify` ", false);
}

// 지번주소 필드추가
if(!isset($mb['mb_addr_jibeon'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 건물명필드추가
if(!isset($mb['mb_addr3'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 중복가입 확인필드 추가
if(!isset($mb['mb_dupinfo'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_dupinfo` varchar(255) NOT NULL DEFAULT '' AFTER `mb_adult` ", false);
}

if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
include_once(G5_SMS5_PATH.'/sms5.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<!-- 회원정보 입력/수정 시작 { -->

<div class="mbskin">

<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

    <div class="tbl_frm01 tbl_wrap">
        <div class="box_red">
            <i class="fa-duotone fa-circle-exclamation"></i> 진실하고 정확한 정보를 입력해 주세요.
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="submit" value="확인" class="btn_submit" accesskey='s'>
            <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
        </div>
        <br>
        <h3>프로필 기본정보 입력</h3>
        <div class="grid">

            <dl>
                <dt>거주지역구분</dt>
                <dd><select name="mb_addr_div" id="mb_addr_div">
                        <option>지역 선택</option>
                        <?php
                        foreach (array_keys($mb_addr_div_arr) as $item) {
                            ?>
                            <option value="<?=$item?>" <?=$mb['mb_addr_div'] == $item ? 'selected' : ''?>><?=$mb_addr_div_arr[$item]?></option>
                            <?php
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>결혼여부</dt>
                <dd class="select grid grid4">
                    <input type="radio" id="radio1" name="mb_merry" value="초혼" <?=$mb['mb_merry'] == '초혼' ? 'checked' : ''?>><label for="radio1">초혼</label>
                    <input type="radio" id="radio2" name="mb_merry" value="재혼" <?=$mb['mb_merry'] == '재혼' ? 'checked' : ''?>><label for="radio2">재혼</label>
                    <input type="radio" id="radio3" name="mb_merry" value="썸혼" <?=$mb['mb_merry'] == '썸혼' ? 'checked' : ''?>><label for="radio3" class="block" tooltip="자녀없이 이혼한  돌싱">썸혼</label>
                    <input type="radio" id="radio4" name="mb_merry" value="황혼" <?=$mb['mb_merry'] == '황혼' ? 'checked' : ''?>><label for="radio4" class="block" tooltip="60세이후 혼자">황혼</label>
                </dd>
            </dl>

            <dl>
                <dt><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></dt>
                <dd>
                    <?php if ($config['cf_cert_use']) { ?>
                        <span class="frm_info">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</span>
                    <?php } ?>
                    <input placeholder="이름" type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($mb['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="<?php echo $required ?> <?php echo $readonly ?>" size="10">
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
                    if ($config['cf_cert_use'] && $mb['mb_certify']) {
                        if($mb['mb_certify'] == 'ipin')
                            $mb_cert = '아이핀';
                        else
                            $mb_cert = '휴대폰';
                        ?>
                        <div id="msg_certify">
                            <strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($mb['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
                        </div>
                    <?php } ?>
                </dd>
            </dl>
            <dl>
                <dt><label for="reg_mb_tel">연락처<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label></dt>
                <dd>
                    <p class="flex ai-c">
                        <input placeholder="연락처" type="text" name="mb_tel" value="<?php echo get_hp(get_text($mb['mb_tel']),1) ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="<?php echo $config['cf_req_tel']?"required":""; ?>" oninput="maxLengthCheck(this)" maxlength="13">

                    </p>
            </dl>



            <dl>
                <dt><label for="reg_mb_email"><strong>E-mail</strong>(*아이디 필수)<strong class="sound_only">필수</strong></label></dt>
                <dd>
                    <input placeholder="E-mail" type="text" name="mb_id" value="<?php echo isset($mb['mb_id'])?$mb['mb_id']:''; ?>" id="reg_mb_id" required class="email required" size="70" maxlength="100" <?php echo $w == 'u' ?'readonly':''; ?> >
                </dd>
            </dl>
            <dl>
                <dt><label for="reg_mb_email"><strong>비밀번호</strong>(*필수)<strong class="sound_only">필수</strong></label></dt>
                <dd class="flex">
                    <input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20">
                </dd>
            </dl>
            <dl>
                <dt>성별</dt>
                <dd class="v_center">
                    <input type="radio" id="female" name="mb_sex" value="F" <?=$mb['mb_sex'] == 'F' ? 'checked' : ''?>><label for="female">여자</label>
                    <input type="radio" id="male" name="mb_sex" value="M" <?=$mb['mb_sex'] == 'M' ? 'checked' : ''?>><label for="male">남자</label>
                </dd>
            </dl>
            <dl>
                <dt><label for="">종교</label></dt>
                <dd>
                    <select name="mb_religion">
                        <option value="무교" <?=$mb['mb_religion'] == '무교' ? 'selected' : ''?>>무교</option>
                        <option value="기독교" <?=$mb['mb_religion'] == '무교' ? 'selected' : ''?>>기독교</option>
                        <option value="불교" <?=$mb['mb_religion'] == '무교' ? 'selected' : ''?>>불교</option>
                        <option value="천주교" <?=$mb['mb_religion'] == '무교' ? 'selected' : ''?>>천주교</option>
                        <option value="기타" <?=$mb['mb_religion'] == '무교' ? 'selected' : ''?>>기타</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt class="flex">
                    <label>생년월일</label>

                    <div class="v_center">
                        <input type="radio" id="radio9" name="mb_birth_div" class="md-radiobtn" value="양력" <?=$mb['mb_birth_div'] == '양력' ? 'checked' : ''?>>
                        <label for="radio9">양력 </label>
                        <input type="radio" id="radio10" name="mb_birth_div" class="md-radiobtn" value="음력" <?=$mb['mb_birth_div'] == '음력' ? 'checked' : ''?>>
                        <label for="radio10">음력 </label>
                    </div>
                </dt>
                <dd class="flex">
                    <input class="" type="number" placeholder="예시) 19840101 형태로" name="mb_birth" id="mb_birth" value="<?=$mb['mb_birth']?>" oninput="maxLengthCheck(this)" maxlength="8" min="8"/>
                    <input class="" type="text" placeholder="태어난 시간(선택)" name="mb_birth_time" id="mb_birth_time" value="<?=$mb['mb_birth_time']?>"/>
                </dd>
            </dl>
            <dl>
                <dt><label>최종 학력</label></dt>
                <dd>
                    <select name="mb_education">
                        <?php
                        foreach (array_keys($mb_education_arr) as $item) {
                            ?>
                            <option value="<?=$item?>" <?=$mb['mb_education'] == $item ? 'selected' : ''?>><?=$mb_education_arr[$item]?></option>
                            <?php
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <!--이미지 추가-->
            <?php if($w == 'u'){ ?>



                <dl>
                    <dt>사진 첨부 (이미지)</dt>
                    <dd>
                        <?php
                        $file = get_file('member_img',$mb['mb_no']);
                        $html = '';
                        foreach ($file as $row_file){
                            if($row_file['file']){
                                //var_dump(G5_DATA_URL.'/file/member_img/'.$row_file['file']);
                                //$thumb = thumbnail(G5_DATA_URL.'/file/member_img/'.$row_file['file'],"","",300,300);
                                $thumb = G5_DATA_URL.'/file/member_img/'.$row_file['file'];
                                $html .= '<img src="'.G5_DATA_URL.'/file/member_img/'.$row_file['file'].'" onclick="window.open(\''.$thumb.'\')" style="width:300px;height:300px">';
                            }
                        }

                        ?>

                        <?php for ($i=0; $i<2; $i++) { ?>
                            <div class="bo_w_flie write_div">
                                <div class="file_wr write_div">
                                    <label for="bf_file2_<?php echo $i+1 ?>" class="lb_icon"><i class="fa fa-folder-open" aria-hidden="true"></i><span class="sound_only"> 파일 #<?php echo $i+1 ?></span></label>
                                    <input type="file" name="bf_file2[]" id="bf_file2_<?php echo $i+1 ?>" class="frm_file ">
                                </div>
                                <?php if($w == 'u') { ?>
                                    <span class="file_del">
                                        <input type="checkbox" id="bf_file2_del<?php echo $i ?>" name="bf_file2_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file2_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                                    </span>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <div class="imageInput_wrap">
                            <?=$html?>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>사진 첨부</dt>
                    <dd>
                        <?php
                        $file = get_file('member',$mb['mb_no']);
                        $html = '';
                        foreach ($file as $row_file){
                            if($row_file['file']){
                                //var_dump(G5_DATA_URL.'/file/member_img/'.$row_file['file']);
                                //$thumb = thumbnail(G5_DATA_URL.'/file/member_img/'.$row_file['file'],"","",300,300);
                                $thumb = G5_DATA_URL.'/file/member_file/'.$row_file['file'];
                                $html .= '<img src="'.G5_DATA_URL.'/file/member_file/'.$row_file['file'].'" onclick="window.open(\''.$thumb.'\')" style="width:300px;height:300px">';
                            }
                        }

                        ?>

                        <?php for ($i=0; $i<5; $i++) { ?>
                            <div class="bo_w_flie write_div">
                                <div class="file_wr write_div">
                                    <label for="bf_file_<?php echo $i+1 ?>" class="lb_icon"><i class="fa fa-folder-open" aria-hidden="true"></i><span class="sound_only"> 파일 #<?php echo $i+1 ?></span></label>
                                    <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" class="frm_file ">
                                </div>
                                <?php if($w == 'u') { ?>
                                    <span class="file_del">
                                        <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                                    </span>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <div class="imageInput_wrap">
                            <?=$html?>
                        </div>
                    </dd>
                </dl>





            <?php }else{ ?>
                <!--이미지 추가-->
                <?php if($w == ''){ ?>
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
            <?php } ?>


            <dl>
                <dt><label>고등학교</label></dt>
                <dd>
                    <input type="text" placeholder="학교명" name="mb_highschool" id="mb_highschool" value="<?=$mb['mb_highschool']?>"/>
                    <input type="text" placeholder="소재지" name="mb_highschool2" id="mb_highschool2" value="<?=$mb['mb_highschool2']?>"/>
                </dd>
            </dl>
            <dl>
                <dt><label>대학교/전문대</label></dt>
                <dd>
                    <input type="text" placeholder="학교명" name="mb_university" id="mb_university" value="<?=$mb['mb_university']?>"/>
                    <input type="text" placeholder="소재지" name="mb_university2" id="mb_university2" value="<?=$mb['mb_university2']?>"/>
                    <input type="text" placeholder="학과" name="mb_university3" id="mb_university3" value="<?=$mb['mb_university3']?>"/>
                    <input type="text" placeholder="졸업년도" name="mb_university4" id="mb_university4" value="<?=$mb['mb_university4']?>" oninput="maxLengthCheck(this)" maxlength="4"/>
                </dd>
            </dl>
            <dl>
                <dt><label>대학원(석사)</label></dt>
                <dd>
                    <input type="text" placeholder="학교명" name="mb_master" id="mb_master" value="<?=$mb['mb_master']?>"/>
                    <input type="text" placeholder="소재지" name="mb_master2" id="mb_master2" value="<?=$mb['mb_master2']?>"/>
                    <input type="text" placeholder="학과" name="mb_master3" id="mb_master3" value="<?=$mb['mb_master3']?>"/>
                    <input type="text" placeholder="졸업년도" name="mb_master4" id="mb_master4" value="<?=$mb['mb_master4']?>" oninput="maxLengthCheck(this)" maxlength="4"/>
                </dd>
            </dl>
            <dl>
                <dt><label>대학원(박사)</label></dt>
                <dd>
                    <input type="text" placeholder="학교명" name="mb_doctor" id="mb_doctor" value="<?=$mb['mb_doctor']?>"/>
                    <input type="text" placeholder="소재지" name="mb_doctor2" id="mb_doctor2" value="<?=$mb['mb_doctor2']?>"/>
                    <input type="text" placeholder="학과" name="mb_doctor3" id="mb_doctor3" value="<?=$mb['mb_doctor3']?>"/>
                    <input type="text" placeholder="졸업년도" name="mb_doctor4" id="mb_doctor4" value="<?=$mb['mb_doctor4']?>" oninput="maxLengthCheck(this)" maxlength="4"/>
                </dd>
            </dl>

            <dl>
                <dt><label>직업 정보</label></dt>
                <dd>
                    <select name="mb_job_div">
                        <?php
                        foreach (array_keys($mb_job_arr) as $item) {
                            ?>
                            <option value="<?=$item?>" <?=$mb['mb_job_div'] == $item ? 'selected' : ''?>><?=$mb_job_arr[$item]?></option>
                            <?php
                        }
                        ?>
                        <!-- 나머지 옵션들 -->
                    </select>
                    <input type="text" placeholder="직장명" name="mb_job_title" value="<?=$mb['mb_job_title']?>"/>
                    <input type="text" placeholder="직장 위치" name="mb_job_addr" value="<?=$mb['mb_job_addr']?>"/>
                    <input type="text" placeholder="직원수(사업자만)" name="mb_job_people" value="<?=$mb['mb_job_people']?>"/>
                    <input type="text" placeholder="창립일자(사업자만)" name="mb_job_date" value="<?=$mb['mb_job_date']?>"/>
                </dd>
            </dl>
            <dl>
                <dt><label>연봉&연수입</label></dt>
                <dd><input type="text" placeholder="연봉 & 보너스 & 금융수익 & 임대수익 포함" name="mb_job_price" value="<?=$mb['mb_job_price']?>"/></dd>
            </dl>
            <dl>
                <dt><label>본인 소유 동산 자산</label></dt>
                <dd><input type="text" placeholder="현금 & 예금 & 차량 등 동산 자산 내역" name="mb_money" value="<?=$mb['mb_money']?>"/></dd>
            </dl>
            <dl>
                <dt><label>본인 소유 부동산 자산</label></dt>
                <dd><input type="text" placeholder="본인 소유 부동산 자산 내역" name="mb_money2" value="<?=$mb['mb_money2']?>"/></dd> </dl>
            <dl>
                <dt><label>현재 주민등록상 주소</label></dt>
                <dd><input type="text" placeholder="주소" name="mb_addr1" value="<?=$mb['mb_addr1']?>"/></dd> </dl>
            <dl>
                <dt><label>동거인 정보</label></dt>
                <dd><input type="text" placeholder="ex) 부모님과 함께 / 혼자 / 동생과 함께 등" name="mb_inmate" value="<?=$mb['mb_inmate']?>"/></dd> </dl>
            <dl>
                <dt><label>가족관계</label></dt>
                <dd><input type="text" placeholder="ex) 2남 1녀 중 막내" name="mb_family" value="<?=$mb['mb_family']?>"/> </dd>
            </dl>
            <dl>
                <dt><label>부모님 정보</label></dt>
                <dd><input type="text" placeholder="아버지 직업" name="mb_dad" value="<?=$mb['mb_dad']?>"/>
                    <input type="text" placeholder="아버지 학력" name="mb_dad2" value="<?=$mb['mb_dad2']?>"/>
                    <input type="text" placeholder="어머니 직업" name="mb_mom" value="<?=$mb['mb_mom']?>"/>
                    <input type="text" placeholder="어머니 학력" name="mb_mom2" value="<?=$mb['mb_mom2']?>"/>
                    <input type="text" placeholder="부모님 소유 자산 금액" name="mb_family_money" value="<?=$mb['mb_family_money']?>"/></dd>
                <input type="text" placeholder="부모님 연락처" name="mb_family_hp" id="reg_mb_family_hp" value="<?=$mb['mb_family_hp']?>" oninput="maxLengthCheck(this)" maxlength="13"/>
            </dl>
            <dl>
                <dt><label>취미</label></dt>
                <dd><input type="text" placeholder="취미" name="mb_hobby" value="<?=$mb['mb_hobby']?>"/> </dd>
            </dl>

            <dl>
                <dt><label>신체 정보</label></dt>
                <dd><input type="text" placeholder="키 (cm)" name="mb_height" value="<?=$mb['mb_height']?>" oninput="maxLengthCheck(this)" maxlength="3"/>
                    <input type="text" placeholder="몸무게 (kg)" name="mb_weight" value="<?=$mb['mb_weight']?>" oninput="maxLengthCheck(this)" maxlength="3"/></dd>
            </dl>

            <dl>
                <dt>
                    <label>미팅 가능 지역</label>
                </dt>
                <dd>
                    <input type="text" placeholder="ex. 서울경기인근 / 주변지역만 등" name="mb_meeting" value="<?=$mb['mb_meeting']?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>선호하는 이상형 직업</label>
                </dt>
                <dd>
                    <input type="text" placeholder="ex. 무관 / 대기업 / 사업가 등" name="mb_love_job" value="<?=$mb['mb_love_job']?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>선호하는 이상형의 나이</label>
                </dt>
                <dd>
                    <input type="text" placeholder="ex. 무관 / 몇 년생부터 몇 년생까지" name="mb_love_age" value="<?=$mb['mb_love_age']?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>선호하는 이상형의 키</label>
                </dt>
                <dd>
                    <input type="text" placeholder="ex. 무관 / OOOcm 이상" name="mb_love_height" value="<?=$mb['mb_love_height']?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>선호하는 이상형의 연봉</label>
                </dt>
                <dd>
                    <input type="text" placeholder="ex. 무관 / OOOO만원 이상" name="mb_love_money" value="<?=$mb['mb_love_money']?>" />
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>선호하는 이상형의 자산</label>
                </dt>
                <dd>
                    <input type="text" placeholder="ex. 무관 / OOOO원 이상" name="mb_love_money2" value="<?=$mb['mb_love_money2']?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>선호하는 이상형의 종교</label>
                </dt>
                <dd>
                    <input type="text" placeholder="ex. 무관 / 선호 or 기피 정보" name="mb_love_religion" value="<?=$mb['mb_love_religion']?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>선호하는 이상형의 학력</label>
                </dt>
                <dd>
                    <input type="text" placeholder="ex. 무관 / OOO졸업 이상" name="mb_love_education" value="<?=$mb['mb_love_education']?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>신체적/정신적 문제 여부</label>
                </dt>
                <dd>
                    <input type="text" placeholder="미팅 상대가 미리 알아야할 내용이라면 적어주세요" name="mb_problem" value="<?=$mb['mb_problem']?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>자기소개 [ 상대방에게 공개되는 내용 ]</label>
                </dt>
                <dd>
                    <textarea class="form-control" name="mb_profile"><?=$mb['mb_profile']?></textarea>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label>기피사항 [ 매니저만 확인하는 내용 ]</label>
                </dt>
                <dd>
                    <textarea class="form-control" name="mb_memo_call"><?=$mb['mb_memo_call']?></textarea>
                </dd>
            </dl>

            <dl>
                <dt><label>재혼인 경우만 적어주세요</label></dt>
                <dd>
                    <input type="text" placeholder="자녀수 ex) 아들1(몇년생) 딸1(몇년생)" name="mb_digamy" value="<?=$mb['mb_digamy']?>">
                    <input type="text" placeholder="양육자 (배우자 / 본인)" name="mb_digamy2" value="<?=$mb['mb_digamy2']?>">
                    <input type="text" placeholder="결혼년도" name="mb_digamy3" value="<?=$mb['mb_digamy3']?>">
                    <input type="text" placeholder="이혼년도" name="mb_digamy4" value="<?=$mb['mb_digamy4']?>">
                    <input type="text" placeholder="이혼사유" name="mb_digamy5" value="<?=$mb['mb_digamy5']?>">
                    <input type="text" placeholder="상대 자녀 양육 가능한지?" name="mb_digamy6" value="<?=$mb['mb_digamy6']?>">
                </dd>
            </dl>


        </div>
        <br>
        <div class="box_red">
            <i class="fa-duotone fa-circle-exclamation"></i> 허위 정보 입력으로 인하여 발생하는 모든 민/형사상 책임은 본인에게 있음에 동의합니다.
        </div>
    </div>
    <div class="tbl_frm01 tbl_wrap">
        <div class="grid grid2">
        <?php if ($config['cf_use_recommend']) { // 추천인 사용 ?>
            <dl>
                <dt>추천인</th>
                <dd><?php echo ($mb['mb_recommend'] ? get_text($mb['mb_recommend']) : '없음'); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?></dd>
            </dl>
        <?php } ?>

        <dl>
            <dt><label for="mb_leave_date">탈퇴일자</label></th>
            <dd>
                <input type="text" name="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>" id="mb_leave_date" maxlength="8">
                <p class="flex jc-l">
                    <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
    this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
                <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
                </p>
            </dd>
            <dt>접근차단일자</th>
            <dd>
                <input type="text" name="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>" id="mb_intercept_date"  maxlength="8">
                <p class="flex jc-l">
                <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
    (this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
    this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
                <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>
                </p>
            </dd>
        </dl>

        <dl>
            <dt><label for="mb_level">회원 권한</label></th>
            <dd><?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?></dd>
        </dl>
    </div>
        <div class="btn_confirm01 btn_confirm">
            <input type="submit" value="확인" class="btn_submit" accesskey='s'>
            <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
        </div>
    </div>



</div>
</form>


<script>

    $(document).ready(function () {

        $(function () {

            $('#reg_mb_hp, #reg_ad_hp, #reg_mb_tel').keydown(function (event) {
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


</script>

</div>
<!-- } 회원정보 입력/수정 끝 -->


<script>
function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
        alert('아이콘은 gif 파일만 가능합니다.');
        return false;
    }

    return true;
}








</script>

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

        // 대표 이미지로 설정하는 함수
        function setRepresentativeImage(imageElement) {
            // 기존에 대표 이미지로 설정된 이미지에서 클래스 제거
            const previousRepresentative = document.querySelector('.preview-item.representative');
            if (previousRepresentative) {
                previousRepresentative.classList.remove('representative');
            }

            // 대표 이미지로 설정된 이미지에 클래스 추가
            imageElement.closest('.preview-item').classList.add('representative');

            //alert('대표 이미지로 설정되었습니다.');
            // 여기에 대표 이미지로 설정하는 로직을 추가하세요
        }

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
        for (var i = 1; i <= 4; i++) {
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
<?php
include_once('./admin.tail.php');
?>
