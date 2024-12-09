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

// 성인인증
$mb_adult_yes       =  $mb['mb_adult']      ? 'checked="checked"' : '';
$mb_adult_no        = !$mb['mb_adult']      ? 'checked="checked"' : '';

//if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
//else $g5['title'] .= "";

$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

?>

    <style>
        .el_hide {position: absolute !important; width: 0; height: 0; opacity: 0; z-index: -1; top: -999; display:none;}
        #btn_close {display: none;}
        #ideal_area span.char_box {margin-bottom: 5px; display: inline-block; width: 30%;}
        #ideal_area div.char_box {margin-bottom: 10px;}
    </style>

    <form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data" class="max1200" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="">
        <!-- 추가 -->
        <input type="hidden" name="mb_intercept_date" value="<?=$mb['mb_intercept_date']?>">

        <div class="tbl_frm01 tbl_wrap">
            <? if ($w == "u") { ?>
                <h2 style="padding:0;margin:15px 0; color: blue;">
                    ㄱ)<?=$mb['mb_sex']?> <?=$mb['mb_name']?> <?=$mb['mb_gu']?> <?=substr($mb['mb_birth'], 2, 2)?> <?=substr($mb['mb_height'], 1, 2)?>
                </h2>
            <? } ?>

            <div class="sub_title">기본정보</div>
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col width="20%">
                    <col width="30%">
                    <col width="20%">
                    <col width="30%">
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row">회원구분</th>
                    <td colspan="3">
                        <? if ($w == "u" && $mb['mb_level'] == '10') { ?>
                        <input type="hidden" name="mb_level" value="10">
                        <input type="hidden" name="mb_status" value="<?=$mb['mb_status']?>">
                            관리자
                        <? } else {
                        $change_evt = "";
                        if ($w == "u" && $member['mb_status'] != "관리자") {
                            $change_evt = "onclick='changeNoti(\"{$mb['mb_status']}\");'";
                        }
                        ?>
                        <input type="hidden" name="mb_level" value="2">
                        <input type="radio" name="mb_status" id="lv1" value="일반" <? if ($w == "" || $mb['mb_status'] == "일반") echo "checked"; ?> required <?=$change_evt?>>
                            <label for="lv1">일반회원</label>&nbsp;
                        <input type="radio" name="mb_status" id="lv2" value="블랙" <? if ($mb['mb_status'] == "블랙") echo "checked"; ?> <?=$change_evt?>>
                            <label for="lv2">블랙회원</label>
                        <input type="radio" name="mb_status" id="lv3" value="탈퇴" <? if ($mb['mb_status'] == "탈퇴") echo "checked"; ?> <?=$change_evt?>>
                            <label for="lv3">탈퇴회원</label>
                            <script>
                                function changeNoti(lv) {
                                    var stt = document.getElementsByName('mb_status'),
                                        flag = false;

                                    for (var i = 0; i < stt.length; i++) {
                                        if (stt[i].value == lv) {
                                            stt[i].checked = true;
                                            flag = true;
                                        }
                                    }
                                    alert("변경 권한이 없습니다.");

                                    if (!flag) {
                                        location.reload();
                                    }
                                    return false;
                                }
                            </script>
                        <? } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_id">아이디</label></th>
                    <td><input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="25" minlength="3" maxlength="20"></td>
                    <th scope="row"><label for="mb_password">비밀번호</label></th>
                    <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="25" maxlength="20"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_name">이름</label></th>
                    <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="25" minlength="2" maxlength="20"></td>
                    <th scope="row"><label for="mb_hp">연락처</label></th>
                    <td><input type="text" name="mb_hp" value="<?=$mb['mb_hp']?>" id="mb_hp" class="frm_input" size="25" maxlength="20"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_5">카카오 아이디</label></th>
                    <td><input type="text" name="mb_5" value="<?=$mb['mb_5']?>" id="mb_5" class="frm_input" size="25" maxlength="20"></td>
                </tr>

                <?php if ($w == 'u') { ?>
                    <tr>
                        <th scope="row">가입일자</th>
                        <td><?php echo $mb['mb_datetime'] ?></td>
                        <th scope="row">최근접속일자</th>
                        <td><? echo (substr($mb['mb_today_login'], 0, 4) == "0000")? "-" : $mb['mb_today_login']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


            <? if ($mb['mb_level'] < 10) { ?>
                <!-- 프로필 -->
                <br>
                <div class="sub_title">프로필</div>
                <table>
                    <colgroup>
                        <col width="20%">
                        <col width="30%">
                        <col width="20%">
                        <col width="30%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th scope="row">성별</th>
                        <td>
                            <input type="radio" name="mb_sex" id="sx1" value="남" <? if ($mb['mb_sex'] == "남") echo "checked"; ?> required><label for="sx1">남</label>
                            <input type="radio" name="mb_sex" id="sx2" value="여" <? if ($mb['mb_sex'] == "여") echo "checked"; ?>><label for="sx2">여</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="mb_birth">생년월일</label></th>
                        <td><input type="text" name="mb_birth" value="<?=$mb['mb_birth']?>" id="mb_birth" required class="required frm_input f_date" size="25" minlength="10" maxlength="10"></td>
                        <th scope="row"><label for="mb_si">거주지역</label></th>
                        <td>
                            <select name="mb_si" id="mb_si">
                                <option value="">시/도 전체</option>
                                <? foreach ($city_arr as $key=>$val) { ?>
                                    <option value="<?=$val?>" <? if ($mb['mb_si'] == $val) echo "selected"; ?>><?=$val?></option>
                                <? } ?>
                            </select>
                            <select name="mb_gu" id="mb_gu">
                                <option value="">구/군 전체</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="mb_height">키</label></th>
                        <td><input type="text" name="mb_height" id="mb_height" value="<? echo ($mb['mb_height'] == 0)? "" : $mb['mb_height']; ?>" size="25" class="frm_input f_num" maxlength="3"></td>
                        <th scope="row"><label for="mb_smoking">흡연</label></th>
                        <td>
                            <select name="mb_smoking" id="mb_smoking">
                                <option value="">--선택--</option>
                                <? foreach ($smoking_arr as $key=>$val) { ?>
                                <option value="<?=$val?>" <? if ($mb['mb_smoking'] == $val) echo "selected"; ?>><?=$val?></option>
                                <? } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="mb_job">직업</label></th>
                        <td>
                            <select name="mb_job" id="mb_job" onchange="getSelectedChk(this);">
                                <option value="">--선택--</option>
                                <?
                                // 직접입력체크변수
                                $mb_job_str = "";
                                $input_class = "hide";

                                foreach ($job_arr as $key=>$val) {
                                    if ($mb['mb_job'] != "" && !in_array($mb['mb_job'], $job_arr) && $val == "직접입력") {
                                        $mb_job_str = $mb['mb_job'];
                                        $input_class = "show";
                                    }
                                    ?>
                                    <option value="<?=$val?>" <? if (($mb['mb_job'] == $val || $mb['mb_job'] == $mb_job_str) && $mb['mb_job'] != "") echo "selected"; ?>><?=$val?></option>
                                <? } ?>
                            </select>
                            <input type="text" name="mb_job_str" class="frm_input <?=$input_class?>" value="<?=$mb_job_str?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="mb_char">성격</label></th>
                        <td colspan="3">
                            <?
                            unset($char_arr[count($char_arr)-1]); // 직접입력 삭제
                            $mb_char_arr = explode(",", $mb['mb_char']);

                            foreach ($char_arr as $key=>$val) {
                                ?>
                                <span class="char_box">
					<input type="checkbox" name="mb_char[]" id="ch<?=$key?>" value="<?=$val?>" <? if (in_array($val, $mb_char_arr)) echo "checked"; ?>>
					<label for="ch<?=$key?>"><?=$val?></label>
				</span>
                            <? } ?>
                            <div class="char_box">
                                <input type="checkbox" name="mb_char[]" id="chd" value="직접입력" <? if (in_array("직접입력", $mb_char_arr) && $mb['mb_char_str'] != "") echo "checked"; ?>>
                                <label for="chd">직접입력</label>
                                <input type="text" class="frm_input" name="mb_char_str" value="<?=$mb['mb_char_str']?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="mb_body_type">체형</label></th>
                        <td>
                            <select name="mb_body_type" id="mb_body_type" onchange="getSelectedChk(this);">
                                <option value="">--선택--</option>
                                <?
                                // 직접입력체크변수
                                $mb_body_type_str = "";
                                $input_class = "hide";

                                foreach ($body_arr as $key=>$val) {
                                    if ($mb['mb_body_type'] != "" && !in_array($mb['mb_body_type'], $body_arr) && $val == "직접입력") {
                                        $mb_body_type_str = $mb['mb_body_type'];
                                        $input_class = "show";
                                    }
                                    ?>
                                    <option value="<?=$val?>" <? if (($mb['mb_body_type'] == $val || $mb['mb_body_type'] == $mb_body_type_str) && $mb['mb_body_type'] != "") echo "selected"; ?>><?=$val?></option>
                                <? } ?>
                            </select>
                            <input type="text" name="mb_body_type_str" class="frm_input <?=$input_class?>" value="<?=$mb_body_type_str?>">
                        </td>
                        <th scope="row"><label for="mb_hobby">취미</label></th>
                        <td>
                            <select name="mb_hobby" id="mb_hobby" onchange="getSelectedChk(this);">
                                <option value="">--선택--</option>
                                <?
                                // 직접입력체크변수
                                $mb_hobby_str = "";
                                $input_class = "hide";

                                foreach ($hobby_arr as $key=>$val) {
                                    if ($mb['mb_hobby'] != "" && !in_array($mb['mb_hobby'], $hobby_arr) && $val == "직접입력") {
                                        $mb_hobby_str = $mb['mb_hobby'];
                                        $input_class = "show";
                                    }
                                    ?>
                                    <option value="<?=$val?>" <? if (($mb['mb_hobby'] == $val || $mb['mb_hobby'] == $mb_hobby_str) && $mb['mb_hobby'] != "") echo "selected"; ?>><?=$val?></option>
                                <? } ?>
                            </select>
                            <input type="text" name="mb_hobby_str" class="frm_input <?=$input_class?>" value="<?=$mb_hobby_str?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="car01">자차</label></th>
                        <td>
                            <input type="radio" name="mb_car_yn" id="car01" <?if($mb['mb_car_yn']=="유") echo "checked"?> value="유"><label for="car01">유</label>
                            <input type="radio" name="mb_car_yn" id="car02" <?if($mb['mb_car_yn']=="무") echo "checked"?> value="무"><label for="car02">무</label>
                        </td>
                        <th scope="row"><label for="mb_drinking">음주</label></th>
                        <td>
                            <select name="mb_drinking" id="mb_drinking">
                                <option value="">--선택--</option>
                                <? foreach ($drinking_arr as $key=>$val) { ?>
                                <option value="<?=$val?>" <? if ($mb['mb_drinking']==$val) echo "selected"; ?>><?=$val?></option>
                                <? } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="mb_profile">내소개(어필)</label></th>
                        <td colspan="3"><textarea name="mb_profile" id="mb_profile"><?=$mb['mb_profile']?></textarea></td>
                    </tr>
                    <?
                    if ($w == "u") {
                        $mb_imgs = getMemberImg($mb['mb_id']);
                        $imgs_cnt = $mb_imgs['cnt'];
                        ?>
                        <tr>
                            <th scope="row"><label for="">사진</label></th>
                            <td colspan="3">
                                <!-- 이미지선택전 -->
                                <div style="padding: 5px 0;"><button type="button" class="btn_frmline" onclick="getImgUpload();">사진등록하기</button></div>
                                <!-- 이미지선택후 -->
                                <div id="img_after">
                                    <!-- 미리보기 -->
                                    <div id="prev_area">
                                        <?
                                        if ($imgs_cnt > 0) {
                                            foreach ($mb_imgs['list'] as $i=>$val) {
                                                ?>
                                                <div class="p_box" id="ubox<?=$i?>">
                                                    <div class="img_bd"><img class="p_img" src="<?=$val['src']?>"></div>
                                                    <button type="button" class="btn" onclick="getImgDel('u', '<?=$i?>')">X</button>
                                                </div>
                                                <input type="file" name="bf_file[]">
                                                <input type="hidden" id="bf_file_del<?=$i?>" name="bf_file_del[<?=$i?>]" value="">
                                                <input type="hidden" name="bf_idx[]" value="<?=$val['idx']?>">
                                                <input type="hidden" name="bf_old_img[]" value="<?=$val['mi_img']?>">
                                                <?
                                            }	//foreach
                                        } // end if
                                        ?>
                                    </div>
                                </div>
                                <?
                                /*
                                if ($imgs_cnt == 0) {
                                    echo "등록된 사진이 없습니다.";
                                } else {
                                    foreach ($mb_imgs['list'] as $key=>$val) {
                                        echo "<img src='{$val['src']}' style='width:300px; height:auto; display:block; margin-bottom:5px; border:1px solid #EEE;' alt='회원사진'>";
                                    }
                                }
                                */
                                ?>
                            </td>
                        </tr>
                    <? } // end if ?>
                    </tbody>
                </table>
                <!-- // 프로필 -->

                <!-- 이상형 -->
                <br>
                <div class="sub_title">이상형</div>
                <table>
                    <colgroup>
                        <col width="20%">
                        <col width="30%">
                        <col width="20%">
                        <col width="30%">
                    </colgroup>
                    <tbody>

                    <tr>
                        <th scope="row">이상형 성격</th>
                        <td colspan="3" id="ideal_area">
                            <?
                            unset($ideal_type_arr[count($ideal_type_arr)-1]); // 직접입력 삭제
                            $mb_ideal_type_arr = explode(",", $mb['mb_ideal_type']);

                            $input_class = "hide";
                            if (in_array("직접입력", $mb_ideal_type_arr) && $mb['mb_ideal_type_str'] != "") $input_class = "show";

                            foreach ($ideal_type_arr as $key=>$val) {
                                ?>
                                <span class="char_box">
					<input type="checkbox" name="mb_ideal_type[]" id="itp<?=$key?>" value="<?=$val?>" <? if (in_array($val, $mb_ideal_type_arr)) echo "checked"; ?> style="margin: 0;">
					<label for="itp<?=$key?>"><?=$val?></label>
				</span>

                            <? } ?>
                            <div class="char_box">
                                <input type="checkbox" name="mb_ideal_type[]" id="itp" value="직접입력" <? if (in_array("직접입력", $mb_ideal_type_arr) && $mb['mb_ideal_type_str'] != "") echo "checked"; ?>>
                                <label for="itp">직접입력</label>
                                <input type="text" class="frm_input <?=$input_class?>" name="mb_ideal_type_str" value="<?=$mb['mb_ideal_type_str']?>" size="100" placeholder="성격을 입력하세요">
                            </div>

                        </td>
                    </tr>

                    </tbody>
                </table>
                <!-- // 이상형 -->

                <br>
                <div class="sub_title">특이사항</div>
                <table>
                    <colgroup>
                        <col width="20%">
                        <col width="30%">
                        <col width="20%">
                        <col width="30%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th scope="row">특이사항</th>
                        <td colspan="3"><textarea name="mb_memo" style="height:200px;"><?=$mb['mb_memo']?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">프로필</th>
                        <td colspan="3"><textarea name="mb_adm_profile" style="height:200px;"><?=$mb['mb_adm_profile']?></textarea></td>
                    </tr>
                    </tbody>
                </table>
            <? } ?>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="submit" value="확인" class="btn_submit" accesskey='s'>
            <a href="./member_list.php<? if ($qstr != "") echo "?".$qstr; ?>" id="btn_list">목록</a>
            <a href="javascript:void(0)" onclick="getWinClose()" id="btn_close">닫기</a>
        </div>

    </form>


    <script>
        var paramGu = "<?=$mb['mb_gu']?>";
        var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            day_arr = ['일', '월', '화', '수', '목', '금', '토'];

        $(function() {
            // 시/도 bind
            $("#mb_si").on("change", fnGetCity);

            if (document.fmember.w.value == "u") {
                fnGetCity();
            }

            // 생년월일 달력
            $("#mb_birth").datepicker({
                changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, showMonthAfterYear : true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr
            });


            if (opener) {
                // console.log('팝업으로 열었을 경우');
                var hd = document.getElementById("hd"),
                    hd_wrap = document.getElementById("hd_wrap"),
                    lnb = document.getElementById("lnb"),
                    btn_close = document.getElementById("btn_close"),
                    btn_list = document.getElementById("btn_list");

                hd.classList.add("el_hide");
                hd_wrap.classList.add("el_hide");
                lnb.classList.add("el_hide");
                document.getElementById("logo").classList.add("el_hide");
                document.getElementById("gnb").classList.add("el_hide");

                btn_list.style.display = "none";
                btn_close.style.display = "inline-block";
            }

        });

        // 시/도 변경
        function fnGetCity() {
            var si = $("#mb_si").val();

            $("#mb_gu").find("option").remove();
            $("#mb_gu").append("<option value=''>구/군 전체</option>");

            if (!si) {
                return false;
            }

            $.ajax({
                type : "GET",
                url : "<?php echo G5_PLUGIN_URL?>/address/address.php",
                dataType : "json",
                data : {"si": si},
                success : function(datas){
                    var opt_select = "", opt = "";

                    for(var i = 0; i < datas.length; i++){
                        opt_select = (paramGu == datas[i])? "selected" : "";
                        opt = "<option value='" + datas[i] + "' " + opt_select + ">" + datas[i] + "</option>";

                        $("#mb_gu").append(opt);
                    }
                },
                error : function(request,status,error){
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                    window.location.reload();
                }
            });
        }

        // 직접입력 필드체크
        function getSelectedChk(el) {
            var input = el.nextSibling.nextSibling;

            if (el.value == "직접입력") {
                input.classList.remove("hide");
                input.classList.add("show");
                input.focus();
            } else {
                input.classList.remove("show");
                input.classList.add("hide");
                input.value = "";
            }
        }

        function fmember_submit(f) {
            return true;
        }

        // ****************************************************
        // 이미지업로드
        var file_num = 0;	// 업로드파일 순번

        // 이미지업로드 동적생성
        function getImgUpload() {
            var area = document.getElementById("img_after"),
                input = document.createElement('input'),
                leng = $("#prev_area .p_box").length;

            file_num = leng;

            if (leng > 4) { // 5장까지
                alert("최대 5장까지 등록 가능합니다.");
                return false;
            }

            input.setAttribute("type", "file");
            input.setAttribute("accept", "image/*");
            input.setAttribute("name", "bf_file[]");
            input.setAttribute("id", "f"+file_num);
            input.setAttribute("onchange", "getImgPrev(this)");

            area.appendChild(input);

            var elem = document.getElementsByName("bf_file[]"),
                eq = elem.length;

            elem[eq-1].click();
        }

        // 이미지업로드 미리보기
        function getImgPrev(input) {
            var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp)$/;

            if (!reg_ext.test(input.files[0].name)) {
                alert("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
                return false;
            }

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var area = document.getElementById("prev_area"),
                        div = document.createElement('div'),
                        div_img = document.createElement('div'),
                        img = document.createElement('img'),
                        btn = document.createElement('button');

                    div.setAttribute("class", "p_box");
                    div.setAttribute("id", "box"+file_num);

                    div_img.setAttribute("class", "img_bd");
                    img.setAttribute("class", "p_img");
                    img.setAttribute("src", e.target.result);

                    btn.setAttribute("type", "button");
                    btn.setAttribute("class", "btn");
                    btn.setAttribute("onclick", "getImgDel('w', "+ file_num +")");
                    btn.innerHTML = "X";

                    div_img.appendChild(img);
                    div.appendChild(div_img);
                    div.appendChild(btn);
                    area.appendChild(div);

                    file_num++;
                }
                reader.readAsDataURL(input.files[0]);
            }


        }

        // 이미지미리보기/업로드된 이미지 삭제
        function getImgDel(mode, idx) {
            if (mode == "w") {
                var input = document.getElementById("f"+idx),
                    prev = document.getElementById("box"+idx);

                input.parentNode.removeChild(input);
                prev.parentNode.removeChild(prev);

            } else if (mode == "u") {
                var input = document.getElementById("bf_file_del"+idx),
                    prev = document.getElementById("ubox"+idx);

                if (confirm("사진을 삭제하시겠습니까?") == true) {
                    input.value = 1;
                    prev.parentNode.removeChild(prev);
                } else {
                    return false;
                }
            }
        }

    </script>

<?php
include_once('./admin.tail.php');
?>