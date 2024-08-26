<?php
$sub_menu = "200100";
include_once('./_common.php');

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
   $sql =  " select *,mem.mb_id mb_id from {$g5['member_table']} mem left join {$g5['profile_table']} pf on mem.mb_id = pf.mb_id where mem.mb_id = TRIM('$mb_id') ";
    $mb = sql_fetch($sql);

    $pf_pro_ctg1 = explode(',',$mb['pf_pro_ctg1']);
    $pf_pro_ctg2 = explode(',',$mb['pf_pro_ctg2']);
    $pf_pro_ctg3 = explode(',',$mb['pf_pro_ctg3']);

    $pf_hold_ctg1 = explode(',',$mb['pf_hold_ctg1']);
    $pf_hold_ctg2 = explode(',',$mb['pf_hold_ctg2']);

    $pf_pro_ctg1 = array_filter($pf_pro_ctg1);
    $pf_hold_ctg1 = array_filter($pf_hold_ctg1);

    $i = 0;
    foreach($pf_pro_ctg1 as $key=>$val)
    {
        unset($pf_pro_ctg1[$key]);

        $new_key = $i;
        $pf_pro_ctg1[$new_key] = $val;

        $i++;
    }
    $i = 0;
    foreach($pf_hold_ctg1 as $key=>$val)
    {
        unset($pf_hold_ctg1[$key]);

        $new_key = $i;
        $pf_hold_ctg1[$new_key] = $val;

        $i++;
    }



    $pf_certificate = explode(',',$mb['pf_certificate']);

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

//탈퇴회원에서 들어오면 탈퇴회원관리 리스트로 빠져나가게 함.
if ($_REQUEST['quit'] == 'y'){
    $url = './quit_member_list.php';
}else{
    $url = './member_list.php';
}


if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

//가입경로
$mb_sub_path_arr= explode(',',$mb['mb_sub_path']);

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<style>
    .readonly{
        background: #ced9de;
    }
</style>
<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="pf_idx" value="<?=$mb['pf_idx']?>">
<input type="hidden" name="mb_birth" value="<?php echo $mb['mb_birth'] ?>" id="mb_birth" >

    <?php for ($i=1; $i<=10; $i++) { ?>
<input type="hidden" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>">
<?php } ?>


