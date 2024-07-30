<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
$get_mb_level = $_GET['mb_level'];
if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

//    $mb['mb_mailling'] = 1;
//    $mb['mb_open'] = 1;
//    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '회원 추가';
    $text = '<p style="margin-left: 20px">회색으로 칠해진 부분은 입력할 수 없습니다.</p>';
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
    $html_title = '회원 수정';

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

if (isset($get_mb_level)){
    $html_title = "관리팀장 등록";
}

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
$g5['title'] .= $html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

?>
<style>
    .back_gr{
        background: grey;
    }
</style>
<?php if ($_REQUEST['add']){ echo $text;?>


<?php } ?>
<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="mb_level" value="<?php echo $mb['mb_level'] ?>">



    <!--<input type="hidden" name="mb_level" value="--><?//=$mb['mb_level']?><!--">-->
    <?php //for ($i=1; $i<=10; $i++) { ?>
    <!--<input type="hidden" name="mb_--><?php //echo $i ?><!--" value="--><?php //echo $mb['mb_'.$i] ?><!--" id="mb_--><?php //echo $i ?><!--">-->
    <?php //} ?>

    <?php if(empty($get_mb_level)){ ?>
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
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
                    <? /*
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
			*/ ?>
                </td>
                <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
                <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">이름<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" minlength="2" maxlength="20"></td>
                <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
                <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" required id="mb_hp" class="frm_input required" size="15" maxlength="20"></td>
            </tr>
            <?php if ($_REQUEST['add'] == 'y'){ ?>
                <tr>
                    <th scope="row">회원구분<label for="mb_name"><strong class="sound_only">필수</strong></label></th>
                    <td>고객<input required name="mb_level" id="lv2" onclick="add_div(2)" value="2" type="radio"> 기사<input required onclick="add_div(3)" value="3" name="mb_level" type="radio"></td>
                </tr>
            <?php } ?>
            <?php if ($mb['mb_level'] == '3' || $_REQUEST['add'] == 'y' ){ ?>

                <tr>
                    <th scope="row"><label for="mb_work">근무가능시간<strong class="sound_only">필수</strong></label></th>
                    <td style="width: 40%">
                        <select name="ma_time1" id="reg_ma_time1" class="sch_sel">
                            <option value="오전">오전</option>
                            <option value="오후">오후</option>
                        </select>
                        <select name="ma_time2" id="ma_time2">
                            <option value="">시간선택</option>
                            <?php for($a = 1; $a < 13; $a++){?>
                              <option value="<?=$a?>시"><?=$a?>시</option>
                            <?php }?>
                        </select>
                        부터
                        <select name="ma_time3" id="ma_time3" class="sch_sel">
                            <option value="오전">오전</option>
                            <option value="오후">오후</option>
                        </select>
                        <select name="ma_time4" id="ma_time4">
                            <option value="">시간선택</option>
                            <?php for($a = 1; $a < 13; $a++){?>
                                <option value="<?=$a?>시"><?=$a?>시</option>
                            <?php }?>
                        </select>까지
                    </td>
                    <th scope="row"><label for="mb_work">근무가능요일<strong class="sound_only">필수</strong></label></th>

                    <td>
                    <?php
                        $ma_day_arr = explode(',',$mb['ma_day']);
                        for($i = 1; $i <= count($yoil); $i++){
                            $chk = "";
                            for($a= 0; $a < count($ma_day_arr); $a ++){
                                if ($ma_day_arr[$a] == $yoil[$i]){
                                    $chk = 'checked';

                                }
                            }

                            ?>
                            <input name="ma_day[]" <?=$chk?> type="checkbox" value="<?=$yoil[$i]?>"><?=$yoil[$i]?>
                        <?php } ?>

                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_work">출장세차경험<strong class="sound_only">필수</strong></label></th>
                    <td>
                    <input name="ma_exp_yn" type="radio" value="Y"><span style="margin: 0 5px">네</span>
                    <input name="ma_exp_yn" type="radio" value="N"><span style="margin: 0 5px">아니오</span>
                    </td>
                    <th scope="row"><label for="mb_work">작업차량<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input name = 'ma_car_no' type="text" class="frm_input" value="<?php echo $mb['ma_car_no'] ?>"placeholder="차량번호">
                        <input name = 'ma_car_type' type="text" class="frm_input" value="<?php echo $mb['ma_car_type'] ?>"placeholder="차량종류">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_1">생년월일<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input name="ma_birth" type="text" value="<?php echo $mb['ma_birth'] ?>" class="frm_input">
                    </td>
                    <th scope="row"><label for="mb_memo">근무희망개월수<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="ma_hope_month" value="<?php echo $mb['ma_hope_month'] ?>" id="ma_hope_month" class="frm_input"></td>
                </tr>


            <?php } ?>
            <tr>
                <th scope="row"><label for="mb_1">승인<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input name="mb_1" type="radio" value="Y"><span style="margin: 0 5px">승인</span>
                    <input name="mb_1" type="radio" value="N"><span style="margin: 0 5px">승인안됨</span>
                </td>
                <th scope="row"><label for="mb_1">주소<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" onclick="sample2_execDaumPostcode()" name="mb_addr1" size="100" value="<?php echo $mb['mb_addr1'] ?>" readonly id="mb_addr1" placeholder="주소"class="frm_input">
                    <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" placeholder="상세주소" class="frm_input">
                </td>
            </tr>

            <?php if ($mb['mb_level'] == '2' || $_REQUEST['add'] == 'y'){ ?>
                <tr>
                    <th scope="row"><label for="mb_work">자택주차가능시간<strong class="sound_only">필수</strong></label></th>
                    <td style="width: 40%">
                        <select name="go_work" id="reg_go_work" class="sch_sel">
                            <option value="">근무형태</option>
                            <option value="주간">주간</option>
                            <option value="야간">야간</option>
                            <option value="교대근무">교대근무</option>
                        </select>
                        <select name="go_time1" id="reg_go_time1" class="sch_sel">
                            <option value="오전">오전</option>
                            <option value="오후">오후</option>
                        </select>
                        <select name="go_time2">
                            <option value="">시간선택</option>
                            <?php for($a = 1; $a < 13; $a++){?>
                                <option value="<?=$a?>"><?=$a?>시</option>
                            <?php }?>
                        </select>
                    </td>
                    <th scope="row"><label for="mb_work">주차가능요일<strong class="sound_only">필수</strong></label></th>
                    <td>  <?php
                        $go_day_arr = explode(',',$mb['go_day']);
                        for($i = 1; $i <= count($yoil); $i++){
                            $chk = "";
                            for($a= 0; $a < count($go_day_arr); $a ++){
                                if ($go_day_arr[$a] == $yoil[$i]){
                                    $chk = 'checked';

                                }
                            }

                            ?>
                            <input name="go_day[]" <?=$chk?> type="checkbox" value="<?=$yoil[$i]?>"><?=$yoil[$i]?>
                        <?php } ?>
                    </td>
                </tr>

            <?php } ?>

            <?php if ($w == 'u') { ?>
                <tr>
                    <th scope="row">회원가입일</th>
                    <td><?php echo $mb['mb_datetime'] ?></td>
                    <th scope="row">최근접속일</th>
                    <td><?php echo $mb['mb_today_login'] ?></td>
                </tr>
            <?php } ?>
            <?php if ($w == 'u') { ?>
                <tr>
                    <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>
                    <td colspan="3" >
                        <input type="text" name="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>" id="mb_leave_date" class="frm_input" maxlength="8">
                        <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
                        <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>
<!--    관리팀장 등록 시   -->
    <input type="hidden" name="mb_level" value="9">
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
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
                    <? /*
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
			*/ ?>
                </td>
                <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
                <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_name">이름<strong class="sound_only">필수</strong></label></th>
                <td colspan="3"><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" minlength="2" maxlength="20"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php }?>
    <div class="btn_confirm01 btn_confirm">
        <?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
            <input type="submit" value="확인" class="btn_submit" accesskey='s'>
        <?php } ?>

        <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
    </div>
</form>

<?php

$sql = "select * from {$g5['car_table']} where mb_id = '{$mb['mb_id']}' ";
$go_car_result = sql_query($sql);

if ($mb['mb_level'] == '2'){
?>
<div class="tbl_head02 tbl_wrap mb_tbl">
    <p>고객 차량리스트 <span style="color: red">* 수정이 불가합니다. 삭제 후 다시 등록해주세요.</span></p>
    <table style="text-align: center">

        <thead>
        <tr>
            <th>차번호</th>
            <th>차종류</a></th>
            <th>차색상</th>
            <th>작성일자</th>
            <?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
            <th width="10%">차량사진</th>
            <th>비고</th>
            <?php }?>
        </tr>
        </thead>
        <tbody>
        <form name="frecom" id="frecom" action="<?= G5_ADMIN_URL ?>/adm.controller.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="mode" name="mode" value="go_car_update" class="frm_input">
            <input type="hidden" id="mb_id" name="mb_id" value="<?=$mb['mb_id']?>" class="frm_input">
            <tr class="<?php echo $bg; ?>" style="border-bottom: double gray;">
                <td>
                    <span id="text_span" style="float: left"></span>
                    <input type="text" name="car_no" id="car_no" class="frm_input">
                </td>
                <td><input type="text" name="car_type" id="car_type" class="frm_input"></td>
                <td><input type="text" id="car_color" name="car_color" class="frm_input"></td>
                <td><?=G5_TIME_YMD?></td>
                <td><input type="file" name="bf_file"></td>
                <?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
                <td><button type="submit" style="border: 1px solid gray">추가</button></td>
                <?php } ?>
            </tr>
        </form>

        <?php
        for ($i=0; $car_row=sql_fetch_array($go_car_result); $i++) {
            $idx = $car_row['gc_idx'];
            
            //23.04.14 한글파일 오류나는거랑 파일이름 다르게 적어주는거 db컬럼파서 만들어줌 wc
            if($car_row['car_img']){
                $file_path = G5_DATA_URL."/file/car_photo/".$car_row['car_img'];
            }else{
                //기존 .jpg 하드코딩되어있던것도.. 안고간다
                $file_path = G5_DATA_URL."/file/car_photo/".$car_row['car_no'].'.jpg';
            }
            //공백제거해줌
            $file_path = str_replace(' ','',$file_path);
            ?>
            <tr class="<?php echo $bg; ?>">
                <td id="car_no_<?= $idx ?>"><?= $car_row['car_no'] ?></td>
                <td id="car_type_<?= $idx ?>"><?= $car_row['car_type'] ?></td>
                <td id="car_color_<?= $idx ?>"><?= $car_row['car_color'] ?></td>
                <td><?= substr($car_row['wr_datetime'], 2, 8) ?></td>
                <td>
                    <?php if ($file_path) { ?>
                        <img src="<?= $file_path ?>" alt="" width="100px" height="auto">
                    <?php } ?>
                </td>
                <?php if ($auth_arr["menu" . substr($sub_menu, 0, 3) . "_write"] == "Y" || $member['mb_level'] == 10) { ?>
                    <td>
                        <button onclick="car_del(<?= $idx ?>,'<?= $car_row['car_no'] ?>','<?= $car_row['car_img'] ?>')" name="act_btn"
                                style="border: 1px solid gray">삭제
                        </button>
                    </td>
                <?php } ?>

            </tr>


            <?php
        }
        if ($i == 0)
            echo "<tr><td colspan=\"9\" class=\"empty_table\">자료가 없습니다.</td></tr>";
        ?>
        </tbody>
    </table>
