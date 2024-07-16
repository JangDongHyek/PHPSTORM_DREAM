<?php

add_stylesheet("<link rel=\"stylesheet\" href=\"{$board_skin_url}/style.css\" />", 0);
add_javascript("<script src=\"{$board_skin_url}/script.js\"></script>", 0);

?>

<script>
function write_skin(){
	<?php echo $editor_js; ?>
	<?php echo $captcha_js; ?>
}
</script>

<form id="write-skin" name="fwrite" method="post" action="<?php echo $action_url; ?>" enctype="multipart/form-data" onsubmit="return write_skin(this);">
	<?php if($is_name){ ?>
	<div>
		<p>
			<input type="text" name="wr_name" value="<?php echo $name; ?>" placeholder="이름" required />
		</p>
	</div>
	<?php } ?>
	<?php if($is_password){ ?>
	<div>
		<p>
			<input type="password" name="wr_password" placeholder="비밀번호" required />
		</p>
	</div>
	<?php } ?>
	<?php if($is_category){ ?>
	<div>
		<p>
			<select name="ca_name" required>
				<option value="">분류</option>
				<?php foreach(explode('|', $board['bo_category_list']) as $val){ ?>
				<option value="<?php echo $val; ?>" <?php if($write['ca_name'] == $val) echo 'selected="selected"'; ?>><?php echo $val; ?></option>
				<?php } ?>
			</select>
		</p>
	</div>
	<?php } ?>
	<div>
		<p>
			<input type="text" name="wr_subject" value="<?php echo $subject; ?>" class="full" placeholder="제목" required />
		</p>
	</div>
	<div>
		<?php echo $editor_html; ?>
		<p class="right">
			<?php
			if($is_notice){
				echo "<label><input type=\"checkbox\" name=\"notice\" value=\"1\" {$notice_checked} /> 공지글</label>";
			}
			if($is_secret && ($is_admin || $is_secret == 1)){
				echo "<label><input type=\"checkbox\" name=\"secret\" value=\"secret\" {$secret_checked} /> 비밀글</label>";
			}
			if($is_html && !$is_dhtml_editor){
				echo "<label><input type=\"checkbox\" name=\"html\" value=\"{$html_value}\" {$html_checked} /> HTML</label>";
			}
			?>
		</p>
	</div>
	<?php for($key = 1; $is_link && $key <= G5_LINK_COUNT; $key++){ ?>
	<div>
		<p>
			<input type="text" name="wr_link<?php echo $key; ?>" value="<?php echo $write['wr_link' . $key]; ?>" class="full" />
		</p>
	</div>
	<?php } ?>
	<?php for($key = 0; $is_file && $key < $file_count; $key++){ ?>
	<div>
		<p>
			<input type="file" name="bf_file[]" />
		</p>
		<?php if($w == 'u' && $file[$key]['file']){ ?>
		<p>
			<label>
				<input type="checkbox" name="bf_file_del[<?php echo $key; ?>]" value="1" />
				<?php echo $file[$key]['source']; ?> 파일삭제
			</label>
		</p>
		<?php } ?>
	</div>
	<?php } ?>
	<?php if($is_use_captcha){ ?>
	<div>
		<p>
			<?php echo $captcha_html; ?>
		</p>
	</div>
	<?php } ?>
	<p>
		<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>">목록보기</a>
		<button type="submit">저장하기</button>
		<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>" />
		<input type="hidden" name="w" value="<?php echo $w; ?>" />
		<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>" />
		<input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>" />
		<input type="hidden" name="sca" value="<?php echo $sca; ?>" />
		<input type="hidden" name="sfl" value="<?php echo $sfl; ?>" />
		<input type="hidden" name="stx" value="<?php echo $stx; ?>" />
		<input type="hidden" name="spt" value="<?php echo $spt; ?>" />
		<input type="hidden" name="sst" value="<?php echo $sst; ?>" />
		<input type="hidden" name="sod" value="<?php echo $sod; ?>" />
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<?php
		if($is_html && $is_dhtml_editor){
			echo '<input type="hidden" name="html" value="html1" />';
		}
		if($is_secret && !$is_admin && $is_secret != 1){
			echo '<input type="hidden" name="secret" value="secret" />';
		}
		?>	
	</p>
</form>