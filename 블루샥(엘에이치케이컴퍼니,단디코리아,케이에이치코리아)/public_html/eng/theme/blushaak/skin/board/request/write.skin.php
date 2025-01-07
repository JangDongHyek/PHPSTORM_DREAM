<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

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
        <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">Name<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">Password<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">E-mail</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email"  maxlength="100"></td>
        </tr>
        <?php } ?>

        <? /* php if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" ></td>
        </tr>
        <?php } */ ?>

        <!--<?php if ($option) { ?>
        <tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>-->
		
        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">Area you wish to open a store <strong class="sound_only">필수</strong></label></th>
            <td>
                <!--<select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>-->
				<?php //echo $category_option ?>
				<input type="text" name="ca_name" value="<?php echo $write[ca_name]?>" class="require frm_input" required>
            </td>
        </tr>
        <?php } ?>
		<tr>
            <th scope="row"><label for="wr_1">Contact</label></th>
            <td><input type="tel" name="wr_1" value="<?php echo $write[wr_1] ?>" id="wr_1" required class="frm_input required" ></td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_2">Do you own or run a store</label></th>
            <td>
				<select name="wr_2" id="wr_2" required>
					<option value="있음"<?php echo $write['wr_2']=="있음"?" selected":"";?>>Yes</option>
					<option value="없음"<?php echo $write['wr_2']=="없음"?" selected":"";?>>No</option>
				</select>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_3">Desired store size</label></th>
            <td>
				<select name="wr_3" id="wr_3">
					<option value="특수상권"<?php echo $write['wr_3']=="특수상권"?" selected":"";?>>Special commercial area </option>
					<option value="10평"<?php echo $write['wr_3']=="10평"?" selected":"";?>>10 pyeong</option>
					<option value="15평"<?php echo $write['wr_3']=="15평"?" selected":"";?>>15 pyeong</option>
					<option value="20평"<?php echo $write['wr_3']=="20평"?" selected":"";?>>20 pyeong</option>
					<option value="30평이상"<?php echo $write['wr_3']=="30평이상"?" selected":"";?>>30 pyeong or larger</option>
				</select>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_4">Age group</label></th>
            <td>
				<select name="wr_4" id="wr_4">
					<?php
						for($i=2;$i<7;$i++){
					?>
						<option value="<?php echo $i*10?>대"<?php echo $i*10==$write[wr_4]?" selected":"";?>><?php echo $i*10?>'s</option>
					<?php
						}
					?>
				</select>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_5">Start-up cost</label></th>
            <td>
				<select name="wr_5" id="wr_5">
					<option value="1억"<?php echo $write['wr_5']=="1억"?" selected":"";?>>100 million</option>
					<option value="1억5천"<?php echo $write['wr_5']=="1억5천"?" selected":"";?>>150 million</option>
					<option value="2억"<?php echo $write['wr_5']=="2억"?" selected":"";?>>200 million</option>
					<option value="2억5천이상"<?php echo $write['wr_5']=="2억5천이상"?" selected":"";?>>250 million or more</option>
				</select>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_6">Current occupation</label></th>
            <td>
				<select name="wr_6" id="wr_6">
					<option value="직장인"<?php echo $write['wr_6']=="직장인"?" selected":"";?>>Employed</option>
					<option value="가사"<?php echo $write['wr_6']=="가사"?" selected":"";?>>Housekeeper</option>
					<option value="학생"<?php echo $write['wr_6']=="학생"?" selected":"";?>>Student</option>
					<option value="자영업"<?php echo $write['wr_6']=="자영업"?" selected":"";?>>Self-employed</option>
					<option value="기타"<?php echo $write['wr_6']=="기타"?" selected":"";?>>Others</option>
				</select>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_7">Experience brand</label></th>
            <td>
				<input type="text" name="wr_7" value="<?php echo $write[wr_7] ?>" id="wr_7" class="frm_input" >
			</td>
        </tr>
        <tr>
            <th scope="row"><label for="wr_subject">Title<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255">
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <?php if($editor_content_js) echo $editor_content_js; ?>
                    <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
                    <div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>
                    <?php } ?>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_content">Content<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?><br/><br/>
				* Area you wish to open a store: Provide up to [City/Gu]. If it is not applicable, please indicate [Any Region].<br/>
				* Contact within 2-3 days after assigning the person in charge
            </td>
        </tr>
		<?php if($w==""){?>
		<tr>
			<td colspan="2">
				<table>
					<tbody>
						<tr>
							<td><p><strong>*Purpose of collection and use of personal information</strong></p></td>
						</tr>
                        <tr>
                           <td align="right" style="border-bottom:0"><input type="checkbox" name="agree" id="agree" value="1">I agree to the purpose of collection and use of personal information.</td>
                        </tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<textarea name="" class="" rows="10" readonly style="width:100%">▶ Purpose of collection and use of personal information
- Personal identification according to service use, real name verification, confirmation of intention to sign up, and use of age-restricted service. 
- Notification, secure communication channels for handling complaints, and secure accurate delivery address information when delivering goods
- Data for providing up-to-date information such as new services and customized services
- Smooth provision of other high quality services, etc.

▶ List of collected personal information 
- Name, e-mail, contact, mobile phone number, and other optional items

▶ Retention and use period of personal information
- In principle, it shall be destroyed without delay immediately when the purpose of personal information collection or provision is achieved.
- However, for smooth service consultation, the content may be retained for 3 months after consultation is completed.
It will be stored for a certain period when it is necessary to preserve it under laws or regulations, such as the Act on the Consumer Protection in Electronic Commerce.
</textarea>
			</td>
		</tr>
		<?php }?>

        

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">Prevent auto-registration</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_orderby) { ?>
        <tr>
            <th scope="row"><label for="wr_orderby">우선순위</label></th>
            <td><input type="text" name="wr_orderby" value="<?php echo $wr_orderby ?>" id="wr_orderby" class="frm_input" size="4"></td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="Complete" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="<?php echo G5_URL ?>" class="btn_cancel">Cancel</a>
        <?php if ($is_admin) {  ?>
        <a href="./board.php?bo_table=<?php echo $bo_table ?>_eng" class="btn_cancel">목록보기</a>
        <?php }  ?>
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
		
		<?php if($w==""){?>
			if(!$("#agree").prop("checked")){
				alert("개인정보의 수집 및 이용목적에 동의하십시오.");
				return false;
			}
		<?php }?>

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->