<?php if($w == "") { ?>
<div id="join_agr">
	<h2>약관동의</h2>
	<div class="box-body">
		<dl class="agree">
			<dd class="chk_red" data-for="reg_req1">
				<input type="checkbox" name="agree1" id="agree1" value="1">
				<label for="agree1">서비스 이용약관 동의(필수)</label>
			</dd>
			<dd class="btn_agr"><input type="button" value="보기" class="btn_red"></dd>
			<dd class="agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
		</dl>
		
		<dl class="agree">
			<dd class="chk_red" data-for="reg_req2">
				<input type="checkbox" name="agree2" id="agree2" value="1">
				<label for="agree2">개인정보처리방침 동의(필수)</label>
			</dd>
			<dd class="btn_agr"><input type="button" value="보기" class="btn_red"></dd>
			<dd class="agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
		</dl>

		<dl class="agree">
			<dd class="chk_red" data-for="reg_req3">
				<input type="checkbox" name="agree3" id="agree3" value="1">
				<label for="agree3" style="letter-spacing: -2px;">"연인" 소개팅 관련 정보 수신에 동의(필수)</label>
			</dd>
			<dd class="btn_agr"><input type="button" value="보기" class="btn_red"></dd>
			<dd class="agr_textarea"><textarea readonly><?php echo get_text($config['cf_matching']) ?></textarea></dd>
		</dl>

		<dl>
			<dd class="chk_red" data-for="reg_req3">
				<input type="checkbox" name="agree0" id="agree0" value="1">
				<label for="agree0">위 내용에 모두 동의합니다</label>
			</dd>
		</dl>
	</div>
</div><!--//join_agr-->
<?php } ?>