<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <input type="hidden" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" class="frm_input" size="15" minlength="3" maxlength="20">

    <tr>
        <th scope="row"><label for="mb_email">E-mail<strong class="sound_only">필수</strong></label></th>
        <td width="40%"><input type="text" name="mb_email" value="<?php echo $mb['mb_id'] ?>" id="mb_email" <?php echo $required_mb_id ?> maxlength="100" size="40" required class="required frm_input"></td>
        <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20"></td>
    </tr>
    <?php if ($w == "u") { ?>
    <tr>
        <th scope="row"><label for="mb_password">생년월일<?php echo $sound_only ?></label></th>
        <td colspan="3"><input type="text" name="mb_birth" class="frm_input"  value="<?php echo substr_replace(substr_replace($mb['mb_birth'], "/", 4,0),"/", 7,0); ?>" readonly id="mb_birth" ></td>
    </tr>
    <?php } ?>
    <tr>
        <th scope="row">회원구분<label for="mb_division"><strong class="sound_only">필수</strong></label></th>
        <td>일반 <input <?php if ($_REQUEST['add'] == 'y'){echo 'checked';} ?> name="mb_division" onclick="member_div(2)" value="1" type="radio"> 전문가 <input onclick="member_div(3)" value="2" name="mb_division" type="radio"></td>
        <th scope="row">가입경로</th>
        <td>
            <input type="checkbox" name="mb_sub_path[]" value="옥외광고" >
            <label for="reg_req1">옥외광고 (포스터, 전광판 등)</label>
            <input type="checkbox" name="mb_sub_path[]" value="SNS" >
            <label for="reg_req1">SNS 광고 (인스타그램, 페이스북 등)  </label>
            <input type="checkbox" name="mb_sub_path[]" value="인터넷" >
            <label for="reg_req1">인터넷 검색</label>
            <input type="checkbox" name="mb_sub_path[]" value="지인추천" >
            <label for="reg_req1">지인추천</label>
            <br>
            <input type="checkbox" name="mb_sub_path[]" value="직접입력">
            <label for="reg_req1">기타 (직접입력)</label>
            <input type="text" name="mb_sub_text"maxlength="50" class="frm_input" value="<?=$mb['mb_sub_text']?>" >
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_nick">닉네임<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_nick" value="<?php echo $mb['mb_nick'] ?>" id="mb_nick" class=" frm_input" size="15" minlength="2" maxlength="20"></td>
        <th scope="row"><label for="mb_nick">내외국인<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="radio"  <?php if ($_REQUEST['add'] == 'y'){echo 'checked';} ?> name="mb_5" value="KO" class="frm_input"> 내국인
            <input type="radio" name="mb_5" value="FO" class="frm_input"> 외국인
        </td>
    <tr>
        <th scope="row"><label for="mb_level">권한<strong class="sound_only">필수</strong></label></th>
        <td>
            <select name="mb_level" id="mb_level">
                <?php for ($i = 1;$i <= 10;$i++ ){?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php } ?>
            </select>
        </td>
        <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
        <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input lv3" size="30" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_icon">사업자 여부</label></th>
        <td>예
            <input type="radio" name = "mb_buisnessman" value="Y">
            아니오
            <input type="radio" name = "mb_buisnessman" value="N">
        </td>
        <th scope="row"><label for="mb_icon">사업자등록증</label></th>
        <td>
            <div>
                <?php
                $mb_dir = substr($mb['mb_id'],0,2);
                $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'_buis.jpg';
                if (file_exists($icon_file)) {
                    $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'_buis.jpg';
//                        echo '</div><input style="float: bottom" type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1"> ※체크 후 확인을 누르면 삭제됩니다.';
                    echo '<a href="'.G5_BBS_URL.'/view_image?bo_table=buis_'.$mb_dir.'&fn='.$mb['mb_id'].'_buis.jpg" class = "view_image"><img class="view_image" style="width: 80px" src="'.$icon_url.'" alt="">';

                }
                ?>
            </div>
        </td>
    </tr>
    <?php if ($mb['mb_division'] == '2' || $_REQUEST['add'] == 'y'){ ?>

    <tr>
        <th scope="row"><label for="mb_name">이름<strong class="sound_only">필수</strong></label></th>
        <td ><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" class="frm_input lv3" size="15" minlength="2" maxlength="20"></td>
        <th scope="row"><label for="mb_4">매니저승인<strong class="sound_only">필수</strong></label></th>
        <td>
            <input class="lv3" name="mb_4" type="radio" value="Y"><span style="margin: 0 5px">승인</span>
            <input class="lv3" name="mb_4" type="radio" value="N"><span style="margin: 0 5px">승인안됨</span>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_2">예금주<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_2" value="<?php echo $mb['mb_2'] ?>" id="mb_2" maxlength="100"  class="frm_input lv3" size="30"></td>
        <th scope="row"><label for="mb_3">계좌번호</label></th>
        <td>
            <select name="mb_1" class="frm_input lv3">
                <option value="">은행명</option>
                <? foreach ($bank_list as $code=>$name) {?>
                    <option value="<?=$code?>" <? if ($w == "u" && $code == $mb['mb_1']) echo "selected"; ?>><?=$name?></option>
                <? } ?>
            </select>
            <input type="text" name="mb_3" value="<?php echo $mb['mb_3'] ?>" id="mb_3" class="frm_input lv3" size="30" maxlength="20">
        </td>
    </tr>
        <?php if ($_REQUEST['add'] != 'y'){ ?>
        <tr>
            <td colspan="3" style="font-size: 1.5em; font-weight: bolder">프로필</td>
        </tr>

        <tr>
            <th scope="row"><label for="mb_icon">프로필사진</label></th>
            <td>
                <?php echo help('<strong>가로: '.$config['cf_member_icon_width'].'px X 세로: '.$config['cf_member_icon_height'].'px</strong>') ?>
                <input type="file" name="mb_icon" id="mb_icon" accept=".jpg,.jpeg,.png">
                <div style="margin-top: 10px">
                    <?php
                    $mb_dir = substr($mb['mb_id'],0,2);
                    $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.jpg';
                    if (file_exists($icon_file)) {
                        $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.jpg';
                        echo '<div><img src="'.$icon_url.'" alt="">';
//                        echo '</div><input style="float: bottom" type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1"> ※체크 후 확인을 누르면 삭제됩니다.';
                    }
                    ?>
                </div>
            </td>
            <th scope="row"><label for="mb_level">응답시간<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="pf_time" id="pf_time">
                    <?php for ($i = 1;$i <= count($pf_time_list);$i++ ){?>
                        <option value="<?= $i ?>"><?= $pf_time_list[$i] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_2">연락가능시간<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="time" name="pf_call_time1" value="<?php echo $mb['pf_call_time1'] ?>" id="pf_call_time1" maxlength="100"  class="frm_input lv3" size="30">
                <input type="time" name="pf_call_time2" value="<?php echo $mb['pf_call_time2'] ?>" id="pf_call_time2" maxlength="100"  class="frm_input lv3" size="30">
            </td>
            <th scope="row"><label for="mb_2">학력 및 전공<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text" name="pf_school" value="<?php echo $mb['pf_school'] ?>" id="pf_school" maxlength="100"  class="frm_input lv3" size="30">
                <input type="text" name="pf_major" value="<?php echo $mb['pf_major'] ?>" id="pf_major" maxlength="100"  class="frm_input lv3" size="30">
                <select name="pf_grad" id="pf_grad">
                    <option value="">졸업여부</option>
                    <option value="J">재학중</option>
                    <option value="H">휴학중</option>
                    <option value="G">졸업</option>
                </select>
            </td>
        </tr>
        <?php if (count($pf_pro_ctg1) != 0 ){ ?>
        <tr>
            <th scope="row"><label for="mb_2">전문분야 및 상세분야<strong class="sound_only">필수</strong></label></th>
            <td colspan="3">
            <?php for ($i = 0; $i <count($pf_pro_ctg1);$i++){
                if ($pf_pro_ctg1[$i] == ""){
                    continue;
                }
                $pf_pro_code = common_code($pf_pro_ctg1[$i], 'code_idx');
                for ($a = 0; $a <count($pf_pro_ctg3);$a++) {

                    $pf_pro_code2 = common_code($pf_pro_ctg2[$a], 'code_idx');
                    $pf_pro_code3 = common_code($pf_pro_ctg3[$a], 'code_idx');
                    echo '<span style="border-right: 1px solid black; padding: 10px">'.$pf_pro_code[0]['name'].'>'.$pf_pro_code2[0]['name'].'>'.$pf_pro_code3[0]['name'].'</span>';
                }
            }?>
            </td>
        </tr>
        <?php }?>
        <?php if (count($pf_hold_ctg1) != 0 ){ ?>
        <tr>
            <th scope="row"><label for="mb_2">분야별 보유기술<strong class="sound_only">필수</strong></label></th>
            <td colspan="3">
                <?php for ($i = 0; $i <count($pf_hold_ctg1);$i++){
                    if ($pf_hold_ctg1[$i] == ""){
                        continue;
                    }
                    $pf_hold_code1 = common_code($pf_hold_ctg1[$i], 'code_idx');
                    for ($a = 0; $a <count($pf_hold_ctg2);$a++) {

                        $pf_hold_code2 = common_code($pf_hold_ctg2[$a], 'code_idx');
                        echo '<span style="border-right: 1px solid black; padding: 10px">'.$pf_hold_code1[0]['name'].'>'.$pf_hold_code2[0]['name'].'</span>';
                    }
                }
                ?>
            </td>
        </tr>
        <?php }?>
        <?php if (count($pf_certificate) != 0 ){ ?>
        <tr>
            <th scope="row"><label for="mb_2">자격증<strong class="sound_only">필수</strong></label></th>
            <td colspan="3">
                <?php
                $bo_table = "certificate";
                $sql = "select bf_file from {$g5['board_file_table']} where wr_id = '{$mb["mb_id"]}' and bo_table = '{$bo_table}' order by bf_file";
                $cert_result = sql_query($sql);

                for ($i = 0; $cert_image = sql_fetch_array($cert_result);$i++){

                    $url = G5_DATA_URL.'/file/'.$bo_table.'/'.$cert_image['bf_file'];
                    if ($pf_certificate[$i] == ""){
                        continue;
                    }
                    $html = '<div style="float: left; border-right: 1px solid black;"><span name="certificate_span">'.$pf_certificate[$i].'</span>';
//                    $html .= '<button style="margin-left: 20px; margin-right: 10px">삭제</button>';
                    $html .= '<img style = "display:block;bottom: 200px;width: 100px; height:100px" src = "'.$url.'" >';
                    $html .= '</div>';

                    echo $html;
                }?>
            </td>
        </tr>
        <?php }?>
        <tr>
            <th scope="row"><label for="mb_2">자기소개<strong class="sound_only">필수</strong></label></th>
            <td colspan="3"><textarea name="pf_produce"><?=$mb['pf_produce']?></textarea></td>
        </tr>
        <?php } ?>
    <?php } ?>
	<? /*
	<tr>
        <th scope="row"><label for="mb_memo">메모</label></th>
        <td colspan="3"><textarea name="mb_memo" id="mb_memo"><?php echo $mb['mb_memo'] ?></textarea></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_level">회원 권한</label></th>
        <td><?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?></td>
        <th scope="row">포인트</th>
        <td><a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $mb['mb_id'] ?>" target="_blank"><?php echo number_format($mb['mb_point']) ?></a> 점</td>
    </tr>
    <tr>
		<th scope="row"><label for="mb_homepage">홈페이지</label></th>
        <td><input type="text" name="mb_homepage" value="<?php echo $mb['mb_homepage'] ?>" id="mb_homepage" class="frm_input" maxlength="255" size="15"></td>
        <th scope="row"><label for="mb_tel">전화번호</label></th>
        <td><input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row">본인확인방법</th>
        <td colspan="3">
            <input type="radio" name="mb_certify_case" value="ipin" id="mb_certify_ipin" <?php if($mb['mb_certify'] == 'ipin') echo 'checked="checked"'; ?>>
            <label for="mb_certify_ipin">아이핀</label>
            <input type="radio" name="mb_certify_case" value="hp" id="mb_certify_hp" <?php if($mb['mb_certify'] == 'hp') echo 'checked="checked"'; ?>>
            <label for="mb_certify_hp">휴대폰</label>
        </td>
    </tr>
    <tr>
        <th scope="row">본인확인</th>
        <td>
            <input type="radio" name="mb_certify" value="1" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>>
            <label for="mb_certify_yes">예</label>
            <input type="radio" name="mb_certify" value="" id="mb_certify_no" <?php echo $mb_certify_no; ?>>
            <label for="mb_certify_no">아니오</label>
        </td>
        <th scope="row"><label for="mb_adult">성인인증</label></th>
        <td>
            <input type="radio" name="mb_adult" value="1" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>>
            <label for="mb_adult_yes">예</label>
            <input type="radio" name="mb_adult" value="0" id="mb_adult_no" <?php echo $mb_adult_no; ?>>
            <label for="mb_adult_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row">주소</th>
        <td colspan="3" class="td_addr_line">
            <label for="mb_zip" class="sound_only">우편번호</label>
            <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
            <label for="mb_addr1">기본주소</label><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
            <label for="mb_addr2">상세주소</label>
            <br>
            <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
            <label for="mb_addr3">참고항목</label>
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_icon">회원아이콘</label></th>
        <td colspan="3">
            <?php echo help('이미지 크기는 <strong>넓이 '.$config['cf_member_icon_width'].'픽셀 높이 '.$config['cf_member_icon_height'].'픽셀</strong>로 해주세요.') ?>
            <input type="file" name="mb_icon" id="mb_icon">
            <?php
            $mb_dir = substr($mb['mb_id'],0,2);
            $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
            if (file_exists($icon_file)) {
                $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
                echo '<img src="'.$icon_url.'" alt="">';
                echo '<input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1">삭제';
            }
            ?>
        </td>
    </tr>
    <tr>
        <th scope="row">메일 수신</th>
        <td>
            <input type="radio" name="mb_mailling" value="1" id="mb_mailling_yes" <?php echo $mb_mailling_yes; ?>>
            <label for="mb_mailling_yes">예</label>
            <input type="radio" name="mb_mailling" value="0" id="mb_mailling_no" <?php echo $mb_mailling_no; ?>>
            <label for="mb_mailling_no">아니오</label>
        </td>
        <th scope="row"><label for="mb_sms_yes">SMS 수신</label></th>
        <td>
            <input type="radio" name="mb_sms" value="1" id="mb_sms_yes" <?php echo $mb_sms_yes; ?>>
            <label for="mb_sms_yes">예</label>
            <input type="radio" name="mb_sms" value="0" id="mb_sms_no" <?php echo $mb_sms_no; ?>>
            <label for="mb_sms_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_open">정보 공개</label></th>
        <td colspan="3">
            <input type="radio" name="mb_open" value="1" id="mb_open_yes" <?php echo $mb_open_yes; ?>>
            <label for="mb_open_yes">예</label>
            <input type="radio" name="mb_open" value="0" id="mb_open_no" <?php echo $mb_open_no; ?>>
            <label for="mb_open_no">아니오</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_signature">서명</label></th>
        <td colspan="3"><textarea  name="mb_signature" id="mb_signature"><?php echo $mb['mb_signature'] ?></textarea></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_profile">자기 소개</label></th>
        <td colspan="3"><textarea name="mb_profile" id="mb_profile"><?php echo $mb['mb_profile'] ?></textarea></td>
    </tr>
	*/ ?>


    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">회원가입일</th>
        <td><?php echo $mb['mb_datetime'] ?></td>
        <th scope="row">최근접속일</th>
        <td><?php echo $mb['mb_today_login'] ?></td>
    </tr>
    <?php } ?>
    <?php if ($w == 'u' && $mb['mb_memo'] != "") { ?>
    <tr>
        <th scope="row">삭제</th>
        <td colspan="3"><?php echo $mb['mb_memo'] ?></td>
    </tr>
    <?php } ?>


    <!--    <tr>-->
