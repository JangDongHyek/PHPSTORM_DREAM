<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 100);
$field=0<strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")?"text":"date";


?>



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
	<input type="hidden" name="wr_1" value="<?php echo $wr_1?>">
	<input type="hidden" name="mode" value="<?php echo $mode;?>">
	<input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
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
        <ul>
            <li>
            <label for="wr_subject">제목<strong class="sound_only">필수</strong></label>
            <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input" size="20" maxlength="255" placeholder="동영상 제목">
            </li>
			<li>
				<label for="wr_content">내용<strong class="sound_only">필수</strong></label>
				<textarea name="wr_content" class="frm_input"><?php echo $write['wr_content'] ?></textarea>
			</li>
            <li>
            <label for="wr_10">동영상 링크</label>
            <input type="text" name="wr_link1" value="<?php echo $write['wr_link1'] ?>" id="wr_link1" class="frm_input" required size="20" placeholder="동영상 링크">
            <div class="help11 blue">유튜브<!-- 나 다음팟--> 영상의 주소를 붙여넣으면 영상이 본문에 보여집니다.</div>
            <span class="help11">예시) http://www.youtube.com/watch?v=9bZkp7q19f0</span>
            </li>
            <li>
                <input type="text" name="wr_1" value="<?php echo $write['wr_1'] ?>" class="frm_input" required size="20" placeholder="동영상 포인트">
                <span class="help11">지급할 동영상 포인트를 입력하시면 됩니다.</span>
            </li>
        </ul>
	</div>

	<div class="btn_confirm">
		<input type="submit" value="등록완료" id="btn_submit" accesskey="s" class="btn_submit">
	</div>
	</form>

	<script>
	$.datepicker.setDefaults({
        dateFormat: 'yymmdd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
    });
		<? if(0<strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")){?>
	$(function() {
        $("#wr_2,#wr_3").datepicker();
    });
		<? }?>
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

		/* 유튜브 주소 통일 시키키 */
		var w10 = $('#wr_10');

		w10.val(w10.val().replace("youtu.be/", "youtube.com/watch?v="));
		w10.val(w10.val().replace("youtube.com/v/", "youtube.com/watch?v="));
		w10.val(w10.val().replace("youtube.com/embed/", "youtube.com/watch?v="));		
		w10.val(w10.val().split('&')[0]); // &포함된 긴 주소의 경우 &앞부분만 사용

		
		/* 본문중 youtube 있으면 추출 */
		var yt_text = $('#wr_content').val();
		if(yt_text.indexOf("youtu") > -1 && $('#wr_10').val().length < 20) {
			var aa = yt_text.indexOf("<iframe");
			if(aa > -1) {
				var bb = yt_text.indexOf("</iframe>");
				var ytag = $('#wr_content').val().substring(aa,bb+9);
				// 나중에 정규식으로 제대로 바꿔야 할듯
				var y_id = ytag.split('src="//www.youtube.com/embed/')[1].split('"')[0];

				alert('본문에 포함된 첫번째 youtube 태그를 삭제하고,\n동영상 주소 입력란으로 옮깁니다.');
				w10.val('http://www.youtube.com/watch?v=' + y_id);
				$('#wr_content').val(yt_text.replace(ytag, "")); // 본문에서 iframe 제거
				if($('#wr_content').val().length < 1) {
					$('#wr_content').val('.'); // 내용이 비어있으면 점하나 넣기
				}
			}
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
	

		return false;
	}
	</script>
</section>
<!-- } 게시물 작성/수정 끝 -->