<div class="box-body">
    <dl class="rows long">
        <dt><label>가입경로<strong class="sound_only">필수</strong></label></dt>
        <dd class="select m5">
            <p class="subt">가입경로</p>
            <?php
            $ii=0;
            $join_path_arr = explode(",", $member['mb_join_path']);
            foreach (MEMBER_JOIN_PATH AS $key=>$val) {
                //if ($ii>0 && $ii%2==0) echo "<br>";
                if ($ii>0 && $ii%2==0) echo "";
            ?>
            <span class="join_path_box">
                <input type="checkbox" name="mb_join_path[]" id="jp<?=$key?>" value="<?=$key?>" <? if ($member['mb_join_path'] != "" && in_array($key, $join_path_arr)) echo "checked"; ?>>
                <label for="jp<?=$key?>"><?=$val?></label>
            </span>&nbsp;
        <?php $ii++; }?>
        </dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_id">아이디<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" name="mb_id" value="<?=$member['mb_id']?>" id="reg_mb_id" class="frm_input f_txt" minlength="3" maxlength="20" <?=$readonly ?> placeholder="아이디 (영문/숫자, 3자이상 입력)">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_password">비밀번호<strong class="sound_only">필수</strong></label></dt>
        <dd><input type="password" name="mb_password" id="reg_mb_password" class="frm_input f_txt" minlength="6" maxlength="20" placeholder="비밀번호"><i></i></dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_password_re">비밀번호 확인<strong class="sound_only">필수</strong></label></dt>
        <dd><input type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input f_txt" minlength="3" maxlength="20" placeholder="비밀번호 확인"><i></i></dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" name="mb_name" value="<?=$member['mb_name'] ?>" id="reg_mb_name" class="frm_input f_txt" readonly />
            <i class="<?=$bullet_on?> <?=$kcb_bullet['mb_name']?>"></i>
            <p class="msg">※본인 명의(이름,생년월일,성별)가 아닌 경우 가입 완료 진행 후, 카카오 채널 상담 연결을 통해  정보 수정 가능합니다.</p>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="mb_5">카카오아이디<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" name="mb_5" value="<?=$member['mb_5']?>" id="mb_5" class="frm_input f_txt" minlength="3" maxlength="20" placeholder="카카오 아이디 입력">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_sex">성별<strong class="sound_only">필수</strong></label></dt>
        <dd class="select flex ai-c jc-sb">
            <input type="radio" name="mb_sex" id="reg_mb_sex1" value="남" <? if ($member['mb_sex'] == "남") echo "checked" ?> onclick="return false;">
            <label for="reg_mb_sex1" class="w49">남자</label>&nbsp;&nbsp;
            <input type="radio" name="mb_sex" id="reg_mb_sex2" value="여" <? if ($member['mb_sex'] == "여") echo "checked" ?> onclick="return false;">
            <label for="reg_mb_sex2" class="w49">여자</label>
            <i class="<?=$bullet_on?> <?=$kcb_bullet['mb_sex']?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_si">거주지역<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <?
            $view_str = "";
            if ($w=="u") $view_str = $member['mb_si']." ".$member['mb_gu'];
            ?>
            <input type="text" class="frm_input" name="mb_area_view" value="<?=$view_str?>" data-toggle="modal" data-target="#areaModal" readonly placeholder="지역">
            <input type="hidden" name="old_mb_gu" value="<?=$member['mb_gu']?>">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_birth">생년월일<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" name="mb_birth" value="<?=$member['mb_birth']?>" id="reg_mb_birth" class="frm_input f_slct" readonly placeholder="YYYY-MM-DD">
            <i class="<?=$bullet_on?> <?=$kcb_bullet['mb_birth']?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_height">키<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" name="mb_height" value="<?=$member['mb_height'] ?>" id="reg_mb_height" class="frm_input f_num f_txt" maxlength="3" placeholder="키 cm">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_smoking">흡연<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" class="frm_input" name="mb_smoking_view" value="<?=$member['mb_smoking']?>" data-toggle="modal" data-target="#smokingModal" readonly placeholder="흡연 여부">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
   <dl class="rows long">
        <dt><label for="reg_mb_job">직업<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" class="frm_input" name="mb_job_view" value="<?=$member['mb_job']?>" data-toggle="modal" data-target="#jobModal" readonly placeholder="직업">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_char">성격<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <?php
            $charStr = $member['mb_char'];
            if (!empty($member['mb_char_str'])) $charStr = str_replace('직접입력', $member['mb_char_str'], $charStr);
            ?>
            <input type="text" class="frm_input" name="mb_char_view" value="<?=$charStr?>" data-toggle="modal" data-target="#charModal" readonly placeholder="성격">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_body_type">체형<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" class="frm_input" name="mb_body_type_view" value="<?=$member['mb_body_type']?>" data-toggle="modal" data-target="#bodyModal" readonly placeholder="체형">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_hobby">취미<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <input type="text" class="frm_input" name="mb_hobby_view" value="<?=$member['mb_hobby']?>" data-toggle="modal" data-target="#hobbyModal" readonly placeholder="취미">
            <i class="<?=$bullet_on?>"></i>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label for="reg_mb_profile">내 소개<strong class="sound_only">필수</strong></label></dt>
        <dd>
            <p class="subt">내 소개</p>
            <textarea name="mb_profile" id="reg_mb_profile" class="frm_input f_txt" placeholder="자기소개 예) 저는 운전을 잘해서 드라이브를 시켜드릴 수 있고 유머스러운 성격의 보유자라 항상 웃게 해드릴 수 있습니다. 저와 대화 나눠보시는 거 어떨까요?"><?=$member['mb_profile']?></textarea>
        </dd>
        <dd class="error_msg"></dd>
    </dl>
    <dl class="rows long">
        <dt><label style="line-height:1.3;">사진<div style="font-size:0.9em; font-weight:normal;">※ 2장 이상</div><strong class="sound_only">필수</strong></label></dt>
        <dd id="bf_wrap">
            <p class="subt">사진 (2장 이상)</p>
            <!-- 이미지선택전 -->
            <div style="padding: 5px 0;"><button type="button" class="btn_red" onclick="getImgUpload();">사진등록하기</button></div>
            <!-- 이미지선택후 -->
            <div id="img_after">
                <!-- 미리보기 -->
                <div id="prev_area">
                    <?
                    if($w == 'u' && $imgs_cnt > 0) {
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
            <!-- //이미지선택후 -->
        </dd>
        <dd class="error_msg"></dd>
    </dl>
</div>

<!-- 지역선택 Modal -->
<div class="modal fade" id="areaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">지역을 선택하세요</h4>
            </div>
            <div class="modal-body select m5">
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
                <button type="button" class="btn btn_purpleg btn_large" onclick="saveMyArea()">선택완료</button>
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
                <div class="box_in select m5">
                    <? foreach ($smoking_arr as $key=>$val) { ?>
                    <input type="radio" name="mb_smoking" id="sk<?=$key?>" value="<?=$val?>" <? if ($member['mb_smoking'] == $val) echo "checked"; ?>>
                    <label for="sk<?=$key?>"><?=$val?></label>
                    <? } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_purpleg btn_large" onclick="saveMySmoking()">선택완료</button>
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
                <div class="box_in  select m5">
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
                <button type="button" class="btn btn_purpleg btn_large" onclick="saveMyJob()">선택완료</button>
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
                <div class="box_in  select m5">
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
                <button type="button" class="btn btn_purpleg btn_large" onclick="saveMyChar()">선택완료</button>
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
                <div class="box_in select m5">
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
                <button type="button" class="btn btn_purpleg btn_large" onclick="saveMyBodyType()">선택완료</button>
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
                <div class="box_in  select m5">
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
                <button type="button" class="btn btn_purpleg btn_large" onclick="saveMyHobby()">선택완료</button>
            </div>
        </div>
    </div>
</div>