<!--        <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>-->
<!--        <td>-->
<!--            <input type="text" name="mb_leave_date" value="--><?php //echo $mb['mb_leave_date'] ?><!--" id="mb_leave_date" class="frm_input" maxlength="8">-->
<!--            <input type="checkbox" value="--><?php //echo date("Ymd"); ?><!--" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {-->
<!--this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">-->
<!--            <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>-->
<!--        </td>-->
<!--        <th scope="row">접근차단일자</th>-->
<!--        <td>-->
<!--            <input type="text" name="mb_intercept_date" value="--><?php //echo $mb['mb_intercept_date'] ?><!--" id="mb_intercept_date" class="frm_input" maxlength="8">-->
<!--            <input type="checkbox" value="--><?php //echo date("Ymd"); ?><!--" id="mb_intercept_date_set_today" onclick="if-->
<!--(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {-->
<!--this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">-->
<!--            <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>-->
<!--        </td>-->
<!--    </tr>-->

    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <a href="<?php echo $url.'?'.$qstr ?>">목록</a>
</div>
</form>


<?
$sql = " select me.* from new_recommend re right join {$g5['member_table']} me on re.register_mb_id =  me.mb_id where re.mb_id='$mb[mb_id]' ";
$result = sql_query($sql);


$cnt  = sql_num_rows($result);
?>

<div class="tbl_head02 tbl_wrap mb_tbl">
    <div style="font-size: 1.5em; font-weight: bolder" >추천가입 회원 리스트 총<?=number_format($cnt) ?>명</div>
    <table style="text-align: center">

        <thead>
        <tr>
            <th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
            <th>닉네임</th>
            <th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
            <th>휴대폰</th>
            <th>가입일</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $mb_nick = $row['mb_nick'];

            $mb_id = $row['mb_id'];
            ?>
            <tr class="<?php echo $bg; ?>">
                <td style="text-decoration:underline"><a href="<?=G5_ADMIN_URL?>/member_form.php?w=u&mb_id=<?=$mb_id?>"><?=$mb_id?></a></td>
                <td><?=$mb_nick?></td>
                <td><?=get_text($row['mb_name'])?></td>
                <td><?=$row['mb_hp']?></td>
                <td><?=substr($row['mb_datetime'],2,8)?></td>
            </tr>


            <?php
        }
        if ($i == 0)
            echo "<tr><td colspan=\"9\" class=\"empty_table\">자료가 없습니다.</td></tr>";
        ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    //승인여부 체크
    <?php if ($mb['mb_division'] == '2'){ ?>
    $("input:radio[name='mb_4']:radio[value='<?=$mb['mb_4']?>']").prop("checked", true);
    if('<?=$mb['mb_4']?>' == ''){
        $("input:radio[name='mb_4']:radio[value='N']").prop("checked", true);
    }
    <?php } ?>

    $("input:radio[name='mb_buisnessman']:radio[value='<?=$mb['mb_buisnessman']?>']").prop("checked", true);
    $("input:radio[name='mb_5']:radio[value='<?=$mb['mb_5']?>']").prop("checked", true);
    $("[name='mb_level']").val('<?= $mb['mb_level']?>');
    $("input:radio[name='mb_division']:radio[value='<?=$mb['mb_division']?>']").prop("checked", true);


    //회원추가 시 기본값 셋팅
    <?php if ($_REQUEST['add'] == 'y'){ ?>
    member_div(<?php echo $mb['mb_level'] ?>);
    <?php } ?>

    <?php //가입경로 체크박스 체크해주는 반복문
    for ($b = 0; $b < count($mb_sub_path_arr); $b++ ){ ?>
    $("input:checkbox[name='mb_sub_path[]']:checkbox[value='<?php echo $mb_sub_path_arr[$b] ?>']").prop("checked", true);
    <?php }?>


});
function fmember_submit(f)
{

    return true;
}
$("a.view_image").click(function() {
    window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=400,height=400,resizable=yes, scrollbars=1,status=no");
    return false;
});
function member_div(val) {
    if (val == '3'){
        $('.lv3').attr('readonly',false);
        $('.lv3').removeClass('readonly');
        $('.lv3').attr('disabled',false);
    }else{
        $('.lv3').attr('readonly',true);
        $('.lv3').val('');
        $('.lv3').addClass('readonly');
        $('.lv3').attr('disabled',true);
        $('.lv3').attr('checked',false);


    }
}


</script>

<?php
include_once('./admin.tail.php');
?>
