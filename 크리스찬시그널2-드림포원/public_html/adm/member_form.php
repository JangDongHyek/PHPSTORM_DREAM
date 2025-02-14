<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$sca = !empty($_GET['sca'])? $sca : "member";
$required_class = 'required';

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
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);

    $mi = sql_fetch(" select * from g5_member_interview where mb_no = {$mb['mb_no']} ");

    $hide_class = 'hide';
    if($mi['interview2_text1'] == '직접기재') { $hide_class = ''; }
    if($mi['interview3_text1'] == '직접기재') { $hide_class = ''; }
    if($mi['interview4_text1'] == '직접기재') { $hide_class = ''; }
    if($mi['interview5_text1'] == '직접기재') { $hide_class = ''; }

    if(!empty($mb['mb_social_role'])) {
        $social_role = sql_fetch(" select co_main_code_value from g5_code where co_code = '{$mb['mb_social_role']}' ")['co_main_code_value'];
    } else {
        $social_role = '회사원';
    }

    // 생년월일로 나이 계산
    $birthyear = substr($mb['mb_birth'],0,4);
    $nowyear = date("Y");
    $age = $nowyear - $birthyear + 1;

    if($mb['mb_9'] == 'N'){
        $sql = "update g5_member set mb_9 = 'Y' where mb_id = '{$mb_id}'";
        sql_query($sql);
    }

}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

if($sca == 'member') {
    $required_class = '';
}

/*
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
*/

//만나정보
$sql_common = " from g5_member_point as mp 
                left join g5_member as mb on mb.mb_id = mp.mb_id
                left join g5_member as mb2 on mb2.mb_id = mp.rel_mb_id
                where 1=1 and mb.mb_id = '{$mb_id}' ";

