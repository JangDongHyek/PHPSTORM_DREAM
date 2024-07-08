
<div class="box-body">
	<dl class="rows long">
		<dt><label for="reg_mb_ideal_type">이상형<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<? 
			unset($ideal_type_arr[count($ideal_type_arr)-1]); // 직접입력 삭제
			$mb_ideal_type_arr = explode(",", $member['mb_ideal_type']);

			$input_class = "hide";
			if (in_array("직접입력", $mb_ideal_type_arr) && $member['mb_ideal_type_str'] != "") $input_class = "show";

			foreach ($ideal_type_arr as $key=>$val) { 
			?>
			<span class="char_box">
				<input type="checkbox" name="mb_ideal_type[]" id="itp<?=$key?>" value="<?=$val?>" <? if (in_array($val, $mb_ideal_type_arr)) echo "checked"; ?> style="margin: 0;">
				<label for="itp<?=$key?>"><?=$val?></label>
			</span>
			<br>
			
			<? } ?>
			<div class="char_box">
				<input type="checkbox" name="mb_ideal_type[]" id="itp" value="직접입력" <? if (in_array("직접입력", $mb_ideal_type_arr) && $member['mb_ideal_type_str'] != "") echo "checked"; ?>>
				<label for="itp">직접입력</label>
				<input type="text" class="frm_input <?=$input_class?>" name="mb_ideal_type_str" value="<?=$member['mb_ideal_type_str']?>" placeholder="성격을 입력하세요">
			</div>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<? /*
	<dl class="rows long">
		<dt><label for="ideal_age_min">나이<strong class="sound_only">필수</strong></label></dt>
		<dd class="half">
			<input type="text" name="ideal_age_min" value="<?=$member['ideal_age_min'] ?>" id="ideal_age_min" class="frm_input step03_txt f_num" maxlength="2" placeholder="최소" data-name="ideal_age_min"> ~ <input type="text" name="ideal_age_max" value="<?=$member['ideal_age_max'] ?>" id="ideal_age_max" class="frm_input step03_txt f_num" maxlength="2" placeholder="최대" data-name="ideal_age_min">
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="logdi01">장거리<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<input type="radio" name="ideal_long_dist" id="logdi01" value="유" <? if ($member['ideal_long_dist'] == "유") echo "checked"; ?>><label for="logdi01">유</label>&nbsp;&nbsp;
			<input type="radio" name="ideal_long_dist" id="logdi02" value="무" <? if ($member['ideal_long_dist'] == "무") echo "checked"; ?>><label for="logdi02">무</label>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"><div class="desc">더욱 많은 이성과 대화를 나눠보실 수 있습니다.</div></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="ideal_height_min">키<strong class="sound_only">필수</strong></label></dt>
		<dd class="half">
			<input type="text" name="ideal_height_min" value="<?=$member['ideal_height_min'] ?>" id="ideal_height_min" class="frm_input step03_txt f_num" maxlength="3" placeholder="최소" data-name="ideal_height_min"> ~ <input type="text" name="ideal_height_max" value="<?=$member['ideal_height_max'] ?>" id="ideal_height_max" class="frm_input step03_txt f_num" maxlength="3" placeholder="최대" data-name="ideal_height_min">
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="ideal_body_type">체형<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="ideal_body_type" id="ideal_body_type" onchange="getSelctdChk(this);" class="f_slct">
				<option value="">선택하세요</option>
				<? 
				// 직접입력체크변수
				$ideal_body_type_str = "";
				$input_class = "hide";

				foreach ($body_arr as $key=>$val) { 
					if ($member['ideal_body_type'] != "" && !in_array($member['ideal_body_type'], $body_arr) && $val == "직접입력") {
						$ideal_body_type_str = $member['ideal_body_type'];
						$input_class = "show";
					}
				?>
				<option value="<?=$val?>" <? if (($member['ideal_body_type'] == $val || $member['ideal_body_type'] == $ideal_body_type_str) && $member['ideal_body_type'] != "") echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<input type="text" name="ideal_body_type_str" class="frm_input step03_txt <?=$input_class?>" value="<?=$ideal_body_type_str?>" placeholder="체형을 입력하세요" data-name="ideal_body_type">
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="ideal_religion">종교<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="ideal_religion" id="ideal_religion" onchange="getSelctdChk(this);" class="f_slct">
				<option value="">선택하세요</option>
				<? 
				// 직접입력체크변수
				$ideal_religion_str = "";
				$input_class = "hide";

				foreach ($religion_arr as $key=>$val) { 
					if ($member['ideal_religion'] != "" && !in_array($member['ideal_religion'], $religion_arr) && $val == "직접입력") {
						$ideal_religion_str = $member['ideal_religion'];
						$input_class = "show";
					}
				?>
				<option value="<?=$val?>" <? if (($member['ideal_religion'] == $val || $member['ideal_religion'] == $ideal_religion_str) && $member['ideal_religion'] != "") echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<input type="text" name="ideal_religion_str" class="frm_input step03_txt <?=$input_class?>" value="<?=$ideal_religion_str?>" placeholder="종교를 입력하세요" data-name="ideal_religion">
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="ideal_drinking">음주<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="ideal_drinking" id="ideal_drinking" class="f_slct">
				<option value="">선택하세요</option>
				<? foreach ($drinking_arr as $key=>$val) { ?>
				<option value="<?=$val?>" <? if ($member['ideal_drinking'] == $val) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="ideal_smoking">흡연<strong class="sound_only">필수</strong></label></dt>
		<dd>
			<select name="ideal_smoking" id="ideal_smoking" class="f_slct">
				<option value="">선택하세요</option>
				<? foreach ($smoking_arr as $key=>$val) { ?>
				<option value="<?=$val?>" <? if ($member['ideal_smoking'] == $val) echo "selected"; ?>><?=$val?></option>
				<? } ?>
			</select>
			<i class="<?=$bullet_on?>"></i>
		</dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="ideal_char">성격<strong class="sound_only">필수</strong></label></dt>
		<dd><textarea name="ideal_char" id="ideal_char" class="frm_input f_txt" placeholder="원하는 이상형의 성격을 입력해주세요."><?=$member['ideal_char']?></textarea></dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="ideal_date">데이트<strong class="sound_only">필수</strong></label></dt>
		<dd><textarea name="ideal_date" id="ideal_date" class="frm_input f_txt" placeholder="원하는 데이트를 입력해주세요."><?=$member['ideal_date']?></textarea></dd>
		<dd class="error_msg"></dd>
	</dl>
	<dl class="rows long">
		<dt><label for="ideal_contents" style="line-height:1.5;">나만의<br>이상형<strong class="sound_only">필수</strong></label></dt>
		<dd><textarea name="ideal_contents" id="ideal_contents" class="frm_input f_txt" placeholder="본인만의 특별한 이상형을 입력해주세요."><?=$member['ideal_contents']?></textarea></dd>
		<dd class="error_msg"></dd>
	</dl>
	*/ ?>
</div>