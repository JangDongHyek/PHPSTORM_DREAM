<?php
$sub_menu = "210100";
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
    $mb = get_member_no($mb_no);
    /*if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');*/

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $_mb_id = 'readonly';
    $_mb_password = '';
    $html_title = '수정';

    for($i=0; $i<count($mb); $i++) {
        $mb[array_values($mb)[$i]] = get_text($mb[array_values($mb)[$i]]);
    }
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '프로'.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_javascript('<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>', 0);
//add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>


<form name="fmember" id="fmember" action="./pro_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="mb_level" value="<?=$mb['mb_level']?>">
<input type="hidden" name="del_mb_img" value="">
<input type="hidden" name="mb_no" value="<?=$mb['mb_no']?>">


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
            <th scope="row"><label for="mb_center">센터/아카데미<?php echo $sound_only ?></label></th>
            <td>
                <input type="text" name="mb_center" value="<?php echo $member['mb_center'] ?>" id="mb_center" class=" frm_input readonly" size="30" readonly><br>
                <?php
                $center_code = sql_fetch(" select center_code from g5_center where center_name = '{$member['mb_center']}' ")['center_code'];
                ?>
                <input type="hidden" name="center_code" value="<?=$center_code?>">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
            <td class="row">
                <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $_mb_id ?> class="frm_input <?php echo $_mb_id_class ?>" size="30" minlength="3" maxlength="20"placeholder="아이디">
                <dd class="status_ico hide"><i class="fas fa-check"></i></dd>
                <dd class="error"></dd>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
            <td><input type="password" name="mb_password" id="mb_password" <?php echo $_mb_password ?> class="frm_input <?php echo $_mb_password ?>" size="30" maxlength="20"placeholder="비밀번호"></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_info">개인정보<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name"  class=" frm_input" size="30" minlength="2" maxlength="20" placeholder="이름" style="margin-bottom: 5px;"><br>
                <input type="text" name="mb_hp1" value="<?php echo explode('-', $mb['mb_hp'])[0] ?>" id="mb_hp1" required class="required frm_input" size="2" maxlength="3" placeholder="ex)010" style="margin-bottom: 5px;" onkeyup="number_check(this)"> -
                <input type="text" name="mb_hp2" value="<?php echo explode('-', $mb['mb_hp'])[1] ?>" id="mb_hp2" required class="required frm_input" size="2" maxlength="4" placeholder="ex)1234" style="margin-bottom: 5px;" onkeyup="number_check(this)"> -
                <input type="text" name="mb_hp3" value="<?php echo explode('-', $mb['mb_hp'])[2] ?>" id="mb_hp3" required class="required frm_input" size="2" maxlength="4" placeholder="ex)1234" style="margin-bottom: 5px;" onkeyup="number_check(this)">
                <input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100"  class=" frm_input email" size="40" placeholder="E-mail" style="margin-bottom: 5px;"><br>
                <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" maxlength="100"  class=" frm_input frm_add" size="80" placeholder="주소" style="margin-bottom: 5px;" onclick="sample2_execDaumPostcode()">
                <input type="button" class="btn" value="우편번호" style="margin-bottom: 5px;" onclick="sample2_execDaumPostcode()"><br>
                <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" maxlength="100"  class=" frm_input frm_add" size="80" placeholder="상세주소">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_birth">생년월일<strong class="sound_only">필수</strong></label></th>
            <td>
                <!--<input type="text" name="mb_birth" id="mb_birth" value="<?/*=$mb['mb_birth']*/?>" class=" frm_input" size="30">-->
                <select name="birth_year" id="birth_year" class="frm_select">
                </select>
                <select name="birth_month" id="birth_month" class="frm_select">
                </select>
                <select name="birth_day" id="birth_day" class="frm_select">
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_img">회원사진<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="file" id="mb_img" name="mb_img[]" onchange="getImgPrev(this)" accept="image/*">
                <div id="mb_img_prev" class="img_prev_wrap">
                <?
                if ($w == "u") {
                    $sql = " select * from g5_member_img where mb_no = '{$mb['mb_no']}' ";
                    $file = sql_fetch($sql);
    
                    if(!empty($file['img_file'])) {
                ?>
                    <div class="prev_area mb_icon">
                        <input type="hidden" id="img_idx" name="img_idx" value="<?=$file['idx']?>">
                        <button type="button" class="btn_del" onclick="mbImgDel('u');" style="position: absolute;">X</button>
                        <div class="img_bd"><img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>" width="150px" height="150px"></div>
                    </div>
                <?
                    }
                }
                ?>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="pro_extra_pay">프로수수료<strong class="sound_only">필수</strong></label>
            </th>
            <!--<td onclick="event.cancelBubble=true">
                <a href="javascript:void(0);" class="btn_remo" onclick="">수당설정</a>
            </td>-->
            <td>
                <div><button type="button" class="btn" onclick="addRows();" style="float: left;"><i class="fas fa-plus"> 추가</i></button> <span><p>&nbsp;* 금액의 범위가 중복될 경우 처음 수당(%)으로 적용됩니다.</p></span></div>
                <div id="extra_pay_wrap">
                    <?php
                    $count = 1;

                    if($w == 'u') {
                        $sql = " select * from g5_pro_extra_pay where pro_mb_no = {$mb_no} ";
                        $result = sql_query($sql);
                        $result_cnt = sql_num_rows($result);

                        $list = array();
                        for($i=0; $i<$result_cnt; $i++) {
                            $list[$i] = sql_fetch_array($result);
                        }
                        $count = count($list);
                    }

                    for($i=0; $i<$count; $i++) {
                        $row = $list[$i];
                        $onclick = ($row['idx'])? "deleteRows(this, {$row['idx']})" : "deleteRows(this)";
                    ?>
                    <div class="rows" style="margin-top: 5px;">
                        <input type="hidden" name="extra_pay_idx[]" id="extra_pay_idx" value="<?=$row['idx']?>">
                        <input type="tel" name="min_price[]" id="min_price" class="frm_input f_amt" placeholder="최소금액(원)" size="10" value="<?php if(!empty($row['min_price']) || $row['min_price'] == '0') { echo number_format($row['min_price']); }?>" required>원~
                        <input type="tel" name="max_price[]" id="max_price" class="frm_input f_amt" placeholder="최대금액(원)" size="10" value="<?php if(!empty($row['max_price'])) { echo number_format($row['max_price']); }?>" required>원
                        <i class="fas fa-angle-double-right"></i>
                        <input type="tel" name="pay_percent[]" id="pay_percent" class="frm_input f_amt" placeholder="수당(%)" size="10" maxlength="3" value="<?php if(!empty($row['pay_percent'])) { echo number_format($row['pay_percent']); }?>" required>%
                        <button type="button" class="btn" onclick="<?=$onclick?>"><i class="fas fa-times"> 삭제</i></button>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="pro_enter_date">입사일<strong class="sound_only">필수</strong></label>
            </th>
            <td>
                <input type="date" name="pro_enter_date" value="<?php echo empty($mb['pro_enter_date']) ? date('Y-m-d') : $mb['pro_enter_date'] ?>" id="pro_enter_date"  class="frm_input"><!-- 일자 -->
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="pro_leave_date">퇴사일<strong class="sound_only">필수</strong></label>
            </th>
            <td>
                <input type="date" name="pro_leave_date" value="<?php echo empty($mb['pro_leave_date']) ? '' : $mb['pro_leave_date'] ?>" id="pro_leave_date"  class="frm_input"><!-- 일자 -->
            </td>
        </tr>
        <?php if($w == '') { ?>
        <tr>
            <th scope="row" colspan="2" class="th_pln"><label for="mb_wish">이용약관 및 회원 준수 사항 <p>(약관의 동의가 필요합니다)</p><strong class="sound_only">필수</strong></label></th>
        </tr>
        <tr>
            <td colspan="2">
                <textarea class="frm_text" style="margin-bottom: 5px;"><?=$config['cf_stipulation']?></textarea><br>
                <input type="checkbox" name="agree_chk" value="Y"> 이용약관 및 회원 준수사항에 동의합니다.
            </td>
        </tr>
        <?php } ?>
        <tr>
            <th scope="row" colspan="2" class="th_pln"><label for="mb_pro_profile">프로필 <p>(주요이력 및 소개)</p><strong class="sound_only">필수</strong></label></th>
        </tr>
        <tr>
            <td colspan="2"><textarea class="frm_text" placeholder="프로필 내용을 입력하세요." name="mb_pro_profile"><?=$mb['mb_pro_profile']?></textarea></td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="th_pln"><label for="mb_notice">Notice<strong class="sound_only">필수</strong></label></th>
        </tr>
        <tr>
            <td colspan="2"><textarea class="frm_text" placeholder="메모할 내용을 입력하세요." name="mb_notice"><?=$mb['mb_notice']?></textarea></td>
        </tr>
        </tbody>
        </table>
    </div>
</div>

<div class="adm_mw_btn">    <!--<input type="submit" value="확인" class="btn_submit" accesskey='s'>-->
    <input type="button" class="btn_adm_ok" id="btn" value="<?=$html_title?>하기" onclick="form_ajax();">
    <!--<a href="./member_list.php?<?php /*echo $qstr */?>">목록</a>-->
    <a href="<?=G5_ADMIN_URL?>/pro_list.php" class="btn_adm_cancel">취소하기</a>
