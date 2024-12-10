<?php
exit;
/*
$tab = ($_GET['tab'])? $_GET['tab'] : "1";
$sub_menu = ($tab == "1")? "200100" : "200200";	// 1:고객관리, 2:기사관리
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '') {
    $required_mb_password = 'required';
    $html_title = '등록';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = ($tab == "1")? 2 : 3; //$config['cf_register_level'];

} else if ($w == 'u') {
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    // 본인대리점 회원인지 확인
    if ($member['mb_level'] != "10" && $mb['agency_no'] != $member['mb_no'])
        alert('잘못된 접근입니다.');

    $required_mb_password = '';
    $html_title = '수정';

    $mb['mb_name'] = get_text($mb['mb_name']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);


} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

// 회원구분 arr
if ($tab == "2")
    $level_list = $driver_list;
else
    $level_list = array("2"=>"고객");

// 대리점리스트
$agency_no = ($member['mb_level'] == "10")? "" : $member['mb_no'];
$agency = getAgencyList($agency_no);
$agency_title = "";
if ($w == "u") {
    foreach ($agency['list'] as $key=>$val) {
        if ($val['mb_no'] == $mb['agency_no']) $agency_title = $val['mb_nick'];
    }
    // 승인안된 대리점명 조회
    if ($agency_title == "") {
        $rs = sql_fetch("SELECT mb_nick FROM g5_member WHERE mb_no = '{$mb['agency_no']}'");
        $agency_title = $rs['mb_nick'];
    }
}

if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= ($tab == "1")? '고객' : '기사';
$g5['title'] .= '정보 '.$html_title;
include_once('./admin.head.php');

// echo point_calc($mb['mb_id']);

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

?>
<style>
    #bank_img img {max-height: 70px; padding-top: 5px;}
    h2.sub_title {margin: 20px 0 10px; padding: 0; color: #ff3061;}
    .at_tab {display: none;}
    .at_tab p {padding: 10px 0 0;}
</style>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="mode" value="member">
    <input type="hidden" name="tab" value="<?=$tab?>">

    <!-- 로그인용 아이디 (자동생성) -->
    <input type="hidden" name="mb_id" value="<?=$mb['mb_id']?>">


    <div class="tbl_frm01 tbl_wrap">
        <h2 class="sub_title">| 기본정보</h2>
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row">승인여부</th>
                <td>
                    <?
                    // 승인여부 (탈퇴승인은 최고관리자만 가능)
                    $auth_list = $user_auth_list;

                    if ($tab == "1") {	// 고객
                        unset($auth_list["3"]);
                        unset($auth_list["4"]);
                    } else  {	// 기사
                        if ($member['mb_level'] != "10") unset($auth_list["4"]);
                    }
                    ?>
                    <select name="mb_user_auth" required>
                        <? foreach ($auth_list as $key=>$val) { ?>
                            <option value="<?=$key?>" <? if ($w == "u" && $mb['mb_user_auth'] == $key) echo "selected"; ?>><?=$val?></option>
                        <? } ?>
                    </select>
                </td>
                <th scope="row">대리점</th>
                <td>
                    <? if ($w == "") { ?>
                        <select name="agency_no" required>
                            <? if ($agency['cnt'] == 0) { ?>
                                <option value="">등록(승인)된 대리점이 없습니다.</option>
                            <? } else { ?>
                                <?	foreach ($agency['list'] as $key=>$val) { ?>
                                    <option value="<?=$val['mb_no']?>" <? if ($w == "u" && $mb['agency_no'] == $val['mb_no']) echo "selected"; ?>><?=$val['mb_nick']?></option>
                                <? 	}
                            } // end if
                            ?>
                        </select>

                    <? } else { ?>
                        <input type="hidden" name="agency_no" value="<?=$mb['agency_no']?>">
                        <?=$agency_title?>
                    <? } ?>
                </td>
            </tr>
            <tr>
                <th scope="row">회원구분</th>
                <td>
                    <select name="mb_level" required>
                        <? foreach ($level_list as $lv=>$name) { ?>
                            <option value="<?=$lv?>" <? if ($w == "u" && $mb['mb_level'] == $lv) echo "selected"; ?>><?=$name?></option>
                        <? } ?>
                    </select>

                </td>
                <th scope="row"><label for="mb_name">이름</label></th>
                <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="30" minlength="2" maxlength="20"></td>
            </tr>

            <?if ($tab=="2") { ?>
                <tr>
                    <th scope="row">기사 콜유형</th>
                    <td colspan="3">
                        <select name="driv_type">
                            <option value="" <?if($mb['driv_type']=="" || empty($mb)) echo "selected";?>>선택하세요</option>
                            <?foreach ($driver_call_type AS $key=>$val) { ?>
                                <option value="<?=$key?>" <?if($mb['driv_type']==(String)$key) echo "selected";?>><?=$val?></option>
                            <?}?>
                        </select>
                    </td>
                </tr>
            <?}?>

            <tr>
                <th scope="row"><label for="mb_password">비밀번호</label></th>
                <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="30" maxlength="20"></td>
                <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
                <td>
                    <? if ($w == "") { ?>
                        <input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input required f_num" size="30" maxlength="12" required>
                    <? } else { ?>
                        <input type="hidden" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>"><?php echo $mb['mb_hp'] ?>
                    <? } ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_recommend">추천인</label></th>
                <td><input type="text" name="mb_recommend" value="<?php echo $mb['mb_recommend'] ?>" id="mb_recommend" class="frm_input" size="30" maxlength="30"></td>
                <th scope="row"><label for="mb_point">포인트</label></th>
                <td><?=number_format($mb['mb_point'])?>점</td>
            </tr>

            <tr>
                <th scope="row"><label for="mb_memo">관리자 메모</label></th>
                <td colspan="3"><textarea name="mb_memo" id="mb_memo"><?php echo $mb['mb_memo'] ?></textarea></td>
            </tr>


            <?php if ($w == 'u') { ?>
                <tr>
                    <th scope="row">회원가입일</th>
                    <td><?php echo $mb['mb_datetime'] ?></td>
                    <th scope="row">최근접속일</th>
                    <td><?php echo (substr($mb['mb_today_login'], 0, 4) == "0000")? "-" : $mb['mb_today_login']; ?></td>
                </tr>
                <!--<tr>
        <th scope="row">IP</th>
        <td colspan="3"><?php echo $mb['mb_ip'] ?></td>
    </tr>-->
                <tr>
                    <th scope="row">접근차단일</th>
                    <td colspan="3">
                        <input type="text" name="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>" id="mb_intercept_date" class="frm_input" maxlength="8">
                        <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
                        <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>
                        <div style="margin: 10px 0 0; color: #999;">※ 접근차단일을 지정하시면 로그인이 불가능합니다.</div>
                    </td>
                    <!--
        <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>
        <td>
            <input type="text" name="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>" id="mb_leave_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
            <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
        </td>
		-->
                </tr>
            <?php } ?>

            </tbody>
        </table>

        <? if ($tab == "2") { ?>
            <h2 class="sub_title">| 기사계약서</h2>
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col width="15%">
                    <col width="35%">
                    <col width="15%">
                    <col width="35%">
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="mb_3">(을)성명</label></th>
                    <td><input type="text" name="mb_3" value="<?php echo $mb['mb_3'] ?>" id="mb_3" class="frm_input" size="30" maxlength="20"></td>
                    <th scope="row"><label for="mb_4">주민번호</label></th>
                    <td><input type="text" name="mb_4" value="<?php echo $mb['mb_4'] ?>" id="mb_4" class="frm_input" size="30" maxlength="6" minlength="6"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="">계약서 사인</label></th>
                    <td>
                        <?
                        $sign_chk = false;
                        if ($w == "u" && $mb['mb_5'] != "") {
                            $img_path = G5_SIGN_PATH."/".$mb['mb_5'];
                            if (file_exists($img_path)) {
                                $img_url = G5_SIGN_URL."/".$mb['mb_5'];
                                $sign_chk = true;
                                ?>
                                <!--<a target="_blank" href="<?=$img_url?>"><img src="<?=$img_url?>" style="max-height: 80px; width: auto; border: 1px solid #EEE;"></a>-->
                                <img src="<?=$img_url?>" style="max-height: 80px; width: auto; border: 1px solid #EEE;">
                                <?
                            }
                        }
                        if (!$sign_chk) echo "계약서사인 없음";
                        ?>
                    </td>
                    <th scope="row"><label for="">이름 서명<br />
                            (이름 표기 3글자) </label></th>
                    <td>
                        <?
                        $nm_sign_chk = false;
                        if ($w == "u" && $mb['mb_12'] != "") {
                            $img_path = G5_SIGN_PATH."/".$mb['mb_12'];
                            if (file_exists($img_path)) {
                                $img_url = G5_SIGN_URL."/".$mb['mb_12'];
                                $nm_sign_chk = true;
                                ?>
                                <!--<a target="_blank" href="<?=$img_url?>"><img src="<?=$img_url?>" style="max-height: 80px; width: auto; border: 1px solid #EEE;"></a>-->
                                <img src="<?=$img_url?>" style="max-height: 80px; width: auto; border: 1px solid #EEE;">
                                <?
                            }
                        }
                        if (!$nm_sign_chk) echo "이름서명 없음";
                        ?>
                    </td>
                </tr>

                </tbody>
            </table>
        <? } // $tab == 2 ?>

        <h2 class="sub_title">| 은행정보</h2>
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
            <? if ($member['mb_level'] == "10") { // 최고관리자만 수정가능 ?>
                <tr>
                    <th scope="row"><label for="mb_6">은행</label></th>
                    <td>
                        <select name="mb_6" id="mb_6" class="frm_input">
                            <option value="">은행선택</option>
                            <? foreach ($bank_list as $key=>$val) { ?>
                                <option value="<?=$key?>" <? if ($mb['mb_6'] == $key) echo "selected"; ?>><?=$val?></option>
                            <? } ?>
                        </select>
                    </td>
                    <th scope="row"><label for="mb_7">계좌번호</label></th>
                    <td><input type="text" name="mb_7" value="<?php echo $mb['mb_7'] ?>" id="mb_7" class="frm_input f_num" size="30" maxlength="30"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_8">예금주</label></th>
                    <td><input type="text" name="mb_8" value="<?php echo $mb['mb_8'] ?>" id="mb_8" class="frm_input" size="30" maxlength="20"></td>
                    <th scope="row"><label for="mb_10">생년월일(6자리) <br>또는 사업자번호(10자리)</label></th>
                    <td><input type="text" name="mb_10" value="<?php echo $mb['mb_10'] ?>" id="mb_10" class="frm_input" size="30" maxlength="20"></td>
                <tr>
                </tr>
                <th scope="row"><label for="mb_9">면허증사본</label></th>
                <td colspan="3">
                    <input type="hidden" name="mb_9" id="mb_9" value="<?=$mb['mb_9']?>">
                    <input type="file" name="upload_mb_9" id="upload_mb_9" class="frm_input" accept="image/*" onchange="uploadImg(this)" />
                    <?
                    $img_url = "";
                    if ($w == "u" && $mb['mb_9'] != "") {
                        $img_path = G5_DATA_PATH."/bank/".$mb['mb_9'];
                        if (file_exists($img_path)) $img_url = G5_DATA_URL."/bank/".$mb['mb_9'];
                    }
                    ?>
                    <div id="bank_img" class="img1">
                        <a target="_blank" href="<?=$img_url?>">
                            <? if ($img_url != "") { ?><img src="<?=$img_url?>"><? } ?>
                        </a>
                    </div>
                </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_user_acc">출금승인</label></th>
                    <td>
                        <? if ($member['mb_level'] == "10") { ?>
                            <select name="mb_user_acc" id="mb_user_acc" class="frm_input">
                                <option value="N" <? if ($mb['mb_user_acc'] != "Y" || $w == "") echo "selected"; ?>><?=$driver_acc_list['N']?></option>
                                <option value="Y" <? if ($mb['mb_user_acc'] == "Y") echo "selected"; ?>><?=$driver_acc_list['Y']?></option>
                            </select>

                            <?
                        } else {
                            $acc_value = ($mb['mb_user_acc'] != "")? $mb['mb_user_acc'] : "N";
                            ?>
                            <input type="hidden" name="mb_user_acc" value="<?=$acc_value?>"><?=$driver_acc_list[$acc_value]?>
                        <? } ?>
                    </td>
                    <th scope="row"><label>계좌실명조회 정보</label></th>
                    <td>
                        <?
                        if ($w == "u") {
                            //$rs = sql_fetch("SELECT * FROM g5_pg_namechk WHERE bankCode = '{$mb['mb_6']}' AND acntNo = '{$mb['mb_7']}' AND resultCode = '0000' ORDER BY idx DESC LIMIT 0, 1");
                            $rs = sql_fetch("SELECT * FROM g5_pg_namechk WHERE tid = '{$mb['mb_namechk_tid']}'");
                            echo ($rs['regdate'] != "")? $rs['regdate'] : "없음";

                        } else {
                            echo "없음";
                        }
                        ?>
                    </td>
                </tr>

            <? } else { // 대리점이면 정보만 노출 ?>
                <tr>
                    <th scope="row"><label for="mb_6">은행</label></th>
                    <td><? echo (array_key_exists($mb['mb_6'], $bank_list))? $bank_list[$mb['mb_6']] : "-"; ?></td>
                    <th scope="row"><label for="mb_7">계좌번호</label></th>
                    <td><? echo ($mb['mb_7'] != "")? $mb['mb_7'] : "-"; ?></td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_8">예금주</label></th>
                    <td><? echo ($mb['mb_8'] != "")? $mb['mb_8'] : "-"; ?></td>
                    <th scope="row"><label for="mb_9">면허증사본</label></th>
                    <td>
                        <?
                        $img_url = "";
                        if ($w == "u" && $mb['mb_9'] != "") {
                            $img_path = G5_DATA_PATH."/bank/".$mb['mb_9'];
                            if (file_exists($img_path)) $img_url = G5_DATA_URL."/bank/".$mb['mb_9'];
                        }
                        ?>
                        <div id="bank_img" class="img1">
                            <a target="_blank" href="<?=$img_url?>">
                                <? if ($img_url != "") { ?><img src="<?=$img_url?>"><? } ?>
                            </a>
                        </div>
                        <? if ($img_url == "") echo "-"; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_user_acc">출금승인</label></th>
                    <td colspan="3">
                        <?
                        $acc_value = ($mb['mb_user_acc'] != "")? $mb['mb_user_acc'] : "N";
                        echo $driver_acc_list[$acc_value];
                        ?>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>


        <?php if ($member['mb_level'] == "10") { // 최고관리자만 수정가능 ?>
            <h2 class="sub_title">| 포인트 자동차감 설정</h2>
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col width="15%">
                    <col width="35%">
                    <col width="15%">
                    <col width="35%">
                </colgroup>
                <tbody>
                <tr>
                    <th>차감방식</th>
                    <td>
                        <?
                        foreach (AT_POINT_TYPE AS $key=>$val) {
                            if ($mb['mb_level'] == "2" && $key == "1") continue; // 고객은 월차감만 노출
                            $id = "wtp{$key}";
                            $checked = ((int)$mb['at_point_type'] == $key)? "checked" : "";
                            ?>
                            <input type="radio" name="at_point_type" value="<?=$key?>" id="<?=$id?>" <?=$checked?>>
                            <label for="<?=$id?>"><?=$val?></label>
                            &nbsp;&nbsp;
                        <?}?>
                    </td>
                    <th>차감금액</th>
                    <td>
                        <?
                        $at_point = ((int)$mb['at_point'] > 0 && (int)$mb['at_point_type'] > 0)? number_format($mb['at_point']) : "";
                        ?>
                        <input type="text" name="at_point" class="frm_input f_amt" value="<?=$at_point?>"> 원
                    </td>
                </tr>
                <tr>
                    <th>차감기간</th>
                    <td colspan="3">
                        <div id="at_area0" class="at_tab">차감방식이 선택되지 않았습니다.</div>
                        <div id="at_area1" class="at_tab">
                            <input type="text" name="at_point_sdate" class="frm_input f_date" value="<?=$mb['at_point_sdate']?>" placeholder="시작일"> ~
                            <input type="text" name="at_point_edate" class="frm_input f_date" value="<?=$mb['at_point_edate']?>" placeholder="종료일">
                            <p>
                                ※ 종료일을 입력하지 않으면 기한없이 매일 차감됩니다.<br>
                                ※ 시작일 다음날부터 매일 0시에 포인트가 출금됩니다. (예. 시작일을 '2022-03-01'로 선택시 2022-03-02 0시에 첫 출금)
                            </p>
                        </div>
                        <div id="at_area2" class="at_tab">
                            <input type="hidden" name="at_point_mdate" value="<?=$mb['at_point_mdate']?>">
                            매월 1일
                            <p>
                                ※ 매월 1일 0시에 포인트가 출금됩니다. (예. 3월에 월 차감 등록시 4월 1일 0시에 첫 출금)
                            </p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        <?php } ?>

    </div>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="확인" class="btn_submit" accesskey='s'>
        <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
    </div>
</form>


<!-- 포인트 -->
<div id="point_list"><!-- /adm/ajax.point_list.php --></div>
<!-- //포인트 -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
    var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        day_arr = ['일', '월', '화', '수', '목', '금', '토'];

    $(function() {
        if (document.fmember.w.value == "u") {
            getPointList(1);
        }

        // 차감방식 뷰
        let wtp = $("[name=at_point_type]:checked").val();
        $("#at_area" + wtp).css('display', 'block');


        // 차감방식 선택시 차감기간 탭 노출
        $("[name=at_point_type]").on("change", function() {
            let type = $(this).val();
            $(".at_tab").css('display', 'none');
            $("#at_area" + type).css('display', 'block');
        });

        // 날짜선택
        $(".f_date").datepicker({
            changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, showMonthAfterYear : true,
            monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr, currentText: '오늘', closeText: '닫기'
        });

    });

    // 포인트내역
    function getPointList(page) {
        $.ajax({
            type : "post",
            url : "./ajax.point_list.php",
            data : {"mb_id" : document.fmember.mb_id.value, "page" : page},
            dataType : "html",
            success : function(data) {
                $("#point_list").html(data);
            },
            error : function(xhr,status,error) {
                alert("포인트 내역을 불러오는데 실패하였습니다. 다시 시도해 주세요.");
            }
        });
    }

    // 포인트충전/차감 폼오픈
    function pointFrm() {
        var area = $("#frm_area"),
            f = document.pFrm;

        f.po_content.value = "";
        f.po_point.value = "";

        if (area.css("display") == "none") {
            area.css("display", "inline-block");
        } else {
            area.css("display", "none");
        }
    }

    // 포인트충전/차감 처리
    function pointSubmit(f) {
        $.ajax({
            type : "post",
            url : "./ajax.point_update.php",
            data : {"mb_id" : f.mb_id.value, "po_type" : f.po_type.value, "po_content" : f.po_content.value, "po_point" : f.po_point.value},
            dataType : "text",
            success : function(data) {
                console.log(data);
                getPointList(1);
            },
            error : function(xhr,status,error) {
                alert("포인트 처리에 실패하였습니다. 다시 시도해 주세요.");
                location.reload();
            }
        });

        return false;
    }


    function fmember_submit(f) {
        if ($("select[name=agency_no] option:selected").val() == "") {
            alert("대리점을 선택하세요.");
            f.agency_no.focus();
            return false;
        }

        if ($("select[name=mb_level] option:selected").val() == "") {
            alert("회원구분을 선택하세요.");
            f.agency_no.focus();
            return false;
        }

        if (f.mb_name.value == "") {
            alert("이름을 입력하세요.");
            f.mb_name.focus();
            return false;
        }

        if (f.w.value == "" && f.mb_password.value == "") {
            alert("비밀번호를 입력하세요.");
            f.mb_password.focus();
            return false;
        }

        if (f.mb_hp.value.length > 11 || f.mb_hp.value.length < 10) {
            alert("휴대폰번호를 10~11자 사이로 입력하세요.");
            f.mb_hp.focus();
            return false;
        }

        if (f.w.value == "") {
            // 회원 로그인용 아이디 생성
            $.ajax({
                type : "post",
                url : g5_bbs_url + "/ajax.mb_login_id.php",
                data : {"agency_no" : $("select[name=agency_no] option:selected").val(), "mb_hp" : f.mb_hp.value},
                dataType : "json",
                async : false,
                success : function(data) {
                    if (data.result == true) {
                        f.mb_id.value = data.login_id;

                    } else {
                        var msg = (data.msg != '')? data.msg : "회원등록에 실패하였습니다. 다시 시도해 주세요.";
                        alert(msg);
                        return false;
                    }
                },
                error : function(xhr,status,error) {
                    alert("회원등록에 실패하였습니다. 다시 시도해 주세요.");
                    return false;
                },
            });

            if (f.mb_id.value.length == 0) {
                alert("회원등록에 실패하였습니다. 다시 시도해 주세요.");
                return false;
            }
        }


        <?php if ($member['mb_level'] == "10") { ?>

        if ($("#mb_user_acc").val() == "Y") {
            if (f.mb_6.value == "") { // || f.mb_7.value == "" || f.mb_8.value == "") {
                alert("출금 승인완료를 선택하셨습니다. 은행명을 선택해 주세요.");
                f.mb_6.focus();
                return false;
            }

            if (f.mb_7.value == "") {
                alert("출금 승인완료를 선택하셨습니다. 계좌번호를 입력해 주세요.");
                f.mb_7.focus();
                return false;
            }

            if (f.mb_8.value == "") {
                alert("출금 승인완료를 선택하셨습니다. 예금주를 입력해 주세요.");
                f.mb_8.focus();
                return false;
            }
        }

        // 포인트 자동차감 설정체크
        if (!!document.querySelector("[name=at_point_type]")) {
            var type_chk = document.querySelector("[name=at_point_type]:checked").value;
            console.log(type_chk != "0");

            switch (type_chk) {
                case "1" : // 일차감
                    var sdate = f.at_point_sdate.value;
                    if (sdate == "") {
                        alert("차감기간 시작일을 선택하세요.");
                        return false;
                    }
                    break;

                case "2" : // 월차감
                    break;

                case "0" : // 없음
                    if (f.at_point.value == "0") {
                        // pass
                    } else if (f.at_point.value != "") {
                        alert("차감금액을 입력하셨습니다. 차감방식을 선택해 주세요.\n차감방식이 없는 경우 차감금액을 삭제해 주세요.");
                        return false;
                    }
                    break;
            }

            if (type_chk != "0" && f.at_point.value == "") {
                alert('차감금액을 입력하세요.');
                f.at_point.focus();
                return false;
            }
        }

        <?php } // end $member['mb_level']==10 ?>

        return true;
    }

    // 면허증사본첨부
    function uploadImg(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;

        if (!reg_ext.test(input.files[0].name)) {
            getNoti(1, "이미지만 등록이 가능합니다. (jpg, jpeg, png)");
            $("#upload_mb_9").val("");
            return false;
        }

        // 최대용량 체크
        var	max_size_mb = 5, //5mb
            max_byte = max_size_mb * 1024 * 1024,
            file_byte = input.files[0].size;

        if (file_byte > max_byte) {
            getNoti(1, "최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
            $("#upload_mb_9").val("");
            return false;
        }

        // 업로드 진행
        var frm = $("#fmember")[0];
        var frm_data = new FormData(frm);

        $.ajax({
            type : "POST",
            url : g5_bbs_url + "/ajax.driver_form_img.php",
            data : frm_data,
            processData : false,
            contentType : false,
            async : false,
            //beforeSend: function() {
            //	$('#page_loader').show();
            //},
            success : function(json) {
                var data = JSON.parse(json);
                var img_area = $("#bank_img.img1");

                if (data.result == "T") {
                    $("#mb_9").val(data.file);
                    var _src = g5_url + "/data/bank/" + data.file;
                    var _img = $("<a href='"+ _src +"' target='_blank'><img src='"+ _src +"'></a>");
                    img_area.html(_img);

                } else {
                    alert("첨부에 실패하였습니다. 다시 시도해 주세요.");
                }
            },
            error : function(xhr,status,error) {
                //console.log(error);
                alert("첨부에 실패하였습니다. 다시 시도해 주세요.");
            }
        });
    }


</script>

<?php
include_once('./admin.tail.php');
?>
