<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $_mb_id = '';
    $_mb_id_class = ' alnum_';
    $_mb_password = '';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '등록';
}
else if ($w == 'u')
{
    $idx = $_GET['idx'];

    $sql = " select ct.idx as center_idx, ct.center_name, ct.center_mb_name, ct.open_date, ct.close_date, ct.memo, mb.* from g5_center as ct left join g5_member as mb on ct.center_mb_no = mb.mb_no where ct.idx = {$idx} ";
    $mb = sql_fetch($sql);

    $_mb_id = 'readonly';
    $_mb_password = '';
    $html_title = '수정';
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '센터'.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<form name="fcenter" id="fcenter" action="./center_form_update.php" onsubmit="return fcenter_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="mb_state" value="<?=$mb['mb_state']?>">
<input type="hidden" name="mb_level" value="<?=$mb['mb_level']?>">
<input type="hidden" name="del_mb_img" value="">
<input type="hidden" name="mb_no" value="<?=$mb['mb_no']?>">
<input type="hidden" name="center_idx" value="<?=$mb['center_idx']?>">


<div id="adm_mw_box">
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col class="grid_5">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="center_name">센터/아카데미<?php echo $sound_only ?></label></th>
            <td>
                <input type="text" name="center_name" value="<?php echo $mb['center_name'] ?>" id="center_name" required class="frm_input" size="30" placeholder="센터/아카데미">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="center_mb_name">팀장명<?php echo $sound_only ?></label></th>
            <td>
                <input type="text" name="center_mb_name" value="<?php echo $mb['center_mb_name'] ?>" id="center_mb_name" required class="frm_input" size="30" placeholder="팀장명">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
            <td class="row">
                <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $_mb_id ?> class="frm_input <?php echo $_mb_id_class ?>" size="30" minlength="3" maxlength="20" placeholder="아이디">
                <dd class="status_ico hide"><i class="fas fa-check"></i></dd>
                <dd class="error"></dd>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
            <td>
                <input type="password" name="mb_password" id="mb_password" <?php echo $_mb_password ?> class="frm_input <?php echo $_mb_password ?>" size="30" maxlength="20" placeholder="비밀번호">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_info">개인정보<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text" name="mb_hp1" value="<?php echo explode('-', $mb['mb_hp'])[0] ?>" id="mb_hp1" required class="frm_input" size="2" maxlength="3" placeholder="ex)010" style="margin-bottom: 5px;" onkeyup="number_check(this)"> -
                <input type="text" name="mb_hp2" value="<?php echo explode('-', $mb['mb_hp'])[1] ?>" id="mb_hp2" required class="frm_input" size="2" maxlength="4" placeholder="ex)1234" style="margin-bottom: 5px;" onkeyup="number_check(this)"> -
                <input type="text" name="mb_hp3" value="<?php echo explode('-', $mb['mb_hp'])[2] ?>" id="mb_hp3" required class="frm_input" size="2" maxlength="4" placeholder="ex)1234" style="margin-bottom: 5px;" onkeyup="number_check(this)">
                <input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100"  class="frm_input email" size="40" placeholder="E-mail" style="margin-bottom: 5px;"><br>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="open_date">설립일<strong class="sound_only">필수</strong></label>
            </th>
            <td>
                <input type="date" name="open_date" value="<?php echo empty($mb['open_date']) ? date('Y-m-d') : $mb['open_date'] ?>" id="open_date"  class="frm_input"><!-- 일자 -->
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="close_date">폐점일<strong class="sound_only">필수</strong></label>
            </th>
            <td>
                <input type="date" name="close_date" value="<?php echo empty($mb['close_date']) ? '' : $mb['close_date'] ?>" id="close_date"  class="frm_input"><!-- 일자 -->
            </td>
        </tr>
        <tr>
            <th>메모</th>
            <td>
                <textarea class="frm_input" id="memo" name="memo" style="white-space: pre-wrap;resize: unset;height: 200px;font-family: inherit;"><?=$mb['memo']?></textarea>
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</div>

<div class="adm_mw_btn">
    <input type="submit" class="btn_adm_ok" id="btn" value="<?=$html_title?>하기">
    <a href="<?=G5_ADMIN_URL?>/center_list.php" class="btn_adm_cancel">취소하기</a>
</div>
</form>

<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <i class="fas fa-times-square" id="btnCloseLayer" style="width:40px; height:40px; color:#000; font-size:2.2em; cursor:pointer;position:absolute;right:-15px;bottom:-15px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></i>
</div>

<script>
function fcenter_submit(f) {
    // 아이디 중복 체크
    if($('#mb_id').parents(".row").find(".status_ico").hasClass("err")) {
        alert('아이디를 확인하세요.');
        $('#mb_id').focus();
        return false;
    }

    return true;
}

// 아이디 중복체크
$("#mb_id").keyup(function (){
    var mb_id = $(this).val();
    var reg_mb_id = $(this);

    // 아이디 정규표현식
    var regId = /^[a-z0-9]{4,12}$/;

    if (regId.test(mb_id)){
        $(this).parents(".row").find(".status_ico").removeClass("err").addClass("pas");
        $(this).parents(".row").find(".error").html("");
    }else{
        $(this).parents(".row").find(".status_ico").removeClass("pas").addClass("err");
        $(this).parents(".row").find(".error").addClass("on").html("아이디는 영문소문자와 숫자, 4 ~ 12자리까지 가능합니다.");

        return false;
    }

    // 아작스로 중복 아이디가 있는지 체크 1
    $.post(g5_bbs_url+"/ajax.mb_id.php", {"reg_mb_id":mb_id}, function (result){
        if(result == ''){  // ajax.mb_id.php 의 die($msg); 값을 가져옴
            reg_mb_id.parents(".row").find(".status_ico").removeClass("err").addClass("pas"); //될때 초록색 박스 i 는 icon 의 약자
            reg_mb_id.parents(".row").find(".error").html(""); // 마지막 dd 의 css 스타일 사용
        }else{
            reg_mb_id.parents(".row").find(".status_ico").removeClass("pas").addClass("err");
            reg_mb_id.parents(".row").find(".error").addClass("on").html(result);
        }
    });
});
</script>

<?php
include_once('./admin.tail.php');
?>