if (!$sst) {
    $sst = "idx";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$sql = " select mp.*, mb.mb_name, mb.mb_nick, mb2.mb_name as rel_mb_name {$sql_common} {$sql_order}  ";
//echo $sql;
$point_result = sql_query($sql);
//만나정보 끝

//유저간의 대화기록

$sql_common = " from g5_message as me left join g5_member as send on me.send_mb_no = send.mb_no left join g5_member as receive on me.receive_mb_no = receive.mb_no where 1=1 and me.show_yn is null ";

if (!$sst) {
    $sst = "message_date";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql_search2 = " and send.mb_level = 2 ";
$sql_search10 = " and send.mb_level = 10 ";
$sql_search = "and (receive.mb_id = '{$mb_id}' or send.mb_id = '{$mb_id}' )";


$sql1 = " select me.*, send.mb_name as send_mb_name, receive.mb_name as receive_mb_name {$sql_common} {$sql_search2} {$sql_search} {$sql_order}";
$sql2 = " select me.*, send.mb_name as send_mb_name, receive.mb_name as receive_mb_name {$sql_common} {$sql_search10} {$sql_search} {$sql_order}";

$user_talk_result = sql_query($sql1);
$admin_talk_result = sql_query($sql2);

$admin_talk_total_cnt = sql_num_rows($admin_talk_result);
$user_talk_total_count = sql_num_rows($user_talk_result);

//관리자 메모
$sql = "select * from new_memo where memo_mb_id = '{$mb_id}' ";
$memo_result = sql_query($sql);

//결제정보
$sql = "select * from g5_payment where userid = '{$mb_id}' and ResultCode = '3001' order by idx desc ";
$payment_result = sql_query($sql);
$payment_total_count = sql_num_rows($payment_result);

//희망배우자정보
$sql = "select * from g5_member_hope where mb_id = '{$mb_id}' ";
$mh = sql_fetch($sql);
$mh_job = explode(",",$mh["mh_job"]);
$mh_height = explode(",",$mh["mh_height"]);
$mh_school = explode(",",$mh["mh_school"]);
$mh_salary = explode(",",$mh["mh_salary"]);
$mh_type = explode(",",$mh["mh_type"]);
$mh_marry_yn = explode(",",$mh["mh_marry_yn"]);

//신앙정보
$sql = "select * from new_member_interview where mb_id = '{$mb_id}' ";
$mi = sql_fetch($sql);

$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<style>
    body, input::placeholder {
        font-family: "Nanum Gothic";
    }
    table caption {
        height: 30px;
        font-size: 15px;
        overflow: hidden;
        text-align: left;
        font-weight: bold;
        line-height: 1.5;
    }
    .mb_5 {
        margin-bottom: 5px;
    }
    .code {
        float: left;
        width: 100px;
        height: 20px;
        border: 1px solid black;
        text-align: center;
        margin-right: 5px;
        margin-bottom: 5px;
        cursor: pointer;
    }
    .btn_add .tab {float: left;width: 100%; list-style: none; padding: 0; margin: 0; margin-bottom: 10px;}
    .btn_add .tab li {float: left;}
    .btn_add .tab a {border-left: 0; background: #FFF;}
    .btn_add .tab .on {background: #f0f0f0;}
    .btn_add .tab li:nth-child(1) a {border-left: 1px solid #ccc;}
    .on {background: lightblue;}
    .btn_approval {
        margin: 0; padding: 0; border: 0; background: blue; color: #fff; cursor: pointer;
    }
    .btn_confirm .btn_approval {
        padding: 0 15px; border: 0; height: 30px; color: #fff;
    }
    .file_select {
        border: 1px solid black; width: 80px; text-align: center; margin-top: 5px; background-color: lightgray; height: 20px;
    }
    .hide {
        display: none;
    }
    .tab_interview select {
        width: 300px;
    }
    .tbl_wrap {
        position: relative;
        top: 30px;
    }
</style>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return code_check();fmember_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="sca" value="<?=$sca?>">
    <input type="hidden" name="hobby_code" value="">
    <input type="hidden" name="mb_level" value="<?=$mb['mb_level']?>">
    <input type="hidden" name="del_mb_img" value="">
    <input type="hidden" name="del_mb_file" value="">

    <?php for ($i=1; $i<=10; $i++) { ?>
        <input type="hidden" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>">
    <?php } ?>

    <div class="btn_add01 btn_add" style="position: relative;">
        <ul class="tab">
            <li><a id="member" <? if ($sca == "member") { ?>class="on"<? } ?> data-sca="member">기본정보</a></li>
<!--            <li><a id="interview" --><?// if ($sca == "interview") { ?><!--class="on"--><?// } ?><!-- data-sca="interview">인터뷰</a></li>-->
            <li><a id="hobby" <? if ($sca == "hobby") { ?>class="on"<? } ?> data-sca="hobby">나의정보</a></li>
            <li><a id="point" <? if ($sca == "point") { ?>class="on"<? } ?> data-sca="point">만나정보</a></li>
            <li><a id="user_talk" <? if ($sca == "user_talk") { ?>class="on"<? } ?> data-sca="user_talk">회원과의 대화기록</a></li>
            <li><a id="adm_talk" <? if ($sca == "adm_talk") { ?>class="on"<? } ?> data-sca="adm_talk">관리자와 대화기록</a></li>
            <!--
            <li><a id="adm_memo" <? if ($sca == "adm_memo") { ?>class="on"<? } ?> data-sca="adm_memo">관리자 메모</a></li>
            -->
            <li><a id="payment" <? if ($sca == "payment") { ?>class="on"<? } ?> data-sca="payment">결제정보</a></li>
        </ul>
    </div>


    <!-- 회원-기본정보 -->
    <div class="tbl_frm01 tbl_wrap tab_member">
        <h1 class="subj" style="position: absolute;">회원정보</h1>
        <table>
            <!--<caption>기본 정보</caption>-->
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_id">* 아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="30" minlength="3" maxlength="20">
                    <? /*
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
			*/ ?>
                </td>
                <th scope="row"><label for="mb_password">* 비밀번호<?php echo $sound_only ?></label></th>
                <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">* 이름<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="30" maxlength="20"></td>
                <th scope="row"><label for="mb_nick">* 닉네임<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_nick" value="<?php echo $mb['mb_nick'] ?>" id="mb_name" required class="required frm_input" size="30" maxlength="20"></td>

            </tr>
            <tr>
                <th scope="row"><label for="mb_certify_ID_yn">* 성별<strong class="sound_only">필수</strong></label></th>
                <td>
                    <label for="mb_sex" style="font-weight: bold;">성별<strong class="sound_only">필수</strong></label>
                    <input type="radio" name="mb_sex" value="남" id="mb_sex_men" <?php if($mb['mb_sex'] == '남') echo 'checked="checked"'; ?> style="margin-left: 10px;">
                    <label for="mb_sex_men">남</label>
                    <input type="radio" name="mb_sex" value="여" id="mb_sex_woman" <?php if($mb['mb_sex'] == '여') echo 'checked="checked"'; ?> style="margin-left: 10px;">
                    <label for="mb_sex_woman">여</label>
                </td>
                <th scope="row"><label for="mb_birth">* 생년월일<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="mb_birth" value="<?php echo $mb['mb_birth'] ?>" id="mb_birth" required class="required frm_input" size="30" placeholder="생년월일 입력 (예:19801025)">
                    (나이 : <?=$age?>세)
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_introduce">* 나를 어필하는 한마디<br>(상대방에게 공개되는 내용입니다)<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="mb_introduce" id="mb_introduce" class="regist-input">
                        <option value="" selected>나를 어필할 수 있는 소개글 선택</option>
                        <option value="안녕하세요">안녕하세요</option>
                        <option value="반갑습니다">반갑습니다</option>
                        <option value="좋은분 만나고 싶어요">좋은분 만나고 싶어요</option>
                        <option value="직접입력">직접입력</option>
                    </select>
                    <input type="text" style="display: none;width: 700px" name="mb_introduce_memo" value="<?php if($w=='u') { echo $mb['mb_introduce']; } else { echo $_POST['mb_introduce']; } ?>" id="mb_introduce_memo" class="frm_input" placeholder="">
                </td>
                <th scope="row"><label for="mb_hp">* 휴대폰번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" required class="required frm_input" size="30" maxlength="13" onkeyup="inputPhoneNumber(this)"></td>

            </tr>
            <tr>
                <th scope="row"><label for="mb_join_type">* 가입유형<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <input type="radio" name="mb_join_type" value="초혼" id="mb_join_type_1" <?php if($mb['mb_join_type'] == '초혼') echo 'checked="checked"'; ?>>
                    <label for="mb_join_type_1">초혼</label>
                    <input type="radio" name="mb_join_type" value="재혼" id="mb_join_type_2" <?php if($mb['mb_join_type'] == '재혼') echo 'checked="checked"'; ?>>
                    <label for="mb_join_type_2">재혼</label>
                    <input type="radio" name="mb_join_type" value="장애인" id="mb_join_type_3" <?php if($mb['mb_join_type'] == '장애인') echo 'checked="checked"'; ?>>
                    <label for="mb_join_type_3">장애인</label>
                </td>
                <?php if($mb['mb_join_type'] == '장애인') { ?>
                 <tr>
                    <th scope="row"><label for="mb_join_type_de">* 장애유형<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <?php
                        $count = sql_fetch(" select count(*) as count from g5_member_disabled where mb_no = {$mb['mb_no']}; ")['count'];

                        $sql = " select * from g5_member_disabled where mb_no = {$mb['mb_no']} order by idx ";
                        $result = sql_query($sql);

                            for($i=0; $row=sql_fetch_array($result); $i++) {
                                ?>
                                <div style="cursor: unset;!important;" class="code result result_<?=$i?>"><span class="a"><?=$row['disab_type1']?></span><span class="b"><?=$row['disab_type2']?></span></div>
                                <?php
                            }
                            ?>
                        </td>
                        <th scope="row"></th>
                        <td></td>
                    </tr>
            <?php } ?>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- 회원-기본정보 -->

    <div class="tbl_frm01 tbl_wrap tab_member">
        <h1 class="subj" >희망 배우자정보</h1>
        <table>
            <!--<caption>기본 정보</caption>-->
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_id">* 희망하는 직업<?php echo $sound_only ?></label></th>
                <td>
                    <?php for ($i=1; $i <= count($mh_job_arr); $i++) {
                        $checked = "";
                        for ($a = 0; $a <count($mh_job); $a++){
                            if ($mh_job[$a] == $mh_job_arr[$i]["code"]) {
                                $checked = "checked";
                            }
                        }

                        ?>
                        <span>
                            <input type="checkbox" name="mh_job[]" value = "<?=$mh_job_arr[$i]["code"]?>" <?=$checked?> id="sec01_01_0<?=$i?>">
                            <label for="sec01_01_0<?=$i?>"><?=$mh_job_arr[$i]["name"]?></label>
                        </span>
                    <?php } ?>
                    <?php  if (in_array('8', $mh_job)) echo "<br>직접기재: <input class = \"frm_input\" type=\"text\" value = \"".$mh['mh_job_memo']."\" name=\"mh_job_memo\" placeholder=\"희망하는 직업을 입력하세요\">" ?>
                </td>
                <th scope="row"><label for="mb_password">* 희망하는 키<?php echo $sound_only ?></label></th>
                <td>
                <?php for ($i=1; $i <= count($mh_height_arr); $i++) {
                    $checked = "";
                    for ($a = 0; $a <count($mh_height); $a++){
                        if ($mh_height[$a] == $mh_height_arr[$i]["code"]) {
                            $checked = "checked";
                        }
                    }

                    ?>
                    <span>
                                <input type="checkbox" name="mh_height[]" value = "<?=$mh_height_arr[$i]["code"]?>" <?=$checked?> id="sec01_02_0<?=$i?>">
                                <label for="sec01_02_0<?=$i?>"><?=$mh_height_arr[$i]["name"]?></label>
                            </span>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_password">* 희망하는 학벌<?php echo $sound_only ?></label></th>
                <td>
                    <?php for ($i=1; $i <= count($mh_school_arr); $i++) {
                        $checked = "";
                        for ($a = 0; $a <count($mh_school); $a++){
                            if ($mh_school[$a] == $mh_school_arr[$i]["code"]) {
                                $checked = "checked";
                            }
                        }

                        ?>
                        <span>
                                <input type="checkbox" name="mh_school[]" value = "<?=$mh_school_arr[$i]["code"]?>" <?=$checked?> id="sec01_03_0<?=$i?>">
                                <label for="sec01_03_0<?=$i?>"><?=$mh_school_arr[$i]["name"]?></label>
                            </span>
                    <?php } ?>
                </td>
                <th scope="row"><label for="mb_password">* 희망하는 연봉<?php echo $sound_only ?></label></th>
                <td>
                    <?php for ($i=1; $i <= count($mh_salary_arr); $i++) {
                        $checked = "";
                        for ($a = 0; $a <count($mh_salary); $a++){
                            if ($mh_salary[$a] == $mh_salary_arr[$i]["code"]) {
                                $checked = "checked";
                            }
                        }

                        ?>
                        <span>
                                <input type="checkbox" name="mh_salary[]" value = "<?=$mh_salary_arr[$i]["code"]?>" <?=$checked?> id="sec01_04_0<?=$i?>">
                                <label for="sec01_04_0<?=$i?>"><?=$mh_salary_arr[$i]["name"]?></label>
                            </span>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_password">* 희망하는 근무형태<?php echo $sound_only ?></label></th>
                <td>
                    <?php for ($i=1; $i <= count($mh_type_arr); $i++) {
                        $checked = "";
                        for ($a = 0; $a <count($mh_type); $a++){
                            if ($mh_type[$a] == $mh_type_arr[$i]["code"]) {
                                $checked = "checked";
                            }
                        }

                        ?>
                        <span>
                                <input type="checkbox" name="mh_type[]" value = "<?=$mh_type_arr[$i]["code"]?>" <?=$checked?> id="sec01_05_0<?=$i?>">
                                <label for="sec01_05_0<?=$i?>"><?=$mh_type_arr[$i]["name"]?></label>
                            </span>
                    <?php } ?>
                </td>
                <th scope="row"><label for="mb_password">* 희망하는 스타일<?php echo $sound_only ?></label></th>
                <td>
                    <select name="mh_style" id="sec01_06" class="form-control" onchange="style_change(this.value)">
                        <option value="">선택하세요</option>
                        <?php for ($i = 1; $i <= count($mh_style_arr); $i++) { ?>
                            <option <?php if ($mh_style_arr[$i]["code"] == $mh["mh_style"] ) echo "selected" ?>  value="<?=$mh_style_arr[$i]["code"]?>"><?=$mh_style_arr[$i]["name"]?></option>
                        <?php } ?>
                    </select>
                    <?php  if ($mh["mh_style"] == 5 ) echo "<input class = \"frm_input\" type=\"text\" value = \"".$mh['mh_style_memo']."\" name=\"mh_style_memo\" >" ?>

                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_password">* 희망하는 상대의 결혼여부<?php echo $sound_only ?></label></th>
                <td colspan="1">
                    <?php for ($i=1; $i <= count($mh_marry_yn_arr); $i++) {
                        $checked = "";
                        for ($a = 0; $a <count($mh_marry_yn); $a++){
                            if ($mh_marry_yn[$a] == $mh_marry_yn_arr[$i]["code"]) {
                                $checked = "checked";
                            }
                        }

                        ?>
                        <span>
                                <input type="checkbox" name="mh_marry_yn[]" value = "<?=$mh_marry_yn_arr[$i]["code"]?>" <?=$checked?> id="sec01_07_0<?=$i?>">
                                <label for="sec01_07_0<?=$i?>"><?=$mh_marry_yn_arr[$i]["name"]?></label>
                            </span>
                    <?php } ?>
                </td>
                <!-- 7살차이 체크한거 변경하는기능 wc -->
                <th scope="row"><label for="mb_certify_ID_yn">7살차이 제한<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="radio" name="mh_ten" value="Y" id="mh_ten_yes" <?php if($mh['mh_ten'] == 'Y') echo 'checked="checked"'; ?> style="margin-left: 10px;">
                    <label for="mb_sex_men">예</label>
                    <input type="radio" name="mh_ten" value="N" id="mh_ten_no" <?php if($mh['mh_ten'] == 'N') echo 'checked="checked"'; ?> style="margin-left: 10px;">
                    <label for="mb_sex_woman">잠시 제한해제</label>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="tbl_frm01 tbl_wrap tab_member">
        <h1 class="subj">신앙정보</h1>
        <table>
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="interview1">교회에 다니는지?</label></th>
                <td>
                    <?php for ($i = 1; $i <= count($mi_chance_arr); $i++){
                        if ($i==3){
                            echo "<br>";
                        }?>
                    <span class="sec02_00">
                        <input type="radio" <?php if ($i == $mi['mi_chance']) echo 'checked' ?> name="mi_chance" id="sec02_01_0<?=$i?>" value="<?=$i?>">
                        <label for="sec02_01_0<?=$i?>"><?=$mi_chance_arr[$i]?></label>
                    </span>
                    <?php } ?>

                </td>

                <th scope="row"><label for="interview1">교회에 다닌 기간?</label></th>
                <td>
                    <span><input type="radio" name="mi_date" id="sec02_02_01" value="1">
                        <label for="sec02_02_01">모태신앙</label></span>
                    <span><input type="radio" name="mi_date" id="sec02_02_02" value="2">
                        <label for="sec02_02_02">5년 이하</label></span>
                    <span><input type="radio" name="mi_date" id="sec02_02_03" value="3">
                        <label for="sec02_02_03">5~10년</label></span>
                    <span><input type="radio" name="mi_date" id="sec02_02_04" value="4">
                        <label for="sec02_02_04">10~15년</label></span>
                    <span><input type="radio" name="mi_date" id="sec02_02_05" value="5">
                        <label for="sec02_02_05">15~20년</label></span>
                    <span><input type="radio" name="mi_date" id="sec02_02_06" value="6">
                        <label for="sec02_02_06">25년 이상</label></span>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="interview1">봉사</label></th>
                <td>
                    <select name="mi_angel" id="sec02_03" class="form-control">
                        <option value="">선택하세요</option>
                        <option value="1">해본적 없지만 기회가 되면 하고싶다.</option>
                        <option value="2">한가지를 봉사하고 있다.</option>
                        <option value="3">두가지를 봉사하고 있다.</option>
                        <option value="4">과거에 했지만 지금 잠깐 쉬고있다.</option>
                        <option value="X">상관없음</option>
                    </select>
                </td>
                <th scope="row"><label for="interview1">십일조 여부</label></th>
                <td>
                    <span><input type="radio" name="mi_ten" id="sec02_04_01" value="Y">
					<label for="sec02_04_01">하고있다.</label></span>
                    <span><input type="radio" name="mi_ten" id="sec02_04_02" value="N">
					<label for="sec02_04_02">하지않는다.</label></span>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="interview1">감사헌금</label></th>
                <td>
                    <span><input type="radio" name="mi_tk" id="sec02_05_01" value="Y">
					<label for="sec02_05_01">하고있다.</label></span>
                    <span><input type="radio" name="mi_tk" id="sec02_05_02" value="N">
					<label for="sec02_05_02">하지않는다.</label></span>
                </td>
                <th scope="row"><label for="interview1">다니는 교회정보 입력</label></th>
                <td>
                    <span class="sm">
						<input type="checkbox" name="mi_church_open" id="info_op" value="1" <?php  if ($mi["mi_church_open"] == '1') echo "checked" ?>  ><em></em>
						<label for="info_op">공개</label>
					</span>
                    <input type="text" class="frm_input" name = "mi_church1" value = "<?=$mi['mi_church1']?>" placeholder="교회이름">
                    <input type="text" class="frm_input" name = "mi_church2" value = "<?=$mi['mi_church2']?>" placeholder="담임목사님 성함">

                </td>
            </tr>
            <tr>
                <th scope="row"><label for="interview1">교회위치</label></th>
                <td>
                    <select class="form-control required2" id="si" name="mi_church_place1" onchange="changeCity('si');">
                        <option value="">교회위치를 선택하세요</option>
                        <option value="서울">서울</option>
                        <option value="경기">경기</option>
                        <option value="세종">세종</option>
                        <option value="인천">인천</option>
                        <option value="부산">부산</option>
                        <option value="대구">대구</option>
                        <option value="대전">대전</option>
                        <option value="울산">울산</option>
                        <option value="광주">광주</option>
                        <option value="충남">충남</option>
                        <option value="충북">충북</option>
                        <option value="경남">경남</option>
                        <option value="경북">경북</option>
                        <option value="전남">전남</option>
                        <option value="전북">전북</option>
                        <option value="강원">강원</option>
                        <option value="제주">제주</option>
                    </select>
                    <select class="form-control" id="cur_gu" name="mi_church_place2" onchange="changeCity('gu');">
                        <option value="">선택하세요</option>
                    </select>
                    <select class="form-control" id="dong" name="mi_church_place3">
                        <option value="">선택하세요</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="tbl_frm01 tbl_wrap tab_member">
        <h1 class="subj">사진/서류정보</h1>
        <table>
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>

            <tr>
                <th scope="row">
                    <label for="mb_img">* 프로필 사진등록<strong class="sound_only">필수</strong><!--<br><div class="file_select" onclick="file_add();">파일선택</div>--></label>
                </th>
                <td colspan="3">
                    <input type="file" name="mb_img[]" id="mb_img" onchange="getImgPrev(this)" accept="image/*" multiple>
                    <div id="mb_img_prev" class="img_prev_wrap">
                        <?php
                        if ($w == "u") {
                            $count_sql = " select count(*) as count from g5_member_img where mb_no = {$mb['mb_no']} ";
                            $file_count = sql_fetch($count_sql)['count'];
                            $file_sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by thumb is null asc, idx ";
                            $file_result = sql_query($file_sql);

                            for($i=0; $file_row = sql_fetch_array($file_result); $i++) {
                                $img_file = G5_DATA_URL.'/file/member/'.$file_row['img_file'];
                                ?>
                                <span class="prev_area mb_icon" id="prev_area_<?=($i)?>">
                                    <input type="hidden" id="img_idx_<?=($i)?>" name="img_idx_<?=($i)?>" value="<?=$file_row['idx']?>">
                                    <button type="button" class="btn_del" onclick="mbImgDel('u', <?=($i)?>);" style="position: absolute;">X</button>
                                    <span class="img_bd" style="margin-right: 10px;">
                                        <img src="<?=$img_file?>" width="150px" height="150px">
                                    </span>
                                </span>
                                <?php
                            }
                            if($i==0) {
                                ?>
                                -
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <div id="file_input"></div>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_add">* 추가 서류<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <input type="file" name="mb_add[]" id="mb_add"  accept="image/*" multiple>
                    <?php
                    $filecount = sql_fetch(" select count(*) as count from g5_member_img_add where mb_no = '{$mb['mb_no']}' ")['count'];
                    if($filecount > 0) {
                        $file_sql = " select * from g5_member_img_add where mb_no = '{$mb['mb_no']}' order by idx; ";
                        $file_result = sql_query($file_sql);
                        for($j=0; $file=sql_fetch_array($file_result); $j++) {
                            ?>
                            <span class="fileName file_<?=$j?>">
                        <input type="hidden" id="file_idx_<?=($j)?>" name="file_idx_<?=($j)?>" value="<?=$file['idx']?>">
                        <p style="padding: unset;">
                            <?php if($private) { ?>
                                <img src="<?/*=G5_DATA_URL*/?>/file/member_add/<?/*=$file['img_file']*/?>" width="150px" height="150px">
                            <?php } ?>
                            <a style="text-decoration: underline;" href="<?=G5_DATA_URL?>/file/member_add/<?=$file['img_file']?>" download="<?=$file['img_source']?>"><?=$file['img_source']?></a>
                            <button type="button" class="btn_del" onclick="mbFileDel('u', <?=($j)?>);" style="position: absolute;margin-left: 10px;">X</button>
                        </p>
                    </span>
                            <br>
                            <?php
                        }
                    }
                    else {
                        ?>
                        -
                        <?php
                    }
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="tbl_frm01 tbl_wrap tab_adm_memo" style="display: ;">
        <div class="tbl_head02 ">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="*">
                    <col width="12%">
                </colgroup>
                <thead>
                <tr>
                    <!--<th scope="col">
                        <label for="chkall" class="sound_only">회원 전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>-->
                    <th>No.</th>
                    <th>메모</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody id="memo_tbody">
                <tr>
                    <td></td>
                    <td><textarea class="frm_input" type="text" id="memo_0" style="width: 100%" ></textarea></td>
                    <td><a class="btn_confirm" href="javascript: memo_update('memo_insert',0)">저장</a></td>
                </tr>
                <?php $colspan = 3;
                for ($k=0; $row=sql_fetch_array($memo_result); $k++) {
                    $s_mod = '<a class = "btn_confirm"  href="javascript: memo_update(\'memo_update\','.$row['idx'].')">수정</a>';
                    $s_mod .= '<a href="javascript: memo_del('.$row["idx"].')">삭제</a>';
                    $bg = 'bg'.($k%2);
                    ?>
                    <tr class="<?php echo $bg; ?>">
                        <!--<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
                        <td><?=$k+1?></td>
                        <td><textarea class="frm_input" type="text" id="memo_<?=$row['idx']?>" style="width: 100%; height: 70px"><?=$row['memo']?></textarea></td>
                        <td><?=$s_mod?></td>
                    </tr>
                    <?php
                    $admin_talk_total_cnt--;
                }
                if ($k == 0)
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">정보가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
        </div>

    </div>


    <!-- 회원-인터뷰 -->
    <?php/*

    <div class="tbl_frm01 tbl_wrap tab_interview" style="display: none;">
        <h1 class="subj" style="position: absolute;">프로필 (인터뷰)</h1>
        <table>
            <!--<caption>인터뷰</caption>-->
            <colgroup>
                <col class="grid_6">
                <col>
                <col class="grid_8">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="interview1">교회에서 섬겼던 역할이나 활동을 소개한다면?<br>(예 : 청년부에서 찬양팀 싱어로 활동했어요)<?php echo $sound_only ?></label></th>
                <td>
                    <select class="form-control" id="interview1_text1" name="interview1_text1">
                        <option value="">선택하세요</option>
                        <option value="경험은 없지만 해볼 생각이 있습니다.">경험은 없지만 해볼 생각이 있습니다.</option>
                        <option value="지금은 하지 않지만 다시 해볼 생각이 있습니다.">지금은 하지 않지만 다시 해볼 생각이 있습니다.</option>
                        <option value="일주일에 한번 다닙니다.">일주일에 한번 다닙니다.</option>
                        <option value="봉사활동 한 가지를 하고 있습니다.">봉사활동 한 가지를 하고 있습니다.</option>
                        <option value="봉사활동 두 가지를 하고 있습니다.">봉사활동 두 가지를 하고 있습니다.</option>
                    </select>
                </td>
                <th scope="row"><label for="interview2">자주 방문하거나, 추억으로 간직하고 있는 장소는?<br>(예 : 활기찬 분위기의 마로니에 공원)<?php echo $sound_only ?></label></th>
                <td style="width: 571px !important;">
                    <select class="form-control mb_5" id="interview2_text1" name="interview2_text1" onchange="change_select(this);">
                        <option value="">선택하세요</option>
                        <option value="편한 트레이닝복으로 가벼운 산책">편한 트레이닝복으로 가벼운 산책</option>
                        <option value="탁 트이고 시원한 바닷가">탁 트이고 시원한 바닷가</option>
                        <option value="도시와 조금 멀어진 드라이브">도시와 조금 멀어진 드라이브</option>
                        <option value="연인이 좋아하는 레포츠">연인이 좋아하는 레포츠</option>
                        <option value="직접기재">직접기재</option><!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                    </select>
                    <input type="text" name="interview2_text2" value="<?php echo $mi['interview2_text2'] ?>" id="interview2_text2" class="frm_input mb_5 <?php echo $required_class ?> direct2 <?=$hide_class?>" size="80">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="interview3">당신의 삶에 있어서 가장 기억에 남는 순간들은?<br>(예 : 오랜 시간 희망했던 회사에 입사했을 때)<?php echo $sound_only ?></label></th>
                <td style="width: 571px !important;">
                    <select class="form-control mb_5" id="interview3_text1" name="interview3_text1" onchange="change_select(this);">
                        <option value="">선택하세요</option>
                        <option value="모든게 즐거웠던 중고생 시절">모든게 즐거웠던 중고생 시절</option>
                        <option value="원하는 대학에 갔을 때">원하는 대학에 갔을 때</option>
                        <option value="희망하는 직장에 갔을 때">희망하는 직장에 갔을 때</option>
                        <option value="매순간이 소중하고 즐거웠다">매순간이 소중하고 즐거웠다</option>
                        <option value="직접기재">직접기재</option><!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                    </select>
                    <input type="text" name="interview3_text2" value="<?php echo $mi['interview3_text2'] ?>" id="interview3_text2" class="frm_input mb_5 <?php echo $required_class ?> direct3 <?=$hide_class?>" size="80"><br>
                </td>
                <th scope="row"><label for="interview4">당신의 매력포인트나 장점은?<br>(예 : 큰 키와 잘생긴 얼굴 / 상대를 배려하는 마음과 따뜻한 매너)<?php echo $sound_only ?></label></th>
                <td style="width: 571px !important;">
                    <select class="form-control mb_5" id="interview4_text1" name="interview4_text1" onchange="change_select(this);">
                        <option value="">선택하세요</option>
                        <option value="활발하고 명랑한 성격">활발하고 명랑한 성격</option>
                        <option value="훤칠하고 뽀대나는 아우라">훤칠하고 뽀대나는 아우라</option>
                        <option value="늘 긍정적이고 적극적인 마인드">늘 긍정적이고 적극적인 마인드</option>
                        <option value="분위기 잘 맞추고 눈치껏 발휘하는 센스">분위기 잘 맞추고 눈치껏 발휘하는 센스</option>
                        <option value="유머러스한 리더쉽">유머러스한 리더쉽</option>
                        <option value="직접기재">직접기재</option><!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                    </select>
                    <input type="text" name="interview4_text2" value="<?php echo $mi['interview4_text2'] ?>" id="interview4_text2" class="frm_input mb_5 <?php echo $required_class ?> direct4 <?=$hide_class?>" size="80"><br>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="interview5">연인이 생긴다면 함께 나누고 싶은 음식은?<br>(예 : 분위기 좋은 레스토랑에서 먹는 쉐프의 추천요리)<?php echo $sound_only ?></label></th>
                <td style="width: 571px !important;">
                    <select class="form-control mb_5" id="interview5_text1" name="interview5_text1" onchange="change_select(this);">
                        <option value="">선택하세요</option>
                        <option value="마음편하게 부담없이 한식찌개">마음편하게 부담없이 한식찌개</option>
                        <option value="분위기 있는 이태리 카페">분위기 있는 이태리 카페</option>
                        <option value="고즈넉하게 즐기는 브런치">고즈넉하게 즐기는 브런치</option>
                        <option value="서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살">서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살</option>
                        <option value="요리실력도 뽐낼겸 셀프요리 피크닉">요리실력도 뽐낼겸 셀프요리 피크닉</option>
                        <option value="직접기재">직접기재</option><!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                    </select>
                    <input type="text" name="interview5_text2" value="<?php echo $mi['interview5_text2'] ?>" id="interview5_text2" class="frm_input mb_5 <?php echo $required_class ?> direct5 <?=$hide_class?>" size="80"><br>
                </td>
                <th scope="row"><label for="interview6">당신의 평생 기도제목이 있다면?<br>(예 : 걱정없이 한달 간 세계 여행을 떠나고 싶어요)<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="interview6_text1" value="<?php echo $mi['interview6_text1'] ?>" id="interview6_text1" class="frm_input mb_5 <?php echo $required_class ?>" size="80"><br>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="interview7">연인이 생기면 함께 해보고 싶은 것?<br>(예 : 함께 공원 산책을 하며 대화를 나누고 싶어요)<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="interview7_text1" value="<?php echo $mi['interview7_text1'] ?>" id="interview7_text1" class="frm_input mb_5 <?php echo $required_class ?>" size="80"><br>
                </td>
                <th scope="row"><label for="interview8">당신이 공부했던/하고 있는 학교와 전공은?<br>(예 : 한국고등학교 / 서울대 경영학과)<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="interview8_text1" value="<?php echo $mi['interview8_text1'] ?>" id="interview8_text1" class="frm_input mb_5 <?php echo $required_class ?>" size="80"><br>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="interview9">당신이 일하고 있는/일했던 일터와 업무분야는?<br>(예 : 부산시청 공무원 / 스타벅스 우동점 점장)<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="interview9_text1" value="<?php echo $mi['interview9_text1'] ?>" id="interview9_text1" class="frm_input <?php echo $required_class ?>" size="80">
                </td>
                <th scope="row"><label for="interview10">하나님께 받은 비전, 혹은 마음에 품고 기도하는 비전은?<br>(예 : 진리롸 복음을 전하는 교사가 되기를 희망합니다)<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="interview10_text1" value="<?php echo $mi['interview10_text1'] ?>" id="interview10_text1" class="frm_input <?php echo $required_class ?>" size="80">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="interview11">마음속에 품고 있는 말씀과 찬양을 소개한다면?<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="interview11_text1" value="<?php echo $mi['interview11_text1'] ?>" id="interview11_text1" class="frm_input mb_5 <?php echo $required_class ?>" size="80" placeholder="좋아하는 말씀"><br>
                    <input type="text" name="interview11_text2" value="<?php echo $mi['interview11_text2'] ?>" id="interview11_text2" class="frm_input mb_5 <?php echo $required_class ?>" size="80" placeholder="이 말씀을 품게 된 계기 / 에피소드"><br>
                    <input type="text" name="interview12_text1" value="<?php echo $mi['interview12_text1'] ?>" id="interview12_text1" class="frm_input mb_5 <?php echo $required_class ?>" size="80" placeholder="좋아하는 찬양"><br>
                    <input type="text" name="interview12_text2" value="<?php echo $mi['interview12_text2'] ?>" id="interview12_text2" class="frm_input <?php echo $required_class ?>" size="80" placeholder="이 찬양을 품게 된 계기 / 에피소드">
                </td>
                <th scope="row"><label for="interview13">앞으로의 계획은? (신앙적, 사회적)<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="interview13_text1" value="<?php echo $mi['interview13_text1'] ?>" id="interview13_text1" class="frm_input mb_5 <?php echo $required_class ?>" size="80" placeholder="신앙적"><br>
                    <input type="text" name="interview14_text1" value="<?php echo $mi['interview14_text1'] ?>" id="interview14_text1" class="frm_input mb_5 <?php echo $required_class ?>" size="80" placeholder="사회적"><br>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
*/?>
    <!-- 회원-취미/관심사 -->
    <div class="tbl_frm01 tbl_wrap tab_hobby" style="display: ;">
        <br>
        <h1 class="subj" style="position: ;text-align: left">취미/관심사</h1>
        <table>

<!--            <caption>취미/관심사</caption>-->
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_job">* 직업<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="mb_job" value="<?php echo $mb['mb_job'] ?>" id="mb_job" required class="frm_input" size="15" placeholder="직업">
                </td>
                <th scope="row"><label for="mb_blood_type">* 혈액형<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="radio" name="mb_blood_type" value="A" id="mb_blood_type_a" <?php if($mb['mb_blood_type'] == 'A') echo 'checked="checked"'; ?>>
                    <label for="mb_blood_type_a">A형</label>
                    <input type="radio" name="mb_blood_type" value="B" id="mb_blood_type_b" <?php if($mb['mb_blood_type'] == 'B') echo 'checked="checked"'; ?>>
                    <label for="mb_blood_type_b">B형</label>
                    <input type="radio" name="mb_blood_type" value="O" id="mb_blood_type_o" <?php if($mb['mb_blood_type'] == 'O') echo 'checked="checked"'; ?>>
                    <label for="mb_blood_type_o">O형</label>
                    <input type="radio" name="mb_blood_type" value="AB" id="mb_blood_type_ab" <?php if($mb['mb_blood_type'] == 'AB') echo 'checked="checked"'; ?>>
                    <label for="mb_blood_type_ab">AB형</label>
                </td>
            <tr>
                <th scope="row"><label for="mb_height">* 키 (cm) / 몸무게 (kg)<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="mb_height" value="<?php echo $mb['mb_height'] ?>" id="mb_height" required class="frm_input" size="15" onkeyup="only_number(this);" placeholder="숫자만 입력">
                    <input type="text" name="mb_weight" value="<?php echo $mb['mb_weight'] ?>" id="mb_weight" required class="frm_input" size="15" onkeyup="only_number(this);" placeholder="숫자만 입력">
                </td>
                <th scope="row"><label for="mb_mbti">* mbti<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="mb_mbti" value="<?php echo $mb['mb_mbti'] ?>" id="mb_mbti" required class="frm_input" size="15" placeholder="mbti">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_height">* 사는지역<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="mb_live_si" value="<?php echo $mb['mb_live_si'] ?>" id="mb_live_si" required class="frm_input" size="15" placeholder="예) 부산광역시">
                    <input type="text" name="mb_live_gu" value="<?php echo $mb['mb_live_gu'] ?>" id="mb_live_gu" required class="frm_input" size="15" placeholder="예) 해운대구">
                </td>
                <th scope="row"><label for="mb_old">* 나이<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="mb_old" value="<?php echo $mb['mb_old'] ?>" id="mb_old" required class="frm_input" size="15" >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_hobby">좋아하는 취미를 선택해주세요<br>(최대 5개까지 선택 가능)<?php echo $sound_only ?></label></th>
                <td colspan="3">
                    <?php
                    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                    if(!empty($mb['mb_no'])) {
                        $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                    }
                    $sql .= " where co.co_code_name = '취미' order by co.co_code*1 ";
                    $result = sql_query($sql);
                    for($i=0;$row=sql_fetch_array($result);$i++) {
                        $class_on = "";
                        if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                            $class_on = "on";
                        }
                        ?>
                        <div class="code hobby <?=$class_on?>" id="hobby_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></div>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_movie">좋아하는 관심사를 선택해주세요 (영화)<br>(최대 3개까지 선택가능)<?php echo $sound_only ?></label></th>
                <td colspan="3">
                    <?php
                    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                    if(!empty($mb['mb_no'])) {
                        $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                    }
                    $sql .= " where co.co_code_name = '영화' order by co.co_code*1 ";
                    $result = sql_query($sql);
                    for($i=0;$row=sql_fetch_array($result);$i++) {
                        $class_on = "";
                        if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                            $class_on = "on";
                        }
                        ?>
                        <div class="code movie <?=$class_on?>" id="movie_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></div>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_music">좋아하는 관심사를 선택해주세요 (음악)<br>(최대 3개까지 선택가능)<?php echo $sound_only ?></label></th>
                <td colspan="3">
                    <?php
                    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                    if(!empty($mb['mb_no'])) {
                        $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                    }
                    $sql .= " where co.co_code_name = '음악' order by co.co_code*1 ";
                    $result = sql_query($sql);
                    for($i=0;$row=sql_fetch_array($result);$i++) {
                        $class_on = "";
                        if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                            $class_on = "on";
                        }
                        ?>
                        <div class="code music <?=$class_on?>" id="music_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></div>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_tv">좋아하는 관심사를 선택해주세요 (TV)<br>(최대 3개까지 선택가능)<?php echo $sound_only ?></label></th>
                <td colspan="3">
                    <?php
                    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                    if(!empty($mb['mb_no'])) {
                        $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                    }
                    $sql .= " where co.co_code_name = 'TV' order by co.co_code*1 ";
                    $result = sql_query($sql);
                    for($i=0;$row=sql_fetch_array($result);$i++) {
                        $class_on = "";
                        if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                            $class_on = "on";
                        }
                        ?>
                        <div class="code tv <?=$class_on?>" id="tv_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></div>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_salary">* 연인이생긴다면 함께나누고 싶은 음식은?<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select class="form-control" id="interview5_text1" name="mi_food" onchange="food_change(this.value);">
                        <option value="">선택하세요</option>
                        <option value="1">마음편하게 부담없이 한식찌개</option>
                        <option value="2">분위기 있는 이태리 카페</option>
                        <option value="3">고즈넉하게 즐기는 브런치</option>
                        <option value="4">서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살</option>
                        <option value="5">요리실력도 뽐낼겸 셀프요리 피크닉</option>
                        <option value="6">직접기재</option>
                        <!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                    </select>
                    <span id="food_span">
                            <?php  if ($mi["mi_food"] == 6 ) echo '<input type="text" value="'.$mi["mi_food_memo"].'" class="frm_input required2 direct5" name="mi_food_memo">' ?>
                    </span>
                </td>
                <th scope="row"><label for="mb_salary">* 연인이 생기면 함께 해보고 싶은 것?<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select class="form-control" id="interview5_text1" name="mi_want" onchange="want_change(this.value)">
                        <option <?php echo $mi['mi_want'] == '1000만원이하' ? 'selected' : ''?> value="">선택하세요</option>
                        <option <?php echo $mi['mi_want'] == '마음편하게 부담없이 한식찌개' ? 'selected' : ''?> value="마음편하게 부담없이 한식찌개">마음편하게 부담없이 한식찌개</option>
                        <option <?php echo $mi['mi_want'] == '분위기 있는 이태리 카페' ? 'selected' : ''?> value="분위기 있는 이태리 카페">분위기 있는 이태리 카페</option>
                        <option <?php echo $mi['mi_want'] == '고즈넉하게 즐기는 브런치' ? 'selected' : ''?> value="고즈넉하게 즐기는 브런치">고즈넉하게 즐기는 브런치</option>
                        <option <?php echo $mi['mi_want'] == '서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살' ? 'selected' : ''?> value="서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살">서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살</option>
                        <option <?php echo $mi['mi_want'] == '요리실력도 뽐낼겸 셀프요리 피크닉' ? 'selected' : ''?> value="요리실력도 뽐낼겸 셀프요리 피크닉">요리실력도 뽐낼겸 셀프요리 피크닉</option>
                        <option <?php echo $mi['mi_want'] == '직접기재' ? 'selected' : ''?> value="직접기재">직접기재</option><!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                    </select>
                    <span id="want_span">
                            <?php  if ($mi["mi_want"] == "직접기재" ) echo '<input type="text" value="'.$mi["mi_want_memo"].'" class="frm_input" name="mi_want_memo">' ?>
                    </span>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_salary">* 당신의 매력포인트나 장점은?<strong class="sound_only">필수</strong></label></th>

                <td>
                    <select class="form-control" id="interview4_text1" name="mi_charming" onchange="charming_change(this.value);">
                        <option value="">선택하세요</option>
                        <option value="1">활발하고 명랑한 성격</option>
                        <option value="2">훤칠하고 뽀대나는 아우라</option>
                        <option value="3">늘 긍정적이고 적극적인 마인드</option>
                        <option value="4">분위기 잘 맞추고 눈치껏 발휘하는 센스</option>
                        <option value="5">유머러스한 리더쉽</option>
                        <option value="6">직접기재</option>
                        <!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                    </select>
                    <span id="charming_span">
                            <?php  if ($mi["mi_charming"] == 6 ) echo '<input class="frm_input" type="text" value="'.$mi["mi_charming_memo"].'"  style = "width:60%" class="frm_input" name="mi_charming_memo">' ?>
                        </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="tbl_frm01 tbl_wrap tab_hobby" style="display: ;">
        <h1 class="subj">학벌/연봉/재산 정보</h1>
        <table>
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>


            <tr>
                <th><label for="mb_salary">* 학력<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name = "mb_school" value="<?=$mb['mb_school']?>" class="frm_input" placeholder="최종졸업학교를 입력하세요">
                    <input type="text" name = "mb_department" value="<?=$mb['mb_department']?>" class="frm_input" placeholder="학과를 입력하세요">
                </td>

                <th><label for="mb_salary">* 연봉<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select class="frm_input" id="mb_salary" name="mb_salary">
                        <option value="">선택하세요</option>
                        <option value="1000만원이하" <?php echo $mb['mb_salary'] == '1000만원이하' ? 'selected' : ''?>>1000만원이하</option>
                        <option value="1000~2000만원" <?php echo $mb['mb_salary'] == '1000~2000만원' ? 'selected' : ''?>>1000~2000만원</option>
                        <option value="2000~3000만원" <?php echo $mb['mb_salary'] == '2000~3000만원' ? 'selected' : ''?>>2000~3000만원</option>
                        <option value="3000~4000만원" <?php echo $mb['mb_salary'] == '3000~4000만원' ? 'selected' : ''?>>3000~4000만원</option>
                        <option value="4000~5000만원" <?php echo $mb['mb_salary'] == '4000~5000만원' ? 'selected' : ''?>>4000~5000만원</option>
                        <option value="5000~6000만원" <?php echo $mb['mb_salary'] == '5000~6000만원' ? 'selected' : ''?>>5000~6000만원</option>
                        <option value="6000만원이상" <?php echo $mb['mb_salary'] == '6000만원이상' ? 'selected' : ''?>>6000만원이상</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="mb_blood_type">* 자차여부<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="radio" name="mb_mycar" value="Y" id="mb_mycar1" <?php if($mb['mb_mycar'] == 'Y') echo 'checked="checked"'; ?>>
                    <label for="mb_mycar1">있음</label>
                    <input type="radio" name="mb_mycar" value="N" id="mb_mycar2" <?php if($mb['mb_mycar'] == 'N') echo 'checked="checked"'; ?>>
                    <label for="mb_mycar2">없음</label>
                    <?php if($mb['mb_mycar'] == 'Y'){ ?>
                        <select name = 'mb_mycar_name' onchange= 'car_change(this.value)' class=\"form-control\">
                            <option value = '' >차브랜드를 선택해주세요</option>
                            <?php for ($c = 1; $c <= count($car_arr); $c++) { ?>
                                <option <? if ($car_arr[$c] == $mb["mb_mycar_name"]) echo "selected"; ?> value = "<?= $car_arr[$c] ?>"><?= $car_arr[$c]?></option>
                            <?php }?>
                            </select>
                        <input style = "display:none" type="text" class="frm_input" name="mb_mycar_name_memo" value = '<?=$mb["mb_mycar_name_memo"]?>' id = 'mb_mycar_name_memo' placeholder="차브랜드를 입력해주세요">
                    <?php } ?>
                </td>
                <th scope="row"><label for="mb_blood_type">* 자가여부<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="radio" name="mb_myhome" value="Y" id="mb_myhome1" <?php if($mb['mb_myhome'] == 'Y') echo 'checked="checked"'; ?>>
                    <label for="mb_myhome1">있음</label>
                    <input type="radio" name="mb_myhome" value="N" id="mb_myhome2" <?php if($mb['mb_myhome'] == 'N') echo 'checked="checked"'; ?>>
                    <label for="mb_myhome2">없음</label>
                </td>
            </tr>
            <tr>
                <th>재혼일 경우 자녀 생년월일-성별</th>
                <td>
                    <input type="text" name="mb_children" value="<?=$mb['mb_children']?>" class="frm_input" id="mb_children" >
                </td>
                <th></th>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

<!--  만나정보  -->
    <div class="tbl_frm01 tbl_wrap tab_point" style="display: ">

        <div class="tbl_head02">

            <table>
                <colgroup>
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>아이디</th>
                    <th>이름</th>
                    <th>닉네임</th>
                    <th>구분</th>
                    <th>내용</th>
                    <th>만나  총만나 : <?=number_format($mb['cw_point'])?></th>
                    <th>누적만나</th>
                    <th>변경일</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=0; $row=sql_fetch_array($point_result); $i++) {
                    $bg = 'bg'.($i%2);
                    ?>
                    <tr class="<?php echo $bg; ?>">
                        <td><?=$total_count?></td>
                        <td><?=$row['mb_id']?></td>
                        <td><?=$row['mb_name']?></td>
                        <td><?=$row['mb_nick']?></td>
                        <td><?=$row['point_category']?></td>
                        <td><?=$row['point_content']?> <?php if(strpos($row['point_content'], '사진 조회') !== false) { echo '('.$row['rel_mb_name'].')'; } ?></td>
                        <td><?=number_format($row['point'])?></td>
                        <td><?=number_format($row['acc_point'])?></td>
                        <td><?=substr($row['wr_datetime'],0,10)?></td>
                    </tr>
                    <?php
                    $total_count--;
                }
                if ($i == 0)
                    echo "<tr ><td colspan='10' class=\"empty_table\">만나 정보가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>

        </div>
    </div>

    <!-- 회원과의 대화기록 -->
    <div class="tbl_frm01 tbl_wrap tab_user_talk" style="display: none;">
        <div class="tbl_head02 ">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="12%">
                    <col width="12%">
                    <col width="*">
                    <col width="10%">
                    <col width="5%">
                </colgroup>
                <thead>
                <tr>
                    <!--<th scope="col">
                        <label for="chkall" class="sound_only">회원 전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>-->
                    <th>No.</th>
                    <th>보낸 이름</th>
                    <th>받는 이름</th>
                    <th>메세지</th>
                    <th>전송일시</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                <?php $colspan = 6;
                for ($i=0; $row=sql_fetch_array($user_talk_result); $i++) {
                    $s_mod = '<a href="./message_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['idx'].'">보기</a>';
                    $bg = 'bg'.($i%2);
                    ?>
                    <tr class="<?php echo $bg; ?>">
                        <!--<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
                        <td><?=$user_talk_total_count?></td>
                        <td><?=$row['send_mb_name']?></td>
                        <td><?=$row['receive_mb_name']?></td>
                        <td><div><?=$row['message']?></div></td>
                        <td><?=substr($row['message_date'],0,16)?></td>
                        <td><?=$s_mod?></td>
                    </tr>
                    <?php
                    $user_talk_total_count--;
                }
                if ($i == 0)
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">메세지 현황 정보가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- 관리자와 대화기록 -->
    <div class="tbl_frm01 tbl_wrap tab_adm_talk" style="display: none;">
        <div class="tbl_head02 ">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="12%">
                    <col width="12%">
                    <col width="*">
                    <col width="10%">
                    <col width="5%">
                </colgroup>
                <thead>
                <tr>
                    <!--<th scope="col">
                        <label for="chkall" class="sound_only">회원 전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>-->
                    <th>No.</th>
                    <th>보낸 이름</th>
                    <th>받는 이름</th>
                    <th>메세지</th>
                    <th>전송일시</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                <?php $colspan = 6;
                for ($i=0; $row=sql_fetch_array($admin_talk_result); $i++) {
                    $s_mod = '<a href="./message_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['idx'].'">보기</a>';
                    $bg = 'bg'.($i%2);
                    ?>
                    <tr class="<?php echo $bg; ?>">
                        <!--<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
                        <td><?=$admin_talk_total_cnt?></td>
                        <td><?=$row['send_mb_name']?></td>
                        <td><?=$row['receive_mb_name']?></td>
                        <td><div><?=$row['message']?></div></td>
                        <td><?=substr($row['message_date'],0,16)?></td>
                        <td><?=$s_mod?></td>
                    </tr>
                    <?php
                    $admin_talk_total_cnt--;
                }
                if ($i == 0)
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">메세지 현황 정보가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
        </div>

    </div>
<!--  관리자 메모  -->

<!--  결제정보  -->
    <div class="tbl_frm01 tbl_wrap tab_payment" style="display: none;">
        <div class="tbl_head02 ">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="12%">
                    <col width="12%">
                    <col width="*">
                    <col width="10%">
                </colgroup>
                <thead>
                <tr>
                    <!--<th scope="col">
                        <label for="chkall" class="sound_only">회원 전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>-->
                    <th>No.</th>
                    <th>상품명</th>
                    <th>결제 카드</th>
                    <th>결제 금액</th>
                    <th>결제 일시</th>
                </tr>
                </thead>
                <tbody>
                <?php $colspan = 6;
                for ($i=0; $row=sql_fetch_array($payment_result); $i++) {
                    $bg = 'bg'.($i%2);
                    $name = explode("_",$row["GoodsName"])[1];
                    ?>
                    <tr class="<?php echo $bg; ?>">
                        <!--<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
                        <td><?=$payment_total_count-- ?></td>
                        <td><?=$name?></td>
                        <td><?=$row['fn_name']?></td>
                        <td><?=number_format($row['Amt'])?></td>
                        <td><?=substr($row['wr_datetime'],0,16)?></td>
                    </tr>
                    <?php
                    $admin_talk_total_cnt--;
                }
                if ($i == 0)
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">결제정보가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
        </div>

    </div>


    <div class="btn_confirm01 btn_confirm" style="margin-top: 40px;">
        <!--<input type="submit" value="확인" class="btn_submit" accesskey='s'>-->
        <?php if($mb['mb_approval_request'] == 'Y' && $mb['mb_approval'] == 'N') { ?>
            <input type="button" value="승인" class="btn_approval" onclick="profile_approval();">
        <?php } ?>
        <input type="button" value="확인" class="btn_submit" onclick="code_check()" accesskey='s'>
        <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
    </div>
</form>
<script>
$(function() {
    $('#interview1_text1').val('<?=$mi['interview1_text1']?>').attr('selected', 'selected');
    $('#interview2_text1').val('<?=$mi['interview2_text1']?>').attr('selected', 'selected');
    $('#interview3_text1').val('<?=$mi['interview3_text1']?>').attr('selected', 'selected');
    $('#interview4_text1').val('<?=$mi['interview4_text1']?>').attr('selected', 'selected');
    $('#interview5_text1').val('<?=$mi['interview5_text1']?>').attr('selected', 'selected');
    // $("input").attr("required", false);
    // $("input").removeClass("required");
    // 탭처리
    $(".btn_add .tab li a").click(function () {
        var tab = $(this).data("sca");
        // console.log(tab);

        $(".btn_add .tab li a").removeClass("on");
        $('#'+tab).addClass("on");
        $(".tbl_frm01").hide();
        $(".tab_"+tab).show();

        if(tab == 'point' || tab == 'user_talk' || tab == 'adm_talk' || tab == "adm_memo" || tab == "payment"){
            $(".btn_submit").css("display","none");
        }else{
            $(".btn_submit").css("display","inline");

        }
    });

    $(document).ready(function () {

        //어필 한마디 직접입력인지
        var thevalue = '<?=$mb['mb_introduce']?>';
        var exists = 0 != $('#mb_introduce option[value="'+thevalue+'"]').length;
        if (exists){
            $("#mb_introduce").val(thevalue);
            $("#mb_introduce_memo").val("");

        }else{
            $("#mb_introduce_memo").css("display","inline");
            $("#mb_introduce").val('직접입력');
        }

    <?php if($_REQUEST["tab"] == "adm_memo"){ ?>
        $(".btn_add .tab li a").removeClass("on");
        $('#adm_memo').addClass("on");
        $(".tbl_frm01").hide();
        $(".tab_adm_memo").show();
        $(".btn_submit").css("display","none");
     <?php } ?>
    <?php if ($mb["mb_mycar"] == "Y"){ ?>
        car_change("<?=$mb["mb_mycar_name"]?>");
    <?php } ?>
        //신앙정보
        $("input:radio[name='mi_chance']:radio[value='<?=$mi['mi_chance']?>']").prop("checked", true);
        $("input:radio[name='mi_date']:radio[value='<?=$mi['mi_date']?>']").prop("checked", true);
        $("[name='mi_angel']").val("<?=$mi['mi_angel']?>");
        $("[name='mi_church_place1']").val("<?=$mi['mi_church_place1']?>");
        $("input:radio[name='mi_ten']:radio[value='<?=$mi['mi_ten']?>']").prop("checked", true);
        $("input:radio[name='mi_tk']:radio[value='<?=$mi['mi_tk']?>']").prop("checked", true);
        $("[name='mi_food']").val("<?=$mi['mi_food']?>");
        $("[name='mi_charming']").val("<?=$mi['mi_charming']?>");


        changeCity("si","Y");
        changeCity("gu","Y");


    })



    // 취미/관심사 선택처리
    $(".code").click(function () {
        if($('#'+this.id).hasClass("on")) {
            $("#"+this.id).removeClass("on");
        }
        else {
            $("#"+this.id).addClass("on");
        }

        if($(".code.hobby.on").length > 5 || $(".code.exercise.on").length > 5) {
            alert('최대 5개까지 선택 가능합니다.');
            $("#"+this.id).removeClass("on");
            return false;
        }

        if($(".code.movie.on").length > 3 || $(".code.music.on").length > 3 || $(".code.tv.on").length > 3) {
            alert('최대 3개까지 선택 가능합니다.');
            $("#"+this.id).removeClass("on");
            return false;
        }
    });

    // 사는 곳 시/도
    $('#si_live').val('<?=$mb['mb_live_si']?>').attr("selected", "selected");
    changeCity('live');
    // 교회위치 시/도/군
    $('#si_church').val('<?=$mb['mb_church_si']?>').attr("selected", "selected");
    changeCity('church');
});

// 취미/관심사 선택 데이터 체크
function code_check() {
    var hobby_code = "";
    $('.code').each(function(){
        if($(this.id).hasClass("on")) {
            hobby_code += this.id + ',';
        }
    });
    // console.log(hobby_code);

    $('input[name=hobby_code]').val(hobby_code.slice(0,-1));

    // 프로필 사진 삭제 체크
    $('input[name=del_mb_img]').val(del_file_idx.slice(0,-1));
    // 추가 서류 삭제 체크
    $('input[name=del_mb_file]').val(del_file_idx2.slice(0,-1));

    form_ajax();
}

function form_ajax() {
    // 가족관계
    var fam_arr = [];
    $('input[name="fam"]:checked').each(function(){
        fam_arr.push($(this).val());
    });

    var form = $('form')[0];
    var formData = new FormData(form);
    formData.append('mb_family', fam_arr);

    // 유효성 검사 정해진 부분이 없어서 막지 않음 -- 추후 수정 가능성
    /*if($.trim($('#mb_id').val()) == "") {
        alert('아이디를 입력하세요.');
        return false;
    }

    if($('#w').val() == '') {
        if($.trim($('#mb_password').val()) == "") {
            alert('비밀번호를 입력하세요.');
            return false;
        }
    }

    if($.trim($('#mb_name').val()) == "") {
        alert('이름을 입력하세요.');
        return false;
    }*/
    form.submit();

    for (var i = 0; i < filesTempArr.length; i++) {
        formData.append("file[]", filesTempArr[i]);
    }
    // console.log(filesTempArr);return;
    /*
    $.ajax({
        url : g5_admin_url + "/member_form_update.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success : function(data) {
            console.log(data);
            if(data){
                alert('저장되었습니다.');
                //location.href = g5_admin_url + "/member_list.php";
            }
        },
    });
    */

}

function fmember_submit(f)
{
    if (f.w.value == "") {
        // 아이디 중복체크
        var msg = reg_mb_id_check();
        if (msg != "") {
            alert(msg);
            f.mb_id.focus();
            return false;
        }
    }

    // 닉네임 중복체크
    if (f.mb_nick.value.length > 0) {
        var msg = reg_mb_nick_check();
        if (msg != "") {
            alert(msg);
            f.mb_nick.focus();
            return false;
        }
    }

    return true;
}

function file_add() {
    // if(file_idx == 0) file_idx = 1;
    // console.log(file_idx);
    upload = $('<input type="file" capture="camera" name="mb_img[]" class="frm_file new" id="mb_img_' + file_idx + '" multiple onchange="getImgPrev(this)" accept="image/*" style="display: none;" >');

    $("#file_input").after(upload);
    upload.trigger('click');
}

// 파일업로드 미리보기
var filesTempArr = [];
var file_idx = 0;
function getImgPrev(input) {
    var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp|JPG|JPEG|PNG)$/;

    if (!reg_ext.test(input.files[0].name)) {
        alert("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
        return false;
    }

    // 최대용량 체크
    var	max_size_mb = 5, //5mb
        max_byte = max_size_mb * 1024 * 1024,
        file_byte = input.files[0].size;

    if (file_byte > max_byte) {
        alert("최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
        $("#mb_img").val("");
        return false;
    }

    // console.log(input.files.length);
    // console.log($('span[id^=prev_area]').length);
    var file_count = input.files.length + $('span[id^=prev_area]').length;
    console.log(file_count);
    if(file_count > 999) {
        alert('최대 4개까지 등록가능합니다.');
        $("#mb_img").val("");
        return false;
    }

    var files = input.files;
    var files_arr = Array.prototype.slice.call(files);

    for (var i = 0; i<input.files.length; i++) {
        filesTempArr.push(files_arr[i]);
    }

    // 미리보기
    if (input.files && input.files[0]) {
        var target = document.getElementsByName('mb_img[]');

        // multiple 적용
        $.each(target[0].files, function(index, file){
            var reader = new FileReader();

            reader.onload = function(e) {
                var src = e.target.result;
                var html = '';

                html += '<span class="prev_area mb_icon" id="prev_area_new_'+file_idx+'">';
                html += '<input type="hidden" id="img_idx_'+file_idx+'" name="img_idx_'+file_idx+'">';
                html += '<button type="button" class="btn_del" onclick="mbImgDel(\'w\', \''+file_idx+'\');" style="position: absolute;">X</button>';
                html += '<span class="img_bd" style="margin-right: 10px;">';
                html += '<img src="'+ src +'" width="150px" height="150px">';
                html += '</span>';
                html += '</span>';

                file_idx++;
                $("#mb_img_prev").append(html);
            }

            reader.readAsDataURL(file);
        });
    }
}

// 이미지 삭제
var del_file_idx = '';
function mbImgDel(mode, file_idx) {
    if (confirm("프로필 사진을 삭제하시겠습니까?")) {
        if (mode == "u") {
            if($('#img_idx_'+file_idx).val() != '') {
                del_file_idx += $('#img_idx_'+file_idx).val() + ',';
            }
            $('#prev_area_'+file_idx).remove();
        } else if (mode == "w") {
            $("#mb_img").val("");
            $("#mb_img").replaceWith($("#mb_img").clone(true));
            $('#prev_area_new_'+file_idx).remove();
        }

        delete filesTempArr[file_idx]; // index 수정
    }
}

// 추가 서류 삭제
var del_file_idx2 = '';
function mbFileDel(mode, file_idx) {
    if (confirm("추가 서류를 삭제하시겠습니까?")) {
        if($('#file_idx_'+file_idx).val() != '') {
            del_file_idx2 += $('#file_idx_'+file_idx).val() + ',';
            $('.file_'+file_idx).remove();
        }
    }
}

// 사회적 역할 DB
function mb_social_role_change(role) {
    // console.log(role);
    $.ajax({
        type : "post",
        url : "./ajax.mb_social_role.php",
        data : {role : role},
        dataType : "html",
        success : function(data) {
            $('#mb_social_role').html(data);
        }
    });
}

function changeCity(type,first_yn) {
    $('.sel_gu').show();
    var si = $("#si").val();
    var gu = $("#cur_gu").val();

    var place = "";
    if ("<?=$mi["idx"]?>" != "" && type == "si" &&first_yn == "Y"){
        si = '<?=$mi["mi_church_place1"]?>';
        place = '<?=$mi["mi_church_place2"]?>'
    }else if("<?=$mi["idx"]?>" != "" && type == "gu" &&first_yn == "Y"){
        gu = '<?=$mi["mi_church_place2"]?>';
        place = '<?=$mi["mi_church_place3"]?>';
    }

    if (!si) {
        $('.sel_gu').hide();
        return false;
    }

    if (type == 'si') {
        $("#cur_gu").find("option").remove();
    }

    $.ajax({
        type: "GET",
        url: "<?php echo G5_PLUGIN_URL?>/address/address.php",
        dataType: "json",
        data: {"si": si,"gu":gu},
        success: function (datas) {
            var opt_select = "", opt = "";
            // var cur_gu = $("#cur_gu").val();


            opt += "<option value=''>지역상세</option>";
            for (var i = 0; i < datas.length; i++) {
                console.log(datas[i]);
                opt_select = (place == datas[i]) ? "selected" : "";
                opt += "<option value='" + datas[i] + "' " + opt_select + ">" + datas[i] + "</option>";
            }

            if(type == "si") {
                $("#cur_gu").html(opt);
            }else{
                $("#dong").html(opt);

            }
        },
        error: function (request, status, error) {
            console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
        }, complete: function () {
        }
    });
}

var is_post = false;
function profile_approval() {
    if(is_post) {
        return false;
    }
    is_post = true;

    $.ajax({
        type: 'POST',
        url: g5_admin_url + "/ajax.profile_approval.php",
        data: {mb_id: '<?=$mb['mb_id']?>'},
        success: function (data) {
            if(data) {
                alert('승인 완료되었습니다.');
                location.href = g5_admin_url + "/member_list.php";
            }
        }
    });
}

// 숫자만 입력
function number_check(data) {
    $('#'+data.id).val(data.value.replace(/[^\d]+/g, ''));
    $('#'+data.id).val(data.value.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));
}

//휴대전화 '-'자동생성
function inputPhoneNumber(obj) {
    var number = obj.value.replace(/[^0-9]/g, "");
    var phone = "";

    if(number.length < 4) {
        return number;
    } else if(number.length < 7) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3);
    } else if(number.length < 11) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 3);
        phone += "-";
        phone += number.substr(6);
    } else {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 4);
        phone += "-";
        phone += number.substr(7);
    }
    obj.value = phone;
}

