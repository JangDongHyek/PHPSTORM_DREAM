<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 100);

?>
<style>
#ft_menu{display:none;}
</style>
<div id="bo_free">
<section id="bo_w">
    <!--<h2 id="container_title"><?php echo $g5['title'] ?></h2> -->

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <div class="tbl_frm01 tbl_wrap">
        <!--<?php if ($option) { ?>
        	옵션 <?php echo $option ?>
        <?php } ?> -->
    	<div class="frm">
        <?php if ($is_name) { ?>
        <label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
        <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input" size="10" maxlength="20">
		<?php } ?>

        <?php if ($is_password) { ?>
        <label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label>
        <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20">
        <?php } ?>
        
        <?php if ($is_category) { ?>
        <label for="ca_name">분류<strong class="sound_only">필수</strong></label>
            <select name="ca_name" id="ca_name" required>
                <option value="">분류를 선택해주세요</option>
                <?php echo $category_option ?>
            </select>
        <?php } ?>

        <label for="wr_subject">제목<strong class="sound_only">필수</strong></label>
		<div id="autosave_wrapper">
			<input type="text" name="wr_subject" value="<?=$write['wr_subject']?>" placeholder="제목을 입력해주세요" id="wr_subject" required class="frm_input" maxlength="255">
		</div>
				
		<label for="wr_content">내용<strong class="sound_only">필수</strong></label>
		<div class="wr_content">
			<textarea id="wr_content" name="wr_content" style="width:100%;height:300px" placeholder="내용을 입력해주세요"><?=$write['wr_content']?></textarea>
		</div>

		<br>
		<div id="bf_wrap">
			<dl>
				<dt>사진 첨부</dt>
                <div class="img_add"><button type="button" class="btn" id="btn_add_file"><i class="fas fa-plus"></i></button></div>
				<dd class="scroll_x">
					<ul id="bf_prev_wrap">
						<? 
						// 글 수정이면
						if ($w == "u" && $file['count'] > 0) { 
							for ($ii = 0; $ii < $file['count']; $ii++)	{
								$upload_img = $file[$ii]['path']."/".$file[$ii]['file'];
						?>
						<li class="prev_area pau<?=$ii?>">
							<button type="button" class="btn_del" onclick="fnFileDel('u', '<?=$ii?>', '');"><i class="fal fa-times"></i></button>
							<div class="img_bd"><img src="<?=$upload_img?>"></div>
						</li>
						<input type="checkbox" class="el_hidden" id="bf_file_del<?php echo $ii ?>" name="bf_file_del[<?php echo $ii;  ?>]" value="1">
						<?
							}
						}
						?>
					</ul>
				</dd>
			</dl>
		</div>
		<? /*
        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
			<strong>사진첨부 #<?php echo $i+1 ?></strong>
			<input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file">
			<?php if ($is_file_content) { ?>
			<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file" size="50">
			<?php } ?>

			<?php if($w == 'u' && $file[$i]['file']) { ?>
			<div style="margin-bottom: 10px;">
				<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1">
				<label for="bf_file_del<?php echo $i ?>" style="display: inline;position: relative;font-size: 1em;height: auto;text-indent: 0;line-height: 1em;">
					<?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제
				</label>
			</div>
			<?php } ?>
		<?php } ?>
		*/ ?>

        </div>
    </div>

    <div class="btn_confirm" id="ft_btn">
        <input type="submit" value="등록하기" id="btn_submit" accesskey="s" class="btn">
    </div>
    </form>

    <script>

	// ***** (멀티플) 파일업로드 START *****
	var sel_files = [],
		file_idx = 0;

	// 파일업로드 클릭
	$("#btn_add_file").on("click", function() {
		var leng = $("input[name='bf_file[]']").length,
			upload = $('<input type="file" name="bf_file[]" class="frm_file el_hidden" id="bf_file'+ file_idx +'" accept="image/*" multiple>');

		console.log(leng);

		if (leng < 5) {
			$(".img_add").after(upload);
			upload.trigger('click');
			file_idx++;

		} else {
			alert("최대 5장까지 등록 가능합니다.");
			return false;
		}
	});

	$(document).on("change", "input[name='bf_file[]']", function(e) {
		fnFileUpload(e, this);
	});

	// 파일업로드 미리보기
	function fnFileUpload(e, el) {
		var files = e.target.files,
			files_arr = Array.prototype.slice.call(files),
			index = sel_files.length,
			prev_wrap = $("#bf_prev_wrap"),
			el_id = $(el).attr("id");

		files_arr.forEach(function(f) {
			if (!f.type.match("image.*")) {
				alert("이미지만 업로드가 가능합니다.");
				return;
			}
			if (f.size > 5242880) {
				alert("이미지의 최대 용량(5MB)을 초과하여 등록이 불가능 합니다.");
				return;
			}

			sel_files.push(f);

			var reader = new FileReader();
			reader.onload = function(e) {
				var html = "<li class='prev_area pa"+ index +"'>";
				html += "<button type='button' class='btn_del' onclick=\"fnFileDel('w', "+ index +", '"+ el_id +"');\"><i class='fal fa-times'></i></button>";
				html += "<div class='img_bd'>";
				html += "<img src='"+ e.target.result +"' data-file='"+ f.name +"'>";
				html += "</div>";
				html += "</li>";

				prev_wrap.append(html);
				index++;
			}
			reader.readAsDataURL(f);
		});
	}

	// 파일업로드 삭제
	function fnFileDel(mode, idx, el_id) {
		if (mode == "w") {
			sel_files.splice(idx, 1);
			$("li.pa" + idx).remove();
			$("#"+el_id).remove();
		} else {
			$("li.pau" + idx).remove();
			$("#bf_file_del" + idx).prop("checked", true);
		}
	}
	// ***** (멀티플) 파일업로드 END *****

    function fwrite_submit(f)
    {
        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->
</div>