</div>
</form>

<div id="extra_pay_copy" class="hide">
    <div class="rows" style="margin-top: 5px;">
        <input type="hidden" name="extra_pay_idx[]" id="extra_pay_idx" value="">
        <input type="tel" name="min_price[]" id="min_price" class="frm_input f_amt" placeholder="최소금액(원)" size="10" value="" required>원~
        <input type="tel" name="max_price[]" id="max_price" class="frm_input f_amt" placeholder="최대금액(원)" size="10" value="" required>원
        <i class="fas fa-angle-double-right"></i>
        <input type="tel" name="pay_percent[]" id="pay_percent" class="frm_input f_amt" placeholder="수당(%)" size="10" maxlength="3" value="" required>%
        <button type="button" class="btn" onclick="deleteRows(this);"><i class="fas fa-times"> 삭제</i></button>
    </div>
</div>

<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
    <i class="fas fa-times-square" id="btnCloseLayer" style="width:40px; height:40px; color:#000; font-size:2.2em; cursor:pointer;position:absolute;right:-15px;bottom:-15px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼"></i>
</div>

<!-- autocomplete -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- autocomplete -->
<script>
$(function() {
    // 회원 상품 구분에 따른 화면 변경 -- 수정
    if('<?=$w?>' == 'u') {
        // 회원 사진
        if('<?=$file['img_file']?>' != '') {
            $('#mb_img').attr('style', 'display:none;');
        }

        // 센터/아카데미
        $('#mb_center').val('<?=$mb['mb_center']?>').attr('selected', 'selected');

        // 레슨명
        $('#lesson_code').val('<?=$mb['lesson_code']?>').attr('selected', 'selected');
    }

    selectDate('<?=$mb['mb_birth']?>');
});

