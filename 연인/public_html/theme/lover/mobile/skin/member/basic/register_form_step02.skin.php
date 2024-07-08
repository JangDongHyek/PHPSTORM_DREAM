


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
			<input type="text" name="mb_name" value="<?=$member['mb_name'] ?>" id="reg_mb_name" class="frm_input f_txt" minlength="3" maxlength="20" <?=$readonly?> <?=$kcb_readonly['mb_name']?> placeholder="2자 이상">
			<i class="<?=$bullet_on?> <?=$kcb_bullet['mb_name']?>"></i>
            <p class="msg">※본인 명의(이름,생년월일,성별)가 아닌 경우 가입 완료 진행 후, 카카오 채널 상담 연결을 통해  정보 수정 가능합니다.</p>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="reg_mb_sex">성별<strong class="sound_only">필수</strong></label></dt>
		<dd class="select flex ai-c jc-sb">
			<input type="radio" name="mb_sex" id="reg_mb_sex1" value="남" <? if ($member['mb_sex'] == "남") echo "checked" ?> <?=$kcb_readonly['mb_sex']?>><label for="reg_mb_sex1" class="w49">남자</label>&nbsp;&nbsp;
			<input type="radio" name="mb_sex" id="reg_mb_sex2" value="여" <? if ($member['mb_sex'] == "여") echo "checked" ?> <?=$kcb_readonly['mb_sex']?>><label for="reg_mb_sex2" class="w49">여자</label>
			<i class="<?=$bullet_on?> <?=$kcb_bullet['mb_sex']?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<? /*
	<dl class="rows long">
		<dt><label for="reg_mb_military1">병역<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<input type="radio" name="mb_military" id="reg_mb_military1" value="군필" <? if ($member['mb_military'] == "군필") echo "checked" ?>><label for="reg_mb_military1">군필</label>&nbsp;&nbsp;
			<input type="radio" name="mb_military" id="reg_mb_military2" value="미필" <? if ($member['mb_military'] == "미필") echo "checked" ?>><label for="reg_mb_military2">미필</label>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	*/ ?>
	<dl class="rows long">
		<dt><label for="reg_mb_si">거주지역<strong class="sound_only">필수</strong></label></dt>
		<dd>
                <p class="subt">거주지역</p>
			<select name="mb_si" id="reg_mb_si">
				<option value="">시/도 전체</option>
				<? foreach ($city_arr as $key=>$val) { ?>
				<option value="<?=$val?>" <? if ($member['mb_si'] == $val) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<select name="mb_gu" id="reg_mb_gu" class="f_slct">
				<option value="">구/군 전체</option>
			</select>
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
	<? /*
	<dl class="rows long">
		<dt><label for="reg_mb_blood_type">혈액형<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="mb_blood_type" id="reg_mb_blood_type" class="f_slct">
				<option value="">선택하세요</option>
				<? foreach ($blood_arr as $key=>$val) { ?>
				<option value="<?=$val?>" <? if ($member['mb_blood_type'] == $val) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	*/ ?>
	<dl class="rows long">
		<dt><label for="reg_mb_smoking">흡연<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="mb_smoking" id="reg_mb_smoking" class="f_slct">
				<option value="">흡연 여부를 선택하세요</option>
				<? foreach ($smoking_arr as $key=>$val) { ?>
				<option value="<?=$val?>" <? if ($member['mb_smoking'] == $val) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<? /*
	<dl class="rows long">
		<dt><label for="reg_mb_car1">자차<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<input type="radio" name="mb_car" id="reg_mb_car1" value="유" <? if ($member['mb_car'] == "유") echo "checked"; ?>><label for="reg_mb_car1">유</label>&nbsp;&nbsp;
			<input type="radio" name="mb_car" id="reg_mb_car2" value="무" <? if ($member['mb_car'] == "무") echo "checked"; ?>><label for="reg_mb_car2">무</label>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="reg_mb_drinking">음주<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="mb_drinking" id="reg_mb_drinking" class="f_slct">
				<option value="">선택하세요</option>
				<? foreach ($drinking_arr as $key=>$val) { ?>
				<option value="<?=$val?>" <? if ($member['mb_drinking'] == $val) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="reg_mb_religion">종교<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="mb_religion" id="reg_mb_religion" onchange="getSelctdChk(this);" class="f_slct">
				<option value="">선택하세요</option>
				<? 
				// 직접입력체크변수
				$mb_religion_str = "";
				$input_class = "hide";

				foreach ($religion_arr as $key=>$val) { 
					if ($member['mb_religion'] != "" && !in_array($member['mb_religion'], $religion_arr) && $val == "직접입력") {
						$mb_religion_str = $member['mb_religion'];
						$input_class = "show";
					}
				?>
				<option value="<?=$val?>" <? if (($member['mb_religion'] == $val || $member['mb_religion'] == $mb_religion_str) && $member['mb_religion'] != "") echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<input type="text" name="mb_religion_str" class="frm_input <?=$input_class?>" value="<?=$mb_religion_str?>" placeholder="종교를 입력하세요" data-name="mb_religion">
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="reg_mb_edu">학력<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="mb_edu" id="reg_mb_edu" class="f_slct">
				<option value="">선택하세요</option>
				<? foreach ($edu_arr as $key=>$val) { ?>
				<option value="<?=$val?>" <? if ($member['mb_edu'] == $val) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	*/ ?>
	<dl class="rows long">
		<dt><label for="reg_mb_job">직업<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="mb_job" id="reg_mb_job" onchange="getSelctdChk(this);" class="f_slct">
				<option value="">직업를 선택하세요</option>
				<? 
				// 직접입력체크변수
				$mb_job_str = "";
				$input_class = "hide";

				foreach ($job_arr as $key=>$val) { 
					if ($member['mb_job'] != "" && !in_array($member['mb_job'], $job_arr) && $val == "직접입력") {
						$mb_job_str = $member['mb_job'];
						$input_class = "show";
					}
				?>
				<option value="<?=$val?>" <? if (($member['mb_job'] == $val || $member['mb_job'] == $mb_job_str ) && $member['mb_job'] != "") echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<input type="text" name="mb_job_str" class="frm_input <?=$input_class?>" value="<?=$mb_job_str?>" placeholder="직업을 입력하세요" data-name="mb_job">
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="reg_mb_char">성격<strong class="sound_only">필수</strong></label></dt>
		<dd class="select m5">
			<? 
			unset($char_arr[count($char_arr)-1]); // 직접입력 삭제
			$mb_char_arr = explode(",", $member['mb_char']);

			$input_class = "hide";
			if (in_array("직접입력", $mb_char_arr) && $member['mb_char_str'] != "") $input_class = "show";

			foreach ($char_arr as $key=>$val) { 
			?>
			<span class="char_box">
				<input type="checkbox" name="mb_char[]" id="ch<?=$key?>" value="<?=$val?>" <? if (in_array($val, $mb_char_arr)) echo "checked"; ?>>
				<label for="ch<?=$key?>"><?=$val?></label>
			</span>&nbsp;
			<? } ?>
			<div class="char_box">
				<input type="checkbox" name="mb_char[]" id="chd" value="직접입력" <? if (in_array("직접입력", $mb_char_arr) && $member['mb_char_str'] != "") echo "checked"; ?>>
				<label for="chd">직접입력</label>
				<input type="text" class="frm_input <?=$input_class?>" name="mb_char_str" value="<?=$member['mb_char_str']?>" placeholder="성격을 입력하세요">
			</div>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="reg_mb_body_type">체형<strong class="sound_only">필수</strong></label></dt>
		<dd class="select m5">
			<select name="mb_body_type" id="reg_mb_body_type" onchange="getSelctdChk(this);" class="f_slct">
				<option value="">체형을 선택하세요</option>
				<? 
				// 직접입력체크변수
				$mb_body_type_str = "";
				$input_class = "hide";

				foreach ($body_arr as $key=>$val) { 
					if ($member['mb_body_type'] != "" && !in_array($member['mb_body_type'], $body_arr) && $val == "직접입력") {
						$mb_body_type_str = $member['mb_body_type'];
						$input_class = "show";
					}
				?>
				<option value="<?=$val?>" <? if (($member['mb_body_type'] == $val || $member['mb_body_type'] == $mb_body_type_str) && $member['mb_body_type'] != "") echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<input type="text" name="mb_body_type_str" class="frm_input <?=$input_class?>" value="<?=$mb_body_type_str?>" placeholder="체형을 입력하세요" data-name="mb_body_type">
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="reg_mb_hobby">취미<strong class="sound_only">필수</strong></label></dt>
		<dd class="select m5">
			<select name="mb_hobby" id="reg_mb_hobby" onchange="getSelctdChk(this);" class="f_slct">
				<option value="">취미를 선택하세요</option>
				<? 
				// 직접입력체크변수
				$mb_hobby_str = "";
				$input_class = "hide";

				foreach ($hobby_arr as $key=>$val) { 
					if ($member['mb_hobby'] != "" && !in_array($member['mb_hobby'], $hobby_arr) && $val == "직접입력") {
						$mb_hobby_str = $member['mb_hobby'];
						$input_class = "show";
					}
				?>
				<option value="<?=$val?>" <? if (($member['mb_hobby'] == $val || $member['mb_hobby'] == $mb_hobby_str) && $member['mb_hobby'] != "") echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<input type="text" name="mb_hobby_str" class="frm_input <?=$input_class?>" value="<?=$mb_hobby_str?>" placeholder="취미를 입력하세요" data-name="mb_hobby">
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