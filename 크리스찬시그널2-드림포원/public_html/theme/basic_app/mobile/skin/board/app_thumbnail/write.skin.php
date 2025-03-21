<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>
<style>
    #ft_menu{display:none;}
</style>
<?php  if (G5_IS_ADMIN == 1) { ?>
    <style>
        .btn{
            display: inline-block;
            vertical-align: middle;
            padding: 10px;
            border: 1px solid #ccc;
            background: #f0f0f0;
            text-decoration: none;
            cursor: pointer;
            float: right;
        }
    </style>
<?php } ?>
<section id="bo_w">

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
                    <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input" size="10" maxlength="20" placeholder="작성자명">
                <?php } ?>

                <?php if (0) { ?>
                    <label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label>
                    <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20" placeholder="비밀번호입력">
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
            </div>
        </div>

        <br>
        <div <?php echo G5_IS_ADMIN == 1 ? 'style="padding: 0 20px;"' : ''; ?>>
            <?php
            for ($i=0; $is_file && $i<$file_count; $i++) { ?>
                <strong>파일첨부 #<?php echo $i+1 ?></strong>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file">
                <?php if(strpos($_SERVER['REQUEST_URI'], 'adm') !== false && $w == '') { ?>
                    <br><br>
                <?php } ?>
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
            <?php }
            ?>
        </div>
        <?php if ($is_guest) { //자동등록방지 ?>
            <div>
                <th scope="row">자동등록방지</th>
                <td>
                    <?php echo $captcha_html ?>
                </td>
            </div>
        <?php } ?>
        <!--<div id="bf_wrap">
		<dl>
			<dt>사진 첨부</dt>
			<dd>
				<div id="bf_prev_wrap">
					<?/*
					// 글 수정이면
					if ($w == "u" && $file['count'] > 0) {
						for ($ii = 0; $ii < $file['count']; $ii++)	{
							$upload_img = $file[$ii]['path']."/".$file[$ii]['file'];
					*/?>
					<div class="prev_area pau<?/*=$ii*/?>">
						<button type="button" class="btn_del" onclick="fnFileDel('u', '<?/*=$ii*/?>', '');"><i class="fas fa-times"></i></button>
						<div class="img_bd"><img src="<?/*=$upload_img*/?>"></div>
					</div>
					<input type="checkbox" class="el_hidden" id="bf_file_del<?php /*echo $ii */?>" name="bf_file_del[<?php /*echo $ii;  */?>]" value="1">
					<?/*
						}
					}
					*/?>
				</div>
				<div class="img_add"><button type="button" class="btn" id="btn_add_file"><i class="fas fa-plus"></i></button></div>
			</dd>
		</dl>
	</div>-->


        <div class="btn_confirm" id="ft_btn">
            <input type="submit" value="등록하기" id="btn_submit" accesskey="s" class="btn">
        </div>
    </form>

    <script>
        <?php if($write_min || $write_max) { ?>
        // 글자수 제한
        var char_min = parseInt(<?php echo $write_min; ?>); // 최소
        var char_max = parseInt(<?php echo $write_max; ?>); // 최대
        check_byte("wr_content", "char_count");

        $(function() {
            $("#wr_content").on("keyup", function() {
                check_byte("wr_content", "char_count");
            });
        });

        <?php } ?>
        function html_auto_br(obj)
        {
            if (obj.checked) {
                result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
                if (result)
                    obj.value = "html2";
                else
                    obj.value = "html1";
            }
            else
                obj.value = "";
        }

        function fwrite_submit(f)
        {
            <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

            var subject = "";
            var content = "";
            $.ajax({
                url: g5_bbs_url+"/ajax.filter.php",
                type: "POST",
                data: {
                    "subject": f.wr_subject.value,
                    "content": f.wr_content.value
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    subject = data.subject;
                    content = data.content;
                }
            });

            if (subject) {
                alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
                f.wr_subject.focus();
                return false;
            }

            if (content) {
                alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
                if (typeof(ed_wr_content) != "undefined")
                    ed_wr_content.returnFalse();
                else
                    f.wr_content.focus();
                return false;
            }

            if (document.getElementById("char_count")) {
                if (char_min > 0 || char_max > 0) {
                    var cnt = parseInt(check_byte("wr_content", "char_count"));
                    if (char_min > 0 && char_min > cnt) {
                        alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                        return false;
                    }
                    else if (char_max > 0 && char_max < cnt) {
                        alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                        return false;
                    }
                }
            }

            <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

            document.getElementById("btn_submit").disabled = "disabled";

            return true;
        }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->