var element_layer = document.getElementById('layer');
function closeDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    element_layer.style.display = 'none';
}

function sample2_execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                // document.getElementById("sample2_extraAddress").value = extraAddr;

            } else {
                // document.getElementById("sample2_extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            // document.getElementById('sample2_postcode').value = data.zonecode;
            document.getElementById("mb_addr1").value = addr +' '+extraAddr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("mb_addr2").focus();

            // iframe을 넣은 element를 안보이게 한다.
            // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            element_layer.style.display = 'none';
        },
        width : '100%',
        height : '100%',
        maxSuggestItems : 5
    }).embed(element_layer);

    // iframe을 넣은 element를 보이게 한다.
    element_layer.style.display = 'block';

    // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
    initLayerPosition();
}

// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
function initLayerPosition(){
    var width = "450"; //우편번호서비스가 들어갈 element의 width 350
    var height = "500"; //우편번호서비스가 들어갈 element의 height 400
    var borderWidth = 1; //샘플에서 사용하는 border의 두께

    // 위에서 선언한 값들을 실제 element에 넣는다.
    element_layer.style.width = width + 'px';
    element_layer.style.height = height + 'px';
    element_layer.style.border = borderWidth + 'px solid';
    // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
    element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
    element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}

// 파일업로드 미리보기
var filesTempArr = [];
var file_idx = 0;
function getImgPrev(input) {
    var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp)$/;

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

    var files = input.files;
    var files_arr = Array.prototype.slice.call(files);

    for (var i = 0; i<input.files.length; i++) {
        filesTempArr.push(files_arr[i]);
    }

    // 미리보기
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var src = e.target.result;
            var html = '<div class="prev_area mb_icon">';
            html += '<input type="hidden" id="img_idx" name="img_idx">';
            html += '<button type="button" class="btn_del" onclick="mbImgDel(\'w\');" style="position: absolute;">X</button>';
            html += '<div class="img_bd">';
            html += '<img src="'+ src +'" width="150px" height="150px">';
            html += '</div>';
            html += '</div>';

            $("#mb_img_prev").html('').append(html);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

var del_file_idx = '';
function mbImgDel(mode) {
    if (confirm("이미지를 삭제하시겠습니까?")) {
        if (mode == "u") {
            if($('#img_idx').val() != '') {
                del_file_idx += $('#img_idx').val() + ',';
            }
            // document.fmember.del_mb_img.value = "1";
        } else if (mode == "w") {
            $("#mb_img").val("");
            $("#mb_img").replaceWith($("#mb_img").clone(true));
        }

        $("#mb_img_prev").html("");
        delete filesTempArr[0]; // 파일 여러개 업로드 시 0 수정 필요
        $('#mb_img').attr('style', 'display:block;');
    }
}