$('.doc-text').keyup(function (e) {
    var content = $("#mb_introduce").val();
    $('#counter').html("" + content.length + " / 최대 100자");    //글자수 실시간 카운팅

    if (content.length > 100) {
        alert("최대 100자까지 입력 가능합니다.");
        $(this).val(content.substring(0, 100));
        $('#counter').html("100 / 최대 100자");
    }
});

// 선택박스 옵션 변경 -- 직접입력 선택 시 텍스트 폼 띄움
function change_select(data) {
    var id = data.id;
    var value = data.value;
    var index = id.split('_')[0].substr(-1,1);
    // var text = id.split('_')[0].slice(0,-1) + index + '_text2'; // inverview + index

    if(value == '직접기재') {
        $('.direct'+index).removeClass('hide');
        $('.direct'+index).val('');
    }
    else {
        $('.direct'+index).addClass('hide');
    }
}

//관리자 메모 저장
    function memo_update(mode,idx) {

        var memo = $("#memo_"+idx).val();

        $.ajax({
            type: 'POST',
            url: g5_admin_url + "/adm.ajax.controller.php",
            data: {
                mode: mode,
                memo: memo,
                memo_mb_id : '<?=$mb_id?>',
                idx : idx
            },
            success: function (data) {

                alert('완료되었습니다.');
                //location.href = g5_admin_url+"/member_form.php?<?=$qstr?>&w=u&tab=adm_memo&mb_id=<?=$mb_id?>"
                location.href = g5_admin_url+"/member_form.php?<?=$qstr?>&w=u&mb_id=<?=$mb_id?>"

            }
        });

    }
    
    function memo_del(idx) {

        if(confirm("삭제하시겠습니까? 삭제하면 복구할 수 없습니다")) {
            location.href = "./adm.ajax.controller.php?mb_id=<?=$mb_id?>&mode=memo_del&idx=" + idx;
        }

    }
