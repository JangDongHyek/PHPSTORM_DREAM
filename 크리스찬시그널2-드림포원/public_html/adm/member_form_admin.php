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

$g5['title'] .= '관리자 '.$html_title;
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
    .btn_add .tab {float: left; list-style: none; padding: 0; margin: 0; margin-bottom: 10px;}
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
</style>

<form name="fmember" id="fmember" action="./member_form_admin_update.php" onsubmit="return form_ajax();" method="post" enctype="multipart/form-data">
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

    <?php for ($i=1; $i<=10; $i++) { ?>
        <input type="hidden" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>">
    <?php } ?>

    <!-- 회원-기본정보 -->
    <div class="tbl_frm01 tbl_wrap tab_member">
        <table>
            <!--<caption>기본 정보</caption>-->
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
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
            </tr>
            <tr>
                <th scope="row"><label for="mb_password">* 비밀번호<?php echo $sound_only ?></label></th>
                <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">* 이름<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="frm_input" size="30" maxlength="20"></td>
            </tr>
            <!--<tr>
                <th scope="row"><label for="mb_hp">* 휴대폰번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_hp" value="<?php /*echo $mb['mb_hp'] */?>" id="mb_hp" class="frm_input" size="30" maxlength="13" onkeyup="number_check(this);inputPhoneNumber(this)"></td>
            </tr>-->
    </tbody>
    </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="확인" class="btn_submit" accesskey='s'>
        <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
    </div>
</form>

<script>
function fmember_submit(f)
{
    return true;
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
</script>

<?php
include_once('./admin.tail.php');
?>