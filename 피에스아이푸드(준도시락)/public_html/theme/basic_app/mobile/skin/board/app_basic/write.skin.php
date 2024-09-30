<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?ver='.G5_CSS_VER.'">', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
/**
 * 앱 - 게시판
 */
?>
<style>
#ft_menu{display:none;}
</style>

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

        <?php for ($i=1; $is_link && $i<=1; $i++) { ?>
        <div class="you_link">
            <h3><label for="wr_link<?php echo $i ?>">링크<strong class="sound_only">필수</strong></label></h3>
            <input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input" size="50" placeholder="링크주소를 입력해주세요">
        </div><!--.you_link-->
        <?php } ?>

        </div>
        <!--사진첨부-->
		<div id="bf_wrap">
			<dl>
				<dt>사진 첨부</dt>
                <div class="img_add"><button type="button" class="btn" id="btn_add_file"><i class="fas fa-camera"></i></button></div>
				<dd class="scroll_x">
					<ul id="bf_prev_wrap">
						<?
                        $count = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
                        $file_rlt = sql_query(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' order by bf_datetime, bf_no ");
                        if($count > 0) {
                            $ii = 0;
                            while($rs = sql_fetch_array($file_rlt)) {
                                $ii++;
                                $upload_img = G5_DATA_URL."/file/".$bo_table."/".$rs['bf_file'];
						?>
						<li class="prev_area pau<?=$ii?>">
							<button type="button" class="btn_del" onclick="fnFileDel('u', '<?=$ii?>', '');"><i class="fas fa-times"></i></button>
							<div class="img_bd"><img src="<?=$upload_img?>"></div>
						</li>
						<input type="checkbox" class="el_hidden" id="bf_file_del<?php echo $ii ?>" name="bf_file_del[]" value="<?=$rs['idx']?>">
						<?
							}
						}
						?>
					</ul>
				</dd>
			</dl>
		</div>
        <!--//사진첨부-->
    </div>

    <div class="btn_confirm" id="ft_btn">
        <input type="submit" value="<?=$w=='u' ? '수정' : '등록' ?>하기" id="btn_submit" accesskey="s" class="btn">
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

<script>
    // ***** (멀티플) 파일업로드 START *****
    var sel_files = [],
        file_idx = 0;

    // 파일업로드 클릭
    $("#btn_add_file").on("click", function() {
        var leng = $("input[name='bf_file[]']").length,
            upload = $('<input type="file" name="bf_file[]" class="frm_file el_hidden" id="bf_file'+ file_idx +'" accept="image/*" multiple>');

        console.log(leng);

        var length = $('.prev_area').length;
        if (length < 10) {
            $(".img_add").after(upload);
            upload.trigger('click');
            file_idx++;

        } else {
            alert("최대 10장까지 등록 가능합니다.");
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
        var length = $('.prev_area').length;
        if (length > 10) {
            alert("이미지는 최대 10장까지 등록 가능합니다.");
            return false;
        }

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }


    <?php /*
    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다. */ ?>
    function initLayerPosition() {
        var width = Math.round($(window).width() * 0.9);
        var height = Math.round($(window).height() * 0.8);
        var borderWidth = 1;

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width) / 2 - borderWidth) + 'px';
        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height) / 2 - borderWidth) + 'px';
    }
</script>