function fmember_submit(f) {
    return true;
}

function form_ajax() {
    // 아이디 중복 체크
    if($('#mb_id').parents(".row").find(".status_ico").hasClass("err")) {
        alert('아이디를 확인하세요.');
        $('#mb_id').focus();
        return false;
    }

    if($.trim($('#mb_id').val()) == '') {
        alert('아이디를 입력하세요.');
        return false;
    }
    if('<?=$w?>' == '') {
        if($.trim($('#mb_password').val()) == '') {
            alert('비밀번호를 입력하세요.');
            return false;
        }
    }
    if($('#mb_name').val() == '') {
        alert('이름을 입력하세요.');
        return false;
    }
    if($('#mb_hp').val() == '') {
        alert('휴대폰번호를 입력하세요.');
        return false;
    }
    // 이용약관 동의 확인
    if('<?=$w?>' == '') {
        var agree = $('input:checkbox[name=agree_chk]:checked').val();
        if(agree != 'Y') {
            alert('이용약관 및 회원 준수사항에 동의해주세요.');
            return false;
        }
    }

    // 회원 사진 삭제 체크
    $('input[name=del_mb_img]').val(del_file_idx.slice(0,-1));

    var form = $('form')[0];
    var formData = new FormData(form);

    for (var i = 0; i < filesTempArr.length; i++) {
        formData.append("file[]", filesTempArr[i]);
    }

    formData.append('extra_pay_del_idx', extra_pay_del_idx.slice(0,-1)); // 수당 설정 삭제 정보

    $.ajax({
        url : g5_admin_url + "/pro_form_update.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success : function(data) {
            if(data){
                alert('저장되었습니다.');
                // location.replace(g5_admin_url+'/pro_form.php?sst=&sod=&sfl=&stx=&page=0&w=u&mb_no='+data);
                location.replace(g5_admin_url+'/pro_list.php');
            }
        },
    });
}

// 생년월일 선택
function selectDate(data) {
    var toDay = new Date();
    var year  = toDay.getFullYear();
    var month = (toDay.getMonth()+1);
    var day   = toDay.getDate();

    // 년도 설정
    var select_year = "<option value=''>선택</option>";
    for (var i=year; i>=1900; i--) {
        select_year += "<option value='" + i + "' >" + i + "</option>";
    }
    $('#birth_year').html(select_year);

    // 월,일 설정
    var select_month = "<option value=''>선택</option>";
    var select_day = "<option value=''>선택</option>";
    for (var i=1; i<=31; i++) {
        var val = "";
        if (i < 10) {
            val = "0" + new String(i);
        } else {
            val = new String(i);
        }

        if (i < 13) {
            select_month += "<option value='" + val + "'>" + val + "</option>";
        }

        select_day += "<option value='" + val + "'>" + val + "</option>";
    }
    $('#birth_month').html(select_month);
    $('#birth_day').html(select_day);

    // 금일 세팅
    /*$("#birth_year").val(year);
    $("#birth_month").val(month);
    $("#birth_day").val(day);*/

    if(data != '') {
        var birth = data.split('.');
        $("#birth_year").val(birth[0]);
        $("#birth_month").val(birth[1]);
        $("#birth_day").val(birth[2]);
    }
}

//휴대전화 '-'자동생성
function inputPhoneNumber(obj) {
    var number = obj.value.replace(/[^0-9]/g, "");
    var phone = "";

    if(number.length < 4) {
        return number;
    } else if(number.length < 8) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3);
    } else if(number.length < 12) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 4);
        phone += "-";
        phone += number.substr(7);
    } else {
        phone += number.substr(0, 4);
        phone += "-";
        phone += number.substr(4, 4);
        phone += "-";
        phone += number.substr(8);
    }
    obj.value = phone;
}

// 수당 설정 추가
function addRows() {
    var copy = $("#extra_pay_copy > .rows");
    var paste = $("#extra_pay_wrap");
    paste.append(copy.clone());
}

// 수당 설정 삭제
var extra_pay_del_idx = '';
function deleteRows(el, idx) {
    var row = $(el).parents('.rows');

    if (confirm('수당 설정을 삭제하시겠습니까?')) {
        extra_pay_del_idx += idx + ',';
    } else {
        return false;
    }

    row.remove();
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