</div>
<?php } ?>
<script>

    $(document).ready(function () {

        <?php if ($mb['mb_level'] == '3'){ ?>
            $("input:radio[name='ma_exp_yn']:radio[value='<?=$mb['ma_exp_yn']?>']").prop("checked", true);

            $("[name='ma_time1']").val('<?=$mb["ma_time1"]?>');
            $("[name='ma_time2']").val('<?=$mb["ma_time2"]?>');
            $("[name='ma_time3']").val('<?=$mb["ma_time3"]?>');
            $("[name='ma_time4']").val('<?=$mb["ma_time4"]?>');
        <?php } ?>
        <?php if ($mb['mb_level'] == '2'){ ?>
        $("[name='go_work']").val('<?=$mb["go_work"]?>');
        $("[name='go_time1']").val('<?=$mb["go_time1"]?>');
        $("[name='go_time2']").val('<?=$mb["go_time2"]?>');
        <?php } ?>

        $("input:radio[name='mb_1']:radio[value='<?=$mb['mb_1']?>']").prop("checked", true);

        $("a.view_image").click(function() {
            window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=400,height=400,resizable=yes, scrollbars=1,status=no");
            return false;
        });

        <?php if ($_REQUEST['add'] == 'y'){ ?>
            add_div(2);
            $('#lv2').prop('checked',true)
        <?php } ?>

    });

        //function fmember_submit(f)
        //{
        //    <?php //if ($_REQUEST['add'] == 'y'){ ?>
        //        if ($('[name="ma_exp_yn"]').val() == ""){
        //            alert("회원구분을 선택해주세요");
        //        }
        //    <?php //} ?>
        //
        //    return true;
        //}

        function car_del(idx,car_no,car_img='') {

            $.ajax({
                url: g5_admin_url+"/adm.controller.php",
                type: "POST",
                data: {
                    "mode": "go_car_del",
                    "car_no": car_no,
                    "car_img": car_img,
                    "idx": idx
                },
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    location.reload(true);
                }
            });
        }

    function add_div(lv) {
        if (lv == '3'){

            $("[name^='go_']").attr('disabled',true);

            $("[name^='go_']").addClass('back_gr');
            $("[name^='ma_']").removeClass('back_gr');

            $('[name = ma_hope_month]').attr('readonly',false);
            $("[name^='ma_']").attr('disabled',false);

        }else{
            $('[name = ma_hope_month]').attr('readonly',true);
            $("[name^='ma_']").attr('disabled',true);

            $("[name^='ma_']").addClass('back_gr');
            $("[name^='go_']").removeClass('back_gr');


            $("[name^='go_']").attr('disabled',false);
        }
    }

    function sample2_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                // document.getElementById('sample4_postcode').value = data.zonecode;
                document.getElementById("mb_addr1").value = roadAddr;
                // document.getElementById("sample4_jibunAddress").value = data.jibunAddress;

                // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                if(roadAddr !== ''){
                    document.getElementById("mb_addr1").value = roadAddr+extraRoadAddr;
                }
            }
        }).open();
    }



</script>

    <?php
    include_once('./admin.tail.php');
    ?>
