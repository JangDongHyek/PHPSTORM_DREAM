<?php
$sub_menu = "250100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$g5['title'] .= '재작업관리';
include_once('./admin.head.php');

$sql = "select *,rw.wr_datetime wr_datetime from new_re_car_wash rw left join new_car_wash cw on rw.rw_idx = cw.rw_idx where rw.rw_idx = '{$_REQUEST["idx"]}' ";
$view = sql_fetch($sql);

$sql = "select * from {$g5['board_file_table']} where wr_id = '{$_REQUEST['idx']}' and bo_table = 're_car_wash' ";
$result = sql_query($sql);
$cnt = sql_num_rows($result);

$manage_member = get_member($view["ma_id"]);

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>



<form name="fmember" id="fmember" action="<?= G5_ADMIN_URL ?>/adm.controller.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="mode" value="re_service_form">
<input type="hidden" name="rw_idx" value="<?php echo $view['rw_idx'] ?>">

<div class="tbl_frm01 tbl_wrap">
    <h2>서비스정보 <span style="font-size: 10pt; font-weight: normal">* 서비스 정보는 서비스관리 메뉴에서 수정가능합니다.</span><a href="<?=G5_ADMIN_URL."/adm_service_form.php?idx=".$view['cw_idx']."&w=u"?>"> 자세히보기</a></h2>
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
        <th scope="row"><label for="car_date_type">상품명<?php echo $sound_only ?></label></th>
        <td style=" width :40%">
            <select name="car_date_type" id="car_date_type" class="service">

                <?php for($i = 1; $i <= count($cdt_list); $i++){
                    echo "<option value='".$i."'>".$cdt_list[$i]."</option>";
                } ?>

            </select>
			<? /*
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
			*/ ?>
        </td>
        <th scope="row"><label for="car_type">차사이즈</label></th>
        <td>
            <select name="car_size" id="car_size" class="service">

                <?php for($i = 1; $i <= count($cs_list); $i++){
                    echo "<option value='".$i."'>".$cs_list[$i]."</option>";
                } ?>

            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="up_address">차량정보</label></th>
        <td>
            <input type="text" name="car_no" value="<?php echo $view['car_no'] ?>" id="car_no"  class=" frm_input service" size="15" placeholder="차번호">
            <input type="text" name="car_type" value="<?php echo $view['car_type'] ?>" id="car_type"  class=" frm_input service" size="20" placeholder="차종">
            <input type="text" name="car_color" value="<?php echo $view['car_color'] ?>" id="car_color"  class=" frm_input service" size="15" placeholder="차색상">
        </td>
        <th scope="row"><label for="car_in_yn">내부세차</label></th>
        <td>
            <select name="car_in_yn" id="car_in_yn" class="service">
                <option value="Y">포함</option>
                <option value="N">포함안함</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_name">고객정보</label></th>
        <td>
            <input type="text" name="mb_name" value="<?php echo $view['mb_name'] ?>" id="mb_name"  class=" frm_input service"  placeholder="고객명">
            <input type="text" name="mb_hp" value="<?php echo $view['mb_hp'] ?>" id="mb_hp"  class=" frm_input service" size="30" placeholder="핸드폰번호">
        </td>
        <th scope="row"><label for="car_addr1">세차장소</label></th>
        <td>
            <input type="text" name="car_w_addr1" value="<?php echo $view['car_w_addr1'] ?>" id="car_w_addr1"  class=" frm_input service" size="50">
            <input type="text" name="car_w_addr2" value="<?php echo $view['car_w_addr2'] ?>" id="car_w_addr2"  class=" frm_input service" size="20">
        </td>
    </tr>
    <tr>
        <td>
            <h2>재작업정보</h2>
        </td>
    </tr>
    <tr>

        <th scope="row"><label for="car_memo">관리자 지시사항</label></th>
        <td>
            <textarea name="rw_memo" id="car_memo"  class=" frm_input" size="55"><?php echo $view['rw_memo'] ?></textarea>
        </td>
        <th scope="row"><label for="car_memo">재작업사유</label></th>
        <td>
            <textarea name="rw_reason" id="car_memo"  class=" frm_input" size="55"><?php echo $view['rw_reason'] ?></textarea>
        </td>

    </tr>
    <tr>
        <th scope="row"><label for="car_w_date">재작업일정</label></th>
        <td>

            <input type="date" name="rw_date" value="<?php echo $view['rw_date'] ?>" id="rw_date"  class=" frm_input" >
            <input type="time" name="rw_date2" value="<?php echo $view['rw_date2'] ?>" id="rw_date2"  class=" frm_input" >

        </td>
        <th scope="row"><label for="pay">사진</label></th>
        <td>
            <?php
            if ($cnt == 0 ){
                echo '없음';
            }else{
                // 파일 출력
                if($cnt != 0) {
                    for ($b = 0; $file = sql_fetch_array($result); $b++) {
                        echo '<a href="'.G5_BBS_URL.'/view_image.php?bo_table=re_car_wash&fn='.$file['bf_file'].'" class = "view_image"><img style = "width:100px" src="'.G5_DATA_URL.'/file/re_car_wash/'.$file['bf_file'].'">';;
                    }
                }
            }
            ?>
        </td>
    </tr>


    <tr>
        <th scope="row"><label for="mb_name">진행상황</label></th>
        <td>
            <select name="rw_step" id="rw_step">

                <?php for($i = 0; $i < count($step_list); $i++){
                    echo "<option value='".$i."'>".$step_list[$i]."</option>";
                } ?>
                <? /*
    <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
    <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
    <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
    <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
    <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
    <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
    <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
	*/ ?>
            </select>
            <?php if ($view['rw_step'] == 2){ ?>
            <span><?= "완료일시: ".$view["complete_datetime"] ?></span>
            <?php } ?>
        </td>
        <th scope="row"><label for="mb_name">매니저 정보<br>(아이디/이름/전화번호)</label></th>
        <td>
            <span style="margin-right: 10px"><?= $view["ma_id"] ."/".$manage_member["mb_name"]."/".$manage_member["mb_hp"]?></span>
        </td>

    </tr>
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

    <tr>
        <th scope="row" "><label for="mb_nick">등록날짜</label></th>
        <td><?php echo $view['wr_datetime'] ?></td>
        <th scope="row" "><label for="mb_nick">고객 아이디</label></th>
        <td><?php echo $view['mb_id'] ?></td>
    </tr>

    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <?php if ($auth_arr["menu".substr($sub_menu, 0, 3)."_write"] == "Y" || $member['mb_level'] == 10){ ?>
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <?php } ?>
    <a href="./adm_re_service_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<script>

    $(document).ready(function() {
        $("[name='car_date_type']").val(<?= $view['car_date_type']?>);
        $("[name='car_size']").val(<?= $view['car_size']?>);
        $("[name='car_w_date']").val('<?= $view['car_w_date']?>');
        $("[name='rw_step']").val(<?= $view['rw_step']?>);
        $("[name='car_in_yn']").val('<?= $view['car_in_yn']?>');

        $("a.view_image").click(function() {
            window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=400,height=400,resizable=yes, scrollbars=1,status=no");
            return false;
        });

        $(".service").attr("disabled",true);
        $(".service").attr("readonly",true);
        $(".service").css("background",'#f1f1f1');



    });

    function fmember_submit(f)
    {

        return true;
    }



</script>

<?php
include_once('./admin.tail.php');
?>
