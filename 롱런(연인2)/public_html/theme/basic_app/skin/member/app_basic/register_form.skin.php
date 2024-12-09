<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css?ver=' . G5_CSS_VER . '">', 100);

include_once(G5_BBS_PATH.'/nice/register.php'); // 나이스모듈
?>
<style>
    body{height: 100vh; overflow-y:hidden; }
    #ft_menu {display: none;}
    #dynamic_files input[type=file] {position: absolute; left: -9999px;}
    #join_step .toolbar {z-index: 10;}
</style>

<div id="join_step" role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link" href="#step-1"><span>1</span><p>본인인증</p></a></li>
        <li class="nav-item"><a class="nav-link" href="#step-2"><span>2</span><p>약관동의</p></a></li>
        <li class="nav-item"><a class="nav-link" href="#step-3"><span>3</span><p>기본정보</p></a></li>
        <li class="nav-item"><a class="nav-link" href="#step-4"><span>4</span><p>프로필</p></a></li>
        <li class="nav-item"><a class="nav-link" href="#step-5"><span>5</span><p>이상형</p></a></li>
    </ul>
    <!-- Tab panes -->
    <form name="frm1" action="post" onsubmit="return false" autocomplete="off">
        <input type="hidden" name="w" value="<?=$w?>">
        <input type="hidden" name="mb_certify" value="<?=$member['mb_certify']?>">
        <input type="hidden" name="app_type" value="<?=$app_type?>">
        <input type="hidden" name="app_ver" value="<?=$inapp_vercode?>">
        <input type="hidden" value="<?=$token?>" name="reg_token">
        <div class="tab-content">
            <div id="step-1" class="tab-pane hide" role="tabpanel" aria-labelledby="step-1">
                <div class="certi">
                    <h3>
                        <p><i class="fa-light fa-lock-keyhole"></i></p>
                        <p>본인인증을 해주세요</p>
                        <span>안전한 서비스 이용을 위해<br>
                            최소 1회 본인인증이 필요합니다.
                        </span>
                    </h3>
                    <!--<input class="frm_input" placeholder="휴대폰 번호를 입력해주세요">-->
                </div>
            </div>
            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                <div id="join_agr">
                    <h3>
                        <p>아래 약관 확인후, 동의해주세요</p>
                    </h3>
                    <dl class="agree-row">
                        <dt data-for="reg_req1">
                            <input type="checkbox" name="reg_req[]" id="reg_req1" value="1">
                            <label for="reg_req1">서비스 이용약관 동의(필수)</label>
                            <input type="button" value="내용보기" class="btn-agr">
                        </dt>
                        <dd class="agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                    </dl>

                    <dl class="agree-row">
                        <dt data-for="reg_req2">
                            <input type="checkbox" name="reg_req[]" id="reg_req2" value="2">
                            <label for="reg_req2">개인정보처리방침 동의(필수)</label>
                            <input type="button" value="내용보기" class="btn-agr">
                        </dt>
                        <dd class="agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                    </dl>
                    <dl class="agree-row">
                        <dt data-for="reg_req3">
                            <input type="checkbox" name="reg_req[]" id="reg_req3" value="3">
                            <label for="reg_req3">롱런 소개팅 관련 정보 수신에 동의(필수)</label>
                            <input type="button" value="내용보기" class="btn-agr">
                        </dt>
                        <dd class="agr_textarea"><textarea readonly>
*롱런 소개팅 관련정보  수신에 동의

