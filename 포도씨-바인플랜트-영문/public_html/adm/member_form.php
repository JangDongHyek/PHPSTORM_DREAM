<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'alnum_';
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

    $btn_txt = $mb['mb_intercept_date'] == '' ? '이용정지' : '이용정지해제';
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


$g5['title'] .= '회원정보';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<style>
    /*input[type=text] {background: none !important;}
    textarea {background: none !important;}*/
</style>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">


<input type="hidden" name="mb_level" value="<?=$mb['mb_level']?>">
<?php for ($i=1; $i<=10; $i++) { ?>
<input type="hidden" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>">
<?php } ?>

<!-- 기본정보 -->
<div class="tbl_frm01 tbl_wrap">
    <h1 class="subj">* 기본정보</h1>
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="10%">
        <col width="25%">
        <col width="10%">
        <col width="*">
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="podosea_certify">포도씨인증<?php echo $sound_only ?></label></th>
        <td>
            <select name="podosea_certify" onchange="memberUpdate('certify', '<?=$mb['mb_id']?>', this.value)">
                <option value="N" <?=$mb['podosea_certify'] == 'N'?'selected':''?>>N</option>
                <option value="Y" <?=$mb['podosea_certify'] == 'Y'?'selected':''?>>Y</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="50" minlength="3">
        </td>
        <th scope="row"><label for="mb_category">회원구분<?php echo $sound_only ?></label></th>
        <td><input type="text" name="mb_category" value="<?php echo $mb['mb_category'] ?>" id="mb_category" class="frm_input" size="50"></td>
        <!--<th scope="row"><label for="mb_password">비밀번호<?php /*echo $sound_only */?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" <?php /*echo $required_mb_password */?> class="frm_input <?php /*echo $required_mb_password */?>" size="50"></td>-->
    </tr>
    <tr>
        <th scope="row"><label for="mb_name">이름<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" class="frm_input" size="50"></td>
        <th scope="row"><label for="mb_nick">닉네임<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_nick" value="<?php echo $mb['mb_nick'] ?>" id="mb_nick" class="frm_input" size="50"></td>
    </tr>
	<tr>
        <th scope="row"><label for="mb_email">이메일<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100" class="frm_input email" size="50"></td>
		<th scope="row"><label for="mb_hp">휴대폰번호</label></th>
        <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="50"></td>
    </tr>
    <?php if($mb['mb_category'] == '일반') { ?>
    <tr>
        <th scope="row"><label for="mb_active_business">활동중인 비즈니스 분야<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_active_business" value="<?php echo $business_active_list[$mb['mb_active_business']]; ?>" id="mb_active_business" maxlength="100" class="frm_input" size="50"></td>
        <th scope="row"><label for="mb_grade">등급 (<?=number_format($mb['mb_grade_point'])?> NM)<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_grade" value="<?php echo $mb['mb_grade'] ?>" id="mb_grade" maxlength="100" class="frm_input" size="50"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_bunker">BUNKER</label></th>
        <td><input type="text" name="mb_bunker" value="<?php echo number_format($mb['mb_bunker']) ?>" id="mb_bunker" class="frm_input" size="50"></td>
        <th scope="row"><label for="mb_bunker_bonus">BONUS BUNKER</label></th>
        <td><input type="text" name="mb_bunker_bonus" value="<?php echo number_format($mb['mb_bunker_bonus']) ?>" id="mb_bunker_bonus" class="frm_input" size="50"></td>
    </tr>
    <?php } ?>
    <?php if($mb['mb_category'] == '기업') { ?>
    <tr>
        <th scope="row"><label for="mb_company_num">사업자등록번호<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_company_num" value="<?php echo $mb['mb_company_num'] ?>" id="mb_company_num" maxlength="100" class="frm_input" size="50"></td>
        <th scope="row"><label for="mb_company_name">회사명</label></th>
        <td><input type="text" name="mb_company_name" value="<?php echo $mb['mb_company_name'] ?>" id="mb_company_name" class="frm_input" size="50"></td>
    </tr>
    <th scope="row"><label for="mb_ceo">대표명<strong class="sound_only">필수</strong></label></th>
    <td><input type="text" name="mb_ceo" value="<?php echo $mb['mb_ceo'] ?>" id="mb_ceo" maxlength="100" class="frm_input" size="50"></td>
    <th scope="row"><label for="mb_addr1">회사주소</label></th>
    <td>
        <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1']?>" id="mb_addr1" class="frm_input" size="70">
        <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2']?>" id="mb_addr2" class="frm_input" size="50">
    </td>
    <tr>
        <th scope="row"><label for="mb_grade">등급<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_grade" value="<?php echo $mb['mb_grade'] ?>" id="mb_grade" maxlength="100" class="frm_input" size="50"></td>
        <th scope="row"></th>
        <td></td>
        <!--<th scope="row"><label for="mb_bunker">BUNKER</label></th>
        <td><input type="text" name="mb_bunker" value="<?php /*echo number_format($mb['mb_bunker']) */?>" id="mb_bunker" class="frm_input" size="50"></td>-->
    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>

<!-- 프로필1 -->
<div class="tbl_frm01 tbl_wrap">
    <h1 class="subj">* <?php echo $mb['mb_category'] == '일반' ? '회원소개' : '회사요약'; ?></h1>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col width="10%">
            <col width="25%">
            <col width="10%">
            <col width="*">
        </colgroup>
        <tbody>
        <?php if($mb['mb_category'] == '일반') { ?>
        <tr>
            <th scope="row"><label for="mb_id">프로필이미지<?php echo $sound_only ?></label></th>
            <td>
                <?php
                $img = sql_fetch(" select * from g5_member_img where mb_id = '{$mb_id}'; ")['img_file'];
                if(!empty($img)) {
                    $mb_photo = G5_DATA_URL.'/file/member/'.$img;
                ?>
                <img src="<?=$mb_photo?>" class="noimg" style="width: 100px; height: 100px; border-radius: 50%;">
                <?php
                } else {
                ?>
                프로필 이미지가 없습니다.
                <?php
                }
                ?>
            </td>
            <th scope="row"><label for="mb_introduce">자기소개<?php echo $sound_only ?></label></th>
            <td><textarea name="mb_introduce" id="mb_introduce" style="resize: unset;width: 400px;"><?php echo $mb['mb_introduce'] ?></textarea></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_si">지역<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="mb_si" value="<?php echo $mb['mb_si'] ?>" id="mb_si" class="frm_input" size="50"></td>
            <th scope="row"></th>
            <td></td>
        </tr>
        <?php } ?>
        <?php if($mb['mb_category'] == '기업') { ?>
        <tr>
            <th scope="row"><label for="mb_company_name">회사명<?php echo $sound_only ?></label></th>
            <td><input type="text" name="mb_company_name" value="<?php echo $mb['mb_company_name'] ?>" id="mb_company_name" class="frm_input" size="50"></td>
            <!--<th scope="row"><label for="mb_company_name_eng">회사명(영문)<?php /*echo $sound_only */?></label></th>
            <td><input type="text" name="mb_company_name_eng" value="<?php /*echo $mb['mb_company_name_eng'] */?>" id="mb_company_name_eng" class="frm_input" size="50"></td>-->
        </tr>
        <tr>
            <th scope="row"><label for="mb_id">회사로고<?php echo $sound_only ?></label></th>
            <td>
                <?php
                $img = sql_fetch(" select * from g5_member_img where mb_id = '{$mb_id}' and category = '로고'; ")['img_file'];
                if(!empty($img)) {
                    $mb_photo = G5_DATA_URL.'/file/company/'.$img;
                ?>
                <img src="<?=$mb_photo?>" class="noimg" height="100%;" style="width: 100px; height: 80px;">
                <?php
                } else {
                ?>
                회사 로고가 없습니다.
                <?php
                }
                ?>
            </td>
            <th scope="row"><label for="mb_company_sector">업종/분류<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="mb_company_sector" value="<?php echo $company_sectors[$mb['mb_company_sector']]; ?>" id="mb_company_sector" class="frm_input" size="50"></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_company_sector_detail">상세업종<strong class="sound_only">필수</strong></label></th>
            <td>
                <?php
                $sector_detail = explode('|', $mb['mb_company_sector_detail']);
                for ($i = 0; $i < count($sector_detail); $i++) {
                ?>
                <input type="text" name="mb_company_sector_detail" value="<?=$sector_detail[$i]?>" id="mb_company_sector_detail" class="frm_input" size="50">
                <?php } ?>
            </td>
            <th scope="row"></th>
            <td></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- 프로필2 -->
<?php if($mb['mb_category'] == '일반') { ?>
<div class="tbl_head02 tbl_wrap mb_tbl">
    <h1 class="subj">* 경력사항</h1>
    <table style="width: 50%;">
        <caption><?php echo $g5['title']; ?></caption>
        <thead>
        <tr>
            <th>프리랜서</th>
            <th>회사</th>
            <th>근무부서</th>
            <th>직위</th>
            <th>근무기간</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $temp = explode(',', $mb['mb_career']);
        for($i=0; $i<count($temp); $i++) {
            $mb_career = explode(' · ', $temp[$i]);
            if(!empty($mb_career[4]) && $mb_career[4] == '프리랜서') { $mb_career[4] = 'Y';}
            else { $mb_career[4] = 'N'; }
        ?>
        <tr>
            <td><?=$mb_career[4]?></td>
            <td><?=$mb_career[0]?></td>
            <td><?=$mb_career[1]?></td>
            <td><?=$mb_career[2]?></td>
            <td><?=$mb_career[3]?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<?php } ?>
<?php if($mb['mb_category'] == '기업') { ?>
<div class="tbl_frm01 tbl_wrap">
    <h1 class="subj">* 회사소개</h1>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col width="10%">
            <col width="25%">
            <col width="10%">
            <col width="*">
        </colgroup>
        <tbody>
            <tr>
                <th scope="row"><label for="mb_company_introduce">회사소개<strong class="sound_only">필수</strong></label></th>
                <td><textarea name="mb_company_introduce" id="mb_company_introduce" style="resize: unset;width: 600px;"><?php echo $mb['mb_company_introduce'] ?></textarea></td>
                <th scope="row"></th>
                <td></td>
                <!--<th scope="row"><label for="mb_company_introduce_eng">영문회사소개</label></th>
                <td><textarea name="mb_company_introduce_eng" id="mb_company_introduce_eng" style="resize: unset;width: 400px;"><?php /*echo $mb['mb_company_introduce_eng'] */?></textarea></td>-->
            </tr>
        </tbody>
    </table>
</div>
<?php } ?>

<!-- 프로필3 -->
<div class="tbl_head02 tbl_wrap mb_tbl">
    <h1 class="subj">* <?php echo $mb['mb_category'] == '일반' ? '학력 · 전공' : '인증서 및 자료'; ?></h1>
    <?php if($mb['mb_category'] == '일반') { ?>
    <table style="width: 50%;">
        <caption><?php echo $g5['title']; ?></caption>
        <thead>
        <tr>
            <th>학교명</th>
            <th>전공</th>
            <th>상태</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $temp = explode(',', $mb['mb_education']);
        for($i=0; $i<count($temp); $i++) {
            $mb_education = explode(' · ', $temp[$i]);
        ?>
        <tr>
            <td><?=$mb_education[0]?></td>
            <td><?=$mb_education[1]?></td>
            <td><?=$mb_education[2]?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <?php } ?>
    <?php if($mb['mb_category'] == '기업') { ?>
    <table style="width: 50%;">
        <thead>
        <tr>
            <th>보유인증, 특허</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $mb_patent = explode('|', $mb['mb_patent']);
        for($i=0; $i<count($mb_patent); $i++) {
            ?>
            <tr>
                <td><?=$mb_patent[$i]?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <table style="width: 50%;margin-top: 10px;">
        <thead>
        <tr>
            <th>커버</th>
            <th>카달로그</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = " select * from g5_member_img where mb_id = '{$mb['mb_id']}' and category = '카달로그' ";
        $result = sql_query($sql);
        for($i=0; $file=sql_fetch_array($result); $i++) {
            $cover = sql_fetch(" select * from g5_member_img where p_idx = {$file['idx']} ");
        ?>
        <tr>
            <td>
                <?php if(!empty($cover['img_file'])) { ?>
                <img class="basic" src="<?php echo G5_DATA_URL ?>/file/company/<?=$cover['img_file']?>" style="width: 100px; height: 100px;">
                <?php } else { ?>
                <img class="no_img" src="<?php echo G5_THEME_IMG_URL ?>/app/logo.png">
                <?php } ?>
            </td>
            <td>
                <a href="<?=G5_DATA_URL?>/file/company/<?=$file['img_file']?>" download="<?=$file['img_source']?>"><?=$file['img_source']?></a>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <table style="width: 50%;margin-top: 10px;">
        <thead>
        <tr>
            <th>회사 소개 영상</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><a href="<?=$mb['mb_video_link']?>"><?=$mb['mb_video_link']?></a></td>
        </tr>
        </tbody>
    </table>
<?php } ?>
</div>

<!-- 프로필4 -->
<div class="tbl_head02 tbl_wrap mb_tbl">
    <h1 class="subj">* <?php echo $mb['mb_category'] == '일반' ? '보유기술 · 자격증' : '취급제품 및 브랜드'; ?></h1>
    <?php if($mb['mb_category'] == '일반') { ?>
        <table style="width: 50%;">
            <thead>
            <tr>
                <th>자격증명</th>
                <th>발급기관</th>
                <th>발급일</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $temp = explode(',', $mb['mb_tech']);
            for($i=0; $i<count($temp); $i++) {
                $mb['mb_tech'] = explode(' · ', $temp[$i]);
            ?>
            <tr>
                <td><?=$mb['mb_tech'][0]?></td>
                <td><?=$mb['mb_tech'][1]?></td>
                <td><?=$mb['mb_tech'][2]?></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    <?php } ?>
    <?php if($mb['mb_category'] == '기업') { ?>
    <table style="width: 50%;">
        <thead>
        <tr>
            <th>취급 제품 및 서비스</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $mb_goods_service = explode('|', $mb['mb_goods_service']);
        for($i=0; $i<count($mb_goods_service); $i++) {
        ?>
        <tr>
            <td><?=$mb_goods_service[$i]?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <table style="width: 50%;margin-top: 10px;">
        <thead>
        <tr>
            <th>브랜드</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $mb_brand = explode('|', $mb['mb_brand']);
        for($i=0; $i<count($mb_brand); $i++) {
            ?>
            <tr>
                <td><?=$mb_brand[$i]?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php } ?>
</div>

<!-- 프로필5 -->
<div class="tbl_frm01 tbl_wrap">
    <h1 class="subj">* <?php echo $mb['mb_category'] == '일반' ? '추가정보' : '해시태그'; ?></h1>
    <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col width="10%">
            <col width="25%">
            <col width="10%">
            <col width="*">
        </colgroup>
        <tbody>
        <?php if($mb['mb_category'] == '일반') { ?>
            <tr>
                <th scope="row"><label for="mb_birth">생년월일<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_birth" value="<?php echo $mb['mb_birth'] ?>" id="mb_birth" class="frm_input" size="50"></td>
                <th scope="row"><label for="mb_sex">성별</label></th>
                <td><input type="text" name="mb_sex" value="<?php echo $mb['mb_sex'] ?>" id="mb_sex" class="frm_input" size="50"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_alarm">알림동의<strong class="sound_only">필수</strong></label></th>
                <td><?php echo $mb['mb_push'] == 'Y' ? 'Y' : 'N'; ?></td>
                <th scope="row"></th>
                <td></td>
            </tr>
        <?php } ?>
        <?php if($mb['mb_category'] == '기업') { ?>
            <tr>
                <th scope="row"><label for="mb_hashtag">해시태그<strong class="sound_only">필수</strong></label></th>
                <td colspan="2">
                    <?php
                    $mb_hashtag = explode(',', $mb['mb_hashtag']);
                    for($i=0; $i<count($mb_hashtag); $i++) {
                    ?>
                    <span><?=$mb_hashtag[$i]?></span>
                    <?php
                    }
                    if(empty($mb_hashtag[0])) {
                    ?>
                    <span>해시태그가 없습니다.</span>
                    <?php
                    }
                    ?>
                </td>
                <td></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <?php if($mb['mb_level'] == 10) { // 관리자정보 수정에서 사용 ?>
    <input type="submit" value="수정" class="btn_submit" accesskey='s'>
    <?php } ?>
    <input type="button" value="<?=$btn_txt;?>" class="btn_submit" onclick="memberUpdate('intercept', '<?=$mb['mb_id']?>')">
    <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<script>
$(function() {
    <?php if($mb['mb_level'] != 10) { ?>
    $("input").attr('readonly', true);
    $("textarea").attr('readonly', true);
    <?php } ?>
});

function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
        alert('아이콘은 gif 파일만 가능합니다.');
        return false;
    }

    return true;
}

// 회원정보 수정
function memberUpdate(mode, mb_id, value) {
    $.ajax({
        url: './ajax.member_update.php',
        type: 'post',
        data: {mode: mode, mb_id: mb_id, value: value},
        success: function(data) {
            if(data) {
                if(mode == 'intercept') { // 이용정지/이용정지해제 처리
                    alert("<?=$btn_txt?> 처리되었습니다.");
                    location.reload();
                } else if(mode == 'certify') { // 포도씨 인증
                    alert("인증 상태가 변경되었습니다.");
                }
            }
        }
    });
}
</script>

<?php
include_once('./admin.tail.php');
?>