//희망하는 음식
function food_change(val) {

    if (val == 6 ){
        $("#food_span").html("<input type=\"text\" class=\"frm_input\" name=\"mi_food_memo\">\n");
    }else{
        $("#food_span").html("");
    }

}
function charming_change(val) {

    if (val == 6 ){
        $("#charming_span").html("<input type=\"text\" class=\"frm_input\" name=\"mi_charming_memo\">\n");
    }else{
        $("#charming_span").html("");
    }

}
function want_change(val) {

    if (val == "직접기재" ){
        $("#want_span").html("<input type=\"text\" class=\"frm_input\" name=\"mi_want_memo\">\n");
    }else{
        $("#want_span").html("");
    }

}
// 어필 소개글
$('#mb_introduce').on('change',function(){
    var val = $(this).val();
    if (val == "직접입력"){
        $("#mb_introduce_memo").css("display","inline");
    }else{
        $("#mb_introduce_memo").css("display","none");
        $("#mb_introduce_memo").val("");
        $(this).parents(".row").find(".error").html("");
    }
});

function car_change(val) {
    if (val == "직접기재"){
        $("#mb_mycar_name_memo").css("display","inline");
    }else{
        $("#mb_mycar_name_memo").css("display","none");
        $("#mb_mycar_name_memo").val("");

    }
}

</script>

<?php
include_once('./admin.tail.php');
?>