사람이 직접 해주는 소개팅으로 소개팅 연결 및 진행을 위해 소개팅 관련 정보 수신을 동의합니다.
심야시간 소개팅 관련 정보, 광고 수신 양해 동의 부탁드립니다.
근무시간 외 심야시간은 ON(출근) 상태인  카운슬러를 통해 소개팅, 상담이 가능합니다.
소개팅 관련 정보는 소개 중단 (소개 휴면기)및 회원 탈퇴 시 전달이 중단됩니다.
                            </textarea></dd>
                    </dl>
                </div><!--//join_chk-->
            </div>
            <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                <div class="join_info">
                    <div class="area">
                        <h2>가입경로</h2>
                        <div class="box_in">
                            <?
                            foreach (MEMBER_JOIN_PATH AS $key=>$val) {
                                $path_arr = ($is_member)? explode(",", $member['mb_join_path']) : [];
                                $checked = (in_array($key, $path_arr))? "checked" : "";
                                $radio_id = "join_path{$key}";
                            ?>
                            <input type="checkbox" name="mb_join_path[]" id="<?=$radio_id?>" <?=$checked?> value="<?=$key?>">
                            <label for="<?=$radio_id?>"><?=$val?></label>
                            <? } ?>
                        </div>
                    </div>
                    <div class="area">
                        <h2>기본회원정보</h2>
                        <div class="mbskin">
                            <article class="box-article">
                                <div class="box-body">
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_id">아이디</label>
                                            <input type="text" name="mb_id" value="<?=$member['mb_id']?>" id="reg_mb_id" placeholder="영문/숫자, 4자이상 입력" <?=$readonly?>>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_password">비밀번호</label>
                                            <input type="password" name="mb_password" id="reg_mb_password" minlength="4" maxlength="20" placeholder="4자이상 영문, 숫자입력">
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="mb_password_re">비밀번호확인</label>
                                            <input type="password" name="mb_password_re" id="reg_mb_password_re" minlength="4" maxlength="20" placeholder="비밀번호확인 입력">
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_name">이름</label>
                                            <input type="text" name="mb_name" value="<?=$member['mb_name']?>" id="reg_mb_name" placeholder="이름" readonly>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="mb_5">카카오 아이디</label>
                                            <input type="text" name="mb_5" value="<?=$member['mb_5']?>" id="mb_5" placeholder="카카오 아이디">
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label>성별</label>
                                            <input type="hidden" name="mb_sex" value="<?=$member['mb_sex']?>">
                                            <div class="box_in">
                                                <input type="radio" id="gender01" <?if($member['mb_sex']=="남") echo "checked"?> disabled><label for="gender01">남성</label>
                                                <input type="radio" id="gender02" <?if($member['mb_sex']=="여") echo "checked"?> disabled><label for="gender02">여성</label>
                                            </div>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_hp">휴대번호</label>
                                            <input type="text" name="mb_hp" value="<?=$member['mb_hp']?>" id="reg_mb_hp" placeholder="휴대번호" readonly>
                                        </dt>
                                        * 나이스평가정보에서 인증받은 휴대전화번호를 사용하고 있습니다.
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_birth">생년월일</label>
                                            <input type="text" name="mb_birth" value="<?=$member['mb_birth']?>" id="reg_mb_birth" placeholder="0000-00-00" readonly>
                                        </dt>
                                    </dl>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                <div class="join_info">
                    <div class="area">
                        <h2>프로필등록</h2>
                        <div class="mbskin">
                            <article class="box-article">
                                <div class="box-body">
                                    <dl>
                                        <dt>
                                            <label for="mb_si">거주지역</label>
                                            <div class="flex">
                                                <?/*
                                                <select name="mb_si" id="mb_si" onchange="fnGetCity()">
                                                    <option value="">시/도 전체</option>
                                                    <? foreach ($city_arr as $key=>$city) { ?>
                                                    <option value="<?=$city?>" <? if ($w=="u" && $member['mb_si']==$city) echo "selected"; ?>><?=$city?></option>
                                                    <? } ?>
                                                </select>
                                                -
                                                <select name="mb_gu" id="mb_gu">
                                                    <option>구/군 전체</option>
                                                </select>
                                                */?>
                                                <?
                                                $view_str = "선택하세요";
                                                if ($w=="u") $view_str = $member['mb_si']." ".$member['mb_gu'];
                                                ?>
                                                <a data-toggle="modal" data-target="#areaModal" id="mb_area_view"><?=$view_str?></a>
                                                <input type="hidden" name="old_mb_gu" value="<?=$member['mb_gu']?>">
                                            </div>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_height">키</label>
                                            <input type="number" name="mb_height" value="<?=$member['mb_height']?>" id="reg_mb_height" placeholder="cm" class="f_num2">
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_smoking">흡연여부</label>
                                            <?/*
                                            <select name="mb_smoking" id="reg_mb_smoking">
                                                <option value="">선택하세요</option>
                                                <? foreach ($smoking_arr as $key=>$val) { ?>
                                                <option value="<?=$val?>" <? if ($member['mb_smoking'] == $val) echo "selected"; ?>><?=$val?></option>
                                                <? } ?>
                                            </select>
                                            */?>
                                            <?
                                            $view_str = "선택하세요";
                                            if ($w=="u") $view_str = $member['mb_smoking'];
                                            ?>
                                            <a data-toggle="modal" data-target="#smokingModal" id="mb_smoking_view"><?=$view_str?></a>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_job">직업</label>
                                            <?/*
                                            <select name="mb_job" id="reg_mb_job" onchange="getSelectedChk(this);">
                                                <option value="">선택하세요</option>
                                                <?
                                                // 직접입력 체크변수
                                                $loop_array = $job_arr;
                                                $input_str = "";
                                                $input_cls = "hide";
                                                $compare_val = $member['mb_job'];

                                                foreach ($loop_array as $key=>$val) {
                                                    if ($compare_val != "" && !in_array($compare_val, $loop_array) && $val == "직접입력") {
                                                        $input_str = $compare_val;
                                                        $input_cls = "";
                                                    }
                                                    $selected = (($compare_val == $val || $compare_val == $input_str) && $compare_val != "")? "selected" : "";
                                                    ?>
                                                    <option value="<?=$val?>" <?=$selected?>><?=$val?></option>
                                                <? } ?>
                                            </select>
                                            <!-- 직접입력 선택시 -->
                                            <div class="input_area <?=$input_cls?>">
                                                <input type="text" name="mb_job_str" value="<?=$input_str?>" placeholder="직접입력">
                                            </div>
                                            */?>
                                            <?
                                            $view_str = "선택하세요";
                                            if ($w=="u") $view_str = $member['mb_job'];
                                            ?>
                                            <a data-toggle="modal" data-target="#jobModal" id="mb_job_view"><?=$view_str?></a>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="">성격</label>
                                            <?
                                            $char_str = "선택하세요";
                                            if ($w=="u") {
                                                $char_str = $member['mb_char'];
                                                if (strpos($member['mb_char'], "직접입력") !== false) {
                                                    $char_str = str_replace("직접입력", $member['mb_char_str'], $char_str);
                                                }
                                            }
                                            ?>
                                            <a data-toggle="modal" data-target="#charModal" id="mb_char_view"><?=$char_str?></a>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_body_type">체형</label>
                                            <?/*
                                            <select name="mb_body_type" id="reg_mb_body_type" onchange="getSelectedChk(this);">
                                                <option value="">선택하세요</option>
                                                <?
                                                // 직접입력 체크변수
                                                $loop_array = $body_arr;
                                                $input_str = "";
                                                $input_cls = "hide";
                                                $compare_val = $member['mb_body_type'];

                                                foreach ($loop_array as $key=>$val) {
                                                    if ($compare_val != "" && !in_array($compare_val, $loop_array) && $val == "직접입력") {
                                                        $input_str = $compare_val;
                                                        $input_cls = "";
                                                    }
                                                    $selected = (($compare_val == $val || $compare_val == $input_str) && $compare_val != "")? "selected" : "";
                                                ?>
                                                <option value="<?=$val?>" <?=$selected?>><?=$val?></option>
                                                <? } ?>
                                            </select>
                                            <!-- 직접입력 선택시 -->
                                            <div class="input_area <?=$input_cls?>">
                                                <input type="text" name="mb_body_type_str" value="<?=$input_str?>" placeholder="직접입력">
                                            </div>
                                            */ ?>
                                            <?
                                            $view_str = "선택하세요";
                                            if ($w=="u") $view_str = $member['mb_body_type'];
                                            ?>
                                            <a data-toggle="modal" data-target="#bodyModal" id="mb_body_type_view"><?=$view_str?></a>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="reg_mb_hobby">취미</label>
                                            <?/*
                                            <select name="mb_hobby" id="reg_mb_hobby" onchange="getSelectedChk(this);">
                                                <option value="">선택하세요</option>
                                                <?
                                                // 직접입력 체크변수
                                                $loop_array = $hobby_arr;
                                                $input_str = "";
                                                $input_cls = "hide";
                                                $compare_val = $member['mb_hobby'];

                                                foreach ($loop_array as $key=>$val) {
                                                    if ($compare_val != "" && !in_array($compare_val, $loop_array) && $val == "직접입력") {
                                                        $input_str = $compare_val;
                                                        $input_cls = "";
                                                    }
                                                    $selected = (($compare_val == $val || $compare_val == $input_str) && $compare_val != "")? "selected" : "";
                                                    ?>
                                                    <option value="<?=$val?>" <?=$selected?>><?=$val?></option>
                                                <? } ?>
                                            </select>
                                            <!-- 직접입력 선택시 -->
                                            <div class="input_area <?=$input_cls?>">
                                                <input type="text" name="mb_hobby_str" value="<?=$input_str?>" placeholder="직접입력">
                                            </div>
                                            */ ?>
                                            <?
                                            $view_str = "선택하세요";
                                            if ($w=="u") $view_str = $member['mb_hobby'];
                                            ?>
                                            <a data-toggle="modal" data-target="#hobbyModal" id="mb_hobby_view"><?=$view_str?></a>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label>자차</label>
                                            <div class="box_in">
                                                <input type="radio" name="mb_car_yn" id="car01" <?if($member['mb_car_yn']=="유") echo "checked"?> value="유">
                                                <label for="car01">유</label>
                                                <input type="radio" name="mb_car_yn" id="car02" <?if($member['mb_car_yn']=="무") echo "checked"?> value="무">
                                                <label for="car02">무</label>
                                            </div>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <label for="mb_drinking">음주</label>
                                            <?/*
                                            <div class="flex">
                                                <select name="mb_drinking" id="mb_drinking">
                                                    <option value="">선택하세요</option>
                                                    <? foreach ($drinking_arr as $key=>$val) { ?>
                                                    <option value="<?=$val?>" <? if ($w=="u" && $member['mb_drinking']==$val) echo "selected"; ?>><?=$val?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                            */?>
                                            <?
                                            $view_str = "선택하세요";
                                            if ($w=="u") $view_str = $member['mb_drinking'];
                                            ?>
                                            <a data-toggle="modal" data-target="#drinkingModal" id="mb_drinking_view"><?=$view_str?></a>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt class="block">
                                            <label for="reg_mb_profile">내 소개</label>
                                            <div class="textarea">
                                                <textarea name="mb_profile" placeholder="예) 저는 운전을 잘해서 드라이브를 시켜드릴 수 있고 유머스러운 성격의 보유자라 항상 웃게 해드릴 수 있습니다. 저와 대화 나눠보시는 거 어떨까요?"><?=$member['mb_profile']?></textarea>
                                            </div>
                                        </dt>
                                    </dl>
                                    <dl>
                                        <dt class="block">
                                            <label for="">사진등록 <span>2장 이상 등록해주세요</span></label>
                                            <div class="frm_photo" id="prev_area">
                                                <ul>
                                                    <li><button type="button" class="add_btn" onclick="getImgUpload();"><i class="fa-light fa-plus"></i></button></li>
                                                    <!--<li class="img_item">
                                                        <p><img src="/~lover2/theme/basic_app/img/main/review_user.png"></p>
                                                        <a class="del_btn"><i class="fa-light fa-xmark"></i></a>
                                                    </li>-->
                                                    <?
                                                    if ($w == "u") {
                                                        // 회원사진
                                                        $imgs = getMemberImg($member['mb_id']);
                                                        foreach ($imgs['list'] AS $key=>$val) {
                                                    ?>
                                                    <li class="img_item" id="item<?=$key?>" data-idx="<?=$val['idx']?>">
                                                        <p><img src="<?=$val['src']?>"></p>
                                                        <a class="del_btn" onclick="getImgDel('u', '<?=$key?>')"><i class="fa-light fa-xmark"></i></a>
                                                    </li>
                                                    <? }} ?>

                                                </ul>
                                            </div>
                                            <div id="dynamic_files">

                                            </div>
                                        </dt>
                                    </dl>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                <div class="join_info">
                    <div class="area">
                        <h2>이상형등록</h2>
                        <div class="mbskin">
                            <div class="box_in">
                                <?
                                // 직접입력 체크변수
                                $loop_array = $ideal_type_arr;
                                $input_str = "";
                                $input_cls = "hide";
                                $compare_val = $member['mb_ideal_type'];

                                if ($w=="u" && strpos($compare_val, "직접입력") !== false) {
                                    $input_cls = "";
                                    $input_str = $member['mb_ideal_type_str'];
                                }

                                foreach ($loop_array as $key=>$val) {
                                    $char_id = "mit{$key}";
                                    $checked = (strpos($compare_val, $val) !== false)? "checked" : "";
                                ?>
                                <input type="checkbox" name="mb_ideal_type[]" id="<?=$char_id?>" value="<?=$val?>" <?=$checked?>>
                                <label for="<?=$char_id?>"><?=$val?></label>
                                <? } ?>
                                <input type="text" class="frm_input <?=$input_cls?>" name="mb_ideal_type_str" value="<?=$input_str?>" placeholder="이상형을 입력하세요">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 지역선택 Modal -->
        <div class="modal fade" id="areaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">지역을 선택하세요</h4>
                    </div>
                    <div class="modal-body">
                        <h4>시/도 선택</h4>
                        <div class="box_in">
                            <? foreach ($city_arr as $key=>$city) { ?>
                            <input type="radio" name="mb_si" id="si<?=$key?>" value="<?=$city?>" onclick="checkCity()" <?if ($w=="u" && $member['mb_si']==$city) echo "checked"; ?>>
                            <label for="si<?=$key?>"><?=$city?></label>
                            <? } ?>
                        </div>
                        <h4>구/군 선택</h4>
                        <div class="box_in" id="gu_item_list">
                            <div>시/도를 선택하세요</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" onclick="saveMyArea()">선택완료</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 흡연여부선택 Modal -->
        <div class="modal fade" id="smokingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">흡연여부를 선택하세요</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box_in">
                            <? foreach ($smoking_arr as $key=>$val) { ?>
                            <input type="radio" name="mb_smoking" id="sk<?=$key?>" value="<?=$val?>" <? if ($member['mb_smoking'] == $val) echo "checked"; ?>>
                            <label for="sk<?=$key?>"><?=$val?></label>
                            <? } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" onclick="saveMySmoking()">선택완료</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 직업선택 Modal -->
        <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">직업을 선택하세요</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box_in">
                            <?
                            // 직접입력 체크변수
                            $loop_array = $job_arr;
                            $input_str = "";
                            $input_cls = "hide";
                            $compare_val = $member['mb_job'];

                            foreach ($loop_array as $key=>$val) {
                                if ($compare_val != "" && !in_array($compare_val, $loop_array) && $val == "직접입력") {
                                    $input_str = $compare_val;
                                    $input_cls = "";
                                }
                                $checked = (($compare_val == $val || $compare_val == $input_str) && $compare_val != "")? "checked" : "";
                            ?>
                            <input type="radio" name="mb_job" id="job<?=$key?>" value="<?=$val?>" <?=$checked?>>
                            <label for="job<?=$key?>"><?=$val?></label>
                            <? } ?>
                            <!-- 직접입력 선택시 -->
                            <input type="text" class="frm_input <?=$input_cls?>" name="mb_job_str" value="<?=$input_str?>" placeholder="직업을 입력하세요">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" onclick="saveMyJob()">선택완료</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- 성격선택 Modal -->
        <div class="modal fade" id="charModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">성격을 2개 이상 선택하세요</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box_in">
                            <?
                            // 직접입력 체크변수
                            $loop_array = $char_arr;
                            $input_str = "";
                            $input_cls = "hide";
                            $compare_val = $member['mb_char'];

                            if ($w=="u" && strpos($compare_val, "직접입력") !== false) {
                                $input_cls = "";
                                $input_str = $member['mb_char_str'];
                            }

                            foreach ($loop_array as $key=>$val) {
                                $char_id = "ch{$key}";
                                $checked = (strpos($compare_val, $val) !== false)? "checked" : "";
                            ?>
                            <input type="checkbox" name="mb_char[]" id="<?=$char_id?>" value="<?=$val?>" <?=$checked?>>
                            <label for="<?=$char_id?>"><?=$val?></label>
                            <? } ?>
                            <input type="text" class="frm_input <?=$input_cls?>" name="mb_char_str" value="<?=$input_str?>" placeholder="성격을 입력하세요">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" onclick="saveMyChar()">선택완료</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- 체형선택 Modal -->
        <div class="modal fade" id="bodyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">체형을 선택하세요</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box_in">
                            <?
                            // 직접입력 체크변수
                            $loop_array = $body_arr;
                            $input_str = "";
                            $input_cls = "hide";
                            $compare_val = $member['mb_body_type'];

                            foreach ($loop_array as $key=>$val) {
                                if ($compare_val != "" && !in_array($compare_val, $loop_array) && $val == "직접입력") {
                                    $input_str = $compare_val;
                                    $input_cls = "";
                                }
                                $checked = (($compare_val == $val || $compare_val == $input_str) && $compare_val != "")? "checked" : "";
                                ?>
                                <input type="radio" name="mb_body_type" id="bdt<?=$key?>" value="<?=$val?>" <?=$checked?>>
                                <label for="bdt<?=$key?>"><?=$val?></label>
                            <? } ?>
                            <!-- 직접입력 선택시 -->
                            <input type="text" class="frm_input <?=$input_cls?>" name="mb_body_type_str" value="<?=$input_str?>" placeholder="체형을 입력하세요">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" onclick="saveMyBodyType()">선택완료</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 취미선택 Modal -->
        <div class="modal fade" id="hobbyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">취미를 선택하세요</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box_in">
                            <?
                            // 직접입력 체크변수
                            $loop_array = $hobby_arr;
                            $input_str = "";
                            $input_cls = "hide";
                            $compare_val = $member['mb_hobby'];

                            foreach ($loop_array as $key=>$val) {
                                if ($compare_val != "" && !in_array($compare_val, $loop_array) && $val == "직접입력") {
                                    $input_str = $compare_val;
                                    $input_cls = "";
                                }
                                $checked = (($compare_val == $val || $compare_val == $input_str) && $compare_val != "")? "checked" : "";
                                ?>
                                <input type="radio" name="mb_hobby" id="hb<?=$key?>" value="<?=$val?>" <?=$checked?>>
                                <label for="hb<?=$key?>"><?=$val?></label>
                            <? } ?>
                            <!-- 직접입력 선택시 -->
                            <input type="text" class="frm_input <?=$input_cls?>" name="mb_hobby_str" value="<?=$input_str?>" placeholder="취미을 입력하세요">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" onclick="saveMyHobby()">선택완료</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- 음주선택 Modal -->
        <div class="modal fade" id="drinkingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">음주량을 선택하세요</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box_in">
                            <? foreach ($drinking_arr as $key=>$val) { ?>
                            <input type="radio" name="mb_drinking" id="dk<?=$key?>" value="<?=$val?>" <? if ($w=="u" && $member['mb_drinking']==$val) echo "checked"; ?>>
                            <label for="dk<?=$key?>"><?=$val?></label>
                            <? } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" onclick="saveMyDrinking()">선택완료</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<form name="certNextFrm" method="post" action="?#step-2">
    <!--<input type="hidden" name="kcb_name" value="<?/*=$kcb_name*/?>">
    <input type="hidden" name="kcb_sex" value="<?/*=$kcb_sex*/?>">
    <input type="hidden" name="kcb_birth" value="<?/*=$kcb_birth*/?>">
    <input type="hidden" name="kcb_hp" value="<?/*=$kcb_hp*/?>">
    <input type="hidden" name="kcb_cert" value="Y">-->
    <input type="hidden" name="nice_name" value="<?=$nice_name?>">
    <input type="hidden" name="nice_sex" value="<?=$nice_sex?>">
    <input type="hidden" name="nice_birth" value="<?=$nice_birth?>">
    <input type="hidden" name="nice_hp" value="<?=$nice_hp?>">
    <input type="hidden" name="nice_cert" value="Y">
</form>

<script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script src="<?=G5_URL?>/js/jquery.register_form.js?v=<?=G5_JS_VER?>"></script>
<script src="<?=G5_URL?>/js/register_form.js?v=<?=G5_JS_VER?>"></script><!-- 회원가입 js -->
<script>
    $(function() {
        let step_hash = parseInt(window.location.hash.replace("#step-", ""));
        let certify = document.querySelector("input[name=mb_certify]").value;
        let w = document.querySelector("input[name=w]").value;
        console.log(`w=${w}, certify=${certify}, step_hash=${step_hash}`);

        if (w == "") {
            // 본인인증 안되었음 step1로 이동
            if (certify == "" && step_hash > 1) location.href = "./register_form.php?#step-1";
            // 본인인증 완료이면 step2로 이동 (테스트)
            else if (certify == "Y" && step_hash < 2) document.certNextFrm.submit();
        }
    })
</script>

<? include_once (G5_PATH."/app/facebook_pixel.php") ?>