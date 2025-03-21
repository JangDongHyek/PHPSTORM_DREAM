<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE wr_1 = '다중지능검사관' ";
$row = sql_fetch($sql);
$cate_count1 = $row['cnt'];

$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE wr_1 = '홀랜드검사관' ";
$row = sql_fetch($sql);
$cate_count2 = $row['cnt'];

$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE wr_1 = '성격카드탐색관' ";
$row = sql_fetch($sql);
$cate_count3 = $row['cnt'];

$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE wr_1 = '취업대비상담관' ";
$row = sql_fetch($sql);
$cate_count4 = $row['cnt'];

$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE wr_1 = '모의면접관' ";
$row = sql_fetch($sql);
$cate_count5 = $row['cnt'];

$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE wr_1 = '학종상담관' ";
$row = sql_fetch($sql);
$cate_count6 = $row['cnt'];

$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE wr_1 = '자원봉사자' ";
$row = sql_fetch($sql);
$cate_count7 = $row['cnt'];

$cate_disabled = "disabled";

?>
<section id="bo_w">
    <?php /*?><h2 id="container_title"><?php echo $g5['title'] ?></h2><?php */?>

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
        <tr>
			<th scope="row">부스명</th>
			<td colspan="3" scope="row">
			<p style="font-size:15px">
			  <strong><label for="rb_1">진로탐색관 :</label></strong> 
			  <input name="wr_1" id="rb_1" type="radio" value="다중지능검사관" required <?if($write['wr_1'] == "다중지능검사관"){echo "checked";}?> <?if($cate_count1 >= 300){echo $cate_disabled;}?>>
			  <label for="rb_1">다중지능검사관<?if($is_admin){echo "[".$cate_count1."/300]";}?></label>
			  &nbsp;&nbsp;
			  <input name="wr_1" id="rb_2" type="radio" value="홀랜드검사관" required <?if($write['wr_1'] == "홀랜드검사관"){echo "checked";}?> <?if($cate_count2 >= 300){echo $cate_disabled;}?>>
			  <label for="rb_2">홀랜드검사관<?if($is_admin){echo "[".$cate_count2."/300]";}?></label>
			  &nbsp;&nbsp;
			  <input name="wr_1" id="rb_3" type="radio" value="성격카드탐색관" required <?if($write['wr_1'] == "성격카드탐색관"){echo "checked";}?> <?if($cate_count3 >= 300){echo $cate_disabled;}?>>
			  <label for="rb_3">성격카드탐색관<?if($is_admin){echo "[".$cate_count3."/300]";}?></label>
			  &nbsp;&nbsp;
			  <input name="wr_1" id="rb_4" type="radio" value="취업대비상담관" required <?if($write['wr_1'] == "취업대비상담관"){echo "checked";}?> <?if($cate_count4 >= 100){echo $cate_disabled;}?>>
			  <label for="rb_4">취업대비상담관<?if($is_admin){echo "[".$cate_count4."/100]";}?></label>
			  </select>
			</p>
			<p style="font-size:15px">
			<strong><label for="rb_5">진로정보관 :</label></strong> 
			  <input name="wr_1" id="rb_5" type="radio" value="모의면접관" required <?if($write['wr_1'] == "모의면접관"){echo "checked";}?> <?if($cate_count5 >= 110){echo $cate_disabled;}?>>
			  <label for="rb_5">모의면접관<?if($is_admin){echo "[".$cate_count5."/110]";}?></label>
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <input name="wr_1" id="rb_6" type="radio" value="학종상담관" required <?if($write['wr_1'] == "학종상담관"){echo "checked";}?> <?if($cate_count6 >= 50){echo $cate_disabled;}?>>
			  <label for="rb_6">학종상담관<?if($is_admin){echo "[".$cate_count6."/50]";}?></label>
			</p>
			<p style="font-size:15px">
			<strong><label for="rb_9">자원봉사자 :</label></strong> 
			  <input name="wr_1" id="rb_9" type="radio" value="자원봉사자" required <?if($write['wr_1'] == "자원봉사자"){echo "checked";}?>>
			  <label for="rb_9">
				자원봉사자 신청 (중3, 고1, 고2) 
			  <br />
			  </label>
			</p>
		  </td>
		  </tr>
        <tbody>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="wr_name" id="wr_name" value="<?php echo $write['wr_name']?>" required class="frm_input required" size="10" maxlength="20" onkeyup="name_copy(this)">
				
				<input type="hidden" name="wr_subject" id="wr_subject" value="<?php echo $write['wr_subject']?>" onkeyup="name_copy(this)">
				<script>					
				function name_copy(name){
					document.fwrite.wr_subject.value = name.value + " 님의 박람회 신청서입니다.";
				}
				</script>
			</td>
            <th><label for="rb_7">성별</label></th>
            <td>
				<input name="wr_2" id="rb_7" type="radio" value="남" required <?if($write['wr_2'] == "남"){echo "checked";}?>>
				<label for="rb_7">남</label>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="wr_2" id="rb_8" type="radio" value="여" required <?if($write['wr_2'] == "여"){echo "checked";}?>>
				<label for="rb_8">여</label>
			</td>
        </tr>
        <tr>
            <th><label for="wr_3">연락처</label></th>
            <td><input type="text" name="wr_3" id="wr_3" value="<?php echo $write['wr_3']?>" class="frm_input" size="25"></td>
            <th><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" id="wr_email" value="<?php echo $write['wr_email']?>" required class="frm_input email required" size="40" maxlength="60"></td>
        </tr>
        <tr>
            <th><label for="wr_4">학교</label></th>
            <td><input type="text" name="wr_4" id="wr_4" value="<?php echo $write['wr_4']?>" class="frm_input" size="25"></td>
            <th><label for="wr_5">학년</label></th>
            <td>
				<select name="wr_5" id="wr_5" required class="required" >
                    <option value="해당없음" <?if($write['wr_5'] == "해당없음"){echo "selected";}?>>해당없음</option>
                    <option value="1학년" <?if($write['wr_5'] == "1학년"){echo "selected";}?>>1학년</option>
                    <option value="2학년" <?if($write['wr_5'] == "2학년"){echo "selected";}?>>2학년</option>
                    <option value="3학년" <?if($write['wr_5'] == "3학년"){echo "selected";}?>>3학년</option>
                    <option value="4학년" <?if($write['wr_5'] == "4학년"){echo "selected";}?>>4학년</option>
                    <option value="5학년" <?if($write['wr_5'] == "5학년"){echo "selected";}?>>5학년</option>
                    <option value="6학년" <?if($write['wr_5'] == "6학년"){echo "selected";}?>>6학년</option>
                </select>
            </td>
        </tr>
		<tr>
			<th><label for="rb_am">시간</label></th>
			<td>
				<input name="wr_6" id="rb_am" type="radio" value="오전" required <?if($write['wr_6'] == "오전"){echo "checked";}?>>
				<label for="rb_am">오전</label>
				&nbsp;&nbsp;/&nbsp;&nbsp;
				<input name="wr_6" id="rb_pm" type="radio" value="오후" required <?if($write['wr_6'] == "오후"){echo "checked";}?>>
				<label for="rb_pm">오후</label>
			</td>
			<th scope="row"><label for="wr_password">비밀<br />번호<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20" size="25"> 
				(신청서 열람에 필요합니다.)			</td>
		</tr>
        <tr>
            <th scope="row"><label for="wr_content">비고<strong class="sound_only">필수</strong></label></th>
            <td colspan="3" class="wr_content">
                <textarea id="wr_content" name="wr_content" style="width:100%;height:100px"><?php echo $write['wr_content']?></textarea>
            </td>
        </tr>

        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">첨부파일 #<?php echo $i+1 ?></th>
            <td colspan="3">
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
          </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td colspan="3">
                <?php echo $captcha_html ?>
            </td>
          </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

	<?if($w != "u"){?>
    <div class="checkbox" style="text-align:center;">
        <input name="cb_1" id="cb_1" type="checkbox">
		<label for="cb_1">상기 개인정보는 상담예약을 위해 본인 동의하에 제공하며 개인정보 수집 및 활용에 동의합니다.</label>
		<br />
        <input name="cb_2" id="cb_2" type="checkbox">
		<label for="cb_2">양산진로지원센터 새로운 소식, 이벤트, 활동사항 등의 문자서비스를 받겠습니다.</label>
    </div>
	<?}?>

    <div class="btn_confirm">
        <!--input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit"-->
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">박람회 신청조회</a>
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
		
		<?if($w != "u"){?>
		if($('input:checkbox[id="cb_1"]').is(":checked") == false){
			alert("상담예약을 위해 본인 동의하에 제공하며 개인정보 수집 및 활용에 동의하셔야합니다.");
			return false;
		}

		if($('input:checkbox[id="cb_2"]').is(":checked") == false){
			alert("양산진로지원센터 새로운 소식, 이벤트, 활동사항 등의 문자서비스에 동의하셔야합니다.");
			return false;
		}
		<?}?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->